<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_cafenews_user';
require_once($root_path.'include/inc_front_chain_lang.php');
$breakfile='cafenews.php'.URL_APPEND;
$returnfile='cafenews-edit-select.php'.URL_APPEND;
?>
<html>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<!-- Creation date: 21.12.2001 -->
<head>
<?php echo setCharSet(); ?>
<title></title>

<script language="javascript">
function chkForm(d)
{
	if((d.week[0].checked)||(d.week[1].checked)||(d.week[2].checked)) return true;
		else return false;
}
</script>

</head>
<body>
<FONT  SIZE=6 COLOR="#cc6600" FACE="verdana,Arial">
<img <?php echo createComIcon($root_path,'basket.gif','0') ?>><b><?php echo $LDCafeMenu ?></b></FONT>
<hr>
<form name="selectform" action="cafenews-edit-menu.php" onSubmit="return chkForm(this)">
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0') ?>></td>
    <td ><FONT FACE="verdana,Arial"><FONT  SIZE=5 COLOR="#000066" FACE="verdana,Arial">
		<?php echo $LDMarkWeek ?></font><p>
			<font size=2><?php echo $LDClkContinue ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="ccffff"><FONT FACE="verdana,Arial"><p><br>
		<input type="radio" name="week" value="1"> <a href="#" onClick="document.selectform.week[0].checked=true"><?php echo $LDThisWeek ?></a><br>
    	<input type="radio" name="week" value="2"> <a href="#" onClick="document.selectform.week[1].checked=true"><?php echo $LDNextWeek ?></a><br>
    	<input type="radio" name="week" value="3"> <a href="#" onClick="document.selectform.week[2].checked=true"><?php echo $LD3rdWeek ?></a><br><p>
  </td>
  </tr>
  <tr>
   <td><p><br>
   <a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
  </td>
    <td><p><br>
    <input type="image" <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>>
    &nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
  </td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form></body>
</html>
