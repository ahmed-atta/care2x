<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

$thisfile=basename(__FILE__);
$searchmask_bgcolor="#f3f3f3";
$searchprompt=$LDEnterSearchKeyword;

$quicklistmaxnr=10; // The maximum number of quicklist popular items

$sql='';

if(!isset($mode)) $mode='';

if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');

if(isset($target)) {
   switch ($target)
	{
	    case 'insurance' :   
		                            $sql='SELECT name AS insurance_firm_name,firm_id AS insurance_firm_id,use_frequency FROM care_insurance_firm WHERE ';
									if($mode=='search') {
									    $sql.='name LIKE "'.$searchkey.'%" OR firm_id LIKE "'.$searchkey.'%"';
									} else {
									    $sql.=' 1 ORDER BY use_frequency DESC LIMIT '.$quicklistmaxnr;
									}
		                            $title=$LDSearch.' :: '.$LDInsuranceCo;
									$itemname=$LDInsuranceCo;
							        break;
									
		case 'citytown' :    $sql='SELECT name AS `aufnahmeform.addr_citytown_name`,nr AS `aufnahmeform.addr_citytown_nr`,use_frequency FROM care_address_citytown WHERE ';
		                            if($mode=='search') {
									    $sql.='name LIKE "'.$searchkey.'%" OR unece_locode LIKE "'.$searchkey.'%"';
									} else {
									    $sql.=' 1 ORDER BY use_frequency DESC LIMIT '.$quicklistmaxnr;
									}
									    
		                            $title=$LDSearch.' :: '.$LDAddress.' ('.$LDTownCity.')';
									$itemname=$LDTownCity;
							        break;
		case 'immunization' :    $sql='SELECT name AS `reportform.type`, medecin AS `reportform.medicine`, dosage AS `reportform.dosage`, titer AS `reportform.titer`, application AS `reportform.application_type_nr`, (CURDATE() + INTERVAL period DAY) as `reportform.refresh_date`, 0 AS use_frequency FROM care_type_immunization WHERE ';
		                            if($mode=='search') {
									    $sql.='name LIKE "'.$searchkey.'%" OR unece_locode LIKE "'.$searchkey.'%"';
									} else {
									    $sql.=' 1 ORDER BY name DESC LIMIT '.$quicklistmaxnr;
									}
									    
		                            $title=$LDSearch.' :: '.$LDImmunization.' ('.$LDImmunization.')';
									$itemname=$LDImmunization;
							        break;

	}

	if($result=$db->Execute($sql))	{ 
		$linecount=$result->RecordCount();
		$sql_value=$result->getarray();
					}

}

/* Set color values for the search mask */
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#66ee66';
$entry_body_bgcolor='#ffffff';
?><?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo $title ?></title>


<script language="javascript">
<!-- Script Begin
function setValue(val) {
	mywin=parent.window.opener;
	var array_val= val.split("|");
	<?php
	$var_parent_document=array_keys($sql_value[0]);
	$indice=0;
	for($i3=1;$i3<sizeof($var_parent_document)-1;$i3=$i3+2) 
		{ 
		echo 'mywin.document.'.$var_parent_document[$i3].'.value=array_val['.$indice.']; '; 
		$indice++;
		};
	?>
	this.window.close();
	mywin.focus();
}


//  Script End -->
</script>
</head>
<body><font face=arial>

<font size=3><b><?php echo $title ?></b></font>

		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
<?php   
include($root_path.'include/inc_patient_searchmask.php');

?>
</td>
     </tr>
   </table>
   
<?php
if($mode=='search')  {    
    if(!$linecount) $linecount=0;
    echo '<hr width=80% align=left>'.str_replace("~nr~",$linecount,$LDSearchFoundData).'<p>';
} else {
    echo '<hr width=80% align=left><font size=4 color="#990000">'.$LDTop.' '.$quicklistmaxnr.' '.$LDQuickList.'</font>';
}
    
    //echo $mode;
    if ($linecount) 
	{ 
         $count=0;
	 					echo '
						<table border=0 cellpadding=2 cellspacing=1> 
						<tr bgcolor="#66ee66" background="'.$root_path.'gui/img/common/default/tableHeaderbg.gif">';

						echo'
						<td><font face=arial size=2 color="#336633"><b>'.$itemname.'</b></td>';
		
						echo'
						<td><font face=arial size=2 color="#336633">&nbsp;</td>';

					echo "</tr>";
					$sql_value_without_key=array_values($sql_value);
					for($i=0;$i<sizeof($sql_value);$i++)
					{
					    if(($mode!='search')&&($count==$quicklistmaxnr)) break;
						    else $count++;
							
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo "<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($sql_value[$i][0]);
						// Creation du tableau export vers java
						$sql_value_java=array_values($sql_value_without_key[$i]);
						// Elimination des doublons
						for($i2=0;$i2<=sizeof($sql_value_java);$i2=$i2+2) {
							unset($sql_value_java[$i2]); };
						$sql_java_string=implode("|", $sql_value_java);
						echo "</td>";
						echo "<td><font face=arial size=2>";
						echo '<a href="javascript:setValue(\''.$sql_java_string.'\')">';
						echo '<img '.createLDImgSrc($root_path,'ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
						echo '</td></tr>';
					}
					echo "
						</table>";
					if($mode=='search' && $linecount>15)
					{
?>
         <p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchform_count=2;
            include($root_path.'include/inc_patient_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>
<?php
					}
    }


?>

</font>
</body>
</html>
