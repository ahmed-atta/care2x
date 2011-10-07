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
define('MODULE','nursing');
define('LANG_FILE_MODULAR','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
?>
<html>

<title></title>

</head><center>
<body>
<p>
&nbsp;
<p>
&nbsp;
<p>

 <table border=0>
   <tr>
     
     <td><font size=3 face="verdana,arial" color="#990000"><b>
	 <?php 
	 	echo str_replace('~str~',strtoupper($ward_id),$LDWardNoClose);
     ?></b>
	 </font>
	  </td>
   </tr>
 </table>
 
 <p>
<font size=2 face="verdana,arial" color="#990000"> 
<a href="nursing-ward-info.php<?php echo URL_APPEND."&mode=show&ward_id=$ward_id&ward_nr=$ward_nr"; ?>">
<?php echo $LDBackToWardProfile.'... '.$LDClkHere ?></a>
<p>
 <a href="nursing-ward.php<?php echo URL_APPEND."&edit=1&ward_id=$ward_id&ward_nr=$ward_nr&retpath=ward_mng"; ?>">
<?php echo $LDShowWardOccupancy.'... '.$LDClkHere ?></a>

</center>
</body>
</html>
