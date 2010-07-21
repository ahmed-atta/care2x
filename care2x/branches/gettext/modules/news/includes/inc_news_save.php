<?php
if (stristr("inc_news_save.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

# Load editor functions
require_once($root_path.'modules/news/includes/inc_editor_fx.php');
# Load date formatter
require_once($root_path.'include/helpers/inc_date_format_functions.php');
# Load image class 
require_once($root_path.'modules/photolab/model/class_image.php');
# Create image object
$img_obj=new Image;

# Clean the content
$newstitle=stripslashes($newstitle);
$preface=stripslashes($preface);
$newsbody=stripslashes($newsbody);

if (!isset($category)) $category=1;

# Clean the title
require('inc_newstitle_clean.php');
# Check if the uploaded image file is valid
$is_pic=@$img_obj->isValidUploadedImage($_FILES['pic']);
# Retrieve the filename extension
$picext=@$img_obj->UploadedImageMimeType();

$publishdate=@ formatDate2Std($publishdate,$date_format);
	
/* Prepare data set for saving */
$news=array( 'category'=>$category,
                     'title'=>$newstitle,
					 'preface'=>$preface,
					 'body'=>$newsbody,
					 'pic_mime'=>$picext,
					 'art_num'=>$artnum,
					 'author'=>$author,
					 'publish_date'=>$publishdate
					 );

require_once($root_path.'modules/news/model/class_news.php');
$newsobj=new News;
if($news_nr = $newsobj->saveNews($dept_nr,$news)) {
    if($is_pic)	{
	    # Get the news photo path from global config 					
		require_once($root_path.'include/core/class_globalconfig.php');    
        $globobj=new GlobalConfig($GLOBALCONFIG);
		$globobj->getConfig('news_photos_path');
					
	    if($GLOBALCONFIG['news_photos_path']=='') $news_photos_path=$root_path.'/uploads/photos/news/'; /* default path */
	        else $news_photos_path = $root_path.$GLOBALCONFIG['news_photos_path']; 
				
	    $picfilename="$news_nr.$picext";
        $img_obj->saveUploadedImage($_FILES['pic'],$news_photos_path,$picfilename);
	}
	header('Location: '.$fileforward.URL_REDIRECT_APPEND.'&nr='.$news_nr.'&mode=preview4saved'); exit;
}else{
    echo $img_obj->getLastQuery()."<p>$LDDbNoSave";
} 
?>