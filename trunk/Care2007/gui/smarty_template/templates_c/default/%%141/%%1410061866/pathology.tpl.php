<?php /* Smarty version 2.6.0, created on 2004-07-06 23:16:13
         compiled from forms/pathology.tpl */ ?>

<table   cellpadding="0" cellspacing=1 border="0" width=700>

	<!-- Header row for patient label, dept. info and identifiers -->

	<tr  valign="top" bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
	<td>
		<?php if ($this->_tpl_vars['edit'] || $this->_tpl_vars['printmode'] || $this->_tpl_vars['read_form']): ?>
			<?php echo $this->_tpl_vars['barcode_label_single_large']; ?>

		<?php else: ?>
			<?php if ($this->_tpl_vars['show_searchmask']): ?>
				<?php echo $this->_tpl_vars['searchmask']; ?>

			<?php endif; ?>
		<?php endif; ?>
	</td>

	<td class=fva2_ml10><div class="fva2_ml10">

		<table border=0  cellpadding=0 cellspacing=0 width=100%>

			<tr>
			<td rowspan=9 align="left" valign="top"><font size=5 color="#0000ff"><b><?php echo $this->_tpl_vars['formtitle']; ?>
</b></font><br>
				<font size=1 color="#000099"><?php echo $this->_tpl_vars['LDTel']; ?>

			</td>
			<td class="fvag_ml10" align="right"></td>
			<td>
				<img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=2>
			</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right"><?php echo $this->_tpl_vars['LDEntryDate']; ?>
 &nbsp;<?php echo $this->_tpl_vars['miniCalendar']; ?>
</td>
			<td class=fva0_ml10><?php echo $this->_tpl_vars['entry_date']; ?>
</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right"><?php echo $this->_tpl_vars['LDJournalNumber']; ?>
 &nbsp;</td>
			<td>	<?php echo $this->_tpl_vars['val_journal_nr']; ?>
</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right"><?php echo $this->_tpl_vars['LDBlockNumber']; ?>
 &nbsp;</td>
			<td><?php echo $this->_tpl_vars['val_blocks_nr']; ?>
</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right"><?php echo $this->_tpl_vars['LDDeepCuts']; ?>
 &nbsp;</td>
			<td><?php echo $this->_tpl_vars['val_deep_cuts']; ?>
</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right"><?php echo $this->_tpl_vars['LDSpecialDye']; ?>
 &nbsp;</td>
			<td><?php echo $this->_tpl_vars['val_special_dye']; ?>
	</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right"><?php echo $this->_tpl_vars['LDImmuneHistoChem']; ?>
 &nbsp;</td>
			<td><?php echo $this->_tpl_vars['val_immune_histochem']; ?>
</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right"><?php echo $this->_tpl_vars['LDHormoneReceptors']; ?>
 &nbsp;</td>
			<td><?php echo $this->_tpl_vars['val_hormone_receptors']; ?>
</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right"><?php echo $this->_tpl_vars['LDSpecials']; ?>
 &nbsp;</td>
			<td><?php echo $this->_tpl_vars['val_specials']; ?>
</td>
			</tr>

		</table>

		</div>
	</td>
	</tr>

	<!-- Second row block for batch barcode, express flags, tel nrs.  -->
	
	<tr bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
	<td  valign="top" colspan=2><font color="#000099">

		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		
			<tr>
			<td><div class=fva0_ml10><?php echo $this->_tpl_vars['input_quick_cut']; ?>
 <b><?php echo $this->_tpl_vars['LDSpeedCut']; ?>
</b></td>
			<td><div class=fva0_ml10><?php echo $this->_tpl_vars['LDRelayResult']; ?>
&nbsp;
				<?php if ($this->_tpl_vars['edit']): ?> <input type="text" name="qc_phone" size=20 maxlength=25  value="<?php echo $this->_tpl_vars['input_qc_phone']; ?>
">
				<?php else: ?> <?php echo $this->_tpl_vars['val_qc_phone']; ?>

				<?php endif; ?>
			</td>
			<td rowspan=2 align="right" >
				<font size=1 color="#000099" face="verdana,arial"><?php echo $this->_tpl_vars['batch_nr']; ?>
</font>&nbsp;&nbsp;<br>
				<?php echo $this->_tpl_vars['gifBatchBarcode']; ?>
&nbsp;&nbsp;
			</td>
			</tr>
		
			<tr>
			<td><div class=fva0_ml10><?php echo $this->_tpl_vars['input_quick_diagnosis']; ?>
 <b><?php echo $this->_tpl_vars['LDSpeedTest']; ?>
</b> </td>
			<td><div class=fva0_ml10><?php echo $this->_tpl_vars['LDRelayResult']; ?>
&nbsp;
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="qd_phone" size=20 maxlength=25  value="<?php echo $this->_tpl_vars['input_qd_phone']; ?>
">
				<?php else: ?> <?php echo $this->_tpl_vars['val_qd_phone']; ?>

				<?php endif; ?>
			</td>
			</tr>
	
		</table>
	
	</td>
<!-- 
	<td  valign=top><div class=fva0_ml10><font color="#000099">
		<?php echo $this->_tpl_vars['LDSpecialNotice']; ?>
:<br>
		<input type="text" name="specials" size=55 maxlength=60>

	</div>
	</td>
-->
	</tr>

<!-- Lower block for the main request information -->

	<tr bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
	<td valign=top>
		<div class=fva2_ml10><p><br>
		<b><?php echo $this->_tpl_vars['LDMatType']; ?>
:</b><br>
		<?php echo $this->_tpl_vars['input_material_type_pe']; ?>
 <?php echo $this->_tpl_vars['LDPE']; ?>
<br>
		<?php echo $this->_tpl_vars['input_material_type_op_specimen']; ?>
 <?php echo $this->_tpl_vars['LDSpecimen']; ?>
<br>
		<?php echo $this->_tpl_vars['input_material_type_shave']; ?>
 <?php echo $this->_tpl_vars['LDShave']; ?>
<br>
		<?php echo $this->_tpl_vars['input_material_type_cytology']; ?>
 <?php echo $this->_tpl_vars['LDCytology']; ?>
<br>
	</td>
	<td><div class=fva0_ml10>
		<?php if ($this->_tpl_vars['edit']): ?>	<textarea name="material_desc" cols=46 rows=8 wrap="physical"><?php echo $this->_tpl_vars['val_material_desc']; ?>
</textarea>
		<?php else: ?> <?php echo $this->_tpl_vars['val_material_desc']; ?>

		<?php endif; ?>
	</td>
	</tr>
	
	<tr bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
	<td  valign="top" colspan=2><div class="fva0_ml10"><font color="#000099">
		<b><?php echo $this->_tpl_vars['LDLocalization']; ?>
<b><br>
		<?php if ($this->_tpl_vars['edit']): ?><textarea name="localization" cols=82 rows=2 wrap="physical"><?php echo $this->_tpl_vars['val_localization']; ?>
</textarea>
		<?php else: ?> <?php echo $this->_tpl_vars['gifVSpacer']; ?>
 <?php echo $this->_tpl_vars['val_localization']; ?>

		<?php endif; ?>
  	</div>
	</td>
	</tr>

	<tr bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
	<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">
		<b><?php echo $this->_tpl_vars['LDClinicalQuestions']; ?>
</b><br>
		<?php if ($this->_tpl_vars['edit']): ?><textarea name="clinical_note" cols=82 rows=2 wrap="physical"><?php echo $this->_tpl_vars['val_clinical_note']; ?>
</textarea>
		<?php else: ?> <?php echo $this->_tpl_vars['gifVSpacer']; ?>
 <?php echo $this->_tpl_vars['val_clinical_note']; ?>

		<?php endif; ?>
	</div>
	</td>
	</tr>

	<tr bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">
		<b><?php echo $this->_tpl_vars['LDExtraInfo']; ?>
</b><font size=1 face="arial"> <?php echo $this->_tpl_vars['LDExtraInfoSample']; ?>
<br>
		<?php if ($this->_tpl_vars['edit']): ?><textarea name="extra_note" cols=82 rows=2 wrap="physical"><?php echo $this->_tpl_vars['val_extra_note']; ?>
</textarea>
		<?php else: ?> <?php echo $this->_tpl_vars['gifVSpacer']; ?>
 <?php echo $this->_tpl_vars['val_extra_note']; ?>

		<?php endif; ?>
	</div></td>
	</tr>

	<tr bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">
		<b><?php echo $this->_tpl_vars['LDRepeatedTest']; ?>
</b><font size=1 face="arial"> <?php echo $this->_tpl_vars['LDRepeatedTestPls']; ?>
<br>
		<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="repeat_note" size=95 maxlength=100 value="<?php echo $this->_tpl_vars['val_repeat_note']; ?>
">
		<?php else: ?> <?php echo $this->_tpl_vars['gifVSpacer']; ?>
 <?php echo $this->_tpl_vars['val_clinical_note']; ?>

		<?php endif; ?>
	</div></td>
	</tr>

	<tr bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">
		<b><?php echo $this->_tpl_vars['LDForGynTests']; ?>
</b>

		<table border=0 cellpadding=1 cellspacing=1 width=100%>
			<tr>
			<td align="right"><div class=fva0_ml10><?php echo $this->_tpl_vars['LDLastPeriod']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="gyn_last_period" size=15 maxlength=25 value="<?php echo $this->_tpl_vars['val_gyn_last_period']; ?>
">
				<?php else: ?> <?php echo $this->_tpl_vars['val_gyn_last_period']; ?>

				<?php endif; ?>
			</td>
			<td align="right"><div class=fva0_ml10><?php echo $this->_tpl_vars['LDMenopauseSince']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="gyn_menopause_since" size=15 maxlength=25 value="<?php echo $this->_tpl_vars['val_gyn_menopause_since']; ?>
">
				<?php else: ?> <?php echo $this->_tpl_vars['val_gyn_menopause_since']; ?>

				<?php endif; ?>
			</td>
			<td align="right"><div class=fva0_ml10><?php echo $this->_tpl_vars['LDHormoneTherapy']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="gyn_hormone_therapy" size=15 maxlength=25 value="<?php echo $this->_tpl_vars['val_gyn_hormone_therapy']; ?>
">&nbsp;
				<?php else: ?> <?php echo $this->_tpl_vars['val_gyn_hormone_therapy']; ?>

				<?php endif; ?>
			</td>
			</tr>
		
			<tr>
			<td align="right"><div class=fva0_ml10><?php echo $this->_tpl_vars['LDPeriodType']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="gyn_period_type" size=15 maxlength=25 value="<?php echo $this->_tpl_vars['val_gyn_period_type']; ?>
">
				<?php else: ?> <?php echo $this->_tpl_vars['val_gyn_period_type']; ?>

				<?php endif; ?>
			</td>
			<td align="right"><div class=fva0_ml10><?php echo $this->_tpl_vars['LDHysterectomy']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="gyn_hysterectomy" size=15 maxlength=25 value="<?php echo $this->_tpl_vars['val_gyn_hysterectomy']; ?>
">
				<?php else: ?> <?php echo $this->_tpl_vars['val_gyn_hysterectomy']; ?>

				<?php endif; ?>
			</td>
			<td align="right"><div class=fva0_ml10><?php echo $this->_tpl_vars['LDIUD']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="gyn_iud" size=15 maxlength=25 value="<?php echo $this->_tpl_vars['val_gyn_iud']; ?>
">&nbsp;
				<?php else: ?> <?php echo $this->_tpl_vars['val_gyn_iud']; ?>

				<?php endif; ?>
			</td>
			</tr>
			<tr>
			<td align="right"><div class=fva0_ml10><?php echo $this->_tpl_vars['LDGravidity']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="gyn_gravida" size=15 maxlength=25 value="<?php echo $this->_tpl_vars['val_gyn_gravida']; ?>
">
				<?php else: ?> <?php echo $this->_tpl_vars['val_gyn_gravida']; ?>

				<?php endif; ?>
			</td>
			<td align="right"><div class=fva0_ml10><?php echo $this->_tpl_vars['LDContraceptive']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="gyn_contraceptive" size=15 maxlength=25 value="<?php echo $this->_tpl_vars['val_gyn_contraceptive']; ?>
">
				<?php else: ?> <?php echo $this->_tpl_vars['val_gyn_contraceptive']; ?>

				<?php endif; ?>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
		</table>

	</div>
	</td>
	</tr>

	<tr bgcolor="<?php echo $this->_tpl_vars['bgc1']; ?>
">
	<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $this->_tpl_vars['LDOpDate']; ?>
:<br>
		<?php echo $this->_tpl_vars['inputOpDate']; ?>
 <?php echo $this->_tpl_vars['gifOpCalendar']; ?>

	</div>
	</td>
	<td align="right"><div class=fva2_ml10><font color="#000099">
		<?php echo $this->_tpl_vars['LDDoctor']; ?>
/<?php echo $this->_tpl_vars['LDDept']; ?>
:
		<?php if ($this->_tpl_vars['edit']): ?><input type="text" name="doctor_sign" size=40 maxlength=60 value="<?php echo $this->_tpl_vars['val_doctor_sign']; ?>
">
		<?php else: ?> <?php echo $this->_tpl_vars['val_doctor_sign']; ?>

		<?php endif; ?>
	</div>
	</td>
	</tr>
</table>