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
switch($target)
{
	case "headline":$breakfile="startframe.php?sid=$sid&lang=$lang";
							//$title="Schalgzeilen";
							break;
	case "cafenews":$breakfile="cafenews.php?sid=$sid&lang=$lang";
							//$title="Schalgzeilen";
							break;
	/*
	case "healthtips":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Gesundheitstips";
							break;
	case "adv_studies":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Fortbildung";
							break;
	case "prof_training":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Ausbildung";
							break;
	case "physiotherapy":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Physiotherapie";
							break;
	case "events":$breakfile="newscolumns.php?sid=$sid&target=$target";
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
 <TITLE><?php echo $title ?></TITLE>

<script language="javascript">
<!-- 
var urlholder;

function gethelp(x)
{
	if (!x) x="";
	urlholder="help-router.php?helpidx="+x+"&lang=<?php echo $lang ?>";
	helpwin=window.open(urlholder,"helpwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?php
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
 ?> >

 <?php if($mode=="preview4saved") : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td colspan=2>
	<FONT FACE="verdana,Arial"><FONT  SIZE=3 COLOR="#000066" FACE="verdana,Arial"><?php echo $LDArticleSaved ?></font>
<hr>
</td>
  </tr>
</table>
<?php endif ?>
 
<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp;<?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if(($cfg['dhtml'])&&($mode!="preview4saved")) print'<a href="javascript:history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>';?>
<a href="javascript:gethelp()"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="startframe.php?sid=<?php echo "$sid&lang=$lang";?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<table border=0 cellpadding=10 width="400">
  <tr>
    <td valign="top">
	<?php 
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
<a href="<?php if($mode=="preview4saved") print $breakfile; else print "javascript:window.history.back()"; ?>"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0><font face="arial"  SIZE=-1 color="#006600"> <?php echo $LDBackTxt ?></a>
</FONT>
<p></td>
  </tr>
 
</table>
<hr>
</td>
</tr>

<tr valign=top>
<td bgcolor="<?php print $cfg['bot_bgcolor']; ?>" colspan=2> 
<a href="editor-pass.php?target=<?php echo "$target&title=$title&lang=$lang&sid=$sid"; ?>"><img src="../img/news.gif" width=16 height=14 border=0></a>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
