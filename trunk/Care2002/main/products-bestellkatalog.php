<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

if(!isset($dept)||!$dept)
{
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&!empty($HTTP_COOKIE_VARS['ck_thispc_dept'])) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	 else $dept='plop';//default is plop dept
}

$thisfile='products-bestellkatalog.php';

if($cat=='pharma') 
 {
 	$dbtable='care_pharma_orderlist';
	$title='Apotheke';
 }
 else
 {
 	$dbtable='care_med_orderlist';
	$title='Medicallager';
 }

if(($mode=='search')&&($keyword!='')&&($keyword!='%'))
 {
 	if($keyword=="*%*") $keyword="%";
 	 include('../include/inc_products_search_mod.php');
 }
	else if(($mode=='save')&&($bestellnum!='')&&($artname!=''))
	{
		include('../include/inc_products_ordercatalog_save.php');
	}

if(($mode=='delete')&&($keyword!='')) 
{
	include('../include/inc_products_ordercatalog_delete.php');
}

/* Load common icon images */	 
$img_leftarrow=createComIcon('../','l-arrowgrnlrg.gif','0');	
$img_uparrow=createComIcon('../','uparrowgrnlrg.gif','0');
$img_dwnarrow=createComIcon('../','dwnarrowgrnlrg.gif','0');
$img_info=createComIcon('../','info3.gif','0');
$img_delete=createComIcon('../','delete2.gif','0');

?>
<html>
<head>
<?php echo setCharSet(); ?>
<?php 
require('../include/inc_css_a_hilitebu.php');
?>
<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php?sid=<?php echo "$sid&lang=$lang"; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat; ?>";
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
	window.parent.BESTELLKORB.location.href="products-bestellkorb.php?sid=<?php echo "$sid&lang=$lang&userck=$userck" ?>&order_nr=<?php echo $order_nr; ?>&mode=add&cat=<?php echo $cat; ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1="+n;
}
function add_update(b)
{
	window.parent.BESTELLKORB.location.href="products-bestellkorb.php?sid=<?php echo "$sid&lang=$lang&userck=$userck" ?>&order_nr=<?php echo $order_nr; ?>&mode=add&cat=<?php echo $cat; ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1=1";
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
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>

<script language="javascript" src="../js/products_validate_order_num.js"></script>

</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 onLoad="document.smed.keyword.focus()"
<?php echo "bgcolor=".$cfg['body_bgcolor'];  if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php //foreach($argv as $v) echo "$v<br>"; ?>

<a href="javascript:gethelp('products.php','catalog','','<?php echo $cat ?>')"><img <?php echo createComIcon('../','frage.gif','0','right') ?> alt="<?php echo $LDOpenHelp ?>"></a>
<form action="<?php echo $thisfile; ?>" method="get" name="smed">
<font face="Verdana, Arial" size=1 color=#800000><?php echo $LDSearchKey ?>:
<br>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang?>">
<input type="hidden" name="mode" value="search">
<input type="text" name="keyword" size=20 maxlength=40>
<input type="hidden" name="order_nr" value="<?php echo $order_nr?>">
<input type="hidden" name="cat" value="<?php echo $cat?>">
<input type="hidden" name="userck" value="<?php echo $userck?>">
<input type="submit" value="<?php echo $LDSearchArticle ?>">
</font>
</form>

<?php 
if (isset($mode)&&($mode=='search')&&($keyword!='')) 
{
	if($linecount>0)
	{
	//set order catalog flag
	/**
	* The following routine displays the search results
	*/	
				echo "<p><font face=verdana,arial size=1>".str_replace("~nr~",$linecount,$LDFoundNrData)."<br>
						$LDClk2SeeInfo</font><br>";

					mysql_data_seek($ergebnis,0);
					echo '<table border=0 cellpadding=3 cellspacing=1> 
					  		<tr bgcolor="#ffffee">';
					for ($i=0;$i<sizeof($LDGenindex);$i++)
					echo '
							<td><font face=Verdana,Arial size=1 color="#000080">'.$LDGenindex[$i].'</td>';
					echo '</tr>';	

					while($zeile=mysql_fetch_array($ergebnis))
					{
						echo "<tr bgcolor=";
						if($toggle) { echo "#dfdfdf>"; $toggle=0;} else {echo "#fefefe>"; $toggle=1;};
						echo '
									<td valign="top"><a href="'.$thisfile.'?sid='.$sid.'&lang='.$lang.'&order_nr='.$order_nr.'&mode=save&cat='.$cat.'&artname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&bestellnum='.$zeile['bestellnum'].'&minorder='.$zeile['minorder'].'&maxorder='.$zeile['maxorder'].'&proorder='.str_replace(" ","+",$zeile['proorder']).'&hit=0&userck='.$userck.'" onClick="add_update(\''.$zeile[bestellnum].'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAway.'"></a></td>		
									<td valign="top"><a href="'.$thisfile.'?sid='.$sid.'&lang='.$lang.'&order_nr='.$order_nr.'&mode=save&cat='.$cat.'&artname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&bestellnum='.$zeile['bestellnum'].'&minorder='.$zeile['minorder'].'&maxorder='.$zeile['maxorder'].'&proorder='.str_replace(" ","+",$zeile[proorder]).'&hit=0&userck='.$userck.'"><img '.$img_dwnarrow.' alt="'.$LDPut2Catalog.'"></a></td>		
									<td valign="top"><a href="#" onClick="popinfo(\''.$zeile[bestellnum].'\')" ><img '.$img_info.' alt="'.$complete_info.$zeile['artikelname'].' - '.$LDClk2See.'"></a></td>
									<td valign="top"><a href="#" onClick="popinfo(\''.$zeile[bestellnum].'\')" ><font face=verdana,arial size=1 color="#800000">'.$zeile[artikelname].'</font></a></td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[generic].'</td>
									<td valign="top"><font face=verdana,arial size=1>';
						if(strlen($zeile[description])>40) echo substr($zeile[description],0,40)."...";
							else echo $zeile[description];
						echo '
									</td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[bestellnum].'</td>';
						echo    '
									</tr>';
					}
					echo "</table>";
	}
	else
		echo "
			<p>$LDNoDataFound";
echo '<p>';
}

// get the actual order catalog
require('../include/inc_products_ordercatalog_getactual.php');
// show catalog

if($rows>0)
	echo'
			<form name="curcatform" onSubmit="return checkform(this)">';
$tog=1;
echo '
		<font face="Verdana, Arial" size=2 color="#800000">'.$LDCatalog.' '.strtoupper($dept).':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDCindex);$i++)
	echo '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$LDCindex[$i].'</td>';
	echo '<td></td><td></td></tr>';	

$i=1;
$mi=2;
$mx=10;
// $content come from inc_products_ordercatalog_getactual.php
/**
* The following routine displays the contents of the current catalog
*/
while($content=mysql_fetch_array($ergebnis))
{
	if($tog)
	{ echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1; }
	echo'
    			<td><a href="#" onClick="add2basket(\''.$content[bestellnum].'\',\''.$i.'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAway.'"></a></td>
  				 <td><input type="checkbox" name="order'.$i.'" value="1">
				 		<input type="hidden" name="bestellnum'.$i.'" value="'.$content[bestellnum].'"></td>		
				<td><font face=Verdana,Arial size=1>'.$content[artikelname].'</td>
				 <td><input type="text" onBlur="validate_min(this,'.$content['minorder'].')"  onKeyUp="validate_value(this,'.$content['minorder'].','.$content['maxorder'].')" name="p'.$i.'" size=3 maxlength=3 ';
	$o="order".$i;
	$pc="p".$i;
	if(($$o) &&($$pc=='')) $$pc=$mi;			 
	if($$pc!='') echo ' value="'.$$pc.'">'; else
	{
	  echo 'value="';
	  if($content['minorder']) echo $content['minorder']; else echo '1';
	  echo '">';
	}
	echo '
				</td>
				<td ><font face=Verdana,Arial size=1><nobr>&nbsp;X '.$content[proorder].'</nobr></td>
				<td><font face=Verdana,Arial size=1>'.$content[bestellnum].'</td>
				<td><a href="javascript:popinfo(\''.$content[bestellnum].'\')" ><img '.$img_info.' alt="'.$complete_info.$content[artikelname].'"></a></td>
				<td><a href="'.$thisfile.'?sid='.$sid.'&lang='.$lang.'&order_nr='.$order_nr.'&mode=delete&cat='.$cat.'&keyword='.$content['item_no'].'&userck='.$userck.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a></td>
				</tr>';
	$i++;
}
	echo '
			</table>';
			
// $rows come from inc_products_ordercatalog_getactual.php
       
if(isset($rows)&&($rows>0))
	echo '
			<p>
			<input type="hidden" name="maxcount" value="'.$rows.'">
			<input type="hidden" name="sid" value="'.$sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="hidden" name="order_nr" value="'.$order_nr.'">
			<input type="hidden" name="mode" value="multiadd">
			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="submit" value="'.$LDPutNBasket.'">
			</form>';

if(isset($mode)&&($mode=="multiadd"))
{
 	echo '
			<script language="javascript">
			window.parent.BESTELLKORB.location.href="products-bestellkorb.php?sid='.$sid.'&lang='.$lang.'&order_nr='.$order_nr.'&mode=add&cat='.$cat.'&maxcount='.$maxcount.'&userck='.$userck;
	for($i=1;$i<=$maxcount;$i++)
	{
		$o="order".$i;
		$pc="p".$i;
		if((!$$o)||($$pc=="0")) continue;
		$b="bestellnum".$i;
		if($$pc=="") $$pc=1;
		echo '&order'.$i.'='.$$o.'&bestellnum'.$i.'='.$$b.'&p'.$i.'='.$$pc;
	}
	echo'"
			</script>';
}		
?>
</body>
</html>
