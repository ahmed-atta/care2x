<?php

require('./gui_bridge/default/gui_std_tags.php');

function createTR($input_name, $ld_text, $input_val, $colspan = 2, $input_size = 35)
{

?>

<tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $ld_text ?>:
</td>
<td colspan=<?php echo $colspan; ?>><input name="<?php echo $input_name; ?>" type="text" size="<?php echo $input_size; ?>" value="<?php if(isset($input_val)) echo $input_val; ?>">
</td>
</tr>

<?php
}

echo StdHeader();
echo setCharSet(); 
?>
 <TITLE><?php echo $LDPatientRegister ?></TITLE>


<script  language="javascript">
<!-- 

function popSearchWin(target,obj_val,obj_name) {
	urlholder="./data_search.php<?php echo URL_REDIRECT_APPEND; ?>&target="+target+"&obj_val="+obj_val+"&obj_name="+obj_name;
	DSWIN<?php echo $sid ?>=window.open(urlholder,"wblabel<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

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


<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister.' - '.$LDArchive ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2new.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
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

<ul>

<FONT    SIZE=-1  FACE="Arial">

<?php

 if(isset($mode)&&$mode=='search')
 {
   echo '<FONT  SIZE=2 FACE="verdana,Arial">'.$LDSearchKeyword.': '.$s2; 
?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php if($rows) echo str_replace("~nr~",$rows,$LDFoundData); else echo str_replace("~nr~",$rows,$LDSearchFound); ?></b></font></td>
  </tr>
</table>

<?php
}
?>

<?php if(isset($rows)&&$rows>1) 
{
 ?>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa background="<?php echo $root_path; ?>gui/img/common/default/tableHeaderbg.gif">
  <?php
for($j=0;$j<sizeof($LDElements);$j++)
		echo '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDElements[$j].'</b></td>';
	?>
  </tr>
 <?php 
 /* Load common icons*/
 $img_arrow=createComIcon($root_path,'r_arrowgrnsm.gif','0');
 
 $toggle=0;
 while($result=$ergebnis->FetchRow())
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  $buf='patient_register_show.php'.URL_APPEND.'&origin=archive&pid='.$result['pid'].'&target=archiv';
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.$img_arrow.'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name_last'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name_first'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.@formatDate2Local($result['date_birth'],$date_format).'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.($result['pid']+$GLOBAL_CONFIG['person_id_nr_adder']).'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.@formatDate2Local($result['date_reg'],$date_format).'</a></td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="../../gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>

<form method="post"  action="patient_register_archive.php" >
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="?">
<input type="submit" value="<?php echo $LDNewArchive ?>" >
                             </form>

<?php 
}
else
{
?>

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform">

<table border=0 cellspacing=0 cellpadding=0>

<?php
if(!isset($pid)) $pid='';
createTR('pid', $LDAdmitNr,$pid);
if(!isset($user_id)) $user_id='';
createTR( 'user_id', $LDRegBy,$user_id);
?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDRegDate ?>: 
</td>
<td ><FONT SIZE=-1  FACE="Arial">
<input name="date_start" type="text" size=10 maxlength=10    onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ]
</td>
<td><nobr><FONT SIZE=-1  FACE="Arial"><?php echo $LDTo ?>: <input name="date_end" type="text" size=10 maxlength=10   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ]
</nobr></td>
</tr>


<?php
if(!isset($name_last)) $name_last='';
if(!isset($name_first)) $name_first='';
createTR('name_last', $LDLastName,$name_last);
createTR( 'name_first', $LDFirstName,$name_first);

if (!$GLOBAL_CONFIG['person_name_2_hide'])
{
if(!isset($name_2)) $name_2='';
createTR('name_2', $LDName2,$name_2);
}

if (!$GLOBAL_CONFIG['person_name_3_hide'])
{
if(!isset($name_3)) $name_3='';
createTR('name_3', $LDName3,$name_3);
}

if (!$GLOBAL_CONFIG['person_name_middle_hide'])
{
if(!isset($name_middle)) $name_middle='';
createTR('name_middle', $LDNameMid,$name_middle);
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide'])
{
if(!isset($name_maiden)) $name_maiden='';
createTR('name_maiden', $LDNameMaiden,$name_maiden);
}

if (!$GLOBAL_CONFIG['person_name_others_hide'])
{
if(!isset($name_others)) $name_others='';
createTR('name_others', $LDNameOthers,$name_others);
}

if(!isset($date_birth)) $date_birth='';
if(!isset($addr_str)) $addr_str='';
if(!isset($addr_str_nr)) $addr_str_nr='';
if(!isset($addr_zip)) $addr_zip='';
if(!isset($addr_city_town)) $addr_city_town='';
?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<input name="date_birth" type="text" size="15" maxlength=10 value="<?php   echo $date_birth;  ?>"
 onFocus="this.select();"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> 
 [ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ]
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>: <input name="sex" type="radio" value="m"><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f"><?php echo $LDFemale ?>
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDCivilStatus ?>:
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="single"><?php echo $LDSingle ?>&nbsp;&nbsp;
<input name="civil_status" type="radio" value="married"><?php echo $LDMarried ?>
<FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="divorced"><?php echo $LDDivorced ?>&nbsp;&nbsp;
<input name="civil_status" type="radio" value="widowed"><?php echo $LDWidowed ?>
<FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="separated"><?php echo $LDSeparated ?>&nbsp;&nbsp;
</td>
</tr>
 
 <tr>
<td colspan=3><FONT SIZE=-1  FACE="Arial"><?php echo $LDAddress ?>:
</td>

</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDStreet ?>:
</td>
<td><input name="addr_str" type="text" size="35" value="<?php if(isset($addr_str)) echo $addr_str; ?>">
</td>
<td>&nbsp;&nbsp;&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if (isset($errorstreetnr)&&$errorstreetnr) echo "<font color=red>"; ?><?php echo $LDStreetNr ?>:<input name="addr_str_nr" type="text" size="10" value="<?php echo $addr_str_nr; ?>">
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTownCity ?>:
</td>
<td><input name="addr_citytown_name" type="text" size="35" value="<?php if(isset($addr_citytown_name)) echo $addr_citytown_name; ?>">
<a href="javascript:popSearchWin('citytown','aufnahmeform.addr_citytown_nr','aufnahmeform.addr_citytown_name')"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>></a>
</td>
<td>&nbsp;&nbsp;&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if (isset($errorzip)&&$errorzip) echo "<font color=red>"; ?><?php echo $LDZipCode ?>:<input name="addr_zip" type="text" size="10" value="<?php echo $addr_zip; ?>">
</td>
</tr>

<?php

if (!$GLOBAL_CONFIG['person_phone_1_nr_hide'])
{
if(!isset($phone_1_nr)) $phone_1_nr='';
createTR('phone_1_nr', $LDPhone.' 1',$phone_1_nr,2);
}

if (!$GLOBAL_CONFIG['person_phone_2_nr_hide'])
{
if(!isset($phone_2_nr)) $phone_2_nr='';
createTR('phone_2_nr', $LDPhone.' 2',$phone_2_nr,2);
}

if (!$GLOBAL_CONFIG['person_cellphone_1_nr_hide'])
{
if(!isset($cellphone_1_nr)) $cellphone_1_nr='';
createTR('cellphone_1_nr', $LDCellPhone.' 1',$cellphone_1_nr,2);
}

if (!$GLOBAL_CONFIG['person_cellphone_2_nr_hide'])
{
if(!isset($cellphone_2_nr)) $cellphone_2_nr='';
createTR('cellphone_2_nr', $LDCellPhone.' 2',$cellphone_2_nr,2);
}

if (!$GLOBAL_CONFIG['person_fax_hide'])
{
if(!isset($fax)) $fax='';
createTR('fax', $LDFax,$fax,2);
}

if (!$GLOBAL_CONFIG['person_email_hide'])
{
if(!isset($email)) $email='';
createTR('email', $LDEmail,$email,2);
}

if (!$GLOBAL_CONFIG['person_citizenship_hide'])
{
if(!isset($citizenship)) $citizenship='';
createTR('citizenship', $LDCitizenship,$citizenship,2);
}

if (!$GLOBAL_CONFIG['person_sss_nr_hide'])
{
if(!isset($sss_nr)) $sss_nr='';
createTR('sss_nr', $LDSSSNr,$sss_nr,2);
}

if (!$GLOBAL_CONFIG['person_nat_id_nr_hide'])
{
if(!isset($nat_id_nr)) $nat_id_nr='';
createTR('nat_id_nr', $LDNatIdNr,$nat_id_nr,2);
}

if (!$GLOBAL_CONFIG['person_religion_hide'])
{
if(!isset($religion)) $religion='';
createTR('religion', $LDReligion,$religion,2);
}

if (!$GLOBAL_CONFIG['person_ethnic_orig_hide'])
{
if(!isset($ethnic_orig)) $ethnic_orig='';
createTR('ethnic_orig', $LDEthnicOrigin,$ethnic_orig,2);
}
?>

</table>
<p>
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="addr_citytown_nr">

<input  type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0') ?> alt="<?php echo $LDSaveData ?>" align="absmiddle"> 

</form>

<?php
}
?>






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
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDPatientRegister ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>

 --><p>
<a href="<?php	echo 'patient.php'.URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
StdFooter();
?>
