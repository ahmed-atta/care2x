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
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

if(($groupname)&&($mode=="save"))
{
	$dbtable="cafe_prices_".$lang;

	include("../include/inc_db_makelink.php");
 	if ($link&&$DBLink_OK)
 	{

		 	$sql="INSERT INTO $dbtable (article,description) VALUES ('$groupname','group')";

			if($ergebnis=mysql_query($sql,$link))
       		{
				header("Location: cafenews-edit-price.php?sid=$sid&lang=$lang&mode=saved_newgroup&groupname=$groupname"); exit;
			}
				else print "<p>".$sql."<p>$LDDbNoSave"; 

  	} else { print "$LDDbNoLink<br> $sql<br>"; }
}
$breakfile="cafenews.php?sid=$sid&lang=$lang";

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
<a href="javascript:editcafe()"><img src="../img/basket.gif" width=74 height=70 border=0></a> <b><?php echo $LDCafePrices ?></b></FONT>
<hr>
<form name="selectform" action="cafenews-edit-price-newgroup.php" onSubmit="return chkForm(this)">
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td colspan=2><FONT  SIZE=4 COLOR="#000066" FACE="verdana,Arial">
			<?php echo $LDEnterGroup ?>
	</td>
  </tr>

    <td>&nbsp;</td>
    <td bgcolor="ccffff" colspan=2><FONT FACE="verdana,Arial">
		&nbsp;<?php echo $LDProdGroup ?>:<br>
		&nbsp;<input type="text" name="groupname" size=40 maxlength=40>
  <br><p>
  </td>
  </tr>
  <tr>
   <td>&nbsp;</td>
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
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="save">
</form></body>
</html>
