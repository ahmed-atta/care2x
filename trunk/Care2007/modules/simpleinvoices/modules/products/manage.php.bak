<?php

//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();

$products = getProducts();
$categories = getActiveCategories();

$smarty -> assign("products",$products);
$smarty -> assign("categories",$categories);
#$categories = getcategories();
#$smarty -> assign("categories",$categories);


getRicoLiveGrid("rico_product","{ type:'number', decPlaces:0, ClassName:'alignleft' },,{ type:'number', decPlaces:2, ClassName:'alignleft' }");

#getRicoLiveGrid("rico_category","{ type:'number', decPlaces:0, ClassName:'alignleft' },,{ type:'number', decPlaces:2, ClassName:'alignleft' }");

?>
