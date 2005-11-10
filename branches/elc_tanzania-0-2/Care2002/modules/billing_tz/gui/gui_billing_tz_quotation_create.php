

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>New Quotations(<?php echo $enc_obj->ShowPID($batch_nr); ?>) - </TITLE>
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
  <tr valign=top  class="titlebar" > 
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Create quotation for
      </font><font color="#330066"> <?php echo $encoded_batch_number=$enc_obj->ShowPID($pid); ?></font> 
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('pending_prescriptions_pharmacy.php')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a> 
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
			  <form method="POST" action="">
			  <table width="80%" border="0" align="center" bgcolor="#FFFF88">
			  	<tr>
			  		<td>
			  			<font class="submenu_item">Current quotation:</font>
			  		</td>
			  		<td align="right">
			  			<?php echo $namelast.', '.$namefirst.' (PID: '.$encoded_batch_number.')'; ?>
			  		</td>
			  	</tr>
			  </table><br><br>
			  <?php if($countlab>0) 
			  {
			  ?>
			  <center><font class="submenu_item">Laboratory requests</font></center>
			  <table width="80%" border="0" align="center">
              <tr>
					  <td bgcolor=#ffffdd width="80"><div align="center">Date</div></td>
					  <td bgcolor=#ffffdd><div align="center">Requestet laboratory tests</div></td>
					  <td bgcolor=#ffffdd width="23"><div align="center"><img src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item now!" style="filter:alpha(opacity=70)"></div></td>
					  <td bgcolor=#ffffdd width="23"><div align="center"><img src="../../gui/img/common/default/clock.gif" width="20" height="20" border=0 alt="Ignore this item now!" style="filter:alpha(opacity=70)"></div></td>
						<td bgcolor=#ffffdd width="23"><div align="center"><img src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></div></td>
					  
					</tr>
          	
					<?php $bill_obj->ShowNewQuotationEncounter_Laboratory($encounter_nr); ?>
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
			  <center><font class="submenu_item">Prescriptions</font></center>
				<table width="80%" border="0" align="center">
              <tr>
					  <td bgcolor=#ffffdd width="80"><div align="center">Date</div></td>
					  <td bgcolor=#ffffdd><div align="center">Article</div></td>
					  <td bgcolor=#ffffdd><div align="center">Price</div></td>
					  <td bgcolor=#ffffdd><div align="center">Dosage</div></td>
					  <td bgcolor=#ffffdd><div align="center">Notes</div></td>
					  <td bgcolor=#ffffdd><div align="center"><img src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item now!" style="filter:alpha(opacity=70)"></div></td>
					  <td bgcolor=#ffffdd><div align="center"><img src="../../gui/img/common/default/clock.gif" width="20" height="20" border=0 alt="Ignore this item now!" style="filter:alpha(opacity=70)"></div></td>
						<td bgcolor=#ffffdd><div align="center"><img src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></div></td>
					  
					</tr>
          	<form method="POST" action="">
					<?php $bill_obj->ShowNewQuotationEncounter_Prescriptions($encounter_nr); ?>
              <tr>
					  <td bgcolor=#ffffdd width="80" colspan="4">
					  
					  <input type="hidden" value="insert" name="task">
					  <input type="hidden" value="<?php echo $encounter_nr; ?>" name="encounter_nr">
					  <input type="hidden" value="<?php echo $pid; ?>" name="pid">
					  </td>
					  <td bgcolor=#ffffdd colspan="4" align="right"></td>

					</tr>
				</table>
				<?php 
				}
				?>
				<table width="80%" border="0" align="center">
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