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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$breakfile="nursing.php?sid=".$sid."&lang=".$lang;



?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>


<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>
<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $LDNursingManage ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','main')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>

  <p><br>
  <table border=0 cellpadding=5 >
    <tr>
      <td >&nbsp;</td>
      <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b><?php echo $LDProfile ?></b></td>
      <td >&nbsp;</td>
      <!-- <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b>Kommunikation</b></td> -->
    </tr>
    <tr>
      <td></td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 ><a href="nursing-station-new.php?sid=<?php echo $sid ?>&mw=1<?php echo "&lang=$lang&station=$ck_thispc_station&name=$ck_thispc_dept" ?>"><b><?php echo $LDCreate ?></b></a><br>
	  		&nbsp;<?php echo $LDNewStation ?><p>
			<?php if ($ck_thispc_station) $mode="show"; ?>
			<a href="nursing-station-info.php?sid=<?php echo "$sid&lang=$lang&mode=$mode&station=$ck_thispc_station" ?>"><b><?php echo $LDShowStationData ?></b></a><br>
			<?php echo $LDShowStationDataTxt ?><p>
			<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><b><?php echo $LDLockBed ?></b></a><br>
			<?php echo $LDLockBedTxt ?><p>
			<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><b><?php echo $LDAccessRights ?></b></a><br>
			<?php echo $LDAccessRightsTxt ?>
			</td>
      <td></td>
    </tr>
  </table>
  
</FONT>
<p>
<ul>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>" border="0"></a>
</ul>
</td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?>  colspan=2>

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
