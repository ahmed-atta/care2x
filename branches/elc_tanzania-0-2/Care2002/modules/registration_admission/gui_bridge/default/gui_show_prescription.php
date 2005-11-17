<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">
<?php
$toggle=0;
while($row=$result->FetchRow()){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	$toggle=!$toggle;

	if($row['encounter_class_nr']==1) $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; // inpatient admission
		else $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; // outpatient admission
	$amount = 0;
	if($row['bill_number']>0)
	{
		include_once($root_path.'include/care_api_classes/class_tz_billing.php');
		if(!isset($bill_obj)) $bill_obj = new Bill;
		$billresult = $bill_obj->GetElemsOfBillByPrescriptionNr($row['nr']);
		if($billrow=$billresult->FetchRow())
		{
			if($billrow['amount']!=$row['dosage'])
				$amount=$billrow['amount'];
		}
		if(!$amount>0)
		{
				$billresult = $bill_obj->GetElemsOfBillByPrescriptionNrArchive($row['nr']);
				if($billrow=$billresult->FetchRow())
				{
					if($billrow['amount']!=$row['dosage'])
						$amount=$billrow['amount'];
				}
		}
	}

?>

  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['prescribe_date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['article']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><?php 
    if($amount>0)
    {
    	echo '<s>'.$row['dosage'].'</s> '.$amount;
  	}
  	else
  	{
    	echo $row['dosage'];
    }
    
    ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['application_type_nr']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $full_en; ?></td>
    <td rowspan=2><FONT SIZE=-1  FACE="Arial"><?php echo $row['notes']; ?>
    
<?php 
    if($row['is_disabled'])
    {
    	echo '<br><br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"> <font color=red>'.$row['is_disabled'].'</font>';
  	}
  	elseif($row['bill_number']>0)
  	{
  		echo '<br><br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)"> <font color=red>Already billed! See bill number '.$row['bill_number'].'</font>';
  		if($amount>0) echo '<br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)"> <font color="red">The dosage has been changed by the billing officer.</font>';
  	}
  	?>    
    </td>
    <td><FONT SIZE=-1  FACE="Arial"><?php 
    if($row['is_disabled'] || $row['bill_number']>0)
  	{
  		echo '<font color="#D4D4D4">edit</font>';
  	}
  	else
    echo '<a href="'.$thisfile.URL_APPEND.'&mode=edit&nr='.$row['nr'].'&show=insert&externalcall='.$externalcall.'&disablebuttons='.$disablebuttons.'">edit</a>'
    
    ?>
    </td><td><FONT SIZE=-1  FACE="Arial"><?php echo $row['order_nr']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescription_type_nr']; ?></td>

    <td><FONT SIZE=-1  FACE="Arial"><?php
    if($row['is_disabled'] || $row['bill_number']>0)
  	{
  		echo '<font color="#D4D4D4">delete</font>';
  	}
  	else
      echo '<a href="'.$thisfile.URL_APPEND.'&mode=delete&nr='.$row['nr'].'&show=insert&externalcall='.$externalcall.'&disablebuttons='.$disablebuttons.'">delete</a>' ?>
    </td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescriber']; ?></td>
  </tr>

<?php
}
?>
</table>

<?php
if($parent_admit&&!$is_discharged) {
?>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=new'; ?>"> 
<?php echo $LDEnterNewRecord; ?>
</a>
<?php
}
?>
