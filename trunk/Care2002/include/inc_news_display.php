 <?php
 /*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_news_display.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

 /**
 * Routine to display the headlines
 */
for($j=1;$j<=$news_num_stop;$j++)
 {
		$picalign=($j==2)?"right":"left";
 ?>

<tr>
    <td>
<?php  

$nofile=0;

if($art[$j])
	{
	

		 $picpath=$newspath.'fotos/'.$art[$j][pic_file];

		if(file_exists($picpath)&&file_exists($newspath.'news/'.$art[$j][head_file]))
		{
			$picsize=GetImageSize($picpath);
		 	print '
				<img src="'.$picpath.'" border=0 align="'.$picalign.'" hspace=10 ';
			if(!$picsize||($picsize[0]>150)) print 'width="150" > ';
				else print $picsize[3].'> ';
		}
		
		if(file_exists($newspath.'news/'.$art[$j][head_file]))
		{
			//print "<nobr>";
			 include($newspath.'news/'.$art[$j][head_file]);
		 	print'
		 	<a href="'.$readerpath.$art[$j][main_file].'&sid='.$sid.'&lang='.$lang.'&picfile='.$art[$j][pic_file].'&palign=right&title='.$LDEditTitle.'"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</font></a>';
			//print "</nobr>";
		}
		else
		{
		 $nofile=1;
		 }
	} 
	
	if(!$art[$j]||$nofile)
	{ 
		$i=$j;
		print '
 		<img '.createComIcon('../','pplanu-s.jpg','0',$picalign).'>';
		if(file_exists("../language/".$lang."/lang_".$lang."_newsdummy.php")) include ("../language/".$lang."/lang_".$lang."_newsdummy.php");
		 else include("../language/en/lang_en_newsdummy.php");
		if(!isset($editor_path)||empty($editor_path)) $editor_path='editor-pass.php?sid='.$sid.'&lang='.$lang.'&target=headline&title='.$LDEditTitle;
		print '
		<font size=1 face="verdana,arial"><a href="'.$editor_path.'">'.$LDClk2Write.'</a>';
	}
?>
</td>
  </tr>
<tr>
<td>
<hr>
</td>
</tr>
<?php
}
?>
