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

if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$edit||!$phonedir_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_phone.php");
require("../req/config-color.php");

$dbtable="mahophone";
$forwardfile="telesuch_phonelist.php";
$breakfile="telesuch_phonelist.php";
$thisfile="telesuch_eintrag_delete.php";

include("../req/db-makelink.php");
if($link&&$DBLink_OK) 
{
    if ($finalcommand=="delete")
    {
        if($itemname!=$linecount)
        {		
            // first renumber the remaining data
            for ($i=$itemname+1;$i<=$linecount;$i++)
            {
                $sql='UPDATE '.$dbtable.' SET mahophone_item="'.($i*10000).'" WHERE mahophone_item="'.$i.'"';	
                if (!(mysql_query($sql,$link))) print $sql."<br>$LDDbNoUpdate";
            }
            // then delete the  data
            $sql='DELETE FROM '.$dbtable.' WHERE mahophone_item="'.$itemname.'"';	
            if (!(mysql_query($sql,$link))) print $sql."<br>$LDDbNoDelete";

            // then correctly itemize the remaining data
            for ($i=$itemname+1;$i<=$linecount;$i++)
            {
                $sql='UPDATE '.$dbtable.' SET mahophone_item="'.($i-1).'" WHERE mahophone_item="'.($i*10000).'"';	
                if (!(mysql_query($sql,$link))) print $sql."<br>$LDDbNoUpdate";
            }	
        }else  // if item is the last then simply delete the  data
        {
            $sql='DELETE FROM '.$dbtable.' WHERE mahophone_item="'.$itemname.'"';	
            if (!(mysql_query($sql,$link))) print $sql."<br>$LDDbNoDelete";										
        }
         // check if the pagecount is reduced
        $buffer=($pagecount-1)*$displaysize;
        if (($buffer+1)==$linecount)
        { 
		    $pagecount--; if($batchnum>1)  $batchnum--; };						
            $linecount--;
            header("Location: telesuch_phonelist.php?&sid=$ck_sid&lang=$lang&route=validroute&remark=itemdelete&batchnum=$batchnum&displaysize=$displaysize&linecount=$linecount&pagecount=$pagecount&edit=$edit");
            exit;
        }else 
        {
            $sql='SELECT * FROM '.$dbtable.' WHERE mahophone_item="'.$itemname.'"';
            $ergebnis=mysql_query($sql,$link);
            if($ergebnis) $zeile=mysql_fetch_array($ergebnis); 
                else print "$LDDbNoRead<br>$sql<br>";
        }
}
   else print "$LDDbNoLink<br>"; 
?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>
<? 
require("../req/css-a-hilitebu.php");
?>
</HEAD>

<BODY  bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<FONT    SIZE=-1  FACE="Arial">

<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?=$LDPhoneDir ?></b></font>

<table width=100% border=1>
<tr>
<td bgcolor="navy" >
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?=$LDDeleteEntry ?></STRONG></FONT>
</td>
</tr>
<tr>
<td bgcolor="#DDE1EC">
<p><br>
<center>
<table  border=1 cellpadding="20" >
<tr nowrap>
<td bgcolor="#ffffaa">
<p><FONT SIZE=2  FACE=Arial>
<?=$LDReallyDelete ?><p>

<table border="0" cellpadding="2" cellspacing="1">
<tr bgcolor="#0000cc" nowrap>
<?
	for($i=0;$i<(sizeof($LDEditFields));$i++) 
 	{	
		if($zeile[$i]!="") 	
		print "<td nowrap><FONT color=\"#fffff\" SIZE=2  FACE=Arial><b>".$LDEditFields[$i]."</b></td>\n";
   	}
?>
</tr>
<tr bgcolor="#f9f9f9" nowrap>
<?
	for($i=0;$i<(sizeof($LDEditFields));$i++) 
 	{	
		if($zeile[$i]!="") 	
		print "<td nowrap><FONT color=\"#000000\" SIZE=2  FACE=Arial><nobr>".$zeile[$i]."</td>\n";
   	}
?>
</tr>
</table>
<br>

<FORM action="<? print $thisfile ?>" method="post">
<INPUT type="hidden" name="itemname" value="<? print $itemname ?>">
<input type="hidden" name=finalcommand value="delete">
<input type="hidden" name=route value="validroute">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name=batchnum value="<? print $batchnum ?>">
<input type="hidden" name=displaysize value="<? print $displaysize ?>">
<input type="hidden" name=linecount value="<? print $linecount ?>">
<input type="hidden" name=pagecount value="<? print $pagecount ?>">
<input type="hidden" name=edit value="<? print $edit ?>">
<INPUT type="submit" name="versand" value="<?=$LDYesDelete ?>"></font></FORM>

<FORM  method=post action="<?print $breakfile ?>" >
<input type="hidden" name=route value="validroute">
<input type="hidden" name=batchnum value="<? print $batchnum ?>">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name=displaysize value="<? print $displaysize ?>">
<input type="hidden" name=linecount value="<? print $linecount ?>">
<input type="hidden" name=pagecount value="<? print $pagecount ?>">
<input type="hidden" name=edit value="<? print $edit ?>">
<INPUT type="submit"  value="<?=$LDNoCancel ?>"></font></FORM>

</center>
</td>
</tr>
</table>        
<p><br>
</td>
</tr>
</table>        
<p>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?=$LDHowManage ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?=$LDHowEnter ?></a><br>
<HR>
<p>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</FONT>
</BODY>
</HTML>
