<?php
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$$fwck)
 {
	switch($cat)
	{
		case "pharma": header("Location:apotheke.php?sid=$ck_sid&lang=$lang"); exit;
		case "medlager": header("Location:medlager.php?sid=$ck_sid&lang=$lang"); exit;
	}
}
require("../language/".$lang."/lang_".$lang."_products.php");

if(!$dept)
{
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
	 else $dept="plop"; //simulate plop dept
}

// set or create an order id number
if($oid!="") $order_id=str_replace($dept,"",$oid);
	else	$order_id=uniqid("");

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>
</head>


<frameset rows="33,*">
  <frame name="BHEADER" src="products-bestell-hf.php<?="?sid=$ck_sid&lang=$lang&cat=$cat" ?>" scrolling="no" frameborder="yes" >
  <frameset cols="50%,*">
    <frame name="BESTELLKORB" src="products-bestellkorb.php?sid=<?print "$ck_sid&lang=$lang&dept=$dept&order_id=$order_id&itwassent=$itwassent&cat=$cat&userck=$userck"; ?>" scrolling="auto" frameborder="yes">
    <frame name="BESTELLKATALOG" src="products-bestellkatalog.php?sid=<?print "$ck_sid&lang=$lang&dept=".strtr($dept," ","+")."&order_id=$order_id&cat=$cat&userck=$userck"; ?>" scrolling="auto" frameborder="yes">
  </frameset>
<noframes>
</noframes>


<body>

</body>
</noframes>
</frameset>

</html>
