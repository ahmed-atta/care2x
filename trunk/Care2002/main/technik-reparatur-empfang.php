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
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');
$breakfile='technik.php?sid='.$sid.'&lang='.$lang;

 if($repair=='ask') 
 {
 	$target=$LDRequest;
	$returnfile='technik-reparatur-anfordern.php?sid='.$sid.'&lang='.$lang;
 }
 else
 {
  $target=$LDReport;
  $returnfile='technik-reparatur-melden.php?sid='.$sid.'&lang='.$lang;
 }

/* Load date formatter */
include_once('../include/inc_date_format_functions.php');


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

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
require('../include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td colspan=2 bgcolor=<?php echo $cfg['body_bgcolor']; ?>>
 
<FONT    SIZE=4  FACE="Arial" >
<ul>
<b><?php echo $LDAck ?></b></FONT><p>
</ul>

<p>
<table align="center"  cellpadding="15"  border="0">
<tr>
<td>
<img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align=left>
</td>
<td bgcolor=#fefefe>
<FONT    SIZE=2  FACE="Verdana,Arial" color="#990000">
<?php echo $LDThanksSir ?> <b><?php echo("$reporter") ?></b>. <p>
<?php echo $LDYour ?> <?php echo $target ?> <?php echo $LDReceived ?> <b><?php echo formatDate2Local($tdate,$date_format); ?></b> <?php echo $LDAt ?>   <b><?php echo convertTimeToLocal($ttime); ?></b> 
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
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-reparatur-anfordern.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDReRepairTxt ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-reparatur-melden.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDRepairReportTxt ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-questions.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDQuestionsTxt ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-info.php?sid=<?php echo "$sid&lang=$lang" ?>"> <?php echo $LDInfoTxt ?></a><br>
</FONT>
</ul>
<p>
<HR>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</td>
</tr>
</table>        
</BODY>
</HTML>
