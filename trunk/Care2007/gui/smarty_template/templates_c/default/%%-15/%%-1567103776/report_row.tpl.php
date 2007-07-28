<?php /* Smarty version 2.6.0, created on 2004-07-09 15:17:43
         compiled from registration_admission/report_row.tpl */ ?>
	<tr <?php echo $this->_tpl_vars['sRowClass']; ?>
>
		<td><?php echo $this->_tpl_vars['sDate']; ?>
</td>
		<td><?php echo $this->_tpl_vars['sPreview']; ?>
</td>
		<td align=center><?php echo $this->_tpl_vars['sDetails']; ?>
 <?php echo $this->_tpl_vars['sMakePdf']; ?>
</td>
		<td><?php echo $this->_tpl_vars['sAuthor']; ?>
</td>
	<?php if ($this->_tpl_vars['parent_admit']): ?>
		<td><?php echo $this->_tpl_vars['sEncNr']; ?>
</td>
	<?php endif; ?>
	</tr>