<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;

require("../language/".$lang."/lang_".$lang."_editor.php");

$newspath="../news_service/".$lang."/news/";
$readerpath="cafenews-read.php?file=";

$today=date("Ymd");
require("../req/db-makelink.php");
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

		if(confirm("<?=$LDConfirmEdit ?>"))
		{
			window.location.href="cafenews-edit-pass.php?sid=<?="$ck_sid&lang=$lang&title=$LDCafeNews" ?>";
			return false;
		}

}
</script>

<style type="text/css" name="s2">
.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style>

</HEAD>
<BODY bgcolor=#ffffff VLINK="#003366" link="#003366">
<TABLE CELLSPACING=10 cellpadding=0 border="0" width="590">
<tr>
<td colspan=3>
<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img src="../img/basket.gif" width=74 height=70 border=0></a> <b><?=$LDCafeNews ?></b></FONT>
<hr>
</td>
</tr>

<TR >
<TD WIDTH=80% VALIGN="top" >

<? 
$nofile=0;
 if($art[1])
	{
		$picpath="../news_service/".$lang."/fotos/".$art[1][pic_file];
		if(file_exists($picpath)&&file_exists($newspath.$art[1][head_file]))
		{
			$picpath="../news_service/".$lang."/fotos/".$art[1][pic_file];
			$picsize=GetImageSize($picpath);
		 	print '
				<img src="'.$picpath.'" border=0 align="left" ';
			if($picsize[0]>150) print 'width="150">';
				else print $picsize[3].'>';
		}
		if (file_exists($newspath.$art[1][head_file]))
		{
			 include($newspath.$art[1][head_file]);
		 	print'
		 	<a href="'.$readerpath.$art[1][main_file].'&lang='.$lang.'&picfile='.$art[1][pic_file].'&palign=left&title='.$LDEditTitle.'"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</font></a>';
		}
		else $nofile=1;
	} 

	if(!$art[1]||$nofile)
	{ 
		$i=1;
		print '
 		<img src="../img/pplanu-s.jpg" border=0 width=130 height=98 align="left">';
		include("../language/".$lang."/lang_".$lang."_newsdummy.php");
		print '<a href="cafenews-edit-pass.php?sid='.$ck_sid.'&title='.strtr($LDCafeNews," ","+").'&lang='.$lang.'">
		<font size=1 color="#ff0000" face="arial">'.$LDClk2Edit.'</font></a>';
	}?>
</TD>
	
<td valign=top width="1" bgcolor="maroon" rowspan=2 ><img src="../img/pixel.gif" width="1" height="1">
</td>


<TD WIDTH=20% VALIGN="top"  rowspan=2>
	
<table cellspacing=0 cellpadding=1 border=0align=right>
<tr bgcolor="#999999" >
<td>
<table  cellspacing=0 cellpadding=2 align=right>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b><?=$LDMenuToday ?></b>
</td>
</tr>
<tr>
<td bgcolor="#ffffcc" class="vn"><nobr><? print nl2br($menu[menu]); ?></nobr>
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
		&nbsp;<A HREF="cafenews-menu.php?lang=<?=$lang ?>"><?=$LDMenuAll ?></A><br>
<img src="../img/frage.gif" width=15 height=15 border=0>
<br>
	&nbsp;<A HREF="cafenews-prices.php?lang=<?=$lang ?>"><?=$LDPrices ?></A>
</td>
</tr></table>






    </TD>
</TR>
<tr>
<td width="80%">
<hr>

<?
$nofile=0;
  if($art[2])
	{
		$picpath="../news_service/".$lang."/fotos/".$art[2][pic_file];
		if(file_exists($picpath)&&file_exists($newspath.$art[2][head_file]))
		{
			$picsize=GetImageSize($picpath);
		 	print '
				<img src="'.$picpath.'" border=0 align="right" ';
			if($picsize[0]>150) print 'width="150">';
				else print $picsize[3].'>';
		}
		if (file_exists($newspath.$art[2][head_file]))
		{
		 include($newspath.$art[2][head_file]);
		 print'
		 	<a href="'.$readerpath.$art[2][main_file].'&lang='.$lang.'&picfile='.$art[2][pic_file].'&palign=right&title='.$LDEditTitle.'"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</font></a>';
		}
		else $nofile=1;
	} 
	
	if(!$art[2]||$nofile)
	{ 
		$i=2;
		print '
 		<img src="../img/pplanu-s.jpg" border=0 width=130 height=98 align="right">';
		include("../language/".$lang."/lang_".$lang."_newsdummy.php");
		print '<a href="cafenews-edit-pass.php?sid='.$ck_sid.'&title='.strtr($LDCafeNews," ","+").'&lang='.$lang.'">
		<font size=1 color="#ff0000" face="arial">'.$LDClk2Edit.'</font></a>';

	}
?>
	
<hr>
<?
$nofile=0;
  if($art[3])
	{
		$picpath="../news_service/".$lang."/fotos/".$art[3][pic_file];
		if(file_exists($picpath)&&file_exists($newspath.$art[3][head_file]))
		{
			$picsize=GetImageSize($picpath);
		 	print '
				<img src="'.$picpath.'" border=0 align="left" ';
			if($picsize[0]>150) print 'width="150">';
				else print $picsize[3].'>';
		}
		if (file_exists($newspath.$art[3][head_file]))
		{
		 include($newspath.$art[3][head_file]);
		 print'
		 	<a href="'.$readerpath.$art[3][main_file].'&lang='.$lang.'&picfile='.$art[3][pic_file].'&palign=left&title='.$LDEditTitle.'"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</font></a>';
		}
		else $nofile=1;
	} 
	
	if(!$art[3]||$nofile)
	{ 
		$i=3;
		print '
 		<img src="../img/pplanu-s.jpg" border=0 width=130 height=98 align="left">';
		include("../language/".$lang."/lang_".$lang."_newsdummy.php");
		print '<a href="cafenews-edit-pass.php?sid='.$ck_sid.'&title='.strtr($LDCafeNews," ","+").'&lang='.$lang.'">
		<font size=1 color="#ff0000" face="arial">'.$LDClk2Edit.'</font></a>';

	}
 ?>

</td>
</tr>

<tr>
<td colspan=3>
<hr>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</td>
</tr>

</TABLE>



</BODY>
</HTML>
