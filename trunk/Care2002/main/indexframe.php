<?php
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

require("../req/config-color.php"); // load color preferences
if($lang)
{
	if(!$ck_language||($lang!=$ck_language)) setcookie(ck_language,$lang);
}
else
{
if(!$ck_language) include("../chklang.php");
	else $lang=$ck_language;

}
require("../language/".$lang."/lang_".$lang."_indexframe.php");

if(($cfg[mask]==2)&&!$nonewmask)
{
	header ("location: indexframe2.php?sid=$ck_sid&lang=$lang&boot=$boot&cookie=$cookie");
	exit;
}
	
$targetfile=array("startframe.php",
					"telesuch.php",
					"aufnahme_pass.php",
					"medopass.php",
					"aerzte.php",
					"pflege.php",
					"op-doku.php",
					"technik.php",
					"labor.php",
					"radiolog.php",
					"apotheke.php",
					"medlager.php",
					"edv.php",
					"intra-email-pass.php",
					"../nocc/index.php",
					"spediens.php",
					"login.php"
					);

?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE>Menu - CARE 2002</TITLE>
<?
//set the css style for a links
require ("../req/css-a-sublinker-d.php");
?>
</HEAD>

<BODY onLoad="if (window.focus) window.focus();
<? if($boot) print 'window.parent.CONTENTS.location.replace(\'startframe.php?sid='.$ck_sid.'&lang='.$lang.'&egal='.$egal.'&cookie='.$cookie.'\');';
?>
"
<?
print 'bgcolor='.$cfg['idx_bgcolor'];
 if(!$cfg['dhtml']) print ' link='.$cfg['idx_txtcolor'].' vlink='.$cfg['idx_txtcolor'].' alink='.$cfg['idx_alink']; ?> 
 >
<center><img src="../img/care_logo.gif" ></center>
<TABLE CELLPADDING=2 CELLSPACING=0 border=0 >
<FONT  FACE="Arial"  SIZE="-1">

<?
for ($i=0;$i<sizeof($targetfile);$i++)
{
	if ($indextag[$i]=="Login &nbsp;")
 	{
		if ($ck_login_logged=="true")
		{
		$targetfile[$i]="logout_confirm.php";
		$indextag[$i]="Logout";
		}	
	}
print '<TR><TD bgcolor='.$cfg['idx_bgcolor'].' ALIGN="left">'; print "\n";
print '<A HREF="'.$targetfile[$i].'?sid='.$ck_sid.'&lang='.$lang.'"';
print ' TARGET="CONTENTS" REL="child">';
print "\n";
print '<img src="../img/blue_bullet.gif" border=0 align="middle"><font FACE="verdana,Arial" SIZE=-1 ><b>'.$indextag[$i].'</b></FONT></A>';
print "\n";
print '</TD></TR>';
}

?>


<tr>
<td>
<A HREF=<? if(($cfg[mask]==1)||($cfg[mask]=="")) print '"'.$VersionChgHref.'" target="_top"'; else print '"javascript:window.opener.top.location.replace(\''.$VersionChgHref.'\')"'; ?> ><img src="../img/blue_bullet.gif" border=0 align="middle"><font FACE="verdana,Arial" SIZE=-1 ><nobr><b><?=$VersionChgLang ?></b></nobr></FONT></A>
</td>
</tr>
<tr >
<td>
<font FACE="Arial" SIZE=1 color="#6f6f6f"><nobr><b>Log Info</b></nobr><br>
<?=$ck_login_username ?><br>
<?=$ck_thispc_dept ?><br></FONT>
</td>
</tr>
</FONT>
</TABLE>

</BODY>
</HTML>
