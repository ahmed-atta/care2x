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

function createElement($item,$err, $f_size=7, $mx=5)
{
    global $mode, $err_data, $result, $lang, $isTimeElement,$opdoc;
	
	if($mode=='saveok')
    {
       $ret_str= '<font color="#800000">'.$opdoc[$item].' &nbsp;</font>';
    } 
    else
    {
        $ret_str= '<input name="'.$item.'" type="text" size="'.$f_size.'"   maxlength='.$mx.' value="';
       if($err_data){
          $ret_str.=$err;
       }else{
          $ret_str.=$opdoc[$item];
       }	  
          
	   if($mode=='') $ret_str.='" ';
	     else $ret_str.='"';
		 
	   if($isTimeElement)  $ret_str.= ' onKeyUp="setTime(this,\''.$lang.'\')">';
	     else $ret_str.='>';		 
	}
	return $ret_str;
}

$lang_tables=array('doctors.php');
define('LANG_FILE','or.php');
$local_user='ck_opdoku_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(!isset($dept_nr)||empty($dept_nr)){
	header('Location:op-doku-select-dept.php'.URL_REDIRECT_APPEND.'&target=entry');
	exit;
}
/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;
/* Save dept name to session */
if(!session_is_registered('sess_dept_name')) session_register('sess_dept_name');
/* Create dept object and preload dept info */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);
$buffer=$dept_obj->LDvar();
if(isset($$buffer)&&!empty($$buffer)) $HTTP_SESSION_VARS['sess_dept_name']=$$buffer;
	else $HTTP_SESSION_VARS['sess_dept_name']=$dept_obj->FormalName();
/* Load global configs */
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');	


if ((substr($matchcode,0,1)=='%')||(substr($matchcode,0,1)=='&')) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require_once($root_path.'include/inc_config_color.php'); // load color preferences


$breakfile=$root_path.'main/op-doku.php'.URL_APPEND;
$thisfile=basename(__FILE__);

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($dept)||empty($dept))
	if($HTTP_COOKIE_VARS['ck_thispc_dept']) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
		else $dept='plop'; // default department is plop

$linecount=0;
// check date for completeness

if($mode=='save')
{
	$err_data=0;
	if(!$op_date) {$err_op_date=1; $err_data=1;}
	if(!$operator) {$err_operator=1;$err_data=1;}
	if(!$diagnosis) {$err_diagnosis=1;$err_data=1;}
	if(!$localize) {$err_localize=1;$err_data=1;}
	if(!$therapy) {$err_therapy=1;$err_data=1;}
	if(!$special) {$err_special=1;$err_data=1;}
	if(!(($class_s)||($class_m)||($class_l))) {$err_klas=1;$err_data=1;}
	if(!$op_start) {$err_op_start=1;$err_data=1;}
	if(!$op_end) {$err_op_end=1;$err_data=1;}
	if(!$scrub_nurse) {$err_scrub_nurse=1;$err_data=1;}
	if(!$op_room) {$err_op_room=1;$err_data=1;}
	
	if($err_data) $mode='?';
	
}
	
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{
    /* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    
	
	/* If the patient number is available = $patnum , get the data from the admission table */
	if(isset($pn) && !empty($pn)){
		$enc_obj->where=" encounter_nr=$pn";
	    if( $enc_obj->loadEncounterData($pn)) {
/*			switch ($enc_obj->EncounterClass())
			{
		    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		                   break;
				case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
				default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			}						
*/			
			$full_en=$pn;
			
			if( $enc_obj->is_loaded){
				$result=&$enc_obj->encounter;		
				$rows=$enc_obj->record_count;	
			}
		}else{ 
			echo "$sql<br>$LDDbNoRead";
			$mode='?';
		} 	
	}
		
	switch($mode)
	{
			case 'search':
			
							$encounter=$enc_obj->searchEncounterBasicInfo($searchkey);
							$rows=$enc_obj->record_count;
							if($rows==1)
							{
								$row=$encounter->FetchRow();
								header("location:op-doku-start.php?sid=$sid&lang=$lang&target=$target&pn=".$row['encounter_nr']."&dept_nr=$dept_nr");
								exit;
							}
							break;
											
			case 'update':
			
							$dbtable='care_op_med_doc';
							
							$sql='SELECT * FROM '.$dbtable.' WHERE  nr="'.$nr.'"';
																			
							if($ergebnis=$db->Execute($sql)) 
							{			
								if($rows=$ergebnis->RecordCount())
								{
									$opdoc=$ergebnis->FetchRow();
								}
							}else echo "$sql<br>$LDDbNoRead"; 
							//echo $sql;
							break;
							
			case 'save':
			
					$dbtable='care_op_med_doc';
					
					/* Prepare the time data */
					
					$op_start=strtr($op_start,'.;,',':::');
					$s_count=substr_count($op_start,':');
					switch($s_count)
					{
					   case 0: $op_start.=':00:00'; break;
					   case 1: $op_start.=':00';break;
					   case '': $op_start.=':00:00';
					}
					
					$op_end=strtr($op_end,'.;,',':::');
					$s_count=substr_count($op_end,':');
					switch($s_count)
					{
					   case 0: $op_end.=':00:00';break;
					   case 1: $op_end.=':00';break;
					   case '': $op_end.=':00:00';
					}
					
					if($update)
					{
					  
						$sql="UPDATE $dbtable SET
									op_date=\"".formatDate2STD($op_date,$date_format)."\",
									operator=\"$operator\",
									diagnosis=\"$diagnosis\",
									localize=\"$localize\",
									therapy=\"$therapy\",
									special=\"$special\",
									class_s=\"$class_s\",
									class_m=\"$class_m\",
									class_l=\"$class_l\",
									op_start=\"$op_start\",
									op_end=\"$op_end\",
									scrub_nurse=\"$scrub_nurse\",
									op_room=\"$op_room\",
									history=CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
									modify_id=\"".$HTTP_SESSION_VARS['sess_user_name']."\"
									WHERE nr=\"$nr\"";
									
						if($ergebnis=$db->Execute($sql))
						{
								header("location:op-doku-start.php?sid=$sid&lang=$lang&target=$target&mode=saveok&pn=$pn&nr=$nr&dept_nr=$dept_nr");
								exit;
						}else echo "$sql<br>$LDDbNoUpdate"; 
					}
					else
					{

								$sql="INSERT INTO $dbtable
								(	dept_nr,
									op_date,
									operator,
									encounter_nr,
									diagnosis,
									localize,
									therapy,
									special,
									class_s,
									class_m,
									class_l,
									op_start,
									op_end,
									scrub_nurse,
									op_room,
									history,
									modify_id,
									create_id,
									create_time
									 ) 
								VALUES (
									'$dept_nr',
									'".formatDate2STD($op_date,$date_format)."',
									'$operator', 
									'$pn',
									'".htmlspecialchars($diagnosis)."', 
									'".htmlspecialchars($localize)."', 
									'".htmlspecialchars($therapy)."', 
									'".htmlspecialchars($special)."', 
									'$class_s', 
									'$class_m', 
									'$class_l', 
									'$op_start',
									'$op_end',
									'$scrub_nurse',
									'$op_room',
									'Create: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n',
									'".$HTTP_SESSION_VARS['sess_user_name']."',
									'".$HTTP_SESSION_VARS['sess_user_name']."',
									NULL
								)";
								//echo $sql;
								if($ergebnis=$db->Execute($sql)) 
								{			
		                                $nr=$db->Insert_ID();
							  			
										header("location:op-doku-start.php?sid=$sid&lang=$lang&target=$target&mode=saveok&pn=$pn&nr=$nr&dept_nr=$dept_nr");
										exit;
										
  							    }else echo "$sql<br>$LDDbNoSave"; 

					} // end of if(update) else
							//$sdate=date(YmdHis); // time stamp
					break;
					
			case 'saveok':
			
					$dbtable='care_op_med_doc';
					
					$sql="SELECT * FROM $dbtable WHERE  nr='$nr'";
					
					if($ergebnis=$db->Execute($sql)) 
					{			

						if($rows=$ergebnis->RecordCount())
						{
							$opdoc=$ergebnis->FetchRow();
						}
					}else echo "$sql<br>$LDDbNoRead"; 
					break;
					
			default:
			
					if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) $mode="dummy";
					
	} // end of switch
}else { echo "$LDDbNoLink<br>"; }

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDOrDocument ?></TITLE>


<script  language="javascript">
<!-- 
var iscat=true;
var cat=new Image();
var pix=new Image();


function hilite(idx,mode) 
	{
	if(mode==1) idx.filters.alpha.opacity=100
	else idx.filters.alpha.opacity=70;
	}	
function lookmatch(d)
{
	m=d.matchcode.value;
	if(m=="") return false;
	if((m.substr(0,1)=="%")||(m.substr(0,1)=="&"))
	{
		d.matchcode.value="";
		d.matchcode.focus();
		return false;
	}
	window.location.replace("op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
}

function setDay(d)
{
	var h="<?php echo date("d.m.Y"); ?>";
	switch(d.value)
	{
		case "h": d.value=h; break;
		case "H": d.value=h; break;
		case "g": d.value=g; break;
		case "G": d.value=g; break;
		default: d.value="";
	}
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>


<style type="text/css" name=cat>

div.cats{
	position: relative;
	right: 10;
	top: 80;
}
</style>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if(window.focus) window.focus(); 
<?php if(!isset($mode)||empty($mode)) {
?>
document.searchform.searchkey.focus();
<?php
}
?>">

<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrDocument :: (".$HTTP_SESSION_VARS['sess_dept_name'].")" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('opdoc.php','create','<?php if(!$mode) echo 'dummy'; else echo $mode ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<?php require('./gui_tabs_op_doku.php'); ?>
<tr>
<td colspan=2  bgcolor=<?php echo $cfg['body_bgcolor']; ?>><p>

<ul>
<?php if($rows>1) : ?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo "$LDPatientsFound<br>$LDPlsClk1" ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDPatientNr ?>&nbsp; &nbsp;</b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; <?php echo $LDLastName ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDName ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDBday ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp;</b></td>
  </tr>
<?php 
$toggle=0;
while($enc_row=$encounter->FetchRow()){
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp;';
	switch($enc_row['encounter_class_nr'])
	{
		case 1:  $full_en=$enc_row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; 
					echo $full_en;
					break;
		case 2: $full_en=$enc_row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; 
					echo $full_en;
					break;
	}	
   echo '&nbsp;</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$thisfile.URL_APPEND.'&mode=select&pn='.$enc_row['encounter_nr'].'&dept_nr='.$dept_nr.'&target='.$target.'">'.$enc_row['name_last'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$enc_row['name_first'].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.formatDate2Local($enc_row['date_birth'],$date_format).'</td>';
	echo '
	<td><font face=arial size=2>&nbsp;';
	echo '<a href="'.$thisfile.URL_APPEND.'&mode=select&pn='.$enc_row['encounter_nr'].'&dept_nr='.$dept_nr.'&target='.$target.'">';
	echo '	
	<img '.createLDImgSrc($root_path,'ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
							
	if(!file_exists($root_path."cache/barcodes/pn_".$full_en.".png")){
		echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
	}
	echo '</td>';
	echo '</tr>
  <tr bgcolor=#0000ff>
  <td colspan=5 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
}
?>
</table>
<p>
<?php else :?>	

    <?php 
	   if(!$rows&&!$err_data) 
       {
    ?>
	<table border="0">
          <tr>
            <td ></td>
            <td valign="top"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0','absmiddle') ?>> <font color="#000099" SIZE=3  FACE="verdana,Arial"><b><?php echo $LDPlsSelectPatientFirst ?></b></font> <img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
          </tr>
	</table>

	<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
            include($root_path.'include/inc_patient_searchmask.php');
	   ?>
		</td>
    </tr>
   </table>

	<?php
	}
	?>

	
<?php 
if($rows || $err_data) 
{

$bg_img=$root_path.'gui/img/common/default/tableHeaderbg3.gif';
?>

<table border=0 cellpadding=3 >
<form method="post" action="op-doku-start.php" name="opdoc">
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial" <?php if($err_op_date) echo 'color=#cc0000'; ?>><?php echo $LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">

<?php 

if($mode=='saveok')
{
   echo '<b>'.formatDate2Local($opdoc['op_date'],$date_format).'</b>'; 
 }
 else
 {
    echo '<input name="op_date" type="text" size="12" maxlength=10 value="';
	if($err_data)
    {
       echo $op_date;
	}
     else
	 {	  
	     echo  formatDate2Local(date('Y-m-d'),$date_format);
     }
	
	echo '"  onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')"> ['; 
    $dfbuffer="LD_".strtr($date_format,".-/","phs");
    echo $$dfbuffer.']';  
}
  

?> 

<font size=2 face="arial" <?php if($err_operator) echo 'color=#cc0000'; ?>>&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php 
if($mode=='saveok') echo '<font color="#800000">'.$opdoc['operator']; 
	else
	{
	 echo '
	<input name="operator" type="text" size="25" value="';
	if($err_data)
    {
	  echo $operator; 
	 }
	 else
	    {
		     echo $HTTP_COOKIE_VARS[$local_user.$sid];
	    }
	echo '">';
	}
 ?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>">
<p>
<FONT SIZE=-1  FACE="Arial" <?php if($err_patnum) echo 'color=#cc0000'; ?>><?php echo $LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#000099">

<?php 

   echo '<b>'.$full_en.'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial" <?php if($err_name) echo 'color=#cc0000'; ?>><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#000099">

<?php 

   echo '<b>'.$result['name_last'].'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial" <?php if($err_vorname) echo 'color=#cc0000'; ?>><?php echo $LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#000099">
<?php 

   echo '<b>'.$result['name_first'].'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial" <?php if($err_gebdatum) echo 'color=#cc0000'; ?>><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#000099">
<?php

      echo @formatDate2Local($result['date_birth'],$date_format);

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial"  color="#000099">

<font color="#000099">
<?php 


switch($result['status'])
	{
		case "stat": echo $LDStationary;break;
		case "amb": echo $LDAmbulant; break;
	}
?>

</font>
<br>
<FONT SIZE=-1  FACE="Arial" color="#000099">
<?php 

if ($result['kasse']=="kasse")
{
   echo $LDInsurance;
}
 elseif($result['kasse']=="privat")
 {
	 echo $LDPrivate;
  }
   elseif($result['kasse']=="x")
   {
	  echo $LDSelfPay;
    }

?>     

</td>
</tr>

<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial"  <?php if($err_diagnosis) echo 'color=#cc0000'; ?>><?php echo $LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php

 echo createElement('diagnosis',$diagnosis,60,100); 
 
?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial" <?php if($err_localize) echo 'color=#cc0000'; ?>><?php echo $LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">

<?php

 echo createElement('localize',$localize,60,100); 
 
?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial" <?php if($err_therapy) echo 'color=#cc0000'; ?>><?php echo $LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">

<?php

 echo createElement('therapy',$therapy,60,100); 
 
?>
</td>
</tr >
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial" <?php if($err_special) echo 'color=#cc0000'; ?>><?php echo $LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">

<?php

echo createElement('special',$special,60,100); 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT SIZE=-1  FACE="Arial"  <?php if($err_klas) echo 'color=#cc0000'; ?>><?php echo $LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial"><font color="#800000">
<?php if($mode=='saveok')
{

    if($opdoc[class_s]) echo "$opdoc[class_s] $LDMinor  &nbsp; ";
   	if($opdoc[class_m]) echo "$opdoc[class_m] $LDMiddle &nbsp; ";
   	if($opdoc[class_l]) echo "$opdoc[class_l] $LDMajor";
	echo " $LDOperation";
}
else
{
?>
 <input name="class_s" type="text" size="2" value="<?php if($err_data) echo $class_s; else echo $opdoc['class_s']; echo '"'; if(mode=='') echo ''; ?>><?php echo $LDMinor ?>&nbsp;
<input name="class_m" type="text" size="2" value="<?php if($err_data) echo $class_m; else echo $opdoc['class_m']; echo '"'; if(mode=='') echo ''; ?>><?php echo $LDMiddle ?>&nbsp;
<input name="class_l" type="text" size="2" value="<?php if($err_data) echo $class_l; else echo $opdoc['class_l']; echo '"'; if(mode=='') echo ''; ?>><?php echo "$LDMajor $LDOperation" ?>
<?php
}
?>
</td>
</tr>

<?php
}
?>

</table>

<?php 
if($rows || $err_data) 
{
?>

<p>
 <FONT SIZE=-1  FACE="Arial" <?php if($err_op_start) echo 'color="#cc0000"'; ?>>
<?php 

/* Set the global $isTimeElement to 1 to cause the function to insert the setTime Code in the form input code */
$isTimeElement=1;

echo $LDOpStart.':';

echo createElement('op_start',$op_start);

 if($err_op_end) echo '<font color="#cc0000">';else echo '<font color="#0">'; ?> &nbsp; <?php echo $LDOpEnd.':';
 
echo createElement('op_end',$op_end);

/* Reset the global $isTimeElement to 1 to disable the setTime code insertion*/
$isTimeElement=0;

if($err_scrub_nurse) echo '<font color="#cc0000">';else echo '<font color="#0">'; ?> &nbsp; <?php echo $LDScrubNurse.':';

echo createElement('scrub_nurse',$scrub_nurse);	

if($err_op_room) echo '<font color="#cc0000">';else echo '<font color="#0">'; ?>  &nbsp; <?php echo $LDOpRoom.':';

echo createElement('op_room',$op_room);

?>
<p>

<?php if($mode=='saveok') : ?>

 <input  type="image" <?php echo createLDImgSrc($root_path,'update_data.gif','0','absmiddle') ?>  alt="<?php echo $LDSave ?>">
<input type="button" value="<?php echo $LDStartNewDocu ?>" onclick="window.location.replace('op-doku-start.php<?php echo URL_REDIRECT_APPEND."&target=$target&dept_nr=$dept_nr"; ?>&mode=dummy')">

<?php else : ?>

<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>  alt="<?php echo $LDSave ?>">
<a href="javascript:document.opdoc.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetAll ?>" ></a>

<?php endif ?>

<input type="hidden" name="mode" value="<?php if($mode=='saveok') echo 'update'; else echo 'save' ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="update" value="<?php if ($mode=='update') echo '1' ?>">
<input type="hidden" name="pn" value="<?php if($mode=='match' && $rows==1) echo $result['encounter_nr']; else echo $pn ?>">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">

</form>

<?php
}
?>


<?php endif ?>


<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<hr>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-search.php<?php echo URL_APPEND."&target=search&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDSearchDocu ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-archiv.php<?php echo URL_APPEND."&target=archiv&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDResearchArchive ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-select-dept.php<?php echo URL_APPEND."&target=$target&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDChangeOnlyDept ?></a><br>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="javascript:showcat()"><?php echo $LDShowCat ?></a><br>
 -->
<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>"></a>
</ul><p>
<hr>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>

</BODY>
</HTML>
