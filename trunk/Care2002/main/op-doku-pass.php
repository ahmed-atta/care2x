<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['op_docs'];

$fileforward="op-doku-javastart.php?sid=$sid&lang=$lang&target=";
$thisfile="op-doku-pass.php";

switch($target)
{
	case "search":$fileforward.="search";
						$lognote="search";
						break;
	case "archiv":$fileforward.="archiv";
						$lognote="archive";
						break;
	default:$fileforward.="entry"; 
				$target="entry";
}

$lognote="OP docs $lognote ok";

$breakfile="op-doku.php?sid=$sid&lang=$lang";

$userck="ck_opdoku_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf="OP docs $target";

require("../include/inc_passcheck_head.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/monitor2.gif" width=85 height=91 border=0 align="absmiddle">
<FONT  COLOR=#cc6600  SIZE=6  FACE="verdana"> <b><?php echo $LDOrDocu ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>

<td colspan=3><?php if($target=="entry") print '<img src=../img/'.$lang.'/'.$lang.'_newdata-b.gif border=0>';
								else print'<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=entry"><img src="../img/'.$lang.'/'.$lang.'_newdata-gray.gif" width=130 height=25 border=0></a>';
							if($target=="search") print '<img src="../img/'.$lang.'/'.$lang.'_such-b.gif" width=130 height=25 border=0>';
								else print '<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=search"><img src="../img/'.$lang.'/'.$lang.'_such-gray.gif" width=130 height=25 border=0></a>';
							if($target=="archiv") print '<img src="../img/'.$lang.'/'.$lang.'_arch-blu.gif" width=130 height=25 border=0>';
								else print '<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=archiv"><img src="../img/'.$lang.'/'.$lang.'_arch-gray.gif" width=130 height=25 border=0></a>';
						?></td>
</tr>

<?php require("../include/inc_passcheck_mask.php") ?>  

<p>
<!-- 
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $LDOrDocu" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $LDOrDocu" ?></a><br> -->
<HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
