<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}
require("../req/config-color.php");

if($ck_language!="") $lang="../language/".$ck_language."-lang.php";
	else $lang="../language/english-lang.php"; // if no language cookie, set lang to english
require($lang);


$thisfile="apotheke-bestellkorb.php";

//init db parameters
$dbname="maho";
$dbtable="pharma_orderlist_".$dept; // the value of dept comes from the calling page
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
// define the content array
$rows=0;
$count=0;

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
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 onLoad="if(window.focus) window.focus()" 
<? 
print "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<? foreach($argv as $v) print "$v<br>"; ?>


<?
$bcatindex=array("","Artikelname","Stück","","Bestell-Nr.","","");
$rows=0;
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
				$sql='SELECT * FROM '.$dbtable.' WHERE order_id="'.$order_id.'" AND sent_stamp="'.$sent_stamp.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
					//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);					
				}else print "$db_sqlquery_fail $sql<br>";
				
			
			//print $sql;
		} else print "$db_table_noselect<br>";
	  mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect $sql<br>"; }
	
	
if($rows>0)
{
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

$tog=1;
$content=mysql_fetch_array($ergebnis);
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
				 <td><font face=Verdana,Arial size=1>'.$r[pcs].'</td>
				<td ><font face=Verdana,Arial size=1><nobr>X '.$r[proorder].'</nobr></td>
				<td><font face=Verdana,Arial size=1>'.$r[bestellnum].'</td>
				<td><a href="#" onClick="popinfo(\''.$r[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$complete_info.$r[artikelname].'"></a></td>
				</tr>';
	$i++;

 	}
	print '</table>
			</form>
			';


}

?>
<a name="bottom"></a>
</body>
</html>
