class Net_HL7_Messages_ACK extends Net_HL7_Message {

  var $_ACK_TYPE;
  
  /**
   * $ack = new Net::HL7::Messages::ACK($request);
   *
   * Convenience module implementing an acknowledgement (ACK) message. This
   * can be used in HL7 servers to create an acknowledgement for an
   * incoming message.
   */
  function _init($req) {
    
    $this->SUPER::_init();
    
    var ($reqMsh, $msh);

    $req && ($reqMsh = $req->getSegmentByIndex(0));

    if ($reqMsh) {

      var $flds = $req->getSegmentByIndex(0)->getFields(1);
	
      $msh = new Net_HL7_Segments_MSH($flds);
    }
    else {
	$msh = new Net_HL7_Segments_MSH();
    }

    var $msa = new Net_HL7_Segment("MSA");

    // Determine acknowledge mode: normal or enhanced
    //
    if ($reqMsh && ($reqMsh->getField(15) || $reqMsh->getField(16))) {
      $this->_ACK_TYPE = "E";
      $msa->setField(1, "CA");
    }
    else {
      $this->_ACK_TYPE = "N";
      $msa->setField(1, "AA");
    }

    $this->addSegment($msh);
    $this->addSegment($msa);

    $msh->setField(9, "ACK");

    # Construct an ACK based on the request
    if ($req && $reqMsh) {

      $msh->setField(3, $reqMsh->getField(5));
      $msh->setField(4, $reqMsh->getField(6));
      $msh->setField(5, $reqMsh->getField(3));
      $msh->setField(6, $reqMsh->getField(4));
      $msa->setField(2, $reqMsh->getField(10));
    }
    
    return 1;
  }


  /**
   * Set the acknowledgement code for the acknowledgement. Code should be
   * one of: A, E, R. Codes can be prepended with C or A, denoting enhanced
   * or normal acknowledge mode. This denotes: accept, general error and
   * reject respectively. The ACK module will determine the right answer
   *  mode (normal or enhanced) based upon the request, if not provided.
   * The message provided in $msg will be set in MSA 3.
   */
  function setAckCode($code, $msg) {

    var $mode = "A";

    // Determine acknowledge mode: normal or enhanced
    //
    if ($this->_ACK_TYPE == "E") {
      $mode = "C";
    }
    
    if (length($code) == 1) {
      $code = "$mode$code";
    }

    $this->getSegmentByIndex(1)->setField(1, $code);
    $msg && $this->getSegmentByIndex(1)->setField(3, $msg);
  }


  /**
   * Set the error message for the acknowledgement. This will also set the
   * error code to either AE or CE, depending on the mode of the incoming
   * message.
   */
  function setErrorMessage($msg) {

    $this->setAckCode("E", $msg);
  }
}
