<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','phone_directory');
define('LANG_FILE_MODULAR','phone_directory.php');
if(isset($user_origin)&&$user_origin=='pers'){
	$local_user='aufnahme_user';
	$sBreakUrl = $root_path.'modules/staff_admin/staff_register_show.php'.URL_APPEND.'&staff_nr='.$nr;
}else{
	$local_user='phonedir_user';
	$sBreakUrl = 'phone.php'.URL_APPEND;
}
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'modules/staff_admin/model/class_staff.php');

/* Create employee object */
$employee=new staff();

if(!isset($mode)) $mode='';
if(!isset($name)) $name='';
if(!isset($vorname)) $vorname='';

//$db->debug=true;

$newdata=1;
$dbtable='care_phone';
$curdate=date('Y-m-d');
$curtime=date('H:i:s');

if ($mode=='save' || ($mode=='update' && !empty($nr)) ){
	   // start checking input data
	if (!empty($name) && !empty($vorname)) {
	
		$bSaveOk = FALSE;

         # Create comm object
         include_once($root_path.'modules/phone_directory/model/class_comm.php');
         $phone = & new Comm;

        # Correctly map some indexes
        $_POST['roomnr']=$_POST['zimmerno'];
        $_POST['date'] = $curdate;
        $_POST['time'] = $curtime;
        $_POST['title'] = $_POST['anrede'];
		
		if($mode=='save'){
			$_POST['create_id'] = $_SESSION['sess_user_name'];
			$_POST['create_time'] = date('YmdHis');
			$_POST['history'] = "Add ".date('Y-m-d H:i:S')." ".$_SESSION['sess_user_name']."\n";
			$phone->setDataArray($_POST);
			//))if($db->Execute($sql))
			if($phone->insertDataFromInternalArray()){
				$bSaveOk = TRUE;
			}
		}else{
                $_POST['modify_id'] = $_SESSION['sess_user_name'];
                $_POST['modify_time'] = date('YmdHis');
                $_POST['history'] = $phone->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");

                $phone->setWhereCondition("staff_nr='$nr'");
                $phone->setDataArray($_POST);

 				if($phone->updateDataFromInternalArray($nr)){
					$bSaveOk = TRUE;
				}
			}
		if($bSaveOk){
			header('location:phone_list.php'.URL_REDIRECT_APPEND.'&user_origin='.$user_origin.'&nr='.$nr);
			exit;
	    }else{
			echo "<p>".$phone->getLastQuery()."<p>$LDDbNoSave.";
		}
    }else{
        $error=1;
    }
}

if($user_origin=='pers'&&$nr){
	if(!$employee->loadstaffData($nr)) $mode='save';
		elseif($employee->PhoneKey()) $mode = 'update';
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">

<html>
	<HEAD>

 	<TITLE></TITLE>
	 
<?php

require($root_path.'include/helpers/include_header_css_js.php');
?> 
</HEAD>

<BODY>

	<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>" SIZE=6 > <b><?php echo "$LDPhoneDir $LDNewData" ?></b></font>

	<table width=100% border=0 cellspacing=0 cellpadding=0>
	<tr>
	<td colspan=3><nobr>
	    <ul class="tabs">
	    <li><a href="phone_list.php<?php echo URL_APPEND.'&edit=$edit'; ?>">Directory</a></li>
	    <li class="active"><a href="phone_edit_pass.php<?php echo URL_APPEND; ?>">New Data</a></li>
    </ul>
	</tr>
	<tr>
	<td class="wardlisttitlerow" colspan=3 >
	&nbsp;<b>
   <?php
   	   if(($newvalues=='')&&($remark!='fromlist')) 
		{
		$nowtime=date(G);
		if(($nowtime>=0)&&($nowtime<10)) echo $LDGoodMorning;
		elseif(($nowtime > 9)&&($curtime<18)) echo $LDGoodDay;
		elseif($nowtime > 18) echo $LDGoodEvening;
		echo ' '.$_COOKIE[$local_user.$sid];
		}
	?>&nbsp;&nbsp;</b>
	</FONT>
	</td>
	</tr>
	
	<tr>
	
	<td class="wardlisttitlerow" >&nbsp;</td>

	<td><br>
	<ul>
	

<FORM action="phone_list.php" method="post" name="newentry">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="newdata" value="<?php echo $newdata ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="user_origin" value="<?php echo $user_origin ?>">
<INPUT type="submit"  value="<?php echo $LDShowActualDir ?>"></FORM>
</FONT>
<?php if (($error)&&($mode=='save'))
{
echo "<FONT  COLOR=maroon  SIZE=+2  FACE=Arial> <b>$LDNewPhoneEntry</b><p>";
}
?>
<form method="post" action="phone_edit.php" enctype="" name="entryform">
<table border="0" cellpadding="5" cellspacing="1">
<tr class="submenu">
<td colspan="4">
<?php echo $LDNewPhoneEntry ?>:
</td>
</tr>

<tr class="submenu">
<td colspan=2>

<?php echo $LDEditFields[1] ?>&nbsp;
<?php 
if($user_origin=='pers'&&$employee->isPreLoaded()){
	echo $employee->Title();
?>
<input type="hidden" name="anrede" value="<?php echo $employee->Title(); ?>">
<?php
}else{
?>
<input name=anrede type=text size="20" value="" maxlength=25><br>
<?php
}
?>
</td>
<td colspan=2>

<?php echo $LDEditFields[4] ?>&nbsp;
<input type=text name=beruf size="20" value="<?php echo $employee->Profession(); ?>" maxlength=25><br>
</td>
</tr>

<tr class="submenu">
<td colspan=2>
<b>
<?php echo $LDEditFields[2] ?>&nbsp;
<?php 
if($user_origin=='pers'&&$employee->isPreLoaded()){
	echo $employee->LastName();
?>
<input type="hidden" name="name" value="<?php echo $employee->LastName(); ?>">
<?php
}else{
?><br>
<input name="name" type=text size="40" value="" maxlength=45><br>
<?php
}
?>
</b>
</td>
<td colspan=2><b>
<?php echo $LDEditFields[3] ?>&nbsp;
<?php 
if($user_origin=='pers'&&$employee->isPreLoaded()){
	echo $employee->FirstName();
?>
<input type="hidden" name="vorname" value="<?php echo $employee->FirstName(); ?>">
<?php
}else{
?><br>
<input name="vorname" type=text size="40" value="" maxlength=45><br>
<?php
}
?>
</b>
</td>
</tr>
<tr class="submenu">
<td colspan=2>
<?php echo $LDEditFields[5] ?>
<br>

<input type=text name=bereich1 size="20" maxlength=25  value="<?php echo $employee->Dept1(); ?>"><br>
</td>
<td>
<?php echo $LDEditFields[6] ?>
<br>
<input type=text name=bereich2 size="20" maxlength=25 value="<?php echo $employee->Dept2(); ?>"><br>
</td>
<td >

<?php echo $LDEditFields[14] ?><br>
<input type=text name=zimmerno size="20" maxlength=10 value="<?php echo $employee->RoomNr(); ?>"><br>
</td>
</tr>

<tr class="submenu">
<td colspan=2>
<?php echo $LDEditFields[7] ?>
<br>

<input type=text name=inphone1 size="20" maxlength=15  value="<?php echo $employee->InPhone1() ?>"><br>
</td>
<td>
<?php echo $LDEditFields[10] ?><br>
<input type=text name=exphone1 size="20"  maxlength=25 value="<?php echo $employee->ExPhone1() ?>"><br>
</td>
<td>
<?php echo $LDEditFields[12] ?><br>
<input type=text name=funk1 size="20" maxlength=15 value="<?php echo $employee->Beeper1() ?>"><br>
</td>
</tr>

<tr class="submenu">
<td colspan=2>

<?php echo $LDEditFields[8] ?>
<br>
<input type=text name=inphone2 size="20" value="<?php echo $employee->InPhone2() ?>" maxlength=15><br>
</td>
<td>
<?php echo $LDEditFields[11] ?><br>
<input type=text name=exphone2 size="20" value="<?php echo $employee->ExPhone2() ?>" maxlength=25><br>
</td>
<td >

<?php echo $LDEditFields[13] ?><br>
<input type=text name=funk2 size="20" value="<?php echo $employee->Beeper2() ?>" maxlength=15><br>
</td>
</tr>

<tr class="submenu">
<td colspan=2>

<?php echo $LDEditFields[9] ?>
<br>
<input type=text name=inphone3 size="20" maxlength=15 value="<?php echo $employee->InPhone3() ?>"><br>
</td>
<td>&nbsp;
</td>
<td>&nbsp;
</td>
</tr>

<tr>
<td colspan=3>
<p>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="<?php if(!empty($mode)) echo $mode; else echo 'save'; ?>">
<input type="hidden" name="user_origin" value="<?php echo $user_origin ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="newvalues" value="1">
<input type="submit" value="<?php echo $LDSave ?>">
<input type="reset" name="erase" value="<?php echo $LDReset ?>">

<?php 
if($user_origin=='pers'&&$employee->isPreLoaded()){
?>
<input type="hidden" name="staff_nr" value="<?php echo $nr; ?>">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<?php
}
?>
&nbsp;
</td>
<td >
&nbsp;
</td>
</tr>
</table>
</form>

<p>
<a href="<?php echo $sBreakUrl; ?>" class="button icon remove danger">Cancel</a>
<p>
</FONT>
</ul>
<p>
</td>
<td class="wardlisttitlerow" >&nbsp;</td>
</tr>
<tr >
<td class="wardlisttitlerow"  colspan=3>
&nbsp; 
</td>
</tr>
</table>        
<p>
</BODY>
</HTML>
