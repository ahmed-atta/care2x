<!-- Creates the tabs for the patient registration module  -->
<?php
if(!isset($notabs)||!$notabs){
?>
<!-- Tabs  -->
<tr  bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<td colspan=3>
<?php 
	if($target=="search") $img='such-b.gif'; //echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
		else{ $img='such-gray.gif'; }
	echo '<a href="upload_person_search.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
?>
</td>
</tr>
<?php
}
?>
<!--  Horizontal blue line below the tabs -->
<tr>
<td colspan=3  bgcolor=#00009c><img src="p.gif" border=0 width=1 height=5></td>
</tr>

