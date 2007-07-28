<?php /* Smarty version 2.6.18, created on 2007-06-01 12:54:41
         compiled from ../templates/default/menu.tpl */ ?>

<div id="Header">
	<div id="Tabs">
		<ul id="navmenu">
			<li><a href="index.php"><?php echo $this->_tpl_vars['LANG']['home']; ?>
</a></li>
			<li><a href="index.php?module=invoices&view=manage"><?php echo $this->_tpl_vars['LANG']['invoices']; ?>
 +</a>
				<ul>
					<li><a href="index.php?module=invoices&view=manage"><?php echo $this->_tpl_vars['LANG']['manage_invoices']; ?>
</a></li>
					<li></li>
					<li><a href="index.php?module=invoices&view=total"><?php echo $this->_tpl_vars['LANG']['new_invoice_total']; ?>
</a></li>
					<li><a href="index.php?module=invoices&view=itemised"><?php echo $this->_tpl_vars['LANG']['new_invoice_itemised']; ?>
</a></li>
					<li><a href="index.php?module=invoices&view=consulting"><?php echo $this->_tpl_vars['LANG']['new_invoice_consulting']; ?>
</a></li>
					<li><a href="index.php?module=invoices&view=search">Search invoices</a></li>
				</ul>
			</li>
			<li><a href="index.php?module=customers&view=manage"><?php echo $this->_tpl_vars['LANG']['customers']; ?>
 +</a>
				<ul>
					<li><a href="index.php?module=customers&view=manage"><?php echo $this->_tpl_vars['LANG']['manage_customers']; ?>
</a></li>
					<li><a href="index.php?module=customers&view=add"><?php echo $this->_tpl_vars['LANG']['add_customer']; ?>
</a></li>
					<li><a href="index.php?module=customers&view=search">Search customer</a></li>
				</ul>
			</li>
			<li><a href="index.php?module=products&view=manage"><?php echo $this->_tpl_vars['LANG']['products']; ?>
 +</a>
				<ul>
					<li><a href="index.php?module=products&view=manage"><?php echo $this->_tpl_vars['LANG']['manage_products']; ?>
</a></li>
					<li><a href="index.php?module=products&view=add"><?php echo $this->_tpl_vars['LANG']['add_product']; ?>
</a></li>
				</ul>
			</li>
			<li><a href="index.php?module=billers&view=manage"><?php echo $this->_tpl_vars['LANG']['billers']; ?>
 +</a>
				<ul>
					<li><a href="index.php?module=billers&view=manage"><?php echo $this->_tpl_vars['LANG']['manage_billers']; ?>
</a></li>
					<li><a href="index.php?module=billers&view=add"><?php echo $this->_tpl_vars['LANG']['add_biller']; ?>
</a></li>
				</ul>
			</li>
			<li><a href="index.php?module=payments&view=manage"><?php echo $this->_tpl_vars['LANG']['payments']; ?>
 +</a>
				<ul>
					<li><a href="index.php?module=payments&view=manage"><?php echo $this->_tpl_vars['LANG']['manage_payments']; ?>
</a></li>
					<li><a href="index.php?module=payments&view=process&op=pay_invoice"><?php echo $this->_tpl_vars['LANG']['process_payment']; ?>
</a></li>
				</ul>
			</li>
			<li><a href="#"><?php echo $this->_tpl_vars['LANG']['reports']; ?>
 +</a>
				<ul>
					<li><a href="index.php?module=reports&view=report_sales_total"><?php echo $this->_tpl_vars['LANG']['sales']; ?>
 +</a>
						<ul>
							<li><a href="index.php?module=reports&view=report_sales_total"><?php echo $this->_tpl_vars['LANG']['total_sales']; ?>
</a></li>
						</ul>
					</li>
					<li><a href="index.php?module=reports&view=report_sales_customers_total"><?php echo $this->_tpl_vars['LANG']['sales_by_customers']; ?>
 +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_sales_customers_total"><?php echo $this->_tpl_vars['LANG']['total_sales_by_customer']; ?>
</a>
							</li>
						</ul>
					</li>
					<li><a href="./index.php?module=reports&view=report_tax_total"><?php echo $this->_tpl_vars['LANG']['tax']; ?>
 +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_tax_total"><?php echo $this->_tpl_vars['LANG']['total_taxes']; ?>
</a></li>
						</ul>
					</li>
					<li><a href="index.php?module=reports&view=report_products_sold_total"><?php echo $this->_tpl_vars['LANG']['product_sales']; ?>
 +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_products_sold_total"><?php echo $this->_tpl_vars['LANG']['products_sold_total']; ?>
</a>
							</li>
						</ul>
					</li>
					<li><a href="./index.php?module=reports&view=report_products_sold_by_customer"><?php echo $this->_tpl_vars['LANG']['products_by_customer']; ?>
 +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_products_sold_by_customer"><?php echo $this->_tpl_vars['LANG']['products_sold_customer_total']; ?>
</a>
							</li>
						</ul>
					</li>
					<li><a href="index.php?module=reports&view=report_biller_total"><?php echo $this->_tpl_vars['LANG']['biller_sales']; ?>
 +</a>
						<ul>
							<li><a href="index.php?module=reports&view=report_biller_total"><?php echo $this->_tpl_vars['LANG']['biller_sales_total']; ?>
</a></li>
							<li><a href="./index.php?module=reports&view=report_biller_by_customer"><?php echo $this->_tpl_vars['LANG']['biller_sales_by_customer_totals']; ?>
</a>
							</li>
						</ul>
					</li>
					<li><a href="./index.php?module=reports&view=report_debtors_by_amount"><?php echo $this->_tpl_vars['LANG']['debtors']; ?>
 +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_debtors_by_amount"><?php echo $this->_tpl_vars['LANG']['debtors_by_amount_owed']; ?>
</a>
							</li>
							<li><a href="./index.php?module=reports&view=report_debtors_by_aging"><?php echo $this->_tpl_vars['LANG']['debtors_by_aging_periods']; ?>
</a>
							</li>
							<li><a href="./index.php?module=reports&view=report_debtors_owing_by_customer"><?php echo $this->_tpl_vars['LANG']['total_owed_per_customer']; ?>
</a>
							</li>
							<li><a href="./index.php?module=reports&view=report_debtors_aging_total"><?php echo $this->_tpl_vars['LANG']['total_by_aging_periods']; ?>
</a>
							</li>
						</ul>
					</li>
					<li><a href="./index.php?module=reports&view=database_log">Database Log</a></li>
				</ul>
			</li>
			<li><a href="#"><?php echo $this->_tpl_vars['LANG']['options']; ?>
 +</a>
				<ul>
					<li>
						<a href="./index.php?module=system_defaults&view=manage"><?php echo $this->_tpl_vars['LANG']['system_defaults']; ?>
</a>
					</li>
					<li>
						<a href="./index.php?module=custom_fields&view=manage"><?php echo $this->_tpl_vars['LANG']['custom_fields_upper']; ?>
</a>
					</li>
					<li></li>
					<li>
						<a href="./index.php?module=tax_rates&view=manage"><?php echo $this->_tpl_vars['LANG']['tax_rates']; ?>
 +</a>
						<ul>
							<li>
								<a href="./index.php?module=tax_rates&view=manage"><?php echo $this->_tpl_vars['LANG']['manage_tax_rates']; ?>
</a>
							</li>
							<li>
								<a href="./index.php?module=tax_rates&view=add"><?php echo $this->_tpl_vars['LANG']['add_tax_rate']; ?>
</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="./index.php?module=preferences&view=manage"><?php echo $this->_tpl_vars['LANG']['invoice_preferences']; ?>
 +</a>
						<ul>
							<li>
								<a href="./index.php?module=preferences&view=manage"><?php echo $this->_tpl_vars['LANG']['manage_invoice_preferences']; ?>
</a>
							</li>
							<li>
								<a href="./index.php?module=preferences&view=add"><?php echo $this->_tpl_vars['LANG']['add_invoice_preference']; ?>
</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="./index.php?module=payment_types&view=manage"><?php echo $this->_tpl_vars['LANG']['payment_types']; ?>
 +</a>
						<ul>
							<li>
								<a href="./index.php?module=payment_types&view=manage"><?php echo $this->_tpl_vars['LANG']['manage_payment_types']; ?>
</a>
							</li>
							<li>
								<a href="./index.php?module=payment_types&view=add"><?php echo $this->_tpl_vars['LANG']['add_payment_type']; ?>
</a>
							</li>
						</ul>
					</li>
					<li></li>
					<li>
						<a href="./index.php?module=options&view=manage_sqlpatches"><?php echo $this->_tpl_vars['LANG']['database_upgrade_manager']; ?>
</a>
					</li>
					<li>
						<a href="./index.php?module=options&view=backup_database"><?php echo $this->_tpl_vars['LANG']['backup_database']; ?>
</a>
					</li>
<!--
					<li>
						<a href="./index.php?module=options&view=sanity_check"><?php echo $this->_tpl_vars['LANG']['sanity_check']; ?>
</a>
					</li>
-->
					<li></li>
					<li>
						<a href="docs.php?p=ReadMe"><?php echo $this->_tpl_vars['LANG']['help']; ?>
 +</a>
						<ul>
							<li>
								<a href="docs.php?p=ReadMe#installation"><?php echo $this->_tpl_vars['LANG']['installation']; ?>
</a>
							</li>
							<li>
								<a href="docs.php?p=ReadMe#upgrading"><?php echo $this->_tpl_vars['LANG']['upgrading_simple_invoices']; ?>
</a>
							</li>
							<li><a href="docs.php?p=ReadMe#prepare"><?php echo $this->_tpl_vars['LANG']['prepare_simple_invoices']; ?>
</a>
							</li>
							<li><a href="docs.php?p=ReadMe#use"><?php echo $this->_tpl_vars['LANG']['using_simple_invoices']; ?>
</a>
							</li>
							<li><a href="docs.php?p=ReadMe#faqs"><?php echo $this->_tpl_vars['LANG']['faqs']; ?>
</a></li>
							<li><a href="index.php?module=options&view=help"><?php echo $this->_tpl_vars['LANG']['get_help']; ?>
</a></li>
						</ul>
					</li>
					<li><a href="index.php?module=documentation/inline_docs&view=about"><?php echo $this->_tpl_vars['LANG']['about']; ?>
 +</a>
						<ul>
							<li><a href="docs.php?p=about"><?php echo $this->_tpl_vars['LANG']['about']; ?>
</a></li>
							<li><a href="docs.php?p=ChangeLog"><?php echo $this->_tpl_vars['LANG']['change_log']; ?>
</a></li>
							<li><a href="docs.php?p=Credits"><?php echo $this->_tpl_vars['LANG']['credits']; ?>
</a></li>
							<li><a href="docs.php?p=gpl"><?php echo $this->_tpl_vars['LANG']['license']; ?>
</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<?php if ($_SESSION['db_is_logged_in'] == null): ?>
				<li><a href="login.php"><?php echo $this->_tpl_vars['LANG']['login']; ?>
</a></li>
			<?php else: ?>
				<li><a href="logout.php"><?php echo $this->_tpl_vars['LANG']['logout']; ?>
</a></li>
			<?php endif; ?>
		</ul>
			
</div id="Tabs">
</div id="Header">