<?php /* Smarty version 2.6.18, created on 2007-06-01 14:05:04
         compiled from ../templates/default/preferences/manage.tpl */ ?>
<?php if (preferences == null): ?>
		<P><em><?php echo $this->_tpl_vars['LANG']['no_preferences']; ?>
.</em></p>
<?php else: ?>

	<h3><?php echo $this->_tpl_vars['LANG']['manage_preferences']; ?>
 ::
	<a href="index.php?module=preferences&view=add"><?php echo $this->_tpl_vars['LANG']['add_new_preference']; ?>
</a></h3>

	<hr />
	

	<table align="center" class="ricoLiveGrid manage" id="rico_preferences">
	<colgroup>
		<col style='width:10%;' />
		<col style='width:10%;' />
		<col style='width:40%;' />
		<col style='width:10%;' />
	</colgroup>
	<thead>
	<tr class="sortHeader">
		<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['actions']; ?>
</th>
		<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['preference_id']; ?>
</th>
		<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['description']; ?>
</th>
		<th class="noFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</th>
	</tr>
	</thead>

  	<?php $_from = $this->_tpl_vars['preferences']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['preference']):
?>

 		<tr class="index_table">
		<td class="index_table">
		<a class="index_table"
		href="index.php?module=preferences&view=details&submit=<?php echo $this->_tpl_vars['preference']['pref_id']; ?>
&action=view"><?php echo $this->_tpl_vars['LANG']['view']; ?>
</a> ::
		<a class="index_table"
		href="index.php?module=preferences&view=details&submit=<?php echo $this->_tpl_vars['preference']['pref_id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a> </td>
		<td class="index_table"><?php echo $this->_tpl_vars['preference']['pref_id']; ?>
</td>
		<td class="index_table"><?php echo $this->_tpl_vars['preference']['pref_description']; ?>
</td>
		<td class="index_table"><?php echo $this->_tpl_vars['preference']['enabled']; ?>
</td>
		</tr>

		<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php endif; ?>
<br />
<div style="text-align:center;"><a href="docs.php?t=help&p=inv_pref_what_the" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img> What's all this "Invoice Preference" stuff about?</a></div>