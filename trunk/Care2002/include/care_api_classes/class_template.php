<?php
/**
* class Template
* a template for the care 2x 
*/
class Template{

	var $filename;
	var $template;
	var $default_path='gui/html_template/'; // Default template path, modify if you placed the template somewhere else
	var $default_theme='default'; // Default template theme
	var $tp_dirs=array();
	var $tp_root;
	var $tp_path;
	var $tp_main_path;
	var $tp_theme;
	
	/**
	* Constructor
	* @param $root = the root path of the current script that instantiates this class
	* @param $path = the path of template source file
	* @param $theme = the template theme
	*/
	function Template($root='./',$path='',$theme='default'){
		$this->tp_root=$root;
		if(empty($path)) $this->tp_path=$root.$this->default_path;
			else $this->tp_path=$path;
		$this->tp_main_path=$this->tp_path;
		$this->tp_theme=$theme;
	}
	/**
	* setPath() sets the template path 
	* @param $path = the path of template source file
	* return true/false
	*/
	function setPath($path=''){
		if(empty($path)) return false;
		if(empty($this->tp_main_path)) $this->tp_main_path=$this->tp_path;
		$this->tp_path=$path;
		return true;
	}
	/**
	* setTheme() sets the template theme 
	* @param $them = the template theme
	* return void
	*/
	function setTheme($theme=''){
		if(empty($theme)) return false;
		$this->tp_theme=$theme;
	}
	/** 
	* useMainPath() sets the template path to the main path which was set at the construction time
	* return true/false
	*/
	function useMainPath(){
		if(empty($this->tp_main_path)){
			return false;
		}else{
			$this->tp_path=$this->tp_main_path;
			return true;
		}
	}
	/**
	* _getTemplates()
	* private
	* creates a list of available templates
	* returns the list in an array
	*/
	function _getTemplates(){
		$handle=opendir($this->tp_path.'.');  // Modify this path if you have placed the language tables somewhere else
		$this->tp_dirs=array();
		while (false!==($tp = readdir($handle))) { 
   			if ($tp != '.' && $tp != '..') {
				if(is_dir($this->tp_path.$tp)){
					$this->tp_dirs[$tp]=$tp;
				}
			} 
		}
		@asort($this->tp_dirs,SORT_STRING);
	}
	/**
	* load() loads the template file and appends/prepends '"' at the loaded string
	* public
	* returns the template in string form
	*/
	function load($tp_fn){
		if(!empty($tp_fn)){
			$tpsrc=$this->tp_path.$this->tp_theme.'/';
			if(file_exists($tpsrc.$tp_fn)) $this->filename=$tpsrc.$tp_fn;
				else $this->filename=$this->tp_root.$this->default_path.$this->default_theme.'/'.$tp_fn;
			$fn=fopen($this->filename,'r');
			$this->template=fread($fn,filesize($this->filename));
			fclose($fn);
			$this->template=$this->neutralize($this->template);
			return '"'.$this->template.'"';
		}else{return false;}
	}
	/**
	* createSelectForm() creates the available templates as options of the select form
	* public
	* @param $curr_theme = the current theme, if the current theme is equal to a theme, the theme will be marked "selected"
	* returns form in string
	*/
	function createSelectForm($curr_theme){
		$this->_getTemplates();
		$str='';
		while(list($x,$v)=each($this->tp_dirs)){
			$str.= '<option value="'.$x.'"';
			if($curr_theme==$x) $str.='selected';
			$str.= '> '.$v.'</option>
			';
		}
		return $str;
	}
	/**
	* createRadioSelect() creates the list of available templates as radio buttons 
	* public
	* @param $name = the name of the radio  input element
	* @param $curr_theme = the current theme, if the current theme is equal to a theme, the theme will be marked "checked"
	* returns radio inputs in string
	*/
	function createRadioSelect($name,$curr_theme){
		$this->_getTemplates();
		$str='';
		while(list($x,$v)=each($this->tp_dirs)){
			$str.= '<input type="radio" name="'.$name.'" value="'.$x.'"';
			if($curr_theme==$x) $str.='checked';
			$str.= '> '.$v;
		}
		return $str;
	}
	/**
	* getTemplateList(),  public interface of the template list variable
	* public
	* returns the template list as array
	*/
	function getTemplateList(){
		$this->_getTemplates();
		return $this->tp_dirs;
	}
	/**
	* neutralize() converts all \ to \\ and " to \" of the string
	* public
	* @param $str (string) = the string to be neutralized
	* return void
	*/
	function neutralize(&$str){
		$str=str_replace('\\','\\\\',$str);
		$str=str_replace('"','\\"',$str);
		return $str;
		echo $str;
	}
}
