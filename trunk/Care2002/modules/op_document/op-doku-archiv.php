<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('doctors.php');
define('LANG_FILE','or.php');
$local_user='ck_opdoku_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(!isset($dept_nr)||empty($dept_nr)){
	header('Location:op-doku-select-dept.php'.URL_REDIRECT_APPEND.'&target=archiv');
	exit;
}

require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile=basename(__FILE__);
$breakfile=$root_path.'main/op-doku.php'.URL_APPEND;

if(!$dept)
	if($HTTP_COOKIE_VARS['ck_thispc_dept']) $dept=$HTTP_COOKIE_VARS[ck_thispc_dept];
		else $dept='plop'; // default department is plop

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
/* Create the encounter object */
include_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter();
		
		
$linecount=0;

function clean_it(&$d)
{
	$d=strtr($d,"°!§$%&/()=?`´*+'#{}[]\^","~~~~~~~~~~~~~~~~~~~~~~~");
	$d=str_replace("\"","~",$d);
	$d=str_replace("~","",$d);
	return trim($d);
}

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	

    /* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    

		switch($mode)
		{
			case 'search':
			
							$dbtable='care_op_med_doc';
							
							$sql="SELECT o.*, e.encounter_class_nr, p.name_last, p.name_first, p.date_birth, d.name_formal, d.LD_var
									FROM $dbtable AS o, care_encounter AS e, care_person AS p, care_department AS d WHERE ";
							$s2="";
							if (clean_it(&$name)) $s2.=" p.name_last=\"".addslashes($name)."\"";
							if (clean_it(&$vorname))
								if($s2) $s2.=" AND p.name_first=\"".addslashes($vorname)."\""; else $s2.=" p.name_first=\"".addslashes($vorname)."\"";
							if($gebdatum)
							{
							    $gebdatum=formatDate2STD($gebdatum,$date_format);
								if($s2) $s2.=" AND p.date_birth=\"".addslashes($gebdatum)."\""; else $s2.=" p.date_birth=\"".addslashes($gebdatum)."\"";
							}
							if($op_date)
							{
							    $op_date=formatDate2STD($op_date,$date_format);
								if($s2) $s2.=" AND o.op_date=\"".addslashes($op_date)."\""; else $s2.=" o.op_date=\"".addslashes($op_date)."\"";
							}
							if (clean_it(&$patnum))
							{
								if(is_numeric($patnum)) $patnum=(int)$patnum; else $patnum='"'.addslashes($patnum).'"';
								if($s2) $s2.=" AND o.encounter_nr=$patnum"; else $s2.=" o.encounter_nr=$patnum";
							}
							if(clean_it(&$operator))
								if($s2) $s2.=" AND o.operator=\"".addslashes($operator)."\""; else $s2.=" o.operator=\"".addslashes($operator)."\"";
							if ($status)
								if($s2) $s2.=" AND e.encounter_class_nr=\"$status\""; else $s2.=" e.encounter_class_nr=\"$status\"";
							if ($kasse)
								if($s2) $s2.=" AND e.insurance_firm_id=\"$kasse\""; else $s2.=" e.insurance_firm_id=\"$kasse\"";
							if(clean_it(&$diagnosis))
								if($s2) $s2.=" AND o.diagnosis LIKE \"%$diagnosis%\""; else $s2.=" o.diagnosis LIKE \"%$diagnosis%\"";
							if(clean_it(&$localize))
								if($s2) $s2.=" AND o.localize LIKE \"%$localize%\""; else $s2.=" o.localize LIKE \"%$localize%\"";
							if(clean_it(&$therapy))
								if($s2) $s2.=" AND o.therapy LIKE \"%$therapy%\""; else $s2.=" o.therapy LIKE \"%$therapy%\"";
							if(clean_it(&$special))
								if($s2) $s2.=" AND o.special LIKE \"%$special%\""; else $s2.=" o.special LIKE \"%$special%\"";
							if(clean_it(&$klas_s))
								if($s2) $s2.=" AND o.class_s LIKE $klas_s"; else $s2.=" o.class_s LIKE $klas_s";
							if(clean_it(&$klas_m))
								if($s2) $s2.=" AND o.class_m LIKE $klas_m"; else $s2.=" o.class_m LIKE $klas_m";
							if(clean_it(&$klas_l))
								if($s2) $s2.=" AND o.class_l LIKE $klas_l"; else $s2.=" o.class_l LIKE $klas_l";
							if(clean_it(&$inst))
								if($s2) $s2.=" AND o.scrub_nurse=\"".addslashes($inst)."\""; else $s2.=" o.scrub_nurse=\"".addslashes($inst)."\"";
							if(clean_it(&$opsaal))
								if($s2) $s2.=" AND o.op_room=\"".addslashes($opsaal)."\""; else $s2.=" o.op_room=\"".addslashes($opsaal)."\"";

							$s2=trim($s2);
							if($s2=="")
								{
									header("location:$thisfile".URL_REDIRECT_APPEND."&dept_nr=$dept_nr&target=archiv&mode=?");
									exit;
								}
							$sql.=$s2.' AND o.encounter_nr=e.encounter_nr AND e.pid=p.pid AND o.dept_nr=d.nr ORDER BY o.nr DESC';
							if($ergebnis=$db->Execute($sql)) 
							{			
								if(!$rows=$ergebnis->RecordCount())
								{
									//echo $sql;
									$sql=str_replace("=\""," LIKE ~",$sql);
									$sql=str_replace("\"","%\"",$sql);
									$sql=str_replace("~","\"",$sql);
									//echo $sql;
									if($ergebnis=$db->Execute($sql)) 
									{			
										$rows=$ergebnis->RecordCount();
									}
								}
							}else echo "$LDDbNoRead<p> $sql <p>";
							
							//echo $sql;
							
							if($rows==1)
							 {
								$row=$ergebnis->FetchRow();
								$enc_obj->loadEncounterData($row['encounter_nr']);
								$mode='select';
							}
							break;
							
			case 'select':
			
							$dbtable='care_op_med_doc';
							
							$sql='SELECT * FROM '.$dbtable.' WHERE nr="'.$nr.'"';
							
							if($ergebnis=$db->Execute($sql)) 
							{			
								if($rows=$ergebnis->RecordCount())
								{
									$row=$ergebnis->FetchRow();
									$enc_obj->loadEncounterData($row['encounter_nr']);
								}
							}else echo "$LDDbNoRead<p> $sql <p>";

							break;
							
			default:
					if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $mode='dummy';
					break;
		} // end of switch
	}
	else { echo "$LDDbNoLink<br>"; }

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>OP Dokumentation</TITLE>


<script  language="javascript">
<!-- 
var iscat=true;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
}

function loadcat()
{
  cat=new Image();
  cat.src="../imgcreator/catcom.php?<?php echo "lang=$lang&person=".$HTTP_COOKIE_VARS[$local_user.$sid];?>";
  pix=new Image();
  pix.src="../../gui/img/common/default/pixel.gif";
}

function showcat()
{

	if(document.images) document.catcom.src=cat.src;
	iscat=true;
}

function hilite(idx,mode) 
	{
	if(mode==1) idx.filters.alpha.opacity=100
	else idx.filters.alpha.opacity=70;
	}	
function lookmatch(d)
{
	m=d.matchcode.value;
	if(m=="") return false;
	window.location.replace("op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
}

function chkForm(d)
{
	if((d.op_date.value!="")||(d.operator.value!="")||(d.patnum.value!="")||(d.name.value!="")||(d.vorname.value!="")||(d.gebdatum.value!=""))return true;
	if((d.status[0].checked)||(d.status[1].checked)||(d.kasse[0].checked)||(d.kasse[1].checked)||(d.kasse[2].checked))return true;
	if((d.diagnosis.value!="")||(d.localize.value!="")||(d.special.value!="")||(d.therapy.value!="")||(d.klas_s.value!="")||(d.klas_m.value!=""))return true;
	if((d.klas_l.value!="")||(d.inst.value!="")||(d.opsaal.value!=""))return true;
	return false;
}

<?php 
require($root_path.'include/inc_checkdate_lang.php'); 
?>

// -->
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

<!-- <BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if(window.focus) window.focus();loadcat();">
 -->
<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if(window.focus) window.focus();">

<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrDocument :: $LDArchive (".$HTTP_SESSION_VARS['sess_dept_name'].")" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('opdoc.php','arch','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<?php require('./gui_tabs_op_doku.php'); ?>
<tr>
<td colspan=2 bgcolor="<?php echo $cfg['body_bgcolor']; ?>"><p><br>

<!-- <div class="cats"><a href="javascript:hidecat()">
<?php 

if($mode!="") echo'
<img src="../../gui/img/common/default/pixel.gif" align=right name=catcom border=0>';
else echo '
<img src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';

?>
</a>
</div> -->

<ul>
<?php if($mode=='search')echo "<FONT  SIZE=2 FACE='verdana,Arial'>$LDSrcCondition: $s2"; ?>

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
 <?php 
   		for($i=0;$i<sizeof($LDSrcListElements);$i++)
		echo '
		   <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp; &nbsp;'.$LDSrcListElements[$i].'&nbsp;</b></td>';
	?>  </tr>
 <?php 
 $toggle=0;
 while($row=$ergebnis->FetchRow())
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  
  $buf='op-doku-archiv.php?sid='.$sid.'&lang='.$lang.'&mode=select&target='.$target.'&dept_nr='.$row['dept_nr'].'&nr='.$row[nr];
  
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.createComIcon($root_path,'r_arrowgrnsm.gif','0').'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$row['name_last'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$row['name_first'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.formatDate2Local($row['date_birth'],$date_format).'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;';
  switch($row['encounter_class_nr'])
  {
  	case 1: echo $row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder'];
				break;
  	case 2: echo $row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder'];
				break;
  }
	echo '</td>
	<td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.formatDate2Local($row['op_date'],$date_format).'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;';

	$buffer=$row['LD_var'];
	if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
		else echo $row['name_formal'];
		
	echo '</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$row['nr'].'</a>&nbsp; &nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>
<form method="post"  action="op-doku-archiv.php">
<FONT  SIZE=-1  FACE="Arial">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="target" value="archiv">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="mode" value="dummy">
<input type="submit" value="<?php echo $LDNewArchiveSearch ?>" >
                             </form>
<?php else :?>



<FONT  SIZE=-1  FACE="Arial">
<table border="0"  bgcolor="#ffffff">

<form method="post" name="opdoc" <?php if($mode=="select") echo 'action="op-doku-start.php"'; else echo 'action="op-doku-archiv.php"  onSubmit="return chkForm(this)"'; ?>>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php

if($mode=="select")
{
    echo '<font color="#800000">'.formatDate2Local($row['op_date'],$date_format); 
}
else 
{
    echo '
 <input name="op_date" type="text" size="14" onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')"> [';
 
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer.' ]';
}
?>
 
<font color="#000000">&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php if($mode=="select") echo '<font color="#800000">'.$row[operator]; 
	else echo '
	<input name="operator" type="text" size="14" >';
 ?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td>
<p>
<FONT SIZE=-1  FACE="Arial"><?php echo $LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") {
	echo '<font color="#000099">';
/*	 switch($enc_obj->EncounterClass())
  	{
  		case 1: echo $row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder'];
				break;
  		case 2: echo $row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder'];
				break;
  	} 
*/
	echo $row['encounter_nr'];
  }
	else echo '
	<input name="patnum" type="text" size="14">';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#000099"><b>'.$enc_obj->LastName().'</b>'; 
	else echo '
	<input name="name" type="text" size="14">';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#000099"><b>'.$enc_obj->FirstName().'</b>'; 
	else echo '
	<input name="vorname" type="text" size="14" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php 

if($mode=="select") 
{
    echo '<font color="#000099">'.formatDate2Local($enc_obj->BirthDate(),$date_format); 
}
else
{
   echo '<input name="gebdatum" type="text" size="14" onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')"> [ ';

   $dfbuffer="LD_".strtr($date_format,".-/","phs");
   echo $$dfbuffer.' ]';
}
?> 

</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") : ?>
<font color="#000099">
<?php switch($row[status])
	{
		case "stat": echo $LDStationary;break;
		case "amb": echo $LDAmbulant; break;
	}
	echo "<br>";
	echo ucfirst($row[kasse]);
?>
<?php else : ?>
<input name="status" type="radio" value="2" <?php if (($row[status]==2)||($status==2))echo "checked" ?> ><?php echo $LDAmbulant ?>  <input name="status" type="radio" value="1"  <?php if(($row[status]==1)||($status==1)) echo "checked" ?> ><?php echo $LDStationary ?><br>
</font>
<FONT SIZE=-1  FACE="Arial" <?php if($err_kasse) echo 'color=#cc0000'; ?>><input name="kasse" type="radio" value="kasse" <?php if (($row[kasse]=="kasse")||($row[kasse]=="kasse")||($kasse=="kasse")) echo "checked" ?> ><?php echo $LDInsurance ?>  <input name="kasse" type="radio" value="privat"  <?php if (($row[kasse]=="privat")||($row[kasse]=="privat")||($kasse=="privat")) echo "checked" ?> ><?php echo $LDPrivate ?> <input name="kasse" type="radio" value="x"  <?php if (($row[kasse]=="x")||($row[kasse]=="x")||($kasse=="x")) echo "checked" ?> ><?php echo $LDSelfPay ?>
<?php endif ?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#800000">'.$row[diagnosis]; 
	else echo '
	<input name="diagnosis" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#800000">'.$row[localize]; 
	else echo '
	<input name="localize" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#800000">'.$row[therapy]; 
	else echo '
	<input name="therapy" type="text" size="60" >';
?>
</td>
</tr >
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#800000">'.$row[special]; 
	else echo '
	<input name="special" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") : ?>
<font color="#800000">
<?php
if($row[class_s]) echo "$row[class_s] $LDMinor  &nbsp; ";
   	if($row[class_m]) echo "$row[class_m] $LDMiddle &nbsp; ";
   	if($row[class_l]) echo "$row[class_l] $LDMajor";
	echo " $LDOperation";
?>
<?php else : ?>
 <input name="klas_s" type="text" size="2" value="<?php echo $row[class_s].$klas_s ?>" ><?php echo $LDMinor ?>&nbsp;
<input name="klas_m" type="text" size="2" value="<?php echo $row[class_m].$klas_m ?>" ><?php echo $LDMiddle ?>&nbsp;
<input name="klas_l" type="text" size="2" value="<?php echo $row[class_l].$klas_l ?>" ><?php echo "$LDMajor $LDOperation" ?>
<?php endif ?>
</td>
</tr>
</table>
<p>
 <FONT SIZE=-1  FACE="Arial">
<font color="#0"> &nbsp; <?php echo $LDScrubNurse ?>: 
<?php if($mode=="select") echo '<font color="#800000">'.$row[scrub_nurse].' &nbsp;'; 
	else echo '
	<input name="inst" type="text" size="14" >';
?>
<font color="#0"> &nbsp; <?php echo $LDOpRoom ?>: <font color="#0">
<?php if($mode=="select") echo '<font color="#800000">'.$row[op_room]; 
	else echo '
	<input name="opsaal" type="text" size="3" >';
?>
<p>
<?php if($mode=="select") : ?>
<input type="hidden" name="nr" value="<?php echo $row['nr'] ?>">
<input type="hidden" name="pn" value="<?php echo $row['encounter_nr'] ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="target" value="entry">
<!-- <input type="submit" value="<?php echo $LDUpdateData ?>">
 -->
 <input type="image"<?php echo createLDImgSrc($root_path,'update_data.gif') ?>>
<p>
<input type="button" value="<?php echo $LDNewArchiveSearch ?>" onClick="window.location.href='op-doku-archiv.php<?php echo URL_REDIRECT_APPEND."&dept_nr=$dept_nr" ?>&target=archiv&mode=?'">

<?php else : ?>
<input type="hidden" name="target" value="archiv">
<input  type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0') ?> border=0  alt="<?php echo $LDSearch ?>">
<input type="hidden" name="mode" value="search">
<a href="javascript:document.opdocument.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetAll ?>" ></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
</form>
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
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-start.php<?php echo URL_APPEND."&target=entry&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDStartNewDocu ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-search.php<?php echo URL_APPEND."&target=archiv&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDSearchDocu ?></a><br>
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
