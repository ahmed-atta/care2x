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
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

/* Check whether the content is language dependent */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $newspath='../news_service/'.$lang.'/';
}
else 
{
    $newspath='../news_service/all_language/';
}

/* Set the return paths */
switch($target)
{
	case "headline":$breakfile="startframe.php?sid=".$sid."&lang=".$lang;
							//$title="Schalgzeilen";
							break;
	case "cafenews":$breakfile="cafenews.php?sid=".$sid."&lang=".$lang;
							//$title="Schalgzeilen";
							break;

	default:	$breakfile="newscolumns.php?sid=$sid&target=$target&lang=$lang&user_origin=$user_origin&title=$title";
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $title ?></TITLE>

<script language="javascript">
<!-- 
var urlholder;

function gethelp(x)
{
	if (!x) x="";
	urlholder="help-router.php?helpidx="+x+"&lang=<?php echo $lang ?>";
	helpwin=window.open(urlholder,"helpwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?php
require('../include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
 ?> >

 <?php if($mode=="preview4saved") : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0') ?>></td>
    <td colspan=2>
	<FONT FACE="verdana,Arial"><FONT  SIZE=3 COLOR="#000066" FACE="verdana,Arial"><?php echo $LDArticleSaved ?></font>
<hr>
</td>
  </tr>
</table>
<?php endif ?>
 
<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp;<?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if(($cfg['dhtml'])&&($mode!="preview4saved")) echo'<a href="javascript:history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>';?>
<a href="javascript:gethelp()"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="startframe.php?sid=<?php echo "$sid&lang=$lang";?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<table border=0 cellpadding=10 width="400">
  <tr>
    <td valign="top">
<?php 
	   
	$palign='left';  // Set the image alignment

	$picpath=$newspath.'/fotos/'.$picfile;

	if(file_exists($picpath)&&file_exists($newspath.'/news/'.$file))
		{
			$picsize=GetImageSize($picpath);
		 	echo '
			<img src="'.$picpath.'" border=0 align="'.$palign.'" ';
			if(!$picsize||($picsize[0]>150)) echo 'width="150">';
				else echo $picsize[3].'>';
		}
	if(file_exists($newspath.'/news/'.$file)) include($newspath.'/news/'.$file); 
?>
<p>
<a href="<?php if($mode=="preview4saved") echo $breakfile; else echo "javascript:window.history.back()"; ?>"><img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>><font face="arial"  SIZE=-1 color="#006600"> <?php echo $LDBackTxt ?></a>
</FONT>
<p></td>
  </tr>
 
</table>
<hr>
</td>
</tr>

<tr valign=top>
<td bgcolor="<?php echo $cfg['bot_bgcolor']; ?>" colspan=2> 
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
