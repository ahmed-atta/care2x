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
define("LANG_FILE","lab.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $LDPhotos ?></title>

</head>
<frameset cols="40%,*">
  <frame name="FOTOS_INDEX" src="fotos-index.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&pn=$pn&station=$station&fileroot=$fileroot" ?>" >
  <frame name="FOTOS_PREVIEW" src="fotos-preview.php?sid=<?php echo "$sid&lang=$lang" ?>">
<noframes>
<body>


</body>
</noframes>
</frameset>
</html>
