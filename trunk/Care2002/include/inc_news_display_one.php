<?php
 /* Get the news global configurations */

require_once($root_path.'include/inc_news_display_config.php');

$picpath=$root_path.$news_fotos_path.$news['nr'].'.'.$news['pic_mime'];

if(!isset($picalign) || empty($picalign)) {
    $picalign=(!($news['art_num']%2))? 'right' : 'left';
}


//if(!isset($picalign) || empty($picalign)) $picalign ='left';

		    echo '<font size="'.$news_headline_title_font_size.'" face="'.$news_headline_title_font_face.'" color="'.$news_headline_title_font_color.'">';
			if ($news_headline_title_font_bold) echo '<b>';
			echo ucfirst(deactivateHotHtml(nl2br($news['title'])));
			if ($news_headline_title_font_bold) echo '</b>';
			
			if(file_exists($picpath)&& !empty($news['body']))
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
			echo ucfirst (deactivateHotHtml(nl2br($news['preface'])));
			if ($news_headline_preface_font_bold) echo '</b>';

			echo '</font><p>';
			
		    echo '<font size="'.$news_headline_body_font_size.'" face="'.$news_headline_body_font_face.'" color="'.$news_headline_body_font_color.'">';
			if ($news_headline_body_font_bold) echo '<b>';
			echo deactivateHotHtml(nl2br($news['body']));
			if ($news_headline_body_font_bold) echo '</b>';
			echo '</font><p>';
			
			echo $LDWrittenFrom.' '.$news['author'].' '.$LDWrittenOn.' '.formatDate2Local($news['submit_date'],$date_format);
			


?>
