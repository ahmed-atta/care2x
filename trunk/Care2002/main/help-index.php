<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('../include/inc_vars_resolve.php'); // globalize POST, GET, & COOKIE  vars
if(file_exists("../help/".$lang."/help_".$lang."_index.php")) include ("../help/".$lang."/help_".$lang."_index.php");
 else  include ("../help/en/help_en_index.php");
?>
