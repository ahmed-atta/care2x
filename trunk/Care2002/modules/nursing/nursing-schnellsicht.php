<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('USE_PIE_CHART',1); // define to 1 if pie chart is preferred as display
define('PIE_CHART_USED_COLOR','red'); // define the color of the used bed portion of the graph

$lang_tables=array('date_time.php');
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='nursing.php'.URL_APPEND;
$thisfile=basename(__FILE__);

// Let us make some interface for calendar class
if($from=='arch'){
	if($pday=='') $pday=date('d');
	if($pmonth=='') $pmonth=date('m');
	if($pyear=='') $pyear=date('Y');
	$currDay=$pday;
	$currMonth=$pmonth;
	$currYear=$pyear;
}else{
	if($currDay=='') $currDay=date('d');
	if($currMonth=='') $currMonth=date('m');
	if($currYear=='') $currYear=date('Y');
	$pday=$currDay;
	$pmonth=$currMonth;
	$pyear=$currYear;
}

$s_date=$pyear.'-'.$pmonth.'-'.$pday;

if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;
	
$dbtable='care_ward';

# Establish db connection
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){/* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
	
	
	# Get the wards' info
	$sql="SELECT nr,ward_id,name,room_nr_start,room_nr_end	FROM $dbtable 
				WHERE NOT is_temp_closed AND status NOT IN ('hide','delete','void','inactive') AND date_create<='$s_date' ORDER BY nr";
		//echo $sql.'<p>';
	if($wards=$db->Execute($sql))
     {
		$rows=$wards->RecordCount();
	}else{echo "$sql<br>$LDDbNoRead";} 
	
	
	# Get the rooms' info
	$sql="SELECT  SUM(r.nr_of_beds) AS maxbed	FROM $dbtable AS w LEFT JOIN care_room AS r ON r.ward_nr=w.nr
			WHERE NOT w.is_temp_closed  AND w.status NOT IN ('hide','delete','void','inactive')   AND w.date_create<='$s_date' GROUP BY w.nr ORDER BY w.nr";
		//echo $sql.'<p>';
	if($rooms=$db->Execute($sql))
     {
		$roomcount=$rooms->RecordCount();
	}else{echo "$sql<br>$LDDbNoRead";} 
	
	# Get the today's occupancy
	$sql="SELECT  COUNT(l.location_nr) AS maxoccbed, w.nr AS ward_nr	FROM $dbtable AS w LEFT JOIN care_encounter_location AS l ON   l.group_nr=w.nr AND l.type_nr=5 ";
	if($is_today) $sql.=" AND '$s_date'>=l.date_from AND l.date_to IN ('0000-00-00','')";
		else $sql.=" AND '$s_date'>= l.date_from AND ('$s_date'<=l.date_to OR l.date_to IN ('0000-00-00',''))";
	$sql.=" WHERE NOT w.is_temp_closed  AND w.status NOT IN ('hide','delete','void','inactive')   AND w.date_create<='$s_date' ";
	$sql.="	GROUP BY w.nr ORDER BY w.nr";
	if($occbed=$db->Execute($sql))
     {
	 	//echo $sql;
		$bedcount=$occbed->RecordCount();
	}else{echo "$sql<br>$LDDbNoRead";} 
	
}else{ echo "$LDDbNoLink<br>";} 
		 
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

var urlholder;

  function gotostat(station){
	winw=screen.width ;
	winw=(winw / 2) - 400;
	winh=screen.height ;
	winh=(winh / 2) - 300;
	winspecs="width=800,height=600,screenX=" + winw + ",screenY=" + winh + ",menubar=no,resizable=yes,scrollbars=yes";

	urlholder="nursing-station.php?route=validroute&user=<?php echo $aufnahme_user ?>&station=" + station;
	stationwin=window.open(urlholder,station,winspecs);
	}

  function statbel(e,ward_nr,st){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width; h=window.parent.screen.height;';
	}
	else echo 'w=800;
					h=600;';
?>
	winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);
	
	if (e==1) urlholder="nursing-station-pass.php?rt=pflege&sid=<?php echo "$sid&lang=$lang&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&edit=1&retpath=quick&ward_nr="+ward_nr+"&station="+st;
		else urlholder="nursing-station.php?rt=pflege&sid=<?php echo "$sid&lang=$lang&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&edit=0&retpath=quick&ward_nr="+ward_nr+"&station="+st;
	//stationwin=window.open(urlholder,station,winspecs);	
	window.location.href=urlholder;
<?php // if($cfg['dhtml']) echo 'window.stationwin.moveTo(0,0);'; ?>
	}

// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY bgcolor=<?php echo $cfg['bot_bgcolor']; ?> marginwidth=0 marginheight=0 topmargin=0 leftmargin=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?> >

<table width=100% border=0  height=100% cellspacing="0">
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDNursing - $LDQuickView" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_how2search.php','','<?php echo $rows ?>','quick','')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 
<?php
/*generate the calendar */
include($root_path.'classes/calendar_jl/class.calendar.php'); 
/** CREATE CALENDAR OBJECT **/
$Calendar = new Calendar;
$Calendar->deactivateFutureDay();
/** WRITE CALENDAR **/
$Calendar -> mkCalendar ($currYear, $currMonth, $currDay);
?>

<FONT    SIZE=4  FACE="Arial" color=red>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<b>
<?php if($pyear.$pmonth.$pday!=date(Ymd)) echo $LDOld; else echo $LDTodays; ?> <?php echo $LDOccupancy ?></b>
</FONT> &nbsp;&nbsp;<font size="2" face="arial">(
<?php echo formatDate2Local($pyear.'-'.$pmonth.'-'.$pday,$date_format) ?> )
</font><br>

<?php

 if($rows)
{

/* Load the common icons */
$img_mangr=createComIcon($root_path,'man-gr.gif','0');
$img_mans_gr=createComIcon($root_path,'mans-gr.gif','0','absmiddle');
$img_mans_red=createComIcon($root_path,'mans-red.gif','0','absmiddle');
$img_statbel=createComIcon($root_path,'statbel2.gif','0','absmiddle');


echo '
		<table  cellpadding="0" cellspacing=0 border="0"  width="100%">';

echo '
		<tr bgcolor="aqua" align=center><td><font face="verdana,arial" size="2" ><b>&nbsp; '.$LDStation.' &nbsp;</b></td>';
echo '
		<td><img '.$img_mangr.' alt="'.$LDNrUnocc.'"> <font face="verdana,arial" size="2" ><b>'.$LDFreeBed.'</b></td>';
echo '
		<td ><font face="verdana,arial" size="2"  color="'.PIE_CHART_USED_COLOR.'">&nbsp;<b>'.$LDOccupied.'</b></td>';
echo '
		<td ><font face="verdana,arial" size="2" >&nbsp;<b>'.$LDOccupancy.' (%)</b></td>';
echo '
		<td><font face="verdana,arial" size="2" >&nbsp;<b>'.$LDBedNr.'</b></td>';
echo '
		<td><font face="verdana,arial" size="2" > <b>&nbsp; '.$LDOptions.' &nbsp;</b></td>';
echo '
		</tr>';

$randombett=0;
$randommaxbett=0;
$frei=0;

srand(time());

while ($result=$wards->FetchRow()){
		
	$maxbed=$result['room_nr_end']-$result['room_nr_start'];
		
	$roomrow=$rooms->FetchRow();
	$bedrow=$occbed->FetchRow();
		$freebeds=$roomrow['maxbed']-$bedrow['maxoccbed'];
		$frei=floor(($freebeds/$roomrow['maxbed'])*10);
	if ($toggler==0) 
		{ $bgc='ffffcc'; $toggler=1;} 
		else {$bgc='dfdfdf'; $toggler=0;}
						
	echo '
			<tr bgcolor="#'.$bgc.'">';
	echo "\r\n";
	echo '
						<td align=center><font face="verdana,arial" size="2" ><a href="javascript:statbel(\'1\',\''.$result['nr'].'\',\''.$result['ward_id'].'\')"  title="'.$LDClk2Show.'">';
	echo strtoupper($result['name']).'
						</a>';
	echo '</td>
						<td align=center><font face="verdana,arial" size="2" >
						'.$freebeds.'&nbsp;&nbsp;&nbsp;</td>
						<td align=center><font face="verdana,arial" size="2" color="'.PIE_CHART_USED_COLOR.'">
						';
	if($bedrow['maxoccbed']) echo $bedrow['maxoccbed'];
	echo '&nbsp;&nbsp;&nbsp;</td>
						';
	echo '
						<td align="center">';
	echo "\r\n";
	if(defined('USE_PIE_CHART')&&USE_PIE_CHART){
		echo '<img src="occupancy_pie_chart.php?qouta='.($roomrow['maxbed']-$bedrow['maxoccbed']).'&used='.$bedrow['maxoccbed'].'&bgc='.$bgc.'&uc='.PIE_CHART_USED_COLOR.'">';
	}else{
		for ($n=0;$n<(10-$frei);$n++) echo '<img '.$img_mans_red.'>';
		for ($n=0;$n<$frei;$n++) echo '<img '.$img_mans_gr.'>';
	}
	echo '
			</td><td align=center>
			<font face="verdana,arial" size="2" >'.$roomrow['maxbed'].'
			</td>';
	echo "\r\n";
	echo '
			</td><td align=center> <a href="javascript:statbel(\'1\',\''.$result['nr'].'\',\''.$result['ward_id'].'\')">';
	if($is_today){
		echo '
			<img '.$img_statbel.' alt="'.str_replace("~station~",$result['name'],$LDEditStation).'" border="0"></a>';
	}
	echo '
			</td></tr>
			</tr>
	 <tr><td bgcolor="#0000ee" colspan="7"><img src="../../gui/img/common/default/pixel.gif" border=0 width=1 height=1></td></tr>
	 ';

	}

echo '
			</table>';
			
if(!$is_today)
			echo '<p>
			<font face="Verdana, Arial" size=2 >
			<a href="nursing-station-archiv.php'.URL_APPEND.'&pyear='.$pyear.'&pmonth='.$pmonth.'">'.$LDClk2Archive.' <img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle').'></a>
			</font><p>';
}
else
{
	echo '
			<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'><font face="Verdana, Arial" size=3 color="#880000">
			<b>'.$LDNoOcc.'</b><p>
			<font size=2 color="#0">
			<a href="nursing-station-archiv.php'.URL_APPEND.'&pyear='.$pyear.'&pmonth='.$pmonth.'">'.$LDClk2Archive.' <img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle').'></a>
			</font></font><p>
			<br>&nbsp;';
}


?>


<p><br>
<?php if($from=="arch") : ?>
<a href="nursing-station-archiv.php<?php echo URL_APPEND."&pyear=$pyear&pmonth=$pmonth" ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?> width=110 height=24></a>
<?php else : ?>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php endif ?>

</FONT>
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
