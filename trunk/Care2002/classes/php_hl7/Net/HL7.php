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
?>

<?php
/**
 *
 * The Net_HL7 class is only used for documentation purposes (the
 * stuff you're reading right now) and to set HL7 configuration properties
 * such as control characters on a global level.
 *
 * @version    0.10
 * @author     D.A.Dokter <dokter@w20e.com>
 * @access     public
 * @category   Networking
 * @package    Net_HL7
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 *
 * @example    observer_upload.php          An example of Net_FTP_Observer implementation.
 */

//class Net_HL7
//{
  /**
   * Separator for segments within a message. Usually this is \015.
   *
   * @var    String
   * @since  0.10
   * @access public
   */
  $GLOBALS["_Net_HL7_SEGMENT_SEPARATOR"] = "\015";


  /**
   * Field separator for this message. In general '|' is used.
   *
   */
  $_Net_HL7_FIELD_SEPARATOR = "|";

  /** 
   * HL7 NULL field, defaults to "". This is therefore different from
   * not setting the fields at all.
   */
  $_Net_HL7_NULL = "\"\"";


  /**
   * Separator used in fields supporting components. Usually this is
   * the '^' character.
   */
  $_Net_HL7_COMPONENT_SEPARATOR    = "^";


  /**
   * Separator for fields that may be repeated. Defaults to '~'.
   */
  $_Net_HL7_REPETITION_SEPARATOR   = "~";


  /**
   * Escape character for escaping special characters. Defaults to '\'.
   */
  $_Net_HL7_ESCAPE_CHARACTER       = "\\";


  /**
   * Separator used in fields supporting subcomponents. Usually this
   * is the '&' character.
   */
  $_Net_HL7_SUBCOMPONENT_SEPARATOR = "&";


  /**
   * This is the version used in the MSH(12) field. Defaults to 2.2.
   */
  $_Net_HL7_HL7_VERSION            = "2.2";
//}
?>
