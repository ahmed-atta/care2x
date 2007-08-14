<?php /* Smarty version 2.6.18, created on 2007-06-01 14:05:16
         compiled from ../templates/default/tax_rates/manage.tpl */ ?>
<?php if ($this->_tpl_vars['taxes'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_tax_rates']; ?>
.</em></p>
<?php else: ?>

	<h3><?php echo $this->_tpl_vars['LANG']['manage_tax_rates']; ?>
 ::
	<a href="./index.php?module=tax_rates&view=add"><?php echo $this->_tpl_vars['LANG']['add_new_tax_rate']; ?>
</a></h3>
 <hr />


<table align="center" class="ricoLiveGrid" id="rico_tax_rates">
<colgroup>
<col style='width:10%;' />
<col style='width:10%;' />
<col style='width:30%;' />
<col style='width:10%;' />
<col style='width:15%;' />
</colgroup>
<thead>
<tr class="sortHeader">
	<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['actions']; ?>
</th>
	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['tax_id']; ?>
</th>
	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['tax_description']; ?>
</th>
	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['tax_percentage']; ?>
</th>
	<th class="noFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</th>
</tr>
</thead>

	<?php $_from = $this->_tpl_vars['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
		<tr class="index_table">
		<td class="index_table">
		<a class="index_table"
		href="./index.php?module=tax_rates&view=details&submit=<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
&action=view"><?php echo $this->_tpl_vars['LANG']['view']; ?>
</a> ::
		<a class="index_table"
		 href="./index.php?module=tax_rates&view=details&submit=<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></td>
		<td class="index_table"><?php echo $this->_tpl_vars['tax']['tax_id']; ?>
</td>
		<td class="index_table"><?php echo $this->_tpl_vars['tax']['tax_description']; ?>
</td>
		<td class="index_table"><?php echo $this->_tpl_vars['tax']['tax_percentage']; ?>
</td>
		<td class="index_table"><?php echo $this->_tpl_vars['tax']['enabled']; ?>
</td>
		</tr>

	<?php endforeach; endif; unset($_from); ?>
	</table>
<?php endif; ?>