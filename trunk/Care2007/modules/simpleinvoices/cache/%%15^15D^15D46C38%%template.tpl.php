<?php /* Smarty version 2.6.18, created on 2007-06-01 15:36:35
         compiled from ../templates/invoices/export/template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'merge_address', '../templates/invoices/export/template.tpl', 102, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<body>
<br>
<div id="container">
<div id="header">

</div>


	<table width="100%" align="center">
			<tr>
	   				<td colspan="5"><img src="<?php echo $this->_tpl_vars['logo']; ?>
" border="0" hspace="0" align="left"></td><th align=right><span ><?php echo $this->_tpl_vars['preference']['pref_inv_heading']; ?>
</span></th>
			</tr>
			<tr>
					<td colspan=6><hr size="1"></td>
			</tr>
	</table>
	
	<table >
		<tr>
				<td colspan="4" ><b><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['summary']; ?>
</b></td>
		</tr>
		<tr>
				<td ><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['number_short']; ?>
:</td><td colspan=3><?php echo $this->_tpl_vars['invoice']['id']; ?>
</td>
		</tr>
		<tr>
				<td nowrap ><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['date']; ?>
:</td><td colspan=3><?php echo $this->_tpl_vars['invoice']['date']; ?>
</td>
		</tr>
	<!-- Show the Invoice Custom Fields if valid -->

	<!-- Show the Invoice Custom Fields if valid -->
		<?php if ($this->_tpl_vars['invoice']['custom_field1'] != null): ?>
		<tr>
				<td nowrap><?php echo $this->_tpl_vars['customFieldLabels']['invoice_cf1']; ?>
:</td><td colspan=3><?php echo $this->_tpl_vars['invoice']['custom_field1']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['invoice']['custom_field2'] != null): ?>
		<tr>
				<td nowrap><?php echo $this->_tpl_vars['customFieldLabels']['invoice_cf2']; ?>
:</td><td colspan=3><?php echo $this->_tpl_vars['invoice']['custom_field2']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['invoice']['custom_field3'] != null): ?>
		<tr>
				<td nowrap><?php echo $this->_tpl_vars['customFieldLabels']['invoice_cf3']; ?>
:</td><td colspan=3><?php echo $this->_tpl_vars['invoice']['custom_field3']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['invoice']['custom_field4'] != null): ?>
		<tr>
				<td nowrap><?php echo $this->_tpl_vars['customFieldLabels']['invoice_cf4']; ?>
:</td><td colspan=3><?php echo $this->_tpl_vars['invoice']['custom_field4']; ?>
</td>
		</tr>
		<?php endif; ?>

		<tr>
				<td ><?php echo $this->_tpl_vars['LANG']['total']; ?>
: </td><td colspan=3><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total_format']; ?>
</td>
		</tr>
		<tr>
				<td ><?php echo $this->_tpl_vars['LANG']['paid']; ?>
:</td><td colspan=3 ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['paid_format']; ?>
</td>
		</tr>
		<tr>
				<td nowrap ><?php echo $this->_tpl_vars['LANG']['owing']; ?>
:</td><td colspan=3 ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['owing']; ?>
</td>
		</tr>


	</table>
	<!-- Summary - end -->
	
	
	<table >
	

        <!-- Biller section - start -->
	<table >
        <tr>
                <td  border=1 cellpadding=2 cellspacing=1><b><?php echo $this->_tpl_vars['LANG']['biller']; ?>
:</b></td><td border=1 cellpadding=2 cellspacing=1 colspan=3><?php echo $this->_tpl_vars['biller']['name']; ?>
</td>
        </tr> 

        <?php if ($this->_tpl_vars['biller']['street_address'] != null): ?>
                <tr>
                     <td ><?php echo $this->_tpl_vars['LANG']['address']; ?>
:</td><td  align=left colspan=3><?php echo $this->_tpl_vars['biller']['street_address']; ?>
</td>
                </tr>   
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['biller']['street_address2'] != null): ?>

                <tr >

                <?php if ($this->_tpl_vars['biller']['street_address'] == null): ?>
                        <td ><?php echo $this->_tpl_vars['LANG']['address']; ?>
:</td><td align=left colspan=3><?php echo $this->_tpl_vars['biller']['street_address2']; ?>
</td>
                </tr>   
                <?php endif; ?>
                <?php if ($this->_tpl_vars['biller']['street_address'] != null): ?>
                        <td ></td><td align=left colspan=3><?php echo $this->_tpl_vars['biller']['street_address2']; ?>
</td>
                </tr>   
                <?php endif; ?>
        <?php endif; ?>


			<?php echo smarty_function_merge_address(array('field1' => $this->_tpl_vars['biller']['city'],'field2' => $this->_tpl_vars['biller']['state'],'field3' => $this->_tpl_vars['biller']['zip_code'],'street1' => $this->_tpl_vars['biller']['street_address'],'street2' => $this->_tpl_vars['biller']['street_address2'],'class1' => "",'class2' => "",'colspan' => 3), $this);?>

	
	        <?php if ($this->_tpl_vars['biller']['country'] != null): ?>
                </tr>
                <tr>
                        <td ></td><td colspan=3><?php echo $this->_tpl_vars['biller']['country']; ?>
</td>
                </tr>
   		<?php endif; ?>
                <?php if ($this->_tpl_vars['biller']['phone'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['phone_short']; ?>
.:<td colspan=3><?php echo $this->_tpl_vars['biller']['phone']; ?>
</td>
                </tr>
   		<?php endif; ?>
                <?php if ($this->_tpl_vars['biller']['fax'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['fax']; ?>
.:<td colspan=3><?php echo $this->_tpl_vars['biller']['fax']; ?>
</td>
                </tr>
   		<?php endif; ?>
                <?php if ($this->_tpl_vars['biller']['mobile_phone'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['mobile_short']; ?>
.:<td colspan=3><?php echo $this->_tpl_vars['biller']['mobile_phone']; ?>
</td>
                </tr>
   		<?php endif; ?>
                <?php if ($this->_tpl_vars['biller']['email'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['email']; ?>
:<td colspan=3><?php echo $this->_tpl_vars['biller']['email']; ?>
</td>
                </tr>
		<?php endif; ?>
        		<?php if ($this->_tpl_vars['biller']['custom_field1'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['customFieldLabels']['biller_cf1']; ?>
:<td colspan=3><?php echo $this->_tpl_vars['biller']['custom_field1']; ?>
</td>
                </tr>	
				<?php endif; ?>
        		<?php if ($this->_tpl_vars['biller']['custom_field2'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['customFieldLabels']['biller_cf2']; ?>
:<td  colspan=3><?php echo $this->_tpl_vars['biller']['custom_field2']; ?>
</td>
                </tr>	
				<?php endif; ?>
        		<?php if ($this->_tpl_vars['biller']['custom_field3'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['customFieldLabels']['biller_cf3']; ?>
:<td  colspan=3><?php echo $this->_tpl_vars['biller']['custom_field3']; ?>
</td>
                </tr>	
				<?php endif; ?>
        		<?php if ($this->_tpl_vars['biller']['custom_field4'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['customFieldLabels']['biller_cf4']; ?>
:<td  colspan=3><?php echo $this->_tpl_vars['biller']['custom_field4']; ?>
</td>
                </tr>	
				<?php endif; ?>
				<tr><td colspan=4></td></tr>

<!-- Biller section - end -->




	<br>
		<tr>
			<td colspan=3><br /><td>
		</tr>
	<!-- Customer section - start -->
	<tr>
		<td  ><b><?php echo $this->_tpl_vars['LANG']['customer']; ?>
:</b></td><td colspan=3><?php echo $this->_tpl_vars['customer']['name']; ?>
</td>
	</tr>

        <?php if ($this->_tpl_vars['customer']['attention'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['attention_short']; ?>
:</td><td align=left  colspan=3 ><?php echo $this->_tpl_vars['customer']['attention']; ?>
</td>
                </tr>
        <?php endif; ?>
               <?php if ($this->_tpl_vars['customer']['street_address'] != null): ?>
                <tr>
                     <td ><?php echo $this->_tpl_vars['LANG']['address']; ?>
:</td><td  align=left colspan=3><?php echo $this->_tpl_vars['customer']['street_address']; ?>
</td>
                </tr>   
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['customer']['street_address2'] != null): ?>

                <tr >

                <?php if ($this->_tpl_vars['customer']['street_address'] == null): ?>
                        <td ><?php echo $this->_tpl_vars['LANG']['address']; ?>
:</td><td  align=left colspan=3><?php echo $this->_tpl_vars['customer']['street_address2']; ?>
</td>
                </tr>   
                <?php endif; ?>
                <?php if ($this->_tpl_vars['customer']['street_address'] != null): ?>
                        <td ></td><td  align=left colspan=3><?php echo $this->_tpl_vars['customer']['street_address2']; ?>
</td>
                </tr>   
                <?php endif; ?>
        <?php endif; ?>

		<?php echo smarty_function_merge_address(array('field1' => $this->_tpl_vars['customer']['city'],'field2' => $this->_tpl_vars['customer']['state'],'field3' => $this->_tpl_vars['customer']['zip_code'],'street1' => $this->_tpl_vars['customer']['street_address'],'street2' => $this->_tpl_vars['customer']['street_addtess2'],'class1' => "",'class2' => "",'colspan' => 3), $this);?>

	
                <?php if ($this->_tpl_vars['customer']['country'] != null): ?>
                </tr>
                <tr>
                        <td ></td><td  colspan=3><?php echo $this->_tpl_vars['customer']['country']; ?>
</td>
                </tr>
       		<?php endif; ?>
                <?php if ($this->_tpl_vars['customer']['phone'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['phone_short']; ?>
.:<td  colspan=3><?php echo $this->_tpl_vars['customer']['phone']; ?>
</td>
                </tr>
       		<?php endif; ?>
                <?php if ($this->_tpl_vars['customer']['fax'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['fax']; ?>
.:<td  colspan=3><?php echo $this->_tpl_vars['customer']['fax']; ?>
</td>
                </tr>
       		<?php endif; ?>
                <?php if ($this->_tpl_vars['customer']['mobile_phone'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['mobile_short']; ?>
.:<td  colspan=3><?php echo $this->_tpl_vars['customer']['mobile_phone']; ?>
</td>
                </tr>
       		<?php endif; ?>
                <?php if ($this->_tpl_vars['customer']['email'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['LANG']['email']; ?>
:<td  colspan=3><?php echo $this->_tpl_vars['customer']['email']; ?>
</td>
                </tr>
		<?php endif; ?>
        		<?php if ($this->_tpl_vars['customer']['custom_field1'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['customFieldLabels']['customer_cf1']; ?>
:<td  colspan=3><?php echo $this->_tpl_vars['customer']['custom_field1']; ?>
</td>
                </tr>	
				<?php endif; ?>
        		<?php if ($this->_tpl_vars['customer']['custom_field2'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['customFieldLabels']['customer_cf2']; ?>
:<td  colspan=3><?php echo $this->_tpl_vars['customer']['custom_field2']; ?>
</td>
                </tr>	
				<?php endif; ?>
        		<?php if ($this->_tpl_vars['customer']['custom_field3'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['customFieldLabels']['customer_cf3']; ?>
:<td  colspan=3><?php echo $this->_tpl_vars['customer']['custom_field3']; ?>
</td>
                </tr>	
				<?php endif; ?>
        		<?php if ($this->_tpl_vars['customer']['custom_field4'] != null): ?>
                <tr>
                        <td ><?php echo $this->_tpl_vars['customFieldLabels']['customer_cf4']; ?>
:<td  colspan=3><?php echo $this->_tpl_vars['customer']['custom_field4']; ?>
</td>
                </tr>	
				<?php endif; ?>
                
				<tr><td colspan=4></td></tr>


<!-- Customer -->


	</table>
		<table width="100%">
		<tr>
			<td colspan="6"><br /></td>
		</tr>
		
	<?php if ($_GET['style'] === 'Itemised'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template_path'])."/itemised.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if ($_GET['style'] === 'Consulting'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template_path'])."/consulting.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	
	<?php if ($_GET['style'] === 'Total'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template_path'])."/total.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	


	<tr >
		<td colspan="3"></td>
		<td align="right" colspan="2"><?php echo $this->_tpl_vars['LANG']['tax_total']; ?>
</td>
		<td align="right" ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total_tax']; ?>
</td>
	</tr>
	<tr >
		<td colspan="6" ><br></td>
	</tr>
		<tr >
		<td colspan="3"></td>
		<td align=right colspan=2><b><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['amount']; ?>
</b></td>
		<td  align=right><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total']; ?>
</u></td>
	</tr>
	<tr>
		<td colspan="6"><br /><br /></td>
	</tr>
	
		<!-- invoice details section - start -->
	<tr>
		<td colspan="6"><b><?php echo $this->_tpl_vars['preference']['pref_inv_detail_heading']; ?>
</b></td>
	</tr>
	<tr>
		<td colspan=6><i><?php echo $this->_tpl_vars['preference']['pref_inv_detail_line']; ?>
</i></td>
	</tr>
	<tr>
		<td colspan=6><?php echo $this->_tpl_vars['preference']['pref_inv_payment_method']; ?>
</td>
	</tr>
	<tr>
		<td colspan=6><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_name']; ?>
 <?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_value']; ?>
</td>
	</tr>
	<tr>
		<td colspan=7><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_name']; ?>
 <?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_value']; ?>
</td>
	</tr>
	<tr>
		<td><br></td>
	</tr>
		<tr>
		<td colspan="6"><div style="font-size:8pt;" align="center"><?php echo $this->_tpl_vars['biller']['footer']; ?>
</div></td>
	</tr>
</table>
<div id="footer"></div></div>

</body>
</html>