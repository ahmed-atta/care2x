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
define("LANG_FILE","tech.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");
$breakfile="technik.php?sid=$sid&lang=$lang";

 if($repair=="ask") 
 {
 	$target=$LDRequest;
	$returnfile="technik-reparatur-anfordern.php?sid=$sid&lang=$lang";
 }
 else
 {
  $target=$LDReport;
  $returnfile="technik-reparatur-melden.php?sid=$sid&lang=$lang";
 }
 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript" >
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
<?php 
require("../include/inc_css_a_hilitebu.php");
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td colspan=2 bgcolor=<?php print $cfg['body_bgcolor']; ?>>
 
<FONT    SIZE=4  FACE="Arial" >
<ul>
<b><?php echo $LDAck ?></b></FONT><p>
</ul>

<p>
<table align="center"  cellpadding="15"  border="0">
<tr>
<td>
<img src="../img/catr.gif" border=0 width=88 height=80 align=left>
</td>
<td bgcolor=#fefefe>
<FONT    SIZE=2  FACE="Verdana,Arial" color="#990000">
<?php echo $LDThanksSir ?> <b><?php print("$reporter") ?></b>. <p>
<?php echo $LDYour ?> <?php echo $target ?> <?php echo $LDReceived ?> <b><?php print($tdate); ?></b> <?php echo $LDAt ?>   <b><?php print($ttime); ?></b> 
<?php echo $LDAtTech ?>
</td>

</tr>

</table>
<p>
<center>

<FORM action="<?php echo $returnfile ?>" >
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<INPUT type="submit"  value="  OK  "></font></FORM>

</center>


</FONT>
<ul>
<p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-reparatur-anfordern.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDReRepairTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-reparatur-melden.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDRepairReportTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-questions.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDQuestionsTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-info.php?sid=<?php echo "$sid&lang=$lang" ?>"> <?php echo $LDInfoTxt ?></a><br>
</FONT>
</ul>
<p>
<HR>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</td>
</tr>
</table>        
</BODY>
</HTML>
