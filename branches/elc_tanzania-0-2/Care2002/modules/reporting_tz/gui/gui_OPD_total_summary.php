<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE> Reporting Module </TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo sid;?>&lang=$lang&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->

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
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo sid;?>&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>

 
</HEAD>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<!-- START HEAD OF HTML CONTENT -->


<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">

	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td width="202" bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">Reporting:: OPD Total Summary </font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('submenu1.php','Pharmacy Databank')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
  </td>
 </tr>
 </table>	
 
<!-- END HEAD OF HTML CONTENT -->

<form name="form1" method="post" action="">
                          </p>
										
						  <br><br><br>
                          <table width="500" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            <tr>
                              <td widtd="220" bgcolor="#ffffaa">OPD Visits  </td>
                              <td widtd="32" bgcolor="#ffffaa">&lt; 5 </td>
                              <td widtd="32" bgcolor="#ffffaa">&gt; 5 </td>
                              <td colspan="2" bgcolor="#ffffaa">Sex (male/female) </td>
                              <td widtd="64" bgcolor="#ffffaa">Total</td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b>Return</b></td>
                              <td><?php echo $arr_ret['return']['underage'];?></td>
                              <td><?php echo $arr_ret['return']['adult'];?></td>
                              <td width="69"><?php echo $arr_ret['return']['male'];?></td>
                              <td width="69"><?php echo $arr_ret['return']['female'];?></td>
                              <td><?php echo $arr_ret['return']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b>New Registrations</b> </td>
                              <td><?php echo $arr_ret['NewRegistration']['underage'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['adult'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['male'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['female'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b>Views for the same reasons:</b> </td>
                              <td><?php echo $arr_ret['revisit']['underage'];?></td>
                              <td><?php echo $arr_ret['revisit']['adult'];?></td>
                              <td><?php echo $arr_ret['revisit']['male'];?></td>
                              <td><?php echo $arr_ret['revisit']['female'];?></td>
                              <td><?php echo $arr_ret['revisit']['total'];?></td>
                            </tr>							
                            <tr>
                              <td bgcolor="#ffffaa"><b>Total</b></td>
                              <td><b><?php echo $arr_ret['Total']['underage'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['adult'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['male'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['female'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['total'];?></b></td>
                            </tr>							
                            <tr>
                              <td bgcolor="#ffffaa">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b>Total Pedriatics: </b></td>
                              <td><?php echo $arr_ret['Total_Pedriatics']['underage'];?></td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                          </table>
				</form>			  
						  <br><br><br>						  


<!-- START BOTTIOM OF HTML CONTENT --->
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
	<td align="center">
  		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   		<tr>
   			<td>
	    		<div class="copyright">
					<script language="JavaScript">
					<!-- Script Begin
					function openCreditsWindow() {
					
						urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
						creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");
					
					}
					//  Script End -->
					</script>

	
					 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
					 <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
					 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
					 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

				</div>
    		</td>
   		<tr>
  		</table>
	</td>
	</tr>
</table>
<!-- START BOTTIOM OF HTML CONTENT --->

</body>