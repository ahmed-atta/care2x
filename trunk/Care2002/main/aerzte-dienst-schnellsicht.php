<?

$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;


$stationen=array("M4A","M4B","M4C","M4D","M5A","M5B","M5C","M5D","M6A",
				 "M6B","M6C","M6D","M7A","M7B","M7C","M7D","M8A","M8B","M8C","M8D",
				 "M9A","M9B","M9C","M9D","P1A","P1B","P2A","P2B","P3A","P3B","P4A",
				 "P4B","KST","L2A","L2B","L2C","L2D","L3");

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Pflege - Schnellübersicht</TITLE>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: none; }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<script language="javascript">
<!-- 
  var urlholder;

  function getinfo(patientID){
	urlholder="pflege-station.php?route=validroute&patient=" + patientID + "&user=<? print $aufnahme_user.'"' ?>;
	patientwin=window.open(urlholder,patientID,"width=600,height=400,menubar=no,resizable=yes,scrollbars=yes");
	}
-->
</script>
</HEAD>

<BODY BACKGROUND="leinwand.gif" onLoad="if (window.focus) window.focus()">



<table width=100% border=1 cellpadding="5">
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>Dientshabende Ärzte - <? print $datum; ?></STRONG></FONT>
</td>
</tr>
<tr>
<td >
 
<?

print '<table  cellpadding="2" cellspacing=0 border="0" >';

print '<tr bgcolor="aqua" align=center><td><font face="verdana,arial" size="2" ><b>Zimmer &nbsp;&nbsp;</b></td>';
print '<td><font face="verdana,arial" size="2" ><b>&nbsp; Bett &nbsp;</b></td>';
print '<td ><font face="verdana,arial" size="2" ><b>&nbsp; Arzt/Ärztin &nbsp;</b></td>';
print '<td><font face="verdana,arial" size="2" > <b>&nbsp; Funknummer &nbsp;</b></td>';
print '<td><font face="verdana,arial" size="2" > <b>&nbsp; Telefonnummer &nbsp;</b></td>';
print '<td><font face="verdana,arial" size="2" > <b>&nbsp; Kasse &nbsp;</b></td>';
print '</tr>';

$bettperroom=2;
$randombett=0;
$randommaxroom=0;
$freibett=0;
$toggler=0;

srand(time());

$randommaxroom=rand(30,40);


for ($i=0;$i<sizeof($stationen);$i++)
	{

	if ($toggler==0) 
		{ print '<tr bgcolor="#ffffcc">'; $toggler=1;} 
		else { print '<tr bgcolor="silver">'; $toggler=0;}
	
	print '<td align=center><font face="verdana,arial" size="1" >'.$stationen[$i].'</td><td align=center><font face="verdana,arial" size="1" ><img src="../img/mans-gr.gif">&nbsp;</td>';
	print '<td><font face="verdana,arial" size="2" ><a href="#" onClick=getinfo()>Dr. Keilbach, Michael</a>';
	
	print '</td><td align=center><font face="verdana,arial" size="1" >2109</td>';
	print '</td><td align=center><font face="verdana,arial" size="1" >2639</td>';
	print '</td><td align=center> <a href="#" onClick=getinfo()><img src="../img/man-whi.gif" alt="Gehe zu Station '.$stationen[$i].'" border="0"></a> &nbsp; <img src="../img/email.gif" alt="Email an die Station '.$stationen[$i].'"></td></tr>';
	print "\n";


	}

print '</table>';


?>


<p>


<FORM action="startframe.php">
<INPUT type="submit"  value="Schliessen" ></font></FORM>




</FONT>
<p>
</td>
</tr>
</table>        
<p>



<FONT    SIZE=1  FACE="Arial">
Copyright &copy; 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts used here for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>

</BODY>
</HTML>