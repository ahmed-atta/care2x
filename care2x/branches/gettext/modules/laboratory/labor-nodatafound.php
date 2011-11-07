<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','laboratory');
define('LANG_FILE_MODULAR','laboratory.php');
$local_user='ck_lab_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
if(isset($from)&&$from=='input'){
	$backfile="labor_datainput.php".URL_APPEND."&encounter_nr=$encounter_nr&job_id=$job_id&parameterselect=$parameterselect&allow_update=$allow_update&user_origin=$user_origin";
}else{
	$backfile="labor_data_patient_search.php".URL_APPEND."&search=1";
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>

</HEAD>

<BODY bgcolor="#ffffff">
<P><br>
<table border=0>
  <tr>
    <td><font face=verdana,arial size=5 color=maroon><?php echo "$LDNoLabReport <br>".ucfirst($ln).", ".ucfirst($fn)." ".$bd ?>.<br> (<?php echo "$LDCaseNr $encounter_nr" ?>)
			<p><br><a href="<?php echo $backfile ?>" class="button icon arrowleft">Back</a>
	</td>
  </tr>
</table>



</FONT>


</BODY>
</HTML>
