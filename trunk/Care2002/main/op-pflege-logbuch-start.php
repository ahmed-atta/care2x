<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","or.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

if (!$internok&&!$HTTP_COOKIE_VARS["ck_op_pflegelogbuch_user".$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
      <title><?php echo "$dept $LDOr $LDLOGBOOK" ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</HEAD>

<frameset rows="83%,*" border=0>
  <frameset rows="53%,*">
<?php if(($mode!="")) : ?>
    <frame name= "OPLOGMAIN"  src="<?php //print 'oplogmain.php?gotoid='.$patnum.'&op_nr='.$op_nr.'&dept='.$dept.'&saal='.$saal.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday; ?>" >
    <frame name="LOGINPUT"  src="<?php print "oploginput.php?sid=$sid&lang=$lang&internok=$internok&mode=$mode&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>">
  </frameset>
  <frameset cols="15%,*">
    <frame name= "OPLOGINPUT"  SRC = "">
    <frame name="OPLOGIMGBAR" src="">
  </frameset>

<?php else : ?>
    <frame name= "OPLOGMAIN"  src="blank.htm" >
    <frame name="LOGINPUT"  src="oploginput.php?sid=<?php echo "$sid&lang=$lang&internok=$internok" ?>">
  </frameset>
  <frameset cols="15%,*">
    <frame name= "OPLOGINPUT"  SRC = "blank.htm">
    <frame name="OPLOGIMGBAR" src="blank.htm">
  </frameset>
 <?php endif ?>
<noframes>
<BODY BACKGROUND="#ffffff" onLoad="if (window.focus) window.focus()">


</body>
</noframes>
</frameset>
</HTML>
