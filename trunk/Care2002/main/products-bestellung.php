<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once('../include/inc_front_chain_lang.php');

if(!$dept)
{
	if($HTTP_COOKIE_VARS['ck_thispc_dept']) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	 else $dept='plop'; //simulate plop dept
}

/**
* if order nr is not available,   get the highest item number in the db and add 1
*/

if(!isset($order_nr) || !$order_nr)
{

    if($cat=='pharma') 
    {
 	    $dbtable='care_pharma_orderlist';
     }
    else
    {
 	    $dbtable='care_med_orderlist';
     }
 
    /* Establish db connection */
    include('../include/inc_db_makelink.php');
    if($link&&$DBLink_OK)
	{
				$sql='SELECT order_nr FROM '.$dbtable.' ORDER BY order_nr DESC LIMIT 1';
						
        		if($ergebnis=mysql_query($sql,$link))
				{
					//reset result
					if ($rows=mysql_num_rows($ergebnis))	
					{
					   $content=mysql_fetch_array($ergebnis);
					   $order_nr=$content['order_nr'] + 1;
					}
				   else
				   {
				      $order_nr=1;
				   } 
				}
				else
				 {
				    echo "$sql<br>$LDDbNoRead<br>";
					exit;
				 } 
		
			//echo $sql;
	}
  	 else { echo "$sql<br>$LDDbNoLink<br>"; } 
}
?>
<html>
<head>
<?php echo setCharSet(); ?>
<title></title>
</head>


<frameset rows="33,*">
  <frame name="BHEADER" src="products-bestell-hf.php<?php echo "?sid=$sid&lang=$lang&cat=$cat&userck=$userck" ?>" scrolling="no" frameborder="yes" >
  <frameset cols="50%,*">
    <frame name="BESTELLKORB" src="products-bestellkorb.php?sid=<?php echo "$sid&lang=$lang&dept=$dept&order_nr=$order_nr&itwassent=$itwassent&cat=$cat&userck=$userck"; ?>" scrolling="auto" frameborder="yes">
    <frame name="BESTELLKATALOG" src="products-bestellkatalog.php?sid=<?php echo "$sid&lang=$lang&dept=".strtr($dept," ","+")."&order_nr=$order_nr&cat=$cat&userck=$userck"; ?>" scrolling="auto" frameborder="yes">
  </frameset>
<noframes>
</noframes>


<body>

</body>
</noframes>
</frameset>

</html>
