<?php
require('./gui_bridge/default/gui_std_tags.php');

echo StdHeader();
echo setCharSet(); 

?>
 <TITLE></TITLE>
 

<?php 
require($root_path.'include/inc_js_barcode_wristband_popwin.php');
require('./include/js_poprecordhistorywindow.inc.php');
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?> 
</HEAD>

<BODY bgcolor="<?php echo $cfg['body_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing=0 cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPersonellData.' ('.$full_pnr.')'; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) echo 'startframe.php?sid='.$sid.'&lang='.$lang; 
	else echo "personell_admin_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

//$target='entry';
include('./gui_bridge/default/gui_tabs_personell_reg.php') 

?>

<tr>
<td colspan=3  bgcolor=<?php echo $cfg['body_bgcolor']; ?>><p><br>

<?php
if(empty($is_discharged)){
	if(!empty($sem)){
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPersonCurrentlyEmployed; ?></b></font></td>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_r.gif','0') ?>></td>
  </tr>
</table>
<?php
	}
	else{
?>
	&nbsp;&nbsp;<font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPersonCurrentlyEmployed; ?></b></font>
<?php
	}
}
?>

<FONT    SIZE=-1  FACE="Arial">

<table border=0>
  <tr>
    <td>&nbsp;
  </td>

  <td>
	
	<table border=0 cellpadding=0 cellspacing=0 bgcolor="#999999">
   <tr>
     <td>

<table border="0" cellspacing=1 cellpadding=0>
<tr bgcolor="white" >
<td valign="top" background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDPersonellNr ?>:
</td>
<td bgcolor="#eeeeee">
<FONT SIZE=-1  FACE="Arial" ><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;<b><?php echo $full_pnr; ?></b><br>
<?php #
if(file_exists($root_path.'cache/barcodes/en_'.$full_pnr.'.png')) echo '<img src="'.$root_path.'cache/barcodes/en_'.$full_pnr.'.png" border=0 width=145 height=35>';
  else 
  {

    echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_pnr."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";

    echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_pnr."&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
  }
?>
</td>
<td rowspan=7 align="center"><img <?php echo $img_source; ?> hspace=5 width=137>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDTitle ?>:
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $title ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDLastName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;<b><?php echo $name_last; ?></b>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;<b><?php echo $name_first; ?></b>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDBday ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php echo formatDate2Local($date_birth,$date_format);?></b>
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDSex ?>: <?php if($sex=='m') echo $LDMale; elseif($sex=='f') echo $LDFemale; ?>
</td>
</tr>


<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDAddress ?>:
</td>
<td bgcolor="#eeeeee" colspan=2><FONT SIZE=-1  FACE="Arial">
<?php 

/* Note: The address is displayed in german format. */
echo $personell_obj->formattedAddress_DE();
/*echo $addr_str.' '.$addr_str_nr.'<br>';
echo $addr_zip.' '.$addr_citytown_name.'<br>';
*/
/*
if ($addr_province) echo $addr_province.'<br>';
if ($addr_region) echo $addr_region.'<br>';
if ($addr_country) echo $addr_country.'<br>';
*/
?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDShortID ?>:
</td>
<td colspan=2   bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php echo  $short_id; ?>
</td>
</tr>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDJobFunction ?>:
</td>
<td colspan=2   bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php echo  $job_function_title; 
?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDDateJoin ?>: 
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php  if($date_join!='0000-00-00')   echo formatDate2Local($date_join,$date_format); ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDDateExit ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php   if($date_exit!='0000-00-00') echo formatDate2Local($date_exit,$date_format,1,1); ?></td>
</tr>


<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDContractClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php	echo $contract_class; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDContractStart ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php  if($contract_start!='0000-00-00') echo formatDate2Local($contract_start,$date_format,1,1); ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDContractEnd ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php  if($contract_end!='0000-00-00') echo formatDate2Local($contract_end,$date_format,1,1); ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDPayClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $pay_class; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDPaySubClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $pay_class_sub; ?>
</td>
</tr>


<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDLocalPremiumID ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $local_premium_id; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDTaxAccountNr ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $tax_account_nr; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDInternalRevenueCode ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $id_code; ?>
</td>
</tr>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDNrWorkDay ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if($nr_workday) echo $nr_workday; ?>
</td>
</tr>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDNrWeekHour ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if($nr_weekhour>0) echo $nr_weekhour; ?>
</td>
</tr>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDNrVacationDay ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if($nr_vacation_day) echo $nr_vacation_day; ?>
</td>
</tr>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDMultipleEmployer ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if($multiple_employer) echo $multiple_employer; ?>
</td>
</tr>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDNrDependent ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if($nr_dependent) echo $nr_dependent; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDRecordedBy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if ($create_id) echo $create_id ;  ?> 
</td>
</tr>
</table>
	 
	 </td>
   </tr>
 </table>

	</td>
    <td valign="top">
<?php include('./gui_bridge/default/gui_options_personell_register_show.php'); ?>
</td>
  </tr>
</table>
<p>
&nbsp;
<a href="<?php echo $updatefile.URL_APPEND.'&personell_nr='.$personell_nr.'&update=1'; ?>"><img <?php echo createLDImgSrc($root_path,'update_data.gif','0','top') ?>></a>
<!-- <a href="javascript:makeBarcodeLabel('<?php echo $encounter_nr  ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_label.gif','0','top') ?>></a>
<a href="javascript:makeWristBands('<?php echo $encounter_nr ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_wristband.gif','0','top') ?>></a>
 -->
<p>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<FONT    SIZE=2  FACE="Arial">
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_start.php<?php echo URL_APPEND; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_daten_such.php<?php echo URL_APPEND; ?>"><?php echo $LDAdmWantSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_list.php<?php echo URL_APPEND; ?>&newdata=1"><?php echo $LDAdmWantArchive ?></a><br>
<p>
 -->&nbsp;
<?php

echo '
		<a href="personell_admin_pass.php'.URL_APPEND.'&target=person_reg">';
?>
<img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
StdFooter();
?>
