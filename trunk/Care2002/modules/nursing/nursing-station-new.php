<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences
/* Load the ward object */
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward=new Ward;
/* Load the dept object */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept=new Department;

$breakfile='nursing-station-manage.php'.URL_APPEND;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$t_date=$pday.'.'.$pmonth.'.'.$pyear;

if($mode){
	$dbtable='care_ward';
			
	if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok){
		switch($mode)
		{	
			case 'create': 
				/* check if ward already exists */
								if(!$ward->IDExists($ward_id)){				
									if($ergebnis=$ward->saveWard($HTTP_POST_VARS)){
										$ward_nr=$db->Insert_ID();
										header("location:nursing-station-new-createbeds.php?sid=$sid&lang=$lang&ward_nr=$ward_nr");
										exit;
									}else{echo "$sql<br>$LDDbNoSave";}
								}else{ $ward_exists=true;}
								break;
		}// end of switch
	}else{echo "$LDDbNoLink<br>";} 
}else{
	$depts=&$dept->getAllMedical();
}
$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#eeeeee';

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

function check(d)
{
	if((d.description.value=="")||(d.dept_nr.value=="")||(d.ward_id=="")||(d.roomprefix.value==""))
	{
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
	if(parseInt(d.room_nr_start.value)>=parseInt(d.room_nr_end.value)) 
	{
		alert("<?php echo $LDAlertRoomNr ?>");
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
td.pblock{ font-family: verdana,arial; font-size: 12}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDCreate::$LDNewStation" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','new')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if($rows) : ?>

<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><font face="Verdana, Arial" size=3 color="#880000">
<b><?php echo str_replace("~station~",strtoupper($station),$LDStationExists) ?></b></font><p>
<?php endif ?>
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<form action="nursing-station-new.php" method="post" name="newstat" onSubmit="return check(this)">
<table border=0>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDStation ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="name" size=20 maxlength=40 value="<?php echo $name ?>"><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDWard_ID ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="ward_id" size=20 maxlength=40 value="<?php echo $ward_id ?>"> [a-Z,1-0] <?php echo $LDNoSpecChars ?><br>
</td>
  </tr> 
<tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDDept ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" >
		<select name="dept_nr">
			<option value=""> </option>';
	<?php
		if($depts&&is_array($depts)){		
			while(list($x,$v)=each($depts)){
				echo '
					<option value="'.$v['nr'].'"';
				if($v['nr']==$dept_nr) echo ' selected';
				echo '>';
				if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
					else echo $v['name_formal'];
				echo '</option>';
			}
		}
	?>
		</select>
	<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDDescription ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><textarea name="description" cols=40 rows=8 wrap="physical"><?php echo $description ?></textarea>
</td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDRoom1Nr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="room_nr_start" size=4 maxlength=4 value="<?php echo $room_nr_start ?>"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDRoom2Nr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="room_nr_end" size=4 maxlength=4 value="<?php echo $room_nr_end ?>"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDRoomPrefix ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="roomprefix" size=4 maxlength=4 value="<?php echo $roomprefix; ?>"><br>
</td>
  </tr>
<!--   <tr>
    <td class=pblock align=right><?php echo $LDNrBeds ?>:</td>
    <td class=pblock><b>2</b><input type="hidden" name="bedtype" value=2 ><br></td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDBed1Prefix ?>:</td>
    <td class=pblock><b>A</b><input type="hidden" name="bed_id1" value="a"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDBed2Prefix ?>: </td>
    <td class=pblock><b>B</b><input type="hidden" name="bed_id2" value="b"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDHeadNurse ?>: </td>
    <td class=pblock><input type="text" name="headnurse" size=40 maxlength=50 value="<?php echo $headnurse ?>"></td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDHeadNurse2 ?>:</td>
    <td class=pblock><input type="text" name="asst" size=40 maxlength=50 value="<?php echo $asst ?>"></td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDNurses ?>:</td>
    <td class=pblock><textarea name="nurses" cols=40 rows=8 wrap="physical"><?php echo $nurses ?></textarea>
                     </td>
  </tr>
 --></table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mode" value="create">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDCreateStation ?>">
</form>
<p>

<a href="javascript:history.back()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>
</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</BODY>
</HTML>
