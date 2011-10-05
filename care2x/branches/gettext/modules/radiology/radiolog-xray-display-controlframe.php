<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/*** CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','radiology');
define('LANG_FILE_MODULAR','radiology.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'include/helpers/inc_date_format_functions.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>

</HEAD>

<BODY bgcolor=black onLoad="if (window.focus) window.focus()" leftmargin=2 marginwidth=2>


<FONT    SIZE=3  FACE="Arial" color=white>

Patient:<br>
Mustermann, Silvia<br>
<?php echo formatDate2Local('1988-11-07',$date_format); ?>
<p>
<?php echo $LDShootDate ?>:<br>
<?php echo formatDate2Local('2001-10-22',$date_format); ?><p>
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
