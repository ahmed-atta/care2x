<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","nursing.php");
$local_user="ck_pflege_user";
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php"); // load color preferences
$breakfile="pflege-station-manage.php?sid=$sid&lang=$lang";

$filename="../global_conf/$lang/doctors_abt_list.pid";
$abtname=get_meta_tags($filename);

$dbtable="nursing_station_".$lang;
			
	require("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
		{
			switch($mode)
			{	
				case "show": 
					// check if already exists
					$sql="SELECT * FROM $dbtable WHERE station='$station'";
					if($ergebnis=mysql_query($sql,$link))
       					{
							$rows=0;
							while( $dbdata=mysql_fetch_array($ergebnis)) $rows++;
							if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
					 			}
						}else print "$sql<br>$LDDbNoRead";
					break;
				case "update":
									$maxbed=($bed_id2-$bed_id2)*$bedtype;
									$sql="UPDATE $dbtable SET
													dept='$dept',
													description='$description',
													start_no='$start_no',
													end_no='$end_no',
													bedtype='$bedtype',
													bed_id1='$bed_id1',
													bed_id2='$bed_id2',
													maxbed='$maxbed',
													roomprefix='$roomprefix',
													headnurse_1='$headnurse',
													headnurse_2='$asst',
													nurses='$nurses',
													editor='".$HTTP_COOKIE_VARS[$local_user.$sid]."',
													edit_date='".date("d.m.Y")."'
												WHERE
													station='$station'";
													
									if($ergebnis=mysql_query($sql,$link)) 
										{
											mysql_close($link);
											header("location:pflege-station-info.php?sid=$sid&lang=$lang&station=$station&edit=0&mode=show");
											exit;
										}
										else print "$sql<br>$LDDbNoSave";
								break;
				default:					
					$sql="SELECT * FROM $dbtable ORDER BY station";
					if($ergebnis=mysql_query($sql,$link))
       					{
							$rows=0;
							while( $dbdata=mysql_fetch_array($ergebnis)) $rows++;
							if($rows)
								{
									mysql_data_seek($ergebnis,0);
					 			}
						}else print "$sql<br>$LDDbNoRead";
			}
		}
  		 else { print "$LDDbNoLink<br>"; } 

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

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
require("../include/inc_css_a_hilitebu.php");
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12; background-color: #ffffff}
td.pv{ font-family: verdana,arial; font-size: 12; color: #0000cc; background-color: #ffffff}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php print $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDNursing $LDStation - $LDProfile" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','<?php echo $mode ?>','<?php echo $edit ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if($rows==1) : ?>
<p><br>
<?php 	parse_str($result[bed_patient],$buf); ?>
	
<font face="Verdana, Arial" size=-1>
<form action="pflege-station-info.php" method="post" name="newstat" <?php if($edit) print ' onSubmit="return check(this)"'; ?>>
<table border=0 cellpadding=3>
  <tr>
    <td class=pblock align=right><?php echo $LDStation ?>: </td>
    <td class=pv><?php print $result[station]; ?>
</td>
  </tr>
<tr>
    <td class=pblock align=right></font><?php echo $LDDept ?>: </td>
    <td class=pv><?php
                       if($edit) 
						{
							print '
									<select name="dept" >';
							while(list($x,$v)=each($abtname))
							{
								print '
									<option value="'.$x.'"';
								if($x==$result[dept]) print ' selected';
								print '>'.$v.'</option>';
							}
							print '
									</select>';
						}
							else print $abtname[$result[dept]]; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right valign="top"><?php echo $LDDescription ?>: </td>
    <td class=pv><?php if($edit) print '<textarea name="description" cols=40 rows=4 wrap="physical">'.$result[description].'</textarea>';
							else print nl2br($result[description]); ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right></font><?php echo $LDRoom1Nr ?>: </td>
    <td class=pv><?php if($edit) print '<input type="text" name="start_no" size=4 maxlength=4 value="'.$result[start_no].'">';
							else print $result[start_no]; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right></font><?php echo $LDRoom2Nr ?>: </td>
    <td class=pv><?php if($edit) print '<input type="text" name="end_no" size=4 maxlength=4 value="'.$result[end_no].'">';
							else print $result[end_no]; ?>
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
    <td class=pv><?php if($edit) print '<input type="text" name="roomprefix" size=4 maxlength=4 value="'.$result[roomprefix].'">';
							else print $result[roomprefix]; ?>
</td>
  </tr>
<!--   <tr>
    <td class=pblock align=right><?php echo $LDMaxBeds ?>: </td>
    <td class=pv><?php if(!$edit) print $result[maxbed]; ?>
</td>
  </tr>
 -->  <tr>
    <td class=pblock align=right><?php echo $LDHeadNurse ?>: </td>
    <td class=pv><?php if($edit) print '<input type="text" name="headnurse" size=40 maxlength=50 value="'.$result[headnurse_1].'">';
							else print $result[headnurse_1]; ?></td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDHeadNurse2 ?>:</td>
    <td class=pv><?php if($edit) print '<input type="text" name="asst" size=40 maxlength=50 value="'.$result[headnurse_2].'">';
							else print $result[headnurse_2]; ?></td>
  </tr>
  <tr>
    <td class=pblock align=right valign="top"><?php echo $LDNurses ?>:</td>
    <td class=pv><?php if($edit) print '<textarea name="nurses" cols=40 rows=8 wrap="physical">'.$result[nurses].'</textarea>';
							else print nl2br($result[nurses]); ?>
                     </td>
  </tr>
 <?php if(!$edit) : ?>
  <tr>
    <td class=pblock align=right><?php echo $LDCreatedOn ?></td>
    <td class=pv><?php echo $result[edit_date] ?>
                     </td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDCreatedBy ?></td>
    <td class=pv><?php echo $result[encoder] ?>
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
	<input type="submit" value="<?php echo $LDSave ?>">
	<?php else : ?>
	<input type="hidden" name="mode" value="show">
    <input type="hidden" name="edit" value="1">
    <input type="submit" value="<?php echo $LDEditProfile ?>">
	<?php endif ?>
</form>
<p>
<font face="Verdana, Arial" size=2><a href="pflege-station-info.php?sid=<?php echo "$sid&lang=$lang" ?>">
<img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0 align=absmiddle> <?php echo $LDOtherStations ?>:</a>
<p>
<?php elseif($rows) : ?><font face="Verdana, Arial" size=2><p><br>
<font color="#0000cc"><b><?php echo $LDExistStations ?></b></font><p><ul>
<table border=0 cellpadding=0 cellspacing=1>
<?php 
	while($result=mysql_fetch_array($ergebnis))
	{
		$buf='pflege-station-info.php?sid='.$sid.'&lang='.$lang.'&mode=show&station='.$result[station];
		print '
	<tr bgcolor="#efefef">
    <td>&nbsp;<a href="'.$buf.'"><img src="../img/bul_arrowgrnsm.gif" border=0 width=12 height=12 align="absmiddle">&nbsp;&nbsp;<font face="Verdana, Arial" size=2>'.strtoupper($result[station]).'</a> &nbsp;
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
<img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border="0"></a>
</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</BODY>
</HTML>
