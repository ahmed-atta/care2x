<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

/* Start initializations */
define('LANG_FILE','konsil_chemlabor.php');

/* Globalize the variables */
require_once('../include/inc_vars_resolve.php');

/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  $breakfile="labor.php?sid=".$sid."&lang=".$lang; 
}
else
{
  $local_user='ck_pflege_user';
  $breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn";
}

require_once('../include/inc_front_chain_lang.php'); ///* invoke the script lock*/
require_once('../include/inc_config_color.php'); ///* load color preferences*/

$thisfile='labor_test_request_admin_chemlabor.php';

$bgc1='#fff3f3'; /* The main background color of the form */
$abtname=get_meta_tags("../global_conf/$lang/konsil_tag_dept.pid");
$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

$formtitle=$abtname[$konsil];

						
/* Here begins the real work */
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
{	
	   
	 if(!isset($mode))   $mode="";
		
		  switch($mode)
		  {
		     case 'done':
							      $sql="UPDATE care_test_request_".$subtarget." SET status = 'done'  WHERE batch_nr = '".$batch_nr."'";
								  
							      if($ergebnis=mysql_query($sql,$link))
       							  {
									//echo $sql;
									mysql_close($link);
									 header("location:".$thisfile."?sid=$sid&lang=$lang&edit=$edit&pn=$pn&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								break; // end of case 'save'		  
		     case 'save':
								break; // end of case 'save'
		     case 'update':
							
								break; // end of case 'save'
								
								
	        /* If mode is edit, get the stored test request when its status is either "pending" or "draft"
			*  otherwise it is not editable anymore which happens when the lab has already processed the request,
			*  or when it is discarded, hidden, locked, or otherwise. 
			*
			*  If the "parameter" element is not empty, parse it to the $stored_param variable
			*/
			case 'edit':
						 
						 break; ///* End of case 'edit': */
			
			 default: $mode='';
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get the pending test requests */
		  {
		                $sql="SELECT batch_nr,patnum,send_date,dept,room_nr FROM care_test_request_".$subtarget." 
						         WHERE status='pending' ORDER BY  send_date DESC";
								 
		                if($requests=mysql_query($sql,$link))
       		            {
                            /* If request is available, load the date format functions */
						    require_once('../include/inc_date_format_functions.php');
                            
						
				            $batchrows=mysql_num_rows($requests);
	                        if($batchrows && (!isset($batch_nr) || !$batch_nr)) 
					        {
						       $test_request=mysql_fetch_array($requests);
							   mysql_data_seek($requests,0);
                               /* Check for the patietn number = $pn. If available get the patients data */
		                       $pn=$test_request['patnum'];
						       $batch_nr=$test_request['batch_nr'];
							}
			             }
			               else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						 $mode="show";   
		   }	
		       
	   
     /* Check for the patietn number = $pn. If available get the patients data */
     if($batchrows && $pn)
	 {		
	    $dbtable='care_admission_patient';
	    /* Get original data */
		$sql="SELECT * FROM $dbtable WHERE patnum='".$pn."'";
		if($ergebnis=mysql_query($sql,$link))
       	{
				if( $rows=mysql_num_rows($ergebnis)) 
					{
						$result=mysql_fetch_array($ergebnis);

		                $sql="SELECT * FROM care_test_request_".$subtarget." WHERE batch_nr='".$batch_nr."'";
		                if($ergebnis=mysql_query($sql,$link))
       		            {
				            if($editable_rows=mysql_num_rows($ergebnis))
					        {
							
     					       $stored_request=mysql_fetch_array($ergebnis);
							   
							   if($stored_request['parameters']!="")
							   {
							      //echo $stored_request['parameters'];
   						          parse_str($stored_request['parameters'],$stored_param);
							      $edit_form=1;
							   }
					         }
			             }
						else
					     {
						     echo "<p>$sql<p>$LDDbNoRead"; 
						  }					
				}
		}
	   else 
	   {
		  $mode="";
		  $pn="";
	   }		
     }		   
		   
		   
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>
<?php
require('../include/inc_css_a_hilitebu.php');
?>
<style type="text/css">
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 

<?php
if($edit)
{
?>

function chkForm(d)
{ 
   return true 
}

function loadM(fn)
{
	mBlank=new Image();
	mBlank.src="../img/pink_border.gif";
	mFilled=new Image();
	mFilled.src="../img/filled_pink_block.gif";
	
	form_name=fn;
}

function setM(m)
{
    eval("marker=document.images."+m);
	eval("element=document."+form_name+"."+m);
	
    if(marker.src!=mFilled.src)
	{
	   marker.src=mFilled.src;
	   element.value='1';
	  // alert(element.name+element.value);
	}
	 else 
	 {
	    marker.src=mBlank.src;
		element.value='0';
	  // alert(element.name+element.value);
	 }
}


function setThis(prep,elem,begin,end,step)
{
  for(i=begin;i<end;i=i+step)
  {
     x=prep + i;
     if(elem!=i)
     {
       eval("marker=document.images."+x);
	   if(marker.src==mFilled.src)  setM(x);
     }
  }
  setM(prep+elem);
}

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

<?php
}
?>

function printOut()
{
	urlholder="labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&target=<?php echo $target ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $stored_request['patnum'] ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>
//-->
</script>
<script language="javascript" src="../js/setdatetime.js">
</script>

<script language="javascript" src="../js/checkdate.js">
</script>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); " 
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDPendingTestRequest." (".$stored_request['patnum']." ".$stored_request['room_nr']." ".$stored_request['dept'].")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp()"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>

<table border=0>
  <tr valign="top">
  <!-- Left block for the request list  -->
    <td><FONT  SIZE=1  FACE="verdana">  
<?php 

/* The following routine creates the list of pending requests */
require('../include/inc_test_request_lister_fx.php');

?></td>
<!-- right block for the form -->
    <td>
	
<!-- Here begins the form  -->	
        
     <a href="javascript:printOut()"><img <?php echo createLDImgSrc('../','printout.gif','0','absmiddle') ?> alt="<?php echo $LDPrintOut ?>"></a>
     <a href="<?php echo $thisfile."?sid=".$sid."&lang=".$lang."&edit=".$edit."&mode=done&target=".$target."&subtarget=".$subtarget."&batch_nr=".$batch_nr."&user_origin=".$user_origin."&noresize=".$noresize; ?>"><img <?php echo createLDImgSrc('../','done.gif','0','absmiddle') ?> alt="<?php echo $LDDone ?>"></a>

<?php
require_once('../include/inc_test_request_printout_chemlabor.php');
?>

     <a href="javascript:printOut()"><img <?php echo createLDImgSrc('../','printout.gif','0','absmiddle') ?> alt="<?php echo $LDPrintOut ?>"></a>
     <a href="<?php echo $thisfile."?sid=".$sid."&lang=".$lang."&edit=".$edit."&mode=done&target=".$target."&subtarget=".$subtarget."&batch_nr=".$batch_nr."&user_origin=".$user_origin."&noresize=".$noresize; ?>"><img <?php echo createLDImgSrc('../','done.gif','0','absmiddle') ?> alt="<?php echo $LDDone ?>"></a>

</td>

</tr>
</table>        	
	
	</td>
  </tr>
</table>

<p>

<?php
if(file_exists("../language/$lang/".$lang."_copyrite.php")) include("../language/$lang/".$lang."_copyrite.php");
  else include("../language/en/en_copyrite.php");?>
<a name="bottom"></a>
</BODY>
</HTML>
