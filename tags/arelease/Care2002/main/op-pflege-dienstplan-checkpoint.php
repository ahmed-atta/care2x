<?
if($dept!="") header("location: op-pflege-dienstplan.php?&dept=".$dept."&pmonth=".$pmonth."&pyear=".$pyear."&user=".$username."&route=validroute"); 
if($option=="") $option=0;	
if(($abt=="")&&($option!=1)) $abt=1;
	
$thisfile="op-pflege-dienstplan-checkpoint.php";
$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;

setcookie(ck_plan,"");

$optiondes=array(	"Mitarbeiterdaten eintragen",
					"Neue Abteilung erstellen",
					"Kalender"
				);
$optiontag=array(	"newinfo.php",
					"newdept.php",
					"calendar.php"
				);

$filename="/Intranet/php-scripts/maryho/dienst/abt_list.pid";

$bufferarr=array();

if (file_exists($filename))
	{
	$abtname=get_meta_tags($filename);
	for ($n=0;$n<$abtname['size'];$n++)
		{
			$bufferarr=each($abtname);
			$bufferarr=explode("\t",$bufferarr[0]);
			$bufferarr=explode(" ",$bufferarr[0]);
			$bufferarr=explode(",",$bufferarr[0]);
			$abtarr[$n]=trim($bufferarr[0]);
		}	
	}
	else $abtarr[0]="?";

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>OP Pflege Dienstplan</TITLE>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<script language="javascript">


var urlholder;

  function gotostat(station){
	winw=(screen.width / 2) - 400;
	winh=(screen.height / 2) - 300;
	winspecs="width=800,height=600,screenX=" + winh + ", screenY=" + winw + ",menubar=no,resizable=yes,scrollbars=yes";
	urlholder="pflege-station.php?route=validroute&station=" + station + "&user=<? print $aufnahme_user.'"' ?>;
	stationwin=window.open(urlholder,station,winspecs);
	}



</script>


</HEAD>

<BODY  alink=navy vlink=navy topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver>


<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="navy" height="10" ><FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp; &nbsp;OP Pflege Dienstplan</STRONG></FONT></td>
<td bgcolor="navy" height="10" align=right><a href="#" onClick=window.history.back()><img src="../img/zuruck.gif" border=0></a><a href="#"><img src="../img/hilfe.gif" border=0></a><a href="startframe.php"><img src="../img/fenszu.gif" border=0></a></td></tr>
<tr valign=top >
<td bgcolor=#cde1ec colspan=2 ><p><br>
<ul><img src="../img/nurse.jpg" align="right">
<FONT    SIZE=-1  FACE="Arial" color=navy>
<img src="../img/varrow.gif" width="20" height="15">
<?
if ($abt==1)
{
print '<font color="red" size="4"><b>Abteilungen</b></a></font><br>';
print '<ul><table border=0 cellspacing=0>';
$toggle=0;
for ($i=0;$i<sizeof($abtarr);$i++)
	{
		if ($toggle<1) {$bcolor="#ffffcc";$toggle=1;} else {$bcolor="#cccccc"; $toggle=0;}
		print '<tr valign=top>
				<td bgcolor='.$bcolor.'><FONT    SIZE=2  FACE="Arial">&nbsp;&nbsp;&nbsp;';
		print '<a href="op-pflege-dienstplan.php?dept='.$abtarr[$i].'" >'.$abtname[$abtarr[$i]].'</a> &nbsp;';
		print "<br>\n</td>";
		print '<td bgcolor='.$bcolor.'><FONT    SIZE=2  FACE="Arial">';
		print '<a href="op-pflege-dienstplan.php?dept='.$abtarr[$i].'" ><img src="../img/eye_s.gif" border="0" alt="Aktueller Dienstplan"></a> &nbsp;';
		print "<br>\n</td>";
		print '<td bgcolor='.$bcolor.'><FONT    SIZE=2  FACE="Arial">';
		print '<a href="op-pflege-dienstplan-planen.php?dept='.$abtarr[$i].'" ><img src="../img/update4.gif" border="0" alt="Einen neuen Diensplan erstellen"></a> &nbsp;';
		print "<br>\n</td></tr>";
	}
print '</table></ul>';
}
else print'<a href="'.$thisfile.'?abt=1"><b>Abteilungen</b></a><br>'
?>




<p>
<img src="../img/varrow.gif" width="20" height="15">
<?
if ($option==1)
{
print '<font color="red" size="4"><b>Optionen</b></a></font><br>';

print '<ul><table border=0 cellspacing=0>';
$toggle=0;
for ($i=0;$i<sizeof($optiondes);$i++)
	{
		if ($toggle<1) {$bcolor="#ffffcc";$toggle=1;} else {$bcolor="#cccccc"; $toggle=0;}
		print '<tr valign=top>
				<td bgcolor='.$bcolor.'><FONT    SIZE=2  FACE="Arial">&nbsp;&nbsp;&nbsp;';
		if($optiontag[$i]=="calendar.php") print '<a href="'.$optiontag[$i].'?sid='.$ck_sid.'" >'.$optiondes[$i].'</a> &nbsp;';
		else print '<a href="op-pflege-'.$optiontag[$i].'" >'.$optiondes[$i].'</a> &nbsp;';
		print "<br>\n</td>";
		print '<td bgcolor='.$bcolor.'><FONT    SIZE=2  FACE="Arial">';
		print '<a href="op-pflege-'.$optiontag[$i].'" ><img src="../img/thumbs_up.gif" border="0" alt="Aktueller Dienstplan"></a> &nbsp;';
		print "<br>\n</td></tr>";
	}
print '</table></ul><p>';
}
else print'<a href="'.$thisfile.'?option=1"><b>Optionen</b></a><br>';
?>

<img src="../img/varrow.gif" width="20" height="15"> <a href="#">Nachrichten</a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="#">Rundbrief</a><br>
<p>
<FORM action="op-doku.php" >
<INPUT type="submit"  value="Schliessen"></font></FORM>
<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top >
<td bgcolor="silver" colspan=2> 
<FONT    SIZE=1  FACE="Arial">
Copyright © 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts used here for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
