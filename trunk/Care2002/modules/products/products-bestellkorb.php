<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

if(!isset($dept)||!$dept)
{
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&!empty($HTTP_COOKIE_VARS['ck_thispc_dept'])) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	 else $dept='plop';//default is plop dept
}

$thisfile='products-bestellkorb.php';

if($cat=='pharma') 
 {
 	$dbtable='care_pharma_orderlist';
	$title=$LDPharmacy;
 }
 else
 {
 	$dbtable='care_med_orderlist';
	$title=$LDMedDepot;
 }
 
$encbuf=$HTTP_COOKIE_VARS[$local_user.$sid];

// define the content array
$rows=0;
$count=0;

/* Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');



if($mode!='')
{
	if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
		if($dblink_ok)
		{		$sql='SELECT * FROM '.$dbtable.' 
							WHERE order_nr="'.$order_nr.'"
							AND dept="'.$dept.'"';
							
        	if($ergebnis=$db->Execute($sql))
			{
				$rows=$ergebnis->RecordCount();
			}
			else { echo "$LDDbNoRead<br>"; } 
			
		 	$content=$ergebnis->FetchRow();
			$artikeln=explode(' ',$content['articles']);
			$ocount=sizeof($artikeln);
			//echo $sql;
			
		if(($mode=='delete')&&($idx!=''))
		{
			if($ocount==1)
		 	{
				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' WHERE order_nr="'.$order_nr.'" AND dept="'.$dept.'"';
							
        		$ergebnis=$db->Execute($sql);
		 	}
		 	else
		 	{
			
			    $trash=array_splice($artikeln,$idx-1,1);
			    $content['articles']=implode(' ',$artikeln);
			
			    $sql='UPDATE '.$dbtable.' SET 
							 		order_date="'.$content['order_date'].'",
							  		articles="'.$content['articles'].'",
									extra1="'.$content['extra1'].'",
									extra2="'.$content['extra2'].'",
									validator="'.$content['validator'].'",
									order_time="'.$content['order_time'].'",
									sent_datetime="'.$content['sent_datetime'].'",
									ip_addr="'.$content['ip_addr'].'",
									priority="'.$content['priority'].'",
									modify_id="'.$HTTP_COOKIE_VARS[$local_user.$sid].'"
							   		WHERE order_nr="'.$content['order_nr'].'"
									AND dept="'.$dept.'"';
									
			     if(!$ergebnis=$db->Execute($sql)) { echo "$sql<br>$LDDbNoSave<br>"; } 
		  	}	
		}

//*** Mode add ******

		if($mode=='add')
		{

			// set main pharma db table
			
			if($cat=='pharma') $dbtable='care_pharma_products_main'; 
				else $dbtable='care_med_products_main'; 
				
			for($i=1;$i<=$maxcount;$i++)
			{
					$o='order'.$i; 
					if(!$$o) continue;
					$b='bestellnum'.$i; 
					// get the needed info from the main pharma db
					$sql='SELECT artikelname, minorder, maxorder, proorder FROM '.$dbtable.' WHERE bestellnum="'.$$b.'"';
        			if($ergeb=$db->Execute($sql))
					{
						$result=$ergeb->FetchRow();
							$a='artname'.$i;
							$$a=str_replace('&','%26',strtr($result['artikelname'],' ','+')); 
							$mi='minorder'.$i;
							$$mi=$result['minorder'];
							$mx='maxorder'.$i;
							$$mx=$result['maxorder'];
							$po='porder'.$i;
							$$po=$result['proorder'];
					}else { echo "$sql<br>$LDDbNoRead<br>"; } 
			}
			
		    if($rows) $tart=$content['articles']; else $tart="";
		    
			for ($i=1;$i<=$maxcount;$i++)
			{
				$o='order'.$i; 
				if(!$$o) continue;
				$b='bestellnum'.$i; 
				$a='artname'.$i;
				$po='porder'.$i;
				$pc='p'.$i;
				$tart.=' bestellnum='.$$b.'&artikelname='.$$a.'&pcs='.$$pc.'&minorder='.$$mi.'&maxorder='.$$mx.'&proorder='.$$po; // append new bestellnum to articles
				$tart=trim($tart);
				//echo $tart;
			}
			
		    $saveok=false;
		
		    //save actual data to  catalog
		    if($cat=='pharma') $dbtable='care_pharma_orderlist';
			    else $dbtable='care_med_orderlist';

			if($rows)
			{

			    $sql='UPDATE '.$dbtable.' SET articles="'.$tart.'", 	
				                                            modify_id="'.$encbuf.'"
							   		                        WHERE order_nr="'.$content['order_nr'].'" AND dept="'.$dept.'"';            
			}
			else 
			{
				$sql="INSERT INTO ".$dbtable." 
						(	
							dept,
							order_date,
							articles,
							order_time,
							ip_addr,
							status,
							modify_id,
							create_id,
							create_time
							) 
						VALUES (
							'$dept',
							'".date('Y-m-d')."',
							'".$tart."',
							'".date('H:i:s')."',
							'".$REMOTE_ADDR."',
							'draft',
							'".$encbuf."',
							'".$encbuf."',
							NULL
							)";
			}
        		if($ergebnis=$db->Execute($sql))
				{
				    // echo $sql;
					if(!$rows) $order_nr=mysql_insert_id($link); // if the last action was insert get the last id
				
				   /**
				   * The following routine will increase the "hit" count of a product and update it in the catalog list
				   */
				    if($cat=='pharma') $cat_table='care_pharma_ordercatalog';
			          else $cat_table='care_med_ordercatalog';
					for($i=1;$i<=$maxcount;$i++)
			       {
					 $b='bestellnum'.$i; 
				    	// get the needed info from the main pharma db
					 $sql='SELECT hit FROM '.$cat_table.' WHERE bestellnum="'.$$b.'" AND dept=\''.$dept.'\'';
        			 if($ergeb=$db->Execute($sql))
					 {
					 	$resulthit=$ergeb->FetchRow();
					    $sql='UPDATE '.$cat_table.' SET hit='.($resulthit['hit']+1).' WHERE bestellnum="'.$$b.'" AND dept=\''.$dept.'\'';
        			    $db->Execute($sql);
					 }
					 /* end of routine */
                   }
					$saveok=true;
				}
				else { echo "$sql<br>$LDDbNoSave<br>"; } 
		}// end of if ($mode=="add")
//++++++++++++++++++++++++++++++++++++++++
	}
  	 else { echo "$LDDbNoLink<br>"; } 
}

// echo $sql;

$rows=0;
$wassent=false;

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
		{
				$sql='SELECT * FROM '.$dbtable.' 
						WHERE order_nr="'.$order_nr.'"
						AND dept="'.$dept.'"';
						
        		if($ergebnis=$db->Execute($sql))
				{
					//reset result
					if ($rows=$ergebnis->RecordCount())	
					{
						// check status again to be sure that the list is not sent by somebody else
					   $content=$ergebnis->FetchRow();
						if(($content['sent_datetime']>0)||($content['validator']!=''))
						{
							$wassent=true;
							 $rows=0;
						} // if sent_stamp or validator filled then reject this data
					}
				}else { echo "$LDDbNoRead<br>"; } 
		
			//echo $sql;
	}
  	 else { echo "$LDDbNoLink<br>"; } 
	 
/* Load common icon images */	 
$img_warn=createComIcon($root_path,'warn.gif','0');	
$img_uparrow=createComIcon($root_path,'uparrowgrnlrg.gif','0');
$img_info=createComIcon($root_path,'info3.gif','0');
$img_delete=createComIcon($root_path,'delete2.gif','0');
 
?>
<html>
<head>
<?php echo setCharSet(); ?>

<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}

</script>

<script language="javascript" src="../js/products_validate_order_num.js"></script>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 
<?php 
switch($mode)
{
	case "add":echo ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete":echo ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
}
echo "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php // foreach($argv as $v) echo "$v<br>"; ?>

<a href="javascript:gethelp('products.php','orderlist','<?php echo $rows ?>','<?php echo $cat ?>')"><img <?php echo createComIcon($root_path,'frage.gif','0','right') ?> alt="<?php echo $LDOpenHelp ?>"></a>


<?php
	
if($rows>0)
{
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

$tog=1;
//$content=$ergebnis->FetchRow();
echo '<form name=actlist>
		<font face="Verdana, Arial" size=2 color="#800000">'.$LDActualOrder.':</font>
		<font face="Arial" size=1> ('.$LDOn.': ';
		
		echo formatDate2Local($content['order_date'],$date_format);

		echo ' '.$LDTime.': '.str_replace('24','00',convertTimeToLocal($content['order_time'])).')</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDcatindex);$i++)
	echo '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$LDcatindex[$i].'</td>';
	echo '</tr>';	

$i=1;
$artikeln=explode(" ",$content['articles']);
for($n=0;$n<sizeof($artikeln);$n++)
 	{
	
	parse_str($artikeln[$n],$r);
	if(!$r['minorder']) $r['minorder']=0;
	if(!$r['maxorder']) $r['maxorder']=0;
	if($tog)
	{ echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1; }
	echo'
				<td>';
	if($mode=='delete') echo '<a name="'.$i.'"></a>';
	echo'	
				<font face=Arial size=1 color="#000080">'.$i.'</td>
				<td><font face=Verdana,Arial size=1>'.$r['artikelname'].'</td>';
/*				 <td><input type="text"  onBlur="validate_min(this,'.$r['minorder'].')"  onKeyUp="validate_value(this,'.$r['maxorder'].')" name="order_v'.$i.'" size=3 maxlength=3 value="'.$r[pcs].'"></td>
*/				 
    echo '<td><font face=Verdana,Arial size=1>'.$r['pcs'].'</td>
				<td ><font face=Verdana,Arial size=1><nobr>X '.$r['proorder'].'</nobr></td>
				<td><font face=Verdana,Arial size=1>'.$r['bestellnum'].'</td>
				<td><a href="javascript:popinfo(\''.$r['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$r['artikelname'].'"></a></td>
				<td><a href="'.$thisfile.URL_APPEND.'&order_nr='.$order_nr.'&mode=delete&cat='.$cat.'&idx='.$i.'&userck='.$userck.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a></td>
				</tr>';
	$i++;

 	}
	echo '</table>
			</form>
			<form action="products-orderlist-final.php" method="post">
			<input type="hidden" name="sid" value="'.$sid.'">
   			<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="order_nr" value="'.$order_nr.'">
   			<input type="hidden" name="cat" value="'.$cat.'">
   			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="submit" value="'.$LDFinalizeList.'">   
   			</form>	';


}
else
if($wassent)
{
	echo '
			<script language="javascript">window.parent.location.replace(\'apotheke-bestellung.php?sid='.$sid.'&lang='.$lang.'&itwassent=1&userck='.$userck.'\')</script>';
}	
else
{
	if($itwassent)
	echo '
		<font face="Verdana,Arial" size=2>'.$LDWasSent.'<p></font>';

	echo '<img '.createMascot($root_path,'mascot1_r.gif','0','middle').'><font face=Verdana,Arial size=2>'.$LDBasketEmpty.'<p>';

// get all lists that are not sent

    $rows=0;
    
	if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok)
	{
				$sql='SELECT * FROM '.$dbtable.' 
						WHERE (sent_datetime="" OR sent_datetime="0000-00-00 00:00:00")
						AND validator="" 
						AND (status="draft" OR status="")
						AND dept="'.$dept.'"
						ORDER BY order_date ';
						
        		if($ergebnis=$db->Execute($sql))
				{
					$rows=$ergebnis->RecordCount();
				}
				else { echo "$LDDbNoRead<br>"; } 
					//echo $sql;
	}
  	 else { echo "$LDDbNoLink<br>"; } 
		
//++++++++++ show the last lists+++++++++++++++++++++++++++++++++++++++++

	if($rows>0)
	{	
	
		if ($rows>1) echo $LDListNotSentMany;
			 else echo $LDListNotSent; 
		echo $LDClk2SeeEdit.'<br></font><p>';

		$tog=1;
		echo '
		<font face="Verdana, Arial" size=2 color="#800000">'.$last_orderlist.strtoupper($dept).':</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
		for ($i=0;$i<sizeof($LDListindex);$i++)
		echo '
			<td><font face=Verdana,Arial size=1 color="#000080">'.$LDListindex[$i].'</td>';
		echo '</tr>';	

		$i=1;

		while($content=$ergebnis->FetchRow())
 		{
			if($tog)
			{ echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1; }
			echo'
				<td><font face=Verdana,Arial size=1>'.$i.'</td>
				<td><a href="products-bestellung.php?sid='.$sid.'&lang='.$lang.'&cat='.$cat.'&order_nr='.$content['order_nr'].'&userck='.$userck.'"  target="_parent" ><img '.$img_uparrow.' alt="'.$LDEditList.'"></a></td>
				<td><font face=Verdana,Arial size=1>'.formatDate2Local($content['order_date'],$date_format);
				
			echo '</td>
				 <td><font face=Verdana,Arial size=1>'.convertTimeToLocal(str_replace('24','00',$content['order_time'])).'</td>
				<td ><font face=Verdana,Arial size=1>'.$content['modify_id'].'</td>
				<td align="center"><font face=Verdana,Arial size=1><img '.$img_warn.' alt="'.$LDNotSent.'">
			 	</td>
				</tr>';
			$i++;

 		}
		echo '</table>';
	}
}
?>
<a name="bottom"></a>
</body>
</html>
