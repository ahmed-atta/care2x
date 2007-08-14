<?php /* Smarty version 2.6.18, created on 2007-06-01 13:56:10
         compiled from ../templates/default/billers/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', '../templates/default/billers/add.tpl', 112, false),)), $this); ?>

<?php if ($_POST['name'] != "" && $_POST['submit'] != null): ?> 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../templates/default/billers/save.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>

<?php if ($_POST['submit'] != null): ?>
<div class="validation_alert"><img src="./images/common/important.png"</img>
You must enter a Biller name</div>
<hr />
<?php endif; ?>
<form name="frmpost" action="index.php?module=billers&view=add"
	method="post"><h3><?php echo $this->_tpl_vars['LANG']['biller_to_add']; ?>
</h3>
<hr />
<table align="center">
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['biller_name']; ?>
 <a href="docs.php?t=help&p=required_field" rel="gb_page_center[350, 150]"><img src="./images/common/required-small.png"></img></a></td>
		<td><input type=text name="name" value="<?php echo $_POST['name']; ?>
"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['street']; ?>
</td>
		<td><input type=text name="street_address"
			value="<?php echo $_POST['street_address']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['street2']; ?>
 <a
			href="docs.php?t=help&p=street2"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="street_address2"
			value="<?php echo $_POST['street_address2']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['city']; ?>
</td>
		<td><input type=text name="city" value="<?php echo $_POST['city']; ?>
"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['state']; ?>
</td>
		<td><input type=text name="state" value="<?php echo $_POST['state']; ?>
"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['zip']; ?>
</td>
		<td><input type=text name="zip_code"
			value="<?php echo $_POST['zip_code']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['country']; ?>
</td>
		<td><input type=text name="country" value="<?php echo $_POST['country']; ?>
"
			size=50></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['phone']; ?>
</td>
		<td><input type=text name="phone" value="<?php echo $_POST['phone']; ?>
"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['mobile_phone']; ?>
</td>
		<td><input type=text name="mobile_phone"
			value="<?php echo $_POST['mobile_phone']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['fax']; ?>
</td>
		<td><input type=text name="fax" value="<?php echo $_POST['fax']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['email']; ?>
</td>
		<td><input type=text name="email" value="<?php echo $_POST['email']; ?>
"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['biller_cf1']; ?>
<a
			href="docs.php?t=help&p=custom_fields"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="custom_field1"
			value="<?php echo $_POST['custom_field1']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['biller_cf2']; ?>
 <a
			href="docs.php?t=help&p=custom_fields"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="custom_field2"
			value="<?php echo $_POST['custom_field2']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['biller_cf3']; ?>
 <a
			href="docs.php?t=help&p=custom_fields"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="custom_field3"
			value="<?php echo $_POST['custom_field3']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['customFieldLabel']['biller_cf4']; ?>
 <a
			href="docs.php?t=help&p=custom_fields"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="custom_field4"
			value="<?php echo $_POST['custom_field4']; ?>
" size=25></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['logo_file']; ?>
 <a
			href="docs.php?t=help&p=insert_biller_text"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td>
			<?php echo smarty_function_html_options(array('name' => 'logo','output' => $this->_tpl_vars['files'],'values' => $this->_tpl_vars['files'],'selected' => $this->_tpl_vars['files'][0]), $this);?>

		</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_footer']; ?>
</td>
		<td><textarea input type=text name="footer"
			rows=4 cols=50><?php echo $_POST['footer']; ?>
</textarea></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['notes']; ?>
</td>
		<td><textarea input type=text name="notes"
			 rows=8 cols=50><?php echo $_POST['notes']; ?>
</textarea></td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</td>
		<td>
			<?php echo smarty_function_html_options(array('name' => 'enabled','options' => $this->_tpl_vars['enabled'],'selected' => 1), $this);?>

		</td>
	</tr>
	</div>
	</div>
	</div>
	</tbody>
</table>
<hr />
<div style="text-align:center;">
	<input type="submit" name="submit" value="<?php echo $this->_tpl_vars['LANG']['insert_biller']; ?>
" /> <input
	type="hidden" name="op" value="insert_biller" />
</div>
</form>
<?php endif; ?>