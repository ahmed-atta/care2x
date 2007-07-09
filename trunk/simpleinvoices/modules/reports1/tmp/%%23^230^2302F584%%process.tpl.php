<?php /* Smarty version 2.6.18, created on 2007-06-01 13:45:49
         compiled from ../templates/default/payments/process.tpl */ ?>
<form name="frmpost" action="index.php?module=payments&view=save" method="post" onsubmit="return frmpost_Validator(this)">
<h3><?php echo $this->_tpl_vars['LANG']['process_payment']; ?>
</h3>
 <hr />
 

<?php if ($_GET['op'] === 'pay_selected_invoice'): ?>

<table align="center">	
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_id']; ?>
</td>
	<td><input type="hidden" name="ac_inv_id" value="<?php echo $this->_tpl_vars['invoice']['id']; ?>
" /><?php echo $this->_tpl_vars['invoice']['id']; ?>
</td>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['total']; ?>
</td><td><?php echo $this->_tpl_vars['invoice']['total_format']; ?>
</td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['biller']; ?>
</td>
	<td><?php echo $this->_tpl_vars['biller']['name']; ?>
</td>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['paid']; ?>
</td>
	<td><?php echo $this->_tpl_vars['invoice']['paid_format']; ?>
</td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['customer']; ?>
</td>
	<td><?php echo $this->_tpl_vars['customer']['name']; ?>
</td>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['owing']; ?>
</td>
	<td><u><?php echo $this->_tpl_vars['invoice']['owing_format']; ?>
</u></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['amount']; ?>
</td>
	<td colspan="5"><input type="text" name="ac_amount" size="25" value="<?php echo $this->_tpl_vars['invoice']['owing']; ?>
" /><a href="docs.php?t=help&p=process_payment_auto_amount" rel="gb_page_center.450, 450"><img src="./images/common/help-small.png"></img></a></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['date_formatted']; ?>
</td>
	<td><input type="text" class="date-picker" name="ac_date" id="date1" value="<?php echo $this->_tpl_vars['today']; ?>
" /></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['payment_type_method']; ?>
</td>
	<td>

<?php endif; ?>


<?php if ($_GET['op'] === 'pay_invoice'): ?>
	
<table align="center">
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_id']; ?>

	<a href="docs.php?t=help&p=process_payment_inv_id" rel="gb_page_center.450, 450"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type="text" id="ac_me" name="ac_inv_id" /></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['details']; ?>

	<a href="docs.php?t=help&p=process_payment_details" rel="gb_page_center.450, 450"><img src="./images/common/help-small.png"></img></a></td>
	<td id="js_total"><i><?php echo $this->_tpl_vars['LANG']['select_invoice']; ?>
</i> </td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['amount']; ?>
</td>
	<td colspan="5"><input type="text" name="ac_amount" size="25" /></td>
</tr>
<tr>
	<div class="demo-holder">
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['date_formatted']; ?>
</td>
		<td><input type="text" class="date-picker" name="ac_date" id="date1" value="<?php echo $this->_tpl_vars['today']; ?>
" /></td>
	</div>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['payment_type_method']; ?>
</td>
	<td>
<?php endif; ?>


<?php if ($this->_tpl_vars['paymentTypes'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_payment_types']; ?>
</em></p>
<?php else: ?>

<select name="ac_payment_type">
<option selected value="<?php echo $this->_tpl_vars['defaults']['payment_type']; ?>
" style="font-weight: bold"><?php echo $this->_tpl_vars['pt']['pt_description']; ?>
</option>

	<?php $_from = $this->_tpl_vars['paymentTypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['paymentType']):
?>
		<option value="<?php echo $this->_tpl_vars['paymentType']['pt_id']; ?>
">
		<?php echo $this->_tpl_vars['paymentType']['pt_description']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>


	
	</td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['note']; ?>
</td>
	<td colspan="5"><textarea name="ac_notes" rows="5" cols="50"></textarea></td>
</tr>
</table>


<hr />
<div style="text-align:center;">
	<input type="submit" name="process_payment" value="<?php echo $this->_tpl_vars['LANG']['process_payment']; ?>
">
</div>
</form>
