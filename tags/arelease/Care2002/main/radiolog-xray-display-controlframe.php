<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_radio.php");

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</HEAD>

<BODY bgcolor=black onLoad="if (window.focus) window.focus()" leftmargin=2 marginwidth=2>


<FONT    SIZE=3  FACE="Arial" color=white>

Patient:<br>
Mustermann, Silvia<br>
12.05.1988

<p>
<?=$LDShootDate ?>:<br>
22.10.2001<p>
</FONT>
<p>
<form>
<input type="button" value="<?=$LDNewSearch ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?="$ck_sid&lang=$lang" ?>')">
<p>


<? if($mode!="display1") : ?>

<input type="button" value="<?=$LDFullScreen ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=display1')">

<? else : ?>
<input type="button" value="<?=$LDReadDiag ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=display_diagnosis_read')">
<p>
<input type="button" value="<?=$LDWriteDiag ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=display_diagnosis_write')">
<? endif ?>

</form>

<p>






</BODY>
</HTML>
