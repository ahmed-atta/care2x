<?php
/**
* Care2x API package* @package care_api
*/

/**
*  Config reader methods. Will be extended by other classes. Note that it is just working with > php 5.x
* @author Robert Meggle
* @version beta 1.0.0
* @copyright 2010 Robert Meggle
* @package care_api
*/
class configfile {

	private $config_filename = '';
	private $xml;
	private $e_arr = array();

	/*
	 * Constructor
	 */
	function __construct($filename) {
	 	$this->config_filename = $filename;
		$this->xml = simplexml_load_file($this->config_filename, 'SimpleXMLIterator');
	 }

	/*
	 * Prepaerd for read out the config parameter setting of config_weberp.xml. Could be imporved later
	 * for more global aspect
	 * @access: public
	 * @return: array
	 * @requires: Use of the class SimpleXMLIterator from PHP standard libary as alternative to SimpleXMLElement by ignition call simplexml_load_file
	 * code example:
	 *  $configClass = new configfile('../../include/config_weberp.xml');
	 *  $myConfig = $configClass->GetConfig();
	 *  $myValue = $myConfig['key'];
	 * from e.g.
	 * <config>
	 * 	<key>value</key>
	 * </config>
	 */
	public function GetConfig () {
		$retval_array = array();
		$this->e_arr = $this->GetElementsAsArray();
		while(list($x,$v)=each($this->e_arr)) {
			$retval_array[$v]=$this->GetValueOf($v);
		}
		return $retval_array;
	} // end of public function GetConfig ()

	/*
	 * GetElementsAsArray() will return an array with all nodes listened in the config file
	 * @access: public
	 * @return: array
	 * @requires: Use of the class SimpleXMLIterator from PHP standard libary as alternative to SimpleXMLElement by ignition call simplexml_load_file
	 * code example:
	 *  $configClass = new configfile('../../include/config_weberp.xml');
	 *  $myConfig = $configClass->GetElementsAsArray();
	 */
	public function GetElementsAsArray() {
		// New instance of RecursiveIteratroIterator for SimpleXMLIterator without root (RIT_SELF_FIRST):
		$iterator = new RecursiveIteratorIterator($this->xml);
		$arr=array();
		// Reading out tags and values from xml file and store it to the return value
		foreach($iterator as $name => $element) {
		  array_push($arr,$name);
		}
		return $arr;
	}

	/*
	 * Prepaerd for read out the config parameter setting of any xml config file.
	 * @access: public
	 * @return: string or zero
	 * @requires: Use of the class SimpleXMLIterator from PHP standard libary as alternative to SimpleXMLElement by ignition call simplexml_load_file
	 * code example:
	 *  $configClass = new configfile('../../include/config_weberp.xml');
	 *  $myConfig = $configClass->GetConfig();
	 *  $myValue = GetValueOf['key'];
	 * from e.g.
	 * <config>
	 * 	<key>value</key>
	 * </config>
	 */
	public function GetValueOf($e) {
		// New instance of RecursiveIteratroIterator for SimpleXMLIterator without root (RIT_SELF_FIRST):
		$iterator = new RecursiveIteratorIterator($this->xml);
		// Reading out tags and values from xml file and store it to the return value
		foreach($iterator as $key => $value) {
		  if ($e==$key) return (string)$value;
		 }
		// nothing found
		return 0;
	}


	/*
	 * Destructor planned to use in case you want to eliminate values out of sessions (e.g.)
	 */
	 public function __destruct(){

	 }
}

?>