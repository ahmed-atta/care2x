<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
		
if (($sid==NULL)||($sid!=$ck_sid)||!$ck_editor_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_editor.php");

if(($artnum)&&($mode=="save"))
{
if($artnum==2) $palign="right"; else $palign="left";

$pd=explode(".",$publishdate);
$pd=array_reverse($pd);
$publishdate=implode("",$pd);


$newstitle=stripslashes($newstitle);
$preface=stripslashes($preface);
$newsbody=stripslashes($newsbody);

$titlebuf=str_replace(" ","",$newstitle);
$titlebuf=strtr($titlebuf,"/%&!?.*'#[]{}§ÄÖÜäöü","~~~~~~~~~~~~~~AOUaou");
$titlebuf=str_replace("~","",$titlebuf);
$titlebuf=str_replace("\"","",$titlebuf);
// now save the newsbody to file in html format

// if a pic file is uploaded move it to the right dir
if($HTTP_POST_FILES['pic']['tmp_name']&&$HTTP_POST_FILES['pic']['size'])
{
	$picext=substr($HTTP_POST_FILES['pic']['name'],strrpos($HTTP_POST_FILES['pic']['name'],".")+1);
	$picfilename=$titlebuf.'.'.$picext;
	//$movefile='rename("'.$HTTP_POST_FILES['pic']['tmp_name'].'","../news_service/'.$lang.'/fotos/'.$picfilename.'");';
	//eval($movefile);
	copy($HTTP_POST_FILES['pic']['tmp_name'],"../news_service/$lang/fotos/headline_".$picfilename);
}


	
$fname="../news_service/".$lang."/news/head_headline_".$titlebuf.".htm";
// now write the header file in html format
if($fp=fopen($fname,"w+"))
{
	$line='<font face="verdana,arial" size="+1" color="#cc0000">'.ucfirst($newstitle).'</font><br><font size=-1 color="#000000" face="arial"><b>'.$preface.'</b></font><p>';
	fwrite($fp,$line);
	$line='<font size=-1 color="#000000" face="helvetica,arial">'.nl2br(substr($newsbody,0,300)).'...</font>';
	fwrite($fp,$line);
	fclose($fp);
}
// now write the main file in html format
$fname="../news_service/".$lang."/news/headline_".$titlebuf.".htm";
if($fp=fopen($fname,"w+"))
{
	$line='<font face="verdana,arial" size="+3" color="#cc0000">'.ucfirst($newstitle).'</font><br><font size=-1 color="#000000" face="arial"><b>'.$preface.'</b></font><p>';
	fwrite($fp,$line);
	$line='<font size=-1 color="#000000" face="helvetica,arial">'.nl2br($newsbody).'<p>'.$LDWrittenOn.' '.date("d.m.Y").' '.$LDWrittenFrom.' '.$author.' </font>';
	fwrite($fp,$line);
	fclose($fp);
}
$dbtable="news_article_".$lang;
// now save in the databank the app. info
include("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	

		 	$sql="INSERT INTO $dbtable 
						(	category,
							title,
							art_num,
							head_file,
							main_file,
							pic_file,
							author,
							encode_date,
							publish_date,
							logged_encoder
							) VALUES 
						(	'headline',
							'$title',
							'$artnum',
							'head_headline_".$titlebuf.".htm',
							'headline_".$titlebuf.".htm',
							'headline_".$picfilename."',
							'$author',
							'".date("d.m.Y")."',
							'$publishdate',
							'$ck_cafenews_user'
							)";

			if($ergebnis=mysql_query($sql,$link))
       		{
				header("Location: headline-read.php?sid=$ck_sid&&lang=$lang&mode=preview4saved&file=headline_".$titlebuf.".htm&picfile=headline_".$picfilename."&palign=$palign&title=$title"); exit;
			}
				else print "<p>".$sql."<p>$LDDbNoSave"; 

	
  } else { print "$LDDbNoLink $sql<br>"; }

}

?>
