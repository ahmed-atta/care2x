<?php 
if ($printout) {
echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>'.$LDDentalSummary.'</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
?>
<DIV align="center">
	<h1><?php echo $LDDentalReportfor; ?><?php echo date('F Y',$start);?></h1>
	<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
</DIV>
         <table width="444" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
            <td width="146" bgcolor="#ffffaa" widtd="220"><b><?php echo $LDPROCEDURE; ?></td>
            <td width="89" bgcolor="#ffffaa" widtd="32"><b><?php echo $LDPrice; ?></td>
            <td width="103" bgcolor="#ffffaa" widtd="32"><b><?php echo $LDNOofTests; ?></td>
            <td width="96" bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></td>
            
          </tr>
		  
		  <?php 

		
		
		 
		 
		// echo "Start time of the script:".date("G:i:s")."<br>";
		 //echo "Looking for test $TestID by time range: day: ".date("d.m.y", $start_timeframe)." starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s", $end_timeframe)."<br>";
			
		  if ($debug) echo "elements in the array: ".sizeof($res_array)."<br>";
		  $db->Execute("SET @@max_heap_table_size=4294967296");
		  while(list($u,$v)=each($res_array) )
		  {
		 	 
			 $total_tests=$total_tests+$v['TESTS'];		 
		  	 $test=$v['SERVICE'];
			 $sql_price="SELECT distinct(price) as PRICE FROM $tmp_table WHERE description='$test'";
			 $db_ptr_price = $db->Execute($sql_price);
			 $db_row_price=$db_ptr_price->FetchRow();
			 $total=$db_row_price['PRICE']*$v['TESTS'];
			 $g_total=$g_total+$total;
			 /* $sql_tests="SELECT  count( amount ) AS TESTS FROM $tmp_table  WHERE description ='$test' AND date_change>='$start_timeframe' AND date_change<='$end_timeframe'" ;
			 $db_ptr_tests = $db->Execute($sql_tests);
			 $db_row_tests=$db_ptr_tests->FetchRow();
			 $total_tests=$total_tests+$db_row_tests['TESTS'];
			 $total=$v['PRICE']*$db_row_tests['TESTS'];
			 $total=$db_row_price['PRICE']*$v['TESTS'];
			 */
			  /* $sql_age5_14="SELECT count( * ) AS Total_age5_14 FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=14 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_age5_14 = $db->Execute($sql_age5_14);
  			  $sql_new="SELECT count( * ) AS NEW  FROM $tmp_table2 WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' ";
			  //$sql_new="SELECT count( * ) AS NEW  FROM care_person,care_encounter WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' and care_person.pid=care_encounter.pid and date_format( care_encounter.encounter_date, '%d.%m.%y' )=date_format( care_person.date_reg, '%d.%m.%y' )";
			  $db_ptr_new = $db->Execute($sql_new);
			  
			  $db_row_under_age=$db_ptr_under_age->FetchRow();
			  $db_row_age5_14=$db_ptr_age5_14->FetchRow();
			  $db_row_new=$db_ptr_new->FetchRow();
			  
			  
			  //$total_new=$total_new+$v['NEW'];
			  $total_new=$total_new+$db_row_new['NEW'];
			  $total_return=$total_opd-$total_new;
			  $total_underage=$total_underage+$db_row_under_age['Total_underage'];
			  $total_age5_14=$total_age5_14+$db_row_age5_14['Total_age5_14'];
			  $total_paediatrics= $total_underage+$total_age5_14;			  
			  */
		  ?>
		  
          <tr> 
            <td width="146" bgcolor="#ffffaa" widtd="220"><?php echo $v['SERVICE']; ?></td>
            <td width="89" bgcolor="#ffffaa" widtd="32"><?php echo number_format($db_row_price['PRICE']);// echo  number_format($v['PRICE']);//?></td>
            <td width="103" bgcolor="#ffffaa" widtd="32"><?php  echo $v['TESTS'];// $db_row_tests['TESTS'];// ?></td>
            <td width="96" bgcolor="#ffffaa"><?php echo number_format($total); //echo $v['RET']; ?></td>
            
          </tr>
		  
		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr> 
            <td width="146" bgcolor="#ffffaa" widtd="220"><b><?php echo $LDtotal; ?></td>
            <td width="89" bgcolor="#ffffaa" widtd="32"><?php //echo $total_opd;?></td>
            <td width="103" bgcolor="#ffffaa" widtd="32"><?php echo $total_tests;?></td>
            <td width="96" bgcolor="#ffffaa"><?php echo number_format($g_total);?></td>
            
          </tr>  
        </table>
      
<?php
exit();
}
?>




<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDReportingModule; ?></TITLE>
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
function printOut()
    {
    	urlholder="./reporting_dental.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
    	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
      	window.testprintout.moveTo(0,0);
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
          <td width="250" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDReportingDentalReport; ?></font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
  </td>
 </tr>
 </table>	
 
<!-- END HEAD OF HTML CONTENT -->

<form name="form1" method="post" action=""></p>
        <?php require_once($root_path.$top_dir.'include/inc_gui_timeframe.php'); ?>
        <p><br>
          <br>
          <br>
        </p>
        <table width="444" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
            <td width="146" bgcolor="#ffffaa" widtd="220"><b><?php echo $LDPROCEDURE; ?></td>
            <td width="89" bgcolor="#ffffaa" widtd="32"><b><?php echo $LDPrice; ?></td>
            <td width="103" bgcolor="#ffffaa" widtd="32"><b><?php echo $LDNOofTests; ?></td>
            <td width="96" bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></td>
            
          </tr>
		  
		  <?php 

		
		
		 
		 
		// echo "Start time of the script:".date("G:i:s")."<br>";
		 //echo "Looking for test $TestID by time range: day: ".date("d.m.y", $start_timeframe)." starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s", $end_timeframe)."<br>";
			
		  if ($debug) echo "elements in the array: ".sizeof($res_array)."<br>";
		  $db->Execute("SET @@max_heap_table_size=4294967296");
		  while(list($u,$v)=each($res_array) )
		  {
		 	 
			 $total_tests=$total_tests+$v['TESTS'];		 
		  	 $test=$v['SERVICE'];
			 $sql_price="SELECT distinct(price) as PRICE FROM $tmp_table WHERE description='$test'";
			 $db_ptr_price = $db->Execute($sql_price);
			 $db_row_price=$db_ptr_price->FetchRow();
			 $total=$db_row_price['PRICE']*$v['TESTS'];
			 $g_total=$g_total+$total;
			 /* $sql_tests="SELECT  count( amount ) AS TESTS FROM $tmp_table  WHERE description ='$test' AND date_change>='$start_timeframe' AND date_change<='$end_timeframe'" ;
			 $db_ptr_tests = $db->Execute($sql_tests);
			 $db_row_tests=$db_ptr_tests->FetchRow();
			 $total_tests=$total_tests+$db_row_tests['TESTS'];
			 $total=$v['PRICE']*$db_row_tests['TESTS'];
			 $total=$db_row_price['PRICE']*$v['TESTS'];
			 */
			  /* $sql_age5_14="SELECT count( * ) AS Total_age5_14 FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=14 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_age5_14 = $db->Execute($sql_age5_14);
  			  $sql_new="SELECT count( * ) AS NEW  FROM $tmp_table2 WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' ";
			  //$sql_new="SELECT count( * ) AS NEW  FROM care_person,care_encounter WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' and care_person.pid=care_encounter.pid and date_format( care_encounter.encounter_date, '%d.%m.%y' )=date_format( care_person.date_reg, '%d.%m.%y' )";
			  $db_ptr_new = $db->Execute($sql_new);
			  
			  $db_row_under_age=$db_ptr_under_age->FetchRow();
			  $db_row_age5_14=$db_ptr_age5_14->FetchRow();
			  $db_row_new=$db_ptr_new->FetchRow();
			  
			  
			  //$total_new=$total_new+$v['NEW'];
			  $total_new=$total_new+$db_row_new['NEW'];
			  $total_return=$total_opd-$total_new;
			  $total_underage=$total_underage+$db_row_under_age['Total_underage'];
			  $total_age5_14=$total_age5_14+$db_row_age5_14['Total_age5_14'];
			  $total_paediatrics= $total_underage+$total_age5_14;			  
			  */
		  ?>
		  
          <tr> 
            <td width="146" bgcolor="#ffffaa" widtd="220"><?php echo $v['SERVICE']; ?></td>
            <td width="89" bgcolor="#ffffaa" widtd="32"><?php echo number_format($db_row_price['PRICE']);// echo  number_format($v['PRICE']);//?></td>
            <td width="103" bgcolor="#ffffaa" widtd="32"><?php  echo $v['TESTS'];// $db_row_tests['TESTS'];// ?></td>
            <td width="96" bgcolor="#ffffaa"><?php echo number_format($total); //echo $v['RET']; ?></td>
            
          </tr>
		  
		<?php }
		 
		?>
		<tr> 
            <td width="146" bgcolor="#ffffaa" widtd="220"><b><?php echo $LDtotal; ?></td>
            <td width="89" bgcolor="#ffffaa" widtd="32"><?php //echo $total_opd;?></td>
            <td width="103" bgcolor="#ffffaa" widtd="32"><?php echo $total_tests;?></td>
            <td width="96" bgcolor="#ffffaa"><?php echo number_format($g_total);?></td>
            
          </tr>  
        </table><?php 
		 //echo "end time of the script:".date("G:i:s")."<br>";
		?>
        <p>&nbsp; </p>
       <!-- <table width="500" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            <tr>
                              <td widtd="220" bgcolor="#ffffaa"><?php echo $LDOPDVisits; ?></td>
                              <td widtd="32" bgcolor="#ffffaa">&lt; 5 </td>
                              <td widtd="32" bgcolor="#ffffaa">&gt; 5 </td>
                              <td colspan="2" bgcolor="#ffffaa"><?php echo $LDsex; ?></td>
                              <td widtd="64" bgcolor="#ffffaa"><?php echo $LDtotal; ?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDRETURN; ?></b></td>
                              <td><?php echo $arr_ret['return']['underage'];?></td>
                              <td><?php echo $arr_ret['return']['adult'];?></td>
                              <td width="69"><?php echo $arr_ret['return']['male'];?></td>
                              <td width="69"><?php echo $arr_ret['return']['female'];?></td>
                              <td><?php echo $arr_ret['return']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDNewRegistrations; ?></b> </td>
                              <td><?php echo $arr_ret['NewRegistration']['underage'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['adult'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['male'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['female'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDViewsforthesameReason; ?></b> </td>
                              <td><?php echo $arr_ret['revisit']['underage'];?></td>
                              <td><?php echo $arr_ret['revisit']['adult'];?></td>
                              <td><?php echo $arr_ret['revisit']['male'];?></td>
                              <td><?php echo $arr_ret['revisit']['female'];?></td>
                              <td><?php echo $arr_ret['revisit']['total'];?></td>
                            </tr>							
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></b></td>
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
                              <td bgcolor="#ffffaa"><b><?php echo $LDTotalPediatrics; ?></b></td>
                              <td><?php echo $arr_ret['Total_Pedriatics']['underage'];?></td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                          </table>-->
				</form>			  
						  <a href="javascript:printOut()"><img border=0 src=<?php echo $root_path;?>/gui/img/common/default/billing_print_out.gif></a><br>									  
						  <br><br><br>  <br><br><br>						  
						  


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