<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','place.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile=$root_path."main/spediens.php".URL_APPEND;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDAddress :: $LDManager" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('address_manage.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
  <p><br>
  
  <table border=0 cellpadding=5>
    <tr>
      <td><!-- <a href="citytown_new.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'form_pen.gif','0'); ?>></a> --></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2 >
	  		<a href="citytown_new.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDNewData; ?></font></b></a><br>
	  		<?php echo $LDNewDataTxt ?></td>
    </tr>
    <tr>
      <td><!-- <a href="citytown_list.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'form_pen.gif','0'); ?>></a> --></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2 >
	  		<a href="citytown_list.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDListAll ?></font></b></a><br>
			<?php echo $LDListAllTxt ?></td>
    </tr>
    <tr>
      <td><!-- <a href="citytown_search.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'search_glass.gif','0'); ?>></a> --></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2 >
	  	<a href="citytown_search.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDSearch ?></font></b></a><br>
			<?php echo $LDSearchTxt ?></td>
    </tr>
  </table>
  
  
</FONT>
<p>
<ul>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> border="0"></a>
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
</BODY>
</HTML>
