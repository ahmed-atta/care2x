<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');
require_once('../global_conf/areas_allow.php');

$allowedarea=&$allow_area['op_docs'];

$thisfile="op-doku-pass.php";

/*
$fileforward="op-doku-javastart.php?sid=$sid&lang=$lang&target=";

switch($target)
{
	case 'search':$fileforward.="search";
						$lognote="search";
						break;
	case 'archiv':$fileforward.="archiv";
						$lognote="archive";
						break;
	default:$fileforward.="entry"; 
				$target="entry";
}*/

switch($target)
{
	case 'search':$fileforward.="op-doku-search.php?sid=$sid&lang=$lang&target=search";
						$lognote="search";
						break;
	case 'archiv':$fileforward.="op-doku-archiv.php?sid=$sid&lang=$lang&target=archiv";
						$lognote="archive";
						break;
	default:$fileforward.="op-doku-start.php?sid=$sid&lang=$lang&target=start";
				$target="entry";
}

$lognote="OP docs $lognote ok";

$breakfile="op-doku.php?sid=".$sid."&lang=".$lang;

$userck="ck_opdoku_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,"");

require('../include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include('../include/inc_passcheck.php');

$errbuf="OP docs $target";

require('../include/inc_passcheck_head.php');
?>
<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon('../','monitor2.gif','0','absmiddle') ?>>
<FONT  COLOR=#cc6600  SIZE=6  FACE="verdana"> <b><?php echo $LDOrDocu ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>

<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc('../','newdata-b.gif','0').'>';
								else echo'<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=entry"><img '.createLDImgSrc('../','newdata-gray.gif','0').'></a>';
							if($target=="search") echo '<img '.createLDImgSrc('../','such-b.gif','0').'>';
								else echo '<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=search"><img '.createLDImgSrc('../','such-gray.gif','0').'></a>';
							if($target=="archiv") echo '<img '.createLDImgSrc('../','arch-blu.gif','0').'>';
								else echo '<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=archiv"><img '.createLDImgSrc('../','arch-gray.gif','0').'></a>';
						?></td>
</tr>

<?php require('../include/inc_passcheck_mask.php') ?>  

<p>
<!-- 
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $LDOrDocu" ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $LDOrDocu" ?></a><br> -->
<HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
