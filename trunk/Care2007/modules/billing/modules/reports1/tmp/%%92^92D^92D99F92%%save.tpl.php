<?php /* Smarty version 2.6.18, created on 2007-06-01 13:56:28
         compiled from ../templates/default/system_defaults/save.tpl */ ?>
<META HTTP-EQUIV=REFRESH CONTENT=2;URL=index.php?module=system_defaults&view=manage>

<br>

<?php if ($this->_tpl_vars['saved']): ?>
	<?php echo $this->_tpl_vars['LANG']['save_defaults_success']; ?>
<br />
<?php else: ?>
	<?php echo $this->_tpl_vars['LANG']['save_defaults_failure']; ?>
<br />
<?php endif; ?>