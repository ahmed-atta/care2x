<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","lab.php");
$local_user="ck_lab_user";
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$thisfile="labor_data_check_arch.php";
$breakfile="labor_data_patient_such.php?sid=$sid&lang=$lang&mode=edit";

$toggle=0;

$fielddata="patnum, name, vorname, gebdatum, item";

$keyword=trim($keyword);

$dbtable="lab_test_data";

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
		{
			$sql="SELECT job_id,test_date,test_time,encoding FROM $dbtable WHERE patnum='$patnum' ORDER BY tid DESC";

        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				if ($linecount>0) 
				{ 		  
					
					mysql_data_seek($ergebnis,0);
				  	
				}
				else
				{
					mysql_close($link);
					switch($mode)
					{
						case "list": header("location:pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$patnum&nodoc=labor");break;
						default: header("location:labor_datainput.php?sid=$sid&lang=$lang&patnum=$patnum&newid=1&mode=$mode");
					}
				}
			}
			 else {print "<p>$sql$LDDbNoRead";}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }

?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Labor Check Archive</TITLE>
 <style type="text/css" name="1">
.va12_w{font-family:verdana,arial; font-size:12; color:#ffffff}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>

</HEAD>

<BODY BACKGROUND="leinwand.gif">

<img src=../img/micros.gif align="absmiddle"><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo "$LDLabReport - $LDNewData" ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img src="../img/<?php echo "$lang/$lang" ?>_newdata-b.gif" border=0 width=130 height=25><a href="labor_data_patient_such.php?sid=<?php echo "$sid&mode=$mode" ?>"><img src="../img/<?php echo "$lang/$lang" ?>_such-gray.gif" border=0 width=130 height=25></a></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>
<FONT  SIZE=1  FACE="Arial"><STRONG> &nbsp; </STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td valign=top><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

<?php 
if($linecount>1) print "<p>$LDReportFoundMany";
	else print "<p>$LDReportFound";
print " <font color=red><b>$patnum</b></font>.";
if($linecount>1) print "<br> $LDIfWantEditMany<p>";
	else print "<br> $LDIfWantEdit<p>";
					//	$abuf=array(); $last=array();
				
					print "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=#9f9f9f>";
					
						print'
						<td class="va12_w"><b>'.$LDJobIdNr.'</b></td>
						<td class="va12_w"><b>'.$LDExamDate.'</b></td>
					 <td class="va12_w">&nbsp;'.$LDOn.'</td>
					 <td class="va12_w">&nbsp;'.$LDAt.'</td>
					 </tr>';

					while($zeile=mysql_fetch_array($ergebnis))
					{
						$abuf=explode("~",$zeile[encoding]);	
						$abuf=array_pop($abuf);
						parse_str(trim($abuf),$last);
					print "<tr bgcolor=";
						if($toggle) { print "#dfdfdf>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
	
							print'
							<td><font face=arial size=2>
							&nbsp;<a href=labor_datainput.php?&patnum='.$patnum.'&job_id='.$zeile[job_id].'>'.$zeile[job_id].'</a>
							</td>
							<td><font face=arial size=2>&nbsp;'.$zeile[test_date].'
							</td>
							<td><font face=arial size=2>&nbsp;'.$zeile[test_time].'
							</td>
							<td><font face=arial size=2>
							&nbsp;'.$last[e].'
							</td>';
						print'<td><font face=arial size=2>&nbsp';
					   print'<a href=labor_datainput.php?sid='.$sid.'&lang='.$lang.'&patnum='.$patnum.'&job_id='.$zeile[job_id].'&mode='.$mode.'&update=1><img 
										src="../img/bul_arrowgrnlrg.gif" width=16 height=16 border=0 alt="'.$LDClk2Edit.'"></a>&nbsp;</td></tr>';

					}
					print "</table>";

?><p>
<form action="labor_datainput.php" method="get"><font face=verdana,arial size=4>
<b><?php echo $LDNewJob ?></b></font><br>
<?php echo "$LDNew $LDJobIdNr" ?>:<br>
<input type="text" name="job_id" size=15 maxlength=15>
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="newid" value="1">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDCreate ?>">
</form>

<p>
<p>
<hr width=80% align=left>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border=0>
</a><p>

</ul>
&nbsp;
</FONT>
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
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
