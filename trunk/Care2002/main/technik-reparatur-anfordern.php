<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

$deptnames=get_meta_tags("../global_conf/$lang/doctors_abt_list.pid");
include('../include/inc_resolve_dept_dept.php');

$breakfile='technik.php?sid='.$sid.'&lang='.$lang;

if($job!=NULL)
{
$dbtable='care_tech_repair_job';

	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
		{
						$sql="INSERT INTO ".$dbtable." 
						(	dept,
							job,
							reporter,
							id,
							tphone,
							tdate,
							ttime,
							done,
							d_idx,
							status
							 ) 
						VALUES 
						(
							'".htmlspecialchars($dept)."',
							'".htmlspecialchars($job)."',
							'".htmlspecialchars($reporter)."',
							'".htmlspecialchars($id)."', 
							'".htmlspecialchars($tphone)."',
							'$tdate', 
							'$ttime', 
							'0',
							'".date('Ymd')."',
							'pending'
							)";
							
						if(mysql_query($sql,$link))
						{ 
							mysql_close($link);
							header("Location: technik-reparatur-empfang.php?sid=$sid&lang=$lang&repair=ask&dept=$dept&reporter=$reporter&tdate=$tdate&ttime=$ttime"); exit;
						}
			 			else {echo "<p>".$sql."$LDDbNoSave<br>"; };
	}
  	 else { echo "$LDDbNoLink<br>"; } 
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
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
require('../include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('tech.php','request')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<FONT    SIZE=4  FACE="Arial" color=red>
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<b><?php echo $LDReRepairTxt ?></b></FONT>

<form ENCTYPE="multipart/form-data" action="technik-reparatur-anfordern.php" method="post" onSubmit="return checkform(this)"> 
<table cellpadding="5"  border="0" cellspacing=1>
<tr>
<td bgcolor=#ffffcc valign="top">
<FONT    SIZE=-1  FACE="Arial">
<?php echo $LDRepairArea ?>:<br>
<input name="dept" type="text" value="<?php echo strtoupper($HTTP_COOKIE_VARS['ck_thispc_station'])." - ".$HTTP_COOKIE_VARS['ck_thispc_room']." - ".$deptnames[$dept] ?>" size="30" maxlength="25">

</td>

<td bgcolor=#ffffcc ><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDReporter ?>:<br><input type="text" name="reporter" size="30" value="<?php echo $HTTP_COOKIE_VARS['ck_login_username'.$sid] ?>"> <br>
<?php echo $LDPersonnelNr ?>:<br><input type="text" name="id" size="30" value=""><br>
<?php echo $LDPhoneNr ?>:<br><input type="text" name="tphone" size="30" value="<?php echo $HTTP_COOKIE_VARS['ck_thispc_phone'] ?>">
</td>
</tr>
<tr>
<td colspan=2 bgcolor=#ffffcc ><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDPlsDescribe ?>:<br>
<TEXTAREA NAME="job" Content-Type="text/html"
	COLS="60" ROWS="10"></TEXTAREA>
<p>
</td>
</tr>

</table>
<p>

<input type="hidden" name="tdate" value="<?php echo date('Y-m-d') ?>" >
<input type="hidden" name="ttime" value= "<?php echo date('H:i:s') ?>">
<input type="hidden" name="sid" value= "<?php echo $sid ?>">
<input type="hidden" name="lang" value= "<?php echo $lang ?>">
<input type="submit"  value="<?php echo $LDSendRequest ?>"  >  
<input type="reset" value="<?php echo $LDReset ?>" >
</form>


<p>
<a href="technik.php?sid=<?php echo "$sid&lang=$lang" ?>" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>" align="middle"></a>
<p>
<FONT    SIZE=-1  FACE="Arial">
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-reparatur-melden.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDRepairReportTxt ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-questions.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDQuestionsTxt ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-info.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDInfoTxt ?></a><br>
</FONT>

</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
