<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.07 - 2003-08-29
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","indexframe.php");
//define('NO_2LEVEL_CHK',1);
define("NO_CHAIN",1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');

	
?>
<HTML>
<HEAD>
<?php echo setCharSet(); ?>


<script language="">
<!-- Script Begin
function openmenuwin() {
menuwin=window.open("indexframe.php?<?php echo "sid=$sid&lang=$lang" ?>&nonewmask=1","menuwin_<?php echo $sid ?>","width=180,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
function killmenu() {
if (window.menuwin)  window.menuwin.close();
}
//  Script End -->
</script>
</HEAD>

<BODY  marginwidth=0 marginheight=0 topmargin=0 leftmargin=0 onUnload="killmenu()" onLoad="if (window.focus) window.focus();
<?php if($boot) echo 'window.parent.CONTENTS.location.replace(\'startframe.php?sid='.$sid.'&lang='.$lang.'&cookie='.$cookie.'\') ';
?>
"
<?php
echo 'bgcolor='.$cfg['idx_bgcolor'];
 if(!$cfg['dhtml']) echo ' link='.$cfg['idx_txtcolor'].' vlink='.$cfg['idx_txtcolor'].' alink='.$cfg['idx_alink']; ?> >
<a href="javascript:openmenuwin();"> <button onClick="javascript:openmenuwin();">MENU</button></a>
</BODY>
</HTML>
