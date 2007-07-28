<?php /* Smarty version 2.6.18, created on 2007-06-01 14:19:55
         compiled from ../templates/default/payments/details.tpl */ ?>
<h3><?php echo $this->_tpl_vars['LANG']['manage_payments']; ?>
</h3>
<hr />

<table align=center>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['payment_id']; ?>
</td><td><?php echo $this->_tpl_vars['payment']['id']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['invoice_id']; ?>
</td><td><a href='print_quick_view.php?submit=<?php echo $this->_tpl_vars['payment']['ac_inv_id']; ?>
&action=view&style=<?php echo $this->_tpl_vars['invoiceType']['inv_ty_description']; ?>
''><?php echo $this->_tpl_vars['payment']['ac_inv_id']; ?>
</a></td>
	</tr>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['amount']; ?>
</td><td><?php echo $this->_tpl_vars['payment']['ac_amount']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['date_upper']; ?>
</td><td><?php echo $this->_tpl_vars['payment']['date']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['biller']; ?>
</td><td><?php echo $this->_tpl_vars['payment']['biller']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['customer']; ?>
</td><td><?php echo $this->_tpl_vars['payment']['customer']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['payment_type']; ?>
</td><td><?php echo $this->_tpl_vars['paymentType']['pt_description']; ?>
</td>
	</tr>
        <tr>
                <td class='details_screen'><?php echo $this->_tpl_vars['LANG']['notes']; ?>
</td><td><?php echo $this->_tpl_vars['payment']['ac_notes']; ?>

        </tr>

</table>
<hr></hr>
	<form>
		<input type="button" value="Back" onCLick="history.back()">
	</form>