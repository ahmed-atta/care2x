<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','phone.php');
if(isset($user_origin)&&$user_origin=='pers'){
	$local_user='aufnahme_user';
	$sBreakUrl = $root_path.'modules/personell_admin/personell_register_show.php'.URL_APPEND.'&personell_nr='.$nr;
}else{
	$local_user='phonedir_user';
	$sBreakUrl = 'phone.php'.URL_APPEND;
}
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_personell.php');

/* Create employee object */
$employee=new Personell();

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
         include_once($root_path.'include/care_api_classes/class_comm.php');
         $phone = & new Comm;

        # Correctly map some indexes
        $HTTP_POST_VARS['roomnr']=$HTTP_POST_VARS['zimmerno'];
        $HTTP_POST_VARS['date'] = $curdate;
        $HTTP_POST_VARS['time'] = $curtime;
        $HTTP_POST_VARS['title'] = $HTTP_POST_VARS['anrede'];
		
		if($mode=='save'){
			$HTTP_POST_VARS['create_id'] = $HTTP_SESSION_VARS['sess_user_name'];
			$HTTP_POST_VARS['create_time'] = date('YmdHis');
			$HTTP_POST_VARS['history'] = "Add ".date('Y-m-d H:i:S')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
			$phone->setDataArray($HTTP_POST_VARS);
			//))if($db->Execute($sql))
			if($phone->insertDataFromInternalArray()){
				$bSaveOk = TRUE;
			}
		}else{
                $HTTP_POST_VARS['modify_id'] = $HTTP_SESSION_VARS['sess_user_name'];
                $HTTP_POST_VARS['modify_time'] = date('YmdHis');
                $HTTP_POST_VARS['history'] = $phone->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n");

                $phone->setWhereCondition("personell_nr='$nr'");
                $phone->setDataArray($HTTP_POST_VARS);

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
	if(!$employee->loadPersonellData($nr)) $mode='save';
		elseif($employee->PhoneKey()) $mode = 'update';
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">

<?php html_rtl($lang); ?>
	<HEAD>
<?php echo setCharSet(); ?>
 	<TITLE></TITLE>
	 
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>	</HEAD>

	<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

	<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>" SIZE=6  FACE="verdana"> <b><?php echo "$LDPhoneDir $LDNewData" ?></b></font>

	<table width=100% border=0 cellspacing=0 cellpadding=0>
	<tr>
	<td colspan=3><nobr>
	<a href="phone_list.php<?php echo URL_APPEND.'&edit=$edit'; ?>"><img <?php echo createLDImgSrc($root_path,'phonedir-gray.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img <?php echo createLDImgSrc($root_path,'newdata-b.gif','0') ?>></nobr></td>
	</tr>
	<tr>
	<td bgcolor=#333399 colspan=3 >
	<FONT  SIZE=2  FACE=verdana,Arial color="#ffffff">&nbsp;<b>
   <?php
   	   if(($newvalues=='')&&($remark!='fromlist')) 
		{
		$nowtime=date(G);
		if(($nowtime>=0)&&($nowtime<10)) echo $LDGoodMorning;
		elseif(($nowtime > 9)&&($curtime<18)) echo $LDGoodDay;
		elseif($nowtime > 18) echo $LDGoodEvening;
		echo ' '.$HTTP_COOKIE_VARS[$local_user.$sid];
		}
	?>&nbsp;&nbsp;</b>
	</FONT>
	</td>
	</tr>
	
	<tr bgcolor="#DDE1EC">
	
	<td bgcolor=#333399>&nbsp;</td>

	<td><br>
	<ul>
	
<FONT    SIZE=-1  FACE="Arial">
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
echo "<img ".createMascot($root_path,'mascot1_r.gif','0','absmiddle')."><FONT  COLOR=maroon  SIZE=+2  FACE=Arial> <b>$LDNewPhoneEntry</b><p>";
}
?>
<form method="post" action="phone_edit.php" enctype="" name="entryform">
<table border="0" cellpadding="5" cellspacing="1">
<tr bgcolor="#cceeff">
<td colspan="4"><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDNewPhoneEntry ?>:
</td>
</tr>

<tr bgcolor="#cceeff">
<td colspan=2>
<FONT    SIZE=-1  FACE="Arial">
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
<FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[4] ?>&nbsp;
<input type=text name=beruf size="20" value="<?php echo $employee->Profession(); ?>" maxlength=25><br>
</td>
</tr>

<tr bgcolor="#cceeff">
<td colspan=2>
<FONT    SIZE=-1  FACE="Arial"><b>
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
<td colspan=2><FONT    SIZE=-1  FACE="Arial"><b>
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
<tr bgcolor="#cceeff">
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[5] ?>
<br>

<input type=text name=bereich1 size="20" maxlength=25  value="<?php echo $employee->Dept1(); ?>"><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[6] ?>
<br>
<input type=text name=bereich2 size="20" maxlength=25 value="<?php echo $employee->Dept2(); ?>"><br>
</td>
<td >
<FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[14] ?><br>
<input type=text name=zimmerno size="20" maxlength=10 value="<?php echo $employee->RoomNr(); ?>"><br>
</td>
</tr>

<tr bgcolor="#cceeff">
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[7] ?>
<br>

<input type=text name=inphone1 size="20" maxlength=15  value="<?php echo $employee->InPhone1() ?>"><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[10] ?><br>
<input type=text name=exphone1 size="20"  maxlength=25 value="<?php echo $employee->ExPhone1() ?>"><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[12] ?><br>
<input type=text name=funk1 size="20" maxlength=15 value="<?php echo $employee->Beeper1() ?>"><br>
</td>
</tr>

<tr bgcolor="#cceeff">
<td colspan=2>
<FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[8] ?>
<br>
<input type=text name=inphone2 size="20" value="<?php echo $employee->InPhone2() ?>" maxlength=15><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[11] ?><br>
<input type=text name=exphone2 size="20" value="<?php echo $employee->ExPhone2() ?>" maxlength=25><br>
</td>
<td >
<FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[13] ?><br>
<input type=text name=funk2 size="20" value="<?php echo $employee->Beeper2() ?>" maxlength=15><br>
</td>
</tr>

<tr bgcolor="#cceeff">
<td colspan=2>
<FONT    SIZE=-1  FACE="Arial">
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
<td colspan=3><FONT    SIZE=-1  FACE="Arial">
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
<input type="hidden" name="personell_nr" value="<?php echo $nr; ?>">
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
<FONT    SIZE=-1  FACE="Arial">
<p>
<a href="<?php echo $sBreakUrl; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>
<p>
</FONT>
</ul>
<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?></FONT>
</BODY>
</HTML>
