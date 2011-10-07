<?php
# To see how the script locking is implemented in this script see /development/dev_docs/script_locking.txt 

#------begin------ This protection code was suggested by Luki R. luki@karet.org ----
if (stristr($PHP_SELF,'inc_front_chain_lang.php')) 	die('<meta http-equiv="refresh" content="0; url=../">');
#------end-----

# Set  to TRUE if you want to disable the time-out feature,
# Once this value is taken from the database, this will be used as the last resort default value
$TIME_OUT_INACTIVE=FALSE;
# Set for  the time out value. The format is MinutesSeconds, e.g.  530 = 5 minutes, 20 seconds or e.g. 2000 = 20 minutes, 00 seconds
# Once the time-out value is taken from the database, this will be used as the last resort default value
$TIME_OUT_TIME=1500;

# Establish db connection
require_once('inc_db_makelink.php');

# The function getLang gets the language code and stores it to the lang variable
# The ck_language variable is a cookie which holds the language code stored at the beginning of
# browser's session. After acquiring the language code, the existence of the language table is
# checked. If language table does not exist, function returns 0.
#
# param chk_file =  filename of the language table
# return = 1 if language table exists 

function getLang($chk_file) {
   global $lang,  $sid;
   
   if(!isset($lang)||empty($lang))   {
	  $ck_lang_buffer='ck_lang'.$sid;
      if(!isset($_COOKIE[$ck_lang_buffer])||empty($_COOKIE[$ck_lang_buffer])) include(CARE_BASE .'/include/helpers/chklang.php');
         else $lang=$_COOKIE[$ck_lang_buffer];
   }
   
   if(file_exists(CARE_BASE .'language/'.$lang.'/lang_'.$lang.'_'.$chk_file)) return 1;
      else return 0;
}

function getLangModular($chk_file) {
   global $lang,  $sid ;

   if(!isset($lang)||empty($lang))   {
	  $ck_lang_buffer='ck_lang'.$sid;
      if(!isset($_COOKIE[$ck_lang_buffer])||empty($_COOKIE[$ck_lang_buffer])) 
      	include(CARE_BASE .'/include/helpers/chklang.php');
      else 
      	$lang=$_COOKIE[$ck_lang_buffer];
   }
   if(file_exists(CARE_BASE .'modules/' . MODULE . '/language/' .$lang.'/'.LANG_FILE_MODULAR)) 
   		return 1;
   else 
   		return 0;
}


# The following lines of code is the script chaining detector. It compares the sid values propagated via
# the relative url with the ck_sid+sid (decrypted) cookie values. If the two don't match, a warning message will apear and
# the script exits stopping the execution. If the caller script does not require chaining, it must set the
# constant NO_CHAIN to 1 before including this script.

if(!defined('NO_CHAIN')||NO_CHAIN!=1){
   $no_valid=0;

   if(!isset($sid)) $sid=NULL;
   
   $ck_sid_buffer='ck_sid'.$sid;

   define('INIT_DECODE',1); # set flag to decrypt
	
   include('inc_init_crypt.php'); # initialize crypt 

   $clear_ck_sid = $dec_hcemd5->DecodeMimeSelfRand($_COOKIE[$ck_sid_buffer]);
   
	$tnow=date('His');
   // echo $tnow."<p>";
	$time_out=FALSE;

   if(!defined('NO_2LEVEL_CHK')||NO_2LEVEL_CHK!=1){
		
		# Let us check if the calling script is the time-out configuration script, if yes, then we skip the time out
		if (!stristr('admin_system_timeout.php',$PHP_SELF)) {
			# Load the global time out configs
			include_once(CARE_BASE .'include/core/class_globalconfig.php');
			if(!isset($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
			$gc_obj= new GlobalConfig($GLOBAL_CONFIG);
			$gc_obj->getConfig('timeout_%');
			# If config data available, use it
			if($GLOBAL_CONFIG['timeout_inactive']) $TIME_OUT_INACTIVE=$GLOBAL_CONFIG['timeout_inactive'];
			if((int)$GLOBAL_CONFIG['timeout_time']) $TIME_OUT_TIME=(int)$GLOBAL_CONFIG['timeout_time'];
		
			if(!$TIME_OUT_INACTIVE){
    				//echo $tnow."<br>";
					//echo $_SESSION['sess_tos']."<br>";
					//echo ($tnow-$_SESSION['sess_tos'])."<br>";
	  			# Check if session is still valid 
	  			if(isset($_SESSION['sess_tos'])||isset($_SESSION['sess_tos'])){
					# Check if time out value is positive or not zero
					# current time minus start time
					if(($tnow - $_SESSION['sess_tos']) >= $TIME_OUT_TIME) $time_out=TRUE;
						else $_SESSION['sess_tos']=$tnow;
				}else{
					$time_out=TRUE;
				}
			
    			if($time_out||!$_SESSION['sess_tos']){
					# Show session time out warning and exit the script to stop the module
					include(CARE_BASE ."include/helpers/inc_session_timeout_warning.php");
					exit;
				}else{
					# Reset the time-out start time
					$_SESSION['sess_tos']=$tnow;
				}
			}
		}
	  # Decrypt the second level cookie sid and compare to sid
       $dec_2level = new Crypt_HCEMD5($key_2level, '');
       $clear_2sid = $dec_2level->DecodeMimeSelfRand($_COOKIE[('ck_2level_sid'.$sid)]);
   
       if(	!$sid ||(
       		$sid!=$clear_ck_sid)||
       		($sid!=$clear_2sid)||
       		!isset($_COOKIE[$local_user.$sid])||
       		empty($_COOKIE[$local_user.$sid])
       	) { 
       		$no_valid=1;
       	}
   }elseif (!$sid||($sid!=$clear_ck_sid)){
   		$no_valid=1;
	}else{
		# Reset the time-out start time
		$_SESSION['sess_tos']=$tnow;
	}

   if ($no_valid) {
       if(getLang('invalid-access-warning.php')) {
	       header('Location:'.CARE_GUI .'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); 
	   }
	     else {
		     header('Location:'.CARE_GUI .'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_invalid-access-warning.php');
		 } 
	   exit;
   }
}

# The constant LANG_FILE contains the file name of the language table without the lang_xx_ component.
# This constant  must be set by the script that calls this file.
# If the calling script does not need a language table, the constant LANG_FILE must be set to empty string '' 

if(defined('LANG_FILE') && LANG_FILE!='') {
    if(getLang(LANG_FILE)) include(CARE_BASE .'language/'.$lang.'/lang_'.$lang.'_'.LANG_FILE);
	    else include (CARE_BASE .'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_'.LANG_FILE);
}

if(defined('LANG_FILE_MODULAR') && LANG_FILE_MODULAR != '') {
    if(getLangModular(LANG_FILE_MODULAR)) 
    	include (CARE_BASE .'modules/' . MODULE . '/language/' .$lang.'/'.LANG_FILE_MODULAR);
	else 
		include (CARE_BASE .'modules/' . MODULE . '/language/' .LANG_DEFAULT.'/'.LANG_FILE_MODULAR);
}


# Load additional language tables
/* This routine includes the language tables which are listed in the array $lang_tables */
if(isset($lang_tables)&&is_array($lang_tables)&&sizeof($lang_tables)) {
	for($tc=0;$tc<sizeof($lang_tables);$tc++) {
	    if(file_exists(CARE_BASE .'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]))    
	    	include(CARE_BASE .'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]);
	    else 
	    	include(CARE_BASE .'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_'.$lang_tables[$tc]);
	}

}

#  Load additional environment files 
include_once(CARE_BASE . '/include/core/class_userconfig.php');
$cfg_obj=new UserConfig;
if(is_object($cfg_obj)) {
	$cfg_obj->getConfig($_COOKIE['ck_config']);
	$cfg=&$cfg_obj->buffer;
}
require_once('inc_img_fx.php'); # image functions

# Resolve the template theme
if(isset($cfg['template_theme'])&&!empty($cfg['template_theme'])) $template_theme=$cfg['template_theme'];
	else $template_theme = 'default';

// Load template class by default
if(!defined('NO_TEMPLATE')||!NO_TEMPLATE){
	require_once(CARE_BASE . '/include/core/class_template.php'); // template class
	# Template object
	$TP_obj=new Template(CARE_BASE ,$template_path,$template_theme);
}