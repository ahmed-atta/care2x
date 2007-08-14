<?php /* Smarty version 2.6.18, created on 2007-05-28 11:58:49
         compiled from ../templates/default/customers/manage.tpl */ ?>
<?php if ($this->_tpl_vars['customers'] == null): ?>
	<P><em><?php echo $this->_tpl_vars['LANG']['no_customers']; ?>
.</em></p>
<?php else: ?>


<h3><?php echo $this->_tpl_vars['LANG']['manage_customers']; ?>
 :: <a href="index.php?module=customers&view=add"><?php echo $this->_tpl_vars['LANG']['customer_add']; ?>
</a></h3>
<hr />

<table align="center" id="rico_customer" class="ricoLiveGrid manage">
<colgroup>
<col style='width:10%;' />
<col style='width:5%;' />
<col style='width:25%;' />
<col style='width:15%;' />
<col style='width:15%;' />
<col style='width:15%;' />
</colgroup>
<thead>
<tr class="sortHeader">
<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['actions']; ?>
</th>
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['customer_id']; ?>
</th>
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['customer_name']; ?>
</th>
<!--
<th class="index_table"><?php echo $this->_tpl_vars['LANG']['phone']; ?>
</th>
-->
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['total']; ?>
</th>
<!--
<th class="index_table"><?php echo $this->_tpl_vars['LANG']['paid']; ?>
</th>
-->
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['owing']; ?>
</th>
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</th>
</tr>
</thead>



<?php $_from = $this->_tpl_vars['customers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customer']):
?>

	<tr class="index_table">
	<td class="index_table"><a class="index_table"
	 href="index.php?module=customers&view=details&submit=<?php echo $this->_tpl_vars['customer']['id']; ?>
&action=view"><?php echo $this->_tpl_vars['LANG']['view']; ?>
</a> ::
	<a class="index_table"
	 href="index.php?module=customers&view=details&submit=<?php echo $this->_tpl_vars['customer']['id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a> </td>
	<td class="index_table"><?php echo $this->_tpl_vars['customer']['id']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['customer']['name']; ?>
</td>
	<!--
	<td class="index_table"><?php echo $this->_tpl_vars['customer']['phone']; ?>
</td>
	-->
	<td class="index_table"><?php echo $this->_tpl_vars['customer']['total']; ?>
</td>
	<!--
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['paid']; ?>
</td>
	-->
	<td class="index_table"><?php echo $this->_tpl_vars['customer']['owing']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['customer']['enabled']; ?>
</td>
	</tr>

<?php endforeach; endif; unset($_from); ?>
	</table>
<?php endif; ?>