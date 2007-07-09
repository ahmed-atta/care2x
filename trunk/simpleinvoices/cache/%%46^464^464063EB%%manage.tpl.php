<?php /* Smarty version 2.6.18, created on 2007-06-01 13:56:05
         compiled from ../templates/default/billers/manage.tpl */ ?>
<?php if ($this->_tpl_vars['billers'] == null): ?>
<P><em><?php echo $this->_tpl_vars['LANG']['no_billers']; ?>
.</em></p>
<?php else: ?>
<h3><?php echo $this->_tpl_vars['LANG']['manage_billers']; ?>
 :: <a href='index.php?module=billers&view=add'><?php echo $this->_tpl_vars['LANG']['add_new_biller']; ?>
</a></h3>
<hr />
<table class="ricoLiveGrid manage" id="rico_biller" align="center">
	<colgroup>
		<col style='width:15%;' />
		<col style='width:10%;' />
		<col style='width:40%;' />
		<!--
<col style='width:10%;' />
<col style='width:10%;' />
-->
		<col style='width:25%;' />
		<col style='width:10%;' />
	</colgroup>
	<thead>
		<tr class="sortHeader">
			<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['actions']; ?>
</th>
			<th class=" index_table sortable"><?php echo $this->_tpl_vars['LANG']['biller_id']; ?>
</th>
			<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['biller_name']; ?>
</th>
			<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['email']; ?>
</th>
			<th class="noFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</th>
		</tr>
	</thead>
	<?php $_from = $this->_tpl_vars['billers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['biller']):
?>
	<tr class='index_table'>
		<td class='index_table'><a class='index_table'
			href='index.php?module=billers&view=details&submit=<?php echo $this->_tpl_vars['biller']['id']; ?>
&action=view'>
		<?php echo $this->_tpl_vars['LANG']['view']; ?>
 </a> :: <a class='index_table'
			href='index.php?module=billers&view=details&submit=<?php echo $this->_tpl_vars['biller']['id']; ?>
&action=edit'>
		<?php echo $this->_tpl_vars['LANG']['edit']; ?>
 </a></td>
		<td class='index_table'><?php echo $this->_tpl_vars['biller']['id']; ?>
</td>
		<td class='index_table'><?php echo $this->_tpl_vars['biller']['name']; ?>
</td>
		<!--
	<td class='index_table'><?php echo $this->_tpl_vars['biller']['phone']; ?>
</td>
	<td class='index_table'><?php echo $this->_tpl_vars['biller']['mobile_phone']; ?>
</td>
	-->
		<td class='index_table'><?php echo $this->_tpl_vars['biller']['email']; ?>
</td>
		<td class='index_table'><?php echo $this->_tpl_vars['biller']['enabled']; ?>
</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>