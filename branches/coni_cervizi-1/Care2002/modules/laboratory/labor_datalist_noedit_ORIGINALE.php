<?php

define('LAB_MAX_DAY_DISPLAY',7); # define the max number or days displayed at one time

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

setcookie('ck_lab_user'.$sid,$_SESSION['idutente'],0,'/');
$lang_tables=array('chemlab_groups.php','chemlab_params.php','prompt.php');
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

#Richiediamo il file che mappa i laboratori in modo corretto
require ('Mappa_lab.php');

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



//if(!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if(!$encounter_nr) header("location:".$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang");

$thisfile=basename(__FILE__);

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_lab.php');
$enc_obj= new Encounter($encounter_nr);
$lab_obj=new Lab($encounter_nr);

$cache='';

if($nostat) $ret=$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$encounter_nr";
	else $ret=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$encounter_nr";
	
# Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');

$enc_obj->setWhereCondition("encounter_nr='$encounter_nr'");

if($encounter=&$enc_obj->getBasic4Data($encounter_nr)) {

	$patient=$encounter->FetchRow();

	$recs=&$lab_obj->getAllResults($encounter_nr);
	
	if ($rows=$lab_obj->LastRecordCount()){
	
		# Check if the lab result was recently modified
		$modtime=$lab_obj->getLastModifyTime();

		$lab_obj->getDBCache('chemlabs_result_'.$encounter_nr.'_'.$modtime,$cache);
		# If cache not available, get the lab results and param items
		//$cache=''; # empty to force redraw
		if(empty($cache)){

			include($root_path.'include/inc_labor_param_group.php');
						
			if(!isset($parameterselect)||empty($parameterselect)) $parameterselect='Nostro';

			$parameters=$paralistarray[$parameterselect];					
			//$paramname=$parametergruppe[$parameterselect];
			# Merge the records to common date key
			$records=array();
			$dt=array();
			while($buffer=&$recs->FetchRow()){
				//$records[$buffer['job_id']]=&$buffer;
				# Prepare the values
				$records[$buffer['job_id']][$buffer['group_id']]=&unserialize($buffer['serial_value']);
				$tdate[$buffer['job_id']]=&$buffer['test_date'];
				$ttime[$buffer['job_id']]=&$buffer['test_time'];
			}
		}
		
	}else{
		if($nostat) header("location:".$root_path."modules/laboratory/labor-nodatafound.php".URL_REDIRECT_APPEND."&user_origin=$user_origin&ln=".strtr($patient['name_last'],' ','+')."&fn=".strtr($patient['name_first'],' ','+')."&bd=".formatDate2Local($patient['date_birth'],$date_format)."&encounter_nr=$encounter_nr&nodoc=labor&job_id=$job_id&parameterselect=$parameterselect&allow_update=$allow_update&from=$from");
		 	else header("location:".$root_path."modules/nursing/nursing-station-patientdaten-nolabreport.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$encounter_nr&nodoc=labor&user_origin=$user_origin");
			exit;
	}

}else{
	echo "<p>".$lab_obj->getLastQuery()."sql$LDDbNoRead";exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<title><?php echo "$LDLabReport $station"; ?></title>
<?php echo setCharSet(); ?>

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
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table  border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDLabReport $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a 
href="javascript:gethelp('lab_list.php','','','','<?php echo $LDLabReport ?>')"><img 
<?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr></td>
</tr>

<tr>
<td colspan=2  bgcolor=#dde1ec><p><br>

<FONT    SIZE=-1  FACE="Arial">

<ul>

<table border=0>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $encounter_nr; ?>&nbsp;
</td>
</tr>

<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo "$LDLastName, $LDName, $LDBday" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php echo  $patient['name_last']; ?>, <?php echo  $patient['name_first']; ?>&nbsp;&nbsp;<?php echo  formatDate2Local($patient['date_birth'],$date_format); ?></b>
</td>
</tr>
</table>
<p>
<?php
echo '
<button onClick="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph.'</button>';
?>
<p>
<table border=0 bgcolor=#9f9f9f cellspacing=0 cellpadding=0>
<tr>
<td>

<form action="labor-data-makegraph.php" method="post" name="labdata">

<table border=0 cellpadding=0 cellspacing=1>
<?php 
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

/*
$cache= '
   <tr bgcolor="#dd0000" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDMsrUnit.'</b>&nbsp;</td>
	';
	*/
	while(list($x,$v)=each($tdate))
	$cache.= '
	<td class="a12_b"><font color="#ffffff">&nbsp;<b>'.formatDate2Local($v,$date_format).'<br>'.$x.'</b>&nbsp;</td>';
	
	$cache.= '
   <td>&nbsp;<a href="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').' alt="'.$LDClk2Graph.'"></td></a></td></tr>
   <tr bgcolor="#ffddee" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;</td>';


	while(list($x,$v)=each($ttime))
	$cache.= '
	<td class="a12_b"><font color="#0000cc">&nbsp;<b>'.convertTimeToLocal($v).'</b> '.$LDOClock.'&nbsp;</td>';

	# Reset array
	reset($ttime);
	
	$cache.= '
   <td>&nbsp;<a href="javascript:selectall()"><img '.createComIcon($root_path,'dwnarrowgrnlrg.gif','0','absmiddle').' alt="'.$LDClk2SelectAll.'"></a>
       </tr>';

# Display the values
$tracker=0;
$ptrack=0;

while(list($group_id,$param_group)=each($paralistarray)){
	
	$grpflag=true;
	
	while(list($param,$pname)=each($param_group)){
		
		$flag=false;
		
		$txt='';
		
		# Reset the array
		reset($tdate);
		while(list($jid,$xval)=each($tdate)){ 
	
			$txt.= '
			<td class="j">&nbsp;';
			if(!empty($records[$jid][$group_id][$param])) {
				if($tp[$param]['hi_bound']&&$records[$jid][$group_id][$param]>$tp[$param]['hi_bound']){
					$txt.='<img '.createComIcon($root_path,'arrow_red_up_sm.gif','0').'> <font color="red">'.htmlspecialchars($records[$jid][$group_id][$param]).'</font>';
				}elseif($records[$jid][$group_id][$param]<$tp[$param]['lo_bound']){
					$txt.='<img '.createComIcon($root_path,'arrow_red_dwn_sm.gif','0').'> <font color="red">'.htmlspecialchars($records[$jid][$group_id][$param]).'</font>';
				}else{
					$txt.=htmlspecialchars($records[$jid][$group_id][$param]);
				}
				$flag=true;
			}
			$txt.='&nbsp;</td>';
		}
		# If a value exist, display the row
		if($flag){
		
			# If parameters info not yet loaded, load now
			if($grpflag){
				$tparams=&$lab_obj->TestParams($group_id);
				$grpflag=false;
				while($tpbuf=&$tparams->FetchRow())	$tp[$tpbuf['id']]=&$tpbuf;
			}
			
			# Create the front colum boxes
			$txx='<tr bgcolor=';
	 		if($toggle) { $txx.= '"#ffdddd"';}else { $txx.= '"#ffeeee"';}
   			$txx.= '>
     		<td class="va12_n"> &nbsp;<nobr><a href="#">'.$pname.'</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;';
			if($tp[$param]['lo_bound']&&$tp[$param]['hi_bound']) $txx.=$tp[$param]['lo_bound'].' - '.$tp[$param]['hi_bound'];
			$txx.='</td>
			<td class="a10_b" >&nbsp;'.$tp[$param]['msr_unit'].'</td>';
			# Print the final row
			 
			 $cache.=$txx.$txt.'<td>
			<input type="checkbox" name="tk" value="'.$tracker.'">
			</td></tr>';
			
	
			$ptrack++;
			$toggle=!$toggle;
		}
		$tracker++;
	}
}
$cache.='
<input type="hidden" name="colsize" value="'.$cols.'">
<input type="hidden" name="params" value="">
<input type="hidden" name="ptk" value="'.$ptrack.'">
';
# Delete old cache data first
$lab_obj->deleteDBCache('chemlabs_result_'.$encounter_nr.'_%');
# Save new cache data
$lab_obj->saveDBCache('chemlabs_result_'.$encounter_nr.'_'.$modtime,$cache);
}
echo "labor_datalist_noedit.php";
echo $cache;
?>
</table>     
<?php
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
?>                                         
<input type="hidden" name="user_origin" value="<?php echo $user_origin ?>">
</td></tr>
</table>
</form>

<p>
<?php
echo '
<button onClick="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph.'</button>';
?>&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> alt="<?php echo $LDClose ?>"></a>
</UL>

</FONT>


<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</td>
</tr>
</table>        

</BODY>
</HTML>
