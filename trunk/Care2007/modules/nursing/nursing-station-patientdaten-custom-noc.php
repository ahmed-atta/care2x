<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
if (file_exists($custom_lang_file)) {include "./lang_en_custom.php";}

/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* , elpidio@care2x.org
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

/**
Load custom file - note that by default we will assume english
**/

$custom_lang_file = $root_path."language/".$lang.'/lang_'.$lang.'_custom.php';
include($custom_lang_file);

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
		
		if(($indatetime_time&&$verbal&&$moton&&$eyes)){
			
		if ($_POST['editid'] != "") {
			
		    // Load the editor functions 
			include_once($root_path.'include/inc_editor_fx.php');
		    // Load the visual signalling functions
			include_once($root_path.'include/inc_visual_signalling_fx.php');
			// Prepare  the date 
			$indatetime_date=formatDate2STD($indatetime_date,$date_format);
			$indatetime_time=$HTTP_POST_VARS['indatetime_time'].':00';
			
			$q="update care_encounter_custom_noc set
			
			indatetime='".$indatetime_date." ".$indatetime_time."',
			createid='".$_SESSION['sess_login_userid']."',
			verbal='".$verbal."',
			moton='".$moton."',
			eyes='".$eyes."'
			where nr = '".$editid."'
			
			";
			//echo $q;
			mysql_query($q);
			echo mysql_error();
			
			if (mysql_affected_rows()>0) {$saved=true;}
			
		}else{
		
		    // Load the editor functions 
			include_once($root_path.'include/inc_editor_fx.php');
		    // Load the visual signalling functions
			include_once($root_path.'include/inc_visual_signalling_fx.php');
			// Prepare  the date 
			$indatetime_date=formatDate2STD($indatetime_date,$date_format);
			$indatetime_time=$HTTP_POST_VARS['indatetime_time'].':00';
			$q="insert into care_encounter_custom_noc (encounter_nr,createid,indatetime,verbal,moton,eyes) values (
				'".$pn."',
				'".$_SESSION['sess_login_userid']."',
				'".$indatetime_date." ".$indatetime_time."',
				'".$verbal."',
				'".$moton."',
				'".$eyes."'
				)";
			//echo $q;
			mysql_query($q);
			echo mysql_error();
			
			if (mysql_insert_id()>0) {$saved=true;}
			
		} // insert of new record
			
		} else {
						$saved=false;
					echo "<p>$report_obj->sql$LDDbNoSave";
		}
		
		
		
		
		
		
		
			if($saved){
					header("location:$thisfile?sid=$sid&lang=$lang&saved=1&pn=$pn&station=$station&edit=$edit");
			} else {
				
				
			}
	
}

}

else{
	echo "$LDDbNoLink<br>$sql<br>";
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
 $smarty->assign('sToolbarTitle',"$NOC_title $station");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('nursing_report.php','','','$station','$NOC_title')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$NOC_title $station");

 # Body Onload JS
 $sOnLoadJs ='onLoad="if (window.focus) window.focus();';
if((($mode=='save')||($saved))&&$edit) $sOnLoadJs =$sOnLoadJs.";window.location.href='#bottom';document.berichtform.indatetime_time.focus()";
$smarty->assign('sOnLoadJs',$sOnLoadJs.'"');


# Collect javascript code

ob_start();
?>

<style type="text/css">
div.fva2_ml10 {font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-size: 12; margin-left: 3; }
</style>

<script language="javascript">
<!--
  var urlholder;
  var focusflag=0;
  var formsaved=0;
  
function pruf(d){
	
	var verbal=0;
	var moton=0;
	var eyes=0;
	for (i=0;i<=d.verbal.length-1;i++) {
		if (d.verbal[i].checked) {verbal=1;}	
	}
		for (i=0;i<=d.moton.length-1;i++) {
		if (d.moton[i].checked) {moton=1;}	
	}
		for (i=0;i<=d.eyes.length-1;i++) {
		if (d.eyes[i].checked) {eyes=1;}	
	}
	
	if(((d.indatetime_time.value)&&(d.indatetime_date.value)&&(verbal)&&(moton)&&(eyes))) return true;
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

<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<form name="berichtform" method="post" action="<?php echo $thisfile ?>" onSubmit="return pruf(this)">
<table   cellpadding="0" cellspacing=1 border="0">
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
<td colspan=4 bgcolor="#99ccff"><div class=fva2_ml10>

<?php

echo '<font size="7">'.$NOC_title.' <p><font size=2>';

?>
</div></td></tr>
</table>
<?php


		
		?>
		
		<script language='JavaScript'>
		
		editcolor='#FFFF00';
		
		function Edit(id) {
		
			
			document.getElementById('editid').value=id;
			 
			document.getElementById('indatetime_time').value=eval("document.getElementById('id_"+id+"_indatetime_time').innerHTML");
			document.getElementById('indatetime_time').style.backgroundColor=editcolor;
			
			document.getElementById('indatetime_date').value=eval("document.getElementById('id_"+id+"_indatetime_date').innerHTML");
			document.getElementById('indatetime_date').style.backgroundColor=editcolor;
			
			verbal_set=5-eval("document.getElementById('id_"+id+"_verbal').value");
			document.forms[0].verbal[verbal_set].checked=true;
			
			moton_set=6-eval("document.getElementById('id_"+id+"_moton').value");
			document.forms[0].moton[moton_set].checked=true;

			eyes_set=4-eval("document.getElementById('id_"+id+"_eyes').value");
			document.forms[0].eyes[eyes_set].checked=true;
			
			
			/*
			document.getElementById('moton').value=eval("document.getElementById('id_"+id+"_moton').innerHTML");
			document.getElementById('moton').style.backgroundColor=editcolor;
			
			document.getElementById('eyes').value=eval("document.getElementById('id_"+id+"_eyes').innerHTML");
			document.getElementById('eyes').style.backgroundColor=editcolor;
*/

			
		}
		
		</script>
		
		
		<?
			
		$row_top.="<tr bgcolor='#99ccff'><td></td><td><b>Ora & Vlera</b></td>";
		$time_top.="<tr bgcolor='#99ccff'><td></td><td></td>";
		$row_verbal.="<tr bgcolor='#00ccff'><td><b>Pergjigja Verbale </b></td><td></td>";
		$row_verbal_5.="<tr bgcolor='#99ccff'><td>Orientuar</td><td align=center>5</td>";
		$row_verbal_4.="<tr bgcolor='#99ccff'><td>Konfuze</td><td align=center>4</td>";
		$row_verbal_3.="<tr bgcolor='#99ccff'><td>Palidhje</td><td align=center>3</td>";
		$row_verbal_2.="<tr bgcolor='#99ccff'><td>Pakuptueshme</td><td align=center>2</td>";
		$row_verbal_1.="<tr bgcolor='#99ccff'><td>Asnje pergjigje</td><td align=center>1</td>";
		$row_verbal_t.="<tr bgcolor='#99ccff'><td><b>Totali</b></td><td align=right><b><span id='verbal_total'></span></b></td>";
		$row_moton.="<tr bgcolor='#00ccff'><td><b>Pergjigja motore</b></td><td></td>";
		$row_moton_6.="<tr bgcolor='#99ccff'><td>Bindet</td><td align=center>6</td>";
		$row_moton_5.="<tr bgcolor='#99ccff'><td>Lokalizon dhimbjen</td><td align=center>5</td>";
		$row_moton_4.="<tr bgcolor='#99ccff'><td>Largohet dhimbjes</td><td align=center>4</td>";
		$row_moton_3.="<tr bgcolor='#99ccff'><td>Hipertoni fleksore</td><td align=center>3</td>";
		$row_moton_2.="<tr bgcolor='#99ccff'><td>Hipertoni ekstensore</td><td align=center>2</td>";
		$row_moton_1.="<tr bgcolor='#99ccff'><td>Asnje pergjigje</td><td align=center>1</td>";
		$row_moton_t.="<tr bgcolor='#99ccff'><td><b>Totali</b></td><td align=right><b><span id='moton_total'></span></b></td>";
		$row_eyes.="<tr bgcolor='#22ccff'><td><b>Hapja e syve</b></td><td></td>";
		$row_eyes_4.="<tr bgcolor='#99ccff'><td>Spontane</td><td align=center>4</td>";
		$row_eyes_3.="<tr bgcolor='#99ccff'><td>Ndaj thirrjes verbale</td><td align=center>3</td>";
		$row_eyes_2.="<tr bgcolor='#99ccff'><td>Ndja stimulit te dhimbshem</td><td align=center>2</td>";
		$row_eyes_1.="<tr bgcolor='#99ccff'><td>Syte nuk hapen</td><td align=center>1</td>";
		$row_eyes_t.="<tr bgcolor='#99ccff'><td><b>Totali</b></td><td align=right><b><span id='eyes_total'></span></b></td>";
		$row_eyes_st.="<tr bgcolor='#99ccff'><td><b><u>Totali vlere</u></b></td><td align=right><b><span id='score_total'></span></b></td>";
		
		
$res=mysql_query("select * from care_encounter_custom_noc where encounter_nr = '".$pn."'");

$rows=0;

while ($iod=mysql_fetch_assoc($res)) {
	
	$cols++;


		
		$row_top.="<td align=center><a href='#' OnClick=Edit('".$iod['nr']."')><span style='background-color:#FFFF00'>NDRYSHO</span></a></td>";
		$time_top.="<td>";
		$time_top.="<span id='id_".$iod['nr']."_indatetime_date'>".date("d/m/Y",strtotime($iod['indatetime']))."</span><br><br>";
		$time_top.="<span id='id_".$iod['nr']."_indatetime_time'>".date("H:i",strtotime($iod['indatetime']))."</span>";
		$time_top.="</td>";
		$row_verbal.="<td></td>";
		$row_verbal_5.="<td align=center>".(($iod['verbal'] == 5) ? 'Po' : '')."</td>";
		$row_verbal_4.="<td align=center>".(($iod['verbal'] == 4) ? 'Po' : '')."</td>";
		$row_verbal_3.="<td align=center>".(($iod['verbal'] == 3) ? 'Po' : '')."</td>";
		$row_verbal_2.="<td align=center>".(($iod['verbal'] == 2) ? 'Po' : '')."</td>";
		$row_verbal_1.="<td align=center>".(($iod['verbal'] == 1) ? 'Po' : '')."</td>";
		$row_verbal_t.="<td align=right><b>".$iod['verbal']."</b></td>";
		$row_moton.="<td></td>";
		$row_moton_6.="<td align=center>".(($iod['moton'] == 6) ? 'Po' : '')."</td>";
		$row_moton_5.="<td align=center>".(($iod['moton'] == 5) ? 'Po' : '')."</td>";
		$row_moton_4.="<td align=center>".(($iod['moton'] == 4) ? 'Po' : '')."</td>";
		$row_moton_3.="<td align=center>".(($iod['moton'] == 3) ? 'Po' : '')."</td>";
		$row_moton_2.="<td align=center>".(($iod['moton'] == 2) ? 'Po' : '')."</td>";
		$row_moton_1.="<td align=center>".(($iod['moton'] == 1) ? 'Po' : '')."</td>";
		$row_moton_t.="<td align=right><b>".$iod['moton']."</b></td>";
		$row_eyes.="<td></td>";
		$row_eyes_4.="<td align=center>".(($iod['eyes'] == 4) ? 'Po' : '')."</td>";
		$row_eyes_3.="<td align=center>".(($iod['eyes'] == 3) ? 'Po' : '')."</td>";
		$row_eyes_2.="<td align=center>".(($iod['eyes'] == 2) ? 'Po' : '')."</td>";
		$row_eyes_1.="<td align=center>".(($iod['eyes'] == 1) ? 'Po' : '')."</td>";
		$row_eyes_t.="<td align=right><b>".$iod['eyes']."</b></td>";
		$row_eyes_st.="<td align=right><b>".($iod['verbal']+$iod['moton']+$iod['eyes'])."/15</b></td>";
		$vars.="<input type=hidden id='id_".$iod['nr']."_verbal' value='".$iod['verbal']."'>";
		$vars.="<input type=hidden id='id_".$iod['nr']."_moton' value='".$iod['moton']."'>";
		$vars.="<input type=hidden id='id_".$iod['nr']."_eyes' value='".$iod['eyes']."'>";
		
		
		/*
		// calculate totals
		
		$verbal_total+=$iod['verbal'];
		$moton_total+=$iod['moton'];
		$eyes_total+=$iod['eyes'];
		$score_total+=($iod['verbal']+$iod['moton']+$iod['eyes']);
		$possible_total+=15;
		*/

	
}

/*
if ($cols<2) {$extracols=1;} else {$extracols=2;}

for ($extra=1;$extra<=$extracols;$extra++) {
	

		
		$row_top.="<td width=10></td>";
		$time_top.="<td></td>";
		$row_verbal.="<td></td>";
		$row_verbal_5.="<td></td>";
		$row_verbal_4.="<td></td>";
		$row_verbal_3.="<td></td>";
		$row_verbal_2.="<td></td>";
		$row_verbal_1.="<td></td>";
		$row_verbal_t.="<td></td>";
		$row_moton.="<td></td>";
		$row_moton_6.="<td></td>";
		$row_moton_5.="<td></td>";
		$row_moton_4.="<td></td>";
		$row_moton_3.="<td></td>";
		$row_moton_2.="<td></td>";
		$row_moton_1.="<td></td>";
		$row_moton_t.="<td></td>";
		$row_eyes.="<td></td>";
		$row_eyes_4.="<td></td>";
		$row_eyes_3.="<td></td>";
		$row_eyes_2.="<td></td>";
		$row_eyes_1.="<td></td>";
		$row_eyes_t.="<td></td>";
		$row_eyes_st.="<td></td>";
}
*/
		
if($edit) { 
	
		$row_top.="<td align=center><a href='nursing-station-patientdaten-custom-noc.php".URL_REDIRECT_APPEND."&station=".$station."&pn=".$pn."&edit=".$edit."'>";
		$row_top.="<span style='background-color:#FFFF00'> PASTRO </span> </a></td>";
		$time_top.="<td>";
		$time_top.=$LDDate.":<br><table><tr><td><input type=text size=10 maxlength=10 name=indatetime_date id=indatetime_date value='".formatDate2Local(date('Y-m-d'),$date_format)."' onBlur='IsValidDate(this,'".$date_format."' onFocus='this.select()' value='";
		if(!$saved) $time_top.="$dateput";
		$time_top.=" onKeyUp=\"setDate(this,'".$date_format."','".$lang."')\"></td><td>
		<a href=\"javascript:show_calendar('berichtform.indatetime_date','".$date_format."')\">
		<img ".createComIcon($root_path,'show-calendar.gif','0','absmiddle',TRUE)." ></a><font size=1 face='arial'><";
		$dfbuffer="LD_".strtr($date_format,".-/","phs");
		$time_top.="$dfbuffer";
		$time_top.="</font></td></tr></table>".
		$LDClockTime.":<br>";
		$time_top.="<input type=text size=4 maxlength=5 name=indatetime_time id=indatetime_time  value='".date('H:i')."' onKeyUp=setTime(this,'".$lang."') onFocus=this.select()><br></td>";
		$row_verbal.="<td></td>";
		$row_verbal_5.="<td align=center><input type=radio name=verbal id='verbal' value=5></td>";
		$row_verbal_4.="<td align=center><input type=radio name=verbal id='verbal'  value=4></td>";
		$row_verbal_3.="<td align=center><input type=radio name=verbal id='verbal'  value=3></td>";
		$row_verbal_2.="<td align=center><input type=radio name=verbal id='verbal'  value=2></td>";
		$row_verbal_1.="<td align=center><input type=radio name=verbal id='verbal'  value=1></td>";
		$row_verbal_t.="<td></td>";
		$row_moton.="<td></td>";
		$row_moton_6.="<td align=center><input type=radio name=moton id='moton' value=6></td>";
		$row_moton_5.="<td align=center><input type=radio name=moton id='moton'  value=5></td>";
		$row_moton_4.="<td align=center><input type=radio name=moton id='moton'  value=4></td>";
		$row_moton_3.="<td align=center><input type=radio name=moton id='moton'  value=3></td>";
		$row_moton_2.="<td align=center><input type=radio name=moton id='moton'  value=2></td>";
		$row_moton_1.="<td align=center><input type=radio name=moton id='moton'  value=1></td>";
		$row_moton_t.="<td align=center></td>";
		$row_eyes.="<td></td>";
		$row_eyes_4.="<td align=center><input type=radio name=eyes id='eyes' value=4></td>";
		$row_eyes_3.="<td align=center><input type=radio name=eyes id='eyes'  value=3></td>";
		$row_eyes_2.="<td align=center><input type=radio name=eyes id='eyes'  value=2></td>";
		$row_eyes_1.="<td align=center><input type=radio name=eyes id='eyes'  value=1></td>";
		$row_eyes_t.="<td></td>";
		$row_eyes_st.="<td></td>";
		
		/*
?>
		<tr>
		<td colspan=8 bgcolor="#ffffff">&nbsp;
		</td>
		</tr>
		
		<tr bgcolor="#99ccff">
		
		<input type=hidden name=editid id=editid value="">
	
        <td valign="top"><?php echo $LDDate ?>:<br>
		<input type=text size=10 maxlength=10 name="indatetime_date" id="indatetime_date" value="<?php echo formatDate2Local(date('Y-m-d'),$date_format); ?>" onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onFocus="this.select()" value="<?php if(!$saved) echo $dateput; ?>" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"><br>
<a href="javascript:show_calendar('berichtform.indatetime_date','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle',TRUE); ?>></a><font size=1 face="arial">[<?php
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?>]</font>
	
         </td>
		 
		<td valign="top"><?php echo $LDClockTime ?>:<br>
		<input type=text size=4 maxlength=5 name="indatetime_time" id="indatetime_time"  value="<?php echo date('H:i'); ?>" onKeyUp=setTime(this,'<?php echo $lang ?>') onFocus=this.select()><br>
		</td>
		
		<td valign="top">Urine Sugar:<br>
		<input type=text size=10 maxlength=6 name="verbal"  id="verbal" value="<?if (!($saved)) echo $_POST['verbal']?>">
		</td>
		<td valign="top">Acetone:<br>
		<input type=text size=10 maxlength=6 name="moton"  id="moton" value="<?if (!($saved)) echo $_POST['moton']?>">
		</td>
		<td valign="top">Blood Sugar:<br>
		<input type=text size=10 maxlength=6 name="eyes"  id="eyes" value="<?if (!($saved)) echo $_POST['eyes']?>">
		</td>
		<td valign="top">Tablets:<br>
		<input type=text size=10 maxlength=6 name="tablets"  id="tablets" value="<?if (!($saved)) echo $_POST['tablets']?>">
		</td>
		<td valign="top">Insulin:<br>
		<input type=text size=10 maxlength=6 name="insulin"  id="insulin" value="<?if (!($saved)) echo $_POST['insulin']?>">
		</td>
	<td align=center><a <?
			
			echo 'href=\'nursing-station-patientdaten-custom-noc.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'';
			
			?>> <span style="background-color:#FFFF00"> CLEAR </span> </a></td>
		</tr>
		
<?php
*/
} 
?>
		
<table>
<?
		echo $row_top."</tr>";
		echo $time_top."</tr>";
		echo $row_verbal."</tr>";
		echo $row_verbal_5."</tr>";
		echo $row_verbal_4."</tr>";
		echo $row_verbal_3."</tr>";
		echo $row_verbal_2."</tr>";
		echo $row_verbal_1."</tr>";
		echo $row_verbal_t."</tr>";
		echo $row_moton."</tr>";
		echo $row_moton_6."</tr>";
		echo $row_moton_5."</tr>";
		echo $row_moton_4."</tr>";
		echo $row_moton_3."</tr>";
		echo $row_moton_2."</tr>";
		echo $row_moton_1."</tr>";
		echo $row_moton_t."</tr>";
		echo $row_eyes."</tr>";
		echo $row_eyes_4."</tr>";
		echo $row_eyes_3."</tr>";
		echo $row_eyes_2."</tr>";
		echo $row_eyes_1."</tr>";
		echo $row_eyes_t."</tr>";
		echo $row_eyes_st."</tr>";
	
		/*
		
		<script language="javaScript">
		document.getElementById("verbal_total").innerHTML='<?=$verbal_total?>';
		document.getElementById("moton_total").innerHTML='<?=$moton_total?>';
		document.getElementById("eyes_total").innerHTML='<?=$eyes_total?>';
		document.getElementById("score_total").innerHTML='<?=$score_total?>/<?=$possible_total?>';
		</script>

		
		*/
		
?>
</table>

<?=$vars?>

	<input type=hidden name=editid id=editid value="">
	
<p>

<table width="650"  cellpadding="0" cellspacing="0">
<tr>
<td>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> width=99 height=24 alt="<?php echo $LDSave ?>">  
</td>

<td>



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

</ul>
<?php


$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
