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
define("LANG_FILE","editor.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");

$newspath="../news_service/".$lang."/news/";
$readerpath="cafenews-read.php?sid=$sid&file=";
$news_num_stop=3; // maximum number of news displayed
$LDEditTitle="Cafenews";
$today=date("Ymd");
require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK)
	{	
		$dbtable="news_article_".$lang;

		for($i=1;$i<4;$i++)
		{
		 	$sql="SELECT head_file,main_file,pic_file FROM $dbtable 
					WHERE category='cafenews' 
						AND art_num='$i' 
						AND publish_date='$today' 
							ORDER BY tstamp DESC";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $artikel=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$art[$i]=mysql_fetch_array($ergebnis);
				}
				else // if no file found get the last entry
				{
					$sql="SELECT head_file,main_file,pic_file FROM $dbtable 
							WHERE category='cafenews' 
								AND art_num='$i'  
								AND publish_date<'$today' 
									ORDER BY tstamp DESC";

							if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=0;
								while( $artikel=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$art[$i]=mysql_fetch_array($ergebnis);
								}
								//else $art[$i]=array("head_file"=>"head_dummy".$i.".htm");
							}
							
				}
			}
		}
		
		// now fetch today's menu
		$dbtable="cafe_menu_".$lang;
		 	$sql="SELECT menu FROM $dbtable 
					WHERE cyear='".date("Y")."' 
						AND cmonth='".date("m")."' 
						AND cday='".date("d")."'";

			if($ergebnis=mysql_query($sql,$link))
       		{
					$menu=mysql_fetch_array($ergebnis);
			}
			if(!$menu[menu]) $menu[menu]=$LDNoMenu;
		
 } else { print "$LDDbNoLink $sql<br>"; }


?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE></TITLE>

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
<a href="javascript:editcafe()"><img src="../img/basket.gif" width=74 height=70 border=0></a> <b><?php echo $LDCafeNews ?></b></FONT>
<hr>
</td>
</tr>
 
  <tr>
    <td WIDTH=480 VALIGN="top">
	<FONT  SIZE=1 COLOR="<?php print $cfg['body_txtcolor']; ?>" FACE="verdana,Arial">
	
	<table>
 <?php
 $editor_path="cafenews-edit-pass.php?sid=".$sid."&lang=".$lang."&title=".$LDCafeNews;
 require("../include/inc_news_display.php");
?>
	</table>
	
	</td>
<TD  VALIGN="top"   bgcolor="<?php print $cfg['idx_txtcolor']; ?>" width=1>
<img src="../img/pixel.gif" border=0 width=1 height=1>
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
<td bgcolor="#ffffcc" class="vn"><nobr><?php print nl2br($menu[menu]); ?></nobr>
</td> 
</tr>

</table>

</td>
</tr>
<tr >
<td><p><br>
<img src="../img/frage.gif" width=15 height=15 border=0>
<br>
<FONT  SIZE=-1 FACE="Arial" >
		&nbsp;<A HREF="cafenews-menu.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDMenuAll ?></A><br>
<img src="../img/frage.gif" width=15 height=15 border=0>
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
	<a href="cafenews-edit-pass.php?sid=<?php echo "$sid&lang=$lang&title=$LDCafeNews" ?>"><img src="../img/news.gif" width=16 height=14 border=0></a>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?></td>
  </tr>
</table>
</BODY>
</HTML>
