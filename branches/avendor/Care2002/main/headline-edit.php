<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
		
if (($sid==NULL)||($sid!=$ck_sid)||!$ck_editor_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 


//print $lang;

require("../language/".$lang."/lang_".$lang."_editor.php");

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?=$title ?></title>

<script language="javascript">
function chkForm(d)
{
	if(d.title.value=="")
	{
		alert("<?=$LDAlertTitle ?>");
		return false;
	}
	else if(d.newsbody.value=="")
	{
		alert("<?=$LDAlertNews ?>");
		return false;
	}
	else if(d.author.value=="")
	{
		alert("<?=$LDAlertAuthor ?>");
		return false;
	}
	else if(d.publishdate.value=="")
	{
		alert("<?=$LDAlertDate ?>");
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
<form ENCTYPE="multipart/form-data" name="selectform" method="post" action="headline-edit-save.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600" FACE="verdana,Arial">
<b><?=$title ?></b></FONT>
<hr>
<table border=0>
  <tr >
<? if($artopt!=2) : ?>
    <td valign=top><img src="../img/x-blank.gif" border=0 id="headpic" width="150"><br>
  </td>
<? endif ?>
    <td bgcolor="ccffff" colspan=2><FONT FACE="verdana,Arial" color="#0000cc" size=3><b><?=$LDTitleTag ?>:</b><br>
	<font size=1><?=$LDTitleMaxNote ?><br>
	<input type="text" name="newstitle" size=50 maxlength=50><br>
	<FONT FACE="verdana,Arial" color="#0000cc" size=3><b><?=$LDHeader ?>:</b><br>
	<font size=1><?=$LDHeaderMaxNote ?><br>
	<input type="text" name="preface" size=50 maxlength=50><br>
	<FONT FACE="verdana,Arial" color="#0000cc" size=3><b><?=$LDNews ?>:</b><br>
	<textarea name="newsbody" cols=50 rows=14 wrap="physical"></textarea><br>
  	<FONT FACE="verdana,Arial" color="#0000cc" size=2><b><?=$LDPicFile ?>:</b><br>
	<input type="file" name="pic" onChange="showpic(this)" ><br>
  	<FONT FACE="verdana,Arial" color="#0000cc" size=2><b><?=$LDAuthor ?>:</b><br>
	<input type="text" name="author" size=30 maxlength=40><br>
  	<FONT FACE="verdana,Arial" color="#0000cc" size=2><b><?=$LDPublishDate ?>:</b><br>
	<input type="text" name="publishdate" size=10 maxlength=10 onKeyUp="setDate(this)">
 
</td>
<? if($artopt==2) : ?>
    <td valign=top><img src="../img/x-blank.gif" border=0 id="headpic" width="150"><br>
  </td>
<? endif ?>
  </tr>
  <tr>
<? if($artopt!=2) : ?>
    <td align=right >&nbsp;
  </td>
<? endif ?>
    <td ><FONT FACE="verdana,Arial"><br><p>
		<input type="button" value="<?=$LDBackBut ?>" onClick="window.history.back()">&nbsp;&nbsp;
		<input type="button" value="<?=$LDCancelBut ?>"  onClick="window.location.replace('startframe.php?sid=<?="$ck_sid&lang=$lang" ?>')">
  </td>
    <td align=right colspan=2><FONT FACE="verdana,Arial"><br><p>
		<input type="submit" value="<?=$LDContinueBut ?>">
  </td>
<? if($artopt==2) : ?>
    <td align=right >&nbsp;
  </td>
<? endif ?>
  </tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="title" value="<?=$title ?>">
<input type="hidden" name="artnum" value="<?=$artopt ?>">
<input type="hidden" name="mode" value="save">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">

</form>
</body>
</html>
