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
define("MODERATE_NEWS",0);  // define to 1 if news is moderated
define("LANG_FILE","newscolumns.php");
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
$breakfile="startframe.php?sid=".$sid."&lang=".$lang; // default return path if cancel button pressed

// reset all 2nd level lock cookies
require('../include/inc_2level_reset.php'); 

$subtitle=$LDSubTitle[$target];

/* Set the return paths */
switch($target)
{
	case "radiology" : $breakfile="radiolog.php?sid=".$sid."&lang=".$lang; break;
	case "pharmacy" : $breakfile="apotheke.php?sid=".$sid."&lang=".$lang;break;
	case "edp" : $breakfile="edv.php?sid=".$sid."&lang=".$lang;break;
	case "doctors" : $breakfile="aerzte.php?sid=".$sid."&lang=".$lang;break;
	case "nursing" : $breakfile="pflege.php?sid=".$sid."&lang=".$lang;break;
	
	default: $title=$LDTitleTag[$target];

}

switch($user_origin)
{
    case 'amb': $breakfile="ambulatory.php?sid=".$sid."&lang=".$lang;break;
	case 'dept': $breakfile="abteilung.php?sid=".$sid."&lang=".$lang;break;
}

if(!$subtitle) $subtitle=$subtitle=$LDSubTitle['SBDefault'];
		

/* Check whether the content is language dependent */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $newspath='../news_service/'.$lang.'/';
	/* Append lang argument */
	$sql_archive.="AND lang = '".$lang."'";
}
else 
{
    $newspath='../news_service/all_language/';
}

$readerpath="editor-4plus1-read.php?sid=$sid&target=$target&lang=$lang&title=".strtr($title," ","+")."&file=";

$today=date("Y-m-d");


/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
	{	
        $dbtable='care_news_article';
		$news_category=$target;  // set the news category
		$news_num_stop=5;
		include("../include/inc_news_get.php"); // now get the current news


        /* Now set the sql query for article # 5 or the achived news */
        $sql_archive="SELECT title,main_file,author,encode_date,pic_file FROM $dbtable 
					WHERE category='$target' 
						AND main_file<>'".$art[1]['main_file']."' 
						AND main_file<>'".$art[2]['main_file']."' 
						AND main_file<>'".$art[3]['main_file']."' 
						AND main_file<>'".$art[4]['main_file']."'";
						
        /* Check whether the content is language dependent */
        if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
        {
	         /* Append lang argument */
	         $sql_archive.="AND lang = '".$lang."'";
	     }

       if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1))
	    {
           $sql_archive.=" AND status<>'pending'";
        }
		 
		$sql_archive.=" ORDER BY create_time DESC";
		  							
		  if($ergebnis=mysql_query($sql_archive,$link))
       		{
				$rows=mysql_num_rows($ergebnis);
			}
  } 
  else 
  { echo "$LDDbNoLink $sql<br>"; }
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $title ?> Information</TITLE>
 
<script language="">
<!-- Script Begin
function gethelp(x)
{
	urlholder="help-router.php?helpidx="+x+"&lang=<?php echo $lang ?>";
	helpwin=window.open(urlholder,"helpwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
//  Script End -->
</script>

<?php
require('../include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp;<?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('<?php echo $target ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<table border=0 cellpadding=10>
  <tr>
<?php 
for($i=1;$i<5;$i++)
{
	$nofile=0;
	echo '
    <td valign="top" width="50%">';
	if($art[$i])
	{
		$picpath=$newspath.'fotos/'.$art[$i][pic_file];
		if(file_exists($picpath)&&file_exists($newspath.'news/'.$art[$i][head_file]))
		{
			$picsize=getimagesize($picpath);
			echo '
			<img src="'.$picpath.'" border=0 align="left" ';
			if(!$picsize||($picsize[0]>150)) echo 'width="150"';
				else echo $picsize[3];
			echo '>';
		}
		
		if(file_exists($newspath.'news/'.$art[$i][head_file]))
		{
		 include($newspath.'news/'.$art[$i][head_file]);
		 echo'
		 	<a href="'.$readerpath.$art[$i][main_file].'&picfile='.$art[$i][pic_file].'"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</font></a>';
		}
		else $nofile=1;
	} 

	if(!$art[$i]||$nofile)
	{
		echo '
 		<img '.createComIcon('../','pplanu-s.jpg','0','left').'>';
		if(file_exists("../language/".$lang."/lang_".$lang."_newsdummy.php")) include ("../language/".$lang."/lang_".$lang."_newsdummy.php");
		 else include("../language/en/lang_en_newsdummy.php");
	    echo '<a href="editor-pass.php?sid='.$sid.'&lang='.$lang.'&target='.$target.'&user_origin='.$user_origin.'&title='.strtr($title," ","+").'">
	    <font size=1 color="#ff0000" face="arial">'.$LDClk2Compose.'</font></a>';
	}
	echo '
	</td>';
	if($i==2) echo '
	</tr>
	<tr>';
}

?>
    
  </tr>
  <tr>
    <td colspan=2 valign="top">
	
	<FONT    SIZE=4  FACE="Arial">
	
<?php if($rows) : ?>
	<?php echo $subtitle ?>
	<table border=0 cellspacing=0 cellpadding=0>
   <tr>
     <td bgcolor=#0>
	 <table border=0 cellspacing=1 cellpadding=5>
    <tr bgcolor=#ffffff>
      <td><font face="Verdana,arial" size=2 color="#0000cc"><b><?php echo $LDArticle ?></b></font></td>
      <td>&nbsp;</td>
	  <td><font face="Verdana,arial" size=2 color="#0000cc"><b><?php echo $LDWrittenBy ?>:</b></font></td>
      <td><font face="Verdana,arial" size=2 color="#0000cc"><b><?php echo $LDWrittenOn ?>:</b></font></td>
    </tr>
<?php while($artikel=mysql_fetch_array($ergebnis))
{
echo '<tr bgcolor="#ffffff"><td><a href="#"><a href="'.$readerpath.$artikel[main_file].'&picfile='.$artikel[pic_file].'"><font face=verdana,arial size=2> '.$artikel[title].'</a></td>
		<td><font face=verdana,arial size=2><a href="'.$readerpath.$artikel[main_file].'&picfile='.$artikel[pic_file].'"><img '.createComIcon('../','info.gif','0').' alt="'.$LDClk2Read.'"></a></td>		
		<td><font face=verdana,arial size=2> '.$artikel[author].'</td>
		<td><font face=verdana,arial size=2><nobr> '.$artikel[encode_date].'</td></tr>';
echo "\r\n";
}
?>
  </table>
  
	 </td>
   </tr>
 </table>
	
	</td>
  </tr>
</table>


 
<?php endif ?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','back2.gif','0','middle').' alt="'.$LDBackTxt.'"'; ?>></a>

<p>

</FONT>
</td>
</tr>
<tr valign=top>
<td bgcolor="<?php echo $cfg['bot_bgcolor']; ?>" colspan=2> 
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
