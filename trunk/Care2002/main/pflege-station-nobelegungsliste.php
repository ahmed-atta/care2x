<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_pflege_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

</head><center>
<body>
<p>
&nbsp;
<p>
&nbsp;
<p>
<a href="pflege-station.php?<?print "sid=$ck_sid&lang=$lang&edit=$edit&list=1&station=$station&mode=fresh"; ?>">
<img src="<? print "../imgcreator/nobellist.php?sid=$ck_sid&lang=$lang&station=$station&c=$c"; ?>" border=0  alt="<?=$LDClkHere ?>">
<p>
<?=$LDClkHere ?>...</a>
</center>
</body>
</html>
