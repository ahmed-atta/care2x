<? 
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla
								
Beta version 1.0    2002-05-10
								
This script(s) is(are) free software; you can redistribute it and/or
modify it under the terms of the GNU General Public
License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.
																  
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
General Public License for more details.
											   
You should have received a copy of the GNU General Public
License along with this script; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
																		 
Copy of GNU General Public License at: http://www.gnu.org/
													 
Source code home page: http://www.care2x.com
Contact author at: elpidio@latorilla.com

This notice also applies to other scripts which are integral to the functioning of CARE 2002 within this directory and its top level directory
A copy of this notice is also available as file named copy_notice.txt under the top level directory.
*/

if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_stdpass.php");

require("../req/config-color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['phonedir'];

$fileforward="telesuch_edit.php?sid=$ck_sid&lang=$lang&edit=1";

$thisfile="telesuch_edit_pass.php";

$breakfile="telesuch.php?sid=$ck_sid&lang=$lang";

$lognote="$LDPhoneDir $LDNewData ok";

$userck="phonedir_user";
//reset cookie;
setcookie($userck,"");

if($ck_login_logged&&$ck_login_userid&&!$nointern)
{
    $userid=$ck_login_userid;
    $checkintern=1;
    $lognote="Direct access ".$lognote;
    $pass="check";
}

if ($pass=="check") include("../req/passcheck.php");

$errbuf="$LDPhoneDir $LDNewData";

require("../req/passcheck_head.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">
<P>
<img src="../img/phone.gif" align="absmiddle">
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?="$LDPhoneDir $LDNewData" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><a href="telesuch.php?sid=<? print "$ck_sid&lang=$lang"; ?>"><img src="../img/<?="$lang/$lang" ?>_such-gray.gif" border="0" <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="telesuch_phonelist.php?sid=<? print "$ck_sid&lang=$lang"; ?>"><img src="../img/<?="$lang/$lang" ?>_phonedir-gray.gif" border="0" <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img src="../img/<?="$lang/$lang" ?>_newdata-b.gif" border="0"></td>
</tr>

<? require("../req/passcheck_mask.php") ?>  
     
<? require("../language/".$lang."/lang_".$lang."_phone.php"); ?>

<p>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','newphone','search')"><?=$LDHow2SearchPhone ?></a><br>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','newphone','dir')"><?=$LDHow2OpenDir ?></a><br>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','newphone','newphone')"><?=$LDHowEnter ?></a><br>
<HR>
<p>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</FONT>
</BODY>
</HTML>
