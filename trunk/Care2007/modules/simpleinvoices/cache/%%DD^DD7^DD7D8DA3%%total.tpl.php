<?php /* Smarty version 2.6.18, created on 2007-06-01 15:36:35
         compiled from ../templates/invoices/export/total.tpl */ ?>

		                <table class="left" width="100%">
		<!--
                <tr>
                        <td colspan="6"><br></td>
                </td>
		-->
                <tr class="tbl1 col1" >
                        <td class="tbl1 col1 tbl1-right" colspan="6"><b><?php echo $this->_tpl_vars['LANG']['description']; ?>
</b></td>
                </tr>

	
	
			                <tr class="tbl1-left tbl1-right">
                        <td class="tbl1-left tbl1-right" colspan=6><?php echo $this->_tpl_vars['invoiceItems'][0]['description']; ?>
</td>
                </tr>
                <tr class="tbl1-left tbl1-right">
                        <td colspan=6 class="tbl1-left tbl1-right"><br></td>
                </tr>

	         
	
	<tr class="tbl1-left tbl1-right">
		<td class="tbl1-left tbl1-right" colspan="6" ><br></td>
	</tr>
	

	<tr class="tbl1-left tbl1-right">
		<td class="tbl1-left" colspan="3"></td>
		<td align="right" colspan="2"><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</td>
		<td align="right" class="tbl1-right" ><?php echo $this->_tpl_vars['preference']['pref_currency_sign']; ?>
<?php echo $this->_tpl_vars['invoice']['total']; ?>
</td>
	</tr>