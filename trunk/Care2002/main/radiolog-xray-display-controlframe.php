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
define("LANG_FILE","radio.php");
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

</HEAD>

<BODY bgcolor=black onLoad="if (window.focus) window.focus()" leftmargin=2 marginwidth=2>


<FONT    SIZE=3  FACE="Arial" color=white>

Patient:<br>
Mustermann, Silvia<br>
12.05.1988

<p>
<?php echo $LDShootDate ?>:<br>
22.10.2001<p>
</FONT>
<p>
<form>
<input type="button" value="<?php echo $LDNewSearch ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>')">
<p>


<?php if($mode!="display1") : ?>

<input type="button" value="<?php echo $LDFullScreen ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=display1')">

<?php else : ?>
<input type="button" value="<?php echo $LDReadDiag ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=display_diagnosis_read')">
<p>
<input type="button" value="<?php echo $LDWriteDiag ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=display_diagnosis_write')">
<?php endif ?>

</form>

<p>






</BODY>
</HTML>
