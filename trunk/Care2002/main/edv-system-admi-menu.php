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
define("LANG_FILE","edp.php");
$local_user="ck_edv_user";
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");

$breakfile="edv.php?sid=$sid&lang=$lang";
setcookie(ck_edvzugang_user,$ck_edv_admin_user);
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
require("../include/inc_css_a_hilitebu.php");
?>
<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php print $cfg['bot_bgcolor'];?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDSystemAdmin" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php print $cfg['body_bgcolor'];?> colspan=2>
<br><ul>



<FONT    SIZE=2  FACE="verdana,Arial">
<?php echo $LDWelcome ?> <FONT    SIZE=3 color=#800000 FACE="Arial"><b><?php echo $HTTP_COOKIE_VARS[$local_user.$sid];?></b></font>. <p>
<?php echo $LDForeWord ?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../img/varrow-r.gif" width="20" height="15"> <a href="edv-accessplan-edit.php?sid=<?php echo $sid."&lang=$lang&src=sysadmin" ?>"><?php echo "$LDManageAccess - $LDManage" ?></a><br>
<img src="../img/varrow-r.gif" width="20" height="15"> <a href="../phpmyadmin/index.php3?sid=<?php echo $sid."&lang=$lang" ?>"><?php echo $LDMySQLManage ?></a><br>
<img src="../img/varrow-r.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDSpexFunctions ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDNewsTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDMemoTxt ?></a><br>
<p>
<FORM action="edv.php">
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php print $lang; ?>">
<INPUT type="submit"  value="<?php echo $LDCancel ?>"></font></FORM>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require("../language/$lang/".$lang."_copyrite.php");
?>

</FONT>
</BODY>
</HTML>
