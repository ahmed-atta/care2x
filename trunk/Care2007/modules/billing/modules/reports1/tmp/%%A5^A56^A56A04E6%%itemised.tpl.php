<?php /* Smarty version 2.6.18, created on 2007-05-28 11:55:32
         compiled from ../templates/default/invoices/itemised.tpl */ ?>
<form name="frmpost" action="index.php?module=invoices&view=save" method=POST onsubmit="return frmpost_Validator(this)">

<h3><?php echo $this->_tpl_vars['LANG']['inv']; ?>
 <?php echo $this->_tpl_vars['LANG']['inv_itemised']; ?>
</h3>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['path'])."/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<tr>
<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['quantity']; ?>
</td><td class="details_screen"><?php echo $this->_tpl_vars['LANG']['description']; ?>
</td>
</tr>


        <?php unset($this->_sections['line']);
$this->_sections['line']['name'] = 'line';
$this->_sections['line']['start'] = (int)0;
$this->_sections['line']['loop'] = is_array($_loop=$this->_tpl_vars['dynamic_line_items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['line']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['line']['show'] = true;
$this->_sections['line']['max'] = $this->_sections['line']['loop'];
if ($this->_sections['line']['start'] < 0)
    $this->_sections['line']['start'] = max($this->_sections['line']['step'] > 0 ? 0 : -1, $this->_sections['line']['loop'] + $this->_sections['line']['start']);
else
    $this->_sections['line']['start'] = min($this->_sections['line']['start'], $this->_sections['line']['step'] > 0 ? $this->_sections['line']['loop'] : $this->_sections['line']['loop']-1);
if ($this->_sections['line']['show']) {
    $this->_sections['line']['total'] = min(ceil(($this->_sections['line']['step'] > 0 ? $this->_sections['line']['loop'] - $this->_sections['line']['start'] : $this->_sections['line']['start']+1)/abs($this->_sections['line']['step'])), $this->_sections['line']['max']);
    if ($this->_sections['line']['total'] == 0)
        $this->_sections['line']['show'] = false;
} else
    $this->_sections['line']['total'] = 0;
if ($this->_sections['line']['show']):

            for ($this->_sections['line']['index'] = $this->_sections['line']['start'], $this->_sections['line']['iteration'] = 1;
                 $this->_sections['line']['iteration'] <= $this->_sections['line']['total'];
                 $this->_sections['line']['index'] += $this->_sections['line']['step'], $this->_sections['line']['iteration']++):
$this->_sections['line']['rownum'] = $this->_sections['line']['iteration'];
$this->_sections['line']['index_prev'] = $this->_sections['line']['index'] - $this->_sections['line']['step'];
$this->_sections['line']['index_next'] = $this->_sections['line']['index'] + $this->_sections['line']['step'];
$this->_sections['line']['first']      = ($this->_sections['line']['iteration'] == 1);
$this->_sections['line']['last']       = ($this->_sections['line']['iteration'] == $this->_sections['line']['total']);
?>

			<tr>
				<td><input type=text name="quantity<?php echo $this->_sections['line']['index']; ?>
" size="5"></td>
				<td>
				                
			<?php if ($this->_tpl_vars['products'] == null): ?>
				<p><em><?php echo $this->_tpl_vars['LANG']['no_products']; ?>
</em></p>
			<?php else: ?>
				<select name="products<?php echo $this->_sections['line']['index']; ?>
">
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

        <?php endfor; endif; ?>
	<?php echo $this->_tpl_vars['show_custom_field']['1']; ?>

	<?php echo $this->_tpl_vars['show_custom_field']['2']; ?>

	<?php echo $this->_tpl_vars['show_custom_field']['3']; ?>

	<?php echo $this->_tpl_vars['show_custom_field']['4']; ?>



<tr>
        <td colspan=2 class="details_screen"><?php echo $this->_tpl_vars['LANG']['notes']; ?>
</td>
</tr>

<tr>
        <td colspan=2><textarea input type=text name="note" rows=5 cols=70 WRAP=nowrap></textarea></td>
</tr>

<tr><td class="details_screen"><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</td>
<td>

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

</td>
</tr>

<tr>
<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['inv_pref']; ?>
</td><td input type=text name="preference_id">

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
</tr>	
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
	<input type=hidden name="style" value="insert_itemised">
</div>
</form>