<?php /* Smarty version 2.6.18, created on 2007-05-23 10:46:00
         compiled from ../templates/default/products/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', '../templates/default/products/add.tpl', 56, false),)), $this); ?>
 

<?php if ($_POST['description'] != "" && $_POST['submit'] != null): ?> 
<?php echo $this->_tpl_vars['refresh_total']; ?>


<br />
<br />
<?php echo $this->_tpl_vars['display_block']; ?>
 
<br />
<br />

<?php else: ?>
 
	<?php if ($_POST['submit'] != null): ?> 
		<div class="validation_alert"><img src="./images/common/important.png"</img>
		You must enter a description for the product</div>
		<hr />
	<?php endif; ?>
<form name="frmpost" ACTION="index.php?module=products&view=add" METHOD="POST">

<div id="top"><h3>&nbsp;<?php echo $this->_tpl_vars['LANG']['product_to_add']; ?>
&nbsp;</h3></div>
 <hr />

<table align=center>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['product_description']; ?>
 <a href="docs.php?t=help&p=required_field" rel="gb_page_center[350, 150]"><img src="./images/common/required-small.png"></img></a></td>
		<td><input type=text name="description" value="<?php echo $_POST['description']; ?>
" size=50></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['product_unit_price']; ?>
</td>
		<td><input type=text name="unit_price" value="<?php echo $_POST['unit_price']; ?>
"  size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf1']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="custom_field1" value="<?php echo $_POST['custom_field1']; ?>
"  size=50></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf2']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="custom_field2" value="<?php echo $_POST['custom_field2']; ?>
" size=50></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf3']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="custom_field3" value="<?php echo $_POST['custom_field3']; ?>
" size=50></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['product_cf4']; ?>
 <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="custom_field4" value="<?php echo $_POST['custom_field4']; ?>
" size=50></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['notes']; ?>
</td>
		<td><textarea input type=text name='notes' rows=8 cols=50><?php echo $_POST['notes']; ?>
</textarea></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['product_enabled']; ?>
</td>
		<td>
			<?php echo smarty_function_html_options(array('name' => 'enabled','options' => $this->_tpl_vars['enabled'],'selected' => 1), $this);?>

		</td>
	</tr>
</table>
<!-- </div> -->
<hr />
<div style="text-align:center;">
	<input type=submit name="submit" value="<?php echo $this->_tpl_vars['LANG']['insert_product']; ?>
">
	<input type=hidden name="op" value="insert_product">
</div>
</form>
	<?php endif; ?>