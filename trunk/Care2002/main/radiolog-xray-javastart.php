<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<? if ($mode=="display1") : ?>
<frameset cols="15%,*">
  <frame name="CONTROLFRAME" src="radiolog-xray-display-controlframe.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=<?=$mode ?>">
  <frame name="DISPLAYFRAME" src="radiolog-xray-display-film.php?sid=<?="$ck_sid&lang=$lang" ?>">
</frameset>

<? elseif(($mode=="display_diagnosis_read")||($mode=="display_diagnosis_write")): ?>
<frameset cols="15%,*">
  <frame name="CONTROLFRAME" src="radiolog-xray-display-controlframe.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=<?=$mode ?>">
  <frameset rows="63%,*">
    <frame name="DISPLAYFRAME" src="radiolog-xray-display-film.php?sid=<?="$ck_sid&lang=$lang" ?>">
    <frame name="DIAGNOSISFRAME" src="<? if($mode=="display_diagnosis_read") print "radiolog-xray-diagnosis.php";
																	else print "radiolog-xray-diagnosis-write-pass.php"; ?>?sid=<?="$ck_sid&lang=$lang" ?>">
  </frameset>
<? else : ?>
<frameset rows="71%,*">
  <frameset rows="27%,*">
    <frame name="SRCFRAME" src="radiolog-xray-pat-search.php?sid=<?="$ck_sid&lang=$lang" ?>">
    <frame name="FILELISTFRAME" src="blank.htm">
  </frameset>
  <frameset cols="50%,*">
    <frame name="PREVIEWFRAME" src="blank.htm">
    <frame name="DIAGNOSISFRAME" src="blank.htm">
  </frameset>
 <? endif ?> 
  
<noframes>
<body>


</body>
</noframes>

</html>
