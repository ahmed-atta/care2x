<?php
if($parent_admit) $bgimg='tableHeaderbg3.gif';
	else $bgimg='tableHeader_gr.gif';
$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
?>
<script language="">
<!-- Script Begin
function cancelAppointment(nr) {
	if(confirm('<?php echo $LDSureCancelAppt; ?>')){
		if(reason=prompt('<?php echo $LDEnterCancelReason; ?>','')){
			window.location.href="<?php echo $thisfile.URL_REDIRECT_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=appt_cancel&nr='; ?>"+nr+"&reason="+reason;
		}
	}
}
//  Script End -->
</script>

<table border=0 cellpadding=3 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo "$LDDate/$LDTime/$LDDetails"; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDAppointments; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDStatus; ?></td>
  </tr>
<?php
$toggle=0;
/* Get department info */
while($row=$result->FetchRow()){
	if(($row['urgency']==7)&&($row['appt_status']=='pending')){
		$bgc='yellow';
	}else{
		if($toggle) $bgc='#f3f3f3';
			else $bgc='#fefefe';
	}
	$toggle=!$toggle;
	$dept=$dept_obj->getDeptAllInfo($row['to_dept_nr']);
	if($row['appt_status']=='cancelled') $tc='#9f9f9f';
		else $tc='#000000';
?>

  <tr   bgcolor="<?php echo $bgc; ?>" >
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>"><?php echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td rowspan=4 valign="top"><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>">
	<?php 
		echo nl2br($row['purpose']);
		if($row['appt_status']=='cancelled'){
			echo '<br>______________________<br>'.$LDCancelReason.'<br>'.nl2br($row['cancel_reason']);
		}
	?>
	</td>
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>"><img <?php echo createComIcon($root_path,'level_'.$row['urgency'].'.gif','0'); ?>></td>
  </tr>
  <tr   bgcolor="<?php echo $bgc; ?>" >
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>"><?php echo $row['time']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>">
		<?php 
			$buffer='LD'.$row['appt_status'];
			if(isset($$buffer)&&!empty($$buffer)) echo $$buffer; else echo $row['appt_status']; 
		?>
	</td>
  </tr>
  <tr  bgcolor="<?php echo $bgc; ?>" >
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>">
	<?php 
		if(isset($$dept['LD_var'])&&!empty($$dept['LD_var'])) echo $$dept['LD_var']; 
			else echo $dept['name_formal'];
	?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>">
	<?php 
		if($row['remind']&&$row['appt_status']=='pending'){
			if($row['remind_email']) echo '<img '.createComIcon($root_path,'email.gif','0').'> ';
			if($row['remind_mail']) echo '<img '.createComIcon($root_path,'print.gif','0').'> ';
			if($row['remind_phone']) echo '<img '.createComIcon($root_path,'violet_phone_2.gif','0').'> ';
		}
		 ?></td>
  </tr>
  <tr  bgcolor="<?php echo $bgc; ?>" >
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>"><?php echo $row['to_personell_name']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>">
	<?php
		if($row['appt_status']!='cancelled'){
	?>
	<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=select&nr='.$row['nr']; ?>"><img <?php echo createLDImgSrc($root_path,'edit_sm.gif','0'); ?>></a> 
	<?php
		}
		if($row['appt_status']=='pending'){
	?>
	<a href="javascript:cancelAppointment(<?php echo $row['nr']; ?>)"><img <?php echo createLDImgSrc($root_path,'cancel_sm.gif','0'); ?>></a><br></td>
	<?php
		}
	?>  
  </tr>

<?php
}
?>
</table>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=new'; ?>"> 
<?php echo $LDScheduleNewAppointment; ?>
</a>
