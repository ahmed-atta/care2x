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

$dbtable_menu='care_cafe_menu';

/* Check whether the content is language dependent */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $newspath='../news_service/'.$lang.'/';
	/* Set the sql query for fetching the menu */
    $sql_menu="SELECT menu FROM $dbtable_menu WHERE cdate='".date("Y-m-d")."' AND lang='".$lang."'";
}
else 
{
    $newspath='../news_service/all_language/';
	/* Set the sql query for fetching the menu */
    $sql_menu="SELECT menu FROM $dbtable_menu WHERE cdate='".date("Y-m-d")."'";
}


// reset all 2nd level lock cookies
require('../include/inc_2level_reset.php');

$readerpath="cafenews-read.php?sid=$sid&file=";
$LDEditTitle="Cafenews";
$today=date("Ymd");

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
	{	
		$dbtable='care_news_article';
		
		$news_category="cafenews";  // set the news category
		$news_num_stop=3; // maximum number of news displayed
		include("../include/inc_news_get.php"); // now get the current news

		// now fetch today's menu

			if($ergebnis=mysql_query($sql_menu,$link))
       		{
					$menu=mysql_fetch_array($ergebnis);
			}
			if(!$menu[menu]) $menu[menu]=$LDNoMenu;
		
 } else { echo "$LDDbNoLink $sql<br>"; }


?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
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
<a href="javascript:editcafe()"><img <?php echo createComIcon('../','basket.gif','0') ?>></a> <b><?php echo $LDCafeNews ?></b></FONT>
<hr>
</td>
</tr>
 
  <tr>
    <td WIDTH=480 VALIGN="top">
	<FONT  SIZE=1 COLOR="<?php echo $cfg['body_txtcolor']; ?>" FACE="verdana,Arial">
	
	<table>
 <?php
 $editor_path="cafenews-edit-pass.php?sid=".$sid."&lang=".$lang."&title=".$LDCafeNews;
 require("../include/inc_news_display.php");
?>
	</table>
	
	</td>
<TD  VALIGN="top"   bgcolor="<?php echo $cfg['idx_txtcolor']; ?>" width=1>
<img src="../gui/img/common/default/pixel.gif" border=0 width=1 height=1>
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
<td bgcolor="#ffffcc" class="vn"><nobr><?php echo nl2br($menu[menu]); ?></nobr>
</td> 
</tr>

</table>

</td>
</tr>
<tr >
<td><p><br>
<img <?php echo createComIcon('../','frage.gif','0') ?> border=0>
<br>
<FONT  SIZE=-1 FACE="Arial" >
		&nbsp;<A HREF="cafenews-menu.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDMenuAll ?></A><br>
<img <?php echo createComIcon('../','frage.gif','0') ?> border=0>
<br>
	&nbsp;<A HREF="cafenews-prices.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDPrices ?></A>
	<hr>
	<a href="cafenews-edit-pass.php?sid=<?php echo "$sid&lang=$lang&title=$LDCafeNews" ?>"><?php echo $LDCafeEditorial ?></a>

</td>
</tr></table>
    </TD>
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
