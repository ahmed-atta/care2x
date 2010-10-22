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

if(!isset($_SESSION['sess_path_referer'])) $_SESSION['sess_path_referer']='';
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

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo 'Maternity reports' ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('maternity.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr  valign=top> 
    <td> 
	
      <!--    here is the form start   -->
	  
	  <table border="0" align="center" cellspacing="9" cellpadding="5" width="100%">
	  <tr>
	  	<td>
		  <table cellpadding=3 cellspacing=1>
              <tbody class="submenu">
			  <tr>
                  <td width="600" class="submenu" colspan="3"><?php echo 'Reports Available:'; ?> </td>
                </tr>
                <tr>
                  <td width="17" align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td width="600" class="submenu_item"><a href="maternity_pregnancy_outcome.php"><?php echo 'Pregnancy Outcome'; ?></a> </td>
                  <td width="200"><?php echo '&nbsp;'; ?></td>
                </tr>
				
				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="maternity_mother_info.php"><?php echo 'Mother information'; ?></a></td>
                  <td><?php echo '&nbsp;'; ?></td>
                </tr>

				<tr>	
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="maternity_singleton_childinfo.php"><?php echo 'Singleton Child Information'; ?></a></td>
                  <td><?php echo '&nbsp;'; ?></td>
                </tr>
				
				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="maternity_multiple_childinfo.php"><?php echo 'Multiple Children Information'; ?></a></td>
                  <td><?php echo '&nbsp;'; ?></td>
                </tr>
				
				
              </tbody>
            </table>
			
			</td>
		  </tr>
		</table>
		
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

