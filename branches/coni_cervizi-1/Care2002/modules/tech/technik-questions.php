<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='departments.php';
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
$breakfile='technik.php'.URL_APPEND;
$returnfile=$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND;
$HTTP_SESSION_VARS['sess_file_return']=basename(__FILE__);

if(!isset($mode)) $mode='';

# Resolve department
require_once($root_path.'include/inc_resolve_dept.php');
# Resolve ward
require_once($root_path.'include/inc_resolve_ward.php');

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
/*	else
	{
	     $inquirer=$HTTP_SESSION_VARS['sess_user_name'];
	}
*/}

$dbtable='care_tech_questions';

if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok) {
    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    

    if($mode=='save') {
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
						if($db->Execute($sql))
						{ 
						    $inquirer=strtr($inquirer,' ','+');
							header("Location: technik-questions.php".URL_REDIRECT_APPEND."&dept=$dept&inquirer=$inquirer"); 
							exit;
						}
			 			else {echo "<p>".$sql."$LDDbNoSave<br>"; };
    }
						
    if($mode=='read') {
/*        $sql="SELECT tdate,ttime,inquirer,query,answered,reply,ansby,astamp FROM $dbtable
							 WHERE inquirer='$inquirer'
							 		AND dept='".$HTTP_GET_VARS['dept']."'
									AND tdate='".$HTTP_GET_VARS['tdate']."'
									AND ttime='".$HTTP_GET_VARS['ttime']."'
									AND tid='".$HTTP_GET_VARS['tid']."'
									LIMIT 0,10"; 
*/        $sql="SELECT tdate,ttime,inquirer,query,answered,reply,ansby,astamp FROM $dbtable
							 WHERE batch_nr='".$HTTP_GET_VARS['batch_nr']."'
									LIMIT 0,10"; 
        if($result=$db->Execute($sql)) {
            $inhalt=$result->FetchRow();		
        } else {echo "<p>$sql $LDDbNoSave<br>"; };
    }
			
    $sql="SELECT batch_nr,dept,tdate,ttime,inquirer,tid,query,answered FROM $dbtable WHERE inquirer='$inquirer'  ORDER BY tid DESC LIMIT 0,6 "; 
    if($ergebnis=$db->Execute($sql)) {
        $rows = $ergebnis->RecordCount();
    } else {echo '<p>'.$sql.$LDDbNoRead.'<br>'; };
} else { echo "$LDDbNoLink<br>"; } 

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

 <script language="javascript" >
<!-- 

function checkform(d)
{
	if(d.query.value=="") 
		{	alert("<?php echo $LDAlertQuestion ?>");
			d.query.focus();
			return false;
		}
	if(d.inquirer.value=="") 
		{	alert("<?php echo $LDAlertName ?>");
			d.inquirer.focus();
			return false;
		}
	if(d.dept.value=="") 
		{	alert("<?php echo $LDAlertDeptOnly ?>");
			d.dept.focus();
			return false;
		}
	return true;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="<?php echo $root_path; ?>main/help-router.php<?php echo URL_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<?php 
require($root_path.'include/inc_css_a_hilitebu.php');
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
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('tech.php','queries')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>

<?php if (($mode=='read'))
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

			echo "	<b>$LDReply $LDFrom ".$inhalt['ansby']." $LDOn ".formatDate2Local($inhalt['astamp'],$date_format,1)." $LDOClock:</b>";
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
while ($content=$ergebnis->FetchRow()) 
{
	//echo "&nbsp;<b>".formatDate2Local($content['tdate'],$date_format).":</b> <a href=\"$thisfile".URL_APPEND."&mode=read&dept=".$content['dept']."&tdate=".$content['tdate']."&ttime=".$content['ttime']."&inquirer=".$content['inquirer']."&tid=".$content['tid']."\">".substr($content[query],0,40)."...";
	echo "&nbsp;<b>".formatDate2Local($content['tdate'],$date_format).":</b> <a href=\"$thisfile".URL_APPEND."&mode=read&batch_nr=".$content['batch_nr']."&dept_nr=".$dept_nr."&inquirer=".strtr($inquirer,' ','+')."\">".substr($content[query],0,40)."...";
	if(isset($content['answered'])&&!empty($content['answered'])) echo '<img '.createComIcon($root_path,'warn.gif','0').'>';
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
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<b><?php echo $LDQuestions ?></b></FONT> <font size="2" face="arial"><br>
<u><a href="technik-reparatur-anfordern.php<?php echo URL_APPEND ?>"><?php echo $LDPlsNoRequest ?></u></a></font><p>


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
<?php echo $LDName ?>:<br><input type="text" name="inquirer" size="30"  value="<?php if($inquirer) echo $inquirer; elseif(isset($HTTP_SESSION_VARS['sess_user_name'])) echo $HTTP_SESSION_VARS['sess_user_name'] ?>"> <br>
<?php echo $LDDept ?>:<br><input type="text" name="dept" size="30" value="<?php echo $dept_name ?>">
</td>
</tr>

</table>
<p>

<input type="image"  <?php echo createLDImgSrc($root_path,'abschic.gif','0','middle') ?> >&nbsp;&nbsp;&nbsp;<a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'cancel.gif','0','middle') ?> alt="<?php echo $LDCancel ?>" align="middle"></a>

</form>

</FONT>
<p>

<FONT    SIZE=-1  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-reparatur-anfordern.php<?php echo URL_APPEND ?>"><?php echo $LDReRepairTxt ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-reparatur-melden.php<?php echo URL_APPEND ?>"><?php echo $LDRepairReportTxt ?></a><br>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-info.php<?php echo URL_APPEND ?>"><?php echo $LDInfoTxt ?></a><br>
 --></FONT>
</ul>
</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        

</FONT>
</BODY>
</HTML>
