<?php

//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();


#get custom field labels
$customFieldLabel = getCustomFieldLabels();

$categories = getActiveCategories();

//if valid then do save
if ($_POST['description'] != "" ) {
	include("./modules/products/save.php");
}

$smarty -> assign('categories',$categories);
$smarty -> assign('customFieldLabel',$customFieldLabel);
$smarty -> assign('save',$save);
?>
