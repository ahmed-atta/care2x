<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid||!$ck_pflege_user)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php"); // load color preferences
$breakfile="pflege.php?sid=$ck_sid&lang=$lang";

$filename="../global_conf/$lang/doctors_abt_list.pid";
$abtname=get_meta_tags($filename);

$dbtable="nursing_station_".$lang;
			
	require("../req/db-makelink.php");
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
													editor='$ck_pflege_user',
													edit_date='".date("d.m.Y")."'
												WHERE
													station='$station'";
													
									if($ergebnis=mysql_query($sql,$link)) 
										{
											mysql_close($link);
											header("location:pflege-station-info.php?sid=$ck_sid&lang=$lang&station=$station&edit=0&mode=show");
											exit;
										}
										else print "$sql<br>$LDDbNoSave";
								break;
				default:					
					$sql="SELECT * FROM $dbtable ORDER BY station DESC";
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
		alert("<?=$LDAlertIncomplete ?>");
		return false;
	}
	if(d.start_no.value>=d.end_no.value) 
	{
		alert("<?=$LDAlertRoomNr ?>");
		return false;
	}
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?
require("../req/css-a-hilitebu.php");
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12; background-color: #ffffff}
td.pv{ font-family: verdana,arial; font-size: 12; color: #0000cc; background-color: #ffffff}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<? print $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?="$LDNursing $LDStation - $LDProfile" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('nursing_ward_mng.php','<?=$mode ?>','<?=$edit ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseAlt ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<? if($rows==1) : ?>
<p><br>
<? 	parse_str($result[bed_patient],$buf); ?>
	
<font face="Verdana, Arial" size=-1>
<form action="pflege-station-info.php" method="post" name="newstat" <? if($edit) print ' onSubmit="return check(this)"'; ?>>
<table border=0 cellpadding=3>
  <tr>
    <td class=pblock align=right><?=$LDStation ?>: </td>
    <td class=pv><? print $result[station]; ?>
</td>
  </tr>
<tr>
    <td class=pblock align=right></font><?=$LDDept ?>: </td>
    <td class=pv><?
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
    <td class=pblock align=right valign="top"><?=$LDDescription ?>: </td>
    <td class=pv><?if($edit) print '<textarea name="description" cols=40 rows=4 wrap="physical">'.$result[description].'</textarea>';
							else print nl2br($result[description]); ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right></font><?=$LDRoom1Nr ?>: </td>
    <td class=pv><?if($edit) print '<input type="text" name="start_no" size=4 maxlength=4 value="'.$result[start_no].'">';
							else print $result[start_no]; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right></font><?=$LDRoom2Nr ?>: </td>
    <td class=pv><?if($edit) print '<input type="text" name="end_no" size=4 maxlength=4 value="'.$result[end_no].'">';
							else print $result[end_no]; ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDNrBeds ?>:</td>
    <td class=pv><input type="hidden" name="bedtype" value=2 ><b>2</b></td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDBed1Prefix ?>:</td>
    <td class=pv><input type="hidden" name="bed_id1" value="a"><b>A</b>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDBed2Prefix ?>: </td>
    <td class=pv><input type="hidden" name="bed_id2" value="b"><b>B</b>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDRoomPrefix ?>: </td>
    <td class=pv><?if($edit) print '<input type="text" name="roomprefix" size=4 maxlength=4 value="'.$result[roomprefix].'">';
							else print $result[roomprefix]; ?>
</td>
  </tr>
<!--   <tr>
    <td class=pblock align=right><?=$LDMaxBeds ?>: </td>
    <td class=pv><? if(!$edit) print $result[maxbed]; ?>
</td>
  </tr>
 -->  <tr>
    <td class=pblock align=right><?=$LDHeadNurse ?>: </td>
    <td class=pv><?if($edit) print '<input type="text" name="headnurse" size=40 maxlength=50 value="'.$result[headnurse_1].'">';
							else print $result[headnurse_1]; ?></td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDHeadNurse2 ?>:</td>
    <td class=pv><?if($edit) print '<input type="text" name="asst" size=40 maxlength=50 value="'.$result[headnurse_2].'">';
							else print $result[headnurse_2]; ?></td>
  </tr>
  <tr>
    <td class=pblock align=right valign="top"><?=$LDNurses ?>:</td>
    <td class=pv><?if($edit) print '<textarea name="nurses" cols=40 rows=8 wrap="physical">'.$result[nurses].'</textarea>';
							else print nl2br($result[nurses]); ?>
                     </td>
  </tr>
 <? if(!$edit) : ?>
  <tr>
    <td class=pblock align=right><?=$LDCreatedOn ?></td>
    <td class=pv><?=$result[edit_date] ?>
                     </td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDCreatedBy ?></td>
    <td class=pv><?=$result[encoder] ?>
                     </td>
  </tr>
  <? endif ?>
</table><p>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="station" value="<?=$result[station] ?>">
	<? if($edit) : ?>
	<input type="hidden" name="mode" value="update">
	<input type="hidden" name="edit" value="1">
	<input type="submit" value="<?=$LDSave ?>">
	<? else : ?>
	<input type="hidden" name="mode" value="show">
    <input type="hidden" name="edit" value="1">
    <input type="submit" value="<?=$LDEditProfile ?>">
	<? endif ?>
</form>
<p>
<font face="Verdana, Arial" size=2><a href="pflege-station-info.php?sid=<?="$ck_sid&lang=$lang" ?>">
<img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0 align=absmiddle> <?=$LDOtherStations ?>:</a>
<p>
<? elseif($rows) : ?><font face="Verdana, Arial" size=2><p><br>
<font color="#0000cc"><b><?=$LDExistStations ?></b></font><p><ul>
<? 
	while($result=mysql_fetch_array($ergebnis))
	{
		$buf='pflege-station-info.php?sid='.$ck_sid.'&lang='.$lang.'&mode=show&station='.$result[station];
		print '<a href="'.$buf.'">'.strtoupper($result[station]).'</a><br>';
	}
?>

</ul><p>

<? endif ?>

<a href="pflege-station-manage.php?sid=<?="$ck_sid&lang=$lang" ?>">
<img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0"></a>
</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</BODY>
</HTML>
