<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_edv_admin_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_edp.php");

require("../req/config-color.php");

$breakfile="edv.php?sid=$ck_sid&lang=$lang";
setcookie(ck_edvzugang_user,$ck_edv_admin_user);
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? 
require("../req/css-a-hilitebu.php");
?>
<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<? print $cfg['bot_bgcolor'];?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?="$LDEDP $LDSystemAdmin" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<? print $cfg['body_bgcolor'];?> colspan=2>
<br><ul>



<FONT    SIZE=2  FACE="verdana,Arial">
<?=$LDWelcome ?> <FONT    SIZE=3 color=#800000 FACE="Arial"><b><?print $ck_edv_admin_user;?></b></font>. <p>
<?=$LDForeWord ?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../img/varrow-r.gif" width="20" height="15"> <a href="edv-accessplan-edit.php?sid=<?="$ck_sid&lang=$lang&src=sysadmin" ?>"><?="$LDManageAccess - $LDManage" ?></a><br>
<img src="../img/varrow-r.gif" width="20" height="15"> <a href="../phpmyadmin/index.php3?sid=<?="$ck_sid&lang=$lang" ?>"><?=$LDMySQLManage ?></a><br>
<img src="../img/varrow-r.gif" width="20" height="15"> <a href="ucons.php"><?=$LDSpexFunctions ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?=$LDNewsTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?=$LDMemoTxt ?></a><br>
<p>
<FORM action="edv.php">
<input type="hidden" name="sid" value="<?print $ck_sid;?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<INPUT type="submit"  value="<?=$LDCancel ?>"></font></FORM>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?
require("../language/$lang/".$lang."_copyrite.htm");
?>

</FONT>
</BODY>
</HTML>
