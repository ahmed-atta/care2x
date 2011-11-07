<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','myintranet');
define('LANG_FILE_MODULAR','myintranet.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile=$root_path.'main/plugin.php'.URL_APPEND;
$thisfile=basename(__FILE__);

if($n==$n2)
{
	$screenall=1;
	$fileforward="my-passw-change-update.php?sid=$sid&lang=$lang&userid=$userid&n=$n";
	if ($pass=='check') 	
		include($root_path.'include/helpers/inc_passcheck.php');
}
else $n_error=1;

if(!isset($userid)) $userid=$_SESSION['sess_user_name'];

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDPWChange);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
# href for return button
 $smarty->assign('pbBack',$breakfile);

 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/pw_change.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDPWChange);

 # Body Onload js
 if($mode!="pwchg") $smarty->assign('sOnLoadJs','onLoad="document.pwchanger.userid.focus()"');

# Collect javascript code

ob_start();
?>
<script language=javascript>
function pruf(d)
{
	return true;
	if((d.userid.value=="")||(d.keyword.value=="")||(d.n.value=="")||(d.n2.value=="")) return false;
	if(d.n.value!=d.n2.value){ alert("<?php echo $LDAlertPwError ?>"); return false;}
	return true;
}

</script>
 
<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>
<P>

<?php if($n_error) : ?><font class="warnprompt">
<?php echo $LDNewPwDiffer ?>
</font>
<?php endif; ?>
<ul>

<?php if($mode=='pwchg') : ?>
<font face="verdana,arial" size=3 color="#009900">
<b><?php echo $LDPWChanged ?></b></font>
<?php else : ?>
<?php if (($pass=='check')&&$passtag) 
{
echo '<FONT  class="warnprompt">';

$errbuf=$title;

switch($passtag)
{
	case 1:$errbuf="$errbuf $LDWrongEntry";
				print ''." $LDWrongEntry <font size=2 color=\"#000000\">$LDPlsTryAgain</font>";
				//echo '<img '.createLDImgSrc($root_path,'cat-fe.gif','0','left').'>';
				break;
	case 2:$errbuf="$errbuf $LDNoAuth";
				print ''."$LDNoAuth  <font size=2 color=\"#000000\">$LDPlsContactEDP</font>";
				//echo '<img '.createLDImgSrc($root_path,'cat-noacc.gif','0','left').'>';
				break;
	default:$errbuf="$errbuf $LDAuthLocked";
				print ''."$LDAuthLocked  <font size=2 color=\"#000000\">$LDPlsContactEDP</font>";
				//echo '<img '.createLDImgSrc($root_path,'cat-sperr.gif','0','left').'>';
}


//logentry($userid,$keyword,$errbuf,$thisfile,$fileforward);

echo '</FONT><p>';

}
?>
<br>
<form method=post action=<?php echo $thisfile; ?> onSubmit="return pruf(this)" name="pwchanger">
<table  border=0 cellpadding="0" cellspacing=1 bgcolor=#666666>
<tr>
<td >

<table border="0" cellpadding="20" cellspacing="0" bgcolor=#ffffdd>
<tr>
<td><font color=#800000>
<p>
<b><?php echo $LDUserIdPWPrompt ?></b><p></font>
<font color=#000080><?php echo $LDUserId ?>:<br>
<input type="text" name="userid" size=25 maxlength=40 value="<?php echo $userid ?>"><br>
<?php echo $LDPassword ?>:<br>
<input type="password" name="keyword" size=25 maxlength=40><p>
<font color=#800000>
<b></b></font>
<p><?php echo $LDNewPwPrompt ?><br>
<input type="password" name="n" size=25 maxlength=40 value=""><br>
<?php echo $LDNewPw2 ?>:<br>
<input type="password" name="n2" size=25 maxlength=40 value="">
                            </td>
</tr>

<tr><td>
		<input type="hidden" name="sid" value="<?php echo $sid; ?>">
		<input type="hidden" name="lang" value="<?php echo $lang; ?>">
		<input type="hidden" name="mode" value="change">
 		<input type="hidden" name="pass" value="check">
 		<input type="submit" value="<?php echo $LDChangePw ?>"><p>
		<input type="reset" value="<?php echo $LDOops ?>"></td>
</tr>
</table>
</td>
</tr>
</table>
</form>
<?php endif; ?>   

<p>

<a href="<?php echo $breakfile; ?>" class="button icon remove danger"><?php if($mode=='pwchg') echo "Close"; else echo "Cancel"; ?></a>

</ul>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>