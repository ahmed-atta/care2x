<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid||!$ck_pflege_user)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php"); // load color preferences

$breakfile="pflege.php?sid=$ck_sid&lang=$lang";

if($pday=="") $pday=date(d);
if($pmonth=="") $pmonth=date(m);
if($pyear=="") $pyear=date(Y);
$t_date=$pday.".".$pmonth.".".$pyear;

if($mode)
{
	$dbtable="nursing_station_".$lang;
			
	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
		{
			switch($mode)
			{	
				case "create": 
					// check if already exists
					$sql="SELECT info FROM $dbtable
									WHERE station='$station'";
					if($ergebnis=mysql_query($sql,$link))
       					{
							$rows=0;
							if( $dbdata=mysql_fetch_array($ergebnis)) $rows++;
							if(!$rows)
								{
									$maxbed=($bed_id2-$bed_id1)*$bedtype;
									$sql="INSERT INTO $dbtable 
												(
													station,
													dept,
													description,
													t_date,
													s_date,
													start_no,
													end_no,
													bedtype,
													bed_id1,
													bed_id2,
													maxbed,
													roomprefix,
													headnurse_1,
													headnurse_2,
													nurses,
													encoder,
													edit_date
												)
												VALUES
												(
													'$station',
													'$dept',
													'$description',
													'".date("d.m.Y")."',
													'".date("Ymd")."',
													'$start_no',
													'$end_no',
													'$bedtype',
													'$bed_id1',
													'$bed_id2',
													'$maxbed',
													'$roomprefix', 
													'$headnurse',
													'$asst',
													'$nurses',
													'$ck_pflege_user',
													'".date("d.m.Y")."'
												)";
									if($ergebnis=mysql_query($sql,$link)) 
										{
											mysql_close($link);
											header("location:pflege-station.php?sid=$ck_sid&lang=$lang&station=$station&edit=$edit&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
											exit;
										}
										else print "$sql<br>$LDDbNoSave";
					 			}
						}else print "$sql<br>$LDDbNoRead";
					break;
				}// end of switch
		}
  		 else { print "$LDDbNoLink<br>"; } 
}
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!-- 

function check(d)
{
	if((d.station.value=="")||(d.name.value=="")||(d.station.start_no=="")||(d.end_no.value==""))
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
td.pblock{ font-family: verdana,arial; font-size: 12}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<? print $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?="$LDCreate $LDNewStation" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('nursing_ward_mng.php','new')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseAlt ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?
if($rows) : ?>

<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"><font face="Verdana, Arial" size=3 color="#880000">
<b><?=str_replace("~station~",strtoupper($station),$LDStationExists) ?></b></font><p>
<? endif ?>
<font face="Verdana, Arial" size=-1><?=$LDEnterAllFields ?>
<form action="pflege-station-new.php" method="post" name="newstat" onSubmit="return check(this)">
<table border=0>
  <tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?=$LDStation ?>: </td>
    <td class=pblock><input type="text" name="station" size=20 maxlength=40 value="<?=//$station ?>"><br>
</td>
  </tr> 
<tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?=$LDDept ?>: </td>
    <td class=pblock><select name="dept">
	<option value=""> </option>';
	<?
		$filename="../global_conf/$lang/doctors_abt_list.pid";
		$abtname=get_meta_tags($filename);
		
		while(list($x,$v)=each($abtname))
			print '
				<option value="'.$x.'">'.$v.'</option>';

	?>
                     </select>
		<img src="../img/l_arrowGrnSm.gif" width=12 height=12 border=0> <?=$LDPlsSelect ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDDescription ?>: </td>
    <td class=pblock><textarea name="description" cols=40 rows=4 wrap="physical"><?=$description ?></textarea>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?=$LDRoom1Nr ?>: </td>
    <td class=pblock><input type="text" name="start_no" size=4 maxlength=4 value="<?=$start_no ?>"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?=$LDRoom2Nr ?>: </td>
    <td class=pblock><input type="text" name="end_no" size=4 maxlength=4 value="<?=$end_no ?>"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?=$LDRoomPrefix ?>: </td>
    <td class=pblock><input type="text" name="roomprefix" size=4 maxlength=4 value="<? // if(!$roomprefix) print strtoupper(substr($station,0,1)); else print $roomprefix; ?>"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDNrBeds ?>:</td>
    <td class=pblock><b>2</b><input type="hidden" name="bedtype" value=2 ><br></td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDBed1Prefix ?>:</td>
    <td class=pblock><b>A</b><input type="hidden" name="bed_id1" value="a"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDBed2Prefix ?>: </td>
    <td class=pblock><b>B</b><input type="hidden" name="bed_id2" value="b"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDHeadNurse ?>: </td>
    <td class=pblock><input type="text" name="headnurse" size=40 maxlength=50 value="<?=$headnurse ?>"></td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDHeadNurse2 ?>:</td>
    <td class=pblock><input type="text" name="asst" size=40 maxlength=50 value="<?=$asst ?>"></td>
  </tr>
  <tr>
    <td class=pblock align=right><?=$LDNurses ?>:</td>
    <td class=pblock><textarea name="nurses" cols=40 rows=8 wrap="physical"><?=$nurses ?></textarea>
                     </td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="mode" value="create">
<input type="hidden" name="edit" value="<?=$edit ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="submit" value="<?=$LDCreateStation ?>">
</form>
<p>

<a href="javascript:history.back()"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0"></a>
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
