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
	header('Location:op-doku-select-dept.php'.URL_REDIRECT_APPEND.'&target=search');
	exit;
}

if ((substr($matchcode,0,1)=="%")||(substr($matchcode,0,1)=="&")) {
	$matchcode='';
	$mode='';
}; 

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

require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile=basename(__FILE__);
$breakfile=$root_path.'main/op-doku.php'.URL_APPEND;
//foreach($arg as $v) echo "$v<br>"; //init db parameters

if(!$dept)
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&!empty($HTTP_COOKIE_VARS['ck_thispc_dept'])) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
		else $dept='plop'; // default department is plop

$linecount=0;

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){	
    /* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    

    /* Load editor functions */
    //include_once('../include/inc_editor_fx.php');

		switch($mode)
		{
			case 'match':
							
							$dbtable='care_op_med_doc';
							
							if(is_numeric($matchcode)&&$matchcode)
							{
								$matchcode=(int)$matchcode;							
							}else{ 
								$matchcode=addslashes($matchcode);
							}
							
							$select_sql='SELECT o.*, e.encounter_class_nr, p.name_last, p.name_first, p.date_birth,d.name_formal,d.LD_var
									FROM '.$dbtable.' AS o,
												care_encounter AS e,
												care_person AS p,
												care_department AS d';
												
							$and_sql=' AND o.encounter_nr=e.encounter_nr
											AND e.pid=p.pid
											AND o.dept_nr=d.nr';
							
							if(!isset($all_depts)||$all_depts=='false') $and_sql.=' AND o.dept_nr='.$dept_nr;

							$sql=$select_sql.'	WHERE o.encounter_nr = "'.$matchcode.'%" '.$and_sql;

							//if(!isset($all_depts)||$all_depts=='false') $sql.=' AND o.dept_nr='.$dept_nr;

							if($ergebnis=$db->Execute($sql)) 
							{			
								if(!$rows=$ergebnis->RecordCount())
								{ 
								    // if not found find similar
								    $sql=$select_sql.'	WHERE ( o.nr LIKE "'.trim($matchcode).'%" 
											OR o.encounter_nr LIKE "'.trim($matchcode).'%" 
											OR p.name_last LIKE "'.trim($matchcode).'%" 
											OR p.name_first LIKE "'.trim($matchcode).'%" 
											OR p.date_birth LIKE "'.trim($matchcode).'%" ) '.$and_sql;
											
									//if(!isset($all_depts)||$all_depts=='false') $sql.=' AND o.dept_nr='.$dept_nr;
									//echo $all_depts;
									$sql.='	ORDER BY o.nr DESC';
									//echo $sql;
									if($ergebnis=$db->Execute($sql)) 
									{			
										$rows=$ergebnis->RecordCount();
									}
									
								}
							}else echo "$LDDbNoRead<p> $sql <p>";
							
							//echo $sql;
							if($rows==1){
								$row=$ergebnis->FetchRow();
								$enc_obj->loadEncounterData($row['encounter_nr']);
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
							//echo $sql;
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
 <TITLE><?php echo $LDOrDocument ?></TITLE>


<script  language="javascript">
<!-- 
var iscat=true;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
	document.matchform.matchcode.focus();
}

function loadcat()
{
  cat=new Image();
  cat.src="<?php echo $root_path ?>main/imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person=<?php echo $HTTP_COOKIE_VARS[$local_user.$sid];?>";
  pix=new Image();
  pix.src="<?php echo $root_path ?>gui/img/common/default/pixel.gif";
}

function showcat()
{

	if(document.images) document.catcom.src=cat.src;
	iscat=true;
}
	
function lookmatch(d)
{
	m=d.matchcode.value;
	a=d.all_depts.checked;
	if(m=="") return false;
	if((m.substr(0,1)=="%")||(m.substr(0,1)=="&"))
	{
		d.matchcode.value="";
		d.matchcode.focus();
		return false;
	}
	window.location.replace("op-doku-search.php?sid=<?php echo "$sid&lang=$lang&target=$target&dept_nr=$dept_nr" ?>&mode=match&matchcode="+m+"&all_depts="+a);
	return false;
}
// -->
</script>

<style type="text/css" name="cat">

div.cats{
	position: relative;
	right: 10;
	top: 80;
}
</style>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<!-- <BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if(window.focus) window.focus();loadcat(); document.matchform.matchcode.focus();">
 -->
 <BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if(window.focus) window.focus();document.matchform.matchcode.focus();">


<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>" SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrDocument :: $LDSearch (".$HTTP_SESSION_VARS['sess_dept_name'].")" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('opdoc.php','search','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<?php require('./gui_tabs_op_doku.php'); ?>
<tr>
<td colspan=2 bgcolor=<?php echo $cfg['body_bgcolor']; ?>><p><br>

<!-- <div class="cats"><a href="javascript:hidecat()">
<?php if($mode!="") echo'
<img src="'.$root_path.'gui/img/common/default/pixel.gif" align=right name=catcom border=0>';
else echo '
<img src="'.$root_path.'main/imgcreator/catcom.php?sid='.$sid.'&lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
?>
</a></div> -->

<ul>
<form method="post"  name="matchform" onSubmit="return lookmatch(this)">
<FONT  SIZE=-1  FACE="Arial"><?php echo $LDSearchKeyword ?>: <input name="matchcode" type="text" size="20">&nbsp;<br>
<FONT  SIZE=-1  FACE="Arial"><input type="checkbox" name="all_depts" <?php if ($all_depts=='true') echo 'checked' ?>> <?php echo $LDSearchInAllDepts ?><br>
<input type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle') ?> alt="<?php echo $LDSearch ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<hr>
</form>
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
	?>

  </tr>
 <?php 
 $toggle=0;
 while($row=$ergebnis->FetchRow())
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  $buf="op-doku-search.php".URL_APPEND."&dept_nr=".$row['dept_nr']."&target=search&mode=select&nr=".$row['nr'];
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.createComIcon($root_path,'r_arrowgrnsm.gif','0').'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$row['name_last'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$row['name_first'].'</td>
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

<?php elseif($rows) :?>



<FONT  SIZE=-1  FACE="Arial">
<table border="0">

<form method="post" action="op-doku-start.php" name="opdoc">
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSrcListElements[7] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$row['nr']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSrcListElements[6] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$HTTP_SESSION_VARS['sess_dept_name']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.formatDate2Local($row['op_date'],$date_format); 
?>
<font color=#0>&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php  echo '<font color="#800000">'.$row['operator']; 
 ?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>

<FONT SIZE=-1  FACE="Arial"><?php echo $LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#000099">';
  switch($enc_obj->EncounterClass())
  {
  	case 1: echo $row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder'];
				break;
  	case 2: echo $row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder'];
				break;
  } 
?>
</td>
</tr>
<tr>
<td>

&nbsp;
</td>
<td>
&nbsp;
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#000099"><b>'.$enc_obj->LastName().'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#000099"><b>'.$enc_obj->FirstName().'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#000099">'.formatDate2Local($enc_obj->BirthDate(),$date_format); 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color=#000099>
<?php switch($row['status'])
	{
		case "stat": echo $LDStationary;break;
		case "amb": echo $LDAmbulant; break;
	}
	echo "<br>";
	echo ucfirst($row['kasse']);
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$row['diagnosis']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$row['localize']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$row['therapy']; 
?>
</td>
</tr >
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$row['special']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color="#800000">
<?php
if($row['class_s']) echo $row['class_s']." $LDMinor  &nbsp; ";
   	if($row['class_m']) echo $row['class_m']." $LDMiddle &nbsp; ";
   	if($row['class_l']) echo $row['class_l']." $LDMajor";
	echo " $LDOperation";
?>
</td>
</tr>
</table>
<p>
 <FONT SIZE=-1  FACE="Arial">
<?php echo $LDOpStart ?>:<font color="#0">
<?php  echo '<font color="#800000">'.convertTimeToLocal($row['op_start']).' &nbsp;'; 
	
?>
<font color="#0"><?php echo $LDOpEnd ?>:
<?php echo '<font color="#800000">'.convertTimeToLocal($row['op_end']).' &nbsp;'; 
	
?>
<font color="#0"><?php echo $LDScrubNurse ?>: 
<?php  echo '<font color="#800000">'.$row['scrub_nurse'].' &nbsp;'; 
	
?>
<font color="#0"><?php echo $LDOpRoom ?>: <font color="#0">
<?php  echo '<font color="#800000">'.$row['op_room']; 
?>
<?php
$buf="op-doku-start.php?sid=$sid&lang=$lang&mode=update&update=1&nr=".$row['nr']."&pn=".$row['encounter_nr'];
?>
<!-- <p><input type="button" value="<?php echo $LDUpdateData ?>" onClick="window.location.href='<?php echo $buf ?>'"> &nbsp;
 -->
 <p><input type="image" <?php echo createLDImgSrc($root_path,'update_data.gif') ?>>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="nr" value="<?php echo $row['nr'] ?>">
<input type="hidden" name="pn" value="<?php echo $row['encounter_nr'] ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="target" value="entry">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="update" value="1">
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
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-start.php<?php echo URL_APPEND."&target=entry&dept_nr=$dept_nr" ?>&mode=dummy"><?php echo $LDStartNewDocu ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-archiv.php<?php echo URL_APPEND."&target=archiv&dept_nr=$dept_nr" ?>&mode=dummy"><?php echo $LDResearchArchive ?></a><br>
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
