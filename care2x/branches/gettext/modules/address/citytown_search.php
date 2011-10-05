<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');

# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_address_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30);

define('MODULE','address');
define('LANG_FILE_MODULAR','place.php');
$local_user='aufnahme_user';
require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');
# Load the insurance object
require_once('model/class_address.php');
$address_obj=new Address;

$breakfile='address_manage.php'.URL_APPEND;
$thisfile=basename(__FILE__);

# Initialize page's control variables
if($mode!='paginate'){
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
}else{
	$searchkey=$_SESSION['sess_searchkey']; # dummy search key to get past the search routine
}
# Set the sort parameters
if(empty($oitem)) $oitem='name';
if(empty($odir)) $odir='ASC';

# Get global configuration
$GLOBAL_CONFIG=array();
include_once($root_path.'include/core/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('pagin_address_search_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_address_search_max_block_rows']))
$GLOBAL_CONFIG['pagin_address_search_max_block_rows'] = MAX_BLOCK_ROWS; # Last resort, use the default defined at the start of this page

#Load and create paginator object
require_once(CARE_BASE.'include/core/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);
# Adjust the max nr of rows in a block
$pagen->setMaxCount($GLOBAL_CONFIG['pagin_address_search_max_block_rows']);


if(isset($mode)&&($mode=='search'||$mode=='paginate')&&!empty($searchkey)){

	# Convert wildcards
	$searchkey=strtr($searchkey,'*?','%_');
	# Save the search keyword for eventual pagination routines
	if($mode=='search') $_SESSION['sess_searchkey']=$searchkey;

	# Search for the addresses
	//$address=$address_obj->searchActiveCityTown($searchkey);
	$address=$address_obj->searchLimitActiveCityTown($searchkey,$GLOBAL_CONFIG['pagin_address_search_max_block_rows'],$pgx,$oitem,$odir);
	# Get the resulting record count
	$linecount=$address_obj->LastRecordCount();
	$pagen->setTotalBlockCount($linecount);
	# Count total available data
	if(isset($totalcount)&&$totalcount){
		$pagen->setTotalDataCount($totalcount);
	}else{
		$totalcount=$address_obj->searchCountActiveCityTown($searchkey);
		$pagen->setTotalDataCount($totalcount);
	}
	$pagen->setSortItem($oitem);
	$pagen->setSortDirection($odir);
}

# Set color values for the search mask
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#abcdef';
$entry_body_bgcolor='#ffffff';

# Start Smarty templating here
/**
 * LOAD Smarty
 */
# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme

require_once(CARE_BASE.'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care('system_admin');

# Title in toolbar
$smarty->assign('sToolbarTitle',"$LDAddress :: $LDSearch");
$smarty->assign('LDBack', $LDBack);
$smarty->assign('LDHelp', $LDHelp);
$smarty->assign('LDClose', $LDClose);
# href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/address_search.html");


# href for close button
$smarty->assign('breakfile',$breakfile);

# Window bar title
$smarty->assign('sWindowTitle',"$LDAddress :: $LDSearch");

# Body onload js
$smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()"');

# Buffer page output

ob_start();
$searchprompt=$LDSearchPrompt;
include(CARE_BASE.'include/helpers/inc_searchmask.php');
$searchMask= ob_get_contents();
ob_end_clean();
$smarty->assign('searchMask',$searchMask);

	if( is_object($address) ) {
		$smarty->assign('foundCity',1);
		$smarty->assign('URL_APPEND',URL_APPEND);
		
		if ($linecount) 
			$smarty->assign('recordsFound',str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.');
		else
			$smarty->assign('recordsFound',str_replace('~nr~','0',$LDSearchFound));

		if($oitem=='name') 
			$flag=TRUE;
		else 
			$flag=FALSE;
		$smarty->assign('name',$pagen->SortLink($LDCityTownName,'name',$odir,$flag));

		if($oitem=='iso_country_id') $flag=TRUE; else $flag=FALSE;
		$smarty->assign('iso_country_id',$pagen->SortLink($LDISOCountryCode,'iso_country_id',$odir,$flag));
		
		if($oitem=='unece_locode_type') $flag=TRUE; else $flag=FALSE;
		$smarty->assign('unece_locode_type',$pagen->SortLink($LDUNECELocalCode,'unece_locode_type',$odir,$flag));

		if($oitem=='info_url') $flag=TRUE; else $flag=FALSE;
		$smarty->assign('info_url',$pagen->SortLink($LDWebsiteURL,'info_url',$odir,$flag));

		$result = array();
		while( $addr = $address->FetchRow() ) {
			$result[] = array(
				'nr' 				=> $addr['nr'],
				'name'				=> $addr['name'],
				'iso_country_id'	=> $addr['iso_country_id'],
				'unece_locode'		=> $addr['unece_locode'],
				'info_url'		=> $addr['info_url'],
			);
		}
		$smarty->assign('result',$result);
		
		$smarty->assign('prevLink',$pagen->makePrevLink($LDPrevious));
		$smarty->assign('nextLink',$pagen->makeNextLink($LDNext));
	}else{
		$smarty->assign('NothingFound',str_replace('~nr~','0',$LDSearchFound));
	}


$smarty->assign('lang',$lang);	
$smarty->assign('sid',$sid);	
$smarty->assign('LDNeedEmptyFormPls',$LDNeedEmptyFormPls);	
	
// assign page output to the mainframe template
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/citytown_search.tpl');

//$smarty->compile_check = true; $smarty->debugging = true; $smarty->display('debug.tpl');
$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');