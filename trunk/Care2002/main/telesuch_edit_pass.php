<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.03 - 2002-10-26 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
require_once('../global_conf/areas_allow.php');

$allowedarea=&$allow_area['phonedir'];

$fileforward="telesuch_edit.php?sid=$sid&lang=$lang&edit=1";

$thisfile="telesuch_edit_pass.php";

$breakfile="telesuch.php?sid=".$sid."&lang=".$lang;

$lognote="$LDPhoneDir $LDNewData ok";

$userck="phonedir_user";
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); setcookie("ck_2level_sid".$sid,"");

require('../include/inc_passcheck_internchk.php');

if ($pass=="check") include("../include/inc_passcheck.php");

$errbuf="$LDPhoneDir $LDNewData";

require('../include/inc_passcheck_head.php');
?>
<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">
<P>
<img <?php echo createComIcon('../','phone.gif','0') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo "$LDPhoneDir $LDNewData" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><a href="telesuch.php?sid=<?php echo "$sid&lang=$lang"; ?>"><img <?php echo createLDImgSrc('../','such-gray.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="telesuch_phonelist.php?sid=<?php echo "$sid&lang=$lang"; ?>"><img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img <?php echo createLDImgSrc('../','newdata-b.gif','0') ?>></td>
</tr>

<?php require('../include/inc_passcheck_mask.php') ?>  
 
<?php
if(file_exists("../language/$lang/lang_".$lang."_phone.php"))
include("../language/$lang/lang_".$lang."_phone.php");
  else include("../language/en/lang_en_phone.php");?>     

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <a href="javascript:gethelp('phone_how2start.php','newphone','search')"><?php echo $LDHow2SearchPhone ?></a><br>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <a href="javascript:gethelp('phone_how2start.php','newphone','dir')"><?php echo $LDHow2OpenDir ?></a><br>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <a href="javascript:gethelp('phone_how2start.php','newphone','newphone')"><?php echo $LDHowEnter ?></a><br>
<HR>
<p>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>
</BODY>
</HTML>
