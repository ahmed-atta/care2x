<?php /* Smarty version 2.6.0, created on 2010-05-31 15:40:58
         compiled from ambulatory/outpatients.tpl */ ?>

<?php echo $this->_tpl_vars['sRoomTop']; ?>

<?php echo $this->_tpl_vars['sWarningPrompt']; ?>

<?php echo $this->_tpl_vars['sNoPatientRow']; ?>

<table cellspacing="0" cellpadding="0" width="100%">
<tbody>
	<tr valign="top">
		<td>
			<?php if ($this->_tpl_vars['bShowPatientsList']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ambulatory/outpatients_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
			<p>
			<?php echo $this->_tpl_vars['pbClose']; ?>

		</td>
		<td align="right">
			<?php echo $this->_tpl_vars['sSubMenuBlock']; ?>

		</td>
	</tr>
</tbody>
</table>

<?php echo $this->_tpl_vars['sRoomBottom']; ?>
