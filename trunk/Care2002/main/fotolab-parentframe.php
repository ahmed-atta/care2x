<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once('../include/inc_front_chain_lang.php');
?>
<html>
<head>
<?php echo setCharSet(); ?>
<title></title>

</head>
<frameset cols="49%,*">
  <frame name="SELECTFRAME" src="fotolab-dir-select-init.php?sid=<?php echo "$sid&lang=$lang" ?>">
  <frameset rows="70%,*">
    <frame name="PREVIEWFRAME" src="fotolab-preview.php?sid=<?php echo "$sid&lang=$lang" ?>">
    <frame name="MAINDATAFRAME" src="fotolab-maindata.php?sid=<?php echo "$sid&lang=$lang" ?>">
  </frameset>
<noframes>
<body>


</body>
</noframes>
</frameset>
</html>
