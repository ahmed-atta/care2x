<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
//require_once('../include/inc_vars_resolve.php'); // globalize POST, GET, & COOKIE  vars
define('LANG_FILE','indexframe.php');
define(NO_CHAIN,1);

require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences

/**
* We check again the language variable lang. If table file not available use default (lang = "en")
*/
$ck_lang_buffer="ck_lang$sid";

if(isset($lang)&&$lang)
{
	if(!$HTTP_COOKIE_VARS[$ck_lang_buffer]||($lang!=$HTTP_COOKIE_VARS[$ck_lang_buffer])) 
	{
	    if(!file_exists('../language/'.$lang.'/lang_'.$lang.'_indexframe.php')) $lang='en';
	    setcookie($ck_lang_buffer);
	    setcookie($ck_lang_buffer,$lang);
		$reload_page=1;
    }
}
else
{
if(!$HTTP_COOKIE_VARS[$ck_lang_buffer]) include('../chklang.php');
	else $lang=$HTTP_COOKIE_VARS[$ck_lang_buffer];
}

/* Load the language table */
if(file_exists('../language/'.$lang.'/lang_'.$lang.'_indexframe.php')) include('../language/'.$lang.'/lang_'.$lang.'_indexframe.php');
else include('../language/'.$lang.'/lang_'.$lang.'_indexframe.php');


if(($cfg['mask']==2)&&!$nonewmask)
{
	header ("location: indexframe2.php?sid=$sid&lang=$lang&boot=$boot&cookie=$cookie");
	exit;
}
require('../include/inc_left_menu_url.php'); // loads the url targets of the left menu items
?>
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE>Menu - Care 2002</TITLE>
<?php
//set the css style for a links
require ('../include/inc_css_a_sublinker_d.php');
?>

<script language="javascript">
function changeLanguage(lang)
{
    <?php if(($cfg[mask]==1)||($cfg[mask]==""))  echo "window.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 else echo "window.opener.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 ?>
	return false;
}
</script>
</HEAD>

<BODY onLoad="if (window.focus) window.focus();
<?php if($boot) echo 'window.parent.CONTENTS.location.replace(\'startframe.php?sid='.$sid.'&lang='.$lang.'&egal='.$egal.'&cookie='.$cookie.'\');';
?>
"
<?php
echo 'bgcolor='.$cfg['idx_bgcolor'];
 if(!$cfg['dhtml']) echo ' link='.$cfg['idx_txtcolor'].' vlink='.$cfg['idx_txtcolor'].' alink='.$cfg['idx_alink']; ?> 
 >
<center><img <?php echo createComIcon('../','care_logo.gif','0') ?>></center>
<TABLE CELLPADDING=2 CELLSPACING=0 border=0 >
<FONT  FACE="Arial"  SIZE="-1">

<?php
for ($i=0;$i<sizeof($targetfile);$i++)
{
	if (eregi('Login',$indextag[$i]))
 	{
		if ($HTTP_COOKIE_VARS['ck_login_logged'.$sid]=='true')
		{
		$targetfile[$i]='logout_confirm.php';
		$indextag[$i]='Logout';
		}	
	}
echo '<TR><TD bgcolor='.$cfg['idx_bgcolor'].' ALIGN="left">'; echo "\n";
echo '<A HREF="'.$targetfile[$i].'?sid='.$sid.'&lang='.$lang.'"';
echo ' TARGET="CONTENTS" REL="child">';
echo "\n";
echo '<nobr><img '.createComIcon('../','blue_bullet.gif','0','middle').'><font FACE="verdana,Arial" SIZE=-1 ><b>'.$indextag[$i].'</b></nobr></FONT></A>';
echo "\n";
echo '</TD></TR>';
}

?>


<tr>
<td>
<FONT  FACE="Arial"  SIZE="-1">
<form action="#" onSubmit="return changeLanguage(this.lang.value)">
<hr>
<?php echo $LDLanguage ?><br>
<select name="lang";>
	<?php if($lang!='pt-br') : ?>
	<option value="pt-br"> Brazilian</option>
    <?php endif ?>
	<?php if($lang!='en') : ?>
	<option value="en"> English</option>
	<?php endif ?>
	<?php if($lang!='fr') : ?>
	<option value="fr"> French</option>
	<?php endif ?>
	<?php if($lang!='de') : ?>
	<option value="de"> German</option>
	<?php endif ?>
	<?php if($lang!='it') : ?>
 	<option value="it"> Italian</option>
    <?php endif ?>
	<?php if($lang!='id') : ?>
	<option value="id"> Indonesian</option>
    <?php endif ?>
	<?php if($lang!='pl') : ?>
	<option value="pl"> Polish</option>
    <?php endif ?>
	<?php if($lang!='es') : ?>
	<option value="es"> Spanish</option>
    <?php endif ?>

</select>
<input type="submit" value="<?php echo $LDChange ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mask" value="<?php echo $mask ?>">
<input type="hidden" name="egal" value="1">
<hr>
<!-- <A HREF=<?php if(($cfg[mask]==1)||($cfg[mask]=="")) echo '"'.$VersionChgHref.'" target="_top"'; else echo '"javascript:window.opener.top.location.replace(\''.$VersionChgHref.'\')"'; ?> ><img src="../img/blue_bullet.gif" border=0 align="middle"><font FACE="verdana,Arial" SIZE=-1 ><nobr><b><?php echo $VersionChgLang ?></b></nobr></FONT></A>
 --></td>
</tr>
<tr >
<td>
<font FACE="Arial" SIZE=1 color="#6f6f6f"><nobr><b>Log Info</b></nobr><br>
<?php echo $HTTP_COOKIE_VARS['ck_login_username'.$sid] ?><br>
<?php echo $HTTP_COOKIE_VARS[ck_thispc_dept] ?><br></FONT>
</td>
</tr>
</form>
</FONT>
</TABLE>

</BODY>
</HTML>
