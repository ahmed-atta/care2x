<?php
$tog=1;
print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$actual_ordercat.':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($bcatindex);$i++)
	print '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$bcatindex[$i].'</td>';
	print '<td></td><td></td></tr>';	

$i=1;

// $content come from pharma-ordercatalog-getactual.php
while($content=mysql_fetch_array($ergebnis))
{
	if($tog)
	{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
	print'
    			<td><a href="#" onClick="add2basket(\''.$content[bestellnum].'\',\''.$i.'\')"><img src="../img/L-arrowGrnLrg.gif" border=0 width=16 height=16 alt="Sofort in den Bestellkorb stellen"></a></td>
  				 <td><input type="checkbox" name="order'.$i.'" value="1">
				 		<input type="hidden" name="order_k'.$i.'" value="'.$content[bestellnum].'"></td>		
				<td><font face=Verdana,Arial size=1>'.$content[artikelname].'</td>
				 <td><input type="text" name="order_v'.$i.'" size=3 maxlength=3></td>
				<td ><font face=Verdana,Arial size=1><nobr>&nbsp;X '.$content[proorder].'</nobr></td>
				<td><font face=Verdana,Arial size=1>'.$content[bestellnum].'</td>
				<td><a href="#" onClick="popinfo(\''.$content[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$complete_info.$content[artikelname].'"></a></td>
				<td><a href="'.$thisfile.'?sid='.$ck_sid.'&order_id='.$order_id.'&mode=delete&keyword='.$content[bestellnum].'" ><img src="../img/delete2.gif" width=16 height=16 border=0 alt="'.$remove_art.'"></a></td>
				</tr>';
	$i++;
}
	print '
			</table>';
?>
