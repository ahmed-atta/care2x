<?
require("../language/".$lang."/lang_".$lang."_or.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>
 <? print "$ln, $fn $bd - $pn";
	if($opnr) print" - OP# $opnr"; 
	$targetbuf="$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=$newsave";
?>	

</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


</HEAD>

<frameset rows="25%,*">
  <frame name="INTERN" src="drg-ops-intern.php?sid=<?=$targetbuf ?>" frameborder="yes">
  
 <frameset rows="52%,*">
  
    <frame name="ICD" src="drg-icd10.php?sid=<?=$targetbuf ?>" frameborder="yes">
	
    <frame name="OPS" src="drg-ops301.php?sid=<?=$targetbuf ?>" frameborder="yes">
	
  </frameset> 
  
<noframes>
<BODY BACKGROUND="#ffffff" onLoad="if (window.focus) window.focus();">

</body>
</noframes>
</frameset>


</HTML>
