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

require_once 'Net_HL7_Response.php';


//use IO::Socket;


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


  var $MESSAGE_PREFIX = "\013";
  var $MESSAGE_SUFFIX = "\034\015";
  var $MAX_READ = 2048;

  /**
   * Creates a connection to a HL7 server, or returns undef when a
   * connection could not be established.are:
   */
  function Net_HL7_Connection($host, $port) {
    
    $self->_HANDLE = $self->_connect($host, $port);
  }


  function _connect($host, $port) {
    
    set_time_limit(10);

    /* Turn on implicit output flushing so we see what we're getting
     * as it comes in. */
    ob_implicit_flush();
    
    if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
      echo "socket_create() failed: reason: " . socket_strerror($sock) . "\n";
    }
    
    if (($ret = socket_bind($sock, $host, $port)) < 0) {
      echo "socket_bind() failed: reason: " . socket_strerror($ret) . "\n";
    }
    
    if (($ret = socket_listen($sock, 5)) < 0) {
      echo "socket_listen() failed: reason: " . socket_strerror($ret) . "\n";
    }
    
    return $sock;
  }



  /**
   * Sends a L<Net::HL7::Request|Net::HL7::Request> object over this
   * connection.
   */
  function send($req) {

    $buff;
    $handle = $self->_HANDLE;
    $hl7Msg = $req->toString();
    
    socket_write($handle, $MESSAGE_PREFIX . $hl7Msg . $MESSAGE_SUFFIX);
    
    // Read response in slurp mode
    $buff = socket_read($handle, $MAXLINE);

    # Remove message prefix and suffix
    preg_replace("/^$MESSAGE_PREFIX/", "", $buff);
    preg_replace("/$MESSAGE_SUFFIX$/", "", $biff);

    return new Net_HL7_Response($buff);
  }


  /**
   * Close the connection.
   */
  function close() {

    $self->_HANDLE->close();
  }
}
?>