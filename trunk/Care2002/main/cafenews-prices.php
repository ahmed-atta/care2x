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
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

$dbtable="care_cafe_prices";
/* Establish db connection */
require('../include/inc_db_makelink.php');
if ($link&&$DBLink_OK)
{
	$sql="SELECT * FROM $dbtable WHERE productgroup<>''";

	 if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
     {
	     $sql.="' AND lang='".$lang."'";
     }
			 
	$sql.=" ORDER BY productgroup";

	
    if($ergebnis=mysql_query($sql,$link))
    {
		$rows=mysql_num_rows($ergebnis);
	}
	
    $sql="SELECT short_name, long_name FROM care_currency WHERE status='main'";
	if($c_result=mysql_query($sql,$link))
	{
	   if(mysql_num_rows($c_result))
	   {
	      $currency=mysql_fetch_array($c_result);
		  $currency_short=$currency['short_name'];
		  $currency_long=$currency['long_name'];
	   } // else get default from ini file
	} // else get default from ini file
} 
 else 
  { echo "$LDDbNoLink<br> $sql<br>"; }
?>
<html>
<head>
<?php echo setCharSet(); ?>
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
<a href="javascript:editcafe()"><img <?php echo createComIcon('../','basket.gif','0') ?>></a> <b><?php echo $LDCafePrices ?></b></FONT>
<hr>

<?php if($rows) : ?>
<table border=0 cellspacing=0>
  <tr bgcolor="ccffff" >
    <td><FONT  SIZE=2  FACE="verdana,Arial"><b><?php echo $LDProdName ?></b></td>
    <td align=right>&nbsp;
	</td>    
	 <td><FONT  SIZE=2  FACE="verdana,Arial">&nbsp;<b><?php echo $LDPrice." ".$currency_short." ".$currency_long ?></b></td>
  </tr>
  <?php 

for($i=0;$i<$rows;$i++)
{
	$prod=mysql_fetch_array($ergebnis);
	if($prodg!=$prod[productgroup])
	{
		$prodg=$prod[productgroup];
		echo '
 			<tr bgcolor="ccffff">
    		<td><FONT  SIZE=2  FACE="verdana,Arial" color="#0000cc"><b>'.$prod['productgroup'].'</b>
        	</td>
  			</tr>';
	}
echo '
 <tr bgcolor="ccffff" >
    <td><FONT  SIZE=2  FACE="verdana,Arial">&nbsp;&nbsp;&nbsp;'.$prod['article'].'
        </td>
    <td align=right>&nbsp;
	</td>
    <td>&nbsp;<FONT  SIZE=2  FACE="verdana,Arial">'.$prod['price'].'
 	</td>
  </tr>';
 }

?>
 </table>
<?php else : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0') ?>></td>
    <td colspan=2><FONT FACE="verdana,Arial"><FONT  SIZE=4 COLOR="#000066" FACE="verdana,Arial"><?php echo $LDNoPrice ?></font><p>
			<font size=2><?php echo $LDSorry ?>
                                                    </td>
  </tr>
</table>
<?php endif ?> 
<FONT  SIZE=2  FACE="verdana,Arial">
 <p><br><a href="cafenews.php?sid=<?php echo "$sid&lang=$lang" ?>"><img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?> align=absmiddle> <?php echo $LDBack2CafeNews ?></a>
</body>
</html>
