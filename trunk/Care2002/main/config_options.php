<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
//$local_user='aufnahme_user';
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load user configurations

$breakfile=$root_path.'main/spediens.php'.URL_APPEND;
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

<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp; <?php echo $LDUserConfigOpt; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
  <p><br>
  
  <table border=0 cellpadding=5>
    <tr>
      <td>&nbsp;&nbsp;<a href="colorchg.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'fileman.gif','0'); ?>></a></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2 >
	  		<a href="colorchg.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDColorOpt; ?></font></b></a><br>
	  		<?php echo $LDColorOptTxt ?></td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;<a href="excolorchg.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'password.gif','0'); ?>></a></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2 >
	  		<a href="excolorchg.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDColorOptExt ?></font></b></a><br>
			<?php echo $LDColorOptExtTxt ?></td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;<a href="config_options_mascot.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'forum.gif','0'); ?>></a></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2 >
	  		<a href="config_options_mascot.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDMascotOpt ?></font></b></a><br>
			<?php echo $LDMascotOptTxt ?></td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;<a href="config_options_gui_template.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'ftpmanager.gif','0'); ?>></a></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2 >
	  		<a href="config_options_gui_template.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDGUITemplate ?></font></b></a><br>
			<?php echo $LDGUITemplateTxt ?></td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;<a href="<?php echo $root_path.'index.php'.URL_APPEND;
				 				 if(($cfg['mask']==1)||($cfg['mask']=='')) echo '&mask=2'; else echo '&mask=1';?>" target="_top"><img <?php  echo createComIcon($root_path,'redirects.gif','0'); ?>></a></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2 >
	  		<a href="<?php echo $root_path.'index.php'.URL_APPEND;
				 				 if(($cfg['mask']==1)||($cfg['mask']=='')) echo '&mask=2'; else echo '&mask=1';?>" target="_top">
							<b><font color="#990000"><?php if(($cfg['mask']==1)||($cfg['mask']=='')) echo $LDDisplay2; else echo $LDDisplay1;?></font></b></a> 
				  <br>
			<?php if(($cfg['mask']==1)||($cfg['mask']=='')) echo $LDDisplay2Txt; else echo $LDDisplay1Txt; ?></td>
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
