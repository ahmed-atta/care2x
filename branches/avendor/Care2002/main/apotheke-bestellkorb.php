<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}
require("../req/config-color.php");

if($ck_language!="") $lang="../language/".$ck_language."-lang.php";
	else $lang="../language/english-lang.php"; // if no language cookie, set lang to english
require($lang);

//simulate plop dept
$dept="plop";
$thisfile="apotheke-bestellkorb.php";

//init db parameters
$dbname="maho";
$dbtable="pharma_orderlist_".$dept;
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
// define the content array
$rows=0;
$count=0;

if($mode!="")
{
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 
		//get current list
		if(mysql_select_db($dbname,$link)) 
		{
				$sql='SELECT * FROM '.$dbtable.' WHERE order_id="'.$dept.$order_id.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
				//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);
		
				}else print "$db_sqlquery_fail<br>";
		 	$content=mysql_fetch_array($ergebnis);
			$artikeln=explode(" ",$content[articles]);
			$ocount=sizeof($artikeln);
			//print $sql;
		if(($mode=="delete")&&($idx!=""))
		{
			if($ocount==1)
		 	{
				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' WHERE order_id="'.$dept.$order_id.'"';
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
							   		WHERE order_id="'.$content[order_id].'"';
			 if($ergebnis=mysql_query($sql,$link))
				{
				}else print "$db_sqlquery_fail<br>";
		  	}	
		}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++
		if($mode=="add")
		{

			$dbtable="pharma_products_main"; // set main pharma db table
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
					}else print "$db_sqlquery_fail<br>";
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
								"encoder"=>$ck_pharma_order_user,
								"validator"=>"",
								"order_time"=>str_replace("00","24",strftime("%H.%M")), // set 00.00 to 24.00 for easier sorting
								"ip_addr"=>$REMOTE_ADDR,
								"priority"=>"",
								"sent_stamp"=>"");
		}
		//}
	
		$saveok=false;
		//save actual data to  catalog
		$dbtable="pharma_orderlist_".$dept;

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
							   		WHERE order_id="'.$content[order_id].'"';

			else 
				$sql="INSERT INTO ".$dbtable." 
						(	order_id,
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
				else print "no good $sql";
			//print $sql;
		}// end of if ($mode=="add")
//++++++++++++++++++++++++++++++++++++++++
		} else print "$db_table_noselect<br>";
	  mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect<br>"; }
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Apotheke - Bestellkorb</title>
<? 
require("../req/css-a-hilitebu.php");
?>
<script language=javascript>
function popinfo(b)
{
	urlholder="apotheke-bestellkatalog-popinfo.php?sid=<? print $ck_sid; ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}
</script>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 
<? 
switch($mode)
{
	case "add":print ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete":print ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
}
print "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?// foreach($argv as $v) print "$v<br>"; ?>


<?
$bcatindex=array("","Artikelname","Stück","","Bestell-Nr.","","");
$dbtable="pharma_orderlist_".$dept;
$rows=0;
$wassent=false;
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
				$sql='SELECT * FROM '.$dbtable.' WHERE order_id="'.$dept.$order_id.'"';
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
				}else print "$db_sqlquery_fail<br>";
				
			
			//print $sql;
		} else print "$db_table_noselect<br>";
	  mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect<br>"; }
	
	
if($rows>0)
{
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

$tog=1;
//$content=mysql_fetch_array($ergebnis);
print '<form name=actlist>
		<font face="Verdana, Arial" size=2 color="#800000">'.$actual_orderlist.':</font>
		<font face="Arial" size=1> (am: ';
		$dt=explode(".",$content[order_date]);
		print "$dt[2].$dt[1].$dt[0]";
		print ' zeit: '.str_replace("24","00",$content[order_time]).')</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($bcatindex);$i++)
	print '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$bcatindex[$i].'</td>';
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
				<td><a href="'.$thisfile.'?sid='.$ck_sid.'&order_id='.$order_id.'&mode=delete&idx='.$i.'" ><img src="../img/delete2.gif" width=16 height=16 border=0 alt="'.$remove_fromlist.'"></a></td>
				</tr>';
	$i++;

 	}
	print '</table>
			</form>
			<form action="apotheke-orderlist-final.php" method="get">
			<input type="hidden" name="sid" value="'.$ck_sid.'">
   			<input type="hidden" name="order_id" value="'.$order_id.'">
			<input type="submit" value="Endgültige Bestellliste erstellen">   
   			</form>	';


}
else
if($wassent)
{
	print '
			<script language=javascript>
			window.parent.location.replace(\'apotheke-bestellung.php?sid='.$ck_sid.'&itwassent=1\')
			</script>';
}	
else
{
	if($itwassent)
	print '
		<font face=Verdana,Arial size=2>Die Liste wurde vor sehr kurzer Zeit von irgenjemand entweder an die Apotheke
		verschickt oder gelöscht! Bitte erstellen Sie eine neue Bestellliste. Vielen Dank.<p></font>';

	print '<img src="../img/catr.gif" width=88 height=80 border=0 align=middle><font face=Verdana,Arial size=2>
			Der Bestellkorb ist momentan leer. <p>';

// get all lists that are not sent

$dbtable="pharma_orderlist_".$dept;
$rows=0;
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
				$sql='SELECT * FROM '.$dbtable.' WHERE sent_stamp ="0" AND validator="" ORDER BY order_date, order_time DESC';
        		if($ergebnis=mysql_query($sql,$link))
				{
					//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);
				}else print "$db_sqlquery_fail<br>$sql";
				
			
			//print $sql;
		} else print "$db_table_noselect<br>";
	  mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect<br>"; }
		
//++++++++++ show the last lists+++++++++++++++++++++++++++++++++++++++++

	if($rows>0)
	{	
	
	print '<p>Folgende ';
			if ($rows>1) print ' sind die letzte nicht verschickte Bestellungslisten.';
			 else print ' ist die letzte nicht verschickte Bestellungsliste.'; 
			print ' Falls Sie sie sehen bzw.
			weiter bearbeiten möchten, klicken Sie den Pfeil an.<br></font><p>';

		$bcatindex=array("","","Erstellt am:","Zeit","Erstellt von:","");
		$tog=1;
		print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$last_orderlist.strtoupper($dept).':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
		for ($i=0;$i<sizeof($bcatindex);$i++)
		print '
			<td><font face=Verdana,Arial size=1 color="#000080">'.$bcatindex[$i].'</td>';
		print '</tr>';	

		$i=1;

		while($content=mysql_fetch_array($ergebnis))
 		{
			if($tog)
			{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
			print'
				<td><font face=Verdana,Arial size=1>'.$i.'</td>
				<td><a href="apotheke-bestellung.php?sid='.$ck_sid.'&oid='.$content[order_id].'"  target="_parent" ><img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$edit_orderlist.'"></a></td>
				<td><font face=Verdana,Arial size=1>';
			$buf=explode(".",$content[order_date]);
			print $buf[2].'.'.$buf[1].'.'.$buf[0].'</td>
				 <td><font face=Verdana,Arial size=1>'.str_replace("24","00",$content[order_time]).'</td>
				<td ><font face=Verdana,Arial size=1>'.$content[encoder].'</td>
				<td align="center"><font face=Verdana,Arial size=1><img src="../img/warn.gif" width=16 height=16 border=0 alt="Noch nicht gesendet!">
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
