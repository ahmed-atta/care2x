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
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require("../language/".$lang."/lang_".$lang."_indexframe.php");
require_once('../include/inc_config_color.php');
$breakfile="spediens.php?sid=".$sid."&lang=".$lang;

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
<?php echo setCharSet(); ?>

<script language="javascript">

var urlholder;

  function chgcolor(p){
	winspecs="width=550,height=600,menubar=no,resizable=yes,scrollbars=yes";
<?php 
	echo 'urlholder="chg-color.php?item="+p+"&sid='.$sid.'&lang='.$lang.'&tb='.str_replace('#','',$cfg['top_bgcolor']).'&tt='.str_replace('#','',$cfg['top_txtcolor']).'&bb='.str_replace('#','',$cfg['body_bgcolor']).'&btb='.str_replace('#','',$cfg['bot_bgcolor']).'&d='.$cfg['dhtml'].'";';
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
{ echo' 
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
 echo 'onLoad="window.parent.STARTPAGE.location.replace(\'indexframe.php?sid='.$sid.'&lang='.$lang.'\'); ';
 if($cfg[mask]==2) echo 'window.parent.MENUBAR.location.replace(\'menubar2.php?sid='.$sid.'&lang='.$lang.'\');'; 
 echo '"';
 }
if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10"><FONT  COLOR="<?php echo  $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp;<img <?php echo createComIcon('../','settings_tree.gif','0') ?>> <?php echo $LDColorOpt ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right><?php if($cfg['dhtml']) echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('color_opt.php','')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" valign=top colspan=2><p><br>
<ul>

<table border=1>
  <tr >
    <td rowspan=3 bgcolor="<?php echo $idxfrm_bgcolor; ?>" width=100 align=left>
	<center><img <?php echo createComIcon('../','care_logo.gif','0') ?>></center>

<a href="#" title="<?php echo $LDClk4TxtColor ?>" onClick=chgcolor('idxfrm_txtcolor')>
<FONT    SIZE=1  FACE="Arial" color=<?php echo $idxfrm_txtcolor; ?>>
<?php
while(list($x,$v)=each($indextag))
echo "&nbsp;$v<br>";
?>
<p>
<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick=chgcolor('idxfrm_bgcolor')><?php echo $LDBgColor ?> <img <?php echo createComIcon('../','settings_tree.gif','0') ?> >
</a>
</td>
    <td bgcolor="<?php echo $topfrm_bgcolor; ?>" ><p><FONT    SIZE=1  FACE="Arial">
	&nbsp;&nbsp;&nbsp;<a href="#" title="<?php echo $LDClk4TxtColor ?>" onClick=chgcolor('topfrm_txtcolor')><font size=3 color=<?php echo $topfrm_txtcolor; ?>><?php echo $LDTxtColor ?></font></a>&nbsp;&nbsp;&nbsp;
<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick=chgcolor('topfrm_bgcolor')><?php echo $LDBgColor ?> <img <?php echo createComIcon('../','settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
</a></td>
  </tr>
  <tr>
  
<td bgcolor="<?php echo $bodyfrm_bgcolor; ?>" width=400 ><p><br>
	<FONT    SIZE=4 FACE="Arial">	<a href="#" onClick=chgcolor('bodyfrm_txtcolor')><?php echo $LDMainFrame ?></a><p><FONT    SIZE=1 FACE="Arial">	
	<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick=chgcolor('bodyfrm_bgcolor')><?php echo $LDBgColor ?> <img <?php echo createComIcon('../','settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
	</a><p><br>
</td>
  </tr>
  <tr>
 
    <td bgcolor="<?php echo $botfrm_bgcolor; ?>">
<FONT    SIZE=1  FACE="Arial">
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

<p><a href="#" title="<?php echo $LDClk4BgColor ?>" onClick=chgcolor('botfrm_bgcolor')><?php echo $LDBgColor ?> <img <?php echo createComIcon('../','settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
</a>
</FONT>
</td>
  </tr>
</table>



<FONT    SIZE=-1  FACE="Arial">

<FORM >
<input type="button" value="<?php echo $LDOK ?>" onClick=ok()>
<INPUT type="button"  value="<?php echo $LDCancel ?>" onClick=location.replace("spediens.php?sid=<?php echo "$sid&lang=$lang"; ?>")>
<input type="button" value="<?php echo $LDApply ?>" onClick=location.replace("colorchg.php?mode=remain&sid=<?php echo "$sid&lang=$lang"; ?>")>
<?php if ($cfg['dhtml'])
echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="'.$LDColorOptExt.'" onClick=location.replace("excolorchg.php?sid='.$sid.'&lang='.$lang.'")>';
?>
</FORM></font>
<p>
</ul>



</td>
</tr>

<tr valign=top >
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
