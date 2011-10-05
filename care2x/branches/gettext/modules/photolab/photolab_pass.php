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
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['doctors'];
//$append="?sid=$sid&lang=$lang&from=pass"; 

$fileforward="photolab-parentframe.php?sid=$sid&lang=$lang&ck_config=$ck_config";
$title=$LDFotolab;
							
$thisfile="photolab_pass.php";

$breakfile=$root_path."main/plugin.php".URL_APPEND;

$lognote="$LDFotolab $title ok";

$userck="ck_photolab_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/helpers/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,"");

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/helpers/inc_passcheck.php');

$errbuf="$LDFotolab $title";

$minimal=1;
require($root_path.'include/helpers/inc_passcheck_head.php');
?>
<BODY  onLoad="document.passwindow.userid.focus();" 
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,'smiley.gif','0','top') ?>>
<FONT  COLOR="<?php echo$cfg['top_txtcolor'] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $title ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>  
</FONT>


</BODY>
</HTML>
