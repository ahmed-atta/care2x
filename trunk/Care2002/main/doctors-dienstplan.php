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
define('LANG_FILE','doctors.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

setcookie(username,"");
setcookie(ck_plan,"1");
if($dept=="") $dept="plast";
if($pmonth=="") $pmonth=date('n');
if($pyear=="") $pyear=date('Y');
$thisfile="doctors-dienstplan.php";

$filename="../global_conf/$lang/doctors_abt_list.pid";
$abtname=get_meta_tags($filename);

$dbtable='care_doctors_dutyplan';

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
	{	
		
		 	$sql="SELECT a_dutyplan,r_dutyplan FROM $dbtable 
							WHERE dept='$dept'
								AND year='$pyear'
								AND month='$pmonth'";
			
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					//echo $sql."<br>";
				}
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
	}
  	 else { echo "$LDDbNoLink<br>"; } 

$firstday=date("w",mktime(0,0,0,$pmonth,1,$pyear));

$maxdays=date("t",mktime(0,0,0,$pmonth,1,$pyear));

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }

	A:visited {text-decoration: none;}

div.a3 {font-family: arial; font-size: 14; margin-left: 3; margin-right:3; }

.infolayer {
	position:absolute;
	visibility: hide;
	left: 100;
	top: 10;

}

</style>

<script language="javascript">

  var urlholder;
  var infowinflag=0;

function popinfo(l,f,b)
{
	w=window.screen.width;
	h=window.screen.height;
	ww=400;
	wh=400;
	urlholder="doctors-dienstplan-popinfo.php?<?php echo "sid=$sid&lang=$lang" ?>&ln="+l+"&fn="+f+"&bd="+b+"&dept=<?php echo $dept ?>&route=validroute&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin<?php echo $sid ?>=window.open(urlholder,"infowin<?php echo $sid ?>","width=" + ww + ",height=" + wh +",menubar=no,resizable=yes,scrollbars=yes");
	window.infowin<?php echo $sid ?>.moveTo((w/2)+20,(h/2)-(wh/2));

}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"  >


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" ><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><font color="<?php echo $cfg['top_txtcolor']; ?>"> &nbsp; <?php echo "$LDDoctors - $LDDutyPlan" ?></font> <?php echo strtoupper($abtname[$dept]); ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right"><a href="javascript:history.back();"><img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>
 alt="<?php echo $LDBack ?>"></a><a href="javascript:gethelp('docs_dutyplan.php','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0','absmiddle') ?>
  alt="<?php echo $LDHelp ?>"></a><a href="op-pflege-dienst-schnellsicht.php?sid=<?php echo $sid ?>" onClick=killchild()><img <?php echo createLDImgSrc('../','close2.gif','0','absmiddle') ?> alt="<?php echo $LDClosePlan ?>"></a></td></tr>

<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" valign=top colspan=2><p>
<ul>


<FONT    SIZE=-1  FACE="Arial">

<table border=0>
<tr><td align=left><a href="<?php echo $thisfile.'?sid='.$sid.'&lang='.$lang.'&retpath='.$retpath.'&dept='.$dept.'&pmonth=';
if ($pmonth==1) echo '12'.'&pyear='.($pyear-1); 
else echo ($pmonth-1).'&pyear='.$pyear; ?>">
<font size=2 face=arial color=gray><b><?php if ($pmonth==1) echo $monat[12]; else echo $monat[$pmonth-1]; ?></b></a></td>
<td align=center><font size=4 face=arial color=navy>
<?php echo ucfirst($monat[$pmonth]).'&nbsp;&nbsp;'.$pyear; ?>
</font></td>

<td align=right><a href="<?php echo $thisfile.'?sid='.$sid.'&lang='.$lang.'&retpath='.$retpath.'&dept='.$dept.'&pmonth=';
if ($pmonth==12) echo '1'.'&pyear='.($pyear+1); 
else echo ($pmonth+1).'&pyear='.$pyear; ?>">
<font size=2 face=arial color=gray><b><?php if ($pmonth==12) echo $monat[1];else echo $monat[$pmonth+1]; ?></b></td>
<td>&nbsp;</td></tr>


<tr>
<td colspan=3>

<table border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="#6f6f6f">

<table border=0 cellpadding=0 cellspacing=1>
<tr><td></td><td></td>
<td><div class=a3><font face=arial size=3 color=white><b><?php echo $LDDoc1 ?></b></div></td>
<td><div class=a3><font face=arial size=3 color=white><b><?php echo $LDDoc2 ?></b></div></td>
</tr>
<?php
$aduty=explode("~",$result[a_dutyplan]);
$rduty=explode("~",$result[r_dutyplan]);

for ($i=1,$n=0,$wd=$firstday;$i<=$maxdays;$i++,$n++,$wd++){
	//$wd=weekday($i,$pmonth,$pyear);
	switch ($wd){
		case 6: $backcolor="bgcolor=#ffffcc";break;
		case 0: $backcolor="bgcolor=#ffff00";break;
		default: $backcolor="bgcolor=white";
		}
	
	parse_str(trim($aduty[$n]),$aelems);
	parse_str(trim($rduty[$n]),$relems);
	echo '
	<tr >
	<td  height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>'.$i.'</div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	if (!$wd) echo '<font color=red>';
	echo $LDShortDay[$wd].'</div>
	</td>
	<td height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>';
	echo '&nbsp;<a href="javascript:popinfo(\''.$aelems[l].'\',\''.$aelems[f].'\',\''.$aelems[b].'\')">'.$aelems[s].'</a></div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	echo '&nbsp;<a href="javascript:popinfo(\''.$relems[l].'\',\''.$relems[f].'\',\''.$relems[b].'\')">'.$relems[s].'</a></div>
	</td>
	</tr>';
	if ($wd==6)  $wd=-1;
	}
?>

</table>

</td>
</tr>
</table>

	
</td>
<?php
switch($retpath)
{
	case "menu": $rettarget="aerzte.php?sid=".$sid."&lang=".$lang; break;
	case "qview": $rettarget="doctors-dienst-schnellsicht.php?sid=$sid&lang=$lang&hilitedept=$dept"; break;
	default: $rettarget="javascript:window.history.back()";
}
?>

<td valign="top">
<a href="doctors-main-pass.php?target=dutyplan&dept=<?php echo $dept.'&sid='.$sid.'&pmonth='.$pmonth.'&pyear='.$pyear.'&retpath='.$retpath.'&lang='.$lang; ?>"><img <?php echo createLDImgSrc('../','newplan.gif','0') ?> alt="<?php echo $LDNewPlan ?>"></a>
<br>
<a href="<?php echo $rettarget ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDClosePlan ?>"></a>
</td>
</tr>
</table>

<p>
<a href="doctors-main-pass.php?target=dutyplan&dept=<?php echo $dept.'&sid='.$sid.'&pmonth='.$pmonth.'&pyear='.$pyear.'&retpath='.$retpath.'&lang='.$lang; ?>"><img <?php echo createLDImgSrc('../','newplan.gif','0') ?> alt="<?php echo $LDNewPlan ?>"></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $rettarget ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClosePlan ?>"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor="<?php echo $cfg[bot_bgcolor] ?>" height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;




</FONT>

</BODY>
</HTML>
