<table border=0 cellpadding=4 cellspacing=1>
<?php
while($row=$result->FetchRow()){

	if($row['encounter_class_nr']==1) $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; // inpatient admission
		else $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; // outpatient admission

?>

  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $full_en; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><b><?php echo $row['code']; ?></b></td>
    <td rowspan=3 valign="top"><FONT SIZE=-1  FACE="Arial"><?php echo $row['description']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['localization']; ?></td>
  </tr>
  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['code_version']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['diagnosing_dept_nr']; ?></td>
  </tr>
  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['category']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['localcode']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['diagnosing_clinician']; ?></td>
  </tr>

<?php
}
?>
</table>
