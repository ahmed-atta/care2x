<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDNewQuotation; ?>(<?php echo $enc_obj->ShowPID($batch_nr); ?>) - </TITLE>
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
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
<!--
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

// -->

</style>

<script language="JavaScript" src="<?php echo $root_path;?>js/cross.js"></script>
<script language="JavaScript" src="<?php echo $root_path;?>js/tooltips.js"></script>
<div id="BallonTip" style="POSITION:absolute; VISIBILITY:hidden; LEFT:-200px; Z-INDEX: 100"></div>



</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="setBallon('BallonTip');" >

<?php if(!isset($mode)) $mode=''; ?>

<table width=100% border=0 cellspacing=0 height=100%>
  <tr valign=top  class="titlebar" >
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDCreatenewquotation . " for " . $in_outpatient;  ?>
      </font>
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('billing_create.php','Billing :: Create Quotation')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
      <a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
    </td>
  </tr>
  <tr valign=top>
    <td colspan="2">
		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5 >
			   <tr>
			<td>
			<tr>
			  <td>
			  <center><?php

					include_once($root_path.'include/care_api_classes/class_mini_dental.php');
					$obj=new dental;
					global $obj;

					if ($patient=='inpatient') $dep = $clinicInp;
					else if ($patient=='outpatient') $dep = $clinicOutp;

					echo $message;

			   ?></center>
				<table width="100%" border="0" align="center" cellspacing=0  class="table_content">
              <tr>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDDate; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDAdmissionNr; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDPID; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDHospitalfileNR; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDPatientName; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDBirth; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDCount; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $dep; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $info; ?></strong></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDOK; ?></strong></div></td>

				  </tr>
					<?php $bill_obj->ShowNewQuotations($in_outpatient,$sid); ?>
				</table>
			  </td>
			<tr>
			  <td></td>
			</tr>
		</table>
	</td>
  </tr>
</table>

</BODY>
</HTML>