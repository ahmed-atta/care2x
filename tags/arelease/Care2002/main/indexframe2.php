<?php
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
//if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

require("../req/config-color.php");

	
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<script language="">
<!-- Script Begin
function openmenuwin() {
menuwin=window.open("indexframe.php?lang=<?=$lang ?>&nonewmask=1","menuwin","width=180,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
function killmenu() {
if (window.menuwin)  window.menuwin.close();
}
//  Script End -->
</script>
</HEAD>

<BODY  marginwidth=0 marginheight=0 topmargin=0 leftmargin=0 onUnload="killmenu()" onLoad="if (window.focus) window.focus();
<? if($boot) print 'window.parent.CONTENTS.location.replace(\'startframe.php?sid='.$ck_sid.'&lang='.$lang.'&cookie='.$cookie.'\') ';
?>
"
<?
print 'bgcolor='.$cfg['idx_bgcolor'];
 if(!$cfg['dhtml']) print ' link='.$cfg['idx_txtcolor'].' vlink='.$cfg['idx_txtcolor'].' alink='.$cfg['idx_alink']; ?> >
<a href="javascript:openmenuwin();"> <button onClick="javascript:openmenuwin();">MENU</button></a>
</BODY>
</HTML>
