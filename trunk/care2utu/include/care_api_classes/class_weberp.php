<?php
require_once('class_xmlrpc.php');
require('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
require_once($root_path.'classes/xmlrpc/lib/xmlrpc.inc');

class weberp extends xmlrpc{

	var $weberpcalls = array (
		getCustomer=>"weberp.xmlrpc_GetCustomer",
		insertCustomer=>"weberp.xmlrpc_InsertCustomer",
		insertBranch=>"weberp.xmlrpc_InsertBranch",
		modifyCustomer=>"weberp.xmlrpc_ModifyCustomer" ,
		searchCustomer=>"weberp.xmlrpc_SearchCustomers" ,
		getCurrencyList=>"weberp.xmlrpc_GetCurrencyList" ,
		getCurrencyDetails=>"weberp.xmlrpc_GetCurrencyDetails",
		getSalesTypeList=>"weberp.xmlrpc_GetSalesTypeList" ,
		getSalesTypeDetails=>"weberp.xmlrpc_GetSalesTypeDetails",
		getHoldReasonList=>"weberp.xmlrpc_GetHoldReasonList" ,
		getHoldReasonDetails=>"weberp.xmlrpc_GetHoldReasonDetails" ,
		getPaymentTermsList=>"weberp.xmlrpc_GetPaymentTermsList" ,
		getPayemtTermsDetails=>"weberp.xmlrpc_GetPaymentTermsDetails",
		insertStockItem=>"weberp.xmlrpc_InsertStockItem" ,
		modfiyStockItem=>"weberp.xmlrpc_ModifyStockItem",
		getStockItem=>"weberp.xmlrpc_GetStockItem" ,
		searchStockItems=>"weberp.xmlrpc_SearchStockItems" ,
		getStockBalance=>"weberp.xmlrpc_GetStockBalance" ,
		insertSalesInvoice=>"weberp.xmlrpc_InsertSalesInvoice" ,
		insertSalesCredit=>"weberp.xmlrpc_InsertSalesCredit" ,
		modifyBranch=>"weberp.xmlrpc_ModifyBranch"
	);

 	private $xmlrpc_obj;

	function weberp($hosturl,$usr,$pwd,$debuglvl)
	{
		$this->xmlrpc_obj = new Xmlrpc($hosturl,$usr,$pwd,$debuglvl);
	}

    function transfer_bill_to_webERP_asSalesInvoice($pid,$bill_number,$billelems)
    {
 		$billdata[ovamount]= $billelems[price]*$billelems[amount];
 	    $billdata[consignment]=$billelems[User_Id];
 		$billdata[bill_nr]= $bill_number;
 		$billdata[pid] = $pid;
 		$billdata[partcode] = $billelems[partcode];
 		$transmit = $this->xmlrpc_obj->transfer($this->generateWebERPCustSalesInvoiceData($billdata),$this->weberpcalls[insertSalesInvoice]);
 		if($transmit == 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }

    }

    function transfer_patient_to_webERP_asCustomer($pid,$persondata)
    {

    	$transmit=$this->xmlrpc_obj->transfer($this->generateWebERPCustomerData($persondata),$this->weberpcalls[insertCustomer]);
		$transmit=$this->xmlrpc_obj->transfer($this->generateWebERPCustBranchData($persondata),$this->weberpcalls[insertBranch]);

		if($transmit == 0)
	    {
	    	return true;
	    }
	    else if($transmit == 1001)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
    }

	function generateWebERPCustSalesInvoiceData($saleInvoiceData)
	{

		$webERPCustSalesInvoiceData = array (

			debtorno=>$saleInvoiceData[pid],
			branchcode=>$saleInvoiceData[pid],
			trandate=>date(d.'/'.m.'/'.Y),
			settled=>"",
			reference=>"",
			tpe=>"",
			order_=>"",
			rate=>"",
			ovamount=>$saleInvoiceData[ovamount],
			ovgst=>"",
			ovfreight=>"",
			ovdiscount=>"",
			diffonexch=>"",
			alloc=>"0",
			invtext=>"",
			shipvia=>"",
			edisent=>"",
			consignment=>$saleInvoiceData[consignment],
			partcode=>$saleInvoiceData[partcode],
			salesarea=>"2"

	);


	$webERPCustSalesInvoiceData = $this->delete_empty_data_entries($webERPCustSalesInvoiceData);

	return $webERPCustSalesInvoiceData;
	}

	function generateWebERPCustBranchData($customerdata)
	{
		$webERPCustBranchData = array (

			branchcode=>$customerdata[pid],
			debtorno=>$customerdata[pid],
			brname=>"".$customerdata[name_first]." ".$customerdata[name_last]."",
			braddress1=>"",
			braddress2=>"",
			braddress3=>"",
			braddress4=>"",
			braddress5=>"",
			braddress6=>"",
			estdeliverydays =>"",
			area=>"1",
			salesman=>"1",
			fwddate=>"",
			phoneno=>"",
			faxno=>"",
			contactname=>"",
			email=>"",
			defaultlocation=>"SEL",
			taxgroupid=>"1",
			defaultshipvia=>"",
			deliverblind=>"",
			disabletrans=>"0",
			brpostaddr1=>"",
			brpostaddr2=>"",
			brpostaddr3=>"",
			brpostaddr4=>"",
			brpostaddr5=>"",
			brpostaddr6=>"",
			specialinstructions=>"",
			custbranchcode=>"",
			vtiger_accountid=>""

		);
		$webERPCustBranchData = $this->delete_empty_data_entries($webERPCustBranchData);

		return $webERPCustBranchData;
	}

	function generateWebERPCustomerData($patientdata){
		$webERPCustomerData = array (

			debtorno=>$patientdata[pid],
			name=>"".$patientdata[name_first]." ".$patientdata[name_last]."",
			address1=>"",
			address2=>"",
			address3=>"",
			address4=>"",
			address5=>"",
			address6=>"",
			currcode=>"TZS",
			salestype=>"1",
			clientsince=>date(d.'/'.m.'/'.Y),
			holdreason=>"1",
			paymentterms=>"20",
			discount=>"",
			pymtdiscount=>"",
			lastpaid=>"",
			lastpaiddate=>"",
			creditlimit=>"",
			invaddrbranch=>"",
			discountcode=>"",
			ediinvoices=>"",
			ediorders=>"",
			edireference=>"",
			editransport=>"",
			ediaddress=>"",
			ediserveruser=>"",
			ediserverpwd=>"",
			taxref=>"",
			customerpoline => "0"

		);

		$webERPCustomerData = $this->delete_empty_data_entries($webERPCustomerData);
		return $webERPCustomerData;
	}

	function delete_empty_data_entries($data)
	{

		foreach ($data as $key => $value) {

			if ($value<>'' ||  is_numeric ($value) ) {
				$dataDetails[$key] = $value;
			}
		}
		return $dataDetails;
	}
}
?>