<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $headframe_title ?></TITLE>

<script  language="javascript">
<!-- 
function chkForm(d){
	if(d.job_function_title.value==""){
		alert("<?php echo $LDPlsEnterJobFunction ?>");
		d.job_function_title.focus();
		return false;
	}else if(d.date_join.value==""){
		alert("<?php echo "$LDDateJoin\\n$LDPlsEnterDate" ?>");
		d.date_join.focus();
		return false;
	}else if(d.contract_start.value==""){
		alert("<?php echo "$LDContractStart\\n$LDPlsEnterDate" ?>");
		d.contract_start.focus();
		return false;
	}else if(d.encoder.value==""){
		alert("<?php echo $LDPlsEnterFullName ?>");
		d.encoder.focus();
		return false;
	}else{
		return true;
	}
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

<?php 
//require('./include/js_popsearchwindow.inc.php');
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['body_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php
if(!$personell_nr && !$pid)
{
?>
onLoad="if(document.searchform.searchkey.focus) document.searchform.searchkey.focus();" 
<?php
}

?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDPersonnelManagement :: $LDNewEmployee "; if($full_nr) echo $full_pnr; ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('employee_how2new.php','<?php echo $personell_nr ?>','<?php echo $pid ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
 echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

$target='personell_reg';
include('./gui_bridge/default/gui_tabs_personell_reg.php') 

?>

<tr>
<td colspan=3  bgcolor=<?php echo $cfg['body_bgcolor']; ?>>

<ul>

<?php 

# If the origin is admission link, show the search prompt
if(!$pid&&!$personell_nr){

?>
<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsFindPersonFirst ?></b></font></td>
    <td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
  </tr>
</table>

<?php

	$user_origin='admit';
	
	require_once($root_path.'include/care_api_classes/class_gui_search_person.php');
	$psearch = & new GuiSearchPerson;

	$psearch->setSearchFile('personell_register_search.php');

	$psearch->setTargetFile('person_register_show.php');

	$psearch->setCancelFile($root_path.'main/spediens.php');

	# Set to TRUE if you want to auto display a single result
	//$psearch->auto_show_byalphanumeric =TRUE;
	# Set to TRUE if you want to auto display a single result based on a numeric keyword
	# usually in the case of barcode scanner data
	$psearch->auto_show_bynumeric = TRUE;

	$psearch->setPrompt($LDEnterPersonSearchKey);

	$psearch->pretext=$sTemp;

	$psearch->display();

}else{

?>

<FONT    SIZE=-1  FACE="Arial">

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform" onSubmit="return chkForm(this)">

<table border="0" cellspacing=1 cellpadding=0 width=450>


<?php 
if($error) 
{
?>
<tr>
<td colspan=4><center>
<font face=arial color="#ff0000" size=4>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle">
	<?php echo $LDDataNoSaved; ?>
</center>
</td>
</tr>
<?php
}
 ?>


<tr>
<td  background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDPersonellNr ?>:
</td>
<td bgcolor="#eeeeee">
<FONT SIZE=-1  FACE="Arial" ><?php echo $full_pnr;  ?>
</td>
<td rowspan=7 align="center"><img <?php echo $img_source ?>>
</td>
</tr>

<tr>
<td  background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php //echo $LDDateJoin ?> 
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;
<?php 
    // if($date_join!='0000-00-00') echo @formatDate2Local($date_join,$date_format); 
?>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php// echo $LDDateExit ?>
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;<?php //if($date_exit!='0000-00-00') echo @formatDate2Local($date_exit,$date_format);  ?>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php// echo $LDDateExit ?>
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;<?php //if($date_exit!='0000-00-00') echo @formatDate2Local($date_exit,$date_format);  ?>
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
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDShortID; ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="short_id" type="text" size="30"  maxlength="10" value="<?php echo $short_id; ?>" >
</td>
</tr>

<!--
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php //echo $LDJobNr; ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="job_type_nr" type="text" size="30" maxlength="3" value="<?php if($job_type_nr) echo $job_type_nr; ?>" >
</td>
</tr>
-->

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDJobFunction; ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="job_function_title" type="text" size="30"  maxlength="60" value="<?php echo $job_function_title; ?>" >
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDDateJoin; ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="date_join" type="text"  size="12" maxlength=10  value="<?php  if(isset($date_join)&&$date_join!=DBF_NODATE)   echo formatDate2Local($date_join,$date_format); ?>" 
 onFocus="this.select();"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<a href="javascript:show_calendar('aufnahmeform.date_join','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 <font size=1>[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ] </font>
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDDateExit ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="date_exit" type="text"  size="12" maxlength=10  value="<?php if(isset($date_exit)&&$date_exit!=DBF_NODATE)   echo formatDate2Local($date_exit,$date_format); ?>" 
 onFocus="this.select();"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<a href="javascript:show_calendar('aufnahmeform.date_exit','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 <font size=1>[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ] </font>
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDContractClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="contract_class" type="text" size="30" maxlength="35" value="<?php if($contract_class) echo $contract_class; ?>" >
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDContractStart ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="contract_start" type="text"  size="12" maxlength=10  value="<?php  if(isset($contract_start)&&$contract_start!=DBF_NODATE)   echo formatDate2Local($contract_start,$date_format); ?>" 
 onFocus="this.select();"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<a href="javascript:show_calendar('aufnahmeform.contract_start','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 <font size=1>[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ] </font>
 </td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDContractEnd ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="contract_end" type="text" size="12" maxlength=10 value="<?php  if(isset($contract_end)&&$contract_end!=DBF_NODATE)   echo formatDate2Local($contract_end,$date_format); ?>" 
 onFocus="this.select();"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<a href="javascript:show_calendar('aufnahmeform.contract_end','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 <font size=1>[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ] </font></td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDPayClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="pay_class" type="text" size="30" maxlength="25" value="<?php echo $pay_class; ?>" >
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDPaySubClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="pay_class_sub" type="text" size="30" maxlength="25" value="<?php echo $pay_class_sub; ?>" >
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDLocalPremiumID ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="local_premium_id" type="text" size="30" maxlength="5" value="<?php echo $local_premium_id; ?>" >
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDTaxAccountNr ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="tax_account_nr" type="text" size="30" maxlength="60" value="<?php echo $tax_account_nr; ?>" >
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDInternalRevenueCode ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="ir_code" type="text" size="30" maxlength="25" value="<?php echo $ir_code; ?>" >
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDNrWorkDay ?>:
</td>
<td colspan=2 bgcolor="#eeeeee">
<select name="nr_workday">
	<?php 
		for($x=0; $x<11;$x++){
			echo "<option value=\"$x\" ";
			if($nr_workday==$x) echo 'selected';
			echo "> $x </option>";
		}
	?>
</select>

<!-- <input name="nr_workday" type="text" size="30" value="<?php // if($nr_workday) echo $nr_workday; ?>" > -->
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDNrWeekHour ?>:
</td>
<td colspan=2 bgcolor="#eeeeee">
<select name="nr_weekhour">
	<?php 
		for($x=0; $x<61;$x++){
			echo "<option value=\"$x\" ";
			if($nr_weekhour==$x) echo 'selected';
			echo "> $x </option>";
		}
	?>
</select>

<!-- <input name="nr_weekhour" type="text" size="30" value="<?php //if($nr_weekhour>0) echo $nr_weekhour; ?>" > -->
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDNrVacationDay ?>:
</td>
<td colspan=2 bgcolor="#eeeeee">
<select name="nr_vacation_day">
	<?php 
		for($x=0; $x<60;$x++){
			echo "<option value=\"$x\" ";
			if($nr_vacation_day==$x) echo 'selected';
			echo "> $x </option>";
		}
	?>
</select>

<!-- <input name="nr_vacation_day" type="text" size="30" value="<?php // if($nr_vacation_day) echo $nr_vacation_day; ?>" > -->
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDNrDependent ?>:
</td>
<td colspan=2 bgcolor="#eeeeee">
<select name="nr_dependent">
	<?php 
		for($x=0; $x<20;$x++){
			echo "<option value=\"$x\" ";
			if($nr_dependent==$x) echo 'selected';
			echo "> $x </option>";
		}
	?>
</select>

<!-- <input name="nr_dependent" type="text" size="30" value="<?php //if($nr_dependent) echo $nr_dependent; ?>" > -->
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDMultipleEmployer ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">

<input name="multiple_employer" type="radio"  value="1"  <?php  if($multiple_employer) echo 'checked'; ?>><?php  echo $LDYes; ?>
<input name="multiple_employer" type="radio"  value="0"  <?php  if(!$multiple_employer)  echo 'checked'; ?>><?php  echo $LDNo; ?>

</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitBy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input  name="encoder" type="text" value="<?php if ($create_id) echo $create_id; else echo $HTTP_SESSION_VARS['sess_user_name']; ?>" size="30" >
</nobr>
</td>
</tr>

</table>
<p>
<input type="hidden" name="pid" value="<?php echo $pid; ?>">
<input type="hidden" name="personell_nr" value="<?php echo $personell_nr; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="insurance_show" value="<?php echo $insurance_show; ?>">

<?php if($update) echo '<input type="hidden" name=update value=1>'; ?>
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>  alt="<?php echo $LDSaveData ?>" align="absmiddle"> 
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDResetData ?>"   align="absmiddle"></a>
<!-- Note: uncomment the ff: line if you want to have a reset button  -->
<!-- 
<a href="javascript:document.aufnahmeform.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetData ?>"   align="absmiddle"></a> 
-->
<?php if($error==1) 
echo '<input type="hidden" name="forcesave" value="1">
								<input  type="submit" value="'.$LDForceSave.'">';
 ?>
</form>

<?php if (!($newdata)) : ?>

<form action=<?php echo $thisfile; ?> method=post>
<input type="hidden" name="sid" value=<?php echo $sid; ?>>
<input type="hidden" name="personell_nr" value="<?php echo $personell_nr; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type=submit value="<?php echo $LDNewForm ?>" >
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
<!--<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_daten_such.php<?php echo URL_APPEND; ?>"><?php echo $LDSearchPersonell ?></a><br>
 <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_list.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>
 -->

<!-- <p>
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
 --></ul>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
