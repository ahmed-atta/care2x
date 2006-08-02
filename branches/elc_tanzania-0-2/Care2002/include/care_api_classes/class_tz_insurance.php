<?php
require_once($root_path.'include/care_api_classes/class_core.php');


/**
*  Insurance methods for tanzania (the product-module is completely rewritten by Alexander Irro) 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Alexander Irro (Version 1.0.0) - alexander.irro@merotech.de
* @copyright 2006 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/



class Insurance_tz extends Core {
  
  var $tbl_company='care_tz_company';
  var $tbl_temp="tmp_search_results";
	var $fields_tbl_company=array(
	                'id',
									'name',
									'contact',
									'po_box',
									'city',
									'start_date',
									'end_date');  
  var $result;
  var $rs_fuzziness;
  
  
  // Constructor
  function Insurance_tz() {
    return TRUE;
  }  
  
  //------------------------------------------------------------------------------
  // Methods:
  
  function GetInsuranceBudgetOfPerson($PID) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;  
    $contract = $this->CheckForValidContract($PID); 
    if(is_array($contract))
    {
	    $this->sql="SELECT balanced_insurance FROM care_tz_billing_elem be, care_tz_billing b, care_encounter e WHERE ".
	    		"be.nr = b.nr AND " .
	    		"e.encounter_nr = b.encounter_nr AND " .
	    		"e.pid =$PID AND " .
	    		"be.insurance_id=".$contract['id']." AND " .
	    		"be.date_change>=".$contract['contract_start_date']." AND " .
	    		"be.date_change<=".$contract['contract_end_date']." AND " .
	    		"be.balanced_insurance>0";
	    		
	    $this->result = $db->Execute($this->sql);
	    $budget = $contract['ceiling'] - $contract['ceiling_startup_substraction'];
	    if($this->result)
	    {
		    while($this->row = $this->result->FetchRow())
		    {
		   		
		    	$budget -= $this->row['balanced_insurance'];
		    	
		  	}
		}
	    $this->sql="SELECT balanced_insurance FROM care_tz_billing_archive_elem be, care_tz_billing b, care_encounter e WHERE ".
	    		"be.nr = b.nr AND " .
	    		"e.encounter_nr = b.encounter_nr AND " .
	    		"e.pid =$PID AND " .
	    		"be.insurance_id=".$contract['id']." AND " .
	    		"be.date_change>=".$contract['contract_start_date']." AND " .
	    		"be.date_change<=".$contract['contract_end_date']." AND " .
	    		"be.balanced_insurance>0";
	    		
	    $this->result = $db->Execute($this->sql);
	    if($this->result)
	    {
		    while($this->row = $this->result->FetchRow())
		    {
		   		
		    	$budget -= $this->row['balanced_insurance'];
		    	
		  	}
		}
    }
    else
    {
    	return -1;
    }
    return $budget;
  }
  
  // -----------------------------------------------------------------------------
  
  
  function CheckForValidContract($PID,$timestamp=0,$company_id=0) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    if($timestamp==0) $timestamp = time();
    if (empty($company_id))
      $company_id = $this->GetCompanyFromPID($PID);
    if ($debug) echo "CheckForValidContract::GetCompanyFromPID returns: ".$company_id."<br>";
    $contractarray = $this->GetActualContractForCompanyAsArray($company_id);
    //echo $contractarray['start_date']."<".$timestamp." && ".$contractarray['end_date'].">".$timestamp;
    if($contractarray['start_date']<$timestamp && $contractarray['end_date']>$timestamp)
	  {
	    $this->sql="SELECT i.*, it.ceiling FROM care_tz_insurance i, care_tz_insurance_types it WHERE company_id=".$company_id." AND PID=".$PID." AND parent= ".$contractarray['id']." AND cancel_flag=0 AND it.id = i.plan ORDER BY i.id DESC LIMIT 1";
	    $this->result = $db->Execute($this->sql);
	    if($this->result)
		    if($this->row = $this->result->FetchRow())
		    {
		    	$this->row['is_valid']=true;
		    	$this->row['contract_start_date'] = $contractarray['start_date'];
		    	$this->row['contract_end_date'] = $contractarray['end_date'];
		    	return $this->row;
		  	}
		}
  	return false;
  }
  
  // -----------------------------------------------------------------------------
  
  function GetCompanyIDFromContract($contract) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
  	$this->sql="SELECT company_id FROM care_tz_insurance WHERE id=".$contract;
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow())
    {
   		return $this->row['company_id'];
  	}
  	return false;
  }
  
  // -----------------------------------------------------------------------------
  
  function GetCompanyFromPID($PID) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
  	return $this->GetCompanyFromParent($PID,true);
  }
  
  // -----------------------------------------------------------------------------
  
  function GetCompanyFromParent($parent,$start)
  {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
		//Abort reason
  	if(!$parent) return false;
  	if($start)
  		$where = 'WHERE PID='.$parent;
  	else
  		$where = 'WHERE id='.$parent;
  	$this->sql="SELECT company_id, parent FROM care_tz_insurance $where ORDER BY id DESC LIMIT 1";
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow())
    {
    	if($this->row['parent']!=-1)
    	{
    		//Recursive call of next parent
    		return $this->GetCompanyFromParent($this->row['parent'],false);
    	}
    	else
    	{
    		//We finally got it, return it now all the way back
    		return $this->row['company_id'];
    	}
  	}

	}
  
  function GetAllInsurancesAsArray($JUST_CONTRACTED=FALSE) {
    /**
    * If you want just a list of contracted companies, give this function a TRUE as parameter
    */
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    if (!$JUST_CONTRACTED)
      $this->sql="SELECT id, name, contact, po_box, city, start_date, end_date FROM care_tz_company ORDER BY id ASC";
    else {
      // This gives a list of companies what are somehow dedicated to a list of contracted companies
      // No check if the contract is valid to any time period...
      $this->sql="SELECT
                    care_tz_company.id,
                    care_tz_company.name,
                    care_tz_company.contact,
                    care_tz_company.po_box,
                    care_tz_company.city,
                    care_tz_company.start_date,
                    care_tz_company.end_date,
                    care_tz_company.invoice_flag
                  FROM care_tz_company
                    INNER JOIN care_tz_insurance ON care_tz_insurance.company_id=care_tz_company.id
                    INNER JOIN care_tz_insurance_types ON care_tz_insurance_types.id=care_tz_insurance.plan
                  WHERE parent=-1
                  ORDER BY care_tz_company.name";
    }  
    $this->result = $db->Execute($this->sql);
    $counter=0;
    while($this->row = $this->result->FetchRow())
    {
    	$return[$counter++] = $this->row;
  	}
  	return $return;
  }
  
  // -----------------------------------------------------------------------------
  
  function GetContractsForCompanyAsArray($company_id) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT i.id, it.name, plan, start_date, end_date, cancel_flag, paid_flag FROM care_tz_insurance i, care_tz_insurance_types it WHERE PID=0 AND company_id=$company_id
    AND it.id = i.plan  ORDER BY end_date DESC";
    $this->result = $db->Execute($this->sql);
    $counter=0;
    while($this->row = $this->result->FetchRow())
    {
    	$return[$counter++] = $this->row;
  	}
  	return $return;
  }
  
  // -----------------------------------------------------------------------------
  
  function GetActualContractForCompanyAsArray($company_id) {
    global $db;
    $debug=FALSE; 
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    if(!$company_id) return false;
    $this->sql="SELECT i.id, it.name, plan, start_date, end_date, cancel_flag, paid_flag FROM care_tz_insurance i, care_tz_insurance_types it WHERE parent=-1 AND company_id=$company_id
    AND it.id = i.plan AND start_date<".time()." AND end_date > ".time()." AND cancel_flag=0 ORDER BY id DESC";
    $this->result = $db->Execute($this->sql);
    $counter=0;
    if($this->row = $this->result->FetchRow())
    {
    	return $this->row;
  	}
  	return false;
  }

  function GetContractForCompanyAsArray($company_id) {
    global $db;
    $debug=FALSE; 
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    if(!$company_id) return false;
    $this->sql="SELECT i.id, it.name, plan, start_date, end_date, cancel_flag, paid_flag FROM care_tz_insurance i, care_tz_insurance_types it WHERE parent=-1 AND company_id=$company_id
    AND it.id = i.plan AND start_date>".time()." AND cancel_flag=0 ORDER BY id DESC LIMIT 0,1";
    $this->result = $db->Execute($this->sql);
    $counter=0;
    if($this->row = $this->result->FetchRow())
    {
    	return $this->row;
  	}
  	return false;
  }  
  
  // -----------------------------------------------------------------------------
  
  
  
  
  function GetContractsByIDAsArray($contract_id) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT i.id, i.company_id, it.name, plan, start_date, end_date, cancel_flag FROM care_tz_insurance i, care_tz_insurance_types it WHERE i.id = ".$contract_id." AND it.id = i.plan ORDER BY end_date DESC";
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow())
    {
    	return $this->row;
  	}
  	return false;
  }
  
  // -----------------------------------------------------------------------------
  
  
  
  function GetInsuranceTypesAsArray() {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT id, name, ceiling, prepaid_amount, is_disabled FROM care_tz_insurance_types ORDER BY id ASC";
    $this->result = $db->Execute($this->sql);
    $counter=0;
    while($this->row = $this->result->FetchRow())
    {
    	$return[$counter++] = $this->row;
  	}
  	return $return;
  }
  
  // -----------------------------------------------------------------------------
  
  function GetInsuranceTypeAsArray($id) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT id, name, ceiling, prepaid_amount, is_disabled FROM care_tz_insurance_types WHERE id=$id";
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow())
    {
    	return $this->row;
  	}
  	return false;
  }
  
  // -----------------------------------------------------------------------------
  

  
	function GetInsuranceAsArray($id){
    global $db;
    if(!$id || !is_numeric($id)) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT
                  care_tz_company.id,
                  care_tz_company.name,
                  care_tz_company.contact,
                  care_tz_company.po_box,
                  care_tz_company.city,
                  care_tz_company.start_date,
                  care_tz_company.end_date,
                  care_tz_company.invoice_flag,
                  care_tz_insurance_types.name as InsuranceName,
                  care_tz_insurance.plan as insurance
                FROM care_tz_company
                  LEFT JOIN care_tz_insurance ON care_tz_insurance.company_id=care_tz_company.id
                  LEFT JOIN care_tz_insurance_types ON care_tz_insurance_types.id=care_tz_insurance.plan
                WHERE care_tz_company.id=$id";
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow())
    {
    	return $this->row;
  	}
  	return false;
	}  
  
  // -----------------------------------------------------------------------------
  
	function GetInsuranceIDByCompanyID($id){
    global $db;
    if(!$id || !is_numeric($id)) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT id FROM care_tz_insurance WHERE company_id =$id AND parent=-1 ORDER BY company_parent DESC LIMIT 1";
    $this->result = $db->Execute($this->sql);
    if($this->result)
    {
	    if($this->row = $this->result->FetchRow())
	    {
	    	return $this->row;
	    }
	  }
  	return 0;
	}  
  
  //------------------------------------------------------------------------------
  	function CreateInsuranceRoot($id){
  		
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $company = $this->GetInsuranceAsArray($id);
    $this->sql="INSERT INTO care_tz_insurance SET
    	parent=-1,
    	company_id='".$id."',
    	PID=0,
    	company_parent=0,
    	ceiling_startup_subtraction=0,
    	plan=0,
    	start_date=".mktime(0,0,0,date("Y"),1,1).",
    	end_date=".mktime(23,59,59,date("Y"),12,31).",
    	timestamp='".time()."',
    	cancel_flag=0";
    $this->result = $db->Execute($this->sql);
    return $this->GetInsuranceIDByCompanyID($id);
  	
	}
  
  //------------------------------------------------------------------------------
  	function CreateInsuranceContract($company_id, $plan, $start, $end){
  		
    global $db;
    $debug=TRUE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $company_parent = $this->GetInsuranceIDByCompanyID($company_id);
    $this->sql="INSERT INTO care_tz_insurance SET
    	parent=-1,
    	company_id='".$company_id."',
    	PID=0,
    	company_parent='".$company_parent."',
    	ceiling_startup_subtraction=0,
    	plan=".$plan.",
    	start_date=".$start.",
    	end_date=".$end.",
    	timestamp='".time()."',
    	cancel_flag=0";
    $this->result = $db->Execute($this->sql);
    $newId= $this->GetInsuranceIDByCompanyID($id);
    $this->RenewContractMembers($newId, $company_parent, $company_id);
    return $newId;
  	
	}
  
  //------------------------------------------------------------------------------
  	function RenewContractMembers($new_id, $old_id, $company_id){
  		
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="INSERT INTO care_tz_insurance (parent, company_id, PID, company_parent, ceiling_startup_substraction,
    plan, start_date, end_date, timestamp, cancel_flag, paid_flag)
    SELECT ".$new_id.", company_id, PID, 0, 0, plan, 0, 0, ".time().", 0, 0 WHERE cancel_flag=0 AND parent = ".$old_id;
    $this->result = $db->Execute($this->sql);
    return true;
  	
	}
  
  
  //------------------------------------------------------------------------------
	function GetInsuranceContractsAsArray($id,$timestamp,$guilty=0){
		/*
		Definitions:
		$guilty < 0 : Show all expired contracts
		$guilty = 0 : Show actual contract
		$guilty > 0 : Show future contracs
		*/
		
    global $db;
    if(!$id || !is_numeric($id)) return false;
    
    if(!$timestamp) $timestamp=time();
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if($guilty<0)
    {
    	$where = ' AND end_date < '.$timestamp;
  	}
  	elseif($guilty==0)
  	{
  		$where = ' AND start_date < '.$timestamp.' AND end_date > '.$timestamp;
  	}
  	else
  	{
  		$where = ' AND start_date > '.$timestamp;
  	}
    $this->sql="SELECT * FROM care_tz_insurance WHERE company_id=$id"; //.$where;

    $this->result = $db->Execute($this->sql);
    $counter=0;
    while($this->row = $this->result->FetchRow())
    {
    	if($this->row['PID']>0)
    	{
    		$return[$this->row['PID']]=$this->row;
    	}
  	}
  	return $return;
	}  
  
  //------------------------------------------------------------------------------
  
  function GetMembersOfContractID($id){
		/*
		Definitions:
		$guilty < 0 : Show all expired contracts
		$guilty = 0 : Show actual contract
		$guilty > 0 : Show future contracs
		*/
		
    global $db;
    if(!$id || !is_numeric($id)) return false;
    
    $this->sql="SELECT * FROM care_tz_insurance WHERE PID>0 and parent=$id";

    $this->result = $db->Execute($this->sql);
    while($this->row = $this->result->FetchRow())
    {
   		$return[$this->row['PID']]=$this->row;
  	}
  	return $return;
	}  
  
  //------------------------------------------------------------------------------
  
  
  
	function InsertNewInsuranceCompany($dataarray){
    global $db;
    if(!$dataarray) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    if($dataarray['invoice_flag']) $invoice=1; else $invoice=0;  
    $this->sql="INSERT INTO care_tz_company SET
    	name='".$dataarray['name']."',
    	contact='".$dataarray['contact']."',
    	po_box='".$dataarray['po_box']."',
    	city='".$dataarray['city']."',
    	invoice_flag='".$invoice."'";
    $this->result = $db->Execute($this->sql);
  	return true;
	}  
  
  //------------------------------------------------------------------------------
  
	function UpdateInsuranceCompany($dataarray){
    global $db;
    
    if(!$dataarray) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if($dataarray['invoice_flag']) $invoice=1; else $invoice=0;    
    $this->sql="UPDATE care_tz_company SET
    	name='".$dataarray['name']."',
    	contact='".$dataarray['contact']."',
    	po_box='".$dataarray['po_box']."',
    	city='".$dataarray['city']."',
    	invoice_flag='".$invoice."'
    	WHERE id=".$dataarray['id'];
    $this->result = $db->Execute($this->sql);
    $this->sql="UPDATE care_tz_insurance SET
      plan='".$dataarray['insurance']."'
      WHERE company_id=".$dataarray['id'];
    $this->result = $db->Execute($this->sql);  
  	return true;
	}  
  
    //------------------------------------------------------------------------------
  
	function UpdateInsuranceType($dataarray){
    global $db;
    if(!$dataarray) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    if(!$dataarray['is_disabled']) $dataarray['is_disabled'] = 0;
    $this->sql="UPDATE care_tz_insurance_types SET
    	name='".$dataarray['name']."',
    	ceiling='".$dataarray['ceiling']."',
    	prepaid_amount='".$dataarray['prepaid_amount']."',
    	is_disabled='".$dataarray['is_disabled']."'
    	WHERE id=".$dataarray['id'];
    $this->result = $db->Execute($this->sql);
  	return true;
	}  
  
    //------------------------------------------------------------------------------
  
  	function InsertInsuranceType($dataarray){
    global $db;
    if(!$dataarray) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    if(!$dataarray['is_disabled']) $dataarray['is_disabled'] = 0;
    $this->sql="INSERT INTO care_tz_insurance_types SET
    	name='".$dataarray['name']."',
    	ceiling='".$dataarray['ceiling']."',
    	prepaid_amount='".$dataarray['prepaid_amount']."',
    	is_disabled='".$dataarray['is_disabled']."'";
    $this->result = $db->Execute($this->sql);
  	return true;
	}  
  
    //------------------------------------------------------------------------------
  
  	function ConcludeContractForPID($pid, $parent, $company_id, $startup_subtraction, $plan){
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="INSERT INTO care_tz_insurance SET
    	parent='".$parent."',
    	company_id='".$company_id."',
    	company_parent=0,
    	PID='".$pid."',
    	ceiling_startup_subtraction='".$startup_subtraction."',
    	plan='".$plan."',
    	start_date='0',
    	end_date='0',
    	timestamp='".time()."',
    	cancel_flag=0";
    $this->result = $db->Execute($this->sql);
  	return true;
	}  
  
    //------------------------------------------------------------------------------
  
  
	function UpdateContractsArray($dataarray){
    global $db;
    if(!$dataarray) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $temparray = $dataarray;
    if($debug) var_dump($dataarray);
    while(list($x,$v) = each($dataarray))
    {
    	if($debug) echo '('.$x.') ';
    	if(strstr($x,"this_"))
    	{
    		$currentpid = substr(strstr($x,"this_"),5);
    		if($temparray['this_'.$currentpid]=="conclude" && $temparray['action_'.$currentpid]=="conclude")
    		{
    			$parent = $this->GetInsuranceIDByCompanyID($temparray['insurance']);
    			$this->ConcludeContractForPID($currentpid, $parent['id'], $temparray['insurance'], $temparray['startup_'.$currentpid], $temparray['plan_'.$currentpid]);
    		}
    		elseif($temparray['this_'.$currentpid]=="cancel" && $temparray['action_'.$currentpid]=="cancel")
    		{
    			if($this->CancelContractForPID($temparray['contract_'.$currentpid]))
    				$status['cancel']++;
    			$this->SetContractPlanForPID($temparray['contract_'.$currentpid],$temparray['plan_'.$currentpid]);
    			if($temparray['startup_'.$currentpid] && is_numeric($temparray['startup_'.$currentpid]))
    				$this->SetContractStartupsubstractionForPID($temparray['contract_'.$currentpid],$temparray['startup_'.$currentpid]);
    				
    		}
    		elseif($temparray['this_'.$currentpid]=="cancel" && !$temparray['action_'.$currentpid])
    		{
    			if($this->EnableContractForPID($temparray['contract_'.$currentpid]))
    				$status['enable']++;
    			if($temparray['startup_'.$currentpid] && is_numeric($temparray['startup_'.$currentpid]))
    				$this->SetContractStartupsubstractionForPID($temparray['contract_'.$currentpid],$temparray['startup_'.$currentpid]);
    		}
    	}
    	if($debug) echo $currentpid.' - ';
  	}
  	if($debug) echo $status['cancel'].' ---- '.$status['enable'];
  	return true;
	}  

  //------------------------------------------------------------------------------


	function CancelContractForPID($id){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="UPDATE care_tz_insurance SET
    	cancel_flag=1
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}  

  
  //------------------------------------------------------------------------------
  
	function EnableContractForPID($id){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="UPDATE care_tz_insurance SET
    	cancel_flag=0
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}  

  
  //------------------------------------------------------------------------------
  
	function EnablePaymentForContract($id){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="UPDATE care_tz_insurance SET
    	paid_flag=1
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}  

  
  //------------------------------------------------------------------------------
  
	function CancelPaymentForContract($id){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="UPDATE care_tz_insurance SET
    	paid_flag=0
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}  

  
  //------------------------------------------------------------------------------
  
  
  function SetContractPlanForPID($id,$value){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="UPDATE care_tz_insurance SET
    	plan=".$value."
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}  

  
  //------------------------------------------------------------------------------
  
  function SetContractStartupsubstractionForPID($id,$value){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="UPDATE care_tz_insurance SET
    	ceiling_startup_subtraction=".$value."
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}  

  
  //------------------------------------------------------------------------------
  
  // Wrappers:
  function Display_Selected_Elements($array,$company_id){
  	global $person_obj;
    while (list($x,$v) = each($array)) {
    	
    	$result = $person_obj->getAllInfoObject($v);
    	if($person = $result->FetchRow())
    	{
      	echo "<option value=\"".$v."\">".$person['selian_pid']." - ".$person['name_last'].", ".$person['name_first']." (".$person['date_birth'].")</option>\n";
    	}
      $counter++;
    }
    if($counter<1)
    {
			$contractarray = $this->GetContractsForCompanyAsArray($company_id);
			$members = $this->GetMembersOfContractID($contractarray[0]['id']);
			
			while(list($x,$v) = each($members))
			{
				    	
	    	$result = $person_obj->getAllInfoObject($v['PID']);
	    	if($person = $result->FetchRow())
	    	{
	    		if($v['cancel_flag']==0)
	      		echo "<option value=\"".$person['pid']."\">".$person['selian_pid']." - ".$person['name_last'].", ".$person['name_first']." (".$person['date_birth'].")</option>\n";
	    	}
			}
												
  	}
  }
  
//------------------------------------------------------------------------------
  
  function ShowInsuranceList() {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    $this->insurance_array = $this->GetAllInsurancesAsArray(FALSE);
    echo '<table border="0" cellpadding="2" cellspacing="0">
    <tr bgcolor=#ffff66>
    	<td align="center" width="30">ID</td>
    	<td align="center" width="240">Company name</td>
			<td colspan="4" align="center" width="50">Options</td>
    </tr>
    
    ';
    while(list($x,$v) = each($this->insurance_array))
    {
    	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";
      echo '
      <tr bgcolor='.$bg.'>
      	<td>'.$v['id'].'</td>
      	<td>'.$v['name'].'</td>
      <td><div align="center"><a href="insurance_company_tz_show.php?id='.$v['id'].'"><img src="../../gui/img/common/default/common_infoicon.gif" alt="Show insurance details" width="16" height="16" border="0"></a></td>
      <td><div align="center"><a href="insurance_company_tz_edit.php?id='.$v['id'].'"><img src="../../gui/img/common/default/hammer.gif" alt="Edit" width="16" height="16" border="0"></a></td>
      <td><div align="center"><a href="insurance_company_tz_contracts.php?id='.$v['id'].'"><img src="../../gui/img/common/default/documents.gif" als="Show contracts" width="16" height="16" border="0"></a></td>
      <td><div align="center"><a href="insurance_company_tz_delete.php?id='.$v['id'].'"><img src="../../gui/img/common/default/delete.gif" als="Delete" width="16" height="16" border="0"></a></td></tr>
      </tr>';
  	}
  	echo '</table>';
    return true;
  }
  
    //------------------------------------------------------------------------------
  
  function ShowMemberBillsOfContract($contract_id) {
  	
  	global $root_path, $person_obj;
    /**
    * Returns TRUE if this item number still exists in the database
    */
    $this->contractmembers = $this->GetMembersOfContractID($contract_id);
    $this->contract = $this->GetContractsByIDAsArray($contract_id);
    $this->company = $this->GetInsuranceAsArray($this->GetCompanyIDFromContract($contract_id));
    echo '
	<table border="0" cellpadding="2" cellspacing="1">
	<tr bgcolor="#FFBD72">
      	<td width="120">Contract-ID: '.$this->contract['id'].'</td>
      	<td width="190">Plan: '.$this->contract['name'].'</td>
      	<td width="118">Timeframe:</td>
      	<td width="90" align="center">'.date("d.m.y", $this->contract['start_date']).'</td>
      	<td width="10">-</td>
      	<td width="80" align="center">'.date("d.m.y", $this->contract['end_date']).'</td>
	</tr>
	</table>
	<table border="0" cellpadding="2" cellspacing="1">
		<tr bgcolor=ffffaa>
			<td width="120">Company name:</td>
			<td width="190">'.$this->company['name'].'</td>
			<td width="118">City:</td>
			<td width="190">'.$this->company['city'].'</td>
		</tr>
		<tr bgcolor=ffffee>
			<td>Contact person:</td>
			<td>'.$this->company['contact'].'</td>
			<td>Insurance type</td>
			<td>'.$this->company['insurance'].'</td>
		</tr>
		<tr bgcolor=ffffaa>
			<td>P.O. Box:</td>
			<td>'.$this->company['po_box'].'</td>
			<td>Pay by invoice:</td>
			<td>';
			if($this->company['invoice_flag']) echo 'Yes'; else echo 'No';
		echo '</td>
		</tr>
	</table><p>
	<b>Member list:</b>
    <table border="0" cellpadding="2" cellspacing="1">
    <tr bgcolor=#ffff66>
    	<td align="center" width="30">PID</td>
    	<td align="center" width="200">Name</td>
		<td align="center" width="100">Plan</td>
		<td align="center" width="100">Ceiling</td>
		<td align="center" width="150">Prepaid Amount</td>
    </tr>
    
    ';
    $total=0;
    while(list($x,$v) = each($this->contractmembers))
    {
    	$result = $person_obj->getAllInfoObject($v['PID']);
	    $person = $result->FetchRow();
	    $plan = $this->GetInsuranceTypeAsArray($v['plan']);
    	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";
      echo '
      <tr bgcolor='.$bg.'>
      	<td>'.$v['PID'].'</td>
      	<td>'.$person['name_last'].', '.$person['name_first'].'</td>
      	<td align="center">'.$plan['name'].'</td>
      	<td align="right">'.$plan['ceiling'].' TSH</td>
      	<td align="right"><b>';
      	if($this->company['invoice_flag'])
      	{
      		$account = $this->CalculateSummaryForInsuranceId($v['id']);
      	}
      	else
      		$account = $plan['prepaid_amount'];
      	echo $account.' TSH</b></td>
      </tr>';
      $total += $account;
  	}
	echo '
	<tr bgcolor="#000000" height="3">
		<td colspan="5"></td>
	</tr>
	<tr bgcolor="#ffff66">
		<td colspan="4" align="right"><b>TOTAL SUM:</b></td>
		<td align="right"><b>'.$total.' TSH</b></td>
	</tr>';
  	echo '</table>
  	</form>';
    return true;
  }
  
  
  //------------------------------------------------------------------------------
  
    function CalculateSummaryForInsuranceId($insurance_id) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT balanced_insurance FROM care_tz_billing_elem WHERE insurance_id=".$insurance_id;
    $this->result = $db->Execute($this->sql);
    $sum=0;
    while($this->row = $this->result->FetchRow())
    {
    	$sum += $this->row['balanced_insurance'];
  	}
	$this->sql="SELECT balanced_insurance FROM care_tz_billing_archive_elem WHERE insurance_id=".$insurance_id;
    $this->result = $db->Execute($this->sql);
    while($this->row = $this->result->FetchRow())
    {
    	$sum += $this->row['balanced_insurance'];
  	}
  	return $sum;
  }

  //------------------------------------------------------------------------------
  
  function ShowContractsOfCompany($company_id) {
  	
  	global $root_path;
    /**
    * Returns TRUE if this item number still exists in the database
    */
    $this->contract_array = $this->GetContractsForCompanyAsArray($company_id);
  		echo '<script language="javascript" >
            <!-- 
            function printOut(id)
            {
            	urlholder="show_contract.php?id=" + id;
            	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
              
            }
            function Bill(id)
            {
            	urlholder="insurance_company_tz_contracts_bill.php?id=" + id;
            	testprintout=window.open(urlholder,"printout","width=630,height=600,menubar=no,resizable=yes,scrollbars=yes");
              
            }
            // -->
            </script> 
            ';
    echo '
    
    
    <form method="post">
    <input type="hidden" name="mode" value="updateflags">
    <table border="1" align="left" cellpadding="2" cellspacing="0">
    	<tr>
    		<td><b>Color Legend:</b></td><td bgcolor=#DBDBDB width="100" align="center">deactivated contract</td><td bgcolor=#FFBD72 width="100" align="center">actual contract</td>
    		<td bgcolor=#ffffaa width="100" align="center">old/future contracts</td>
    	</tr>
    </table>
    <br><br><br>
    <table border="0" cellpadding="2" cellspacing="1">
    <tr bgcolor=#ffff66>
    	<td align="center" width="30">ID</td>
    	<td align="center" width="240">Plan</td>
    	<td align="center" width="80" colspan="2">Start date</td>
    	<td align="center" width="70">End date</td>
			<td align="center" width="70">Cancelled?</td>
			<td align="center" width="100">Already paid?</td>
			<td align="center" width="70">Show contract</td>
			<td align="center" width="70">Show Bill</td>
    </tr>
    
    ';
    while(list($x,$v) = each($this->contract_array))
    {
    	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";
    	if($v['start_date']< time() && $v['end_date'] > time()) $bg='#FFBD72';
    	if($v['cancel_flag']) $bg='#DBDBDB';
    	if($v['cancel_flag']) 
    	{
    		$cancel_flag_yes = 'checked'; 
    		$cancel_flag_no = false; 
    	}
    	else
    	{
    		$cancel_flag_yes= false;
    		$cancel_flag_no = 'checked'; 
    	}
    	if($v['paid_flag']) 
    	{
    		$paid_flag_yes = 'checked'; 
    		$paid_flag_no = false; 
    	}
    	else
    	{
    		$paid_flag_yes= false;
    		$paid_flag_no = 'checked'; 
    	}
      echo '
      <tr bgcolor='.$bg.'>
      	<td>'.$v['id'].'</td>
      	<td>'.$v['name'].'</td>
      	<td align="center">'.date("d.m.y", $v['start_date']).'</td>
      	<td>-</td>
      	<td align="center">'.date("d.m.y", $v['end_date']).'</td>
      <td><div align="center">Yes<input type="radio" '.$cancel_flag_yes.' name="cancel_'.$v['id'].'" value="yes"><input type="radio" '.$cancel_flag_no.' name="cancel_'.$v['id'].'" value="no"> No</td>
      <td><div align="center">Yes<input type="radio" '.$paid_flag_yes.' name="paid_'.$v['id'].'" value="yes"><input type="radio" '.$paid_flag_no.' name="paid_'.$v['id'].'" value="no"> No</td>
      <td><div align="center"><a href="javascript:printOut('.$v['id'].')"><img src="../../gui/img/common/default/documents.gif" alt="Show contracts" width="16" height="16" border="0"></a></td>
	  <td><div align="center"><a href="javascript:Bill('.$v['id'].')"><img src="../../gui/img/common/default/play_one.gif" alt="Show Bill" border="0"></a></td>
      		
      </tr>';
  	}
  	echo '</table>
  	<input type="image" src="'.$root_path.'/gui/img/control/default/en/en_update.gif">
  	</form>';
    return true;
  }
  
  //------------------------------------------------------------------------------

  function CheckContractValidity($company_id, $start_date, $end_date) {
    /**
    * Returns TRUE if this item number still exists in the database
    */

    if(!$company_id || !$start_date || !$end_date || $start_date >= $end_date) return false;
    $this->contract_array = $this->GetContractsForCompanyAsArray($company_id);
    while(list($x,$v) = each($this->contract_array))
    {
    	if(($v['end_date']>$start_date || $v['start_date']>$start_date) && $v['cancel_flag']!=1) return false;
  	}
    return true;
  }
  
  //------------------------------------------------------------------------------

  function NewContractForm($company_id) {
  	global $root_path, $db, $start, $end;
    /**
    * Returns TRUE if this item number still exists in the database
    */
    include_once($root_path.'include/inc_date_format_functions.php');
    echo '<script language="JavaScript">';
		require($root_path.'include/inc_checkdate_lang.php'); 
    echo '</script>';
    echo '<script language="javascript" src="'.$root_path.'js/setdatetime.js"></script>';
    echo '<script language="javascript" src="'.$root_path.'js/checkdate.js"></script>';
    echo '<script language="javascript" src="'.$root_path.'js/dtpick_care2x.js"></script>';
    echo '<table border="0" cellpadding="1" cellspacing="1" width="850">
      	<tr bgcolor="ffffdd"><td>Contract (Start/End):<br><input type="text" size="15" maxlength=10 value="';
      	$datename=	'start';
    		$formname= 'insurance';
				if($start){
					echo $start;
				}
				else{
					echo formatDate2Local(date('Y').'-01-01',$date_format);
				}
		  	echo '"
		 				onFocus="this.select();"  
						onBlur="IsValidDate(this,\''.$date_format.'\')" 
						onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\');" name="'.$datename.'">
						<a href="javascript:show_calendar(\''.$formname.'.'.$datename.'\',\''.$date_format.'\')">
						<img '.createComIcon($root_path,'show-calendar.gif','0','absmiddle').'></a> - <input type="text" size="15" maxlength=10 value="';
      	$datename=	'end';
    		$formname= 'insurance';
				if($end){
					echo $end;
				}
				else{
					echo formatDate2Local(date('Y').'-12-31',$date_format);
				}
		  	echo '"
		 				onFocus="this.select();"  
						onBlur="IsValidDate(this,\''.$date_format.'\')" 
						onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\');" name="'.$datename.'">
						<a href="javascript:show_calendar(\''.$formname.'.'.$datename.'\',\''.$date_format.'\')">
						<img '.createComIcon($root_path,'show-calendar.gif','0','absmiddle').'></a></td><td>Preselected contract plan:<br>'; $this->ShowInsuranceTypesDropDown('plan',$v['Contract']['plan']); echo '</td></tr>
				</table>';


  }
  
  //------------------------------------------------------------------------------

  
  function ShowInsuranceTypesList() {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    $this->insurance_array = $this->GetInsuranceTypesAsArray();
    echo '<table border="0" cellpadding="2" cellspacing="0">
    <tr bgcolor=#ffff66>
    	<td align="center" width="30">ID</td>
    	<td align="center" width="240">Insurance type</td>
    	<td align="center" width="70">Ceiling</td>
    	<td align="center" width="125">Prepaid amount</td>
			<td colspan="2" align="center" width="50">Options</td>
    </tr>
    
    ';
    while(list($x,$v) = each($this->insurance_array))
    {
    	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";
    	if($v['is_disabled']>0)
    		$disabled='<font color=red><b>(DISABLED)</b></font>';
    	else $disabled=false;
      echo '
      <tr bgcolor='.$bg.'>
      	<td>'.$v['id'].'</td>
      	<td>'.$v['name'].' '.$disabled.'</td>
      	<td align="center">'.$v['ceiling'].' TSH</td>
      	<td align="center">'.$v['prepaid_amount'].' TSH</td>
      <td><div align="center"><a href="insurance_types_tz_edit.php?id='.$v['id'].'"><img src="../../gui/img/common/default/hammer.gif" alt="Edit" width="16" height="16" border="0"></a></td>
      </tr>';
  	}
  	echo '</table>';
    return true;
  }
  
  
  
  //------------------------------------------------------------------------------
  function ShowInsuranceTypesDropDown($name,$selected) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    $this->insurancetype_array = $this->GetInsuranceTypesAsArray();
    echo '<select name="'.$name.'">
    ';
    while(list($x,$v) = each($this->insurancetype_array))
    {
    		if($v['is_disabled']==0)
    		{
      	echo '<option ';
      	if($v['id']==$selected) echo ' selected ';
      	echo ' value="'.$v['id'].'">'.$v['name'].' ('.$v['ceiling'].')</option>';
      	}
  	}
  	echo '</select>';
    return true;
  }
  
   //------------------------------------------------------------------------------
  
  function ShowInsuranceHeadline($company_id) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    global $thisfile;
    $this->insurance = $this->GetInsuranceAsArray($company_id);
    echo '<table border="0" cellpadding="1" cellspacing="1" bgcolor="FFFF33" width="850">
    			<tr>
    				<td align="center">Selected Insurance Company: '.$this->insurance['name'].'
    				</td>
    			</tr>
    </table>';
    return true;
  } 
  
  //------------------------------------------------------------------------------
  
  function ShowInsurancesDropDown($name,$selected) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    global $thisfile;
    $this->insurance_array = $this->GetAllInsurancesAsArray(TRUE);
    echo '<select name="'.$name.'" onChange="submit_form(this,\''.$thisfile.'\',\''.session_id().'\',\'company_id\');">
    <option selected value="-1">Please select a company </option>';
    while(list($x,$v) = each($this->insurance_array))
    {
      	echo '<option '; 
      	if($v['id']==$selected) echo ' selected ';
      	echo 'value="'.$v['id'].'">'.$v['id'].' - '.$v['name'].'</option>';
  	}
  	echo '</select>';
    return true;
  }
  
  
  
  //------------------------------------------------------------------------------
  
  function ShowMemberForms($array) {
  	global $person_obj, $root_path, $company_id;
  	$selected_insurance = $company_id;
  	include_once($root_path.'include/inc_date_format_functions.php');
    /**
    * Returns TRUE if this item number still exists in the database
    */
    echo '<script language="JavaScript">';
		require($root_path.'include/inc_checkdate_lang.php'); 
    echo '</script>';
/*    echo '<script language="javascript" src="'.$root_path.'js/setdatetime.js"></script>';
    echo '<script language="javascript" src="'.$root_path.'js/checkdate.js"></script>';
    echo '<script language="javascript" src="'.$root_path.'js/dtpick_care2x.js"></script>';
*/
    echo '<table border="0" cellpadding="1" cellspacing="1" width="850">';

    $allcontracts = $this->GetInsuranceContractsAsArray($selected_insurance,false,0);
		$contractarray = $this->GetActualContractForCompanyAsArray($company_id);
		if (!$contractarray) {
		  // if there is no valid contract for now, take the next one what you have in the database.
		  $contractarray = $this->GetContractForCompanyAsArray($company_id);
		}
		//if($contractarray['id']>0)
		if(count($contractarray)>0)
		{
	    while(list($x,$v) = each($array))
	    {
	    		$result = $person_obj->getAllInfoObject($v['PID']);
	    		$person = $result->FetchRow();
	    		unset($allcontracts[$v['PID']]);
	    		if(!is_array($v['Contract']))		//New Contract
	    		{	
						echo '<tr bgcolor="ffffaa"><td>'.$person['name_last'].', '.$person['name_first'].' (Selian file nr: '.$person['selian_pid'].')</td><td>Action:</td><td>Plan / Start up substraction:</td></tr>
						<tr bgcolor="ffffdd"><td>Contract (Start/End):<br><input type="hidden" name="this_'.$v['PID'].'" value="conclude">'.date("m/d/Y",$contractarray['start_date']).' - '.date("m/d/Y",$contractarray['end_date']).'</td><td><input type="hidden" name="this_'.$v['PID'].'" value="conclude">
						<input type="checkbox" name="action_'.$v['PID'].'" align="absmiddle" checked value="conclude">Conclude contract</td>
						<td align="center">'; $this->ShowInsuranceTypesDropDown('plan_'.$v['PID'],$contractarray['plan']); echo '<input typ="text" value="'.$v['Contract']['ceiling_startup_subtraction'].'" name="startup_'.$v['PID'].'"></td></tr>';
					}
			    elseif($v['Contract']['is_valid'])  // Actual Contract
			    {
	
						echo '<tr bgcolor="ffffaa"><td><img src="'.$root_path.'gui/img/common/default/lock.gif" height="15" align="absmiddle">'.$person['name_last'].', '.$person['name_first'].' (Selian file nr: '.$person['selian_pid'].')</td><td>Action:</td><td>Plan / Start up substraction:</td></tr>';
	
						if($v['Contract']['company_id']!=$selected_insurance) // Is there another valid contract for this person?
			    	{
			    		$other_insurance = $this->GetInsuranceAsArray($v['Contract']['company_id']);
			    		echo '<tr>
			    		<td colspan="3"><table border="0" bgcolor="FFFF00" width="100%">
			    		<tr><td><img src="'.$root_path.'gui/img/common/default/level_7.gif" height="15" align="absmiddle"></td><td align="center">This person has a valid contract with<br><b>'.$other_insurance['name'].'</b><br>Please deactivate the persons contract there first!</td><td><img src="'.$root_path.'gui/img/common/default/level_7.gif" height="15" align="absmiddle"></td></tr></table></td></tr>';
			    	}   
			    	else // No its not, he is a valid member of this company
			    	{
			    		if($v['Contract']['ceiling_startup_subtraction']) $startupsubstraction=$v['Contract']['ceiling_startup_subtraction'];
			    		else $startupsubstraction=0;
			    		echo '<tr bgcolor="ffffdd"><td>Contract (Start/End):<br>'.date('m/d/Y',$contractarray['start_date']).' - '.date('m/d/Y',$contractarray['end_date']).'
			    		</td><td><input type="hidden" name="parent_'.$v['PID'].'" value="'.$v['Contract']['parent'].'"><input type="hidden" name="contract_'.$v['PID'].'" value="'.$v['Contract']['id'].'"><input type="hidden" name="this_'.$v['PID'].'" value="cancel"><input type="checkbox" name="action_'.$v['PID'].'" align="absmiddle" value="cancel"> Cancel contract</td><td align="center">'; $this->ShowInsuranceTypesDropDown('plan_'.$v['PID'],$v['Contract']['plan']); echo ' Subtraction: '.$startupsubstraction.' TSH</td></tr>';
						      	
			    	}
			  	}
			  	else
			  	{
			  		echo '';
			  	}
			}
  	}
  	else
  	{
			echo '<tr bgcolor="ffffaa"><td colspan="3" align="center">There is no valid actual contract for this company!<br><a href="insurance_company_tz_contracts_new.php?company_id='.$company_id.'">Click here to create a contract for this company.</a></td></tr>';
  	}

  	while(list($x,$v) = each($allcontracts))
  	{
			$result = $person_obj->getAllInfoObject($v['PID']);
			$person = $result->FetchRow();
			echo '<tr bgcolor="ffffaa"><td><img src="'.$root_path.'gui/img/common/default/lock.gif" height="15" align="absmiddle"><input type="hidden" name="this_'.$v['PID'].'" value="cancel">'.$person['name_last'].', '.$person['name_first'].' (Selian file nr: '.$person['selian_pid'].')</td><td>Status:</td><td>Plan / Start up substraction:</td></tr>';

    		echo '<tr bgcolor="ffffdd"><td>Contract (Start/End):<br>'.date('m/d/Y',$contractarray['start_date']).' - '.date('m/d/Y',$contractarray['end_date']).'
    		</td><td><input type="hidden" name="contract_'.$v['PID'].'" value="'.$v['id'].'"><input type="checkbox" name="action_'.$v['PID'].'" checked value="cancel"> Cancel contract</td><td align="center">'; $this->ShowInsuranceTypesDropDown('plan_'.$v['PID'],$v['plan']); echo '<input typ="text" value="'.$v['ceiling_startup_subtraction'].'" name="startup_'.$v['PID'].'"></td></tr>';
  	}
  	  	echo '</table>';
    return true;
  }
  
  
  
  //------------------------------------------------------------------------------
  
}

?>