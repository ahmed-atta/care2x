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
define("LANG_FILE","startframe.php");
define("NO_CHAIN",1);
require("../include/inc_front_chain_lang.php");
$ck_sid_buffer="ck_sid$sid";
if(!($HTTP_COOKIE_VARS[$ck_sid_buffer])&&!$cookie) { header("location:../cookies.php?lang=$lang&startframe=1"); exit;}

$newspath="../news_service/".$lang."/news/";
$readerpath="headline-read.php?file=";
$news_num_stop=3;  // The maximum number of news article to be displayed
// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");
require("../include/inc_config_color.php");

$today=date("Ymd");
require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK)
{
		$dbtable="news_article_".$lang;

		for($i=1;$i<=$news_num_stop;$i++) 
		{
		 	$sql="SELECT head_file,main_file,pic_file FROM $dbtable 
					WHERE category='headline' 
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
							WHERE category='headline' 
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
  } else { print "$LDDbNoLink $sql<br>"; }
//print $lang;
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE><?php echo $LDPageTitle ?></TITLE>

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
 <BODY topmargin=4 marginheight=4  bgcolor=<?php print $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>




<TABLE CELLSPACING=5 cellpadding=0 border="0" width="601">
  <tr>
    <td colspan=3><nobr>  <img src="../img/banner_middle3.gif" border=0 width=451 height=60><img src="../img/mo_dau.gif" border=0 width=150 height=60>
</nobr></td>
  </tr>


  <tr>
    <td WIDTH=450 VALIGN="top">
	<FONT  SIZE=1 COLOR="<?php print $cfg['body_txtcolor']; ?>" FACE="verdana,Arial">
	
	<table>
 <?php
 require("../include/inc_news_display.php");
?>
	</table>
	
	</td>
<TD  VALIGN="top"   bgcolor="<?php print $cfg['idx_txtcolor']; ?>" width=1>
<img src="../img/pixel.gif" border=0 width=1 height=1>
    </TD>
<TD WIDTH=150 VALIGN="top" >
	<FONT  SIZE=2  FACE="arial,verdana">
<?php
require("../include/inc_rightcolumn_menu.php");
?>    </TD>
  </tr>
  <tr>
    <td colspan=3>
	<a href="editor-pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=headline&title=<?php echo $LDEditTitle ?>"><img src="../img/news.gif" width=16 height=14 border=0></a>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?></td>
  </tr>
</table>




</BODY>
</HTML>
