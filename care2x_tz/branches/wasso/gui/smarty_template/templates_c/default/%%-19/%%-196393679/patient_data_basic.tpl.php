<?php /* Smarty version 2.6.0, created on 2009-09-25 12:38:08
         compiled from laboratory/patient_data_basic.tpl */ ?>

<table>
<tbody>
	<tr>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDCaseNr']; ?>
:</td>
		<td class="adm_input"><?php echo $this->_tpl_vars['encounter_nr']; ?>
</td>
	</tr>
	<tr>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDLastName']; ?>
, <?php echo $this->_tpl_vars['LDName']; ?>
, <?php echo $this->_tpl_vars['LDBday']; ?>
:</td>
		<td class="adm_input"><b><?php echo $this->_tpl_vars['sLastName']; ?>
, <?php echo $this->_tpl_vars['sName']; ?>
 <?php echo $this->_tpl_vars['sBday']; ?>
</b></td>
	</tr>
</tbody>
</table>