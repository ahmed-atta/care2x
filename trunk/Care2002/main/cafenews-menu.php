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
define("LANG_FILE","editor.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

if(!$week) $week=1;
 $daytag=date("w");
 $day=date("j");
 $month=date("n");
 $year=date("Y");
 
if(!$mday) 
{
	$mday=$day;
	$mmonth=$month;
	$myear=$year;
} 
//print $daytag.$day.$month.$year."<p>";

 if(($daytag!=1)||($week!=1))
 {
	$JDday=GregorianToJD($month,$day,$year);
	if($daytag=="0") $JDday-=6;
	else $JDday=$JDday-($daytag-1);

	switch ($week)
	{
		case 2: $JDday+=7; break;
		case 3: $JDday+=14; break;
	}

	$datebuf=JDToGregorian($JDday);//print $datebuf;
	$arraybuf=explode("/",$datebuf);
	$month=$arraybuf[0];
	$day=$arraybuf[1];
	$year=$arraybuf[2];
	$daytag=date("w",mktime(0,0,0,$month,$day,$year));
 }
 

$dbtable="cafe_menu_".$lang;

require("../include/inc_db_makelink.php");
 if ($link&&$DBLink_OK)
 {

		 	$sql="SELECT menu FROM $dbtable WHERE cyear='$myear' AND cmonth='$mmonth' AND cday='$mday'";
			//print $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
								$content=mysql_fetch_array($ergebnis);
			}
				else print "<p>".$sql."<p>$LDDbNoRead"; 
			if(!$content[menu]) $content[menu]=$LDNoMenu;

  } else { print "$LDDbNoLink<br> $sql<br>"; }

function aligndate(&$ad,&$am,&$ay)
{
	if(!checkdate($am,$ad,$ay))
	{
		if($am==12)
		{
			$am=1;
			$ad=1;
			$ay++;
		}
		else
		{
			$am=$am+1;
    		$ad=1;
		}
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

<style type="text/css" name="s2">
.v18{ font-family:verdana,arial; color:#d6d6d6; font-size:16}
.v18_b{ font-family:verdana,arial; color:#000066; font-size:16}
</style>

<script language="javascript" >
function editcafe()
{

		if(confirm("<?php echo $LDConfirmEdit ?>"))
		{
			window.location.href="cafenews-edit-pass.php?sid=<?php echo "$sid&lang=$lang&title=$LDCafeNews" ?>";
			return false;
		}

}
</script>
</head>
<body>
<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img src="../img/basket.gif" width=74 height=70 border=0></a> <b><?php echo $LDCafeMenu ?></b></FONT>
<form action="cafenews-menu.php" method="post">

<table border=0 bgcolor="#000000" cellspacing=0 cellpadding=0>
  <tr>
    <td>

<table border=0 cellspacing=1 cellpadding=3>
  <tr>
    <td colspan=7 bgcolor="#ccffff">
	<FONT  SIZE=3 COLOR="#0000cc" FACE="verdana,Arial"><?php echo $LDThisWeek ?>
</font>
</td>
    <td colspan=7 bgcolor="#ccffff">
	<FONT  SIZE=3 COLOR="#0000cc" FACE="verdana,Arial"><?php echo $LDNextWeek ?>
</font>
</td>  
     <td colspan=7 bgcolor="#ccffff">
	<FONT  SIZE=3 COLOR="#0000cc" FACE="verdana,Arial"><?php echo $LD3rdWeek ?>
</font>
</td> 
</tr>
<tr bgcolor="#ccffff">
  
<?php for ($i=0,$acttag=$day,$dyidx=$daytag-1;$i<21;$i++,$acttag++,$dyidx++)
	{
	$spot=0; if($dyidx==7) $dyidx=0;
	aligndate($acttag,$month,$year);
	if ($mday.$mmonth.$myear==$acttag.$month.$year) 	$spot=1;
	print ' 
    <td class="v18_b" ';
	if ($spot)  print ' bgcolor="yellow">';
		else print ' bgcolor="#ccffff">';
	print '<a href="';
	if($spot) print "#\""; else print 'cafenews-menu.php?sid='.$sid.'&lang='.$lang.'&week='.$week.'&myear='.$year.'&mmonth='.$month.'&mday='.$acttag.'" ';
	print ' title="'.$acttag.'.'.$month.'.'.$year.'">';
	if($spot) print '<font color="#0000cc">';else print '<font color="#d6d6d6">';
	print '<b>'.$dayname[$dyidx].'</b>';
	if ($spot) print '</a>';
	print '</td>
	';
	}
?>

  </tr>
</table>
</td>
  </tr>
</table>



<p>
<table border=0 cellspacing=0 cellpadding=10>
  <tr bgcolor="#ccffff" >
    <td colspan=3><FONT  SIZE=2  FACE="verdana,Arial"><b><?php echo $LDMenu ?></b><p>
<?php echo nl2br($content[menu]) ?>	
 </td>
  </tr>

 <tr>    
 <td colspan=3><p><br><FONT  SIZE=2  FACE="verdana,Arial">
<a href="cafenews.php?sid=<?php echo "$sid&lang=$lang" ?>"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0> <?php echo $LDBack2CafeNews ?></a></td>
  </tr>
 </table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang?>">
<input type="hidden" name="week" value="<?php echo $week?>">
<input type="hidden" name="myear" value="<?php echo $myear?>">
<input type="hidden" name="mmonth" value="<?php echo $mmonth?>">
<input type="hidden" name="mday" value="<?php echo $mday?>">
</form></body>
</html>
