<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$deptnames=get_meta_tags($root_path."global_conf/$lang/doctors_abt_list.pid");

include($root_path.'include/inc_resolve_dept_dept.php');

$breakfile='technik.php'.URL_APPEND;
$returnfile=$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND;
$HTTP_SESSION_VARS['sess_file_return']=basename(__FILE__);

if(!isset($HTTP_COOKIE_VARS['ck_thispc_station'])) $HTTP_COOKIE_VARS['ck_thispc_station']='';
if(!isset($HTTP_COOKIE_VARS['ck_thispc_room'])) $HTTP_COOKIE_VARS['ck_thispc_room']='';
if(!isset($HTTP_COOKIE_VARS['ck_thispc_dept'])) $HTTP_COOKIE_VARS['ck_thispc_dept']='';
if(!isset($HTTP_COOKIE_VARS['ck_thispc_phone'])) $HTTP_COOKIE_VARS['ck_thispc_phone']='';
if(!isset($HTTP_COOKIE_VARS['ck_login_username'.$sid])) $HTTP_COOKIE_VARS['ck_login_username'.$sid]='';

if(!isset($dept)) $dept='';

if(isset($job)&&!empty($job)) {

    $dbtable='care_tech_repair_job';

    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {
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
							
        $db->BeginTrans();
        $ok=$db->Execute($sql);
        if($ok && $db->CommitTrans()) { 
            header("Location: technik-reparatur-empfang.php".URL_REDIRECT_APPEND."&repair=ask&dept=$dept&reporter=$reporter&tdate=$tdate&ttime=$ttime"); exit;
        } else {
            $db->RollbackTrans();
            echo "<p>".$sql."$LDDbNoSave<br>"; 
        };
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
		    d.dept.focus();
			return false;
		}
	if(d.reporter.value=="") 
		{	alert("<?php echo $LDAlertName ?>");
		    d.reporter.focus();
			return false;
		}
	if(d.id.value=="") 
		{	alert("<?php echo $LDAlertPNr ?>");
		    d.id.focus();
			return false;
		}
	if(d.job.value=="") 
		{	alert("<?php echo $LDPlsDescribe ?>");
		    d.job.focus();
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
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('tech.php','request')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<FONT    SIZE=4  FACE="Arial" color=red>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<b><?php echo $LDReRepairTxt ?></b></FONT>

<form  action="technik-reparatur-anfordern.php" method="post" onSubmit="return checkform(this)"> 
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
<input type="image"  <?php echo createLDImgSrc($root_path,'send.gif','0') ?>  >  
</form>


<p>
<a href="<?php echo $breakfile; ?>" ><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDClose ?>" align="middle"></a>
<p>
<FONT    SIZE=-1  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-reparatur-melden.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDRepairReportTxt ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
<a href="technik-questions.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo $LDQuestionsTxt ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>>
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
require($root_path.'include/inc_load_copyrite.php');
?>

</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
