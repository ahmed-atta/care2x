<?php
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_specials.php");
require("../language/".$lang."/lang_".$lang."_indexframe.php");
require("../req/config-color.php");

$breakfile="spediens.php?sid=$ck_sid&lang=$lang";

      
if ($mode=="change")
{
$color="#".$color;
switch($item)
{
	case "idxfrm_hover": setcookie(idxfrm_hover,$color);$idxfrm_hover=$color;break;
	case "idxfrm_alink":setcookie(idxfrm_alink,$color);$idxfrm_alink=$color;break;
	case "bodyfrm_hover":setcookie(bodyfrm_hover,$color);$bodyfrm_hover=$color;break;
	case "bodyfrm_alink";setcookie(bodyfrm_alink,$color);$bodyfrm_alink=$color;break;

}

}
elseif(($mode=="ok")||($mode=="remain")) 
{
	//update new color values
	$cfg['idx_hover']=$idxfrm_hover;
	$cfg['idx_alink']=$idxfrm_alink;
	$cfg['body_hover']=$bodyfrm_hover;
	$cfg['body_alink']=$bodyfrm_alink;
	//save to file

	if($file=fopen($path,"w+"))
	{
		reset($cfg);
		while(list($x,$v)=each($cfg))
		{
			$line='<meta name="'.$x.'" content="'.$v.'">';
			fwrite($file,$line."\r\n");
		}
		fclose($file);
		if($mode=="ok") {header("location:spediens.php?idxreload=j&sid=$ck_sid&lang=$lang");exit;}
		if($mode=="remain") {header("location:excolorchg.php?item=$item&idxreload=j&sid=$ck_sid&lang=$lang");exit;}
    }
}
else //load saved colors from cookies
{
//print "default";
$idxfrm_hover=$cfg['idx_hover'];
$idxfrm_alink=$cfg['idx_alink'];
$bodyfrm_hover=$cfg['body_hover'];
$bodyfrm_alink=$cfg['body_alink'];
setcookie(idxfrm_hover,$cfg['idx_hover']);
setcookie(idxfrm_alink,$cfg['idx_alink']);
setcookie(bodyfrm_hover,$cfg['body_hover']);
setcookie(bodyfrm_alink,$cfg['body_alink']);
}
//prevent client from caching
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Spezielle Dienste</TITLE>

<script language="javascript">
<!-- 
var urlholder;

  function chgcolor(p,x){
	winspecs="width=550,height=600,menubar=no,resizable=yes,scrollbars=yes";
<? 
print 'urlholder="chg-color.php?item="+p+"&sid='.$ck_sid.'&mode=ex&tb='.str_replace('#','',$cfg['top_bgcolor']).'&tt='.str_replace('#','',$cfg['top_txtcolor']).'&bb='.str_replace('#','',$cfg['body_bgcolor']).'&btb='.str_replace('#','',$cfg['bot_bgcolor']).'&d='.$cfg['dhtml'].'";';
?>
	colorwin=window.open(urlholder,"colorwin",winspecs);
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//  -->
</script>

<? if($cfg['dhtml'])
{ print' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>

	<STYLE TYPE="text/css">
	A:link  {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$bodyfrm_hover.';}
	A:active {text-decoration: none; color: '.$bodyfrm_alink.';}
	A:visited {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$bodyfrm_alink.';}
	A:visited:hover {text-decoration: underline; color: '.$bodyfrm_hover.';}
	</style>';
}
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver 
<? if($idxreload=="j") print 'onLoad="window.parent.STARTPAGE.location.replace(\'indexframe.php?sid='.$ck_sid.'&lang='.$lang.'\');" '; 
if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$bodyfrm_alink.' vlink='.$cfg['idx_txtcolor']; } ?>>
<?//print $item; ?>
<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10"><FONT  COLOR="<? print  $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp; &nbsp; <img src="../img/settings_tree.gif"  height=23 border=0> <?=$LDColorOptExt ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0 style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('color_opt.php','ext')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>

<table border=1>
  <tr >
    <td rowspan=3 bgcolor=<? print $cfg['idx_bgcolor']; ?> width=100 >
	<center><img src="../img/maho4.gif" width=115 height=61 border=0 ></center>


<FONT    SIZE=1  FACE="Arial" color=<? print $cfg['idx_txtcolor']; ?>>
<?
while(list($x,$v)=each($indextag))
print "&nbsp;$v<br>";
?>
<FONT    SIZE=-1  FACE="verdana,Arial">
<p align=center>
Index frame<p align=left >
&nbsp;<a href="#" onClick="chgcolor('idxfrm_hover','ex')"><img src="../img/settings_tree.gif" border=0 alt="Index frame hover  link color" align="absmiddle"><font face="Verdana, Arial" size=2 color=<?print $idxfrm_hover; ?>> Hover link.</font></a><br>
&nbsp;<a href="#" onClick="chgcolor('idxfrm_alink','ex')"><img src="../img/settings_tree.gif" border=0 alt="Index frame active  link color" align="absmiddle"><font face="Verdana, Arial" color=<?print $idxfrm_alink; ?>> Active link.</font></a><br>


</p>
<p><br>
</td>
    <td bgcolor=<? print $cfg['top_bgcolor']; ?> >
	&nbsp;&nbsp;&nbsp;<font size=2 color=<? print $cfg['top_txtcolor']; ?> FACE="Arial"><?=$LDTopFrame ?></font>
</td>
  </tr>
  <tr valign=top>
  
<td bgcolor=<? print $cfg['body_bgcolor']; ?> width=400 ><FONT    SIZE=-1  FACE="verdana,Arial">
<p><br>&nbsp; <?=$LDMainFrame ?><p><br>
&nbsp;<a href="#" onClick=chgcolor('bodyfrm_hover','ex')><img src="../img/settings_tree.gif"  alt="<?=$LDMainFrame ?> hover  link " align="absmiddle" border=0><font face="Verdana, Arial" color=<? print $bodyfrm_hover; ?>> <?=$LDMainFrame ?> hover link.</font></a><br>
&nbsp;<a href="#" onClick=chgcolor('bodyfrm_alink','ex')><img src="../img/settings_tree.gif"  alt="<?=$LDMainFrame ?> active link " align="absmiddle" border=0><font face="Verdana, Arial" color=<? print $bodyfrm_alink; ?>> <?=$LDMainFrame ?> active link.</font></a><br>
<p><br>
</td>
  </tr>
  <tr>
 
    <td bgcolor=<? print $cfg['bot_bgcolor']; ?>>
<FONT    SIZE=2  FACE="Arial"><p><br>
	&nbsp;&nbsp;&nbsp;<?=$LDBottomFrame ?>

<p>
</FONT>
</td>
  </tr>
</table>





<FORM >
<input type="button" value="<?=$LDOK ?>" onClick="location.replace('excolorchg.php?mode=ok&sid=<? print "$ck_sid&lang=$lang"; ?>&item=<? print $item; ?>')">
<INPUT type="button"  value="<?=$LDCancel ?>" onClick="location.replace('spediens.php?sid=<? print "$ck_sid&lang=$lang"; ?>')">
<input type="button" value="<?=$LDApply ?>" onClick="location.replace('excolorchg.php?mode=remain&sid=<? print "$ck_sid&lang=$lang"; ?>&item=<? print $item; ?>')">
</FORM>
</font>
<p>
</ul>



</td>
</tr>

<tr valign=top >
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
