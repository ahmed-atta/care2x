<table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDReportNr; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDReportingDept; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDAdmitNr; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTime; ?></td>
  </tr>
<?php
while($row=$result->FetchRow()){

	$buf=$root_path.'modules/laboratory/'.(str_replace('?',URL_APPEND.'&',$row['script_call'])).'&pn='.$row['encounter_nr'];
	if($row['encounter_class_nr']==1) $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; // inpatient admission
		else $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; // outpatient admission
?>


  <tr bgcolor="#fefefe">
    <td><a href="<?php echo $buf; ?>&user_origin=patreg" target="_new"><img <?php echo createComIcon($root_path,'info3.gif','0'); ?>></a></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['report_nr']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><b>
	<?php 
		$deptnr_ok=false;
		while(list($x,$v)=each($depts_array)){
			if($v['nr']==$row['reporting_dept_nr']){
				$deptnr_ok=true;
				break;
			}
		}
		reset($depts_array);
		if($deptnr_ok){
			if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
				else echo $v['name_formal'];
		}else{
			echo $row['reporting_dept'].$row['reporting_dept_nr'];
		}
	 ?></b>
	</td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $full_en; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['report_date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['report_time']; ?></td>
  </tr>

<?php
}
?>
</table>
