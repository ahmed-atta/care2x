<?php

require('./gui_bridge/default/gui_std_tags.php');


function createTR($ld_text, $input_val, $colspan = 1)
{
    global $toggle, $root_path;
?>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $ld_text ?>:
</td>
<td colspan=<?php echo $colspan; ?> bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $input_val; ?>
</td>
</tr>

<?php
$toggle=!$toggle;
}

echo StdHeader();
echo setCharSet(); 
?>
 <TITLE><?php echo $LDPatientRegister ?></TITLE>

<script  language="javascript">
<!-- 

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>



<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0"  cellpadding=0 >

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister ?></STRONG> <font size=+2>(<?php echo ($pid) ?>)</font></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('person_admit.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo $breakfile."?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<?php
/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_patreg.php');
?>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<FONT    SIZE=-1  FACE="Arial">

<table border=0 cellspacing=1 cellpadding=3>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDRegistryNr ?>:
</td>
<td width="30%"  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $pid; ?>
</td>

<td valign="top" rowspan=6 align="center" bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><img <?php echo $img_source; ?>>
</td>
<!-- Load the options table  -->
<td rowspan=30  valign="top">
<?php
require('./gui_bridge/default/gui_patient_reg_options.php');
?>
</td>

</tr>


<tr>
<td  bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDRegTime ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo convertTimeToLocal(formatDate2Local($date_reg,$date_format,0,1)); ?>
</td>


</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDRegDate ?>: 
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 

    echo formatDate2Local($date_reg,$date_format); 

?>
<input name="date_reg" type="hidden" value="<?php echo $date_reg ?>">
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">
<?php echo $title ?>
</td>

</tr>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php  echo $LDLastName ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#990000"><b><?php echo $name_last; ?></b>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#990000"><b><?php echo $name_first; ?></b>
<?php
# If person is dead show a black cross
if($death_date&&$death_date!='0000-00-00') echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>';
?>
</td>
</tr>

<?php

if (!$GLOBAL_CONFIG['person_name_2_hide']&&$name_2)
{
createTR($LDName2,$name_2);
}

if (!$GLOBAL_CONFIG['person_name_3_hide']&&$name_3)
{
createTR( $LDName3,$name_3);
}

if (!$GLOBAL_CONFIG['person_name_middle_hide']&&$name_middle)
{
createTR($LDNameMid,$name_middle);
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide']&&$name_maiden)
{
createTR($LDNameMaiden,$name_maiden);
}

if (!$GLOBAL_CONFIG['person_name_others_hide']&&$name_others)
{
createTR($LDNameOthers,$name_others);
}
?>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial"  color="#990000">
<b><?php       echo formatDate2Local($date_birth,$date_format);  ?></b>
<?php
# If person is dead show a black cross
if($death_date&&$death_date!='0000-00-00'){
	echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>&nbsp;<font color="#000000">'.formatDate2Local($death_date,$date_format).'</font>';
}
?>
</td>

<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial"><?php  echo $LDSex ?>: <?php if($sex=="m") echo  $LDMale; elseif($sex=="f") echo $LDFemale ?>
</td>

</tr>


<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBloodGroup ?>:
</td>
<td colspan=2 bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">  
<?php 
	$buf='LD'.$blood_group;
	echo $$buf;
?>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDCivilStatus ?>:
</td>
<td colspan=2 bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">  
<?php 
if($civil_status=="single") echo $LDSingle; 
 elseif($civil_status=="married") echo  $LDMarried; 
  elseif($civil_status=="divorced") echo  $LDDivorced;
   elseif($civil_status=="widowed") echo $LDWidowed;
    elseif($civil_status=="separated") echo  $LDSeparated ?>
</td>
</tr>


<tr>
<td colspan=3><FONT SIZE=-1  FACE="Arial"><?php echo $LDAddress ?>:
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;&nbsp;&nbsp;<?php echo $LDStreet ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial"><?php echo $addr_str; ?>
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">&nbsp;&nbsp;&nbsp;<?php echo $LDStreetNr ?>: <?php echo $addr_str_nr; ?>
</td>
</tr>



<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;&nbsp;&nbsp;<?php echo $LDTownCity ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial"><?php echo $addr_citytown_name; ?>
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">&nbsp;&nbsp;&nbsp;<?php echo $LDZipCode ?>: <?php echo $addr_zip; ?>
</td>
</tr>

 <?php

if (!$GLOBAL_CONFIG['person_insurance_1_nr_hide']&&$insurance_show&&$insurance_nr)
{
createTR($LDInsuranceNr,$insurance_nr,2);
$buffer=$insurance_class_info['LD_var'];
if(isset($$buffer)&&!empty($$buffer)) createTR($LDInsuranceClass,$$buffer,2);
    else createTR($LDInsuranceClass,$insurance_class_info['name'],2);
createTR($LDInsuranceCo.' 1',$insurance_firm_name,2);
}


if (!$GLOBAL_CONFIG['person_phone_1_nr_hide']&&$phone_1_nr)
{
createTR($LDPhone.' 1',$phone_1_nr,2);
}

if (!$GLOBAL_CONFIG['person_phone_2_nr_hide']&&$phone_2_nr)
{
createTR($LDPhone.' 2',$phone_2_nr,2);
}

if (!$GLOBAL_CONFIG['person_cellphone_1_nr_hide']&&$cellphone_1_nr)
{
createTR($LDCellPhone.' 1',$cellphone_1_nr,2);
}

if (!$GLOBAL_CONFIG['person_cellphone_2_nr_hide']&&$cellphone_2_nr)
{
createTR($LDCellPhone.' 2',$cellphone_2_nr,2);
}

if (!$GLOBAL_CONFIG['person_fax_hide']&&$fax)
{
createTR($LDFax,$fax,2);
}

if (!$GLOBAL_CONFIG['person_email_hide']&&$email)
{
?>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDEmail ?>:
</td>
<td bgcolor="#ffffee" colspan=2><FONT SIZE=-1  FACE="Arial"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
</td>
</tr>

<?php
}

if (!$GLOBAL_CONFIG['person_citizenship_hide']&&$citizenship)
{
createTR($LDCitizenship,$citizenship,2);
}

if (!$GLOBAL_CONFIG['person_sss_nr_hide']&&$sss_nr)
{
createTR($LDSSSNr,$sss_nr,2);
}

if (!$GLOBAL_CONFIG['person_nat_id_nr_hide']&&$nat_id_nr)
{
createTR($LDNatIdNr,$nat_id_nr,2);
}

if (!$GLOBAL_CONFIG['person_religion_hide']&&$religion)
{
createTR($LDReligion,$religion,2);
}

if (!$GLOBAL_CONFIG['person_ethnic_orig_hide']&&$ethnic_orig)
{
createTR($LDEthnicOrigin,$ethnic_orig_txt,2);
}

?>
 
 <tr>
<td bgcolor="#eeeeee"><nobr><FONT  SIZE=2  FACE="Arial"><?php echo $LDRegBy ?>:
</nobr>
</td>
<td colspan=2 bgcolor="#ffffee"><FONT  SIZE=2  FACE="Arial"><?php echo $modify_id ?> </FONT>
</td>
</tr>

</table>
<p>


<?php if (!$newdata) { ?>

<?php if($target=="search") $newsearchfile='patient_register_search.php'.URL_APPEND;
    else $newsearchfile='patient_register_archive.php'.URL_APPEND;
?>
<a href="<?php echo $newsearchfile ?>"><img 
<?php echo createLDImgSrc($root_path,'new_search.gif','0','absmiddle') ?>></a>
<?php } ?>
<a href="patient_register.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&update=1"><img 
<?php echo createLDImgSrc($root_path,'update_data.gif','0','absmiddle') ?>></a>
<?php
# If currently admitted show button link to admission data display
if($current_encounter){
?>
<a href="aufnahme_daten_zeigen.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $current_encounter ?>&origin=patreg_reg"><img <?php echo createLDImgSrc($root_path,'admission_data.gif','0','absmiddle') ?>></a>
<?php
# Else if person still living, show button links to admission
}elseif(!$death_date||$death_date=='0000-00-00'){
?>
<a href="<?php echo $admissionfile ?>&pid=<?php echo $pid ?>&origin=patreg_reg&encounter_class_nr=1"><img <?php echo createLDImgSrc($root_path,'admit_inpatient.gif','0','absmiddle') ?>></a>
<a href="<?php echo $admissionfile ?>&pid=<?php echo $pid ?>&origin=patreg_reg&encounter_class_nr=2"><img <?php echo createLDImgSrc($root_path,'admit_outpatient.gif','0','absmiddle') ?>></a>
<?php
}
?>

<form action="patient_register.php" method=post>
<input type=submit value="<?php echo $LDRegisterNewPerson ?>" >
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
</form>


<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPersonSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_archive.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>

<p>
<a href="
<?php if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) echo $root_path.'main/startframe.php'.URL_APPEND;
	else echo $breakfile.URL_APPEND;
	echo ;
?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
StdFooter();
?>
