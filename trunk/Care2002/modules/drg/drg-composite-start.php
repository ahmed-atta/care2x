<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2002 Integrated Information System beta 1.0.05 - 2003-06-22 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','drg.php');

switch($HTTP_SESSION_VARS['sess_user_origin'])
{
	case 'admission': 
	{
		$local_user='aufnahme_user';
		break;
	}
	default: 
	{
		$local_user='ck_op_pflegelogbuch_user';
	}
}

require_once($root_path.'include/inc_front_chain_lang.php');
/* Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>
 <?php echo "$ln, $fn ".formatDate2Local($bd,$date_format)." - $pn";
	if($opnr) echo" - OP# $opnr"; 
	$targetbuf="$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=$newsave";
?>	

</TITLE>
<?php echo setCharSet(); ?>


</HEAD>

<frameset rows="25%,*">
  <frame name="INTERN" src="drg-ops-intern.php?sid=<?php echo $targetbuf ?>" frameborder="yes">
  
 <frameset rows="52%,*">
  
    <frame name="ICD" src="drg-icd10.php?sid=<?php echo $targetbuf ?>" frameborder="yes">
	
    <frame name="OPS" src="drg-ops301.php?sid=<?php echo $targetbuf ?>" frameborder="yes">
	
  </frameset> 
  
<noframes>
<BODY BACKGROUND="#ffffff" onLoad="if (window.focus) window.focus();">

</body>
</noframes>
</frameset>


</HTML>
