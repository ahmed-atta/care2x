<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_prod_db_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_products.php");
require("../req/config-color.php");

$thisfile="medlager-report.php";

if($mode=="sent") $breakfile=$thisfile; else $breakfile="medlager-datenbank-functions.php";

if(($job!=NULL)||($mode!=""))
{
	$dbtable="med_report";

	include("../req/db-makelink.php");
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
							header("Location: $thisfile?sid=$ck_sid&lang=$lang&dept=$dept&reporter=$reporter&tdate=$tdate&ttime=$ttime&mode=sent"); exit;
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
		{	alert("<?=$LDAlertReport ?>");
			return false;
		}
	if(d.reporter.value=="") 
		{	alert("<?=$LDAlertName ?>");
			return false;
		}
	if(d.id.value=="") 
		{	alert("<?=$LDAlertPersonNr ?>");
			return false;
		}
	return true;
}
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

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?="$LDMedDepot - $LDReport" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#" onClick=history.back(1)><img src="../img/<?="$lang/$lang" ?>_back2.gif" width=110 height=24 border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="javascript:gethelp('products_db.php','report','<?=$mode ?>','<?=$cat ?>','<?=$update ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="<?=$breakfile ?>?sid=<?="$ck_sid&lang=$lang" ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<? if ($mode=="sent") : ?>
<FONT    SIZE=4  FACE="Arial" color=#00cc00>
<img src="../img/varrow.gif" width="20" height="15">
<b><?=$LDReportSent ?></b></FONT> <font size="2" face="arial">
</font><p>
<?
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
<? else : ?>
<FONT    SIZE=4  FACE="Arial" color=#00cc00>
<img src="../img/varrow.gif" width="20" height="15">
<b><?=$LDWriteReport ?></b></FONT> <font size="2" face="arial">
</font><p>
<form ENCTYPE="multipart/form-data" action="<?=$thisfile ?>" method="post" onSubmit="return checkform(this)"> 
<table cellpadding="5" border="0" cellspacing=1>
<tr>
<td  bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">
<p><?=$LDReport ?>:<br>
<TEXTAREA NAME="job" Content-Type="text/html"
	COLS="60" ROWS="10"></TEXTAREA>
</td>
</tr>
<tr>
<td bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">

<?=$LDReporter ?>:<br><input type="text" name="reporter" size=20 value="<?=$ck_prod_db_user ?>"> <p>
<?=$LDPersonellNr ?>:<br><input type="text" name="id" size="20">
<input type="hidden" name="tdate" value="<? print strftime("%d.%m.%Y") ?>" >
<input type="hidden" name="ttime" value= "<? print strftime("%H.%M") ?>">
<input type="hidden" name="sid" value= "<?=$ck_sid ?>">
<input type="hidden" name="lang" value= "<?=$lang ?>">
<input type="hidden" name="mode" value= "save">

</td>
</tr>

</table>
<p>

<input type="submit" name="versand" value="<?=$LDSend ?>"  >  
<input type="reset" value="<?=$LDResetAll ?>" >
</form>

</FONT>
<p>
<? endif ?>

<p>



<p>
<a href="<?=$breakfile ?>?sid=<?="$ck_sid&lang=$lang" ?>" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0  height=24  align="middle"></a>
<p>
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
