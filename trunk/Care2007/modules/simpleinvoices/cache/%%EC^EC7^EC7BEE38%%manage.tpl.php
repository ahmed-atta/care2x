<?php /* Smarty version 2.6.18, created on 2007-06-18 15:46:58
         compiled from ../templates/default/category/manage.tpl */ ?>
<?php if ($this->_tpl_vars['categories'] == null): ?>
	<P><em><?php echo $this->_tpl_vars['LANG']['no_categories']; ?>
</em></p>
<?php else: ?>


<h3><?php echo $this->_tpl_vars['LANG']['manage_category']; ?>
 :: <a href="index.php?module=category&view=add"><?php echo $this->_tpl_vars['LANG']['add_new_category']; ?>
</a></h3>

 <hr />

<table align="center" class="ricoLiveGrid" id="rico_category">
<colgroup>
	<col style='width:10%;' />
	<col style='width:10%;' />
	<col style='width:60%;' />
<!--	<col style='width:20%;' /> -->
	<col style='width:20%;' />
</colgroup>
<thead>
<tr class="sortHeader">
	<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['actions']; ?>
</th>
	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['category_id']; ?>
</th>
	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['category_name']; ?>
</th>
<!--	<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['product_unit_price']; ?>
</th> -->
	<th class="noFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</th>
</tr>
</thead>


<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
	<tr class="index_table">
	<td class="index_table">
	<a class="index_table"
	 href="index.php?module=category&view=details&submit=<?php echo $this->_tpl_vars['category']['id']; ?>
&action=view"><?php echo $this->_tpl_vars['LANG']['view']; ?>
</a> ::
	<a class="index_table"
	 href="index.php?module=category&view=details&submit=<?php echo $this->_tpl_vars['category']['id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a> </td>
	<td class="index_table"><?php echo $this->_tpl_vars['category']['id']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['category']['name']; ?>
</td>
<!--	<td class="index_table"><?php echo $this->_tpl_vars['category']['unit_price']; ?>
</td>  -->
	<td class="index_table"><?php echo $this->_tpl_vars['category']['enabled']; ?>
</td>
	</tr>

<?php endforeach; endif; unset($_from); ?>

	</table>
<?php endif; ?>