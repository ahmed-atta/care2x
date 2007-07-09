<?php /* Smarty version 2.6.18, created on 2007-05-28 11:54:23
         compiled from ../templates/default/invoices/total.tpl */ ?>
<form name="frmpost" action="index.php?module=invoices&view=save" method=POST onsubmit="return frmpost_Validator(this)">

<h3><?php echo $this->_tpl_vars['LANG']['inv']; ?>
 <?php echo $this->_tpl_vars['LANG']['inv_total']; ?>
</h3>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['path'])."/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<tr>
<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['description']; ?>
</td>
</tr>

<tr>
	<td colspan=5 class="details_screen" ><textarea input type=text name="description" rows=10 cols=100 WRAP=nowrap></textarea></td>
</tr>

	<?php echo $this->_tpl_vars['show_custom_field']['1']; ?>

	<?php echo $this->_tpl_vars['show_custom_field']['2']; ?>

	<?php echo $this->_tpl_vars['show_custom_field']['3']; ?>

	<?php echo $this->_tpl_vars['show_custom_field']['4']; ?>




<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</td><td class="details_screen"><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</td><td class="details_screen"><?php echo $this->_tpl_vars['LANG']['inv_pref']; ?>
</td>
</tr>
<tr>
	<td><input type="text" name="unit_price" size="15"></td><td input type=text name="tax" size=15>
	
	<?php if ($this->_tpl_vars['taxes'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_taxes']; ?>
</em></p>
<?php else: ?>
	<select name="tax_id">
	<?php $_from = $this->_tpl_vars['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
		<option <?php if ($this->_tpl_vars['tax']['tax_id'] == $this->_tpl_vars['defaults']['tax']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
"><?php echo $this->_tpl_vars['tax']['tax_description']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>

</td><td>

<?php if ($this->_tpl_vars['preferences'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_preferences']; ?>
</em></p>
<?php else: ?>
	<select name="preference_id">
	<?php $_from = $this->_tpl_vars['preferences']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['preference']):
?>
		<option <?php if ($this->_tpl_vars['preference']['pref_id'] == $this->_tpl_vars['defaults']['preference']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['preference']['pref_id']; ?>
"><?php echo $this->_tpl_vars['preference']['pref_description']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>

</td>
	
<tr>
	<td align=left>
		<a href="docs.php?t=help&p=invoice_custom_fields" rel="gb_page_center[450, 450]"><?php echo $this->_tpl_vars['LANG']['want_more_fields']; ?>
<img src="./images/common/help-small.png"></img></a>

	</td>
</tr>
<!--Add more line items while in an itemeised invoice - Get style - has problems- wipes the current values of the existing rows - not good
<tr>
<td>
<a href="?get_num_line_items=10">Add 5 more line items<a>
</tr>
-->
</table>
<!-- </div> -->
<hr />
<div style="text-align:center;">
	<input type=hidden name="max_items" value="<?php echo $this->_sections['line']['index']; ?>
">
	<input type=submit name="submit" value="<?php echo $this->_tpl_vars['LANG']['save_invoice']; ?>
">
	<input type=hidden name="style" value="insert_total">
</div>
</form>