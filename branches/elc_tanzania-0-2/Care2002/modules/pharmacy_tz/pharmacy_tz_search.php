<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');


require($root_path.'include/inc_environment_global.php');
require($root_path.'include/care_api_classes/class_tz_pharmacy.php');


/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/

define('NO_2LEVEL_CHK',1);
require($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_tz_pharmacy.php');
$debug=false;

if ($debug) {
  function print_debug_info($name, $value) {
  if (isset($value))
    echo $name." is set to value: ".$value."<br>";
  }
  print_debug_info("Search pattern", $keyword);
}

if (!empty($keyword)) {
  // We have work... 
  
  
  $product_obj = new Product();
  
  if ($keyword=="*") {
    $search_results = $product_obj->get_all_items();
  } else {
    $search_results = $product_obj->get_array_search_results($keyword);
  }
  $number_of_search_results = $search_results->RecordCount();
  
  $bg_color_change = 1;
  
  while ($search_element = $search_results->FetchRow()) {
    if ($bg_color_change) {
      $http_buffer.="<tr bgcolor=#ffffaa>";
      $bg_color_change = 0;
    } else {
      $http_buffer.="<tr bgcolor=#ffffdd>";
      $bg_color_change = 1;
    }
    
    $item_id = $search_element['item_id'];
    $item_plausibility = $search_element['plausibility'];
    $item_description = $product_obj->get_description($item_id);
    $item_number = $product_obj->get_itemnumber($item_id);
    $item_classification = $product_obj->get_item_classification($item_id);
    $item_unit_price = $product_obj->get_selians_item_price($item_id);
    $http_buffer.=" <td>".$item_number."</td>
                    <td>".str_replace(strtolower(trim($keyword)),"<b>".trim($keyword)."</b>",strtolower($item_description))."</td>
                    <td>".$item_classification."</td>
					<td align=\"right\">".number_format($item_unit_price,0,'.',',')."</td>                    		
                    <td align=\"right\">".$item_plausibility."</td>
                    <td><div align=\"center\"><a href=\"pharmacy_tz_new_product.php?mode=show&item_id=".$item_id."&keyword=".$keyword."\"><img src=\"".$root_path."gui/img/common/default/common_infoicon.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>
                    <td><div align=\"center\"><a href=\"pharmacy_tz_new_product.php?mode=edit&item_id=".$item_id."&keyword=".$keyword."\"><img src=\"".$root_path."gui/img/common/default/hammer.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>
                    <td><div align=\"center\"><a href=\"pharmacy_tz_new_product.php?mode=erase&item_id=".$item_id."&keyword=".$keyword."\"><img src=\"".$root_path."gui/img/common/default/delete.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>";
    $http_buffer.="</tr>";
    
  }
 
}


require ("gui/gui_pharmacy_tz_search.php");
exit();
?>