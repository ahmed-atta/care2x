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
define("LANG_FILE","tech.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

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
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<?php 
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>
<?php //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('tech.php','showarch')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>
  <?php
$rows=0;
	require("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
		{
				if(isset($markseen)&&$markseen)
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
				 <td><font face=Verdana,Arial size=2>'.$content['reporter'].'</td>
				<td ><font face=Verdana,Arial size=2>'.$content['tdate'].'</td>
				<td><font face=Verdana,Arial size=2>'.$content['ttime'].'</td>
				<td><font face=Verdana,Arial size=2>'.$content['dept'].'</td>
				<td><font face=Verdana,Arial size=2>';
	if(isset($content['job_id'])&&$content['job_id']) print $content['job_id']; else print "&nbsp;";
	print '</td>
				</tr>
			<tr bgcolor=#ffffff>
				 <td colspan=5><p><br><font face=Verdana,Arial size=2><ul><i>" '.nl2br($content['job']).' "</i></ul></td>
				</tr></table></td></tr>

				</table>';

//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

}
if(!isset($content['seen'])||!$content['seen'])
print '
  <form action="'.$thisfile.'" method="post">
<input type="submit" value="'.$LDMarkRead.'">
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="markseen" value="1">
<input type="hidden" name="dept" value="'.$content['dept'].'">
<input type="hidden" name="reporter" value="'.$content['reporter'].'">
<input type="hidden" name="tdate" value="'.$content['tdate'].'">
<input type="hidden" name="ttime" value="'.$content['ttime'].'">
<input type="hidden" name="tid" value="'.$content['tid'].'">
<input type="hidden" name="job_id" value="'.$content['job_id'].'">
</form>
';
 ?>
   <form>
<input type="button" value="<?php echo $LDPrint ?>" onClick="javascript:window.print()">
</form>
 <a> <?php print'<a href="technik-report-arch.php?sid='.$sid.'&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0>';?></a>
</table>

		
	

</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
