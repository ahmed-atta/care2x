<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

define('SHOW_DOC_2',1);  # Define to 1 to  show the 2nd doctor-on-duty
define('DOC_CHANGE_TIME','7.30'); # Define the time when the doc-on-duty will change in 24 hours H.M format (eg. 3 PM = 15.00, 12 PM = 0.00)

$lang_tables[]='ambulatory.php';
$lang_tables[]='prompt.php';
$lang_tables[]='departments.php';
define('LANG_FILE','nursing.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/**
* Set default values if not available from url
*/
if (!isset($dept_nr)||empty($dept_nr)) { $dept_nr=$HTTP_SESSION_VARS['sess_dept_nr'];} # Default station must be set here !!
if(!isset($pday)||empty($pday)) $pday=date('d');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;

if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;


$tnow=date('H:i:s');
	
if(!isset($mode)) $mode='';

$breakfile='ambulatory.php'.URL_APPEND; # Set default breakfile
$thisfile=basename(__FILE__);

if(isset($retpath)){
	switch($retpath)
	{
		case 'quick': $breakfile='nursing-schnellsicht.php'.URL_APPEND;
							break;
		case 'ward_mng': $breakfile='nursing-station-info.php'.URL_APPEND.'&ward_nr='.$ward_nr.'&mode=show';
	}
}
# Mark where we are
$HTTP_SESSION_VARS['sess_user_origin']='amb';

# Load date formatter 
require_once($root_path.'include/inc_date_format_functions.php');
  
if(($mode=='')||($mode=='fresh')){

	# Create encounter object
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj= new Encounter;
	
	# Get all outpatients for this dept
	$opat_obj=&$enc_obj->OutPatientsBasic($dept_nr);
	//echo $enc_obj->getLastQuery();
	$rows=$enc_obj->LastRecordCount();
	# If dept name is empty, fetch by location nr
	if(!isset($dept)||empty($dept)){
		# Create department object 
		include_once($root_path.'include/care_api_classes/class_department.php');
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
		
		# Create personnel object
		include_once($root_path.'include/care_api_classes/class_personell.php');
		$pers_obj=new Personell;
			
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
			$person1=&$pers_obj->getPersonellInfo($pnr1);
		}
		if(SHOW_DOC_2 && ($pnr2=$duty2['hr'.$offset_day])){
			$person2=&$pers_obj->getPersonellInfo($pnr2);
		}
		#### End of routine to fetch doctors on duty
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
  var urlholder;

function getinfo(pn){
<?php /* if($edit)*/
	{ echo '
	urlholder="'.$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_REDIRECT_APPEND;
	echo '&pn=" + pn + "';
	echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit&station=$station"; 
	echo '";';
	echo '
	patientwin=window.open(urlholder,pn,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	';
	}
	/*else echo '
	window.location.href=\'nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$station.'\'';*/
?>
	}
function getrem(pn){
	urlholder="<?php echo $root_path ?>modules/nursing/nursing-station-remarks.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&dept_nr=$dept_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>";
	patientwin=window.open(urlholder,pn,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}
function release(nr)
{
	urlholder="amb_clinic_discharge.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+nr+"<?php echo "&pyear=".$pyear."&pmonth=".$pmonth."&pday=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>&station=<?php echo $station; ?>&dept_nr=<?php echo $dept_nr; ?>";
	//indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes"
	window.location.href=urlholder;
}

function popinfo(l,d)
{
	urlholder="<?php echo $root_path ?>modules/doctors/doctors-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
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
<?php 
require($root_path.'include/inc_checkdate_lang.php'); 
?>
// -->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=3  FACE="Arial"><STRONG> &nbsp;&nbsp; <?php echo $dept." :: $LDOutpatientClinic (".formatDate2Local($s_date,$date_format,'','',$null='').")" ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('nursing_station.php','<?php echo $mode ?>','<?php echo $occup ?>','<?php echo $station ?>','<?php echo "$LDStation" ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<?php

if($rows){

	if($s_date<date('Y-m-d')){
	 	echo '
		<font face="verdana,arial" size="2"><img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> <font color="#ff0000"><b>'.$LDAttention.'</font> '.$LDOldList.'</b></font> ';
		$edit=0;
	}

# Start here, create the occupancy list

$occ_list='<table  cellpadding="0" cellspacing=0 border="0" >';

$occ_list.='<tr bgcolor="#0000dd" align=center>';
# Add the description row

$occ_list.='
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDTime.'&nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDLastName.'&nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDName.'&nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDBirthDate.' &nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDFinanceType.'&nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDAdm_Nr.'&nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDOptions.'&nbsp;&nbsp;</b></td>';
	

$occ_list.= '</tr>';

$toggle=1;
$room_info=array();
$males=0;
$females=0;
while ($patient=$opat_obj->FetchRow()){
 	
	# set row color
	$occ_list.='
			<tr bgcolor=';
	if ($toggle) $occ_list.='"#fefefe">'; else $occ_list.='"#dfdfdf">';
	
	$toggle=!$toggle;

	$occ_list.='
			<td><font face="verdana,arial" size="2"';
	# If appt time is past the now time, color font with red
	if($patient['time']<$tnow) $occ_list.=' color="red"';
		elseif(($patient['time']>=$tnow)&&($patient['time']<=$tnow)) $occ_list.=' color="green"';
	$occ_list.='>';
	if($patient['time']) $occ_list.=convertTimeToLocal($patient['time'],$date_format);
	$occ_list.='&nbsp;</td><td>';
	# If edit show small color bars
	if($edit)
	{  
		 $occ_list.='<a href="javascript:getinfo(\''.$patient['encounter_nr'].'\')">
		 <img src="'.$root_path.'main/imgcreator/imgcreate_colorbar_small.php'.URL_APPEND.'&pn='.$patient['encounter_nr'].'" alt="'.$LDSetColorRider.'" align="absmiddle" border=0 width=80 height=18>
		 </a>';
    }
	$occ_list.='&nbsp;
			</td>
			<td align=center><font face="verdana,arial" size="2" >';
	# If patient, show images by sex
	$occ_list.='<a href="javascript:popPic(\''.$patient['name_last'].', '.$patient['name_first'].' '.formatDate2Local($patient['date_birth'],$date_format).'\',\''.$patient['photo_filename'].'\')">';
		switch(strtolower($patient['sex']))
		{
			case 'f': $occ_list.='<img '.createComIcon($root_path,'spf.gif','0').'>'; $females++; break;
			case 'm': $occ_list.='<img '.createComIcon($root_path,'spm.gif','0').'>'; $males++; break;
			default: $occ_list.='<img '.createComIcon($root_path,'bn.gif','0').'>';break;
		}

	 $occ_list.='</a>';

	$occ_list.='&nbsp;
	</td>';
	$occ_list.='
			<td><font face="verdana,arial" size="2" >';
	# Show the patients name with link to open charts
	if($edit)
	{
	  $occ_list.='<a href="javascript:';
	   $occ_list.='getinfo(\''.$patient['encounter_nr'].'\')" title="'.$LDShowPatData.'">'; // ln=last name fn=first name
	}

	$occ_list.=ucfirst($patient['title']).' ';
		
	 $occ_list.=ucfirst($patient['name_last']); 
	
	if($edit) $occ_list.='</a>';
			
	
	$occ_list.='&nbsp;
	</td><td><font face="verdana,arial" size="2">'.ucfirst($patient['name_first']);

	
	$occ_list.='&nbsp;
			</td><td align=right><font face="verdana,arial" size="2">&nbsp;';
			
    if($patient['date_birth'])
	{
	   $occ_list.=formatDate2Local($patient['date_birth'],$date_format);
    }
	$occ_list.='&nbsp;
			</td><td ><font face="verdana,arial" size="2" >&nbsp;';
	if($patient['insurance_class_nr']!=2) $occ_list.='<font color="#ff0000">';
	if(isset($$patient['LD_var'])&&!empty($$patient['LD_var'])) $occ_list.=$$patient['LD_var'];
		else $occ_list.=$patient['insurance_name'];
	$occ_list.='&nbsp;
	</td>
	<td><font face="verdana,arial" size="2">&nbsp;'.$patient['encounter_nr'].'&nbsp;
	</td>';
	
	if($edit)
	{
		$occ_list.='
			<td><nobr>';
		$occ_list.='&nbsp;
		<a href="javascript:getinfo(\''.$patient['encounter_nr'].'\')"><img '.createComIcon($root_path,'open.gif','0').' alt="'.$LDShowPatData.'"></a>
	 	<a href="javascript:getrem(\''.$patient['encounter_nr'].'\')"><img ';
		if($patient['notes']) $occ_list.=createComIcon($root_path,'bubble3.gif','0'); else $occ_list.=createComIcon($root_path,'bubble2.gif','0');
		$occ_list.=' alt="'.$LDNoticeRW.'"></a>';
		$occ_list.='&nbsp;<a href="javascript:Transfer(\''.$patient['encounter_nr'].'\')"><img '.createComIcon($root_path,'xchange.gif','0').' alt="'.$LDTransferPatient.'"></a>
		 <a href="javascript:release(\''.$patient['encounter_nr'].'\')"><img '.createComIcon($root_path,'bestell.gif','0').' alt="'.$LDReleasePatient.'"></a>';
		 //<a href="javascript:deletePatient(\''.$helper[r].'\',\''.$helper[b].'\',\''.$helper[t].'\',\''.$helper[ln].'\')"><img src="../img/delete.gif" border=0 width=19 height=19 alt="Löschen (Passwort erforderlich)"></a>';

		 $occ_list.='</nobr>
	 	</td>
		</tr>
		 <tr><td bgcolor="#0000ee" colspan="9"><img '.createComIcon($root_path,'pixel.gif').'></td></tr> 
	 	';
	}
}	
# Final occupancy list line
$occ_list.='</table>';
}

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
		if($waitpatient['current_dept_nr']!=$dept_nr) $buf2=createComIcon($root_path,'red_dot.gif','0');
			else  $buf2=createComIcon($root_path,'green_dot.gif','0');
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
	$TP_ICON1='<img '.createComIcon($root_path,'violet_phone.gif','0','absmiddle').'>';
}
if(isset($person2)){
	$TP_DOC2_BLOCK='<a href="javascript:popinfo(\''.$pnr2.'\',\''.$dept_nr.'\')" title="'.$LDClk4Phone.'">'.$person2['name_last'].', '.$person2['name_first'].'</a>';
	$TP_ICON2=$TP_ICON1;
}

$TP_Legend1_BLOCK.='
<nobr>&nbsp;<img '.createComIcon($root_path,'green_dot.gif','0','absmiddle').'>&nbsp;<b>'.$LDOwnPatient.'</b></nobr><br>
<nobr>&nbsp;<img '.createComIcon($root_path,'red_dot.gif','0','absmiddle').'> <b>'.$LDNonOwnPatient.'</b></nobr><br>';
# Create the data block
if($edit&&$rows){
$TP_Legend1_BLOCK.='
<nobr>&nbsp;<img '.createComIcon($root_path,'open.gif','0','absmiddle').'> <b>'.$LDOpenFile.'</b></nobr><br>
<nobr>&nbsp;<img '.createComIcon($root_path,'bubble2.gif','0','absmiddle').'> <b>'.$LDNotesEmpty.'</b></nobr><br>
<nobr>&nbsp;<img '.createComIcon($root_path,'bubble3.gif','0','absmiddle').'> <b>'.$LDNotes.'</b></nobr><br>
<nobr>&nbsp;<nobr><img '.createComIcon($root_path,'xchange.gif','0','absmiddle').'> <b>'.$LDTransferPatient.'</b></nobr></nobr><br>
<nobr>&nbsp;<img '.createComIcon($root_path,'bestell.gif','0','absmiddle').'> <b>'.$LDRelease.'</b></nobr><br>';

$TP_Legend2_BLOCK= '
&nbsp;<img '.createComIcon($root_path,'spf.gif','0','absmiddle').'> <b>'.$LDFemale.'</b><br>
&nbsp;<img '.createComIcon($root_path,'spm.gif','0','absmiddle').'> <b>'.$LDMale.'</b><br>';
}
# Load the quick info block template
$tp=$TP_obj->load('ambulatory/tp_clinic_quickinfo.htm');
eval("echo $tp;");

if($rows){
# Print both blocks of data
echo $occ_list;
}else{
	# Prompt no outpatients available
	echo '
			<ul><img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'><font face="Verdana, Arial" size=3>
			<font color="#880000"><b>'.str_replace("~station~",strtoupper($station),$LDNoOutpatients).'</b></font><br><img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0').'> 
			<a href="'.$root_path.'modules/appointment_scheduler/appt_main_pass.php'.URL_APPEND.'&dept_nr='.$dept_nr.'&dept_name='.$dept.'">'.$LDGoToAppointments.'</a><p></font>
			</ul>';
}
?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
</FONT>


<p>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</BODY>
</HTML>
