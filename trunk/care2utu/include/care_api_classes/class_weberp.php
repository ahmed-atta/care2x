<?php
require_once('class_xmlrpc.php');
require('./roots.php');
require_once($root_path.'include/inc_environment_global.php');

function new_weberp() {
	$cache_filename = 'object_data.inc';
	if (!file_exists(sys_get_temp_dir().'/cache')) {
		mkdir(sys_get_temp_dir().'/cache');
	}
	$cachefile_full_filename = sys_get_temp_dir().'/cache/'.$cache_filename;
	// check for cache, if it exists and is less than 1 hour old grab it
	if(file_exists($cachefile_full_filename)){
		$object_data = unserialize(file_get_contents($cachefile_full_filename));
	} else {
		// Initialise object
		$object_data = new weberp;
	} // end else
	return $object_data;
}

function destroy_weberp($obj_weberp) {
	$cache_filename = 'object_data.inc';
	$cachefile_full_filename = sys_get_temp_dir().'/cache/'.$cache_filename;
	file_put_contents($cachefile_full_filename, serialize($obj_weberp));
	return true;
}

class weberp extends xmlrpc{

	const webERPServerURL = "http://localhost/webERPtanzania/api/api_xml-rpc.php";
   	const weberpuser = "admin";
	const weberppassword = "haydom";
	const weberpDebugLevel = 2;

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
		modifyBranch=>"weberp.xmlrpc_ModifyBranch" ,
		getStockReorderLevel=>"weberp.xmlrpc_GetStockReorderLevel",
		setStockReorderLevel=>"weberp.xmlrpc_SetStockReorderLevel",
		getAllocatedStock=>"weberp.xmlrpc_GetAllocatedStock",
		getOrderedStock=>"weberp.xmlrpc_GetOrderedStock",
		setStockPrice=>"weberp.xmlrpc_SetStockPrice",
		getStockPrice=>"weberp.xmlrpc_GetStockPrice",
		getCustomerBranch=>"weberp.xmlrpc_GetCustomerBranch",
		insertSalesOrderHeader=>"weberp.xmlrpc_InsertSalesOrderHeader",
		modifySalesOrderHeader=>"weberp.xmlrpc_ModifySalesOrderHeader",
		insertSalesOrderLine=>"weberp.xmlrpc_InsertSalesOrderLine",
		modifySalesOrderLine=>"weberp.xmlrpc_ModifySalesOrderLine",
		insertGLAccount=>"weberp.xmlrpc_InsertGLAccount",
		insertGLAccountSection=>"weberp.xmlrpc_InsertGLAccountSection",
		insertGLAccountGroup=>"weberp.xmlrpc_InsertGLAccountGroup",
		getLocationList=>"weberp.xmlrpc_GetLocationList",
		getLocationDetails=>"weberp.xmlrpc_GetLocationDetails",
		getShipperList=>"weberp.xmlrpc_GetShipperList",
		getShipperDetails=>"weberp.xmlrpc_GetShipperDetails",
		getSalesAreasList=>"weberp.xmlrpc_GetSalesAreasList",
		getSalesAreaDetails=>"weberp.xmlrpc_GetSalesAreaDetails",
		getSalesAreaDetailsFromName=>"weberp.xmlrpc_GetSalesAreaDetailsFromName",
		insertSalesArea=>"weberp.xmlrpc_InsertSalesArea",
		getSalesmanList=>"weberp.xmlrpc_GetSalesmanList",
		getSalesmanDetails=>"weberp.xmlrpc_GetSalesmanDetails",
		getSalesmanDetailsFromName=>"weberp.xmlrpc_GetSalesmanDetailsFromName",
		insertSalesman=>"weberp.xmlrpc_InsertSalesman",
		getTaxGroupList=>"weberp.xmlrpc_GetTaxgroupList",
		getTaxGroupDetails=>"weberp.xmlrpc_GetTaxgroupDetails",
		getCustomerTypeList=>"weberp.xmlrpc_GetCustomerTypeList",
		getCustomerTypeDetails=>"weberp.xmlrpc_GetCustomerTypeDetails",
		insertStockCategory=>"weberp.xmlrpc_InsertStockCategory",
		modifyStockCategory=>"weberp.xmlrpc_ModifyStockCategory",
		getStockCategory=>"weberp.xmlrpc_GetStockCategory",
		searchStockCategories=>"weberp.xmlrpc_SearchStockCategories",
		getGLAccountList=>"weberp.xmlrpc_GetGLAccountList",
		getGLAccountDetails=>"weberp.xmlrpc_GetGLAccountDetails",
		getStockTaxRate=>"weberp.xmlrpc_GetStockTaxRate",
		insertSupplier=>"weberp.xmlrpc_InsertSupplier",
		modifySupplier=>"weberp.xmlrpc_ModifySupplier",
		getSupplier=>"weberp.xmlrpc_GetSupplier",
		searchSuppliers=>"weberp.xmlrpc_SearchSuppliers",
		stockAdjustment=>"weberp.xmlrpc_StockAdjustment",
		workOrderIssue=>"weberp.xmlrpc_WorkOrderIssue",
		searchWorkOrders=>"weberp.xmlrpc_SearchWorkOrders",
		insertPurchData=>"weberp.xmlrpc_InsertPurchData",
		modifyPurchData=>"weberp.xmlrpc_ModifyPurchData",
		insertWorkOrder=>"weberp.xmlrpc_InsertWorkOrder",
		workOrderReceive=>"weberp.xmlrpc_WorkOrderReceive",
		getBatches=>"weberp.xmlrpc_GetBatches",
		getDefaultDateFormat=>"weberp.xmlrpc_GetDefaultDateFormat",
		getDefaultCurrency=>"weberp.xmlrpc_GetDefaultCurrency",
		getDefaultPriceList=>"weberp.xmlrpc_GetDefaultPriceList",
		getDefaultLocation=>"weberp.xmlrpc_GetDefaultLocation"
	);

 	private $xmlrpc_obj;
 	private $defaultDateFormat;
 	public $defaultLocation;
 	private $defaultCurrency;
 	private $defaultPriceList;

	function weberp()
	{
		$this->xmlrpc_obj = new Xmlrpc(self::webERPServerURL,self::weberpuser,self::weberppassword,self::weberpDebugLevel);
    	$dateFormat=$this->xmlrpc_obj->transfer(null, $this->weberpcalls[getDefaultDateFormat]);
    	if ($dateFormat[0]==0)
    	{
    		$this->defaultDateFormat=$dateFormat[1]['confvalue'];
    	}else{
    		$this->defaultDateFormat='d/m/Y';
    	}
    	$location=$this->xmlrpc_obj->transfer(null, $this->weberpcalls[getDefaultLocation]);
    	if ($location[0]==0)
    	{
    		$this->defaultLocation=$location[1]['defaultlocation'];
    	}else{
    		$this->defaultLocation='';
    	}
    	$currency=$this->xmlrpc_obj->transfer(null, $this->weberpcalls[getDefaultCurrency]);
    	if ($currency[0]==0)
    	{
    		$this->defaultCurrency=$currency[1]['currencydefault'];
    	}else{
    		$this->defaultCurrency='GBP';
    	}
    	$pricelist=$this->xmlrpc_obj->transfer(null, $this->weberpcalls[getDefaultPriceList]);
    	if ($pricelist[0]==0)
    	{
    		$this->defaultPriceList=$pricelist[1]['confvalue'];
    	}else{
    		$this->defaultPriceList='0';
    	}
	}

    function transfer_bill_to_webERP_asSalesInvoice($pid,$bill_number,$billelems)
    {
 		$billdata[ovamount]= $billelems[price]*$billelems[amount];
 	    $billdata[consignment]=$billelems[User_Id];
 		$billdata[bill_nr]= $bill_number;
 		$billdata[pid] = $pid;
 		$billdata[partcode] = 'TREATMENT';
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

    function transfer_osc_customer_to_webERP($pid,$persondata)
    {

        $customer_data[pid] = $pid;
        $customer_data[name_first] = $persondata['firstname'];
        $customer_data[name_last] = $persondata['lastname'];
        $customer_data[district] = 'England';
    	$transmit=$this->xmlrpc_obj->transfer($this->generateWebERPCustomerData($customer_data),$this->weberpcalls['insertCustomer']);
		$transmit=$this->xmlrpc_obj->transfer($this->generateWebERPCustBranchData($customer_data),$this->weberpcalls['insertBranch']);

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

    function make_patient_workorder_in_webERP($treatmentID)
    {
    	$woData['loccode']=$this->defaultLocation;
    	$woData['requiredby']=date($this->defaultDateFormat);
    	$woData['startdate']=date($this->defaultDateFormat);
    	$woData['costissued']=0;
    	$woData['closed']=0;
    	$woData['stockid']='TREATMENT';
    	$woData['qtyreqd']=1;
    	$woData['qtyrecd']=0;
    	$woData['stdcost']=0;
    	$woData['nextlotsnref']=$treatmentID;
    	$transmit=$this->xmlrpc_obj->transfer($woData,$this->weberpcalls[insertWorkOrder]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function issue_to_patient_workorder_in_weberp($SerialNumber, $StockID, $Location, $Quantity, $Batch)
    {
    	$woSearchData[0]='nextlotsnref';
    	$woSearchData[1]=$SerialNumber;
    	$answer=$this->xmlrpc_obj->transfer($woSearchData,$this->weberpcalls[searchWorkOrders]);
    	$woIssueData[0]=$answer[0];
    	if (!$this->get_stock_item_from_webERP($StockID))
    	{
    		$stockData=$this->get_stock_info_for_webERP($StockID);
			$this->create_stock_item_in_webERP($stockData);
    	}
    	$woIssueData[1]=$StockID;
    	$woIssueData[2]=$Location;
    	$woIssueData[3]=$Quantity;
    	$woIssueData[4]=date('Y-m-d');
    	$woIssueData[5]=$Batch;
    	$transmit=$this->xmlrpc_obj->transfer($woIssueData,$this->weberpcalls[workOrderIssue]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function receive_patient_workorder_in_weberp($WONumber)
    {
    	$woReceiveData[0]=$WONumber;
    	$woReceiveData[1]='TREATMENT';
    	$woReceiveData[2]=$this->defaultLocation;
    	$woReceiveData[3]=1;
    	$woReceiveData[4]=date($this->defaultDateFormat);
    	$transmit=$this->xmlrpc_obj->transfer($woReceiveData,$this->weberpcalls[workOrderReceive]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function get_stock_info_for_webERP($StockID)
    {
		global $db;
	  	$sql="SELECT * FROM care_tz_drugsandservices where item_number='".$StockID."'";
  		$result=$db->Execute($sql);
  		$myrow=$result->FetchRow();
		$StockData['stockid']=$StockID;
		$StockData['description']=$myrow['item_description'];
		$StockData['longdescription']=$myrow['item_full_description'];
		if ($myrow['purchasing_class']=="service")
		{
			$StockData['mbflag'] = 'D';
		}
		if (($myrow['is_pediatric']+$myrow['is_adult']+$myrow['is_other']+$myrow['is_consumable']+$myrow['is_labtest'])==0)
		{
			$StockData['categoryid']='ZZ';
		}
		return $StockData;
    }

    function create_stock_item_in_webERP($stockData)
    {
    	$transmit=$this->xmlrpc_obj->transfer($stockData,$this->weberpcalls[insertStockItem]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[0];
    	}else{
    		return false;
    	}
    }

    function modify_stock_item_in_webERP($stockData)
    {
    	$transmit=$this->xmlrpc_obj->transfer($stockData,$this->weberpcalls[modifyStockItem]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[0];
    	}else{
    		return false;
    	}
    }

    function get_stock_item_from_webERP($stockID)
    {
    	$transmit=$this->xmlrpc_obj->transfer($stockID,$this->weberpcalls[getStockItem]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function search_stock_items_in_webERP($field, $criteria)
    {
    	$searchData[0]=$field;
    	$searchData[1]=$criteria;
    	$transmit=$this->xmlrpc_obj->transfer($searchData,$this->weberpcalls[searchStockItems]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function get_stock_balance_webERP($stockID)
    {
    	$transmit=$this->xmlrpc_obj->transfer($stockID,$this->weberpcalls[getStockBalance]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function get_stock_reorder_level_in_webERP($stockID)
    {
    	$transmit=$this->xmlrpc_obj->transfer($stockID,$this->weberpcalls[getStockReorderLevel]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function set_stock_reorder_level_in_webERP($StockID, $Location, $ReorderLevel)
    {
    	$reorderData[0]=$StockID;
    	$reorderData[1]=$Location;
    	$reorderData[2]=$ReorderLevel;
    	$transmit=$this->xmlrpc_obj->transfer($reorderData,$this->weberpcalls[setStockReorderLevel]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function get_allocated_stock_in_webERP($stockID)
    {
    	$transmit=$this->xmlrpc_obj->transfer($stockID,$this->weberpcalls[getAllocatedStock]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function get_ordered_stock_in_webERP($stockID)
    {
    	$transmit=$this->xmlrpc_obj->transfer($stockID,$this->weberpcalls[getOrderedStock]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

    function stock_adjusment_in_webERP($StockID, $Location, $Quantity, $TranDate)
    {
    	$adjustmentData[0]=$StockID;
    	$adjustmentData[1]=$Location;
    	$adjustmentData[2]=$Quantity;
    	$adjustmentData[3]=$TranDate;
    	$transmit=$this->xmlrpc_obj->transfer($adjustmentData,$this->weberpcalls[stockAdjustment]);
    	if ($transmit[0]==0)
    	{
    		return $transmit[1];
    	}else{
    		return false;
    	}
    }

	function generateWebERPCustSalesInvoiceData($saleInvoiceData)
	{

		$webERPCustSalesInvoiceData = array (

			debtorno=>$saleInvoiceData[pid],
			branchcode=>$saleInvoiceData[pid],
			trandate=>date($this->defaultDateFormat),
			settled=>"",
			reference=>"",
			tpe=>"",
			order_=>"",
			rate=>"1",
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
			partcode=>'TREATMENT',
			salesarea=>"Ar0"

	);


	$webERPCustSalesInvoiceData = $this->delete_empty_data_entries($webERPCustSalesInvoiceData);

	return $webERPCustSalesInvoiceData;
	}

	function getAreaCode($district) {
    	$areadetails=$this->xmlrpc_obj->transfer($district, $this->weberpcalls[getSalesAreaDetailsFromName]);
		if ($areadetails[0]==0) {
			return $areadetails[1]['areacode'];
		} else if ($areadetails[0]==1156) {
			$i=0;
			$area['areacode']=substr($district,0,2).$i;
			$area['areadescription']=$district;
    		$transmit=$this->xmlrpc_obj->transfer($area, $this->weberpcalls[insertSalesArea]);
    		while ($transmit[0]!=0) {
    			$i++;
				$area['areacode']=substr($district,0,2).$i;
    			$transmit=$this->xmlrpc_obj->transfer($area, $this->weberpcalls[insertSalesArea]);
    		}
    		if ($transmit[0]==0) {
    			return $area['areacode'];
    		} else {
    			return -1;
    		}
		} else {
			return -1;
		}
	}

	function getSalesmanCode() {
    	$salesmandetails=$this->xmlrpc_obj->transfer('Default', $this->weberpcalls[getSalesmanDetailsFromName]);
		if ($salesmandetails[0]==0) {
			return $salesmandetails[1]['salesmancode'];
		} else if ($salesmandetails[0]==1157) {
			$salesman['salesmancode']='1';
			$salesman['salesmanname']='Default';
    		$transmit=$this->xmlrpc_obj->transfer($salesman, $this->weberpcalls[insertSalesman]);
    		if ($transmit[0]==0) {
    			return $salesman['salesmancode'];
    		} else {
    			return -1;
    		}
		} else {
			return -1;
		}
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
			area=>$this->getAreaCode($customerdata[district]),
			salesman=>$this->getSalesmanCode(),
			fwddate=>"",
			phoneno=>"",
			faxno=>"",
			contactname=>"",
			email=>"",
			defaultlocation=>$this->defaultLocation,
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
			custbranchcode=>""

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
			currcode=>$this->defaultCurrency,
			salestype=>$this->defaultPriceList,
			clientsince=>date($this->defaultDateFormat),
			holdreason=>"1",
			paymentterms=>"CA",
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