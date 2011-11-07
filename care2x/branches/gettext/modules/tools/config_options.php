<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','tools');
define('LANG_FILE_MODULAR','tools.php');
//$local_user='aufnahme_user';
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
$breakfile=$root_path.'main/plugin.php'.URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDUserConfigOpt);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
# href for the  button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/config_user.html"); 
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDUserConfigOpt);
 
 # Prepare the alternative window url param
  if(($cfg['mask']==1)||($cfg['mask']=='')){
		$sMask = '&mask=2';
	}else{
		$sMask = '&mask=1';
	}

 # Assign the options links

 $smarty->assign('LDColorOpt','<a href="'.$root_path.'modules/tools/colorchg.php'.URL_APPEND.'">'.$LDColorOpt.'</a>');
 $smarty->assign('LDColorOptExt','<a href="'.$root_path.'modules/tools/excolorchg.php'.URL_APPEND.'">'.$LDColorOptExt.'</a>');
 $smarty->assign('LDMainMenuTree','<a href="config_options_mainmenu_tree.php'.URL_APPEND.'">'.$LDMainMenuTree.'</a>');
 $smarty->assign('LDGUITemplate','<a href="config_options_gui_template.php'.URL_APPEND.'">'.$LDGUITemplate.'</a>');
 $smarty->assign('LDComIcons','<a href="config_options_icons.php'.URL_APPEND.'">'.$LDComIcons.'</a>');
 $smarty->assign('LDCssThemes','<a href="config_options_css.php'.URL_APPEND.'">'.$LDCssThemes.'</a>');
 $smarty->assign('LDSmartyTemplate','<a href="config_options_smarty.php'.URL_APPEND.'">'.$LDSmartyTemplate.'</a>');

 if(($cfg['mask']==1)||($cfg['mask']==''))  $smarty->assign('LDDisplay','<a href="'.$root_path.'index.php'.URL_APPEND.$sMask.'" target="_top">'.$LDDisplay2.'</a>');
 	else $smarty->assign('LDDisplay','<a href="'.$root_path.'index.php'.URL_APPEND.$sMask.'" target="_top">'.$LDDisplay1.'</a>');

# Assign the description text

 $smarty->assign('LDColorOptTxt',$LDColorOptTxt);
 $smarty->assign('LDColorOptExtTxt',$LDColorOptExtTxt);
 $smarty->assign('LDMainMenuTreeTxt',$LDMainMenuTreeTxt);
 $smarty->assign('LDGUITemplateTxt',$LDGUITemplateTxt);
 $smarty->assign('LDControlButtonsTxt',$LDControlButtonsTxt);
 $smarty->assign('LDComIconsTxt',$LDComIconsTxt);
 $smarty->assign('LDCssThemesTxt',$LDCssThemesTxt);
 $smarty->assign('LDSmartyTemplateTxt',$LDSmartyTemplateTxt);

  if(($cfg['mask']==1)||($cfg['mask']==''))  $smarty->assign('LDDisplayTxt',$LDDisplay2Txt);
 	else $smarty->assign('LDDisplayTxt',$LDDisplay1Txt);

# Assign the image icons

 $smarty->assign('LDColorOptImg','<a href="'.$root_path.'modules/tools/colorchg.php'.URL_APPEND.'"><img '.createComIcon($root_path,'fileman.gif','0','',FALSE).'></a>');
 $smarty->assign('LDColorOptExtImg','<a href="'.$root_path.'modules/tools/excolorchg.php'.URL_APPEND.'"><img '.createComIcon($root_path,'password.gif','0','',FALSE).'></a>');
 $smarty->assign('LDMainMenuTreeImg','<a href="config_options_mainmenu_tree.php'.URL_APPEND.'"><img '.createComIcon($root_path,'ftpmanager.gif','0','',FALSE).'></a>');
 $smarty->assign('LDGUITemplateImg','<a href="config_options_gui_template.php'.URL_APPEND.'"><img '.createComIcon($root_path,'ftpmanager.gif','0','',FALSE).'></a>');
 $smarty->assign('LDComIconsImg','<a href="config_options_icons.php'.URL_APPEND.'"><img '.createComIcon($root_path,'forum.gif','0','',FALSE).'></a>');
 $smarty->assign('LDCssThemesImg','<a href="config_options_css.php'.URL_APPEND.'"><img '.createComIcon($root_path,'password.gif','0','',FALSE).'></a>');
 $smarty->assign('LDSmartyTemplateImg','<a href="config_options_smarty.php'.URL_APPEND.'"><img '.createComIcon($root_path,'fileman.gif','0','',FALSE).'></a>');

  if(($cfg['mask']==1)||($cfg['mask']==''))  $smarty->assign('LDDisplayImg','<a href="'.$root_path.'index.php'.URL_APPEND.$sMask.'" target="_top"><img '.createComIcon($root_path,'redirects.gif','0','',FALSE).'></a>');
 	else $smarty->assign('LDDisplayImg','<a href="'.$root_path.'index.php'.URL_APPEND.$sMask.'" target="_top"><img '.createComIcon($root_path,'redirects.gif','0','',FALSE).'></a>');

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/config_options.tpl');
 /**
 * show Template
 */

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

 ?>