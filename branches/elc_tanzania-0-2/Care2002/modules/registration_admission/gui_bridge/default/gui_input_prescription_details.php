<?php
require_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($pres_obj)) $pres_obj=new Prescription;

$pres_types=$pres_obj->getPrescriptionTypes();


?>
<script language="JavaScript">
function chkform(d) {
	if(isNaN(d.value))
	{
		alert("Please enter a valid numeric value format like '1234', '2' or '2.5'");	
		d.focus();
	}
/*
	return false;
	if(d.prescribe_date.value==""){
		alert("<?php echo $LDPlsEnterDate; ?>");
		d.prescribe_date.focus();
		return false;
	}else if(d.article.value==""){
		alert("<?php echo $LDPlsEnterMedicine; ?>");
		d.article.focus();
		return false;
	}else if(d.dosage.value==""){
		alert("<?php echo $LDPlsEnterDosage; ?>");
		d.dosage.focus();
		return false;
	}else if(d.application_type_nr.value==""){
		alert("<?php echo $LDPlsSelectAppType; ?>");
		d.application_type_nr.focus();
		return false;
	}else if(d.prescriber.value==""){
		alert("<?php echo $LDPlsEnterFullName; ?>");
		d.prescriber.focus();
		return false;
	}else{
		return true;
	}
*/
}
</script>
<form method="POST" name="reportform<?PHP echo $i;?>">
<?PHP
if(!$nr)
{
	$item_array=$_SESSION['item_array'];
}
else
{
	$prescriptionitem = $pres_obj->GetPrescritptionItem($nr);
	$item_array='';
	$item_array[0]= $prescriptionitem['article_item_number'];
	echo '<input type="hidden" value="'.$nr.'" name="nr">';
}
//echo "-->items in array: ".count($item_array)."<br>";#
for ($i=0 ; $i<count($item_array) ; $i++) {
$class = $pres_obj->GetClassOfItem($item_array[$i]);
if($nexttime)
{
	$prescriptionitem['dosage']="";
	$nexttime=false;
}
if($class=='mems_supplies' || $class=='mems_drug_list' || $class=='mems_special_others_list' || $class=='mems_supplies_laboratory')
{
	$caption_dosage = 'Total dose';
}
else
{
	$caption_dosage = 'Amount';
	if(!$prescriptionitem['dosage']) $prescriptionitem['dosage']=1;
	$nexttime=true;
}
?>
<font class="adm_div"><?php echo $pres_obj->GetNameOfItem($item_array[$i]); ?></font>
 <table border=0 cellpadding=2 width=100%>
  
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $caption_dosage; ?></td>
     <td><input type="text" name="arr_dosage[<?PHP echo $i; ?>]" size=50 maxlength=60 value="<?php echo $prescriptionitem['dosage'];?>" onBlur="chkform(this)"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDApplication.' '.$LDNotes; ?></td>
     <td><textarea name="arr_notes[<?PHP echo $i; ?>]" cols=40 rows=3 wrap="physical"><?php echo $prescriptionitem['notes'];?></textarea>
         </td>
   </tr>


   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDPrescribedBy; ?></td>
     <td><input type="text" name="prescriber" size=50 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>" readonly></td>
   </tr>
 </table>
<input type="hidden" name="arr_item_number[<?PHP echo $i; ?>]" value="<?PHP echo $i; ?>">
<input type="hidden" name="arr_article_item_number[<?PHP echo $i; ?>]" value="<?php echo $item_array[$i];?>">
<input type="hidden" name="arr_price[<?PHP echo $i; ?>]" value="<?php echo $pres_obj->GetPriceOfItem($item_no[$i]);?>">
<input type="hidden" name="arr_article[<?PHP echo $i; ?>]" value="<?php echo $pres_obj->GetNameOfItem($item_array[$i]);?>">
<?php
} // end of loop
?>
<input type="hidden" name="encounter_nr" value="<?php echo $HTTP_SESSION_VARS['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<?php
if(!$nr)
	echo '<input type="hidden" name="mode" value="create">';
else
	echo '<input type="hidden" name="mode" value="update">';
?>
<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $HTTP_SESSION_VARS['sess_user_name']."\n"; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">


        <?
        if (isset($externalcall)) {      
        ?>
          <input type="hidden" name="externalcall" value="<?php echo $externalcall;?>">
        <?}?>

<input type="hidden" name="is_outpatient_prescription" value="1">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>


<?php
/**
* Second part: Show all prescriptions for this encounter no. since now. 
*/
?>

<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">
<?php
$toggle=0;
while($row=$result->FetchRow()){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	$toggle=!$toggle;

	if($row['encounter_class_nr']==1) $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; // inpatient admission
		else $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; // outpatient admission

?>

  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['prescribe_date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['article']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><?php echo $row['dosage']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['application_type_nr']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $full_en; ?></td>
    <td rowspan=2><FONT SIZE=-1  FACE="Arial"><?php echo $row['notes']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['drug_class']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['order_nr']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescription_type_nr']; ?></td>

    <td><FONT SIZE=-1  FACE="Arial">&nbsp;</td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescriber']; ?></td>
  </tr>
<?php
}
?>

</table>