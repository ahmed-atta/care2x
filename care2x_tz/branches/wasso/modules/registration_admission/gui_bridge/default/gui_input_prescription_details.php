<?php
require_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($pres_obj)) $pres_obj=new Prescription;
require_once($root_path.'include/care_api_classes/class_person.php');
$person_obj = new Person;

require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$bill = new Bill();

if (empty($encounter_nr) and !empty($pid))
	$encounter_nr = $person_obj->CurrentEncounter($pid);

$debug=FALSE;
if ($debug) {
	if (!empty($back_path)) $backpath=$back_path;

	echo "file: show_prescription<br>";
    if (!isset($externalcall))
      echo "internal call<br>";
    else
      echo "external call<br>";

    echo "mode=".$mode."<br>";

		echo "show=".$show."<br>";

    echo "nr=".$nr."<br>";

    echo "breakfile: ".$breakfile."<br>";

    echo "backpath: ".$backpath."<br>";

    echo "pid:".$pid."<br>";

    echo "encounter_nr:".$encounter_nr."<br>";

    echo "Session-ecnounter_nr: ".$HTTP_SESSION_VARS['sess_en'];
}
$pres_types=$pres_obj->getPrescriptionTypes();


?>
<script language="JavaScript">
function chkform(d) {

		if(d.dosage.value==""){
				alert("<?php echo 'Please enter Total Dose'; ?>");
				d.dosage.focus();
				return false;

	/*
	}else if(d.prescribe_date.value==""){
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
<!--
Original form code
<form method="POST" name="reportform<?PHP echo $i;?>">
-->

<form name="reportform" method="post" action="<?php echo $thisfile; ?>" name="reportform"
onSubmit="return chkform(this)">

<input type="hidden" name="backpath" value="<?php echo $backpath; ?>">
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
if($class=='supplies' || $class=='drug_list' || $class=='special_others_list' || $class=='supplies_laboratory')
{
	$caption_dosage = 'Single dose(per intake)';
}
else
{
	$caption_dosage = 'Amount';
	if(!$prescriptionitem['single_dosage']) $prescriptionitem['single_dosage']=1;
	$nexttime=true;
}
?>

<font class="adm_div"><?php echo $pres_obj->GetNameOfItem($item_array[$i]); ?></font>
 <table border=0 cellpadding=2 width=100%>

   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $caption_dosage; ?></td>
     <td>
	<?php

		 //select "dosage"

		 if ($caption_dosage == 'Single dose(per intake)')
		 {

	     	echo '<select id="single_dose" name="arr_single_dosage['.$i.']"> ';

	     			 $dosageUnits = array (	"" => "",
										"0.1" =>  "1 / 10",
										"0.25" => "1 / 4",
										"0.5"  => "1 / 2",
										"0.75" => "3 / 4",
										"1"    => "1",
										"1.25"    => "1 + 1 / 4",
										"1.5"     => "1 + 1 / 2",
										"1.75"    => "1 + 3 / 4",
										"2"    => "2",
										"3"    => "3",
										"4"    => "4",
										"5"    => "5",
										"6"    => "6",
										"7"    => "7",
										"8"    => "8",
										"9"    => "9",
										"10"   => "10",
										"15"   => "15",
										"20"   => "20",
										"25"   => "25",
										"30"   => "30"	);

			foreach($dosageUnits as $dec => $fract)
			{
				//preselect "1" in case of a new entry or the old value in case of an edit
				if (($prescriptionitem['single_dosage'] == $dec)||((!$nr)&&($dec == "-1")))
					$selected = 'selected="selected"';
				else
					$selected = '';

				echo '<option value="'.$dec.'" '.$selected.'>'.$fract.'</option>';

			}

	       echo '</select>';
	       if (isset($nr)&&($prescrServ!='serv')) echo '('.$prescriptionitem['single_dosage'].')&nbsp;&nbsp;&nbsp;';

		 }
		 else
		 {
		 	echo '1';
			echo '<input type="hidden" id="single_dose" name="arr_single_dosage['.$i.']" value="1">';
		 }

       ?>
&nbsp;&nbsp;&nbsp;

      <?php

      	 //select "times_per_day"

		 if ($caption_dosage == 'Single dose(per intake)')
		 {

    		echo '<FONT SIZE=-1  FACE="Arial" color="#000066"> Times per day :  </FONT>';

     		echo '<select id="timesperday" name="arr_timesperday['.$i.']">';

      		$timesperdayUnits = array('', '1', '2', '3');

     		foreach ($timesperdayUnits as $unit)
     		{
     			//preselect "1" in case of a new entry or the old value in case of an edit
				if (($prescriptionitem['times_per_day'] == $unit)||((!$nr)&&($unit == "-1")))
					$selected = 'selected="selected"';
				else
					$selected = '';

				echo '<option value="'.$unit.'" '.$selected.'>'.$unit.'</option>';
     		}

			echo '</select>';
		 }
		 else
		 {
		 	echo '<input type="hidden" id="timesperday" name="arr_timesperday['.$i.']" value="1">';
		 }

		 if (isset($nr)&&($prescrServ!='serv')) echo '('.$prescriptionitem['times_per_day'].')&nbsp;&nbsp;&nbsp;'

      ?>

&nbsp;&nbsp;&nbsp;
     <?php

		 //select "days"

		 if ($caption_dosage == 'Single dose(per intake)')
		 {

	    	 echo '<FONT SIZE=-1  FACE="Arial" color="#000066">  Days : </FONT>';
	     	 echo '<select id="days" name="arr_days['.$i.']">';

	     	$dayUnits[0]='';

			for ($daycounter=1;$daycounter<91;$daycounter++) {
				$dayUnits[$daycounter]=$daycounter;
			}

	     	 foreach ($dayUnits as $unit)
	     	 {
	     			//preselect "1" in case of a new entry or the old value in case of an edit
					if (($prescriptionitem['days'] == $unit)||((!$nr)&&($unit == "-1")))
						$selected = 'selected="selected"';
					else
						$selected = '';

					echo '<option value="'.$unit.'" '.$selected.'>'.$unit.'</option>';
	     	 }

			 echo '</select>';
		 }
		 else
		 {
			echo '<input type="hidden" id="days" name="arr_days['.$i.']" value="1">';
		 }

		 if (isset($nr)&&($prescrServ!='serv')) echo '('.$prescriptionitem['days'].')&nbsp;&nbsp;&nbsp;'

     ?>
	 &nbsp;&nbsp;&nbsp;
	 <?php

		 //select "total dose"

		 if ($caption_dosage == 'Single dose(per intake)')
		 {

	    	 echo '<FONT SIZE=-1  FACE="Arial" color="#000066">  Total Dose (tabs /bottles /inj.) : </FONT>';
	     	 echo '<select id="dosage" name="arr_dosage['.$i.']">';


			$totalDoseUnits[0]='';
			for ($doseCounter=1;$doseCounter<91;$doseCounter++) {
				$totalDoseUnits[$doseCounter]=$doseCounter;
			}

	     	 foreach ($totalDoseUnits as $td_unit)
	     	 {
	     			//preselect "1" in case of a new entry or the old value in case of an edit
					if (($prescriptionitem['dosage'] == $td_unit)||((!$nr)&&($td_unit == "-1")))
						$selected = 'selected="selected"';
					else
						$selected = '';

					echo '<option value="'.$td_unit.'" '.$selected.'>'.$td_unit.'</option>';
	     	 }

			 echo '</select>';
		 }
		 else
		 {
			echo '<input type="hidden" id="dosage" name="arr_dosage['.$i.']" value="1">';
		 }

		 if (isset($nr)&&($prescrServ!='serv')) echo '('.$prescriptionitem['dosage'].')&nbsp;&nbsp;&nbsp;'

     ?>

	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDApplication.' '.$LDNotes; ?></td>
     <!--<td><textarea name="arr_notes[<?PHP echo $i; ?>]" cols=40 rows=3 wrap="physical"><?php echo $prescriptionitem['notes'];?></textarea>
         </td>-->
		 <td><input type="text" name="arr_notes[<?PHP echo $i; ?>]" size="120"><?php echo $prescriptionitem['notes'];?>
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
$toggle=TRUE;
while($row=$result->FetchRow() ){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	if ($toggle)
		$toggle=FALSE;
	else $toggle=TRUE;

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