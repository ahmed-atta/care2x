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
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
if($from!="station")
	if(!$HTTP_COOKIE_VARS["ck_lab_user".$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if(!$patnum) header("location:labor_data_patient_such.php?sid=$sid&lang=$lang");
require("../include/inc_config_color.php");

$thisfile="labor_datainput.php";

if($from=="station") $breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$patnum";
	else $breakfile="labor_data_patient_such.php?sid=$sid&lang=$lang";

$fielddata="patnum,name,vorname,gebdatum";

require("../include/inc_labor_param_group.php");

						
if($parameterselect=="") $parameterselect=0;

$parameters=$paralistarray[$parameterselect];					
//$paramname=$parametergruppe[$parameterselect];


if($nostat) $ret="labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$patnum";
	else $ret="pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$patnum";
	
require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{
			// get orig data
		$dbtable="mahopatient";
		$sql="SELECT patnum,name,vorname,gebdatum FROM $dbtable WHERE patnum='$patnum' ";
		if($ergebnis=mysql_query($sql,$link))
       	{
			$rows=0;
			if( $result=mysql_fetch_array($ergebnis)) $rows++;
			if($rows)
			{
				mysql_data_seek($ergebnis,0);
				$result=mysql_fetch_array($ergebnis);
				
				$dbtable="lab_test_data";
				$sql="SELECT * FROM $dbtable WHERE patnum='$patnum' ORDER BY tid DESC";
				
        		if($ergebnis=mysql_query($sql,$link))
				{
					$rows=0;$zeile=array();
					while ($zeile=mysql_fetch_array($ergebnis)) $rows++;
					if ($rows) mysql_data_seek($ergebnis,0);
					else
					 {
					 	if($nostat)header("location:labor-nodatafound.php?sid=$sid&lang=$lang&patnum=$patnum&ln=$result[name]&fn=$result[vorname]&nodoc=labor");
					 	else header("location:pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$patnum&nodoc=labor");
					 	exit;
					 }
				}	
			}
		}
			else{print "<p>$sql$LDDbNoRead";exit;}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<title><?php print "$LDLabReport $station"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
.a12_b{font-family:arial; font-size:12; color:#000000}
.j{font-family:verdana; font-size:12; color:#000000}
</style>

<?php 
require("../include/inc_css_a_hilitebu.php");
?>

<script language="javascript">
<!-- Script Begin
var toggle=true;
function selectall()
{
	for(i=0;i<document.labdata.pname.length;i++)
	{
	if(toggle==true)
	{document.labdata.pname[i].checked=true; }
		else
		{ document.labdata.reset();}
	}	
	toggle=(!toggle);

}
function prep2submit()
{

	var j=0;
	d=document.labdata;
	for(i=0;i<d.pname.length;i++)
	{
		if(d.pname[i].checked==true) 
		{
			if(j)
			{d.params.value=d.params.value +"~"+d.pname[i].value;}
			else
			{ d.params.value=d.pname[i].value;	j=1;}
		}
	}
	if(d.params.value!=""){d.submit(); }
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//  Script End -->
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php if(!$noexpand) : ?>
<script language="">
<!-- Script Begin
	window.moveTo(0,0);
	 window.resizeTo(1000,740);
//  Script End -->
</script>
<?php endif ?>

<table  border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php print "$LDLabReport $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab_list.php','','','','<?php echo $LDLabReport ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>

<tr>
<td colspan=2  bgcolor=#dde1ec><p><br>

<FONT    SIZE=-1  FACE="Arial">

<ul>

<table border=0>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<?php print $result[patnum]; ?>&nbsp;
</td>
</tr>

<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo "$LDLastName, $LDName, $LDBday" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php print  $result[name]; ?>, <?php print  $result[vorname]; ?>&nbsp;&nbsp;<?php print  $result[gebdatum]; ?></b>
</td>
</tr>
</table>
<p>
<?php
print '
<button onClick="javascript:prep2submit()"><img src="../img/chart.gif" width=16 height=17 border=0 align="absmiddle"> '.$LDClk2Graph.'</button>';
?>
<p>
<table border=0 bgcolor=#9f9f9f cellspacing=0 cellpadding=0>
<tr>
<td>
<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1>
<?php 

while($zeile=mysql_fetch_array($ergebnis)) $data[]=$zeile;

if(sizeof($data)>5) $data=array_slice($data,0,5);
$data=array_reverse($data);
$pname=array();
for($a=0;$a<sizeof($data);$a++)
{
	$da=$data[$a];
	for($b=0;$b<sizeof($parametergruppe);$b++)
	{
		$buf=$da[($parametergruppe[$b])];
		//print $parametergruppe[$b]."<br>";
		parse_str($buf,$elems);
		//print $buf."<br>";
		$parameters=$paralistarray[$b];
		for($c=0;$c<sizeof($parameters);$c++)
		{
		//print $parameters[$c]." param <br>";
			
			//list($key[($a.$b.$c)],$val[($a.$b.$c)])=$elems[$c];
			if($elems[($parameters[$c])]!="")
			{
				$val[($a.($parameters[$c]))]=$elems[($parameters[$c])];
				if(!in_array($parameters[$c],$pname)) $pname[]=$parameters[$c];
			}
		}
	}
}	

array_unique($pname);
$cols=sizeof($data);
if($cols>5) if($cfg[mask]!=2) $cols=5;  // set colunm number
if(($rows=sizeof($pname))<10) $rows=10; // set rows number
//print sizeof($pname);
print'
   <tr bgcolor="#dd0000" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>';
	for($i=0;$i<$cols;$i++)
	print '
	<td class="a12_b"><font color="#ffffff">&nbsp;<b>'.$data[$i][test_date].'</b>&nbsp;</td>';
	print '
   <td>&nbsp;<a href="javascript:prep2submit()"><img src="../img/chart.gif" width=16 height=17 border=0 align="absmiddle" alt="'.$LDClk2Graph.'"></td></a></td></tr>';
print'
   <tr bgcolor="#ffddee" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;</td>';
	for($i=0;$i<$cols;$i++)
	print '
	<td class="a12_b"><font color="#0000cc">&nbsp;<b>'.$data[$i][test_time].'</b> '.$LDOClock.'&nbsp;</td>';
	print '
   <td>&nbsp;<a href="javascript:selectall()"><img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 align="absmiddle" alt="'.$LDClk2SelectAll.'"></a>
       </tr>';


for($l=0;$l<$rows;$l++)
{
	print'
   <tr bgcolor=';
	 if($toggle) {print '"#ffdddd"'; $toggle=(!$toggle); }else { print '"#ffeeee"';$toggle=(!$toggle);}
   print '>
     <td class="va12_n"> &nbsp;<nobr><a href="#">'.strtr($pname[$l],"_-",". ").'</a></nobr> 
	</td>
	<td class="j" >&nbsp;&nbsp;</td>';
	for($i=0;$i<$cols;$i++)
	print '
	<td class="j" >&nbsp;'.$val[$i.$pname[$l]].'&nbsp;</td>';
	print '
	<td>
	<input type="checkbox" name="pname" value="'.$pname[$l].'">
</td></tr>';
}
	print '
</table>';     

// set the row/date variables for form
for($i=0;$i<$cols;$i++)
print '
<input type="hidden" name="date'.$i.'" value="'.$data[$i][test_date].'">
<input type="hidden" name="time'.$i.'" value="'.$data[$i][test_time].'">';
for($i=0;$i<$cols;$i++)
print '
<input type="hidden" name="tid'.$i.'" value="'.$data[$i][tid].'">';

print '
<input type="hidden" name="colsize" value="'.$cols.'">
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="from" value="'.$from.'">
<input type="hidden" name="edit" value="'.$edit.'">
<input type="hidden" name="params" value="">
<input type="hidden" name="patnum" value="'.$result[patnum].'">
<input type="hidden" name="name" value="'.$result[name].'">
<input type="hidden" name="vorname" value="'.$result[vorname].'">
<input type="hidden" name="gebdatum" value="'.$result[gebdatum].'">';
?>                                         
</td></tr>
</table>
</form>

<p>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0" width=103 height=24 alt="<?php echo $LDClose ?>"></a>
</UL>

</FONT>


<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</td>
</tr>
</table>        


</BODY>
</HTML>
