<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('aufnahme.php','prompt.php');
define('LANG_FILE','nursing.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(empty($HTTP_COOKIE_VARS[$local_user.$sid])){
    $edit=0;
	include($root_path."language/".$lang."/lang_".$lang."_".LANG_FILE);
}
/**
* Set default values if not available from url
*/
if (!isset($station)||empty($station)) { $station=$HTTP_SESSION_VARS['sess_nursing_station'];} # Default station must be set here !!
if(!isset($pday)||empty($pday)) $pday=date('d');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;
if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;

if(!isset($mode)) $mode='';

$breakfile='javascript:window.close()'; # Set default breakfile

/* Create ward object */
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj= new Ward;

# Load date formatter 
require_once($root_path.'include/inc_date_format_functions.php');
  
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
		
		# Load global person photo source path
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('person_foto_path');
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

		#Create encounter object and load encounter info
		$enc_obj=new Encounter($pn);
		$enc_obj->loadEncounterData();
		if($enc_obj->is_loaded) {
			$encounter=&$enc_obj->encounter;
		}
		
		# Set the foto filename
		$photo_filename=$encounter['photo_filename'];
		/* Prepare the photo filename */
		require_once($root_path.'include/inc_photo_filename_resolve.php');

		# Get billing type
		$billing_type=&$enc_obj->getInsuranceClassInfo($encounter['insurance_class_nr']);
			
	}else{
			$ward_ok=false;
	}
}
if(isset($transfer)&&$transfer){
	$TP_TITLE=$LDTransferPatient;
}else{
	$TP_TITLE= $LDAssignOcc.' '.strtoupper($station);
	$transfer=false;
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<title><?php echo $TP_TITLE; ?></title>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
  var urlholder;

function getrem(pn){
	urlholder="nursing-station-remarks.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station"; ?>";
	patientwin=window.open(urlholder,pn,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}

function belegen(pn,rm,bd){
<?php
if($encounter['current_ward_nr']!=$ward_nr){
echo '
if(confirm("'.$LDSureAssignRoomBed.'"))
';
}
?>
{
<?php
echo '
	urlholder="nursing-station.php?mode=newdata&sid='.$sid.'&lang='.$lang.'&rm="+rm+"&bd="+bd+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn="+pn+"&station='.$station.'&ward_nr='.$ward_nr.'"
';
?>
	window.opener.location.replace(urlholder);
	window.close();
}
}
function transferBed(pn,rm,bd){

<?php
echo '
urlholder="nursing-station-transfer-save.php?mode=transferbed&sid='.$sid.'&lang='.$lang.'&rm="+rm+"&bd="+bd+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn="+pn+"&station='.$station.'&ward_nr='.$ward_nr.'"
';
?>
window.opener.location.replace(urlholder);
window.close();
}
// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus()"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=3  FACE="Arial"><STRONG> &nbsp;&nbsp; <?php echo $TP_TITLE ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('inpatient_assignbed.php','<?php echo $mode ?>','<?php echo $occup ?>','<?php echo $station ?>','<?php echo "$LDStation" ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<!-- Patients basic admission info -->
<table border=0 cellspacing=1 cellpadding=0 width=100%>

<tr bgcolor="#ffffff">
<td  valign="top">

<table border=0 width=100% cellspacing=1>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php 
echo $LDAdmitNr;
?>
</td>
<td width="30%"  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 
echo $pn ;
?>
</td>

<td valign="top" rowspan=5 align="center" bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><img <?php echo $img_source; ?>>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo "$LDTitle $LDLastName, $LDFirstName" ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">
<?php echo $encounter['title'].' '.$encounter['name_last'].', '.$encounter['name_first'] ?>
</td>

</tr>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php  echo $LDBday ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">
<?php if($encounter['date_birth']) echo @formatDate2Local($encounter['date_birth'],$date_format);  ?>
</td>
</tr>
<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><?php  echo $LDSex ?>: 
</td>
<td bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><?php if($encounter['sex']=="m") echo  $LDMale; elseif($encounter['sex']=="f") echo $LDFemale ?>
</td>
</tr>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBillType ?>:
</td>
<td  bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"  color="#990000">
<b>
<?php if (isset($$billing_type['LD_var'])&&!empty($$billing_type['LD_var'])) echo $$billing_type['LD_var']; 
    else echo  $billing_type['name']; 
?>
</b>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td  bgcolor="#ffffee" colspan=2 ><FONT SIZE=-1  FACE="Arial">
<?php
	echo nl2br($encounter['referrer_diagnosis']);
?>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td  bgcolor="#ffffee" colspan=2 ><FONT SIZE=-1  FACE="Arial">
<?php
	echo nl2br($encounter['referrer_recom_therapy']);
?>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td  bgcolor="#ffffee"  colspan=2><FONT SIZE=-1  FACE="Arial">
<?php
	echo nl2br($encounter['referrer_notes']);
?>
</td>
</tr>

</table>


</td>
</tr>
</table>
<!-- End of Patients basic admission info -->

<!--  Show stop sign and warn if the initial ward assignment is different from this ward -->
<?php
if($encounter['current_ward_nr']!=$ward_nr){
?>
<table border=0>
  <tr>
    <td><img <?php 	echo createLDImgSrc($root_path,'stop.png','0'); ?>></td>
    <td><FONT SIZE=2  FACE="Arial"><?php 	echo str_replace('~ward_id~',$pat_station,$LDChkWardConflict); ?></td>
  </tr>
</table>

<?php
}else{
?>
<table border=0>
  <tr>
    <td><img <?php 	echo createComIcon($root_path,'angle_down_l.gif','0'); ?>></td>
    <td><FONT SIZE=3  FACE="Arial"><?php 	echo $LDSelectRoomBed; ?></td>
    <td><img <?php 	echo createMascot($root_path,'mascot1_l.gif','0'); ?>></td>
  </tr>
</table>

<?php
}

if($ward_ok){

# Start here, create the occupancy list

$occ_list='<table  cellpadding="0" cellspacing=0 border="0" width="100%">
<tr bgcolor="#0000dd" align="center">
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDPatListElements[0].' &nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDPatListElements[1].' &nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDPatListElements[2].' &nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDPatListElements[3].' &nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDBillType.' &nbsp;&nbsp;</b></td>
	<td><font face="verdana,arial" size="2" color="#ffffff">&nbsp;</td>
</tr>';

$toggle=1;
$cflag=$ward_info['room_nr_start'];
$room_info=array();
# Set occupied bed counter

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
	# Toggle row color
	$occ_list.='
			<tr bgcolor=';
	if($transfer&&$bed['encounter_nr']==$pn){
		 $occ_list.='"yellow">';
	}else{
		if($cflag!=$i){
			$toggle=!$toggle;
			$cflag=$i;
		}
		if ($toggle) $occ_list.='"#fefefe">'; else $occ_list.='"#dfdfdf">';
	}
	
	# Check if bed is locked
	if(stristr($room_info['closed_beds'],$j.'/')){
		$bed_locked=true;
		$lock_beds++;
		# Consider locked bed as occupied so increase occupied bed counter
		$occ_bed++;
	}else{
		$bed_locked=false;
	}

	$occ_list.='
			<td align=center><font face="verdana,arial" size="2" >';
	# If bed nr  is 1, show the room number		
	if($j==1) $occ_list.=strtoupper($ward_info['roomprefix']).$i; else $occ_list.='&nbsp;';
	
	$occ_list.='
			</td><td align=left><font face="verdana,arial" size="2" > '.strtoupper(chr($j+96)).' ';
	# If patient, show images by sex
	if($is_patient)
	{
		switch(strtolower($bed['sex']))
		{
			case 'f': $occ_list.='<img '.createComIcon($root_path,'spf.gif','0').'>'; $females++; break;
			case 'm': $occ_list.='<img '.createComIcon($root_path,'spm.gif','0').'>'; $males++; break;
			default: $occ_list.='<img '.createComIcon($root_path,'bn.gif','0').'>';break;
		}
	}elseif($bed_locked){
		$occ_list.='<img '.createComIcon($root_path,'delete2.gif','0').'>';
	}
	$occ_list.='
	</td>';
	$occ_list.='
			<td><font face="verdana,arial" size="2" >';
	# Show the patients name with link to open charts

	if($bed_locked)  $occ_list.=$LDLocked; //$j=bed   $i=room number
	
	if($is_patient&&($bed['encounter_nr']!=""))
	{
		$occ_list.=ucfirst($bed['title'])." ";
		
	  	if(isset($sln)&&$sln) $occ_list.=eregi_replace($sln,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_last']));
	 		else $occ_list.=ucfirst($bed['name_last']); 
			
		if($bed['name_last']) $occ_list.=',';
		
		if(isset($sfn)&&$sfn) $occ_list.=eregi_replace($sfn,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_first']));
			else $occ_list.=ucfirst($bed['name_first']);
	}
	elseif(!$bed_locked) // Else show the image link to assign bed to patient
	{
		if($transfer){
			$as_img='transfer_sm.gif';
			$js_fx='transferBed';
		}else{
			$as_img='assign_here.gif';
			$js_fx='belegen';
		}
	   $occ_list.='<a href="javascript:'.$js_fx.'(\''.$pn.'\',\''.$i.'\',\''.$j.'\')"><img '.createLDImgSrc($root_path,$as_img,'0','middle').' alt="'.$LDClk2Occupy.'"></a>';
	}
	
	$occ_list.='
			</td><td align="center"><font face="verdana,arial" size="2" >&nbsp;';
    if($bed['date_birth'])
	{
	   if(isset($sg)&&$sg) $occ_list.=eregi_replace($sg,"<font color=#ff0000><b>".ucfirst($sg)."</b></font>",formatDate2Local($bed['date_birth'],$date_format));
		 else $occ_list.=formatDate2Local($bed['date_birth'],$date_format);
    }
	$occ_list.='
			</td><td ><font face="verdana,arial" size="2" >&nbsp;';
	if($bed['insurance_class_nr']!=2) $occ_list.='<font color="#ff0000">';
	if(isset($$bed['insurance_LDvar'])&&!empty($$bed['insurance_LDvar'])) $occ_list.=$$bed['insurance_LDvar'];
		else $occ_list.=$bed['insurance_name'];
	$occ_list.='</td>
			<td><nobr>';
	
	if(($is_patient)&&!empty($bed['encounter_nr'])){	$occ_list.='&nbsp;
	 	<a href="javascript:getrem(\''.$bed['encounter_nr'].'\')"><img ';
			if($bed['ward_notes']) $occ_list.=createComIcon($root_path,'bubble3.gif','0'); else $occ_list.=createComIcon($root_path,'bubble2.gif','0');
		$occ_list.=' alt="'.$LDNoticeRW.'"></a>';
	}else{
		 	$occ_list.='&nbsp;';
	}
	$occ_list.='</nobr>
	 	</td></tr>
		 <tr><td bgcolor="#0000ee" colspan="6"><img '.createComIcon($root_path,'pixel.gif').'></td></tr> 
	 	';
	
	}
}	
# Final occupancy list line
$occ_list.='</table>';

# Print data
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
?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
</FONT>


<p>
</td>
</tr>
</table>        
<p>

</BODY>
</HTML>
