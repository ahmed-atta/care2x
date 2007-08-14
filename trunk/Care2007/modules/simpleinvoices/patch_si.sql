alter table si_account_payments add create_id varchar(60) default '';

alter table si_account_payments add billingf_ref tinyint(1) default '0';

CREATE TABLE `si_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `notes` text NOT NULL,
  `enabled` char(1) NOT NULL default '1',
  `visible` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM ;

alter table si_invoice_items add `create_id` varchar(60) default '' ;

alter table si_invoice_items add `category_id` int(11) NOT NULL default '0';

alter table si_invoices add `create_id` varchar(60) default '';

alter table si_log modify `userid` varchar(60) default '';

alter table si_products add `category_id` int(11) NOT NULL default '0';






