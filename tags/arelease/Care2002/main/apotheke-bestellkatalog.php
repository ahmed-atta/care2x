<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}
require("../req/config-color.php");

if($ck_language!="") $lang="../language/".$ck_language."-lang.php";
	else $lang="../language/english-lang.php"; // if no language cookie, set lang to english

require($lang);

// simulate dept to plop
$dept="plop";

$thisfile="apotheke-bestellkatalog.php";

if(($mode=="search")&&($keyword!="")&&($keyword!="%"))
 {
 	if($keyword=="*%*") $keyword="%";
 	 include("../req/pharma-search-mod.php");
 }
	else if(($mode=="save")&&($bestellnum!="")&&($artname!=""))
	{
		include("../req/pharma-ordercatalog-save.php");
	}

if(($mode=="delete")&&($keyword!="")) 
{
	include("../req/pharma-ordercatalog-delete.php");
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

function add2basket(b,i)
{
	if(eval("document.curcatform.p"+i+".value")=="0")
	{
		eval("document.curcatform.p"+i+".value=''");
		eval("document.curcatform.p"+i+".focus()");
		return;
	}
	var n;
	if(eval("document.curcatform.p"+i+".value")=="") n=1;
	 else n=eval("document.curcatform.p"+i+".value")
	window.parent.BESTELLKORB.location.href="apotheke-bestellkorb.php?sid=<?=$ck_sid?>&order_id=<?=$order_id?>&mode=add&maxcount=1&order1=1&bestellnum1="+b+"&p1="+n;
}
function add_update(b)
{
	window.parent.BESTELLKORB.location.href="apotheke-bestellkorb.php?sid=<?=$ck_sid?>&order_id=<?=$order_id?>&mode=add&maxcount=1&order1=1&bestellnum1="+b+"&p1=1";
}

function checkform(d)
{
	for (i=1;i<=d.maxcount.value;i++)
		if (eval("d.order"+i+".checked")) return true;

	return false;
}
</script>

</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 onLoad="document.smed.keyword.focus()"
<?print "bgcolor=".$cfg['body_bgcolor'];  if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<? //foreach($argv as $v) print "$v<br>"; ?>

<form action="<? print $thisfile; ?>" method="get" name="smed">
<font face="Verdana, Arial" size=1 color=#800000>Suchbegriff für den Artikel:
<br>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="mode" value="search">
<input type="text" name="keyword" size=20 maxlength=40>
<input type="hidden" name="order_id" value="<?=$order_id?>">
<input type="submit" value="Artikel suchen">
</font>
</form>

<? 

if (($mode=="search")&&($keyword!="")) 
{
	if($linecount>0)
	{
		$scatindex=array("","","","Artikelname","Generic","Beschreibung","Bestell-Nr..");
	//set order catalog flag
	
				print "<p><font face=verdana,arial size=1>Die Suche hat <font color=red><b>".$linecount."</b></font> Daten gefunden, die dem Suchbegriff entsprechen.<br>
						Bitte klicken Sie das richtige an, um die komplette Information zu zeigen.</font><br>";

					mysql_data_seek($ergebnis,0);
					print '<table border=0 cellpadding=3 cellspacing=1> 
					  		<tr bgcolor="#ffffee">';
					for ($i=0;$i<sizeof($scatindex);$i++)
					print '
							<td><font face=Verdana,Arial size=1 color="#000080">'.$scatindex[$i].'</td>';
					print '</tr>';	

					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "<tr bgcolor=";
						if($toggle) { print "#dfdfdf>"; $toggle=0;} else {print "#fefefe>"; $toggle=1;};
						print '
									<td valign="top"><a href="'.$thisfile.'?sid='.$ck_sid.'&order_id='.$order_id.'&mode=save&artname='.str_replace("&","%26",strtr($zeile[artikelname]," ","+")).'&bestellnum='.$zeile[bestellnum].'&proorder='.str_replace(" ","+",$zeile[proorder]).'&hit=0" onClick="add_update(\''.$zeile[bestellnum].'\')"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0 alt="Dieses Artikel sofort in Bestellkorb stellen"></a></td>		
									<td valign="top"><a href="'.$thisfile.'?sid='.$ck_sid.'&order_id='.$order_id.'&mode=save&artname='.str_replace("&","%26",strtr($zeile[artikelname]," ","+")).'&bestellnum='.$zeile[bestellnum].'&proorder='.str_replace(" ","+",$zeile[proorder]).'&hit=0"><img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 alt="Dieses Artikel in Bestellkatalog stellen"></a></td>		
									<td valign="top"><a href="#" onClick="popinfo(\''.$zeile[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$complete_info.$zeile[artikelname].'"></a></td>
									<td valign="top"><a href="#" onClick="popinfo(\''.$zeile[bestellnum].'\')" ><font face=verdana,arial size=1 color="#800000">'.$zeile[artikelname].'</font></a></td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[generic].'</td>
									<td valign="top"><font face=verdana,arial size=1>';
						if(strlen($zeile[description])>40) print substr($zeile[description],0,40)."...";
							else print $zeile[description];
						print '
									</td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[bestellnum].'</td>';
						print    '
									</tr>';
					}
					print "</table>";

	}
	else
		print "
			<p>Die Suche hat <font color=red><b>keine</b></font> Daten gefunden, die dem Suchbegriff entsprechen.";

print '<p>';
}

// get the actual order catalog
require("../req/pharma-ordercatalog-getactual.php");
// show catalog

if($rows>0)
	print'
			<form name="curcatform" onSubmit="return checkform(this)">';


$bcatindex=array("","","Artikelname","Stück","","Bestell-Nr.");
$tog=1;
print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$actual_ordercat.':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($bcatindex);$i++)
	print '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$bcatindex[$i].'</td>';
	print '<td></td><td></td></tr>';	

$i=1;

// $content come from pharma-ordercatalog-getactual.php
while($content=mysql_fetch_array($ergebnis))
{
	if($tog)
	{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
	print'
    			<td><a href="#" onClick="add2basket(\''.$content[bestellnum].'\',\''.$i.'\')"><img src="../img/L-arrowGrnLrg.gif" border=0 width=16 height=16 alt="Sofort in den Bestellkorb stellen"></a></td>
  				 <td><input type="checkbox" name="order'.$i.'" value="1" >
				 		<input type="hidden" name="bestellnum'.$i.'" value="'.$content[bestellnum].'"></td>		
				<td><font face=Verdana,Arial size=1>'.$content[artikelname].'</td>
				 <td><input type="text" name="p'.$i.'" size=3 maxlength=3 ';
	$o="order".$i;
	$pc="p".$i;
	if(($$o) &&($$pc=="")) $$pc=1;			 
	if($$pc!="")
		print ' value="'.$$pc.'">';
		 	else print ' >';
	print '
				</td>
				<td ><font face=Verdana,Arial size=1><nobr>&nbsp;X '.$content[proorder].'</nobr></td>
				<td><font face=Verdana,Arial size=1>'.$content[bestellnum].'</td>
				<td><a href="#" onClick="popinfo(\''.$content[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$complete_info.$content[artikelname].'"></a></td>
				<td><a href="'.$thisfile.'?sid='.$ck_sid.'&order_id='.$order_id.'&mode=delete&keyword='.$content[bestellnum].'" ><img src="../img/delete2.gif" width=16 height=16 border=0 alt="'.$remove_art.'"></a></td>
				</tr>';
	$i++;
}
	print '
			</table>';
			
// $rows come from pharma-ordercatalog-getactual.php
       
if($rows>0)
	print '
			<p>
			<input type="hidden" name="maxcount" value="'.$rows.'">
			<input type="hidden" name="sid" value="'.$ck_sid.'">
			<input type="hidden" name="order_id" value="'.$order_id.'">
			<input type="hidden" name="mode" value="multiadd">
			<input type="submit" value="In Bestellkorb stellen">
			</form>';

if($mode=="multiadd")
{
 	print '
			<script language="javascript">
			window.parent.BESTELLKORB.location.href="apotheke-bestellkorb.php?sid='.$ck_sid.'&order_id='.$order_id.'&mode=add&maxcount='.$maxcount;
	for($i=1;$i<=$maxcount;$i++)
	{
		$o="order".$i;
		$pc="p".$i;
		if((!$$o)||($$pc=="0")) continue;
		$b="bestellnum".$i;
		if($$pc=="") $$pc=1;
		print '&order'.$i.'='.$$o.'&bestellnum'.$i.'='.$$b.'&p'.$i.'='.$$pc;
	}
	print'"
			</script>';
}		
?>
</body>
</html>
