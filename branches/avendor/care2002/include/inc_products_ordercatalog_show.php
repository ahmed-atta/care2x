<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_products_ordercatalog_show.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

$tog=1;
print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$LDCatalog.':</font>
		<table border=0 cellspacing=1 cellpadding=0>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDMCindex);$i++)
	print '
		<td>&nbsp;<font face=Verdana,Arial size=2 color="#000080">'.$LDMCindex[$i].'&nbsp;</td>';
	print '<td></td></tr>';	

while($content=mysql_fetch_array($ergebnis))
{
	if($tog)
	{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
	print'
				<td>&nbsp;<a href="#" onClick="popinfo(\''.$content[bestellnum].'\')" ><img src="../img/info3.gif" align="absmiddle" width=16 height=16 border=0 alt="'.$LDOpenInfo.$content[artikelname].'"></a>&nbsp;</td>
				<td><font face=Verdana,Arial size=2>&nbsp;'.$content[artikelname].'&nbsp;</td>
				<td><font face=Verdana,Arial size=2>&nbsp;&nbsp;'.$content[proorder].'&nbsp;</td>
				<td><font face=Verdana,Arial size=2>&nbsp;'.$content[bestellnum].'&nbsp;</td>
				<td>&nbsp;<a href="'.$thisfile.'?sid='.$sid.'&lang='.$lang.'&mode=delete&keyword='.$content[bestellnum].'&cat='.$cat.'" ><img src="../img/delete2.gif" width=16 height=16 border=0 alt="'.$LDRemoveArticle.'"></a>&nbsp;</td>
				</tr>
				  <tr>
    			<td colspan=5 bgcolor="#0000ff"><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  				</tr>';
}
print '
		</table>
		</font>';
?>
