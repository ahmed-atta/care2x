<!-- Creates the tabs for the patient registration module  -->
<?php
if(!isset($notabs)||!$notabs){
?>
<!-- Tabs  -->
<tr  bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<td colspan=3><?php if($target=="entry") $img='register_green.gif'; //echo '<img '.createLDImgSrc($root_path,'register_green.gif','0').' alt="'.$LDAdmit.'">';
								else{ $img='register_gray.gif';}
							echo'<a href="patient_register.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
							if($target=="search") $img='search_green.gif'; //echo '<img '.createLDImgSrc($root_path,'search_green.gif','0').' alt="'.$LDSearch.'">';
								else{ $img='such-gray.gif';}
							echo '<a href="patient_register_search.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
							if($target=="archiv") $img='archive_green.gif'; //echo '<img '.createLDImgSrc($root_path,'archive_green.gif','0').'  alt="'.$LDArchive.'">';
								else{$img='arch-gray.gif'; }
							echo '<a href="patient_register_archive.php'.URL_APPEND.'&target=archiv"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDArchive.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';

						?><img src="<?php echo $cfg['top_bgcolor']; ?>gui/img/common/default/pixel.gif" height=1 width=25><?php
echo'<a href="aufnahme_start.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,'admit-gray.gif','0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
?></td>
</tr>
<?php
}
?>
<!--  Horizontal green line below the tabs -->
<tr>
<td colspan=3  bgcolor="<?php if($tab_bot_line) echo $tab_bot_line; else echo '#333399'; ?>"><img src="p.gif" border=0 width=1 height=5><?php
if(!empty($subtitle)) echo '<font color="#000099" SIZE=3  FACE="verdana,Arial"><b>:: '.$subtitle.'</b></font>';
if(isset($current_encounter)&&$current_encounter) echo '<font size=2 FACE="verdana,Arial"> <img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> '.$LDPersonIsAdmitted.'</font>';
?></td>
</tr>

