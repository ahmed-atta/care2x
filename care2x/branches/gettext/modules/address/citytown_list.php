<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');

// Default value for the maximum nr of rows per block displayed, define this to the value you wish
// In normal cases this value is derived from the db table "care_config_global" using the "pagin_address_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables[] = 'search.php';
define('LANG_FILE','place.php');
$local_user = 'aufnahme_user';
require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');

// Load the address object
require_once(CARE_BASE.'/modules/address/model/class_address.php');
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
$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],CARE_BASE);
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

 require_once(CARE_BASE.'/gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

// Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDAddress :: $LDListAll");
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 // href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('address_list.php')");

 // href for close button
 $smarty->assign('breakfile',$breakfile);

 // Window bar title
 $smarty->assign('sWindowTitle',"$LDAddress :: $LDListAll");

// Buffer page output

ob_start();
?>
 <ul>

 &nbsp;
 <br>
<?php 
if(is_object($address)){
	if ($linecount) 
		echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
	else 
		echo str_replace('~nr~','0',$LDSearchFound); 
?>
<table border=0 cellpadding=2 cellspacing=1>
  <tr class="wardlisttitlerow">
      <td><b>
	  <?php 
	  	if($oitem=='name') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDCityTownName,'name',$odir,$flag); 
			 ?></b>
	</td>
      <td><b>
	  <?php 
	  	if($oitem=='zip_code') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDZipCode,'zip_code',$odir,$flag); 
			 ?></b>
	</td>
      <td><b>
	  <?php 
	  	if($oitem=='iso_country_id') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDISOCountryCode,'iso_country_id',$odir,$flag); 
			 ?></b>
	</td>
	
      <td><b>
	  <?php 
	  	if($oitem=='unece_locode_type') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDUNECELocalCode,'unece_locode_type',$odir,$flag); 
			 ?></b>
	</td>

      <td><b>
	  <?php 
	  	if($oitem=='info_url') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDWebsiteURL,'info_url',$odir,$flag); 
			 ?></b>
	</td>

  </tr> 
<?php
	$toggle=0;
	while($addr=$address->FetchRow()){
		if($toggle) $bgc='wardlistrow2';
			else $bgc='wardlistrow1';
		$toggle=!$toggle;
?>
  <tr  class="<?php echo $bgc ?>">
    <td><a href="citytown_info.php<?php echo URL_APPEND.'&retpath=list&nr='.$addr['nr']; ?>"><?php echo $addr['name']; ?></a></td>
    <!-- gjergji added zip code -->
    <td><?php echo $addr['zip_code']; ?></td>
    <!-- end:gjergji added zip code -->
    <td><?php echo $addr['iso_country_id']; ?></td>
    <td><?php echo $addr['unece_locode']; ?></td>
    <td><a href="<?php echo $addr['info_url']; ?>"><?php echo $addr['info_url']; ?></a></td>
</td>
  </tr> 
<?php
	}
	echo '
	<tr><td colspan=3>'.$pagen->makePrevLink($LDPrevious).'</td>
	<td align=right>'.$pagen->makeNextLink($LDNext).'</td>
	</tr>';
?>
  </table>
<?php
}
?>
<p>

<form action="citytown_new.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="retpath" value="list">
<input type="submit" value="<?php echo $LDNeedEmptyFormPls ?>">
</form>
</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

// Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');
?>