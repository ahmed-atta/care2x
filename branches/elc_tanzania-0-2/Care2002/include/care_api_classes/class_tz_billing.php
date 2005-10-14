<?PHP

require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Billing methods for tanzania (the product-module is completely rewritten by Robert Meggle. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Robert Meggle
* @version beta 1.0.0
* @copyright 2005 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/

/*
Class Structure:

Class Core
    |
    `---> Class Notes
              |
              `--->Class Encounter
                        |
                        `----> Class Bill
*/              

class Bill extends Encounter {
  
  // Properties

	var $fields_tbl_bill=array(
                  'encounter_nr',
                  'first_date',
                  'create_id'); 
									
  var $tbl_bill='care_tz_billing';
  var $tbl_bill_elements='care_tz_billing_elem';
  
  var $tbl_bill_archive='care_tz_billing_archive';
  var $tbl_bill_archive_elements='care_tz_billing_archive_elem';
  
  
  var $tbl_lab_param='care_tz_laboratory_param';
  var $tb_drug_list='care_tz_druglist';
  var $tbl_prescriptions='care_encounter_prescription';
  var $tbl_lab_requests='care_test_request_chemlabor';
  
  var $fields_tbl_bill_elements=array (
                  'nr',
                  'date_change',
                  'is_labtest',
                  'is_medicine',
                  'is_comment',
                  'is_paid', 
                  'amount',
                  'description');
                  
  var $result;
  var $sql;
  var $debug;
  var $records;
  var $parameter_array;
  var $index;
  var $value;
  var $chemlab_testindex;
  var $chemlab_testname;
  var $chemlab_amount;
  var $price;
  var $medical_item_name;
  var $medical_item_amount;
  var $item_number;
  
  
  //------------------------------------------------------------------------------
  
  // Constructor
  function Bill() {
  }
  
  // Methods:
  
  /******************************************************************************
  *  PRIVATE
  **/

  
  function _check_tbl_exists($tbl_name) {
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;        
      $this->sql="SELECT * FROM $tbl_name LIMIT 0";
      return ($db->Execute($this->sql)) ? true : false;
  }

  function _delete_tbl($tbl_name) {
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;        
      $this->sql="DROP TABLE $tbl_name";
      return ($db->Execute($this->sql)) ? true : false;
  }


  //------------------------------------------------------------------------------    

  
  function _GetPendingResults($encounter_nr=FALSE) {
    /*
    * This private method goes through the main tables and returns an
    * result array (adodb) with hits or FALSE
    *
    * Definition of a pending bill:
    *   ************************************************************************
    *   ** A pending bill is a record that is not given by the billing table  **
    *   ** care_tz_billing (encounter_nr) but there are entries in the tables **
    *   ** care_test_request_chemlabor (encounter_nr) and                     **
    *   ** care_encounter_prescription (encounter_nr)                         **
    *   ************************************************************************    
    *  if $encounter_nr is set, then this private function just returns the
    *  records for this encounter. Default is FALSE for this value and this
    *  method returns a list of all
    */
    
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;    
  }
  
  /******************************************************************************
  *  PUBLIC
  **/

  function GetFirstPid() {
    global $db, $root_path;
    /*
    * Definition of a pending bill:
    *   ************************************************************************
    *   ** A pending bill is a record that is not given by the billing table  **
    *   ** care_tz_billing (encounter_nr) but there are entries in the tables **
    *   ** care_test_request_chemlabor (encounter_nr) and                     **
    *   ** care_encounter_prescription (encounter_nr)                         **
    *   ************************************************************************    
    */
    
    /* 
    * Note: 10.June 2005 by RM: This is an old function out of an billing experiment,
    * there is the possibility that this function is not working correctely but I haven't 
    * fond an error right now. Never touch a running and working routine... But:
    * If there is a need for it, please replace this function and note that there are
    * now flags in the pending encounter and laboratory table to determine this result.
    * This function should return the first pid what could have pending bills.
    */
    
    
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    
      $this->sql = "CREATE TEMPORARY TABLE 
                         tmp_care_tz_billing 
                    (
                   `encounter_nr` BIGINT ( 20 ) NOT NULL DEFAULT '0',
                    PRIMARY KEY ( `encounter_nr` )
                    ) TYPE = MyISAM;";
      $this->results = $db->Execute($this->sql);

    // ------> Section Chemlab <----------------
    // insert all entries of care_test_request_chemlab into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr)
                      SELECT  
                          	ctrc.encounter_nr as encounter_nr
                          FROM $this->tbl_lab_requests ctrc  
                            LEFT JOIN $this->tbl_bill ctb 
                            ON ctrc.encounter_nr = ctb.encounter_nr 
                            GROUP BY ctb.encounter_nr
                      ";    
    $this->results = $db->Execute($this->sql);
    
    // ------> Section Prescriptions <----------------
    // insert all entries of care_encounter_prescription into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr) 
                  SELECT 
                  	cep.encounter_nr as encounter_nr 
                  FROM care_encounter_prescription cep 
                  	LEFT JOIN care_tz_billing ctb 
                  		ON cep.encounter_nr = ctb.encounter_nr
                  GROUP BY ctb.encounter_nr
                  ";
    $this->results = $db->Execute($this->sql);
    
    // --------> final result <---------------
    // get the first encounter_nr out of the temporary billing table, that
    // is what we need!
    $this->sql = "SELECT ce.pid AS PID FROM tmp_care_tz_billing 
                	INNER JOIN care_encounter ce
                		ON ce.encounter_nr = tmp_care_tz_billing.encounter_nr
                  ORDER BY ce.encounter_nr DESC LIMIT 1";
    $this->results = $db->Execute($this->sql);
		if($this->first_pn=$this->results->FetchRow()) {
    	return $this->first_pn['PID'];
  	} else {
  	  return FALSE;
  	}
  }

  //------------------------------------------------------------------------------  
  function getAllEncounters() {
		global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;		
    if ($this->debug) echo "<br><b>statement from Method: class_tz_billing::GetAllEncounters:</b><br>"; 
		$this->sql="SELECT 
            encounter_nr
    FROM care_encounter
    
    ORDER BY encounter_nr DESC";						              
    
		$this->result=$db->Execute($this->sql);
		$i=0;
		while($encounters=$this->result->FetchRow()) {
			$enc_array[$i] = $encounters['encounter_nr'];
    	$i++;
  	}
  	return $enc_array;
	}
  //------------------------------------------------------------------------------  
  
  function GetAllEncountersOfPendingBills() {
    /**
    * This is e.g. for the left side navigation include
    */
    global $db, $root_path;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    /**
    * This function returns TRUE if there are some new items for that encounter number
    * that should be transfered into the billing table
    *
    **/
    
    if ($this->debug) echo "<b>class_tz_billing::GetAllEncountersOfPendingBills($encounter_nr)</b><br>";
    
    // include here the always repeading sql-statements to find out the pending bills:
    require($root_path."modules/billing_tz/inc_basic_statements/inc_temp_pending_bills_sql.php");
    
    $this->sql = "DROP TABLE tmp_care_tz_billing";
    $db->Execute($this->sql);
    
    return $this->results;
    
  }

  //------------------------------------------------------------------------------  

  function CheckForPendingBill($encounter_nr) {
    /**
    * returns TRUE if there is a pending Bill existing for this encounter
    */
    global $db;
    $this->debug=FALSE;
    if ($this->debug) echo "<br><b>class_tz_billing::CheckForExistingBill($encounter_nr)</b><br>";
    $this->sql="select encounter_nr FROM care_tz_billing where encounter_nr=$encounter_nr LIMIT 0,1";
    $this->result=$db->Execute($this->sql);
    
    return ($this->result->RecordCount())? TRUE : FALSE;
  }

  
  //------------------------------------------------------------------------------  
  
  function PendingBillObjects($encounter_nr) {
    /**
    * returns TRUE if at least one item in the billing table are missing...
    */
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>class_tz_billing::GetPendingObjects($encounter_nr)</b><br>";
    // prescription:
    // read all items out of the prescription table where no bill_number is given for this encounter
    $this->sql = "select 
                  	article_item_number 
                  from $this->tbl_prescriptions
                  where isnull(bill_number) AND encounter_nr=".$encounter_nr;
    $this->result=$db->Execute($this->sql); 
    if ($this->result->RecordCount()>0) 
      return TRUE;
      
    //laboratory:
    // read all items out of the laboratory table where no bill_number is given for this encounter
    $this->sql="select 
                        encounter_nr 
                FROM 
                  $this->tbl_lab_requests
                where isnull(bill_number) AND encounter_nr=".$encounter_nr;
    $this->result=$db->Execute($this->sql); 
    if ($this->result->RecordCount()>0) 
      return TRUE;

    return FALSE; // We have nothing to do... no pending issues in the tables!                
                
  }
  
  //------------------------------------------------------------------------------  
 
  function DisplayArchivedBillHeadlines() {
    global $db;
    $enc_obj = New Encounter;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>class_tz_billing::DisplayArchivedBillHeadlines</b><br>";    
    $this->sql="SELECT `nr`, `encounter_nr`, `first_date` FROM care_tz_billing_archive order by first_date DESC";
    $this->request=$db->Execute($this->sql);
    $color_change=FALSE;
    while ($this->res=$this->request->FetchRow()) {

      if ($color_change) {
        $BGCOLOR='bgcolor="#ffffdd"';
        $color_change=FALSE;
      } else {
        $BGCOLOR='bgcolor="#ffffaa"';
        $color_change=TRUE;
      }
  	  //$encoded_batch_number = $enc_obj->ShowPID($batch_nr);
  	  $enc_number = $enc_obj->GetEncounterFromBatchNumber($batch_nr);      
  	  
      $this->bill_number=$this->res['nr'];
      $this->encounter_number=$this->res['encounter_nr'];
      $this->batch_number=$enc_obj->GetBatchFromEncounterNumber($this->encounter_number);
      $this->date=$this->res['first_date'];
      $enc_data = $enc_obj->loadEncounterData($this->encounter_number);
  		echo '<script language="javascript" >
            <!-- 
            function printOut_'.$this->bill_number.'()
            {
            	urlholder="show_bill.php?bill_number='.$this->bill_number.'&batch_nr='.$this->batch_number.'&printout=TRUE&show_archived_bill=TRUE";
            	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
              
            }
            // -->
            </script> 
            ';

      echo '<tr>
  					  <td '.$BGCOLOR.'><div align="center"><a href="javascript:printOut_'.$this->bill_number.'()">'.$this->bill_number.'</a></div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.date("d.m.Y",$this->date).'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$enc_obj->ShowPID($this->batch_number).'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$this->encounter_number.'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$enc_obj->FirstName($enc_data).' '.$enc_obj->LastName($enc_data).'</div></td>
  					</tr> ';
    }
  }
  
  
  //------------------------------------------------------------------------------  
  
  function GetBill($encounter_nr) {
    global $db;
    /**
    * Returns the ident bill number 
    */
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetBill()</b><br>";
    $this->sql = "SELECT nr FROM $this->tbl_bill WHERE encounter_nr=".$encounter_nr." limit 0,1 ";    
    $this->request = $db->Execute($this->sql);
    if ($this->result=$this->request->FetchRow())
      return $this->result[0];
    
  }
  
  //------------------------------------------------------------------------------  
  
  function CreateNewBill($encounter_nr) {
    global $db;
    /**
    * Returns the ident bill number 
    */
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::CreateNewBill()</b><br>";
    $this->sql = "INSERT INTO care_tz_billing (encounter_nr, first_date, create_id) VALUES ('".$encounter_nr."','".time()."','') ";    
    $this->request = $db->Execute($this->sql);
    return $db->Insert_ID();
  }
  
  //------------------------------------------------------------------------------  
  
  function GetPendingLaboratoryBills($encounter_nr) {
    global $db, $root_path;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

      $this->sql = "CREATE TEMPORARY TABLE 
                         tmp_care_tz_billing 
                    (
                   `encounter_nr` BIGINT ( 20 ) NOT NULL DEFAULT '0'
                    ) TYPE = HEAP;
                ";
      $this->results = $db->Execute($this->sql);

    // ------> Section Chemlab <----------------
    // insert all entries of care_test_request_chemlab into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr)
                      SELECT  
                          	ctrc.encounter_nr as encounter_nr
                          FROM $this->tbl_lab_requests ctrc  
                            LEFT JOIN $this->tbl_bill ctb 
                              ON ctrc.encounter_nr = ctb.encounter_nr 
                              	LEFT JOIN $this->tbl_bill_elements ctb_elem
                              		ON ctb_elem.nr = ctb.nr
                  WHERE ctb_elem.is_labtest=1
                  GROUP BY ctb.encounter_nr";    
    $this->results = $db->Execute($this->sql);
    
    
    // now we have all pending bills in this temporary table. The next step is to find out
    // what encounters are for laboratory and if there is this encounter_nr in it.
    
    $this->sql = "SELECT tmp_care_tz_billing.encounter_nr FROM tmp_care_tz_billing 
                  where tmp_care_tz_billing.encounter_nr=".$encounter_nr;

    $this->result = $db->Execute($this->sql);
    
    $this->sql = "DROP TABLE tmp_care_tz_billing";
    $db->Execute($this->sql);
    
    return ($this->result) ? $this->result : FALSE;
  }

	//------------------------------------------------------------------------------  
	
	function GetPendingPrescriptionBills($encounter_nr) {
    global $db, $root_path;
    $this->debug=FALSE; // Note that in this method are two times this debugging should be set!

    if ($this->_check_tbl_exists("tmp_care_tz_billing")) {
      if ($this->debug) echo "there is a tmp-table, I'll erase it...<br>";
      $this->_delete_tbl("tmp_care_tz_billing");
    }
    
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    
    if ($this->debug) echo "<b>class_tz_billing::GetPendingPrescriptionBills($encounter_nr)</b>";

    // include here the always repeading sql-statements to find out the pending bills:
    // require($root_path."modules/billing_tz/inc_basic_statements/inc_temp_pending_bills_sql.php");

      $this->sql = "CREATE TEMPORARY TABLE 
                         tmp_care_tz_billing 
                    (
                   `encounter_nr` BIGINT ( 20 ) NOT NULL DEFAULT '0'
                    ) TYPE = HEAP;";
      $this->results = $db->Execute($this->sql);


    // ------> Section Prescriptions <----------------
    // insert all entries of care_encounter_prescription into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr) 
                  SELECT 
                  	cep.encounter_nr as encounter_nr 
                  FROM care_encounter_prescription cep 
                  	LEFT JOIN care_tz_billing ctb 
                  		ON cep.encounter_nr = ctb.encounter_nr
                      	LEFT JOIN $this->tbl_bill_elements ctb_elem
                      		ON ctb_elem.nr = ctb.nr
                  WHERE cep.encounter_nr=".$encounter_nr." AND isnull(ctb_elem.nr)";
    $this->results = $db->Execute($this->sql);
    
    $this->sql = "SELECT encounter_nr FROM tmp_care_tz_billing 
                  where encounter_nr=".$encounter_nr;

    if ($this->result = $db->Execute($this->sql))
      if ($this->debug) echo "There are ".$this->result->RecordCount()." outstanding prescriptions for the billing table<br>";

    while ($rr=$this->result->FetchRow()) echo $rr[0]."<br>";
    
    $this->_delete_tbl("tmp_care_tz_billing");    
    
    return ($this->result) ? $this->result : FALSE;
	}
	//------------------------------------------------------------------------------  
	
	function StoreToBill($encounter_nr, $bill_number){
	  global $db;
	  $this->debug=FALSE;
	  if ($this->debug) echo "<b>class_tz_billing::StoreToBill(encounter_nr: $encounter_nr, bill_number: $bill_number)</b><br>";
	  ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    // do we have pending issues of prescriptions?
    // read all items out of the prescription table
    $this->sql = "select 
                  	article_item_number,
                    article,
                    notes,
                    dosage,
                    price
                  from $this->tbl_prescriptions
                  where isnull(bill_number) AND encounter_nr=".$encounter_nr;
    $this->result=$db->Execute($this->sql); 
    while ($this->records=$this->result->FetchRow()) {        
        $this->item_number=$this->records['article_item_number'];
        $this->medical_item_name  =$this->records['article'];
        $this->medical_item_name  .= "(".$this->records['notes'].")";
        $this->medical_item_amount=$this->records['dosage'];
        $this->price              =$this->records['price'];
        // The amount of this medical item could be translated into the real amount...
        $this->medical_item_amount = $this->ConvertMedicalItemAmount($this->medical_item_amount);
        $this->sql ="INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, price, description)
							 			VALUES (".$bill_number.",".time().",0,1,'".$this->medical_item_amount."','".$this->price."','".$this->medical_item_name."')";
			  $db->Execute($this->sql);          
  
        // Mark these lines in the table prescription as "still billed". We can do this
        // in that way: Insert the billing number where we can find this article again...
        $this->sql="UPDATE $this->tbl_prescriptions SET bill_number='".$bill_number."', bill_status='pending' WHERE isnull(bill_number) AND encounter_nr=".$encounter_nr;
        $db->Execute($this->sql);
    }
    
    // And now the laboratory...
    $this->sql = "select 
                          encounter_nr, 
                          parameters 
                  FROM $this->tbl_lab_requests
                  WHERE encounter_nr=".$encounter_nr." AND isnull(bill_number)";
    $this->parameters = $db->Execute($this->sql);
    while ($this->records=$this->parameters->FetchRow()) {
      if ($this->debug) echo $this->records['parameters']."<br>";
      parse_str($this->records['parameters'],$this->parameter_array);
      while(list($this->index,$this->chemlab_amount) = each($this->parameter_array)) {
  				//Strip the string baggage off to get the task id
  				$this->chemlab_testindex = substr($this->index,5,strlen($this->index)-6);
          $this->chemlab_testname = $this->GetNameOfLAboratoryFromID($this->chemlab_testindex);
          $this->price = $this->GetPriceOfLAboratoryItemFromID($this->chemlab_testindex);
          if ($this->debug) echo "the name of chemlab is:".$this->chemlab_testname." with a amount of ".$this->chemlab_amount."<br>";
          // we have it all... now we store it into the billing-elements-table
          $this->sql ="INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, price, description)
								 			VALUES (".$bill_number.",".time().",1,0,".$this->chemlab_amount.",'".$this->price."','".$this->chemlab_testname."')";
				  $db->Execute($this->sql);
								 			
			  }          
    }
    // Mark these lines in the table prescription as "still billed". We can do this
    // in that way: Insert the billing number where we can find this article again...
    $this->sql="UPDATE $this->tbl_lab_requests SET bill_number='".$bill_number."' , bill_status='pending' WHERE isnull(bill_number) AND encounter_nr=".$encounter_nr;
    $db->Execute($this->sql);

	}
	
	
	//------------------------------------------------------------------------------  
	
	function StoreToPendingBills($requests,$bill_number,$kind_of){
	  
	  /**
	  * Class to store the pending items into the billing table.
	  * Note that the $request should have following informations:
	  * encounter_nr , parameters and price
	  */
	  global $db;
	  $this->debug=FALSE;
	  if ($this->debug) echo "<b>class_tz_billing::StoreToPendingBills($requests,$bill_number,$kind_of)</b><br>";
	  ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b> class_tz_billing::StoreToPendingBills($requests,$bill_number,$kind_of)</b><br>";
    if (empty($kind_of)) {
      if ($this->debug) echo "<b> NO KIND-OF PARAMETER IS GIVEN!!</b><br>";
      return FALSE;
    }

		$requests->MoveFirst();
		$enc=0;
		$current_encounter="";
		
		if ($kind_of=="laboratory") {
		  if ($this->debug) echo "  <h1>...this is a laboratory item</h1><br>";
		  if ($this->debug) echo "  ...we have ".$requests->RecordCount()." items to manage<br>";
		  while ($this->records=$requests->FetchRow()) {
		    if ($this->debug) echo "<b>".$this->records[0]."</b><br>";
		    // get the parameter string of the laboratory tasks...
		    $this->sql = "select 
		                          encounter_nr, 
		                          parameters 
		                  FROM care_test_request_chemlabor
                      WHERE encounter_nr=".$this->records[0]." 
                      GROUP BY encounter_nr";
        $this->parameters = $db->Execute($this->sql);
        if ($this->records=$this->parameters->FetchRow()) {
          if ($this->debug) echo $this->records['parameters']."<br>";
          parse_str($this->records['parameters'],$this->parameter_array);
          while(list($this->index,$this->chemlab_amount) = each($this->parameter_array)) {
      				//Strip the string baggage off to get the task id
      				$this->chemlab_testindex = substr($this->index,5,strlen($this->index)-6);
              $this->chemlab_testname = $this->GetNameOfLAboratoryFromID($this->chemlab_testindex);
              $this->price = $this->GetPriceOfLAboratoryItemFromID($this->chemlab_testindex);
              if ($this->debug) echo "the name of chemlab is:".$this->chemlab_testname." with a amount of ".$this->chemlab_amount."<br>";
              // we have it all... now we store it into the billing-elements-table
              $this->sql ="INSERT INTO care_tz_billing_elem (nr, date_change, is_labtest, is_medicine, amount, price, description)
  									 			VALUES (".$bill_number.",".time().",1,0,".$this->chemlab_amount.",'".$this->price."','".$this->chemlab_testname."')";
  					  $db->Execute($this->sql);
  									 			
    			  }          
        }
		  }
		}
		
		if ($kind_of=="prescription") {
		  if ($this->debug) echo "  <h1>...this is a prescription item</h1><br>";
		  if ($this->debug) echo "  ...we have ".$requests->RecordCount()." items to manage<br>";		  
		  if ($this->records=$requests->FetchRow()) {
		    if ($this->debug) echo "<b>".$this->records[0]."</b><br>";
		    // get the parameter string of the laboratory tasks...
		    $this->sql = "select 
		                          encounter_nr, 
		                          article,notes,
		                          dosage,
		                          price
		                  FROM care_encounter_prescription
                      WHERE encounter_nr=".$this->records[0];
        $this->parameters = $db->Execute($this->sql);
        while ($this->records=$this->parameters->FetchRow()) {
          if ($this->debug) echo $this->records['article']."<br>";
          $this->medical_item_name  =$this->records['article'];
          $this->medical_item_name  .= "(".$this->records['notes'].")";
          $this->medical_item_amount=$this->records['dosage'];
          $this->price              =$this->records['price'];
          // The amount of this medical item could be translated into the real amount...
          $this->medical_item_amount = $this->ConvertMedicalItemAmount($this->medical_item_amount);
          $this->sql ="INSERT INTO care_tz_billing_elem (nr, date_change, is_labtest, is_medicine, amount, price, description)
								 			VALUES (".$bill_number.",".time().",0,1,'".$this->medical_item_amount."','".$this->price."','".$this->medical_item_name."')";
				  $db->Execute($this->sql);          
        }
      }
		}
		
	  return TRUE;
	}
	
	//------------------------------------------------------------------------------
	
	function ConvertMedicalItemAmount ( $amount ) {
	  return $amount;
	}

  //------------------------------------------------------------------------------

  function GetPriceOfItem($item_number) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT unit_price as price FROM $this->tb_drug_list WHERE item_id = '$item_number' ";
    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        $this->item_array = $this->result->GetArray();
		          while (list($x,$v)=each($this->item_array)) {
                $db->debug=FALSE;
		            return $v['price'];
		          }
			} else {
			  $db->debug=FALSE;
				return false;
			}
		}
  } // end of function GetPriceOfItem($item_number) 
  
  //------------------------------------------------------------------------------
  
  function GetPrescriptionDetails() {
  }
  
  //------------------------------------------------------------------------------

  function GetNameOfItem($item_number) {
    global $db;
    $debug=FALSE;
    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
    $this->sql="SELECT item_description as description FROM $this->tb_drug_list WHERE item_id = '$item_number' ";
    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        $this->item_array = $this->result->GetArray();
		          while (list($x,$v)=each($this->item_array)) {
                $db->debug=FALSE;
		            return $v['description'];
		          }
			} else {
			  $db->debug=FALSE;
				return false;
			}
		}
  } // end of function GetNameOfDrug($item_number) 
  
  //------------------------------------------------------------------------------
  
  function GetBillNumbersFromPID($pid) {
  	global $db;
    $debug=FALSE;
    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
  	$this->sql="SELECT cb.nr FROM ".$this->tbl_bill." cb, ".$this->tbl_bill_elements." cbe, care_encounter ce, care_person cp
					 WHERE cb.encounter_nr = ce.encounter_nr
					 AND ce.pid = cp.pid
					 AND cbe.nr = cb.nr
					 AND cp.pid = $pid
					 GROUP BY cb.nr";
		return $db->Execute($this->sql);
	}
  
  //------------------------------------------------------------------------------

  function GetArchivedBill($bill_nr) {
  	global $db;
  	$this->sql="SELECT nr FROM care_tz_billing_archive WHERE nr=".$bill_nr;
		return $db->Execute($this->sql);
	}


  //------------------------------------------------------------------------------

  function VerifyBill($bill_nr) {
  	global $db;
  	$this->sql="SELECT nr FROM ".$this->tbl_bill." WHERE nr=".$bill_nr;
  	//echo $this->sql;
		return $db->Execute($this->sql);
	}
  

  //------------------------------------------------------------------------------

  
  function GetElemsOfArchivedBill($nr,$what_kind_of) {
  	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  	if ($what_kind_of=="prescriptions")
  	  $sql_where = " AND is_medicine=1 ";

  	if ($what_kind_of=="laboratory")
  	  $sql_where = " AND is_labtest=1 ";

  	  
  	$this->sql="SELECT * FROM care_tz_billing_archive_elem
					 WHERE nr = ".$nr." ".$sql_where."
					 ORDER BY date_change ASC";
		return $db->Execute($this->sql);
	}

  //------------------------------------------------------------------------------

  
  function GetElemsOfBill($nr,$what_kind_of) {
  	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  	if ($what_kind_of=="prescriptions")
  	  $sql_where = " AND is_medicine=1 ";

  	if ($what_kind_of=="laboratory")
  	  $sql_where = " AND is_labtest=1 ";

  	  
  	$this->sql="SELECT * FROM ".$this->tbl_bill_elements."
					 WHERE nr = ".$nr." ".$sql_where."
					 ORDER BY date_change ASC";
		return $db->Execute($this->sql);
	}
	
	//------------------------------------------------------------------------------
	
	function GetNameOfLAboratoryFromID($id)	{
		global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;		
  	$this->sql="SELECT name FROM ".$this->tbl_lab_param."
					 WHERE id = '".$id."'";
		$this->result = $db->Execute($this->sql);
		if ($this->records=$this->result->FetchRow())
  		return $this->records['name'];
	}
	
	//------------------------------------------------------------------------------

	function GetPriceOfLAboratoryItemFromID($id)	{
		global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;		
  	$this->sql="SELECT price FROM ".$this->tbl_lab_param."
					 WHERE id = '".$id."'";
		$this->result = $db->Execute($this->sql);
		if ($this->records=$this->result->FetchRow())
  		return $this->records['price'];
	}
	
	//------------------------------------------------------------------------------
	
	function DisplayBillHeadline($bill_nr, $batch_nr) {
	  
	  $enc_obj = New Encounter;
	  $encoded_batch_number = $enc_obj->ShowPID($batch_nr);
	  $enc_number = $enc_obj->GetEncounterFromBatchNumber($batch_nr);
	  
		

	  
	  if ($enc_obj->EncounterExists($enc_number)) {
	    // Load the encounter data:
	    $enc_data = $enc_obj->loadEncounterData($enc_number);
  	  
  	  echo '		
  	  <table border="0" cellspacing=1 cellpadding=0 width="50%">
  				<tr>
  					<td class="adm_item"><b>Batch file no.</b></td>
  					<td class="adm_item"><b>'.$encoded_batch_number.'</b></td>
  					<td rowspan="7">&nbsp;<td>
  				</tr>
  				<tr>
  					<td class="adm_item">Encounter/Reg.Nr.:</td>
  					<td bgcolor="#ffffee" class="vi_data"><b>'.$enc_number.'</b></td>
  				</tr>
  				<tr>
  					<td class="adm_item">Surname/Ukoo:</td>
  					<td bgcolor="#ffffee" class="vi_data"><b>'.$enc_obj->LastName($enc_number).'</b></td>
  				</tr>
  				<tr>
  					<td class="adm_item">First name:</td>
  					<td bgcolor="#ffffee" class="vi_data">'.$enc_obj->FirstName($enc_number).'</td>
  				</tr>
  				<tr>
  					<td class="adm_item">Date of birth:</td>
  					<td bgcolor="#ffffee" class="vi_data">'.$enc_obj->BirthDate($enc_number).'</td>
  				</tr>
  				<tr>
  					<td class="adm_item">Sex:</td>
  					<td class="adm_input">'.$enc_obj->Sex($enc_number).'</td>
  				</tr>
  				<tr>
  					<td class="adm_item"><b>Bill Number:</b></td>
  					<td class="adm_item"><b>'.$bill_nr.'</b></td>
  				</tr>
  				
  		</table>';
      return TRUE;	  
    }
  return FALSE;
	} 
	
	//------------------------------------------------------------------------------  
	
	function DisplayArchivedLaboratoryBill($bill_nr,$edit_fields) {
    global $root_path;
    $sum_price=0;

  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Laboratory</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfArchivedBill($bill_nr,"laboratory");
      			//echo "edit fields is set to:".$edit_fields;
      			echo '
      			<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>
      				<td><b>part. sum</b></td>
      				<td><b>';
      				echo 'Already paid?';
      				echo '</b><td>';
      				if ($edit_fields) echo "<td>Edit</td>";
              echo '</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_labtest']==1)
      				{
      				  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$this->chemlab_testname=$bill_elems_row['description'];
      					$this->price=$bill_elems_row['price'];
      					if (empty($this->price)) $this->price="0,00";
      					
      				}
      				$part_sum = ($this->price*$bill_elems_row['amount']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td width="100">'.$pos_nr.'</td>
        				<td width="200">'.$this->chemlab_testname.'</td>
        				<td width="100">'.$this->price.'</td>
        				<td width="100">'.$bill_elems_row['amount'].'</td>
        				<td width="100">'.number_format($part_sum,2,',','.').'</td>
        				<td width="100">
        				';
        				if($bill_elems_row['is_paid']==1)
        				{ 
        					echo "Yes</td>";
        				}
        				else
        				{
        					echo "No</td>";
        					$sum_to_pay += $part_sum;
        				}
        				echo "<td>&nbsp;</td>";
        				if ($edit_fields) echo '<td><a href="billing_tz_edit.php?mode=edit_elem&billing_item='.$this->tbl_bill_elem_ID.'"><img src="'.$root_path.'gui/img/common/default/bul_arrowgrnsm.gif" border="0"></td>';
                echo "</tr>";
      				
      			}

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td><i>total amount:</i></td>
      				<td><i>'.number_format($sum,2,',','.').'</i> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td><b>open item accountinga:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>======</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			
      			echo '</table>';
      			echo '
      	  </td>
      	</tr>';
      	
  	echo'
  	</table>';
	  
	}	
	
	//------------------------------------------------------------------------------  
	
	function DisplayLaboratoryBill($bill_nr,$edit_fields) {
		global $root_path, $billnr, $batch_nr;
    $sum_price=0;

  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Laboratory</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfBill($bill_nr,"laboratory");
      			//echo "edit fields is set to:".$edit_fields;
      			echo '
      			<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>
      				<td><b>part. sum</b></td>
      				<td><b>';
      				echo 'Already paid?';
      				echo '</b><td>';
      				if ($edit_fields) echo "<td>Edit</td>";
              echo '</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_labtest']==1)
      				{
      				  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$this->chemlab_testname=$bill_elems_row['description'];
      					$this->price=$bill_elems_row['price'];
      					if (empty($this->price)) $this->price="0,00";
      					
      				}
      				$part_sum = ($this->price*$bill_elems_row['amount']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td width="100">'.$pos_nr.'</td>
        				<td width="200">'.$this->chemlab_testname.'</td>
        				<td width="100">'.$this->price.'</td>
        				<td width="100">'.$bill_elems_row['amount'].'</td>
        				<td width="100">'.number_format($part_sum,2,',','.').'</td>
        				<td width="100">
        				';
        				if($bill_elems_row['is_paid']==1)
        				{ 
        					echo "Yes</td>";
        				}
        				else
        				{
        					echo "No</td>";
        					$sum_to_pay += $part_sum;
        				}
        				echo "<td>&nbsp;</td>";
        				if ($edit_fields) echo '<td><a href="billing_tz_edit.php?mode=edit_elem&billing_item='.$this->tbl_bill_elem_ID.'"><img src="'.$root_path.'gui/img/common/default/bul_arrowgrnsm.gif" border="0"></td>';
                echo "</tr>";
      				
      			}

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td>----------</td>      			
      				';
      			if ($edit_fields) 
      			{
      				echo '<td colspan="3">';
      				echo '<a href="'.URL_APPEND.'&mode=allpaid&batch_nr='.$batch_nr.'&billnr='.$billnr.'">Pay all items at once now</a></td>';
      			}
      			else echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td><i>total amount:</i></td>
      				<td><i>'.number_format($sum,2,',','.').'</i> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td><b>open item accountingb:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>======</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			
      			echo '</table>';
      			echo '
      	  </td>
      	</tr>';
      	
  	echo'
  	</table>';
	  
	}
	
	//------------------------------------------------------------------------------  
	
	function DisplayArchivedPrescriptionBill($bill_nr, $edit_fields){
	  global $root_path;
  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Prescriptions</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfArchivedBill($bill_nr,"prescriptions");
      			
      			echo '
      			<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>
      				<td><b>part. sum</b></td>
      				<td><b>';
      				echo 'Already paid?';
      				echo '</b><td>';
      				if ($edit_fields) echo "<td>Edit</td>";
              echo '</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_medicine']==1)
      				{
      					$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$desc = $bill_elems_row['description'];
      					$price = $bill_elems_row['price'];
      				}
      				$part_sum = ($price*$bill_elems_row['amount']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td width="100">'.$pos_nr.'
      				  </td>
        				<td width="200">'.$desc.'
        				</td>
        				<td width="100">'.$price.'
        				</td>
        				<td width="100">'.$bill_elems_row['amount'].'
        				</td>
        				<td width="100">'.number_format($part_sum,2,',','.').'
        				</td>
        				<td>
        				';
        				if($bill_elems_row['is_paid']==1)
        				{ 
        					echo "Yes";
        				}
        				else
        				{
        					echo "No";
        					$sum_to_pay += $part_sum;
        				}
        				echo "<td>&nbsp;</td>";
        				if ($edit_fields) echo '<td><a href="billing_tz_edit.php?mode=edit_elem&billing_item='.$this->tbl_bill_elem_ID.'"><img src="'.$root_path.'gui/img/common/default/bul_arrowgrnsm.gif" border="0"></td>';
                echo "</tr>";
      				
      			}
      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td><i>total amount:</i></td>
      				<td><i>'.number_format($sum,2,',','.').'</i> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td><b>open item accountingc:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>======</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			
      			echo '</table>';
      			echo '
      		</td>
      	</tr>';
      	
  	echo'
  	</table>';
	  	  
	  return TRUE;
	}

	//------------------------------------------------------------------------------  
	
	function DisplayPrescriptionBill($bill_nr, $edit_fields){
	  global $root_path, $billnr, $batch_nr;
  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Prescriptions</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfBill($bill_nr,"prescriptions");
      			
      			echo '
      			<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>
      				<td><b>part. sum</b></td>
      				<td><b>';
      				echo 'Already paid?';
      				echo '</b><td>';
      				if ($edit_fields) echo "<td>Edit</td>";
              echo '</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_medicine']==1)
      				{
      					$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$desc = $bill_elems_row['description'];
      					$price = $bill_elems_row['price'];
      				}
      				$part_sum = ($price*$bill_elems_row['amount']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td width="100">'.$pos_nr.'
      				  </td>
        				<td width="200">'.$desc.'
        				</td>
        				<td width="100">'.$price.'
        				</td>
        				<td width="100">'.$bill_elems_row['amount'].'
        				</td>
        				<td width="100">'.number_format($part_sum,2,',','.').'
        				</td>
        				<td>
        				';
        				if($bill_elems_row['is_paid']==1)
        				{ 
        					echo "Yes";
        				}
        				else
        				{
        					echo "No";
        					
        					$sum_to_pay += $part_sum;
        				}
        				echo "<td>&nbsp;</td>";
        				if ($edit_fields) echo '<td><a href="billing_tz_edit.php?mode=edit_elem&billing_item='.$this->tbl_bill_elem_ID.'"><img src="'.$root_path.'gui/img/common/default/bul_arrowgrnsm.gif" border="0"></td>';
                echo "</tr>";
      				
      			}
      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td>----------</td>      			
      				';
      			if ($edit_fields) 
      			{
      				echo '<td colspan="3">';
      				echo '<a href="'.URL_APPEND.'&mode=allpaid&batch_nr='.$batch_nr.'&billnr='.$billnr.'">Pay all items at once now</a></td>';
      			}
      			else echo '<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td><i>total amount:</i></td>
      				<td><i>'.number_format($sum,2,',','.').'</i> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td><b>open item accountingd:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>======</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			
      			echo '</table>';
      			echo '
      		</td>
      	</tr>';
      	
  	echo'
  	</table>';
	  	  
	  return TRUE;
	}


//------------------------------------------------------------------------------  

function EditBillElement($id) {
  global $root_path, $db;
  // get the elements out of this billing-table:
  $this->sql = "SELECT 
                      care_tz_billing_elem.nr,
                      care_tz_billing.encounter_nr, 
                      care_tz_billing_elem.description,
                      care_tz_billing_elem.price,
                      care_tz_billing_elem.amount,
                      care_tz_billing_elem.is_paid
                FROM 
                  care_tz_billing_elem 
                    INNER JOIN care_tz_billing 
                      ON care_tz_billing.nr=care_tz_billing_elem.nr 
                WHERE care_tz_billing_elem.ID=".$id;
  $this->result = $db->Execute($this->sql);
  if ($this->row=$this->result->FetchRow()) {
	  $enc_obj = New Encounter;
	  
    $this->bill_number=$this->row['nr'];
    
    $this->encounter_nr=$this->row['encounter_nr'];
    $this->batch_nr=$enc_obj->GetBatchFromEncounterNumber($this->encounter_nr);
    
    $this->description=$this->row['description'];
    $this->price=$this->row['price'];
    $this->amount=$this->row['amount'];
    
    $this->payed_status_checked = '';
    $this->outstanding_checked  = '';
    if ($this->is_paid=$this->row['is_paid'])
        $this->payed_status_checked = 'checked';
    else
        $this->outstanding_checked = 'checked';
  }
  
  //echo $this->batch_nr;
  $this->DisplayBillHeadline($this->bill_number, $this->batch_nr);
  
  echo '<table width="800" border="1">';
  echo '
<link rel="stylesheet" href="'.$root_path.'css/themes/default/default.css" type="text/css">
<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
          <tr valign=top  class="warnprompt" >
            <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Billing: modification item</font> </td>
            <td bgcolor="#99ccff" align=right>&nbsp; </td>
          </tr>
       </table>
 		</td>
	</tr>
	<tr>
    <td bgcolor=#ffffff valign=top> 
      <font class="warnprompt"><br></font>
      <form ENCTYPE="multipart/form-data" action="billing_tz_edit.php" method="post" name="inputform">
	      <table border=0 cellspacing=1 cellpadding=3>
            <tbody class="submenu">
              <tr> 
                <td align=right width=339 >description</td>
                <td width="339"><input type="text" name="description" value="'.$this->description.'"  size=50 maxlength=50></td>
                <td width="37" rowspan=14 valign=top> <br> </td>
              </tr>
              <tr> 
                <td align=right width=339>price</td>
                <td><input name="price" type="text" value="'.$this->price.'"  size=10 maxlength=10> 
                </td>
              </tr>
              <tr> 
                <td align=right> Amount</td>
                <td><input type="text" name="amount" value="'.$this->amount.'"  size=10 maxlength=10> 
                </td>
              </tr>
              <tr> 
                <td align=right width=339> payment status of this billing item</td>
                <td> 
                    <input type="radio" name="payment_status" value="paid" '.$this->payed_status_checked.'> paid
                    <input name="payment_status" type="radio" value="outstanding" '.$this->outstanding_checked.'> outstanding
                </td>
              </tr>
              <tr> 
                <td colspan="2" align=right>&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width=339>&nbsp;</td>
                <td align=right> 
                    Prepare this dataset for 
                    <select name="specific_mode">
                      <option value="delete">Delete</option>
                      <option value="update" selected>Update</option>
                    </select> 
                    <input type="hidden" name="mode" value="modfication">
                    <input type="hidden" name="bill_elem_number" value="'.$id.'">
                    <input type="hidden" name="encounter_nr" value="'.$this->encounter_nr.'">
                    <input type="hidden" name="batch_nr" value="'.$this->batch_nr.'">
                    <input type="submit" value="OK"> 
                  </td>
              </tr>
            </tbody>
          </table>
        </form>
      <a href="'.$root_path.'modules/billing_tz/billing_tz_pending.php"><img src="'.$root_path.'gui/img/control/default/en/en_cancel.gif" border=0 align="left" width="103" height="24" alt="Cancel and go back"></a>									
		  </td>
  	</tr>
		<tr valign=top >
		  <td bgcolor=#cccccc>
  		  <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
        <tr>
          <td align="center">
            <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
              <tr>
   	            <td>
	                <div class="copyright"></div>
	              </td>
              <tr>
            </table>
          </td>
        </tr>
        </table>
		  </td>
  	</tr>
	</tbody>
 </table>';
  echo '</table>';      
  return TRUE;
}
//------------------------------------------------------------------------------  

function update_bill_element($bill_elem_number, $is_paid, $amount, $price, $description) {
  global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  $this->sql="UPDATE care_tz_billing_elem SET 
                `is_paid` = '".$is_paid."',
                `amount` = '".$amount."',
                `price` = '".$price."',
                `description` = '".$description."'
             WHERE `ID` = '".$bill_elem_number."'";
  $db->Execute($this->sql);
  return TRUE;
}

function update_bill_element_allpaid($billnr, $is_paid) {
  global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  $this->sql="UPDATE care_tz_billing_elem SET 
                `is_paid` = '".$is_paid."'
             WHERE `nr` = ".$billnr;
  $db->Execute($this->sql);
  return TRUE;
}

//------------------------------------------------------------------------------  


//------------------------------------------------------------------------------  

function delete_bill_element($bill_elem_number) {
  global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  $this->sql="DELETE FROM care_tz_billing_elem 
             WHERE `ID` = '".$bill_elem_number."'";
  $db->Execute($this->sql);
  return TRUE;
}


//------------------------------------------------------------------------------  
	
	function DisplayArchivedBills($batch_nr, $specific_bill, $edit_fields) {
	  if (func_num_args()>3)
	    $printout=func_get_arg (3);
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
		*/
		global $db;
		
  	echo '
  	<table width="800" border="1">

  		';
  			$billnumbers=$this->GetArchivedBill($specific_bill);

  		while($bills=$billnumbers->FetchRow()) { 

        if ($printout==FALSE) {
      		//Java script for print out the bill
      		// We have to place it here, because here is one place where we have the bill number what is 
      		// definetly displayed on the user-screen 
      		echo '<script language="javascript" >
                <!-- 
                function printOut_'.$bills['nr'].'()
                {
                	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
                	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
                  
                }
                // -->
                </script> 
                ';
        }
  		  
				echo '
					<tr>
						<td>';
						$this->DisplayBillHeadline($bills['nr'], $batch_nr);
						echo '
						</td>
					</tr>';
  			$sum_to_pay =0;
  			$sum = 0;
  			
  			$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"laboratory");
				if($bill_elems_row=$billelems->FetchRow())
				{			
	  			echo '
	  			<tr>
	  				<td valign="top">';
	  					$this->DisplayArchivedLaboratoryBill($bills['nr'],$edit_fields);
	      	echo '
	      		</td>
	      	</tr>';
      	}
      	$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"prescriptions");
				if($bill_elems_row=$billelems->FetchRow())
				{
					echo '
	  			<tr>
	  				<td valign="top">';
	  					$this->DisplayArchivedPrescriptionBill($bills['nr'],$edit_fields);
	      		echo '
	      		</td>
	      	</tr>';
      	}
      	
      	// is there the edit_fields flag set, then there should be finished the formular with the submit button. 
      	// If not, then show the three kinds of the main folder.
      	echo '
			    <tr>
			  		<td>';
       echo '</td>
			  	</tr>';
  		}
  	echo'

  	</table>';
	}

//------------------------------------------------------------------------------  
	
	function DisplayBills($batch_nr, $specific_bill, $edit_fields) {
	  if (func_num_args()>3)
	    $printout=func_get_arg (3);
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
		*/
		global $db;
		
  	echo '
  	<table width="800" border="1">

  		';
  		if($specific_bill>0)
  		{ 
  			$billnumbers=$this->VerifyBill($specific_bill);
  		}
  		else
  		{ 
  			$billnumbers=$this->GetBillNumbersFromPID($batch_nr);
  		}
  		if ($billnumbers) {
    		while($bills=$billnumbers->FetchRow()) { 
  
          if ($printout==FALSE) {
        		//Java script for print out the bill
        		// We have to place it here, because here is one place where we have the bill number what is 
        		// definetly displayed on the user-screen 
        		echo '<script language="javascript" >
                  <!-- 
                  function printOut_'.$bills['nr'].'()
                  {
                  	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
                  	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
                    
                  }
                  // -->
                  </script> 
                  ';
          }
    		  
  				echo '
  					<tr>
  						<td>';
  						$this->DisplayBillHeadline($bills['nr'], $batch_nr);
  						echo '
  						</td>
  					</tr>';
    			$sum_to_pay =0;
    			$sum = 0;
    			
    			$billelems=$this->GetElemsOfBill($bills['nr'],"laboratory");
  				if($bill_elems_row=$billelems->FetchRow())
  				{			
  	  			echo '
  	  			<tr>
  	  				<td valign="top">';
  	  					$this->DisplayLaboratoryBill($bills['nr'],$edit_fields);
  	      	echo '
  	      		</td>
  	      	</tr>';
        	}
        	$billelems=$this->GetElemsOfBill($bills['nr'],"prescriptions");
  				if($bill_elems_row=$billelems->FetchRow())
  				{
  					echo '
  	  			<tr>
  	  				<td valign="top">';
  	  					$this->DisplayPrescriptionBill($bills['nr'],$edit_fields);
  	      		echo '
  	      		</td>
  	      	</tr>';
        	}
        	
        	// is there the edit_fields flag set, then there should be finished the formular with the submit button. 
        	// If not, then show the three kinds of the main folder.
        	echo '
  			    <tr>
  			  		<td>';
  			 
  			 $show_printout_button = FALSE;
  			 $show_done_button=FALSE;
  			 $show_edit_button=FALSE;
  			 
         if ($printout==FALSE) {
    			 if (!$show_printout_button) echo '<a href="javascript:printOut_'.$bills['nr'].'()"><img src="../../gui/img/control/default/en/en_printout.gif" border=0 align="absmiddle" width="99" height="24" alt="Print this form"></a> ';
    			 if ($edit_fields) echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif"> &nbsp;&nbsp;&nbsp; To transfere this pending bill into the archive: <a href="billing_tz_pending.php?&mode=done&bill_number='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_done.gif" border=0 align="absmiddle" width="75" height="24" alt="It´s done! Move the form to the archive"></a>&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif">';
    			 if (!$edit_fields) echo '<a href="billing_tz_edit.php?batch_nr='.$batch_nr.'&billnr='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_auswahl2.gif" border=0 align="absmiddle" width="120" height="24"></a>';
    		 }
         echo '</td>
  			  	</tr>';
    		}
    	} else {
    	  echo '<br><br><tr><td><div align="center"><h1>No pending bills available</h1><div></td></tr>';
      }
  	echo'

  	</table>';
	  //if($edit_fields) echo '<form method=post action="#" name="edit_bill">';
	}
	
	//------------------------------------------------------------------------------  
	
	function ArchiveBill($bill_number) {
	  global $db;
	  $debug=FALSE;
	  if ($debug) echo "<b>class_tz_billing::ArchiveBill($bill_number)</b><br>";
	  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;	  
    
    $this->sql = "INSERT INTO care_tz_billing_archive 
                      (`nr`,`encounter_nr`, `first_date`, `create_id`)	  
                  SELECT `nr`, `encounter_nr`, `first_date`, `create_id` FROM care_tz_billing WHERE `nr`=".$bill_number;
    $this->result=$db->Execute($this->sql);
    
    if ($db->Insert_ID())
      $CARE_TZ_BILLING_ARCHIVED=TRUE;

    $this->sql = "INSERT INTO care_tz_billing_archive_elem 
                      (`nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, `is_paid`, `amount`, `price`, `description`, `item_number`)	  
                  SELECT `nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, `is_paid`, `amount`, `price`, `description`, `item_number` FROM care_tz_billing_elem WHERE `nr`=".$bill_number;
    $this->result=$db->Execute($this->sql);

    if ($db->Insert_ID())
      $CARE_TZ_BILLING_ELEM_ARCHIVED=TRUE;      
    
    if ($CARE_TZ_BILLING_ARCHIVED && $CARE_TZ_BILLING_ELEM_ARCHIVED) {
      $this->sql = "UPDATE care_encounter_prescription SET bill_status='archived' WHERE bill_number=".$bill_number;
      $db->Execute($this->sql);
      $this->sql = "UPDATE care_test_request_chemlabor SET bill_status='archived' WHERE bill_number=".$bill_number;
      $db->Execute($this->sql);
      $this->DeleteBillFromPendingList($bill_number);
      return TRUE;
    }
    return FALSE;
	}
	
	function DeleteBillFromPendingList($bill_number) {
	  global $db;
	  $debug=FALSE;
	  if ($debug) echo "<b>class_tz_billing::DeleteBillFromPendingList($bill_number)</b><br>";
	  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;	  
    $this->sql = "DELETE FROM care_tz_billing WHERE `nr`=".$bill_number;
    $db->Execute($this->sql);
    $this->sql = "DELETE FROM care_tz_billing_elem WHERE `nr`=".$bill_number;
    $db->Execute($this->sql);
    return TRUE;
  }

}


	
?>