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

define('LANG_FILE','lab.php');

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
  if($target=='radio') $breakfile='radiolog.php?sid='.$sid.'&lang='.$lang;
   else $breakfile='labor.php?sid='.$sid.'&lang='.$lang;
}
else
{
  $local_user='ck_pflege_user';
  $breakfile='pflege-station-patientdaten.php?sid='.$sid.'&lang='.$lang.'&pn='.$pn.'&station='.$station.'&edit='.$edit.'&user_origin='.$user_origin;
}

require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

$thisfile='labor_test_request_aftersave.php';

$db_request_table=$target;

/* Here begins the real work */
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
{	

     require_once('../include/inc_date_format_functions.php');
     
	   
	 if(!isset($mode))   $mode='';
  
	   
		
	    $dbtable='care_admission_patient';
	    /* Get original data */
		$sql="SELECT * FROM $dbtable WHERE patnum='".$pn."'";
		if($ergebnis=mysql_query($sql,$link))
       	{
				if( $rows=mysql_num_rows($ergebnis)) 
					{
						$result=mysql_fetch_array($ergebnis);

		                $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		                if($ergebnis=mysql_query($sql,$link))
       		            {
				            if($editable_rows=mysql_num_rows($ergebnis))
					        {
							
     					       $stored_request=mysql_fetch_array($ergebnis);
								  if($target=='baclabor')
								  {
								  	  parse_str($stored_request['material'],$stored_material);
							          parse_str($stored_request['test_type'],$stored_test_type);
								   }
								   elseif($target=='chemlabor')
								   {
								       if($stored_request['parameters']!='') parse_str($stored_request['parameters'],$stored_param);
								   }							   					      
							   $read_form=1;
							   $printmode=1;
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
		  $mode='';
		  $pn='';
	   }		
	   
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require('../include/inc_css_a_hilitebu.php');
?> 
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}

<?php if($target=='baclabor') 
{
?>
.lab {font-family: arial; font-size: 9; color:#ee6666;}
<?php 
}
else
{
?>
.lab {font-family: arial; font-size: 9; color:purple;}
<?php
}
?>

.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 
function printOut()
{
	urlholder="labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $target ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
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
// -->
</script>
 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?>>
 

<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo $LDTestRequest ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').' style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<br><ul>
<p>


<table border=0>
  <tr valign="top">
    <td><img <?php echo createMascot('../','mascot1_r.gif','0','absmiddle') ?>></td>
    <td><FONT    SIZE=4  FACE="verdana,Arial" color="#990000">
	<?php 
	    if($status=="draft") echo $LDFormSaved[$saved]; else echo $LDRequestSent[$saved]; 
		echo $LDWhatToDo;
	?><p>
<FONT    SIZE=2  FACE="verdana,Arial" color="#990000">
           <a href="javascript:printOut()"><img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDPrintForm ?></a><br>
           <a href="pflege-station-patientdaten-doconsil-<?php echo $target ?>.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&pn=<?php echo $pn ?>&edit=<?php echo $edit ?>&station=<?php echo $station ?>&target=<?php echo $target ?>&user_origin=<?php echo $user_origin ?>&noresize=<?php echo $noresize ?>&mode=edit&batch_nr=<?php echo $batch_nr ?>"><img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDEditForm ?></a><br>
	       <a href="pflege-station-patientdaten-doconsil-<?php echo $target ?>.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&pn=<?php echo $pn ?>&edit=<?php echo $edit ?>&station=<?php echo $station ?>&target=<?php echo $target ?>&user_origin=<?php echo $user_origin ?>&noresize=<?php echo $noresize ?>&mode="><img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDNewFormSamePatient ?></a><br>
           <?php
		   if($user_origin=='lab')
		   {
		   ?>
		   <a href="pflege-station-patientdaten-doconsil-<?php echo $target ?>.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&edit=0&station=<?php echo $station ?>&target=<?php echo $target ?>&user_origin=<?php echo $user_origin ?>&noresize=<?php echo $noresize ?>"><img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDNewFormOtherPatient ?></a><br>
           <?php
		   }
		   ?>
           <a href="<?php echo $breakfile ?>"><img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDEndTestRequest ?></a><p>
        </td>
  </tr>
</table>



<?php
/* The main background color of the form */
switch($target)
{ 
  case 'generic':         $bgc1='#bbdbc4'; break;
  case 'patho':         $bgc1='#cde1ec'; break;
  case 'radio':          $bgc1='#ffffff'; break;
  case 'blood':          $bgc1='#99ffcc'; break;
  case 'baclabor':          $bgc1='#fff3f3'; break;
  case 'chemlabor':   $bgc1='#fff3f3';
                               if(file_exists('../language/'.$lang.'/lang_'.$lang.'_konsil_chemlabor.php'))
							   {
							      include_once('../language/'.$lang.'/lang_'.$lang.'_konsil_chemlabor.php');
							    }
								else
								{ 
								   include_once('../language/en/lang_en_konsil_chemlabor.php');
								}
                               break;
  default:  $bgc1='#ffffff'; break; 
}

$abtname=get_meta_tags("../global_conf/$lang/konsil_tag_dept.pid");
$formtitle=$abtname[$target];


require_once('../include/inc_test_request_printout_fx.php');

if(file_exists('../language/'.$lang.'/lang_'.$lang.'_konsil.php'))
{  
   include_once('../language/'.$lang.'/lang_'.$lang.'_konsil.php');
}
else
{  
   include_once('../language/en/lang_en_konsil.php');
}
/* Load the form for printing out */
$edit=0;
if($target=='baclabor') include('../include/inc_test_findings_form_baclabor.php');
 else include('../include/inc_test_request_printout_'.$target.'.php');

?>  
</ul>
</td>
</tr>
</table>        
<p>
<?php
if(file_exists("../language/$lang/".$lang."_copyrite.php")) include("../language/$lang/".$lang."_copyrite.php");
 else include("../language/en/en_copyrite.php");
?>

</BODY>
</HTML>
