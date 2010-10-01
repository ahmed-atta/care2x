<?php
/**
 * @package care_api
 */

/**
 */
require_once($root_path.'include/core/class_core.php'); 
/**
 *  Reporting Methods methods.
 *  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
 * @author Robert Meggle
 * @version  0.1
 * @copyright 2009,2010 Robert Meggle
 * @package care_api
 */
class Report extends Core {

	public function __construct() {
		// Constructor
	    global $db;
	    $this->debug=false;
	    $this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;		
		return true;
	   }

	public function GetView($model) {
		
		// Call reflection Class for OPD Summary
		return $this->Display = new OPDSummary();
	}
	
	
	
	
	public function __destruct() {
		// Destructor
		
	}
	   
}

class OPDSummary extends Report {
	
	private $Class;
	
	private function __contructor($method) {
		if (!class_exists($this->Class)) {
			$reflector = new Report_Reflector($this->Class); 
			return $reflector->export($this->Class);
		} else {
			return false;
		}
	}
	
	public function Display() {
	   //echo parent::testit();
	}
	
}

?>