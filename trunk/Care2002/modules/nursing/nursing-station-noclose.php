<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<html>

<?php echo setCharSet(); ?>
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
     <td><img <?php echo createMascot($root_path,'mascot1_r.gif') ?>></td>
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
<a href="nursing-station-info.php<?php echo URL_APPEND."&mode=show&ward_id=$ward_id&ward_nr=$ward_nr"; ?>">
<?php echo $LDBackToWardProfile.'... '.$LDClkHere ?></a>
<p>
 <a href="nursing-station.php<?php echo URL_APPEND."&edit=1&ward_id=$ward_id&ward_nr=$ward_nr&retpath=ward_mng"; ?>">
<?php echo $LDShowWardOccupancy.'... '.$LDClkHere ?></a>

</center>
</body>
</html>
