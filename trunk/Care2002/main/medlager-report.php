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
define("LANG_FILE","products.php");
$local_user=$userck;
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$thisfile="medlager-report.php";

if($mode=="sent") $breakfile=$thisfile; else $breakfile="medlager-datenbank-functions.php";

if(($job!=NULL)||($mode!=""))
{
	$dbtable="med_report";

	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
		{
			switch($mode)
			{
				case "save":
						$sql="INSERT INTO ".$dbtable." 
						(	
							job,
							reporter,
							id,
							tdate,
							ttime,
							seen,
							d_idx ) 
						VALUES 
						(
							'$job',
							'$reporter',
							'$id', 
							'$tdate', 
							'$ttime', 
							'0',
							'".date(Ymd)."'	)";
						if(mysql_query($sql,$link))
						{ 
							mysql_close($link);
							header("Location: $thisfile?sid=$sid&lang=$lang&userck=$userck&dept=$dept&reporter=$reporter&tdate=$tdate&ttime=$ttime&mode=sent"); exit;
						}
			 			else {print "<p>".$sql."<p>$LDDbNoSave.";};
   						break;
						
				case "sent":
								$sql='SELECT * FROM '.$dbtable.' 
										WHERE tdate="'.$tdate.'"
											AND ttime="'.$ttime.'"
											AND reporter="'.$reporter.'"';
        						if($ergebnis=mysql_query($sql,$link))
								{
									$rows=0;
									//count rows=linecount
									while ($content=mysql_fetch_array($ergebnis)) $rows++;					
									//reset result
									if ($rows)	mysql_data_seek($ergebnis,0);
								}else print "$LDDbNoRead<br>";
						break;
			} // end of switch

	}
  	 else 
		{ print "$LDDbNoLink<br>"; }
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <script language="javascript" >
<!-- 

function checkform(d)
{

	if(d.job.value=="") 
		{	alert("<?php echo $LDAlertReport ?>");
			return false;
		}
	if(d.reporter.value=="") 
		{	alert("<?php echo $LDAlertName ?>");
			return false;
		}
	if(d.id.value=="") 
		{	alert("<?php echo $LDAlertPersonNr ?>");
			return false;
		}
	return true;
}
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

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDMedDepot - $LDReport" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#" onClick=history.back(1)><img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" width=110 height=24 border=0  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="javascript:gethelp('products_db.php','report','<?php echo $mode ?>','<?php echo $cat ?>','<?php echo $update ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="<?php echo $breakfile ?>?sid=<?php echo "$sid&lang=$lang" ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<?php if ($mode=="sent") : ?>
<FONT    SIZE=4  FACE="Arial" color=#00cc00>
<img src="../img/varrow.gif" width="20" height="15">
<b><?php echo $LDReportSent ?></b></FONT> <font size="2" face="arial">
</font><p>
<?php
$tog=1;
$content=mysql_fetch_array($ergebnis);
print '</font>
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666"><tr><td><table border=0 cellspacing=1 cellpadding=3>
	<tr bgcolor=#ffffff>
				 <td colspan=5><p><br><font face=Verdana,Arial size=2><ul><i>" '.nl2br($content[job]).' "</i></ul></td>
				</tr>
				<tr bgcolor=#cccccc>
				 <td colspan=5><p>
				 <font face=Verdana,Arial size=2>Bericht von:'.nl2br($content[reporter]).'<br>
				 am: '.$content[tdate].'<br>
				 um: '.$content[ttime].'<p></td>
				</tr></table></td></tr>
				</table>';
?>
<?php else : ?>
<FONT    SIZE=4  FACE="Arial" color="#00cc00">
<img src="../img/varrow.gif" width=20 height=15>
<b><?php echo $LDWriteReport ?></b></FONT> <font size="2" face="arial">
</font><p>
<form ENCTYPE="multipart/form-data" action="<?php echo $thisfile ?>" method="post" onSubmit="return checkform(this)"> 
<table cellpadding=5 border=0 cellspacing=1>
<tr>
<td  bgcolor="#dddddd" ><FONT    SIZE=-1  FACE="Arial">
<p><?php echo $LDReport ?>:<br>
<TEXTAREA NAME="job" Content-Type="text/html"
	COLS=60 ROWS=10></TEXTAREA>
</td>
</tr>
<tr>
<td bgcolor="#dddddd"><FONT    SIZE=-1  FACE="Arial">

<?php echo $LDReporter ?>:<br><input type="text" name="reporter" size=30 value="<?php echo $HTTP_COOKIE_VARS[$local_user.$sid]; ?>"> <p>
<?php echo $LDPersonellNr ?>:<br><input type="text" name="id" size=30>
<input type="hidden" name="tdate" value="<?php print strftime("%d.%m.%Y") ?>" >
<input type="hidden" name="ttime" value= "<?php print strftime("%H.%M") ?>">
<input type="hidden" name="sid" value= "<?php echo $sid ?>">
<input type="hidden" name="lang" value= "<?php echo $lang ?>">
<input type="hidden" name="userck" value= "<?php echo $userck ?>">
<input type="hidden" name="mode" value= "save">

</td>
</tr>
</table>
<p>
<input type="reset" value="<?php echo $LDResetAll ?>" >&nbsp;&nbsp;&nbsp;
<input type="submit" name="versand" value="<?php echo $LDSend ?>"  >  
</form>

</FONT>
<p>
<?php endif ?>

<p>
<p>
<a href="<?php echo $breakfile ?>?sid=<?php echo "$sid&lang=$lang&userck=$userck" ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  height=24  align="middle"></a>
<p>
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
