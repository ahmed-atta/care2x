<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_tech.php");
require("../req/config-color.php");

$thisfile="technik-report-showcontent.php";
//init db parameters
$dbtable="tech_repair_done"; 
// define the content array
$rows=0;
$count=0;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> Technik - Bericht</TITLE>

 <script language="javascript" >
<!-- 
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

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?=$test ?>
<? //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?=$LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('tech.php','showarch')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>
  <?
$rows=0;
	require("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
		{
		
				if($markseen)
				{
					$sql='UPDATE '.$dbtable.' SET  tid="'.$tid.'", seen=1
							WHERE dept="'.$dept.'" 
								AND reporter="'.$reporter.'" 
								AND tdate="'.$tdate.'"
								AND ttime="'.$ttime.'"
								AND tid="'.$tid.'"';
					if(mysql_query($sql,$link))
					{
						if($job_id)
						{
							$sql='UPDATE tech_repair_job SET  tid="'.$job_id.'", done=1
								WHERE  tid="'.$job_id.'"';
    						if(!mysql_query($sql,$link))	 {print "<p>".$sql."$LDDbNoSave<br>"; };
						}
					}
					else print "$sql $db_sqlquery_fail<br>";
				}
				$sql='SELECT * FROM '.$dbtable.' 
							WHERE dept="'.$dept.'" 
								AND reporter="'.$reporter.'" 
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
	}
  	 else { print "$LDDbNoLink<br>"; } 
	
	
if($rows)
{
//++++++++++++++++++++++++ show general info about the list +++++++++++++++++++++++++++
$tog=1;
$content=mysql_fetch_array($ergebnis);
print '</font>
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666"><tr><td><table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($blistindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 color="#0000ff">'.$blistindex[$i].'</td>';
	print '</tr>
			<tr bgcolor=#f6f6f6>
				 <td><font face=Verdana,Arial size=2>'.$content[reporter].'</td>
				<td ><font face=Verdana,Arial size=2>'.$content[tdate].'</td>
				<td><font face=Verdana,Arial size=2>'.$content[ttime].'</td>
				<td><font face=Verdana,Arial size=2>'.$content[dept].'</td>
				<td><font face=Verdana,Arial size=2>';
	if($content[job_id]) print $content[job_id]; else print "&nbsp;";
	print '</td>
				</tr>
			<tr bgcolor=#ffffff>
				 <td colspan=5><p><br><font face=Verdana,Arial size=2><ul><i>" '.nl2br($content[job]).' "</i></ul></td>
				</tr></table></td></tr>

				</table>';

//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

}
if(!$content[seen])
print '
  <form action='.$thisfile.'>
<input type="submit" value="'.$LDMarkRead.'">
<input type="hidden" name="sid" value="'.$ck_sid.'">
<input type="hidden" name="markseen" value="1">
<input type="hidden" name="dept" value="'.$content[dept].'">
<input type="hidden" name="reporter" value="'.$content[reporter].'">
<input type="hidden" name="tdate" value="'.$content[tdate].'">
<input type="hidden" name="ttime" value="'.$content[ttime].'">
<input type="hidden" name="tid" value="'.$content[tid].'">
<input type="hidden" name="job_id" value="'.$content[job_id].'">
</form>
';
 ?>
   <form>
<input type="button" value="<?=$LDPrint ?>" onclick="window.print()">
</form>
  <form>
<input type="button" value="<< <?=$LDGoBack ?>" onclick="window.history.<? if($markseen) print "go(-2)"; else print "back()"; ?>">
  
</form>
</table>

		
	

</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
