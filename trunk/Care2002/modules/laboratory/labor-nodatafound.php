<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');
if(isset($from)&&$from=='input'){
	$backfile="labor_datainput.php".URL_APPEND."&encounter_nr=$encounter_nr&job_id=$job_id&parameterselect=$parameterselect&allow_update=$allow_update&user_origin=$user_origin";
}else{
	$backfile="labor_data_patient_such.php".URL_APPEND."&search=1";
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
</HEAD>

<BODY bgcolor="#ffffff">
<P><br>
<table border=0>
  <tr>
    <td valign="top"><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="left"></td>
    <td><font face=verdana,arial size=5 color=maroon><?php echo "$LDNoLabReport <br>".ucfirst($ln).", ".ucfirst($fn)." ".$bd ?>.<br> (<?php echo "$LDCaseNr $encounter_nr" ?>)
			<p><br><a href="<?php echo $backfile ?>">
			<img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
	</td>
  </tr>
</table>


<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
