<?php
/* These are functions for image routines */

# Initialize themes and paths
//$theme_control='blue_aqua'; // Temporary initial theme
//$theme_control='aqua'; // Temporary initial theme
//$theme_control=$GLOBAL_CONFIG['theme_control_buttons'];
//$theme_com_icon='default'; // Temporary initial theme
//$theme_com_icon='winter_jelias'; // Temporary initial theme



# Create global config object

if(!isset($GLOBAL_CONFIG)||!is_array($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
require_once(CARE_BASE . '/include/core/class_globalconfig.php');
$gc=new GlobalConfig($GLOBAL_CONFIG);


# Set the control buttons theme

if(!isset($cfg['control_buttons'])||empty($cfg['control_buttons'])){
	$gc->getConfig('theme_control_buttons');
	if(!isset($GLOBAL_CONFIG['theme_control_buttons'])||empty($GLOBAL_CONFIG['theme_control_buttons'])){
		$theme_control='default'; // this is the last default theme if the global item is not available, change this to the desired theme
	}else{
		$theme_control=$GLOBAL_CONFIG['theme_control_buttons'];
	}
}else{
	$theme_control=$cfg['control_buttons'];
}

# Set the common icons theme/style

if(!isset($cfg['icons'])||empty($cfg['icons'])){
	$gc->getConfig('theme_common_icons');
	if(!isset($GLOBAL_CONFIG['theme_common_icons'])||empty($GLOBAL_CONFIG['theme_common_icons'])){
		$theme_com_icon='default'; // this is the last default theme if the global item is not available, change this to the desired theme
	}else{
		$theme_com_icon=$GLOBAL_CONFIG['theme_common_icons'];
	}
}else{
	$theme_com_icon=$cfg['icons'];
}

$theme_skin='default';

$img_path_control='gui/img/control/'.$theme_control.'/';  # the path for language dependent control buttons
$img_path_com_icon='gui/img/common/'.$theme_com_icon.'/'; # the path for non-language dependent common icons
$img_path_skin='gui/img/skin/'.$theme_skin.'/'; # the path for non-language dependent

/**
 * createLDImgSrc will display a language dependent image
 * if the filename does not exists, the default version will be displayed
 * It also receives the root of the image and creates the width and height values
 * param $fn = filename of the image
 * param $froot = root of the image
 * param $align = alignment of the image
 * param $border = image border value
 * return = root + image filename
 */

function createLDImgSrc($froot, $fn, $border='', $align='')
{
	global $lang, $theme_control, $img_path_control;
	$froot = CARE_GUI;
	//return 1;
	if(file_exists($froot.$img_path_control.$lang.'/'.$lang.'_'.$fn)){
		$picfile_path=$froot.$img_path_control.$lang.'/'.$lang.'_'.$fn;
		//$picsize=getimagesize($picfile_path);
		$picfile_path=CARE_GUI.$img_path_control.$lang.'/'.$lang.'_'.$fn;
	}elseif(file_exists($froot.'gui/img/control/default/'.$lang.'/'.$lang.'_'.$fn)){
		$picfile_path=$froot.'gui/img/control/default/'.$lang.'/'.$lang.'_'.$fn;
		//$picsize=getimagesize($picfile_path);
		$picfile_path=CARE_GUI.'gui/img/control/default/'.$lang.'/'.$lang.'_'.$fn;
	}else{
		$picfile_path=$froot.'gui/img/control/default/'.LANG_DEFAULT.'/'.LANG_DEFAULT.'_'.$fn;
		//$picsize=getimagesize($picfile_path);
		$picfile_path=CARE_GUI.'gui/img/control/default/'.LANG_DEFAULT.'/'.LANG_DEFAULT.'_'.$fn;
	}

	//	$picsize=getimagesize($picfile_path);
	 
	$picfilesrc='src="'.$picfile_path.'"';
	if($border!='') $picfilesrc.=' border='.$border;
	if($align) $picfilesrc.=' align="'.$align.'"';
	 
	//$picfilesrc.=' '.$picsize[3];
	 
	return $picfilesrc;
}

/**
 * createComIcom = create common icon
 * displays the common non-language dependent icon
 * param 1 = root path
 * param 2 = icon's file name
 * param 3 = border size
 * param 4 = alignment
 * param 5 = FALSE = the icon can be hidden based on the user config, TRUE = the icon will be shown always
 */
function createComIcon($froot, $fn, $border='', $align='', $show_always=TRUE)
{
	global $lang, $theme_com_icon, $img_path_com_icon;
	$froot = CARE_GUI;
	# if icon theme is  "no_icon", return a transparent pixel gif
	if($theme_com_icon == 'no_icon' && !$show_always){
		$picfile_path=$froot.'gui/img/common/default/pixel.gif';
		//$picsize= getimagesize($picfile_path);
		$picfile_path=CARE_GUI.'gui/img/common/default/pixel.gif';
	} elseif(file_exists($froot.$img_path_com_icon.$fn)){
		$picfile_path=$froot.$img_path_com_icon.$fn;
		// $picsize= getimagesize($picfile_path);
		$picfile_path=CARE_GUI.$img_path_com_icon.$fn;
	} else {
		$picfile_path=$froot.'gui/img/common/default/'.$fn;
		//   $picsize= getimagesize($picfile_path);
		$picfile_path=CARE_GUI.'gui/img/common/default/'.$fn;
	}
	 


	 
	$picfilesrc='src="'.$picfile_path.'"';
	if($border!='') $picfilesrc.=' border='.$border;
	if($align) $picfilesrc.=' align="'.$align.'"';
	 
	//$picfilesrc.=' '.$picsize[3];
	 
	return $picfilesrc;
}


/**
 *  createBgSkin will return the correct file path for the skin and background image
 */
function createBgSkin($froot,$fn)
{
	global $lang, $theme_skin, $img_path_skin;
	$froot = CARE_GUI;
	if(file_exists($froot.$img_path_skin.$fn))
	{
		$picfile_path=$froot.$img_path_skin.$fn;
	}
	else
	{
		$picfile_path=$froot.'gui/img/skin/default/'.$fn;
	}


	return $picfile_path;
}
 
/**
 *  createLogo creates a logo image
 */
function createLogo(){

	$froot = CARE_GUI;
	$img_path_com_icon='uploads/logos/';
	$fn = 'care_logo.png';

	return "src='$froot$img_path_com_icon$fn'";
}
/**
 * Checks if the given icon (or non-language dependent image) exists
 */
function image_exists($froot, $fn)
{
	global $lang,  $img_path_com_con;
	$froot = CARE_GUI;
	if(file_exists($froot.$img_path_com_icon.$fn)){
		return TRUE;
	}else{
		return FALSE;
	}
}
/**
 * Checks if the language dependent image exists
 */
function lang_image_exists($froot, $fn)
{
	$froot = CARE_GUI;
	global $lang, $img_path_control;
	 
	if(file_exists($froot.$img_path_control.$lang.'/'.$lang.'_'.$fn)){
		return TRUE;
	}else{
		return FALSE;
	}
}

?>