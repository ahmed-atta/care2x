<?php /* Smarty version 2.6.18, created on 2007-06-28 15:09:09
         compiled from ../templates/invoices/default/template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'merge_address', '../templates/invoices/default/template.tpl', 106, false),array('function', 'print_if_not_null', '../templates/invoices/default/template.tpl', 115, false),array('function', 'inv_itemised_cf', '../templates/invoices/default/template.tpl', 240, false),array('function', 'do_tr', '../templates/invoices/default/template.tpl', 241, false),)), $this); ?>
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

<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['css']; ?>
">

	<table width="100%" align="center">
			<tr>
	   				<td colspan="5"><img src="<?php echo $this->_tpl_vars['logo']; ?>
" border="0" hspace="0" align="left"></td><th align=right><span class="font1"><?php echo $this->_tpl_vars['preference']['pref_inv_heading']; ?>
</span></th>
			</tr>
			<tr>
					<td colspan=6><hr size="1"></td>
			</tr>
	</table>
	
	<!-- Summary - start -->

	<table class="right">
		<tr>
				<td class="col1 tbl1" colspan="4" ><b><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['summary']; ?>
</b></td>
		</tr>
		<tr>
				<td class="tbl1-left"><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['number_short']; ?>
:</td><td class="tbl1-right" colspan=3><?php echo $this->_tpl_vars['invoice']['id']; ?>
</td>
		</tr>
		<tr>
				<td nowrap class="tbl1-left"><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['date']; ?>
:</td><td class="tbl1-right" colspan=3><?php echo $this->_tpl_vars['invoice']['date']; ?>
</td>
		</tr>
	<!-- Show the Invoice Custom Fields if valid -->
		<?php if ($this->_tpl_vars['invoice']['custom_field1'] != null): ?>
		<tr>
				<td nowrap class="tbl1-left"><?php echo $this->_tpl_vars['customFieldLabels']['invoice_cf1']; ?>
:</td><td class="tbl1-right" colspan=3><?php echo $this->_tpl_vars['invoice']['consultant']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['invoice']['custom_field2'] != null): ?>
		<tr>
				<td nowrap class="tbl1-left"><?php echo $this->_tpl_vars['customFieldLabels']['invoice_cf2']; ?>
:</td><td class="tbl1-right" colspan=3><?php echo $this->_tpl_vars['invoice']['custom_field2']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['invoice']['custom_field3'] != null): ?>
		<tr>
				<td nowrap class="tbl1-left"><?php echo $this->_tpl_vars['customFieldLabels']['invoice_cf3']; ?>
:</td><td class="tbl1-right" colspan=3><?php echo $this->_tpl_vars['invoice']['custom_field3']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['invoice']['custom_field4'] != null): ?>
		<tr>
				<td nowrap class="tbl1-left"><?php echo $this->_tpl_vars['customFieldLabels']['invoice_cf4']; ?>
:</td><td class="tbl1-right" colspan=3><?php echo $this->_tpl_vars['invoice']['custom_field4']; ?>
</td>
		</tr>
		<?php endif; ?>

		<tr>
				<td class="tbl1-left" ><?php echo $this->_tpl_vars['LANG']['total']; ?>
: </td><td class="tbl1-right" colspan=3><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total_format']; ?>
</td>
		</tr>
		<tr>
				<td class="tbl1-left"><?php echo $this->_tpl_vars['LANG']['paid']; ?>
:</td><td class="tbl1-right" colspan=3 ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['paid_format']; ?>
</td>
		</tr>
		<?php if ($this->_tpl_vars['invoice']['owing'] < 0): ?>
		<tr>
				<td nowrap class="tbl1-left tbl1-bottom">Advance</td><td class="tbl1-right tbl1-bottom" colspan=3 ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['advance']; ?>
</td>
		</tr>
		<?php else: ?>
		<tr>
				<td nowrap class="tbl1-left tbl1-bottom"><?php echo $this->_tpl_vars['LANG']['owing']; ?>
</td><td class="tbl1-right tbl1-bottom" colspan=3 ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['owing']; ?>
</td>
		</tr>
		<?php endif; ?>


	</table>
	<!-- Summary - end -->
	
	
	<table class="left">

        <!-- Biller section - start -->
	<table class='left'>
        <tr>
                <td class="tbl1-left tbl1-bottom tbl1-top col1" border=1 cellpadding=2 cellspacing=1><b><?php echo $this->_tpl_vars['LANG']['biller']; ?>
:</b></td><td class="col1 tbl1-bottom tbl1-top tbl1-right" border=1 cellpadding=2 cellspacing=1 colspan=3><?php echo $this->_tpl_vars['biller']['name']; ?>
</td>
        </tr> 

        <?php if ($this->_tpl_vars['biller']['street_address'] != null): ?>
                <tr>
                        <td class='tbl1-left'><?php echo $this->_tpl_vars['LANG']['address']; ?>
:</td><td class='tbl1-right' align=left colspan=3><?php echo $this->_tpl_vars['biller']['street_address']; ?>
</td>
                </tr>   
        <?php endif; ?>
        <?php if ($this->_tpl_vars['biller']['street_address2'] != null): ?>
                <tr class='details_screen customer'>

                <?php if ($this->_tpl_vars['biller']['street_address'] == null): ?>
                        <td class='tbl1-left'><?php echo $this->_tpl_vars['LANG']['address']; ?>
:</td><td class='tbl1-right' align=left colspan=3><?php echo $this->_tpl_vars['biller']['street_address2']; ?>
</td>
                </tr>   
                <?php endif; ?>
                <?php if ($this->_tpl_vars['biller']['street_address'] != null): ?>
                        <td class='tbl1-left'></td><td class='tbl1-right' align=left colspan=3><?php echo $this->_tpl_vars['biller']['street_address2']; ?>
</td>
                </tr>   
                <?php endif; ?>
        <?php endif; ?>

		<?php echo smarty_function_merge_address(array('field1' => $this->_tpl_vars['biller']['city'],'field2' => $this->_tpl_vars['biller']['state'],'field3' => $this->_tpl_vars['biller']['zip_code'],'street1' => $this->_tpl_vars['biller']['street_address'],'street2' => $this->_tpl_vars['biller']['street_address2'],'class1' => "tbl1-left",'class2' => "tbl1-right",'colspan' => 3), $this);?>


         <?php if ($this->_tpl_vars['biller']['country'] != null): ?>
                </tr>
                <tr>
                        <td class='tbl1-left'></td><td class='tbl1-right' colspan="3"><?php echo $this->_tpl_vars['biller']['country']; ?>
</td>
                </tr>
       	<?php endif; ?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['LANG']['phone_short'],'field' => $this->_tpl_vars['biller']['phone'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['LANG']['fax'],'field' => $this->_tpl_vars['biller']['fax'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['LANG']['mobile_short'],'field' => $this->_tpl_vars['biller']['mobile_short'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['LANG']['email'],'field' => $this->_tpl_vars['biller']['email'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	
	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['customFieldLabels']['biller_cf1'],'field' => $this->_tpl_vars['biller']['custom_field1'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['customFieldLabels']['biller_cf2'],'field' => $this->_tpl_vars['biller']['custom_field2'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['customFieldLabels']['biller_cf3'],'field' => $this->_tpl_vars['biller']['custom_field3'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['customFieldLabels']['biller_cf4'],'field' => $this->_tpl_vars['biller']['custom_field4'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	

	<tr><td class="tbl1-top" colspan="4"> </td></tr>

<!-- Biller section - end -->






		<tr>
			<td colspan=3><br /><td>
		</tr>

	<!-- Customer section - start -->
	<tr>
		<td class="tbl1-left tbl1-top tbl1-bottom col1" ><b><?php echo $this->_tpl_vars['LANG']['customer']; ?>
:</b></td><td class="tbl1-top tbl1-bottom col1 tbl1-right" colspan=3><?php echo $this->_tpl_vars['customer']['name']; ?>
</td>
	</tr>

        <?php if ($this->_tpl_vars['customer']['attention'] != null): ?>
                <tr>
                        <td class='tbl1-left'><?php echo $this->_tpl_vars['LANG']['attention_short']; ?>
:</td><td align=left class='tbl1-right' colspan=3 ><?php echo $this->_tpl_vars['customer']['attention']; ?>
</td>
                </tr>
       <?php endif; ?>
        <?php if ($this->_tpl_vars['customer']['street_address'] != null): ?>
                <tr >
                        <td class='tbl1-left'><?php echo $this->_tpl_vars['LANG']['address']; ?>
:</td><td class='tbl1-right' align=left colspan=3><?php echo $this->_tpl_vars['customer']['street_address']; ?>
</td>
                </tr>   
        <?php endif; ?>
        <?php if ($this->_tpl_vars['customer']['street_address2'] != null): ?>
                <tr class='details_screen customer'>
                <?php if ($this->_tpl_vars['customer']['street_address'] == null): ?>
                        <td class='tbl1-left'><?php echo $this->_tpl_vars['LANG']['address']; ?>
:</td><td class='tbl1-right' align=left colspan=3><?php echo $this->_tpl_vars['customer']['street_address2']; ?>
</td>
                </tr>   
                <?php endif; ?>
                <?php if ($this->_tpl_vars['customer']['street_address'] != null): ?>
                        <td class='tbl1-left'></td><td class='tbl1-right' align=left colspan=3><?php echo $this->_tpl_vars['customer']['street_address2']; ?>
</td>
                </tr>   
                <?php endif; ?>
        <?php endif; ?>
		
		<?php echo smarty_function_merge_address(array('field1' => $this->_tpl_vars['customer']['city'],'field2' => $this->_tpl_vars['customer']['state'],'field3' => $this->_tpl_vars['customer']['zip_code'],'street1' => $this->_tpl_vars['customer']['street_address'],'street2' => $this->_tpl_vars['customer']['street_addtess2'],'class1' => "tbl1-left",'class2' => "tbl1-right",'colspan' => 3), $this);?>


         <?php if ($this->_tpl_vars['customer']['country'] != null): ?>
                </tr>
                <tr>
                        <td class='tbl1-left'></td><td class='tbl1-right' colspan=3><?php echo $this->_tpl_vars['customer']['country']; ?>
</td>
                </tr>
        <?php endif; ?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['LANG']['phone_short'],'field' => $this->_tpl_vars['customer']['phone'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['LANG']['fax'],'field' => $this->_tpl_vars['customer']['fax'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['LANG']['mobile_short'],'field' => $this->_tpl_vars['customer']['mobile_short'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['LANG']['email'],'field' => $this->_tpl_vars['customer']['email'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	
	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['customFieldLabels']['customer_cf1'],'field' => $this->_tpl_vars['customer']['custom_field1'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['customFieldLabels']['customer_cf2'],'field' => $this->_tpl_vars['customer']['custom_field2'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['customFieldLabels']['customer_cf3'],'field' => $this->_tpl_vars['customer']['custom_field3'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>

	<?php echo smarty_function_print_if_not_null(array('label' => $this->_tpl_vars['customFieldLabels']['customer_cf4'],'field' => $this->_tpl_vars['customer']['custom_field4'],'class1' => 'tbl1-left','class2' => 'tbl1-right','colspan' => 3), $this);?>


		<tr><td class="tbl1-top" colspan=4></td></tr></table>


	</table>
		<table class="left" width="100%">
		<tr  class="tbl1-left tbl1-right" >
			<td colspan="4"><br /></td>
			</tr>
	<?php if ($this->_tpl_vars['invoice']['owing'] < 0): ?>
			<tr class="tbl1-left tbl1-right">
		<td class="tbl1-left" colspan="3"></td>
		<td align="right" colspan="2">Advance</td>
		<td align="right" class="tbl1-right" ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['advance']; ?>
</td>
		</tr>
		<tr class="tbl1-left tbl1-right" >
		<td colspan="4"><br /><br /></td>
		</tr>
		<tr class="tbl1-left tbl1-right tbl1-bottom">
		<td class="tbl1-left tbl1-bottom" colspan="3"></td>
		<td class="tbl1-bottom" align=right colspan=2><b><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['amount']; ?>
</b></td>
		<td  class="tbl1-bottom tbl1-right" align=right><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['advance']; ?>
</u></td>

	</tr>
	<tr>
		<td colspan="6"><br /><br /></td>
	</tr>

	<?php else: ?>

	<?php if ($_GET['style'] === 'Itemised' || $_GET['style'] === 'Consulting'): ?>
					<tr>
			<!--	<td class="tbl1 col1" ><b><?php echo $this->_tpl_vars['LANG']['quantity_short']; ?>
</b></td> -->
				<td class="tbl1 col1" align=center colspan=2 ><b><?php echo $this->_tpl_vars['LANG']['category_tpl']; ?>
</b></td>
			<!--	<td class="tbl1 col1" align=center ><b><?php echo $this->_tpl_vars['LANG']['unit_price']; ?>
</b></td>  -->
				<td class="tbl1 col1"  align=center><b><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</b></td>
				<td class="tbl1 col1"  align=center><b><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</b></td>
				<td class="tbl1 col1" align=right colspan=2 ><b><?php echo $this->_tpl_vars['LANG']['total_uppercase']; ?>
</b></td>
			</tr>
			
				<?php $_from = $this->_tpl_vars['invoiceItems1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invoiceItem1']):
?>

			<tr class="tbl1" >
			<!--	<td class="tbl1"><?php echo $this->_tpl_vars['invoiceItem']['quantity_formatted']; ?>
</td> 
				<td class="tbl1"><?php echo $this->_tpl_vars['invoiceItem']['product']['description']; ?>
</td>
				<td class="tbl1"><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['unit_price']; ?>
</td>  -->
				<td classs="tbll" align=center colspan=2><?php echo $this->_tpl_vars['invoiceItem1']['category']; ?>
</td>
				<td class="tbl1"  align=right><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem1']['gross_total']; ?>
</td>
				<td class="tbl1"  align=right><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem1']['tax_amount']; ?>
</td>
				<td class="tbl1" align=right colspan=2><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem1']['total']; ?>
</td>
			</tr>
                <tr>
                        <td class="tbl1-left"></td><td class="tbl1-right" colspan="5">
                                                <table width="100%">
                                                        <tr>

				<!--	<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf1'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field1']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 1,'class' => "blank-class"), $this);?>
 
					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf2'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field2']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 2,'class' => "blank-class"), $this);?>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf3'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field3']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 3,'class' => "blank-class"), $this);?>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf4'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field4']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 4,'class' => "blank-class"), $this);?>
  -->
               

                                                        </tr>
                                                </table>
                                </td>
                 </tr>
             	<?php endforeach; endif; unset($_from); ?>
             	
	<?php endif; ?>

<!--	<?php if ($_GET['style'] === 'Consulting'): ?>
				<tr class="tbl1 col1">
			<td class="tbl1"><b><?php echo $this->_tpl_vars['LANG']['quantity_short']; ?>
</b></td>
			<td class="tbl1"><b><?php echo $this->_tpl_vars['LANG']['item']; ?>
</b></td>
			<td class="tbl1"><b><?php echo $this->_tpl_vars['LANG']['unit_price']; ?>
</b></td>
			<td class="tbl1"><b><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</b></td><td class="tbl1"><b><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</b></td>
			<td align="right" class="tbl1"><b><?php echo $this->_tpl_vars['LANG']['total_uppercase']; ?>
</b></td>
		</tr>
		
			<?php $_from = $this->_tpl_vars['invoiceItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invoiceItem']):
?>
	
	
				<tr class="tbl1-left tbl1-right">
				<td class="tbl1-left" ><?php echo $this->_tpl_vars['invoiceItem']['quantity_formatted']; ?>
</td>
				<td><?php echo $this->_tpl_vars['invoiceItem']['product']['description']; ?>
</td><td class="tbl1-right" colspan="5"></td>
			</tr>
			
                <tr>       
                        <td class="tbl1-left"></td><td class="tbl1-right" colspan="6">
                                                <table width="100%">
                                                        <tr>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf1'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field1']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 1,'class' => "blank-class"), $this);?>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf2'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field2']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 2,'class' => "blank-class"), $this);?>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf3'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field3']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 3,'class' => "blank-class"), $this);?>

					<?php echo smarty_function_inv_itemised_cf(array('label' => $this->_tpl_vars['customFieldLabels']['product_cf4'],'field' => $this->_tpl_vars['invoiceItem']['product']['custom_field4']), $this);?>

					<?php echo smarty_function_do_tr(array('number' => 4,'class' => "blank-class"), $this);?>


                                                        </tr>
                                                </table>
                                </td>
                 </tr>
	
			<tr class="tbl1-left tbl1-right">
				<td class="tbl1-left"></td>
				<td class="tbl1-right" colspan=6><i><?php echo $this->_tpl_vars['LANG']['description']; ?>
: </i><?php echo $this->_tpl_vars['invoiceItem']['description']; ?>
</td>
			</tr>
			<tr class="tbl1-left tbl1-right tbl1-bottom">
				<td class="tbl1-left tbl1-bottom" ></td>
				<td class="tbl1-bottom"></td>
				<td class="tbl1-bottom"><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['unit_price']; ?>
</td>
				<td class="tbl1-bottom"><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['gross_total']; ?>
</td>
				<td class="tbl1-bottom "><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['tax_amount']; ?>
</td>
				<td align=right colspan=2 class="tbl1-right tbl1-bottom"><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['total']; ?>
</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
			
			
	<?php endif; ?>  -->
	
	<?php if ($_GET['style'] === 'Total'): ?>
		                <table class="left" width="100%">

                <tr class="tbl1 col1" >
                        <td class="tbl1 col1 tbl1-right" colspan="6"><b><?php echo $this->_tpl_vars['LANG']['description']; ?>
</b></td>
                </tr>
                
          <?php $_from = $this->_tpl_vars['invoiceItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invoiceItem']):
?>

			                <tr class="tbl1-left tbl1-right">
                        <td class="tbl1-left tbl1-right" colspan=6><?php echo $this->_tpl_vars['invoiceItem']['description']; ?>
</td>
                </tr>
                <tr class="tbl1-left tbl1-right">
                        <td colspan=6 class="tbl1-left tbl1-right"><br></td>
                </tr>

		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	






<?php if (( $_GET['style'] === 'Itemised' && $this->_tpl_vars['invoice']['note'] != "" ) || ( $_GET['style'] === 'Consulting' && $this->_tpl_vars['invoice']['note'] != "" )): ?>

		<tr>
			<td class="tbl1-left tbl1-right" colspan="7"><br></td>
		</tr>
		<tr>
			<td class="tbl1-left tbl1-right" colspan="7" align="left"><b><?php echo $this->_tpl_vars['LANG']['notes']; ?>
:</b></td>
		</tr>
		<tr>
			<td class="tbl1-left tbl1-right" colspan="7"><?php echo $this->_tpl_vars['invoice']['note']; ?>
</td>
		</tr>

<?php endif; ?>


	<tr class="tbl1-left tbl1-right">
		<td class="tbl1-left tbl1-right" colspan="6" ><br></td>
	</tr>
	
	<?php if ($_GET['style'] === 'Total'): ?>
		<tr class="tbl1-left tbl1-right">
		<td class="tbl1-left" colspan="3"></td>
		<td align="right" colspan="2"><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</td>
		<td align="right" class="tbl1-right" ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['gross_total']; ?>
</td>
	</tr>
	<?php endif; ?>
	
	
		<tr class="tbl1-left tbl1-right">
		<td class="tbl1-left" colspan="3"></td>
		<td align="right" colspan="2"><?php echo $this->_tpl_vars['LANG']['tax_total']; ?>
</td>
		<td align="right" class="tbl1-right" ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total_tax']; ?>
</td>
	</tr>
	<tr class="tbl1-left tbl1-right">
		<td class="tbl1-left tbl1-right" colspan="6" ><br></td>
	</tr>
		<tr class="tbl1-left tbl1-right tbl1-bottom">
		<td class="tbl1-left tbl1-bottom" colspan="3"></td>
		<td class="tbl1-bottom" align=right colspan=2><b><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['amount']; ?>
</b></td>
		<td  class="tbl1-bottom tbl1-right" align=right><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total']; ?>
</u></td>
	</tr>
	<tr>
		<td colspan="6"><br /><br /></td>
	</tr>
<?php endif; ?>
	
		<!-- invoice details section - start -->
	<tr>
		<td class="tbl1 col1" colspan="6"><b><?php echo $this->_tpl_vars['preference']['pref_inv_detail_heading']; ?>
</b></td>
	</tr>
	<tr>
		<td class="tbl1-left tbl1-right" colspan=6><i><?php echo $this->_tpl_vars['preference']['pref_inv_detail_line']; ?>
</i></td>
	</tr>
	<tr>
		<td class="tbl1-left tbl1-right" colspan=6><?php echo $this->_tpl_vars['preference']['pref_inv_payment_method']; ?>
</td>
	</tr>
	<tr>
		<td class="tbl1-left tbl1-right" colspan=6><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_name']; ?>
 <?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_value']; ?>
</td>
	</tr>
	<tr>
		<td class="tbl1-left tbl1-bottom tbl1-right" colspan=7><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_name']; ?>
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