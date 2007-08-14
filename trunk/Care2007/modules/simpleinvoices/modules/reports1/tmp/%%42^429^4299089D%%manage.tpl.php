<?php /* Smarty version 2.6.18, created on 2007-06-01 14:31:40
         compiled from ../templates/default/payments/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', '../templates/default/payments/manage.tpl', 61, false),)), $this); ?>

<?php if ($this->_tpl_vars['payments'] == null): ?>
	<P><em><?php echo $this->_tpl_vars['LANG']['no_payments']; ?>
.</em></p>
<?php else: ?>

<?php if ($_GET['id']): ?>

	<h3><?php echo $this->_tpl_vars['LANG']['payments_filtered']; ?>
 <?php echo $_GET['id']; ?>
</h3> :: <a href='index.php?module=payments&view=process&submit=$_GET.id&op=pay_selected_invoice'><?php echo $this->_tpl_vars['LANG']['payments_filtered_invoice']; ?>
</a>

<?php elseif ($_GET['c_id']): ?>
<h3><?php echo $this->_tpl_vars['LANG']['payments_filtered_customer']; ?>
 <?php echo $_GET['c_id']; ?>
 :: <a href='index.php?module=payments&view=process&op=pay_invoice'><?php echo $this->_tpl_vars['LANG']['process_payment']; ?>
</a></h3>


<?php else: ?>

	<h3><?php echo $this->_tpl_vars['LANG']['manage_payments']; ?>
 :: <a href='index.php?module=payments&view=process&op=pay_invoice'><?php echo $this->_tpl_vars['LANG']['process_payment']; ?>
</a></h3>

<?php endif; ?>


<hr></hr>


<table align="center" class="ricoLiveGrid"  id="rico_payment" >
<colgroup>
<col style='width:10%;' />
<col style='width:10%;' />
<col style='width:10%;' />
<col style='width:15%;' />
<col style='width:10%;' />
<col style='width:10%;' />
<col style='width:10%;' />
<col style='width:10%;' />
<col style='width:15%;' />
</colgroup>
<thead>

<tr class="sortHeader">
<th class="noFilter sortable"><?php echo $this->_tpl_vars['LANG']['actions']; ?>
</th>
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['payment_id']; ?>
</th>
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['invoice_id']; ?>
</th>
<th class="selectFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['customer']; ?>
</th>
<th class="selectFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['biller']; ?>
</th>
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['amount']; ?>
</th>
<th class="index_table sortable"><?php echo $this->_tpl_vars['LANG']['notes']; ?>
</th>
<th class="selectFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['payment_type']; ?>
</th>
<th class="noFilter index_table sortable"><?php echo $this->_tpl_vars['LANG']['date_upper']; ?>
</th>
</tr>
</thead>

	<?php $_from = $this->_tpl_vars['payments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['payment']):
?>


	<tr class='index_table'>
		<td class='index_table'><a class='index_table' href='index.php?module=payments&view=details&id=<?php echo $this->_tpl_vars['payment']['id']; ?>
'><?php echo $this->_tpl_vars['LANG']['view']; ?>
</a></td>
		<td class='index_table'><?php echo $this->_tpl_vars['payment']['id']; ?>
</td>
		<td class='index_table'><?php echo $this->_tpl_vars['payment']['ac_inv_id']; ?>
</td>
		<td class='index_table'><?php echo $this->_tpl_vars['payment']['CNAME']; ?>
</td>
		<td class='index_table'><?php echo $this->_tpl_vars['payment']['BNAME']; ?>
</td>
		<td class='index_table'><?php echo $this->_tpl_vars['payment']['ac_amount']; ?>
</td>
		<td class='index_table'><?php echo ((is_array($_tmp=$this->_tpl_vars['payment']['ac_notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "...") : smarty_modifier_truncate($_tmp, 10, "...")); ?>
</td>
		<td class='index_table'><?php echo $this->_tpl_vars['payment']['description']; ?>
</td>
		<td class='index_table'><?php echo $this->_tpl_vars['payment']['ac_date']; ?>
</td>
	</tr>
	
	<?php endforeach; endif; unset($_from); ?>

	</table>
<?php endif; ?>



<br />
<div style="text-align:center;"><a href="docs.php?t=help&p=wheres_the_edit_button"
	rel="gb_page_center.450, 450"><img
	src="./images/common/help-small.png"></img> Wheres the Edit button?</a></div>