<?php

define('ROW_MAX',15); # define here the maximum number of rows for displaying the parameters

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
$lang_tables=array('chemlab_groups.php','chemlab_params.php');
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(!$encounter_nr) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 

if(!isset($user_origin)||empty($user_origin)) $user_origin='lab';

# Create encounter object
require_once($root_path.'include/care_api_classes/class_encounter.php');
$encounter=new Encounter($encounter_nr);

$thisfile='labor_datainput.php';

#Risaliamo alle analisi che il paziente ha effettuato
$domanda="SELECT * FROM care_test_request_chemlabor WHERE encounter_nr=".$encounter_nr." AND batch_nr=".$job_id;
$risposta=$db->Execute($domanda);
$risposta=$risposta->FetchRow();
$risposta3=split("#",$risposta['parameters']);

$i=0;
while ($risposta3[$i]!='')
{
$risposta2[$i]=split("=",$risposta3[$i]);
$i++;
}

#Richiediamo il file che mappa bene le analisi con i parametri da riempire
include('Mappa_lab.php');

# Create lab object
require_once($root_path.'include/care_api_classes/class_lab.php');
$lab_obj=new Lab($encounter_nr);

require($root_path.'include/inc_labor_param_group.php');
						
if(!isset($parameterselect)||$parameterselect=='') $parameterselect='Nostro';

$parameters=&$paralistarray[$parameterselect];					
$paramname=&$parametergruppe[$parameterselect];

/*
while(list($c,$v)=each($HTTP_POST_VARS))
{
	echo "c $c <br />";
	echo "v $v <br />";
}
echo "parselect ". $parameterselect;
echo "valori 1".$HTTP_POST_VARS[trim($risposta2[0][0])];
echo "valori 2".$HTTP_POST_VARS[trim($risposta2[1][0])];
echo " altro ".$risposta2[0][0];
echo " altro ".$risposta2[1][0];
echo " i ".$HTTP_POST_VARS['contatore'];


*/


# Load the date formatter */
include_once($root_path.'include/inc_date_format_functions.php');
  $verifica="SELECT * from care_test_findings_chemlab WHERE job_id='".$job_id."' AND encounter_nr=".$encounter_nr;
$controllo=$db->Execute($verifica);
$num_record=$controllo->RecordCount();
//@$controllo=$controllo->FetchRow();
//echo " davvero ".$controllo['batch_nr'];
//exit;

if($mode=='save'){
  
	for ($i=0;$i<$HTTP_POST_VARS['contatore'];$i++)
{
 $valori[trim($risposta2[$i][0])]=$HTTP_POST_VARS[trim($risposta2[$i][0])];
}
$datiser=serialize($valori);
if ($num_record==0)
  {
$query="INSERT INTO care_test_findings_chemlab (encounter_nr,job_id,group_id,test_date,test_time,history,modify_id,modify_time,create_id,create_time,serial_value) VALUES ($encounter_nr,'".$job_id."','Nostro','".date('Y-m-d')."','".date('H:i:s')."','Create ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."','".$HTTP_SESSION_VARS['sess_user_name']."','".date('YmdHis')."','".$HTTP_SESSION_VARS['sess_user_name']."','".date('YmdHis')."','".$datiser."')";
$db->Execute($query);
$saved=true;
 }
 else
 {
 $storia=$controllo->FetchRow();
 $storia=$storia['history'];
  $query="UPDATE care_test_findings_chemlab SET history='".$storia." Modified ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."' ,modify_id='".$HTTP_SESSION_VARS['sess_user_name']."',modify_time='".date('YmdHis')."',serial_value='".$datiser."'WHERE job_id='".$job_id."'" ;
$db->Execute($query);
$saved=true;
//echo " query ".$query;
//exit;

 }
#Codice originale che si interessava della registrazione nel db dei dati delle analisi
/*
	$nbuf=array();
	# Prepare parameter values and serialize
	while(list($x,$v)=each($parameters))
	{
		if(isset($HTTP_POST_VARS[$x])&&!empty($HTTP_POST_VARS[$x])){
		 $nbuf[$x]=$HTTP_POST_VARS[$x];
	
		}
	}
	$dbuf['group_id']=$parameterselect;
	$dbuf['serial_value']=serialize($nbuf);
	$dbuf['job_id']=$job_id;
	$dbuf['encounter_nr']=$encounter_nr;
	$dbuf['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];

	if($allow_update){

		# Recheck the date, ! bug patch 
		if($HTTP_POST_VARS['std_date']=='0000-00-00') $dbuf['test_date']=date('Y-m-d');
	
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
			if($HTTP_POST_VARS['std_date']=='0000-00-00') $dbuf['test_date']=date('Y-m-d');
				else 	$dbuf['test_date']=$HTTP_POST_VARS['std_date'];
		}else{
			$dbuf['test_date']=formatDate2STD($HTTP_POST_VARS['test_date'],$date_format);
		}
		$dbuf['test_time']=date('H:i:s');
		
		$dbuf['history']="Create ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		$dbuf['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$dbuf['create_time']='NULL';
		# Insert new job record
		$lab_obj->setDataArray($dbuf);
		if($lab_obj->insertDataFromInternalArray()){
			//echo $sql." new insert <br>";				
			$batch_nr=$db->Insert_ID();
			$saved=true;
		}else{echo "<p>".$lab_obj->getLastQuery()."$LDDbNoSave";}
		
	}
	*/
	# If save successful, jump to display values
	if($saved){
		include_once($root_path.'include/inc_visual_signalling_fx.php');
		# Set the visual signal 
		setEventSignalColor($encounter_nr,SIGNAL_COLOR_DIAGNOSTICS_REPORT);							
		header("location:$thisfile?sid=$sid&lang=$lang&saved=1&batch_nr=$batch_nr&encounter_nr=$encounter_nr&job_id=$job_id&parameterselect=$parameterselect&allow_update=1&user_origin=$user_origin");
	}
	
# end of if(mode==save)
} 
#Questa sezione ? la nuova sezione update
else { #If mode is not "save" then get the basic personal data 
 
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
	
	//echo $lab_obj->getLastQuery();
			
	# Get the test test groups
	$tgroups=&$lab_obj->TestGroups();
	
	# Get the test parameter values
	$tparams=&$lab_obj->TestParams($parameterselect);
	

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
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>Laborwerte Eingabe</TITLE>

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

<script language="javascript" src="<?php echo $root_path ?>js/checkdate.js" type="text/javascript"></script>
<script language="javascript" src="<?php echo $root_path ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php

/*if($newid) echo ' onLoad="document.datain.test_date.focus();" ';*/
 if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
 ?>>

<table width=100% border=0 cellspacing=0 cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php if($update) echo "$LDLabReport - $LDEdit"; else echo "$LDNew $LDLabReport"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab.php','input','main','<?php echo $job_id ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td  bgcolor=#dde1ec>

<FONT    SIZE=-1  FACE="Arial">


<form method="post" action="<?php echo $thisfile; ?>" onSubmit="return pruf(this)" name="datain">

<!--  Display of the patient's basic personal data -->
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
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php echo  $patient['name_last']; ?>, <?php echo  $patient['name_first']; ?>&nbsp;&nbsp;<?php echo formatDate2Local($patient['date_birth'],$date_format); ?></b>
</td>
</tr>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDJobIdNr ?>:
</td>
<td  bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;
<?php if($saved||$job_id)
echo $job_id.'
<input type=hidden name=job_id value="'.$job_id.'">';
else echo ' 
<input name="job_id" type="text" size="14" >';
?>
</td>
</tr>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDExamDate ?>
</td>
<td  bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;
<?php 
if($saved||$row['test_date']||$std_date){
   echo formatDate2Local($std_date,$date_format).'
   	<input type=hidden name="std_date" value="'.$controllo['test_date'].'">';
}else{
   echo '<input name="test_date" type="text" size="14" value="'.formatDate2Local(date('Y-m-d'),$date_format).'" onBlur="IsValidDate(this,\''.$date_format.'\')")  onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')">';
?>
  	<a href="javascript:show_calendar('datain.test_date','<?php echo $date_format ?>')">
	<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a>
<?php
}
?>
</td>
</tr>
</table>

<table border=0 bgcolor=#99ccff cellspacing=1 cellpadding=1 width="100%">
<tr>
<td  bgcolor=#0D5BA7 colspan=2><FONT SIZE=2  FACE="Verdana,Arial" color="#ffffff">
<b><?php echo "Test ".$job_id." per il paziente ".$encounter_nr; ?></b>
<!--<b><?php /*echo strtr($parametergruppe[$parameterselect],"_","-"); */?></b>-->
</td>
</tr>
<tr>
<td  colspan=2>


<table border="0" cellpadding=0 cellspacing=1>



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

$pcols=ceil($paramnum/ROW_MAX);

echo '<tr>';

for($j=0;$j<1;$j++){
echo '
<td class="a10_n">&nbsp;Parametri d\' esame</td>
<td  class="a10_n">&nbsp; Valore</td>';

/*echo '
<td class="a10_n">&nbsp;'.$LDParameter.'</td>
<td  class="a10_n">&nbsp;'.$LDValue.'</td>';
*/
}

echo '
	</tr>';
	
echo '
<tr>';
$rowlimit=0;
//$count=$paramnum;
$i=0;

while($risposta2[$i][0]!='')
{
//while($tp=$tparams->FetchRow()){
$aiuto=trim($risposta2[$i][0]);
	if (!$mappa_lab[$aiuto]['descrizione'])
	echo "Questa analisi viene effettuata in outsourcing da un Ente di servizi.<br />";
	else
    {	
	 echo '<td';

	 echo ' bgcolor="#ffffee" class="a10_b"><nobr>&nbsp;<b>';
     echo $mappa_lab[$aiuto]['parametro'];
	 //echo $mappa_lab[$risposta2[$i]]['parametro'];
	 /*
	 if(isset($parameters[$tp['id']])&&!empty($parameters[$tp['id']])) echo $parameters[$tp['id']];
		else echo $tp['name'];
	 */
	 
	 echo '</b>&nbsp;</nobr>';

	 echo '</td>
			<td class="a10_b">';

	 //echo '<input name="'.$tp['id'].'" type="text" size="8" ';
	echo '<input name="'.$aiuto.'" type="text" size="8" ';
	
	 echo 'value="';
	 if ($num_record)
	 {
 	 	$query="SELECT * FROM care_test_findings_chemlab WHERE job_id='".$job_id."' AND encounter_nr=".$encounter_nr;
		$answer=$db->Execute($query);
		$answer=$answer->FetchRow();
		$prova=unserialize($answer['serial_value']);
		echo 	$prova[$aiuto]; 
	 }
	 //if(isset($pdata[$tp['id']])&&!empty($pdata[$tp['id']])) echo trim($pdata[$tp['id']]);
//if(isset($pdata[$tp['id']])&&!empty($pdata[$tp['id']])) echo trim($pdata[$tp['id']]);
	 echo '">'.$mappa_lab[$aiuto]['unita_di_misura'].'&nbsp;
			</td>';
	/*echo '">'.$tp['msr_unit'].'&nbsp;
			</td>';
*/
	 //$rowlimit++;
	 //if($rowlimit==$pcols)
	  //{
		echo '
		</tr><tr>';
		//$rowlimit=0;
	  //}
    }
	$i++;
 }
/*while(list($x,$v)=each($parameters)){

	echo '<td';

	echo ' bgcolor="#ffffee" class="a10_b"><nobr>&nbsp;<b>'.$v.'</b>&nbsp;</nobr>';

	echo '</td>
			<td>';

	echo '<input name="'.$x.'" type="text" size="8" ';

	echo 'value="';
	if(isset($pdata[$x])&&!empty($pdata[$x])) echo trim($pdata[$x]);

	echo '">';
	echo'&nbsp;
			</td>';

	$rowlimit++;
	if($rowlimit==$pcols){
		echo '
		</tr><tr>';
		$rowlimit=0;
	}
 }
*/
?>
</table>
</td>
</tr>
<tr>
<td>
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0');?>> 
</td>

<td align="right"><font size=1><nobr>
<?php
//echo '<a href="labor_datalist_noedit.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&noexpand=1&from=input&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&nostat=1&user_origin='.$user_origin.'"><img '.createLDImgSrc($root_path,'showreport.gif','0','absmiddle').' alt="'.$LDClk2See.'"></a>';
?>
&nbsp;
<a href="<?php echo $breakfile ?>"><?php
 if($saved) echo '<img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').'>';
	else echo '<img  '.createLDImgSrc($root_path,'cancel.gif','0','absmiddle').'>'; 
?></a>
</nobr>
</font>
</td>
</tr>
</table>
<input type=hidden name="parameterselect" value=<?php echo $parameterselect; ?>>
<input type=hidden name="encounter_nr" value="<?php echo $encounter_nr; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="update" value="<?php echo $update; ?>">
<input type=hidden name="allow_update" value="<?php if(isset($allow_update)) echo $allow_update; ?>">
<input type=hidden name="batch_nr" value="<?php if(isset($row['batch_nr'])) echo $row['batch_nr']; ?>">
<input type=hidden name="newid" value="<?php echo $newid; ?>">
<input type=hidden name="user_origin" value="<?php echo $user_origin; ?>">
<input type=hidden name="contatore" value="<?php echo $i?>">
<input type=hidden name="mode" value="save">
</form>


<form action=<?php echo $thisfile; ?> method=post onSubmit="return chkselect(this)" name="paramselect">
<table border=0>
<tr>
<!--<td colspan=3><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDSelectParamGroup ?></b>
</td>
-->
</tr>
<!--
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDParamGroup ?>:
</td>

<td >
<select name="parameterselect" size=1>
-->
<?php 
/*
	while($tg=$tgroups->FetchRow())
      {
		echo '<option value="'.$tg['group_id'].'"';
		if($parameterselect==$tg['group_id']) echo ' selected';
		echo '>';
		if(isset($parametergruppe[$tg['group_id']])&&!empty($parametergruppe[$tg['group_id']])) echo $parametergruppe[$tg['group_id']];
			else echo $tg['name'];
		echo '</option>';
		echo "\n";
	  }	
*/
?>
<!--
</select>
</td>
-->
<td>
<input type=hidden name="encounter_nr" value="<?php echo $encounter_nr; ?>">
<input type=hidden name="job_id" value="<?php echo $job_id; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="update" value="<?php echo $update; ?>">
<input type=hidden name="allow_update" value="<?php if(isset($allow_update)) echo $allow_update; ?>">
<input type=hidden name="batch_nr" value="<?php if(isset($row['batch_nr'])) echo $row['batch_nr']; ?>">
<input type=hidden name="newid" value="<?php echo $newid; ?>">
<input type=hidden name="std_date" value="<?php echo $std_date; ?>">
<input type=hidden name="user_origin" value="<?php echo $user_origin; ?>">

<!--<FONT SIZE=-1  FACE="Arial">&nbsp;<input  type="image" <?php echo createLDImgSrc($root_path,'auswahl2.gif','0') ?>>
-->
</td>
</tr>
</tr>

</table>
</form>


</FONT>
<p>
</td>
<!--
<td colspan=2 bgcolor=#ffffee width=20% valign=top>


<table border=0 cellpadding=5 cellspacing=2>
<tr>

<td valign=top><a href="Javascript:gethelp('lab.php','input','param')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDParamNoSee ?></td>
</tr>

<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','few')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDOnlyPair ?></td>
</tr>

<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','save')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDHow2Save ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','correct')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDWrongValueHow ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','note')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDVal2Note ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','done')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDImDone ?></td>
</tr>
</table>
</td>


</tr>
</table>        
<p>
-->
<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</BODY>
</HTML>
