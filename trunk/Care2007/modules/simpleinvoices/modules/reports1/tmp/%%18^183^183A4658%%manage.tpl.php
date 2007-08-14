<?php /* Smarty version 2.6.18, created on 2007-06-01 13:55:43
         compiled from ../templates/default/products/manage.tpl */ ?>
<?php if ($this->_tpl_vars['products'] == null): ?>
	<P><em><?php echo $this->_tpl_vars['LANG']['no_products']; ?>
</em></p>
<?php else: ?>


<h3><?php echo $this->_tpl_vars['LANG']['manage_products']; ?>
 :: <a href="index.php?module=products&view=add"><?php echo $this->_tpl_vars['LANG']['add_new_product']; ?>
</a></h3>

 <hr />

<table align="center" class="ricoLiveGrid" id="rico_product">
<colgroup>
	<col style='width:10%;' />
	<col style='width:10%;' />
	<col style='width:50%;' />
	<col style='width:20%;' />
	<col style='width:10%;' />
</colgroup>
<thead>
<tr class="sortHeader">
	<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['actions']; ?>
</th>
	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['product_id']; ?>
</th>
	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['product_description']; ?>
</th>
	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['product_unit_price']; ?>
</th>
	<th class="noFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</th>
</tr>
</thead>


<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
	<tr class="index_table">
	<td class="index_table">
	<a class="index_table"
	 href="index.php?module=products&view=details&submit=<?php echo $this->_tpl_vars['product']['id']; ?>
&action=view"><?php echo $this->_tpl_vars['LANG']['view']; ?>
</a> ::
	<a class="index_table"
	 href="index.php?module=products&view=details&submit=<?php echo $this->_tpl_vars['product']['id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a> </td>
	<td class="index_table"><?php echo $this->_tpl_vars['product']['id']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['product']['description']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['product']['unit_price']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['product']['enabled']; ?>
</td>
	</tr>

<?php endforeach; endif; unset($_from); ?>

	</table>
<?php endif; ?>