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
define("LANG_FILE","editor.php");
$local_user="ck_editor_user";
require("../include/inc_front_chain_lang.php");

switch($target)
{
	case "headline":$breakfile="startframe.php?sid=$sid&lang=$lang";
							//$title="Schalgzeilen";
							break;
	case "cafenews":$breakfile="cafenews.php?sid=$sid&lang=$lang";
							//$title="Schalgzeilen";
							break;
	/*
	case "healthtips":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Gesundheitstips";
							break;
	case "adv_studies":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Fortbildung";
							break;
	case "prof_training":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Ausbildung";
							break;
	case "physiotherapy":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Physiotherapie";
							break;
	case "events":$breakfile="newscolumns.php?sid=$sid&target=$target";
							//$title="Veranstaltungen";
							break;
	*/
	default:	$breakfile="newscolumns.php?sid=$sid&target=$target&lang=$lang&title=$title";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
</script>

<script language="javascript" src="../js/setdatetime.js"></script>

</head>
<body onLoad="document.selectform.newstitle.focus()">
<form ENCTYPE="multipart/form-data" name="selectform" method="post" action="editor-4plus1-save.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600" FACE="verdana,Arial">
<b><?php echo $title ?></b></FONT><font FACE="verdana,Arial" size=3> <?php echo $LDArticleTxt ?> #<?php echo $artopt ?></font>
<hr>
<table border=0>
  <tr >

    <td valign=top><img src="../img/x-blank.gif" border=0 id="headpic" width="150"><br>
  </td>

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
	<input type="text" name="publishdate" size=10 maxlength=10 onKeyUp="setDate(this)">
 
</td>


  </tr>
  <tr>

    <td align=right >&nbsp;
  </td>

     <td ><FONT FACE="verdana,Arial">
	<a href="javascript:window.history.back()"><img src="../img/<?php echo $lang ?>/<?php echo $lang ?>_back2.gif" border=0></a>
	<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo $lang ?>/<?php echo $lang ?>_cancel.gif" border=0></a>
  </td>
    <td align=right ><FONT FACE="verdana,Arial">
<input type="image" src="../img/<?php echo $lang ?>/<?php echo $lang ?>_continue.gif" border=0>
  </td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">
<input type="hidden" name="artnum" value="<?php echo $artopt ?>">
<input type="hidden" name="title" value="<?php echo strtr($title," ","+") ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="save">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000">

</form>
</body>
</html>
