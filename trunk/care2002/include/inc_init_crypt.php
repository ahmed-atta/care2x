<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_init_crypt.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

/**
* This initializes the hcemd5 crypt function
*/

function makeRand()
{
    srand((double)microtime()*32767);
    $rand = rand(1, 32767);
    return pack('i*', $rand);
}

if(defined('FROM_ROOT')&&FROM_ROOT==1) require_once 'pear/crypt/hcemd5.php';
   else require_once '../pear/crypt/hcemd5.php';

/**
* This is the secret key used for the security script chaining
* IMPORTANT!!!  Change this key immediately after  installing CARE
*/
$key = "change this key now";
$key_2level="change this 2nd level key now";
$key_login="replace this login key now";
/**
* The INIT_DECODE  must be defined at the calling script before including this script
* INIT_DECODE=1  // will not start creation of random key and create decoder object
* INIT_DECODE= undefined or not 1 // will start creation of random key and create encoder object
*/
if(defined('INIT_DECODE')&&INIT_DECODE==1)
{
    $dec_hcemd5 = new Crypt_HCEMD5($key, '');
}
else
{  
    $enc_hcemd5 = new Crypt_HCEMD5($key, makeRand());
}
?>
