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

$lang_tables[]='prompt.php';
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(empty($HTTP_COOKIE_VARS[$local_user.$sid])){
    $edit=0;
	include($root_path."language/".$lang."/lang_".$lang."_".LANG_FILE);
}

# Set default values if not available from url
if (!isset($station)||empty($station)) { $station=$HTTP_SESSION_VARS['sess_nursing_station'];} # Default station must be set here !!
if(!isset($pday)||empty($pday)) $pday=date('d');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;
if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;

if(!isset($mode)) $mode='';

$breakfile='nursing.php'.URL_APPEND; # Set default breakfile
$thisfile=basename(__FILE__);

if(isset($retpath)){
	switch($retpath)
	{
		case 'quick': $breakfile='nursing-schnellsicht.php'.URL_APPEND;
							break;
		case 'ward_mng': $breakfile='nursing-station-info.php'.URL_APPEND.'&ward_nr='.$ward_nr.'&mode=show';
	}
}

# Create ward object
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj= new Ward;

# Load date formatter 
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');
  
if(($mode=='')||($mode=='fresh')){
	if($ward_info=&$ward_obj->getWardInfo($ward_nr)){
		$room_obj=&$ward_obj->getRoomInfo($ward_nr,$ward_info['room_nr_start'],$ward_info['room_nr_end']);
		if(is_object($room_obj)) {
			$room_ok=true;
		}else{
			$room_ok=false;
		}
		# GEt the number of beds
		$nr_beds=$ward_obj->countBeds($ward_nr);
		# Get ward patients
		if($is_today) $patients_obj=&$ward_obj->getDayWardOccupants($ward_nr);
			else $patients_obj=&$ward_obj->getDayWardOccupants($ward_nr,$s_date);
		
		//echo $ward_obj->getLastQuery();
		//echo $ward_obj->LastRecordCount();
		
		if(is_object($patients_obj)){
			# Prepare patients data into array matrix
			while($buf=$patients_obj->FetchRow()){
				$patient[$buf['room_nr']][$buf['bed_nr']]=$buf;
			}
			$patients_ok=true;
		}else{
			$patients_ok=false;
		}
				
		$ward_ok=true;
			
		# Create the waiting inpatients' list
		$wnr=(isset($w_waitlist)&&$w_waitlist) ? 0 : $ward_nr;
		$waitlist=$ward_obj->createWaitingInpatientList($wnr);
		$waitlist_count=$ward_obj->LastRecordCount();
			
		# Get the doctor's on duty information
		#### Start of routine to fetch doctors on duty
		$elem='duty_1_pnr';
		if(SHOW_DOC_2) $elem.=',duty_2_pnr';
			
		# Create personnel object
		include_once($root_path.'include/care_api_classes/class_personell.php');
		$pers_obj=new Personell;
			
		if($result=$pers_obj->getDOCDutyplan($ward_info['dept_nr'],$pyear,$pmonth,$elem)){
			$duty1=&unserialize($result['duty_1_pnr']);
			if(SHOW_DOC_2) $duty2=&unserialize($result['duty_2_pnr']);
					//echo $sql."<br>";
		}
		//echo $sql;
		# Adjust the day index
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
	}else{
		$ward_ok=false;
	}
}elseif($mode=='newdata'){	
				
	if(($pn=='lock')||($pn=='unlock')){
						
		if($pn=='lock') $ward_obj->closeBed($ward_nr,$rm,$bd);
			else $ward_obj->openBed($ward_nr,$rm,$bd);
						
		#header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr");
		#exit;
	}else{
		if($ward_obj->AdmitInWard($pn,$ward_nr,$rm,$bd)){
			//echo "ok";
			$ward_obj->setAdmittedInWard($pn,$ward_nr,$rm,$bd);
		}
		#header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr");
		#exit;
	}
	header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr");
	exit;
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
	urlholder="nursing-station-patientdaten.php'.URL_REDIRECT_APPEND;
	echo '&pn=" + pn + "';
	echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit&station=".$ward_info['name']; 
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
	urlholder="nursing-station-remarks.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&dept_nr=$ward_nr&location_nr=$ward_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station"; ?>";
	patientwin=window.open(urlholder,pn,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}
	
function indata(room,bed)
{
	urlholder="nursing-station-bettbelegen.php<?php echo URL_REDIRECT_APPEND; ?>&rm="+room+"&bd="+bed+"<?php echo "&py=".$pyear."&pm=".$pmonth."&pd=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>&s=<?php echo $station; ?>&wnr=<?php echo $ward_nr; ?>";
	indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
}
function release(room,bed,pid)
{
	urlholder="nursing-station-patient-release.php<?php echo URL_REDIRECT_APPEND; ?>&rm="+room+"&bd="+bed+"&pn="+pid+"<?php echo "&pyear=".$pyear."&pmonth=".$pmonth."&pday=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>&station=<?php echo $station; ?>&ward_nr=<?php echo $ward_nr; ?>";
	//indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes"
	window.location.href=urlholder;
}

function unlock(b,r)
{
<?php
	echo '
	urlholder="nursing-station.php'.URL_REDIRECT_APPEND.'&mode=newdata&pn=unlock&rm="+r+"&bd="+b+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&station='.$station.'&ward_nr='.$ward_nr.'";
	';
?>
	if(confirm('<?php echo $LDConfirmUnlock ?>'))
	{
		window.location.replace(urlholder);
	}
}

function popinfo(l,d)
{
	urlholder="<?php echo $root_path ?>modules/doctors/doctors-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=450,menubar=no,resizable=yes,scrollbars=yes");

}
function assignWaiting(pn,pw)
{
	urlholder="nursing-station-assignwaiting.php<?php echo URL_REDIRECT_APPEND ?>&pn="+pn+"&pat_station="+pw+"&ward_nr=<?php echo $ward_nr ?>&station=<?php echo $station ?>";	
	asswin<?php echo $sid ?>=window.open(urlholder,"asswind<?php echo $sid ?>","width=650,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
function Transfer(pn,pw)
{
	if(confirm("<?php echo $LDSureTransferPatient ?>")){
		urlholder="nursing-station-transfer-select.php<?php echo URL_REDIRECT_APPEND ?>&pn="+pn+"&pat_station="+pw+"&ward_nr=<?php echo $ward_nr ?>&station=<?php echo $station ?>";	
		transwin<?php echo $sid ?>=window.open(urlholder,"transwin<?php echo $sid ?>","width=650,height=600,menubar=no,resizable=yes,scrollbars=yes");
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=3  FACE="Arial"><STRONG> &nbsp;&nbsp; <?php echo "$LDStation  ".$ward_info['name']." $LDOccupancy (".formatDate2Local($s_date,$date_format,'','',$null='').")" ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('nursing_station.php','<?php echo $mode ?>','<?php echo $occup ?>','<?php echo $station ?>','<?php echo "$LDStation" ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<?php
if(($occup=='template')&&(!$mode)&&(!isset($list)||!$list)){
			 echo'<font face="verdana,arial" size="2" >'.$LDNoListYet.'<br>
			 <form action="nursing-station.php" method=post>
			<input type="hidden" name="sid" value="'.$sid.'">
   			<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="pyear" value="'.$pyear.'">
 			<input type="hidden" name="pmonth" value="'.$pmonth.'">
  			<input type="hidden" name="pday" value="'.$pday.'">
			<input type="hidden" name="station" value="'.$station.'">
			<input type="hidden" name="ward_nr" value="'.$ward_nr.'">
			<input type="hidden" name="mode" value="getlast">
			<input type="hidden" name="c" value="1">       
			<input type="hidden" name="edit" value="'.$edit.'">
   			<input type="submit" value="'.$LDShowLastList.'" >
 			</form>';
}elseif($mode=="getlast"){
			echo'
			<font face="verdana,arial" size="2" >'.$LDLastList;
			if($c>2) echo '<font color=red><b>'.$LDNotToday.'</b></font><br>'.str_replace("~nr~",$c,$LDListFrom);
				else echo '<font color=red><b>'.$LDFromYesterday.'</b></font><br>
				';
			echo '
			</font>
			<form action="nursing-station.php" method=post>
			<input type="hidden" name="sid" value="'.$sid.'">
    		<input type="hidden" name="lang" value="'.$lang.'">
  			<input type="hidden" name="pyear" value="'.$pyear.'">
 			<input type="hidden" name="pmonth" value="'.$pmonth.'">
  			<input type="hidden" name="pday" value="'.$pday.'">
			<input type="hidden" name="station" value="'.$station.'">
			<input type="hidden" name="ward_nr" value="'.$ward_nr.'">
			<input type="hidden" name="mode" value="copylast">&nbsp;&nbsp;&nbsp;';
			if($c>2) echo '<input type="submit" value="'.$LDCopyAnyway.'">';
			else echo '
   			<input type="submit" value="'.$LDTakeoverList.'" >
				';
			echo '
			&nbsp;&nbsp;&nbsp;<input type="button" value="'.$LDDoNotCopy.'" onClick="javascript:window.location.href=\'nursing-station.php?sid='.$sid.'&edit=1&list=1&station='.$station.'&mode=fresh\'">
 			</form>
				';		
}

if($ward_ok){

	if($pyear.$pmonth.$pday<date('Ymd')){
	 	echo '
		<font face="verdana,arial" size="2"><img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> <font color="#ff0000"><b>'.$LDAttention.'</font> '.$LDOldList.'</b></font> ';
		$edit=0;
	}

# Start here, create the occupancy list

$occ_list='<table  cellpadding="0" cellspacing=0 border="0" >';

$occ_list.='<tr bgcolor="#0000dd" align=center>
		<td>&nbsp;</td>';
# add the description row
for($n=0;$n<sizeof($LDPatListElements);$n++){
	$occ_list.='
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDPatListElements[$n].' &nbsp;&nbsp;</b></td>';
}
$occ_list.= '</tr>';

$toggle=1;
$room_info=array();
# Set occupied bed counter
$occ_beds=0;
$lock_beds=0;
$males=0;
$females=0;
$cflag=$ward_info['room_nr_start'];
for ($i=$ward_info['room_nr_start'];$i<=$ward_info['room_nr_end'];$i++){
 	
	if($room_ok){
		$room_info=$room_obj->FetchRow();
	}else{
		$room_info['nr_of_beds']=1;
		$edit=false;
	}
	for($j=1;$j<=$room_info['nr_of_beds'];$j++){
	// Scan the patients object if the patient is assigned to the bed & room
	if($patients_ok){

		if(isset($patient[$i][$j])){
			 $bed=&$patient[$i][$j];
    		 $is_patient=true;
			 # Increase occupied bed nr
			 $occ_beds++;
		 }else{
		 	$is_patient=false;
			$bed=NULL;
		}
	}
	# set room nr change flag , toggle row color
	if($cflag!=$i){
		$toggle=!$toggle;
		$cflag=$i;
	}

	# set row color
	$occ_list.='
			<tr bgcolor=';
	if ($toggle) $occ_list.='"#fefefe">'; else $occ_list.='"#dfdfdf">';
	
	$occ_list.='
			<td>';
	# Check if bed is locked
	if(stristr($room_info['closed_beds'],$j.'/')){
		$bed_locked=true;
		$lock_beds++;
		# Consider locked bed as occupied so increase occupied bed counter
		$occ_bed++;
	}else{
		$bed_locked=false;
	}
	# If patient and edit show small color bars
	if($is_patient&&$edit)
	{  
		 $occ_list.='<a href="javascript:getinfo(\''.$bed['encounter_nr'].'\')">
		 <img src="'.$root_path.'main/imgcreator/imgcreate_colorbar_small.php'.URL_APPEND.'&pn='.$bed['encounter_nr'].'" alt="'.$LDSetColorRider.'" align="absmiddle" border=0 width=80 height=18>
		 </a>';
    }
	$occ_list.='
			</td>
			<td align=center><font face="verdana,arial" size="2" >';
	# If bed nr  is 1, show the room number		
	if($j==1) $occ_list.=strtoupper($ward_info['roomprefix']).$i; else $occ_list.='&nbsp;';
	
	$occ_list.='
			</td><td align=left><font face="verdana,arial" size="2" > <nobr>'.strtoupper(chr($j+96)).' ';
	# If patient, show images by sex
	if($is_patient)
	{
		 $occ_list.='<a href="javascript:popPic(\''.$bed['name_last'].', '.$bed['name_first'].' '.formatDate2Local($bed['date_birth'],$date_format).'\',\''.$bed['photo_filename'].'\')">';
		switch(strtolower($bed['sex']))
		{
			case 'f': $occ_list.='<img '.createComIcon($root_path,'spf.gif','0').'>'; $females++; break;
			case 'm': $occ_list.='<img '.createComIcon($root_path,'spm.gif','0').'>'; $males++; break;
			default: $occ_list.='<img '.createComIcon($root_path,'bn.gif','0').'>';break;
		}
		 $occ_list.='</a>';
	}elseif($bed_locked){
		$occ_list.='<img '.createComIcon($root_path,'delete2.gif','0').'>';
	}
	elseif($edit) // Else show the image link to assign bed to patient
	{
	   $occ_list.='<a href="javascript:indata(\''.$i.'\',\''.$j.'\')"><img '.createComIcon($root_path,'plus2.gif','0').' alt="'.$LDClk2Occupy.'"></a>';
	}
	$occ_list.='
	</nobr></td>';
	$occ_list.='
			<td><font face="verdana,arial" size="2" >';
	# Show the patients name with link to open charts
	if($edit)
	{
	  $occ_list.='<a href="javascript:';
	    if(!$bed_locked) $occ_list.='getinfo(\''.$bed['encounter_nr'].'\')" title="'.$LDShowPatData.'">'; // ln=last name fn=first name
	      else $occ_list.='unlock(\''.strtoupper($j).'\',\''.$i.'\')" title="'.$LDInfoUnlock.'">'.$LDLocked; //$j=bed   $i=room number
	   
	}
	else 
	{
	    if($bed_locked)  $occ_list.=$LDLocked; //$j=bed   $i=room number
	}
	
	if($is_patient&&($bed['encounter_nr']!=""))
	{
		$occ_list.=ucfirst($bed['title'])." ";
		
	  	if(isset($sln)&&$sln) $occ_list.=eregi_replace($sln,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_last']));
	 		else $occ_list.=ucfirst($bed['name_last']); 
			
		if($bed['name_last']) $occ_list.=',';
		
		if(isset($sfn)&&$sfn) $occ_list.=eregi_replace($sfn,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_first']));
			else $occ_list.=ucfirst($bed['name_first']);
	}
	else
	{
	   $occ_list.='&nbsp;';
	}
	
	if($edit) $occ_list.='</a>';
	
	$occ_list.='
			</td><td align=right><font face="verdana,arial" size="2" >&nbsp;';
    if($bed['date_birth'])
	{
	   if(isset($sg)&&$sg) $occ_list.=eregi_replace($sg,"<font color=#ff0000><b>".ucfirst($sg)."</b></font>",formatDate2Local($bed['date_birth'],$date_format));
		 else $occ_list.=formatDate2Local($bed['date_birth'],$date_format);
    }
	$occ_list.='
			</td><td align=center><font face="verdana,arial" size="2" >&nbsp;';
	//if ($bed['encounter_nr']) echo ($bed['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']);
	if ($bed['encounter_nr']) $occ_list.=$bed['encounter_nr'];
	$occ_list.="\r\n";
	$occ_list.='
			</td><td ><font face="verdana,arial" size="2" >&nbsp;';
	if($bed['insurance_class_nr']!=2) $occ_list.='<font color="#ff0000">';
	if(isset($$bed['insurance_LDvar'])&&!empty($$bed['insurance_LDvar'])) $occ_list.=$$bed['insurance_LDvar'];
		else $occ_list.=$bed['insurance_name'];
	$occ_list.='</td>';
	
	if($edit)
	{
		$occ_list.='
			<td><nobr>';
		if(($is_patient)&&!empty($bed['encounter_nr'])){	$occ_list.='&nbsp;
			<a href="javascript:getinfo(\''.$bed['encounter_nr'].'\')"><img '.createComIcon($root_path,'open.gif','0').' alt="'.$LDShowPatData.'"></a>
	 		<a href="javascript:getrem(\''.$bed['encounter_nr'].'\')"><img ';
			if($bed['ward_notes']) $occ_list.=createComIcon($root_path,'bubble3.gif','0'); 
				else $occ_list.=createComIcon($root_path,'bubble2.gif','0');
			$occ_list.=' alt="'.$LDNoticeRW.'"></a>';
			$occ_list.='&nbsp;<a href="javascript:Transfer(\''.$bed['encounter_nr'].'\')"><img '.createComIcon($root_path,'xchange.gif','0').' alt="'.$LDTransferPatient.'"></a>
		 	<a href="javascript:release(\''.$bed['room_nr'].'\',\''.$bed['bed_nr'].'\',\''.$bed['encounter_nr'].'\')"><img '.createComIcon($root_path,'bestell.gif','0').' alt="'.$LDReleasePatient.'"></a>';
		 	//<a href="javascript:deletePatient(\''.$helper[r].'\',\''.$helper[b].'\',\''.$helper[t].'\',\''.$helper[ln].'\')"><img src="../img/delete.gif" border=0 width=19 height=19 alt="Löschen (Passwort erforderlich)"></a>';
		 }else{
		 	$occ_list.='&nbsp;';
		}
		 $occ_list.='</nobr>
	 	</td></tr>	 
	 	';
	}else{
		$occ_list.='<td>
	 	</td></tr>';
	}
	$occ_list.='<tr><td bgcolor="#0000ee" colspan="8"><img '.createComIcon($root_path,'pixel.gif').'></td></tr>';
}
}	
# Final occupancy list line
$occ_list.='</table>';

# Prepare the stations quick info data	
# Occupancy in percent
$occ_percent=ceil(($occ_beds/$nr_beds)*100);
# Nr of vacant beds
$vac_beds=$nr_beds-$occ_beds;

# Declare template items
$TP_DOC1_BLOCK='';
$TP_DOC2_BLOCK='';
$TP_ICON1='';
$TP_ICON2='';
$TP_Legend1_BLOCK='';

//$buf1='<img '.createComIcon($root_path,'powdot.gif','0','absmiddle').'>';
# Create waiting list block
if($waitlist_count&&$edit){
	while($waitpatient=$waitlist->FetchRow()){
		$buf2='';
		//if($waitpatient['current_ward_nr']!=$ward_nr) $buf2='<nobr>'.$waitpatient['ward_id'].'::';
		if($waitpatient['current_ward_nr']!=$ward_nr) $buf2=createComIcon($root_path,'red_dot.gif','0');
			else  $buf2=createComIcon($root_path,'green_dot.gif','0');
		$TP_WLIST_BLOCK.='<nobr><img '.$buf2.'><a href="javascript:assignWaiting(\''.$waitpatient['encounter_nr'].'\',\''.$waitpatient['ward_id'].'\')">';
		$TP_WLIST_BLOCK.='&nbsp;'.$waitpatient['name_last'].', '.$waitpatient['name_first'].' '.formatDate2Local($waitpatient['date_birth'],$date_format).'</nobr></a><br>';
	}
}else{
	$TP_WLIST_BLOCK='&nbsp;';
}
if($edit){
	$wlist_url=$thisfile.URL_APPEND.'&ward_nr='.$ward_nr.'&edit='.$edit.'&station='.$station;
	if($w_waitlist){
		$TP_WLIST_OPT =	'[<a href="'.$wlist_url.'&w_waitlist=0">'.$LDShowWardOnly.'</a>]';
	}else{
		$TP_WLIST_OPT=	'[<a href="'.$wlist_url.'&w_waitlist=1">'.$LDShowAll.'</a>]';
	}
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

# Create the legend block
$TP_Legend1_BLOCK.='
&nbsp;<img '.createComIcon($root_path,'green_dot.gif','0','absmiddle').'>&nbsp;<b>'.$LDOwnPatient.'</b><br>
&nbsp;<img '.createComIcon($root_path,'red_dot.gif','0','absmiddle').'> <b>'.$LDNonOwnPatient.'</b><br>
&nbsp;<img '.createComIcon($root_path,'plus2.gif','0','absmiddle').'> <b>'.$LDFreeOccupy.'</b><br>
&nbsp;<img '.createComIcon($root_path,'delete2.gif','0','absmiddle').'> <b>'.$LDLocked.'</b><br>
';

if($edit&&$patients_ok){
 $TP_Legend1_BLOCK.= '
&nbsp;<img '.createComIcon($root_path,'open.gif','0','absmiddle').'> <b>'.$LDOpenFile.'</b><br>
&nbsp;<img '.createComIcon($root_path,'bubble2.gif','0','absmiddle').'> <b>'.$LDNotesEmpty.'</b><br>
&nbsp;<img '.createComIcon($root_path,'bubble3.gif','0','absmiddle').'> <b>'.$LDNotes.'</b><br>
&nbsp;<nobr><img '.createComIcon($root_path,'xchange.gif','0','absmiddle').'> <b>'.$LDTransferPatient.'</b></nobr><br>
&nbsp;<img '.createComIcon($root_path,'bestell.gif','0','absmiddle').'> <b>'.$LDRelease.'</b><br>
';

$TP_Legend2_BLOCK= '
&nbsp;<img '.createComIcon($root_path,'spf.gif','0','absmiddle').'> <b>'.$LDFemale.'</b><br>
&nbsp;<img '.createComIcon($root_path,'spm.gif','0','absmiddle').'> <b>'.$LDMale.'</b><br>';
}
# Load the quick info block template
$tp=$TP_obj->load('nursing/tp_ward_quickinfo.htm');
eval("echo $tp;");
# Print both blocks of data
echo $occ_list;
}
else
{
	echo '
			<ul><img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'><font face="Verdana, Arial" size=3>
			<font color="#880000"><b>'.str_replace("~station~",strtoupper($station),$LDNoInit).'</b></font><br>
			<a href="nursing-station-new.php'.URL_APPEND.'&station='.$station.'&edit='.$edit.'">'.$LDIfInit.' <img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0').'></a><p></font>
			</ul>';
}

if($pday.$pmonth.$pyear<>date('dmY'))
			echo '<p>
			<font face="Verdana, Arial" size=2 >
			<a href="nursing-station-archiv.php'.URL_APPEND.'">'.$LDClk2Archive.' <img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0').'></a>
			</font><p>';

?>
<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font face="verdana,arial" size=2>
<?php
if(!$edit){
	echo '<a href="nursing-station-pass.php'.URL_APPEND.'&edit=1&rt=pflege&ward_nr='.$ward_nr.'&station='.$ward_info['name'].'"><img '.createComIcon($root_path,'uparrowgrnlrg.gif','0','absmiddle').'> Open ward for management</a>';
}
?>
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
