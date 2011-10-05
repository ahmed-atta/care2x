<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
define('MODULE','op_document');
define('LANG_FILE_MODULAR','op_document.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['op_docs'];

$thisfile=basename(__FILE__);

switch($target)
{
	case 'search':$fileforward.="op-docu-search.php?sid=$sid&lang=$lang&target=search";
						$lognote="search";
						break;
	case 'archiv':$fileforward.="op-docu-archive.php?sid=$sid&lang=$lang&target=archiv";
						$lognote="archive";
						break;
	default:$fileforward.="op-docu-start.php?sid=$sid&lang=$lang&target=entry";
				$target="entry";
}

$lognote="OP docs $lognote ok";

$breakfile=$root_path.'main/op-docu.php'.URL_APPEND;

$userck='ck_opdocu_user';

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/helpers/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,"");

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/helpers/inc_passcheck.php');

$errbuf="OP docs $target";

require($root_path.'include/helpers/inc_passcheck_head.php');
?>
<BODY  onLoad="document.passwindow.userid.focus();" 
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,'swimring.gif','0','top') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $LDOrDocu ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>

<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc($root_path,'newdata-b.gif','0').'>';
								else echo'<a href="op-docu-pass.php?sid='.$sid.'&lang='.$lang.'&target=entry"><img '.createLDImgSrc($root_path,'newdata-gray.gif','0').'></a>';
							if($target=="search") echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').'>';
								else echo '<a href="op-docu-pass.php?sid='.$sid.'&lang='.$lang.'&target=search"><img '.createLDImgSrc($root_path,'such-gray.gif','0').'></a>';
							if($target=="archiv") echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'>';
								else echo '<a href="op-docu-pass.php?sid='.$sid.'&lang='.$lang.'&target=archiv"><img '.createLDImgSrc($root_path,'arch-gray.gif','0').'></a>';
						?></td>
</tr>

<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>  
</FONT>


</BODY>
</HTML>
