<form method="post" >
 <table border=0 cellpadding=2 width=100%>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
     <td><input type="text" name="date" size=10 maxlength=10  
	 	 value="<?php if(($mode!='update')&&!empty($date)&&($date!='0000-00-00')) echo formatDate2Local($date,$date_format); ?>" 
	 	onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTime; ?></td>
     <td><input type="text" name="time" size=10 maxlength=10 value="<?php if(!empty($time)) echo convertTimeToLocal($time); ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDepartment; ?></td>
     <td>
	    <select name="to_dept_nr">
	<?php
		
		while(list($x,$v)=each($deptarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$to_dept_nr) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
				else  echo $v['name_formal'];
			echo '</option>';
		}
	?>
        </select>
	 </td>
   </tr>
   
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo "$LDPhysician/$LDClinician"; ?></td>
     <td><input type="text" name="to_personell_name" size=50 maxlength=60  value="<?php if(isset($to_personell_name)) echo $to_personell_name; ?>"></td>
   </tr>

   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDPurpose; ?></td>
     <td><textarea name="purpose" cols=40 rows=6 wrap="physical"><?php if(isset($purpose)) echo $purpose; ?></textarea>
         </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDUrgency; ?></td>
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">
	 		<input type="radio" name="urgency" value="0" <?php if($urgency==0) echo 'checked'; ?>><?php echo $LDNormal; ?>	
			<input type="radio" name="urgency" value="3" <?php if($urgency==3) echo 'checked'; ?>><?php echo $LDPriority; ?>
	 		<input type="radio" name="urgency" value="5" <?php if($urgency==5) echo 'checked'; ?>><?php echo $LDUrgent; ?>	
			<input type="radio" name="urgency" value="7" <?php if($urgency==7) echo 'checked'; ?>><?php echo $LDEmergency; ?>
     </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDRemindPatient; ?> ?</td>
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">
	 		<input type="radio" name="remind" value="1"  <?php if($remind) echo 'checked'; ?>> <?php echo $LDYes; ?>	<input type="radio" name="remind" value="0"   <?php if(!$remind) echo 'checked'; ?>> <?php echo $LDNo; ?>
     </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDRemindBy; ?></td>
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">
	 	<input type="checkbox" name="remind_email" value="1"   <?php if($remind_email) echo 'checked'; ?>><?php echo $LDEmail; ?>
	 	<input type="checkbox" name="remind_phone" value="1"  <?php if($remind_phone) echo 'checked'; ?>><?php echo $LDPhone; ?>
	 	<input type="checkbox" name="remind_mail" value="1"  <?php if($remind_mail) echo 'checked'; ?>><?php echo $LDMail; ?>
	 </td>
   </tr>

 </table>
<input type="hidden" name="encounter_nr" value="<?php echo $HTTP_SESSION_VARS['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<input type="hidden" name="modify_id" value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<?php 
if($mode=='select'){
?>
<input type="hidden" name="nr" value="<?php echo $nr; ?>">
<?php
}else{
?>
<input type="hidden" name="create_id" value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<input type="hidden" name="create_time" value="null">
<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $HTTP_SESSION_VARS['sess_user_name']."\n"; ?>">
<?php
}

?>
<input type="hidden" name="mode" value="<?php if($mode=='select') echo 'update'; else echo 'create';?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
