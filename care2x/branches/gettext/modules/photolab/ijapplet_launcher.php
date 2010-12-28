<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
?>
<!-- Runs ImageJ as an Apple -->

<html>
<head>
<title>Image editing</title>
</head>
<body>

<h2>Image editing</h2>

<applet codebase="."
	code="ij.ImageJApplet.class" archive="ij.jar"
	width=750 height=550
	security=all-permissions>
<param name=url value=<?php echo "$httprotocol://$main_domain/uploads/photos/encounter/$pn/$img"; ?>>
</applet>

<p>
<a href="javascript:window.history.back()">Back</a>
</p>
</body>
</html>