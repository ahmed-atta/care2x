<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_tech.php");
require("../req/config-color.php");

$thisfile="technik-questions.php";
$breakfile="technik.php?sid=$ck_sid&lang=$lang";

$deptnames=get_meta_tags("../global_conf/$lang/doctors_abt_list.pid");
$checkdept=1;
require("../req/resolve_dept_dept.php");

if(!$inquirer) $inquirer=$ck_login_username;
$dbtable="tech_questions";

	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
		{
			if($mode=="save")
			{
						$sql="INSERT INTO ".$dbtable." 
						(	dept,
							query,
							inquirer,
							tphone,
							tdate,
							ttime,
							answered ) 
						VALUES 
						(
							'$dept',
							'$query',
							'$inquirer',
							'$tphone', 
							'$tdate', 
							'$ttime', 
							'0'	)";
						if(mysql_query($sql,$link))
						{ 
							mysql_close($link);
							header("Location: ".strtr("technik-questions.php?sid=$ck_sid&lang=$lang&dept=$dept&inquirer=$inquirer"," ","+")); exit;
						}
			 			else {print "<p>".$sql."$LDDbNoSave<br>"; };
			}
						
			if($mode=="read")
			{
				$sql="SELECT tdate,ttime,inquirer,query,answered,reply,ansby,astamp FROM $dbtable
							 WHERE inquirer='$inquirer'
							 		AND dept='$dept'
									AND tdate='$tdate'
									AND ttime='$ttime'
									AND tid='$tid'
									LIMIT 0,10"; 
        		if($result=mysql_query($sql,$link))
				{
					$inhalt=mysql_fetch_array($result);		
				}
			 	else {print "<p>".$sql."$LDDbNoSave<br>"; };
			}
			
			$sql="SELECT dept,tdate,ttime,inquirer,tid,query,answered FROM $dbtable WHERE inquirer='$inquirer'  ORDER BY tid DESC LIMIT 0,10 "; 
        	if($ergebnis=mysql_query($sql,$link))
				{
					$rows=0;
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);
				}
			 	else {print "<p>".$sql."$LDDbNoRead<br>"; };
	}
  	 else { print "$LDDbNoLink<br>"; } 

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <script language="javascript" >
<!-- 

function checkform(d)
{
	if(d.query.value=="") 
		{	alert("<?=$LDAlertQuestion ?>");
			return false;
		}
	if(d.inquirer.value=="") 
		{	alert("<?=$LDAlertName ?>");
			return false;
		}
	if(d.dept.value=="") 
		{	alert("<?=$LDAlertDeptOnly ?>");
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
<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10;background-color:#dedede}
</style>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?=$LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('tech.php','queries')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>

<? if (($mode=="read"))
	{
		print '<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" >
				<tr>
				<td>
				<table  cellspacing=0 cellpadding=2 >
				<tr><td bgcolor=#999999 >	<FONT  SIZE=2 FACE="verdana,Arial" color=white>';
		print "<b>$LDInquiry $LDFrom $inhalt[inquirer] $LDOn $inhalt[tdate] $LDAt $inhalt[ttime] $LDOClock:</b>";
		print '	</td>
				</tr>
				<tr><td class="vn">';
		print "	\" ".nl2br($inhalt[query])." \"</td></tr> ";
		
		if($inhalt[answered])
		{
			print '	<tr><td bgcolor="#999999" >	<FONT  SIZE=2 FACE="verdana,Arial" color=white>';

			print "	<b>$LDReply $LDFrom $inhalt[ansby] $LDAt $inhalt[astamp] :</b>";
			print '	</td>
					</tr>
					<tr><td  bgcolor="#ffffcc" ><FONT  SIZE=1 FACE="verdana,Arial" >';
			print "	\" ".nl2br($inhalt[reply])." \" ";
			print '</td> 
				</tr>';
		}
		print '
				</table>

				</td>
				</tr>
				</table>';
		print "<hr>";
	}
?>
<form action="technik-questions.php">
<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" align=right width=20%>
<tr>
<td>

<table  cellspacing=0 cellpadding=2 >
<tr><td bgcolor=#999999 align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b><?=str_replace("~tagword~",$rows,$LDLastQuestions) ?></b>
</td>
</tr>
<tr><td class="vn">
<?
if($rows)
while ($content=mysql_fetch_array($ergebnis)) 
{
	print "&nbsp;<b>$content[tdate]:</b> <a href=\"$thisfile?sid=$ck_sid&mode=read&dept=$content[dept]&tdate=$content[tdate]&ttime=$content[ttime]&inquirer=$content[inquirer]&tid=$content[tid]\">".substr($content[query],0,40)."...";
	if($content[answered]) print '<img src="../img/warn.gif" width=16 height=16 border=0>';
	print '</a><p>';
}

?>
<center>
<?=$LDFrom ?>:
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="text" name="inquirer" size=19 maxlength=40 value="<?=$inquirer ?>">
<input type="hidden" name="lang" value= "<?=$lang ?>">
<input type="submit" value="<?=$LDLogIn ?>">
</center>
</td> 
</td>
</tr>
</table>

</td>
</tr>
</table>
</form>
<FONT    SIZE=4  FACE="Arial" color=#00cc00>
<img src="../img/varrow.gif" width="20" height="15">
<b><?=$LDQuestions ?></b></FONT> <font size="2" face="arial"><br>
<u><a href="technik-reparatur-anfordern.php?sid=<?="$ck_sid&lang=$lang" ?>"><?=$LDPlsNoRequest ?></u></a></font><p>


<form ENCTYPE="multipart/form-data" action="technik-questions.php" method="post" onSubmit="return checkform(this)"> 
<table cellpadding="5" border="0" cellspacing=1>
<tr>
<td bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">
<p><?=$LDEnterQuestion ?>:<br>
<TEXTAREA NAME="query" Content-Type="text/html"
	COLS="50" ROWS="10"></TEXTAREA>
<p>
</td>
</tr>
<tr>

<td bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">


<input type="hidden" name="tdate" value="<? print strftime("%d.%m.%Y") ?>" >
<input type="hidden" name="ttime" value= "<? print strftime("%H.%M") ?>">
<input type="hidden" name="sid" value= "<?=$ck_sid ?>">
<input type="hidden" name="lang" value= "<?=$lang ?>">
<!-- <input type="hidden" name="dept" value= "<?=$dept ?>">
 --><input type="hidden" name="mode" value="save">
<?=$LDName ?>:<br><input type="text" name="inquirer" size="30"  value="<?=$inquirer ?>"> <br>
<?=$LDDept ?>:<br><input type="text" name="dept" size="30" value="<?=$deptnames[$dept] ?>">
</td>
</tr>

</table>
<p>

<input type="submit" name="versand" value="<?=$LDSendInquiry ?>"  >  
<input type="reset" value="<?=$LDReset ?>" >
</form>

</FONT>
<p>


<p>



<p>
<a href="technik.php?sid=<?="$ck_sid&lang=$lang" ?>" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0  width=103 height=24  alt="<?=$LDClose ?>" align="middle"></a>
<p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-reparatur-anfordern.php?sid=<?=$ck_sid ?>"><?=$LDReRepairTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-reparatur-melden.php?sid=<?=$ck_sid ?>"><?=$LDRepairReportTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-info.php?sid=<?=$ck_sid ?>"><?=$LDInfoTxt ?></a><br>
</FONT>
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
