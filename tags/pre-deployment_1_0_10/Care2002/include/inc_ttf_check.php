<?php
# This subroutine detects the ttf capability of the system and checks if the arial font is available

# If you want to enable ttf font rendering, set the following variable to TRUE.
# In some cases, if your system detects ttf capability but the text does not appear, you have to disable
# ttf font rendering. By default, ttf rendering is disabled due to inconsequent results from different php versions.

$ttf_render=FALSE;	

if($ttf_render){
	$font_path=$root_path.'main/imgcreator/';
	$ttf_ok=FALSE;
	# Check if TTF text possible
	if(function_exists(ImageTTFText)){
		# Workaround to avoid upper/lower case error
		if(file_exists($font_path.'arial.ttf')){
			$ttf_ok=TRUE;
			$arial=$font_path.'arial.ttf';
		}elseif(file_exists($font_path.'ARIAL.TTF')){
			$ttf_ok=TRUE;
			$arial=$font_path.'ARIAL.TTF';
		}
	}
}else{
	$ttf_ok=FALSE;
}

?>
