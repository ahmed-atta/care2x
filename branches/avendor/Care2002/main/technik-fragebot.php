<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_tech.php");

$thisfile="technik-fragebot.php";
$dbtable="tech_questions";

$rows=0;
require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
		{
		 switch($mode)
		 {
			case "answer":
				{
				$sql='UPDATE '.$dbtable.' SET  tid="'.$tid.'", reply="'.$reply.'", answered=1, ansby="'.$von.'", astamp="'.date("d.m.Y H.m").'"
							WHERE dept="'.$dept.'" 
								AND inquirer="'.$inquirer.'" 
								AND tdate="'.$tdate.'"
								AND ttime="'.$ttime.'"
								AND tid="'.$tid.'"';
								
					if(mysql_query($sql,$link)) 
					{
							$sql='SELECT * FROM '.$dbtable.' 
							WHERE dept="'.$dept.'" 
								AND inquirer="'.$inquirer.'" 
								AND tdate="'.$tdate.'"
								AND ttime="'.$ttime.'"
								AND tid="'.$tid.'"';
								
							if($ergebnis=mysql_query($sql,$link)) 
							{
								$saved=true; 
								$inhalt=mysql_fetch_array($ergebnis);
							}
							else {print "<p>".$sql."$LDDbNoRead<br>"; };
					}
					else {print "<p>".$sql."$LDDbNoUpdate<br>"; };
					break;
				}
			case "read":
				{
					$sql='SELECT * FROM '.$dbtable.' 
							WHERE dept="'.$dept.'" 
								AND inquirer="'.$inquirer.'" 
								AND tdate="'.$tdate.'"
								AND ttime="'.$ttime.'"
								AND tid="'.$tid.'"';
								
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$saved=true;
						$inhalt=mysql_fetch_array($ergebnis);
					}
					else {print "<p>".$sql."$LDDbNoRead<br>"; };
					break;
				}
			case "archive":
				{
				$sql='UPDATE '.$dbtable.' SET  tid="'.$tid.'", archive=1
							WHERE dept="'.$dept.'" 
								AND inquirer="'.$inquirer.'" 
								AND tdate="'.$tdate.'"
								AND ttime="'.$ttime.'"
								AND tid="'.$tid.'"';
					if(!mysql_query($sql,$link)) {print "<p>".$sql."$LDDbNoUpdate<br>"; };
					 break;
					}// end of case "archive":

		 	}// end of switch(mode)

				$sql='SELECT * FROM '.$dbtable.' WHERE archive<>1 ORDER BY tid DESC';;
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
<? if($mode=="") print '<meta http-equiv="refresh" content="30, url: technik-fragebot.php">'; ?>
<title><?=$LDQBotActivate ?></title>
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
	url="technik-fragebot-print.php?sid=<? print"$ck_sid&lang=$lang"; ?>&dept="+d+"&tdate="+o+"&ttime="+s+"&tid="+t;
	frageprintwin=window.open(url,"frageprintwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
</script>
<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:12;background-color:#dedede}
</style>

</head>
<body <? 	if($rows) print " bgcolor=#ffffee  onLoad=goactive() "; else print " bgcolor=#006600"; ?>
	>
<font face="Verdana, Arial" size=2 color=#800000>
<MARQUEE dir=ltr scrollAmount=3 scrollDelay=120 width=150
      height=10 align="middle"><b><?=$LDImQBot ?>...</b></MARQUEE></font>
<p>
<?
if(($mode!="")&&($saved))
	{	
		print '<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" align=center>
				<tr>
				<td>
				<table  cellspacing=0 cellpadding=2 >
				<tr><td bgcolor=#999999 >	<FONT  SIZE=2 FACE="verdana,Arial" color=white>';
		print "<b>$LDInquiry $LDFrom $inhalt[inquirer] $LDOn $inhalt[tdate] $LDAt $inhalt[ttime] $LDOClock. $LDTelephoneNr: $inhalt[tphone]</b>";
		print '	</td>
				</tr>
				<tr><td class="vn">';
		print "	\" ".nl2br($inhalt[query])." \"</td></tr> ";
		
			print '	<tr><td bgcolor=#999999 >	<FONT  SIZE=2 FACE="verdana,Arial" color=white>';

		if($inhalt[answered])	print "	<b>$LDReply $LDFrom $inhalt[ansby] $LDOn $inhalt[astamp] :</b>";
		 	else print "	<b>$LDYourReply :</b>";
			print '	</td>
					</tr>
					<tr><td class="vn">';
		if($mode=="read")
		{
			print '	<form action="'.$thisfile.'" method="post" name="repform">
						<textarea name="reply" cols=70 rows=15 wrap="physical">'.$inhalt[reply].'</textarea><br>
						'.$LDAlertName.'<br>
						<input type="text" name="von" size=25 maxlength=40 value="'.$inhalt[ansby].'"><br>
      					<input type="submit" value="'.$LDSendReply.'">
						<input type="hidden" name="sid" value="'.$ck_sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
						<input type="hidden" name="mode" value="answer">
						<input type="hidden" name="showlist" value="1">
						<input type="hidden" name="dept" value="'.$inhalt[dept].'">
 						<input type="hidden" name="inquirer" value="'.$inhalt[inquirer].'">
						<input type="hidden" name="tdate" value="'.$inhalt[tdate].'">
						<input type="hidden" name="ttime" value="'.$inhalt[ttime].'">
						<input type="hidden" name="tid" value="'.$inhalt[tid].'">
      					</form>';
		}
		else print '<i>"'.nl2br($inhalt[reply]).'"</i><br>
			<form action="'.$thisfile.'" method="get" name="closer">
			<input type="submit" value="'.$LDClose.'">
			<input type="hidden" name="dept" value="'.$inhalt[dept].'">
			<input type="hidden" name="sid" value="'.$ck_sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="hidden" name="showlist" value="'.$showlist.'">
			</form>';
			print '</td> 
				</tr>';

		print '
				</table>

				</td>
				</tr>
				</table>';
		print "<hr>";
	}


//print "$rows <br>";
if($rows)
{
	if($showlist)
	{
	print '<center><font face=Verdana,Arial size=2>';
			if ($rows>1) print $LDNewInquiryMany; else print $LDNewInquiry; 
			print'.<br> '.$LDClk2Reply.'<br></font><p>';

		$tog=1;
		print '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($queryindex);$i++)
		print '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$queryindex[$i].'</td>';
		print '
				</tr>';	

		$i=$rows;

		while($content=mysql_fetch_array($ergebnis))
 		{
			if($tog)
			{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
			print'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="technik-fragebot.php?sid='.$ck_sid.'&lang='.$lang.'&dept='.$content[dept].'&inquirer='.$content[inquirer].'&tdate='.$content[tdate].'&ttime='.$content[ttime].'&tid='.$content[tid].'&mode=read&showlist=1">
						<img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDShow.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.$content[inquirer].' </td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content[dept]).' </td>
				<td><font face=Verdana,Arial size=2>';
			//$buf=explode(".",$content[tdate]);
			//print $buf[2].'.'.$buf[1].'.'.$buf[0].'</td>
			print $content[tdate].'</td>
				 <td><font face=Verdana,Arial size=2>'.str_replace("24","00",$content[ttime]).'</td>
				<td align="center">';
			if($content[answered])
				{
					 print '<a href="technik-fragebot.php?sid='.$ck_sid.'&lang='.$lang.'&dept='.$content[dept].'&inquirer='.$content[inquirer].'&tdate='.$content[tdate].'&ttime='.$content[ttime].'&tid='.$content[tid].'&mode=archive&showlist=1">
					 <img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDMove2Archive.'"></a>';
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
			&nbsp;<b>'.$LDInquiryArrived.'</b><p>
			<form name=ack>
			<input type="hidden" name="showlist" value="1">
			<input type="hidden" name="sid" value="'.$ck_sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="submit" value="'.$LDShowInquiry.'">
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
				window.location.replace("technik-fragebot.php?='.$ck_sid.'&dept='.$dept.'");
				</script>';
	}
?>
</body>
</html>
