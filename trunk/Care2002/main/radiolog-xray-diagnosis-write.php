<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_radio.php");

$thisfile="radiolog-xray-diagnosis-write.php";
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<body>
<form>
<!-- <font face="Verdana" size=3 color=#800000><b>Befund erstellen</b></font> -->
<input type="submit" value="<?=$LDSave ?>">
<input type="reset" value="<?=$LDResetEntry ?>">
<input type="button" value="<?=$LDCancel ?>" onClick="javascript:window.top.location.replace('radiolog-xray-javastart.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=display1')"><br>
<textarea name="diagnosis" cols=70 rows=20 wrap="physical">
<? 
//$diagnosis=file("http://192.168.0.2/radiology/diagnosis/Thorax.txt"); 
//while(list($x,$v)=each($diagnosis)) print $v;
require("../global_conf/remoteservers_conf.php");

if($disc_pix_mode) readfile($xray_diagnosis_localpath."Thorax.txt");
 else readfile($xray_diagnosis_server_http."Thorax.txt");
?>
</textarea><br>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="submit" value="<?=$LDSave ?>">
<input type="reset" value="<?=$LDResetEntry ?>">
<input type="button" value="<?=$LDCancel ?>" onClick="javascript:window.top.location.replace('radiolog-xray-javastart.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=display1')">
   
</form>

</body>
</html>
