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

$breakfile="technik.php?sid=$sid&lang=$lang";
if(isset($job)&&($job!=NULL))
{
$dbtable="tech_repair_done";

	include("../include/inc_db_makelink.php");
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
							'".$HTTP_POST_VARS['dept']."',
							'".$HTTP_POST_VARS['job']."',
							'".$HTTP_POST_VARS['job_id']."',
							'".$HTTP_POST_VARS['reporter']."',
							'".$HTTP_POST_VARS['id']."', 
							'".$HTTP_POST_VARS['tdate']."', 
							'".$HTTP_POST_VARS['ttime']."', 
							'0',
							'".date(Ymd)."'	)";
						if(mysql_query($sql,$link))
						{ 
							mysql_close($link);
							header("Location: technik-reparatur-empfang.php?sid=$sid&lang=$lang&dept=".$HTTP_POST_VARS['dept']."&reporter=".$HTTP_POST_VARS['reporter']."&tdate=".$HTTP_POST_VARS['tdate']."&ttime=".$HTTP_POST_VARS['ttime']); 
							exit;
						}
			 			else {print "<p>".$sql."$LDDbNoSave<br>"; };
	}
  	 else { print "$LDDbNoLink<br>"; } 
}

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
		{	alert("<?php echo $LDAlertDept ?>");
			return false;
		}
	if(d.reporter.value=="") 
		{	alert("<?php echo $LDAlertName ?>");
			return false;
		}
	if(d.id.value=="") 
		{	alert("<?php echo $LDAlertPNr ?>");
			return false;
		}
	if(d.job.value=="") 
		{	alert("<?php echo $LDPlsDescribe ?>");
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
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('tech.php','report')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<FONT    SIZE=4  FACE="Arial" color=#00cc00>
<img src="../img/varrow.gif" width="20" height="15">
<b><?php echo $LDRepairReport ?></b></FONT> <font size="2" face="arial">
<?php echo $LDPlsDoneOnly ?></font><p>


<form ENCTYPE="multipart/form-data" action="technik-reparatur-melden.php" method="post" onSubmit="return checkform(this)"> 
<table cellpadding="5" border="0" cellspacing=1>
<tr>
<td bgcolor=#dddddd >
<FONT    SIZE=-1  FACE="Arial">

<?php echo $LDRepairArea ?>:<br>
<input type="text" name="dept" size=30 maxlength=30><p>
<?php echo $LDJobIdNr ?>:<br>
<input type="text" name="job_id" size=30 maxlength=14><br>

</td>

<td bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">

<?php echo $LDTechnician ?>:<br><input type="text" name="reporter" size=30 > <p>
<?php echo $LDPersonnelNr ?>:<br><input type="text" name="id" size=30>
<input type="hidden" name="tdate" value="<?php print strftime("%d.%m.%Y") ?>" >
<input type="hidden" name="ttime" value= "<?php print strftime("%H.%M") ?>">
<input type="hidden" name="sid" value= "<?php echo $sid ?>">
<input type="hidden" name="lang" value= "<?php echo $lang ?>">

</td>
</tr>
<tr>
<td colspan=2 bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDPlsTypeReport ?><br>
<TEXTAREA NAME="job" Content-Type="text/html"
	COLS="60" ROWS="10"></TEXTAREA>
<p>
</td>
</tr>

</table>
<p>
<input type="submit" name="versand" value="<?php echo $LDSendReport ?>"  >  
<input type="reset" value="<?php echo $LDReset ?>" >
</form>
</FONT>
<p>
<a href="technik.php?sid=<?php echo "$sid&lang=$lang" ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  width=103 height=24  alt="<?php echo $LDClose ?>" align="middle"></a>
<p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-reparatur-anfordern.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDReRepairTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-questions.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDQuestionsTxt ?></a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-info.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDInfoTxt ?></a><br>
</FONT>
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
