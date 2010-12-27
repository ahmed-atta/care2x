<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../include/helpers/inc_environment_global.php');
header("Location:../modules/news/start_page.php?sid=$sid&lang=$lang");
exit;
?>