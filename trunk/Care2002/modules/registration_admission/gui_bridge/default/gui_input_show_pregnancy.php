<?php
if($rows) $pregnancy=$pregs->FetchRow();
?>
<form method="post" name="report">
 <table border=0 cellpadding=2 width=100%>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['this_pregnancy_nr']; ?></td>
     <td><input type="text" name="this_pregnancy_nr" size=10 maxlength=2 value="<?php if($pregnancy['this_pregnancy_nr']) echo $pregnancy['this_pregnancy_nr']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">
	 <input type="text" name="delivery_date" value="<?php if($pregnancy['delivery_date']) echo formatDate2Local($pregnancy['delivery_date'],$date_format); ?>" size=10 maxlength=10 onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
 		<a href="javascript:show_calendar('report.delivery_date','<?php echo $date_format ?>')">
 		<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 		 <?php echo $LDTime; ?>
	 <input type="text" name="delivery_time" size=10 maxlength=5 value="<?php if($pregnancy['delivery_time']) echo $pregnancy['delivery_time'] ?>" >
 		</font></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['gravida']; ?></td>
     <td><input type="text" name="gravida" size=10 maxlength=10 value="<?php if($pregnancy['gravida']) echo $pregnancy['gravida']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['para']; ?></td>
     <td><input type="text" name="para" size=10 maxlength=10 value="<?php if($pregnancy['para']) echo $pregnancy['para']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['pregnancy_gestational_age'] ?></td>
     <td><input type="text" name="pregnancy_gestational_age" size=10 maxlength=10 value="<?php if($pregnancy['pregnancy_gestational_age']) echo $pregnancy['scored_gestational_age']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['nr_of_fetuses']; ?></td>
     <td><input type="text" name="nr_of_fetuses" size=10 maxlength=10 value="<?php if($pregnancy['nr_of_fetuses']) echo $pregnancy['nr_of_fetuses']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['child_encounter_nr'].'<br><font size=1>'.$LD['sepspace'].'</font>'; ?></td>
     <td><input type="text" name="child_encounter_nr" size=50 maxlength=60 value="<?php echo $pregnancy['child_encounter_nr']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['delivery_mode']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 
	$dm=&$obj->DeliveryModes();
	if($obj->LastRecordCount()){
		while($dmod=$dm->FetchRow()){
			echo '<input type="radio" name="delivery_mode" value="'.$dmod['nr'].'" ';
			if($pregnancy['delivery_mode']==$dmod['nr']) echo 'checked' ;
			echo '>';
			if(isset($$dmod['LD_var'])&&$$dmod['LD_var']) echo $$dmod['LD_var'];
				else echo $dmod['name'];
		}
	}
	?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['is_booked']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 	<input type="radio" name="is_booked" value="1" <?php if($pregnancy['is_booked']) echo 'checked' ?>><?php echo  $LDYes ?>
  	<input type="radio" name="is_booked" value="0" <?php if(!$pregnancy['is_booked']) echo 'checked' ?>><?php echo  $LDNo ?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['vdrl']; ?></td>
     <td><input type="text" name="vdrl" size=10 maxlength=2 value="<?php echo $pregnancy['vdrl']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['rh']; ?></td>
     <td><input type="text" name="rh" size=10 maxlength=2 value="<?php echo $pregnancy['rh']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['bp_systolic_high'] ?></td>
     <td><input type="text" name="bp_systolic_high" size=10 maxlength=10 value="<?php if($pregnancy['bp_systolic_high']) echo $pregnancy['bp_systolic_high']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['bp_diastolic_high'] ?></td>
     <td><input type="text" name="bp_diastolic_high" size=10 maxlength=10 value="<?php if($pregnancy['bp_diastolic_high']) echo $pregnancy['bp_diastolic_high']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['proteinuria']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 	<input type="radio" name="proteinuria" value="1" <?php if($pregnancy['proteinuria']) echo 'checked' ?>><?php echo  $LDYes ?>
  	<input type="radio" name="proteinuria" value="0" <?php if(!$pregnancy['proteinuria']) echo 'checked' ?>><?php echo  $LDNo ?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['labour_duration'] ?></td>
     <td><input type="text" name="labour_duration" size=10 maxlength=10 value="<?php if($pregnancy['labour_duration']) echo $pregnancy['labour_duration']; ?>"></td>
   </tr>

   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['induction_method'] ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 
	$ind=&$obj->InductionMethods();
	if($obj->LastRecordCount()){
		while($induc=$ind->FetchRow()){
			echo ' <input type="radio" name="induction_method" value="'.$induc['nr'].'" ';
			if($pregnancy['induction_method']==$induc['nr']) echo 'checked' ;
			echo '>';
			if(isset($$induc['LD_var'])&&$$induc['LD_var']) echo $$induc['LD_var'];
				else echo $induc['name'];
		}
	}
	?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['induction_indication'] ?></td>
     <td><input type="text" name="induction_indication" size=50 maxlength=60 value="<?php echo $pregnancy['induction_indication']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['is_epidural']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 	<input type="radio" name="is_epidural" value="1" <?php if($pregnancy['is_epidural']) echo 'checked' ?>><?php echo  $LDYes ?>
  	<input type="radio" name="is_epidural" value="0" <?php if(!$pregnancy['is_epidural']) echo 'checked' ?>><?php echo  $LDNo ?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['complications'] ?></td>
     <td><input type="text" name="complications" size=50 maxlength=255 value="<?php echo $pregnancy['complications']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['perineum'] ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 
	$buf=&$obj->Perineums();
	if($obj->LastRecordCount()){
		while($per=$buf->FetchRow()){
			echo ' <input type="radio" name="perineum" value="'.$per['nr'].'" ';
			if($pregnancy['perineum']==$per['nr']) echo 'checked' ;
			echo '>';
			if(isset($$per['LD_var'])&&$$per['LD_var']) echo $$per['LD_var'];
				else echo $per['name'];
		}
	}
	?>
	 </td>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['blood_loss'] ?></td>
     <td><input type="text" name="blood_loss" size=10 maxlength=10 value="<?php if($pregnancy['blood_loss']) echo $pregnancy['blood_loss']; ?>">
	 		<select name="blood_loss_unit">
	 <?php
	 	# make ml (milliliter) the default
		if(empty($pregnancy['blood_loss_unit'])) $pregnancy['blood_loss_unit']='ml';
	 	# Load the volume units
	 	$unit=&$msr->VolumeUnits();
		while(list($x,$v)=each($unit)){
			echo '<option value="'.$v['id'].'" ';
			if($pregnancy['blood_loss_unit']==$v['id']) echo 'selected';
			echo '>'.$v['id'];
		}
	?>
	</select></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['is_retained_placenta']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 	<input type="radio" name="is_retained_placenta" value="1" <?php if($pregnancy['is_retained_placenta']) echo 'checked' ?>><?php echo  $LDYes ?>
  	<input type="radio" name="is_retained_placenta" value="0" <?php if(!$pregnancy['is_retained_placenta']) echo 'checked' ?>><?php echo  $LDNo ?>
	 </td>
   </tr>
    <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['post_labour_condition'] ?></td>
     <td><input type="text" name="post_labour_condition" size=50 maxlength=60 value="<?php echo $pregnancy['post_labour_condition']; ?>"></td>
   </tr>
    <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['outcome']  ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 
	$oc=&$obj->Outcomes();
	if($obj->LastRecordCount()){
		while($otc=$oc->FetchRow()){
			echo '<input type="radio" name="outcome" value="'.$otc['nr'].'" ';
			if($pregnancy['outcome']==$otc['nr']) echo 'checked' ;
			echo '>';
			if(isset($$otc['LD_var'])&&$$otc['LD_var']) echo $$otc['LD_var'];
				else echo $otc['name'];
		}
	}
	?>
	 </td>
   </tr>
 
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['docu_by'] ?></td>
     <td><input type="text" name="application_by" size=50 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>"></td>
   </tr>
 </table>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="encounter_nr" value="<?php echo $HTTP_SESSION_VARS['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<input type="hidden" name="rec_nr" value="<?php echo $rec_nr; ?>">
<input type="hidden" name="allow_update" value="<?php if(isset($allow_update)) echo $allow_update; ?>">
<input type="hidden" name="target" value="<?php echo trim($target); ?>">
<input type="hidden" name="mode" value="newdata">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
