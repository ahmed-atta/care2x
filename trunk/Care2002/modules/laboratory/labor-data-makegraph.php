<?php

define('LAB_MAX_DAY_DISPLAY',7); # define the max number or days displayed at one time

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


/*if($from=='station') $breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$patnum";
	else $breakfile='labor_data_patient_such.php'.URL_APPEND;
*/

require($root_path.'include/inc_labor_param_group.php');

						
if(!isset($parameterselect)||empty($parameterselect)) $parameterselect='priority';

$parameters=$paralistarray[$parameterselect];					
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
			$records[$buffer['job_id']][$buffer['group_id']]=unserialize($buffer['serial_value']);
			$tdate[$buffer['job_id']]=&$buffer['test_date'];
			$ttime[$buffer['job_id']]=&$buffer['test_time'];
		}
	}else{
		if($nostat) header("location:".$root_path."modules/laboratory/labor-nodatafound.php?sid=$sid&lang=$lang&patnum=$pn&ln=$result[name]&fn=$result[vorname]&nodoc=labor");
		 	else header("location:".$root_path."modules/nursing/nursing-station-patientdaten-nolabreport.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&nodoc=labor&user_origin=$user_origin");
			//else echo("location:".$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&nodoc=labor");
			exit;
	}
}else{echo "<p>".$lab_obj->getLastQuery()."sql$LDDbNoRead";exit;}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
      <title><?php echo "$LDLabReport - $LDGraph" ?></title>
<?php echo setCharSet(); ?>
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
.a12_b{font-family:arial; font-size:12; color:#000000}
.j{font-family:verdana; font-size:12; color:#000000}
</style>

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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDLabReport - $LDGraph" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab_list.php','graph','','','<?php echo $LDGraph ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
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

</UL>
<p>
<table border=0 bgcolor=#9f9f9f cellspacing=0 cellpadding=0>
<tr>
<td>


<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1>
<?php 


# Get the number of colums
$cols=sizeof($tdate);
echo'
   <tr bgcolor="#dd0000" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDMsrUnit.'</b>&nbsp;</td>';
	while(list($x,$v)=each($tdate))
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

while(list($group_id,$param_group)=each($paralistarray)){
	
	$grpflag=true;
	
	while(list($param,$pname)=each($param_group)){

		$flag=false;

		# Reset the array
		reset($tdate);
		# Reset the sessbuf
		$sessbuf='';
		while(list($job_id,$xval)=each($tdate)){ 
	
			while(list($x,$v)=each($tparam))
			{
				if($v==$tracker) {
					# Prepare the values for graph tracing
					if($sessbuf==''){
						if($records[$job_id][$group_id][$param]) $sessbuf.=$records[$job_id][$group_id][$param];
							else $sessbuf.='0';
					}else{
						if($records[$job_id][$group_id][$param]) $sessbuf.='~'.$records[$job_id][$group_id][$param];
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
			$txt='<tr bgcolor=';
	 		if($toggle) { $txt.= '"#ffdddd"';}else { $txt.= '"#ffeeee"';}
   			$txt.= '>
     		<td class="va12_n"> &nbsp;<nobr><a href="#">'.$pname.'</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;';
			# The normal range limits
			if($tp[$param]['lo_bound']&&$tp[$param]['hi_bound']) $txt.=$tp[$param]['hi_bound'].'<p><br>&nbsp;'.$tp[$param]['lo_bound'];
			# The unit of measurement
			$txt.='</td>
  			<td class="a10_b" >&nbsp;'.$tp[$param]['msr_unit'].'</td>';

			//$txt.=$records[$job_id][$group_id][$param];
				
			# Print the row
			 echo $txt.'<td colspan="'.$cols.'"><img  src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$tp[$param]['lo_bound'].'&hi='.$tp[$param]['hi_bound'].'&d='.$sessbuf.'" border=0>
			</td></tr>';
		}
		$tracker++;
	}
}
	echo '
</table>';     

?>                                         
</td></tr>
</table>
</form>
<ul>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDBack ?>"></a>
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
