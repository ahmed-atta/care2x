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

	function xmlrpc($hosturl,$usr,$pwd,$debuglvl)
	{
		$this->ServerURL = $hosturl;
   	 	$this->user = new xmlrpcval($usr);
		$this->password = new xmlrpcval($pwd);
		$this->DebugLevel = $debuglvl;
		$this->client = new xmlrpc_client($this->ServerURL);
		$this->client->setDebug($this->DebugLevel);
	}

	function transfer($data,$call)
	{
		$details = php_xmlrpc_encode($data);
		$msg = new xmlrpcmsg($call, array($details, $this->user, $this->password));
		$this->client->setDebug($this->DebugLevel);
		$this->response = $this->client->send($msg);
	}

	function exist_entry($criteria,$call)
	{
		$exits = true;
		$criteria = new xmlrpcval($criteria);
		$msg = new xmlrpcmsg($call, array($criteria, $this->user, $this->password));
		$this->response = $this->client->send($msg);

		$debtor = php_xmlrpc_decode($this->response->value());
		if (sizeof($debtor)<20) {
			$exits = false;
		}
		else
		{
			$exist= true;
		}
		return $exist;
	}

	function get_data($criteria,$call)
	{
		$criteria = new xmlrpcval($criteria);
		$msg = new xmlrpcmsg($call, array($criteria, $this->user, $this->password));
		$this->response = $this->client->send($msg);
		$data = php_xmlrpc_decode($this->response->value());
		return $data;
	}
}
?>
