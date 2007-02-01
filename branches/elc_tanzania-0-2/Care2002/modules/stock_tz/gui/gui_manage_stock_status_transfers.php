

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Care2x - Stock</TITLE>
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

<script language="JavaScript">
function toggle_tr(myelem,show,id) {
 if(show){
   document.getElementById(myelem).style.display = '';
   if(show)
   calc_article(id);
 }else{
   document.getElementById(myelem).style.display = 'none';
 }
}
function calc_article(id)
{
	if(document.forms[0].elements['insurance_' + id])
	{
		if(isNaN(document.forms[0].elements['showprice_' + String(id)].value) || isNaN(document.forms[0].elements['dosage_' + id].value) || isNaN(document.forms[0].elements['insurance_' + id].value))
		{
			document.getElementById('div_' + id).innerHTML='n/a';
		}
		else
		{
			sum = document.forms[0].elements['showprice_' + id].value * document.forms[0].elements['dosage_' + id].value;
			sum_total = sum - document.forms[0].elements['insurance_' + id].value;
			if (sum_total<0) sum_total=0;
			document.getElementById('div_' + id).innerHTML='<table width="100%" border="0"><tr><td>' + document.forms[0].elements['showprice_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' = </td><td align="right">' + sum + ' TSH</td></tr><tr><td>Insurance:</td><td align="right">- ' + document.forms[0].elements['insurance_' + id].value + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align="right"><b>' + sum_total + ' TSH</b></td></tr></table><input type="hidden" name="pressum_' + id + '" value="'+ sum_total + '">';
			
		}
	}
	else
	{
		if(isNaN(document.forms[0].elements['showprice_' + String(id)].value) || isNaN(document.forms[0].elements['dosage_' + id].value))
		{
			document.getElementById('div_' + id).innerHTML='n/a';
		}
		else
		{
			sum = document.forms[0].elements['showprice_' + id].value * document.forms[0].elements['dosage_' + id].value;
			sum_total = sum;
			if (sum_total<0) sum_total=0;
			document.getElementById('div_' + id).innerHTML='<table width="100%" border="0"><tr><td>' + document.forms[0].elements['showprice_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' = </td><td align="right">' + sum + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align="right"><b>' + sum_total + ' TSH</b></td></tr></table><input type="hidden" name="pressum_' + id + '" value="'+ sum_total + '">';
			
		}
	}
}
</script>

 
</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >

<table width=100% border=0 cellspacing=0 height=100%>
  <tr valign=top  class="titlebar" > 
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Manage pending transfers</font> 
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('billing.php','quotation','details')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a> 
      <a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a> 
    </td>
  </tr>
  <tr valign=top> 
    <td colspan="2">
		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
			   <tr>
			<td>
			<tr>
			  <td>
			  <form method="POST" action="" name="step1">
			  <center><font class="submenu_item">Pending transfers</font></center>
				<table width="600" border="0" align="center">
          			<tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="700">
					  		<tr bgcolor="#ffff88">
					  			<td width="100">	
					  				<div align="center">Date</div>
					  			</td>
					  			<td width="100">
					  				<div align="center">Druglist-ID</div>
					  			</td>
					  			<td width="250">
					  				<div align="center">Description</div>
					  			</td>
					  			<td width="100">
					  				<div align="center">Amount</div>
					  			</td>
					  			<td>
					  				<div align="right">
					  				<table border="0" cellpadding="0" width="130">
					  					<tr>
					  						<td width="60"><img align=absmiddle src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="right"><img align=absmiddle src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></td>
					  					</tr>
					  				</table>
					  				
					  				
										
					  				</div>
					  			</td>
					  		</tr>

					  	</table>
					  </td>
					</tr>
			<?php
			
			$transfers = $stock_obj->get_pending_transfers();
			
		$color_change=FALSE;
		if(is_array($transfers))
	    while (list($x,$row) = each($transfers))
	    {
	      if ($color_change) {
	        $BGCOLOR='bgcolor="#ffffdd"';
	        $color_change=FALSE;
	      } else {
	        $BGCOLOR='bgcolor="#ffffaa"';
	        $color_change=TRUE;
	      }
	      $id_array['pressum_'.$row['nr']]= true;
	      
	      echo '
          <tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="700">
					  		<tr bgcolor="#ffffaa">
					  			<td width="100">
					  				<div align="center">'.date("d.m.y H:i:s", $row['Timestamp_started']).'</div>
					  			</td>
					  			<td width="100">
					  				<div align="center"><input type="text" name="newdrugid_'.$row['ID'].'" size="5" value="'.$row['Drugsandservices_id'].'"></div>
					  			</td>
					  			<td width="250">
					  				<div align="center">'.$stock_obj->get_description($row['Drugsandservices_id']).'</div>
					  			</td>
					  			<td width="100">
					  				<div align="center"><input type="text" name="amount_'.$row['ID'].'" size="5" value="'.$row['Amount'].'"> Pcs.</div>
					  			</td>
					  			<td>
					  				<div align="right">
					  				<table border="0" cellpadding="0" width="130">
					  					<tr>
					  						<td width="60"><input type="radio" checked value="update" name="trigger_'.$row['ID'].'" onClick="javascript:toggle_tr(\'tr_'.$row['ID'].'\',true,\''.$row['ID'].'\');"><img align=absmiddle src="../../gui/img/common/default/check2.gif" border=0 alt="Receive this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="right"><input type="radio" value="delete" name="trigger_'.$row['ID'].'" onClick="javascript:toggle_tr(\'tr_'.$row['ID'].'\',false,\''.$row['ID'].'\');"><img align=absmiddle src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></td>
					  					</tr>
					  				</table>
					  				
					  				
										
					  				</div>
					  			</td>
					  		</tr>

					  	</table>
					  </td>
					</tr>';
}
else
{
	echo '			<tr>
						<td bgcolor=#ffffdd width="80" colspan="8" align="center">
							Nothing to do :)
						</td>
					</tr>';
}
		?>
              <tr>
					  <td bgcolor=#ffffdd width="80" colspan="4">

					  <input type="hidden" value="update" name="task">
					  </td>
					  <td bgcolor=#ffffdd colspan="4" align="right"></td>

					</tr>
				</table>

					  <script language="JavaScript">
					  var objectarray = new Array();
					  	
					  	function TriggerAllItems(trigger)
					  	{
						<?php
						reset($transfers);
						while(list($x,$v) = each($transfers))
						{
							echo "
							if(document.forms[0].elements['trigger_".$v['ID']."'])
							{
								document.forms[0].elements['trigger_".$v['ID']."'][trigger].checked = true;
							}
							";
							
						}
						?>
					  	}
					  </script>

				<table width="700" border="0" align="center">
					<tr>
						<td>
							Mark all items at once:
						</td>
						<td align="right">
							<input type="button" value="Update" onClick="javascript:TriggerAllItems(0);">
							<input type="button" value="Delete" onClick="javascript:TriggerAllItems(2);">
						</td>
					</tr>
					<tr>
						<td>
							<input type="reset" value="Reset fields">
						</td>
						<td align="right">
							<input type="submit" value="I'm finished">
						</td>
					</tr>
				</table>
				</td>
			</form>
			</tr>
		</table>	
	</td>
  </tr>
</table>		

</BODY>
</HTML>