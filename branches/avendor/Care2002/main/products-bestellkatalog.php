<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_products.php");
require("../req/config-color.php");

if(!$dept)
{
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
	 else $dept="plop";// default is dept to plop
}

$thisfile="products-bestellkatalog.php";

if($cat=="pharma") 
 {
 	$dbtable="pharma_orderlist";
	$title="Apotheke";
 }
 else
 {
 	$dbtable="med_orderlist";
	$title="Medicallager";
 }

if(($mode=="search")&&($keyword!="")&&($keyword!="%"))
 {
 	if($keyword=="*%*") $keyword="%";
 	 include("../req/products-search-mod.php");
 }
	else if(($mode=="save")&&($bestellnum!="")&&($artname!=""))
	{
		include("../req/products-ordercatalog-save.php");
	}

if(($mode=="delete")&&($keyword!="")) 
{
	include("../req/products-ordercatalog-delete.php");
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? 
require("../req/css-a-hilitebu.php");
?>
<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php?sid=<? print "$ck_sid&lang=$lang"; ?>&keyword="+b+"&mode=search&cat=<?=$cat ?>";
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
	window.parent.BESTELLKORB.location.href="products-bestellkorb.php?sid=<?="$ck_sid&lang=$lang&userck=$userck" ?>&order_id=<?=$order_id?>&mode=add&cat=<?=$cat ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1="+n;
}
function add_update(b)
{
	window.parent.BESTELLKORB.location.href="products-bestellkorb.php?sid=<?="$ck_sid&lang=$lang&userck=$userck" ?>&order_id=<?=$order_id?>&mode=add&cat=<?=$cat ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1=1";
}

function checkform(d)
{
	for (i=1;i<=d.maxcount.value;i++)
		if (eval("d.order"+i+".checked")) return true;

	return false;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>

</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 onLoad="document.smed.keyword.focus()"
<?print "bgcolor=".$cfg['body_bgcolor'];  if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<? //foreach($argv as $v) print "$v<br>"; ?>

<a href="javascript:gethelp('products.php','catalog','','<?=$cat ?>')"><img src="../img/frage.gif" border=0 width=15 height=15 align="right" alt="<?=$LDOpenHelp ?>"></a>
<form action="<? print $thisfile; ?>" method="get" name="smed">
<font face="Verdana, Arial" size=1 color=#800000><?=$LDSearchKey ?>:
<br>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang?>">
<input type="hidden" name="mode" value="search">
<input type="text" name="keyword" size=20 maxlength=40>
<input type="hidden" name="order_id" value="<?=$order_id?>">
<input type="hidden" name="cat" value="<?=$cat?>">
<input type="hidden" name="userck" value="<?=$userck?>">
<input type="submit" value="<?=$LDSearchArticle ?>">
</font>
</form>

<? 

if (($mode=="search")&&($keyword!="")) 
{
	if($linecount>0)
	{
	//set order catalog flag
	
				print "<p><font face=verdana,arial size=1>".str_replace("~nr~",$linecount,$LDFoundNrData)."<br>
						$LDClk2SeeInfo</font><br>";

					mysql_data_seek($ergebnis,0);
					print '<table border=0 cellpadding=3 cellspacing=1> 
					  		<tr bgcolor="#ffffee">';
					for ($i=0;$i<sizeof($LDGenindex);$i++)
					print '
							<td><font face=Verdana,Arial size=1 color="#000080">'.$LDGenindex[$i].'</td>';
					print '</tr>';	

					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "<tr bgcolor=";
						if($toggle) { print "#dfdfdf>"; $toggle=0;} else {print "#fefefe>"; $toggle=1;};
						print '
									<td valign="top"><a href="'.$thisfile.'?sid='.$ck_sid.'&order_id='.$order_id.'&mode=save&cat='.$cat.'&artname='.str_replace("&","%26",strtr($zeile[artikelname]," ","+")).'&bestellnum='.$zeile[bestellnum].'&proorder='.str_replace(" ","+",$zeile[proorder]).'&hit=0&userck='.$userck.'" onClick="add_update(\''.$zeile[bestellnum].'\')"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDPut2BasketAway.'"></a></td>		
									<td valign="top"><a href="'.$thisfile.'?sid='.$ck_sid.'&order_id='.$order_id.'&mode=save&cat='.$cat.'&artname='.str_replace("&","%26",strtr($zeile[artikelname]," ","+")).'&bestellnum='.$zeile[bestellnum].'&proorder='.str_replace(" ","+",$zeile[proorder]).'&hit=0&userck='.$userck.'"><img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDPut2Catalog.'"></a></td>		
									<td valign="top"><a href="#" onClick="popinfo(\''.$zeile[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$complete_info.$zeile[artikelname].' - '.$LDClk2See.'"></a></td>
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
			<p>$LDNoDataFound";

print '<p>';
}

// get the actual order catalog
require("../req/products-ordercatalog-getactual.php");
// show catalog

if($rows>0)
	print'
			<form name="curcatform" onSubmit="return checkform(this)">';
$tog=1;
print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$LDCatalog.' '.strtoupper($dept).':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDCindex);$i++)
	print '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$LDCindex[$i].'</td>';
	print '<td></td><td></td></tr>';	

$i=1;

// $content come from products-ordercatalog-getactual.php
while($content=mysql_fetch_array($ergebnis))
{
	if($tog)
	{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
	print'
    			<td><a href="#" onClick="add2basket(\''.$content[bestellnum].'\',\''.$i.'\')"><img src="../img/L-arrowGrnLrg.gif" border=0 width=16 height=16 alt="'.$LDPut2BasketAway.'"></a></td>
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
				<td><a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&order_id='.$order_id.'&mode=delete&cat='.$cat.'&keyword='.$content[bestellnum].'&userck='.$userck.'" ><img src="../img/delete2.gif" width=16 height=16 border=0 alt="'.$LDRemoveArticle.'"></a></td>
				</tr>';
	$i++;
}
	print '
			</table>';
			
// $rows come from products-ordercatalog-getactual.php
       
if($rows>0)
	print '
			<p>
			<input type="hidden" name="maxcount" value="'.$rows.'">
			<input type="hidden" name="sid" value="'.$ck_sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="hidden" name="order_id" value="'.$order_id.'">
			<input type="hidden" name="mode" value="multiadd">
			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="submit" value="'.$LDPutNBasket.'">
			</form>';

if($mode=="multiadd")
{
 	print '
			<script language="javascript">
			window.parent.BESTELLKORB.location.href="products-bestellkorb.php?sid='.$ck_sid.'&lang='.$lang.'&order_id='.$order_id.'&mode=add&cat='.$cat.'&maxcount='.$maxcount.'&userck='.$userck;
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
