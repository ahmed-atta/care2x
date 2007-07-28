
<div id="Header">
	<div id="Tabs">
		<ul id="navmenu">
			<li><a href="index.php">{$LANG.home}</a></li>
			<li><a href="index.php?module=invoices&view=manage">{$LANG.invoices} +</a>
				<ul>
					<li><a href="index.php?module=invoices&view=manage">{$LANG.manage_invoices}</a></li>
					<li></li>
					<li><a href="index.php?module=invoices&view=total">{$LANG.new_invoice_total}</a></li>
					<li><a href="index.php?module=invoices&view=itemised">{$LANG.new_invoice_itemised}</a></li>
					<li><a href="index.php?module=invoices&view=consulting">{$LANG.new_invoice_consulting}</a></li>
					<li><a href="index.php?module=invoices&view=search">Search Bills</a></li>
				</ul>
			</li>
			<!--<li><a href="index.php?module=customers&view=manage">{$LANG.customers} +</a>
				<ul>
					<li><a href="index.php?module=customers&view=manage">{$LANG.manage_customers}</a></li>
					<li><a href="index.php?module=customers&view=add">{$LANG.add_customer}</a></li>
					<li><a href="index.php?module=customers&view=search">Search customer</a></li>
				</ul>
			</li>-->
			<li><a href="index.php?module=products&view=manage">{$LANG.products} +</a>
				<ul>
					<li><a href="index.php?module=products&view=manage">{$LANG.manage_products}</a></li>
					<li><a href="index.php?module=products&view=add">{$LANG.add_product}</a></li>
				</ul>
			</li>
			<li><a href="index.php?module=billers&view=manage">{$LANG.billers} +</a>
				<ul>
					<li><a href="index.php?module=billers&view=manage">{$LANG.manage_billers}</a></li>
					<li><a href="index.php?module=billers&view=add">{$LANG.add_biller}</a></li>
				</ul>
			</li>
			<li><a href="index.php?module=payments&view=manage">{$LANG.payments} +</a>
				<ul>
					<li><a href="index.php?module=payments&view=manage">{$LANG.manage_payments}</a></li>
					<li><a href="index.php?module=payments&view=process&op=pay_invoice">{$LANG.process_payment}</a></li>
				</ul>
			</li>
			<li><a href="#">{$LANG.reports} +</a>
				<ul>
					
					<li><a href="index.php?module=reports&view=report_menu">Staff Report</a></li>
					<li><a href="index.php?module=reports&view=consult_menu">Consultant Report</a></li>
					<li><a href="index.php?module=reports&view=department_menu">Department Report</a></li>
					<li><a href="index.php?module=reports&view=patient_menu">In and OutPatient Report </a></li>
					<li><a href="index.php?module=reports&view=insurance_menu">Insurance Report</a></li>
				<!--	<li><a href="index.php?module=reports&view=report_sales_total">{$LANG.sales} +</a>
						<ul>
							<li><a href="index.php?module=reports&view=report_sales_total">{$LANG.total_sales}</a></li>
						</ul>
					</li>
					<li><a href="index.php?module=reports&view=report_sales_customers_total">{$LANG.sales_by_customers} +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_sales_customers_total">{$LANG.total_sales_by_customer}</a>
							</li>
						</ul>
					</li>
					<li><a href="./index.php?module=reports&view=report_tax_total">{$LANG.tax} +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_tax_total">{$LANG.total_taxes}</a></li>
						</ul>
					</li>
					<li><a href="index.php?module=reports&view=report_products_sold_total">{$LANG.product_sales} +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_products_sold_total">{$LANG.products_sold_total}</a>
							</li>
						</ul>
					</li>
					<li><a href="./index.php?module=reports&view=report_products_sold_by_customer">{$LANG.products_by_customer} +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_products_sold_by_customer">{$LANG.products_sold_customer_total}</a>
							</li>
						</ul>
					</li>
					<li><a href="index.php?module=reports&view=report_biller_total">{$LANG.biller_sales} +</a>
						<ul>
							<li><a href="index.php?module=reports&view=report_biller_total">{$LANG.biller_sales_total}</a></li>
							<li><a href="./index.php?module=reports&view=report_biller_by_customer">{$LANG.biller_sales_by_customer_totals}</a>
							</li>
						</ul>
					</li>
					<li><a href="./index.php?module=reports&view=report_debtors_by_amount">{$LANG.debtors} +</a>
						<ul>
							<li><a href="./index.php?module=reports&view=report_debtors_by_amount">{$LANG.debtors_by_amount_owed}</a>
							</li>
							<li><a href="./index.php?module=reports&view=report_debtors_by_aging">{$LANG.debtors_by_aging_periods}</a>
							</li>
							<li><a href="./index.php?module=reports&view=report_debtors_owing_by_customer">{$LANG.total_owed_per_customer}</a>
							</li>
							<li><a href="./index.php?module=reports&view=report_debtors_aging_total">{$LANG.total_by_aging_periods}</a>
							</li>
						</ul>
					</li> -->
					<li><a href="./index.php?module=reports&view=database_log">Database Log</a></li>
				</ul>
			</li>
			<li><a href="#">{$LANG.options} +</a>
				<ul>
					<li>
						<a href="./index.php?module=system_defaults&view=manage">{$LANG.system_defaults}</a>
					</li>
					<li><a href="./index.php?module=category&view=manage">{$LANG.category} +</a>
						<ul>
					<li><a href="./index.php?module=category&view=manage">{$LANG.manage_category}</a></li>
					<li><a href="./index.php?module=category&view=add">{$LANG.add_category}</a></li>
						</ul>
					</li>
					<li>
						<a href="./index.php?module=custom_fields&view=manage">{$LANG.custom_fields_upper}</a>
					</li>
					<li></li>
					<li>
						<a href="./index.php?module=tax_rates&view=manage">{$LANG.tax_rates} +</a>
						<ul>
							<li>
								<a href="./index.php?module=tax_rates&view=manage">{$LANG.manage_tax_rates}</a>
							</li>
							<li>
								<a href="./index.php?module=tax_rates&view=add">{$LANG.add_tax_rate}</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="./index.php?module=preferences&view=manage">{$LANG.invoice_preferences} +</a>
						<ul>
							<li>
								<a href="./index.php?module=preferences&view=manage">{$LANG.manage_invoice_preferences}</a>
							</li>
							<li>
								<a href="./index.php?module=preferences&view=add">{$LANG.add_invoice_preference}</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="./index.php?module=payment_types&view=manage">{$LANG.payment_types} +</a>
						<ul>
							<li>
								<a href="./index.php?module=payment_types&view=manage">{$LANG.manage_payment_types}</a>
							</li>
							<li>
								<a href="./index.php?module=payment_types&view=add">{$LANG.add_payment_type}</a>
							</li>
						</ul>
					</li>
					<li></li>
					<li>
						<a href="./index.php?module=options&view=manage_sqlpatches">{$LANG.database_upgrade_manager}</a>
					</li>
					<li>
						<a href="./index.php?module=options&view=backup_database">{$LANG.backup_database}</a>
					</li>
<!--
					<li>
						<a href="./index.php?module=options&view=sanity_check">{$LANG.sanity_check}</a>
					</li>
-->
					<li></li>
					<li>
						<a href="docs.php?p=ReadMe">{$LANG.help} +</a>
						<ul>
							<li>
								<a href="docs.php?p=ReadMe#installation">{$LANG.installation}</a>
							</li>
							<li>
								<a href="docs.php?p=ReadMe#upgrading">{$LANG.upgrading_simple_invoices}</a>
							</li>
							<li><a href="docs.php?p=ReadMe#prepare">{$LANG.prepare_simple_invoices}</a>
							</li>
							<li><a href="docs.php?p=ReadMe#use">{$LANG.using_simple_invoices}</a>
							</li>
							<li><a href="docs.php?p=ReadMe#faqs">{$LANG.faqs}</a></li>
							<li><a href="index.php?module=options&view=help">{$LANG.get_help}</a></li>
						</ul>
					</li>
					<li><a href="index.php?module=documentation/inline_docs&view=about">{$LANG.about} +</a>
						<ul>
							<li><a href="docs.php?p=about">{$LANG.about}</a></li>
							<li><a href="docs.php?p=ChangeLog">{$LANG.change_log}</a></li>
							<li><a href="docs.php?p=Credits">{$LANG.credits}</a></li>
							<li><a href="docs.php?p=gpl">{$LANG.license}</a></li>
						</ul>
					</li>
				</ul>
			</li>
			{if $smarty.session.db_is_logged_in == null}
				<li><a href="login.php">{$LANG.login}</a></li>
			{else}
				<li><a href="logout.php">{$LANG.logout}</a></li>
			{/if}
		</ul>
			
</div id="Tabs">
</div id="Header">