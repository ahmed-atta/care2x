<?php
/**
* Language class
*/
class Language {

	function createSelectForm($curr_lang){
		global $root_path;
		$str='';
		$handle=opendir($root_path.'language/.');  // Modify this path if you have placed the language tables somewhere else
		$langdirs=array();
		while (false!==($langcode = readdir($handle))) { 
   			if ($langcode != '.' && $langcode != '..') {
				if(is_dir($root_path.'language/'.$langcode)&&file_exists($root_path.'language/'.$langcode.'/tags.php')){
				@include($root_path.'language/'.$langcode.'/tags.php');
				if($langcode==$lang_iso_code) $langdirs[$lang_iso_code]=$lang_name;
				}
			} 
		}
		@asort($langdirs,SORT_STRING);
		while(list($x,$v)=each($langdirs)){
			$str.= '<option value="'.$x.'"';
			if($curr_lang==$x) $str.='selected';
			$str.= '> '.$v.'</option>
			';
		}
		return $str;
	}
}
