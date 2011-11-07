<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','laboratory');
define('LANG_FILE_MODULAR','laboratory.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile=$root_path."modules/nursing/nursing-ward-patientdata.php".URL_APPEND."&station=$station&pn=$pn&edit=$edit";
?>
<html>
<head>
<title></title>
<?php require($root_path.'include/helpers/include_header_css_js.php'); ?>
</head>
<body>

<table border=0>
  <tr>
    
    <td class="warnprompt"><?php echo $LDNoDiagReport ?></td>
  </tr>
</table>
<p><br>
<a href="<?php echo $breakfile ?>" target="_top" class="button icon arrowleft">Back</a>
</body>
</html>
