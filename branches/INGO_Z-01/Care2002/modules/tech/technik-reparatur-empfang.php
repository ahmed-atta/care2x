<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
$breakfile='technik.php'.URL_APPEND;
$returnfile=$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND;
$HTTP_SESSION_VARS['sess_file_return']='technik.php';

if($repair=='ask'){
 	$target=$LDRequest;
	$returnfile='technik-reparatur-anfordern.php?sid='.$sid.'&lang='.$lang;
}else{
  $target=$LDReport;
  $returnfile='technik-reparatur-melden.php?sid='.$sid.'&lang='.$lang;
}

# Load date formatter
require_once($root_path.'include/inc_date_format_functions.php');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0  cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"  height="10"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('tech_ack.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align=left>
</td>
<td bgcolor=#fefefe>
<FONT    SIZE=2  FACE="Verdana,Arial" color="#990000">
<?php echo $LDThanksSir ?> <b><?php echo("$reporter") ?></b>. <p>
<?php echo $LDYour ?> <?php echo $target ?> <?php echo $LDReceived ?> <b><?php echo formatDate2Local($tdate,$date_format); ?></b> <?php echo $LDAt ?>   <b><?php echo convertTimeToLocal($ttime); ?></b> 
<p>
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
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-reparatur-anfordern.php<?php echo URL_APPEND ?>"><?php echo $LDReRepairTxt ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-reparatur-melden.php<?php echo URL_APPEND ?>"><?php echo $LDRepairReportTxt ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-questions.php<?php echo URL_APPEND ?>"><?php echo $LDQuestionsTxt ?></a><br>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-info.php<?php echo URL_APPEND ?>"> <?php echo $LDInfoTxt ?></a><br>
 --></FONT>
</ul>
<p>


<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</td>
</tr>
</table>        
</BODY>
</HTML>
