<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//error_reporting(E_WARNING);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(empty($HTTP_COOKIE_VARS[$local_user.$sid])) 
{
    $edit=0;
	include("/language/".$lang."/lang_".$lang."_".LANG_FILE);
}

require_once($root_path.'include/inc_config_color.php');

/**
* Set default values if not available from url
*/
if (!isset($station)||empty($station)) { $station=$HTTP_SESSION_VARS['sess_nursing_station'];} // default station must be set here !!
if(!isset($pday)||empty($pday)) $pday=date('d');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
$s_date=$pyear."-".$pmonth."-".$pday;
if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;

if(!isset($mode)) $mode="";

$breakfile='nursing.php'.URL_APPEND; // default breakfile

if(isset($retpath)){
	switch($retpath)
	{
		case 'quick': $breakfile='nursing-schnellsicht.php'.URL_APPEND;
							break;
		case 'ward_mng': $breakfile='nursing-station-info.php'.URL_APPEND.'&ward_nr='.$ward_nr.'&mode=show';
	}
}

/* Create ward object */
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj= new Ward;
			
/* Establish db connection */
if(!isset($db)||$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){
   /* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
	/* Load editor functions */
    //include_once('../include/inc_editor_fx.php');
  
	if(($mode=='')||($mode=='fresh')){
		if($ward_info=&$ward_obj->getWardInfo($ward_nr)){
			$room_obj=&$ward_obj->getRoomInfo($ward_nr,$ward_info['room_nr_start'],$ward_info['room_nr_end']);
			if(is_object($room_obj)) {
				$room_ok=true;
			}else{
				$room_ok=false;
			}
			// Get ward patients
			if($is_today) $patients_obj=&$ward_obj->getDayWardOccupants($ward_nr);
				else $patients_obj=&$ward_obj->getDayWardOccupants($ward_nr,$s_date);
			
			if(is_object($patients_obj)) $patients_ok=true;
				else $patients_ok=false;
				
			// Get some global config values
			include_once($root_path.'include/care_api_classes/class_globalconfig.php');
			$GLOBAL_CONFIG=array();
			$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
			$glob_obj->getConfig('patient_%');
						
			$ward_ok=true;
		}else{
			$ward_ok=false;
		}
	}elseif($mode=='newdata'){	
				
		if(($pn=='lock')||($pn=='unlock')){
						
			if($pn=='lock') $ward_obj->closeBed($ward_nr,$rm,$bd);
				else $ward_obj->openBed($ward_nr,$rm,$bd);
						
			header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr");
			exit;

		}else{
			if($ward_obj->AdmitInWard($pn,$ward_nr,$rm,$bd)){
				//echo "ok";
				$ward_obj->setAdmittedInWard($pn,$ward_nr,$rm,$bd);
			}
			header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr");
			exit;
		}
	}
	/* now get the doctor on duty */
	$dbtable='care_doctors_dutyplan';
			
	$sql='SELECT a_dutyplan,r_dutyplan 	FROM '.$dbtable.' WHERE dept=\''.$dept.'\' AND year=\''.(int)$pyear.'\' AND month=\''.(int)$pmonth.'\'';
	//echo $sql;
	$docslist=$db->Execute($sql);
}else{ 
	echo "$LDDbNoLink<br>$sql<br>";
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
	urlholder="nursing-station-remarks.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station"; ?>";
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
function deletePatient(r,b,t,n)
{
	if(confirm("<?php echo $LDConfirmDelete ?>"))
	{
		url="nursing-station.php<?php echo URL_REDIRECT_APPEND."&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&mode=delete&rm="+r+"&bd="+b+"<?php echo "&station=$station"; ?>";
		window.location.replace(url);
	}
}

function popinfo(l,f,b)
{
	w=window.screen.width;
	h=window.screen.height;
	ww=400;
	wh=400;
	urlholder="doctors-dienstplan-popinfo.php?<?php echo URL_REDIRECT_APPEND."&dept=$dept"; ?>&ln="+l+"&fn="+f+"&bd="+b;
	
	infowin=window.open(urlholder,"infowin","width=" + ww + ",height=" + wh +",menubar=no,resizable=yes,scrollbars=yes");
	window.infowin.moveTo((w/2)-(ww/2),(h/2)-(wh/2));

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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=3  FACE="Arial"><STRONG> &nbsp;&nbsp; <?php echo "$LDStation  ".strtoupper($station)." $LDOccupancy (".formatDate2Local($s_date,$date_format,'','',$null='').")" ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('nursing_station.php','<?php echo $mode ?>','<?php echo $occup ?>','<?php echo $station ?>','<?php echo "$LDStation" ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<?php
if(($occup=="template")&&(!$mode)&&(!isset($list)||!$list))
		 	{
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
			}
		else if($mode=="getlast")
			{
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
//echo $statdata[$bd.$rm];

if($ward_ok)
{

if($pday.$pmonth.$pyear<date('dmY'))
	{
	 echo '
	<font face="verdana,arial" size="2"><img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> <font color="#ff0000"><b>'.$LDAttention.'</font> '.$LDOldList.'</b></font> ';
	$edit=0;
	}

//echo $result[bed_patient];
if(isset($result['bed_patient']))
{
  $buf=explode("_",trim($result['bed_patient']));
  $m=substr_count($result['bed_patient'],"s=m");
  $f=substr_count($result['bed_patient'],"s=f");
 
}
else
{
  $buf="";
  $m="";
  $f="";
  $result['usedbed']="";
  $result['freebed']="";
  $result['usebed_percent']="";
  $result['closedbeds']="";
}

echo '
<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" align=right>
<tr>
<td>

<table  cellspacing=0 cellpadding=2 align=right>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b>'.$LDQuickInformer.'</b>
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDOccupied.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$result['usedbed'].'</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;
</td>
<td bgcolor="#ffffcc" class="vn">'.$result['usebed_percent'].'%</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDFree.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$result['freebed'].'</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDLocked.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$result['closedbeds'].'</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDShortMale.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$m.'</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDShortFemale.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$f.'</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align="right" valign="top">
&nbsp;<nobr>'.$LDDutyDoctor.':</nobr>
</td>
<td bgcolor="#ffffcc" class="vn">';
//echo $dept;
// display the doctors on duty if available
$doctors=mysql_fetch_array($docslist);
if($doctors)
{
	$a_doctors=explode("~",$doctors['a_dutyplan']);
	$r_doctors=explode("~",$doctors['r_dutyplan']);
	parse_str($a_doctors[($pday-1)],$parsed_a);
	parse_str($r_doctors[($pday-1)],$parsed_r);
	if(sizeof($parsed_a))	echo '<a href="javascript:popinfo(\''.$parsed_a['l'].'\',\''.$parsed_a['f'].'\',\''.$parsed_a['b'].'\')" title="'.$LDClk4Phone.'">'.$parsed_a['l'].'</a><br>';
	if(sizeof($parsed_r))	echo '<a href="javascript:popinfo(\''.$parsed_r['l'].'\',\''.$parsed_r['f'].'\',\''.$parsed_r['b'].'\')" title="'.$LDClk4Phone.'">'.$parsed_r['l'].'</a><br>';
}

echo '
</td> 
</tr>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b>'.$LDLegend.'</b>
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" colspan=2 >';
if($edit) echo '
&nbsp;<img '.createComIcon($root_path,'open.gif','0','absmiddle').'> <b>'.$LDOpenFile.'</b><br>
&nbsp;<img '.createComIcon($root_path,'bubble2.gif','0','absmiddle').'> <b>'.$LDNotesEmpty.'</b><br>
&nbsp;<img '.createComIcon($root_path,'bubble3.gif','0','absmiddle').'> <b>'.$LDNotes.'</b><br>
&nbsp;<img '.createComIcon($root_path,'bestell.gif','0','absmiddle').'> <b>'.$LDRelease.'</b><br>
&nbsp;<img '.createComIcon($root_path,'plus2.gif','0','absmiddle').'> <b>'.$LDFreeOccupy.'</b><br>
';
echo '
&nbsp;<img '.createComIcon($root_path,'delete2.gif','0','absmiddle').'> <b>'.$LDLocked.'</b><br>
&nbsp;<img '.createComIcon($root_path,'mans-red.gif','0','absmiddle').'> <b>'.$LDFemale.'</b><br>
&nbsp;<img '.createComIcon($root_path,'mans-gr.gif','0','absmiddle').'> <b>'.$LDMale.'</b><br>
</td>

</tr>
</table>

</td>
</tr>
</table>
';
	
echo '<table  cellpadding="0" cellspacing=0 border="0" >';

echo '<tr bgcolor="#0000dd" align=center>
		<td>&nbsp;</td>';

for($n=0;$n<sizeof($LDPatListElements);$n++)
echo'
<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDPatListElements[$n].' &nbsp;&nbsp;</b></td>';
echo '</tr>';

$toggle=1;
$room_info=array();
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
		$is_patient=false;
		//$pbuff=$patients_obj;
		//echo $pbuff->RecordCount();
		while($bed=$patients_obj->FetchRow()){
			if($i==$bed['room_nr']&&$j==$bed['bed_nr']){
				$is_patient=true;
				break;
			}
		}
		$patients_obj->MoveFirst();
	}
	// Check if bed is locked
	echo '
			<tr bgcolor=';
	if ($toggle) echo '"#fefefe">'; else echo '"#dfdfdf">';
	$toggle=!$toggle;
	
	echo '
			<td>';
	if(stristr($room_info['closed_beds'],$j.'/')){
		$bed_locked=true;
	}else{
		$bed_locked=false;
	}
	// If patient and edit show small color bars
	if($is_patient&&$edit)
	{  
		 echo '<a href="javascript:getinfo(\''.$bed['encounter_nr'].'\')">
		 <img src="'.$root_path.'main/imgcreator/imgcreate_colorbar_small.php'.URL_APPEND.'&pn='.$bed['encounter_nr'].'" alt="'.$LDSetColorRider.'" align="absmiddle" border=0 width=80 height=18>
		 </a>';
    }
	echo '
			</td>
			<td align=center><font face="verdana,arial" size="2" >';
	// If bed nr  is 1, show the room number		
	if($j==1) echo strtoupper($ward_info['roomprefix']).$i; else echo "&nbsp;";
	
	echo '
			</td><td align=left><font face="verdana,arial" size="2" > '.strtoupper(chr($j+96)).' ';
	// If patient, show image by sex
	if($is_patient)
	{
		switch(strtolower($bed['sex']))
		{
			case "f": echo '<img '.createComIcon($root_path,'mans-red.gif','0').'>';break;
			case "m": echo '<img '.createComIcon($root_path,'mans-gr.gif','0').'>';break;
			default:echo '<img '.createComIcon($root_path,'man-whi.gif','0').'>';break;
		}
	}
	elseif($edit&&!$bed_locked) // Else show the image link to assign bed to patient
	{
	   echo '<a href="javascript:indata(\''.$i.'\',\''.$j.'\')"><img '.createComIcon($root_path,'plus2.gif','0').' alt="'.$LDClk2Occupy.'"></a>';
	}elseif($bed_locked){
		echo '<img '.createComIcon($root_path,'delete2.gif','0').'>';
	}
	echo "
	</td>";
	echo '
			<td><font face="verdana,arial" size="2" >';
	// Show the patients name with link to open charts
	if($edit)
	{
	  echo '<a href="javascript:';
	    if(!$bed_locked) echo 'getinfo(\''.$bed['encounter_nr'].'\')" title="'.$LDShowPatData.'">'; // ln=last name fn=first name
	      else echo 'unlock(\''.strtoupper($j).'\',\''.$i.'\')" title="'.$LDInfoUnlock.'">'.$LDLocked; //$j=bed   $i=room number
	   
	}
	else 
	{
	    if($bed_locked)  echo $LDLocked; //$j=bed   $i=room number
	}
	
	if($is_patient&&($bed['encounter_nr']!=""))
	{
		echo ucfirst($bed['title'])." ";
		
	  	if(isset($sln)&&$sln) echo eregi_replace($sln,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_last']));
	 		else echo ucfirst($bed['name_last']); 
			
		if($bed['name_last']) echo ",";
		
		if(isset($sfn)&&$sfn) echo eregi_replace($sfn,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_first']));
			else echo ucfirst($bed['name_first']);
	}
	else
	{
	   echo "&nbsp;";
	}
	
	if($edit) echo '</a>';
	
	echo '
			</td><td align=right><font face="verdana,arial" size="2" >&nbsp;';
    if($bed['date_birth'])
	{
	   if(isset($sg)&&$sg) echo eregi_replace($sg,"<font color=#ff0000><b>".ucfirst($sg)."</b></font>",formatDate2Local($bed['date_birth'],$date_format));
		 else echo formatDate2Local($bed['date_birth'],$date_format);
    }
	echo '
			</td><td align=center><font face="verdana,arial" size="2" >&nbsp;';
	//if ($bed['encounter_nr']) echo ($bed['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']);
	if ($bed['encounter_nr']) echo $bed['encounter_nr'];
	echo "\r\n";
	echo '
			</td><td ><font face="verdana,arial" size="2" >&nbsp;';
	if($bed['insurance_class_nr']!=2) echo '<font color="#ff0000">';
	if(isset($$bed['insurance_LDvar'])&&!empty($$bed['insurance_LDvar'])) echo $$bed['insurance_LDvar'];
		else echo $bed['insurance_name'];
	echo '</td>';
	
	if($edit)
	{
		echo '
			<td>';
		if(($is_patient)&&!empty($bed['encounter_nr'])){	echo '&nbsp;
		<a href="javascript:getinfo(\''.$bed['encounter_nr'].'\')"><img '.createComIcon($root_path,'open.gif','0').' alt="'.$LDShowPatData.'"></a>
	 	<a href="javascript:getrem(\''.$bed['encounter_nr'].'\')"><img ';
		if($bed['ward_notes']) echo createComIcon($root_path,'bubble3.gif','0'); else echo createComIcon($root_path,'bubble2.gif','0');
		echo ' alt="'.$LDNoticeRW.'"></a>
		 <a href="javascript:release(\''.$bed['room_nr'].'\',\''.$bed['bed_nr'].'\',\''.$bed['encounter_nr'].'\')"><img '.createComIcon($root_path,'bestell.gif','0').' alt="'.$LDReleasePatient.'"></a>';
		 //<a href="javascript:deletePatient(\''.$helper[r].'\',\''.$helper[b].'\',\''.$helper[t].'\',\''.$helper[ln].'\')"><img src="../img/delete.gif" border=0 width=19 height=19 alt="Löschen (Passwort erforderlich)"></a>';
		 }
		 else echo "&nbsp;";
		 echo '
	 	</td></tr>
		 <tr><td bgcolor="#0000ee" colspan="8"><img '.createComIcon($root_path,'pixel.gif').'></td></tr> 
	 	';
		}
	}
}	
echo '</table>';
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
