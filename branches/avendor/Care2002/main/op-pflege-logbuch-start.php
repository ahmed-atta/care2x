<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if (!$internok&&!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
      <title><?="$LDOr $LDLOGBOOK $dept" ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</HEAD>

<frameset rows="83%,*" border=0>
  <frameset rows="53%,*">
<? if(($mode!="")) : ?>
    <frame name= "OPLOGMAIN"  src="<? //print 'oplogmain.php?gotoid='.$patnum.'&op_nr='.$op_nr.'&dept='.$dept.'&saal='.$saal.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday; ?>" >
    <frame name="LOGINPUT"  src="<? print "oploginput.php?sid=$ck_sid&lang=$lang&internok=$internok&mode=$mode&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>">
  </frameset>
  <frameset cols="15%,*">
    <frame name= "OPLOGINPUT"  SRC = "">
    <frame name="OPLOGIMGBAR" src="">
  </frameset>

<? else : ?>
    <frame name= "OPLOGMAIN"  src="blank.htm" >
    <frame name="LOGINPUT"  src="oploginput.php?sid=<?="$ck_sid&lang=$lang&internok=$internok" ?>">
  </frameset>
  <frameset cols="15%,*">
    <frame name= "OPLOGINPUT"  SRC = "blank.htm">
    <frame name="OPLOGIMGBAR" src="blank.htm">
  </frameset>
 <? endif ?>
<noframes>
<BODY BACKGROUND="#ffffff" onLoad="if (window.focus) window.focus()">


</body>
</noframes>
</frameset>
</HTML>
