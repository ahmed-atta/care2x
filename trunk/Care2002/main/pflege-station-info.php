<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences
$breakfile='pflege-station-manage.php?sid='.$sid.'&lang='.$lang;

$filename="../global_conf/$lang/doctors_abt_list.pid";
$abtname=get_meta_tags($filename);

$dbtable='care_nursing_station';
			
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{
    /* Load the date formatter */
    include_once('../include/inc_date_format_functions.php');
    
		
			switch($mode)
			{	
				case 'show': 
				
					// check if already exists
					$sql='SELECT * FROM '.$dbtable.' WHERE station=\''.$station.'\'';
					if($ergebnis=mysql_query($sql,$link))
       					{

							if($rows = mysql_num_rows($ergebnis))
								{

									$result=mysql_fetch_array($ergebnis);
									
					 			}
						}else echo "$sql<br>$LDDbNoRead";
						
					break;
					
				case 'update':
									$maxbed=($bed_id2-$bed_id2)*$bedtype;
									$sql="UPDATE $dbtable SET
													dept='$dept',
													description='".htmlspecialchars($description)."',
													start_no='$start_no',
													end_no='$end_no',
													bedtype='$bedtype',
													bed_id1='$bed_id1',
													bed_id2='$bed_id2',
													maxbed='$maxbed',
													roomprefix='$roomprefix',
													headnurse_1='".htmlspecialchars($headnurse)."',
													headnurse_2='".htmlspecialchars($asst)."',
													nurses='".htmlspecialchars($nurses)."',
													modify_id='".$HTTP_COOKIE_VARS[$local_user.$sid]."'
												WHERE
													station='$station'";
													
									if($ergebnis=mysql_query($sql,$link)) 
										{
											mysql_close($link);
											header("location:pflege-station-info.php?sid=$sid&lang=$lang&station=$station&edit=0&mode=show");
											exit;
										}
										else echo "$sql<br>$LDDbNoSave";
								break;
				default:					
					$sql="SELECT * FROM $dbtable ORDER BY station";
					if($ergebnis=mysql_query($sql,$link))
       					{
							$rows=mysql_num_rows($ergebnis);
							
							if($rows==1) $result=mysql_fetch_array($ergebnis);
							
						}else echo "$sql<br>$LDDbNoRead";
			}	
			
}
else { echo "$LDDbNoLink<br>"; } 

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

function check(d)
{
	if((d.station.value=="")||(d.dept.value=="")||(d.station.start_no=="")||(d.end_no.value==""))
	{
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
	if(d.start_no.value>=d.end_no.value) 
	{
		alert("<?php echo $LDAlertRoomNr ?>");
		return false;
	}
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?php
require('../include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12; background-color: #ffffff}
td.pv{ font-family: verdana,arial; font-size: 12; color: #0000cc; background-color: #ffffff}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDNursing $LDStation - $LDProfile" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','<?php echo $mode ?>','<?php echo $edit ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if($rows==1) : ?>
<p><br>
<?php 	


parse_str($result[bed_patient],$buf); 

?>


<font face="Verdana, Arial" size=-1>
<form action="pflege-station-info.php" method="post" name="newstat" <?php if($edit) echo ' onSubmit="return check(this)"'; ?>>
<table border=0 cellpadding=3>
  <tr>
    <td class=pblock align=right><?php echo $LDStation ?>: </td>
    <td class=pv><?php echo $result['station']; ?>
</td>
  </tr>
<tr>
    <td class=pblock align=right></font><?php echo $LDDept ?>: </td>
    <td class=pv><?php
                       if($edit) 
						{
							echo '
									<select name="dept" >';
							while(list($x,$v)=each($abtname))
							{
								echo '
									<option value="'.$x.'"';
								if($x==$result[dept]) echo ' selected';
								echo '>'.$v.'</option>';
							}
							echo '
									</select>';
						}
							else echo $abtname[$result['dept']]; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right valign="top"><?php echo $LDDescription ?>: </td>
    <td class=pv><?php if($edit) echo '<textarea name="description" cols=40 rows=4 wrap="physical">'.$result['description'].'</textarea>';
							else echo nl2br($result['description']); ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right></font><?php echo $LDRoom1Nr ?>: </td>
    <td class=pv><?php if($edit) echo '<input type="text" name="start_no" size=4 maxlength=4 value="'.$result['start_no'].'">';
							else echo $result['start_no']; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right></font><?php echo $LDRoom2Nr ?>: </td>
    <td class=pv><?php if($edit) echo '<input type="text" name="end_no" size=4 maxlength=4 value="'.$result['end_no'].'">';
							else echo $result['end_no']; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDNrBeds ?>:</td>
    <td class=pv><input type="hidden" name="bedtype" value=2 ><b>2</b></td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDBed1Prefix ?>:</td>
    <td class=pv><input type="hidden" name="bed_id1" value="a"><b>A</b>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDBed2Prefix ?>: </td>
    <td class=pv><input type="hidden" name="bed_id2" value="b"><b>B</b>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDRoomPrefix ?>: </td>
    <td class=pv><?php if($edit) echo '<input type="text" name="roomprefix" size=4 maxlength=4 value="'.$result[roomprefix].'">';
							else echo $result['roomprefix']; ?>
</td>
  </tr>
<!--   <tr>
    <td class=pblock align=right><?php echo $LDMaxBeds ?>: </td>
    <td class=pv><?php if(!$edit) echo $result['maxbed']; ?>
</td>
  </tr>
 -->  <tr>
    <td class=pblock align=right><?php echo $LDHeadNurse ?>: </td>
    <td class=pv><?php if($edit) echo '<input type="text" name="headnurse" size=40 maxlength=50 value="'.$result[headnurse_1].'">';
							else echo $result['headnurse_1']; ?></td>
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
 <?php if(!$edit) : ?>
  <tr>
    <td class=pblock align=right><?php echo $LDCreatedOn ?></td>
    <td class=pv><?php echo formatDate2Local($result['s_date'],$date_format) ?>
                     </td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDCreatedBy ?></td>
    <td class=pv><?php echo $result['create_id'] ?>
                     </td>
  </tr>
  <?php endif ?>
</table><p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $result[station] ?>">
	<?php if($edit) : ?>
	<input type="hidden" name="mode" value="update">
	<input type="hidden" name="edit" value="1">
	<input type="image" <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>
	<?php else : ?>
	<input type="hidden" name="mode" value="show">
    <input type="hidden" name="edit" value="1">
    <input type="submit" value="<?php echo $LDEditProfile ?>">
	<?php endif ?>
</form>
<p>
<font face="Verdana, Arial" size=2>

<?php
if($rows>1)
{
?>
<a href="pflege-station-info.php?sid=<?php echo "$sid&lang=$lang" ?>">
<img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?> align=absmiddle> <?php echo $LDOtherStations ?>:</a>
<?php
}
?>

<p>
<?php elseif($rows) : ?><font face="Verdana, Arial" size=2><p><br>
<font color="#0000cc"><b><?php echo $LDExistStations ?></b></font><p><ul>
<table border=0 cellpadding=0 cellspacing=1>
<?php 
	while($result=mysql_fetch_array($ergebnis))
	{
		$buf='pflege-station-info.php?sid='.$sid.'&lang='.$lang.'&mode=show&station='.$result[station];
		echo '
	<tr bgcolor="#efefef">
    <td>&nbsp;<a href="'.$buf.'"><img '.createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle').'>&nbsp;&nbsp;<font face="Verdana, Arial" size=2>'.strtoupper($result[station]).'</a> &nbsp;
	</td> 
	<td>&nbsp;<font face="Verdana, Arial" size=2> '.ucfirst($result['dept']).' &nbsp;  
	</td> 
	<td>&nbsp;<font face="Verdana, Arial" size=2>'.ucfirst($result['description']).'&nbsp;
	</td>  
	</tr>';
	}
?>
</table>
</ul><p>

<?php endif ?>

<a href="<?php echo $breakfile ?>">
<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border="0"></a>
</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');
  ?>

</BODY>
</HTML>
