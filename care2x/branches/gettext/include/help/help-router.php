<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
// globalize POST, GET, & COOKIE  vars
require_once('../helpers/inc_environment_global.php');
?>
<html>
<head>

<title>?</title>

</head>
<frameset cols="20%,*">
	<frame name="HELPINDEXFRAME" src="help-index.php?helpidx=<?php echo "$helpidx&src=$src&x1=$x1&x2=$x2&x3=$x3&lang=$lang" ?>">
	<frame name="HELPINFOFRAME" src="help-info.php?helpidx=<?php echo "$helpidx&src=$src&x1=$x1&x2=$x2&x3=$x3&lang=$lang" ?>">
	<noframes>
	<body>
	</body>
	</noframes>
</frameset>
</html>