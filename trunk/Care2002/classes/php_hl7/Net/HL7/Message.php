<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
// +----------------------------------------------------------------------+
// | PHP version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: D.A.Dokter <dokter@w20e.com>                                |
// +----------------------------------------------------------------------+
//
// $Id$

require_once 'Net/HL7/Segment.php';
require_once 'Net/HL7.php';


/**
 * In general one needn't create an instance of the Net_HL7_Message
 * class directly, but use the Net_HL7_Request class. When adding
 * segments, note that the segment index starts at 0, so to get the
 * first segment, segment, do $msg->getSegmentByIndex(0).
 *
 * The segment separator defaults to \015. To change this, set the
 * variable $_Net_HL7_SEGMENT_SEPARATOR.
 *
 * @version    $Revision$
 * @author     D.A.Dokter <dokter@w20e.com>
 * @access     public
 * @category   Networking
 * @package    Net_HL7
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 */
class Net_HL7_Message {
  
  var $_segments;
  var $_segmentSeparator;
  var $_fieldSeparator;
  var $_componentSeparator;
  var $_subcomponentSeparator;
  var $_repetitionSeparator;
  var $_escapeChar;
  var $_hl7Version;

  /**
   * The constructor takes an optional string argument that is a string
   * representation of a HL7 message. If the string representation is not a
   * valid HL7 message. according to the specifications, undef is returned
   * instead of a new instance. This means that segments should be
   * separated within the message with the segment separator (defaults to
   * \015) or a newline, and segments should be syntactically correct.
   * When using the string argument constructor, make sure that you have
   * escaped any characters that would have special meaning in Perl. For
   * instance (using a different subcomponent separator):
   *
   *     $msg = new Net_HL7_Message("MSH*^~\\@*1\rPID***x^x@y@z^z\r");
   *
   * would actually mean
   *
   *     $msg = new Net_HL7_Message("MSH*^~\\@*1\rPID***x^x^z\r");>
   *
   * since '@y@z' would be interpreted as two empty arrays, so do:
   *
   *     $msg = new Net::HL7::Message("MSH*^~\\@*1\rPID***x^x\@y\@z^z\r");
   *
   * instead.
   *
   * The control characters and field separator will take the values from
   * the MSH segment, if set. Otherwise defaults will be used. Changing the
   * MSH fields specifying the field separator and control characters after
   * the MSH has been added to the message will result in setting these
   * values for the message.
   *
   * If the message couldn't be created, for example due to a erroneous HL7
   * message string, undef is returned.
   */

  function Net_HL7_Message($msgStr = "") {

    //Array holding the segments
    $this->segments = array();

    // Control characters and other HL7 properties
    //
    $this->_segmentSeparator      = $GLOBALS["_Net_HL7_SEGMENT_SEPARATOR"];
    $this->_fieldSeparator        = $GLOBALS["_Net_HL7_FIELD_SEPARATOR"];
    $this->_componentSeparator    = $GLOBALS["_Net_HL7_COMPONENT_SEPARATOR"];
    $this->_subcomponentSeparator = $GLOBALS["_Net_HL7_SUBCOMPONENT_SEPARATOR"];
    $this->_repetitionSeparator   = $GLOBALS["_Net_HL7_REPETITION_SEPARATOR"];
    $this->_escapeChar            = $GLOBALS["_Net_HL7_ESCAPE_CHARACTER"];
    $this->_hl7Version            = $GLOBALS["_Net_HL7_HL7_VERSION"];

    
    // If an HL7 string is given to the constructor, parse it.
    if ($msgStr) {

      $segments = preg_split("/[\n\\" . $this->_segmentSeparator . "]/", $msgStr);

      // The first segment should be the control segment
      //
      preg_match("/^([A-Z0-9]{3})(.)(.)(.)(.)(.)(.)/", $segments[0], $matches);
      
      $hdr = $matches[1];
      $fldSep = $matches[2];
      $compSep = $matches[3];
      $repSep = $matches[4];
      $esc = $matches[5];
      $subCompSep = $matches[6];
      $fldSepCtrl = $matches[7];
      
      // Check whether field separator is repeated after 4 control characters
      //
      if ($fldSep != $fldSepCtrl) {
	
	return NULL;
      }
      
      // Set field separator based on control segment
      $this->_fieldSeparator        = $fldSep;
      
      // Set other separators
      $this->_componentSeparator    = $compSep; 
      $this->_subcomponentSeparator = $subCompSep;
      $this->_escapeChar            = $esc;
      $this->_repetitionSeparator   = $repSep;
      
      // Do all segments
      //
      for ($i = 0; $i < count($segments); $i++) {
	
	$fields = split($this->_fieldSeparator, $segments[$i]);
	$name = array_shift($fields);
	
	// Now decompose fields if necessary, into arrays
	//
	for ($j = 0; $j < count($fields); $j++) {
	  
	  // Skip control field
	  if ($i == 0 && $j == 0) {
	    
	    next;
	  }
	  
	  $comps = split($this->_componentSeparator, $fields[$j]);
	  
	  for ($k = 0; $k < count($comps); $k++) {
	    
	    $subComps = split($this->_subcomponentSeparator, $comps[$k]);
	    
	    // Make it a ref or just the value
	    (count($subComps) == 1) ? ($comps[$k] = $subComps[0]) : ($comps[$k] = $subComps);
	  }
	  
	  (count($comps) == 1) ? ($fields[$j] = $comps[0]) : ($fields[$j] = $comps);
	}
	
	$seg;	
	$segClass = "Net_HL7_Segments_$name";
	
	// Let's see whether it's a special segment
	//
	if ( eval("require \"Net/HL7/Segments/$name.php;\"") ) {
	  array_unshift($fields, $this->_fieldSeparator);
	  $seg = eval("new $segClass($fields)");
	}
	else {
	  $seg = new Net_HL7_Segment($name, $fields);
	}
	
	if (! $seg) { 
	  return NULL;
	}
	
	$this->addSegment($seg);
      }
    }
    
    return 1;
  }
  
  /**
   * Add the segment. to the end of the message. The segment should be
   * an instance of Net_HL7_Segment.
   */
  function addSegment($segment) { 
    
    if (count($this->segments) == 0) {
      $this->_resetCtrl($segment);
    }
    
    array_push($this->segments, $segment);
  }


  /**
   * Insert the segment. The segment should be an instance of
   * Net_HL7_Segment. If the index is not given, nothing happens.
   */
  function insertSegment($segment, $idx) {

    if ((! $idx) || ($idx > count($this->segments))) {
      return;
    }

    if ($idx == 0) {

	$this->_resetCtrl($segment);
	array_unshift($this->segments, $segment);
    } 
    elseif ($idx == count($this->segments)) {

      array_push($this->segments, $segment);
    }
    else {
      $this->segments = array_merge(
				    slice($this->segments, 0, $idx),
				    array($segment),
				    slice($this->segments, $idx)
				    );
    }
  }

  /**
   * Return the segment specified by $index. Segment count within the
   * message starts at 0.
   */
  function getSegmentByIndex($index) {

    return $this->segments[$index];
  }


  /**
   * Return an array of all segments with the given name
   */
  function getSegmentsByName($name) {

    $segments = array();

    foreach ($this->segments as $seg) {
	if ($seg->getName() == $name) {
	  array_push($segments, $seg);
	}
    }

    return $segments;
  }


  /**
   * Remove the segment indexed by $index. If it doesn't exist, nothing
   * happens, if it does, all segments after this one will be moved one
   * index up.
   */
  function removeSegmentByIndex($index) {

    if ($index < count($this->segments)) {
      array_splice($this->segments, $index, 1);
    }
  }


  /**
   * Set the segment on index. If index is out of range, or not provided,
   * do nothing. Setting MSH on index 0 will revalidate field separator,
   * control characters and hl7 version, based on MSH(1), MSH(2) and
   * MSH(12).
   */
  function setSegment($segment, $idx) {
  
    if ((! $idx) || $idx > count($this->segments)) { 
      return;
    };
    
    if ($segment->getName() == "MSH" && $idx == 0) {
      
      $this->_resetCtrl($segment);
    }
    
    $this->segments[$idx] = $segment;
  }
  
  
  /**
   * After change of MSH, reset control fields
   */
  function _resetCtrl($segment) {
    
    if ($segment->getField(1)) {
      $this->fieldSeparator = $segment->getField(1);
    }
    
    if (preg_match("/(.)(.)(.)(.)/", $segment->getField(2), $matches)) {
      $this->componentSeparator    = $matches[1];
      $this->repetitionSeparator   = $matches[2];
      $this->escapeChar            = $matches[3];
      $this->subcomponentSeparator = $matches[4];
    }
    
    if ($segment->getField(12)) {
      $this->hl7Version = $segment->getField(12);
    }
  }


  /**
   * Return an array containing all segments in the right order.
   */
  function getSegments() {

    return $this->segments;
  }


  /**
   * Return a string representation of this message. This can be used to
   * send the message over a socket to an HL7 server. To print to other
   * output, use the $pretty argument as some true value. This will not use
   * the default segment separator, but '\n' instead.
   */
  function toString($pretty) {
    
    $msg = "";

    # Make sure MSH(1) and MSH(2) are ok, even if someone has changed
    # these values 
    # 
    $msh = $this->segments[0];

    $this->_resetCtrl($msh);

    foreach ($this->segments as $seg) {

      $msg .= $seg->getName() . $this->fieldSeparator;

      foreach ($seg->getFields($seg->getName() != "MSH"? 1 : 2) as $fld) {
	
	if (is_array($fld)) {
	  
	  for ($i = 0; $i < count($fld); $i++) {
	    
	    (is_array($fld[$i])) ? ($msg .= join($this->subcomponentSeparator, $fld[$i])) :
	      ($msg .= $fld[$i]);
	    
	    
	    if ($i < (count($fld) - 1)) {
	      $msg .= $this->componentSeparator;
	    }
	  }
	}
	else {
	  $msg .= $fld;
	}
	
	$msg .= $this->fieldSeparator;
      }
      
      ($pretty) ? ($msg .= "\n") : ($msg .= $this->segmentSeparator);
    }
    
    return $msg;
  }

}
