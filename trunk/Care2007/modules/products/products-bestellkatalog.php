<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

$lang_tables[]='departments.php';
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product;
$product_obj_sub = new Product();
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$pharma_nr = $dept_obj->getPharmaOfDept($dept_nr);
$thisfile=basename(__FILE__);

$db->debug=1;

if($cat=='pharma') {
 	$dbtable='care_pharma_orderlist';
	$title='Apotheke';
}else{
 	$dbtable='care_med_orderlist';
	$title='Medicallager';
}

if(($mode=='search')&&($keyword!='')&&($keyword!='%')){
 	if($keyword=="*%*") $keyword="%";
 	 include($root_path.'include/inc_products_search_mod.php');
}elseif(($mode=='save')&&($bestellnum!='')&&($artikelname!='')){
	//include($root_path.'include/inc_products_ordercatalog_save.php');
	$saveok=$product_obj->SaveCatalogItem($HTTP_GET_VARS,$cat);
}

if(($mode=='delete')&&($keyword!='')) {
	//include($root_path.'include/inc_products_ordercatalog_delete.php');
	$delete_ok=$product_obj->DeleteCatalogItem($keyword,$cat);
}

/* Load common icon images */	 
$img_leftarrow=createComIcon($root_path,'l-arrowgrnlrg.gif','0');	
$img_uparrow=createComIcon($root_path,'uparrowgrnlrg.gif','0');
$img_dwnarrow=createComIcon($root_path,'dwnarrowgrnlrg.gif','0');
$img_info=createComIcon($root_path,'info3.gif','0');
$img_delete=createComIcon($root_path,'delete2.gif','0');

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_REDIRECT_APPEND; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat; ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
}

function add2basket(b,i,id){
	if(eval("document.curcatform.p"+i+".value")=="0")
	{
		eval("document.curcatform.p"+i+".value=''");
		eval("document.curcatform.p"+i+".focus()");
		return;
	}
	var n;
	if(eval("document.curcatform.p"+i+".value")=="") n=1;
	 else n=eval("document.curcatform.p"+i+".value")
	window.parent.BESTELLKORB.location.href="products-bestellkorb.php<?php echo URL_REDIRECT_APPEND."&userck=$userck" ?>&dept_nr=<?php echo $dept_nr; ?>&order_nr=<?php echo $order_nr; ?>&mode=add&cat=<?php echo $cat; ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1="+n+"&idsub1="+id;
}

function add_update(b)
{
	window.parent.BESTELLKORB.location.href="products-bestellkorb.php<?php echo URL_REDIRECT_APPEND."&userck=$userck" ?>&dept_nr=<?php echo $dept_nr; ?>&order_nr=<?php echo $order_nr; ?>&mode=add&cat=<?php echo $cat; ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1=1";
}

function checkform(d)
{
	for (i=1;i<=d.maxcount.value;i++)
		if (eval("d.order"+i+".checked")) return true;
	return false;
}

function resize() {
	parent.document.getElementById("products").cols = "20%,60%";
}
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/products_validate_order_num.js"></script>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 onLoad="document.smed.keyword.focus()"
<?php echo "bgcolor=".$cfg['body_bgcolor'];  if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php //foreach($argv as $v) echo "$v<br>"; ?>
<table><tr><td>
<a href="javascript:resize()"><img <?php echo $img_leftarrow ?> alt="Zgjero"></a>
</td><td>
<a href="javascript:gethelp('products.php','catalog','','<?php echo $cat ?>')"><img <?php echo createComIcon($root_path,'frage.gif','0','right') ?> alt="<?php echo 
$LDOpenHelp ?>"></a>
</td></tr></table>
<form action="<?php echo $thisfile; ?>" method="get" name="smed">
<font face="Verdana, Arial" size=1 color=#800000><?php echo $LDSearchKey ?>:
<br>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang?>">
<input type="hidden" name="mode" value="search">
<input type="text" name="keyword" size=20 maxlength=40>
<input type="hidden" name="order_nr" value="<?php echo $order_nr?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr?>">
<input type="hidden" name="cat" value="<?php echo $cat?>">
<input type="hidden" name="userck" value="<?php echo $userck?>">
<input type="submit" value="<?php echo $LDSearchArticle ?>">
</font>
</form>

<?php 
if (isset($mode)&&($mode=='search')&&($keyword!='')) 
{
	if($linecount)
	{
	//set order catalog flag
	/**
	* The following routine displays the search results
	*/	
				echo "<p><font size=1>".str_replace("~nr~",$linecount,$LDFoundNrData)."<br>
						$LDClk2SeeInfo</font><br>";

					$ergebnis->MoveFirst();
					echo '<table border=0 cellpadding=3 cellspacing=1> 
					  		<tr class="wardlisttitlerow">';
					for ($i=0;$i<sizeof($LDGenindex);$i++)
					echo '
							<td><font color="#000080">'.$LDGenindex[$i].'</td>';
					echo '</tr>';	

					while($zeile=$ergebnis->FetchRow())
					{
						echo '<tr class="';
						if($toggle) { echo 'wardlistrow2">'; $toggle=0;} else {echo 'wardlistrow1">'; $toggle=1;};
						echo '
									<!--<td valign="top"><a href="'.$thisfile.URL_APPEND.'&order_nr='.$order_nr.'&dept_nr='.$dept_nr.'&mode=save&cat='.$cat.'&artikelname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&doza='.$zeile['doza'].'&packing='.$zeile['packing'].'&bestellnum='.$zeile['bestellnum'].'&minorder='.$zeile['minorder'].'&maxorder='.$zeile['maxorder'].'&proorder='.str_replace(" ","+",$zeile['proorder']).'&hit=0&userck='.$userck.'" onClick="add_update(\''.$zeile['bestellnum'].'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAway.'"></a></td>		-->
									<td valign="top"><a href="'.$thisfile.URL_APPEND.'&order_nr='.$order_nr.'&dept_nr='.$dept_nr.'&mode=save&cat='.$cat.'&artikelname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&doza='.$zeile['doza'].'&packing='.$zeile['packing'].'&bestellnum='.$zeile['bestellnum'].'&minorder='.$zeile['minorder'].'&maxorder='.$zeile['maxorder'].'&proorder='.str_replace(" ","+",$zeile['proorder']).'&hit=0&userck='.$userck.'"><img '.$img_dwnarrow.' alt="'.$LDPut2Catalog.'"></a></td>		
									<td valign="top"><a href="javascript:popinfo(\''.$zeile['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$zeile['artikelname'].' - '.$LDClk2See.'"></a></td>
									<td valign="top"><a href="javascript:popinfo(\''.$zeile['bestellnum'].'\')" ><font color="#800000">'.$zeile['artikelname'].' - '.$zeile['doza']. ' - ' .$zeile['packing'] . '</font></a></td>
									<td valign="top"><font size=1>'.$zeile['generic'].'</td>
									<td valign="top"><font size=1>';
						if(strlen($zeile['description'])>40) echo substr($zeile['description'],0,40)."...";
							else echo $zeile['description'];
						echo '
									</td>
									<td valign="top"><font size=1>'.$zeile['bestellnum'].'</td>';
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

# get the actual order catalog
//mizuko:for pharmacy & medical depot
//require($root_path.'include/inc_products_ordercatalog_getactual.php');
/*if($cat=='pharma'){
	$ergebnis=&$product_obj->ActualOrderCatalogPharma($dept_nr,$cat);
}else{*/
	$ergebnis=&$product_obj->ActualOrderCatalog($dept_nr,$cat);
/*}*/
$rows=$product_obj->LastRecordCount();
# show catalog

if($rows){
	echo'
			<form name="curcatform" onSubmit="return checkform(this)">';
$tog=1;
echo '
		<font color="#800000">'.$LDCatalog.' :: ';
		$buff=$dept_obj->LDvar($dept_nr);
		
		if(isset($$buff)&&!empty($$buff)) echo $$buff;
			else echo $dept_obj->FormalName($dept_nr);

		echo '</font>
		<table border=0 cellspacing=1 cellpadding=3 width="100%">
  		<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($LDCindex);$i++)
	echo '
		<td><font color="#000080">'.$LDCindex[$i].'</td>';

$i=1;
$mi=2;
$mx=10;


/*# The following routine displays the contents of the current catalog based upon the 
if($cat == 'pharma') {
	
			$tog=1;
			
			while($content=$ergebnis->FetchRow())
			{
				if($tog)
				{ echo '<tr class="wardlistrow1">'; $tog=0; }else{ echo '<tr class="wardlistrow2">'; $tog=1; }
				echo'
			    			<td><a href="javascript:add2basket(\''.$content['bestellnum'].'\',\''.$i.'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAway.'"></a></td>
			  				 <td><input type="checkbox" name="order'.$i.'" value="1">
							 		<input type="hidden" name="bestellnum'.$i.'" value="'.$content['bestellnum'].'"></td>		
							<td><font size=1>'.$content['artikelname'].'</td>
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
							<td ><font size=1><nobr>&nbsp;X '.$content['proorder'].'</nobr></td>
							<td><font size=1>'.$content['bestellnum'].'</td>
							<td><a href="javascript:popinfo(\''.$content['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$content['artikelname'].'"></a></td>
							<td><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&order_nr='.$order_nr.'&mode=delete&cat='.$cat.'&keyword='.$content['item_no'].'&userck='.$userck.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a></td>
							</tr>';
				$i++;
			}
				echo '
						</table>';
} else {*/
			$tog=1;
			
			while($content=$ergebnis->FetchRow())
			{
				if($tog)
				{ echo '<tr class="wardlistrow1">'; $tog=0; }else{ echo '<tr class="wardlistrow2">'; $tog=1; }
				echo'
									<td>&nbsp;</td><td>&nbsp;</td>
							 		<input type="hidden" name="bestellnum'.$i.'" value="'.$content['bestellnum'].'"></td>		
							<td><font size=1>'.$content['artikelname'].' - '.$content['doza']. ' - ' .$content['packing'] .'</td>';
			
				echo '
							</td>
							<td ><font size=1><nobr>&nbsp;X '.$content['proorder'].'</nobr></td>
							<td><font size=1>'.$content['bestellnum'].'</td>
							<td><a href="javascript:popinfo(\''.$content['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$content['artikelname'].'"></a></td>
							<td><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&order_nr='.$order_nr.'&mode=delete&cat='.$cat.'&keyword='.$content['item_no'].'&userck='.$userck.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a></td>
							</tr>';
			
			
					//mizuko:get how many of this product do i have in the care_med/pharma_producs_main_sub
					if($cat=='medlager'){
						$ergebnis_sub=&$product_obj_sub->ActualOrderCatalogProducts('medsub',$content['bestellnum']);
					}else{
						$ergebnis_sub=&$product_obj_sub->ActualOrderCatalogPharma('pharmasub',$content['bestellnum'],$pharma_nr['pharma_dept_nr']);
					}

					$rows_sub=$product_obj_sub->LastRecordCount();
					if($rows_sub) {
						while($content_sub=$ergebnis_sub->FetchRow()) {
							echo '
							 <td><a href="javascript:add2basket(\''.$content['bestellnum'].'\',\''.$i.'\',\''.$content_sub['id'].'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAway.'"></a></td>
			  				 <td><input type="checkbox" name="order'.$i.'" value="1">
							 <td><input type="text" onKeyUp="validate_value(this,1,'.$content_sub['pcs'].')" name="p'.$i.'" size=5 maxlength=5 ';
							$o="order".$i;
							$pc="p".$i;
							if(($$o) &&($$pc=='')) $$pc=$mi;			 
							if($$pc!='') echo ' value="'.$$pc.'">'; else
								{
								  echo 'value="';
								  if($content_sub['pcs']) echo $content_sub['pcs']; else echo '1';
								  echo '">';
								}  				 
							echo '<td>'.$content_sub['pcs'].'</td><td>'.$content_sub['skadenca'].'</td><tr>';
							//mizuko:had to put it here to correctly generate p+i on the input boxes
							$i++;
						}
					}
					//end mizuko
			}
				echo '
						</table>';
//}	
// $rows come from inc_products_ordercatalog_getactual.php
       

	echo '
			<p>
			<input type="hidden" name="maxcount" value="'.$rows.'">
			<input type="hidden" name="sid" value="'.$sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="hidden" name="order_nr" value="'.$order_nr.'">
			<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
			<input type="hidden" name="mode" value="multiadd">
			<input type="hidden" name="userck" value="'.$userck.'">';
	if($rows > 1) echo '<input type="submit" value="'.$LDPutNBasket.'">';
			echo '</form>';
}


if(isset($mode)&&($mode=="multiadd"))
{
 	echo '
			<script language="javascript">
			window.parent.BESTELLKORB.location.href="products-bestellkorb.php'.URL_REDIRECT_APPEND.'&dept_nr='.$dept_nr.'&order_nr='.$order_nr.'&mode=add&cat='.$cat.'&maxcount='.$maxcount.'&userck='.$userck;
	for($i=1;$i<=$maxcount;$i++) 	{
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
