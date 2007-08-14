<?php /* Smarty version 2.6.18, created on 2007-06-20 13:42:42
         compiled from ../templates/default/custom_fields/manage.tpl */ ?>

<?php if ($this->_tpl_vars['cfs'] == null): ?>
<P><em><?php echo $this->_tpl_vars['LANG']['no_invoices']; ?>
.</em></p>

<?php else: ?>


<h3><?php echo $this->_tpl_vars['LANG']['manage_custom_fields']; ?>
</h3>
<div style="text-align:center;"><a href="docs.php?t=help&p=what_are_custom_fields" rel="gb_page_center[450, 450]"><?php echo $this->_tpl_vars['LANG']['what_are_custom_fields']; ?>
<img src="./images/common/help-small.png"></img></a> :: <a href="docs.php?t=help&p=manage_custom_fields" rel="gb_page_center[450, 450]"><?php echo $this->_tpl_vars['LANG']['whats_this_page_about']; ?>
<img src="./images/common/help-small.png"></img></a></div>
<hr />

<table align="center" class="ricoLiveGrid manage" id="rico_custom_fields">
<colgroup>
	<col style='width:10%;' />
	<col style='width:10%;' />
	<col style='width:40%;' />
	<col style='width:40%;' />
</colgroup>
<thead>
	<tr class="sortHeader">
		<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['actions']; ?>
</th>
		<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['id']; ?>
</th>
		<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['custom_field']; ?>
</th>
		<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['custom_label']; ?>
</th>
	</tr>
</thead>

<?php $_from = $this->_tpl_vars['cfs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cf']):
?>

	<tr class="index_table">
		<td class="index_table">
			<a class="index_table" href="index.php?module=custom_fields&view=details&submit=<?php echo $this->_tpl_vars['cf']['cf_id']; ?>
&action=view"><?php echo $this->_tpl_vars['LANG']['view']; ?>
</a> ::
			<a class="index_table" href="index.php?module=custom_fields&view=details&submit=<?php echo $this->_tpl_vars['cf']['cf_id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a> </td>
		<td class="index_table"><?php echo $this->_tpl_vars['cf']['cf_id']; ?>
</td>
		<td class="index_table"><?php echo $this->_tpl_vars['cf']['filed_name']; ?>
</td>
		<td class="index_table"><?php echo $this->_tpl_vars['cf']['cf_custom_label']; ?>
</td>
	</tr>

<?php endforeach; endif; unset($_from); ?>

</table>

<?php endif; ?>