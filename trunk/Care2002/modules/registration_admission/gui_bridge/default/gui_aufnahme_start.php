<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $headframe_title ?></TITLE>

<script  language="javascript">
<!-- 
function setsex(d)
{
	s=d.selectedIndex;
	t=d.options[s].text;
	if(t.indexOf("Frau")!=-1) document.aufnahmeform.sex[1].checked=true;
	if(t.indexOf("Herr")!=-1) document.aufnahmeform.sex[0].checked=true;
	if(t.indexOf("-")!=-1){ document.aufnahmeform.sex[0].checked=false;document.aufnahmeform.sex[1].checked=false;}
}

function settitle(d)
{
	if(d.value=="m") document.aufnahmeform.anrede.selectedIndex=2;
	else document.aufnahmeform.anrede.selectedIndex=1;
}


function hidecat()
{
<?php if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
	if(document.images) document.images.catcom.src="../../gui/img/common/default/pixel.gif";
<?php
}
?>
}

function loadcat()
{

  	cat=new Image();
  	cat.src="../imgcreator/catcom.php?person=<?php echo strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+")."&lang=$lang";?>";
  	
}

function showcat()
{
<?php if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
	document.images.catcom.src=cat.src;
<?php
}
?>
}


<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>

<?php 
require('./include/js_popsearchwindow.inc.php');
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php
if(!$encounter_nr && !$pid)
{
?>
onLoad="if(document.searchform.searchkey.focus) document.searchform.searchkey.focus();" 
<?php
}

 if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
if(onLoad="if (window.focus) window.focus();loadcat();" 
<?php
}
?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo $headframe_title; if($encounter_nr) echo $headframe_append; ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2new.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo 'startframe.php'.URL_APPEND; 
	else echo "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

$target='entry';
include('./gui_bridge/default/gui_tabs_patadmit.php') 

?>

<tr>
<td colspan=3  bgcolor=<?php echo $cfg['body_bgcolor']; ?>>

<?php  /* If defined, create the mascot */

if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
<div class="cats">
<a href="javascript:hidecat()"><img
<?php if($from=="pass")
{ 
    echo 'src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" ';
 }
else 
{
	echo ' src="../../gui/img/common/default/pixel.gif" ';
}
?>
align=right id=catcom border=0></a>
</div>
<?php
}
?>

<ul>


<?php 
/* If the origin is admission link, show the search prompt */
if(!isset($pid) || !$pid)
{
/* Set color values for the search mask */

$searchmask_bgcolor="#f3f3f3";
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

?>
<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
  </tr>
</table>

 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	        /* set the script for searching */
	       $search_script='patient_register_search.php';
		   $user_origin='admit';
		   
            include($root_path.'include/inc_patient_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>

   <FONT    SIZE=3  FACE="Arial" color="#990000"><br>
   <img <?php echo createComIcon($root_path,'warn.gif','0','absmiddle'); ?>>
<?php 
   
   echo $LDRedirectToRegistry;
}
else
{
?>

<FONT    SIZE=-1  FACE="Arial">

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform">

<table border="0" cellspacing=1 cellpadding=0>


<?php 
if($error) 
{
?>
<tr>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle">
	<?php if ($errornum>1) echo $LDErrorS; else echo $LDError; ?>
</center>
</td>
</tr>
<?php
}
 ?>


<tr>
<td  background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td bgcolor="#eeeeee">
<FONT SIZE=-1  FACE="Arial" ><?php if(isset($encounter_nr)&&$encounter_nr) echo $full_en; else echo '<font color="red">'.$LDNotYetAdmitted.'</font>'; ?>
</td>
<td rowspan=7 align="right"><img <?php echo $img_source ?> width=137>
</td>
</tr>

<tr>
<td  background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitDate ?>: 
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 
    if(isset($encounter_nr)&&$encounter_nr) echo @formatDate2Local(date('Y-m-d'),$date_format); 
?>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitTime ?>:
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php if(isset($encounter_nr)&&$encounter_nr) echo @convertTimeToLocal(date('H:i:s')); ?>
</td>
</tr>
<tr>
<td colspan=2><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $title ?>
</td>

</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_last; ?></b>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_first; ?></b>
</td>
</tr>

<?php if($GLOBAL_CONFIG['patient_name_2_show'])
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDName2 ?>:
</td>
<td bgcolor="#ffffee" colspan=2><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_2; ?></b>
</td>
</tr>
<?php
}

if($GLOBAL_CONFIG['patient_name_3_show'])
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDName3 ?>:
</td>
<td bgcolor="#ffffee" colspan=2><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_3; ?></b>
</td>
</tr>
<?php
}

if($GLOBAL_CONFIG['patient_name_middle_show'])
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDNameMid ?>:
</td>
<td bgcolor="#ffffee" colspan=2><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_middle; ?></b>
</td>
</tr>
<?php
}
?>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><FONT SIZE=-1  FACE="Arial"><b><?php echo @formatDate2Local($date_birth,$date_format);?></b>
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>: <?php if($sex=='m') echo $LDMale; elseif($sex=='f') echo $LDFemale; ?>
</td>
</tr>


<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAddress ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php 

/* Note: The address is displayed in german format. 
*   STREET_NAME STREET_NUMBER
*   ZIP_CODE  TOWN_OR_CITY
*  Edit the code to display it in other formats
*/
echo $addr_str.' '.$addr_str_nr.'<br>';
echo $addr_zip.' '.$addr_citytown_name.'<br>';

?>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php
if(is_object($encounter_classes)){
    while($result=$encounter_classes->FetchRow()) {
?>
<input name="encounter_class_nr" type="radio"  value="<?php echo $result['class_nr']; ?>" <?php if($encounter_class_nr==$result['class_nr']) echo 'checked'; ?>>
<?php 
        $LD=$result['LD_var'];
        if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        echo '&nbsp;';
	}
} 
?>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php if ($errorward) echo "<font color=red>"; ?><?php echo $LDWard ?>:
</td>
<td colspan=2 bgcolor="#eeeeee">
<select name="current_ward_nr">
	<option value="">___________________________________________________</option>
<?php 
if(!empty($ward_info)&&$ward_info->RecordCount()){
    while($station=$ward_info->FetchRow()){
	    echo '
	    <option value="'.$station['nr'].'" ';
	    if(isset($current_ward_nr)&&($current_ward_nr==$station['nr'])) echo 'selected';
		echo '>'.$station['name'].'</option>';
    }
}
?>
</select>

</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php if ($errordiagnose) echo "<font color=red>"; ?><?php echo $LDDiagnosis ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="referrer_diagnosis" type="text" size="60" value="<?php echo $referrer_diagnosis; ?>">
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php if ($errorreferrer) echo "<font color=red>"; ?><?php echo $LDRecBy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="referrer_dr" type="text" size="60" value="<?php echo $referrer_dr; ?>"><a href="#"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>></a>
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php if ($errortherapie) echo "<font color=red>"; ?><?php echo $LDTherapy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="referrer_recom_therapy" type="text" size="60" value="<?php echo $referrer_recom_therapy; ?>">
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php if ($errorbesonder) echo "<font color=red>"; ?><?php echo $LDSpecials ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="referrer_notes" type="text" size="60" value="<?php echo $referrer_notes; ?>">
</td>
</tr>

<!-- The insurance class  -->
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php if ($errorinsclass) echo "<font color=red>"; ?><?php echo $LDBillType ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">

<?php
if(is_object($insurance_classes)){
    while($result=$insurance_classes->FetchRow()) {
?>
<input name="insurance_class_nr" type="radio"  value="<?php echo $result['class_nr']; ?>" <?php if($insurance_class_nr==$result['class_nr']) echo 'checked'; ?>>
<?php 
        $LD=$result['LD_var'];
        if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        echo '&nbsp;';
	}
} 
?>

</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php if ($error_ins_nr) echo "<font color=red>"; ?><?php echo $LDInsuranceNr ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="insurance_nr" type="text" size="60" value="<?php if(isset($insurance_nr)) echo $insurance_nr; ?>"> 
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php if ($error_ins_co) echo "<font color=red>"; ?><?php echo $LDInsuranceCo ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="insurance_firm_name" type="text" size="60" value="<?php  if(isset($insurance_firm_name))echo $insurance_firm_name; ?>"><a href="javascript:popSearchWin('insurance','aufnahmeform.insurance_firm_id','aufnahmeform.insurance_firm_name')"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>></a>
</td>
</tr>

<?php

//if (!$GLOBAL_CONFIG['patient_care_service_hide'] && $care_ok)
if (!$GLOBAL_CONFIG['patient_service_care_hide']&& is_object($care_service))
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDCareServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><nobr>
<select name="sc_care_class_nr" onFocus="hidecat()">
<?php
while($buffer=$care_service->FetchRow())
{
  echo '
	<option value="'.$buffer['class_nr'].'" ';
	if($sc_care_class_nr==$buffer['class_nr']) echo 'selected';
	echo '>';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
}
?>
</select>

<?php echo $LDFrom ?> <input type="text" name="sc_care_start"  value="<?php if(!empty($sc_care_start))  echo @formatDate2Local($sc_care_start,$date_format); ?>" size=9 maxlength=10 onFocus="hidecat()"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<?php echo $LDTo ?> <input type="text" name="sc_care_end"  value="<?php if(!empty($sc_care_end))  echo @formatDate2Local($sc_care_end,$date_format); ?>" size=9 maxlength=10 onFocus="hidecat()"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">                 
<input type="hidden" name="sc_care_nr" value="<?php echo $sc_care_nr; ?>">
</td>
</tr>
<?php
}

//if (!$GLOBAL_CONFIG['patient_service_room_hide'] && $room_ok)
if (!$GLOBAL_CONFIG['patient_service_room_hide']&&is_object($room_service))
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDRoomServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<select name="sc_room_class_nr" onFocus="hidecat()">
<?php
while($buffer=$room_service->FetchRow())
{
  echo '
	<option value="'.$buffer['class_nr'].'" ';
	if($sc_room_class_nr==$buffer['class_nr']) echo 'selected';
	echo '>';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
}
?>
</select>

<?php echo $LDFrom ?> <input type="text" name="sc_room_start"  value="<?php if(!empty($sc_room_start))  echo @formatDate2Local($sc_room_start,$date_format); ?>" size=9 maxlength=10 onFocus="hidecat()"   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> 
<?php echo $LDTo ?> <input type="text" name="sc_room_end"  value="<?php if(!empty($sc_room_end))  echo @formatDate2Local($sc_room_end,$date_format); ?>" size=9 maxlength=10 onFocus="hidecat()"   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">                 
<input type="hidden" name="sc_room_nr" value="<?php echo $sc_room_nr; ?>">
</td>
</tr>
<?php
}

//if (!$GLOBAL_CONFIG['patient_service_att_dr_hide'] && $att_dr_ok)
if (!$GLOBAL_CONFIG['patient_service_att_dr_hide']&&is_object($att_dr_service))
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAttDrServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<select name="sc_att_dr_class_nr" onFocus="hidecat()">
<?php
while($buffer=$att_dr_service->FetchRow())
{
   echo '
	<option value="'.$buffer['class_nr'].'" ';
	if($sc_att_dr_class_nr==$buffer['class_nr']) echo 'selected';
	echo '>';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
}
?>
</select>

<?php echo $LDFrom ?> <input type="text" name="sc_att_dr_start" size=9 maxlength=10  value="<?php if(!empty($sc_att_dr_start)) echo  @formatDate2Local($sc_att_dr_start,$date_format); ?>" onFocus="hidecat()"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<?php echo $LDTo ?> <input type="text" name="sc_att_dr_end" size=9 maxlength=10 value="<?php if(!empty($sc_att_dr_end)) echo  @formatDate2Local($sc_att_dr_end,$date_format); ?>" onFocus="hidecat()"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">                 
<input type="hidden" name="sc_att_dr_nr" value="<?php echo $sc_att_dr_nr; ?>">
</td>
</tr>
<?php
}

?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitBy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input  name="encoder" type="text" value=<?php if ($encoder!='') echo '"'.$encoder.'"' ; else echo '"'.$HTTP_COOKIE_VARS[$local_user.$sid].'"' ?> size="28">
</nobr>
</td>
</tr>

</table>
<p>
<input type="hidden" name="pid" value="<?php echo $pid; ?>">
<input type="hidden" name="encounter_nr" value="<?php echo $encounter_nr; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="insurance_firm_id" value="<?php echo $insurance_firm_id; ?>">
<input type="hidden" name="insurance_show" value="<?php echo $insurance_show; ?>">


<?php if($update) echo '<input type="hidden" name=update value=1>'; ?>
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSaveData ?>" align="absmiddle"> 
<a href="<?php echo 'aufnahme_start.php'.URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDResetData ?>"  align="absmiddle"></a>
<!-- Note: uncomment the ff: line if you want to have a reset button  -->
<!-- 
<a href="javascript:document.aufnahmeform.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetData ?>"  align="absmiddle"></a> 
-->
<?php if($error==1) 
echo '<input type="hidden" name="forcesave" value="1">
								<input  type="submit" value="'.$LDForceSave.'">';
 ?>
<?php if($update) 
/*	{ 
		echo '<input type="button" value="'.$LDCancel.'" onClick="location.replace(\'';
		if($from=="such") echo 'aufnahme_daten_such.php?sid='.$sid.'&lang='.$lang;
			else echo 'aufnahme_list.php?sid='.$sid.'&newdata=1&lang='.$lang;
		echo '\')"> ';  

	}*/
?>
</form>

<?php if (!($newdata)) : ?>

<form action=<?php echo $thisfile; ?> method=post>
<input type="hidden" name=sid value=<?php echo $sid; ?>>
<input type="hidden" name=patnum value="">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type=submit value="<?php echo $LDNewForm ?>">
</form>
<?php endif; ?>
<p>

<?php
}  // end of if !isset($pid...
?>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_daten_such.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_list.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>

<?php  /* If defined, create the mascot */

if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="#" onClick="showcat()"><?php echo $LDCatPls ?><br>
<?php
}
?>

<p>
<a href="
<?php if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) echo 'patient.php';
	else echo 'patient.php';
	echo URL_APPEND;
?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<hr>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
