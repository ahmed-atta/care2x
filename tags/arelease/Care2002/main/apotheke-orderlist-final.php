<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}
require("../req/config-color.php");

if($ck_language!="") $lang="../language/".$ck_language."-lang.php";
	else $lang="../language/english-lang.php"; // if no language cookie, set lang to english
require($lang);

//simulate plop dept
$dept="plop";
$sendok=false;
$ofinal=false;

//init db parameters
$dbname="maho";
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
// define the content array
$rows=0;
$count=0;

if(($mode=="send")&&($order_id))
{
	$link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
			
		$dbtable="pharma_orderlist_".$dept; // set dbtable to dept's order list
        // the column sent_stamp is not included in the sql to cause its auto update	
		$sql='UPDATE '.$dbtable.' SET 										
							 		validator="'.$validator.'@'.crypt($vpw).'",
									priority="'.$prior.'"
							   		WHERE order_id="'.$dept.$order_id.'"';		// save aux data to the order list
		
		 if($ergebnis=mysql_query($sql,$link))
			{
				//print $sql;
					$ofinal=true;
					
				$dbtable="pharma_orderlist_todo"; // select pharma table		
				// the column t_stamp is not included in the sql to cause its auto update	
				$sql="INSERT INTO ".$dbtable." 
						(	rec_date,
							rec_time,
							order_id,
							dept,
							clerk,
							done_date,
							status,
							priority ) 
						VALUES (
							'".strftime("%Y.%m.%d")."',
							'".str_replace("00","24",strftime("%H.%M"))."',
							'$dept$order_id',
							'$dept',
							'',
							'',
							'o_todo',
							'$prior' )";
        		if($ergebnis=mysql_query($sql,$link))
				{
				//print $sql;
					$sendok=true;			
				}
			}	
			//print $sql;
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
<title>Apotheke - Bestellliste</title>
<? 
require("../req/css-a-hilitebu.php");
?>
<script language=javascript>
function popinfo(b)
{
	urlholder="apotheke-bestellkatalog-popinfo.php?sid=<? print $ck_sid; ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}
function checkform(d)
{
	if (d.validator.value=="") 
	{
		alert("Der Bestätiger fehlt! Ohne ihn kann die Bestellliste nicht gesendet werden.");
		return false;
	}
	if (d.vpw.value=="") 
	{
		alert("Passwort des Bestätigers fehlt! Ohne es kann die Bestellliste nicht gesendet werden.");
		return false;
	}
 	return true;
}
<? if (($mode=="send")&&($sendok))
{
$idbuf=uniqid("");
print "
		function hide_bcat()
		{
			window.parent.BESTELLKATALOG.location.replace('apotheke-bestellkatalog.php?sid=$ck_sid&order_id=$idbuf')
		}";
}
?>

</script>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 
<? 			
switch($mode)
{
	case "add":print ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete":print ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
	case "send": if($sendok) print ' onLoad="hide_bcat()" ';
}
print "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?// foreach($argv as $v) print "$v<br>"; ?>


<?
if($sendok)
	print '
			<font face="Verdana, Arial" size=2 color="#800000">
			Folgende Bestellliste wurde an die Apotheke erfolgreich gesendet. Vielen Dank!<p></font>';

$dbtable="pharma_orderlist_".$dept;
$rows=0;
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
					if ($rows)	mysql_data_seek($ergebnis,0);
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
$bcatindex=array("&nbsp;","Artikelname","Stück","&nbsp;","Bestell-Nr.");

$tog=1;
$content=mysql_fetch_array($ergebnis);
print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$final_orderlist.':</font><br>
		<font face="Arial" size=1> (erstellt am: ';
		$dt=explode(".",$content[order_date]);
		print "$dt[2].$dt[1].$dt[0]";
		print ' zeit: '.str_replace("24","00",$content[order_time]).')</font>
		<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
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
	{ print '<tr bgcolor="#ffffff">'; $tog=0; }else{ print '<tr bgcolor="#ffffff">'; $tog=1; }
	print'
				<td>';
	if($mode=="delete") print '<a name="'.$i.'"></a>';
	print'	
				<font face=Arial size=1 color="#000080">'.$i.'</td>
				<td><font face=Verdana,Arial size=1>'.$r[artikelname].'</td>
				 <td><font face=Verdana,Arial size=1>'.$r[pcs].'</td>
					<td ><font face=Verdana,Arial size=1><nobr>X '.$r[proorder].'</nobr></td>
			<td><font face=Verdana,Arial size=1>'.$r[bestellnum].'</td>
				</tr>';
	$i++;

 	}
	print '</table></td></tr></table><font face=Verdana,Arial size=2 color="#800000">';
	
	if(!($mode=="send")&&(!$sendok))
	print '
			<form action="apotheke-orderlist-final.php" method="get" onSubmit="return checkform(this)">Erstellt von:<br>
			<input type="text" name="sender" size=20 maxlength=40 value="'.$ck_pharma_order_user.'"> 
			 &nbsp;normal<input type="radio" name="prior" value="normal" checked> 
			eilig<input type="radio" name="prior" value="eilig" > <br>
   			<p>
			Bestätigt von:<br>
			<input type="text" name="validator" size=20 maxlength=40 value="'.$validator.'"><br><font size=1>Passwort:</font><input type="password" name="vpw" size=10 maxlength=20>
       			<input type="hidden" name="sid" value="'.$ck_sid.'">
   			<input type="hidden" name="order_id" value="'.$order_id.'">
			<input type="hidden" name="mode" value="send">
   			<p>
			<input type="submit" value="Bestellliste an die Apotheke senden">   
   			</form></font>
			<font face=Verdana,Arial size=2>
			<a href="apotheke-bestellkorb.php?sid='.$ck_sid.'&order_id='.$order_id.'" ><< Zurück und noch mal bearbeiten.</a></font>
			';
		else 
		print '
				<p><font face=Verdana,Arial size=1 color="#000080"><a href="apotheke.php?sid='.$ck_sid.'" target="_parent">
				<img src="../img/arrow-blu.gif" width=12 height=12 border=0> Bestellung beenden & verlassen.</a>
				<p>
				<a href="apotheke-bestellung.php?sid='.$ck_sid.'" target="_parent"><img src="../img/arrow-blu.gif" width=12 height=12 border=0> Eine neue Bestellliste erstellen bzw. einen leeren Bestellkorb erzeugen.</a>
				</font>';

}
// get all lists
$mode="";
$sendok=false;
?>
<a name="bottom"></a>
</body>
</html>
