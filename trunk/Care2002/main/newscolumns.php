<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","newscolumns.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");
$breakfile="startframe.php?sid=$sid&lang=$lang"; // default return path if cancel button pressed

// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php"); 

switch($target)
{
	case "headline":
							$title=$LDTitleTag[$target];
							break;
	case "cafenews":
							$title=$LDTitleTag[$target];
							break;
	case "management":
							$title=$LDTitleTag[$target];
							break;
	case "healthtips":
							$title=$LDTitleTag[$target];
							$subtitle=$LDSubTitle[$target];
							break;
	case "adv_studies":
							$title=$LDTitleTag[$target];
							$subtitle=$LDSubTitle[$target];
							break;
	case "prof_training":
							$title=$LDTitleTag[$target];
							$subtitle=$LDSubTitle[$target];
							break;
	case "physiotherapy":
							$title=$LDTitleTag[$target];
							break;
	case "events":	$title=$LDTitleTag[$target];
							break;
	case "dept_generalsurgery":	$title=$LDTitleTag[$target];
							break;
	case "dept_emergency":	$title=$LDTitleTag[$target];
							break;
	case "dept_plasticsurgery":	$title=$LDTitleTag[$target];
							break;
	case "dept_ent":	$title=$LDTitleTag[$target];
							break;
	case "dept_eyesurgery":	$title=$LDTitleTag[$target];
							break;
	case "dept_pathology":	$title=$LDTitleTag[$target];
							break;
	case "dept_gynecology":	$title=$LDTitleTag[$target];
							break;
	case "dept_internalmed":	$title=$LDTitleTag[$target];
							break;
	case "dept_oncology":	$title=$LDTitleTag[$target];
							break;
	case "dept_techservice":	$title=$LDTitleTag[$target];
							break;
	case "dept_IMCU":	$title=$LDTitleTag[$target];
							break;
	case "dept_ICU":	$title=$LDTitleTag[$target];
							break;
	case "dept_lab":	$title=$LDTitleTag[$target];
							break;
	case "patient_admission":
							$title=$LDTitleTag[$target];
							$subtitle=$LDSubTitle[$target];
							break;
	case "radiology" : $breakfile="radiolog.php?sid=$sid&lang=$lang"; break;
	case "pharmacy" : $breakfile="apotheke.php?sid=$sid&lang=$lang";break;
	case "edp" : $breakfile="edv.php?sid=$sid&lang=$lang";break;
	case "doctors" : $breakfile="aerzte.php?sid=$sid&lang=$lang";break;
	case "nursing" : $breakfile="pflege.php?sid=$sid&lang=$lang";break;
}

if(!$subtitle) $subtitle=$subtitle=$LDSubTitle[SBDefault];

if(strpos($target,"ept_")) $breakfile="abteilung.php?sid=$sid";
	elseif($target=="") $breakfile="startframe.php?sid=$sid";
$newspath="../news_service/$lang/news/";
$readerpath="editor-4plus1-read.php?sid=$sid&target=$target&lang=$lang&title=".strtr($title," ","+")."&file=";

$today=date("Ymd");


require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
		$dbtable="news_article_".$lang;

		for($i=1;$i<5;$i++)
		{
		 	$sql="SELECT head_file,main_file,pic_file FROM $dbtable 
					WHERE category='$target' 
						AND art_num='$i' 
						AND publish_date='$today' 
							ORDER BY tstamp DESC";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $artikel=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$art[$i]=mysql_fetch_array($ergebnis);
				}
				else // if no file found get the last entry
				{
					$sql="SELECT head_file,main_file,pic_file FROM $dbtable 
							WHERE category='$target' 
								AND art_num='$i'  
								AND publish_date<'$today' 
									ORDER BY tstamp DESC";

							if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=0;
								while( $artikel=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$art[$i]=mysql_fetch_array($ergebnis);
								}
								//else $art[$i]=array("head_file"=>"head_dummy".$i.".htm");
								$ergebnis=NULL;
							}
							
				}
			}
		}
		
		 	$sql="SELECT title,main_file,author,encode_date,pic_file FROM $dbtable 
					WHERE category='$target' 
						AND main_file<>'".$art[1][main_file]."' 
						AND main_file<>'".$art[2][main_file]."' 
						AND main_file<>'".$art[3][main_file]."' 
						AND main_file<>'".$art[4][main_file]."' 
							ORDER BY tstamp DESC";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $artikel=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					//print $sql;
				}
			}
  } else { print "$db_noconnect $sql<br>"; }
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp;<?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('<?php echo $target ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<table border=0 cellpadding=10>
  <tr>
<?php 
for($i=1;$i<5;$i++)
{
	$nofile=0;
	print '
    <td valign="top" width="50%">';
	if($art[$i])
	{
		$picpath='../news_service/'.$lang.'/fotos/'.$art[$i][pic_file];
		if(file_exists($picpath)&&file_exists($newspath.$art[$i][head_file]))
		{
			$picsize=getimagesize($picpath);
			print '
			<img src="'.$picpath.'" border=0 align="left" ';
			if(!$picsize||($picsize[0]>150)) print 'width="150"';
				else print $picsize[3];
			print '>';
		}
		
		if(file_exists($newspath.$art[$i][head_file]))
		{
		 include($newspath.$art[$i][head_file]);
		 print'
		 	<a href="'.$readerpath.$art[$i][main_file].'&picfile='.$art[$i][pic_file].'"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</font></a>';
		}
		else $nofile=1;
	} 

	if(!$art[$i]||$nofile)
	{
		print '
 		<img src="../img/pplanu-s.jpg" border=0 width=130 height=98 align="left">';
	 include("../language/".$lang."/lang_".$lang."_newsdummy.php");
	 print '<a href="editor-pass.php?sid='.$sid.'&target='.$target.'&title='.strtr($title," ","+").'&lang='.$lang.'">
	<font size=1 color="#ff0000" face="arial">'.$LDClk2Compose.'</font></a>';
	}
	print '
	</td>';
	if($i==2) print '
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
print '<tr bgcolor="#ffffff"><td><a href="#"><a href="'.$readerpath.$artikel[main_file].'&picfile='.$artikel[pic_file].'"><font face=verdana,arial size=2> '.$artikel[title].'</a></td>
		<td><font face=verdana,arial size=2><a href="'.$readerpath.$artikel[main_file].'&picfile='.$artikel[pic_file].'"><img src="../img/info.gif" border=0 alt="'.$LDClk2Read.'"></a></td>		
		<td><font face=verdana,arial size=2> '.$artikel[author].'</td>
		<td><font face=verdana,arial size=2><nobr> '.$artikel[encode_date].'</td></tr>';
print "\r\n";
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
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" border=0  alt="<?php echo $LDBackTxt ?>" align="middle"></a>

<p>


</FONT>

</td>
</tr>

<tr valign=top>
<td bgcolor="<?php print $cfg['bot_bgcolor']; ?>" colspan=2> 
<a href="editor-pass.php?sid=<?php echo $sid ?>&target=<?php echo $target ?>&title=<?php echo strtr($title," ","+") ?>&lang=<?php echo $lang ?>"><img src="../img/news.gif" width=16 height=14 border=0></a>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
