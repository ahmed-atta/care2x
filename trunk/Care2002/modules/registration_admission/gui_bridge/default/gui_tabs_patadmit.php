<!-- Creates the tabs for the patient registration module  -->
<?php
if(!isset($notabs)||!$notabs){
?>
<!-- Tabs  -->
<tr  bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<td colspan=3><?php if($target=="entry")  $img='admit-blue.gif'; //echo '<img '.createLDImgSrc($root_path,'admit-blue.gif','0').' alt="'.$LDAdmit.'">';
								else{ $img='admit-gray.gif';}
							echo'<a href="aufnahme_start.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
							if($target=="search") $img='such-b.gif'; //echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ $img='such-gray.gif'; }
							echo '<a href="aufnahme_daten_such.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
							if($target=="archiv") $img='arch-blu.gif'; //echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{$img='arch-gray.gif'; }
							echo '<a href="aufnahme_list.php'.URL_APPEND.'&target=archiv"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDArchive.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
						?><img src="<?php echo $cfg['top_bgcolor']; ?>gui/img/common/default/pixel.gif" height=1 width=25><?php 
						echo '<a href="patient_register.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,'register_gray.gif','0').' alt="'.$LDAdmit.'"></a>'; ?></td>
</tr>
<?php
}
?>
<!--  Horizontal blue line below the tabs -->
<tr>
<td colspan=3  bgcolor=#00009c><img src="p.gif" border=0 width=1 height=5><?php
if(!empty($subtitle)) echo '<font color="#fefefe" SIZE=3  FACE="verdana,Arial"><b>:: '.$subtitle.'</b>';
?></td>
</tr>

