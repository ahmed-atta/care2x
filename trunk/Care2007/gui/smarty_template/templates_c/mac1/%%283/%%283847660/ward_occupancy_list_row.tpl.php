<?php /* Smarty version 2.6.0, created on 2004-07-03 16:06:22
         compiled from nursing/ward_occupancy_list_row.tpl */ ?>

 <?php if ($this->_tpl_vars['bToggleRowClass']): ?>
	<tr class="wardlistrow1">
 <?php else: ?>
	<tr class="wardlistrow2">
 <?php endif; ?>
		<td><?php echo $this->_tpl_vars['sMiniColorBars']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sRoom']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sBed']; ?>
 <?php echo $this->_tpl_vars['sBedIcon']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sTitle']; ?>
 <?php echo $this->_tpl_vars['sFamilyName'];  echo $this->_tpl_vars['cComma']; ?>
 <?php echo $this->_tpl_vars['sName']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sBirthDate']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sPatNr']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sInsuranceType']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sAdmitDataIcon']; ?>
 <?php echo $this->_tpl_vars['sChartFolderIcon']; ?>
 <?php echo $this->_tpl_vars['sNotesIcon']; ?>
 <?php echo $this->_tpl_vars['sTransferIcon']; ?>
 <?php echo $this->_tpl_vars['sDischargeIcon']; ?>
</td>
		</tr>
		<tr>
		<td colspan="8" class="thinrow_vspacer"><?php echo $this->_tpl_vars['sOnePixel']; ?>
</td>
	</tr>