<?php
/**
* class Template
* a template for the care 2x 
*/
class Template{

	var $filename;
	var $template;
	var $default_path='gui/html_template/';
	var $default_theme='default';
	var $tp_dirs=array();
	/**
	* _getTemplates()
	* private
	* creates a list of available templates
	* returns the list in an array
	*/
	function _getTemplates(){
		global $template_path, $root_path;
		if(empty($template_path)) $template_path=$root_path.$this->default_path;
		$handle=opendir($template_path.'.');  // Modify this path if you have placed the language tables somewhere else
		$this->tp_dirs=array();
		while (false!==($tp = readdir($handle))) { 
   			if ($tp != '.' && $tp != '..') {
				if(is_dir($template_path.$tp)){
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
		global $template_path, $root_path, $template_theme;
		if(!empty($tp_fn)){
			if(empty($template_path)) $template_path=$root_path.$this->default_path;
			if(empty($template_theme)) $template_theme=$this->default_theme; // Last default alternative
			$tpsrc=$template_path.$template_theme.'/';
			if(!file_exists($tpsrc.$tp_fn)) $this->filename=$root_path.$this->default_path.$this->default_theme.'/'.$tp_fn;
				else $this->filename=$tpsrc.$tp_fn;
			$fn=fopen($this->filename,"r");
			$this->template=fread($fn,filesize($this->filename));
			fclose($fn);
			$this->template=str_replace('"','\\"',$this->template);
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
		while(list($x,$v)=each($tpdirs)){
			$str.= '<option value="'.$x.'"';
			if($curr_theme==$x) $str.='selected';
			$str.= '> '.$v.'</option>
			';
		}
		return $str;
	}
	/**
	* createSelectForm() creates the available templates as radio buttons 
	* public
	* @param $name = the name of the radio  input element
	* @param $curr_theme = the current theme, if the current theme is equal to a theme, the theme will be marked "checked"
	* returns radio inputs in string
	*/
	function createRadioSelect($name,$curr_theme){
		$this->_getTemplates();
		$str='';
		while(list($x,$v)=each($tpdirs)){
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
}
