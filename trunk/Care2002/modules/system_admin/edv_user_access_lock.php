<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';

require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='edv_user_access_list.php'.URL_APPEND;
$updatereturn='edv_user_access_list.php';
//$updatereturn='edv_user_access_list.php';
$returnfile=$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND;

//$HTTP_SESSION_VARS['sess_file_return']='edv.php';


    $sql='SELECT name, login_id, lockflag FROM care_users WHERE login_id="'.addslashes($itemname).'"';
	
	if($ergebnis=$db->Execute($sql,$link)) {	

        $zeile=$ergebnis->FetchRow();
		
		if ($finalcommand=='changelock') {	
		    
			if ($zeile['lockflag']) $newlockflag=0; 
			    else $newlockflag=1;
			
			$sql='UPDATE care_users SET lockflag='.$newlockflag.' WHERE login_id="'.$itemname.'"';	
			
			if ($db->Execute($sql)) {
				header("Location: ".$updatereturn.URL_REDIRECT_APPEND."&itemname=$itemname&remark=lockchanged"); 
                exit;
			}else { 
				echo "$LDDbNoSave<p>$sql"; 
			} 
		}
	}

  
?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?>>


<FONT    SIZE=-1  FACE="Arial">

<P>

<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDAccessRight ";  if($zeile['lockflag']) echo $LDUnlock; else echo $LDLock; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('edp.php','access','lock','<?php echo $zeile['lockflag'] ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>


<p><br>
<center>


<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffdd"><font face=verdana,arial size=2>
<p>
<?php if ($zeile['lockflag']) 
echo $LDSureUnlock; else echo $LDSureLock; ?>?<p>

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
<FORM action="edv_user_access_lock.php" method="post">
<INPUT type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="finalcommand" value="changelock">
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<INPUT type="submit" name="versand"  value="  <?php echo $LDYesSure ?>  "></font></FORM>

<FORM  method=get action="edv_user_access_list.php" >
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<INPUT type="submit"  value="<?php echo $LDNoBack ?>"></font></FORM>

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
