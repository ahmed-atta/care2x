<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences
$thisfile=basename(__FILE__);
/* Load the ward object */
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward($ward_nr);

$rows=0;
	
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){
    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
	
	switch($mode){	
		
		case 'show': 
		{
			if($ward=&$ward_obj->getWardInfo($ward_nr)){
				$rooms=&$ward_obj->getAllActiveRoomsInfo();
				$rows=true;
				// Get all medical departments
				/* Load the dept object */
/*				if($edit){
					include_once($root_path.'include/care_api_classes/class_department.php');
					$dept=new Department;							
					$depts=&$dept->getAllMedical();
				}
*/							
			}else{
				header('location:nursing-station-info.php'.URL_REDIRECT_APPEND);
				exit;
			}
							
			$breakfile='nursing-station-info.php?sid='.$sid.'&lang='.$lang;
			break;
		}
		
		case 'update':
		{
			$HTTP_POST_VARS['nr']=$HTTP_POST_VARS['ward_nr'];
			if($ward_obj->updateWard($ward_nr,$HTTP_POST_VARS)){
				header("location:nursing-station-info.php".URL_REDIRECT_APPEND."&edit=0&mode=show&ward_id=$station&ward_nr=$ward_nr");
				exit;
			}else{
				echo $ward_obj->getLastQuery()."<br>$LDDbNoSave";
			}
							
			break;
		}
		
		case 'close_ward':
		{
			if($ward_obj->hasPatient($ward_nr)){
				header("location:nursing-station-noclose.php".URL_REDIRECT_APPEND."&ward_id=$ward_id&ward_nr=$ward_nr");
				exit;
			}else{
				switch($close_type)
				{
					case 'temporary':		
					{
						$ward_obj->closeWardTemporary($ward_nr);
						break;
					}
					
					case 'nonreversible':	
					{
						$ward_obj->closeWardNonReversible($ward_nr);
						break;
					}
					
					case 're_open':	
					{
						$ward_obj->reOpenWard($ward_nr);
					}
				}
				
				header("location:nursing-station-info.php".URL_REDIRECT_APPEND);
				exit;
			}
		}
							
		default:					
		{
			if($wards=&$ward_obj->getAllActiveWards()){
				// Get all medical departments
				$rows=$wards->RecordCount();
				$rooms=$ward_obj->countCreatedRooms();
				if($rows==1) $ward=$wards->FetchRow();
			}else{
			 	//echo $ward_obj->getLastQuery()."<br>$LDDbNoRead";
			}
							
			$breakfile='nursing-station-manage.php?sid='.$sid.'&lang='.$lang;
		}
	} # End of switch($mode)
}else{ 
	echo "$LDDbNoLink<br>";
} 

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
function check(d){
	if((d.description.value=="")||(d.roomprefix.value=="")){
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
	if(d.room_nr_start.value>=d.room_nr_end.value){
		alert("<?php echo $LDAlertRoomNr ?>");
		return false;
	}
}
function checkTempClose(){
	if(confirm("<?php echo $LDSureTemporaryClose ?>")) return true;
		else return false;
}
function checkReopen(){
	if(confirm("<?php echo $LDSureReopenWard ?>")) return true;
		else return false;
}
function checkClose(f){
	if(confirm("<?php echo $LDSureIrreversibleClose ?>")){
		f.close_type.value="nonreversible";
		f.submit();
		return true;
	}else{
		return false;
	}
}
// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12; background-color: #ffffff}
td.pv{ font-family: verdana,arial; font-size: 12; color: #0000cc; background-color: #eeeeee}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDNursing $LDStation - $LDProfile" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','<?php echo $mode ?>','<?php echo $edit ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php
if($rows==1) {
?>
<p><br>
<?php 	

$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#abcdef';


?>


<font face="Verdana, Arial" size=-1>
<form action="nursing-station-info.php" method="post" name="newstat" <?php if($edit) echo ' onSubmit="return check(this)"'; ?>>
<table border=0 cellpadding=3>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDStation ?>: </td>
    <td class=pv bgcolor="<?php echo $bgc2 ?>"  colspan=2><?php if($edit) echo '<input type="text" name="name" size=50 maxlength=60 value="'.$ward['name'].'">';
							else echo $ward['name']; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDWard_ID ?>: </td>
    <td class=pv bgcolor="<?php echo $bgc2 ?>"  colspan=2><?php echo $ward['ward_id']; ?>
</td>
  </tr>
<tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDDept ?>: </td>
    <td class=pv colspan=2>
	<?php
	if($edit){	
	?>
	<select name="dept_nr">
	<option value=""> </option>';
	<?php
		if($depts&&is_array($depts)){		
			while(list($x,$v)=each($depts)){
				echo '
					<option value="'.$v['nr'].'"';
				if($v['nr']==$ward['dept_nr']) echo ' selected';
				echo '>';
				if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
					else echo $v['name_formal'];
				echo '</option>';
			}
		}
	?>
     </select>
	<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
		
	<?php
	}else{
		echo $ward['dept_name'];
	}
	?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right valign="top" background="<?php echo $bgc ?>"><?php echo $LDDescription ?>: </td>
    <td class=pv colspan=2><?php if($edit) echo '<textarea name="description" cols=40 rows=8 wrap="physical">'.$ward['description'].'</textarea>';
							else echo nl2br($ward['description']); ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDRoom1Nr ?>: </td>
    <td class=pv colspan=2><?php if($edit) echo '<input type="text" name="room_nr_start" size=4 maxlength=4 value="'.$ward['room_nr_start'].'">';
							else echo $ward['room_nr_start']; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDRoom2Nr ?>: </td>
    <td class=pv colspan=2><?php if($edit) echo '<input type="text" name="room_nr_end" size=4 maxlength=4 value="'.$ward['room_nr_end'].'">';
							else echo $ward['room_nr_end']; ?>
</td>
  </tr>
<!--   <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDNrBeds ?>:</td>
    <td class=pv><input type="hidden" name="bedtype" value=2 ><b>2</b></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDBed1Prefix ?>:</td>
    <td class=pv><input type="hidden" name="bed_id1" value="a"><b>A</b>
</td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDBed2Prefix ?>: </td>
    <td class=pv><input type="hidden" name="bed_id2" value="b"><b>B</b>
</td>
  </tr>
 -->  
 <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDRoomPrefix ?>: </td>
    <td class=pv colspan=2><?php if($edit) echo '<input type="text" name="roomprefix" size=4 maxlength=4 value="'.$ward[roomprefix].'">';
							else echo $ward['roomprefix']; ?>
</td>
  </tr>
<!--   
<tr>
    <td class=pblock align=right><?php echo $LDMaxBeds ?>: </td>
    <td class=pv><?php if(!$edit) echo $ward['maxbed']; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDHeadNurse ?>: </td>
    <td class=pv><?php if($edit) echo '<input type="text" name="headnurse" size=40 maxlength=50 value="'.$result[headnurse_1].'">';
							else echo $ward['headnurse_1']; ?></td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDHeadNurse2 ?>:</td>
    <td class=pv><?php if($edit) echo '<input type="text" name="asst" size=40 maxlength=50 value="'.$result[headnurse_2].'">';
							else echo $result['headnurse_2']; ?></td>
  </tr>
  <tr>
    <td class=pblock align=right valign="top"><?php echo $LDNurses ?>:</td>
    <td class=pv><?php if($edit) echo '<textarea name="nurses" cols=40 rows=8 wrap="physical">'.$result[nurses].'</textarea>';
							else echo nl2br($result['nurses']); ?>
                     </td>
  </tr>
 --> 

  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDCreatedOn ?></td>
    <td class=pv colspan=2><?php echo formatDate2Local($ward['date_create'],$date_format) ?>
                     </td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDCreatedBy ?></td>
    <td class=pv colspan=2><?php echo $ward['create_id'] ?>
                     </td>
  </tr>
  <tr>
    <td class=pv colspan=3>&nbsp;
                     </td>
  </tr>
  
<?php
if(is_object($rooms)){
	$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
	echo '<tr>
		<td background="'.$bgc.'" align="right"><font face="verdana,arial" size="2" >&nbsp;<b>'.$LDRoom.':</b></td>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" >&nbsp;<nobr><b>'.$LDBedNr.'</b></nobr></td>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" > <b>&nbsp; '.$LDRoomShortDescription.' &nbsp;</b></td>
		</tr>';
$toggle=0;
	while($room=$rooms->FetchRow()){
		if($toggle)	$trc='#dedede';
			else $trc='#efefef';
		$toggle=!$toggle;
		echo '
	<tr bgcolor="'.$trc.'">
    <td align="right">&nbsp;<font face="Verdana, Arial" size=2>'.strtoupper($ward['roomprefix']).' '.$room['room_nr'].'&nbsp;
	</td> 
	<td class=pv >&nbsp;<font color="#ff0000">&nbsp;'.$room['nr_of_beds'].'</td> 
	<td class=pv >&nbsp;'.$room['info'].'</td> 
	</tr>';
	}


}
?>

</table><p>


<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="ward_id" value="<?php echo $ward['ward_id'] ?>">
	<?php 
		/*if($edit) {  // editing the profile is temporarily disabled ?>
	<input type="hidden" name="mode" value="update">
	<input type="hidden" name="edit" value="1">
	<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
	<input type="hidden" name="ward_nr" value="<?php echo $ward_nr ?>">
	<?php } else { ?>
		<input type="hidden" name="mode" value="show">
    	<input type="hidden" name="edit" value="1">
    	<input type="submit" value="<?php echo $LDEditProfile ?>">
		<input type="hidden" name="ward_nr" value="<?php if($mode=='show') echo $ward_nr; else echo $ward['ward_nr'] ?>">
	<?php } */?>
</form>
<p>
<?php
if($ward['is_temp_closed']){
?>
<table border=0 width="100%">
  <tr>
    <td><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> border="0"></a></td>
    <td align="right">
	<form name="closer" method="post" action="<?php echo $thisfile ?>" onSubmit="return checkReopen()" onReset="return checkClose(this)">
		<input type="hidden" name="ward_nr" value="<?php echo $ward['nr'] ?>">
		<input type="hidden" name="mode" value="close_ward">
		<input type="hidden" name="close_type" value="re_open">
		<input type="hidden" name="sid" value="<?php echo $sid ?>">
		<input type="hidden" name="lang" value="<?php echo $lang ?>">
		<input type="hidden" name="ward_id" value="<?php echo $ward['ward_id'] ?>">
		<input type="submit" value="<?php echo $LDReopenWard ?>">
		<input type="reset" value="<?php echo $LDIrreversiblyCloseWard ?>">
	</form>
	</td>
  </tr>
</table>

<?php
}else{
?>
<table border=0 width="100%">
  <tr>
    <td><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> border="0"></a></td>
    <td align="right">
	<form name="closer" method="post" action="<?php echo $thisfile ?>" onSubmit="return checkTempClose()" onReset="return checkClose(this)">
		<input type="hidden" name="ward_nr" value="<?php echo $ward['nr'] ?>">
		<input type="hidden" name="mode" value="close_ward">
		<input type="hidden" name="close_type" value="temporary">
		<input type="hidden" name="sid" value="<?php echo $sid ?>">
		<input type="hidden" name="lang" value="<?php echo $lang ?>">
		<input type="hidden" name="ward_id" value="<?php echo $ward['ward_id'] ?>">
		<input type="submit" value="<?php echo $LDTemporaryCloseWard ?>">
		<input type="reset" value="<?php echo $LDIrreversiblyCloseWard ?>">
	</form>
	</td>
  </tr>
</table>
<?php
}
?>

  
  <font face="Verdana, Arial" size=2>

<?php
if($rows>1)
{
?>
<a href="nursing-station-info.php?sid=<?php echo "$sid&lang=$lang" ?>">
<img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?> align=absmiddle> <?php echo $LDOtherStations ?>:</a>
<?php
}
?>

<p>
<?php 
}elseif($rows){
 ?>
 <font face="Verdana, Arial" size=2><p><br>
<font color="#0000cc"><b><?php echo $LDExistStations ?></b></font><p>
<table border=0 cellpadding=4 cellspacing=1>

<?php 
$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
echo '<tr>
		<td background="'.$bgc.'"></td>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" ><b>&nbsp;'.$LDStation.'</b></td>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" ><nobr><b>&nbsp;'.$LDWard_ID.'</b></nobr></td>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" ><b>&nbsp;'.$LDDescription.'&nbsp;</b></td>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" ><b>&nbsp;'.$LDStatus.'&nbsp;</b></td>
		</tr>';
		
$toggle=0;
$room=array();

	while($result=$wards->FetchRow()){
		if(is_object($rooms)){
			while($room=$rooms->FetchRow()){
				if($room['nr']==$result['nr'])	break;
			}
			$rooms->MoveFirst();
		}
		if($toggle)	$trc='#dedede';
			else $trc='#efefef';
		$toggle=!$toggle;
		$buf='nursing-station-info.php'.URL_APPEND.'&mode=show&station='.$result['name'].'&ward_nr='.$result['nr'];
		echo '
	<tr bgcolor="'.$trc.'">
    <td>&nbsp;<a href="'.$buf.'"><img '.createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle').'>&nbsp;&nbsp;<font face="Verdana, Arial" size=2>'.strtoupper($result[station]).'</a></td> 
	<td><font face="Verdana, Arial" size=2> <a href="'.$buf.'">'.ucfirst($result['name']).'</a> &nbsp;</td> 
	<td>&nbsp;<font face="Verdana, Arial" size=2> <a href="'.$buf.'">'.ucfirst($result['ward_id']).'</a> &nbsp;</td> 
	<td><font face="Verdana, Arial" size=2>'.ucfirst($result['description']).'&nbsp;</td>  
	<td><font face="Verdana, Arial" size=2 >';
	if($result['is_temp_closed']){
		echo '<font  color="red">'.$LDTemporaryClosed.'</font>';
	}elseif(empty($room['nr_rooms'])){
		echo $LDRoomNotCreated.'<a href="nursing-station-new-createbeds.php'.URL_APPEND.'&ward_nr='.$result['nr'].'"> '.$LDCreate.'>></a>';
	}else{
		echo $room['nr_rooms'].' '.$LDRoom;
	}
	echo '&nbsp;</td>  
	</tr>';
	}
?>
</table>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> border="0"></a>
<?php
}else{

# If no wards available 
echo '<p><font size=2 face="verdana,arial,helvetica">'.$LDNoWardsYet.'<br><img '.createComIcon($root_path,'redpfeil.gif','0','absmiddle').'> <a href="nursing-station-new.php'.URL_APPEND.'">'.$LDClk2CreateWard.'</a></font>';

}
 ?>


</ul>

</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
