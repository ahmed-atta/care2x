<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
if (!isset($logout)||!$logout) {header('Location:'.$root_path.'/language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 

# Reset all login cookies 

//setcookie('ck_login_pw'.$sid,'',0,'/');
//setcookie('ck_login_userid'.$sid,'',0,'/');
//setcookie('ck_login_username'.$sid,'',0,'/');
setcookie('ck_login_logged'.$sid,'',0,'/');
setcookie('ck_login_reset'.$sid,false,0,'/');
					
# Empty login values
$HTTP_SESSION_VARS['sess_login_userid']='';		
$HTTP_SESSION_VARS['sess_login_username']='';		
$HTTP_SESSION_VARS['sess_login_pw']='';		

?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE></TITLE>
<script language="javascript">

function pruf(d)
{
	if((d.userid.value=='')&&(d.keyword.value=='')) return false;
}
</script>

</head>


<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="window.parent.STARTPAGE.location.href='indexframe.php?sid=<?php echo "$sid&lang=$lang" ?>'">
<center>
<FONT  FACE="Arial" SIZE=+4 ><b><?php echo $LDLoggedOut ?></b></FONT>
<p>
<br><FONT  FACE="Arial" SIZE=5 color=navy>
<?php echo $nm.'<br>'; ?>

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
<input type=hidden name=direction value=<?php echo $direction; ?>>
<br>
<input type="hidden" name="pass" value="check">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<p>
<INPUT type="image"  <?php echo createLDImgSrc($root_path,'continue.gif') ?>></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:top.location.reload()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancel ?>"></a>

</FORM>

</td>
</tr>
</table>
</center>

</BODY>
</HTML>
