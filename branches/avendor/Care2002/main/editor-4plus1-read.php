<?
if(!$file) { print "Artikel nicht gefunden."; exit;}
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
		
require("../language/".$lang."/lang_".$lang."_editor.php");

require("../req/config-color.php");
switch($target)
{
	case "headline":$breakfile="startframe.php?sid=$sid&lang=$lang";
							//$title="Schalgzeilen";
							break;
	case "cafenews":$breakfile="cafenews.php?sid=$sid&lang=$lang";
							//$title="Schalgzeilen";
							break;
	/*
	case "healthtips":$breakfile="newscolumns.php?sid=$ck_sid&target=$target";
							//$title="Gesundheitstips";
							break;
	case "adv_studies":$breakfile="newscolumns.php?sid=$ck_sid&target=$target";
							//$title="Fortbildung";
							break;
	case "prof_training":$breakfile="newscolumns.php?sid=$ck_sid&target=$target";
							//$title="Ausbildung";
							break;
	case "physiotherapy":$breakfile="newscolumns.php?sid=$ck_sid&target=$target";
							//$title="Physiotherapie";
							break;
	case "events":$breakfile="newscolumns.php?sid=$ck_sid&target=$target";
							//$title="Veranstaltungen";
							break;
	*/
	default:	$breakfile="newscolumns.php?sid=$sid&target=$target&lang=$lang&title=$title";
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?=$title ?></TITLE>

<script language="javascript">
<!-- 
var urlholder;

function gethelp(x)
{
	if (!x) x="";
	urlholder="help-router.php?helpidx="+x+"&lang=<?=$lang ?>";
	helpwin=window.open(urlholder,"helpwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
 ?> >

 <? if($mode=="preview4saved") : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td colspan=2>
	<FONT FACE="verdana,Arial"><FONT  SIZE=3 COLOR="#000066" FACE="verdana,Arial"><?=$LDArticleSaved ?></font>
<hr>
</td>
  </tr>
</table>
<? endif ?>
 
<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp;<?=$title ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if(($cfg['dhtml'])&&($mode!="preview4saved")) print'<a href="javascript:history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>';?>
<a href="javascript:gethelp()"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="startframe.php?sid=<?print "$sid&lang=$lang";?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<table border=0 cellpadding=10 width="400">
  <tr>
    <td valign="top">
	<? 
		$picpath="../news_service/".$lang."/fotos/".$picfile;
		if(file_exists($picpath)&&file_exists("../news_service/$lang/news/$file"))
		{
			$picsize=GetImageSize($picpath);
		 	print '
				<img src="'.$picpath.'" border=0 align="left" ';
			if(!$picsize||($picsize[0]>150)) print 'width="150">';
				else print $picsize[3].'>';
		}
		
		if(file_exists("../news_service/$lang/news/$file")) include("../news_service/$lang/news/$file");
	?>
<p>
<a href="<? if($mode=="preview4saved") print $breakfile; else print "javascript:window.history.back()"; ?>"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0><font face="arial"  SIZE=-1 color="#006600"> <?=$LDBackTxt ?></a>
</FONT>
<p></td>
  </tr>
 
</table>
<hr>
</td>
</tr>

<tr valign=top>
<td bgcolor="<? print $cfg['bot_bgcolor']; ?>" colspan=2> 
<a href="editor-pass.php?target=<?="$target&title=$title&lang=$lang"; ?>"><img src="../img/news.gif" width=16 height=14 border=0></a>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
