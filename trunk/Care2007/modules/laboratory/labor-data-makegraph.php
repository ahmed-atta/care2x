<?php

define('LAB_MAX_DAY_DISPLAY',7); # define the max number or days displayed at one time

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
//$db->debug=1;
$lang_tables=array('chemlab_groups.php','chemlab_params.php');
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

if($user_origin=='lab'||$user_origin=='lab_mgmt'){
	$local_user='ck_lab_user';
	//$breakfile=$root_path.'modules/laboratory/labor.php'.URL_APPEND;
  	if(isset($from)&&$from=='input') $breakfile=$root_path.'modules/laboratory/labor_datalist_noedit.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&user_origin='.$user_origin.'&from=input';
		else $breakfile=$root_path.'modules/laboratory/labor_datalist_noedit.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&user_origin='.$user_origin;
}else{
  	$local_user='ck_pflege_user';
  	//$breakfile=$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_APPEND.'&pn='.$encounter_nr;
  	$breakfile=$root_path.'modules/laboratory/labor_datalist_noedit.php'.URL_APPEND.'&pn='.$encounter_nr.'&user_origin='.$user_origin.'&edit='.$edit;
	//$encounter_nr=$pn;
}

if(!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if(!$encounter_nr) header("location:".$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang");
require_once($root_path.'include/inc_config_color.php');

$thisfile=basename(__FILE__);

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_lab.php');
$enc_obj= new Encounter($encounter_nr);
$lab_obj=new Lab($encounter_nr);

//gjergji :
//diff for the date of birth
function dateDiff($dformat, $endDate, $beginDate){
	$date_parts1=explode($dformat, $beginDate);
	$date_parts2=explode($dformat, $endDate);
	$start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	$end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	return $end_date - $start_date;
}

/*if($from=='station') $breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$patnum";
	else $breakfile='labor_data_patient_such.php'.URL_APPEND;
*/

require($root_path.'include/inc_labor_param_group.php');

						
if(!isset($parameterselect)||empty($parameterselect)) $parameterselect='priority';

//$parameters=$paralistarray[$parameterselect];					
//$paramname=$parametergruppe[$parameterselect];


if($nostat) $ret=$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$pn";
	else $ret=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn";
	
# Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');

$enc_obj->setWhereCondition("encounter_nr='$encounter_nr'");

if($encounter=$enc_obj->getBasic4Data($encounter_nr)) {

	$patient=$encounter->FetchRow();

	$recs=&$lab_obj->getAllResults($encounter_nr);
	
	if ($rows=$lab_obj->LastRecordCount()){
		# Merge the records to common date key
		$records=array();
		$dt=array();
		while($buffer=$recs->FetchRow()){
			//$records[$buffer['job_id']]=&$buffer;
			$records[$buffer['job_id']]=unserialize($buffer['serial_value']);
			$tdate[$buffer['job_id']]=&$buffer['test_date'];
			$ttime[$buffer['job_id']]=&$buffer['test_time'];
		}
		//gjergji :
		// reverse date from past to current
		//had to use $tdatePrint for the arrayreverse to work...
		$tdatePrint = array_reverse($tdate,true);
		$tdate = array_reverse($tdate);
		$ttime = array_reverse($ttime);
		$records = array_reverse($records);
	}else{
		if($nostat) header("location:".$root_path."modules/laboratory/labor-nodatafound.php?sid=$sid&lang=$lang&patnum=$pn&ln=$result[name]&fn=$result[vorname]&nodoc=labor");
		 	else header("location:".$root_path."modules/nursing/nursing-station-patientdaten-nolabreport.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&nodoc=labor&user_origin=$user_origin");
			//else echo("location:".$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&nodoc=labor");
			exit;
	}
}else{
	echo "<p>".$lab_obj->getLastQuery()."sql$LDDbNoRead";
	exit;
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDLabReport - $LDGraph");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('lab_list.php','graph','','','$LDGraph')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDLabReport - $LDGraph");

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

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Assign patient basic elements
$smarty->assign('LDCaseNr',$LDCaseNr);
$smarty->assign('LDLastName',$LDLastName);
$smarty->assign('LDName',$LDName);
$smarty->assign('LDBday',LDBday);

# Assign patient basic data
$smarty->assign('encounter_nr',$encounter_nr);
$smarty->assign('sLastName',$patient['name_last']);
$smarty->assign('sName',$patient['name_first']);
$smarty->assign('sBday',formatDate2Local($patient['date_birth'],$date_format));
# Buffer page output

ob_start();

echo '
<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1 class="frame">';

# Get the number of colums
$cols=sizeof($tdate);
echo'
   <tr bgcolor="#dd0000" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDMsrUnit.'</b>&nbsp;</td>';
	while(list($x,$v)=each($tdatePrint))
	echo '
	<td class="a12_b"><font color="#ffffff">&nbsp;<b>'.formatDate2Local($v,$date_format).'<br>'.$x.'</b>&nbsp;</td>';
	reset($tdate);
	
	
	echo '</tr>';
echo'
   <tr bgcolor="#ffddee" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;</td>';


	while(list($x,$v)=each($ttime))
	echo '
	<td class="a12_b"><font color="#0000cc">&nbsp;<b>'.convertTimeToLocal($v).'</b> '.$LDOClock.'&nbsp;</td>';

	# Reset array
	reset($ttime);
	

# Prepare the graph values
$tparam=explode('~',$HTTP_POST_VARS['params']);
# Display the values
$tracker=0;
$displayedParam=array();
while (list($job_id,$parametrat)=each($records)) {
	$grpflag=true;
		while(list($param,$pname)=each($parametrat)){
			$flag=false;
			$param_name = $lab_obj->TestParamsDetails($param);
			# Reset the array
			reset($tdate);
			# Reset the sessbuf
			$sessbuf='';		
			while(list($job_id,$xval)=each($tdate)){ 
				while(list($x,$v)=each($tparam)) {	
					if($v==$param_name['id']) {
						# Prepare the values for graph tracing
						if($sessbuf==''){
							if($records[$job_id][$param]) $sessbuf.=$records[$job_id][$param];
								else $sessbuf.='0';
						}else{
							if($records[$job_id][$param]) $sessbuf.='~'.$records[$job_id][$param];
								else $sessbuf.='~';
						}
						$flag=true;
						$toggle=!$toggle;
					}
				}
				reset($tparam);
			}
			if($flag){
				# If parameters info not yet loaded, load now
				if($grpflag){
					$tparams=&$lab_obj->TestParams($group_id);
					$grpflag=false;
					while($tpbuf=&$tparams->FetchRow())	$tp[$tpbuf['id']]=&$tpbuf;
				}
				# Create the first colums boxes of a row
				//$txt='<tr bgcolor=';
		 		//if($toggle) { $txt.= '"#ffdddd"';}else { $txt.= '"#ffeeee"';}	 	
				if(!in_array($param_name['id'],$displayedParam)) {
					//gjergji : stupid idea for dealing with doubled values to show
					$displayedParam[$ptrack]=$param_name['id'];		 			
					$txt='<tr class=';
			 		if($toggle) { $txt.= '"wardlistrow1"';}else { $txt.= '"wardlistrow2"';}
					$txt.= '>
		     		<td class="va12_n"> &nbsp;<nobr><a href="#">'.$param_name['name'].'</a></nobr> 
					</td>
					<td class="a10_b" >&nbsp;';
					# gjergji : find the adeguate range limits
					$diferenca = dateDiff("-", date("Y-m-d"), $patient['date_birth']);
					switch ($diferenca) {
						case ( ($diferenca >= 1) and ($diferenca <= 30 ) ) :
							if($param_name['lo_bound_n']&&$param_name['hi_bound_n']) $txt.=$param_name['hi_bound_n'].'<p><br>&nbsp;'.$param_name['lo_bound_n'];
							break;
						case ( ($diferenca >= 31) and ($diferenca <= 360 ) ) :
							if($param_name['lo_bound__y']&&$param_name['hi_bound_y']) $txt.=$param_name['hi_bound_y'].'<p><br>&nbsp;'.$param_name['lo_bound_y'];
							break;
						case ( $diferenca >= 361) and ($diferenca <= 5040 ) :
							if($param_name['lo_bound_c']&&$param_name['hi_bound_c']) $txt.=$param_name['hi_bound_c'].'<p><br>&nbsp;'.$param_name['lo_bound_c'];
							break;
						case $diferenca > 5040 :
							if($patient['sex']=='m')
								if($param_name['lo_bound']&&$param_name['hi_bound']) $txt.=$param_name['hi_bound'].'<p><br>&nbsp;'.$param_name['lo_bound'];
							elseif($patient['sex']=='f')
								if($param_name['lo_bound_f']&&$param_name['hi_bound_f']) $txt.=$param_name['hi_bound_f'].'<p><br>&nbsp;'.$param_name['lo_bound_f'];	
							break;
					}	
					# The unit of measurement
					$txt.='</td>
		  			<td class="a10_b" >&nbsp;'.$param_name['msr_unit'].'</td>';					
					# do the graph
					$diferenca = dateDiff("-", date("Y-m-d"), $patient['date_birth']);
					switch ($diferenca) {
						case ( ($diferenca >= 1) and ($diferenca <= 30 ) ) :
							echo $txt.'<td colspan="'.$cols.'"><img  src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$param_name['lo_bound_n'].'&hi='.$param_name['hi_bound_n'].'&d='.$sessbuf.'" border=0>';
							break;
						case ( ($diferenca >= 31) and ($diferenca <= 360 ) ) :
							echo $txt.'<td colspan="'.$cols.'"><img  src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$param_name['lo_bound_y'].'&hi='.$param_name['hi_bound_y'].'&d='.$sessbuf.'" border=0>';
							break;
						case ( $diferenca >= 361) and ($diferenca <= 5040 ) :
							echo $txt.'<td colspan="'.$cols.'"><img  src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$param_name['lo_bound_c'].'&hi='.$param_name['hi_bound_c'].'&d='.$sessbuf.'" border=0>';
							break;
						case $diferenca > 5040 :
							if($patient['sex']=='m')
								echo $txt.'<td colspan="'.$cols.'"><img  src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$param_name['lo_bound'].'&hi='.$param_name['hi_bound'].'&d='.$sessbuf.'" border=0>';
							elseif($patient['sex']=='f')
								echo $txt.'<td colspan="'.$cols.'"><img  src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$param_name['lo_bound_f'].'&hi='.$param_name['hi_bound_f'].'&d='.$sessbuf.'" border=0>';
							break;
					}				
					echo '</td></tr>';	
					$ptrack++;		
				}
			}
		$tracker++;
		}
}
echo '
</table>
</form>';

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sLabResultsGraphTable',$sTemp);

$smarty->assign('sClose','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').' alt="'.$LDClose.'"></a>');

# Assign the include file to main frame template

 $smarty->assign('sMainBlockIncludeFile','laboratory/chemlab_data_results_graph.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
