<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","radio.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php if ($mode=="display1") : ?>
<frameset cols="15%,*">
  <frame name="CONTROLFRAME" src="radiolog-xray-display-controlframe.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=<?php echo $mode ?>">
  <frame name="DISPLAYFRAME" src="radiolog-xray-display-film.php?sid=<?php echo "$sid&lang=$lang" ?>">
</frameset>

<?php elseif(($mode=="display_diagnosis_read")||($mode=="display_diagnosis_write")): ?>
<frameset cols="15%,*">
  <frame name="CONTROLFRAME" src="radiolog-xray-display-controlframe.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=<?php echo $mode ?>">
  <frameset rows="63%,*">
    <frame name="DISPLAYFRAME" src="radiolog-xray-display-film.php?sid=<?php echo "$sid&lang=$lang" ?>">
    <frame name="DIAGNOSISFRAME" src="<?php if($mode=="display_diagnosis_read") print "radiolog-xray-diagnosis.php";
																	else print "radiolog-xray-diagnosis-write-pass.php"; ?>?sid=<?php echo "$sid&lang=$lang" ?>">
  </frameset>
<?php else : ?>
<frameset rows="71%,*">
  <frameset rows="27%,*">
    <frame name="SRCFRAME" src="radiolog-xray-pat-search.php?sid=<?php echo "$sid&lang=$lang" ?>">
    <frame name="FILELISTFRAME" src="blank.htm">
  </frameset>
  <frameset cols="50%,*">
    <frame name="PREVIEWFRAME" src="blank.htm">
    <frame name="DIAGNOSISFRAME" src="blank.htm">
  </frameset>
 <?php endif ?> 
  
<noframes>
<body>


</body>
</noframes>

</html>
