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
define('LANG_FILE','startframe.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$cksid='ck_sid'.$sid;
if(!$HTTP_COOKIE_VARS[$cksid] && !$cookie) { header("location:".$root_path."cookies.php?lang=$lang&startframe=1"); exit;}

if(!session_is_registered('sess_news_nr')) session_register('sess_news_nr');

$readerpath='headline-read.php?sid='.$sid.'&lang='.$lang;
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');
require_once($root_path.'include/inc_config_color.php');
		
$dept_nr=1;  /* 1 = press relations */

/* Get the maximum number of headlines to be displayed */
$config_type='news_headline_max_display';
include($root_path.'include/inc_get_global_config.php');

if(!isset($news_headline_max_display)||!$news_headline_max_display) $news_num_stop=3; /* default is 3 */
    else $news_num_stop=$news_headline_max_display;  // The maximum number of news article to be displayed
	
//include($root_path.'include/inc_news_get.php'); // now get the current news
$thisfile=basename(__FILE__);
require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
$news=&$newsobj->getHeadlinesPreview($dept_nr,$news_num_stop);
/* Set initial session environment for this module */

if(!session_is_registered('sess_file_editor')) session_register('sess_file_editor');
if(!session_is_registered('sess_file_reader')) session_register('sess_file_reader');

$HTTP_SESSION_VARS['sess_file_break']=$top_dir.$thisfile;
$HTTP_SESSION_VARS['sess_file_return']=$top_dir.$thisfile;
$HTTP_SESSION_VARS['sess_file_editor']='headline-edit-select-art.php';
$HTTP_SESSION_VARS['sess_file_reader']='headline-read.php';
$HTTP_SESSION_VARS['sess_dept_nr']='1'; // 1= press relations dept
$HTTP_SESSION_VARS['sess_title']=$LDEditTitle.'::'.$LDSubmitNews;
$HTTP_SESSION_VARS['sess_user_origin']='main_start';
$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.$thisfile;

$readerpath='headline-read.php'.URL_APPEND;

?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $LDPageTitle ?></TITLE>

<?php if($cfg['dhtml']) include($root_path.'include/inc_css_a_hilitebu.php'); ?>

<script language="javascript">
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
<?php
 include($root_path.'include/inc_js_gethelp.php'); 
 ?>
 </HEAD>
 <BODY topmargin=4 marginheight=4  bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<!-- <TABLE CELLSPACING=3 cellpadding=0 border="0" width="601"> -->
<TABLE CELLSPACING=3 cellpadding=0 border="0" width="100%">
<!-- These are the header images. Comment it to hide -->
<!--   
	<tr>
    <td colspan=3><nobr>  <img <?php //echo createComIcon($root_path,'banner_middle3.gif','0') ?>><img <?php //echo createComIcon($root_path,'mo_dau.gif','0') ?>>
	</nobr></td>
  </tr>
 -->

  <tr>
<!--     <td WIDTH=450 VALIGN="top">
 -->    
 	<td VALIGN="top">
	<FONT  SIZE=1 COLOR="<?php echo $cfg['body_txtcolor']; ?>" FACE="verdana,Arial">
	<table width=100%>
 <?php
 //require($root_path.'include/inc_news_display.php');
 require('./headline-format.php');
?>
<!-- The current news and news archive block -->
<!--   
	<tr>
    <td>
	 <img <?php echo createComIcon($root_path,'news.png','0') ?>><p>
	 <img <?php echo createComIcon($root_path,'news_archive2.png','0') ?>><br>
  </tr>

  <tr>
    <td>
	<FONT  SIZE=1 FACE="verdana,Arial">.::<a href="editor-pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=headline&title=<?php echo $LDEditTitle ?>"><?php echo $LDClk2Write ?></a>::.</td>
  </tr> 
-->

	</table>
	
	</td>
<!-- <TD  VALIGN="top"   bgcolor="<?php echo //$cfg['body_txtcolor']; ?>" width=1>
 -->
 <TD   width=1  background="<?php //echo $root_path ?>gui/img/common/biju/vert_reuna_20b.gif">
 	&nbsp;
    </TD>
<!-- <TD WIDTH=150 VALIGN="top" >
 -->
 <TD VALIGN="top" >
	<FONT  SIZE=2  FACE="arial,verdana">
<?php
require($root_path.'include/inc_rightcolumn_menu.php');
?>    </TD>
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
