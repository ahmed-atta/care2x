<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_cafe_get_menu.php');

$returnfile=$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND;
$breakfile=$HTTP_SESSION_VARS['sess_file_break'].URL_APPEND;

$dept_nr=2; /* 2= cafeteria */

if(!isset($mode)) $mode='';

/* Get the news article */
require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
$news=&$newsobj->getNews($nr);

?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?><TITLE></TITLE>

<script language="javascript" >
function editcafe()
{
		if(confirm("<?php echo $LDConfirmEdit ?>"))
		{
			window.location.href="cafenews-edit-pass.php?sid=<?php echo "$sid&lang=$lang&title=$LDCafeNews" ?>";
			return false;
		}
}
		
</script>

<style type="text/css" name="s2">
.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style>

</HEAD>
<BODY bgcolor=#ffffff VLINK="#003366" link="#003366">

<?php if($mode=='preview4saved') : ?>
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

<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img <?php echo createComIcon($root_path,'basket.gif','0') ?>></a> <b><?php echo $LDCafeNews ?></b></FONT>

<TABLE CELLSPACING=10 cellpadding=0 border="0" width="590">
<tr>
<td colspan=3>
<hr>
</td>
</tr>



<TR >
<TD WIDTH=80% VALIGN="top" >

<?php
require($root_path.'include/inc_news_display_one.php');
?>

<p>
<a href="<?php echo ($mode=='preview4saved') ? $returnfile : $breakfile;  ?>"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>> <font face="arial" color="#006600"><?php echo $LDBackTxt ?></a>

</TD>
	
<td valign=top width="1" bgcolor="maroon"><img src="../../gui/img/common/default/pixel.gif" width="1" height="1">
</td>


<TD WIDTH=20% VALIGN="top"  rowspan=2>

	<table cellspacing=0 cellpadding=1 border=0 align=right>
<tr bgcolor="#999999" >
<td>
<table  cellspacing=0 cellpadding=2 align=right>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b><?php echo $LDMenuToday ?></b>
</td>
</tr>
<tr>
<td bgcolor="#ffffcc" class="vn"><nobr><?php echo nl2br($menu[menu]); ?></nobr>
</td> 
</tr>

</table>

</td>
</tr>
<tr >
<td><p><br>
<img <?php echo createComIcon($root_path,'frage.gif','0') ?> border=0>
<br>
<FONT  SIZE=-1 FACE="Arial" >
		&nbsp;<A HREF="cafenews-menu.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDMenuAll ?></A><br>
<img <?php echo createComIcon($root_path,'frage.gif','0') ?> border=0>
<br>
	&nbsp;<A HREF="cafenews-prices.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDPrices ?></A>
</td>
</tr></table>

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
