<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE></TITLE>
<script language="javascript">

</script>

</head>


<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080">
<center>
<FONT  FACE="Arial" SIZE=+4 ><b><?=$LDLogoutConfirm ?></b></FONT>
<p>
<br><FONT  FACE="Arial" SIZE=5 color=navy>
<? print $nm.'<br>'; ?>

<form name="okbut" action="logout.php">
<input type="hidden"  name="sid" value="<?=$ck_sid ?>" >
<input type="hidden"  name="lang" value="<?=$lang ?>" >
<input type="hidden"  name="logout" value="1" >
<input type="submit" value=" <?=$LDYes ?> " >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="<?=$LDNotReally ?>" onClick="javascript:window.history.back()">
</form>



</center>

</BODY>
</HTML>
