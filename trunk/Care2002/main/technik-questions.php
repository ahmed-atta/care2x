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

$thisfile='technik-questions.php';
$breakfile='technik.php?sid='.$sid.'&lang='.$lang;

$deptnames=get_meta_tags("../global_conf/$lang/doctors_abt_list.pid");

/**
* Resolve the department's acronym to it proper name
*/
$checkdept=1;
require('../include/inc_resolve_dept_dept.php');

if(!isset($inquirer)||empty($inquirer))
{
	if(isset($HTTP_GET_VARS['inquirer'])&&!empty($HTTP_GET_VARS['inquirer'])) 
	{
	    $inquirer=$HTTP_GET_VARS['inquirer'];
    }
	elseif(isset($HTTP_POST_VARS['inquirer'])&&!empty($HTTP_POST_VARS['inquirer'])) 
	{
	    $inquirer=$HTTP_POST_VARS['inquirer'];
    }
	else
	{
	     $inquirer=$HTTP_COOKIE_VARS['ck_login_username'.$sid];
	}
}

$dbtable='care_tech_questions';

include('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{
    /* Load the date formatter */
    include_once('../include/inc_date_format_functions.php');
    

			if($mode=='save')
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
							'".htmlspecialchars($HTTP_POST_VARS['query'])."',
							'$inquirer',
							'".$HTTP_POST_VARS['tphone']."', 
							'".$HTTP_POST_VARS['tdate']."', 
							'".$HTTP_POST_VARS['ttime']."', 
							'0'	)";
						if(mysql_query($sql,$link))
						{ 
							mysql_close($link);
							header("Location: ".strtr("technik-questions.php?sid=$sid&lang=$lang&dept=$dept&inquirer=$inquirer"," ","+")); 
							exit;
						}
			 			else {echo "<p>".$sql."$LDDbNoSave<br>"; };
			}
						
			if($mode=='read')
			{
				$sql="SELECT tdate,ttime,inquirer,query,answered,reply,ansby,astamp FROM $dbtable
							 WHERE inquirer='$inquirer'
							 		AND dept='".$HTTP_GET_VARS['dept']."'
									AND tdate='".$HTTP_GET_VARS['tdate']."'
									AND ttime='".$HTTP_GET_VARS['ttime']."'
									AND tid='".$HTTP_GET_VARS['tid']."'
									LIMIT 0,10"; 
        		if($result=mysql_query($sql,$link))
				{
					$inhalt=mysql_fetch_array($result);		
				}
			 	else {echo "<p>$sql $LDDbNoSave<br>"; };
			}
			
			$sql="SELECT dept,tdate,ttime,inquirer,tid,query,answered FROM $dbtable WHERE inquirer='$inquirer'  ORDER BY tid DESC LIMIT 0,10 "; 
        	if($ergebnis=mysql_query($sql,$link))
				{
					$rows=0;

					$rows = mysql_num_rows($ergebnis);
				}
			 	else {echo "<p>".$sql."$LDDbNoRead<br>"; };
}
else 
{ echo "$LDDbNoLink<br>"; } 

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

 <script language="javascript" >
<!-- 

function checkform(d)
{
	if(d.query.value=="") 
		{	alert("<?php echo $LDAlertQuestion ?>");
			return false;
		}
	if(d.inquirer.value=="") 
		{	alert("<?php echo $LDAlertName ?>");
			return false;
		}
	if(d.dept.value=="") 
		{	alert("<?php echo $LDAlertDeptOnly ?>");
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
<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10;background-color:#dedede}
</style>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('tech.php','queries')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>

<?php if (($mode=="read"))
	{
		echo '<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" >
				<tr>
				<td>
				<table  cellspacing=0 cellpadding=2 >
				<tr><td bgcolor=#999999 >	<FONT  SIZE=2 FACE="verdana,Arial" color=white>';
		echo "<b>$LDInquiry $LDFrom ".$inhalt['inquirer']." $LDOn ".formatDate2Local($inhalt['tdate'],$date_format)." $LDAt ".convertTimeToLocal($inhalt['ttime'])." $LDOClock:</b>";
		echo '	</td>
				</tr>
				<tr><td class="vn">';
		echo "	\" ".nl2br($inhalt['query'])." \"</td></tr> ";
		
		if(isset($inhalt['answered'])&&$inhalt['answered'])
		{
			echo '	<tr><td bgcolor="#999999" >	<FONT  SIZE=2 FACE="verdana,Arial" color=white>';

			echo "	<b>$LDReply $LDFrom ".$inhalt['ansby']." $LDAt ".$inhalt['astamp']." :</b>";
			echo '	</td>
					</tr>
					<tr><td  bgcolor="#ffffcc" ><FONT  SIZE=1 FACE="verdana,Arial" >';
			echo "	\" ".nl2br($inhalt['reply'])." \" ";
			echo '</td> 
				</tr>';
		}
		echo '
				</table>
				</td>
				</tr>
				</table>';
		echo "<hr>";
	}
?>
<form action="technik-questions.php">
<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" align=right width=20%>
<tr>
<td>

<table  cellspacing=0 cellpadding=2 >
<tr><td bgcolor=#999999 align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b><?php echo str_replace('~tagword~',$rows,$LDLastQuestions) ?></b>
</td>
</tr>
<tr><td class="vn">
<?php if($rows)
while ($content=mysql_fetch_array($ergebnis)) 
{
	echo "&nbsp;<b>".formatDate2Local($content['tdate'],$date_format).":</b> <a href=\"$thisfile?sid=$sid&lang=$lang&mode=read&dept=$content[dept]&tdate=$content[tdate]&ttime=$content[ttime]&inquirer=$content[inquirer]&tid=$content[tid]\">".substr($content[query],0,40)."...";
	if(isset($content['answered'])&&!empty($content['answered'])) echo '<img '.createComIcon('../','warn.gif','0').'>';
	echo '</a><p>';
}

?>
<center>
<?php echo $LDFrom ?>:
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="text" name="inquirer" size=19 maxlength=40 value="<?php echo $inquirer ?>">
<input type="hidden" name="lang" value= "<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDLogIn ?>">
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
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<b><?php echo $LDQuestions ?></b></FONT> <font size="2" face="arial"><br>
<u><a href="technik-reparatur-anfordern.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDPlsNoRequest ?></u></a></font><p>


<form ENCTYPE="multipart/form-data" action="technik-questions.php" method="post" onSubmit="return checkform(this)"> 
<table cellpadding="5" border="0" cellspacing=1>
<tr>
<td bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">
<p><?php echo $LDEnterQuestion ?>:<br>
<TEXTAREA NAME="query" Content-Type="text/html"
	COLS="50" ROWS="10"></TEXTAREA>
<p>
</td>
</tr>
<tr>

<td bgcolor=#dddddd ><FONT    SIZE=-1  FACE="Arial">

<input type="hidden" name="tdate" value="<?php echo date('Y-m-d') ?>" >
<input type="hidden" name="ttime" value= "<?php echo date('H:i:s') ?>">
<input type="hidden" name="sid" value= "<?php echo $sid ?>">
<input type="hidden" name="lang" value= "<?php echo $lang ?>">
<input type="hidden" name="mode" value="save">
<?php echo $LDName ?>:<br><input type="text" name="inquirer" size="30"  value="<?php echo $inquirer ?>"> <br>
<?php echo $LDDept ?>:<br><input type="text" name="dept" size="30" value="<?php echo $deptnames[$dept] ?>">
</td>
</tr>

</table>
<p>

<input type="submit" name="versand" value="<?php echo $LDSendInquiry ?>"  >  
<input type="reset" value="<?php echo $LDReset ?>" >
</form>

</FONT>
<p>

<a href="technik.php?sid=<?php echo "$sid&lang=$lang" ?>" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>" align="middle"></a>
<p>
<FONT    SIZE=-1  FACE="Arial">
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-reparatur-anfordern.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDReRepairTxt ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<a href="technik-reparatur-melden.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDRepairReportTxt ?></a><br>
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
