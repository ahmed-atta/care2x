<?
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla
								
Beta version 1.0    2002-05-10
								
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

//if(!$lang&&$mode!="viish") { header ("location:start.php"); exit; }

function configNew(&$bn,&$bv,&$f,$i,&$uid)
{
		global $HTTP_USER_AGENT;
		global $REMOTE_ADDR;
		
		$bbuff=str_replace("/"," ",$HTTP_USER_AGENT);
		$bbuff=strtolower(str_replace(";","",$bbuff));
		$bbuff=explode(" ",$bbuff);
	
		for($j=(sizeof($bbuff)-1);$j>=0;$j--)
		{
			if(($bbuff[$j]=="opera")||($bbuff[$j]=="msie"))
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

if(!$egal)
{
	$usid=uniqid("");
	setcookie(ck_sid,$usid);
	$ck_sid=$usid;
	mt_srand(time()*10);
	include("counter/count.php");	
}

if($boot||(!$ck_config)) configNew($bname,$bversion,$filename,$ip,$cfgid);
else $filename=$ck_config;

// ********************
// Get init color values
// ********************
$path="userconfig/".$filename;
if(file_exists($path))	$cfg=get_meta_tags($path);
	else $cfg=get_meta_tags("userconfig/default/default.cfg");
	
if($lang) $savelang=1;
	 else
		{
		 	if($cfg[lang]) $lang=$cfg[lang];
			else  include("chklang.php");
		}
		 
setcookie(ck_language,$lang);
$ck_language=$lang;
require("language/".$lang."/lang_".$lang."_startframe.php");
	
if($mask||!file_exists($path)||$savelang)
{
		if(!file_exists($path))
		{
			configNew($bname,$bversion,$filename,$ip,$cfgid);
			$cfg['bname']=$bname;
			$cfg['bversion']=$bversion;
			$cfg[cid]=$cfgid;
		}
		$path="userconfig/".$filename;
		// *****************************
		//save browser info to array
		// *****************************
		$cfg[ip]=$REMOTE_ADDR;
		if($mask) $cfg[mask]=$mask; 
		 $cfg[lang]=$lang;		
		if(((($bname=="msie")||($bname=="opera"))&&($bversion>4))||(($bname=="netscape")&&($bversion>3.5))) $cfg['dhtml']=1; 
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

/*if(!$egal)
{
	if(($cfg[bname]!="msie")||($cfg[bversion]<5)) 
	{
		header("location:browser.php?lang=$lang&b=$cfg[bname]&v=$cfg[bversion]");
		exit;
	}

}
else*/
if(!$ck_sid) 
{
		header("location:cookies.php?lang=$lang");
		exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?=$LDMainTitle ?></TITLE>

 <!-- <TITLE>CARE 2002 Integrated Hospital Information System</TITLE> -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Description" content="Maryhospital Virtual Integrated Information System of a Hospital powered by CARE 2002">
<meta name="Author" content="Elpidio Latorilla">
<meta name="Generator" content="AceHTML 4 Freeware">
</HEAD>
<?
if($cfg[mask]==2)
{
?>
<frameset rows="25,*" border=0>
  <frameset cols="9%,*" border=0>
    <frame name="STARTPAGE" src="main/indexframe.php?boot=1&lang=<?="$lang&egal=$egal&cookie=$cookie" ?>&mask=2">
    <frame name="MENUBAR" src="main/menubar2.php" scrolling=no>
  </frameset>
  <frame name="CONTENTS" src="">
  
<?
}
else
{
?>
<frameset cols="150,*" border=0>
	<FRAME MARGINHEIGHT="5"	MARGINWIDTH  ="5" NAME = "STARTPAGE" SRC = "main/indexframe.php?boot=1&mask=<?="$mask&lang=$lang&cookie=$cookie" ?>" SCROLLING="auto"  NORESIZE >
	<FRAME NAME = "CONTENTS" SRC = "blank.htm">
<?
}
?>
</frameset>
<noframes>
<BODY bgcolor=white>
<?=$LDNoFrame ?><BR>
<A HREF="contents.htm"> OK</A></BODY>
</noframes>

</HTML>
