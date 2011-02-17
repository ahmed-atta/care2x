<?php

if(isset($cfg['css']) && !empty($cfg['css']) && file_exists($root_path.'css/themes/'.$cfg['css'])){
	$sCssFile =$root_path.'css/themes/'.$cfg['css'];
}else{
	$sCssFile=$root_path.'css/themes/default/default.css';
}

echo '<link rel="stylesheet" href="'.$sCssFile.'" type="text/css">';

//TODO: provide these scripts to care2x project and do not take it from internet
if($cfg['dhtml']){

/*
echo '
	<link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/standalone.css"/>	
	<link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/tabs.css" />
';
*/

//TODO: provide these scripts to care2x project and do not take it from internet
echo '
<script language="javascript" src="'.$root_path.'js/hilitebu.js"></script>

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

 if(pid!="") regpicwindow = window.open("<?php echo $root_path ?>main/pop_reg_pic.php<?php echo URL_REDIRECT_APPEND ?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>
