<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","products.php");
$local_user=$userck;
require("../include/inc_front_chain_lang.php");

if(!$dept)
{
	if($HTTP_COOKIE_VARS['ck_thispc_dept']) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
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
  <frame name="BHEADER" src="products-bestell-hf.php<?php echo "?sid=$sid&lang=$lang&cat=$cat&userck=$userck" ?>" scrolling="no" frameborder="yes" >
  <frameset cols="50%,*">
    <frame name="BESTELLKORB" src="products-bestellkorb.php?sid=<?php echo "$sid&lang=$lang&dept=$dept&order_id=$order_id&itwassent=$itwassent&cat=$cat&userck=$userck"; ?>" scrolling="auto" frameborder="yes">
    <frame name="BESTELLKATALOG" src="products-bestellkatalog.php?sid=<?php echo "$sid&lang=$lang&dept=".strtr($dept," ","+")."&order_id=$order_id&cat=$cat&userck=$userck"; ?>" scrolling="auto" frameborder="yes">
  </frameset>
<noframes>
</noframes>


<body>

</body>
</noframes>
</frameset>

</html>
