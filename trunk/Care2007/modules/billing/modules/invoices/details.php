<?php
#table

//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();

#get the invoice id
$master_invoice_id = $_GET['submit'];

$invoice = getInvoice($master_invoice_id);
$invoiceItems = getInvoiceItems($master_invoice_id);
$customers = getActiveCustomers();
$preference = getPreference($invoice['preference_id']);
$billers = getActiveBillers();
$taxes = getActiveTaxes();
$preferences = getActivePreferences();
$products = getActiveProducts();



for($i=1;$i<=4;$i++) {
	$customFields[$i] = show_custom_field("invoice_cf$i",$invoice["custom_field$i"],"write",'',"details_screen",'','','',$master_invoice_id);
}

$smarty -> assign("invoice",$invoice);
$smarty -> assign("invoiceItems",$invoiceItems);
$smarty -> assign("customers",$customers);
$smarty -> assign("preference",$preference);
$smarty -> assign("billers",$billers);
$smarty -> assign("taxes",$taxes);
$smarty -> assign("preferences",$preferences);
$smarty -> assign("products",$products);
$smarty -> assign("customFields",$customFields);
$smarty -> assign("lines",count($invoiceItems));

?>
