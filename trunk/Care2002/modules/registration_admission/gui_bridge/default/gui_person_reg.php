<?php

require('./gui_bridge/default/gui_std_tags.php');

$error_fontcolor='red';

function createTR($error_handler, $input_name, $ld_text, $input_val, $colspan = 1, $input_size = 35)
{
   global $error_fontcolor, $toggle;

?>

<tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($error_handler) echo '<font color="'.$error_fontcolor.'">'; ?><?php echo $ld_text ?>:
</td>
<td colspan=<?php echo $colspan; ?>><input name="<?php echo $input_name; ?>" type="text" size="<?php echo $input_size; ?>" value="<?php echo $input_val; ?>" >
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
	if(document.images) document.images.catcom.src="../../gui/img/common/default/pixel.gif";
}

function loadcat()
{

  	cat=new Image();
  	cat.src="../imgcreator/catcom.php?person=<?php echo strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+")."&lang=$lang";?>";
  	
}

function showcat()
{

	document.images.catcom.src=cat.src;
}

function forceSave()
{
   document.aufnahmeform.mode.value="forcesave";
   document.aufnahmeform.submit();
}

function showpic(d)
{
	if(d.value) document.images.headpic.src=d.value;
}

function popSearchWin(target,obj_val,obj_name) {
	urlholder="./data_search.php<?php echo URL_REDIRECT_APPEND; ?>&target="+target+"&obj_val="+obj_val+"&obj_name="+obj_name;
	DSWIN<?php echo $sid ?>=window.open(urlholder,"wblabel<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}


<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister ?></STRONG></FONT>
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

<!--  <div class="cats">
<a href="javascript:hidecat()"><img
<?php if($from=='pass')
{ 
    echo 'src="'.$root_path.'main/imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" ';
 }
else 
{
	echo ' src="'.$root_path.'gui/img/common/default/pixel.gif" ';
}
?>
align=right id=catcom border=0></a>
</div>  -->

<ul>

<FONT    SIZE=-1  FACE="Arial">

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform" ENCTYPE="multipart/form-data">

<table border=0 cellspacing=0 cellpadding=0>

<?php if($error) : ?>
<tr bgcolor=#ffffee>
<td colspan=3><center>
<font face=arial color=#7700ff size=4>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle">
	<?php if ($error>1) echo $LDErrorS; else echo $LDError; ?>
</center>
</td>
</tr>
<?php endif; ?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if($pid) echo $LDRegistryNr ?> 
</td>
<td ><FONT SIZE=-1  FACE="Arial" color="#800000"><?php if($pid) echo $pid+$person_id_nr_adder ?>&nbsp;
</td>
<td  rowspan=6 ><FONT SIZE=-1  FACE="Arial">
<a href="#"  onClick="showpic(document.aufnahmeform.photo_filename)"><img <?php echo $img_source; ?> width=137  id="headpic" name="headpic"></a>
<br>
<?php echo $LDPhoto ?><br><input name="photo_filename" type="file" size="15"   onChange="showpic(this)" value="<?php if(isset($photo_filename)) echo $photo_filename ?>">

</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDRegDate ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php     echo formatDate2Local($date_reg,$date_format); ?>
<input name="date_reg" type="hidden" value="<?php echo $date_reg ?>">
</td>

</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDRegTime ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo convertTimeToLocal(formatDate2Local($date_reg,$date_format,0,1)); ?>
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td >
<input type="text" name="title" size=14 maxlength=25 value="<?php echo $title ?>" onFocus="this.select();">
</td>
</tr>

<?php
createTR($errornamelast, 'name_last', $LDLastName,$name_last);
createTR($errornamefirst, 'name_first', $LDFirstName,$name_first);

if (!$person_name_2_hide)
{
createTR($errorname2, 'name_2', $LDName2,$name_2);
}

if (!$person_name_3_hide)
{
createTR($errorname3, 'name_3', $LDName3,$name_3);
}

if (!$person_name_middle_hide)
{
createTR($errornamemid, 'name_middle', $LDNameMid,$name_middle);
}

if (!$person_name_maiden_hide)
{
createTR($errornamemaiden, 'name_maiden', $LDNameMaiden,$name_maiden);
}

if (!$person_name_others_hide)
{
createTR($errornameothers, 'name_others', $LDNameOthers,$name_others);
}
?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errordatebirth) echo "<font color=red>"; ?><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<input name="date_birth" type="text" size="15" maxlength=10 value="<?php 
     if($date_birth)
     {
        if($error) echo $date_birth; 
	      else echo formatDate2Local($date_birth,$date_format);
     }
	
     /* Uncomment the following when the current date must be inserted
     *    automatically at the start of each document
     */
     
     /*else 
       {
	 echo formatDate2Local(date('Y-m-d'),$date_format);
       }*/
 ?>"
 onFocus="this.select();"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> 
 <a href="javascript:show_calendar('aufnahmeform.date_birth','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 <font size=1>[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ] </font>
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?php 
if ($errorsex) echo "<font color=red>";  
echo $LDSex;
 ?>: <input name="sex" type="radio" value="m"  <?php if($sex=="m") echo "checked"; ?>><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f"  <?php if($sex=="f") echo "checked"; ?>>
<?php 
echo $LDFemale;
if ($errorsex) echo "</font>";  
 ?>
 </td>
</tr>



<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorcivil) echo "<font color=red>"; ?><?php echo $LDCivilStatus ?>:
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="single"  <?php if($civil_status=="single") echo "checked"; ?>><?php echo $LDSingle ?>&nbsp;&nbsp;
<input name="civil_status" type="radio" value="married"  <?php if($civil_status=="married") echo "checked"; ?>><?php echo $LDMarried ?>
<FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="divorced"  <?php if($civil_status=="divorced") echo "checked"; ?>><?php echo $LDDivorced ?>&nbsp;&nbsp;
<input name="civil_status" type="radio" value="widowed"  <?php if($civil_status=="widowed") echo "checked"; ?>><?php echo $LDWidowed ?>
<FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="separated"  <?php if($civil_status=="separated") echo "checked"; ?>><?php echo $LDSeparated ?>&nbsp;&nbsp;
</td>
</tr>

 
<tr>
<td colspan=2><FONT SIZE=-1  FACE="Arial"><?php if ($erroraddress) echo "<font color=red>"; ?><?php echo $LDAddress ?>:
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorstreet) echo "<font color=red>"; ?><?php echo $LDStreet ?>:
</td>
<td><input name="addr_str" type="text" size="35" value="<?php echo $addr_str; ?>" >
</td>
<td>&nbsp;&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if ($errorstreetnr) echo "<font color=red>"; ?><?php echo $LDStreetNr ?>:<input name="addr_str_nr" type="text" size="10" value="<?php echo $addr_str_nr; ?>" >
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errortown) echo "<font color=red>"; ?><?php echo $LDTownCity ?>:
</td>
<td><input name="addr_citytown_name" type="text" size="35" value="<?php echo $addr_citytown_name; ?>" ><a href="javascript:popSearchWin('citytown','aufnahmeform.addr_citytown_nr','aufnahmeform.addr_citytown_name')"><img <?php echo createComIcon($root_path,'b-write_addr.gif','0') ?>></a>
</td>
<td>&nbsp;&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if ($errorzip) echo "<font color=red>"; ?><?php echo $LDZipCode ?>:<input name="addr_zip" type="text" size="10" value="<?php echo $addr_zip; ?>" >

</td>
</tr>

<?php
if($insurance_show) {
    if (!$person_insurance_1_nr_hide) {
        createTR($errorinsurancenr, 'insurance_nr', $LDInsuranceNr.' 1',$insurance_nr,2);
?>
<tr>
<td>&nbsp;
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial"><?php if ($errorinsuranceclass) echo '<font color="'.$error_fontcolor.'">'; ?>
<?php
if($insurance_classes!=false){
    while($result=$insurance_classes->FetchRow()) {
?>
<input name="insurance_class_nr" type="radio"  value="<?php echo $result['class_nr']; ?>"  <?php if($insurance_class_nr==$result['class_nr']) echo 'checked'; ?>>
<?php 
        $LD=$result['LD_var'];
        if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        echo '&nbsp;';
	}
} else echo "no insurance class";
?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorinsurancecoid) echo '<font color="'.$error_fontcolor.'">'; ?><?php echo $LDInsuranceCo ?>:
</td>
<td colspan=2><input name="insurance_firm_name" type="text" size="35" value="<?php echo $insurance_firm_name; ?>" ><a href="javascript:popSearchWin('insurance','aufnahmeform.insurance_firm_id','aufnahmeform.insurance_firm_name')"><img <?php echo createComIcon($root_path,'b-write_addr.gif','0') ?>></a>
</td>
</tr>
<?php
    }
} else {
?>

  <tr>
    <td colspan=2><a><?php echo $LDSeveralInsurances; ?><img <?php echo createComIcon($root_path,'frage.gif','0') ?>></a></td>
  </tr>
   
<?php
}

if (!$person_phone_1_nr_hide)
{
createTR($errorphone1, 'phone_1_nr', $LDPhone.' 1',$phone_1_nr,2);
}

if (!$person_phone_2_nr_hide)
{
createTR($errorphone2, 'phone_2_nr', $LDPhone.' 2',$phone_2_nr,2);
}

if (!$person_cellphone_1_nr_hide)
{
createTR($errorcell1, 'cellphone_1_nr', $LDCellPhone.' 1',$cellphone_1_nr,2);
}

if (!$person_cellphone_2_nr_hide)
{
createTR($errorcell2, 'cellphone_2_nr', $LDCellPhone.' 2',$cellphone_2_nr,2);
}

if (!$person_fax_hide)
{
createTR($errorfax, 'fax', $LDFax,$fax,2);
}

if (!$person_email_hide)
{
createTR($erroremail, 'email', $LDEmail,$email,2);
}

if (!$person_citizenship_hide)
{
createTR($errorcitizen, 'citizenship', $LDCitizenship,$citizenship,2);
}

if (!$person_sss_nr_hide)
{
createTR($errorsss, 'sss_nr', $LDSSSNr,$sss_nr,2);
}

if (!$person_nat_id_nr_hide)
{
createTR($errornatid, 'nat_id_nr', $LDNatIdNr,$nat_id_nr,2);
}

if (!$person_religion_hide)
{
createTR($errorreligion, 'religion', $LDReligion,$religion,2);
}

if (!$person_ethnic_orig_hide)
{
createTR($errorethnicorig, 'ethnic_orig', $LDEthnicOrigin,$ethnic_orig,2);
}


?>
<tr>
<td ><FONT SIZE=-1  FACE="Arial" ><FONT  SIZE=2  FACE="Arial"><?php echo $LDRegBy ?>
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial"><nobr>
<input  name="user_id" type="text" value=<?php if ($user_id!='') echo '"'.$user_id.'"' ; else echo '"'.$HTTP_COOKIE_VARS[$local_user.$sid].'"' ?> size="35" >
</nobr></td>
</tr>


</table>
<p>
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="hidden" name="itemname" value="<?php echo $itemname; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="linecount" value="<?php echo $linecount; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="addr_citytown_nr" value="<?php echo $addr_citytown_nr; ?>">
<input type="hidden" name="insurance_item_nr" value="<?php echo $insurance_item_nr; ?>">
<input type="hidden" name="insurance_firm_id" value="<?php echo $insurance_firm_id; ?>">
<input type="hidden" name="insurance_show" value="<?php echo $insurance_show; ?>">

<?php if($update)
{
    echo '<input type="hidden" name="update" value=1>'; 
	echo '<input type="hidden" name="pid" value="'.$pid.'">';
}
?>

<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>  alt="<?php echo $LDSaveData ?>" align="absmiddle"> 
<a href="javascript:document.aufnahmeform.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetData ?>"   align="absmiddle"></a>

<?php if($error==1) echo '<input  type="button" value="'.$LDForceSave.'" onClick="forceSave()">'; ?>

<?php if($update) 
	{ 
		echo '<input type="button" value="'.$LDCancel.'" onClick="location.replace(\'';
		if($from=="such") echo 'aufnahme_daten_such.php'.URL_APPEND.'&lang='.$lang;
			else echo 'aufnahme_list.php'.URL_APPEND.'&newdata=1&lang='.$lang;
		echo '\')"> '; 
	}
?>
</form>

<?php if (!$newdata) : ?>

<form action=<?php echo $thisfile; ?> method=post>
<input type=hidden name=sid value=<?php echo $sid; ?>>
<input type=hidden name=patnum value="">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="date_format" value="<?php echo $date_format; ?>">
<input type=submit value="<?php echo $LDNewForm ?>" >
</form>
<?php endif; ?>

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
<?php if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) echo 'startframe.php';
	else echo 'aufnahme_pass.php';
	echo URL_APPEND;
?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<hr>
<?php
echo StdCopyright();
?>
</FONT>
<?php
echo StdFooter();
?>
