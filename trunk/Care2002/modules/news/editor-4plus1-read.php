<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

/* Set the return paths */
$returnfile='editor-4plus1-select-art.php'.URL_APPEND;
$breakfile='newscolumns.php'.URL_APPEND;

/* Set the return file to this file*/
//$HTTP_SESSION_VARS['sess_file_return']=basename(__FILE__);
/* get the title = name of department */
$title=$HTTP_SESSION_VARS['sess_title'];

/* Get the news article */
require($root_path.'include/inc_news_get_one.php');

/* Get the news table width */
$config_type='news_normal_display_width';
include_once($root_path.'include/inc_get_global_config.php');
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
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
 ?> >

 <?php if($mode=="preview4saved") : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0') ?>></td>
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG>&nbsp;<?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if(($cfg['dhtml'])&&($mode!="preview4saved")) echo'<a href="javascript:history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>';?>
<a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<table border=0 cellpadding=10 width="<?php echo (isset($news_normal_display_width) && !empty($news_normal_display_width)) ? $news_normal_display_width : 400; ?>">
  <tr>
    <td valign="top">
<?php 
	   
$palign='left';  // Set the image alignment

include($root_path.'include/inc_news_display_one.php');
?>
<p>
<a href="<?php if($mode=="preview4saved") echo $returnfile; else echo $breakfile; ?>"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>><font face="arial"  SIZE=-1 color="#006600"> <?php echo $LDBackTxt ?></a>
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
require($root_path.'include/inc_load_copyrite.php');
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
