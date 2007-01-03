

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDPendingTestRequest; ?>(<?php echo $enc_obj->ShowPID($batch_nr); ?>) - </TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo $sid;?>&lang=en&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 


</script> 
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>

  	
<style type="text/css">
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
.billing_topic {font-family: arial; font-size: 12; color:black;}
</style>

<script language="JavaScript" src="<?php echo $root_path;?>js/cross.js"></script>
<script language="JavaScript" src="<?php echo $root_path;?>js/tooltips.js"></script>
<div id="BallonTip" style="POSITION:absolute; VISIBILITY:hidden; LEFT:-200px; Z-INDEX: 100"></div>


 
</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
            <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDPendingBills; ?>
               (<?php echo $encoded_batch_number=$enc_obj->ShowPID($batch_nr); ?>)</font> </td>
  <td bgcolor="#99ccff" align=left>
  	<a href="javascript:gethelp('billing_pendingbills.php','Billing :: Pending Bills')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   	<a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
	
  </td>
 </tr>

 </table>		
         
      </td>
	</tr>

	<tr>
		<td bgcolor=#ffffff valign=top>
		
													
<table border="0">
	<tr valign="top">
		<!-- Left block for the request list  -->
		    <td> <br>
              <br>
              <a href="billing_tz_quotation.php"><?php echo $LDGotoQuotations; ?></a>
<?php 
  
  require($root_path.'include/inc_billing_pending_lister_fx.php'); 
  
?>
		    <td> 

		    
		    
		          <?php
                 
                  if ($NO_PENDING_PRESCRIPTIONS) {
                    echo '<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;no pending prescriptions...<br>';
                  } else {
                                    	
                  	//Content-Frame. Here we go!
                  	$bill_obj->DisplayBills($pid,0,0);
                  	if ($DISPLAY_MSG)
                  	  echo $DISPLAY_MSG;
                  }
               ?>
        </td>
	</tr>
</table>     


						
		</td>
	</tr>
	
		<tr valign=top >
		<td bgcolor=#cccccc>
							<table width="100%" border="1" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
<td align="center">

  <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   <tr>
   	<td>
	    <div class="copyright"> </div>
	    </td>
   <tr>
  </table>
</td>
</tr>
</table>
					</td>

	</tr>
	
	</tbody>
 </table>


</BODY>
</HTML>