<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
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
    <td><img <?php echo createMascot('../','mascot1_r.gif','0') ?>></td>
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
<?php 
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
<a href="<?php if($mode=="preview4saved") echo "startframe.php?sid=".$sid."&lang=".$lang; else echo "javascript:window.history.back()"; ?>"><img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> <font face="arial" color="#006600"><?php echo $LDBackTxt ?></a>

</TD>
	
<td valign=top width="1" bgcolor="<?php echo $cfg['idx_txtcolor']; ?>" ><img src="../gui/img/common/default/pixel.gif" width="1" height="1" border=0>
</td>

<TD WIDTH=20% VALIGN="top" >
<?php 
	require("../include/inc_rightcolumn_menu.php"); 
?>
</TD>
</TR>

<tr>
<td colspan=3>
<hr>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</td>
</tr>
</TABLE>
</BODY>
</HTML>
