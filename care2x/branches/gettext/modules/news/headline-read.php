<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','news');
define('LANG_FILE_MODULAR','news.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$returnfile='headline-edit-select-art.php'.URL_APPEND;
$breakfile=$root_path.$_SESSION['sess_file_break'].URL_APPEND;

//$_SESSION['sess_file_return']='start_page.php';

# Get the news article
require_once($root_path.'modules/news/model/class_news.php');
$newsobj=new News;
$news=&$newsobj->getNews($nr);

# Get the news global configurations

require_once('includes/inc_news_display_config.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Hide the title bar
 $smarty->assign('bHideTitleBar',TRUE);

 # Window title
 $smarty->assign('title',$title);

 $smarty->assign('news_normal_display_width',$news_normal_display_width);

 # Headline title
 $smarty->assign('LDHeadline',$LDHeadline);


if($mode=="preview4saved"){
echo '---';
	$smarty->assign('bShowPrompt',TRUE);

    $smarty->assign('LDArticleSaved', $LDArticleSaved);
}

require('includes/inc_news_display_one.php');

if(!isset($picalign) || empty($picalign)) {
	$smarty->assign('sNewsBodyTemplate','news/headline_newslist_item.tpl');
}else{
	if(!($news['art_num']%2)) $smarty->assign('sNewsBodyTemplate','news/headline_newslist_item2.tpl');
		else $smarty->assign('sNewsBodyTemplate','news/headline_newslist_item.tpl');
}


# Collect html for the submenu blocks

ob_start();

	include('includes/inc_rightcolumn_menu.php');
	# Stop buffering, get contents

	$sTemp = ob_get_contents();
ob_end_clean();

# assign contents to subframe

$smarty->assign('sSubMenuBlock',$sTemp);

# Assign the subframe template file name to mainframe

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/headline_news.tpl');

  /**
 * show Template
 */

 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>