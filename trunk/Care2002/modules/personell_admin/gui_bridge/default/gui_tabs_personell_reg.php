<?php
# Creates the tabs for the personnel administration module 
if(!isset($notabs)||!$notabs){
?>
<!-- Tabs  -->
<tr  bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<td colspan=3><?php if($target=="personell_reg") $img='employment_blue.gif'; //echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ $img='employment_gray.gif'; }
							echo '<a href="personell_register.php'.URL_APPEND.'&target=personell_reg"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDEnterNewEmployment.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
							if($target=="personell_search") $img='src_emp_blu.gif'; //echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{$img='src_emp_gray.gif'; }
							echo '<a href="personell_search.php'.URL_APPEND.'&target=personell_search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDFindPersonell.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
							if($target=="personell_listall") $img='lista-blu.gif'; //echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{$img='lista-gray.gif'; }
							echo '<a href="personell_listall.php'.URL_APPEND.'&target=personell_listall"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDFindPersonell.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
							echo '<img src="'.$root_path.'gui/img/common/default/pixel.gif" width=20>';
							if($target=="person_reg")  $img='register_blue.gif'; //echo '<img '.createLDImgSrc($root_path,'admit-blue.gif','0').' alt="'.$LDAdmit.'">';
								else{ $img='register_gray.gif';}
							echo'<a href="person_register.php'.URL_APPEND.'&target=person_reg"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDRegNewPerson.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
							?></td>
</tr>
<?php
}
?>
<!--  Horizontal blue line below the tabs -->
<tr>
<td colspan=3  bgcolor=#00009c><img src="p.gif" border=0 width=1 height=5><?php
if(!empty($subtitle)) echo '<font color="#fefefe" SIZE=3  FACE="verdana,Arial"><b>:: '.$subtitle.'</b>';
if(isset($current_employ)&&$current_employ) echo '<font size=2 FACE="verdana,Arial" color="white"> <img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> <b>'.$LDPersonIsEmployed.'</b></font>';
?></td>
</tr>

