<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_products_ordercatalog_show.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if($rows){
	# Load the common icon images 
	$img_info=createComIcon($root_path,'info3.gif','0');
	$img_delete=createComIcon($root_path,'delete2.gif','0');

	$tog=1;
	print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$LDCatalog.':</font>
		<table border=0 cellspacing=1 cellpadding=0>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDMCindex);$i++)
	print '
		<td>&nbsp;<font face=Verdana,Arial size=2 color="#000080">'.$LDMCindex[$i].'&nbsp;</td>';
	print '<td></td></tr>';	

	while($content=$ergebnis->FetchRow())
	{
		if($tog){
			print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
		print'
				<td>&nbsp;<a href="javascript:popinfo(\''.$content['bestellnum'].'\')" ><img '.$img_info.' alt="'.$LDOpenInfo.$content['artikelname'].'"></a>&nbsp;</td>
				<td><font face=Verdana,Arial size=2>&nbsp;'.$content['artikelname'].'&nbsp;</td>
				<td><font face=Verdana,Arial size=2>&nbsp;&nbsp;'.$content['proorder'].'&nbsp;</td>
				<td><font face=Verdana,Arial size=2>&nbsp;'.$content['bestellnum'].'&nbsp;</td>
				<td>&nbsp;<a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&mode=delete&keyword='.$content['item_no'].'&cat='.$cat.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a>&nbsp;</td>
				</tr>
				  <tr>
    			<td colspan=5 bgcolor="#0000ff"><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  				</tr>';
	}
	print '
		</table>
		</font>';
}
?>
