<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');

$breakfile='edv.php'.URL_APPEND;
$returnfile=$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND;
$HTTP_SESSION_VARS['sess_file_return']='edv.php';

/* Establish db connection */
if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');

if($dblink_ok) {
	
    $sql='SELECT name, login_id FROM care_users WHERE login_id="'.$itemname.'"';

    if($ergebnis=$db->Execute($sql)) {

	    if ($finalcommand=='delete') {
			
		    $sql='DELETE FROM care_users WHERE login_id="'.$itemname.'"';	
			
			$db->BeginTrans();
			$ok=$db->Execute($sql);
			if($ok&&$db->CommitTrans()) {
                header("Location: edv_user_access_list.php?sid=$sid&lang=$lang&remark=itemdelete"); 
				exit;
            } else {
			    $db->RollbackTrans();
				echo '<p>'.$LDDbNoDelete.'<p>';
			}
        }
        elseif ($ergebnis->RecordCount()) {
            $zeile=$ergebnis->FetchRow();
        };
    }
}
else { 
    echo "$LDDbNoLink<br>$sql"; 
}
?>
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="<?php echo $root_path; ?>help-router.php<?php echo URL_REDIRECT_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?>>
<FONT    SIZE=-1  FACE="Arial">
<P>
<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDAccessRight $LDDelete"; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('edp.php','access','delete')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>

<p><br>
<center>
<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffdd"><font face=verdana,arial size=2>
<p>
<?php echo $LDSureDelete ?><p>

<table border="0" cellpadding="5" cellspacing="1">
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDName ?>:
</td><td><font face=verdana,arial size=2 color=#800000>
<?php
echo $zeile['name'];
?>
</td>
</tr>
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDUserId ?>:</td>
<td><font face=verdana,arial size=2 color=#800000>
<?php
echo $zeile['login_id'];
?>
</td>
</tr>
<!-- <tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDPassword ?>:</td>
<td><font face=verdana,arial size=2 color=#800000>
<?php
echo $zeile['password'];
?>
</td>
</tr> -->
</table>

<br>
<FORM action="edv_user_access_delete.php" method="post">
<INPUT type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="finalcommand" value="delete">
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<INPUT type="submit" name="versand" value="<?php echo $LDYesDelete ?>"></font></FORM>
<p>
<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>  alt="<?php echo $LDCancel ?>" align="middle"></a>

</center>

</td>
</tr>
</table>        

<p><br>

</td>
</tr>
</table>        

<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
