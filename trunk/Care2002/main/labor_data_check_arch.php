<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

$thisfile='labor_data_check_arch.php';
$breakfile="labor_data_patient_such.php?sid=$sid&lang=$lang&mode=edit";

$toggle=0;

$fielddata='patnum, name, vorname, gebdatum, item';

$keyword=trim($keyword);

$dbtable='care_lab_test_data';

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{
    /* Load the date formatter */
    require_once('../include/inc_date_format_functions.php');
    
	
    /* Load editor functions for time format converter */
    //include_once('../include/inc_editor_fx.php');

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
						case 'list': header("location:pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$patnum&nodoc=labor");break;
						default: header("location:labor_datainput.php?sid=$sid&lang=$lang&patnum=$patnum&newid=1&mode=$mode");
					}
				}
			}
			 else {echo "<p>$sql$LDDbNoRead";}
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }

?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>Labor Check Archive</TITLE>
 <style type="text/css" name="1">
.va12_w{font-family:verdana,arial; font-size:12; color:#ffffff}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>

</HEAD>

<BODY BACKGROUND="leinwand.gif">

<img <?php echo createComIcon('../','micros.gif','0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo "$LDLabReport - $LDNewData" ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img <?php echo createLDImgSrc('../','newdata-b.gif','0') ?>><a href="labor_data_patient_such.php?sid=<?php echo "$sid&lang=$lang&mode=$mode" ?>"><img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>></a></td>
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
if($linecount>1) echo "<p>$LDReportFoundMany";
	else echo "<p>$LDReportFound";
echo " <font color=red><b>$patnum</b></font>.";
if($linecount>1) echo "<br> $LDIfWantEditMany<p>";
	else echo "<br> $LDIfWantEdit<p>";
					//	$abuf=array(); $last=array();
				
					echo "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=#9f9f9f>";
					
					/* Print the column descriptors */
						echo'
						<td class="va12_w"><b>'.$LDJobIdNr.'</b></td>
						<td class="va12_w"><b>'.$LDExamDate.'</b></td>
					 <td class="va12_w">&nbsp;'.$LDAt.'</td>
					 <td class="va12_w">&nbsp;</td>
					 </tr>';
					 
                    /* Print the list of the stored test results */
					while($zeile=mysql_fetch_array($ergebnis))
					{
						$abuf=explode('~',$zeile['encoding']);	
						$abuf=array_pop($abuf);
						parse_str(trim($abuf),$last);
						
					    echo '<tr bgcolor=';
						
						if($toggle) { echo "#dfdfdf>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
	
	                         /* Print the job id or batch nr., test date and time */
							echo'
							<td><font face=arial size=2>
							&nbsp;<a href=labor_datainput.php?&patnum='.$patnum.'&job_id='.$zeile['job_id'].'>'.$zeile['job_id'].'</a>
							</td>
							<td><font face=arial size=2>&nbsp;'.formatDate2Local($zeile['test_date'],$date_format).'
							</td>
							<td><font face=arial size=2>&nbsp;'.convertTimeToLocal($zeile['test_time']).'
							</td>';
						    echo'<td><font face=arial size=2>&nbsp';
						
						    /* Create the link button */
					        echo '<a href=labor_datainput.php?sid='.$sid.'&lang='.$lang.'&patnum='.$patnum.'&job_id='.$zeile['job_id'].'&mode='.$mode.'&update=1><img 
										'.createComIcon('../','bul_arrowgrnlrg.gif','0').' alt="'.$LDClk2Edit.'"></a>&nbsp;</td></tr>';

					}
					echo "</table>";

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
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>
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
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</FONT>


</BODY>
</HTML>
