<?php

$tog=1;
print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$actual_ordercat.':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor=#ffffee><td></td>';
	for ($i=0;$i<sizeof($catindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 color="#000080">'.$catindex[$i].'</td>';
	print '<td></td></tr>';	

while($content=mysql_fetch_array($ergebnis))
{
	if($tog)
	{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
	print'
				<td><a href="#" onClick="popinfo(\''.$content[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$complete_info.$content[artikelname].'"></a></td>
				<td><font face=Verdana,Arial size=2>'.$content[artikelname].'</td>
				<td><font face=Verdana,Arial size=2>&nbsp;&nbsp;'.$content[proorder].'</td>
				<td><font face=Verdana,Arial size=2>'.$content[bestellnum].'</td>
				<td><a href="'.$thisfile.'?sid='.$ck_sid.'&mode=delete&keyword='.$content[bestellnum].'" ><img src="../img/delete2.gif" width=16 height=16 border=0 alt="'.$remove_art.'"></a></td>
				</tr>';
}
print '
		</table>
		</font>';
?>
