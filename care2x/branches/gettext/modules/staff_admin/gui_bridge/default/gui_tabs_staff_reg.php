<?php
# Creates the tabs for the staff administration module 
if(!isset($notabs)||!$notabs){

	if($target=='person_reg') $tab_bot_line='reg_div';
		else $tab_bot_line='adm_div';
?>
<!-- Tabs  -->
<tr>
<td colspan=3><?php if($target=="staff_reg") $img='add_employee_blue.gif'; //echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ $img='add_employee_gray.gif'; }
							echo '<a href="staff_register.php'.URL_APPEND.'&target=staff_reg"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDEnterNewEmployment.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';
							if($target=="staff_search") $img='src_emp_blu.gif'; //echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{$img='src_emp_gray.gif'; }
							echo '<a href="staff_search.php'.URL_APPEND.'&target=staff_search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDFindstaff.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';
							if($target=="staff_listall") $img='lista-blu.gif'; //echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{$img='lista-gray.gif'; }
							echo '<a href="staff_listall.php'.URL_APPEND.'&target=staff_listall"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDFindstaff.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';
							echo '<img src="'.$root_path.'gui/img/common/default/pixel.gif" width=20>';
							if($target=="person_reg")  $img='register_green.gif'; //echo '<img '.createLDImgSrc($root_path,'admit-blue.gif','0').' alt="'.$LDAdmit.'">';
								else{ $img='register_gray.gif';}
							echo'<a href="person_register.php'.URL_APPEND.'&target=person_reg"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDRegNewPerson.'"'; if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';
							?></td>
</tr> 
<?php
}
?>
<!--  Horizontal  line below the tabs -->
<tr>
<td colspan=3  class="<?php echo $tab_bot_line; ?>"><img src="p.gif" border=0 width=1 height=5><?php
if(!empty($subtitle)) echo '<font color="#fefefe" SIZE=3><b>:: '.$subtitle.'</b>';
if(isset($current_employ)&&$current_employ) echo '<font color="white"> <img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> <b>'.$LDPersonIsEmployed.'</b></font>';
?></td>
</tr>

