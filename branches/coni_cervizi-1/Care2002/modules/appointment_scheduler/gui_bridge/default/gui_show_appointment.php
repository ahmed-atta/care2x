<script language="javascript">
<!--
function Funzioni()
{

 //window.target="_self";
 window.open("http://localhost/Care2xd/modules/registration_admission/aufnahme_start.php?lang=it".resto);
 //opener.location.href="http://localhost/Care2xd/modules/registration_admission/radiografico.php?lang=it";
 //document.location="http://www.yahoo.it"; 
 //window.open("www.yahoo.it");
}
//-->
</script>
<META HTTP-EQUIV="Refresh" CONTENT="75">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<?php
/*
*	Vogliamo sapere se l'utente ha i privilegi per scrivere un referto
*
*/
//require($root_path.'include/inc_environment_global.php');

//DEBUG
/*while(list($a,$b)=each($_SESSION))
{
echo $a."##".$b."@@<br>";
}*/
require_once($root_path.'global_conf/areas_allow.php');

$query="SELECT * FROM care_users where login_id='".$_SESSION['idutente']."'";

$ris=$db->Execute($query);
$ris=$ris->FetchRow();
$ris=$ris['permission'];

$permessi=split(" ",$ris);


while(list($a,$b)=each($permessi))
{
	if(($b)=='_a_1_medocswrite' || $b=='System_Admin' || $b=='_a_0_all') 	
				{
				$permessi="ok";	
				break;
				}
	else if ($b=='_a_1_labresultswrite')
				{
				$permessi="lab";
				break;
				}
}

							
$bgimg='tableHeader_gr.gif';
$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
?>
<script language="javascript">
<!-- Script Begin
function cancelAppointment(nr) {
	if(confirm('<?php echo "$LDSureCancelAppt"; ?>')){
		if(reason=prompt('<?php echo $LDEnterCancelReason; ?>','')){
			window.location.href="<?php echo $thisfile.URL_REDIRECT_APPEND."&currYear=$currYear&currMonth=$currMonth&currDay=$currDay&target=$target&mode=appt_cancel&nr="; ?>"+nr+"&reason="+reason;
		}
	}
}
function checkApptDate(d,e,n){
	fg=false;
	if(d=="<?php echo date('Y-m-d'); ?>"){
		fg=true;
	}else{
		if (confirm("<?php echo $LDAppointNotToday.'\n'.$LDSureAdmitAppoint; ?>")){
			fg=true;
		}
	}
	if(fg){
		window.location.href="<?php echo $root_path.'modules/registration_admission/aufnahme_start.php'.URL_REDIRECT_APPEND; ?>&pid=<?php echo $HTTP_SESSION_VARS['sess_pid'] ?>&origin=patreg_reg&encounter_class_nr="+e+"&appt_nr="+n;
	}
}

//  Script End -->
</script>

<table border=0 cellpadding=3 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo "$LDDate/$LDTime/$LDDetails"; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDPatient; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDAppointments; ?></td>
    <td <?php echo $tbg; ?> colspan=2><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDStatus; ?></td>
  </tr>
<?php
$toggle=0;
/* Get department info */
$qualifica=0;
while($row=$result->FetchRow()){
$qualifica=0;
	if(($row['urgency']==7)&&($row['appt_status']=='pending')){
		$bgc='yellow';
	}else{
		if($toggle) $bgc='#f3f3f3';
			else $bgc='#f6f6f6';
	}
	$toggle=!$toggle;
	$dept=$dept_obj->getDeptAllInfo($row['to_dept_nr']);
	if($row['appt_status']=='cancelled') $tc='#9f9f9f';
		else $tc='';
?>

  <tr   bgcolor="<?php echo $bgc; ?>" >
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>"><?php echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td rowspan=4 valign="top"><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>"><font color="<?php if(empty($tc)) echo '#0000cc'; else echo $tc; ?>"><b>
	<a href="<?php echo $root_path.'modules/registration_admission/patient_register_show.php'.URL_APPEND.'&pid='.$row['pid']; ?>">
	<?php 
		echo ucfirst($row['name_last']).'</b></font>, '.ucfirst($row['name_first']).'<br>';
		echo @formatDate2Local($row['date_birth'],$date_format);
		
		if($row['death_date']&&$row['death_date']!='0000-00-00'){
			echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>&nbsp;'.@formatDate2Local($row['death_date'],$date_format).'</font>';
		}
	
		$atletaoprivato="SELECT enc.*,per.* FROM care_encounter AS enc, care_person AS per WHERE enc.pid=".$row['pid']." AND per.pid=".$row['pid'];
		$atleta=$db->Execute($atletaoprivato);
		$atleta=$atleta->FetchRow();
		
		echo '<br>';
		# Show sex icons
		switch($row['sex']){
			case 'f': echo '<img '.$img_female.'>'; break;
			case 'm': echo '<img '.$img_male.'>'; break;
			default: echo '&nbsp;'; break;
		}	?></a> <? 
			echo "<b><i>".$atleta['encounter_nr']."</i></b>";
			echo '<br>';	
	?>
	
	<?php
	if ($atleta['insurance_firm_id']=='14' || $atleta['insurance_firm_id']=='13')
		{
		switch($atleta['insurance_firm_id']){
			case '14': $qualifica='P.O.'; 
			//$sql="UPDATE care_appointment SET to_dept_id='P.O.' WHERE nr="; 
		 break;
			case '13': $qualifica='I.N.';  
			//$sql="UPDATE care_appointment SET to_dept_id='I.N.' WHERE nr="; 
			break;
		}
		}
		
		else if ($qualifica=='' && $atleta['nat_id_nr'])
		{
		$qualifica='Atleta';
		 //$sql="UPDATE care_appointment SET to_dept_id='Atleta'  WHERE nr="; 
		}
		else
		{
		$qualifica='Privato';
		// $sql="UPDATE care_appointment SET to_dept_id='Privato'  WHERE nr="; 
		}
		echo $qualifica." <b><u>".$atleta['name_maiden']."</b></u>";
		//$sql.=$row['nr'];
				//$esegui=$db->Execute($sql);
	?>
	</td>
    <td rowspan=4 valign="top"><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>">
	<?php 
		
	    $descriziones=split('#',$row['purpose']);
		echo nl2br(str_replace("_"," ",$descriziones[0]));
		//elsedescrizione[1 echo nl2br($row['purpose']);
		
		//echo $
		if($row['appt_status']=='cancelled'){
			echo '<br>______________________<br>'.$LDCancelReason.'<br>'.nl2br($row['cancel_reason']);
		}
	?>
	</td>
    <td><FONT SIZE=1  FACE="Arial" color="<?php echo $tc; ?>">
	 <?$codice=split('#',$row['purpose']);?>
	 <?php 
	if($row['appt_status']!='cancelled'){
	
		if($row['appt_status']=='Fatto' || $row['appt_status']=='Richiesta inoltrata al Laboratorio'){
			$urg_img='check-r.gif';
		}else if($row['appt_status']=='In attesa di referto')
			$urg_img='../../../../gedit-icon.png';
			
		
		else{
			$urg_img='level_'.$row['urgency'].'.gif';
		}
		echo '<img '.createComIcon($root_path,$urg_img,'0','absmiddle').'>'; 
	?>
<?php 
		if($row['appt_status']=='Fatto' && $row['encounter_nr']){
			echo '<a href="'.$root_path.'modules/registration_admission/aufnahme_daten_zeigen.php'.URL_APPEND.'&encounter_nr='.$row['encounter_nr'].'&origin=appt&target='.$target.'">'.$row['encounter_nr'].'</a>';
		}
	}else{
		echo '&nbsp;';
	}
	?>	
	
	</td>
    <td rowspan=4 valign="top"> 
	<?php
		if($row['appt_status']=='In attesa di referto'){
		
		
	?>
	<!--<a href="<?php echo $editorfile.URL_APPEND.'&pid='.$row['pid'].'&target=&mode=select&nr='.$row['nr']; ?>"><img <?php echo createLDImgSrc($root_path,'edit_sm.gif','0'); ?>></a> <br>-->
	<?php //$referto_nr=split("#",$row['purpose']); 
	?>
	
	
	
	
	<?php  
	
		//DEBUG
		//echo $_SESSION['sess_user_name']."<BR>";
		//echo $row['modify_id']."<BR>";
		
		
		if($permessi=='ok'){ 
		if ($codice[1]!='COXXX'){
	?>
	
		<?php
		
		
			//visualizza il tasto referta solo se l'utente corrente � quello che
			//ha accettato la visita
			if ($_SESSION['sess_user_name']==$row['modify_id']) {
		?>
		<a href="
				<?php echo $root_path.'modules/registration_admission/aufnahme_start.php'.URL_APPEND; 
				?>
		&pid=
			<?php echo $row['pid'] ?>
		&origin=patreg_reg&encounter_class_nr=
			<?php echo $row['encounter_class_nr']; ?>
		&appt_nr=
			<?php echo $row['nr']; ?>
		&referto=<?php echo $codice[1]; ?>"
		target="_blank" >
			<img <?php echo createLDImgSrc($root_path,'referta.gif','0'); ?>">
		<?php
			}
		?>
			
			
			
	<?php 
	}

	}?>
	<!--<a href="javascript:checkApptDate('<?php echo $row['date'] ?>','<?php echo $row['encounter_class_nr'] ?>','<?php echo $row['nr'] ?>' )"><img <?php echo createLDImgSrc($root_path,'admit_sm.gif','0'); ?>></a> <br>
-->
	<?php
			}
		if($row['appt_status']=='pending'){
			if(!$row['death_date']||$row['death_date']=='0000-00-00'){
			//echo "dpt vale ". $_GET['dept_nr'];
	?>
	<a href="<?php echo $editorfile.URL_APPEND.'&pid='.$row['pid'].'&target=&mode=select'.'&cod='.$codice[1].'&nr='.$row['nr']; ?>"><img <?php echo createLDImgSrc($root_path,'edit_sm.gif','0'); ?>></a> <br>
	<?php if($permessi=='ok') {?><a href="<?php echo $root_path.'modules/registration_admission/aufnahme_start.php'.URL_APPEND; ?>&dept_nr=<?php echo $_GET['dept_nr'] ?>&pid=<?php echo $row['pid'] ?>&origin=patreg_reg&encounter_class_nr=<?php echo $row['encounter_class_nr']; ?>&appt_nr=<?php echo $row['nr']; ?>"><img <?php echo createLDImgSrc($root_path,'admit_sm.gif','0'); ?>>
	</a> <br><?php }
	else if($permessi=='lab') {?><a href="<?php echo $root_path.'modules/registration_admission/aufnahme_start.php'.URL_APPEND; ?>&dept_nr=<?php echo $_GET['dept_nr'] ?>&pid=<?php echo $row['pid'] ?>&origin=patreg_reg&encounter_class_nr=<?php echo $row['encounter_class_nr']; ?>&appt_nr=<?php echo $row['nr']; ?>"><?php if ($descriziones[0]=="Analisi_di_Laboratorio"){?><img <?php echo createLDImgSrc($root_path,'admit_sm.gif','0'); }?>
	</a> <br><?php }
	?>
	
	<!--<a href="javascript:checkApptDate('<?php echo $row['date'] ?>','<?php echo $row['encounter_class_nr'] ?>','<?php echo $row['nr'] ?>' )"><img <?php echo createLDImgSrc($root_path,'admit_sm.gif','0'); ?>></a> <br>
-->
	<?php
			}
	?>
	<a href="javascript:cancelAppointment(<?php echo $row['nr']; ?>)"><img <?php echo createLDImgSrc($root_path,'cancel_sm.gif','0'); ?>></a>
	<?php
		}else{
		
			echo '&nbsp;';
		}
	?>
	</td>  
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
		if($row['appt_status']=='In attesa di referto')
		{
            echo $row['modify_id'];
		}
		 ?></td>
  </tr>
  <tr  bgcolor="<?php echo $bgc; ?>" >
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>"><?php echo $row['to_personell_name']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="<?php echo $tc; ?>">
	<?php
		$buf=$enc_class[$row['encounter_class_nr']]['LD_var'];
		 if (isset($$buf)&&!empty($$buf)) echo $$buf; 
    		else echo  $enc_class[$row['encounter_class_nr']]['name']; 
	?>
	</td>
  </tr>

<?php
}
?>
</table>
<br />
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $root_path.'modules/registration_admission/patient_register_pass.php'.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target=search'; ?>"> 
<font size=+1 color="#000066" face="verdana,arial"><?php echo $LDScheduleNewAppointment; ?></font>
</a>

