<?php /* Smarty version 2.6.18, created on 2007-06-18 15:49:55
         compiled from ../templates/default/preferences/details.tpl */ ?>
<form name="frmpost"
	action="index.php?module=preferences&view=save&submit=<?php echo $_GET['submit']; ?>
"
	method="post">


<?php if ($_GET['action'] == 'view'): ?>
	<b>Preference :: <a href='index.php?module=preferences&view=details&submit=<?php echo $this->_tpl_vars['preference']['pref_id']; ?>
&action=edit'>Edit</a></b>
	<hr></hr>

	
	<table align=center>
		<tr>
  			<td class='details_screen'>Preference ID</td><td><?php echo $this->_tpl_vars['preference']['pref_id']; ?>
</td>
                </tr>
		<tr>	
			<td class='details_screen'>Description <a href="docs.php?t=help&p=inv_pref_description" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_description']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Currency sign <a href="docs.php?t=help&p=inv_pref_currency_sign" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice heading <a href="docs.php?t=help&p=inv_pref_invoice_heading" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_heading']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice wording <a href="docs.php?t=help&p=inv_pref_invoice_wording" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice detail heading <a href="docs.php?t=help&p=inv_pref_invoice_detail_heading" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_detail_heading']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice detail line <a href="docs.php?t=help&p=inv_pref_invoice_detail_line" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_detail_line']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice payment method <a href="docs.php?t=help&p=inv_pref_invoice_payment_method" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_payment_method']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice payment line1 name <a href="docs.php?t=help&p=inv_pref_payment_line1_name" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_name']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice payment line1 value <a href="docs.php?t=help&p=inv_pref_payment_line1_value" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_value']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice payment line2 name <a href="docs.php?t=help&p=inv_pref_payment_line2_name" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_name']; ?>
</td>
                </tr>
                <tr>
			<td class='details_screen'>Invoice payment line2 value <a href="docs.php?t=help&p=inv_pref_payment_line2_value" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_value']; ?>
</td>
		</tr>
	        <tr>
        	        <td class='details_screen'><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
 <a href="docs.php?t=help&p=inv_pref_invoice_enabled" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><?php echo $this->_tpl_vars['preference']['enabled']; ?>
</td>
	        </tr>	
		<tr>
			<td colspan=2 align=center></td>
		</tr>
		<tr>
			<td colspan=2 align=center class="align_center"><a href="docs.php?t=help&p=inv_pref_what_the" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img> Whats all this "Invoice Preference" stuff about?</a></td>
		</tr>
		</table>
		<hr></hr>

<a href='index.php?module=preferences&view=details&submit=$pref_idField&action=edit'>Edit</a>

<?php endif; ?>

<?php if ($_GET['action'] == 'edit'): ?>

<b>Preferences</b>
	<hr></hr>

        <table align=center>
                <tr>
                        <td class='details_screen'>Preference ID</td><td><?php echo $this->_tpl_vars['preference']['pref_id']; ?>
</td>
                </tr>
                <tr>
                        <td class='details_screen'>Description <a href="docs.php?t=help&p=inv_pref_description" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_description' value='<?php echo $this->_tpl_vars['preference']['pref_description']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Currenc sign <a href="docs.php?t=help&p=inv_pref_currency_sign" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_currency_sign' value='<?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice heading <a href="docs.php?t=help&p=inv_pref_invoice_heading" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a><td><input type=text name='pref_inv_heading' value='<?php echo $this->_tpl_vars['preference']['pref_inv_heading']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice wording <a href="docs.php?t=help&p=inv_pref_invoice_wording" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_inv_wording' value='<?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice detail heading <a href="docs.php?t=help&p=inv_pref_invoice_detail_heading" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_inv_detail_heading' value='<?php echo $this->_tpl_vars['preference']['pref_inv_detail_heading']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice detail line <a href="docs.php?t=help&p=inv_pref_invoice_detail_line" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_inv_detail_line' value='<?php echo $this->_tpl_vars['preference']['pref_inv_detail_line']; ?>
' size=75></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice payment method <a href="docs.php?t=help&p=inv_pref_invoice_payment_method" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_inv_payment_method' value='<?php echo $this->_tpl_vars['preference']['pref_inv_payment_method']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice payment line1 name <a href="docs.php?t=help&p=inv_pref_payment_line1_name" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_inv_payment_line1_name' value='<?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_name']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice payment line1 value <a href="docs.php?t=help&p=inv_pref_payment_line1_value" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_inv_payment_line1_value' value='<?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_value']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice payment line2 name <a href="docs.php?t=help&p=inv_pref_payment_line2_name" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_inv_payment_line2_name' value='<?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_name']; ?>
' size=50></td>
                </tr>
                <tr>
                        <td class='details_screen'>Invoice payment line2 value <a href="docs.php?t=help&p=inv_pref_payment_line2_value" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td><td><input type=text name='pref_inv_payment_line2_value' value='<?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_value']; ?>
' size=50></td>
                </tr>
	<tr>
    	<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
 <a href="docs.php?t=help&p=inv_pref_invoice_enabled" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td>
				<select name="pref_enabled">
			<option value="<?php echo $this->_tpl_vars['preference']['pref_enabled']; ?>
" selected
				style="font-weight: bold;"><?php echo $this->_tpl_vars['preference']['enabled']; ?>
</option>
			<option value="1"><?php echo $this->_tpl_vars['LANG']['enabled']; ?>
</option>
			<option value="0"><?php echo $this->_tpl_vars['LANG']['disabled']; ?>
</option>
		</select>
				</td>
	</tr>
                <tr>
                        <td colspan=2 align=center></td>
                </tr>
                <tr>
                        <td colspan=2 align=center class="align_center"><a href="docs.php?t=help&p=inv_pref_what_the" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img> Whats all this "Invoice Preference" stuff about?</a></td>
                </tr>

                </table>
		<hr></hr>

<input type=submit name='action' value='<?php echo $this->_tpl_vars['LANG']['cancel']; ?>
'>
<input type=submit name='save_preference' value='<?php echo $this->_tpl_vars['LANG']['save']; ?>
'>
<input type=hidden name='op' value='edit_preference'>
<?php endif; ?>
</form>