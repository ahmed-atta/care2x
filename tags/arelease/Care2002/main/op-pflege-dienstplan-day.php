<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");

setcookie(username,"");
setcookie(ck_plan,"1");
/*if($dept=="") $dept="plop";
*/

$saal="exclude";
require("../req/resolve_opr_dept.php");


if($pmonth=="") $pmonth=date('n');
if($pyear=="") $pyear=date('Y');
$thisfile="op-pflege-dienstplan.php";

switch($retpath)
{
	case "menu": $rettarget="op-doku.php?sid=".$ck_sid; break;
	case "qview": $rettarget="op-pflege-dienst-schnellsicht.php"; break;
	case "calendar_opt": $rettarget="calendar-options.php?sid=$ck_sid&lang=$lang&forcestation=1&day=$pday&month=$pmonth&year=$pyear";break;
	default: $rettarget="javascript:window.history.back()";
}

//$monat=array("","Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");



$dbtable="nursing_dutyplan";

require("../req/db-makelink.php");
if($DBLink_OK)
{	
		 	$sql="SELECT a_dutyplan,r_dutyplan FROM $dbtable 
							WHERE dept='$dept'
								AND year='$pyear'
								AND month='".(int)$pmonth."'";
			
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					$dayduty=explode("~",$result[a_dutyplan]);
					$a_duty=$dayduty[$pday-1];
					if(trim($a_duty)!="?") 
					{
						parse_str($a_duty,$a_parsed);
					}
						else
						{
							$a_duty=0;
						}
					$dayduty=NULL;
					$dayduty=explode("~",$result[r_dutyplan]);
					$r_duty=$dayduty[$pday-1];
					if(trim($r_duty)!="?") 
					{
						parse_str($r_duty,$r_parsed);
					}
						else
						{
							$r_duty=0;
						}
						
						
					//print $sql."<br>";
				}
			}
				else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
				
			$sql="SELECT list FROM nursing_dept_personell_quicklist
							WHERE dept LIKE '$dept'";	
							
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $ftinfo=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$ftinfo=mysql_fetch_array($ergebnis);
					//print $result[$i][a_dutyplan];
					//print $sql."<br>";
					
					$ndl="l=$a_parsed[l]&f=$a_parsed[f]&b=$a_parsed[b]";
					$lbuf=explode("~",$ftinfo['list']);
					for($j=0;$j<sizeof($lbuf);$j++)
					{
						if(substr_count($lbuf[$j],$ndl))
						{
							parse_str($lbuf[$j],$a_f); 
							break;
			 			}
					}
					$ndl="l=$r_parsed[l]&f=$r_parsed[f]&b=$r_parsed[b]";
					//$lbuf=explode("~",$ftinfo['list']);
					for($j=0;$j<sizeof($lbuf);$j++)
					{
						if(substr_count($lbuf[$j],$ndl))
						{
							parse_str($lbuf[$j],$r_f); 
							break;
			 			}
					}
					
				}
			}
				else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
}



?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?="$LDOR $LDNursing $LDOnCallDuty" ?></TITLE>

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
	urlholder="op-pflege-dienstplan-popinfo.php?ln="+l+"&fn="+f+"&bd="+b+"&dept=<?="$dept&sid=$ck_sid&lang=$lang" ?>&route=validroute&user=<? print $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"infowin","width=" + ww + ",height=" + wh +",menubar=no,resizable=yes,scrollbars=yes");
	window.infowin.moveTo((w/2)+20,(h/2)-(wh/2));

}

</script>

</HEAD>

<BODY  bgcolor="#ffffff" alink="navy" vlink="navy"  onLoad="window.resizeTo(600,450)">
<font face="Verdana, Arial" size=2>

<b> <? print "$LDOnCallDuty ($dept) $LDOn $pday.$pmonth.$pyear" ?></b>
<p>
<? if($rows&&($a_duty||$r_duty)) : ?>
<table border=0 >
<tr>
<td bgcolor=#ffffcc><img src="../img/authors.gif" width=16 height=15 border=0>&nbsp;
<font face=verdana,arial size=2 ><b><?=$LDStandbyPerson ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><ul><font size=3 color="#990000"><b><? if($a_duty) print $a_parsed[l].", ".$a_parsed[f]; ?></b></font>
<br><ul><b><?=$LDBeeper ?>:</b><font color=red> <? print $a_f[df]; ?><br> 
<font color=navy><b><?=$LDPhone ?>:</b> <? print $a_f[dp]; ?><br></font></ul></ul>
</td>
</tr>
<tr>
<td bgcolor=#ffffcc><img src="../img/listen-sm-legend.gif" width=15 height=15 border=0>&nbsp;
<font face=verdana,arial size=2 ><b><?=$LDOnCallPerson ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><ul><font size=3 color="#990000"><b><? if($r_duty) print $r_parsed[l].", ".$r_parsed[f]; ?></b></font>
<br><ul><b><?=$LDBeeper ?>:</b><font color=red> <? print $r_f[of]; ?>
<br>
<font color=navy><b><?=$LDPhone ?>:</b> <? print $r_f[op]; ?><br></font></ul></ul>
</td>
</tr>


</table>

<? else : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td><font face="Verdana, Arial" size=3 color="#cc0000"><b><?=$LDNoEntryFound ?></b></font></td>
  </tr>
</table>


<? endif ?>

<p>
<a href="<?=$rettarget ?>"><img src="../img/<?="$lang/$lang" ?>_back2.gif" width=110 height=24 border=0></a>



</FONT>

</BODY>
</HTML>
