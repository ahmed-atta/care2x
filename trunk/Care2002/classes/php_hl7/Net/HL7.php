<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
// +----------------------------------------------------------------------+
// | PHP version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 D.A.Dokter                                        |
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

/**
 * The Net_HL7 class is a factory class for HL7 messages.
 *
 * The factory class provides the convenience of changing several
 * defaults for HL7 messaging globally, like separators, etc. Note
 * that some default settings use characters that have special meaning
 * in PHP, like the HL7 escape character.
 *
 * @version    0.10
 * @author     D.A.Dokter <dokter@w20e.com>
 * @access     public
 * @category   Networking
 * @package    Net_HL7
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 */
class Net_HL7 {

    /**
     * Holds all global HL7 settings.
     */
    var $_hl7Globals = array();


    /**
     * Create a new instance of the HL7 factory.
     */
    function Net_HL7() {

        $_hl7Globals['SEGMENT_SEPARATOR'] = "\015";
        $_hl7Globals["FIELD_SEPARATOR"] = "|";
        $_hl7Globals["NULL"] = "\"\"";
        $_hl7Globals["COMPONENT_SEPARATOR"] = "^";
        $_hl7Globals["REPETITION_SEPARATOR"] = "~";
        $_hl7Globals["ESCAPE_CHARACTER"] = "\\";
        $_hl7Globals["SUBCOMPONENT_SEPARATOR"] = "&";
        $_hl7Globals["HL7_VERSION"] = "2.2";
    }
    

    /**
     * Create a new Net_HL7_Message, using the global HL7 variables as
     * defaults.
     * 
     * @param string Text representation of an HL7 message
     * @return object Net_HL7_Message
     * @access public
     */
    function &createMessage($msgStr = "")
    {
        $msg =& new Net_HL7_Message($msgStr, $this->_hl7Globals);
        
        return $msg;
    }


    /**
     * Create a new Net_HL7_Segments_MSH segment, using the global HL7
     * variables as defaults.
     * 
     * @return object Net_HL7_Segments_MSH
     * @access public
     */
    function &createMSH()
    {
        $msh =& new Net_HL7_Segments_MSH($this->_hl7Globals);
        
        return $msh;
    }


    /**
     * Set the component separator to be used by the factory. Should
     * be a single character. Default ^
     *
     * @param string Component separator char.
     * @return boolean true if value has been set.
     * @access public
     */
    function setComponentSeparator($value)
    {
        if (strlen($value) != 1) return false;

        return _setGlobal('COMPONENT_SEPARATOR', $value);
    }


    /**
     * Set the subcomponent separator to be used by the factory. Should
     * be a single character. Default: &
     *
     * @param string Subcomponent separator char.
     * @return boolean true if value has been set.
     * @access public
     */
    function setSubcomponentSeparator($value)
    {
        if (strlen($value) != 1) return false;

        return _setGlobal('SUBCOMPONENT_SEPARATOR', $value);
    }


    /**
     * Set the repetition separator to be used by the factory. Should
     * be a single character. Default: ~
     *
     * @param string Repetition separator char.
     * @return boolean true if value has been set.
     * @access public
     */
    function setRepetitionSeparator($value)
    {
        if (strlen($value) != 1) return false;

        return _setGlobal('REPETITION_SEPARATOR', $value);
    }


    /**
     * Set the field separator to be used by the factory. Should
     * be a single character. Default: |
     *
     * @param string Field separator char.
     * @return boolean true if value has been set.
     * @access public
     */
    function setFieldSeparator($value)
    {
        if (strlen($value) != 1) return false;

        return _setGlobal('FIELD_SEPARATOR', $value);
    }


    /**
     * Set the segment separator to be used by the factory. Should
     * be a single character. Default: \015
     *
     * @param string Segment separator char.
     * @return boolean true if value has been set.
     * @access public
     */
    function setSegmentSeparator($value)
    {
        if (strlen($value) != 1) return false;

        return _setGlobal('SEGMENT_SEPARATOR', $value);
    }


    /**
     * Set the escape character to be used by the factory. Should
     * be a single character. Default: \
     *
     * @param string Escape character.
     * @return boolean true if value has been set.
     * @access public
     */
    function setEscapeCharacter($value)
    {
        if (strlen($value) != 1) return false;
        
        return _setGlobal('ESCAPE_CHARACTER', $value);
    }


    /**
     * Set the HL7 version to be used by the factory.
     *
     * @param string HL7 version character.
     * @return boolean true if value has been set.
     * @access public
     */
    function setHL7Version($value)
    {
        return _setGlobal('HL7_VERSION', $value);
    }


    /**
     * Set the NULL string to be used by the factory.
     *
     * @param string NULL string.
     * @return boolean true if value has been set.
     * @access public
     */
    function setNull($value)
    {
        return _setGlobal('NULL', $value);
    }


    /**
     * Convenience method for obtaining the special NULL value.
     *
     * @return string null value
     * @access public
     */
    function getNull() {

    }


    /**
     * Set the HL7 global variable
     *
     * @access private
     * @param string name
     * @param string value
     * @return boolean True when value has been set, false otherwise.
     */
    function _setGlobal($name, $value)
    {
        $_hl7Globals[$name] = $value;

        return true;
    }
    
}
?>
