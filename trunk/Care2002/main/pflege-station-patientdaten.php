<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

/**
* If the script call comes from the op module replace the user cookie with the user info from op module
*/
if($op_shortcut)
{
	$HTTP_COOKIE_VARS['ck_pflege_user'.$sid]=$op_shortcut;
	 setcookie('ck_pflege_user'.$sid,$op_shortcut);
	 $edit=1;
}
elseif(!$HTTP_COOKIE_VARS['ck_pflege_user'.$sid])
 {
		if($edit) {header('Location:../language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
 }
 elseif($HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid])
  {
	    setcookie('ck_pflege_user'.$sid,$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]);
		$edit=1;
  }

/* Load the visual signalling defined constants */
require_once('../include/inc_visual_signalling_fx.php');
require_once('../include/inc_config_color.php'); // load color preferences
require_once('../global_conf/inc_remoteservers_conf.php');

/* Retrieve the SIGNAL_COLOR_LEVEL_ZERO = for convenience purposes */
$z = SIGNAL_COLOR_LEVEL_ZERO;
/* Retrieve the SIGNAL_COLOR_LEVEL_FULL = for convenience purposes */
$f = SIGNAL_COLOR_LEVEL_FULL;

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
{	
    /* Load date formatter */
	include_once('../include/inc_date_format_functions.php');

	// get orig data
	$dbtable='care_admission_patient';
	$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
	if($ergebnis=mysql_query($sql,$link))
       	{
			if($rows=mysql_num_rows($ergebnis))
				{
					$result=mysql_fetch_array($ergebnis);
					if($edit&&(int)$result['discharge_date']) $edit=0;
					
					$event_table= 'care_nursing_station_patients_event_signaller';
					
					/* If mode = save_event_changes, save the color bar status */
					
					if($mode=='save_event_changes')
					{
					   $sql_buf='';
					   
					   /* prepare the rose_x part sql query */
					   
					   for ($i=1;$i<25;$i++)
					   {
					       $buf='rose_'.$i;
						   
						   $sql_buf.=$buf.'="'.$$buf.'", ';
					   }
					   
					   /* prepare the green_x part */
					   
					   for ($i=1;$i<8;$i++)
					   {
					       $buf='green_'.$i;
						   
						   $sql_buf.=$buf.'="'.$$buf.'", ';
					   }
					   
					   /* append the additional color event signallers */
					   
					   $sql_buf.='yellow="'.$yellow.'", black="'.$black.'", blue_pale="'.$blue_pale.'", brown="'.$brown.'", 
					                   pink="'.$pink.'", yellow_pale="'.$yellow_pale.'", red="'.$red.'", green_pale="'.$green_pale.'",
									   violet="'.$violet.'", blue="'.$blue.'", biege="'.$biege.'", orange="'.$orange.'"';
					   
					   
					   $sql='UPDATE '.$event_table.' SET '.$sql_buf.' WHERE patnum="'.$pn.'"';
					 
					 //  echo $sql; 

					   if ($event_result=mysql_query($sql,$link))
					   {
					     if (!mysql_affected_rows($link))
					      {
                            /* If entry not yet existing, insert data */
							
					        /* prepare the rose_x part sql query */
					       
						    $set_str='';
							$sql_buf='';
					   
					        for ($i=1;$i<25;$i++)
					       {
						   
					          $buf='rose_'.$i;
							  
							  $set_str.=$buf.', ';
						   
						       $sql_buf.='"'.$$buf.'", ';
					       }
					   
					       /* prepare the green_x part */
					   
					       for ($i=1;$i<8;$i++)
					      {
					          $buf='green_'.$i;
							  
							  $set_str.=$buf.', ';
						   
						       $sql_buf.='"'.$$buf.'", ';
					       }
							
					   /* append the additional color event signallers */
					   
					   $set_str.='yellow, black, blue_pale, brown, 
					                   pink, yellow_pale, red, green_pale,
									   violet, blue, biege, orange';
									   
					   /* prepare the values part */
					   
					   $sql_buf.='"'.$yellow.'", "'.$black.'", "'.$blue_pale.'", "'.$brown.'", 
					                   "'.$pink.'", "'.$yellow_pale.'", "'.$red.'", "'.$green_pale.'",
									   "'.$violet.'", "'.$blue.'", "'.$biege.'", "'.$orange.'"';
									
						$sql='INSERT INTO '.$event_table.' (patnum, '.$set_str.') VALUES ("'.$pn.'", '.$sql_buf.')';
						
					    if($event_result=mysql_query($sql,$link))
					    {
					       $event=&$HTTP_POST_VARS;
						   
						   $mode='changes_saved';
						    //echo "ok insertd $sql";
					    }
						else
						{
						    //echo "failed insert $sql";
						    $mode='';
						}

				      }
					  else
					  {
					      $mode='changes_saved';
						   //echo "update ok $sql";
					  }
					}
					else
					{
					      $mode='';
						   //echo " failed update $sql";
					}
			    }
				
				//echo $sql;

			   if(!isset($mode) || ($mode=='') || ($mode=='changes_saved'))
			   {
					/* Get the color event signaller data */
					
					$sql="SELECT * FROM ".$event_table." WHERE patnum='".$pn."'";
					
					if($event_result=mysql_query($sql,$link))
					{
					   if(mysql_num_rows($event_result)) 
					   {
					      $event=mysql_fetch_array($event_result);
						}
					    else
						{
						   /* If no event entry yet, create event array with zeros */
						   $event=array('yellow'=>$z,'black'=>$z,'blue_pale'=>$z,'brown'=>$z,'pink'=>$z,'yellow_pale'=>$z,'red'=>$z,'green_pale'=>$z,'violet'=>$z,'blue'=>$z,'biege'=>$z,'orange'=>$z);
						   /* Add the green_n */
						   for ($i=1;$i<8;$i++)
						   {
						       $event['green_'.$i]=$z;
						    }
							/* Add the rose_n */
						   for ($i=1;$i<25;$i++)
						   {
						       $event['rose_'.$i]=$z;
						    }
					    }
							
					}
			   }
			} // end of if($rows)
	  } // end of if ($ergebnis)
	   else {echo "<p>$sql$LDDbNoRead"; exit;}
        
    
}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }
		
$fr=strtolower(str_replace('.','-',($result['patnum'].'_'.$result['name'].'_'.$result['vorname'].'_'.$result['gebdatum'])));

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<META http-equiv='Cache-Control' content='no-cache, must-revalidate'>
<META http-equiv='Pragma: no-cache'>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo ucfirst($result[name]).",".ucfirst($result[vorname])." ".$result[gebdatum]." ".$LDPatDataFolder ?></TITLE>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover { color: red }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<script language="javascript">
<!-- 
  var urlholder;
  var changed_flag=0;

function initwindow(){
	if (window.focus) window.focus();
	window.resizeTo(800,600);
}

function getinfo(patientID){
	urlholder="pflege-station.php?route=validroute&patient=" + patientID + "&user=<?php echo $aufnahme_user.'"' ?>;
	patientwin=window.open(urlholder,patientID,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
}

function enlargewin(){
	window.moveTo(0,0);
	 window.resizeTo(1000,740);
}

function makekonsil(v)
{ 
    var x=v;
/*	if((v=="patho")||(v=="inmed")||(v=="radio")||(v=="baclabor")||(v=="blood")||(v=="chemlabor"))
	{
*/	
	   if((v=="inmed")||(v=="allamb")||(v=="unfamb")||(v=="sono")	||(v=="nuklear"))
	   {
	     v="generic";
	   }
	   location.href="pflege-station-patientdaten-doconsil-"+v+".php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&konsil="; ?>"+x+"&target="+v;
/*	}
	else 
	{v="radio";
	location.href="ucons.php?sid=<?php echo "$sid&lang=$lang&station=$station&pn=$pn&konsil="; ?>"+v;
	}
*/	//enlargewin();
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}


function pullbar(cb)
{
    var buf;
	
	eval("buf = document.patient_folder." + cb.name + ".value");
	
	buf=parseInt(buf);
	
	if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
	{ eval("document."+cb.name+".src='../gui/img/common/default/qbar_<?php echo $z ?>_"+cb.name+".gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
	}
		else 
		{
		 eval("document."+cb.name+".src='../gui/img/common/default/qbar_<?php echo $f ?>_"+cb.name+".gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
		}
	changed_flag=1;
}

function pullGreenbar(cb)
{
    var buf;
	
	eval("buf = document.patient_folder." + cb.name + ".value");
	
     buf=parseInt(buf);
	
	if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
	{ eval("document."+cb.name+".src='../gui/img/common/default/qbar_<?php echo $z ?>_green.gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
	}
		else 
		{
		 eval("document."+cb.name+".src='../gui/img/common/default/qbar_<?php echo $f ?>_green.gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
		}
	changed_flag=1;
}

function pullRosebar(cb)
{
    var buf;
	
	eval("buf = document.patient_folder." + cb.name + ".value");
	
     buf=parseInt(buf);
	
	if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
	{ eval("document."+cb.name+".src='../gui/img/common/default/qbar_<?php echo $z ?>_rose.gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
	}
		else 
		{
		 eval("document."+cb.name+".src='../gui/img/common/default/qbar_<?php echo $f ?>_rose.gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
		}
	changed_flag=1;
}

function isColorBarUpdated()
{
   if (changed_flag==1) return true;
     else return false;
}
//-->
</script>
</HEAD>

<BODY bgcolor=#cde1ec onLoad="initwindow(); <?php if($mode=='changes_saved') echo 'window.opener.location.reload();' ?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 link="#800080" vlink="#800080" >

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="navy" >
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDPatDataFolder $station"; ?></STRONG></FONT>
</td>
<td bgcolor="navy" height="10" align=right></a><a href="javascript:gethelp('patient_folder.php','<?php echo $nodoc ?>','','<?php echo $station ?>','Main folder')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?> alt="<?php echo $LDHelp ?>"></a><a href="javascript:window.close()"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a></td></tr>

</tr>
<tr>
<td colspan=2>
 <ul><p><br>
 
 <form action="" method="post" name="patient_folder" onSubmit="return isColorBarUpdated()">
 

<?php
switch($nodoc)
{
case "labor":
	echo '
	<center><FONT  COLOR="maroon"  SIZE=4  FACE="Arial"><p><br>
	<img '.createMascot('../','mascot1_r.gif','0','absmiddle').'> &nbsp;
	<b>'.$LDNoLabReport.'</b><p>
		<form action="'.$thisfile.'" method="get">
	<input type="hidden" name="sid" value="'.$sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="pn" value="'.$pn.'">
<input type="hidden" name="edit" value="'.$edit.'">
 <input type="hidden" name="station" value="'.$station.'">  
 <input type="submit" value=" OK ">
     </form>
	</center>';
	break;

default:
{
         /* Now create the first group of color event signaller */
        echo '<table   cellpadding="0" cellspacing=0 border="0" >
		<tr bgcolor="#696969" ><td colspan="3" ><nobr><a href="#"><img 
		'.createComIcon('../','qbar_'.$event['yellow'].'_yellow.gif','0').' name="yellow" onClick="javascript:pullbar(this)"></a><a href="#"><img 
		'.createComIcon('../','qbar_'.$event['black'].'_black.gif','0').' name="black" onClick="javascript:pullbar(this)"></a><a href="#"><img 
		'.createComIcon('../','qbar_'.$event['blue_pale'].'_blue_pale.gif','0').' name="blue_pale" onClick="javascript:pullbar(this)"></a><a href="#"><img 
		'.createComIcon('../','qbar_'.$event['brown'].'_brown.gif','0').' name="brown" onClick="javascript:pullbar(this)"></a><a href="#"><img 
		'.createComIcon('../','qbar_'.$event['pink'].'_pink.gif','0').' name="pink" onClick="javascript:pullbar(this)"></a><a href="#"><img 
		'.createComIcon('../','qbar_'.$event['yellow_pale'].'_yellow_pale.gif','0').' name="yellow_pale" onClick="javascript:pullbar(this)"></a><a href="#"><img 
		'.createComIcon('../','qbar_'.$event['red'].'_red.gif','0').' name="red" onClick="javascript:pullbar(this)"></a><a href="#"><img
		'.createComIcon('../','qbar_'.$event['green_pale'].'_green_pale.gif','0').' name="green_pale" onClick="javascript:pullbar(this)"></a><a href="#"><img
		'.createComIcon('../','qbar_'.$event['violet'].'_violet.gif','0').' name="violet" onClick="javascript:pullbar(this)"></a><a href="#"><img
		'.createComIcon('../','qbar_'.$event['blue'].'_blue.gif','0').' name="blue" onClick="javascript:pullbar(this)"></a><a href="#"><img
		'.createComIcon('../','qbar_'.$event['biege'].'_biege.gif','0').' name="biege" onClick="javascript:pullbar(this)"></a><img
		'.createComIcon('../','qbar_trans.gif','0').'><a href="#"><img
		'.createComIcon('../','qbar_'.$event['orange'].'_orange.gif','0').' name="orange" onClick="javascript:pullbar(this)"></a><img
		'.createComIcon('../','qbar_trans.gif','0').'><img
		'.createComIcon('../','qbar_trans.gif','0').'><img
		'.createComIcon('../','qbar_trans.gif','0').'>';
		
		/* Create the green bars */
		/* Note $h is used here as counter  */
		for($h=1;$h<8;$h++)
		{ 
		  echo '<a href="#"><img
		 '.createComIcon('../','qbar_'.$event['green_'.$h].'_green.gif','0').' alt="'.$LDFullDayName[$h].'"  name="green_'.$h.'" onClick="javascript:pullGreenbar(this)"></a>';
		  }
		 
		 echo '<img
		'.createComIcon('../','qbar_trans.gif','0').'>';
		
		/* Create the rose bars*/
		/* Note $h is used here as counter  */
		for($h=1;$h<25;$h++)
		{ 

		  echo '<a href="#"><img 
			 '.createComIcon('../','qbar_'.$event['rose_'.$h].'_rose.gif','0').' alt="'.$h.' '.$LDHour.'"  name="rose_'.$h.'" onClick="javascript:pullRosebar(this)"></a>';
			if(($h==6)||($h==12)||($h==18))
		 	echo'<img
			  '.createComIcon('../','qbar_trans.gif','0').'>';
		 }
		 
		 /* Create the tag links */
		echo '</td></nobr>
		</tr>
		<tr bgcolor="#696969" ><td colspan="3" ><nobr>
		<input type="button" onClick="javascript:enlargewin();window.location.href=\'pflege-station-patientdaten-kurve.php?sid='.$sid.'&lang='.$lang.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDFeverCurve.'"><input 
		type="button" onClick="javascript:enlargewin();window.location.href=\'pflege-station-patientdaten-pbericht.php?sid='.$sid.'&lang='.$lang.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDNursingReport.'"><input 
		type="button" onClick="javascript:enlargewin();window.location.href=\'pflege-station-patientdaten-todo.php?sid='.$sid.'&lang='.$lang.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDDocsPrescription.'"><input 
		type="button" onClick="javascript:enlargewin();window.location.href=\'diagnostics-report-start.php?sid='.$sid.'&lang='.$lang.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'&header='.$result['name'].',+'.$result['vorname'].'+'.formatDate2Local($result['gebdatum'],$date_format).'\'" value="'.$LDReports.'"><br>
		<input type="button" value="'.$LDRootData.'"><input 
		type="button" value="'.$LDNursingPlan.'"><input 
		type="button" onClick="javascript:window.location.href=\'labor_datalist_noedit.php?sid='.$sid.'&lang='.$lang.'&station='.$station.'&patnum='.$pn.'&from=station&edit='.$edit.'\'" value="'.$LDLabReports.'"><input 
		type="button" onClick="javascript:enlargewin();window.location.href=\'fotos-start.php?sid='.$sid.'&lang='.$lang.'&pn='.$pn.'&station='.$station.'&fileroot='.$fr.'&edit='.$edit.'\'" value="'.$LDPhotos.'">';
		
		
		/* Create the select  menu in edit mode */
		if($edit)
		{
		$ChkUpOptions=get_meta_tags('../global_conf/'.$lang.'/konsil_tag_dept.pid');
		
		echo '<select 
		name="konsiltyp" size="1" onChange=makekonsil(this.value)>
			<option value="">'.$LDChkUpRequests.'</option>';

		while(list($x,$v)=each($ChkUpOptions))
		echo'
			<option value="'.$x.'">'.$v.'</option>';
		echo '
		</select>';
		}
		
		/* Create frames witht the skins */
		echo '
		</nobr>
		</td>
		</tr>
		<tr bgcolor="#696969" >
		<td colspan=3   background="'.createBgSkin('../','folderskin2.jpg').'">&nbsp;</td>
		</tr>';
/**
*  Display the patient's basic info
* By default, the png image label displayed
* To use the html display form uncomment the code within the PATIENT_INFO_HTML tags
*  and comment out the code within the PATIENT_INFO_IMAGE tags
*/		
/*	

//..................... START...... PATIENT_INFO_HTML

	echo'
		<tr  bgcolor="#696969"><td   background="'.createBgSkin('../','folderskin2.jpg').'"><font face="verdana,arial" size="2" ><b>&nbsp;&nbsp;</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" >&nbsp;<b>'.$result[patnum].'</b></td>
		<td   background="'.createBgSkin('../','folderskin2.jpg').'"><font face="verdana,arial" size="2" ><b>&nbsp;</b></td>
		</tr>';

//..................... END....... PATIENT_INFO_HTML
		
*/
echo '
<tr  bgcolor="#696969" ><td  background="'.createBgSkin('../','folderskin2.jpg').'"><font face="verdana,arial" size="2" ><b> &nbsp;&nbsp;</b></td>
		<td valign="top" bgcolor="#ffffff"><font face="verdana,arial" size="2" >';

//..................... START...... PATIENT_INFO_HTML

/*
echo '<ul>'.$result[title].'<br>
		<b>'.ucfirst($result[name]).', '.ucfirst($result[vorname]).'</b> <br>
		<font color=maroon>'.formatDate2Local($result[gebdatum],$date_format).'</font> <p>
		'.nl2br($result[address]);

echo '<p>'.strtoupper($station).' &nbsp; &nbsp; '.$result[kasse].' '.$result[kassename];
//echo '<p><IMG SRC="http://www.barcodemill.com/cgi-bin/barcodemill/bcmill/barcode.gif?height=30&symbol=1&content='.$result[patnum].'" align="left">';

if(file_exists('../cache/barcodes/pn_'.$result['patnum'].'.png')) echo '<br><img src="../cache/barcodes/pn_'.$result[patnum].'.png" border=0>';
else echo "<br><img src='../classes/barcode/image.php?code=$result[patnum]&style=68&type=I25&width=145&height=50&xres=2&font=5' border=0>";
echo '</ul>';
*/
// echo '<p>'.$pday.'.'.$pmonth.'.'.$pyear;

//..................... END....... PATIENT_INFO_HTML

//..................... START...... PATIENT_INFO_IMAGE

echo '<img src="../imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&pn='.$result['patnum'].'" width=282 height=178 align="left" hspace=5 vspace=5>';

//..................... END....... PATIENT_INFO_IMAGE

/* Create the colorbar legend table */

echo '
<table border=0 cellspacing=1 cellpadding=0>
  <tr>
    <td bgcolor="#ffff00"><font size=1>&nbsp;&nbsp;&nbsp;</font></td>
    <td><font size=1>&nbsp;'.$LDQueryDoctor.'</font></td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#000000"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDDoctorInfo.'</font></td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#81eff5"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDTestConsultRequested.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#804408"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDDiagnosticsReport.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#f598cb"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDInfusionTherapy.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#ebf58d"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDMonitorFluidDischarge.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#ff0000"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDBloodProgram.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#00ff00"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDAntibioticsProgram.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#dd36fc"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDAnticoagProgram.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#0000ff"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDNurseReport.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#f5ddc6"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDSpecialCare.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#fdad29"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDDaily.'</td>
  </tr>
  <tr>

</table>
';


echo '
		</td>
		<td   background="'.createBgSkin('../','folderskin2.jpg').'" valign="top" align="center">
		';
//$frmain=$fotoserver_http.'/fotos/'.$fr.'/'.$fr.'_main.jpg';

$fname=strtolower($fr."_main.jpg");
$frmain='/'.$fr.'/'.$fname;

//******************* check cache if pix exists *************
$cpix='../cache/'.$fname;

if(file_exists($cpix))
{
	echo '<img src="'.$cpix.'" width="150">';
}
else
{
	// if fotos must be fetched directly from local dir
	if($disc_pix_mode) 
	{
		$cpix=$fotoserver_localpath.$fr.'/'.$fname;
		if(file_exists($cpix))
		{
			echo '<img src="'.$cpix.'" width="150">';
		}
		else echo '<img  '.createLDImgSrc('../','foto_na.gif').'>';
	}
	else
	{
		//**************** ftp check of main pix ************************

		// set up basic connection
		//$ftp_server="192.168.0.2";   // configured in the file ..include/inc_remoteservers_conf.php
		//$ftp_user="maryhospital_fotodepot";
		//$ftp_pw="seeonly";
		$conn_id = ftp_connect("$ftp_server"); 
		if ($conn_id)
		{
			// login with username and password
			$login_result = ftp_login($conn_id, "$ftp_user", "$ftp_pw"); 

  	 		 // check connection
  			if($login_result)
		 	{ 
  				$fn=ftp_pwd($conn_id);       
				$f_e=ftp_size($conn_id,"$fn$frmain");
  		  		//if(strpos(file("$frmain"),"warning")) echo '<img src="'.$frmain.'">';
				if($f_e>0)
				{
			 		echo '<img src="'.$fotoserver_http.$frmain.'" width="150">';
					// now save the pix in cache
					ftp_get($conn_id,$cpix,"$fn$frmain",FTP_BINARY);	
				}
				else echo '<img '.createLDImgSrc('../','foto_na.gif').'>';
  			}
		 	else	echo "$LDFtpNoLink<p>";
			// close the FTP stream 
			ftp_quit($conn_id); 
		}	
		else 
		{
			echo '<img '.createLDImgSrc('../','foto_na.gif').'><br>';
			echo $LDFtpAttempted; 
		}
	}
 }
 
echo '
		</td>
		<td bgcolor="#cde1ec"><font face="verdana,arial" size="2" >
		

		</td>
		</tr>
		<tr bgcolor="#696969" >
		<td colspan=3  background="'.createBgSkin('../','folderskin2.jpg').'">&nbsp;</td>
		</tr>
		</table>
		';

	}// end of default	
}	//end of switch (nodoc
		
?>



<input type="hidden" name="yellow" value="<?php echo $event['yellow'] ?>">
<input type="hidden" name="black" value="<?php echo $event['black'] ?>">
<input type="hidden" name="blue_pale" value="<?php echo $event['blue_pale'] ?>">
<input type="hidden" name="brown" value="<?php echo $event['brown'] ?>">
<input type="hidden" name="pink" value="<?php echo $event['pink'] ?>">
<input type="hidden" name="yellow_pale" value="<?php echo $event['yellow_pale'] ?>">
<input type="hidden" name="red" value="<?php echo $event['red'] ?>">
<input type="hidden" name="green_pale" value="<?php echo $event['green_pale'] ?>">
<input type="hidden" name="violet" value="<?php echo $event['violet'] ?>">
<input type="hidden" name="blue" value="<?php echo $event['blue'] ?>">
<input type="hidden" name="biege" value="<?php echo $event['biege'] ?>">
<input type="hidden" name="orange" value="<?php echo $event['orange'] ?>">
<input type="hidden" name="green_1" value="<?php echo $event['green_1'] ?>">
<input type="hidden" name="green_2" value="<?php echo $event['green_2'] ?>">
<input type="hidden" name="green_3" value="<?php echo $event['green_3'] ?>">
<input type="hidden" name="green_4" value="<?php echo $event['green_4'] ?>">
<input type="hidden" name="green_5" value="<?php echo $event['green_5'] ?>">
<input type="hidden" name="green_6" value="<?php echo $event['green_6'] ?>">
<input type="hidden" name="green_7" value="<?php echo $event['green_7'] ?>">
<input type="hidden" name="rose_1" value="<?php echo $event['rose_1'] ?>">
<input type="hidden" name="rose_2" value="<?php echo $event['rose_2'] ?>">
<input type="hidden" name="rose_3" value="<?php echo $event['rose_3'] ?>">
<input type="hidden" name="rose_4" value="<?php echo $event['rose_4'] ?>">
<input type="hidden" name="rose_5" value="<?php echo $event['rose_5'] ?>">
<input type="hidden" name="rose_6" value="<?php echo $event['rose_6'] ?>">
<input type="hidden" name="rose_7" value="<?php echo $event['rose_7'] ?>">
<input type="hidden" name="rose_8" value="<?php echo $event['rose_8'] ?>">
<input type="hidden" name="rose_9" value="<?php echo $event['rose_9'] ?>">
<input type="hidden" name="rose_10" value="<?php echo $event['rose_10'] ?>">
<input type="hidden" name="rose_11" value="<?php echo $event['rose_11'] ?>">
<input type="hidden" name="rose_12" value="<?php echo $event['rose_12'] ?>">
<input type="hidden" name="rose_13" value="<?php echo $event['rose_13'] ?>">
<input type="hidden" name="rose_14" value="<?php echo $event['rose_14'] ?>">
<input type="hidden" name="rose_15" value="<?php echo $event['rose_15'] ?>">
<input type="hidden" name="rose_16" value="<?php echo $event['rose_16'] ?>">
<input type="hidden" name="rose_17" value="<?php echo $event['rose_17'] ?>">
<input type="hidden" name="rose_18" value="<?php echo $event['rose_18'] ?>">
<input type="hidden" name="rose_19" value="<?php echo $event['rose_19'] ?>">
<input type="hidden" name="rose_20" value="<?php echo $event['rose_20'] ?>">
<input type="hidden" name="rose_21" value="<?php echo $event['rose_21'] ?>">
<input type="hidden" name="rose_22" value="<?php echo $event['rose_22'] ?>">
<input type="hidden" name="rose_23" value="<?php echo $event['rose_23'] ?>">
<input type="hidden" name="rose_24" value="<?php echo $event['rose_24'] ?>">

<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">

<input type="hidden" name="mode" value="save_event_changes">
<input type="submit" value="<?php echo $LDSaveChanges ?>">

<?php
  echo '<a href="javascript:window.close()"><img '.createLDImgSrc('../','close2.gif','0','absmiddle').'></a>';
?>


</form>
<p>
</FONT>
</ul>
<p>
</td>
</tr>
</table>        
<p>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</BODY>
</HTML>
