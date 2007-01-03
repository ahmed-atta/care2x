

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDBillingArchive; ?> (<?php echo $enc_obj->ShowPID($batch_nr); ?>) - </TITLE>
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
	<script language="javascript" >
<!-- 
function archive()
    {
    document.form1.action="./billing_tz_archive.php?search=TRUE";
	document.form1.submit();
	}

// -->

</script> 
<div id="BallonTip" style="POSITION:absolute; VISIBILITY:hidden; LEFT:-200px; Z-INDEX: 100"></div>


 
</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >
<?php //echo '<iframe name="prescription" src="'.$root_path.'modules/registration_admission/aufnahme_daten_such.php'.URL_APPEND.'&target=search&task=newprescription&back_path='.$back_path.'&pharmacy=yes" width="100%" height="90%" align="left" marginheight="0" marginwidth="0" hspace="0" vspace="0" scrolling="auto" frameborder="0" noresize></iframe> '; ?>
<form name="form1">
<table width=100% border=0 cellspacing=0 height=100%>
  <tr valign=top  class="titlebar" > 
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDBillingArchive; ?>
      </font><font color="#330066"> (<?php echo $encoded_batch_number=$enc_obj->ShowPID($batch_nr); ?>)</font> 
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('billing_archive.php','Billing :: Archive')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a> 
      <a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a> 
    </td>
  </tr>
  <tr valign=top> 
    <td colspan="2">
		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
			 <?php
			 if(!$search)
			 {
			 ?>
			  <tr><td>Enter the search keyword. For example: lastname, or firstname, or Hospital file nr. 
</td></tr>
			 <tr><td><input type=text name=search></td></tr>
			  <tr><td><input type=button name=search value="search" onClick="archive()"></td></tr>
			 
			 <?php
			 
			}
			else
			{
			
			
			?>
			   <tr>
			<td>
			<tr>
			  <td>
				<table width="80%" border="0" align="center">
              <tr>
					  <td bgcolor=#ffffdd><div align="center"><?php echo $LDBillNumber; ?></div></td>
					  <td bgcolor=#ffffdd><div align="center"><?php echo $LDBillingdate; ?></div></td>
					  <td bgcolor=#ffffdd><div align="center"><?php echo $LDBatchFileNr; ?></div></td>
					  <td bgcolor=#ffffdd><div align="center"><?php echo $LDPatientsEncounterNumber; ?></div></td>
					  <td bgcolor=#ffffdd><div align="center"><?php echo $LDPatientName; ?></div></td>
					</tr>
					<?php
							  $no=$_REQUEST['search'];
					 $bill_obj->DisplayArchivedBillHeadlines($no); ?>
				</table>
				</td>
			<tr>
			  <td></td>
			</tr>
		</table>
		<?php } ?>	
	</td>
  </tr>
</table>		
</form>
</BODY>
</HTML>