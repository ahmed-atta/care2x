<?php
/* These are functions for image routines */

/* Initialize themes and paths */
$theme_control='default'; // Temporary initial theme
//$theme_control='aqua'; // Temporary initial theme
$theme_com_icon='default'; // Temporary initial theme
//$theme_mascot='none';
$theme_mascot='default';
$theme_skin='default';

$img_path_control='gui/img/control/'.$theme_control.'/';  // the path for language dependent control buttons
$img_path_com_icon='gui/img/common/'.$theme_com_icon.'/'; // the path for non-language dependent common icons
$img_path_mascot='gui/img/mascot/'.$theme_mascot.'/'; // the path for non-language dependent mascot
$img_path_skin='gui/img/skin/'.$theme_skin.'/'; // the path for non-language dependent mascot

/**
* showLDImg will display a language dependent image
* if the filename does not exists, the default version will be displayed
*/
function showLDImg($fn)
{
   global $lang;
   
   if(file_exists('../img/'.$lang.'/'.$lang.'_'.$fn)) return ('../img/'.$lang.'/'.$lang.'_'.$fn);
     else return ('../img/'.LANG_DEFAULT.'/'.LANG_DEFAULT.'_'.$fn);
}

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
   
   
   if(file_exists($froot.$img_path_control.$lang.'/'.$lang.'_'.$fn))
   {
      $picfile_path=$froot.$img_path_control.$lang.'/'.$lang.'_'.$fn;
    }
     else
   {
      $picfile_path=$froot.'gui/img/control/default/'.LANG_DEFAULT.'/'.LANG_DEFAULT.'_'.$fn;
    }
	
	$picsize=GetImageSize($picfile_path);
	  
	$picfilesrc='src="'.$picfile_path.'"';  
	if($border!='') $picfilesrc.=' border='.$border;
	if($align) $picfilesrc.=' align="'.$align.'"';
	  
	$picfilesrc.=' '.$picsize[3];
	  
	return $picfilesrc;
}

/**
* createComIcom = create common icon
* displays the common non-language dependent icon
*/
function createComIcon($froot, $fn, $border='', $align='')
{
   global $lang, $theme_com_icon, $img_path_com_icon;
   
   if(file_exists($froot.$img_path_com_icon.$fn))
   {
      $picfile_path=$froot.$img_path_com_icon.$fn;
    }
	else
	{
        $picfile_path=$froot.'gui/img/common/default/'.$fn;
	}
   
	
	$picsize= @ GetImageSize($picfile_path);
	  
	$picfilesrc='src="'.$picfile_path.'"';  
	if($border!='') $picfilesrc.=' border='.$border;
	if($align) $picfilesrc.=' align="'.$align.'"';
	  
	$picfilesrc.=' '.$picsize[3];
	  
	return $picfilesrc;
}

/**
* createMascot = create mascot 
* displays the non-language dependent mascot
*/
function createMascot($froot, $fn, $border='', $align='')
{
   global $lang, $theme_mascot, $img_path_mascot;
   
   if(file_exists($froot.$img_path_mascot.$fn))
   {
      $picfile_path=$froot.$img_path_mascot.$fn;
    }
	else
	{
        $picfile_path=$froot.'gui/img/mascot/default/'.$fn;
	}
	
	$picsize= @ GetImageSize($picfile_path);
	  
	$picfilesrc='src="'.$picfile_path.'"';  
	if($border!='') $picfilesrc.=' border='.$border;
	if($align) $picfilesrc.=' align="'.$align.'"';
	  
	$picfilesrc.=' '.$picsize[3];
	  
	return $picfilesrc;
}

/**
*  createBgSkin will return the correct file path for the skin and background image
*/
function createBgSkin($froot,$fn)
{
   global $lang, $theme_skin, $img_path_skin;
   
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
   
?>
