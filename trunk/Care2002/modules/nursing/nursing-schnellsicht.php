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
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php'); // load color preferences

$breakfile='nursing.php?sid='.$sid.'&lang='.$lang;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;

$dbtable='care_nursing_station_patients';

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok) 
{/* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    

	// check if already exists
	$sql='SELECT station, maxbed, freebed, usebed_percent FROM '.$dbtable.'
				WHERE s_date=\''.$s_date.'\' ORDER BY station';
	if($ergebnis=$db->Execute($sql))
     {
		$rows=0;
		while( $dbdata=$ergebnis->FetchRow()) $rows++;
		if($rows)
		{
			mysql_data_seek($ergebnis,0);
		}
	}
	else echo "$sql<br>$LDDbNoRead"; 
}
else { echo "$LDDbNoLink<br>"; } 
		 
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

  function statbel(station,e){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width; h=window.parent.screen.height;';
	}
	else echo 'w=800;
					h=600;';
?>
	winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);
	
	if (e==1) urlholder="nursing-station-pass.php?rt=pflege&sid=<?php echo "$sid&lang=$lang&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&edit=1&retpath=quick&station="+station;
		else urlholder="nursing-station.php?rt=pflege&sid=<?php echo "$sid&lang=$lang&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&edit=0&retpath=quick&station="+station;
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
 <ul>
<FONT    SIZE=4  FACE="Arial" color=red>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<b>
<?php if($pyear.$pmonth.$pday<date(Ymd)) echo $LDOld; else echo $LDTodays; ?> <?php echo $LDOccupancy ?></b>
</FONT> &nbsp;&nbsp;<font size="2" face="arial">(
<?php echo formatDate2Local($pyear.'-'.$pmonth.'-'.$pday,$date_format) ?> )
</font><p>

<?php

 if($rows)
{

/* Load the common icons */
$img_mangr=createComIcon($root_path,'man-gr.gif','0');
$img_mans_gr=createComIcon($root_path,'mans-gr.gif','0','absmiddle');
$img_mans_red=createComIcon($root_path,'mans-red.gif','0','absmiddle');
$img_statbel=createComIcon($root_path,'statbel2.gif','0','absmiddle');


echo '
		<table  cellpadding="0" cellspacing=0 border="0" >';

echo '
		<tr bgcolor="aqua" align=center><td><font face="verdana,arial" size="2" ><b>&nbsp; '.$LDStation.' &nbsp;</b></td>';
echo '
		<td><img '.$img_mangr.' alt="'.$LDNrUnocc.'"> <font face="verdana,arial" size="2" ><b>'.$LDFreeBed.'</b></td>';
echo '
		<td ><font face="verdana,arial" size="2" ><b>'.$LDOccupancy.' (%)</b></td>';
echo '
		<td><font face="verdana,arial" size="2" > <b>'.$LDBedNr.'</b></td>';
echo '
		<td><font face="verdana,arial" size="2" > <b>&nbsp; '.$LDOptions.' &nbsp;</b></td>';
echo '
		</tr>';

$randombett=0;
$randommaxbett=0;
$frei=0;

srand(time());

while ($result=$ergebnis->FetchRow())
	{
	$frei=floor(($result[freebed]/$result[maxbed])*10);
	if ($toggler==0) 
		{ echo '
						<tr bgcolor="#ffffcc">'; $toggler=1;} 
		else { echo '
						<tr bgcolor="#dfdfdf">'; $toggler=0;}
	echo "\r\n";
	echo '
						<td align=center><font face="verdana,arial" size="2" ><a href="javascript:statbel(\''.$result[station].'\',\'0\')"  title="'.$LDClk2Show.'">';
	echo strtoupper($result[station]).'
						</a></td><td align=center><font face="verdana,arial" size="2" >
						'.$result[freebed].'&nbsp;&nbsp;&nbsp;</td>';
	echo '
						<td>';
	echo "\r\n";
	for ($n=0;$n<(10-$frei);$n++) echo '<img '.$img_mans_red.'>';
	for ($n=0;$n<$frei;$n++) echo '<img '.$img_mans_gr.'>';
	echo '
			</td><td align=center>
			<font face="verdana,arial" size="2" >'.$result[maxbed].'
			</td>';
	echo "\r\n";
	echo '
			</td><td align=center> <a href="javascript:statbel(\''.$result[station].'\',\'1\')">
			<img '.$img_statbel.' alt="'.str_replace("~station~",$result[station],$LDEditStation).'" border="0"></a>
			</td></tr>
			</tr>
	 <tr><td bgcolor="#0000ee" colspan="7"><img src="../../gui/img/common/default/pixel.gif" border=0 width=1 height=1></td></tr>
	 ';

	}

echo '
			</table>';
			
if($pyear.$pmonth.$pday<>date(Ymd))
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
<a href="nursing-station-archiv.php?sid=<?php echo "$sid&lang=$lang&pyear=$pyear&pmonth=$pmonth" ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?> width=110 height=24></a>
<?php else : ?>
<a href="nursing.php?sid=<?php echo "$sid&lang=$lang" ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php endif ?>
</ul>



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
