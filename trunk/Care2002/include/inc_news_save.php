<?php
if (eregi("inc_news_save.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/* Load editor functions */
require_once($root_path.'include/inc_editor_fx.php');

/* Load date formatter */
require_once($root_path.'include/inc_date_format_functions.php');

/* Clean the content */
$newstitle=stripslashes($newstitle);
$preface=stripslashes($preface);
$newsbody=stripslashes($newsbody);

if (!isset($category)) $category=1;

/* Clean the title */
require($root_path.'include/inc_newstitle_clean.php');

$is_pic=0;
// if a pic file is uploaded move it to the right dir
if(is_uploaded_file($HTTP_POST_FILES['pic']['tmp_name']) && $HTTP_POST_FILES['pic']['size'])
{
    $picext=substr($HTTP_POST_FILES['pic']['name'],strrpos($HTTP_POST_FILES['pic']['name'],'.')+1);
                    
    if(stristr($picext,'jpg')||stristr($picext,'gif'))
    {
        $is_pic=1;	
    }
}

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
					 
					// echo $HTTP_SESSION_VARS['sess_user_name'];
					 //exit;
require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
if($news_nr = $newsobj->saveNews($dept_nr,$news)) {
				
    if($is_pic)	{
	    /* Get the news foto path from global config */
        /*$config_type='news_fotos_path';
        
		include($root_path.'include/inc_get_global_config.php');*/
						
		require_once($root_path.'include/care_api_classes/class_globalconfig.php');    
        $globobj=new GlobalConfig($GLOBALCONFIG);
		$globobj->getConfig('news_fotos_path');
					
	    if($GLOBALCONFIG['news_fotos_path']=='') $news_fotos_path=$root_path.'fotos/news/'; /* default path */
	        else $news_fotos_path = $root_path.$GLOBALCONFIG['news_fotos_path']; 
				
	    $picfilename=$news_nr.'.'.strtolower($picext);
		//$movefile='rename("'.$HTTP_POST_FILES['pic']['tmp_name'].'","../news_service/'.$lang.'/fotos/'.$picfilename.'");';
        //eval($movefile);
        copy($HTTP_POST_FILES['pic']['tmp_name'],$news_fotos_path.$picfilename);
	}
				 			 
	header('Location: '.$fileforward.URL_REDIRECT_APPEND.'&nr='.$news_nr.'&mode=preview4saved'); exit;
} else {
    echo "<p>No save<p>$LDDbNoSave";
} 
?>
