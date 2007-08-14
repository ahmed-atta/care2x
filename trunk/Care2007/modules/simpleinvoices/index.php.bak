<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

require($root_path.'include/inc_environment_global.php');


//error_reporting(E_ALL);
//ini_set("display_errors","1");

/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

define('LANG_FILE','index.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/inc_2level_reset.php');

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);
# Erase the cookie 
//if(isset($HTTP_COOKIE_VARS['ck_doctors_dienstplan_user'.$sid])) setcookie('ck_doctors_dienstplan_user'.$sid,'',0,'/');
# erase the user_origin 
if(isset($HTTP_SESSION_VARS['sess_user_origin'])) $HTTP_SESSION_VARS['sess_user_origin']='';




//stop browsing to files directly - all viewing to be handled by index.php
//if browse not defined then the page will exit
define("BROWSE","browse");

$module = isset($_GET['module'])?$_GET['module']:null;
$view = isset($_GET['view'])?$_GET['view']:null;
$action = isset($_GET['case'])?$_GET['case']:null;

require_once("./include/smarty/Smarty.class.php");

$smarty = new Smarty();
$smarty -> compile_dir = "./cache/";

include('./include/language.php');

include("./include/include_main.php");
include('./modules/options/database_sqlpatches.php');


$smarty -> assign("LANG",$LANG);
//For Making easy enabled pop-menus (see biller)
$smarty -> assign("enabled",array($LANG['disabled'],$LANG['enabled']));

$menu = true;
$file = "home";


if(getNumberOfPatches() > 0 ) {
	$view = "database_sqlpatches";
	$module = "options";
	
	if($action == "run") {
		runPatches();
	}
	else {
		listPatches();
	}
	$menu = false;
}



/*dont include the header if requested file is an invoice template - for print preview etc.. header is not needed */
if (($module == "reports" )) {
	if(($view=="consult") || ($view=="department") || ($view=="insurance") || ($view=="staff") || ($view=="patient"))
	{
	if(file_exists("./modules/reports/$view.php"))
	{
		include("./modules/reports/$view.php");
	}
	else
	{
		echo"The file that you requested doesn't exist";
	}
	exit(0);
	}
}
if (($module == "invoices" ) && (strstr($view,"templates"))) {
	//TODO: why is $view templates/template?...
	if (file_exists("./modules/invoices/template.php")) {
	        include("./modules/invoices/template.php");
	}
	else {
		echo "The file that you requested doesn't exist";
	}
	
	exit(0);
}


$path = "$module/$view";

if(file_exists("./modules/$path.php")) {
	
	preg_match("/^[a-z|_]+\/[a-z|_]+/",$path,$res);

	if(isset($res[0]) && $res[0] == $path) {
		$file = $path;
	}	
}



$smarty -> display("../templates/default/header.tpl");
if($menu) {
	$smarty -> display("../templates/default/menu.tpl");
}

$smarty -> display("../templates/default/main.tpl");

include_once("./modules/$file.php");

//Shouldn't be necessary anymore. Ist for old files without tempaltes...

if(file_exists("./templates/default/$file.tpl")) {
	
	$path = "../templates/default/$module/";
	$smarty->assign("path",$path);
	$smarty -> display("../templates/default/$file.tpl");
}
// If no smarty template - add message - onyl uncomment for dev - commented out for release
else {
	error_log("NOTEMPLATE!!");
}

$smarty -> display("../templates/default/footer.tpl");

?>
