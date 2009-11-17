<?php
/* This file is included in session.inc or PDFStarter.php or a report script that does not use PDFStarter.php
to check for the existance of gettext function and setup the necessary enviroment to allow for automatic translation

Set language - defined in config.php or user variable when logging in (session.inc)
NB this language must also exist in the locale on the web-server
normally the lower case two character country code underscore uppercase
2 character country code does the trick  except for en !!*/

// Specify location of translation tables
If (isset($_POST['Language'])) {
	$_SESSION['Language'] = $_POST['Language'];
	$Language = $_POST['Language'];
} elseif (!isset($_SESSION['Language'])) {
	$_SESSION['Language'] = $DefaultLanguage;
	$Language = $DefaultLanguage;
} else {
	$Language = $_SESSION['Language'];
}


if (function_exists('gettext')){
  
  //This maybe reqiured in some stubborn installations
	$Locale = setlocale (LC_ALL, $_SESSION['Language']);
		
	//$Locale = setlocale (LC_CTYPE, $_SESSION['Language']);
	//$Locale = setlocale (LC_MESSAGES, $_SESSION['Language']);
	$Locale = setlocale (LC_NUMERIC, 'en_GB'); //currently need all decimal points etc to be as expected on webserver

	// possibly even if locale fails the language will still switch by using Language instead of locale variable
	putenv('LANG=' . $_SESSION['Language']);
	putenv('LANGUAGE=' . $_SESSION['Language']);
  //putenv('LANG=$Language_Country');
	bindtextdomain ('messages', $PathPrefix . 'locale');
	textdomain ('messages');

	$locale_info = localeconv();
	
} else {
/*
	PHPGettext integration by Braian Gomez
	http://www.vairux.com/
*/
	require_once($PathPrefix . 'includes/php-gettext/streams.php');
	require_once($PathPrefix . 'includes/php-gettext/gettext.php');
	if(isset($_SESSION['Language'])){
		$Locale = $_SESSION['Language'];
	} else {
		$Locale = $DefaultLanguage;
	}
	
	if (isset($PathPrefix)) {
		$LangFile = $PathPrefix . 'locale/' . $Locale . '/LC_MESSAGES/messages.mo';
	} else {
		$LangFile = 'locale/' . $Locale . '/LC_MESSAGES/messages.mo';
	}
	
	if (file_exists($LangFile)){
		$input = new FileReader($LangFile);
		$PhpGettext = new gettext_reader($input);
		
		if (!function_exists('_')){
			function _($text) {
				global $PhpGettext;
				return $PhpGettext->translate($text);
			}
		}
	} elseif (!function_exists('_')) {
		function _($text){
			return $text;
		}
	}
	//if (substr($_SESSION['Language'],0,2) == 'en'){
		$locale_info['thousands_sep'] = ',';
		$locale_info['decimal_point'] = '.';
	/*
	} else {
		$locale_info['thousands_sep'] = '.';
		$locale_info['decimal_point'] = ',';
	}
	*/
}
?>