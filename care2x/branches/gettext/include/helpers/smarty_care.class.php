<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* SETUP Smarty for CARE2X
*
* SMARTY.PHP
* 19.12.2003 Thomas Wiedmann
* Converted to smarty_care.class.php by Elpidio Latorilla 2003-12-25
* For global smarty template class
*/

/**
* LOAD Smarty Library
*/
require_once (CARE_BASE.'classes/smarty/Smarty.class.php');

class smarty_care extends Smarty {

	var $bInitGUI = TRUE;
	var $bShowCopyright = TRUE;
	var $bLoadJS = TRUE;
	var $templatedir;

	#Set the default template, change this to the desired default template
	var $default_template='default';

	var $sDocRoot;
	var $templateCache;
	
	var $root_path;
	var $LDCloseAlt;
	var $cfg;
	var $lang;

	/**
	* Constructor
	*
	* @param string modulname ==  cache directory /modules/$dirname
	* @param boolean Initialize GUI (default TRUE)
	* @param boolean Show copyright footer (default TRUE)
	* @param boolean Load standard Javascript code (default TRUE)
	*/
	function smarty_care ($dirname, $bInit = TRUE, $bShowCopy = TRUE, $bLoadJS = TRUE) {

 		global $templatedir, $default_template, $sDocRoot, $LDCloseAlt, $cfg, $lang, $GLOBAL_CONFIG;

		$this->__construct();

		$this->root_path = CARE_BASE;

		# Set the root path
		$this->assign('root_path',CARE_BASE);
		
		# Path to the smarty care templates and classes
		$this->sDocRoot = CARE_BASE;
		# Path to the template cache
		$this->templateCache = CARE_BASE.'cache/templates_c';

		# Set the template
		# First check if the user config template is available
		if(isset($cfg['template_smarty'])&&!empty($cfg['template_smarty'])){
			$this->templatedir=$cfg['template_smarty'];
		}else{
			# Else get try to get the global config template
			if(!isset($GLOBAL_CONFIG)||!is_array($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();

			# create global config object
			if(!isset($GLOBAL_CONFIG['template_smarty'])){
				include_once(CARE_BASE.'include/core/class_globalconfig.php');
				$gc= new GlobalConfig($GLOBAL_CONFIG);
				# Get the global template config
				$gc->getConfig('template_smarty');
			}

			# If the global config template is not available, use hard coded template theme
			if(!isset($GLOBAL_CONFIG['template_smarty'])||empty($GLOBAL_CONFIG['template_smarty'])){
				if(isset($template_theme)) $this->templatedir=$template_theme; // use this theme if the global item is not available
					 else $this->templatedir = $this->default_template;
			}else{
				$this->templatedir=$GLOBAL_CONFIG['template_smarty'];
			}
		}

		# Set the flags
		$this->bInitGUI = $bInit;
		$this->bShowCopyright = $bShowCopy;
		$this->bLoadJS = $bLoadJS;

		$this->LDCloseAlt = $LDCloseAlt;
		$this->cfg = $cfg;
		$this->lang = $lang;

		// being called from a module or from the main ?
		$module = MODULE != '' ? "modules/" : "";
		$this->template_dir = MODULE != '' ? $this->sDocRoot . $module . MODULE . "/view/"
										   : "";
		$this->cache_dir = MODULE != '' ? $this->compile_dir . $module . MODULE . "/view/"
										   : $this->compile_dir ;
		
		$this->compile_dir = $this->templateCache ;
		$this->config_dir = $this->sDocRoot.'configs';
		//$this->cache_dir = $this->compile_dir;//.'/cache';

		# For temporary debugging
	    	if(0){
			echo  "template dir : " . $this->template_dir."<p>";
			echo  "compile dir : " .$this->compile_dir."<p>";
			echo  "config dir : " .$this->config_dir."<p>";
			echo  "cache dir : " .$this->cache_dir."<p>";
		 }
		/***/
		/* global configs
		*/

		$this->debug = true;
		//TODO : move this to a global configuration 
		$this->caching = false;

		/**
		* Smarty delimiters
		*/
		$this->left_delimiter = '{{';
		$this->right_delimiter = '}}';

		# Now assign standard GUI elements if bInitGUI flag is set to TRUE (default is TRUE)

		if($this->bInitGUI){
			$this->InitializeGUI();
		}
	} // end of constructor

	function InitializeGUI(){
 		global  $lang, $cfg;
		
		if(empty($lang)) $lang = $this->lang;
		
		# collect JavaScript for Smarty. By default collect the help javascript and css stylesheets
		if($this->bLoadJS){
			ob_start();
				include($this->root_path.'include/helpers/include_header_css_js.php');
				$sTemp = ob_get_contents();
			ob_end_clean();
		}

		$this->assign('JavaScript',$sTemp);

		# Added for the html tag direction
		$this->assign('HTMLtag','<html>');

		# Set colors
		$this->assign('top_txtcolor',$this->cfg['top_txtcolor']);
		$this->assign('top_bgcolor',$this->cfg['top_bgcolor']);
		$this->assign('body_bgcolor',$this->cfg['body_bgcolor']);
		$this->assign('body_txtcolor',$this->cfg['body_txtcolor']);
		$this->assign('bot_bgcolor',$this->cfg['bot_bgcolor']);

		# Set title bar buttons
		$this->assign('gifBack2',createComIcon(CARE_GUI,'arrow_left.png','0') );
		$this->assign('gifHilfeR',createComIcon(CARE_GUI,'help.png','0') );
		$this->assign('gifClose2',createComIcon(CARE_GUI,'cross.png','0') );
		$this->assign('LDCloseAlt',CARE_GUI );

		# Set default href of the title bar buttons
		# By default, the back button uses the javascript
		$this->assign('pbBack','javascript:window.history.back()');

		# By default the help button points to the main help window
		$this->assign('pbHelp',"javascript:gethelp()");

		# By default the break/close button points to the main startframe
		$this->assign('breakfile',CARE_GUI.'main/startframe.php'.URL_APPEND);

		
		# By default the toolbar title is empty
		//$this->assign('sToolbarTitle','');

		# By default the window title is Care2x
		$this->assign('title','Care2X');
		
		//i hate it.. :(
		ob_start();
		require_once (CARE_BASE.'modules/menu/menu.php');
		$menu_contents = ob_get_contents();
		ob_clean();
		$this->assign('main_menu', $menu_contents);
		# For the dhtml effects

		if($this->cfg['dhtml']) {

			# Overload css  document body attributes
			
			$this->assign('bgcolor','bgcolor='.$this->cfg['body_bgcolor']);
			$this->assign('dhtml','class="fadedOut"');
			$this->assign('sLinkColors','link='.$this->cfg['idx_txtcolor'].' alink='.$this->cfg['body_alink'].' vlink='.$this->cfg['idx_txtcolor']);
		}

		# Show Copyright
		
		if($this->bShowCopyright){
			$this->assign('sCopyright',$this->Copyright());
		}
	}

	function Copyright(){
		global $lang;

		if(empty($lang)) $lang = $this->lang;

		ob_start();
			$sTempFile=$this->root_path.'language/'.$this->lang.'/'.$this->lang.'_copyrite.php';
			if(file_exists($sTempFile)) include($sTempFile);
			else include($this->root_path.'language/en/en_copyrite.php');
			$sTemp = ob_get_contents();
		ob_end_clean();
		return "<div class=\"copyright\">$sTemp</div>";
	}

} // end class

?>
