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
if (!$sid||($sid!=$ck_sid)||!$edit||!$phonedir_user||!$itemname) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_phone.php");
require("../req/config-color.php");

$error=1;
//$newdata=0;
$curdate=date("Y.m.d");
$curtime=date("H.i");
$dbtable="mahophone";

if($from=="list") include("../req/db-makelink.php");

if($link&&$DBLink_OK) 					
{
    if ($mode=="save")
     {
	    // start checking input data
	    if (($name!="")or($vorname!=""))
		{
						$sql='UPDATE '.$dbtable.' SET
							mahophone_title="'.$anrede.'",
							mahophone_name="'.$name.'",
							mahophone_vorname="'.$vorname.'",
							mahophone_beruf="'.$beruf.'",
							mahophone_bereich1="'.$bereich1.'",
							mahophone_bereich2="'.$bereich2.'",
							mahophone_inphone1="'.$inphone1.'",
							mahophone_inphone2="'.$inphone2.'",
							mahophone_inphone3="'.$inphone3.'",
							mahophone_exphone1="'.$exphone1.'",
							mahophone_exphone2="'.$exphone2.'",
							mahophone_funk1="'.$funk1.'",
							mahophone_funk2="'.$funk2.'",
							mahophone_roomnr="'.$zimmerno.'",
							mahophone_date="'.$curdate.'",
							mahophone_time="'.$curtime.'",
							mahophone_encoder="'.$phonedir_user.'"  
						WHERE mahophone_item="'.$itemname.'"';
				
 						if(mysql_query($sql,$link))
						{ 
							header("Location: telesuch_phonelist.php?sid=$ck_sid&lang=$lang&batchnum=$batchnum&linecount=$linecount&pagecount=$pagecount&displaysize=$displaysize&update=1&itemname=$itemname&edit=$edit"); 
							exit;
						}
			 			else {print "<p>".$sql."<p>$LDDbNoSave";};
    	 }
 	}
	else
	{
						$sql='SELECT * FROM '.$dbtable.' WHERE mahophone_item="'.$itemname.'"';
		
 						if($ergebnis=mysql_query($sql,$link))	$zeile=mysql_fetch_array($ergebnis);					
			 			    else {print "<p>".$sql."<p>$LDDbNoRead";};
	}
}
 else print "$LDDbNoLink<br>";  
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE></TITLE>
<STYLE TYPE="text/css">
	.va12_b {font-family:verdana,arial;font-size:12;text-decoration: none; color: #0000cc;}
</style>
</HEAD>

	<BODY >
	<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?=$LDPhoneDir ?></b></font>

	<table width=100% border=1>
	<tr>
	<td bgcolor=navy>
	<FONT  COLOR=white  SIZE=+1  FACE=Arial><STRONG>&nbsp;<?=$LDUpdate ?></STRONG></FONT>
	</td>
	</tr>
	<tr bgcolor="#DDE1EC">
	<td ><p><br>
	<ul>
<?
if (($error==1)and($newvalues!="")) print "<FONT  COLOR=maroon  SIZE=+1  FACE=Arial>$LDNoData<p>";
?>
<form method="post" action="telesuch_eintrag_update.php">
<table bgcolor="#f9f9f9" border="1" cellpadding="5" cellspacing="1">
<tr>
<td colspan="3"><FONT    SIZE=-1  FACE="Arial">
<b><?  print str_replace("~nr~",$zeile[mahophone_item],$LDDirData); ?> </b>
</td>
<td >
&nbsp;
</td>
</tr>
<tr>
<td class="va12_b">

<?=$LDEditFields[1] ?>&nbsp;
<input name=anrede type=text size="5" value="<? print $zeile[mahophone_title] ?>"><br>
</td>
<td class="va12_b">

<?=$LDEditFields[2] ?>&nbsp;
<input name=name type=text size="15" value="<? print $zeile[mahophone_name] ?>"><br>
</td>
<td class="va12_b">
<?=$LDEditFields[3] ?>&nbsp;

<input type=text name=vorname size="15" value="<? print $zeile[mahophone_vorname] ?>"><br>
</td>
<td class="va12_b">
<?=$LDEditFields[4] ?>&nbsp;
<input type=text name=beruf size="10" value="<? print $zeile[mahophone_beruf] ?>"><br>
</td>
</tr>
<tr>
<td colspan=2 class="va12_b">
<?=$LDEditFields[5] ?><br>

<input type=text name=bereich1 size="10" value="<? print $zeile[mahophone_bereich1] ?>"><br>
</td>
<td class="va12_b">
<?=$LDEditFields[6] ?><br>
<input type=text name=bereich2 size="10" value="<? print $zeile[mahophone_bereich2] ?>"><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?=$LDEditFields[7] ?><br>

<input type=text name=inphone1 size="20" value="<? print $zeile[mahophone_inphone1] ?>"><br>
</td>
<td class="va12_b">
<?=$LDEditFields[8] ?><br>
<input type=text name=inphone2 size="20" value="<? print $zeile[mahophone_inphone2] ?>"><br>
</td>
<td class="va12_b">
<?=$LDEditFields[9] ?><br>
<input type=text name=inphone3 size="20" value="<? print $zeile[mahophone_inphone3] ?>"><br>
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?=$LDEditFields[10] ?><br>

<input type=text name=exphone1 size="20" value="<? print $zeile[mahophone_exphone1] ?>"><br>
</td>
<td class="va12_b">
<?=$LDEditFields[11] ?><br>
<input type=text name=exphone2 size="20" value="<? print $zeile[mahophone_exphone2] ?>"><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?=$LDEditFields[12] ?><br>

<input type=text name=funk1 size="20" value="<? print $zeile[mahophone_funk1] ?>"><br>
</td>
<td class="va12_b">
<?=$LDEditFields[13] ?><br>
<input type=text name=funk2 size="20" value="<? print $zeile[mahophone_funk2] ?>"><br>
</td>
<td class="va12_b">
<?=$LDEditFields[14] ?><br>
<input type=text name=zimmerno size="20" value="<? print $zeile[mahophone_roomnr] ?>"><br>
</td>
</tr>
<tr>
<td colspan=3>
<p>
<input type="hidden" name="mode" value="save">
<input type="hidden" name="from" value="list">
<input type="hidden" name="itemname" value="<? print $itemname ?>">
<input type="hidden" name="linecount" value="<? print $linecount ?>">
<input type="hidden" name="pagecount" value="<? print $pagecount ?>">
<input type="hidden" name="batchnum" value="<? print $batchnum ?>">
<input type="hidden" name="displaysize" value="<? print $displaysize ?>">
<input type="hidden" name="edit" value="<? print $edit ?>">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="submit"  value="<?=$LDUpdate ?>"> &nbsp;
<input type="reset"  value="<?=$LDReset ?>">
</td>
<td >
&nbsp;
</td>
</tr>
</table>
</form>

<FONT    SIZE=-1  FACE="Arial">
<p>
<FORM action="telesuch_phonelist.php" method="post">
<input type="hidden" name="linecount" value="<? print $linecount ?>">
<input type="hidden" name="pagecount" value="<? print $pagecount ?>">
<input type="hidden" name="batchnum" value="<? print $batchnum ?>">
<input type="hidden" name="displaysize" value="<? print $displaysize ?>">
<input type="hidden" name="edit" value="<? print $edit ?>">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<INPUT type="submit"  value="<?=$LDCancel ?>"></font></FORM>
<p>
</FONT>
</ul>
<p>
</td>
</tr>
</table>        
<p>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</FONT>
</BODY>
</HTML>
