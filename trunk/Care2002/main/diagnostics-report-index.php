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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once('../include/inc_front_chain_lang.php');
if($edit&&!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require_once('../include/inc_config_color.php'); // load color preferences

$thisfile='diagnostics-report-index.php';
$breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";

$bgc1='#fefefe'; 

$abtname=get_meta_tags("../global_conf/$lang/konsil_tag_dept.pid");

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	
	
       include_once('../include/inc_date_format_functions.php');

		$dbtable='care_nursing_station_patients_diagnostics_report';
		
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ORDER BY  report_date   DESC";
		//$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ORDER BY  item_nr DESC";
		
		if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=mysql_num_rows($ergebnis);
				if($rows) $report=mysql_fetch_array($ergebnis);
				  else $report['script_call']='diagnostics-report-none.php?pn='.$pn; // If no report is available, load the non-availability page
			}
			else{echo "<p>$sql$LDDbNoRead";}

       
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDReports ?></TITLE>
<?php
require('../include/inc_css_a_hilitebu.php');
?>



<script language="javascript">
<!-- Script Begin
function showInitPage() {

   window.parent.DIAGNOSTICS_REPORT_MAIN_<?php echo $sid.'_'.$pn ?>.location.replace('<?php echo $report['script_call'] ?>&sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&show_print_button=1');

}
//  Script End -->
</script>

</HEAD>

<BODY bgcolor="<?php echo $cfg['top_bgcolor']; ?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="showInitPage()" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<font face="verdana,arial" size=2>
<?php 


/* The following routine creates the list of pending diagnostics reports */

if($rows)
{ 

   $ChkUpOptions=get_meta_tags('../global_conf/'.$lang.'/konsil_tag_dept.pid');

   mysql_data_seek($ergebnis,0);  //reset the array to the first element

  while($report=mysql_fetch_array($ergebnis))
  {
  //echo $tracker."<br>";

    if($report['report_date']!=$report_date)
    {
       echo "<FONT size=2 color=\"#990000\"><b>".formatDate2Local($report['report_date'],$date_format)."</b></font><br>";
	   $report_date=$report['report_date'];
    } 

    if($report['status']=='pending')
   {
        echo "&nbsp;<img ".createComIcon('../','r_arrowgrnsm.gif','0','absmiddle')."> ";
   }
   else
   {
        echo "&nbsp;<img src=\"../gui/img/common/default/pixel.gif\" border=0 width=4 height=7> ";
   }  
  
   echo " <a href=\"".$report['script_call']."&sid=".$sid."&lang=".$lang."&user_origin=".$user_origin."&show_print_button=1\" target=\"DIAGNOSTICS_REPORT_MAIN_".$sid."_".$pn."\">".$ChkUpOptions[$report['reporting_dept']]."<br>".$report['report_nr']."</a><hr>";

		
   
    /* Check for the barcode png image, if nonexistent create it in the cache */
    if(!file_exists('../cache/barcodes/pn_'.$report['patnum'].'.png'))
    {
	   echo "<img src='../classes/barcode/image.php?code=".$report['patnum']."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
	}
  } 
}
?>       
</font>
</BODY>
</HTML>
