<?php  
$nofile=0;

if($news[$j])
	{

		 $picpath=$root_path.$news_fotos_path.$news[$j]['nr'].'.'.$news[$j]['pic_mime'];

		if(!empty($news[$j]['body']))
		{
		    echo '<font size="'.$news_headline_title_font_size.'" face="'.$news_headline_title_font_face.'" color="'.$news_headline_title_font_color.'">';
			
			if ($news_headline_title_font_bold) echo '<b>';
			
			echo ucfirst(deactivateHotHtml(nl2br($news[$j]['title'])));
			
			if ($news_headline_title_font_bold) echo '</b>';
			
			if(file_exists($picpath)&& !empty($news[$j]['body']))
		   {
			    $picsize=GetImageSize($picpath);
		 	    
				echo '
				<img src="'.$picpath.'" border=0 align="'.$picalign.'" hspace=10 ';
			    
				if(!$picsize||($picsize[0]>150)) echo 'width="150" > ';
				    else echo $picsize[3].'> ';
		    }
			
			echo '</font><br>';
			
		    echo '<font size="'.$news_headline_preface_font_size.'" face="'.$news_headline_preface_font_face.'" color="'.$news_headline_preface_font_color.'">';

			if ($news_headline_preface_font_bold) echo '<b>';
			
			echo ucfirst (deactivateHotHtml(nl2br($news[$j]['preface'])));
			
			if ($news_headline_preface_font_bold) echo '</b>';

			echo '</font><p>';
			
		    echo '<font size="'.$news_headline_body_font_size.'" face="'.$news_headline_body_font_face.'" color="'.$news_headline_body_font_color.'">';
			
			if ($news_headline_body_font_bold) echo '<b>';
			
			echo substr(deactivateHotHtml(nl2br($news[$j]['body'])), 0 ,$news_normal_preview_maxlen).'...';
			
			if ($news_headline_body_font_bold) echo '</b>';
			
			echo '</font><br>';
			
		 	echo '
		 	<a href="'.$readerpath.'&nr='.$news[$j]['nr'].'&news_type=headline"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</font></a>';
			//print "</nobr>";
		}
		else
		{
		 $nofile=1;
		 }
	} 
	
	if(!$news[$j]||$nofile)
	{ 
		$i=$j;
		
		print '
 		<img '.createComIcon($root_path,'pplanu-s.jpg','0',$picalign).'>';
		
		if(file_exists($root_path."language/".$lang."/lang_".$lang."_newsdummy.php")) include ($root_path."language/".$lang."/lang_".$lang."_newsdummy.php");
		   else include($root_path."language/en/lang_en_newsdummy.php");
		
		if(!isset($editor_path)||empty($editor_path)) $editor_path='editor-pass.php?sid='.$sid.'&lang='.$lang.'&target=headline&title='.$LDEditTitle;
		
		print '
		<font size=1 face="verdana,arial"><a href="'.$editor_path.'">'.$LDClk2Write.'</a>';
	}
?>
