<?php
if(isset($cfg['css']) && !empty($cfg['css']) && file_exists( CARE_GUI. '/gui/css/themes/'.$cfg['css'])){
	$sCssFile = CARE_GUI.  '/gui/css/themes/'.$cfg['css'];
}else{
	$sCssFile=  CARE_GUI. '/gui/css/themes/default/default.css';
}
echo '<link rel="stylesheet" href="'.$sCssFile.'" type="text/css">';
echo '
<script src="'.CARE_GUI.'js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="'.CARE_GUI.'js/uniform/jquery.uniform.js" type="text/javascript"></script>
<link rel="stylesheet" href="'.CARE_GUI.'js/uniform/css/uniform.default.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript">
$(function(){
		$("select, input:checkbox, input:radio, input:file, input:text").uniform();
	}
)
</script>';

?>

<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("<?php echo CARE_BASE   ?>main/pop_reg_pic.php<?php echo URL_REDIRECT_APPEND ?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>
