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
define('LANG_FILE','editor.php');
$local_user='ck_editor_user';
require_once('../include/inc_front_chain_lang.php');

switch($target)
{
	case "headline":$breakfile="startframe.php?sid=$sid&srcpath=reader&lang=$lang";
							//$title="Schalgzeilen";
							break;

	case "cafenews":$breakfile="cafenews.php?sid=$sid&srcpath=reader&lang=$lang";
							//$title="Schalgzeilen";
							break;

	default:	$breakfile="newscolumns.php?sid=$sid&target=$target&lang=$lang&user_origin=$user_origin&title=$title";

}

?>
<html>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<!-- Creation date: 21.12.2001 -->
<head>
<?php echo setCharSet(); ?>
<title></title>

<script language="javascript">
function chkForm(d)
{
	if((d.artopt[0].checked)||(d.artopt[1].checked)||(d.artopt[2].checked)||(d.artopt[3].checked)||(d.artopt[4].checked)) return true;
		else return false;
}
</script>

</head>
<body>
<form name="selectform" method="get" action="editor-4plus1.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600" FACE="verdana,Arial">
<b><?php echo $title ?></b></FONT>
<hr>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0') ?>></td>
    <td colspan=2><FONT FACE="verdana,Arial"><FONT  SIZE=5 COLOR="#000066" FACE="verdana,Arial"><?php echo $LDWhereTo ?></font><br>
			<font size=2><?php echo $LDPlsSelect ?></td>
  </tr>
  <tr>
    <td bgcolor="ccffff" colspan=3><FONT FACE="verdana,Arial"><p>
		<img <?php echo createComIcon('../','healthtips.jpg','0','right') ?>>		
		<input type="radio" name="artopt" value="1"> <a href="#" onClick="document.selectform.artopt[0].checked=true"><?php echo $LDArticle1 ?></a><br>
    	<input type="radio" name="artopt" value="2"> <a href="#" onClick="document.selectform.artopt[1].checked=true"><?php echo $LDArticle2 ?></a><br>
    	<input type="radio" name="artopt" value="3"> <a href="#" onClick="document.selectform.artopt[2].checked=true"><?php echo $LDArticle3 ?></a><br>
    	<input type="radio" name="artopt" value="4"> <a href="#" onClick="document.selectform.artopt[3].checked=true"><?php echo $LDArticle4 ?></a><br>
     	<input type="radio" name="artopt" value="5"> <a href="#" onClick="document.selectform.artopt[4].checked=true"><?php echo $LDArticle5 ?></a><br><p>
</td>
  </tr>
  <tr>
     <td >
	<a href="javascript:window.history.back()"><img <?php echo createLDImgSrc('../','back2.gif','0') ?>></a>
<input type="image" <?php echo createLDImgSrc('../','continue.gif','0') ?>>
  </td>
    <td align=right >
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>></a>
  </td>
 </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">
<input type="hidden" name="user_origin" value="<?php echo $user_origin ?>">
<input type="hidden" name="title" value="<?php echo $title ?>">

</form>
</body>
</html>
