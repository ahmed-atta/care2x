<?php

$tog=1;
print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$LDCatalog.':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDMCindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 color="#000080">'.$LDMCindex[$i].'</td>';
	print '<td></td></tr>';	

while($content=mysql_fetch_array($ergebnis))
{
	if($tog)
	{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
	print'
				<td><a href="#" onClick="popinfo(\''.$content[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$LDOpenInfo.$content[artikelname].'"></a></td>
				<td><font face=Verdana,Arial size=2>'.$content[artikelname].'</td>
				<td><font face=Verdana,Arial size=2>&nbsp;&nbsp;'.$content[proorder].'</td>
				<td><font face=Verdana,Arial size=2>'.$content[bestellnum].'</td>
				<td><a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&mode=delete&keyword='.$content[bestellnum].'&cat='.$cat.'" ><img src="../img/delete2.gif" width=16 height=16 border=0 alt="'.$LDRemoveArticle.'"></a></td>
				</tr>
				  <tr>
    			<td colspan=5 bgcolor="#0000ff"></td>
  				</tr>';
}
print '
		</table>
		</font>';
?>
