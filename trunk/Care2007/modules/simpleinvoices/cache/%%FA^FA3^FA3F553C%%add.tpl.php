<?php /* Smarty version 2.6.18, created on 2007-06-18 15:49:44
         compiled from ../templates/default/preferences/add.tpl */ ?>

 

<?php if ($_POST['p_description'] != "" && $_POST['submit'] != null): ?> 
<?php echo $this->_tpl_vars['refresh_total']; ?>


<br />
<br />
<?php echo $this->_tpl_vars['display_block']; ?>
 
<br />
<br />

<?php else: ?>
 
	<?php if ($_POST['submit'] != null): ?> 
		<div class="validation_alert"><img src="./images/common/important.png"</img>
		You must enter a description for the preference</div>
		<hr />
	<?php endif; ?>
<form name="frmpost" ACTION="index.php?module=preferences&view=add" METHOD="POST">

<h3><?php echo $this->_tpl_vars['LANG']['invoice_preference_to_add']; ?>
</h3>

<hr />


<table align=center>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['description']; ?>
 <a href="docs.php?t=help&p=inv_pref_description" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_description"  value="<?php echo $_POST['p_description']; ?>
" size=25></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['currency_sign']; ?>
 <a href="docs.php?t=help&p=inv_pref_currency_sign" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_currency_sign"  value="<?php echo $_POST['p_currency_sign']; ?>
" size=25></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_heading']; ?>
 <a href="docs.php?t=help&p=inv_pref_invoice_heading" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_heading"  value="<?php echo $_POST['p_inv_heading']; ?>
" size=50></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_wording']; ?>

	<a href="docs.php?t=help&p=inv_pref_invoice_wording" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_wording"  value="<?php echo $_POST['p_inv_wording']; ?>
" size=50></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_detail_heading']; ?>

	<a href="docs.php?t=help&p=inv_pref_invoice_detail_heading" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_detail_heading"  value="<?php echo $_POST['p_inv_detail_heading']; ?>
" size=50></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_detail_line']; ?>

	<a href="docs.php?t=help&p=inv_pref_invoice_detail_line" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_detail_line"  value="<?php echo $_POST['p_inv_detail_line']; ?>
" size=75></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_payment_method']; ?>

	<a href="docs.php?t=help&p=inv_pref_invoice_payment_method" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_payment_method"  value="<?php echo $_POST['p_inv_payment_method']; ?>
" size=50></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_payment_line_1_name']; ?>

	<a href="docs.php?t=help&p=inv_pref_payment_line1_name" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_payment_line1_name"  value="<?php echo $_POST['p_inv_payment_line1_name']; ?>
" size=50></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_payment_line_1_value']; ?>

	<a href="docs.php?t=help&p=inv_pref_payment_line1_value" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_payment_line1_value"  value="<?php echo $_POST['p_inv_payment_line1_value']; ?>
" size=50></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_payment_line_2_name']; ?>

	<a href="docs.php?t=help&p=inv_pref_payment_line2_name" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_payment_line2_name"  value="<?php echo $_POST['p_inv_payment_line2_name']; ?>
" size=50></td>
</tr>
<tr>
	<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['invoice_payment_line_2_value']; ?>

	<a href="docs.php?t=help&p=inv_pref_payment_line2_value" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="p_inv_payment_line2_value"  value="<?php echo $_POST['p_inv_payment_line2_value']; ?>
" size=50></td>
</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</td>
		<td>
			<select name="pref_enabled">
			<option value="1" selected><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</option>
			<option value="0"><?php echo $this->_tpl_vars['LANG']['disabled']; ?>
</option>
			</select>
		</td>
	</tr>
</table>
<!-- </div> -->
<hr />
<div style="text-align:center;">
	<input type=submit name="submit" value="<?php echo $this->_tpl_vars['LANG']['insert_preference']; ?>
">
	<input type=hidden name="op" value="insert_preference">
</div>
</form>
	
<?php endif; ?>