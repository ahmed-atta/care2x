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

$breakfile="pflege.php?sid=$sid&lang=$lang";

if($pday=="") $pday=date(d);
if($pmonth=="") $pmonth=date(m);
if($pyear=="") $pyear=date(Y);
$t_date=$pday.".".$pmonth.".".$pyear;

if($mode)
{
	$dbtable="nursing_station_".$lang;
			
	include("../include/inc_db_makelink.php");
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
									$maxbed=($end_no-($start_no-1))*$bedtype;
									$sql="INSERT INTO $dbtable 
												(
													station,
													dept,
													description,
													t_date,
													s_date,
													info,
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
													'template',
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
													'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
													'".date("d.m.Y")."'
												)";
									if($ergebnis=mysql_query($sql,$link)) 
										{
											mysql_close($link);
											header("location:pflege-station.php?sid=$sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
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
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
	if(parseInt(d.start_no.value)>=parseInt(d.end_no.value)) 
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
td.pblock{ font-family: verdana,arial; font-size: 12}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php print $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDCreate $LDNewStation" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','new')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if($rows) : ?>

<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"><font face="Verdana, Arial" size=3 color="#880000">
<b><?php echo str_replace("~station~",strtoupper($station),$LDStationExists) ?></b></font><p>
<?php endif ?>
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<form action="pflege-station-new.php" method="post" name="newstat" onSubmit="return check(this)">
<table border=0>
  <tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?php echo $LDStation ?>: </td>
    <td class=pblock><input type="text" name="station" size=20 maxlength=40 value="<?php echo //$station ?>"><br>
</td>
  </tr> 
<tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?php echo $LDDept ?>: </td>
    <td class=pblock><select name="dept">
	<option value=""> </option>';
	<?php
        $filename="../global_conf/$lang/doctors_abt_list.pid";
		$abtname=get_meta_tags($filename);
		
		while(list($x,$v)=each($abtname))
			print '
				<option value="'.$x.'">'.$v.'</option>';

	?>
                     </select>
		<img src="../img/l_arrowGrnSm.gif" width=12 height=12 border=0> <?php echo $LDPlsSelect ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><?php echo $LDDescription ?>: </td>
    <td class=pblock><textarea name="description" cols=40 rows=4 wrap="physical"><?php echo $description ?></textarea>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?php echo $LDRoom1Nr ?>: </td>
    <td class=pblock><input type="text" name="start_no" size=4 maxlength=4 value="<?php echo $start_no ?>"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?php echo $LDRoom2Nr ?>: </td>
    <td class=pblock><input type="text" name="end_no" size=4 maxlength=4 value="<?php echo $end_no ?>"><br>
</td>
  </tr>
  <tr>
    <td class=pblock align=right><font color=#ff0000><b>*</b></font><?php echo $LDRoomPrefix ?>: </td>
    <td class=pblock><input type="text" name="roomprefix" size=4 maxlength=4 value="<?php // if(!$roomprefix) print strtoupper(substr($station,0,1)); else print $roomprefix; ?>"><br>
</td>
  </tr>
  <tr>
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
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mode" value="create">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDCreateStation ?>">
</form>
<p>

<a href="javascript:history.back()"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border="0"></a>
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
