<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('startframe.php');
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$returnfile='headline-edit-select-art.php'.URL_APPEND;
$breakfile=$root_path.$HTTP_SESSION_VARS['sess_file_break'].URL_APPEND;

//$HTTP_SESSION_VARS['sess_file_return']='start_page.php';

/* Get the news article */
require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
$news=&$newsobj->getNews($nr);
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?><TITLE><?php echo $title ?></TITLE>

<?php if($cfg['dhtml'])
{ echo' <STYLE TYPE="text/css">

	A:link  {text-decoration: none; color: '.$cfg['idx_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$cfg['idx_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	</style>';
}
?>
<script language="">
<!-- Script Begin
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="<?php echo $root_path; ?>help-router.php<?php echo URL_REDIRECT_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//  Script End -->
</script>
</HEAD>
<BODY bgcolor=<?php if ($cfg) 
{	echo $cfg['body_bgcolor']; 
	 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
 }else echo '"#ffffff"';
?>>
<!-- 
<img src="../img/groupcopy2.jpg" width="598" height="70" border="0"> -->

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

<TABLE CELLSPACING=5 cellpadding=0 border="0" width="600">

<TR >
<TD WIDTH=80% VALIGN="top" >
<img <?php echo (isset($news_type)&&($news_type='headline')) ?  createComIcon($root_path,'headline4.png','0') :  createComIcon($root_path,'news.png','0')?>>
<?php 

require($root_path.'include/inc_news_display_one.php');

?>
<p>
<a href="<?php echo ($mode=='preview4saved') ? $returnfile : $breakfile; ?>"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>> <font face="arial" color="#006600"><?php echo $LDBackTxt ?></a>

</TD>
	
<td valign=top width="1" bgcolor="<?php echo $cfg['idx_txtcolor']; ?>" ><img src="../../gui/img/common/default/pixel.gif" width="1" height="1" border=0>
</td>

<TD WIDTH=20% VALIGN="top" >
<?php 
	require($root_path.'include/inc_rightcolumn_menu.php'); 
?>
</TD>
</TR>

<tr>
<td colspan=3>
<hr>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</TABLE>
</BODY>
</HTML>
