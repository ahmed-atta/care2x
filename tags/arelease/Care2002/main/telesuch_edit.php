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
if (!$sid||($sid!=$ck_sid)||!$phonedir_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_phone.php");
require("../req/config-color.php");

$error=1;
$newdata=1;
$dbtable="mahophone";
$curdate=date("Y.m.d");
$curtime=date("H.i");

include("../req/db-makelink.php");
if($link&&$DBLink_OK) 
{	
   if ($mode=="save")
    {
	   // start checking input data
	   if (($name!="")or($vorname!="")) 
	   {	
				$sql="INSERT INTO ".$dbtable." 
						(	mahophone_item,
							mahophone_title,
							mahophone_name,
							mahophone_vorname,
							mahophone_beruf,
							mahophone_bereich1,
							mahophone_bereich2,
							mahophone_inphone1,
							mahophone_inphone2,
							mahophone_inphone3,
							mahophone_exphone1,
							mahophone_exphone2,
							mahophone_funk1,
							mahophone_funk2,
							mahophone_roomnr,
							mahophone_date,
							mahophone_time,
							mahophone_encoder ) 
						VALUES (
							'$itemno',
							'$anrede',
							'$name', 
							'$vorname', 
							'$beruf', 
							'$bereich1', 
							'$bereich2', 
							'$inphone1', 
							'$inphone2', 
							'$inphone3', 
							'$exphone1', 
							'$exphone2', 
							'$funk1', 
							'$funk2', 
							'$zimmerno',
							'$curdate', 
							'$curtime',
							'$phonedir_user')";
				
 						if(mysql_query($sql,$link))
						{ 
							header("location:telesuch_phonelist.php?sid=$ck_sid&lang=$lang&newdata=1&edit=1");
							exit;
						}
			 			else {print "<p>".$sql."<p>$LDDbNoSave.";};
    	 }
 	}
	else
	{
			$sql="SELECT * FROM $dbtable ORDER BY mahophone_item DESC";
        	$ergebnis=mysql_query($sql,$link);
			if($ergebnis)
       		{
				if($zeile=mysql_fetch_array($ergebnis)) $itemno=$zeile[mahophone_item]+1;
				 	else $itemno=1;
			}
			 else print "<p>".$sql."<p>$LDDbNoRead";
	}
}
else print "$LDDbNoLink<br>"; 
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">

<HTML>
	<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 	<TITLE></TITLE>
	 
<? 
require("../req/css-a-hilitebu.php");
?>

	</HEAD>

	<BODY bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

	<FONT  COLOR="<?=$cfg[top_txtcolor] ?>" SIZE=6  FACE="verdana"> <b><?="$LDPhoneDir $LDNewData" ?></b></font>

	<table width=100% border=0 cellspacing=0 cellpadding=0>
	<tr>
	<td colspan=3><nobr>
	<a href="telesuch_phonelist.php?sid=<? print "$ck_sid&lang=$lang&edit=$edit"; ?>"><img src=../img/<?="$lang/$lang" ?>_phonedir-gray.gif border=0 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img src=../img/<?="$lang/$lang" ?>_newdata-b.gif border=0></nobr></td>
	</tr>
	<tr>
	<td bgcolor=#333399 colspan=3 >
	<FONT  SIZE=2  FACE=verdana,Arial color="#ffffff"><b>
	<?
		if(($newvalues=="")and($remark!="fromlist")) 
		{
		
		$curtime=date("G");
		if ($curtime<9) print $LDGoodMorning;
		if (($curtime>9)&&($curtime<18)) print $LDGoodDay;
		if ($curtime>18) print $LDGoodEvening;
		print " ".$phonedir_user;
		}
	?>&nbsp;&nbsp;</b>
	</FONT>
	</td>
	</tr>
	
	<tr bgcolor="#DDE1EC">
	
	<td bgcolor=#333399>&nbsp;</td>

	<td ><p><br>
	<ul>


<FONT    SIZE=-1  FACE="Arial"><p>
<FORM action="telesuch_phonelist.php" method="post" name="newentry">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="newdata" value="<? print $newdata ?>">
<input type="hidden" name="edit" value="<? print $edit ?>">
<INPUT type="submit"  value="<?=$LDShowActualDir ?>"></font></FORM>
<p>
</FONT>
<?
if (($error==1)and($newvalues!=""))
{
print "<FONT  COLOR=maroon  SIZE=+1  FACE=Arial> $LDNoData<p>";
}
?>
<form method="get" action="telesuch_edit.php" enctype="">
<table bgcolor="#cceeff" border="1" cellpadding="5" cellspacing="1">
<tr>
<td colspan="3"><FONT    SIZE=-1  FACE="Arial">
<?=$LDNewPhoneEntry ?>:
</td>
<td >
&nbsp;
</td>
</tr>
<tr>
<td>
<FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[1] ?>&nbsp;
<input name=anrede type=text size="5" value=""><br>
</td>
<td>
<FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[2] ?>&nbsp;
<input name=name type=text size="15" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[3] ?>&nbsp;
<input type=text name=vorname size="15" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[4] ?>&nbsp;
<input type=text name=beruf size="10" value=""><br>
</td>
</tr>
<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[5] ?>
<br>

<input type=text name=bereich1 size="10" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[6] ?>
<br>
<input type=text name=bereich2 size="10" value=""><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[7] ?>
<br>

<input type=text name=inphone1 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[8] ?>
<br>
<input type=text name=inphone2 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[9] ?>
<br>
<input type=text name=inphone3 size="20" value=""><br>
</td>
</tr>

<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[10] ?><br>

<input type=text name=exphone1 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[11] ?><br>
<input type=text name=exphone2 size="20" value=""><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[12] ?><br>

<input type=text name=funk1 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[13] ?><br>
<input type=text name=funk2 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?=$LDEditFields[14] ?><br>
<input type=text name=zimmerno size="20" value=""><br>
</td>
</tr>

<tr>
<td colspan=3><FONT    SIZE=-1  FACE="Arial">
<p>
<input type="hidden" name="itemno" value="<? print $itemno ?>">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="edit" value="<?=$edit ?>">
<input type="submit" value="<?=$LDSave ?>">
<input type="reset" name="erase" value="<?=$LDReset ?>">
&nbsp;
</td>
<td >
&nbsp;
</td>
</tr>
</table>
</form>
<FONT    SIZE=-1  FACE="Arial">
<p>
<FORM action="telesuch.php" name="breaker">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<INPUT type="submit"  value="<?=$LDCancel ?>"></font></FORM>
<p>
</FONT>
</ul>
<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>
</table>        
<p>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</FONT>
</BODY>
</HTML>
