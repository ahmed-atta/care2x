<?php
/* API class for products
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Product extends Core {
	/**
	* Table names
	*/
	var $tb_polist='care_pharma_orderlist'; 
	var $tb_pocat='care_pharma_ordercatalog'; 
	var $tb_pmain='care_pharma_products_main';
	var $tb_molist='care_med_orderlist';
	var $tb_mocat='care_med_ordercatalog';
	var $tb_mmain='care_med_products_main';
	
	/**
	* Table fields
	*/
	var $fld_ocat=array('item_no',
								'dept_nr',
								'hit',
								'artikelname',
								'bestellnum',
								'minorder',
								'maxorder',
								'proorder');
								
	var $fld_prodmain=array('bestellnum',
										'artikelnum',
										'industrynum',
										'artikelname',
										'generic',
										'description',
										'packing',
										'minorder',
										'maxorder',
										'proorder',
										'picfile',
										'encoder',
										'enc_date',
										'enc_time',
										'lock_flag',
										'medgroup',
										'cave',
										'status',
										'history',
										'modify_id',
										'modify_time',
										'create_id',
										'create_time');

	/**
	* Constructor, sets default tables if $type is not empty
	*/				
	function Product(){
	}
	/**
	*	useOrderList() sets the core table to care_???_orderlist
	* @param $type (str) determines the final table name 
	*/
	function useOrderList($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_polist;
		}elseif($type=='medlager'){
			$this->coretable=$this->tb_molist;
		}else{return false;}
	}
	/**
	*	useOrderCatalog() sets the core table to care_????_ordercatalog
	* @param $type (str) determines the final table name 
	*/
	function useOrderCatalog($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_pocat;
			$this->ref_array=$this->fld_ocat;
		}elseif($type=='medlager'){
			$this->coretable=$this->tb_mocat;
			$this->ref_array=$this->fld_ocat;
		}else{return false;}
	}
	/**
	*	useProduct() sets the core table to care_????_products_main
	* @param $type (str) determines the final table name 
	*/
	function useProduct($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_pmain;
			$this->ref_array=$this->fld_prodmain;
		}elseif($type=='medlager'){
			$this->coretable=$this->tb_mmain;
			$this->ref_array=$this->fld_prodmain;
		}else{return false;}
	}
	/**
	* DeleteOrder() deletes an order, 
	* public
	* @param $order_nr (int) the order number to be deleted
	* return true , else false
	*/
	function DeleteOrder($order_nr,$type){
		$this->useOrderList($type);
		$this->sql="DELETE  FROM $this->coretable WHERE order_nr='$order_nr'";
       	return $this->Transact();
	}
	/**
	* ActualCatalog() returns the actual order catalog of a department
	* public
	* @param $dept_nr (int) the department number
	* return adodb record object
	*/
	function ActualOrderCatalog($dept_nr,$type=''){
		global $db;
		if(empty($type)||empty($dept_nr)) return false;
		$this->useOrderCatalog($type);
		$this->sql="SELECT * FROM $this->coretable WHERE dept_nr='$dept_nr' ORDER BY hit DESC";
        if($this->res['aoc']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['aoc']->RecordCount()) {
				return $this->res['aoc'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Saves (insert)  an item in the order catalog
	* public
	* @param $data (array) passed by reference contains the data in assoc array
	* @param $type (str) determines the final table to be used
	* return true/false
	*/
	function SaveCatalogItem(&$data,$type){
		if(empty($type)) return false;
		$this->useOrderCatalog($type);
		$this->data_array=&$data;
		return $this->insertDataFromInternalArray();
	}
	/**
	* DeleteCatalogItem() deletes a catalog item, 
	* public
	* @param $item_nr (int) the item's record number to be deleted
	* return true , else false
	*/
	function DeleteCatalogItem($item_nr,$type){
		if(!$item_nr||!$type) return false;
		$this->useOrderCatalog($type);
		$this->sql="DELETE  FROM $this->coretable WHERE item_no='$item_nr'";
       	return $this->Transact();
	}
	/**
	* OrderDrafts() returns all orders marked as draft or are still unsent
	* @public
	* @param $dept_nr (int) department nr
	* @param $type (str) determines the final table name 
	* return adodb record object, else false
	*/
	function OrderDrafts($dept_nr,$type){
		global $db;
		if(empty($type)||empty($dept_nr)) return false;
		$this->useOrderList($type);
		$this->sql="SELECT * FROM $this->coretable 
						WHERE (sent_datetime='' OR sent_datetime='0000-00-00 00:00:00')
						AND validator=''
						AND (status='draft' OR status='')
						AND dept_nr=$dept_nr
						ORDER BY order_date";

        if($this->res['od']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['od']->RecordCount()) {
				return $this->res['od'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* PendingOrders() returns all orders marked as "pending" or "ack_print"
	* @public
	* @param $type (str) determines the final table name 
	* return adodb record object, else false
	*/
	function PendingOrders($type){
		global $db;
		if(empty($type)) return false;
		$this->useOrderList($type);
		$this->sql="SELECT * FROM $this->coretable WHERE status='pending' OR status='ack_print' ORDER BY sent_datetime DESC";

        if($this->res['po']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['po']->RecordCount()) {
				return $this->res['po'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* ProductExists() check if the product exists
	* @public
	* @param $nr (int) product number
	* return true/false
	*/
	function ProductExists($nr=0,$type=''){
		global $db;
		if(empty($type)||!$nr) return false;
		$this->useProduct($type);
		$this->sql="SELECT bestellnum FROM $this->coretable WHERE bestellnum='$nr'";

        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				return true;
			} else { return false; }
		} else { return false; }
	}
}
?>
