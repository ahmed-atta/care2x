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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once('../include/inc_front_chain_lang.php');
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
<!-- <img src="<?php echo "../imgcreator/nobellist.php?sid=$sid&lang=$lang&station=$station&c=$c"; ?>" border=0  alt="<?php echo $LDClkHere ?>">
 -->
 <table border=0>
   <tr>
     <td><img <?php echo createMascot('../','mascot1_r.gif') ?>></td>
     <td><font size=3 face="verdana,arial" color="#990000"><b>
	 <?php 
	 echo $LDNoOccList.' '.$LDFromWard.'<font color="#0000ff">'.strtoupper($station).'</font> '.$LDWithinLast.' '.($c-1).$LDDays.' '.$LDAvailable;
     ?></b>
	 </font>
	  </td>
   </tr>
 </table>
 
 <p>
<a href="pflege-station.php?<?php echo "sid=$sid&lang=$lang&edit=$edit&list=1&station=$station&mode=fresh"; ?>">
<?php echo $LDClkHere.' '.$LDToCreateNewList ?>...</a>
</center>
</body>
</html>
