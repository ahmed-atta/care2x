<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_tech.php");
require("../req/config-color.php");

$breakfile="technik.php?sid=$ck_sid&lang=$lang";
if($job!=NULL)
{
$dbtable="tech_repair_done";

	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
		{
			
						$sql="INSERT INTO ".$dbtable." 
						(	dept,
							job,
							job_id,
							reporter,
							id,
							tdate,
							ttime,
							seen,
							d_idx ) 
						VALUES 
						(
							'$dept',
							'$job',
							'$job_id',
							'$reporter',
							'$id', 
							'$tdate', 
							'$ttime', 
							'0',
							'".date(Ymd)."'	)";
						if(mysql_query($sql,$link))
						{ 
							mysql_close($link);
							header("Location: technik-reparatur-empfang.php?sid=$ck_sid&lang=$lang&dept=$dept&reporter=$reporter&tdate=$tdate&ttime=$ttime"); exit;
						}
			 			else {print "<p>".$sql."$LDDbNoSave<br>"; };
	}
  	 else { print "$LDDbNoLink<br>"; } 
}

//create unique id
$r=uniqid("");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> OP </TITLE>

 <script language="javascript" >
<!-- 

function checkform(d)
{
	if(d.dept.selectedIndex==-1) 
		{	alert("<?=$LDAlertDept ?>");
			return false;
		}
	if(d.reporter.value=="") 
		{	alert("<?=$LDAlertName ?>");
			return false;
		}
	if(d.id.value=="") 
		{	alert("<?=$LDAlertPNr ?>");
			return false;
		}
	if(d.job.value=="") 
		{	alert("<?=$LDPlsDescribe ?>");
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
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?=$LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('tech.php','report')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<FONT    SIZE=4  FACE="Arial" color=#00cc00>
<img src="../img/varrow.gif" width="20" height="15">
<b><?=$LDRepairReport ?></b></FONT> <font size="2" face="arial">
<?=$LDPlsDoneOnly ?></font><p>


<form ENCTYPE="multipart/form-data" action="technik-reparatur-melden.php" method="post" onSubmit="return checkform(this)"> 
<table cellpadding="5" border="0" cellspacing=1>
<tr>
<td bgcolor=#dddddd >
<FONT    SIZE=-1  FACE="Arial">

<?=$LDRepairArea ?>:<br>
<input type="text" name="dept" size=15 maxlength=30><p>
<?=$LDJobIdNr ?>:<br>
<input type="text" name="job_id" size=15 maxlength=14><br>

</td>

<td bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">

<?=$LDTechnician ?>:<br><input type="text" name="reporter" size=20 > <p>
<?=$LDPersonnelNr ?>:<br><input type="text" name="id" size="20">
<input type="hidden" name="tdate" value="<? print strftime("%d.%m.%Y") ?>" >
<input type="hidden" name="ttime" value= "<? print strftime("%H.%M") ?>">
<input type="hidden" name="sid" value= "<?=$ck_sid ?>">

</td>
</tr>
<tr>
<td colspan=2 bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">
<?=$LDPlsTypeReport ?><br>
<TEXTAREA NAME="job" Content-Type="text/html"
	COLS="60" ROWS="10"></TEXTAREA>
<p>
</td>
</tr>

</table>
<p>

<input type="submit" name="versand" value="<?=$LDSendReport ?>"  >  
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
<a href="technik-questions.php?sid=<?=$ck_sid ?>"><?=$LDQuestionsTxt ?></a><br>
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
