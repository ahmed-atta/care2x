<? 
if(!$file) { header("location:startframe.php?sid=$ck_sid"); exit;}

if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
		
require("../language/".$lang."/lang_".$lang."_editor.php");

require("../req/config-color.php");

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE><?=$title ?></TITLE>

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
<BODY bgcolor=<? if ($cfg) 
{	print $cfg['body_bgcolor']; 
	 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
 }else print '"#ffffff"';
?>>
<!-- 
<img src="../img/groupcopy2.jpg" width="598" height="70" border="0"> -->

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

<TABLE CELLSPACING=5 cellpadding=0 border="0" width="600">

<TR >
<TD WIDTH=80% VALIGN="top" >
<? 
	$picpath="../news_service/".$lang."/fotos/".$picfile;
	if(file_exists($picpath)&&file_exists("../news_service/$lang/news/$file"))
		{
			$picsize=GetImageSize($picpath);
		 	print '
			<img src="'.$picpath.'" border=0 align="'.$palign.'" ';
			if(!$picsize||($picsize[0]>150)) print 'width="150">';
				else print $picsize[3].'>';
		}
	if(file_exists("../news_service/$lang/news/$file")) include("../news_service/$lang/news/$file"); 
?>
<p>
<a href="<? if($mode=="preview4saved") print "startframe.php?sid=$ck_sid&lang=$lang"; else print "javascript:window.history.back()"; ?>"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0> <font face="arial" color="#006600"><?=$LDBackTxt ?></a>

</TD>
	
<td valign=top width="1" bgcolor="<? print $cfg['idx_txtcolor']; ?>" ><img src="../img/pixel.gif" width="1" height="1" border=0>
</td>


<TD WIDTH=20% VALIGN="top" >

<? 
	require("../req/rightcolumn-menu.php"); 
?>
	
    </TD>
</TR>

<tr>
<td colspan=3>
<hr>
<a href="editor-pass.php?lang=<?=$lang ?>&target=headline&title=<?=$title ?>"><img src="../img/news.gif" width=16 height=14 border=0></a>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</td>
</tr>

</TABLE>




</BODY>
</HTML>
