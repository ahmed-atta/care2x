<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('actions.php');
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
if($edit&&!$HTTP_COOKIE_VARS[$local_user.$sid]) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
 
$thisfile=basename(__FILE__);
$breakfile="nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;
/* Create nursing notes object */
require_once($root_path.'include/care_api_classes/class_notes_nursing.php');
$report_obj= new NursingNotes;
/* Load global configs */
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');	

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{
	/* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
       
	if($mode=='save'){
		if(($dateput&&$timeput&&$berichtput&&$author)||($dateput2&&$berichtput2&&$author2)){
		    // Load the editor functions 
			include_once($root_path.'include/inc_editor_fx.php');
		    // Load the visual signalling functions
			include_once($root_path.'include/inc_visual_signalling_fx.php');
			// Prepare  the date 
			if($dateput&&$timeput&&$berichtput&&$author){
				if($dateput)  $HTTP_POST_VARS['dateput']=formatDate2STD($dateput,$date_format);
				$HTTP_POST_VARS['timeput']=$HTTP_POST_VARS['timeput'].':00'; // adjust time to 00:00:00 format
				$HTTP_POST_VARS['berichtput']=deactivateHotHtml($berichtput);
				if($report_obj->saveNursingReport($HTTP_POST_VARS)){
					// Get the last insert id
					$HTTP_POST_VARS['ref_notes_nr']=$db->Insert_ID();
					// Set the visual signal 
					setEventSignalColor($pn, SIGNAL_COLOR_NURSE_REPORT, SIGNAL_COLOR_LEVEL_FULL);
					$saved=true;
				}else{
					$saved=false;
					echo "<p>$report_obj->sql$LDDbNoSave";
				}
			}
			if($dateput2&&$berichtput2&&$author2){
				if(!$HTTP_POST_VARS['ref_notes_nr']) $HTTP_POST_VARS['timeput']=date('H:i:s');
				if($dateput2) $HTTP_POST_VARS['dateput2']=formatDate2STD($dateput2,$date_format);
				$HTTP_POST_VARS['berichtput2']=deactivateHotHtml($berichtput2);
				if($report_obj->saveEffectivityReport($HTTP_POST_VARS)){
					// Set the visual signal 
					setEventSignalColor($pn, SIGNAL_COLOR_NURSE_REPORT, SIGNAL_COLOR_LEVEL_FULL);
					$saved=true;
				}else{
					$saved=false;
					echo "<p>$report_obj->sql$LDDbNoSave";
				}
			}
			if($saved){
					header("location:$thisfile?sid=$sid&lang=$lang&saved=1&pn=$pn&station=$station&edit=$edit");
			}
		}else{
			$saved=false;
		}
	}else{
	// end of if(mode==save)
		$enc_obj->where=" encounter_nr=$pn";
    	if( $enc_obj->loadEncounterData($pn)) {
			switch ($enc_obj->EncounterClass())
			{
	    		case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
	                   		break;
				case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
				default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			}						
			if( $enc_obj->is_loaded){
				$result=&$enc_obj->encounter;		
				$rows=$enc_obj->record_count;	
			}
		}else{ 
			echo "$sql<br>$LDDbNoRead";
			$mode='?';
		} 	
		// Load the nursing and effectivity reports in one instance
		$neff_report=&$report_obj->getNursingAndEffectivityReport($pn);
		// Load the date range
		$neff_date_range=&$report_obj->getNursingReportDateRange($pn);
	}
}else{
	echo "$LDDbNoLink<br>$sql<br>";
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
</style>

<script language="javascript">
<!-- 
  var urlholder;
  var focusflag=0;
  var formsaved=0;
  
function pruf(d){
	if(((d.dateput.value)&&(d.timeput.value)&&(d.berichtput.value)&&(d.author.value))||((d.dateput2.value)&&(d.berichtput2.value)&&(d.author2.value))) return true;
	else 
	{
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
}

function submitform(){
	document.forms[0].submit();
	}

function closewindow(){
	opener.window.focus();
	window.close();
	}

function resetinput(){
	document.berichtform.reset();
	}

function select_this(formtag){
		document.berichtform.elements[formtag].select();
	}
	
function getinfo(patientID){
	urlholder="nursing-station.php?sid=<?php echo "$sid&lang=$lang" ?>&route=validroute&patient=" + patientID + "&user=<?php echo $HTTP_COOKIE_VARS[$local_user.$sid].'"' ?>;
	patientwin=window.open(urlholder,patientID,"width=600,height=400,menubar=no,resizable=yes,scrollbars=yes");
	}
function sethilite(d){
	d.focus();
	d.value=d.value+"~";
	d.focus();
	}
function endhilite(d){
	d.focus();
	d.value=d.value+"~~";
	d.focus();
	}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); 
<?php if((($mode=='save')||($saved))&&$edit) echo ";window.location.href='#bottom';document.berichtform.berichtput.focus()"; ?>"  
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="2" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDNursingReport $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('nursing_report.php','','','<?php echo $station ?>','<?php echo $LDNursingReport ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>
 <ul>

<form name="berichtform" method="post" action="<?php echo $thisfile ?>" onSubmit="return pruf(this)">
<table   cellpadding="0" cellspacing=1 border="0"  width="650">
<tr  valign="top">
<td colspan=4 bgcolor="#99ccff"  width="50%">
<?php
/*echo '<div class=fva2_ml10>
		<span style="background:yellow"><b>'.$result[patnum].'</b></span><br>
		<b>'.$result[name].', '.$result[vorname].'</b> <br>
		<font color=maroon>'.formatDate2Local($result[gebdatum],$date_format).'</font><font size=1> <p>
		'.nl2br($result[address]).'<p>
		'.$station.'&nbsp;'.$result[kasse].' '.$result[kassename].'</div>';*/

echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
?>
</td>
<td colspan=3 bgcolor="#99ccff"><div class=fva2_ml10>

<?php

echo '<font size="6"  >'.$LDNursingReport.' <p><font size=2>'.$LDPage.' 1/1
		<br><font size=1>'.$LDFrom.'</font> ';
		if($neff_date_range['fe_date']) echo formatDate2Local($neff_date_range['fe_date'],$date_format);
		echo ' <font size=1>'.$LDTo.'</font> ';
		if($neff_date_range['le_date']) echo formatDate2Local($neff_date_range['le_date'],$date_format).' ';
?>
</div></td></tr>
<?php
echo '	<tr bgcolor="#99ccff">
		<td colspan=4><div class=fva2_ml10><font color="#000099"><b>'.$LDNursingReport.'</b></div></td>
		<td colspan=3><div class=fva2_ml10><font color="#000099"><b>'.$LDEffectReport.'</b></div></td>
		</tr>';	

echo '	<tr bgcolor="#99ccff">
		<td><div class=fva2_ml3><b>'.$LDDate.'</b></div></td><td><div class=fva2_ml3><b>'.$LDClockTime.'</b></div></td><td><div class=fva2_ml3>&nbsp;</div></td><td><div class=fva2_ml3><b>'.$LDSignature.'</b></div></td>
		<td><div class=fva2_ml3><b>'.$LDDate.'</b></div></td><td><div class=fva2_ml3>&nbsp;</div></td><td><div class=fva2_ml3><b>'.$LDSignature.'</b></div></td>
		</tr>';	
		
if(is_object($neff_report)) $cnt=$neff_report->RecordCount();
	else $cnt=15;
$buf=array();
if($cnt){
	if($cnt<15) $cnt=15;
	for ($i=0;$i<$cnt;$i++){
		
		if(is_object($neff_report)) $buf=$neff_report->FetchRow();
		if($buf['type_nr']==17){
			if($buf['ref_notes_nr']) continue;
			$buf['eff_date']=$buf['date'];
			$buf['date']='';
			$buf['eff_time']=$buf['time'];
			$buf['time']='';
			$buf['eff_notes']=$buf['notes'];
			$buf['notes']='';
			$buf['eff_personell_name']=$buf['personell_name'];
			$buf['personell_name']='';
			$buf['eff_aux_notes']=$buf['aux_notes'];
			$buf['aux_notes']='';
		}
		echo '	
		<tr bgcolor="#99ccff">';
			//  Column for the nursing report		
			echo '
			<td><div class=fa2_ml3>';
			if($buf['date']) echo formatDate2Local($buf['date'],$date_format);
			echo '&nbsp;</div>
			</td>
			<td><div class=fa2_ml3>'.$buf['time'].'</div>
			</td>
			<td><div class=fva2_ml3><i>';
			if(stristr($buf['aux_notes'],'warn')) echo '<img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> ';
			$strbuf=str_replace('~~','</span>',stripcslashes(nl2br($buf['notes'])));	
			echo str_replace('~','<span style="background:yellow">',$strbuf).'</i></div>
			</td>
			<td>
			<div class=fa2_ml3>'.$buf['personell_name'].'</div>
			</td>';

				// Column for the effectivity report
				echo '
				<td><div class=fa2_ml3>';
				if($buf['eff_date']) echo formatDate2Local($buf['eff_date'],$date_format);
				echo '&nbsp;</div>
				</td>
				<td><div class=fva2_ml3><i>';
				if(stristr($buf['eff_aux_notes'],'warn')) echo '<img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> ';
				$strbuf=str_replace('~~','</span>',stripcslashes(nl2br($buf['eff_notes'])));	
				echo str_replace('~','<span style="background:yellow">',$strbuf).'</i></div>
				</td>
				<td>
				<div class=fa2_ml3>'.$buf['eff_personell_name'].'</div>
				</td>';
		echo'</tr>';	
	}
}
		
if($edit) { 
?>
		<tr>
		<td colspan=7 bgcolor="#ffffff">&nbsp;
		</td>
		</tr>
		
		<tr bgcolor="#99ccff">
<!-- 		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDDate ?>:<br>
		<input type=text size="8" name="dateput" onKeyUp=setDate(this) onFocus=this.select() value="<?php if(!$saved) echo $dateput; ?>"><br>
		<a href="javascript:document.berichtform.dateput.value='h';setDate(document.berichtform.dateput);"><img <?php echo createComIcon($root_path,'arrow-t.gif','0') ?> alt="<?php echo $LDInsertDate ?>"></a>
		</td>
 -->		
        <td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDDate ?>:<br>
		<input type=text size=10 maxlength=10 name="dateput" value="<?php echo formatDate2Local(date('Y-m-d'),$date_format); ?>" onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onFocus="this.select()" value="<?php if(!$saved) echo $dateput; ?>" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"><br>
<a href="javascript:show_calendar('berichtform.dateput','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a><font size=1 face="arial">[<?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?>]</font>

<!-- 		<a href="javascript:document.berichtform.dateput.value='h';setDate(document.berichtform.dateput);"><img <?php echo createComIcon($root_path,'arrow-t.gif','0') ?> alt="<?php echo $LDInsertDate ?>"></a>
 -->		
         </td>
		 
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDClockTime ?>:<br>
		<input type=text size=4 maxlength=5 name="timeput"  value="<?php echo date('H:i'); ?>" onKeyUp=setTime(this,'<?php echo $lang ?>') onFocus=this.select()><br>
<!-- 		<a href="javascript:document.berichtform.timeput.value='j';setTime(document.berichtform.timeput);"><img <?php echo createComIcon($root_path,'arrow-t.gif','0') ?> alt="<?php echo $LDInsertTimeNow ?>"></a>
 -->		</td>
		
		<td><font face="verdana,arial" size="2" ><?php echo $LDNursingReport ?>:<br>&nbsp;<textarea rows="4" cols="25" name="berichtput"><?php if(!$saved) echo $berichtput; ?></textarea><br>
		<input type="checkbox" name="warn" <?php if((!$saved)&&($warn)) echo "checked"; ?> value="warn"> <img <?php echo createComIcon($root_path,'warn.gif','0','top') ?>>
		 <font size=1 face=arial><?php echo $LDInsertSymbol ?><br><font size=2 face=arial><b>
		 &nbsp;<a href="javascript:sethilite(document.berichtform.berichtput)"><img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0') ?>> <?php echo $LDStart ?></a>
		<a href="javascript:endhilite(document.berichtform.berichtput)"><img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0') ?>> <?php echo $LDEnd ?></a>
		</b>
		</td>
		
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDSignature ?>:<br><input type=text size="3" name="author" onFocus=this.select() value="<?php if(!$saved) echo $author; ?>">
		</td>
		
<!-- 		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDDate ?>:<br><input type=text size="8" name="dateput2" value="<?php if(!$saved) echo $dateput2; ?>" onKeyUp="setDate(this)" onFocus="this.select()"><br>
		<a href="javascript:document.berichtform.dateput2.value='h';setDate(document.berichtform.dateput2);"><img <?php echo createComIcon($root_path,'arrow-t.gif','0') ?> alt="<?php echo $LDInsertDate ?>"></a>
		</td>
 -->		
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDDate ?>:<br>
		<input type=text size=10 maxlength=10 name="dateput2" value="<?php echo formatDate2Local(date('Y-m-d'),$date_format); ?>" onBlur="IsValidDate(this,'<?php echo $date_format ?>')"  onFocus="this.select()" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"><br>
<a href="javascript:show_calendar('berichtform.dateput2','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a><font size=1 face="arial">[<?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?>]</font>

<!-- 		<a href="javascript:document.berichtform.dateput2.value='h';setDate(document.berichtform.dateput2);"><img <?php echo createComIcon($root_path,'arrow-t.gif','0') ?> alt="<?php echo $LDInsertDate ?>"></a>
 -->		
        </td>
		
		<td><font face="verdana,arial" size="2" ><?php echo $LDEffectReport ?>:<br>&nbsp;<textarea rows="4" cols="25"  name="berichtput2"><?php if(!$saved) echo $berichtput2; ?></textarea><br>
		<input type="checkbox" name="warn2" <?php if((!$saved)&&($warn2)) echo "checked"; ?> value="warn"> <img <?php echo createComIcon($root_path,'warn.gif','0','top') ?>> 
		<font size=1 face=arial><?php echo $LDInsertSymbol ?><br><font size=2 face=arial><b>
		 &nbsp;<a href="javascript:sethilite(document.berichtform.berichtput2)"><img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0') ?>> <?php echo $LDStart ?></a>
		<a href="javascript:endhilite(document.berichtform.berichtput2)"><img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0') ?>> <?php echo $LDEnd ?></a>
		</b>
		</td>
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDSignature ?>:<br><input type=text size="3" name="author2" onFocus=this.select() value="<?php if(!$saved) echo $author2; ?>">
		</td>
		</tr>
		
<?php 
} 
?>
		</table>


<p>

<table width="650"  cellpadding="0" cellspacing="0">
<tr>
<?php if($edit) : ?>
<td>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> width=99 height=24 alt="<?php echo $LDSave ?>">
</td>
<?php endif ?>
<td>
<!-- <?php if($edit) : ?>
<a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?>  width=156 height=24 alt="<?php echo $LDReset ?>"></a>
&nbsp;&nbsp;
<?php endif ?> -->
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
</td>


</tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="mode" value="save">
</form>
</FONT>
</ul>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
<a name="bottom"></a>
</BODY>
</HTML>
