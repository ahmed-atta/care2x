<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_cafenews_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/* Set navigation paths for this page*/
$breakfile=$HTTP_SESSION_VARS['sess_file_break'].URL_APPEND;
/* Set the new return file for the suceeding page */
$HTTP_SESSION_VARS['sess_file_return']=basename(__FILE__);
$HTTP_SESSION_VARS['sess_file_return']='cafenews-edit-select-art.php';

$returnfile='cafenews-edit-select-art.php'.URL_APPEND;

/* Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');

$title=$HTTP_SESSION_VARS['sess_title'];
?>
<html>
<head>
<?php echo setCharSet(); ?>
<title></title>

<script language="javascript">
function chkForm(d)
{
	if(d.newstitle.value=="")
	{
		alert("<?php echo $LDAlertTitle ?>");
		return false;
	}
	else if(d.newsbody.value=="")
	{
		alert("<?php echo $LDAlertNews ?>");
		return false;
	}
	else if(d.author.value=="")
	{
		alert("<?php echo $LDAlertAuthor ?>");
		return false;
	}
	else if(d.publishdate.value=="")
	{
		alert("<?php echo $LDAlertDate ?>");
		return false;
	}
	else return true;
		
}

function showpic(d)
{
	if(d.value) document.images.headpic.src=d.value;
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

</script>

<script language="javascript" src="<?php echo $root_path ?>js/checkdate.js" type="text/javascript"></script>

<script language="javascript" src="<?php echo $root_path ?>js/setdatetime.js"></script>
</head>
<body onLoad="document.selectform.newstitle.focus()">
<form ENCTYPE="multipart/form-data" name="selectform" method="post" action="cafenews-edit-save.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600" FACE="verdana,Arial">
<img <?php echo createComIcon($root_path,'basket.gif','0') ?>> <b><?php echo $title ?></b></FONT>
<hr>
<table border=0>
  <tr >
<?php if($artopt!=2) : ?>
    <td valign=top><img <?php echo createLDImgSrc($root_path,'x-blank.gif','0') ?> id="headpic"><br>
  </td>
<?php endif ?>
    <td bgcolor="ccffff" colspan=2><FONT FACE="verdana,Arial" color="#0000cc" size=3><b><?php echo $LDTitleTag ?>:</b><br>
	<font size=1><?php echo $LDTitleMaxNote ?><br>
	<input type="text" name="newstitle" size=50 maxlength=50><br>
	<FONT FACE="verdana,Arial" color="#0000cc" size=3><b><?php echo $LDHeader ?>:</b><br>
	<font size=1><?php echo $LDHeaderMaxNote ?><br>
	<input type="text" name="preface" size=50 maxlength=50><br>
	<FONT FACE="verdana,Arial" color="#0000cc" size=3><b><?php echo $LDNews ?>:</b><br>
	<textarea name="newsbody" cols=50 rows=14 wrap="physical"></textarea><br>
  	<FONT FACE="verdana,Arial" color="#0000cc" size=2><b><?php echo $LDPicFile ?>:</b><br>
	<input type="file" name="pic" onChange="showpic(this)" ><br>
<input type="button" value="<?php echo $LDPreviewPic ?>" onClick="showpic(document.selectform.pic)"><br>
  	<FONT FACE="verdana,Arial" color="#0000cc" size=2><b><?php echo $LDAuthor ?>:</b><br>
	<input type="text" name="author" size=30 maxlength=40><br>
  	<FONT FACE="verdana,Arial" color="#0000cc" size=2><b><?php echo $LDPublishDate ?>:</b><br>
	<!-- <input type="text" name="publishdate" size=10 maxlength=10 onKeyUp="setDate(this)"> -->
 	<input type="text" name="publishdate" size=10 maxlength=10 onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
  [ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ]
</td>
<?php if($artopt==2) : ?>
    <td valign=top><img <?php echo createLDImgSrc($root_path,'x-blank.gif','0') ?> id="headpic" ><br>
  </td>
<?php endif ?>
  </tr>
  <tr>
<?php if($artopt!=2) : ?>
    <td align=right >
	<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
  </td>
<?php endif ?>
    <td >
<?php if($artopt==2) : ?>
	<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<?php endif ?>
<input type="image" <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>>
  </td>
    <td>
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
  </td>
<?php if($artopt==2) : ?>
    <td align=right >&nbsp;
  </td>
<?php endif ?>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="title" value="<?php echo strtr($title," ","+") ?>">
<input type="hidden" name="artnum" value="<?php echo $artopt ?>">
<input type="hidden" name="mode" value="save">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000">

</form>
</body>
</html>
