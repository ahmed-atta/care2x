<?php /* Smarty version 2.6.18, created on 2007-06-18 15:47:01
         compiled from ../templates/default/category/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', '../templates/default/category/details.tpl', 97, false),)), $this); ?>
<form name="frmpost"
	action="index.php?module=category&view=save&submit=<?php echo $_GET['submit']; ?>
"
	method="post">


<?php if ($_GET['action'] == 'view'): ?>

	<b><?php echo $this->_tpl_vars['LANG']['category']; ?>
 ::
	<a href="index.php?module=category&view=details&submit=<?php echo $this->_tpl_vars['category']['id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></b>
	
 	<hr></hr>

	<table align="center">
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['category_id']; ?>
</td><td><?php echo $this->_tpl_vars['category']['id']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['category_name']; ?>
</td>
		<td><?php echo $this->_tpl_vars['category']['name']; ?>
</td>
	</tr>
<!--	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['product_unit_price']; ?>
</td>
		<td><?php echo $this->_tpl_vars['product']['unit_price']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf1']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><?php echo $this->_tpl_vars['product']['custom_field1']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf2']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><?php echo $this->_tpl_vars['product']['custom_field2']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf3']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><?php echo $this->_tpl_vars['product']['custom_field3']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf4']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><?php echo $this->_tpl_vars['product']['custom_field4']; ?>
</td>
	</tr>
-->
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['notes']; ?>
</td><td><?php echo $this->_tpl_vars['category']['notes']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['category_enabled']; ?>
</td>
		<td><?php echo $this->_tpl_vars['category']['wording_for_enabled']; ?>
</td>
	</tr>
	</table>

<hr></hr>
<a href="index.php?module=category&view=details&submit=<?php echo $this->_tpl_vars['category']['id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a>
<?php endif; ?>


<?php if ($_GET['action'] == 'edit'): ?>

	<b><?php echo $this->_tpl_vars['LANG']['category_edit']; ?>
</b>
	<hr></hr>

	<table align="center">
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['category_id']; ?>
</td><td><?php echo $this->_tpl_vars['category']['id']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['category_name']; ?>
</td>
		<td><input type="text" name="name" size="50" value="<?php echo $this->_tpl_vars['category']['name']; ?>
" /></td>
	</tr>
<!--	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['product_unit_price']; ?>
</td>
		<td><input type="text" name="unit_price" size="25" value="<?php echo $this->_tpl_vars['product']['unit_price']; ?>
" /></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf1']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type="text" name="custom_field1" size="50" value="<?php echo $this->_tpl_vars['product']['custom_field1']; ?>
" /></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf2']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type="text" name="custom_field2" size="50" value="<?php echo $this->_tpl_vars['product']['custom_field2']; ?>
" /></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf3']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type="text" name="custom_field3" size="50" value="<?php echo $this->_tpl_vars['product']['custom_field3']; ?>
" /></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf4']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type="text" name="custom_field4" size="50" value="<?php echo $this->_tpl_vars['product']['custom_field4']; ?>
" /></td>
	</tr>
-->
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['notes']; ?>
</td>
		<td><textarea name="notes" rows="8" cols="50"><?php echo $this->_tpl_vars['category']['notes']; ?>
</textarea></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['category_enabled']; ?>
</td>
		<td>
			<?php echo smarty_function_html_options(array('name' => 'enabled','options' => $this->_tpl_vars['enabled'],'selected' => $this->_tpl_vars['category']['enabled']), $this);?>

		</td>
	</tr>
	</table>
<?php endif; ?> 
<?php if ($_GET['action'] == 'edit'): ?>
	<hr></hr>
		<input type="submit" name="cancel" value="<?php echo $this->_tpl_vars['LANG']['cancel']; ?>
" /> 
		<input type="submit" name="save_category" value="<?php echo $this->_tpl_vars['LANG']['save_category']; ?>
" /> 
		<input type="hidden" name="op" value="edit_category" /> 
	<?php endif; ?>
</form>