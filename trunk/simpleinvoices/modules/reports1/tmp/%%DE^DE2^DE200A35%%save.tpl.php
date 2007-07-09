<?php /* Smarty version 2.6.18, created on 2007-06-01 13:56:17
         compiled from ../templates/default/billers/save.tpl */ ?>
<?php if ($this->_tpl_vars['saved'] == true): ?>
	<br>
	 <?php echo $this->_tpl_vars['LANG']['save_biller_success']; ?>

	<br>
	<br>
<?php else: ?>
	<br>
	 <?php echo $this->_tpl_vars['LANG']['save_biller_failure']; ?>

	<br>
	<br>
<?php endif; ?>

<?php if ($_POST['cancel'] == null): ?>
	<META HTTP-EQUIV=REFRESH CONTENT=2;URL=index.php?module=billers&view=manage>
<?php else: ?>
	<META HTTP-EQUIV=REFRESH CONTENT=0;URL=index.php?module=billers&view=manage>
<?php endif; ?>