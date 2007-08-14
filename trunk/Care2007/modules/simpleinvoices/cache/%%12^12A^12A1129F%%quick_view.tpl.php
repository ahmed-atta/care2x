<?php /* Smarty version 2.6.18, created on 2007-06-25 14:00:06
         compiled from ../templates/default/invoices/quick_view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', '../templates/default/invoices/quick_view.tpl', 303, false),)), $this); ?>
<?php echo '
	
	<script type="text/javascript">
	$(document).ready(function() {
	 // hides the customer and biller details as soon as the DOM is ready (a little sooner that page load)
	  $(\'.show-summary\').hide();
	  $(\'.biller\').hide();
	  $(\'.customer\').hide();
	  $(\'.consulting\').hide();
	  $(\'.itemised\').hide();
	  $(\'.notes\').hide();
  	});
    </script>
'; ?>



<?php echo $this->_tpl_vars['LANG']['quick_view_of']; ?>
 <?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['id']; ?>

<br>



<!--Actions heading - start-->
<?php echo $this->_tpl_vars['LANG']['actions']; ?>
: 
		<a href="index.php?module=invoices&view=templates/template&submit=<?php echo $this->_tpl_vars['invoice']['id']; ?>
&action=view&style=<?php echo $this->_tpl_vars['invoice_type']['inv_ty_description']; ?>
" target="blank"> <?php echo $this->_tpl_vars['LANG']['print_preview']; ?>
</a>
		 :: 
		<a href="index.php?module=invoices&view=details&submit=<?php echo $this->_tpl_vars['invoice']['id']; ?>
&action=view&style=<?php echo $this->_tpl_vars['invoice_type']['inv_ty_description']; ?>
"> <?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a>
		 ::
		 <a href='index.php?module=payments&view=process&submit=<?php echo $this->_tpl_vars['invoice']['id']; ?>
&op=pay_selected_invoice'> <?php echo $this->_tpl_vars['LANG']['process_payment']; ?>
 </a>
		 ::
		 <!-- EXPORT TO PDF -->
		<a href='<?php echo $this->_tpl_vars['url_for_pdf']; ?>
'><?php echo $this->_tpl_vars['LANG']['export_pdf']; ?>
</a>
		::
		<a href="index.php?module=invoices&view=templates/template&submit=<?php echo $this->_tpl_vars['invoice']['id']; ?>
&action=view&style=<?php echo $this->_tpl_vars['invoice_type']['inv_ty_description']; ?>
&export=<?php echo $this->_tpl_vars['spreadsheet']; ?>
"><?php echo $this->_tpl_vars['LANG']['export_as']; ?>
 .<?php echo $this->_tpl_vars['spreadsheet']; ?>
</a>
		::
		<a href="index.php?module=invoices&view=templates/template&submit=<?php echo $this->_tpl_vars['invoice']['id']; ?>
&action=view&style=<?php echo $this->_tpl_vars['invoice_type']['inv_ty_description']; ?>
&export=<?php echo $this->_tpl_vars['word_processor']; ?>
"><?php echo $this->_tpl_vars['LANG']['export_as']; ?>
 .<?php echo $this->_tpl_vars['word_processor']; ?>
 </a>
		:: <a href="index.php?module=invoices&view=email&stage=1&submit=<?php echo $this->_tpl_vars['invoice']['id']; ?>
"><?php echo $this->_tpl_vars['LANG']['email']; ?>
</a>
<!--Actions heading - start-->
<hr></hr>
</form>
<!-- #PDF end -->

	<table align=center>
	<tr>
		<td class=account colspan=8><?php echo $this->_tpl_vars['LANG']['account_info']; ?>
</td><td width=5%></td><td class="columnleft" width=5%></td><td class="account" colspan=6><a href='index.php?module=customers&view=details&submit=$customer.id&action=view'><?php echo $this->_tpl_vars['LANG']['customer_account']; ?>
</a></td>
	</tr>
	<tr>
		<td class=account><?php echo $this->_tpl_vars['LANG']['total']; ?>
:</td><td class=account><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total']; ?>
</td>
		<td class=account><a href='index.php?module=payments&view=manage&id=$invoice.id'><?php echo $this->_tpl_vars['LANG']['paid']; ?>
:</a></td><td class=account><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['paid_format']; ?>
</td>
		<?php if ($this->_tpl_vars['invoice']['owing'] < 0): ?>
		<td class=account>Advance:</td><td class=account><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['advance']; ?>
</u></td>
		<?php else: ?>
		<td class=account><?php echo $this->_tpl_vars['LANG']['owing']; ?>
:</td><td class=account><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['owing']; ?>
</u></td>
		<?php endif; ?>
		<td class=account><?php echo $this->_tpl_vars['LANG']['age']; ?>
:</td><td class=account nowrap ><?php echo $this->_tpl_vars['invoice_age']; ?>
 <a href='docs.php?p=age&t=help' rel='gb_page_center.450, 450'><img src="./images/common/help-small.png"></img></a></td>
		<td></td><td class="columnleft"></td>
		<td class="account"><?php echo $this->_tpl_vars['LANG']['total']; ?>
:</td><td class=account><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total_format']; ?>
</td>
		<td class=account><a href='index.php?module=payments&view=manage&c_id=$customer.id'><?php echo $this->_tpl_vars['LANG']['paid']; ?>
:</a></td><td class=account><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['paid_format']; ?>
</td>
		<?php if ($this->_tpl_vars['invoice']['owing'] < 0): ?>
		<td class=account>Advance:</td><td class=account><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['advance']; ?>
</u></td>
		<?php else: ?>
		<td class=account><?php echo $this->_tpl_vars['LANG']['owing']; ?>
:</td><td class=account><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['owing']; ?>
</u></td>
		<?php endif; ?>
	</tr>
	</table>


	<table align=center>
	<tr>
		<td colspan=6 align=center class="align_center"><b><?php echo $this->_tpl_vars['preference']['pref_inv_heading']; ?>
</b></td>
	</tr>
        <tr>
                <td colspan=6><br></td>
        </tr>

	<!-- Invoice Summary section -->

	<tr class='details_screen'>
		<td class='details_screen'><b><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['summary']; ?>
:</b></td><td colspan=5 align=right class='details_screen align_right'><a href='#' class="show-summary" onClick="$('.summary').show();$('.show-summary').hide();"><?php echo $this->_tpl_vars['LANG']['show_details']; ?>
</a><a href='#' class="summary" onClick="$('.summary').hide();$('.show-summary').show();"><?php echo $this->_tpl_vars['LANG']['hide_details']; ?>
</a> </td>
	</tr>
	<tr class='details_screen summary'>
		<td class='details_screen'><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['number_short']; ?>
:</td><td colspan=5 class='details_screen'><?php echo $this->_tpl_vars['invoice']['id']; ?>
</td>
	</tr>
	<tr class='details_screen summary'>
		<td class='details_screen'><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['date']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['invoice']['date']; ?>
</td>
	</tr>
	<?php echo $this->_tpl_vars['customFiled']['1']; ?>

	<?php echo $this->_tpl_vars['customFiled']['2']; ?>

	<?php echo $this->_tpl_vars['customFiled']['3']; ?>

	<?php echo $this->_tpl_vars['customFiled']['4']; ?>


	<tr>	
		<td><br></td>
	</tr>
	<!-- Biller section -->


	<tr class='details_screen'>
		<td class='details_screen'><b><?php echo $this->_tpl_vars['LANG']['biller']; ?>
:</b></td><td class='details_screen' colspan=3><?php echo $this->_tpl_vars['biller']['name']; ?>
</b></td><td colspan=2 align=right class='details_screen align_right'><a href='#' class="show-biller" onClick="$('.biller').show();$('.show-biller').hide();"><?php echo $this->_tpl_vars['LANG']['show_details']; ?>
</a><a href='#' class="biller" onClick="$('.biller').hide();$('.show-biller').show();"><?php echo $this->_tpl_vars['LANG']['hide_details']; ?>
</a></td>
	</tr>
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['street']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['biller']['street_address']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['street2']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['biller']['street_address2']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['city']; ?>
:</td><td class='details_screen' colspan=3><?php echo $this->_tpl_vars['biller']['city']; ?>
</td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['phone_short']; ?>
:</td><td class='details_screen'><?php echo $this->_tpl_vars['biller']['phone']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['state']; ?>
, Zip:</td><td class='details_screen' colspan=3><?php echo $this->_tpl_vars['biller']['state']; ?>
, <?php echo $this->_tpl_vars['biller']['zip_code']; ?>
</td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['mobile_short']; ?>
:</td><td class='details_screen'><?php echo $this->_tpl_vars['biller']['mobile_phone']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['country']; ?>
:</td><td class='details_screen' colspan=3><?php echo $this->_tpl_vars['biller']['country']; ?>
</td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['fax']; ?>
:</td><td class='details_screen'><?php echo $this->_tpl_vars['biller']['fax']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['email']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['biller']['email']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['biller_cf1']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['biller']['custom_field1']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['biller_cf2']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['biller']['custom_field2']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['biller_cf3']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['biller']['custom_field3']; ?>
</td>
	</tr>	
	<tr class='details_screen biller'>
		<td class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['biller_cf4']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['biller']['custom_field4']; ?>
</td>
	</tr>	
	<tr >
		<td colspan=5><br></td>
	</tr>	
	
	<!-- Customer section -->
	<tr class='details_screen'
		<td class='details_screen'><b><?php echo $this->_tpl_vars['LANG']['customer']; ?>
:</b></td><td class='details_screen' colspan=3><?php echo $this->_tpl_vars['customer']['name']; ?>
</td><td colspan=2 align=right class='details_screen align_right'><a href='#' class="show-customer" <?php echo ' onClick="$(\'.customer\').show(); $(\'.show-customer\').hide(); '; ?>
"><?php echo $this->_tpl_vars['LANG']['show_details']; ?>
</a> <a href='#' class="customer" <?php echo ' onClick="$(\'.customer\').hide(); $(\'.show-customer\').show(); '; ?>
"><?php echo $this->_tpl_vars['LANG']['hide_details']; ?>
</a></td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['attention_short']; ?>
:</td><td class='details_screen' colspan=5 align=left><?php echo $this->_tpl_vars['customer']['attention']; ?>
,</td>
	</tr>
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['street']; ?>
:</td><td class='details_screen' colspan=5 align=left><?php echo $this->_tpl_vars['customer']['street_address']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['street2']; ?>
:</td><td class='details_screen' colspan=5 align=left><?php echo $this->_tpl_vars['customer']['street_address2']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['city']; ?>
:</td><td class='details_screen' colspan=3><?php echo $this->_tpl_vars['customer']['city']; ?>
</td><td class='details_screen'>Ph:</td><td class='details_screen'><?php echo $this->_tpl_vars['customer']['phone']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['state']; ?>
, ZIP:</td><td colspan=3 class='details_screen'><?php echo $this->_tpl_vars['customer']['state']; ?>
, <?php echo $this->_tpl_vars['customer']['zip_code']; ?>
</td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['fax']; ?>
:</td><td class='details_screen'><?php echo $this->_tpl_vars['customer']['fax']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['country']; ?>
:</td><td class='details_screen' colspan=3><?php echo $this->_tpl_vars['customer']['country']; ?>
</td><td class='details_screen'>Mobile:</td><td class='details_screen'><?php echo $this->_tpl_vars['customer']['mobile_phone']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['email']; ?>
:</td><td class='details_screen'colspan=5><?php echo $this->_tpl_vars['customer']['email']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['customer_cf1']; ?>
:</td><td colspan=5 class='details_screen'><?php echo $this->_tpl_vars['customer']['custom_field1']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['customer_cf2']; ?>
:</td><td colspan=5 class='details_screen'><?php echo $this->_tpl_vars['customer']['custom_field2']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['customer_cf3']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['customer']['custom_field3']; ?>
</td>
	</tr>	
	<tr class='details_screen customer'>
		<td class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['customer_cf4']; ?>
:</td><td class='details_screen' colspan=5><?php echo $this->_tpl_vars['customer']['custom_field4']; ?>
</td>
	</tr>	


<hr></hr>

<?php if ($this->_tpl_vars['invoice']['owing'] < 0): ?>
		<tr>
	                <td colspan=6><br></td>
        	</tr>
		<tr>
        	        <td colspan=6><br></td>
	        </tr>
		 <tr>
	                <td></td><td></td><td></td><td><b>Advance</b></td><td></td><td><b><?php echo $this->_tpl_vars['LANG']['total_uppercase']; ?>
</b></td>
        	</tr>
		 <tr>
        	        <td></td><td></td><td></td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['advance']; ?>
</td><td></td><td><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['advance']; ?>
</u></td>
	        </tr>
		<tr>
	                <td colspan=6><br></td>
        	</tr>
		<tr>
        	        <td colspan=6><br></td>
	        </tr>
		<tr>
                <td colspan=3></td><td align=left colspan=2><b><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['amount']; ?>
</b></td><td colspan=2 align=right><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['advance']; ?>
</u></td>
        </tr>
<?php else: ?>


<?php if ($_GET['style'] === 'Total'): ?>


	        <tr>
	                <td colspan=6><br></td>
        	</tr>
	        <tr>
        	        <td colspan=6><b><?php echo $this->_tpl_vars['LANG']['description']; ?>
</b></td>
	        </tr>
	        <tr>
	                <td colspan=6><?php echo $this->_tpl_vars['invoiceItems']['0']['description']; ?>
</td>
        	</tr>
	        <tr>
        	        <td colspan=6><br></td>
	        </tr>
	        <tr>
	                <td></td><td></td><td></td><td><b><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['total_uppercase']; ?>
</b></td>
        	</tr>
	        <tr>
        	        <td></td><td></td><td></td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItems']['0']['gross_total']; ?>
</td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItems']['0']['tax_amount']; ?>
</td><td><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItems']['0']['total']; ?>
</u></td>
	        </tr>

        	<tr>
                	<td colspan=6><br><br></td>
	        </tr>
        	<tr>
                	<td colspan=6><b><?php echo $this->_tpl_vars['preference']['pref_inv_detail_heading']; ?>
</b></td>
	        </tr>

   

<?php endif; ?>


<?php if ($_GET['style'] === 'Itemised' || $_GET['style'] === 'Consulting'): ?>

        <tr>
                <td colspan=6><br></td>
        </tr>
	
     <?php if ($_GET['style'] === 'Itemised'): ?>
        	
		<tr>
		<td colspan="6">
		<table width="100%">
                        <tr>
                                <td colspan="5"></td>
                                <td class="details_screen"><a href='#' align=right class="show-itemised" onClick="$('.itemised').show();$('.show-itemised').hide();"><?php echo $this->_tpl_vars['LANG']['show_details']; ?>
</a><a href='#' class="itemised" onClick="$('.itemised').hide();$('.show-itemised').show();"><?php echo $this->_tpl_vars['LANG']['hide_details']; ?>
</a> 
                      
			<tr>
        		       <td><b><?php echo $this->_tpl_vars['LANG']['quantity_short']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['description']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['unit_price']; ?>
</b><td><b><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['total_uppercase']; ?>
</b></td>  
		<!--	<td><b><?php echo $this->_tpl_vars['LANG']['category_tpl']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['total_uppercase']; ?>
</b></td>  -->
		        </tr>
	<?php endif; ?>


    <?php if ($_GET['style'] === 'Consulting'): ?>
		<tr>
		<td colspan=6>
		<table width=100%> 
			<tr>
				<td colspan=6></td>
				<td class='details_screen'><a href='#' align=right class="show-consulting" onClick="$('.consulting').show();$('.show-consulting').hide();"><?php echo $this->_tpl_vars['LANG']['show_details']; ?>
</a><a href='#' class="consulting" onClick="$('.consulting').hide();$('.show-consulting').show();"><?php echo $this->_tpl_vars['LANG']['hide_details']; ?>
</a> 
        	        <tr>
               	 	       <td><b><?php echo $this->_tpl_vars['LANG']['quantity_short']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['item']; ?>
</b></td><td class=show-consulting><b><?php echo $this->_tpl_vars['LANG']['description']; ?>
</b></td><td class='consulting'></td><td><b><?php echo $this->_tpl_vars['LANG']['unit_price']; ?>
</b><td><b><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</b></td><td><b><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</b></td><td align=right><b><?php echo $this->_tpl_vars['LANG']['total_uppercase']; ?>
</b></td>
	                </tr>
        <?php endif; ?>


		<?php $_from = $this->_tpl_vars['invoiceItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invoiceItem']):
?>
	
			
		<?php if ($_GET['style'] === 'Itemised'): ?>
	
		        <tr>
	               <td><?php echo $this->_tpl_vars['invoiceItem']['quantity']; ?>
</td><td><?php echo $this->_tpl_vars['invoiceItem']['product']['description']; ?>
</td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['unit_price']; ?>
</td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['gross_total']; ?>
</td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['tax_amount']; ?>
</td><td><?php echo $this->_tpl_vars['invoiceItem']['total']; ?>
</td> 
		        </tr>
                <tr  class='itemised' >       
                        <td></td>
				<td colspan=5>
					<table width=100%>
					<tr>
						<td width=50% class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['product_cf1']; ?>
: <?php echo $this->_tpl_vars['invoiceItem']['product']['custom_field1']; ?>
</td><td width="50%" class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['product_cf2']; ?>
:
<?php echo $this->_tpl_vars['invoiceItem']['product']['custom_field2']; ?>
</td>
                 			</tr>
			                <tr class='itemised' >       
			                       <td width=50% class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['product_cf3']; ?>
:
	<?php echo $this->_tpl_vars['invoiceItem']['product']['custom_field3']; ?>
</td><td width=50% class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['product_cf4']; ?>
:
	<?php echo $this->_tpl_vars['invoiceItem']['product']['custom_field4']; ?>
</td>
			                 </tr>
					</table>
				</td>
		</tr> 
		
	<?php endif; ?>	
	

	<?php if ($_GET['style'] === 'Consulting'): ?>
		


        	<tr>
	                <td><?php echo $this->_tpl_vars['invoiceItem']['quantity']; ?>
</td><td><?php echo $this->_tpl_vars['invoiceItem']['product']['description']; ?>
</td><td class='show-consulting'>
	                <?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceItem']['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, "...") : smarty_modifier_truncate($_tmp, "...")); ?>

	                
	                </td><td class='consulting'></td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['unit_price']; ?>
</td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['gross_total']; ?>
</td><td><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['tax_amount']; ?>
</td><td align=right><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoiceItem']['total']; ?>
</td>
		</tr>
		<tr  class='consulting' >	
                        <td></td>
                                <td colspan=6>
                                        <table width=100%>
                                        <tr>
                                                <td width=50% class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['product_cf1']; ?>
: <?php echo $this->_tpl_vars['invoiceItem']['product']['custom_field1']; ?>
</td><td width=50% class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['product_cf2']; ?>
: <?php echo $this->_tpl_vars['invoiceItem']['product']['custom_field2']; ?>
</td>
                                        </tr>
                                        <tr>       
                                               <td width=50% class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['product_cf3']; ?>
: <?php echo $this->_tpl_vars['invoiceItem']['product']['custom_field3']; ?>
</td><td width=50% class='details_screen'><?php echo $this->_tpl_vars['customFieldLabels']['product_cf4']; ?>
: <?php echo $this->_tpl_vars['invoiceItem']['product']['custom_field4']; ?>
</td>
                                         </tr>
                                        </table>
                                </td>
	<!--		<td></td><td colspan=6 class='details_screen consulting'><?php echo $this->_tpl_vars['prod_custom_field_label1']; ?>
: <?php echo $this->_tpl_vars['product']['custom_field1']; ?>
, <?php echo $this->_tpl_vars['prod_custom_field_label2']; ?>
: <?php echo $this->_tpl_vars['product']['custom_field2']; ?>
, <?php echo $this->_tpl_vars['prod_custom_field_label3']; ?>
: <?php echo $this->_tpl_vars['product']['custom_field3']; ?>
, <?php echo $this->_tpl_vars['prod_custom_field_label4']; ?>
: <?php echo $this->_tpl_vars['product']['custom_field4']; ?>
</td> -->
		 </tr>
		 
		<?php if ($this->_tpl_vars['invoiceItem']['description'] != null): ?>
			<tr  class='consulting' >	
				<td></td><td colspan=6 class='details_screen consulting'><?php echo $this->_tpl_vars['LANG']['description']; ?>
:<br><?php echo $this->_tpl_vars['invoiceItem']['description']; ?>
</td>
			 </tr>
		<?php endif; ?>
	<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>




	<?php if (( $_GET['style'] === 'Itemised' && $this->_tpl_vars['invoice']['note'] != null ) || 'Consulting' && $this->_tpl_vars['invoice']['note'] != null): ?>




			</table>
			</td></tr>
			<tr>
				<td></td>
			</tr>
			<tr class='details_screen'>
				<td colspan=5><b><?php echo $this->_tpl_vars['LANG']['notes']; ?>
:</b></td><td align=right class='details_screen'><a href='#' align=right class="show-notes" onClick="$('.notes').show();$('.show-notes').hide();"><?php echo $this->_tpl_vars['LANG']['show_details']; ?>
</a><a href='#' class="notes" onClick="$('.notes').hide();$('.show-notes').show();"><?php echo $this->_tpl_vars['LANG']['hide_details']; ?>
</a> 
</td>
			</tr>
			<!-- if hide detail click - the stripped note will be displayed -->
			<tr class='show-notes details_screen'>
				<td colspan=6><?php echo ((is_array($_tmp=$this->_tpl_vars['invoice']['note'])) ? $this->_run_mod_handler('truncate', true, $_tmp, "...") : smarty_modifier_truncate($_tmp, "...")); ?>
</td>
			</tr>
			<!-- if show detail click - the full note will be displayed -->
			<tr class='notes details_screen'>
				<td colspan=6><?php echo $this->_tpl_vars['invoice']['note']; ?>
</td>
			</tr>

	<?php endif; ?>
	
	


	<tr>
		<td colspan=6><br></td>
	</tr>	

        <tr>
                <td colspan=3></td><td align=left colspan=2><?php echo $this->_tpl_vars['LANG']['total']; ?>
 <?php echo $this->_tpl_vars['LANG']['tax']; ?>
 <?php echo $this->_tpl_vars['LANG']['included']; ?>
</td><td colspan=2 align=right><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total_tax']; ?>
</td>
        </tr>
	<tr><td><br></td>
	</tr>
        <tr>
                <td colspan=3></td><td align=left colspan=2><b><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['amount']; ?>
</b></td><td colspan=2 align=right><u><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total']; ?>
</u></td>
        </tr>


	<tr>
		<td colspan=6><br><br></td>
	</tr>	
	<tr>
		<td colspan=6><b><?php echo $this->_tpl_vars['preference']['pref_inv_detail_heading']; ?>
</b></td>
	</tr>
<?php endif; ?>

<?php endif; ?>
	<?php if ($this->_tpl_vars['invoice']['owing'] < 0): ?>
	
	<tr>
		<td colspan=6><br><br></td>
	</tr>

	<tr>
		<td colspan=6><b><?php echo $this->_tpl_vars['preference']['pref_inv_detail_heading']; ?>
</b></td>
	</tr>
	<?php endif; ?>

        <tr>
                <td colspan=6><i><?php echo $this->_tpl_vars['preference']['pref_inv_detail_line']; ?>
</i></td>
        </tr>
	<tr>
		<td colspan=6><?php echo $this->_tpl_vars['preference']['pref_inv_payment_method']; ?>
</td>
        <tr>
                <td><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_name']; ?>
</td><td colspan=5><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line1_value']; ?>
</td>
        </tr>
        <tr>
                <td><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_name']; ?>
</td><td colspan=5><?php echo $this->_tpl_vars['preference']['pref_inv_payment_line2_value']; ?>
</td>
        </tr>
        </table>
	<!-- addition close table tag to close invoice itemised/consulting if it has a note -->
	</table>

<hr></hr>
	<form>
		<input type=button value="<?php echo $this->_tpl_vars['LANG']['cancel']; ?>
" onCLick="history.back()">
	</form>