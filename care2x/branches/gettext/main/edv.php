<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/helpers/inc_environment_global.php');

require_once($root_path.'include/helpers/inc_environment_global.php');
header('Location:'.$root_path.'modules/system_admin/admin.php?sid='.$sid.'&lang='.$lang);
exit;
?>
