<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
if (!$logout) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

// reset all login cookies 

setcookie("ck_login_pw".$sid,"");
setcookie("ck_login_userid".$sid,"");
setcookie("ck_login_username".$sid,"");
setcookie("ck_login_logged".$sid,"");
setcookie("ck_login_reset".$sid,"false");

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


<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="window.parent.STARTPAGE.location.href='indexframe.php?sid=<?php echo "$sid&lang=$lang" ?>'">
<center>
<FONT  FACE="Arial" SIZE=+4 ><b><?php echo $LDLogout ?></b></FONT>
<p>
<br><FONT  FACE="Arial" SIZE=5 color=navy>
<?php print $nm.'<br>'; ?>

<form name="okbut" action="startframe.php">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value=" <?php echo $LDOK ?> " >
</form>
<hr>
<font size=4><?php echo $LDNewLogin ?>:</font>
<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffaa">
<p><br>
<FORM action="login.php" method="post" name="passwindow" onSubmit="return pruf(this)">
<font face="Arial,Verdana"  color="navy" size=-1>
<b><?php echo $LDUserPrompt ?>:</b><br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="navy" size=-1><b><?php echo $LDPwPrompt ?>:</b></font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type=hidden name=direction value=<?php print $direction; ?>>
<br>
<input type="hidden" name="pass" value="check">
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="hidden" name="lang" value="<?php print $lang; ?>">
<p>

<a href="javascript:top.location.reload()"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border="0" alt="<?php echo $LDCancel ?>"></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<INPUT type="image"  src="../img/<?php echo "$lang/$lang" ?>_continue.gif" border=0 ></font>

</FORM>

</td>
</tr>
</table>
</center>

</BODY>
</HTML>
