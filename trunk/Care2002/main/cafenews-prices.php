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

$dbtable="cafe_prices_".$lang;
require("../include/inc_db_makelink.php");
 if ($link&&$DBLink_OK)
 {
		 	$sql="SELECT * FROM $dbtable WHERE productgroup<>'' ORDER BY productgroup";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $prod=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
				}
			}
  } else { print "$LDDbNoLink<br> $sql<br>"; }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>
<script language="javascript" >
function editcafe()
{

		if(confirm("<?php echo $LDConfirmEdit ?>"))
		{
			window.location.href="cafenews-edit-pass.php?sid=<?php echo "$sid&lang=$lang&title=$LDCafeNews" ?>";
			return false;
		}

}
</script>
</head>
<body>
<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img src="../img/basket.gif" width=74 height=70 border=0></a> <b><?php echo $LDCafePrices ?></b></FONT>
<hr>

<?php if($rows) : ?>
<table border=0 cellspacing=0>
  <tr bgcolor="ccffff" >
    <td><FONT  SIZE=2  FACE="verdana,Arial"><b><?php echo $LDProdName ?></b></td>
    <td><FONT  SIZE=2  FACE="verdana,Arial"><b><?php echo $LDPriceDM ?></b></td>
    <td align=right>&nbsp;
	</td>    
	 <td><FONT  SIZE=2  FACE="verdana,Arial">&nbsp;<b><?php echo $LDPriceEuro ?></b></td>
  </tr>
  <?php 

for($i=0;$i<$rows;$i++)
{
	$prod=mysql_fetch_array($ergebnis);
	if($prodg!=$prod[productgroup])
	{
		$prodg=$prod[productgroup];
		print '
 			<tr bgcolor="ccffff">
    		<td><FONT  SIZE=2  FACE="verdana,Arial" color="#0000cc"><b>'.$prod[productgroup].'</b>
        	</td>
  			</tr>';
	}
print '
 <tr bgcolor="ccffff" >
    <td><FONT  SIZE=2  FACE="verdana,Arial">&nbsp;&nbsp;&nbsp;'.$prod[article].'
        </td>
    <td align=right><FONT  SIZE=2  FACE="verdana,Arial">'.$prod[price_dm].'
	</td>
    <td align=right>&nbsp;
	</td>
    <td>&nbsp;<FONT  SIZE=2  FACE="verdana,Arial">'.$prod[price_euro].'
 	</td>
  </tr>';
 }

?>
 </table>
<?php else : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td colspan=2><FONT FACE="verdana,Arial"><FONT  SIZE=4 COLOR="#000066" FACE="verdana,Arial"><?php echo $LDNoPrice ?></font><p>
			<font size=2><?php echo $LDSorry ?>
                                                    </td>
  </tr>
</table>
<?php endif ?> 
<FONT  SIZE=2  FACE="verdana,Arial">
 <p><br><a href="cafenews.php?sid=<?php echo "$sid&lang=$lang" ?>"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0 align=absmiddle> <?php echo $LDBack2CafeNews ?></a>
</body>
</html>
