<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_tech.php");

$dbtable="tech_repair_job";

$rows=0;
	require("../req/db-makelink.php");
		if($link&&$DBLink_OK) 
		{
				$sql='SELECT * FROM '.$dbtable.' WHERE archive=0  ORDER BY tid DESC';
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
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="30, url: technik-repabot.php">
<title><?=$LDRepabotActivate ?></title>
<script language=javascript>
function goactive()
	{
<?
 if (!$nofocus) print "	
 	self.focus();
 	";
	if($nofocus) $nofocus=0; // toggle it to reset 	
?>
	self.resizeTo(800,600);
	}
	
function show_order(d,o,s,t)
{
	url="technik-repabot-print.php?sid=<? print "$ck_sid&lang=$lang"; ?>&dept="+d+"&tdate="+o+"&ttime="+s+"&tid="+t;
	repaprintwin=window.open(url,"repaprintwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
</script>

</head>
<body <? 	if($rows) print " bgcolor=#ffffee  onLoad=goactive() "; ?>
	>
<font face="Verdana, Arial" size=2 color=#800000>
<MARQUEE dir=ltr scrollAmount=3 scrollDelay=120 width=150
      height=10 align="middle"><b><?=$LDImRepabot ?>...</b></MARQUEE></font>
<p>
<?
//print "$rows <br>";
if($rows)
{
	if($showlist)
	{
	print '<center>
			<font face=Verdana,Arial size=2>
			<p>';
			if ($rows>1) print $LDNewReportMany; else print $LDNewReport;
			print '<br>'.$LDClk2Read.'<br></font><p>';

		$tog=1;
		print '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($reportindex);$i++)
		print '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$reportindex[$i].'</td>';
		print '
				</tr>';	

		$i=$rows;

		while($content=mysql_fetch_array($ergebnis))
 		{
			if($tog)
			{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
			print'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content[dept].'\',\''.$content[tdate].'\',\''.$content[ttime].'\',\''.$content[tid].'\')">
						<img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDShowReport.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content[dept]).'</td>
				<td><font face=Verdana,Arial size=2>';
			$buf=explode(".",$content[tdate]);
			print $buf[2].'.'.$buf[1].'.'.$buf[0].'</td>
				 <td><font face=Verdana,Arial size=2>'.str_replace("24","00",$content[ttime]).'</td>
				<td align="center">';
			if($content[seen])
				{
					 print '<img src="../img/check2.gif" width=21 height=15 border=0 alt="OK">';
				}

			print '
					</td>
				</tr>';
			$i--;

 		}
		print '
			</table>
			</td></tr></table>
			</center>';
	}
	else 
	{
 	print '<center><img src="../img/nedr.gif" width=100 height=138  border=0 align=middle>
			<font face="Verdana, Arial" size=3 color=#ff0000>
			&nbsp;<b>'.$LDReportArrived.'</b><p>
			<form name=ack>
			<input type="hidden" name="showlist" value="1">
			<input type="hidden" name="sid" value="'.$ck_sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="submit" value="'.$LDShowRequest.'">
    		</form>
			</center>'; 
	}
	

}
else if($showlist) 
	{	
		$showlist=0;
		print '
				<script language=javascript>
				self.resizeTo(300,150);
				window.location.replace("technik-repabot.php?sid='.$ck_sid.'&lang='.$lang.'&dept='.$dept.'");
				</script>';
	}
?>
</body>
</html>
