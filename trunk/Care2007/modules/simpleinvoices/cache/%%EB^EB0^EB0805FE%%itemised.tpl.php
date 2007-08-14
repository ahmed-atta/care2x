<?php /* Smarty version 2.6.18, created on 2007-06-20 12:35:02
         compiled from ../templates/invoices/export/itemised.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'inv_itemised_cf', '../templates/invoices/export/itemised.tpl', 26, false),array('function', 'do_tr', '../templates/invoices/export/itemised.tpl', 27, false),)), $this); ?>

			<tr>
				<td class="tbl1 col1" ><b><?php echo $this->_tpl_vars['LANG']['quantity_short']; ?>
</b></td>
				<td class="tbl1 col1" ><b><?php echo $this->_tpl_vars['LANG']['description']; ?>
</b></td>
				<td class="tbl1 col1" ><b><?php echo $this->_tpl_vars['LANG']['unit_price']; ?>
</b></td>
				<td class="tbl1 col1" ><b><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</b></td>
				<td class="tbl1 col1" ><b><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</b></td>
				<td class="tbl1 col1" align=right><b><?php echo $this->_tpl_vars['LANG']['total_uppercase']; ?>
</b></td>
			</tr>

	
	<?php $_from = $this->_tpl_vars['invoiceItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invoiceItem']):
?>
						<tr>
				<td><?php echo $this->_tpl_vars['invoiceItem']['quantity_formatted']; ?>
</td>
				<td><?php echo $this->_tpl_vars['invoiceItem']['product']['description']; ?>
</td>
				<td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['unit_price']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['gross_total']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['tax_amount']; ?>
</td>
				<td align="right"><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['total']; ?>
</td>
			</tr>
                <tr>
                        <td class="tbl1-left"></td><td class="tbl1-right" colspan="5">
                                                <table width="100%">
                                                        <tr>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf1'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field1']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 1,'class' => "blank-class"), $this);?>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf2'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field2']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 2,'class' => "blank-class"), $this);?>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf3'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field3']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 3,'class' => "blank-class"), $this);?>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf4'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field4']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 4,'class' => "blank-class"), $this);?>


                                                        </tr>
                                                </table>
                                </td>
                 </tr>

	
	<?php endforeach; endif; unset($_from); ?>
                

	<?php if ($this->_tpl_vars['invoice']['note']): ?>

		<tr>
			<td class="tbl1-left tbl1-right" colspan="7"><br></td>
		</tr>
		<tr>
			<td class="tbl1-left tbl1-right" colspan="7" align="left"><b><?php echo $this->_tpl_vars['LANG']['notes']; ?>
:</b></td>
		</tr>
		<tr>
			<td class="tbl1-left tbl1-right" colspan="7"><?php echo $this->_tpl_vars['invoice']['note']; ?>
</td>
		</tr>
	<?php endif; ?>
	
	<tr class="tbl1-left tbl1-right">
		<td class="tbl1-left tbl1-right" colspan="6" ><br></td>
	</tr>