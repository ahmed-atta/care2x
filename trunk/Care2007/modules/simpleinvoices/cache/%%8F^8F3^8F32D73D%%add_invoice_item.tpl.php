<?php /* Smarty version 2.6.18, created on 2007-06-01 15:18:38
         compiled from ../templates/default/invoices/add_invoice_item.tpl */ ?>
<?php if ($_POST['submit'] != null): ?>
	<META HTTP-EQUIV=REFRESH CONTENT=1;URL=index.php?module=invoices&view=details&submit=<?php echo $_POST['invoice_id']; ?>
&style=<?php echo $_POST['style']; ?>
>
<?php else: ?>
<form name="add_invoice_item" action="index.php?module=invoices&view=add_invoice_item" method="post">
	<table>


			<tr>
				<td><input type=text name="quantity" size="5"></td><td input type=text name="description" size="50">
				                
			<?php if ($this->_tpl_vars['products'] == null): ?>
				<p><em><?php echo $this->_tpl_vars['LANG']['no_products']; ?>
</em></p>
			<?php else: ?>
				<select name="product">
					<option value=""></option>
				<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
					<option <?php if ($this->_tpl_vars['product']['id'] == $this->_tpl_vars['defaults']['product']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['product']['id']; ?>
"><?php echo $this->_tpl_vars['product']['description']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php endif; ?>
				                				                
                </td></tr>
                
                <tr class="text hide">
        <td colspan=2 ><textarea input type=text name='description' rows=3 cols=80 WRAP=nowrap></textarea></td>
</tr>
</table>

<div style="text-align:center;">
	<input type=submit name="submit" value="<?php echo $this->_tpl_vars['LANG']['save_invoice']; ?>
">
	<input type=hidden name="invoice_id" value="<?php echo $_GET['invoice']; ?>
">
	<input type=hidden name="style" value="<?php echo $_GET['style']; ?>
">
	<input type=hidden name="tax_id" value="<?php echo $_GET['tax_id']; ?>
">
</div>
</form>
<?php endif; ?>