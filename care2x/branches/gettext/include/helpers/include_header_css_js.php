<?php

echo '<link rel="stylesheet" href="'.CARE_GUI. '/gui/css/themes/default/bootstrap-1.1.0.css" type="text/css">';
echo '<link rel="stylesheet" href="'.CARE_GUI. '/gui/css/themes/default/gh-buttons.css" type="text/css">';
echo '
<script src="'.CARE_GUI.'js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="'.CARE_GUI.'js/colorbox/js/jquery.colorbox-min.js" type="text/javascript"></script>
<link type="text/css" media="screen" rel="stylesheet" href="'.CARE_GUI.'js/colorbox/styles/4/colorbox.css" />
<script type="text/javascript">
$(function(){
		$(".help").click(function(){
			if(!$(this).attr("href").match("^javascript"))
				$(this).colorbox({iframe:true, innerWidth:500, innerHeight:344});
		});
	}
)
</script>

';

?>

<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("<?php echo CARE_GUI   ?>main/pop_reg_pic.php<?php echo URL_REDIRECT_APPEND ?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}

function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="<?php echo CARE_GUI ; ?>include/help/help-router.php<?php echo URL_REDIRECT_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>