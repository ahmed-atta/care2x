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

define('LANG_FILE','startframe.php');
define('NO_CHAIN',1);
require_once('../include/inc_front_chain_lang.php');
if(!($HTTP_COOKIE_VARS['ck_sid'.$sid])&&!$cookie) { header("location:../cookies.php?lang=$lang&startframe=1"); exit;}

/* Check whether the content is language dependent */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $newspath='../news_service/'.$lang.'/';
}
else 
{
    $newspath='../news_service/all_language/';
}

$readerpath="headline-read.php?file=";
// reset all 2nd level lock cookies
require('../include/inc_2level_reset.php');
require_once('../include/inc_config_color.php');

$today=date("Y-m-d");
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
{
		$dbtable='care_news_article';
		
		$news_category="headline";  // set the news category
        $news_num_stop=3;  // The maximum number of news article to be displayed
		include("../include/inc_news_get.php"); // now get the current news

  } else { echo "$LDDbNoLink $sql<br>"; }
//echo $lang;
?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $LDPageTitle ?></TITLE>

<?php if($cfg['dhtml']) include("../include/inc_css_a_hilitebu.php"); ?>

<script language="javascript">
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
 <BODY topmargin=4 marginheight=4  bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>




<TABLE CELLSPACING=5 cellpadding=0 border="0" width="601">
  <tr>
    <td colspan=3><nobr>  <img <?php echo createComIcon('../','banner_middle3.gif','0') ?>><img <?php echo createComIcon('../','mo_dau.gif','0') ?>>
</nobr></td>
  </tr>


  <tr>
    <td WIDTH=450 VALIGN="top">
	<FONT  SIZE=1 COLOR="<?php echo $cfg['body_txtcolor']; ?>" FACE="verdana,Arial">
	
	<table>
 <?php
 require("../include/inc_news_display.php");
?>
	</table>
	
	</td>
<TD  VALIGN="top"   bgcolor="<?php echo $cfg['idx_txtcolor']; ?>" width=1>
<img src="../gui/img/common/default/pixel.gif" border=0 width=1 height=1>
    </TD>
<TD WIDTH=150 VALIGN="top" >
	<FONT  SIZE=2  FACE="arial,verdana">
<?php
require("../include/inc_rightcolumn_menu.php");
?>    </TD>
  </tr>
  <tr>
    <td colspan=3>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?></td>
  </tr>
</table>




</BODY>
</HTML>
