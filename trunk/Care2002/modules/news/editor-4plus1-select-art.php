<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_editor_user';
require_once($root_path.'include/inc_front_chain_lang.php');
/* Set the new return file for the preview page */
$HTTP_SESSION_VARS['sess_file_return']=$top_dir.basename(__FILE__);

$breakfile='newscolumns.php'.URL_APPEND;
$returnfile='editor-pass.php'.URL_APPEND;
$title=$HTTP_SESSION_VARS['sess_title'];
?>
<?php html_rtl($lang); ?>
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

<?php require($root_path.'include/inc_css_a_hilitebu.php'); ?>

</head>
<body>
<form name="selectform" method="get" action="editor-4plus1.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600">
<b><?php echo $title ?></b></FONT>
<hr>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0') ?>></td>
    <td colspan=2><FONT  SIZE=5 COLOR="#000066"><?php echo $LDWhereTo ?></font><br>
			<?php echo $LDPlsSelect ?></td>
  </tr>
  <tr>
    <td class="submenu" colspan=3><p>
		<img <?php echo createComIcon($root_path,'healthtips.jpg','0','right',TRUE) ?>>
		<input type="radio" name="artopt" value="1"> <a href="#" onClick="document.selectform.artopt[0].checked=true"><?php echo $LDArticle1 ?></a><br>
    	<input type="radio" name="artopt" value="2"> <a href="#" onClick="document.selectform.artopt[1].checked=true"><?php echo $LDArticle2 ?></a><br>
    	<input type="radio" name="artopt" value="3"> <a href="#" onClick="document.selectform.artopt[2].checked=true"><?php echo $LDArticle3 ?></a><br>
    	<input type="radio" name="artopt" value="4"> <a href="#" onClick="document.selectform.artopt[3].checked=true"><?php echo $LDArticle4 ?></a><br>
     	<input type="radio" name="artopt" value="5"> <a href="#" onClick="document.selectform.artopt[4].checked=true"><?php echo $LDArticle5 ?></a><br><p>
</td>
  </tr>
  <tr>
     <td >
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<input type="image" <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>>
  </td>
    <td align=right >
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
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
