<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
require("../language/".$lang."/lang_".$lang."_help.php");
		
//if(($sid==NULL)||($sid!=$ck_sid)) { header("location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=closeparent"); exit;}

//require("../language/".$lang."/lang_".$lang."_helppages.php");
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

</head>
<body onLoad="if (window.focus) window.focus()">

<?  if($helpidx=="") : ?>

	<?  include("../help/".$lang."/help_".$lang."_main.htm"); ?>

<? else : ?>
	<? 
		if(file_exists("../help/".$lang."/help_".$lang."_".$helpidx)) include("../help/".$lang."/help_".$lang."_".$helpidx);else include("../help/".$lang."/help_".$lang."_main.htm");
	?>
<? endif ?>
<hr>
<a href="javascript:window.parent.close()"><img src="../img/<?="$lang/$lang"; ?>_closehelp.gif" height=24 border=0 alt="<?=$LDCloseHelpWin ?>"></a>
</body>
</html>
