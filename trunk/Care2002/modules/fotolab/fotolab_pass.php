<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['doctors'];
//$append="?sid=$sid&lang=$lang&from=pass"; 

$fileforward="fotolab-parentframe.php?sid=$sid&lang=$lang&ck_config=$ck_config";
$title=$LDFotolab;
							
$thisfile="fotolab_pass.php";

$breakfile=$root_path."main/spediens.php".URL_APPEND;

$lognote="$LDFotolab $title ok";

$userck="ck_fotolab_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,"");

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf="$LDFotolab $title";

$minimal=1;
require($root_path.'include/inc_passcheck_head.php');
?>
<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,'monitor2.gif','0','absmiddle') ?>>
<FONT  COLOR=#cc6600  SIZE=6  FACE="verdana"> <b><?php echo $title ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntro2 $title" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhat2Do $title" ?></a><br>
 --><hr>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>


</BODY>
</HTML>
