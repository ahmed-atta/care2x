<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_lab.php");
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?=$LDPhotos ?></title>

</head>
<frameset cols="40%,*">
  <frame name="FOTOS_INDEX" src="fotos-index.php?sid=<?="$ck_sid&lang=$lang&edit=$edit&pn=$pn&station=$station&fileroot=$fileroot" ?>" >
  <frame name="FOTOS_PREVIEW" src="fotos-preview.php?sid=<?="$ck_sid&lang=$lang" ?>">
<noframes>
<body>


</body>
</noframes>
</frameset>
</html>
