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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences

$breakfile="pflege.php?sid=".$sid."&lang=".$lang;



?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

 <script language="javascript" >
<!-- 
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
<?php echo $test ?>
<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?php echo $LDNursingManage ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','main')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 ><a href="pflege-station-new.php?sid=<?php echo $sid ?>&mw=1<?php echo "&lang=$lang&station=$ck_thispc_station&name=$ck_thispc_dept" ?>"><b><?php echo $LDCreate ?></b></a><br>
	  		&nbsp;<?php echo $LDNewStation ?><p>
			<?php if ($ck_thispc_station) $mode="show"; ?>
			<a href="pflege-station-info.php?sid=<?php echo "$sid&lang=$lang&mode=$mode&station=$ck_thispc_station" ?>"><b><?php echo $LDShowStationData ?></b></a><br>
			<?php echo $LDShowStationDataTxt ?><p>
			<a href="ucons.php<?php echo "?lang=$lang" ?>"><b><?php echo $LDLockBed ?></b></a><br>
			<?php echo $LDLockBedTxt ?><p>
			<a href="ucons.php<?php echo "?lang=$lang" ?>"><b><?php echo $LDAccessRights ?></b></a><br>
			<?php echo $LDAccessRightsTxt ?>
			</td>
      <td></td>
    </tr>
  </table>
  
</FONT>
<p>
<ul>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>" border="0"></a>
</ul>
</td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?>  colspan=2>

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
