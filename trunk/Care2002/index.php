<?php
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla
								
Beta version 1.0.04    2003-03-31
								
This script(s) is(are) free software; you can redistribute it and/or
modify it under the terms of the GNU General Public
License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.
																  
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
General Public License for more details.
											   
You should have received a copy of the GNU General Public
License along with this script; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
																		 
Copy of GNU General Public License at: http://www.gnu.org/
													 
Source code home page: http://www.care2x.com
Contact author at: elpidio@latorilla.com

This notice also applies to other scripts which are integral to the functioning of CARE 2002 within this directory and its top level directory
A copy of this notice is also available as file named copy_notice.txt under the top level directory.
*/
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('./include/inc_environment_global.php');

/* Register global session variables */
if(!session_is_registered('sess_user_name')) session_register('sess_user_name');
if(!session_is_registered('sess_user_origin')) session_register('sess_user_origin');
if(!session_is_registered('sess_file_forward')) session_register('sess_file_forward');
if(!session_is_registered('sess_file_return')) session_register('sess_file_return');
if(!session_is_registered('sess_file_break')) session_register('sess_file_break');
if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
if(!session_is_registered('sess_dept_nr')) session_register('sess_dept_nr');
if(!session_is_registered('sess_title')) session_register('sess_title');
if(!session_is_registered('sess_lang')) session_register('sess_lang');
if(!session_is_registered('sess_user_id')) session_register('sess_user_id');
if(!session_is_registered('sess_cur_page')) session_register('sess_cur_page');

define('FROM_ROOT',1);

if(!isset($mask)) $mask='';
if(!isset($cookie)) $cookie='';
if(!isset($boot)) $boot='';

$bname='';
$bversion='';
$user_id='';
$ip='';
$cfgid='';
$config_exists=false;

$GLOBALCONFIG=array();
$USERCONFIG=array();

/****************************************************************************
 phpSniff: HTTP_USER_AGENT Client Sniffer for PHP
 Copyright (C) 2001 Roger Raymond ~ epsilon7@users.sourceforge.net

 * Check environment : Browser, OS
 * @param string $bn  name of browser
 * @param string $bv  version of browser
 * @param string $f   CFG filename
 * @param string $i   IP adress
 * @param string $uid new guid (session var)
 * @return all parameter using &
 * @access public
 *
 * 02.02.2003 Thomas Wiedmann
 ****************************************************************************
 */

require_once('./classes/phpSniff/phpSniff.class.php'); // Sniffer for PHP

function configNew(&$bn,&$bv,&$f,$i,&$uid)
{
  global $HTTP_USER_AGENT;
  global $REMOTE_ADDR;
  
  /* We disable the error reporting, because Konqueror 3.0.3 causes a  runtime error output that stops the program.
  *  could be a bug in phpsniff .. hmmm?
  */
  $old_err_rep= error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
  /* Function rewritten by Thomas Wiedmann to use phpSniff class  */
  
  // initialize some vars
  if(!isset($UA)) $UA = '';
  if(!isset($cc)) $cc = '';
  if(!isset($dl)) $dl = '';
  if(!isset($am)) $am = '';

  //$timer = new phpTimer();
  //$timer->start('main');
  //$timer->start('client1');
  $sniffer_settings = array('check_cookies'=>$cc,'default_language'=>$dl,'allow_masquerading'=>$am);
  $client = new phpSniff($UA,$sniffer_settings);

  // get phpSniff result
  $i=$client->get_property('ip');
  $bv=$client->get_property('version');
  $bn=$client->get_property('browser');

  // translate some browsernames for "Care2x"
  if ($bn == 'moz') { $bn='mozilla';}
  else if ($bn == 'op') { $bn='opera';}
  else if ($bn == 'ns') { $bn='netscape';}
  else if ($bn == 'ie') { $bn='msie';}

  $uid=uniqid('');
  $f='CFG'.$uid.microtime().'.cfg';

   /* Return previous error reporting */
   error_reporting($old_err_rep);
}


/**
* Create simple session id (sid), save a encrpyted  sid to a cookie with a dynamic name 
* consisting of concatenating "ck_sid" and the sid itself.
* For more information about the encryption class, see the proper docs of the pear's "hcemd5.php" class.
*/
//$sid=uniqid('');
$sid=session_id();
$ck_sid_buffer='ck_sid'.$sid;

include('include/inc_init_crypt.php'); // initialize crypt
$ciphersid=$enc_hcemd5->encodeMimeSelfRand($sid);
setcookie($ck_sid_buffer,$ciphersid);
$HTTP_COOKIE_VARS[$ck_sid_buffer]=$ciphersid;

/**
* Simple counter, counts all hits including revisits
* Comment the following line if you do not like to count the hits
*/
include('./counter/count.php');	


if((isset($boot)&&$boot)||!isset($HTTP_COOKIE_VARS['ck_config'])||empty($HTTP_COOKIE_VARS['ck_config'])) {
    configNew($bname,$bversion,$user_id,$ip,$cfgid);
} else {
    $user_id=$HTTP_COOKIE_VARS['ck_config'];
}
	
/* Load user config API. Get the user config data from db */
require_once('include/care_api_classes/class_userconfig.php');
$cfg=new UserConfig;

if($cfg->exists($user_id)) {
	$cfg->getConfig($user_id);
	$USERCONFIG=&$cfg->buffer;
    $config_exists=true;  // Flag that user config is existing
}else{
	$cfg->_getDefault();
	$USERCONFIG=&$cfg->buffer;
}

/* Load global configurations API*/
require_once('include/care_api_classes/class_globalconfig.php');
$glob_cfg=new GlobalConfig($GLOBALCONFIG);

//* Get the global config for language usage*/
$glob_cfg->getConfig('language_%');
//* Get the global config for frames */
$glob_cfg->getConfig('gui_frame_left_nav_width');
//* Get the global config for lev nav border */
$glob_cfg->getConfig('gui_frame_left_nav_border');

$savelang=0;
/*echo $GLOBALCONFIG['language_non_single'];
while (list($x,$v)=each($GLOBALCONFIG)) echo $x.'==>'.$v.'<br>';
*//* Start checking language properties */	
if(!$GLOBALCONFIG['language_single']) {
        /**
        * We get the language code
        */
//echo $lang;
    if(isset($lang)&&$lang) {
		    $savelang=1;
    } else {
        if($USERCONFIG['lang']) $lang=$USERCONFIG['lang'];
			    else  include('chklang.php');
	 } 
} else {
    // If single language is configured, we get the user configured lang
	if(!empty($USERCONFIG['lang']) && file_exists('language/'.$USERCONFIG['lang'].'/lang_'.$USERCONFIG['lang'].'_startframe.php')) {
	    $lang=$USERCONFIG['lang'];
	} else {
	    // If user config lang is not available, we get the global system lang configuration
	    if(!empty($GLOBALCONFIG['language_default']) && file_exists('language/'.$GLOBALCONFIG['language_default'].'/lang_'.$GLOBALCONFIG['language_default'].'_startframe.php')) {
            $lang=$GLOBALCONFIG['language_default'];
		} else {
	        $lang=LANG_DEFAULT; // Comes from inc_environment_global.php, the last chance, usually set to "en"
	    }	
	}
}

	
$lang_file='language/'.$lang.'/lang_'.$lang.'_startframe.php';
/** 
* We check if language table exists, if not, english is used
*/
if(file_exists($lang_file)) {
    include($lang_file);
} else {
    include('language/en/lang_en_startframe.php');  // en = english is the default language table
	$lang='en';
}
/* The language detection is finished, we save it to session */
$HTTP_SESSION_VARS['sess_lang']=$lang;

/*$ck_lang_buffer='ck_lang'.$sid;
setcookie($ck_lang_buffer,$lang);*/

/*$HTTP_COOKIE_VARS[$ck_lang_buffer]=$lang;*/
	 //echo $mask;
if((isset($mask)&&$mask)||!$config_exists||$savelang) {
		if(!$config_exists) {
		
			//$cfg->getConfig('default');
			//$USERCONFIG=&$cfg->buffer;
			
			configNew($bname,$bversion,$user_id,$ip,$cfgid);
			
			$USERCONFIG['bname']=$bname;
			$USERCONFIG['bversion']=$bversion;
			$USERCONFIG['cid']=$cfgid;
		}
		// *****************************
		//save browser info to user config array
		// *****************************
		if(empty($ip)) $USERCONFIG['ip']=$REMOTE_ADDR;
		$USERCONFIG['mask']=$mask; 
		$USERCONFIG['lang']=$lang;		
		if(((($bname=='msie') ||($bname=='opera')) &&($bversion>4)) ||(($bname=='netscape')&&($bversion>3.5)) ||($bname=='mozilla')) {
		    $USERCONFIG['dhtml']=1;
		} 
		// *****************************
		// Save config to db
		// *****************************
		$mask=$USERCONFIG['mask']; //save mask before serializing
        $cfg->saveConfig($user_id,$USERCONFIG);
		setcookie('ck_config',$user_id,time()+(3600*24*365)); // expires after 1 year
}	

// save user_id to session
$HTTP_SESSION_VARS['sess_user_id']=$user_id;
if(empty($HTTP_SESSION_VARS['sess_user_name'])) $HTTP_SESSION_VARS['sess_user_name']='default';

include_once('include/inc_charset_fx.php');

/* Load the gui template */
require('gui/html_template/default/tp_index.php');

?>
