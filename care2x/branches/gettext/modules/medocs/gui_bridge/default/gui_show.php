<?php
$returnfile=$_SESSION['sess_file_return'];

require('./gui_bridge/default/gui_std_tags.php');

$_SESSION['sess_file_return']=$thisfile;


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

?>
 <TITLE><?php echo $title ?></TITLE>

<script  language="javascript">
<!--

<?php require($root_path.'include/helpers/inc_checkdate_lang.php'); ?>
function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

-->
</script>
<?php 
if($parent_admit) include($root_path.'include/imgcreator/inc_js_barcode_wristband_popwin.php');

require($root_path.'include/helpers/include_header_css_js.php');
?>
</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();" 
>


<table width=100% border=0 cellspacing="0"  cellpadding=0 >

<tr>
<td >
<FONT    SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $page_title ?></STRONG> 
<font size=+2>(
<?php 
if($parent_admit) echo ($_SESSION['sess_full_en']);
else echo ($_SESSION['sess_full_pid']);
?>)</font></FONT>
</td>

<td  align="right">
<a href="<?php echo $returnfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=show&type_nr='.$type_nr; ?>" class="button icon arrowleft">Back</a>
<a href="javascript:gethelp('admission_how2new.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  </a>
<a href="<?php if($_COOKIE["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang;
	else echo $breakfile."?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   </a>
</td>
</tr>

<?php
/* Create the tabs */
if($parent_admit) {
	$tab_bot_line='#66ee66';
	require('./gui_bridge/default/gui_tabs_medocs.php');

}else{
	$tab_bot_line='#66ee66';
	require('./gui_bridge/default/gui_tabs_medocs.php');
}
?>
<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<FONT    SIZE=-1  FACE="Arial">

<table border=0 cellspacing=1 cellpadding=0 width=100%>

<tr bgcolor="#ffffff">
<td colspan=3 valign="top">

<table border=0 width=100% cellspacing=1>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php 
if($parent_admit) echo $LDAdmitNr;
else echo $LDRegistrationNr;
?>
</td>
<td width="30%"  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 
if($parent_admit) echo ($_SESSION['sess_full_en']) ;
else echo ($_SESSION['sess_full_pid'])
?>
</td>

<td valign="top" rowspan=8 align="center" bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><img <?php echo $img_source; ?> width=137>
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
</td>
</tr>

<?php

if (!$GLOBAL_CONFIG['person_name_2_hide'])
{
	createTR($LDName2,$name_2);
}

if (!$GLOBAL_CONFIG['person_name_3_hide'])
{
	createTR( $LDName3,$name_3);
}

if (!$GLOBAL_CONFIG['person_name_middle_hide'])
{
	createTR($LDNameMid,$name_middle);
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide'])
{
	createTR($LDNameMaiden,$name_maiden);
}

if (!$GLOBAL_CONFIG['person_name_others_hide'])
{
	createTR($LDNameOthers,$name_others);
}
?>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td  bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"  color="#990000">
<b><?php       echo @formatDate2Local($date_birth,$date_format);  ?></b>
</td>

</tr>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><?php  echo $LDSex ?>: 
</td>
<td bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><?php if($sex=="m") echo  $LDMale; elseif($sex=="f") echo $LDFemale ?>
</td>
</tr>
</table>


</td>
<!-- Load the options table  -->
<td rowspan=2  valign="top">
&nbsp;
</td>
</tr>

<tr>
<td bgColor="#eeeeee" colspan=3 valign="top">

<?php
if($mode=='show'){

	if($rows){

		include('./gui_bridge/default/gui_'.$thisfile);

	}else{
?>
<table border=0>
  <tr>
    <td></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b>
	<?php 
	echo $norecordyet;
	?></b></font></td>
  </tr>
</table>
<?php
	}
}else {
	@ include('./gui_bridge/default/gui_input_'.$thisfile);
}
?>
</td>
</tr>

</table>
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
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_archive.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>

<p>
<a href="
<?php if($_COOKIE['ck_login_logged'.$sid]) echo 'startframe.php'.URL_APPEND;
else echo $breakfile.URL_APPEND;
?>
" class="button icon remove danger">Cancel</a>
</ul>
</FONT>
<?php
StdFooter();
?>