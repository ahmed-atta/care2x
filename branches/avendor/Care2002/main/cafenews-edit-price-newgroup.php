<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_editor.php");

if(($groupname)&&($mode=="save"))
{
	$dbtable="cafe_prices_".$lang;

	include("../req/db-makelink.php");
 	if ($link&&$DBLink_OK)
 	{

		 	$sql="INSERT INTO $dbtable (article,description) VALUES ('$groupname','group')";

			if($ergebnis=mysql_query($sql,$link))
       		{
				header("Location: cafenews-edit-price.php?sid=$ck_sid&lang=$lang&mode=saved_newgroup&groupname=$groupname"); exit;
			}
				else print "<p>".$sql."<p>$LDDbNoSave"; 

  	} else { print "$LDDbNoLink<br> $sql<br>"; }
}

?>
<html>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<!-- Creation date: 21.12.2001 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>


<script language="javascript">
function chkForm(d)
{
	if(d.groupname.value) return true;
		else return false;
}
</script>


</head>
<body>
<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img src="../img/basket.gif" width=74 height=70 border=0></a> <b><?=$LDCafePrices ?></b></FONT>
<hr>
<form name="selectform" action="cafenews-edit-price-newgroup.php" onSubmit="return chkForm(this)">
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td colspan=2><FONT  SIZE=4 COLOR="#000066" FACE="verdana,Arial">
			<?=$LDEnterGroup ?>
	</td>
  </tr>

    <td>&nbsp;</td>
    <td bgcolor="ccffff" colspan=2><FONT FACE="verdana,Arial">
		&nbsp;<?=$LDProdGroup ?>:<br>
		&nbsp;<input type="text" name="groupname" size=40 maxlength=40>
  <br><p>
  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p><br>
		<input type="button" value="<?=$LDBackBut ?>" onClick="window.history.back()">&nbsp;&nbsp;&nbsp;
        <input type="button" value="<?=$LDCancelBut ?>" onClick="window.location.replace('cafenews.php?sid=<?="$ck_sid&lang=$lang" ?>')"></td>
    <td align=right><p><br><FONT FACE="verdana,Arial">
		<input type="submit" value="<?=$LDContinueBut ?>">
  </td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="mode" value="save">
</form></body>
</html>
