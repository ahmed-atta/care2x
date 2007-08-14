<?php
//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();

#get the invoice id
#$product_id = $_GET['submit'];
 $category_id = $_GET['submit'];


#$product = getProduct($product_id);
 $category = getcategory($category_id);

#get custom field labels
#$customFieldLabel = getCustomFieldLabels();

$smarty -> assign('category',$category);
#$smarty -> assign('customFieldLabel',$customFieldLabel);

?>
