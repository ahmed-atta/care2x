<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if($op_shortcut)
{
	$ck_pflege_user=$op_shortcut;
	 setcookie(ck_pflege_user,$op_shortcut);
}
	elseif(!$ck_pflege_user)
	 {
		if($edit) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
	}

require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php"); // load color preferences

require("../global_conf/remoteservers_conf.php");

require("../req/db-makelink.php");
if($link&&$DBLink_OK)
	{	
	// get orig data
	$dbtable="mahopatient";
	$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
	if($ergebnis=mysql_query($sql,$link))
       	{
			$rows=0;
			if( $result=mysql_fetch_array($ergebnis)) $rows++;
			if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					if($edit&&$result[discharge_date]) $edit=0;
				}
		}
		else {print "<p>$sql$LDDbNoRead"; exit;}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }
		
$fr=strtolower(str_replace(".","-",($result[patnum]."_".$result[name]."_".$result[vorname]."_".$result[gebdatum])));

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<META http-equiv='Cache-Control' content='no-cache, must-revalidate'>
<META http-equiv='Pragma: no-cache'>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?=$LDPatDataFolder ?></TITLE>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover { color: red }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<script language="javascript">
<!-- 
  var urlholder;
	var colorbar=new Array();
	function initwindow(){
	 	if (window.focus) window.focus();
		window.resizeTo(700,450);
		}

  function getinfo(patientID){
	urlholder="pflege-station.php?route=validroute&patient=" + patientID + "&user=<? print $aufnahme_user.'"' ?>;
	patientwin=window.open(urlholder,patientID,"width=600,height=400,menubar=no,resizable=yes,scrollbars=yes");
	}

	function enlargewin(){
	window.moveTo(0,0);
	 window.resizeTo(1000,740);
	}

function makekonsil(v)
{ 
	if((v=="patho")||(v=="inmed")||(v=="radio"))
	{
	location.href="pflege-station-patientdaten-doconsil-"+v+".php?sid=<? print "$ck_sid&lang=$lang&edit=$edit&station=$station&pn=$pn&konsil="; ?>"+v;
	}
	else 
	{v="radio";
	location.href="ucons.php?sid=<? print "$ck_sid&lang=$lang&station=$station&pn=$pn&konsil="; ?>"+v;
	}
	//enlargewin();
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
function pullcolorbar(cb)
{
	if(colorbar[cb.name]||(colorbar[cb.name]==1))
	{ eval("document."+cb.name+".src='../img/quickbar-"+cb.name+".gif'");
		 colorbar[cb.name]=0;
	}
		else 
		{
		 eval("document."+cb.name+".src='../img/qbar-"+cb.name+".gif'");
		 colorbar[cb.name]=1;
		}
}
function pullbar(cb,c)
{
	
	if(colorbar[cb.name]||(colorbar[cb.name]==1))
	{ eval("document."+cb.name+".src='../img/qbar-"+c+".gif'");
		 colorbar[cb.name]=0;
	}
		else 
		{
		 eval("document."+cb.name+".src='../img/quickbar-"+c+".gif'");
		 colorbar[cb.name]=1;
		}
}
//-->
</script>
</HEAD>

<BODY bgcolor=#cde1ec onLoad="initwindow()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 link="#800080" vlink="#800080">



<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="navy" >
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG><? print "$LDPatDataFolder $station"; ?></STRONG></FONT>
</td>
<td bgcolor="navy" height="10" align=right></a><a href="javascript:gethelp('patient_folder.php','<?=$nodoc ?>','','<?=$station ?>','Main folder')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 alt="<?=$LDHelp ?>"></a><a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"></a></td></tr>

</tr>
<tr>
<td colspan=2>
 <ul><p><br>
<?

switch($nodoc)
{
case "labor":
	print '
	<center><FONT  COLOR="maroon"  SIZE=4  FACE="Arial"><p><br>
	<img src="../img/catr.gif" border=0 width=88 height=80 align=absmiddle> &nbsp;
	<b>'.$LDNoLabReport.'</b><p>
		<form action="'.$thisfile.'" method="get">
	<input type="hidden" name="sid" value="'.$ck_sid.'">
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

print '<form name="konsil"><table   cellpadding="0" cellspacing=0 border="0" >
		<tr bgcolor="#696969" ><td colspan="3" ><nobr><a href="#"><img 
		src="../img/quickbar-red.gif" border=0 width=19 height=40 name="red" onClick="javascript:pullcolorbar(this)"></a><a href="#"><img 
		src="../img/quickbar-blk.gif" border=0 width=19 height=40 name="blk" onClick="javascript:pullcolorbar(this)"></a><a href="#"><img 
		src="../img/qbar-blu.gif" border=0 width=19 height=40 name="blu" onClick="javascript:pullcolorbar(this)"></a><a href="#"><img 
		src="../img/quickbar-vio.gif" border=0 width=19 height=40 name="vio" onClick="javascript:pullcolorbar(this)"></a><a href="#"><img 
		src="../img/qbar-yel.gif" border=0 width=19 height=40 name="yel" onClick="javascript:pullcolorbar(this)"></a><a href="#"><img 
		src="../img/quickbar-grn.gif" border=0 width=19 height=40 name="grn" onClick="javascript:pullcolorbar(this)"></a><a href="#"><img 
		src="../img/quickbar-ora.gif" border=0 width=19 height=40 name="ora" onClick="javascript:pullcolorbar(this)"></a><img
		src="../img/quickbar-trans.gif" border=0 width=19 height=40><img
		src="../img/quickbar-trans.gif" border=0 width=19 height=40><img
		src="../img/quickbar-trans.gif" border=0 width=19 height=40>';
		for($h=0;$h<7;$h++)
		{ print '<a href="#"><img src="../img/qbar-gren.gif" border=0 width=10 height=40 alt="'.$LDFullDayName[$h].'"  name="gren'.$h.'" onClick="javascript:pullbar(this,\'gren\')"></a>';
		 }
		 print '<img
		src="../img/quickbar-trans.gif" border=0 width=10 height=40>';
		for($h=0;$h<24;$h++)
		{ print '<a href="#"><img src="../img/qbar-pink.gif" border=0 width=10 height=40 alt="'.$h.' '.$LDHour.'"  name="pink'.$h.'" onClick="javascript:pullbar(this,\'pink\')"></a>';
			if(($h==5)||($h==11)||($h==17))
		 	print'<img src="../img/quickbar-trans.gif" border=0 width=10 height=40>';
		 }
		print '</td></nobr>
		</tr>
		<tr bgcolor="#696969" ><td colspan="3" ><nobr>
		<input type="button" onClick="javascript:enlargewin();window.location.href=\'pflege-station-patientdaten-kurve.php?sid='.$ck_sid.'&lang='.$lang.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDFeverCurve.'"><input 
		type="button" onClick="javascript:enlargewin();window.location.href=\'pflege-station-patientdaten-pbericht.php?sid='.$ck_sid.'&lang='.$lang.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDNursingReport.'"><input 
		type="button" onClick="javascript:enlargewin();window.location.href=\'pflege-station-patientdaten-todo.php?sid='.$ck_sid.'&lang='.$lang.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDDocsPrescription.'"><input 
		type="button" onClick="javascript:enlargewin();window.location.href=\'pflege-station-patientdaten-diagnosis.php?sid='.$ck_sid.'&lang='.$lang.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDReports.'"><br>
		<input type="button" value="'.$LDRootData.'"><input 
		type="button" value="'.$LDNursingPlan.'"><input 
		type="button" onClick="javascript:window.location.href=\'labor_datalist_noedit.php?sid='.$ck_sid.'&lang='.$lang.'&station='.$station.'&patnum='.$pn.'&from=station&edit='.$edit.'\'" value="'.$LDLabReports.'"><input 
		type="button" onClick="javascript:enlargewin();window.location.href=\'fotos-start.php?sid='.$ck_sid.'&lang='.$lang.'&pn='.$pn.'&station='.$station.'&fileroot='.$fr.'&edit='.$edit.'\'" value="'.$LDPhotos.'">';
		
		if($edit)
		{
		$ChkUpOptions=get_meta_tags("../global_conf/$lang/konsil_tag_dept.pid");
		
		print '<select 
		name="konsiltyp" size="1" onChange=makekonsil(this.value)>
			<option value="">'.$LDPleaseSelect.'</option>';

		while(list($x,$v)=each($ChkUpOptions))
		print'
			<option value="'.$x.'">'.$v.'</option>';
		print '
		</select>';
		}
		print '
		</nobr>
		</td>
		</tr>
		<tr bgcolor="#696969" >
		<td colspan=3   background="../img/skin/folderskin2.jpg">&nbsp;</td>
		</tr>
		<tr  bgcolor="#696969"><td   background="../img/skin/folderskin2.jpg"><font face="verdana,arial" size="2" ><b>&nbsp;&nbsp;</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" >&nbsp;<b>'.$result[patnum].'</b></td>
		<td   background="../img/skin/folderskin2.jpg"><font face="verdana,arial" size="2" ><b>&nbsp;</b></td>
		</tr>';


print '
<tr  bgcolor="#696969" ><td  background="../img/skin/folderskin2.jpg"><font face="verdana,arial" size="2" ><b> &nbsp;&nbsp;</b></td>
		<td valign="top" bgcolor="#ffffff"><font face="verdana,arial" size="2" ><ul>
		'.$result[title].'<br>
		<b>'.ucfirst($result[name]).', '.ucfirst($result[vorname]).'</b> <br>
		<font color=maroon>'.$result[gebdatum].'</font> <p>
		'.nl2br($result[address]);



print '<p>'.strtoupper($station).' &nbsp; &nbsp; '.$result[kasse].' '.$result[kassename];
/*print '<p><IMG SRC="http://www.barcodemill.com/cgi-bin/barcodemill/bcmill/barcode.gif?height=30&symbol=1&content='.$result[patnum].'" align="left">';
*/
if(file_exists("../cache/barcodes/pn_".$result[patnum].".png")) print '<br><img src="../cache/barcodes/pn_'.$result[patnum].'.png" border=0>';
else print "<br><img src='../barcode/image.php?code=$result[patnum]&style=68&type=I25&width=145&height=50&xres=2&font=5' border=0>";
/*
print '<p>
		'.$pday.'.'.$pmonth.'.'.$pyear;
*/
print '</ul>
		</td>
		<td   background="../img/skin/folderskin2.jpg" valign="top" align="center">
		';
//$frmain=$fotoserver_http.'/fotos/'.$fr.'/'.$fr.'_main.jpg';

$fname=strtolower($fr."_main.jpg");
$frmain='/'.$fr.'/'.$fname;

//******************* check cache if pix exists *************
$cpix='../cache/'.$fname;

if(file_exists($cpix))
{
	print '<img src="'.$cpix.'" width="150">';
}
else
{
	// if fotos must be fetched directly from local dir
	if($disc_pix_mode) 
	{
		$cpix=$fotoserver_localpath.$fr.'/'.$fname;
		if(file_exists($cpix))
		{
			print '<img src="'.$cpix.'" width="150">';
		}
		else print '<img src="'.$fotoserver_localpath.'foto-na.jpg">';
	}
	else
	{
		//**************** ftp check of main pix ************************

		// set up basic connection
		//$ftp_server="192.168.0.2";   // configured in the file ..req/remoteservers_conf.php
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
  		  		//if(strpos(file("$frmain"),"warning")) print '<img src="'.$frmain.'">';
				if($f_e>0)
				{
			 		print '<img src="'.$fotoserver_http.$frmain.'" width="150">';
					// now save the pix in cache
					ftp_get($conn_id,$cpix,"$fn$frmain",FTP_BINARY);	
				}
				else print '<img src="'.$fotoserver_localpath.'foto-na.jpg">';
  			}
		 	else	echo "$LDFtpNoLink<p>";
			// close the FTP stream 
			ftp_quit($conn_id); 
		}	
		else 
		{
			print '<img src="'.$fotoserver_localpath.'foto-na.jpg"><br>';
			echo $LDFtpAttempted; 
		}
	}
 }
 
 
print '
		</td>
		<td bgcolor="#cde1ec"><font face="verdana,arial" size="2" >
		

		</td>
		</tr>
		<tr bgcolor="#696969" >
		<td colspan=3  background="../img/skin/folderskin2.jpg">&nbsp;</td>
		</tr>
		</table></form>	
		<a href="javascript:window.close()"><img src="../img/'.$lang.'/'.$lang.'_close2.gif" border="0"></a>
		';

	}// end of default	
}	//end of switch (nodoc
		
?>


<p>




</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</BODY>
</HTML>
