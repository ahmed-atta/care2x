<form method="post" name="report">
 <table border=0 cellpadding=2 width=100%>
<!--    <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">Delivery <?php echo $LDDate; ?></td>
     <td><input type="text" name="delivery_date" value="<?php if($birth['delivery_date']) echo formatDate2Local($birth['delivery_date'],$date_format); ?>" size=10 maxlength=10 onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
 		<a href="javascript:show_calendar('report.delivery_date','<?php echo $date_format ?>')">
 		<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 		<font size=1>[ <?php   $dfbuffer="LD_".strtr($date_format,".-/","phs");	echo $$dfbuffer; ?> ] </font>
	 </td>
   </tr>
 -->   
 	<tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['parent_encounter_nr']; ?></td>
     <td><input type="text" name="parent_encounter_nr" size=10 maxlength=11 value="<?php if($birth['parent_encounter_nr']) echo $birth['parent_encounter_nr']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['delivery_nr']; ?></td>
     <td><input type="text" name="delivery_nr" size=10 maxlength=2 value="<?php if($birth['delivery_nr']) echo $birth['delivery_nr']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['delivery_place'] ?></td>
     <td><input type="text" name="delivery_place" size=50 maxlength=60 value="<?php echo $birth['delivery_place']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['delivery_mode']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 
	$dm=&$obj->DeliveryModes();
	if($obj->LastRecordCount()){
		while($dmod=$dm->FetchRow()){
			echo '<input type="radio" name="delivery_mode" value="'.$dmod['nr'].'" ';
			if($birth['delivery_mode']==$dmod['nr']) echo 'checked' ;
			echo '>';
			if(isset($$dmod['LD_var'])&&$$dmod['LD_var']) echo $$dmod['LD_var'];
				else echo $dmod['name'];
		}
	}
	?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['c_s_reason']; ?></td>
     <td><textarea name="c_s_reason" cols=40 rows=3 wrap="physical"><?php echo $birth['c_s_reason']; ?></textarea>
         </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['born_before_arrival']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 	<input type="radio" name="born_before_arrival" value="1" <?php if($birth['born_before_arrival']) echo 'checked' ?>><?php echo  $LDYes ?>
  	<input type="radio" name="born_before_arrival" value="0" <?php if(!$birth['born_before_arrival']) echo 'checked' ?>><?php echo  $LDNo ?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['face_presentation']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 # set default to "yes" = 1
	 if(!isset($birth['face_presentation'])) $birth['face_presentation']=1;
	 ?>
	 	<input type="radio" name="face_presentation" value="1" <?php if($birth['face_presentation']) echo 'checked' ?>><?php echo  $LDYes ?>
  	<input type="radio" name="face_presentation" value="0" <?php if(!$birth['face_presentation']) echo 'checked' ?>><?php echo  $LDNo ?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['posterio_occipital_position']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 	<input type="radio" name="posterio_occipital_position" value="1" <?php if($birth['posterio_occipital_position']) echo 'checked' ?>><?php echo  $LDYes ?>
  	<input type="radio" name="posterio_occipital_position" value="0"  <?php if(!$birth['posterio_occipital_position']) echo 'checked' ?>><?php echo  $LDNo ?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['delivery_rank']; ?></td>
     <td><input type="text" name="delivery_rank" size=10 maxlength=2 value="<?php echo $birth['delivery_rank']; ?>"></td>
   </tr>
      <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['apgar_1_min']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 if(!isset($birth['apgar_1_min'])) $birth['apgar_1_min']=-1;
	 ?>
	 	<input type="radio" name="apgar_1_min" value="0" <?php if($birth['apgar_1_min']==0) echo 'checked' ?>>0
	 	<input type="radio" name="apgar_1_min" value="1" <?php if($birth['apgar_1_min']==1) echo 'checked' ?>>1
  	<input type="radio" name="apgar_1_min" value="2" <?php if($birth['apgar_1_min']==2) echo 'checked' ?>>2
  	<input type="radio" name="apgar_1_min" value="3" <?php if($birth['apgar_1_min']==3) echo 'checked' ?>>3
  	<input type="radio" name="apgar_1_min" value="4" <?php if($birth['apgar_1_min']==4) echo 'checked' ?>>4
  	<input type="radio" name="apgar_1_min" value="5" <?php if($birth['apgar_1_min']==5) echo 'checked' ?>>5
	 	<input type="radio" name="apgar_1_min" value="6" <?php if($birth['apgar_1_min']==6) echo 'checked' ?>>6
	 	<input type="radio" name="apgar_1_min" value="7" <?php if($birth['apgar_1_min']==7) echo 'checked' ?>>7
  	<input type="radio" name="apgar_1_min" value="8" <?php if($birth['apgar_1_min']==8) echo 'checked' ?>>8
  	<input type="radio" name="apgar_1_min" value="9" <?php if($birth['apgar_1_min']==9) echo 'checked' ?>>9
  	<input type="radio" name="apgar_1_min" value="10" <?php if($birth['apgar_1_min']==10) echo 'checked' ?>>10
	 </td>
   </tr>
      <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['apgar_5_min']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 if(!isset($birth['apgar_5_min'])) $birth['apgar_5_min']=-1;
	 ?>
	 	<input type="radio" name="apgar_5_min" value="0" <?php if($birth['apgar_5_min']==0) echo 'checked' ?>>0
	 	<input type="radio" name="apgar_5_min" value="1" <?php if($birth['apgar_5_min']==1) echo 'checked' ?>>1
  	<input type="radio" name="apgar_5_min" value="2" <?php if($birth['apgar_5_min']==2) echo 'checked' ?>>2
  	<input type="radio" name="apgar_5_min" value="3" <?php if($birth['apgar_5_min']==3) echo 'checked' ?>>3
  	<input type="radio" name="apgar_5_min" value="4" <?php if($birth['apgar_5_min']==4) echo 'checked' ?>>4
  	<input type="radio" name="apgar_5_min" value="5" <?php if($birth['apgar_5_min']==5) echo 'checked' ?>>5
	 	<input type="radio" name="apgar_5_min" value="6" <?php if($birth['apgar_5_min']==6) echo 'checked' ?>>6
	 	<input type="radio" name="apgar_5_min" value="7" <?php if($birth['apgar_5_min']==7) echo 'checked' ?>>7
  	<input type="radio" name="apgar_5_min" value="8" <?php if($birth['apgar_5_min']==8) echo 'checked' ?>>8
  	<input type="radio" name="apgar_5_min" value="9" <?php if($birth['apgar_5_min']==9) echo 'checked' ?>>9
  	<input type="radio" name="apgar_5_min" value="10" <?php if($birth['apgar_5_min']==10) echo 'checked' ?>>10
	 </td>
   </tr>
      <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['apgar_10_min']; ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 if(!isset($birth['apgar_10_min'])) $birth['apgar_10_min']=-1;
	 ?>
	 	<input type="radio" name="apgar_10_min" value="0" <?php if($birth['apgar_10_min']==0) echo 'checked' ?>>0
	 	<input type="radio" name="apgar_0_min" value="1" <?php if($birth['apgar_10_min']==1) echo 'checked' ?>>1
  	<input type="radio" name="apgar_10_min" value="2" <?php if($birth['apgar_10_min']==2) echo 'checked' ?>>2
  	<input type="radio" name="apgar_10_min" value="3" <?php if($birth['apgar_10_min']==3) echo 'checked' ?>>3
  	<input type="radio" name="apgar_10_min" value="4" <?php if($birth['apgar_10_min']==4) echo 'checked' ?>>4
  	<input type="radio" name="apgar_10_min" value="5" <?php if($birth['apgar_10_min']==5) echo 'checked' ?>>5
	 	<input type="radio" name="apgar_10_min" value="6" <?php if($birth['apgar_10_min']==6) echo 'checked' ?>>6
	 	<input type="radio" name="apgar_10_min" value="7" <?php if($birth['apgar_10_min']==7) echo 'checked' ?>>7
  	<input type="radio" name="apgar_10_min" value="8" <?php if($birth['apgar_10_min']==8) echo 'checked' ?>>8
  	<input type="radio" name="apgar_10_min" value="9" <?php if($birth['apgar_10_min']==9) echo 'checked' ?>>9
  	<input type="radio" name="apgar_10_min" value="10" <?php if($birth['apgar_10_min']==10) echo 'checked' ?>>10
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['condition']; ?></td>
     <td><input type="text" name="condition" size=50 maxlength=60 value="<?php echo $birth['condition']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['weight']; ?></td>
     <td><input type="text" name="weight" size=10 maxlength=10 value="<?php if($birth['weight']) echo $birth['weight']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['length'] ?></td>
     <td><input type="text" name="length" size=10 maxlength=10 value="<?php if($birth['length']) echo $birth['length']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['head_circumference'] ?></td>
     <td><input type="text" name="head_circumference" size=10 maxlength=10 value="<?php if($birth['head_circumference']) echo $birth['head_circumference']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['scored_gestational_age'] ?></td>
     <td><input type="text" name="scored_gestational_age" size=10 maxlength=10 value="<?php if($birth['scored_gestational_age']) echo $birth['scored_gestational_age']; ?>"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['feeding'] ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 # set default to "breast" = type #1
	 if(!isset($birth['feeding'])||!$birth['feeding']) $birth['feeding']=1;
	 
	$fd=&$obj->FeedingTypes();
	if($obj->LastRecordCount()){
		while($feed=$fd->FetchRow()){
			echo '<input type="radio" name="feeding" value="'.$feed['nr'].'" ';
			if($birth['feeding']==$feed['nr']) echo 'checked' ;
			echo '>';
			if(isset($$feed['LD_var'])&&$$feed['LD_var']) echo $$feed['LD_var'];
				else echo $feed['name'];
		}
	}
	?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['congenital_abnormality'] ?></td>
     <td><input type="text" name="congenital_abnormality" size=50 maxlength=60 value="<?php echo $birth['congenital_abnormality']; ?>"></td>
   </tr>
    <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['classification'] ?></td>
     <td><input type="text" name="classification" size=50 maxlength=60 value="<?php echo $birth['classification']; ?>"></td>
   </tr>

       <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['outcome']  ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 
	$oc=&$obj->Outcomes();
	if($obj->LastRecordCount()){
		while($otc=$oc->FetchRow()){
			echo '<input type="radio" name="outcome" value="'.$otc['nr'].'" ';
			if($birth['outcome']==$otc['nr']) echo 'checked' ;
			echo '>';
			if(isset($$otc['LD_var'])&&$$otc['LD_var']) echo $$otc['LD_var'];
				else echo $otc['name'];
		}
	}
	?>
	 </td>
   </tr>


   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['disease_category'] ?></td>
     <td><FONT SIZE=-1  FACE="Arial">
	 <?php
	 
	$dc=&$obj->DiseaseCategories();
	if($obj->LastRecordCount()){
		while($dcat=$dc->FetchRow()){
			echo '<input type="radio" name="disease_category" value="'.$dcat['nr'].'" ';
			if($birth['disease_category']==$dcat['nr']) echo 'checked' ;
			echo '>';
			if(isset($$dcat['LD_var'])&&$$dcat['LD_var']) echo $$dcat['LD_var'];
				else echo $dcat['name'];
		}
	}
	?>
	 </td>
   </tr>
 
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LD['docu_by'] ?></td>
     <td><input type="text" name="application_by" size=50 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>"></td>
   </tr>
 </table>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="encounter_nr" value="<?php echo $HTTP_SESSION_VARS['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<input type="hidden" name="allow_update" value="<?php if(isset($allow_update)) echo $allow_update; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="delivery_date" value="<?php echo $date_birth; ?>">
<input type="hidden" name="mode" value="newdata">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
