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
define("LANG_FILE","specials.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../language/".$lang."/lang_".$lang."_indexframe.php");
require("../include/inc_config_color.php");
$breakfile="spediens.php?sid=$sid&lang=$lang";

if ($mode=="change")
{
$color="#".$color;
switch($item)
{
	case "idxfrm_bgcolor": setcookie(idxfrm_bgcolor,$color);$idxfrm_bgcolor=$color;break;
	case "idxfrm_txtcolor":setcookie(idxfrm_txtcolor,$color);$idxfrm_txtcolor=$color;break;
	case "topfrm_bgcolor":setcookie(topfrm_bgcolor,$color);$topfrm_bgcolor=$color;break;
	case "topfrm_txtcolor":setcookie(topfrm_txtcolor,$color);$topfrm_txtcolor=$color;break;
	case "bodyfrm_bgcolor":setcookie(bodyfrm_bgcolor,$color);$bodyfrm_bgcolor=$color;break;
	case "bodyfrm_txtcolor";setcookie(bodyfrm_txtcolor,$color);$bodyfrm_txtcolor=$color;break;
	case "botfrm_bgcolor":setcookie(botfrm_bgcolor,$color);$botfrm_bgcolor=$color;break;
	case "botfrm_bgcolor":setcookie(botfrm_txtcolor,$color);$botfrm_txtcolor=$color;break;
}

}
elseif(($mode=="ok")||($mode=="remain"))
{
//save config to file

$cfg['idx_bgcolor']=$idxfrm_bgcolor;
$cfg['idx_txtcolor']=$idxfrm_txtcolor;
$cfg['top_bgcolor']=$topfrm_bgcolor;
$cfg['top_txtcolor']=$topfrm_txtcolor;
$cfg['body_bgcolor']=$bodyfrm_bgcolor;
$cfg['body_txtcolor']=$bodyfrm_txtcolor;
$cfg['bot_bgcolor']=$botfrm_bgcolor;
$cfg['bot_txtcolor']=$botfrm_txtcolor;

if($file=fopen($path,"w+"))
{
	reset($cfg);
	while(list($x,$v)=each($cfg))
	{
		$line='<meta name="'.$x.'" content="'.$v.'">';
		fwrite($file,$line."\r\n");
	}
	fclose($file);
	if($mode=="ok") {header("location:spediens.php?sid=$sid&lang=$lang&idxreload=j");exit;}
	if($mode=="remain") {header("location:colorchg.php?sid=$sid&lang=$lang&idxreload=j");exit;}
}
}
else //load saved colors from cookies
{
//get "default";
$idxfrm_bgcolor=$cfg['idx_bgcolor'];
$idxfrm_txtcolor=$cfg['idx_txtcolor'];
$topfrm_bgcolor=$cfg['top_bgcolor'];
$topfrm_txtcolor=$cfg['top_txtcolor'];
$bodyfrm_bgcolor=$cfg['body_bgcolor'];
$bodyfrm_txtcolor=$cfg['body_txtcolor'];
$botfrm_bgcolor=$cfg['bot_bgcolor'];
$botfrm_txtcolor=$cfg['bot_txtcolor'];
//save default to cookies
setcookie(idxfrm_bgcolor,$cfg['idx_bgcolor']);
setcookie(idxfrm_txtcolor,$cfg['idx_txtcolor']);
setcookie(topfrm_bgcolor,$cfg['top_bgcolor']);
setcookie(topfrm_txtcolor,$cfg['top_txtcolor']);
setcookie(bodyfrm_bgcolor,$cfg['body_bgcolor']);
setcookie(bodyfrm_txtcolor,$cfg['body_txtcolor']);
setcookie(botfrm_bgcolor,$cfg['bot_bgcolor']);
setcookie(botfrm_txtcolor,$cfg['bot_txtcolor']);
}

// prevent client from caching
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">

var urlholder;

  function chgcolor(p){
	winspecs="width=550,height=600,menubar=no,resizable=yes,scrollbars=yes";
<?php 
	print 'urlholder="chg-color.php?item="+p+"&sid='.$sid.'&lang='.$lang.'&tb='.str_replace('#','',$cfg['top_bgcolor']).'&tt='.str_replace('#','',$cfg['top_txtcolor']).'&bb='.str_replace('#','',$cfg['body_bgcolor']).'&btb='.str_replace('#','',$cfg['bot_bgcolor']).'&d='.$cfg['dhtml'].'";';
?>
	colorwin=window.open(urlholder,"colorwin",winspecs);
	}
	
function ok()
{
	location.href='colorchg.php?mode=ok&sid=<?php echo "$sid&lang=$lang"; ?>';
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

</script>

<?php if($cfg['dhtml'])
{ print' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>

	<STYLE TYPE="text/css">

	A:link  {text-decoration: none; color: '.$bodyfrm_txtcolor.';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$bodyfrm_txtcolor.';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	</style>';
}
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver 
<?php if($idxreload=="j")
{
 print 'onLoad="window.parent.STARTPAGE.location.replace(\'indexframe.php?sid='.$sid.'&lang='.$lang.'\'); ';
 if($cfg[mask]==2) print 'window.parent.MENUBAR.location.replace(\'menubar2.php?sid='.$sid.'&lang='.$lang.'\');'; 
 print '"';
 }
if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10"><FONT  COLOR="<?php print  $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp;<img src="../img/settings_tree.gif"  height=23 border=0> <?php echo $LDColorOpt ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right><?php if($cfg['dhtml']) print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('color_opt.php','')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor="<?php print $cfg['body_bgcolor']; ?>" valign=top colspan=2><p><br>
<ul>

<table border=1>
  <tr >
    <td rowspan=3 bgcolor="<?php print $idxfrm_bgcolor; ?>" width=100 align=left>
	<center><img src="../img/maho4.gif" width=115 height=61 border=0 ></center>

<a href="#" title="<?php echo $LDClk4TxtColor ?>" onClick=chgcolor('idxfrm_txtcolor')>
<FONT    SIZE=1  FACE="Arial" color=<?php print $idxfrm_txtcolor; ?>>
<?php
while(list($x,$v)=each($indextag))
print "&nbsp;$v<br>";
?>
<p>
<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick=chgcolor('idxfrm_bgcolor')><?php echo $LDBgColor ?> <img src="../img/settings_tree.gif" border=0 width=16 height=17 >
</a>
</td>
    <td bgcolor="<?php print $topfrm_bgcolor; ?>" ><p><FONT    SIZE=1  FACE="Arial">
	&nbsp;&nbsp;&nbsp;<a href="#" title="<?php echo $LDClk4TxtColor ?>" onClick=chgcolor('topfrm_txtcolor')><font size=3 color=<?php print $topfrm_txtcolor; ?>><?php echo $LDTxtColor ?></font></a>&nbsp;&nbsp;&nbsp;
<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick=chgcolor('topfrm_bgcolor')><?php echo $LDBgColor ?> <img src="../img/settings_tree.gif" border=0 width=16 height=17 alt="<?php echo $LDClk4BgColor ?>">
</a></td>
  </tr>
  <tr>
  
<td bgcolor="<?php print $bodyfrm_bgcolor; ?>" width=400 ><p><br>
	<FONT    SIZE=4 FACE="Arial">	<a href="#" onClick=chgcolor('bodyfrm_txtcolor')><?php echo $LDMainFrame ?></a><p><FONT    SIZE=1 FACE="Arial">	
	<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick=chgcolor('bodyfrm_bgcolor')><?php echo $LDBgColor ?> <img src="../img/settings_tree.gif" border=0 width=16 height=17 alt="<?php echo $LDClk4BgColor ?>">
	</a><p><br>
</td>
  </tr>
  <tr>
 
    <td bgcolor="<?php print $botfrm_bgcolor; ?>">
<FONT    SIZE=1  FACE="Arial">
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

<p><a href="#" title="<?php echo $LDClk4BgColor ?>" onClick=chgcolor('botfrm_bgcolor')><?php echo $LDBgColor ?> <img src="../img/settings_tree.gif" border=0 width=16 height=17 alt="<?php echo $LDClk4BgColor ?>">
</a>
</FONT>
</td>
  </tr>
</table>



<FONT    SIZE=-1  FACE="Arial">

<FORM >
<input type="button" value="<?php echo $LDOK ?>" onClick=ok()>
<INPUT type="button"  value="<?php echo $LDCancel ?>" onClick=location.replace("spediens.php?sid=<?php print "$sid&lang=$lang"; ?>")>
<input type="button" value="<?php echo $LDApply ?>" onClick=location.replace("colorchg.php?mode=remain&sid=<?php print "$sid&lang=$lang"; ?>")>
<?php if ($cfg['dhtml'])
print '&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="'.$LDColorOptExt.'" onClick=location.replace("excolorchg.php?sid='.$sid.'&lang='.$lang.'")>';
?>
</FORM></font>
<p>
</ul>



</td>
</tr>

<tr valign=top >
<td bgcolor=<?php print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
