	// JavaScript Document

	var xmlHttp

	var dd

	function myprint(){this.window.print();}

	//################# FOR LISTS #########################

	function navigate(str,pg)
	{
	dd = str
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	 {
	 alert ("Browser does not support HTTP Request")
	 return
	 }
	var url= pg
	url=url+"?encounter="+str
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=trace
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
	}

	//#####################################################

	function trace()
	{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	 {
	 document.getElementById("specials").innerHTML=xmlHttp.responseText
	}
	}

	//#####################################################
	function GetXmlHttpObject()
	{
	var xmlHttp=null;
	try
	 {
	 // Firefox, Opera 8.0+, Safari
	 xmlHttp=new XMLHttpRequest();
	 }
	catch (e)
	 {
	 //Internet Explorer
	 try
	  {
	  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	  }
	 catch (e)
	  {
	  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	 }
	return xmlHttp;
	}

	//################# END #########################