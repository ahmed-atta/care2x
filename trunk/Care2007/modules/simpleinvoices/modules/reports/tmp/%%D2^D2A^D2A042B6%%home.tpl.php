<?php /* Smarty version 2.6.18, created on 2007-05-23 10:33:45
         compiled from ../templates/default/home.tpl */ ?>

<div>
<h3><?php echo $this->_tpl_vars['title']; ?>
</h3>
<hr />

<!--
<?php if ($this->_tpl_vars['patch'] > $this->_tpl_vars['max_patches_applied']): ?>

                NOTE <a href='docs.php?t=help&p=database_patches' rel='gb_page_center[450, 450]'><img src='./images/common/help-small.png'></img></a> :   There are database patches that need to be applied, please select <a href="./index.php?module=options&view=database_sqlpatches ">'Database Upgrade Manager'</a> from the Options menu and follow the instructions<br>
<?php endif; ?>
-->

<?php if ($this->_tpl_vars['mysql'] < 5): ?>

		NOTE <a href='docs.php?t=help&p=mysql4' rel='gb_page_center[450, 450]' ><img src='./images/common/help-small.png'></img></a> : As you are using Mysql 4 some features have been disabled<br>
<?php endif; ?>

<div id="accordian">
	<div id="list1">
	<h2><img src="./images/common/reports.png"></img><?php echo $this->_tpl_vars['LANG']['stats']; ?>
</h2>
	
		<div id="item11">
			<div class="title"><?php echo $this->_tpl_vars['LANG']['stats_debtor']; ?>
</div>
			<div class="content"><?php echo $this->_tpl_vars['debtor']['Customer']; ?>
</div>
		</div>

		<div id="item12">
			<div class="title"><?php echo $this->_tpl_vars['LANG']['stats_customer']; ?>
</div>
			<div class="content"><?php echo $this->_tpl_vars['customer']['Customer']; ?>
</div>
		</div>

		<div id="item13">
			<div class="title"><?php echo $this->_tpl_vars['LANG']['stats_biller']; ?>
</div>
			<div class="content"><?php echo $this->_tpl_vars['biller']['name']; ?>
</div>
		</div>
	</div>

	<div id="list2">
	<h2><img src="./images/common/menu.png"><?php echo $this->_tpl_vars['LANG']['shortcut']; ?>
</h2>

	<div id="item21">
	<div class="mytitle"><?php echo $this->_tpl_vars['LANG']['getting_started']; ?>
</div>
		<div class="mycontent">
			<table>
				<tr>
					<td>
						<a href="docs.php?p=ReadMe#faqs-what"><img src="images/common/question.png"></img><?php echo $this->_tpl_vars['LANG']['faqs_what']; ?>
</a>
					</td>		
					<td>
						<a href="docs.php?p=ReadMe#faqs-need"><img src="images/common/question.png"></img><?php echo $this->_tpl_vars['LANG']['faqs_need']; ?>
</a>
					</td>		
				</tr>
				<tr>
					<td>
						<a href="docs.php?p=ReadMe#faqs-how"><img src="images/common/question.png"></img><?php echo $this->_tpl_vars['LANG']['faqs_how']; ?>
</a>
					</td>		
					<td>
						<a href="docs.php?p=ReadMe#faqs-types"><img src="images/common/question.png"></img><?php echo $this->_tpl_vars['LANG']['faqs_type']; ?>
</a>
					</td>		
				</tr>
			</table>
		</div>
	</div>

	<div id="item22">
	<div class="mytitle"><?php echo $this->_tpl_vars['LANG']['create_invoice']; ?>
</div>
		<div class="mycontent">
			<table>
				<tr>
					<td>
						<a href="index.php?module=invoices&view=itemised"><img src="images/common/itemised.png"></img><?php echo $this->_tpl_vars['LANG']['itemised_style']; ?>
</a>
					</td>		
					<td>
						<a href="index.php?module=invoices&view=total"><img src="images/common/total.png"></img><?php echo $this->_tpl_vars['LANG']['total_style']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=invoices&view=consulting"><img src="images/common/consulting.png"></img><?php echo $this->_tpl_vars['LANG']['consulting_style']; ?>
</a>
					</td>
				</tr>
				<tr>
					<td colspan=3 align=center class="align_center">
						<a href="docs.php?p=ReadMe#faqs-types"><img src="images/common/question.png"></img><?php echo $this->_tpl_vars['LANG']['faqs_type']; ?>
</a>
					</td>		
				</tr>
			</table>
		</div>
	</div>

	<div id="item23">
	<div class="mytitle"><?php echo $this->_tpl_vars['LANG']['manage_existing_invoice']; ?>
</div>
		<div class="mycontent">
			<table>
				<tr>
					<td align=center class="align_center">
						<a href="index.php?module=invoices&view=manage"><img src="images/common/manage.png"></img><?php echo $this->_tpl_vars['LANG']['manage_invoices']; ?>
</a>
					</td>
				</tr>
			</table>
		 </div>
	</div>

	<div id="item24">
	<div class="mytitle"><?php echo $this->_tpl_vars['LANG']['manage_data']; ?>
</div>
		<div class="mycontent">
			<table>
				 <tr>
					<td>
						<a href="index.php?module=customers&view=add"><img src="images/common/add.png"></img><?php echo $this->_tpl_vars['LANG']['insert_customer']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=billers&view=add"><img src="images/common/add.png"></img><?php echo $this->_tpl_vars['LANG']['insert_biller']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=products&view=add"><img src="images/common/add.png"></img><?php echo $this->_tpl_vars['LANG']['insert_product']; ?>
</a>
					</td>
				</tr>
				<tr>
					<td>
						<a href="index.php?module=customers&view=manage"><img src="images/common/customers.png"></img><?php echo $this->_tpl_vars['LANG']['manage_customers']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=billers&view=manage"><img src="images/common/biller.png"></img><?php echo $this->_tpl_vars['LANG']['manage_billers']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=products&view=manage"><img src="images/common/products.png"></img><?php echo $this->_tpl_vars['LANG']['manage_products']; ?>
</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
		
	<div id="item25">
	<div class="mytitle"><?php echo $this->_tpl_vars['LANG']['options']; ?>
</div>
		<div class="mycontent">
			<table>
				<tr>
					<td>
						<a href="index.php?module=system_defaults&view=manage"><img src="images/common/defaults.png"></img><?php echo $this->_tpl_vars['LANG']['system_defaults']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=tax_rates&view=manage"><img src="images/common/tax.png"></img><?php echo $this->_tpl_vars['LANG']['tax_rates']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=preferences&view=manage"><img src="images/common/preferences.png"></img><?php echo $this->_tpl_vars['LANG']['invoice_preferences']; ?>
</a>
					</td>
				</tr>
				<tr>
					<td>
						<a href="index.php?module=payment_types&view=manage"><img src="images/common/payment.png"></img><?php echo $this->_tpl_vars['LANG']['payment_types']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=options&view=database_sqlpatches"><img src="images/common/upgrade.png"></img><?php echo $this->_tpl_vars['LANG']['database_upgrade_manager']; ?>
</a>
					</td>
					<td>
						<a href="index.php?module=options&view=backup_database"><img src="images/common/backup.png"></img><?php echo $this->_tpl_vars['LANG']['backup_database']; ?>
</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
	
	<div id="item26">
	<div class="mytitle"><?php echo $this->_tpl_vars['LANG']['help']; ?>
</div>
		<div class="mycontent">
			<table>
				<tr>
					<td>
						<a href="docs.php?p=ReadMe#installation"><img src="images/common/help.png"></img><?php echo $this->_tpl_vars['LANG']['installation']; ?>
</a>
					</td>	
					<td>
						<a href="docs.php?p=ReadMe#upgrading"><img src="images/common/help.png"></img><?php echo $this->_tpl_vars['LANG']['upgrading_simple_invoices']; ?>
</a>
					</td>	
				</tr>
				<tr>
					<td class="align_center" colspan="2">
						<a href="docs.php?p=ReadMe#prepare"><img src="images/common/help.png"></img><?php echo $this->_tpl_vars['LANG']['prepare_simple_invoices']; ?>
</a>
					</td>	
				</tr>
			</table>
		</div>
	</div>
</div>
	
</div>
</div>