<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='prompt.php';
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(!isset($dept_nr)||!$dept_nr){
	if($cfg['thispc_dept_nr']){
		$dept_nr=$cfg['thispc_dept_nr'];
	}else{
		if($cfg['bname']=='mozilla'){
			#
			# Bug patch for Mozilla, I know its not automatic but Mozilla seems to have problems with two consecutive header redirects
			#
			require($root_path.'include/inc_mozillapatch_redirect.php');
		}else{
			header("Location:select_dept.php".URL_REDIRECT_APPEND."&cat=$cat&target=entry&retpath=$retpath");
		}
		exit;
	}
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
 

	$sql='SELECT order_nr FROM '.$dbtable.' ORDER BY order_nr DESC LIMIT 1';
						
     if($ergebnis=$db->Execute($sql)){
		//reset result
		if ($rows=$ergebnis->RecordCount())	{
			$content=$ergebnis->FetchRow();
			$order_nr=$content['order_nr'] + 1;
		}else{
			$order_nr=1;
		} 
	}else{
		echo "$sql<br>$LDDbNoRead<br>";
		exit;
	} 
}
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title></title>
</head>


<frameset rows="33,*">
  <frame name="BHEADER" src="products-bestell-hf.php<?php echo "?sid=$sid&lang=$lang&cat=$cat&userck=$userck" ?>" scrolling="no" frameborder="yes" >
  <frameset cols="50%,*">
	<frame name="BESTELLKORB" src="products-bestellkorb.php?sid=<?php echo "$sid&lang=$lang&dept_nr=$dept_nr&order_nr=$order_nr&itwassent=$itwassent&cat=$cat&userck=$userck"; ?>" scrolling="auto" frameborder="yes">
     <frame name="BESTELLKATALOG" src="products-bestellkatalog.php?sid=<?php echo "$sid&lang=$lang&dept_nr=$dept_nr&order_nr=$order_nr&cat=$cat&userck=$userck"; ?>" scrolling="auto" frameborder="yes">
  </frameset>
<noframes>
</noframes>


<body>

</body>
</noframes>
</frameset>

</html>
