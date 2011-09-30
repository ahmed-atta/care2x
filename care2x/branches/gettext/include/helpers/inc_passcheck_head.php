<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($PHP_SELF, 'inc_passcheck_head.php')) die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
?>
<?php html_rtl($lang); ?>
<HEAD>

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
require(CARE_BASE .'include/helpers/inc_js_gethelp.php');
include(CARE_BASE .'include/helpers/inc_css_a_hilitebu.php');
?>
 
</HEAD>