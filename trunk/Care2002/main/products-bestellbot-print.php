<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","products.php");
$local_user=$userck;
require("../include/inc_front_chain_lang.php");

if ($HTTP_COOKIE_VARS[$local_user.$sid]==NULL) $cat="";  

switch($cat)
{
	case "pharma":	
							$title="$LDPharmacy - $LDOrderBotActivate $LDAck";
							$dbtable="pharma_orderlist_todo";
							$dbtable2="pharma_orderlist_archive";
							$dbtable3="pharma_orderlist";
							break;
	case "medlager":
							$title="$LDMedDepot - $LDOrderBotActivate $LDAck";
							$dbtable="med_orderlist_todo";
							$dbtable2="med_orderlist_archive";
							$dbtable3="med_orderlist";
							break;
	default:   {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
}

if($order_id&&$dept)
{

$rows=0;
$stat2seen=false;
$mov2arc=false;
$deltodo=false;
include("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
		{
		 switch($mode)
		 {
			case "ack_print":
				{
				$sql='UPDATE '.$dbtable.' SET status="o_seen", t_stamp="'.$t_stamp.'" 	
							WHERE dept="'.$dept.'" 
								AND order_id="'.$order_id.'"
								AND t_stamp="'.$t_stamp.'"';
								
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$status=""; 
						$stat2seen=true;
					}
					else { print "$LDDbNoUpdate<br>$sql"; }
					break;
				}
			case "archive":
				{
				$sql='SELECT * FROM '.$dbtable.'   
							WHERE dept="'.$dept.'" 
								AND order_id="'.$order_id.'"
								AND t_stamp="'.$t_stamp.'"';
					if($ergebnis=mysql_query($sql,$link))  // get the data from pharma order list todo
					{
						$rows=0;
						//count rows=linecount
						while ($content=mysql_fetch_array($ergebnis)) $rows++;					
						//reset result
						if ($rows==1)	
						{
							mysql_data_seek($ergebnis,0); // reset to start
							$content=mysql_fetch_array($ergebnis);
							// if data ok save to the pharma orderlist archive
							// set dbtable 
							$sql="INSERT INTO $dbtable2
								   (rec_date,
									rec_time,
									order_id,
									dept,
									clerk,
									done_date,
									status,
									priority,
									t_stamp )
									VALUES(
									'$content[rec_date]',
									'$content[rec_time]',
									'$content[order_id]',
									'$content[dept]',
									'$clerk',
									'".strftime("%Y.%m.%d %H.%M")."',
									'done',
									'$content[priority]',
									'$content[t_stamp]' )";
									
							if($ergebnis=mysql_query($sql,$link)) 
								{										
									$mov2arc=true;
									$sql='DELETE LOW_PRIORITY FROM '.$dbtable.'
											 WHERE dept="'.$dept.'" 
											AND order_id="'.$order_id.'"
											AND t_stamp="'.$t_stamp.'"';
									if($ergebnis=mysql_query($sql,$link)) 
									{
										$status="";
										$deltodo=true;
									}
									else { print "$LDDbNoSave<br>$sql"; }  // insert the data to pharma orderlist archive
								}
								else { print "$LDDbNoSave<br>$sql"; }// insert the data to pharma orderlist archive
						  }	//end of if (rows)									
						}// end of if(ergebnis)
						else { print "$LDDbNoRead<br>$sql"; } 
					 break;
					}// end of case "archive":
		 		}// end of switch(mode)


				$sql='SELECT * FROM '.$dbtable3.' 
					WHERE order_id="'.$order_id.'"
					AND dept="'.$dept.'"';
							
        		if($ergebnis=mysql_query($sql,$link))
				{
					//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);
				}else { print "$LDDbNoRead<br>$sql"; } 
			//print $sql;
		}
  		 else { print "$LDDbNoLink<br>"; } 
}
?>

<html>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<!-- Creation date: 14.07.01 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $title ?></title>

<script language=javascript>
function ack_print()
{
	window.print()
	window.location.replace("products-bestellbot-print.php?<?php print "sid=$sid&lang=$lang&userck=$userck&mode=ack_print&cat=$cat&dept=$dept&order_id=$order_id&t_stamp=$t_stamp&status=$status"; ?>")
}
function move2arch()
{
	if(document.opt.clerk.value=="")
	{
		alert('<?php echo $LDAlertEnterName ?>');
		return;
	}
	c=document.opt.clerk.value;
	window.location.replace("products-bestellbot-print.php?<?php print "sid=$sid&lang=$lang&userck=$userck&mode=archive&cat=$cat&dept=$dept&order_id=$order_id&t_stamp=$t_stamp&status=$status&clerk="; ?>"+c)
}
function parentref(n)
{
window.opener.location.replace('products-bestellbot.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"?>&cat=<?php echo $cat ?>&nofocus='+n+'&showlist=1');
setTimeout("parentref(0)",10000);
}
</script>

</head>
<body bgcolor=#fefefe onLoad="if (window.focus) window.focus(); 
<?php 
	if($stat2seen) print "parentref(1);"; 
	if($deltodo) print "parentref(1);"; 
?>" 
>
<p>
<form name="opt">
<?php
//foreach($argv as $v) print "$v ";

if($rows>0)
{
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

$tog=1;
$content=mysql_fetch_array($ergebnis);

print '<p>
		<font face="Verdana, Arial" size=2 >'.$final_orderlist.strtoupper($dept).'</font><br>
		<font face="Arial" size=2> '.$LDListindex[2].': ';
		$dt=explode(".",$content[order_date]);
		print "$dt[2].$dt[1].$dt[0] ";
		print $LDAt.': '.str_replace("24","00",$content[order_time]).'<p>';
		if($content[priority]=="urgent") print "******************** $LDUrgent $LDUrgent $LDUrgent *******************";
		print'
		<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($LDFinindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 >'.$LDFinindex[$i].'</td>';
	print '</tr>';	

$i=1;
$artikeln=explode(" ",$content[articles]);
for($n=0;$n<sizeof($artikeln);$n++)
 	{
	
	parse_str($artikeln[$n],$r);
	if($tog)
	{ print '<tr bgcolor="#ffffff">'; $tog=0; }else{ print '<tr bgcolor="#ffffff">'; $tog=1; }
	print'
				<td>';
	print'	
				<font face=Arial size=2 >'.$i.'</td>
				<td><font face=Verdana,Arial size=2> &nbsp;'.$r[artikelname].' &nbsp;</td>
				 <td><font face=Verdana,Arial size=2>'.$r[pcs].'</td>
					<td ><font face=Verdana,Arial size=2><nobr>X '.$r[proorder].'</nobr></td>
			<td><font face=Verdana,Arial size=2> &nbsp;'.$r[bestellnum].'</td>
				</tr>';
	$i++;

 	}
	print '</table></td></tr></table>';
	if($content[priority]=="urgent") print "******************** $LDUrgent $LDUrgent $LDUrgent *******************";
	print'
			<p>
			'.$LDCreatedBy.': '.$content[encoder].'<p><hr>';
			
	switch($status)
	{
		case "o_todo":{ print '
									
									<input type="button" value="GO" onClick="ack_print()"> '.$LDOrderAck.'<p>';
							break;
						}
		case "o_seen":{ print '
									<input type="button" value="GO" onClick="window.print()"> <b>'.$LDOrderPrint.'</b><p>
									'.$LDProcessedBy.':<input type="text" name="clerk" size=25 maxlength=40><br>
									<input type="button" value="GO" onClick="move2arch()"> <b>'.$LDOrder2Archive.'</b>
                                    <p>';
							break;
						}
	}//end of switch(status)
} // end of if(rows)
else print'
<img src="../img/nedr.gif" width=100 height=138 border=0 align=middle>'.$LDDataNoFoundTxt;

?>
<p align=right><input type="button" value="<?php echo $LDClose ?>" onClick="parentref(0);window.close();"></p>
</form>
</font></body>
</html>
