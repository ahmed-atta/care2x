<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
require("../include/inc_config_color.php"); // load color preferences

/**
* We check again the language variable lang. If table file not available use default (lang = "en")
*/
$ck_lang_buffer="ck_lang$sid";
if(isset($lang)&&$lang)
{
	if(!$HTTP_COOKIE_VARS[$ck_lang_buffer]||($lang!=$HTTP_COOKIE_VARS[$ck_lang_buffer])) 
	{
	    if(!file_exists("../language/lang_".$lang."_indexframe.php")) $lang="en";
	    setcookie($HTTP_COOKIE_VARS[$ck_lang_buffer],$lang);
    }
}
else
{
if(!$HTTP_COOKIE_VARS[$ck_lang_buffer]) include("../chklang.php");
	else $lang=$HTTP_COOKIE_VARS[$ck_lang_buffer];
}
require("../language/".$lang."/lang_".$lang."_indexframe.php");


if(($cfg['mask']==2)&&!$nonewmask)
{
	header ("location: indexframe2.php?sid=$sid&lang=$lang&boot=$boot&cookie=$cookie");
	exit;
}
require("../include/inc_left_menu_url.php"); // loads the url targets of the left menu items
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE>Menu - Care 2002</TITLE>
<?php
//set the css style for a links
require ("../include/inc_css_a_sublinker_d.php");
?>

<script language="javascript">
function changeLanguage(lang)
{
    <?php if(($cfg[mask]==1)||($cfg[mask]==""))  print "window.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 else print "window.opener.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 ?>
	return false;
}
</script>
</HEAD>

<BODY onLoad="if (window.focus) window.focus();
<?php if($boot) print 'window.parent.CONTENTS.location.replace(\'startframe.php?sid='.$sid.'&lang='.$lang.'&egal='.$egal.'&cookie='.$cookie.'\');';
?>
"
<?php
print 'bgcolor='.$cfg['idx_bgcolor'];
 if(!$cfg['dhtml']) print ' link='.$cfg['idx_txtcolor'].' vlink='.$cfg['idx_txtcolor'].' alink='.$cfg['idx_alink']; ?> 
 >
<center><img src="../img/care_logo.gif" ></center>
<TABLE CELLPADDING=2 CELLSPACING=0 border=0 >
<FONT  FACE="Arial"  SIZE="-1">

<?php
for ($i=0;$i<sizeof($targetfile);$i++)
{
	if ($indextag[$i]=="Login &nbsp;")
 	{
		if ($HTTP_COOKIE_VARS["ck_login_logged".$sid]=="true")
		{
		$targetfile[$i]="logout_confirm.php";
		$indextag[$i]="Logout";
		}	
	}
print '<TR><TD bgcolor='.$cfg['idx_bgcolor'].' ALIGN="left">'; print "\n";
print '<A HREF="'.$targetfile[$i].'?sid='.$sid.'&lang='.$lang.'"';
print ' TARGET="CONTENTS" REL="child">';
print "\n";
print '<img src="../img/blue_bullet.gif" border=0 align="middle"><font FACE="verdana,Arial" SIZE=-1 ><nobr><b>'.$indextag[$i].'</b></nobr></FONT></A>';
print "\n";
print '</TD></TR>';
}

?>


<tr>
<td>
<FONT  FACE="Arial"  SIZE="-1">
<form action="../index.php" onSubmit="return changeLanguage(this.lang.value)">
<hr>
<?php echo $LDLanguage ?><br>
<select name="lang";>
	<?php if($lang!="en") : ?>
	<option value="en"> English</option>
	<?php endif ?>
	<?php if($lang!="de") : ?>
	<option value="de"> German</option>
	<?php endif ?>
	<?php if($lang!="it") : ?>
<!-- 	<option value="it"> Italian</option>
 -->	<?php endif ?>
</select>
<input type="submit" value="Go">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mask" value="<?php echo $mask ?>">
<input type="hidden" name="egal" value="1">
<hr>
<!-- <A HREF=<?php if(($cfg[mask]==1)||($cfg[mask]=="")) print '"'.$VersionChgHref.'" target="_top"'; else print '"javascript:window.opener.top.location.replace(\''.$VersionChgHref.'\')"'; ?> ><img src="../img/blue_bullet.gif" border=0 align="middle"><font FACE="verdana,Arial" SIZE=-1 ><nobr><b><?php echo $VersionChgLang ?></b></nobr></FONT></A>
 --></td>
</tr>
<tr >
<td>
<font FACE="Arial" SIZE=1 color="#6f6f6f"><nobr><b>Log Info</b></nobr><br>
<?php echo $HTTP_COOKIE_VARS["ck_login_username".$sid] ?><br>
<?php echo $HTTP_COOKIE_VARS[ck_thispc_dept] ?><br></FONT>
</td>
</tr>
</form>
</FONT>
</TABLE>

</BODY>
</HTML>
