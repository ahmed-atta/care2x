<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');

// Default value for the maximum nr of rows per block displayed, define this to the value you wish
// In normal cases this value is derived from the db table "care_config_global" using the "pagin_address_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

define('MODULE','address');
define('LANG_FILE_MODULAR','place.php');
$local_user = 'aufnahme_user';
require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');

// Load the address object
require_once('model/class_address.php');
$address_obj = new Address;

$breakfile='address_manage.php'.URL_APPEND;
$thisfile = basename(__FILE__);

# Initialize page's control variables
if($mode != 'paginate'){
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	# Set the sort parameters
	if(empty($oitem)) $oitem = 'name';
	if(empty($odir)) $odir = 'ASC';
}

$GLOBAL_CONFIG=array();
include_once(CARE_BASE.'/include/core/class_globalconfig.php');
$glob_obj = new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('pagin_address_list_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_address_list_max_block_rows'])) 
	$GLOBAL_CONFIG['pagin_address_list_max_block_rows'] = MAX_BLOCK_ROWS; 

//Load and create paginator object
require_once(CARE_BASE.'/include/core/class_paginator.php');
$pagen = new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],CARE_BASE);
// Adjust the max nr of rows in a block
$pagen->setMaxCount($GLOBAL_CONFIG['pagin_address_list_max_block_rows']);

// Get all the active firms info
$address = $address_obj->getLimitActiveCityTown($GLOBAL_CONFIG['pagin_address_list_max_block_rows'],$pgx,$oitem,$odir);

$linecount = $address_obj->LastRecordCount();
$pagen->setTotalBlockCount($linecount);
// Count total available data
if( isset($totalcount) && $totalcount ){
	$pagen->setTotalDataCount($totalcount);
}else{
	$totalcount = $address_obj->countAllActiveCityTown();
	$pagen->setTotalDataCount($totalcount);
}

$pagen->setSortItem($oitem);
$pagen->setSortDirection($odir);

// Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
$smarty = new smarty_care('system_admin');

$smarty->assign('URL_APPEND',URL_APPEND);

// Title in toolbar
$smarty->assign('sToolbarTitle',"$LDAddress :: $LDListAll");
$smarty->assign('LDBack', $LDBack);
$smarty->assign('LDHelp', $LDHelp);
$smarty->assign('LDClose', $LDClose);

// href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/address_list.html");

// href for close button
$smarty->assign('breakfile',$breakfile);

// Window bar title
$smarty->assign('sWindowTitle',"$LDAddress :: $LDListAll");

if(is_object($address)){
	if ($linecount) { 
		$resultsFound =  str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
	} else { 
		$resultsFound =  str_replace('~nr~','0',$LDSearchFound); 
	}
	
	$smarty->assign('resultsFound',$resultsFound);
	
	if($oitem == 'name') $flag=TRUE;
	else $flag = FALSE; 
	$nameTitle = $pagen->SortLink($LDCityTownName,'name',$odir,$flag); 
	$smarty->assign('nameTitle',$nameTitle);
	
	if($oitem == 'zip_code') $flag=TRUE;
	else $flag = FALSE; 
	$zipTitle = $pagen->SortLink($LDZipCode,'zip_code',$odir,$flag); 
	$smarty->assign('zipTitle',$zipTitle);
	
	if($oitem == 'iso_country_id') $flag=TRUE;
	else $flag = FALSE; 
	$isoTitle = $pagen->SortLink($LDISOCountryCode,'iso_country_id',$odir,$flag); 
	$smarty->assign('isoTitle',$isoTitle);
	
	if($oitem == 'unece_locode_type') $flag=TRUE;
	else $flag = FALSE; 
	$uneceTitle = $pagen->SortLink($LDUNECELocalCode,'unece_locode_type',$odir,$flag); 
	$smarty->assign('uneceTitle',$uneceTitle);
	
	if($oitem == 'info_url') $flag=TRUE;
	else $flag = FALSE; 
	$infoTitle = $pagen->SortLink($LDWebsiteURL,'info_url',$odir,$flag); 
	$smarty->assign('infoTitle',$infoTitle);
	
	$smarty->assign('address',$address->GetAssoc());
	
	$smarty->assign('prev',$pagen->makePrevLink($LDPrevious));
	$smarty->assign('next',$pagen->makeNextLink($LDPrevious));

}

$smarty->assign('sid',$sid);
$smarty->assign('lang',$lang);
$smarty->assign('LDNeedEmptyFormPls',$LDNeedEmptyFormPls);


// Assign page output to the mainframe template
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/citytown_list.tpl');

//$smarty->compile_check = true; $smarty->debugging = true; $smarty->display('debug.tpl');
$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');