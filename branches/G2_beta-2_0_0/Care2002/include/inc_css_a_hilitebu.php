<?php 

if($cfg['dhtml'])
{ print' 
	<script language="javascript" src="'.$root_path.'js/hilitebu.js">
	</script>



	<STYLE TYPE="text/css">

	A:link  {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	</style>';
}

?>
<script language="JavaScript">
<!--
function popPic(pid,nm){

	if(pid!="") regpicwindow = window.open("<?php echo $root_path ?>main/pop_reg_pic.php<?php echo URL_REDIRECT_APPEND ?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>
