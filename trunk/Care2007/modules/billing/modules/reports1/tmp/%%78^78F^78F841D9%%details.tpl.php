<?php /* Smarty version 2.6.18, created on 2007-05-28 11:56:09
         compiled from ../templates/default/invoices/details.tpl */ ?>
<b>You are editing <?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['master_invoice_id']; ?>
</b>

 <hr></hr>

<form name="frmpost" action="index.php?module=invoices&view=save" method="post">

	<table align=center>
	<tr>
		<td colspan=6 align=center></td>
	</tr>
        <tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['preference']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['LANG']['number_short']; ?>
</td><td><input type=hidden name="invoice_id" value=<?php echo $this->_tpl_vars['invoice']['id']; ?>
  size=15><?php echo $this->_tpl_vars['invoice']['id']; ?>
</td>
	</tr>
	<tr>
	        <td class="details_screen"><?php echo $this->_tpl_vars['LANG']['date_formatted']; ?>
</td>
        	<td><input type="text" class="date-picker" name="date" id="date1" value='<?php echo $this->_tpl_vars['invoice']['date']; ?>
'></input></td>
	</tr>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['biller']; ?>
</td><td>
			
		<?php if ($this->_tpl_vars['billers'] == null): ?>
			<p><em><?php echo $this->_tpl_vars['LANG']['no_billers']; ?>
</em></p>
		<?php else: ?>
			<select name="biller_id">
			<?php $_from = $this->_tpl_vars['billers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['biller']):
?>
				<option <?php if ($this->_tpl_vars['biller']['id'] == $this->_tpl_vars['invoice']['biller_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['biller']['id']; ?>
"><?php echo $this->_tpl_vars['biller']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php endif; ?>
					
		</td>
	</tr>
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['customer']; ?>
</td><td>
		
			<?php if ($this->_tpl_vars['customers'] == null): ?>
	        <p><em><?php echo $this->_tpl_vars['LANG']['no_customers']; ?>
</em></p>
		
			<?php else: ?>
			
			<select name="customer_id">
			<?php $_from = $this->_tpl_vars['customers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customer']):
?>
				<option <?php if ($this->_tpl_vars['customer']['id'] == $this->_tpl_vars['invoice']['customer_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['customer']['id']; ?>
"><?php echo $this->_tpl_vars['customer']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		
			<?php endif; ?>
		
		</td>
	</tr>


<?php if ($_GET['style'] === 'Total'): ?>
		<input type=hidden name="style" value="edit_total">
	        <tr>
        	        <td colspan=6 class='details_screen'><?php echo $this->_tpl_vars['LANG']['description']; ?>
</td>
	        </tr>
	        <tr>
			<td colspan=6 ><textarea input type=text name="description0" rows=10 cols=70 WRAP=nowrap><?php echo $this->_tpl_vars['invoiceItems']['0']['description']; ?>
</textarea></td>
        	</tr>

	 <?php echo $this->_tpl_vars['customFields']['1']; ?>

	 <?php echo $this->_tpl_vars['customFields']['2']; ?>

	 <?php echo $this->_tpl_vars['customFields']['3']; ?>

	 <?php echo $this->_tpl_vars['customFields']['4']; ?>

	
		        <tr>       	         
			<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['gross_total']; ?>
</td><td><input type="text" name="unit_price" value="<?php echo $this->_tpl_vars['invoiceItems']['0']['unit_price']; ?>
" size=10 />
			<input type="hidden" name="quantity0" value="1">
			<input type="hidden" name="id0" value="<?php echo $this->_tpl_vars['invoiceItems']['0']['id']; ?>
">
			<input type="hidden" name="products0" value="<?php echo $this->_tpl_vars['invoiceItems']['0']['product_id']; ?>
">
			
			</td>
			
		</tr>
		<tr>

<?php endif; ?>

<?php if ($_GET['style'] === 'Itemised' || $_GET['style'] === 'Consulting'): ?>

     <?php if ($_GET['style'] === 'Itemised'): ?>
		<input type=hidden name="style" value="edit_itemised">
		<tr>
		<td colspan=6>
		<table>
		<tr>
        	        <td class='details_screen'><?php echo $this->_tpl_vars['LANG']['quantity_short']; ?>
</td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['description']; ?>
</td>
	        </tr>
	<?php endif; ?>

        <?php if ($_GET['style'] === 'Consulting'): ?>
		<input type=hidden name="style" value="edit_consulting">
		<tr>
		<td colspan=6>
		<table>
                <tr>
                        <td class='details_screen'><?php echo $this->_tpl_vars['LANG']['quantity_short']; ?>
</td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['item']; ?>
</td>
                </tr>
        <?php endif; ?>
			
			
	<tr>
	<td><a href="./index.php?module=invoices&view=add_invoice_item&invoice=<?php echo $this->_tpl_vars['invoice']['id']; ?>
&style=<?php echo $_GET['style']; ?>
&tax_id=<?php echo $this->_tpl_vars['invoiceItems']['0']['tax_id']; ?>
">Add Invoice Item</a></td><td></td>
	</tr>
	
<?php $_from = $this->_tpl_vars['invoiceItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['line'] => $this->_tpl_vars['invoiceItem']):
?>
		
		
	        <tr>
			<td><input type="text" name='quantity<?php echo $this->_tpl_vars['line']; ?>
' value='<?php echo $this->_tpl_vars['invoiceItem']['quantity']; ?>
' size="10">
			<input type="hidden" name='id<?php echo $this->_tpl_vars['line']; ?>
' value='<?php echo $this->_tpl_vars['invoiceItem']['id']; ?>
' size="10"> </td>
			
	                <td>
	                
	                <?php if ($this->_tpl_vars['products'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_products']; ?>
</em></p>
<?php else: ?>
	<select name="products<?php echo $this->_tpl_vars['line']; ?>
">
	<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
		<option <?php if ($this->_tpl_vars['product']['id'] == $this->_tpl_vars['invoiceItem']['product_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['product']['id']; ?>
"><?php echo $this->_tpl_vars['product']['description']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>

	                
	                
	                </td>
	        </tr>
		

	<?php if ($_GET['style'] === 'Consulting'): ?>
		

		<tr>

			<td colspan="6" class="details_screen"><?php echo $this->_tpl_vars['LANG']['description']; ?>
</td>
		<tr>
                        <td colspan="6"><textarea input type="text" name="description<?php echo $this->_tpl_vars['line']; ?>
" rows=5 cols=70 wrap="nowrap"><?php echo $this->_tpl_vars['invoiceItem']['description']; ?>
</textarea></td>
                </tr>
	
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>


	 <?php echo $this->_tpl_vars['customFields']['1']; ?>

	 <?php echo $this->_tpl_vars['customFields']['2']; ?>

	 <?php echo $this->_tpl_vars['customFields']['3']; ?>

	 <?php echo $this->_tpl_vars['customFields']['4']; ?>

			<tr>
				<td colspan=6 class='details_screen'><?php echo $this->_tpl_vars['LANG']['note']; ?>
:</td>
			</tr>
			<tr>
	             <td colspan=6 ><textarea input type=text name="note" rows=10 cols=70 WRAP=nowrap><?php echo $this->_tpl_vars['invoice']['note']; ?>
</textarea></td>
			</tr>
			

	<?php endif; ?>
	
	
	<tr>
		<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</td>
		<td>
	                         
	                         	
<?php if ($this->_tpl_vars['taxes'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_taxes']; ?>
</em></p>
<?php else: ?>
	<select name="tax_id">
	<?php $_from = $this->_tpl_vars['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
		<option <?php if ($this->_tpl_vars['tax']['tax_id'] == $this->_tpl_vars['invoiceItems']['0']['tax_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
"><?php echo $this->_tpl_vars['tax']['tax_description']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>


	</td>
	</tr>
	<td class='details_screen'><?php echo $this->_tpl_vars['LANG']['inv_pref']; ?>
</td><td>


<?php if ($this->_tpl_vars['preferences'] == null): ?>
	<p><em><?php echo $this->_tpl_vars['LANG']['no_preferences']; ?>
</em></p>
<?php else: ?>
	<select name="preference_id">
	<?php $_from = $this->_tpl_vars['preferences']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['preference']):
?>
		<option <?php if ($this->_tpl_vars['preference']['pref_id'] == $this->_tpl_vars['invoice']['preference_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['preference']['pref_id']; ?>
"><?php echo $this->_tpl_vars['preference']['pref_description']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>
	                         
	                         </td>
	                </tr>

	


        </table>
	<!-- addition close table tag to close invoice itemised/consulting if it has a note -->
	</table>

<hr></hr>
	<input type=button value='Cancel'onCLick='history.back()'>
	<input type=submit name="submit" value="<?php echo $this->_tpl_vars['LANG']['save']; ?>
">
	<input type=hidden name="max_items" value="<?php echo $this->_tpl_vars['lines']; ?>
">
</form>