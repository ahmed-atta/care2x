<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla
								
Beta version 1.0.03    2002-10-26
								
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

function configNew(&$bn,&$bv,&$f,$i,&$uid)
{
		global $HTTP_USER_AGENT;
		global $REMOTE_ADDR;
		
		$bbuff=str_replace("/"," ",$HTTP_USER_AGENT);
		$bbuff=strtolower(str_replace(";","",$bbuff));
		$bbuff=explode(" ",$bbuff);
	
		for($j=(sizeof($bbuff)-1);$j>=0;$j--)
		{
			//if(($bbuff[$j]=="opera")||($bbuff[$j]=="msie")||($bbuff[$j]=="mozilla"))
			if(stristr($bbuff[$j],"opera")||stristr($bbuff[$j],"msie")||stristr($bbuff[$j],"mozilla"))
				{
					$bn=$bbuff[$j]; $bv=$bbuff[$j+1];break;
				}
		}
		if ($bn=="")
		{
			$bn="netscape";
			$bv=$bbuff[1];
		}
	
		$i=$REMOTE_ADDR;
		$uid=uniqid("");
		$f="CFG".$uid.".cfg";
}	

require_once('include/inc_vars_resolve.php'); // globalize POST, GET, & COOKIE  vars

/**
* Create simple session id (sid), save a encrpyted  sid to a cookie with a dynamic name 
* consisting of concatenating "ck_sid" and the sid itself.
* For more information about the encryption class, see the proper docs of the pear's "hcemd5.php" class.
*/
$sid=uniqid("");
$ck_sid_buffer="ck_sid".$sid;
define("FROM_ROOT",1);
include("include/inc_init_crypt.php"); // initialize crypt
$ciphersid=$enc_hcemd5->encodeMimeSelfRand($sid);
setcookie($ck_sid_buffer,$ciphersid);
$HTTP_COOKIE_VARS[$ck_sid_buffer]=$ciphersid;
/**
* simple counter, counts all hits including revisits
*/
include("counter/count.php");	


if((isset($boot)&&$boot)||!isset($HTTP_COOKIE_VARS['ck_config'])||empty($HTTP_COOKIE_VARS['ck_config'])) configNew($bname,$bversion,$filename,$ip,$cfgid);
else $filename=$HTTP_COOKIE_VARS['ck_config'];

// ********************
// Get init color values
// ********************
$path="userconfig/".$filename;
if(file_exists($path))	$cfg=get_meta_tags($path);
	else $cfg=get_meta_tags("userconfig/default/default.cfg");

/**
* We get the language code
*/
$savelang=0;
if(isset($lang)&&$lang) $savelang=1;
	 else
		{
		 	if($cfg[lang]) $lang=$cfg[lang];
			else  include("chklang.php");
		}
$lang_file="language/".$lang."/lang_".$lang."_startframe.php";
/**
* We check if language table exists, if not english is used
*/
if(file_exists($lang_file))
   {
   	    include($lang_file);
    }
	 else  
	 {
	    include("language/en/lang_en_startframe.php");  // en = english is the default language table
	    $lang="en";
    }
$ck_lang_buffer="ck_lang".$sid;
setcookie($ck_lang_buffer,$lang);

$HTTP_COOKIE_VARS[$ck_lang_buffer]=$lang;
	 
if((isset($mask)&&$mask)||!file_exists($path)||$savelang)
{
		if(!file_exists($path))
		{
			configNew($bname,$bversion,$filename,$ip,$cfgid);
			$cfg['bname']=$bname;
			$cfg['bversion']=$bversion;
			$cfg['cid']=$cfgid;
		}
		$path="userconfig/".$filename;
		// *****************************
		//save browser info to array
		// *****************************
		$cfg[ip]=$REMOTE_ADDR;
		if($mask) $cfg['mask']=$mask; 
		 $cfg['lang']=$lang;		
		if(((($bname=="msie")||($bname=="opera"))&&($bversion>4))||(($bname=="netscape")&&($bversion>3.5))||($bname=="mozilla")) $cfg['dhtml']=1; 
		// *****************************
		// Save to config file
		// *****************************
		if($file=fopen($path,"w+"))
		{
		while(list($x,$v)=each ($cfg))
			{
			$line='<meta name="'.$x.'" content="'.$v.'">';
			fwrite($file,$line."\r\n");
			}
		fclose($file);
		}
		setcookie(ck_config,$filename,time()+(3600*24*365)); // expires after 1 year
}	

?>
<HTML>
<HEAD>
<?php 

include_once('include/inc_charset_fx.php');
echo setCharSet(); 

?>
 <TITLE><?php echo $LDMainTitle ?></TITLE>

 <!-- <TITLE>CARE 2002 Integrated Hospital Information System</TITLE> -->
<meta name="Description" content="Maryhospital Virtual Integrated Information System of a Hospital powered by CARE 2002">
<meta name="Author" content="Elpidio Latorilla">
<meta name="Generator" content="AceHTML 4 Freeware">
</HEAD>
<?php
if($cfg[mask]==2)
{
?>
<frameset rows="25,*" border=0>
  <frameset cols="9%,*" border=0>
    <frame name="STARTPAGE" src="main/indexframe.php?boot=1&lang=<?php echo "$lang&egal=$egal&cookie=$cookie&sid=$sid" ?>&mask=2">
    <frame name="MENUBAR" src="main/menubar2.php" scrolling=no>
  </frameset>
  <frame name="CONTENTS" src="">
  
<?php
}
else
{
?>
<frameset cols="150,*" border=0>
	<FRAME MARGINHEIGHT="5"	MARGINWIDTH  ="5" NAME = "STARTPAGE" SRC = "main/indexframe.php?boot=1&mask=<?php echo "$mask&lang=$lang&cookie=$cookie&sid=$sid" ?>" SCROLLING="auto"  >
	<FRAME NAME = "CONTENTS" SRC = "blank.php?lang=<?php echo "$lang&sid=$sid" ?>">
<?php
}
?>
</frameset>
<noframes>
<BODY bgcolor=white>
<?php echo $LDNoFrame ?><BR>
<A HREF="contents.htm"> OK</A></BODY>
</noframes>

</HTML>
