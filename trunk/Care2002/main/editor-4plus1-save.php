<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_editor_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_editor_fx.php');

/* Load date formatter */
require_once('../include/inc_date_format_functions.php');


/* Check whether the content is language dependent */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $newspath='../news_service/'.$lang.'/';
}
else 
{
    $newspath='../news_service/all_language/';
}

if(($artnum)&&($mode=='save'))
{

$newstitle=stripslashes($newstitle);
$preface=stripslashes($preface);
$newsbody=stripslashes($newsbody);

/* We clean the $newstitle value */
require('../include/inc_newstitle_clean.php');

// if a pic file is uploaded move it to the right dir
if($HTTP_POST_FILES['pic']['size'] && is_uploaded_file($HTTP_POST_FILES['pic']['tmp_name']))
{
	$picext=substr($HTTP_POST_FILES['pic']['name'],strrpos($HTTP_POST_FILES['pic']['name'],".")+1);
    if(stristr($picext,'gif')||stristr($picext,'jpg'))
	{
        $picfilename=$titlebuf.'.'.$picext;
        //$movefile='rename("'.$HTTP_POST_FILES['pic']['tmp_name'].'","../news_service/'.$lang.'/fotos/'.$picfilename.'");';
        //eval($movefile);
        copy($HTTP_POST_FILES['pic']['tmp_name'],$newspath.'fotos/'.$target.'_'.$picfilename);
	}
	else
	{
		$picfilename='nopic';
	}
}

	
$fname=$newspath.'news/head_'.$target.'_'.$titlebuf.'.htm';
// now write the header file in html format
if($fp=fopen($fname,'w+'))
{
	$line='<font face="arial" size="+1" color="#cc0000">'.ucfirst($newstitle).'</font><br><font size=-1 color="#000000" face="arial"><b>'.$preface.'</b></font><p>';
	fwrite($fp,$line);
	$line='<font size=-1 color="#000000" face="arial">'.nl2br(substr(deactivateHotHtml($newsbody),0,300)).'...</font>';
	fwrite($fp,$line);
	fclose($fp);
}
// now write the main file in html format
$fname=$newspath.'news/'.$target.'_'.$titlebuf.'.htm';
if($fp=fopen($fname,'w+'))
{
	$line='<font face="arial" size="+2" color="#cc0000">'.ucfirst($newstitle).'</font><br><font size=-1 color="#000000" face="arial"><b>'.$preface.'</b></font><p>';
	fwrite($fp,$line);
	$line='<font size=-1 color="#000000" face="arial">'.nl2br(deactivateHotHtml($newsbody)).'<p>'.$LDWrittenOn.': '.formatDate2Local(date('Y-m-d'),$date_format).' '.$LDWrittenFrom.' '.$author.' </font>';
	fwrite($fp,$line);
	fclose($fp);
}
// now save in the databank the app. info
$dbtable='care_news_article';
include('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
	{	
        include_once('../include/inc_date_format_functions.php');
        //
		 	$sql="INSERT INTO $dbtable 
						(	
						    lang,
							category,
							title,
							art_num,
							head_file,
							main_file,
							pic_file,
							author,
							encode_date,
							publish_date,
							modify_time,
							create_id,
							create_time
							) VALUES 
						(	
						    '".$lang."',
							'".$target."',
							'".addslashes($newstitle)."',
							'$artnum',
							'head_".$target."_".$titlebuf.".htm',
							'".$target."_".$titlebuf.".htm',
							'".$target."_".$picfilename."',
							'$author',
							'".date("Y-m-d H:i:s")."',
							'".formatDate2STD($publishdate,$date_format)."',
							'',
							'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
							NULL
							)";

			if($ergebnis=mysql_query($sql,$link))
       		{
				header("Location: editor-4plus1-read.php?sid=$sid&lang=$lang&target=$target&user_origin=$user_origin&title=".strtr($title," ","+")."&mode=preview4saved&file=".$target."_".$titlebuf.".htm&picfile=".$target."_".$picfilename); exit;
			}
				else echo "<p>".$sql."<p>$LDDbNoSave."; 

  } else { echo "$LDDbNoLink $sql<br>"; }
}
?>
