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
/* Set image alignment */
if($artnum==2) $palign='right'; else $palign='left';

$newstitle=stripslashes($newstitle);
$preface=stripslashes($preface);
$newsbody=stripslashes($newsbody);

require('../include/inc_newstitle_clean.php');

// if a pic file is uploaded move it to the right dir
if(is_uploaded_file($HTTP_POST_FILES['pic']['tmp_name']) && $HTTP_POST_FILES['pic']['size'])
{
	$picext=substr($HTTP_POST_FILES['pic']['name'],strrpos($HTTP_POST_FILES['pic']['name'],".")+1);
	if(stristr($picext,'jpg')||stristr($picext,'png')||stristr($picext,'gif'))
	{
	    $picfilename=$titlebuf.'.'.strtolower($picext);
	    //$movefile='rename("'.$HTTP_POST_FILES['pic']['tmp_name'].'","../news_service/'.$lang.'/fotos/'.$picfilename.'");';
	    //eval($movefile);
		
		    copy($HTTP_POST_FILES['pic']['tmp_name'],$newspath.'fotos/headline_'.$picfilename);
	}
}
	
$fname=$newspath.'news/head_headline_'.$titlebuf.'.htm';
// now write the header file in html format
if($fp=fopen($fname,'w+'))
{
	$line='<font face="verdana,arial" size="+1" color="#cc0000">'.ucfirst($newstitle).'</font><br><font size=-1 color="#000000" face="arial"><b>'.$preface.'</b></font><p>';
	fwrite($fp,$line);
	$line='<font size=-1 color="#000000" face="helvetica,arial">'.nl2br(substr(deactivateHotHtml($newsbody),0,300)).'...</font>';
	fwrite($fp,$line);
	fclose($fp);
}
// now write the main file in html format
$fname=$newspath.'news/headline_'.$titlebuf.'.htm';

if($fp=fopen($fname,'w+'))
{
	$line='<font face="verdana,arial" size="+3" color="#cc0000">'.ucfirst($newstitle).'</font><br><font size=-1 color="#000000" face="arial"><b>'.$preface.'</b></font><p>';
	fwrite($fp,$line);
	$line='<font size=-1 color="#000000" face="helvetica,arial">'.nl2br(deactivateHotHtml($newsbody)).'<p>'.$LDWrittenOn.' '.formatDate2Local(date('Y-m-d'),$date_format).' '.$LDWrittenFrom.' '.$author.' </font>';
	fwrite($fp,$line);
	fclose($fp);
}

$dbtable='care_news_article';
include('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
	{	
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
							'headline',
							'".addslashes($newstitle)."',
							'$artnum',
							'head_headline_".$titlebuf.".htm',
							'headline_".$titlebuf.".htm',
							'headline_".$picfilename."',
							'$author',
							'".date("Y-m-d H:i:s")."',
							'".formatDate2STD($publishdate,$date_format)."',
							'',
							'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
							NULL
							)";

			if($ergebnis=mysql_query($sql,$link))
       		{
				header("Location: headline-read.php?sid=$sid&&lang=$lang&mode=preview4saved&file=headline_".$titlebuf.".htm&picfile=headline_".$picfilename."&palign=$palign&title=$title"); exit;
			}
				else echo "<p>".$sql."<p>$LDDbNoSave"; 
  } else { echo "$LDDbNoLink $sql<br>"; }
}
?>
