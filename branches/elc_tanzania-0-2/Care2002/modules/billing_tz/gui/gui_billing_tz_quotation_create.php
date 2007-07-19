
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <TITLE><?php echo $LDNewQuotation; ?>(<?php echo $enc_obj->ShowPID($batch_nr); ?>) - </TITLE>
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

	.table_content {
	            border: 1px solid #000000;
	}
	
	.tr_content {
		        border: 1px solid #000000;
	}
	
	.td_content {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: dotted;
	border-bottom-style: solid;
	border-left-style: dotted;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
	}
p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
}
	
	.headline {
	            background-color: #CC9933;
	            border-top-width: 1px;
	            border-right-width: 1px;
	            border-bottom-width: 1px;
	            border-left-width: 1px;
	            border-top-style: solid;
	            border-right-style: solid;
	            border-bottom-style: solid;
	            border-left-style: solid;
	}

A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
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
			//if (sum_total<0) sum_total=0;
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
			//if (sum_total<0) sum_total=0;
			document.getElementById('div_' + id).innerHTML='<table width="100%" border="0"><tr><td>' + document.forms[0].elements['showprice_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' = </td><td align="right">' + sum + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align="right"><b>' + sum_total + ' TSH</b></td></tr></table><input type="hidden" name="pressum_' + id + '" value="'+ sum_total + '">';

		}
	}
}
</script>


</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >

<table width="100%" border="0" cellspacing="0" height="100%">
  <tr valign=top  class="titlebar" >
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDCreateQuotationfor; ?>
      </font><font color="#330066"> <?php echo $encoded_batch_number=$enc_obj->ShowPID($pid); ?></font>
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('billing_create_2.php','Billing :: Create Quotation')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
      <a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
    </td>
  </tr>
  <tr valign=top>
    <td colspan="2">
		<table width="100%" bgcolor="#ffffff" cellspacing="0" cellpadding="5" >
			   <tr>
			<td>
			<tr>
			  <td>
			  <form method="POST" action="">
			  <table width="600" border="0" align="center" bgcolor="#FFFF88" class="table_content">
			  	<tr>
			  		<td>
			  			<font class="submenu_item"><?php echo $LDCurrentQuotation; ?></font>
			  		</td>
			  		<td align="right">
			  			<?php echo $namelast.', '.$namefirst.' (PID: '.$encoded_batch_number.')'; ?>
			  		</td>
			  	</tr>
			  </table><br><br>
			  <?php if($countlab>0)
			  {
			  ?>
			  <center><font class="submenu_item"><?php echo $LDLabRequest; ?></font></center>
			  <table width="600" border="0" align="center" class="table_content">


					<?php
					 $id_array = array();
					 $bill_obj->ShowNewQuotationEncounter_Laboratory($encounter_nr, $id_array,$IS_PATIENT_INSURED); ?>
				</table>
					  <input type="hidden" value="insert" name="task">
					  <input type="hidden" value="<?php echo $encounter_nr; ?>" name="encounter_nr">
					  <input type="hidden" value="<?php echo $createmode; ?>" name="createmode">
					  <input type="hidden" value="<?php echo $pid; ?>" name="pid">
			  <?php
				}
			  if($countpres>0)
			  {
			  ?><br>
			  <center><font class="submenu_item"><?php echo $LDPrescription; ?></font></center>
				<table width="600" border="0" align="center" class="table_content">
          	<form method="POST" action="">
					<?php $bill_obj->ShowNewQuotationEncounter_Prescriptions($encounter_nr,$id_array,$IS_PATIENT_INSURED); ?>
              <tr>
					  <td bgcolor="#ffffdd" width="80" colspan="4">

					  <input type="hidden" value="insert" name="task">
					  <input type="hidden" value="<?php echo $encounter_nr; ?>" name="encounter_nr">
					  <input type="hidden" value="<?php echo $pid; ?>" name="pid">
					  </td>
					  <td bgcolor="#ffffdd" colspan="4" align="right"></td>

					</tr>
				</table>
				<?php
				}
				?>
					  <script language="JavaScript">
					  var objectarray = new Array();
					  	function sum_all()
					  	{
					  		var totalsum=0;
					  		var insurancebalance=0;


					  		<?php
					  		$arraycount=0;
					  		while(list($x,$v) = each($id_array))
					  		{
					  			$objectarray[$arraycount++] = substr(strstr($x,'_'),1);
					  			echo 'if(document.forms[0].elements[\''.$x.'\'])
					  							if(!isNaN(document.forms[0].elements[\''.$x.'\'].value))
					  							{
					  								if(document.forms[0].elements[\'modepres_'.substr(strstr($x,'_'),1).'\'])
					  								{

					  									if(document.forms[0].elements[\'modepres_'.substr(strstr($x,'_'),1).'\'][0].checked)
					  									{
						  									totalsum = totalsum + parseInt(document.forms[0].elements[\''.$x.'\'].value);
						  									if(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'])
						  									{
																if(parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value) <= (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value)))
							  									{
							  								    	insurancebalance=insurancebalance + parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value);
							  								    }else
							  								    {
							  								    	insurancebalance=insurancebalance + (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value));
							  								    }
							  								}
						  								}
					  								}
					  								else
					  								{
														if(document.forms[0].elements[\'modelab_'.substr(strstr($x,'_'),1).'\'])
														{

						  									if(document.forms[0].elements[\'modelab_'.substr(strstr($x,'_'),1).'\'][0].checked)
						  									{
							  									totalsum = totalsum + parseInt(document.forms[0].elements[\''.$x.'\'].value);
							  									if(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'])
							  									{
																	if(parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value) <=parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value))
								  								    	insurancebalance=insurancebalance + parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value);
								  								    else
								  								    {
								  								    	insurancebalance=insurancebalance + (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value));
								  								    }
							  								    }
							  								}
						  								}
													}
						  						}
					  			';
									$y = $x;
					  		}
					  		$x = $y;
/*					  			echo '

					  			if(document.getElementById(\'modepres_'.substr(strstr($x,'_'),1).'\'))
					  			{


					  			}
					  			if(document.getElementById(\'modelab_'.substr(strstr($x,'_'),1).'\'))
					  				alert(document.getElementById(\'modelab_'.substr(strstr($x,'_'),1).'\').value);';
	*/
							echo 'balance='.$insurancebudget.'-insurancebalance;';
							echo 'if(balance<0) balance = \'<font color="#FF0000">\' + balance + \'</font>\';';
					  		echo 'document.getElementById(\'totalsum\').innerHTML=\' '.$LDTotalSum.' <b>\' + totalsum + \' TSH</b>';
					  		echo '<br>Your insurance balance is: <b>'.$insurancebudget.' - \' + insurancebalance + \' = \' + balance + \' TSH</b>';
					  		echo '\';';
					  		?>
					  	}
					  	function TriggerAllItems(trigger)
					  	{

					  	var showtr;
					  	if(trigger==0) {
					  		showtr = true;
					  	} else {
					  		showtr = false;
					  	} // end of if(trigger==0)
						<?php
						while(list($x,$v) = each($objectarray))
						{
							echo "
							if(document.forms[0].elements['modepres_".$v."'])
							{
								document.forms[0].elements['modepres_".$v."'][trigger].checked = true;
								toggle_tr('tr_".$v."',showtr,'".$v."');
							}
							if(document.forms[0].elements['modelab_".$v."'])
							{
								document.forms[0].elements['modelab_".$v."'][trigger].checked = true;
								toggle_tr('tr_".$v."',showtr,'".$v."');
							}
							";

						} // end of while(list($x,$v) = each($objectarray))

						?>

					  	} // end of function TriggerAllItems(trigger)
					  </script>

				<table width="600" border="0" align="center">
					<tr>
						<td>
							<?php echo $LDMarkallitems; ?>
						</td>
						<td align="right">
							<input type="button" value="<?php echo $LDSelect; ?>" onClick="javascript:TriggerAllItems(0);">
							<input type="button" value="<?php echo $LDTodo; ?>" onClick="javascript:TriggerAllItems(1);">
							<input type="button" value="<?php echo $LDDelete; ?>" onClick="javascript:TriggerAllItems(2);">
						</td>
					</tr>
					<tr>
						<td>
							<input type="button" value="<?php echo $LDCalculateTotalSum; ?>" onClick="javascript:sum_all();">
						</td>
						<td>
							<div id="totalsum" width="400">
								<?php echo $LDTotalSumnotcalculated; ?>
								<?php
											if($insurance_obj->is_patient_insured($pid)) {
												echo '<br>'. $namelast.', '.$namefirst.'  is insured by: '.$insurance_obj->GetName_insurance_from_pid($pid);
												echo '<br>'.$LDRemainingInsurancebudget .'<b>'.$insurancebudget.' TSH</b>';
											} else
												echo '<br>'.$LDThereisnovalidinsurance;
								?></div>
						</td>
					</tr>
					<tr>
						<td>&nbsp;
						</td>
						<td>
							<?php if(!$insurancebudget) echo 'Assign here to a insurance:'?>

							<?php echo $insurance_obj->ShowAllInsurancesForQuotatuion(); ?>
						</td>
					</tr>
					<tr>
						<td>
							<input type="reset" value="<?php echo $LDResetFields; ?>">
						</td>
						<td align="right">
							<input type="submit" value="<?php echo $LDFinished; ?>">
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