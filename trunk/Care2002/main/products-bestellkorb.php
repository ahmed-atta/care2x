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
require("../include/inc_config_color.php");

if(!isset($dept)||!$dept)
{
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&!empty($HTTP_COOKIE_VARS['ck_thispc_dept'])) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	 else $dept="plop";//default is plop dept
}

$thisfile="products-bestellkorb.php";

if($cat=="pharma") 
 {
 	$dbtable="pharma_orderlist";
	$title=$LDPharmacy;
 }
 else
 {
 	$dbtable="med_orderlist";
	$title=$LDMedDepot;
 }
 
$encbuf=$HTTP_COOKIE_VARS[$local_user.$sid];
// define the content array
$rows=0;
$count=0;

if($mode!="")
{
	include("../include/inc_db_makelink.php");
		if($link&&$DBLink_OK)
		{
				$sql='SELECT * FROM '.$dbtable.' 
							WHERE order_id="'.$dept.$order_id.'"
							AND dept="'.$dept.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
				//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);
		
				}else { print "$LDDbNoRead<br>"; } 
		 	$content=mysql_fetch_array($ergebnis);
			$artikeln=explode(" ",$content[articles]);
			$ocount=sizeof($artikeln);
			//print $sql;
		if(($mode=="delete")&&($idx!=""))
		{
			if($ocount==1)
		 	{
				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' 
							WHERE order_id="'.$dept.$order_id.'"
							AND dept="'.$dept.'"';
        		$ergebnis=mysql_query($sql,$link);
		 	}
		 	else
		 	{
			$trash=array_splice($artikeln,$idx-1,1);
			$content[articles]=implode(" ",$artikeln);
			$sql='UPDATE '.$dbtable.' SET 
							 		order_date="'.$content[order_date].'",
							  		articles="'.$content[articles].'",
									extra1="'.$content[extra1].'",
									extra2="'.$content[extra2].'",
									encoder="'.$content[encoder].'",
									validator="'.$content[validator].'",
									order_time="'.$content[order_time].'",
									sent_stamp="'.$content[sent_stamp].'",
									ip_addr="'.$content[ip_addr].'",
									priority="'.$content[priority].'"
							   		WHERE order_id="'.$content[order_id].'"
									AND dept="'.$dept.'"';
			 if($ergebnis=mysql_query($sql,$link))
				{
				}else { print "$LDDbNoSave<br>"; } 
		  	}	
		}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++
		if($mode=="add")
		{

			//$dbtable="pharma_products_main"; // set main pharma db table
			if($cat=="pharma") $dbtable="pharma_products_main"; 
				else $dbtable="med_products_main"; 
			for($i=1;$i<=$maxcount;$i++)
			{
					$o="order".$i; 
					if(!$$o) continue;
					$b="bestellnum".$i; 
					// get the needed info from the main pharma db
					$sql='SELECT artikelname, proorder FROM '.$dbtable.' WHERE bestellnum="'.$$b.'"';
        			if($ergeb=mysql_query($sql,$link))
					{
						$result=mysql_fetch_array($ergeb);
							$a='artname'.$i;
							$$a=str_replace("&","%26",strtr($result[artikelname]," ","+")); 
							$po='porder'.$i;
							$$po=$result[proorder];
					}else { print "$LDDbNoRead<br>"; } 
			}
		if($rows) $tart=$content[articles]; else $tart="";
		for ($i=1;$i<=$maxcount;$i++)
			{
				$o="order".$i; 
				if(!$$o) continue;
				$b="bestellnum".$i; 
				$a="artname".$i;
				$po="porder".$i;
				$pc="p".$i;
				$tart.=" bestellnum=".$$b."&artikelname=".$$a."&pcs=".$$pc."&proorder=".$$po; // append new bestellnum to articles
				$tart=trim($tart);
				//print $tart;
			}
		if($rows) $content[articles]=$tart;
		else
		{
			$content=array(	"order_id"=>$dept.$order_id, 
								"order_date"=>strftime("%Y.%m.%d"),// format date to year.mon.day for easier sorting
								"articles"=>$tart,
								"extra1"=>"",
								"extra2"=>"",
								"encoder"=>$encbuf,
								"validator"=>"",
								"order_time"=>str_replace("00","24",strftime("%H.%M")), // set 00.00 to 24.00 for easier sorting
								"ip_addr"=>$REMOTE_ADDR,
								"priority"=>"",
								"sent_stamp"=>"");
		}
		//}
	
		$saveok=false;
		//save actual data to  catalog
		if($cat=="pharma") $dbtable="pharma_orderlist";
			else $dbtable="med_orderlist";

			if($rows) $sql='UPDATE '.$dbtable.' SET 
							 		order_date="'.$content[order_date].'",
							  		articles="'.$content[articles].'",
									extra1="'.$content[extra1].'",
									extra2="'.$content[extra2].'",
									encoder="'.$content[encoder].'",
									validator="'.$content[validator].'",
									order_time="'.$content[order_time].'",
									ip_addr="'.$content[ip_addr].'",
									priority="'.$content[priority].'",
									sent_stamp=""
							   		WHERE order_id="'.$content[order_id].'"
											AND dept="'.$dept.'"';

			else 
				$sql="INSERT INTO ".$dbtable." 
						(	
							dept,
							order_id,
							order_date,
							articles,
							extra1,
							extra2,
							encoder,
							validator,
							order_time,
							ip_addr,
							priority,
							sent_stamp ) 
						VALUES (
							'$dept',
							'$content[order_id]',
							'$content[order_date]',
							'$content[articles]',
							'$content[extra1]',
							'$content[extra2]',
							'$content[encoder]',
							'$content[validator]',
							'$content[order_time]',
							'$content[ip_addr]',
							'$content[priority]',
							'')";
							
        		if($ergebnis=mysql_query($sql,$link))
				{
				//print "ok $sql";
					$saveok=true;
				}
				else { print "$LDDbNoSave<br>"; } 
			//print $sql;
		}// end of if ($mode=="add")
//++++++++++++++++++++++++++++++++++++++++
	}
  	 else { print "$LDDbNoLink<br>"; } 
}

$rows=0;
$wassent=false;

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK)
		{
				$sql='SELECT * FROM '.$dbtable.' 
						WHERE order_id="'.$dept.$order_id.'"
						AND dept="'.$dept.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
					//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	
					{
						mysql_data_seek($ergebnis,0);					
						// check status again to be sure that the list is not sent by somebody else
					   $content=mysql_fetch_array($ergebnis);
						if(($content[sent_stamp]>0)||($content[validator]!=""))
						{
							$wassent=true;
							 $rows=0;
						} // if sent_stamp or validator filled then reject this data
					}
				}else { print "$LDDbNoRead<br>"; } 
		
			//print $sql;
	}
  	 else { print "$LDDbNoLink<br>"; } 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
require("../include/inc_css_a_hilitebu.php");
?>
<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php?sid=<?php print "$sid&lang=$lang&userck=$userck"; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 
<?php 
switch($mode)
{
	case "add":print ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete":print ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
}
print "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php // foreach($argv as $v) print "$v<br>"; ?>

<a href="javascript:gethelp('products.php','orderlist','<?php echo $rows ?>','<?php echo $cat ?>')"><img src="../img/frage.gif" border=0 width=15 height=15 align="right" alt="<?php echo $LDOpenHelp ?>"></a>


<?php
	
if($rows>0)
{
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

$tog=1;
//$content=mysql_fetch_array($ergebnis);
print '<form name=actlist>
		<font face="Verdana, Arial" size=2 color="#800000">'.$LDActualOrder.':</font>
		<font face="Arial" size=1> (am: ';
		$dt=explode(".",$content[order_date]);
		print "$dt[2].$dt[1].$dt[0]";
		print ' zeit: '.str_replace("24","00",$content[order_time]).')</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDcatindex);$i++)
	print '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$LDcatindex[$i].'</td>';
	print '</tr>';	

$i=1;
$artikeln=explode(" ",$content[articles]);
for($n=0;$n<sizeof($artikeln);$n++)
 	{
	
	parse_str($artikeln[$n],$r);
	if($tog)
	{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
	print'
				<td>';
	if($mode=="delete") print '<a name="'.$i.'"></a>';
	print'	
				<font face=Arial size=1 color="#000080">'.$i.'</td>
				<td><font face=Verdana,Arial size=1>'.$r[artikelname].'</td>
				 <td><input type="text" name="order_v'.$i.'" size=3 maxlength=3 value="'.$r[pcs].'"></td>
				<td ><font face=Verdana,Arial size=1><nobr>X '.$r[proorder].'</nobr></td>
				<td><font face=Verdana,Arial size=1>'.$r[bestellnum].'</td>
				<td><a href="#" onClick="popinfo(\''.$r[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$complete_info.$r[artikelname].'"></a></td>
				<td><a href="'.$thisfile.'?sid='.$sid.'&lang='.$lang.'&order_id='.$order_id.'&mode=delete&cat='.$cat.'&idx='.$i.'&userck='.$userck.'" ><img src="../img/delete2.gif" width=16 height=16 border=0 alt="'.$LDRemoveArticle.'"></a></td>
				</tr>';
	$i++;

 	}
	print '</table>
			</form>
			<form action="products-orderlist-final.php" method="get">
			<input type="hidden" name="sid" value="'.$sid.'">
   			<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="order_id" value="'.$order_id.'">
   			<input type="hidden" name="cat" value="'.$cat.'">
   			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="submit" value="'.$LDFinalizeList.'">   
   			</form>	';


}
else
if($wassent)
{
	print '
			<script language="javascript">window.parent.location.replace(\'apotheke-bestellung.php?sid='.$sid.'&lang='.$lang.'&itwassent=1&userck='.$userck.'\')</script>';
}	
else
{
	if($itwassent)
	print '
		<font face="Verdana,Arial" size=2>'.$LDWasSent.'<p></font>';

	print '<img src="../img/catr.gif" width=88 height=80 border=0 align=middle><font face=Verdana,Arial size=2>'.$LDBasketEmpty.'<p>';

// get all lists that are not sent

$rows=0;
include("../include/inc_db_makelink.php");
if($link&&$DBLink_OK)
		{
				$sql='SELECT * FROM '.$dbtable.' 
						WHERE sent_stamp ="0" 
						AND validator="" 
						AND dept="'.$dept.'"
						ORDER BY order_date ';
        		if($ergebnis=mysql_query($sql,$link))
				{
					//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);
				}else { print "$LDDbNoRead<br>"; } 
					//print $sql;
	}
  	 else { print "$LDDbNoLink<br>"; } 
		
//++++++++++ show the last lists+++++++++++++++++++++++++++++++++++++++++

	if($rows>0)
	{	
	
		if ($rows>1) print $LDListNotSentMany;
			 else print $LDListNotSent; 
		print $LDClk2SeeEdit.'<br></font><p>';

		$tog=1;
		print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$last_orderlist.strtoupper($dept).':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
		for ($i=0;$i<sizeof($LDListindex);$i++)
		print '
			<td><font face=Verdana,Arial size=1 color="#000080">'.$LDListindex[$i].'</td>';
		print '</tr>';	

		$i=1;

		while($content=mysql_fetch_array($ergebnis))
 		{
			if($tog)
			{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
			print'
				<td><font face=Verdana,Arial size=1>'.$i.'</td>
				<td><a href="products-bestellung.php?sid='.$sid.'&lang='.$lang.'&cat='.$cat.'&oid='.$content[order_id].'&userck='.$userck.'"  target="_parent" ><img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDEditList.'"></a></td>
				<td><font face=Verdana,Arial size=1>';
			$buf=explode(".",$content[order_date]);
			print $buf[2].'.'.$buf[1].'.'.$buf[0].'</td>
				 <td><font face=Verdana,Arial size=1>'.str_replace("24","00",$content[order_time]).'</td>
				<td ><font face=Verdana,Arial size=1>'.$content[encoder].'</td>
				<td align="center"><font face=Verdana,Arial size=1><img src="../img/warn.gif" width=16 height=16 border=0 alt="'.$LDNotSent.'">
			 	</td>
				</tr>';
			$i++;

 		}
		print '</table>';
	}
}
?>
<a name="bottom"></a>
</body>
</html>
