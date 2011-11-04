<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');
require('./roots.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

define('SHOW_DOC_2',1);  # Define to 1 to  show the 2nd doctor-on-duty
define('DOC_CHANGE_TIME','7.30'); # Define the time when the doc-on-duty will change in 24 hours H.M format (eg. 3 PM = 15.00, 12 PM = 0.00)

define('MODULE','ambulatory');
define('LANG_FILE_MODULAR','ambulatory.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

/**
* Set default values if not available from url
*/
if (!isset($dept_nr)||empty($dept_nr)) { $dept_nr=$_SESSION['sess_dept_nr'];} # Default station must be set here !!
if(!isset($pday)||empty($pday)) $pday=date('d');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;

if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;

//$db->debug=1;

$tnow=date('H:i:s');
	
if(!isset($mode)) $mode='';

$breakfile='ambulatory.php'.URL_APPEND; # Set default breakfile
$thisfile=basename(__FILE__);

if(isset($retpath)){
	switch($retpath)
	{
		case 'quick': $breakfile='nursing-quickview.php'.URL_APPEND;
							break;
		case 'ward_mng': $breakfile='nursing-ward-info.php'.URL_APPEND.'&ward_nr='.$ward_nr.'&mode=show';
	}
}
# Mark where we are
$_SESSION['sess_user_origin']='amb';

# Load date formatter 
require_once($root_path.'include/helpers/inc_date_format_functions.php');
  
if(($mode=='')||($mode=='fresh')){

	# Create encounter object
	include_once($root_path.'include/core/class_encounter.php');
	$enc_obj= new Encounter;
	
	# Get all outpatients for this dept
	$opat_obj=&$enc_obj->OutPatientsBasic($dept_nr);
	//echo $enc_obj->getLastQuery();
	$rows=$enc_obj->LastRecordCount();
	# If dept name is empty, fetch by location nr
	if(!isset($dept)||empty($dept)){
		# Create department object 
		include_once($root_path.'modules/dept_admin/model/class_department.php');
		$dept_obj= new Department;
		$deptLDvar=$dept_obj->LDvar($dept_nr);
		if(isset($$deptLDvar)&&!empty($$deptLDvar)) $dept=$$deptLDvar;
			else $dept=$dept_obj->FormalName($dept_nr);
	}
	# set to edit mode
	$edit=true;
	
		# Create the waiting outpatients' list
		$dnr=(isset($w_waitlist)&&$w_waitlist) ? 0 : $dept_nr;
		$waitlist=&$enc_obj->createWaitingOutpatientList($dnr);
		$waitlist_count=$enc_obj->LastRecordCount();
		//echo $waitlist_count.'<p>'.$enc_obj->getLastQuery();
		
		# Get the doctor's on duty information
		#### Start of routine to fetch doctors on duty
		$elem='duty_1_pnr';
		if(SHOW_DOC_2) $elem.=',duty_2_pnr';
		
		# Create staff object
		include_once($root_path.'modules/staff_admin/model/class_staff.php');
		$pers_obj=new staff;
			
		if($result=$pers_obj->getDOCDutyplan($dept_nr,$pyear,$pmonth,$elem)){
			$duty1=&unserialize($result['duty_1_pnr']);
			if(SHOW_DOC_2) $duty2=&unserialize($result['duty_2_pnr']);
					//echo $sql."<br>";
		}
		//echo $pers_obj->getLastQuery();
		# Adjust the day index. This is necessary since change of duty usually happens early morning  not midnight
		$offset_day=$pday-1;
		# Consider the early morning hours to belong to the past day
		if(date('H.i')<DOC_CHANGE_TIME) $offset_day--;
		if($pnr1=$duty1['ha'.$offset_day]){
			$person1=&$pers_obj->getstaffInfo($pnr1);
		}
		if(SHOW_DOC_2 && ($pnr2=$duty2['hr'.$offset_day])){
			$person2=&$pers_obj->getstaffInfo($pnr2);
		}
		#### End of routine to fetch doctors on duty
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle', $dept." :: $LDOutpatientClinic (".formatDate2Local($s_date,$date_format,'','',$null='').")");
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
  # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/ambulatory_clinic.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$dept." :: $LDOutpatientClinic (".formatDate2Local($s_date,$date_format,'','',$null='').")");

 # Collect extra javascript code

 ob_start();
?>
<script language="javascript">
<!-- 
  var urlholder;

function getinfo(pn){
<?php /* if($edit)*/
	{ echo '
	urlholder="'.$root_path.'modules/nursing/nursing-ward-patientdata.php'.URL_REDIRECT_APPEND;
	echo '&pn=" + pn + "';
	echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit&station=$station"; 
	echo '";';
	echo '
	patientwin=window.open(urlholder,pn,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	';
	}
	/*else echo '
	window.location.href=\'nursing-ward-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$station.'\'';*/
?>
	}
function getrem(pn){
	urlholder="<?php echo $root_path ?>modules/nursing/nursing-ward-remarks.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&dept_nr=$dept_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>";
	patientwin=window.open(urlholder,pn,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}
function release(nr)
{
	urlholder="amb_clinic_discharge.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+nr+"<?php echo "&pyear=".$pyear."&pmonth=".$pmonth."&pday=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>&station=<?php echo $station; ?>&dept_nr=<?php echo $dept_nr; ?>";
	//indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes"
	window.location.href=urlholder;
}

// Codice aggiunto per il foglio di anamnesi
function yellow(pn){
	urlholder="amb_yellow_paper.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&dept_nr=$ward_nr&location_nr=$ward_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station"; ?>";
	patientwin=window.open(urlholder,pn,"width=1000,height=600,menubar=no,resizable=yes,scrollbars=yes");
	}
//

// Codice aggiunto per il foglio di esame obiettivo
function target(pn){
	urlholder="amb_target_paper.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&dept_nr=$ward_nr&location_nr=$ward_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station"; ?>";
	patientwin=window.open(urlholder,pn,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}
//


function popinfo(l,d)
{
	urlholder="<?php echo $root_path ?>modules/doctors/doctors-rosterplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=450,menubar=no,resizable=yes,scrollbars=yes");

}
function assignWaiting(pn,pw)
{
	urlholder="amb_clinic_assignwaiting.php<?php echo URL_REDIRECT_APPEND ?>&pn="+pn+"&pdept="+pw+"&dept_nr=<?php echo $dept_nr ?>&station=<?php echo $station ?>";	
	asswin<?php echo $sid ?>=window.open(urlholder,"asswind<?php echo $sid ?>","width=650,height=500,menubar=no,resizable=yes,scrollbars=yes");

}
function Transfer(pn,pw)
{
	if(confirm("<?php echo $LDSureTransferPatient ?>")){
		urlholder="amb_clinic_transfer_select.php<?php echo URL_REDIRECT_APPEND ?>&pn="+pn+"&pat_station="+pw+"&dept_nr=<?php echo $dept_nr ?>&station=<?php echo $station ?>";	
		transwin<?php echo $sid ?>=window.open(urlholder,"transwin<?php echo $sid ?>","width=550,height=620,menubar=no,resizable=yes,scrollbars=yes");
	}
}

function billinfo(patnum)
{
	urlholder="<?php echo $root_path ?>modules/ecombill/patientbill.php<?php echo URL_REDIRECT_APPEND ?>&ntid=false&update=1&mode=search&patientno="+patnum+"&full_en="+patnum;
	window.location.href=urlholder;
}

<?php 
require($root_path.'include/helpers/inc_checkdate_lang.php'); 
?>
// -->
</script>

<?php
$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# If ward exists, show the occupancy list

if($rows){

	$smarty->assign('bShowPatientsList',TRUE);

	if($s_date<date('Y-m-d')){
	 	$smarty->assign('sWarningPrompt','<img '.createComIcon($root_path,'warn.gif','0','absmiddle',TRUE).'> <font color="#ff0000"><b>'.$LDAttention.'</font> '.$LDOldList.'</b>');

		# Prevent adding new patients to the list  if list is old
		$edit=FALSE;
	}

	# Start here, create the occupancy list
	# Assign the column  names

	$smarty->assign('LDTime',$LDTime);
	$smarty->assign('LDRoom',$LDRoom);
	$smarty->assign('LDBed',$LDPatListElements[1]);
	$smarty->assign('LDFamilyName',$LDLastName);
	$smarty->assign('LDName',$LDName);
	$smarty->assign('LDBirthDate',$LDBirthDate);
	$smarty->assign('LDPatNr',$LDPatListElements[4]);
	$smarty->assign('LDInsuranceType',$LDPatListElements[5]);
	$smarty->assign('LDOptions',$LDPatListElements[6]);

	# Initialize help flags
	$toggle=1;
	$room_info=array();

	$males=0;
	$females=0;

	# Initialize list rows container string
	$sListRows='';

	# Loop trough patients

	while ($patient=$opat_obj->FetchRow()){

			if($patient['encounter_nr']==$sEncNrBuffer) continue;
				else $sEncNrBuffer=$patient['encounter_nr'];

			# Reset elements

			$smarty->assign('sMiniColorBars','');
			$smarty->assign('sRoom','');
			$smarty->assign('sBed','');
			$smarty->assign('sBedIcon','');
			$smarty->assign('cComma','');
			$smarty->assign('sFamilyName','');
			$smarty->assign('sName','');
			$smarty->assign('sTitle','');
			$smarty->assign('sBirthDate','');
			$smarty->assign('sPatNr','');
			$smarty->assign('sAdmitDataIcon','');
			$smarty->assign('sChartFolderIcon','');
			$smarty->assign('sNotesIcon','');
			$smarty->assign('sTransferIcon','');
			$smarty->assign('sDischargeIcon','');
			$smarty->assign('sYellowPaper','');
			$smarty->assign('sTarget','');

			$sAstart='';
			$sAend='';
			$sFamNameBuffer='';
			$sNameBuffer='';

			# set row color/class

			if ($toggle){
				$smarty->assign('bToggleRowClass',TRUE);
			}else{
				$smarty->assign('bToggleRowClass',FALSE);
			}

			$toggle=!$toggle;


			# If appt time is past the now time, color font with red
			if($patient['time']<$tnow) $smarty->assign('sTimeFontClass'.'class="cave_data"');
				elseif(($patient['time']>=$tnow)&&($patient['time']<=$tnow)) $smarty->assign('sTimeFontClass'.'class="go_data"');

			if($patient['time']) $smarty->assign('sTime',convertTimeToLocal($patient['time'],$date_format));

			# If patient and edit show small color bars
			if($edit){
			 	$smarty->assign('sMiniColorBars','<a href="javascript:getinfo(\''.$patient['encounter_nr'].'\')">
			 		<img src="'.$root_path.'include/imgcreator/imgcreate_colorbar_small.php'.URL_APPEND.'&pn='.$patient['encounter_nr'].'" alt="'.$LDSetColorRider.'" align="absmiddle" border=0 width=80 height=18>
			 		</a>');
			}
			

			# Show images by sex

			$sBuffer = '<a href="javascript:popPic(\''.$patient['pid'].'\')" title="'.$LDShowPhoto.'">';
			switch(strtolower($patient['sex'])){
				case 'f':
						$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'spf.gif','0','',TRUE).'></a>');
						$females++;
						break;
				case 'm':
						$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'spm.gif','0','',TRUE).'></a>');
						$males++;
						break;
				default:
						$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'bn.gif','0','',TRUE).'></a>');
			}

			# Show the patients name with link to open charts
			if($edit){

				$sAstart = '<a href="'.$root_path.'modules/registration_admission/admission_pass.php'.URL_APPEND.'&target=search&fwd_nr='.$patient['encounter_nr'].'" title="'.$LDClk2Show.'">';

			}

			$smarty->assign('sTitle',ucfirst($patient['title']));

			if(isset($sln)&&$sln) $sFamNameBuffer = str_ireplace($sln,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($patient['name_last']));
				else $sFamNameBuffer = ucfirst($patient['name_last']);

			if($bed['name_last']) $smarty->assign('cComma',',');
				else $smarty->assign('cComma','');

			if(isset($sfn)&&$sfn) $sNameBuffer = str_ireplace($sfn,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($patient['name_first']));
				else $sNameBuffer = ucfirst($patient['name_first']);


			if($edit) $sAend ='</a>';
				else $sAend='';

			# Assign the family and first names together with the <a href></a> tags

			$smarty->assign('sFamilyName',$sAstart.$sFamNameBuffer.$sAend);
			$smarty->assign('sName',$sAstart.$sNameBuffer.$sAend);


			if($patient['date_birth']){

				if(isset($sg)&&$sg) $smarty->assign('sBirthDate',str_ireplace($sg,"<font color=#ff0000><b>".ucfirst($sg)."</b></font>",formatDate2Local($patient['date_birth'],$date_format)));
					else $smarty->assign('sBirthDate',formatDate2Local($patient['date_birth'],$date_format));
			}

			if ($patient['encounter_nr']) $smarty->assign('sPatNr',$patient['encounter_nr']);

			$sBuffer = '';
			if($patient['insurance_class_nr']!=2) $sBuffer = $sBuffer.'<font color="#ff0000">';

			if(isset($$patient['LD_var'])&&!empty($$patient['LD_var']))  $sBuffer = $sBuffer.$$patient['LD_var'];
				else  $sBuffer = $sBuffer.$patient['insurance_name'];

			$smarty->assign('sInsuranceType',$sBuffer);

			if($edit){

				$smarty->assign('sAdmitDataIcon','<a href="'.$root_path.'modules/registration_admission/admission_pass.php'.URL_APPEND.'&target=search&fwd_nr='.$patient['encounter_nr'].'" title="'.$LDAdmissionData.' : '.$LDClk2Show.'"><img '.createComIcon($root_path,'pdata.gif','0','',TRUE).' alt="'.$LDAdmissionData.' : '.$LDClk2Show.'"></a>');

				$smarty->assign('sChartFolderIcon','<a href="javascript:getinfo(\''.$patient['encounter_nr'].'\')"><img '.createComIcon($root_path,'open.gif','0','',TRUE).' alt="'.$LDShowPatData.'"></a>');

				$sBuffer = '<a href="javascript:getrem(\''.$patient['encounter_nr'].'\')"><img ';
				if($patient['notes']) $sBuffer = $sBuffer.createComIcon($root_path,'bubble3.gif','0','',TRUE);
					else $sBuffer = $sBuffer.createComIcon($root_path,'bubble2.gif','0','',TRUE);
				$sBuffer = $sBuffer.' alt="'.$LDNoticeRW.'"></a>';

				$smarty->assign('sNotesIcon',$sBuffer);

				$smarty->assign('sTransferIcon','<a href="javascript:Transfer(\''.$patient['encounter_nr'].'\')"><img '.createComIcon($root_path,'xchange.gif','0','',TRUE).' alt="'.$LDTransferPatient.'"></a>');
				$smarty->assign('sDischargeIcon','<a href="javascript:release(\''.$patient['encounter_nr'].'\')" title="'.$LDReleasePatient.'"><img '.createComIcon($root_path,'bestell.gif','0','',TRUE).' alt="'.$LDReleasePatient.'"></a>');
				$smarty->assign('sBillIcon','<a href="javascript:billinfo(\''.$patient['encounter_nr'].'\')" title="'.$LDBillPatient.'"><img '.createComIcon($root_path,'dollarsign.gif','0','',TRUE).' alt="'.$LDBillPatient.'"></a>');
			}

			# Create the rows using ward_occupancy_list_row.tpl template
			ob_start();
				$smarty->display(__DIR__ . '/view/outpatients_list_row.tpl');
				$sListRows = $sListRows.ob_get_contents();
			ob_end_clean();

		# Append the new row to the previous row in string

		$smarty->assign('sOccListRows',$sListRows);

	} // end of patients loop
}else{

	# Prompt no outpatients available
	$smarty->assign('sWarningPrompt','
			'.str_replace("~station~",strtoupper($station),$LDNoOutpatients).'</b></font><br><img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','',TRUE).'>
			<a href="'.$root_path.'modules/appointment_scheduler/appt_main_pass.php'.URL_APPEND.'&dept_nr='.$dept_nr.'&dept_name='.$dept.'">'.$LDGoToAppointments.'</a><p>
			</ul></div>');
}

# Assign href  for  bottom close button
$smarty->assign('pbClose','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp');

# Declare template items
$TP_DOC1_BLOCK='';
$TP_DOC2_BLOCK='';
$TP_ICON1='';
$TP_ICON2='';
$TP_Legend1_BLOCK='';

//$buf1='<img '.createComIcon($root_path,'powdot.gif','0','absmiddle').'>';
# Create waiting list block
if($waitlist_count){
	while($waitpatient=$waitlist->FetchRow()){
		$buf2='';
		if($waitpatient['current_dept_nr']!=$dept_nr) $buf2=createComIcon($root_path,'red_dot.gif','0','',TRUE);
			else  $buf2=createComIcon($root_path,'green_dot.gif','0','',TRUE);
		$TP_WLIST_BLOCK.='<nobr><img '.$buf2.'>&nbsp;<a href="javascript:assignWaiting(\''.$waitpatient['encounter_nr'].'\',\''.$waitpatient['dept_LDvar'].'\')">'.$waitpatient['name_last'].', '.$waitpatient['name_first'].' '.formatDate2Local($waitpatient['date_birth'],$date_format).'</nobr></a><br>';
	}
}
$wlist_url=$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&edit='.$edit.'&station='.$station;
if($w_waitlist){
	$TP_WLIST_OPT =	'[<a href="'.$wlist_url.'&w_waitlist=0">'.$LDShowClinicOnly.'</a>]';
}else{
	$TP_WLIST_OPT=	'[<a href="'.$wlist_url.'&w_waitlist=1">'.$LDShowAll.'</a>]';
}

# Create doctors-on-duty block
if(isset($person1)){
	$TP_DOC1_BLOCK='<a href="javascript:popinfo(\''.$pnr1.'\',\''.$dept_nr.'\')" title="'.$LDClk4Phone.'">'.$person1['name_last'].', '.$person1['name_first'].'</a>';
	$TP_ICON1='<img '.createComIcon($root_path,'violet_phone.gif','0','absmiddle',TRUE).'>';
}
if(isset($person2)){
	$TP_DOC2_BLOCK='<a href="javascript:popinfo(\''.$pnr2.'\',\''.$dept_nr.'\')" title="'.$LDClk4Phone.'">'.$person2['name_last'].', '.$person2['name_first'].'</a>';
	$TP_ICON2=$TP_ICON1;
}

$TP_Legend1_BLOCK.='
<nobr>&nbsp;<img '.createComIcon($root_path,'green_dot.gif','0','absmiddle',TRUE).'>&nbsp;<b>'.$LDOwnPatient.'</b></nobr><br>
<nobr>&nbsp;<img '.createComIcon($root_path,'red_dot.gif','0','absmiddle',TRUE).'> <b>'.$LDNonOwnPatient.'</b></nobr><br>';
# Create the data block
if($edit&&$rows){
$TP_Legend1_BLOCK.= '&nbsp;<img '.createComIcon($root_path,'pdata.gif','0','absmiddle',TRUE).'> <b>'.$LDAdmissionData.'</b><br>
		&nbsp;<img '.createComIcon($root_path,'open.gif','0','absmiddle',TRUE).'> <b>'.$LDOpenFile.'</b><br>
		&nbsp;<img '.createComIcon($root_path,'yellowlist.gif','0','absmiddle',TRUE).'> <b>'.$LDYellowPaper.'</b><br>
		&nbsp;<img '.createComIcon($root_path,'articles.gif','0','absmiddle',TRUE).'> <b>'.$LDTarget.'</b><br>		
		&nbsp;<img '.createComIcon($root_path,'bubble2.gif','0','absmiddle',TRUE).'> <b>'.$LDNotesEmpty.'</b><br>
		&nbsp;<img '.createComIcon($root_path,'bubble3.gif','0','absmiddle',TRUE).'> <b>'.$LDNotes.'</b><br>
		&nbsp;<nobr><img '.createComIcon($root_path,'xchange.gif','0','absmiddle',TRUE).'> <b>'.$LDTransferPatient.'</b></nobr><br>
		&nbsp;<img '.createComIcon($root_path,'bestell.gif','0','absmiddle',TRUE).'> <b>'.$LDRelease.'</b><br>
		';

$TP_Legend2_BLOCK= '
&nbsp;<img '.createComIcon($root_path,'spf.gif','0','absmiddle',TRUE).'> <b>'.$LDFemale.'</b><br>
&nbsp;<img '.createComIcon($root_path,'spm.gif','0','absmiddle',TRUE).'> <b>'.$LDMale.'</b><br>';
}
# Load the quick info block template
$smarty->assign('LDWaitingList',$LDWaitingList);
$smarty->assign('TP_WLIST_BLOCK',$TP_WLIST_BLOCK);
$smarty->assign('TP_WLIST_OPT',$TP_WLIST_OPT);
$smarty->assign('LDQuickInformer',$LDQuickInformer);
$smarty->assign('males',$males);
$smarty->assign('LDMale',$LDMale);
$smarty->assign('females',$females);
$smarty->assign('LDFemale',$LDFemale);
$smarty->assign('LDDutyDoctor',$LDDutyDoctor);
$smarty->assign('TP_ICON1',$TP_ICON1);
$smarty->assign('TP_DOC1_BLOCK',$TP_DOC1_BLOCK);
$smarty->assign('TP_ICON2',$TP_ICON2);
$smarty->assign('TP_DOC2_BLOCK',$TP_DOC2_BLOCK);
$smarty->assign('LDLegend',$LDLegend);
$smarty->assign('TP_Legend1_BLOCK',$TP_Legend1_BLOCK);
$smarty->assign('TP_Legend2_BLOCK',$TP_Legend2_BLOCK);
	# Buffer orig template output
	ob_start();
		$smarty->display(__DIR__ . '/view/tp_clinic_quickinfo.tpl');
		$sTemp = ob_get_contents();
	ob_end_clean();
	 # Assign to page template object
	$smarty->assign('sSubMenuBlock',$sTemp);

// Assign page output to the mainframe template
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/outpatients.tpl');

//$smarty->compile_check = true; $smarty->debugging = true; $smarty->display('debug.tpl');
$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');