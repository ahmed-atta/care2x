<?php /* Smarty version 2.6.18, created on 2007-06-01 13:06:17
         compiled from ../templates/default/invoices//header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '../templates/default/invoices//header.tpl', 43, false),)), $this); ?>
<hr />

<table align="center">

<tr>
	<td class="details_screen">
		<?php echo $this->_tpl_vars['LANG']['biller_name']; ?>

	</td>
	<td input type="text" name="biller_block" size=25>
		<?php if ($this->_tpl_vars['billers'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_billers']; ?>
</em></p>
<?php else: ?>
	<select name="biller_id">
	<?php $_from = $this->_tpl_vars['billers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['biller']):
?>
		<option <?php if ($this->_tpl_vars['biller']['id'] == $this->_tpl_vars['defaults']['biller']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['biller']['id']; ?>
"><?php echo $this->_tpl_vars['biller']['name']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>

	</td>
</tr>
<tr>
	<td class="details_screen">
		<?php echo $this->_tpl_vars['LANG']['customer_name']; ?>

	</td>
	<td>
		
<?php if ($this->_tpl_vars['customers'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_customers']; ?>
</em></p>
<?php else: ?>
	<select name="customer_id">
	<?php $_from = $this->_tpl_vars['customers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customer']):
?>
		<option <?php if ($_GET['customer'] == $this->_tpl_vars['customer']['id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['customer']['id']; ?>
"><?php echo $this->_tpl_vars['customer']['name']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>

	</td>
</tr>
<tr>
        <td class="details_screen"><?php echo $this->_tpl_vars['LANG']['date_formatted']; ?>
</td>
        <td>
                        <input type="text" class="date-picker" name="date" id="date1" value='<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
'></input>
        </td>
</tr>
