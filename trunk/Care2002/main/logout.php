<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$logout) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

// reset all login cookies 
$id=$ck_login_userid;
$nm=$ck_login_username;

setcookie(ck_login_userid,"");
setcookie(ck_login_username,"");
setcookie(ck_login_logged,"");
setcookie(ck_login_reset,"false");

?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE></TITLE>
<script language="javascript">

function pruf(d)
{
	if((d.userid.value=="")&&(d.keyword.value=="")) return false;
}
</script>

</head>


<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="window.parent.STARTPAGE.location.href='indexframe.php?sid=<?="$ck_sid&lang=$lang" ?>'">
<center>
<FONT  FACE="Arial" SIZE=+4 ><b><?=$LDLogout ?></b></FONT>
<p>
<br><FONT  FACE="Arial" SIZE=5 color=navy>
<? print $nm.'<br>'; ?>

<form name="okbut" action="startframe.php">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="submit" value=" <?=$LDOK ?> " >
</form>
<hr>
<font size=4><?=$LDNewLogin ?>:</font>
<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffaa">
<p><br>
<FORM action="login.php" method="post" name="passwindow" onSubmit="return pruf(this)">
<font face="Arial,Verdana"  color="navy" size=-1>
<b><?=$LDUserPrompt ?>:</b><br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="navy" size=-1><b><?=$LDPwPrompt ?>:</b></font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type=hidden name=direction value=<? print $direction; ?>>
<br>
<input type="hidden" name="pass" value="check">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<p>

<a href="javascript:top.location.reload()"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0" alt="<?=$LDCancel ?>"></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<INPUT type="image"  src="../img/<?="$lang/$lang" ?>_continue.gif" border=0 ></font>

</FORM>

</td>
</tr>
</table>
</center>

</BODY>
</HTML>
