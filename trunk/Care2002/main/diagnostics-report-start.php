<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','konsil.php');

/* Globalize the variables */
require_once('../include/inc_vars_resolve.php');

$rel_url="?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&header=$header";

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
  $breakfile='pflege-station-patientdaten.php'.$rel_url;
}

require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences



?>
<html>
<head>
<title></title>
</head>
<frameset rows="35,*" border=0>
  <frame name="DIAGNOSTICS_REPORT_HEAD_<?php echo $sid.'_'.$pn ?>" src="diagnostics-report-head.php<?php echo $rel_url ?>" marginwidth=0 marginheight=0>
  <frameset cols="16%,*" border=0>
    <frame name="DIAGNOSTICS_REPORT_INDEX_<?php echo $sid.'_'.$pn ?>" src="diagnostics-report-index.php<?php echo $rel_url ?>" marginwidth=0 marginheight=0 border=0>
    <frame name="DIAGNOSTICS_REPORT_MAIN_<?php echo $sid.'_'.$pn ?>" src="blank.htm" >
  </frameset>
<noframes>
<body>


</body>
</noframes>
</frameset>
</html>
