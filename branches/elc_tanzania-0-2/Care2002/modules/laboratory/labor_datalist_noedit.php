<?php

define('LAB_MAX_DAY_DISPLAY',7); # define the max number or days displayed at one time

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


$lang_tables=array('chemlab_groups.php','chemlab_params.php','prompt.php');
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
if(!isset($user_origin)) $user_origin='';
if($user_origin=='lab'||$user_origin=='lab_mgmt'){
  	$local_user='ck_lab_user';
  	if(isset($from)&&$from=='input') $breakfile=$root_path.'modules/laboratory/labor_datainput.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&user_origin='.$user_origin;
		else $breakfile=$root_path.'modules/laboratory/labor_data_patient_such.php'.URL_APPEND;
}else{
  	$local_user='ck_pflege_user';
  	$breakfile=$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_APPEND.'&pn='.$pn.'&edit='.$edit;
	$encounter_nr=$pn;
}
if(!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if(!$encounter_nr) header("location:".$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang");

$thisfile=basename(__FILE__);

//$db->debug=1;


/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_lab.php');
$enc_obj= new Encounter($encounter_nr);
$lab_obj=new Lab($encounter_nr);

$jobs = $lab_obj->GetJobsByEncounter($encounter_nr);
$count_job = 0;
$count_subjob=1;
if ($jobs)
  while($j=$jobs->FetchRow()){
  		if($last_job != $j['job_id'])
  			{
  				$count_job++;
  			}
  		$arr_tasks = unserialize($j['serial_value']);
  		while(list($x,$v) = each($arr_tasks))
  		{
  			
  			$parameters[$count_job]['tasks'][$x] = $v; 
  			$taskstodo[$x] = $v;
  			if($x>$old_x) $old_x=$x;
  			
  		}
  		$parameters[$count_job]['jobs'] = $j;
  		$last_job = $j['job_id'];
  }	
$patient = $lab_obj->GetUserDataByEncounter($encounter_nr);
if($debug)
{
	for($i=1;$i<=$count_job;$i++)
	{
			for($k=0;$k<=$old_x;$k++)
			{
				if($parameters[$i]['jobs'][$k])	echo 'parameters['.$i.'][\'jobs\']['.$k.'] = '.$parameters[$i]['jobs'][$k].'<br>';
				if($parameters[$i]['tasks'][$k])	echo 'parameters['.$i.'][\'tasks\']['.$k.'] = '.$parameters[$i]['tasks'][$k].'<br>';
			}
		
	}
}
$cache='';

if($nostat) $ret=$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$encounter_nr";
	else $ret=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$encounter_nr";

	
# Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');



# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDLabReport $station");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('lab_list.php','','','','$LDLabReport')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDLabReport $station");

 # collect extra javascript code
 ob_start();
?>

<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
.a12_b{font-family:arial; font-size:12; color:#000000}
.j{font-family:verdana; font-size:12; color:#000000}
</style>

<script language="javascript">
<!-- Script Begin
var toggle=true;
function selectall(){

	d=document.labdata;
	var t=d.ptk.value;
	
	if(t==1){
		if(toggle==true){ d.tk.checked=true;}
	}else{
		for(i=0;i<t;i++){
			if(toggle==true){d.tk[i].checked=true; }
		}
	}
	if(toggle==false){ 
		d.reset();
	}
	toggle=(!toggle);

}

function prep2submit(){
	d=document.labdata;
	var j=false;
	var t=d.ptk.value;
	var n=false;
	for(i=0;i<t;i++)
	{
		if(t==1) {
			n=d.tk;
			v=d.tk.value;
		}else{
			n=d.tk[i];
			v=d.tk[i].value;
		}
		
		if(n.checked==true){
			
			if(j){
				d.params.value=d.params.value +"~"+v;
			}else{ 
				d.params.value=v;	
				j=1;
			}
		 }
	}
	if(d.params.value!=''){
		d.submit();
	}else{
		alert("<?php echo $LDCheckParamFirst ?>");
	}
}
//  Script End -->
</script>

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Assign patient basic elements
$smarty->assign('LDCaseNr',$LDCaseNr);
$smarty->assign('LDLastName',$LDLastName);
$smarty->assign('LDName',$LDName);
$smarty->assign('LDBday',$LDBday);

# Assign patient basic data
$smarty->assign('encounter_nr',$encounter_nr);
$smarty->assign('sLastName',$patient['name_last']);
$smarty->assign('sName',$patient['name_first']);
$smarty->assign('sBday',formatDate2Local($patient['date_birth'],$date_format));

# Assign link  to generate graphic display of results
$smarty->assign('sMakeGraphButton', '<img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph);

# Buffer page output

ob_start();

echo '
<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1>';

if(empty($cache)){

	# Get the number of colums
	$cols=sizeof($records);

	$cache= '
		<tr bgcolor="#dd0000" >
		<td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
		</td>
		<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>
		<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDMsrUnit.'</b>&nbsp;</td>
		';
	for($i=1;$i<=$count_job;$i++){
		$cache.= '
		<td class="a12_b"><font color="#ffffff">&nbsp;<b>'.formatDate2Local($parameters[$i]['jobs'][2],$date_format).'<br>'.$parameters[$i]['jobs'][0].'</b>&nbsp;</td>';
	}

	$cache.= '
		<td>&nbsp;<a href="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle',TRUE).' alt="'.$LDClk2Graph.'"></td></a></td></tr>
		<tr bgcolor="#ffddee" >
		<td class="va12_n"><font color="#ffffff"> &nbsp;
		</td>
		<td class="va12_n"><font color="#ffffff"> &nbsp;
		</td>
		<td  class="j"><font color="#ffffff">&nbsp;</td>';


	for($i=1;$i<=$count_job;$i++){
		$cache.= '
		<td class="a12_b"><font color="#0000cc">&nbsp;<b>'.convertTimeToLocal($parameters[$i]['jobs'][3]).'</b> '.$LDOClock.'&nbsp;</td>';
	}

	# Reset array
	reset($ttime);
	
	$cache.= '
		<td>&nbsp;<a href="javascript:selectall()"><img '.createComIcon($root_path,'dwnarrowgrnlrg.gif','0','absmiddle',TRUE).' alt="'.$LDClk2SelectAll.'"></a>
		</tr>';

	# Display the values
	
	$tasks=&$lab_obj->TestParams();
	while($t=$tasks->FetchRow())
	{
		$arr_task = $lab_obj->TestParamsDetails($t['id']);
		$first=true;
		$imgprep="";
		if($taskstodo[$t['id']])
		{
			for($i=1;$i<=$count_job;$i++)
			{
				if(!$first) { $imgprep .= '~'; }
				$imgprep .= $parameters[$i]['tasks'][$t['id']];
				
				if($first)
				{
					
					$txt.= '<tr class="wardlistrow2">
					<td class="j">'.$arr_task['name'].'</td><td class="j">';
					if($arr_task['lo_bound'] && $arr_task['hi_bound'])
					{
						$txt.=$arr_task['lo_bound'].' - '.$arr_task['hi_bound'];
					}
					$txt.='</td><td class="j">'.$arr_task['msr_unit'].'</td>';
					$first=false;
				}
				$txt.= '
				<td class="j">&nbsp;';
					
					if($arr_task['hi_bound']&&$parameters[$i]['tasks'][$t['id']]>$arr_task['hi_bound'])
					{
						$txt.='<img '.createComIcon($root_path,'arrow_red_up_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($parameters[$i]['tasks'][$t['id']]).'</font>';
					}
					elseif($parameters[$i]['tasks'][$t['id']]<$arr_task['lo_bound'])
					{
						$txt.='<img '.createComIcon($root_path,'arrow_red_dwn_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($parameters[$i]['tasks'][$t['id']]).'</font>';
					}
					else
					{
						$txt.=htmlspecialchars($parameters[$i]['tasks'][$t['id']]);
					}
					$flag=true;
				
				$txt.='&nbsp;</td>';

			
			
			}
	$txt.='<td>
				<input type="checkbox" name="tk" value="'.$t['id'].'">
				<input type="hidden" name="imgprep_'.$t['id'].'" value="'.$imgprep.'">
				</td></tr>'; 					
				$ptrack++;
				$toggle=!$toggle;
			}
			$tracker++;

	
}
echo 				$cache.=$txt;

		}
	
	
	echo '
		<input type="hidden" name="colsize" value="'.$cols.'">
		<input type="hidden" name="params" value="">
		<input type="hidden" name="ptk" value="'.$ptrack.'">
		';


# Show the lab results table from the cache



echo '</table>';

echo '
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="from" value="'.$from.'">
<input type="hidden" name="encounter_nr" value="'.$encounter_nr.'">
<input type="hidden" name="edit" value="'.$edit.'">
<input type="hidden" name="lang" value="'.$lang.'">';

if($from=='input'){
	echo '
<input type="hidden" name="parameterselect" value="'.$parameterselect.'">
<input type="hidden" name="job_id" value="'.$job_id.'">
<input type="hidden" name="allow_update" value="'.$allow_update.'">';
}

echo '
<input type="hidden" name="user_origin" value="'.$user_origin.'">
</form>';

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sLabResultsTable',$sTemp);

$smarty->assign('sClose','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').' alt="'.$LDClose.'"></a>');

# Assign the include file to main frame template

 $smarty->assign('sMainBlockIncludeFile','laboratory/chemlab_data_results_show.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
