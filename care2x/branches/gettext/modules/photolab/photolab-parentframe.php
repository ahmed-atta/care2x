<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','photolab');
define('LANG_FILE_MODULAR','photolab.php');
$local_user='ck_photolab_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
?>
<html>
<head>

<title></title>

</head>

<?php
if($lang=='ar'||$lang=='fa'){
?>
<frameset cols="*,49%">
   <frame name="PREVIEWFRAME" src="photolab-preview.php?sid=<?php echo "$sid&lang=$lang" ?>">
  <frame name="SELECTFRAME" src="upload_search_patient.php?sid=<?php echo "$sid&lang=$lang" ?>">
<noframes>
<body>
</body>
</noframes>
</frameset>
<?php
}else{
?>
<frameset cols="49%,*">
  <frame name="SELECTFRAME" src="upload_search_patient.php?sid=<?php echo "$sid&lang=$lang" ?>">
   <frame name="PREVIEWFRAME" src="photolab-preview.php?sid=<?php echo "$sid&lang=$lang" ?>">
<noframes>
<body>
</body>
</noframes>
</frameset>
<?php
}
?>
</html>
