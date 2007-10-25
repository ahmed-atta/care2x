<?php
define('ROW_MAX',2); # define here the maximum number of rows for displaying the parameters

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
//$lang_tables=array('chemlab_groups.php','chemlab_params.php');
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(!$encounter_nr) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 

if(!isset($user_origin)||empty($user_origin)) $user_origin='lab';

# Create encounter object
require_once($root_path.'include/care_api_classes/class_encounter.php');
$encounter=new Encounter($encounter_nr);

///$db->debug=1;

$thisfile='labor_datainput.php';

# Create lab object
require_once($root_path.'include/care_api_classes/class_lab.php');
$lab_obj=new Lab($encounter_nr);

# Load the date formatter
include_once($root_path.'include/inc_date_format_functions.php');
    
if($mode=='save'){
	
	$nbuf=array();
	# Prepare parameter values and serialize
	//gjergji :
	// chaged the serialization for the lab 
	while (list($z,$y)=each($HTTP_POST_VARS)) {
		
		if($result_tests = $lab_obj->GetTestsToDo($job_id))
			while($row_tests = $result_tests->FetchRow())	{
				parse_str($row_tests['parameters'], $arr_tasks);
				if(isset($arr_tasks[$z])&&!empty($arr_tasks[$z])){
				 	$nbuf[$z]=$y;
				}
		}
	}

	$dbuf['group_id']=$parameterselect;
	$dbuf['serial_value']=serialize($nbuf);
	$dbuf['job_id']=$job_id;
	$dbuf['encounter_nr']=$encounter_nr;
	if($allow_update){
		
		$dbuf['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$dbuf['modify_time']=date('YmdHis');

		# Recheck the date, ! bug pat	$dbuf['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];ch
		if($HTTP_POST_VARS['std_date']==DBF_NODATE) $dbuf['test_date']=date('Y-m-d');
	
		$lab_obj->setDataArray($dbuf);
		# set update pointer
		$lab_obj->setWhereCondition("batch_nr='$batch_nr'");
		if($lab_obj->updateDataFromInternalArray($batch_nr)){
			$saved=true;
		}else{echo "<p>".$lab_obj->getLastQuery()."$LDDbNoSave";}
	
	}else{
		
		# Hide old job record if it exists
		$lab_obj->hideResultIfExists($encounter_nr,$job_id,$parameterselect);
		# Convert date to standard format
		if(isset($std_date)){
			if($HTTP_POST_VARS['std_date']==DBF_NODATE) $dbuf['test_date']=date('Y-m-d');
				else 	$dbuf['test_date']=$HTTP_POST_VARS['std_date'];
		}else{
			$dbuf['test_date']=formatDate2STD($HTTP_POST_VARS['test_date'],$date_format);
		}
		$dbuf['test_time']=date('H:i:s');
		
		$dbuf['history']="Create ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		$dbuf['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$dbuf['create_time']=date('YmdHis');
		# Insert new job record
		$lab_obj->setDataArray($dbuf);
		if($lab_obj->insertDataFromInternalArray()){
			//echo $sql." new insert <br>";

			$pk_nr=$db->Insert_ID();
            $batch_nr=$lab_obj->LastInsertPK('batch_nr',$pk_nr);
			$saved=true;
		}else{echo "<p>".$lab_obj->getLastQuery()."$LDDbNoSave";}
		
	}
	# If save successful, jump to display values
	if($saved){
		include_once($root_path.'include/inc_visual_signalling_fx.php');
		# Set the visual signal 
		setEventSignalColor($encounter_nr,SIGNAL_COLOR_DIAGNOSTICS_REPORT);							
		header("location:$thisfile?sid=$sid&lang=$lang&saved=1&batch_nr=$batch_nr&encounter_nr=$encounter_nr&job_id=$job_id&parameterselect=$parameterselect&allow_update=1&user_origin=$user_origin");
	}
# end of if(mode==save)
} else { #If mode is not "save" then get the basic personal data 
	
	# Create encounter object
	//include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter($encounter_nr);
	if($encounter=&$enc_obj->getBasic4Data($encounter_nr)){
		$patient=$encounter->FetchRow();
	}
	# If previously saved, get the values
	$pdata=array();
	if($saved){
		if($result=&$lab_obj->getBatchResult($batch_nr)){
			$row=$result->FetchRow();
			$pdata=unserialize($row['serial_value']);
		}
	}else{
		if($result=&$lab_obj->getResult($job_id,$parameterselect)){
			$row=$result->FetchRow();
			$pdata=unserialize($row['serial_value']);
		}else{
			# disallow update if group does not exist yet
			$allow_update=false;
		}
	}
			
	# Get the test test groups
	$tgroups=&$lab_obj->TestActiveGroups();
	# Get the test parameter values
	//gjergji : take all the params for this group...
	//$tparams=&$lab_obj->TestParams($parameterselect);
	$tparams=&$lab_obj->TestParams();

	# Set the return file
	if(isset($job_id)&&$job_id){
		switch($user_origin){
			case 'lab_mgmt':  $breakfile="labor_test_request_admin_chemlabor.php".URL_APPEND."&pn=$encounter_nr&batch_nr=$job_id&user_origin=lab"; 
					break;
			default: $breakfile="labor_data_check_arch.php".URL_APPEND."&versand=1&encounter_nr=$encounter_nr";
		}
	}else{
		$breakfile="labor_data_patient_such.php".URL_APPEND."&mode=edit";
	}
}

// echo "from table ".$linecount;
if($saved || $row['test_date']) $std_date=$row['test_date'];

# Prepare title
 if($update) $sTitle="$LDLabReport - $LDEdit";
 	else $sTitle= "$LDNew $LDLabReport";

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTitle);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('lab.php','input','main','$job_id')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

 # collect extra javascript code
 ob_start();
?>

<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>

<script language="javascript" name="j1">
<!--        
function pruf(d)
{
	if(!d.job_id.value)
		{ alert("<?php echo $LDAlertJobId ?>");
			d.job_id.focus();
			 return false;
		}
		else
		{
			if(d.test_date){
				if(!d.test_date.value)
				{ alert("<?php echo $LDAlertTestDate ?>");
					d.test_date.focus();
					return false;
				}
				else return true;
			}
		} 
}
function chkselect(d)
{
 	if(d.parameterselect.value=="<?php echo $parameterselect ?>"){
		return false;
	}
}
function labReport(){
	window.location.replace("<?php echo 'labor_datalist_noedit.php'.URL_REDIRECT_APPEND.'&encounter_nr='.$encounter_nr.'&noexpand=1&from=input&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&nostat=1&user_origin=lab'; ?>");
}
<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
// -->
</script>
<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);
		//gjergji : new calendar
		require_once ('../../js/jscalendar/calendar.php');
		$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
		$calendar->load_files();
		//end : gjergji
# Assign patient basic elements
$smarty->assign('LDCaseNr',$LDCaseNr);
$smarty->assign('LDLastName',$LDLastName);
$smarty->assign('LDName',$LDName);
$smarty->assign('LDBday',$LDBday);
$smarty->assign('LDJobIdNr',$LDJobIdNr);
$smarty->assign('LDExamDate',$LDExamDate);

# Assign patient basic data
$smarty->assign('encounter_nr',$encounter_nr);
$smarty->assign('sLastName',$patient['name_last']);
$smarty->assign('sName',$patient['name_first']);
$smarty->assign('sBday',formatDate2Local($patient['date_birth'],$date_format));

if($saved||$job_id) $smarty->assign('sJobIdNr',$job_id.'<input type=hidden name=job_id value="'.$job_id.'">');
	else $smarty->assign('sJobIdNr','<input name="job_id" type="text" size="14">');

$smarty->assign('sExamDate',$LDExamDate);

if($saved||$row['test_date']||$std_date){
   $smarty->assign('sExamDate',formatDate2Local($std_date,$date_format).'<input type=hidden name="std_date" value="'.$std_date.'">');
}else{
	//gjergji : new calendar
	$smarty->assign('sMiniCalendar',$calendar->show_calendar($calendar,$date_format,'test_date'));
	//end : gjergji
}

# Assign parameter elements

$smarty->assign('sParamGroup',strtr($parametergruppe[$parameterselect],"_","-"));

$smarty->assign('pbSave','<input  type="image" '.createLDImgSrc($root_path,'savedisc.gif','0').'>');
$smarty->assign('pbShowReport','<a href="labor_datalist_noedit.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&noexpand=1&from=input&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&nostat=1&user_origin='.$user_origin.'"><img '.createLDImgSrc($root_path,'showreport.gif','0','absmiddle').' alt="'.$LDClk2See.'"></a>');

if($saved) $sCancelBut='<img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').'>';
	else $sCancelBut='<img  '.createLDImgSrc($root_path,'cancel.gif','0','absmiddle').'>';

$smarty->assign('pbCancel',"<a href=\"$breakfile\">$sCancelBut</a>");

$smarty->assign('sAskIcon',"<img ".createComIcon($root_path,'small_help.gif','0').">");

$smarty->assign('sFormAction',$thisfile);

# Buffer parameter items generation

ob_start();
?>

<?php if($error) : ?>
<tr bgcolor=#ffffee>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
In <font color=red>rot</font> gekennzeichnet<?php if ($errornum>1) echo "en"; else echo "em"; ?>&nbsp;
Feld<?php if ($errornum>1) echo "ern"; ?>&nbsp;
fehl<?php if ($errornum>1) echo "en"; else echo "t eine"; ?>&nbsp;
Information<?php if ($errornum>1) echo "en"; ?>!
</center>
</td>
</tr>
<?php endif; ?>


<?php 
$paramnum=sizeof($parameters);

$pcols=ROW_MAX;

echo '<tr>';

for($j=0;$j<$pcols;$j++){
echo '
<td class="a10_n">&nbsp;'.$LDParameter.'</td>
<td  class="a10_n">&nbsp;'.$LDValue.'</td>';
}

echo '
	</tr>';

//order the params according to groups
$rowlimit=0;
$requestData=array();
if($result_tests = $lab_obj->GetTestsToDo($job_id)) {
	if($row_tests = $result_tests->FetchRow())	{
		parse_str($row_tests['parameters'], $arr_tasks);
		while(list($x,$v)=each($arr_tasks)) {
		$ext='';
		$ext = substr(stristr($x, '__'), 2);
		$requestData[$ext][$x] = 1;

		}
	}
}
//print_r($requestData);
reset($requestData);
echo '
<tr>';
//display them
$collimit=0;
while(list($group,$pm)=each($requestData)) {
	$gName = $lab_obj->getGroupName($group ) ;
	echo '
	</tr><tr>';	
	echo '<td bgcolor="#ffffee" class="a10_a"><nobr>&nbsp;<b>';
	echo $gName->fields['name'];
	echo '</b>&nbsp;</nobr>';
	echo '</td>';
	//$collimit++;	
	while(list($pId,$not)=each($pm)) {
		$pName = $lab_obj->TestParamsDetails($pId);
		echo '<td bgcolor="#ffffee" class="a10_b">';
		echo $pName['name'] . '</td>';
		echo '<td>';

			echo '<input name="'.$pId.'" type="text" size="8" ';
			echo 'value="';
			if(isset($pdata[$pId])&&!empty($pdata[$pId])) echo trim($pdata[$pId]);
			echo '">';		

		echo '</td>';
		$collimit++;
		if($collimit==8){
			echo '
			</tr><tr>';	
			$collimit=0;
		}
	}
}

 # Assign parameter output
 
 $sTemp = ob_get_contents();
 ob_end_clean();
 
 $smarty->assign('sParameters',$sTemp);

# Collect hidden inputs for the parameters form

ob_start();

?>
<input type=hidden name="encounter_nr" value="<?php echo $encounter_nr; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="update" value="<?php echo $update; ?>">
<input type=hidden name="allow_update" value="<?php if(isset($allow_update)) echo $allow_update; ?>">
<input type=hidden name="batch_nr" value="<?php if(isset($row['batch_nr'])) echo $row['batch_nr']; ?>">
<input type=hidden name="newid" value="<?php echo $newid; ?>">
<input type=hidden name="user_origin" value="<?php echo $user_origin; ?>">
<input type=hidden name="mode" value="save">
<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->assign('sSaveParamHiddenInputs',$sTemp);

# Collect hidden inputs for the parameter group selector
ob_start();
?>
<input type=hidden name="encounter_nr" value="<?php echo $encounter_nr; ?>">
<input type=hidden name="job_id" value="<?php echo $job_id; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="update" value="<?php echo $update; ?>">
<input type=hidden name="allow_update" value="<?php if( isset($allow_update)) echo $allow_update; ?>">
<input type=hidden name="batch_nr" value="<?php if(isset($row['batch_nr'])) echo $row['batch_nr']; ?>">
<input type=hidden name="newid" value="<?php echo $newid; ?>">
<input type=hidden name="std_date" value="<?php echo $std_date; ?>">
<input type=hidden name="user_origin" value="<?php echo $user_origin; ?>">
<input type=hidden name="changegroup" value="1">
<input type=hidden name="saved" value="0">
<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sSelectGroupHiddenInputs',$sTemp);


# Assign help items
$smarty->assign('LDParamNoSee',"<a href=\"Javascript:gethelp('lab.php','input','param')\">$LDParamNoSee</a>");
$smarty->assign('LDOnlyPair',"<a href=\"Javascript:gethelp('lab.php','input','few')\">$LDOnlyPair</a>");
$smarty->assign('LDHow2Save',"<a href=\"Javascript:gethelp('lab.php','input','save')\">$LDHow2Save</a>");
$smarty->assign('LDWrongValueHow',"<a href=\"Javascript:gethelp('lab.php','input','correct')\">$LDWrongValueHow</a>");
$smarty->assign('LDVal2Note',"<a href=\"Javascript:gethelp('lab.php','input','note')\">$LDVal2Note</a>");
$smarty->assign('LDImDone',"<a href=\"Javascript:gethelp('lab.php','input','done')\">$LDImDone</a>");

# Assign the include file to mainframe

 $smarty->assign('sMainBlockIncludeFile','laboratory/chemlab_data_results.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
