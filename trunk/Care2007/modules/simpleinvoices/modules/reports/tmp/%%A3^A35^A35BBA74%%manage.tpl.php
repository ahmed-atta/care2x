<?php /* Smarty version 2.6.18, created on 2007-05-23 10:33:41
         compiled from ../templates/default/invoices/manage.tpl */ ?>
<?php if ($this->_tpl_vars['invoices'] == null): ?>
	<P><em><?php echo $this->_tpl_vars['LANG']['no_invoices']; ?>
.</em></p>
<?php else: ?>

<div style="text-align:center;">
<b><?php echo $this->_tpl_vars['LANG']['manage_invoices']; ?>
</b> ::
<a href="index.php?module=invoices&view=total"><?php echo $this->_tpl_vars['LANG']['add_new_invoice']; ?>
 - <?php echo $this->_tpl_vars['LANG']['total_style']; ?>
</a> ::
<a href="index.php?module=invoices&view=itemised"><?php echo $this->_tpl_vars['LANG']['add_new_invoice']; ?>
 - <?php echo $this->_tpl_vars['LANG']['itemised_style']; ?>
</a> ::
<a href="index.php?module=invoices&view=consulting"><?php echo $this->_tpl_vars['LANG']['add_new_invoice']; ?>
 - <?php echo $this->_tpl_vars['LANG']['consulting_style']; ?>
</a>
</div><hr />


<table align="center" id="ex1" class="ricoLiveGrid manage" >
<colgroup>
	<col style='width:15%;' />
	<col style='width:5%;' />
	<col style='width:10%;' />
	<col style='width:10%;' />
	<col style='width:10%;' />
	<col style='width:10%;' />
	<col style='width:5%;' />
	<col style='width:5%;' />
	<col style='width:10%;' />
</colgroup>
<thead> 
	<tr class="sortHeader">
		<th class="noFilter sortable" ><?php echo $this->_tpl_vars['LANG']['actions']; ?>
 </th>
		<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['id']; ?>
</th>
		<th class="selectFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['biller']; ?>
</th>
		<th class="selectFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['customer']; ?>
</th>
		<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['total']; ?>
</th>
		<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['owing']; ?>
</th>
		<th class="selectFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['aging']; ?>
</th>
		<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['invoice_type']; ?>
</th>
		<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['date_upper']; ?>
</th>
	</tr>
</thead>

<?php $_from = $this->_tpl_vars['invoices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invoice']):
?>

	
	<tr class="index_table">
	<td class="index_table" nowrap>
	<!-- Quick View -->
	<a class="index_table"
	 title="<?php echo $this->_tpl_vars['LANG']['quick_view_tooltip']; ?>
 <?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
"
	 href="index.php?module=invoices&view=quick_view&submit=<?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
&invoice_style=<?php echo $this->_tpl_vars['invoice']['invoiceType']['inv_ty_description']; ?>
">
		<img src="images/common/view.png" height="16" border="-5px0" padding="-4px" valign="bottom" /><!-- print --></a>
	</a>
	
	<!-- Edit View -->
	<a class="index_table" title="<?php echo $this->_tpl_vars['LANG']['edit_view_tooltip']; ?>
 <?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
"
	 href="index.php?module=invoices&view=details&submit=<?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
&action=view&invoice_style=<?php echo $this->_tpl_vars['invoice']['invoiceType']['inv_ty_description']; ?>
">
		<img src="images/common/edit.png" height="16" border="-5px" padding="-4px" valign="bottom" /><!-- print --></a>
	</a> 
	
	<!-- Print View -->
	<a class="index_table" title="<?php echo $this->_tpl_vars['LANG']['print_preview_tooltip']; ?>
 <?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
"
	href="index.php?module=invoices&view=templates/template&submit=<?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
&action=view&location=print&invoice_style=<?php echo $this->_tpl_vars['invoice']['invoiceType']['inv_ty_description']; ?>
">
	<img src="images/common/printer.gif" height="16" border="-5px" padding="-4px" valign="bottom" /><!-- print --></a>
 
	<!-- EXPORT TO PDF -->
	<a title="<?php echo $this->_tpl_vars['LANG']['export_tooltip']; ?>
 <?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
 <?php echo $this->_tpl_vars['LANG']['export_pdf_tooltip']; ?>
"
	class="index_table" href="<?php echo $this->_tpl_vars['invoice']['url_for_pdf']; ?>
"><img src="images/common/pdf.jpg" height="16" padding="-4px" border="-5px" valign="bottom" /><!-- pdf --></a>

	<!--XLS -->
	<a title="<?php echo $this->_tpl_vars['LANG']['export_tooltip']; ?>
 <?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
<?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
 <?php echo $this->_tpl_vars['LANG']['export_xls_tooltip']; ?>
 <?php echo $this->_tpl_vars['spreadsheet']; ?>
 <?php echo $this->_tpl_vars['LANG']['format_tooltip']; ?>
"
	 class="index_table" href="index.php?module=invoices&view=templates/template&submit=<?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
&action=view&invoice_style=<?php echo $this->_tpl_vars['invoice']['invoiceType']['inv_ty_description']; ?>
&location=print&export=<?php echo $this->_tpl_vars['spreadsheet']; ?>
">
	 <img src="images/common/xls.gif" height="16" border="0" padding="-4px" valign="bottom" /><!-- $spreadsheet --></a>

	<!-- DOC -->
	<a title="<?php echo $this->_tpl_vars['LANG']['export_tooltip']; ?>
 <?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
 <?php echo $this->_tpl_vars['LANG']['export_doc_tooltip']; ?>
 <?php echo $this->_tpl_vars['word_processor']; ?>
 <?php echo $this->_tpl_vars['LANG']['format_tooltip']; ?>
"
	 class="index_table" href="index.php?module=invoices&view=templates/template&submit=<?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
&action=view&invoice_style=<?php echo $this->_tpl_vars['invoice']['invoiceType']['inv_ty_description']; ?>
&location=print&export=<?php echo $this->_tpl_vars['word_processor']; ?>
">
	 <img src="images/common/doc.png" height="16" border="0" padding="-4px" valign="bottom" /><!-- $word_processor --></a>

  <!-- Payment --><a title="<?php echo $this->_tpl_vars['LANG']['process_payment']; ?>
 <?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
"
   class="index_table" href="index.php?module=payments&view=process&submit=<?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
&op=pay_selected_invoice">$</a>
	<!-- Email -->
	<a href="index.php?module=invoices&view=email&stage=1&submit=<?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
" title="<?php echo $this->_tpl_vars['LANG']['email']; ?>
  <?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
"><img src="images/common/mail-message-new.png" height="16" border="0" padding="-4px" valign="bottom" /></a>

	</td>
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['invoice']['id']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['biller']['name']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['customer']['name']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['invoice']['total']; ?>
</td>
	<!--
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['paid_format']; ?>
</td>
	-->
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['invoice']['owing']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['overdue']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['preference']['pref_inv_wording']; ?>
</td>
	<td class="index_table"><?php echo $this->_tpl_vars['invoice']['invoice']['date']; ?>
</td>
	</tr>

									
	<?php endforeach; endif; unset($_from); ?>					

</table>
<?php endif; ?>