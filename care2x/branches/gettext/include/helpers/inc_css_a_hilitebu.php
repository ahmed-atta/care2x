<?php
if(isset($cfg['css']) && !empty($cfg['css']) && file_exists( CARE_GUI. '/gui/css/themes/'.$cfg['css'])){
	$sCssFile = CARE_GUI.  '/gui/css/themes/'.$cfg['css'];
}else{
	$sCssFile=  CARE_GUI. '/gui/css/themes/default/default.css';
}
echo '<link rel="stylesheet" href="'.$sCssFile.'" type="text/css">';

if($cfg['dhtml']){

echo '
<STYLE TYPE="text/css">
A:link  {color: '.$cfg['body_txtcolor'].';}
A:hover {color: '.$cfg['body_hover'].';}
A:active {color: '.$cfg['body_alink'].';}
A:visited {color: '.$cfg['body_txtcolor'].';}
A:visited:active {color: '.$cfg['body_alink'].';}
A:visited:hover {color: '.$cfg['body_hover'].';}
</style>';
}
?>

<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("<?php echo CARE_BASE   ?>main/pop_reg_pic.php<?php echo URL_REDIRECT_APPEND ?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>
