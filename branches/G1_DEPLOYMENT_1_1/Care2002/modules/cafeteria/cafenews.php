<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

/* Set initial session environment for this module */
$dept_nr=2;// 2= cafeteria dept
$title=$LDCafeNews;

if(!session_is_registered('sess_file_editor')) session_register('sess_file_editor');
if(!session_is_registered('sess_file_reader')) session_register('sess_file_reader');

$HTTP_SESSION_VARS['sess_file_break']=basename(__FILE__);
$HTTP_SESSION_VARS['sess_file_return']=basename(__FILE__);
$HTTP_SESSION_VARS['sess_file_editor']='cafenews-edit-select.php';
$HTTP_SESSION_VARS['sess_file_reader']='cafenews-read.php';
$HTTP_SESSION_VARS['sess_dept_nr']=$dept_nr; 
$HTTP_SESSION_VARS['sess_title']=$title;

require_once($root_path.'include/inc_cafe_get_menu.php');

$readerpath='cafenews-read.php'.URL_APPEND;

/* Get the maximum number of headlines to be displayed */
$config_type='news_headline_max_display';
require($root_path.'include/inc_get_global_config.php');

if(!$news_headline_max_display) $news_headline_max_display=3; /* default is 3 */

$news_num_stop=$news_headline_max_display;  // The maximum number of news article to be displayed
//require($root_path.'include/inc_news_get.php'); // now get the current news

require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
$news=&$newsobj->getHeadlinesPreview($dept_nr,$news_num_stop);
 
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

<?php if($cfg['dhtml']) include("../include/inc_css_a_hilitebu.php"); ?>

<style type="text/css" name="s2">
.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style>

</HEAD>
<BODY bgcolor=#ffffff VLINK="#003366" link="#003366">

 <TABLE CELLSPACING=5 cellpadding=0 border="0" width="601">

<tr>
<td colspan=3>
<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img <?php echo createComIcon($root_path,'basket.gif','0') ?>></a> <b><?php echo $title ?></b></FONT>
<hr>
</td>
</tr>
 
  <tr>
    <td WIDTH=480 VALIGN="top">
	<FONT  SIZE=1 COLOR="<?php echo $cfg['body_txtcolor']; ?>" FACE="verdana,Arial">
	
	<table>
<?php
 $editor_path='cafenews-edit-pass.php'.URL_APPEND.'&title='.$LDCafeNews;
 require($root_path.'include/inc_news_display.php');
?>
	</table>
	
	</td>
<TD  VALIGN="top"   bgcolor="<?php echo $cfg['idx_txtcolor']; ?>" width=1>
<img src=<?php echo $root_path; ?>"gui/img/common/default/pixel.gif" border=0 width=1 height=1>
    </TD>
<TD WIDTH=120 VALIGN="top" >
	<FONT  SIZE=2  FACE="arial,verdana">

<table cellspacing=0 cellpadding=1 border=0 align=right width=100%>
<tr bgcolor="#999999" >
<td>
<table  cellspacing=0 cellpadding=2 align=right width=100%>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b><?php echo $LDMenuToday ?></b>
</td>
</tr>
<tr>
<td bgcolor="#ffffcc" class="vn"><nobr><?php echo nl2br($menu['menu']); ?></nobr>
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
		&nbsp;<A HREF="cafenews-menu.php<?php echo URL_APPEND ?>"><?php echo $LDMenuAll ?></A><br>
<img <?php echo createComIcon($root_path,'frage.gif','0') ?> border=0>
<br>
	&nbsp;<A HREF="cafenews-prices.php<?php echo URL_APPEND ?>"><?php echo $LDPrices ?></A>
	<hr>
	<a href="cafenews-edit-pass.php<?php echo URL_APPEND ?>"><?php echo $LDCafeEditorial ?></a>

</td>
</tr></table>
    </TD>
  </tr>
  <tr>
    <td colspan=3>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
    </td>
  </tr>
</table>
</BODY>
</HTML>
