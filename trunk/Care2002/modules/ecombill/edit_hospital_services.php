<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//define('NO_CHAIN',1);
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

    if($service=='HS')
    	$qryLT="SELECT * FROM care_billing_item WHERE item_type='HS'";
    if($service=='LT')
    	$qryLT="SELECT * FROM care_billing_item WHERE item_type='LT'";
		
    $resultqryLT=$db->Execute($qryLT);
	
    if(is_object($resultqryLT)){
		$cntLT=$resultqryLT->RecordCount();
	}

$breakfile='billingmenu.php'.URL_APPEND;
	
?>

<html>
<head>
<title><?php if($service=='LT')echo "Edit Laboratory Tests";?><?php if($service=='HS')echo "Edit Hospital Services";?></title>
<SCRIPT language="JavaScript">
<!--
function submitform()
{
	document.editservice.action ="posteditservice.php";
	document.editservice.submit();
}

//-->
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong>eComBill-
          <?php if($service=='LT')echo "Edit Laboratory Test Items";if($service=='HS')echo "Edit Hospital Service Items"; ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  <p>
  <form name="editservice" id="editservice" method="POST" action="">
    <p>
	 <div align="center">
      <center>
      <table cellSpacing="1" cellPadding="3" width="450" bgColor="#999999" border="0" height="138">
<?php
	echo "<tr bgColor=\"#eeeeee\">";
	echo "<td align=\"left\" height=\"73\" width=\"7666\" colspan=\"6\"><font size=\"5\" color=\"#FF0000\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if($service=='LT')echo "Laboratory Test Items";?><?php if($service=='HS')echo "Hospital Service Items";
	echo "<p><font color=\"#800000\" size=\"4\">";
	
	echo "</font></td>";
	echo "<tr bgColor=\"#eeeeee\">";
	
	echo "<th height=\"7\" width=\"826\" align=\"center\" bgcolor=\"#CCCCCC\">Test code</th>";
	echo "<th align=\"center\" height=\"7\" width=\"1014\" bgcolor=\"#CCCCCC\">Test Name&nbsp;</th>";
	echo "<th height=\"7\" width=\"643\" align=\"center\" bgcolor=\"#CCCCCC\">Cost per unit</th>";
	echo "<th height=\"7\" width=\"484\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">Discount</th>";
	//echo "<th height=\"7\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\"></th>";
	for($cnt=0;$cnt<$cntLT;$cnt++)
	{
		$itemdetails="";
		$result=$resultqryLT->FetchRow();
		echo "</tr>";
		echo "<tr bgColor=\"#eeeeee\">";
		echo "<td height=\"7\" width=\"846\" align=\"center\">".$result['item_code'];
		echo "</td>";
		echo "<td align=\"center\" height=\"7\" width=\"1014\">";
		echo "<input tupe=\"text\" name=\"itemnm.$cnt\" size=\"15\" value=\"".$result['item_description']."\">";
		echo "</td>";		
		echo "<td height=\"7\" width=\"623\" align=\"center\">";
		echo "<input tupe=\"text\" name=\"itemcs.$cnt\" size=\"7\" value=\"".$result['item_unit_cost']."\">";
		echo "</td>";
		echo "<td height=\"7\" width=\"484\" align=\"center\" valign=\"middle\">";
		echo "<input tupe=\"text\" name=\"itemdc.$cnt\" size=\"3\" value=\"".$result['item_discount_max_allowed']."\">";
		//echo "</td>";
		//echo "<td align=\"center\" height=\"7\" width=\"133\"><input type=\"button\" name=\"selectitem.$cnt\" value=\"EDIT\"></td>";
		//echo "</tr>";		
		if($cnt != ($cntLT-1))
		{
			echo "<tr bgColor=\"#dddddd\" height=\"1\">";
			echo "<td height=\"5\" width=\"7666\" colspan=\"6\"><img height=\"1\" src=\"pics/hor_bar.bmp\" width=\"5\"></td>";
			echo "</tr>";
		}
		$itemcd=$result['item_code'];
		$itemcd1=$itemcd1.$itemcd;
		$itemcd1=$itemcd1."#";		
		
        }
      $itemcd=$itemcd1;
?>
<input type="hidden" name="itemcd" value="<?php echo $itemcd; ?>"> 
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
      </table>
    	<p>&nbsp;&nbsp;&nbsp;</p>
   		<!--  <input type="button" onclick="javascript:submitform();" value="Save" name="B1"> --></p>
		<a href="javascript:submitform();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0'); ?>></a>      </center>
    </div>
    
    <p>&nbsp;</p>
  </form>
</blockquote>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

