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
define("LANG_FILE","nursing.php");
$local_user="ck_pflege_user";
require("../include/inc_front_chain_lang.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

</head><center>
<body>
<p>
&nbsp;
<p>
&nbsp;
<p>
<a href="pflege-station.php?<?php echo "sid=$sid&lang=$lang&edit=$edit&list=1&station=$station&mode=fresh"; ?>">
<img src="<?php print "../imgcreator/nobellist.php?sid=$sid&lang=$lang&station=$station&c=$c"; ?>" border=0  alt="<?php echo $LDClkHere ?>">
<p>
<?php echo $LDClkHere ?>...</a>
</center>
</body>
</html>
