<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","drg.php");
$local_user="ck_op_pflegelogbuch_user";
require("../include/inc_front_chain_lang.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>
 <?php print "$ln, $fn $bd - $pn";
	if($opnr) print" - OP# $opnr"; 
	$targetbuf="$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=$newsave";
?>	

</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


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
