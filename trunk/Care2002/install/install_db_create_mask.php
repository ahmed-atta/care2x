<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
$lang='en';
define('LANG_FILE','');
define('NO_CHAIN',1);
require_once('../include/inc_front_chain_lang.php');

if($origin=='path_b' && empty($dbname))
{

  header('location:install_db_create_b.php');
   exit;
}

?>

<html>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<head>
<title></title>

<meta name="Description" content="">
<meta name="Keywords" content="">
<meta name="Author" content="Lorilla Bong">
<meta name="Generator" content="AceHTML 4 Freeware">
</head>
<body bgcolor=#99ccff>

<center>
<font face="Verdana, Arial" size=4 color=#800000>
<p>
Care 2002 beta version 1.0.03 <br> Installation<br>
Step <?php if($origin=='path_b') echo 3; else echo 6; ?>
</font>
<p>

<img <?php echo createComIcon('../','butft2_d.gif','0') ?>>

<p>
<font face="Verdana" color=#000080 size=2>

The ICD (International Code of Diseases [englisn & german]) <br>and OPS (codes for surgical operations) <br>
are going to be inserted (47,341 inserts!) <p>This could take several minutes. Please be patient. 
<font size=1> ( It took 10 minutes with a 600 MHz, K7 processor. )</font><p>
Please <font color="red">do not cancel or break </font>this phase.  Otherwise, the data would  be incomplete.



</b>
<?php

if($origin=='path_b') $createfile='install_db_create_b.php';
  else $createfile='install_db_create_2.php';
?>  

<form action="<?php echo $createfile ?>" method="post">
<input type="submit" value="START INSERTION OF DATA. Please press this button ONCE ONLY">
<input type="hidden" name="dbusername" value="<?php echo $dbusername ?>">
<input type="hidden" name="dbhost" value="<?php echo $dbhost?>">
<input type="hidden" name="dbpassword" value="<?php echo $dbpassword ?>">
<input type="hidden" name="dbname" value="<?php echo $dbname ?>">

</form>
</center>

</body>
</html>
