<?php

//debug
/*while(list($a,$b)=each($HTTP_POST_VARS))
{
echo $a."##".$b."@@<br>";
}*/

require('./gui_bridge/default/gui_std_tags.php');

$error_fontcolor='red';

function createTR($error_handler, $input_name, $ld_text, $input_val, $colspan = 1, $input_size = 35,$red=FALSE)
{
   global $error_fontcolor, $toggle;

?>

<tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($error_handler||$red) echo '<font color="'.$error_fontcolor.'">'; ?><?php echo $ld_text ?>:
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
function parti()
{
document.getElementById('livello').style.visibility='hidden';
document.aufnahmeform.pri.checked=true;
}
function forceSave(){
   document.aufnahmeform.mode.value="forcesave";
   document.aufnahmeform.submit();
}

function showpic(d){
	if(d.value) document.images.headpic.src=d.value;
}

function popSearchWin(target,obj_val,obj_name){
	urlholder="./data_search.php<?php echo URL_REDIRECT_APPEND; ?>&target="+target+"&obj_val="+obj_val+"&obj_name="+obj_name;
	DSWIN<?php echo $sid ?>=window.open(urlholder,"wblabel<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

function controllo_atl(){
if(document.aufnahmeform.atl.checked)
document.aufnahmeform.atl.checked=false;
}

function controllo_pri(){
if(document.aufnahmeform.pri.checked)
document.aufnahmeform.pri.checked=false;
}

function chkform(d) {

	 if(d.name_last.value==""){
		alert("<?php echo $LDPlsEnterLastName; ?>");
		d.name_last.focus();
		return false;
	}else if(d.name_first.value==""){
		alert("<?php echo $LDPlsEnterFirstName; ?>");
		d.name_first.focus();
		return false;
	}else if(d.date_birth.value==""){
		alert("<?php echo $LDPlsEnterDateBirth; ?>");
		d.date_birth.focus();
		return false;
	}else if(d.sex[0]&&d.sex[1]&&!d.sex[0].checked&&!d.sex[1].checked){
		alert("<?php echo $LDPlsSelectSex; ?>");
		return false;
	}else if(d.addr_str.value==""){
		alert("<?php echo $LDPlsEnterStreetName; ?>");
		d.addr_str.focus();
		return false;
	}else if(d.cellphone_1_nr.value==""){
		alert('Mobile necessario (se non disponibile mettere -)');
		d.cellphone_1_nr.focus();
		return false;
	}else if(d.addr_str_nr.value==""){
		alert("<?php echo $LDPlsEnterBldgNr; ?>");
		d.addr_str_nr.focus();
		return false;
	}else if(d.addr_zip.value==""){
		alert("<?php echo $LDPlsEnterZip; ?>");
		d.addr_zip.focus();
		return false;
	}else if(d.user_id.value==""){
		alert("<?php echo $LDPlsEnterFullName; ?>");
		d.user_id.focus();
		return false;
	}else if(d.citizenship.value==""){
		alert("Indicare la provincia di residenza");
		d.user_id.focus();
		return false;
	}else if(d.sss_nr.value==""){
		alert("Indicare la localita' di residenza");
		d.sss_nr.focus();
		return false;
	}
	else{
		return true;
	}
}

function controlla_campi_atl(){
//window.alert(document.aufnahmeform.name_maiden.value);
if(document.aufnahmeform.atl.checked==true && document.aufnahmeform.name_maiden.value==''){
		alert('Bisogna inserire uno Sport');
		document.aufnahmeform.name_maiden.focus();
		return false;
	}/*else if(document.aufnahmeform.atl.checked==true && document.aufnahmeform.name_3.value==''){
		alert('Specialit&agrave/Ruolo/Categoria');
		document.aufnahmeform.name_3.focus();
		return false;
	}*/else if(document.aufnahmeform.atl.checked==true && document.aufnahmeform.nat_id_nr.value==''){
		alert('Bisogna inserire una Societ&agrave Sportiva');
		document.aufnahmeform.nat_id_nr.focus();
		return false;
	} else if(document.aufnahmeform.atl.checked==true && document.aufnahmeform.religion.value==''){
		alert('Bisogna inserire la Federazione');
		document.aufnahmeform.religion.focus();
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
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY onLoad="javascript:parti()" bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2new.php','<?php echo $error; ?>','<?php echo $error_person_exists; ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
echo $breakfile;  ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
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

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform" ENCTYPE="multipart/form-data" onSubmit="return (chkform(this) && controlla_campi_atl())" >

<table border=0 cellspacing=0 cellpadding=0>

<?php if($error) { ?>
<tr bgcolor=#ffffee>
<td colspan=3><center>
<font face=arial color=#7700ff size=4>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle">
	<?php if ($error>1) echo $LDErrorS; else echo $LDError; ?>
</center>
</td>
</tr>
<?php 
}elseif($error_person_exists){
 ?>
<tr bgcolor=#ffffee>
<td colspan=3><center>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><font face=arial color=#7700ff size=4>
	<?php 
		echo $LDPersonDuplicate;
		if($duperson->RecordCount()>1) echo " $LDSimilarData2 $LDPlsCheckFirst2";
			else echo " $LDSimilarData $LDPlsCheckFirst";
	?></td>
  </tr>
</table>
</center>
</td>
</tr>
<tr>
<td colspan=3>
<table border=0 cellspacing=0 cellpadding=1 bgcolor="#000000" width=100%>
  <tr>
    <td>
	<table border=0 cellspacing=0 width=100% bgcolor="#ffffff">
		<?php
		$img_male=createComIcon($root_path,'spm.gif','0');
		$img_female=createComIcon($root_path,'spf.gif','0');
		$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeader_gr.gif"';
		echo'		
		 <tr bgcolor="#66ee66" background="'.$root_path.'gui/img/common/default/tableHeaderbg.gif">';
		echo "
      	<td $tbg><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
    	$LDRegistryNr</b></td>
      <td $tbg><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
	  $LDLastName</b></td>
      <td $tbg><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
	  $LDFirstName</b></td>
      <td $tbg><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
	  $LDBday</b></td>
      <td $tbg><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
	  $LDSex</b></td>
      <td $tbg><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
	  $LDOptions</b></td>
		</tr>";
		
		while($dup=$duperson->FetchRow()){
			echo '<tr>
     		<td><font face=arial color=#000000 size=2>'.$dup['pid'].'</td>
			<td><font face=arial color=#000000 size=2>'.$dup['name_last'].'</td>
			<td><font face=arial color=#000000 size=2>'.$dup['name_first'].'</td>
			<td><font face=arial color=#000000 size=2>'.formatDate2Local($dup['date_birth'],$date_format).'</td>
			<td>';
			switch($dup['sex']){
				case 'f': echo '<img '.$img_female.'>'; break;
				case 'm': echo '<img '.$img_male.'>'; break;
				default: echo '&nbsp;'; break;
			}
        	echo '</td>	
			<td><font face=arial color=#000000 size=2>:: <a href="person_reg_showdetail.php'.URL_APPEND.'&pid='.$dup['pid'].'&from=$from&newdata=1&target=entry" target="_blank">'.$LDShowDetails.'</a> :: 
			<a href="patient_register.php'.URL_APPEND.'&pid='.$dup['pid'].'&update=1">'.$LDUpdate.'</a>
			</td>
   			</tr>
			';
		}
		?>
 </table>
 
	</td>
  </tr>
</table>

<?php 
}
 ?>
 <br>
 </td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if($pid) echo $LDRegistryNr ?> 
</td>
<td ><FONT SIZE=-1  FACE="Arial" color="#800000"><?php if($pid) echo $pid+$person_id_nr_adder ?>&nbsp;
</td>
<td  rowspan=6 ><FONT SIZE=-1  FACE="Arial">
<a href="#"  onClick="showpic(document.aufnahmeform.photo_filename)"><img <?php echo $img_source; ?> id="headpic" name="headpic"></a>
<br>
<?php echo $LDPhoto ?><br><input name="photo_filename" type="file" size="15"   onChange="showpic(this)" value="<?php if(isset($photo_filename)) echo $photo_filename ?>">

</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><font color=#ff0000><?php echo $LDRegDate ?></font>:
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
<!-- AGGIUNTO DA NOI PER METTERE SE SIA UN ATLETA O UN PRIVATO, NEL PRIMO CASO COMPAIONO I CAMPI NECESSARI PER L'ATLETA -->
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo "<font size='3' color='red'><b>Atleta</b></font>"; ?>
<input type="radio" name="atl" value="atleta" onclick="document.getElementById('livello').style.visibility='visible'; javascript:controllo_pri()"  ></td>
<td><FONT SIZE=-1  FACE="Arial" ><?php echo "<font size='3' ><b>Privato</b></font>"; ?>
<input type="radio" name="pri" value="privato" onclick="document.getElementById('livello').style.visibility='hidden'; javascript:controllo_atl()"  >
</td>
</tr>
<!-- TERMINE AGGIUNTA -->
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td >
<input type="text" name="title" size=14 maxlength=25 value="<?php echo $title ?>" onFocus="this.select();">
</td>
</tr>

<?php
createTR($errornamelast, 'name_last', "* ".$LDLastName,$name_last,'','',TRUE);
createTR($errornamefirst, 'name_first', "* ".$LDFirstName,$name_first,'','',TRUE);

if (!$person_name_2_hide)
{
createTR($errorname2, 'name_2', $LDName2,$name_2);
}

?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errordatebirth) echo "<font color=red>"; ?><font color=#ff0000>* <?php echo $LDBday ?></font>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<input name="date_birth" type="text" size="15" maxlength=10 value="<?php 
     if($date_birth)
     {
        if($mode=='save'||$error||$error_person_exists) echo $date_birth; 
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
<!-- 
<a href="javascript:show_calendar('aufnahmeform.date_birth','<?php echo $date_format ?>')">
 <img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
-->
 <font size=1>[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ] </font>
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?php 
if ($errorsex) echo "<font color=#ff0000>";  
echo '<font color=#ff0000>* '.$LDSex.'</font>';
 ?>: <input name="sex" type="radio" value="m"  <?php if($sex=="m") echo "checked"; ?>><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f"  <?php if($sex=="f") echo "checked"; ?>>
<?php 
echo $LDFemale;
if ($errorsex) echo "</font>";  
 ?>
 </td>
</tr>
 <!-- COMMENTATO DA NOI!!!!!!!!
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBloodGroup ?>:
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial">
 <input name="blood_group" type="radio" value="A"  <?php if($blood_group=='A') echo 'checked'; ?>><?php echo $LDA ?>&nbsp;&nbsp;
<input name="blood_group" type="radio" value="B"  <?php if($blood_group=='B') echo 'checked'; ?>><?php echo $LDB ?>&nbsp;&nbsp;
<input name="blood_group" type="radio" value="AB"  <?php if($blood_group=='AB') echo 'checked'; ?>><?php echo $LDAB ?>&nbsp;&nbsp;
<input name="blood_group" type="radio" value="O"  <?php if($blood_group=='O') echo 'checked'; ?>><?php echo $LDO ?>
</td>
</tr>


<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorcivil) echo "<font color=red>"; ?> <?php echo $LDCivilStatus ?></font>:
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="single"  <?php if($civil_status=="single") echo "checked"; ?>><?php echo $LDSingle ?>&nbsp;&nbsp;
<input name="civil_status" type="radio" value="married"  <?php if($civil_status=="married") echo "checked"; ?>><?php echo $LDMarried ?>
<FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="divorced"  <?php if($civil_status=="divorced") echo "checked"; ?>><?php echo $LDDivorced ?>&nbsp;&nbsp;
<input name="civil_status" type="radio" value="widowed"  <?php if($civil_status=="widowed") echo "checked"; ?>><?php echo $LDWidowed ?>
<FONT SIZE=-1  FACE="Arial"> <input name="civil_status" type="radio" value="separated"  <?php if($civil_status=="separated") echo "checked"; ?>><?php echo $LDSeparated ?>&nbsp;&nbsp;
</td>
</tr>
-->
 <?php
 if (!$person_name_middle_hide)
{
?><tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($errornameid||$red) echo '<font color="'.$error_fontcolor.'">'; ?><font color=#ff0000>* <?php echo "Localita' di Nascita" ?>:</font>
</td>
<td colspan=2><input name="<?php echo 'name_middle'; ?>" type="text" size="35" value="<?php echo $name_middle; ?>" >
</td>
</tr>
<?php
}
?>
<tr>
<td colspan=2><FONT SIZE=-1  FACE="Arial"><?php if ($erroraddress) echo "<font color=red>"; ?><?php echo $LDAddress ?></font>:
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorstreet) echo "<font color=red>"; ?><font color=#ff0000>* <?php echo $LDStreet ?></font>:
</td>
<td><input name="addr_str" type="text" size="35" value="<?php echo $addr_str; ?>" >
</td>
<td>&nbsp;&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if ($errorstreetnr) echo "<font color=red>"; ?><font color=#ff0000>* <?php echo $LDStreetNr ?></font>:<input name="addr_str_nr" type="text" size="10" value="<?php echo $addr_str_nr; ?>" >
</td>
</tr>

<?
if (!$person_sss_nr_hide)
{
//createTR($errorsss, 'sss_nr', $LDSSSNr,$sss_nr,2);
?>
<tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($errorsss||$red) echo '<font color="red">'; ?><font color=#ff0000>* <?php echo $LDSSSNr ?>:</font>
</td>
<td colspan=1><input name="<?php echo "sss_nr" ?>" type="text" size="35" value="<?php echo $sss_nr ?>" >
</td>

<td>&nbsp;   <FONT SIZE=-1  FACE="Arial"><?php if ($errorzip) echo "<font color=red>"; ?><font color=#ff0000>* <?php echo $LDZipCode ?>:<input name="addr_zip" type="text" size="10" value="<?php echo $addr_zip; ?>" >
</td>
</tr>
<?php
}


?>
<!--<tr>

<td><FONT SIZE=-1  FACE="Arial"><?php if ($errortown) echo "<font color=red>"; ?>
<font color=#ff0000>* <?php echo "Localita' di Nascita" ?>:</font></td>
<td><input name="localita_nascita" type="text" size="35" value="<?php echo $addr_citytown_name; ?>" ><!--<a href="javascript:popSearchWin('citytown','aufnahmeform.addr_citytown_nr','aufnahmeform.addr_citytown_name')"><img <?php echo createComIcon($root_path,'b-write_addr.gif','0') ?>></a>
</td>-->

<!--
<?php
//PROVA PROVA
if (!$person_citizenship_hide)
{
createTR($errorcitizen, 'citizenship', $LDCitizenship,$citizenship,2);
}
?>
-->

<tr>
	<td>
	<FONT SIZE=-1  FACE="Arial,verdana,sans serif">	
	<?php if ($errorcitizen||$red) echo '<font color="'.$error_fontcolor.'">'; ?>
	<font color="red">* 
	<?php echo "Prov." ?>:</font>
	</td>
	<td colspan=2><input name="citizenship" type="text" size="2" maxlength="2" value="<?php echo $citizenship ; ?>" ><?php echo "<font size='-1'>INSERIRE LA SIGLA AUTOMOBILISTICA</font>";	?>
	</td>
</tr>



<?php

if($insurance_show) {
    if (!$person_insurance_1_nr_hide) {
      //  createTR($errorinsurancenr, 'insurance_nr', $LDInsuranceNr.' ',$insurance_nr,2);

?>
<tr>
<td>&nbsp;
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial"><?php if ($errorinsuranceclass) echo '<font color="'.$error_fontcolor.'">'; ?>
<?php
       
	/* if($insurance_classes!=false){
    while($result=$insurance_classes->FetchRow()) {
	*/	
?>
<!-- COMMENTATO DA NOI!!!!!!!
 <input name="insurance_class_nr" type="radio"  value="<?php echo $result['class_nr']; ?>"  <?php/* if($insurance_class_nr==$result['class_nr']) echo 'checked'; */?>>
-->
   <?php /*
          $LD=$result['LD_var'];
        if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        echo '&nbsp;';
	}
} else echo "no insurance class";
	 */
?>
   
</td>

</tr>

<tr>
<!-- COMMENTATO DA NOI!!!!!!!!!!!!!!!!!!!
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorinsurancecoid) echo '<font color="'.$error_fontcolor.'">'; ?><?php echo $LDInsuranceCo ?>:
</td>

<td colspan=2><input name="insurance_firm_name" type="text" size="35" value="<?php echo $insurance_firm_name; ?>" ><a href="javascript:popSearchWin('insurance','aufnahmeform.insurance_firm_id','aufnahmeform.insurance_firm_name')"><img <?php echo createComIcon($root_path,'b-write_addr.gif','0') ?>></a>
</td>
-->
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
createTR($errorphone1, 'phone_1_nr', $LDPhone.' ',$phone_1_nr,2);
}

if (!$person_phone_2_nr_hide)
{
createTR($errorphone2, 'phone_2_nr', $LDPhone.' 2',$phone_2_nr,2);
}

if (!$person_cellphone_1_nr_hide)
{
#createTR($errorcell1, 'cellphone_1_nr', $LDCellPhone.' ',$cellphone_1_nr,2);
?>





<tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($errorcell1||$red) echo '<font color="'.$error_fontcolor.'">'; ?><font color="red">* <?php echo "Mobile" ?>:</font>
</td>
<td colspan=2><input name="<?php echo 'cellphone_1_nr'; ?>" type="text" size="35" value="<?php echo $cellphone_1_nr; ?>" >
</td>
</tr>
<?php
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

/*
if (!$person_citizenship_hide)
{
createTR($errorcitizen, 'citizenship', $LDCitizenship,$citizenship,2);
}
*/

?>
<tr>
<td ><FONT SIZE=-1  FACE="Arial" ><FONT  SIZE=2  FACE="Arial"><font color=#ff0000><?php echo $LDRegBy ?></font>
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial"><nobr>
<input  name="user_id" type="text" value=<?php if ($user_id!='') echo '"'.$user_id.'"' ; else echo '"'.$HTTP_COOKIE_VARS[$local_user.$sid].'"' ?> size="35" readonly>
</nobr></td>
</tr>


</table>
<!-- COSA AGGIUNTA DA NOI PER RENDERE OBBLIGATORI I CAMPI PER L'ATLETA -->
<div ID="livello">
	<table>
				<?php
					if (!$person_name_maiden_hide)
{?>   
<tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($errornamemaiden||$red) echo '<font color="'.$error_fontcolor.'">'; ?><font color="blue">* <?php echo "Sport" ?>:</font>
</td>
<td colspan=2><input name="<?php echo 'name_maiden'; ?>" type="text" size="35" value="<?php echo $name_maiden; ?>" readonly>
<a href="javascript:popSearchWin('sport','aufnahmeform.name_maiden','aufnahmeform.name_maiden')"><img <?php echo createComIcon($root_path,'b-write_addr.gif','0') ?>></a>
</td>
</tr>
<?php
}

if (!$person_name_3_hide)
{?><tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($errorname3||$red) echo '<font color="'.$error_fontcolor.'">'; ?><font color="blue">* <?php echo "Specialita'/Ruolo/Categoria" ?>:</font>
</td>
<td colspan=2><input name="<?php echo 'name_3'; ?>" type="text" size="35" value="<?php echo $name_3; ?>" readonly>
<a href="javascript:popSearchWin('specialita','aufnahmeform.name_3','aufnahmeform.name_3')"><img <?php echo createComIcon($root_path,'b-write_addr.gif','0') ?>></a>
</td>
</tr>
<?php
}




if (!$person_name_others_hide)
{?><tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($errornameothers||$red) echo '<font color="'.$error_fontcolor.'">'; ?><font color="blue">* <?php echo "Inizio attivita' ad anni" ?>:</font>
</td>
<td colspan=2><input name="<?php echo 'name_others'; ?>" type="text" size="35" value="<?php echo $name_others; ?>" >
</td>
</tr>
<?php
}

if (!$person_nat_id_nr_hide)
{?><tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($errornatid||$red) echo '<font color="'.$error_fontcolor.'">'; ?><font color="blue">* <?php echo "Societa' sportiva" ?>:</font>
</td>
<td colspan=2><input name="<?php echo 'nat_id_nr'; ?>" type="text" size="35" value="<?php echo $nat_id_nr; ?>" >
</td>
</tr>
<?php
}

if (!$person_religion_hide)
{?><tr>
<td><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php if ($errorreligion||$red) echo '<font color="'.$error_fontcolor.'">'; ?><font color="blue">* <?php echo $LDReligion ?>:</font>
</td>
<td colspan=2><input name="<?php echo 'religion'; ?>" type="text" size="35" value="<?php echo $religion; ?>" readonly>
<a href="javascript:popSearchWin('federazioni','aufnahmeform.religion','aufnahmeform.religion')"><img <?php echo createComIcon($root_path,'b-write_addr.gif','0') ?>></a>
</td>
</tr>

   
<?php
}
				?>		
	</table>
</div>
<!-- COSA AGGIUNTA DA NOI PER RENDERE OBBLIGATORI I CAMPI PER L'ATLETA -->
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

<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>  alt="<?php echo $LDSaveData ?>" align="absmiddle" > 
<a href="javascript:document.aufnahmeform.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetData ?>"   align="absmiddle"></a>

<?php if($error||$error_person_exists) echo '<input  type="button" value="'.$LDForceSave.'" onClick="forceSave()">'; ?>

<?php
/* if($update) 
	{ 
		echo '<input type="button" value="'.$LDCancel.'" onClick="location.replace(\'';
		if($target=='search') echo 'patient_register_show.php'.URL_REDIRECT_APPEND.'&lang='.$lang;
			else echo 'patient_register_archive.php'.URL_REDIRECT_APPEND.'&newdata=1&lang='.$lang;
		echo '\')"> '; 
	}*/
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
<?php if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) echo 'aufnahme_start.php';
	else echo 'aufnahme_start.php';
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
