<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_tech.php");

if($tid&&$dept)
{

$rows=0;
$stat2seen=false;
$mov2arc=false;
$deltodo=false;
	include("../req/db-makelink.php");
		if($link&&$DBLink_OK) 
		{
		 switch($mode)
		 {
			case "ack_print":
				{
				$sql='UPDATE tech_repair_job SET seen=1, tid="'.$tid.'" 
							WHERE dept="'.$dept.'" 
								AND tdate="'.$tdate.'"
								AND ttime="'.$ttime.'"
								AND tid="'.$tid.'"';
								
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$stat2seen=true;
					}
					else {print "<p>".$sql."$LDDbNoUpdate<br>"; };
					break;
				}
			case "archive":
				{
				$sql='UPDATE tech_repair_job SET archive=1, tid="'.$tid.'" 
							WHERE dept="'.$dept.'" 
								AND tdate="'.$tdate.'"
								AND ttime="'.$ttime.'"
								AND tid="'.$tid.'"';
								
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$deltodo=true;
					}
					else {print "<p>".$sql."$LDDbNoUpdate<br>"; };
					 break;
					}// end of case "archive":
		 		}// end of switch(mode)
				
				$dbtable="tech_repair_job";

				$sql='SELECT * FROM '.$dbtable.' 
										WHERE dept="'.$dept.'" 
											AND tdate="'.$tdate.'"
											AND ttime="'.$ttime.'"
											AND tid="'.$tid.'"';

							
        		if($ergebnis=mysql_query($sql,$link))
				{
					//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);
				}else {print "<p>".$sql."$LDDbNoRead<br>"; };
			//print $sql;
		}
  		 else { print "$LDDbNoLink<br>"; } 
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?="$LDRepabotActivate $LDAck" ?></title>

<script language=javascript>
function ack_print()
{
	window.print()
	window.location.replace("technik-repabot-print.php?<? print "sid=$ck_sid&lang=$lang&mode=ack_print&dept=$dept&tdate=$tdate&ttime=$ttime&tid=$tid"; ?>")
}
function move2arch()
{
	if(document.opt.clerk.value=="")
	{
		alert('<?=$LDAlertEnterName ?>');
		return;
	}
	c=document.opt.clerk.value;
	window.location.replace("technik-repabot-print.php?<? print "sid=$ck_sid&lang=$lang&mode=archive&dept=$dept&tdate=$tdate&ttime=$ttime&tid=$tid"; ?>&clerk="+c)
}
function parentref(n)
{
window.opener.location.replace('technik-repabot.php?sid=<?="$ck_sid&lang=$lang" ?>&nofocus='+n+'&showlist=1');
setTimeout("parentref(0)",10000);
}
</script>

</head>
<body bgcolor=#fefefe onLoad="if (window.focus) window.focus(); 
<? 
	if($stat2seen) print "parentref(1);"; 
	if($deltodo) print "parentref(1);"; 
?>" 
>
<p>
<form name="opt">
<?
//foreach($argv as $v) print "$v ";

if($rows>0)
{
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++
$tog=1;
$content=mysql_fetch_array($ergebnis);
print '</font>
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666"><tr><td><table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($requestindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 color="#0000ff">'.$requestindex[$i].'</td>';
	print '</tr>
			<tr bgcolor=#f6f6f6>
				 <td><font face=Verdana,Arial size=2>'.$content[reporter].'</td>
				<td ><font face=Verdana,Arial size=2>'.$content[tdate].'</td>
				<td><font face=Verdana,Arial size=2>'.$content[ttime].'</td>
				<td><font face=Verdana,Arial size=2>'.strtoupper($content[dept]).'</td>
				<td><font face=Verdana,Arial size=2>'.$content[tphone].'</td>
				<td><font face=Verdana,Arial size=2>'.$content[tid].'</td>
				</tr>
			<tr bgcolor=#ffffff>
				 <td colspan=6><p><br><font face=Verdana,Arial size=2><ul><i>" '.nl2br($content[job]).' "</i></ul></td>
				</tr></table></td></tr>

				</table><font face=Verdana,Arial size=2><p>';

if(!$deltodo)		
if (!$content[seen]){ print '
									
									<input type="button" value="GO" onClick="ack_print()"> '.$LDAckPrint.'<p>';

						}
					else{ print '<p>
									<input type="button" value="GO" onClick="window.print()"> <b>'.$LDPrintRequest.'</b><p>
									'.$LDAckBy.':<input type="text" name="clerk" size=25 maxlength=40><br>
									<input type="button" value="GO" onClick="move2arch()"> <b>'.$LDArchiveRequest.'</b>
                                    <p>';
						}
} // end of if(rows)
else print'
<img src="../img/nedr.gif" width=100 height=138 border=0 align=middle>'.$LDNoDataFound;
?>
<p align=right><input type="button" value="<?=$LDClose ?>" onClick="parentref(0);window.close();"></p>
</form>
</font></body>
</html>
