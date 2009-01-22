<?php

require('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
require_once($root_path.'classes/xmlrpc/lib/xmlrpc.inc');


class xmlrpc {

	private $serverURL;
	private $user;
	private $password;
	private $DebugLevel;
	private $client;
	public $response;
	public $parms;

	function xmlrpc($hosturl,$usr,$pwd,$debuglvl)
	{
		$this->ServerURL = $hosturl;
   	 	$this->user = new xmlrpcval($usr);
		$this->password = new xmlrpcval($pwd);
		$this->DebugLevel = $debuglvl;
		$this->client = new xmlrpc_client($this->ServerURL);
		$this->client->setDebug($this->DebugLevel);
	}

	function params($call)
	{
		if (isset($this->parms[$call])) {
			$answer[0]=$this->parms[$call];
			return $answer[0];
		}
		$msg = new xmlrpcmsg("system.methodSignature", array(php_xmlrpc_encode($call)));

		$client = new xmlrpc_client($this->ServerURL);
		$client->setDebug($this->DebugLevel);
		$response = $client->send($msg);
		$answer = php_xmlrpc_decode($response->value());
		$this->parms[$call]=$answer[0];
		return $answer[0];
	}

	function transfer($data,$call)
	{
		$parameters = $this->params($call);
		$parameter_number=sizeOf($parameters)-3;
		if ($parameter_number==0)
		{
			$msg = new xmlrpcmsg($call, array($this->user, $this->password));
		} else if ($parameter_number==1)
		{
			$details = php_xmlrpc_encode($data);
			$msg = new xmlrpcmsg($call, array($details, $this->user, $this->password));
		} else if ($parameter_number==2)
		{
			for ($i=0; $i<$parameter_number; $i++)
			{
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $this->user, $this->password));
		} else if ($parameter_number==3)
		{
			for ($i=0; $i<$parameter_number; $i++)
			{
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $details[2], $this->user, $this->password));
		} else if ($parameter_number==4)
		{
			for ($i=0; $i<$parameter_number; $i++)
			{
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $details[2], $details[3], $this->user, $this->password));
		} else if ($parameter_number==5)
		{
			for ($i=0; $i<$parameter_number; $i++)
			{
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $details[2], $details[3], $details[4], $this->user, $this->password));
		} else if ($parameter_number==6)
		{
			for ($i=0; $i<$parameter_number; $i++)
			{
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $details[2], $details[3], $details[4], $details[5], $this->user, $this->password));
		}
		$this->client->setDebug($this->DebugLevel);
		//$this->client->setDebug(2);
		$this->response = $this->client->send($msg);
		$error_code= php_xmlrpc_decode($this->response->value());
		return $error_code;
	}

}
?>
