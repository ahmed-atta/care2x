<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['phonedir'];

$fileforward="telesuch_edit.php?sid=$sid&lang=$lang&edit=1";

$thisfile="telesuch_edit_pass.php";

$breakfile="telesuch.php?sid=$sid&lang=$lang";

$lognote="$LDPhoneDir $LDNewData ok";

$userck="phonedir_user";
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie("ck_2level_sid".$sid,"");

require("../include/inc_passcheck_internchk.php");

if ($pass=="check") include("../include/inc_passcheck.php");

$errbuf="$LDPhoneDir $LDNewData";

require("../include/inc_passcheck_head.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">
<P>
<img src="../img/phone.gif" align="absmiddle">
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo "$LDPhoneDir $LDNewData" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><a href="telesuch.php?sid=<?php print "$sid&lang=$lang"; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_such-gray.gif" border="0" <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="telesuch_phonelist.php?sid=<?php print "$sid&lang=$lang"; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_phonedir-gray.gif" border="0" <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img src="../img/<?php echo "$lang/$lang" ?>_newdata-b.gif" border="0"></td>
</tr>

<?php require("../include/inc_passcheck_mask.php") ?>  
     
<?php require("../language/".$lang."/lang_".$lang."_phone.php"); ?>

<p>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','newphone','search')"><?php echo $LDHow2SearchPhone ?></a><br>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','newphone','dir')"><?php echo $LDHow2OpenDir ?></a><br>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','newphone','newphone')"><?php echo $LDHowEnter ?></a><br>
<HR>
<p>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>
</FONT>
</BODY>
</HTML>
