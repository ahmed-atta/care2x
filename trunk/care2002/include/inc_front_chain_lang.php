<?php
/** 
* CARE 2xxx Integrated Hospital Information System
* This is the chaining and language detection routine. It should be included at the beginning of each script that
* must be protected from a direct execution triggered from outside. It also loads the appropriate language table.
*
* ::::::: USAGE ::::::::
* At every start of a script that must be protected write the following lines of code:
*
*    define("LANG_FILE","name_of_language_table.php");
*    define("NO_2LEVEL_CHK",1);
*    require("../include/inc_front_chain_lang.php");
*
* If the script is protected w/ the second level security chaining write instead the following code:
*
*    define("LANG_FILE","name_of_language_table.php");
*    $local_user="edp_access_user";
*    require("../include/inc_front_chain_lang.php");
*
* Where "edp_access_user" is the name of the cookie set at a successful password check
*
* If the script is not protected w/ security chaining but requires language detection write instead:
*
*    define("LANG_FILE","name_of_language_table.php");
*    define("NO_CHAIN",1);
*    require("../include/inc_front_chain_lang.php");
*
* If the script does not require a language table, define the LANG_FILE to "" (empty string).
*    define("LANG_FILE","");
*    define("NO_2LEVEL_CHK",1);
*    require("../include/inc_front_chain_lang.php");
*/

/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_front_chain_lang.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

/**
* The following constant LANG_DEFAULT is the default language code. Set this to the language code of your choice.
* NOTE: set this to a code of a language with an existing language table.
*/

define ("LANG_DEFAULT","en");

/**
* The function getLang gets the language code and stores it to the lang variable
* The ck_language variable is a cookie which holds the language code stored at the beginning of
* browser's session. After acquiring the language code, the existence of the language table is
* checked. If language table does not exist, function returns 0.
*
* param chk_file =  filename of the language table
* return = 1 if language table exists 
*/
function getLang($chk_file) 
{
   global $lang;
   global $sid;
   
   if(!isset($lang)||empty($lang))
   {
	  $ck_lang_buffer="ck_lang".$sid;
      if(!isset($HTTP_COOKIE_VARS[$ck_lang_buffer])||empty($HTTP_COOKIE_VARS[$ck_lang_buffer])) include("../chklang.php");
         else $lang=$HTTP_COOKIE_VARS[$ck_lang_buffer];
   }
   if(file_exists("../language/".$lang."/lang_".$lang."_".$chk_file)) return 1;
      else return 0;
}

/**
* The following lines of code is the script chaining detector. It compares the sid values propagated via
* the relative url with the ck_sid+sid (decrypted) cookie values. If the two don't match, a warning message will apear and
* the script exits stopping the execution. If the caller script does not require chaining, it must set the
* constant NO_CHAIN to 1 before including this script.
*/

if(!defined('NO_CHAIN')||NO_CHAIN!=1)
{
    $no_valid=0;
	if(!isset($sid)) $sid=NULL;
    $ck_sid_buffer="ck_sid".$sid;
    define("INIT_DECODE",1); // set flag to decrypt
    include("../include/inc_init_crypt.php"); // initialize crypt 
    $clear_ck_sid = $dec_hcemd5->DecodeMimeSelfRand($HTTP_COOKIE_VARS[$ck_sid_buffer]);

  if(!defined('NO_2LEVEL_CHK')||NO_2LEVEL_CHK!=1)
  {
      /**
      * Decrypt the second level cookie sid and compare to sid
      */
       $dec_2level = new Crypt_HCEMD5($key_2level, '');
       $clear_2sid = $dec_2level->DecodeMimeSelfRand($HTTP_COOKIE_VARS[('ck_2level_sid'.$sid)]);
   
       if(!$sid||($sid!=$clear_ck_sid)||($sid!=$clear_2sid)||!isset($HTTP_COOKIE_VARS[$local_user.$sid])||empty($HTTP_COOKIE_VARS[$local_user.$sid])) $no_valid=1;
      
/*	if(!$sid||($sid!=$clear_ck_sid)||($sid!=$clear_2sid)) $no_valid=1; */  
   }
      elseif (!$sid||($sid!=$clear_ck_sid)) $no_valid=1;

   if ($no_valid)
   {
      if(getLang("invalid-access-warning.php"))
         header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); 
	        else
	           header("Location:../language/".LANG_DEFAULT."/lang_".LANG_DEFAULT."_invalid-access-warning.php"); 
      exit;
   }
}; 

/**
* The constant LANG_FILE contains the file name of the language table without the lang_xx_ component.
* This constant  must be set by the script that calls this file.
* If the calling script does not need a language table, the constant LANG_FILE must be set to empty string "" 
*/ 

if(defined('LANG_FILE')&&LANG_FILE!="") {
    if(getLang(LANG_FILE)) include("../language/".$lang."/lang_".$lang."_".LANG_FILE);
	    else include ("../language/".LANG_DEFAULT."/lang_".LANG_DEFAULT."_".LANG_FILE);
}
?>
