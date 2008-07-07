<?php /* Smarty version 2.6.0, created on 2008-05-27 15:34:25
         compiled from ambulatory/outpatients_list.tpl */ ?>

<table cellspacing="0" width="100%">
<tbody>
	<tr>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDTime']; ?>
</td>
		<td class="adm_item">&nbsp;</td>
		<td class="adm_item">&nbsp;</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDFamilyName']; ?>
, <?php echo $this->_tpl_vars['LDName']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDBirthDate']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDPatNr']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDAdmissionDate']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDInsuranceType']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDOptions']; ?>
</td>
	</tr>

	<?php echo $this->_tpl_vars['sOccListRows']; ?>


 </tbody>
</table>