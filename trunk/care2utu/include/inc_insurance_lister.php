<?php
/**
*  A routine to create links to insurances
*  (left list at the 'manage insurances'-menu)
*/

require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$coreObj = new Insurance_tz;

if (!$status)
	$condition = "where deleted != 1";
else
	$condition = "where deleted = 1";

$coreObj->sql="SELECT *  FROM care_tz_insurances_admin $condition order by name asc";

//$coreObj->result = $db->Execute($coreObj->sql);
$result=$db->Execute($coreObj->sql);

while($row=$result->FetchRow())
{
	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";

    if ($insurance_ID == $row['insurance_ID'])
    {
    	$marker = '#006400';
    }
    else $marker = '#000000';

   	echo "<tr bgcolor=$bg ><td>";
	echo "<a href=\"".$root_path."modules/billing_tz/insurance_company_tz_manage.php".URL_APPEND."&insurance_ID" .
			"=".$row['insurance_ID']."&name=".$row['name']."&id_insurer=".$row['insurer']."&max_pay=".$row['max_pay']."&status=".$status."&contact_person" .
			"=".$row['contact_person']."&po_box=".$row['po_box']."&city=".$row['city']."&phone=".$row['phone']."&email=".$row['email']."\">";
	echo '<font color='.$marker.'>'.$row['name'].'</font></a>';
	echo "</td></tr>";
}
?>
