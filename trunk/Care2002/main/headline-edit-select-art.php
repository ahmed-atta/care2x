<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.03 - 2002-10-26 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','editor.php');
$local_user='ck_editor_user';
require_once('../include/inc_front_chain_lang.php');
$breakfile="startframe.php?sid=".$sid."&lang=".$lang;
?>
<html>
<head>
<?php echo setCharSet(); ?>
<title></title>

<script language="javascript">
function chkForm(d)
{
	if((d.artopt[0].checked)||(d.artopt[1].checked)||(d.artopt[2].checked)) return true;
		else return false;
}
</script>

</head>
<body>
<form name="selectform" method="get" action="headline-edit.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600" FACE="verdana,Arial">
<b><?php echo $title ?></b></FONT>
<hr>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0') ?>></td>
    <td colspan=2><FONT FACE="verdana,Arial"><FONT  SIZE=5 COLOR="#000066" FACE="verdana,Arial"><?php echo $LDWhereTo ?></font><p>
			<font size=2><?php echo $LDPlsSelect ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="ccffff"><FONT FACE="verdana,Arial"><p><br>
<!-- 		&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $LDArticle1 ?><br>
		<input type="hidden" name="artopt" value="">
 -->    	
 		<input type="radio" name="artopt" value="1"> <a href="#" onClick="document.selectform.artopt[0].checked=true"><?php echo $LDArticle1 ?></a><br>
 		<input type="radio" name="artopt" value="2"> <a href="#" onClick="document.selectform.artopt[1].checked=true"><?php echo $LDArticle2 ?></a><br>
    	<input type="radio" name="artopt" value="3"> <a href="#" onClick="document.selectform.artopt[2].checked=true"><?php echo $LDArticle3 ?></a><br><p>
  </td>
    <td><img <?php echo createLDImgSrc('../','headline.jpg') ?>></td>
  </tr>
  <tr>
    <td>
		<a href="javascript:window.history.back()"><img <?php echo createLDImgSrc('../','back2.gif','0') ?>></a>
	</td>
    <td >
<input type="image" <?php echo createLDImgSrc('../','continue.gif','0') ?>>
  </td>
    <td align=right >
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>></a>
 </td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="title" value="<?php echo $title ?>">
<hr>
<?php 
require("../language/$lang/".$lang."_copyrite.php");
?>
</form>
</body>
</html>
