<?php
include_once($root_path.'include/care_api_classes/class_measurement.php');
if(!isset($obj)) $obj=new Measurement;
$unit_types=$obj->getUnits();
?>

<form method="post" >
 <table border=0 cellpadding=2 width=100%>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
     <td><input type="text" name="date" size=10 maxlength=10  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"></td>
   </tr>
   
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDMeasurement.' '.$LDType; ?></td>
     <td><FONT SIZE=-1  FACE="Arial"><input type="radio" name="type" value="6"> <?php echo $LDWeight; ?> <input type="radio" name="type" value="7"> <?php echo $LDHeight; ?>
         
     </td>
   </tr>

   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDValue; ?></td>
     <td><input type="text" name="value" size=50 maxlength=60></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDUnit.' '.$LDType; ?></td>
     <td><select name="unit_nr">
         	<option value=""></option>
		<?php
			while(list($x,$v)=each($unit_types)){
				echo '<option value="'.$v['nr'].'">';
				if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
					else echo $v['name'];
				echo '</option>
				';
			}
		?>
         </select>
         </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDApplication.' '.$LDNotes; ?></td>
     <td><textarea name="notes" cols=40 rows=3 wrap="physical"></textarea>
         </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDMeasuredBy; ?></td>
     <td><input type="text" name="measured_by" size=50 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>"></td>
   </tr>
 </table>
<input type="hidden" name="encounter_nr" value="<?php echo $HTTP_SESSION_VARS['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<input type="hidden" name="modify_id" value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<input type="hidden" name="create_id" value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<input type="hidden" name="create_time" value="null">
<input type="hidden" name="mode" value="create">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $HTTP_SESSION_VARS['sess_user_name']."\n"; ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
