<?
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
Beta version 1.0    2002-05-10
GNU GPL. For details read file "copy_notice.txt".
*/
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (($sid==NULL)||($sid!=$ck_sid)||!$ck_editor_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_editor.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<b><?=$title ?></b></FONT>
<hr>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td colspan=2><FONT FACE="verdana,Arial"><FONT  SIZE=5 COLOR="#000066" FACE="verdana,Arial"><?=$LDWhereTo ?></font><p>
			<font size=2><?=$LDPlsSelect ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="ccffff"><FONT FACE="verdana,Arial"><p><br>
<!-- 		&nbsp;&nbsp;&nbsp;&nbsp;<?=$LDArticle1 ?><br>
		<input type="hidden" name="artopt" value="">
 -->    	
 		<input type="radio" name="artopt" value="1"> <a href="#" onClick="document.selectform.artopt[0].checked=true"><?=$LDArticle1 ?></a><br>
 		<input type="radio" name="artopt" value="2"> <a href="#" onClick="document.selectform.artopt[1].checked=true"><?=$LDArticle2 ?></a><br>
    	<input type="radio" name="artopt" value="3"> <a href="#" onClick="document.selectform.artopt[2].checked=true"><?=$LDArticle3 ?></a><br><p>
  </td>
    <td><img src="../img/<?="$lang/$lang" ?>_headline.jpg" border=0 width=320 ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td ><FONT FACE="verdana,Arial">
		<input type="button" value="<?=$LDBackBut ?>" onClick="window.history.back()">&nbsp;&nbsp;
		<input type="button" value="<?=$LDCancelBut ?>"  onClick="window.location.replace('startframe.php?sid=<?="$ck_sid&lang=$lang" ?>')">
  </td>
    <td align=right ><FONT FACE="verdana,Arial">
		<input type="submit" value="<?=$LDContinueBut ?>">
  </td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="title" value="<?=$title ?>">
<hr>
<? 
require("../language/$lang/".$lang."_copyrite.htm");
?>
</form>
</body>
</html>
