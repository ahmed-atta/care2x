<? 
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla
								
Beta version 1.0    2002-05-10
								
This script(s) is(are) free software; you can redistribute it and/or
modify it under the terms of the GNU General Public
License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.
																  
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
General Public License for more details.
											   
You should have received a copy of the GNU General Public
License along with this script; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
																		 
Copy of GNU General Public License at: http://www.gnu.org/
													 
Source code home page: http://www.care2x.com
Contact author at: elpidio@latorilla.com

This notice also applies to other scripts which are integral to the functioning of CARE 2002 within this directory and its top level directory
A copy of this notice is also available as file named copy_notice.txt under the top level directory.
*/

if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if(!$ck_sid&&!$cookie) { header("location:../cookies.php?lang=$lang&startframe=1"); exit;}
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}

require("../language/".$lang."/lang_".$lang."_startframe.php");

// reset all cookies
$newspath="../news_service/".$lang."/news/";
$readerpath="headline-read.php?file=";

setcookie(currentuser,""); 
setcookie(aufnahme_user,"");
setcookie(ck_apo_db_user,"");
setcookie(ck_apo_arch_user,"");
require("../req/config-color.php");

$today=date("Ymd");
require("../req/db-makelink.php");
if($link&&$DBLink_OK)
{
		$dbtable="news_article_".$lang;

		for($i=2;$i<4;$i++) // temporary starts at 2 to deactivate the article 1
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
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE><?=$LDPageTitle ?></TITLE>

<? if($cfg['dhtml'])
{ print' <STYLE TYPE="text/css">

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
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//  Script End -->
</script>
</HEAD>
<BODY topmargin=4 marginheight=4  bgcolor=<? print $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>
 <img src="../img/banner_middle3.gif" border=0 width=451 height=60><img src="../img/mo_dau.gif" border=0 width=150 height=60>

<TABLE CELLSPACING=5 cellpadding=0 border="0" width="600">
 <!-- width=143 height=123 -->
<TR >
<TD WIDTH=80% VALIGN="top" >
<FONT  SIZE=6 COLOR="#0000cc" FACE="Times New Roman,Arial">
<p>
<? if($art[1])
	{
		$picpath="../news_service/".$lang."/fotos/".$art[1][pic_file];
		if(file_exists($picpath)&&file_exists($newspath.$art[1][head_file]))
		{
			$picsize=GetImageSize($picpath);
		 	print '
				<img src="'.$picpath.'" border=0 align="left" ';
			if(!$picsize||($picsize[0]>150)) print 'width="150">';
				else print $picsize[3].'>';
		}
		
		if(file_exists($newspath.$art[2][head_file]))
		{
			 include($newspath.$art[2][head_file]);
		 	print'
		 	<a href="'.$readerpath.$art[1][main_file].'&lang='.$lang.'&picfile='.$art[1][pic_file].'&palign=right&title='.$LDEditTitle.'"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</font></a>';
		}
		else $nofile=1;
	} 
	
	if(!$art[1]||$nofile)
	{ 
		$i=1;
		print '
 		<img src="../img/pplanu-s.jpg" border=0 width=130 height=98 align="left">';
		include("../language/".$lang."/lang_".$lang."_newsdummy.php");
		print '
		<font size=1 face="verdana,arial"><a href="editor-pass.php?sid='.$ck_sid.'&lang='.$lang.'&target=headline&title='.$LDEditTitle.'">'.$LDClk2Write.'</a>';
	}
	$nofile=0;
?>

</TD>
<td valign=top width="1" bgcolor="<? print $cfg['idx_txtcolor']; ?>" rowspan=2 ><img src="../img/pixel.gif" width="1" height="1" border=0>
</td>
<TD WIDTH=20% VALIGN="top"  rowspan=2>
<? 
	require("../req/rightcolumn-menu.php"); 
?>
	
    </TD>
</TR>
<tr>
<td width="80%">

<hr>
<? if($art[2])
	{
		$picpath="../news_service/".$lang."/fotos/".$art[2][pic_file];
		if(file_exists($picpath)&&file_exists($newspath.$art[2][head_file]))
		{
			$picsize=GetImageSize($picpath);
		 	print '
				<img src="'.$picpath.'" border=0 align="right" ';
			if(!$picsize||($picsize[0]>150)) print 'width="150">';
				else print $picsize[3].'>';
		}
		
		if(file_exists($newspath.$art[2][head_file]))
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
		print '
		<font size=1 face="verdana,arial"><a href="editor-pass.php?sid='.$ck_sid.'&lang='.$lang.'&target=headline&title='.$LDEditTitle.'">'.$LDClk2Write.'</a>';
	}
	$nofile=0;
?>
<hr>
<? if($art[3])
	{
		$picpath="../news_service/".$lang."/fotos/".$art[3][pic_file];
		 if(file_exists($picpath)&&file_exists($newspath.$art[3][head_file]))
		 {
			$picsize=GetImageSize($picpath);
		 	print '
			<img src="'.$picpath.'" border=0 align="left" ';
			if(!$picsize||($picsize[0]>150)) print 'width="150">';
				else print $picsize[3].'>';
		}
		if(file_exists($newspath.$art[3][head_file]))
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
		print '
		<font size=1 face="verdana,arial"><a href="editor-pass.php?sid='.$ck_sid.'&lang='.$lang.'&target=headline&title='.$LDEditTitle.'">'.$LDClk2Write.'</a>';
	}
?>
</td>
</tr>
<tr>
<td colspan=3>
<hr>
<a href="editor-pass.php?sid=<?=$ck_sid ?>&lang=<?=$lang ?>&target=headline&title=<?=$LDEditTitle ?>"><img src="../img/news.gif" width=16 height=14 border=0></a>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</TABLE>
</BODY>
</HTML>
