<?php
/**
* importGlobalVariable solves the different global variable names
* in different versions of php
* original idea by Chris Burkert
*/
function importGlobalVariable($variable)
{ 
   switch (strtolower($variable))
   { case 'server' :
          if (isset($_SERVER))  { return $_SERVER; }
          else
                 { return $GLOBALS['HTTP_SERVER_VARS']; }
           break;
      case 'session' :
           if (isset($_SESSION)) { return $_SESSION; }
           else
                { return $GLOBALS['HTTP_SESSION_VARS']; }
           break;
      case 'post' :
           if (isset($_POST))    { return $_POST; }
           else
                 { return $GLOBALS['HTTP_POST_VARS']; }
           break;
      case 'get' :
          if (isset($_GET))     { return $_GET; }
          else
                { return $GLOBALS['HTTP_GET_VARS']; }
           break;
      case 'cookie' :
          if (isset($_COOKIE))     { return $_COOKIE; }
          else
                { return $GLOBALS['HTTP_COOKIE_VARS']; }
           break;
      default:return null;
           break;
    }
}

/**
* This routine will check whether the register_globals of php is on or off.
* If it is off, all GET,POST, and COOKIE variables will be explicitely 'globalized' here
* Note: this uses the $$ variable which will not work in php3
*/
$reg_glob_ini=ini_get('register_globals');

if(empty($reg_glob_ini)||(!$reg_glob_ini))
{

/* Process GET vars */

  //if(sizeof($HTTP_GET_VARS))
  if(sizeof($global_vars=&importGlobalVariable('get')))
  {
    //while(list($x,$v)=each($HTTP_GET_VARS))    
    while(list($x,$v)=each($global_vars))    
    {
      $global_var_buf=$x;
	  $$global_var_buf=$v;
    }
    reset($global_vars);
  }
  
/* Process POST vars */
  
  //if(sizeof($HTTP_POST_VARS))
  if(sizeof($global_vars=&importGlobalVariable('post')))
  {
    //while(list($x,$v)=each($HTTP_POST_VARS)) 
    while(list($x,$v)=each($global_vars))    
    {
      $global_var_buf=$x;
	  $$global_var_buf=$v;
    }
    //reset($HTTP_POST_VARS);
    reset($global_vars);
  }
  
/* Process COOKIE vars */

  //if(sizeof($HTTP_COOKIE_VARS))
  if(sizeof($global_vars=&importGlobalVariable('cookie')))
  {
    //while(list($x,$v)=each($HTTP_COOKIE_VARS)) 
    while(list($x,$v)=each($global_vars))    
    {
      $global_var_buf=$x;
	  $$global_var_buf=$v;
    }
    //reset($HTTP_COOKIE_VARS);
    reset($global_vars);
  }
 
/* Process SERVER vars */

  //if(sizeof($HTTP_SERVER_VARS))
  if(sizeof($global_vars=&importGlobalVariable('server')))
  {
    //while(list($x,$v)=each($HTTP_SERVER_VARS)) 
    while(list($x,$v)=each($global_vars))    
    {
      $global_var_buf=$x;
	  $$global_var_buf=$v;
    }
    //reset($HTTP_SERVER_VARS);
    reset($global_vars);
  }
  
 /* Globalize POST FILES */
/*if(isset($_FILES)) $HTTP_POST_FILES=$_FILES;
   else $HTTP_POST_FILES=$GLOBALS['HTTP_POST_FILES'];
*/ 
    
}

/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_vars_resolve.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
?>
