<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//define('LANG_FILE','radio.php');

define('NO_2LEVEL_CHK',1);
//$local_user='ck_radio_user';
require_once($root_path.'include/inc_front_chain_lang.php');
//require($root_path.'include/inc_2level_reset.php'); 
setcookie('aufnahme_user'.$sid,$_SESSION['idutente'],0,'/');


$sql="SELECT dr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_diagnostics_report AS dr 
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." 
			AND p.pid=e.pid 
			AND dr.reporting_dept='Radiologia'
			AND e.encounter_nr=".$HTTP_SESSION_VARS['sess_en']." 
			AND e.encounter_nr=dr.encounter_nr 
		ORDER BY dr.create_time DESC";
		
		$result=$db->Execute($sql);
		?>

<table>
<tr bgColor=#dddddd>
<td>
	
</td>
<td>
Numero referto
</td>
<td>
Dipartimento
</td>
<td>
Codice di accettazione paziente
</td>
<td>
Data
</td>
<td>
Orario
</td>
</tr>
<?
while($res2=$result->FetchRow())
{
?>
	<tr bgColor=#eeeeee>
	<td>
	<?php
		$buf='../laboratory/'.(str_replace('?',URL_APPEND.'&',$res2['script_call'])).'&pn='.$res2['encounter_nr'];
	?>
		<a href="<?php echo $buf; ?>&user_origin=patreg" target="_new"><img <?php echo createComIcon("../../",'info3.gif','0'); ?>></a>
	</td>
	<td>
    <? echo $res2['report_nr']; ?>
	</td>
	<td>
	<? echo $res2['reporting_dept'];?>
	</td>
	<td>
	<?echo $res2['encounter_nr']; ?>
	</td>
	<td>
	<? echo $res2['report_date']; ?>
	</td>
	<td>
	<? echo $res2['report_time']; ?>
	</td>
	</tr>
<?
}

?>
</table>
		

