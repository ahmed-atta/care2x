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

require_once 'Net/HL7/Response.php';


/**
 * $conn = new Net::HL7::Connection('localhost', 8089);
 *
 * $req = new Net::HL7::Request();
 * 
 * ... set some request attributes
 * 
 *  $res = $conn->send($req);
 * 
 * $conn->close();
 *
 *
 * The Net::HL7::Connection object represents the tcp connection to the
 * HL7 message broker. The Connection has only two useful methods (apart
 * from the constructor), send and close. The 'send' method takes a
 * L<Net::HL7::Request|Net::HL7::Request> as argument, and returns a
 * L<Net::HL7::Response|Net::HL7::Response>. The send method can be used
 * more than once, before the connection is closed.
 *
 * The Connection object holds the following fields:
 *
 * MESSAGE_PREFIX
 *
 * The prefix to be sent to the HL7 server to initiate the
 * message. Defaults to \013.
 *
 * MESSAGE_SUFFIX
 * End of message signal for HL7 server. Defaults to \034\015.
 * 
 *
 * @version    
 * @author     D.A.Dokter <dokter@w20e.com>
 * @access     public
 * @category   
 * @package    
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 */
class Net_HL7_Connection {

  var $_HANDLE;
  var $_MESSAGE_PREFIX;
  var $_MESSAGE_SUFFIX;
  var $_MAX_READ;

  /**
   * Creates a connection to a HL7 server, or returns undef when a
   * connection could not be established.are:
   */
  function Net_HL7_Connection($host, $port) {
    
    $this->_HANDLE = $this->_connect($host, $port);
    $this->_MESSAGE_PREFIX = "\013";
    $this->_MESSAGE_SUFFIX = "\034\015";
    $this->_MAX_READ       = 8192;
  }


  function _connect($host, $port) {
    
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket < 0) {
      echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
    }

    $result = socket_connect($socket, $host, $port);

    if ($result < 0) {
      echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
    }

    return $socket;
  }


  /**
   * Sends a Net_HL7_Request object over this connection.
   */
  function send($req) {

    $handle = $this->_HANDLE;
    $hl7Msg = $req->toString();
    
    socket_write($handle, $this->_MESSAGE_PREFIX . $hl7Msg . $this->_MESSAGE_SUFFIX);

    $data = "";

    while(($buf = socket_read($handle, 256, PHP_BINARY_READ)) !== false) {
      $data .= $buf;

      if(preg_match("/" . $this->_MESSAGE_SUFFIX . "$/", $buf))
	break;
    }

    # Remove message prefix and suffix
    $data = preg_replace("/^" . $this->_MESSAGE_PREFIX . "/", "", $data);
    $data = preg_replace("/" . $this->_MESSAGE_SUFFIX . "$/", "", $data);

    return new Net_HL7_Response($data);
  }


  /**
   * Close the connection.
   */
  function close() {

    socket_close($this->_HANDLE);
  }
}
?>