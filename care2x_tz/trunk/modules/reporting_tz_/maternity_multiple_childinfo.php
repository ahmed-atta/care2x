<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/

define('LANG_FILE','maternity.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
$_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);
$_SESSION['sess_user_origin']='amb';
$_SESSION['sess_parent_mod']='';

require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward;
$items='nr,name';
$ward_info=&$ward_obj->getAllWardsItemsObject($items);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css">
<!--
.boda {
	border: 1px none #CCCCCC;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	text-decoration: none;
}
-->
</style>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo $LDSReportMultipleChildInfo; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('maternity.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr  valign=top> 
    <td colspan="2"> 
	
      <!--    here is the form start   -->
<table cellspacing="5" align="center" border="0"><tr><td>&nbsp;
</td></tr>

<tr><td>
<?php require('maternity_year_selector.php');?>
</td></tr>

<tr><td>

<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" class="boda">
  <tr align="center" valign="middle"> 
    <td width="97" rowspan="2" bordercolor="#666666" bgcolor="#CCCCCC"><div align="center"><strong>Quarter</strong></div></td>
    <td width="176" rowspan="2" bgcolor="#CCCCCC"><strong>Total Number of Children</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Still Births</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Born then Died</strong></td>
  </tr>
  <tr> 
    <td width="173" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Macerated</strong></td>
    <td width="147" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Fresh</strong></td>
    <td width="147" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Before 24Hrs</strong></td>
    <td width="186" align="center" valign="middle" bgcolor="#CCCCCC"><strong>After 24Hrs</strong></td>
  </tr>
  <tr> 
    <td bordercolor="#666666">1St Quarter</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td bordercolor="#666666">2nd Quarter</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td bordercolor="#666666">3rd Quarter</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td bordercolor="#666666">4th Quarter</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td bordercolor="#666666"><strong>Total</strong></td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
</table>

    <td>&nbsp;</td>
  </tr>
    <tr><td align="center">
<a href="javascript:printOut(<?php echo $start_timeframe.",".$end_timeframe.",".$group_id;?>)"><img border=0 src=../martenity/img/maternity_print_out.gif></a><br>
  </td></tr>

</table>
		</td></tr></table>
      <!--    here is the form start   -->
	  
    </td>
  </tr>
<tr>

<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>    
</table>
</body>
</html>

