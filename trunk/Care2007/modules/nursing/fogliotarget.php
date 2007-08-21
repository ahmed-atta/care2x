<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('date_time.php');
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
//define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
/* Create nursing notes object */
require_once($root_path.'include/care_api_classes/Target.php');
$report_obj= new Target;
 
//if ($station=='') { $station='Non-department specific';  }
if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;

$thisfile=basename(__FILE__);
			
require_once($root_path.'include/inc_date_format_functions.php');


if($mode=='save'){
	# Know where we are
	switch($HTTP_SESSION_VARS['sess_user_origin']){
		case 'lab': $HTTP_POST_VARS['location_type_nr']=1; # 1 =department
						break;
		default: 	$HTTP_POST_VARS['location_type_nr']=2; # 2 = ward 
						break;
	}
	$HTTP_POST_VARS['location_id']=$station; 
	if($report_obj->saveDailyWardNotes($HTTP_POST_VARS)){
		//echo $report_obj->getLastQuery();
		header("Location:$thisfile".URL_REDIRECT_APPEND."&pn=$pn&station=$station&dept_nr=$dept_nr&location_nr=$location_nr&saved=1");
		exit;
	}else{echo $report_obj->getLastQuery()."<p>$LDDbNoUpdate";}
} elseif ($mode=='update') {
	# Know where we are
	switch($HTTP_SESSION_VARS['sess_user_origin']){
		case 'lab': $HTTP_POST_VARS['location_type_nr']=1; # 1 =department
						break;
		default: 	$HTTP_POST_VARS['location_type_nr']=2; # 2 = ward 
						break;
	}
	$HTTP_POST_VARS['location_id']=$station;
	if($report_obj->updateDailyWardNotes($HTTP_POST_VARS)){
		//echo $report_obj->getLastQuery();
		header("Location:$thisfile".URL_REDIRECT_APPEND."&pn=$pn&station=$station&dept_nr=$dept_nr&location_nr=$location_nr&saved=1");
		exit;
	}else{echo $report_obj->getLastQuery()."<p>$LDDbNoUpdate";}
}else{
	if($d_notes=&$report_obj->getDailyWardNotes($pn)){
   		include_once($root_path.'include/inc_editor_fx.php');
		$occup=true;
	}
	# If location name is empty, fetch by location nr
	if(!isset($station)||empty($station)){
		# Know where we are
		switch($HTTP_SESSION_VARS['sess_user_origin']){
			case 'amb': # Create nursing notes object 
						include_once($root_path.'include/care_api_classes/class_department.php');
						$obj= new Department;
						$station=$obj->FormalName($dept_nr);
						break;
			default: # Create nursing notes object 
						include_once($root_path.'include/care_api_classes/class_ward.php');
						$obj= new Ward;
						$station=$obj->WardName($location_nr);
		}
		echo $obj->getLastQuery();
	}
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle', $LDTarget.' :: '.$station.' ('.formatDate2Local($s_date,$date_format).')');

   # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('patient_remarks.php','','','$station','$LDNotes')");

 # href for close button
 $smarty->assign('breakfile','javascript:window.close()');


 # OnLoad Javascript code
  if(($mode=='save')&&($occup)||$saved) $sTemp = "window.opener.location.reload();";
  	else $sTemp = '';

 $smarty->assign('sOnLoadJs','onLoad="'.$sTemp.' if (window.focus) window.focus();"');

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTarget.' :: '.$station.' ('.formatDate2Local($s_date,$date_format).')');

 # Collect extra javascript code

 ob_start();
?>

<script language="javascript">
<!-- 
var n=false;
function checkForm(f)
{
	if(f.notes.value==""||f.personell_name=="") return false;
	 else return true;
}
function setChg()
{
	n=true;
}
// -->
</script>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style>

<?php

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

ob_start();

/*
if($occup){
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>
 <table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr class="adm_item">
    <td><FONT color="#000066"><?php echo $LDDate; ?></td>
    <td><FONT color="#000066"><?php echo $LDTime; ?></td>
    <td><FONT color="#000066"><?php echo $LDNotes; ?></td>
    <td><FONT color="#000066"><?php echo $LDCreatedBy; ?></td>
  </tr>
<?php
	$toggle=0;
	while($row=$d_notes->FetchRow()){
		if($toggle) $bgc='#efefef';
			else $bgc='#f0f0f0';
		if($toggle) $sRowClass='wardlistrow2';
			else $sRowClass='wardlistrow1';
		$toggle=!$toggle;
		if(!empty($row['short_notes'])) $bgc='yellow';
	
?>


  <tr  class="<?php echo $sRowClass ?>"  valign="top">
    <td><?php if(!empty($row['date'])) echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><?php if($row['time']) echo $row['time']; ?></td>
    <td><FONT color="#000033">
	<?php 
		if(!empty($row['notes'])) echo deactivateHotHtml(nl2br($row['notes'])); 
		if(!empty($row['short_notes'])) echo '<br>[ '.deactivateHotHtml($row['short_notes']).' ]';
	?>
	</td>
    <td><?php if($row['personell_name']) echo $row['personell_name']; ?></td>
  </tr>

<?php
	}
?>
</table>
<?php
}
*/
?>

 <ul>
 
 <?php
 	if ($occup) {
 		$row = $d_notes->FetchRow();
 	}
 ?>
 
 <form method="post" name=remform action="fogliotarget.php" onSubmit="return checkForm(this)">
 <table>
 <tr>
 	<td>Konstitucioni</td>
 	<td><select name='tipo_costituzionale'><option name='Normotipo' <?php if (($occup)&&($row['tipo_costituzionale']=="Normotipo")) echo "selected"; ?>>Normotipo</option><option name='Brachitipo' <?php if (($occup)&&($row['tipo_costituzionale']=="Brachitipo")) echo "selected"; ?>>Brachitipo</option><option name='Longitipo' <?php if (($occup)&&($row['tipo_costituzionale']=="Longitipo")) echo "selected"; ?>>Longitipo</option></select></td>
 	<td>Paraqitja e pergjithshme</td>
 	<td><select name='condizioni_generali'><option name='Buone' <?php if (($occup)&&($row['condizioni_generali']=="Buone")) echo "selected"; ?>>Buone</option><option name='Discrete' <?php if (($occup)&&($row['condizioni_generali']=="Discrete")) echo "selected"; ?>>Discrete</option><option name='Scadute' <?php if (($occup)&&($row['condizioni_generali']=="Scadute")) echo "selected"; ?>>Scadute</option></select></td>
 </tr>
 </table>
 
<table>
<tr>
<td><strong>Gjendja nutricionale dhe hidratimi</strong><br>
<textarea name="stato_nutrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['stato_nutrizione'] ?></textarea></td>
<td><strong>Dekubitusi</strong><br>
<textarea name="decubito" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['decubito'] ?></textarea></td>
</tr>
<tr>
<td><strong>Ndergjegja</strong><br>
<textarea name="psiche" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['psiche'] ?></textarea></td>
<td><strong>Lekura</strong><br>
<textarea name="cute" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['cute'] ?></textarea></td>
</tr>
</table>

<table>
<tr>
<td><strong>Pershkrimi i mukozave</strong><br>
<textarea name="descrizione_mucose" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['descrizione_mucose'] ?></textarea></td>
<td><strong>Adnekset kutane</strong><br>
<textarea name="annessi_cutanei" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['annessi_cutanei'] ?></textarea></td>
</tr>
</table>
 Edemat&nbsp;
&nbsp;<select name='edemi'><option name='No'<?php if (($occup)&&($row['edemi']=="No")) echo "selected"; ?>>Jo</option><option name='Si' <?php if (($occup)&&($row['edemi']=="Si")) echo "selected"; ?>>Po</option></select><br>
<strong>Pershkrimi i edemave</strong><br><textarea name="sottocutaneo_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['sottocutaneo_descrizione'] ?></textarea><br>
<table>
 <tr>
 	<td>Temperatura</td><td><select name='temperatura'><option name='Apiressia' <?php if (($occup)&&($row['temperatura']=="Apiressia")) echo "selected"; ?>>Apiressia</option><option name='Febbre' <?php if (($occup)&&($row['temperatura']=="Febbre")) echo "selected"; ?>>Febbre</option><option name='Ipotermia' <?php if (($occup)&&($row['temperatura']=="Ipotermia")) echo "selected"; ?>>Ipotermia</option></select></td>
 	<td>Pulset&nbsp;  centrale&nbsp;</i></td><td><input type="text" name="polso_battiti" size=10 maxlength=10 <?php if ($occup) echo "value='".$row['polso_battiti']."'" ?>></td>
 	<td>Pulset periferike</td><td><select name='polso'><option name='Regolare' <?php if (($occup)&&($row['polso']=="Regolare")) echo "selected"; ?>>Regolare</option><option name='Piccolo' <?php if (($occup)&&($row['polso']=="Piccolo")) echo "selected"; ?>>Piccolo</option><option name='Molle' <?php if (($occup)&&($row['polso']=="Molle")) echo "selected"; ?>>Molle</option><option name='Teso' <?php if (($occup)&&($row['polso']=="Teso")) echo "selected"; ?>>Teso</option><option name='Aritmico' <?php if (($occup)&&($row['polso']=="Aritmico")) echo "selected"; ?>>Aritmico</option></select></td>
 </tr>
 </table>
 <table>
 <tr>
 	<td>Presioni arterial diastolik&nbsp;</i></td><td><input type="text" name="pressione_min" size=10 maxlength=10 <?php if ($occup) echo "value='".$row['pressione_min']."'" ?>></td>
 	<td>Presioni arterial sistolik&nbsp;</i></td><td><input type="text" name="pressione_max" size=10 maxlength=10 <?php if ($occup) echo "value='".$row['pressione_max']."'" ?>></td>
 	</tr>
 </table>
 <strong>Aparati linfoglandular</strong><br>
 <textarea name="linfoghiandolare_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['linfoghiandolare_descrizione'] ?></textarea><br>
 <strong>Koka</strong><br>
 <textarea name="capo_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['capo_descrizione'] ?></textarea><br>
 Globi oculari&nbsp;<select name='globi_oculari'><option name='Normoprotrusi' <?php if (($occup)&&($row['globi_oculari']=="Normoprotrusi")) echo "selected"; ?>>Normoprotrusi</option><option name='Esoftalmo' <?php if (($occup)&&($row['globi_oculari']=="Esoftalmo")) echo "selected"; ?>>Esoftalmo</option><option name='Enfotalmo' <?php if (($occup)&&($row['globi_oculari']=="Enfotalmo")) echo "selected"; ?>>Enfotalmo</option></select><br>
 <table>
<tr>
<td>Pershkrimi i sklerave<br>
<textarea name="sclere_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['sclere_descrizione'] ?></textarea></td>
<td>Pupilat<br>
<textarea name="pupille" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['pupille'] ?></textarea></td>
</tr>
<tr>
<td>Refleksi korneal<br>
<textarea name="riflesso_corneale" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['riflesso_corneale'] ?></textarea></td>
<td>Veshet<br>
<textarea name="orecchie" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['orecchie'] ?></textarea></td>
</tr>
<tr>
<td>Hunda<br>
<textarea name="naso" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['naso'] ?></textarea></td>
<td>Goja<br>
<textarea name="cavo_orofaringeo" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['cavo_orofaringeo'] ?></textarea></td
></tr>
</table>
 Gjuha&nbsp;
&nbsp;<select name='lingua'><option name='Epitelizzata' <?php if (($occup)&&($row['lingua']=="Epitelizzata")) echo "selected"; ?>>Ben epitelizzata</option><option name='Atrofica' <?php if (($occup)&&($row['lingua']=="Atrofica")) echo "selected"; ?>>Atrofica</option><option name='Patinosa' <?php if (($occup)&&($row['lingua']=="Patinosa")) echo "selected"; ?>>Patinosa</option><option name='Secca' <?php if (($occup)&&($row['lingua']=="Secca")) echo "selected"; ?>>Secca</option></select><br>
 <table>
<tr>
<td>Dhembet<br>
<textarea name="dentatura" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['dentatura'] ?></textarea></td>
<td>Tonsilat<br>
<textarea name="tonsille" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['tonsille'] ?></textarea></td>
</tr>
</table>
 <p><strong>Qafa</strong></p>
 <br>
 <table>
<tr>
<td>Forma<br>
<textarea name="collo_forma" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['collo_forma'] ?></textarea></td>
<td>Levizshmeria<br>
<textarea name="mobilita" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['mobilita'] ?></textarea></td>
</tr>
<tr>
<td>Qendrimi<br>
<textarea name="atteggiamento" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['atteggiamento'] ?></textarea></td>
<td>Pershkrimi<br>
<textarea name="collo_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['collo_descrizione'] ?></textarea></td>
</tr>
</table>
<table>
<tr>
<td>Jugularet e fryra&nbsp;</td><td><select name='giugulari_turgide'><option name='No'<?php if (($occup)&&($row['giugulari_turgide']=="No")) echo "selected"; ?>>Jo</option><option name='Si' <?php if (($occup)&&($row['giugulari_turgide']=="Si")) echo "selected"; ?>>Po</option></select></td>
<td>Tiroidja normale&nbsp;</td><td><select name='tiroide_normale'><option name='No'<?php if (($occup)&&($row['tiroide_normale']=="No")) echo "selected"; ?>>Jo</option><option name='Si' <?php if (($occup)&&($row['tiroide_normale']=="Si")) echo "selected"; ?>>Po</option></select></td>
</tr>
</table>

<p><strong>Toraksi</strong></p>
<br>
 <table>
<tr>
<td>Forma<br>
<textarea name="torace_forma" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['torace_forma'] ?></textarea></td>
<td>Glandulat mamare<br>
<textarea name="mammelle" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['mammelle'] ?></textarea></td>
</tr>
</table>
 Te dhena normale
&nbsp;<select name='reperti_torace'><option name='Si'<?php if (($occup)&&($row['reperti_torace']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_torace']=="No")) echo "selected"; ?>>Jo</option></select><br>
<strong>Aparati respirator</strong><br> 
<table>
<tr>
<td>Inspeksioni<br>
<textarea name="ispezione_respiratoria" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['ispezione_respiratoria'] ?></textarea></td>
<td>Palpacioni<br>
<textarea name="palpazione_respiratoria" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['palpazione_respiratoria'] ?></textarea></td>
</tr>
<tr>
<td>Perkusioni<br>
<textarea name="percussione_respiratoria" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['percussione_respiratoria'] ?></textarea></td>
<td>Auskultacioni<br>
<textarea name="ascoltazione_respiratoria" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['ascoltazione_respiratoria'] ?></textarea></td>
</tr>
</table>
Rezultate normale&nbsp;<select name='reperti_respiratoria'><option name='Si'<?php if (($occup)&&($row['reperti_respiratoria']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_respiratoria']=="No")) echo "selected"; ?>>Jo</option></select><br>
<p><strong>Zemra</strong></p>
<br> 
<table>
<tr>
<td>Inspeksioni<br>
<textarea name="ispezione_cuore" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['ispezione_cuore'] ?></textarea></td>
<td>Palpacioni<br>
<textarea name="palpazione_cuore" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['palpazione_cuore'] ?></textarea></td>
</tr>
<tr>
<td>Perkusioni<br>
<textarea name="percussione_cuore" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['percussione_cuore'] ?></textarea></td>
<td>Auskultacioni<br>
<textarea name="ascoltazione_cuore" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['ascoltazione_cuore'] ?></textarea></td>
</tr>
</table>
Rezultate normale&nbsp;<select name='reperti_cuore'><option name='Si'<?php if (($occup)&&($row['reperti_cuore']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_cuore']=="No")) echo "selected"; ?>>Jo</option></select><br>
<p><strong>Vazat periferike</strong></p>
<br>
 <table>
<tr>
<td>Pershkrimi<br>
<textarea name="vasi_periferici_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['vasi_periferici_descrizione'] ?></textarea></td>
<td>Arteriet<br>
<textarea name="arterie" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['arterie'] ?></textarea></td>
<td>Venat<br>
<textarea name="vene" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['vene'] ?></textarea></td>
</tr>
</table>
 Rezultate normale
&nbsp;<select name='reperti_vasi'><option name='Si'<?php if (($occup)&&($row['reperti_vasi']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_vasi']=="No")) echo "selected"; ?>>Jo</option></select><br>
<strong>Abdomeni</strong><br> 
<table>
<tr>
<td>Inspeksioni<br>
<textarea name="addome_ispezione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['addome_ispezione'] ?></textarea></td>
<td>Palpacioni<br>
<textarea name="addome_palpazione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['addome_palpazione'] ?></textarea></td>
</tr>
<tr>
<td>Perkusioni<br>
<textarea name="addome_percussione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['addome_percussione'] ?></textarea></td>
<td>Auskultacioni<br>
<textarea name="addome_ascoltazione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['addome_ascoltazione'] ?></textarea></td>
</tr>
<tr>
<td>Pershkrimi<br>
<textarea name="addome_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['addome_descrizione'] ?></textarea></td>
<td>Eksplorimi rektal<br>
<textarea name="rettale" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['rettale'] ?></textarea></td>
</tr>
</table>
 Rezultate normale
&nbsp;<select name='reperti_addome'><option name='Si'<?php if (($occup)&&($row['reperti_addome']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_addome']=="No")) echo "selected"; ?>>Jo</option></select><br>
<strong>Hepari</strong><br>
<textarea name="fegato_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['fegato_descrizione'] ?></textarea><br>
<table>
<tr>
<td>Hepatomegalia&nbsp;</td><td><select name='epatomegalia'><option name='No'<?php if (($occup)&&($row['epatomegalia']=="No")) echo "selected"; ?>>Jo</option><option name='Si' <?php if (($occup)&&($row['epatomegalia']=="Si")) echo "selected"; ?>>Po</option></select></td>
<td>Murphy pozitiv&nbsp;&nbsp;</td><td><select name='murphy'><option name='No'<?php if (($occup)&&($row['murphy']=="No")) echo "selected"; ?>>Jo</option><option name='Si' <?php if (($occup)&&($row['murphy']=="Si")) echo "selected"; ?>>Po</option></select></td>
</tr>
<tr>
<td colspan="2">Koleciste e palpueshme&nbsp;</td><td colspan="2"><select name='colecisti_palpabile'><option name='No'<?php if (($occup)&&($row['colecisti_palpabile']=="No")) echo "selected"; ?>>Jo</option><option name='Si' <?php if (($occup)&&($row['colecisti_palpabile']=="Si")) echo "selected"; ?>>Po</option></select></td>
</tr>
</table>
 Rezultate normale
&nbsp;<select name='reperti_fegato'><option name='Si'<?php if (($occup)&&($row['reperti_fegato']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_fegato']=="No")) echo "selected"; ?>>Jo</option></select><br>
<strong>Lieni</strong><br>
<textarea name="milza_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['milza_descrizione'] ?></textarea><br>
Rezultate normale&nbsp;<select name='reperti_milza'><option name='Si'<?php if (($occup)&&($row['reperti_milza']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_milza']=="No")) echo "selected"; ?>>Jo</option></select><br>
<strong>Aparati uro-gjenital</strong><br>
 <table>
<tr>
<td>Pershkrimi<br>
<textarea name="urogenitale_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['urogenitale_descrizione'] ?></textarea></td>
<td>Eksplorimi vaginal<br>
<textarea name="esplorazione_vaginale" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['esplorazione_vaginale'] ?></textarea></td>
</tr>
</table>
 Rezultate normale
&nbsp;<select name='reperti_genitale'><option name='Si'<?php if (($occup)&&($row['reperti_genitale']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_genitale']=="No")) echo "selected"; ?>>Jo</option></select><br>
<strong>Aparati osteo-artikular e muskular</strong><br>
 <table>
<tr>
<td>Pershkrimi i aparatit osteo-artikular<br>
<textarea name="osteoarticolare_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['osteoarticolare_descrizione'] ?></textarea></td>
<td>Pershkrimi i aparatit muskular<br>
<textarea name="muscolare_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['muscolare_descrizione'] ?></textarea></td>
</tr>
</table>
Rezultate normale&nbsp;<select name='reperti_muscolare'><option name='Si'<?php if (($occup)&&($row['reperti_muscolare']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_muscolare']=="No")) echo "selected"; ?>>Jo</option></select><br>
<strong>Sistemi nervor</strong><br>
 <table>
<tr>
<td>Pershkrimi<br>
<textarea name="nervoso_descrizione" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['nervoso_descrizione'] ?></textarea></td>
<td>Nervat kraniale<br>
<textarea name="nervi_cranici" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['nervi_cranici'] ?></textarea></td>
<td>Reflekset siperfaqesore<br>
<textarea name="riflessi_superficiali" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['riflessi_superficiali'] ?></textarea></td>
</tr>
</table>
 Rezultate normale
&nbsp;<select name='reperti_nervoso'><option name='Si'<?php if (($occup)&&($row['reperti_nervoso']=="Si")) echo "selected"; ?>>Po</option><option name='No' <?php if (($occup)&&($row['reperti_nervoso']=="No")) echo "selected"; ?>>Jo</option></select><br>


<input type="text" name="personell_name" size=60 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>" readonly>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="location_nr" value="<?php echo $location_nr; ?>">
<?php if ($occup) { ?>
	<input type="hidden" name="mode" value="update">
		<input type="hidden" name="nr" value="<?php echo $row['nr'] ?>">
<?php } else { ?>
	<input type="hidden" name="mode" value="save">
<?php } ?>
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<p>
 <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif') ?>>
</form>

<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
</ul>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the page output to the mainframe center block

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>