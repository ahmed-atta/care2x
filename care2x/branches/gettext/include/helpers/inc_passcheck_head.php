<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_passcheck_head.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
?>
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
<script language="javascript">
<!-- 
function pruf(d)
{
	if((d.userid.value=="")&&(d.keyword.value=="")) return false;
}

// -->
</script>
 
 <?php 
require($root_path.'include/helpers/inc_js_gethelp.php');
include($root_path.'include/helpers/inc_css_a_hilitebu.php');
?>
 
</HEAD>
