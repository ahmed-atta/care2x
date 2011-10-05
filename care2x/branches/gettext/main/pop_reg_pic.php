<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
define('NO_2LEVEL_CHK',1);
require_once(CARE_BASE .'include/helpers/inc_front_chain_lang.php');
require_once(CARE_BASE .'global_conf/inc_remoteservers_conf.php');
require_once(CARE_BASE .'include/helpers/inc_date_format_functions.php');
require_once(CARE_BASE .'include/core/class_person.php');
$person=& new Person($pid);
$person->preloadPersonInfo();
?>
<html>
<head>
<title><?php echo $person->LastName().', '.$person->FirstName().' ['.formatDate2Local($person->Birthdate(),$date_format).']';  ?></title>


</head>
<body onLoad="if (window.focus) window.focus()">
<font size=2 face="verdana,arial"><?php echo $person->LastName().', '.$person->FirstName().' ['.formatDate2Local($person->Birthdate(),$date_format).']';  ?><br>
<?php
if($person->PhotoFilename()&&file_exists(CARE_BASE .'uploads/photos/registration/'.$person->PhotoFilename())){
?>
<img src="<?php echo CARE_BASE  ?>uploads/photos/registration/<?php echo $person->PhotoFilename(); ?>">
<?php
}
?>
</body>
</html>
