<?php html_rtl($lang); ?>
<HEAD>
<?php echo $charset; ?>
<TITLE><?php echo $wintitle; ?></TITLE>
<?php
//set the css style for a links
require($root_path.'include/inc_css_a_sublinker_d.php');
?>

<script language="javascript">
function changeLanguage(lang)
{
    <?php if(($cfg[mask]==1)||($cfg[mask]==""))  echo "window.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1&_chg_lang_=1\");";
	 else echo "window.opener.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 ?>
	return false;
}
function checkIfChanged(lang)
{
	if(lang=="<?php echo $lang; ?>") return false;
		else changeLanguage(lang);
}
</script>
</HEAD>
 
 <?php
 # Prepare values for body template
if($boot){
	 $TP_js_onload= 'onLoad="if (window.focus) window.focus();window.parent.CONTENTS.location.replace(\'startframe.php?sid='.$sid.'&lang='.$lang.'&egal='.$egal.'&cookie='.$cookie.'\');"';
}else{
	$TP_js_onload='onLoad="if (window.focus) window.focus();"';
}

$TP_bgcolor='bgcolor="'.$cfg['idx_bgcolor'].'"';

if(!$cfg['dhtml']){
	 $TP_link='link="'.$cfg['idx_txtcolor'].'"';
	 $TP_vlink='vlink="'.$cfg['idx_txtcolor'].'"';
	 $TP_alink='alink="'.$cfg['idx_alink'].'"';
}else{
	 $TP_link='';
	 $TP_vlink='';
	 $TP_alink='';
}


$TP_logo=createLogo($root_path,'care_logo.gif','0');
# Load the template
$tp_body=&$TP_obj->load('tp_main_index_menu_body.htm');
eval("echo $tp_body;");
?>

<TABLE CELLPADDING=0 CELLSPACING=0 border=0  dir=ltr>

<?php
//echo $HTTP_COOKIE_VARS['ck_config']; // used only in debugging related to user config data
if($result){
	$gui='';
	$TP_img1= '<img '.createComIcon($root_path,'blue_bullet.gif','0','middle').'>';
	
	$TP_com_img_path=$root_path.'gui/img/common';
	$buf='';
	# Load the menu item template
	$tp =&$TP_obj->load('tp_main_index_menu_item.htm');
	while($menu=$result->FetchRow()){
		if (eregi('LDLogin',$menu['LD_var'])){
			if ($HTTP_COOKIE_VARS['ck_login_logged'.$sid]=='true'){
				$menu['url']='main/logout_confirm.php';
				$menu['LD_var']='LDLogout';
			}	
		}
		$TP_menu_item='<a href="'.$root_path.$menu['url'].URL_APPEND.'" TARGET="CONTENTS" REL="child">';
		if(isset($$menu['LD_var'])&&!empty($$menu['LD_var'])) $TP_menu_item.=$$menu['LD_var'];
			else $TP_menu_item.=$menu['name'];
		$TP_menu_item.='</A>';
		eval("echo $tp;");
	}
	echo $gui;
}

if(!$GLOBALCONFIG['language_single']){
?>
<tr>
<td colspan=3>
<FONT  FACE="Arial"  SIZE="-1">
<form action="#" onSubmit="return checkIfChanged(this.lang.value)">
<hr>
<?php echo $LDLanguage ?><br>
 <select name="lang"> 
<?php

require($root_path.'include/care_api_classes/class_language.php');
$lang_obj=new Language;
$langselect= $lang_obj->createSelectForm($lang);
echo $langselect;
?>
</select>
<br>
<input type="submit" value="<?php echo $LDChange ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mask" value="<?php echo $mask ?>">
<input type="hidden" name="egal" value="1">
<input type="hidden" name="chg_lang" value="1">
<hr>
</td>
</tr>
<?php
}
?>

<tr >
<td colspan=3>
<font FACE="Arial" SIZE=1 color="#6f6f6f"><nobr><b><?php echo $LDUser ?>:</b></nobr><br>
<?php echo  $HTTP_SESSION_VARS['sess_login_username']; ?><br>
<?php echo $dept->FormalName($cfg['thispc_dept_nr']); ?><br>
<?php echo $ward->WardName($cfg['thispc_ward_nr']); ?><br>
</FONT>
</td>
</tr>
</form>
</FONT>
</TABLE>
<center>
<a href="http://www.opensource.org/" target="_blank"><img src="<?php echo $root_path ?>gui/img/common/default/osilogo.gif" border=0></a>
</center>
</BODY>
</HTML>
