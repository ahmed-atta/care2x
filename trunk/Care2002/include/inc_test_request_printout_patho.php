<table   cellpadding="0" cellspacing=1 border="0" width=700 >
		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>">
		<td  width=40%>
		<?php
        if($edit || $read_form)
        {
		   echo '<img src="../imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&pn='.$result['patnum'].'" width=282 height=178>';
		}
        ?>
     </td> 
		<td class=fva2_ml10><div class="fva2_ml10">
		
		<table border=0  cellpadding=0 cellspacing=0 width=100%>
    <tr>
      <td rowspan=8 align="left" valign="top"><font size=4 color="#0000ff"><b><?php echo $formtitle ?></b></font><br>
	  <font size=1 color="#000099"><?php echo $LDTel ?>
	  </td>
      <td class="fvag_ml10" align="right"><?php echo $LDEntryDate ?> &nbsp;</td>
      <td>
	  <?php 
	     if($printmode)
		 {
	   ?>
	     <font face="arial" size=2 color="#000000">
	  <?php  if($stored_request['entry_date']!='0000-00-00') echo formatDate2Local($stored_request['entry_date'],$date_format); 
	                 else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	  ?>
	     </font>
	   <?php
	      }
		  else
		  {
	   ?>
	  <input type="text" name="entry_date" size=10 maxlength=10 value="<?php  if($stored_request['entry_date']) echo formatDate2Local($stored_request['entry_date'],$date_format); ?>" onBlur="IsValidDate(this,'<?php echo $date_format ?>')">
      <?php
	      }
	   ?>&nbsp;</td>
	</tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDJournalNumber ?> &nbsp;</td>
      <td>
	   <?php printLabInterns('journal_nr'); ?>&nbsp;</td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDBlockNumber ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('blocks_nr'); ?>&nbsp;</td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDDeepCuts ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('deep_cuts'); ?>&nbsp;</td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDSpecialDye ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('special_dye'); ?>&nbsp;</td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDImmuneHistoChem ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('immune_histochem'); ?>&nbsp;</td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDHormoneReceptors ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('hormone_receptors'); ?>&nbsp;</td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDSpecials ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('specials'); ?>&nbsp;</td>
    </tr>
  </table>
  		</div>
		</td></tr>


<!-- Second row  -->
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2><font color="#000099">	   
		
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
    <tr>
      <td><div class=fva0_ml10><?php 
	    if($stored_request['quick_cut']) echo '<img '.createComIcon('../','chkbox_chk.gif','0','absmiddle'); 
	      else echo '<img '.createComIcon('../','chkbox_blk.gif','0','absmiddle');  
		echo '>&nbsp;<b>'.$LDSpeedCut.'</b>'; 
		?></td>
      <td><div class=fva0_ml10><?php 
	  echo $LDRelayResult ?>&nbsp;<font face="courier" size=2 color="#000000"><?php echo $stored_request['qc_phone'] ?></font></td>
      <td rowspan=2 align="right" >
	  <?php 
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;&nbsp;<br>';
          echo "<img src='../classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
     ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td><div class=fva0_ml10> <?php
	    if($stored_request['quick_diagnosis']) echo '<img '.createComIcon('../','chkbox_chk.gif','0','absmiddle'); 
	      else echo '<img '.createComIcon('../','chkbox_blk.gif','0','absmiddle');  
		echo '>&nbsp;<b>'.$LDSpeedTest.'</b>'; 	  
	  ?> </td>
      <td><div class=fva0_ml10><?php echo $LDRelayResult ?>&nbsp;<font face="courier" size=2 color="#000000"><?php echo $stored_request['qd_phone'] ?></font></td>
    </tr>
  </table>
  </div></td>
<!-- 			<td  valign=top><div class=fva0_ml10><font color="#000099">
		 <?php echo $LDSpecialNotice ?>:<br>
		<input type="text" name="specials" size=55 maxlength=60>
		
  </div></td> -->
</tr>
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td valign="top" width=40%>
		<div class=fva2_ml10><p><br>
		<b><?php echo $LDMatType ?>:</b><br>
			<?php
	    if($stored_request['material_type']=="pe") echo '<img '.createComIcon('../','radio_chk.gif','0','absmiddle'); 
	      else echo '<img '.createComIcon('../','radio_blk.gif','0','absmiddle');  
		echo '>&nbsp;'.$LDPE.'</b>'; 	  
	?><br>
  	<?php 
	    if($stored_request['material_type']=="op_specimen") echo '<img '.createComIcon('../','radio_chk.gif','0','absmiddle'); 
	      else echo '<img '.createComIcon('../','radio_blk.gif','0','absmiddle');  
		echo '>&nbsp;'.$LDSpecimen.'</b>'; 	  
	?><br>
	<?php 
	    if($stored_request['material_type']=="shave") echo '<img '.createComIcon('../','radio_chk.gif','0','absmiddle'); 
	      else echo '<img '.createComIcon('../','radio_blk.gif','0','absmiddle');  
		echo '>&nbsp;'.$LDShave.'</b>'; 	  
	?><br>
  	 <?php
	    if($stored_request['material_type']=="cytology") echo '<img '.createComIcon('../','radio_chk.gif','0','absmiddle'); 
	      else echo '<img '.createComIcon('../','radio_blk.gif','0','absmiddle');  
		echo '>&nbsp;'.$LDCytology.'</b>'; 	  
	 ?><br>
		</td>
		<td valign="top"><br><font face="courier" size=2><?php  echo nl2br(stripslashes($stored_request['material_desc'])) ?></font>
				</td>
		</tr>	
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  colspan=2><div class="fva0_ml10">&nbsp;<br><font color="#000099">	 
		<b><?php echo $LDLocalization ?></b><p><img src="../gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">
		<font face="courier" size=2 color="#000000"><?php echo nl2br(stripslashes($stored_request['localization'])); ?></font>
  </div></td>
</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10>&nbsp;<br><font color="#000099">	 
		<b><?php echo $LDClinicalQuestions ?></b><p><img src="../gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">
		<font face="courier" size=2 color="#000000"><?php echo  nl2br(stripslashes($stored_request['clinical_note'])); ?></font>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10>&nbsp;<br><font color="#000099">	 
		<b><?php echo $LDExtraInfo ?></b><font size=1 face="arial"> <?php echo $LDExtraInfoSample ?><p><img src="../gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">
		<font face="courier" size=2 color="#000000"><?php echo  nl2br(stripslashes($stored_request['extra_note'])); ?></font>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">&nbsp;<br> 
		<b><?php echo $LDRepeatedTest ?></b><font size=1 face="arial"> <?php echo $LDRepeatedTestPls ?><p><img src="../gui/img/common/default/pixel.gif" border=0 width=20 height=30 align="left">
		<font face="courier" size=2 color="#000000"><?php echo  nl2br(stripslashes($stored_request['repeat_note'])); ?></font>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">&nbsp;<br> 
		<b><?php echo $LDForGynTests ?></b>
		&nbsp;<p>
		<table border=0 cellpadding=1 cellspacing=1 width=100%>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDLastPeriod ?></td>
      <td><font face="courier" size=2 color="#000000"><?php echo stripslashes($stored_request['gyn_last_period']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDMenopauseSince ?></td>
      <td><font face="courier" size=2 color="#000000"><?php echo stripslashes($stored_request['gyn_menopause_since']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDHormoneTherapy ?></td>
      <td><font face="courier" size=2 color="#000000"><?php echo stripslashes($stored_request['gyn_hormone_therapy']) ?></font>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDPeriodType ?></td>
      <td><font face="courier" size=2 color="#000000"><?php echo stripslashes($stored_request['gyn_period_type']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDHysterectomy ?></td>
      <td><font face="courier" size=2 color="#000000"><?php  echo stripslashes($stored_request['gyn_hysterectomy']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDIUD ?></td>
      <td><font face="courier" size=2 color="#000000"><?php echo stripslashes($stored_request['gyn_iud']) ?></font>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDGravidity ?></td>
      <td><font face="courier" size=2 color="#000000"><?php  echo stripslashes($stored_request['gyn_gravida']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDContraceptive ?></td>
      <td><font face="courier" size=2 color="#000000"><?php echo stripslashes($stored_request['gyn_contraceptive']) ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td width=40%><div class=fva2_ml10><font color="#000099">&nbsp;<br>
		 <?php echo $LDOpDate ?>:
		<font face="courier" size=2 color="#000000"><?php  echo formatDate2Local($stored_request['op_date'],$date_format); ?></font>
  </div></td>
			<td align="right"><div class=fva2_ml10><font color="#000099">&nbsp;<br>
		<?php echo $LDDoctor."/".$LDDept ?>:
		<font face="courier" size=2 color="#000000"><?php echo stripslashes($stored_request['doctor_sign']) ?></font>
		
  </div></td>
</tr>

		</table>
