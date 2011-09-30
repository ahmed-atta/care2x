<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','cafeteria');
define('LANG_FILE_MODULAR','cafeteria.php');
$local_user='ck_cafenews_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile='cafenews.php'.URL_APPEND;
$returnfile='cafenews-edit-price-select.php'.URL_APPEND;
$thisfile=basename(__FILE__);

require('includes/inc_currency_set.php');
?>
<?php html_rtl($lang); ?>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<!-- Creation date: 21.12.2001 -->
<head>

<title></title>

<?php if($rows) : ?>
<script language="javascript" src="<?php echo $root_path ?>js/check_currency_same_item.js">
</script>
<?php endif ?>

</head>
<body>
<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img <?php echo createComIcon($root_path,'basket.gif','0') ?>></a> <b><?php echo $LDCafePrices ?></b></FONT>
<hr>
<?php 
/**
* Create the GUI body
*/
$bottomlink=$root_path.'modules/system_admin/admin_main-pass.php'.URL_APPEND.'&target=currency_admin'; 
$bottomlink_txt=$LDClk2AddCurrency;
require('includes/inc_currency_set_gui.php'); 
?>
</body>
</html>
