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

if(!$dept)
{
	if($HTTP_COOKIE_VARS['ck_thispc_dept']) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	elseif($HTTP_COOKIE_VARS['ck_thispc_station']) $dept=$HTTP_COOKIE_VARS['ck_thispc_station'];
	 elseif($HTTP_COOKIE_VARS['ck_thispc_room']) $dept=$HTTP_COOKIE_VARS['ck_thispc_room'];
	 	 else $dept='plop'; //simulate plop dept
}

$sendok=false;
$ofinal=false;


if($cat=='pharma') 
 {
 	$dbtable='care_pharma_orderlist';
	$title=$LDPharmacy;
	$breakfile='apotheke.php';
 }
 else
 {
 	$dbtable='care_med_orderlist';
	$title=$LDMedDepot;
	$breakfile='medlager.php';
 }

$thisfile='products-orderlist-final.php';

// define the content array
$rows=0;
$count=0;

/* Load the date formatter */
require_once('../include/inc_date_format_functions.php');

if(($mode=='send') && isset($order_nr) && $order_nr)
{
	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK)
	{
	   
	   /* Check password of the validator */
	   
	   $sql='SELECT password FROM care_users WHERE login_id="'.$validator.'"';
	   
	   if($ergebnis=mysql_query($sql,$link))
	   {
			
		  if(mysql_num_rows($ergebnis))
		  {
		     $result=mysql_fetch_array($ergebnis);
			 
			 if ($result['password'] == $vpw)
			 {
			 
		         $sql='UPDATE '.$dbtable.' SET 										
							 		validator="'.$validator.'",
									priority="'.$prior.'",
									status="pending",
									sent_datetime="'.date('Y-m-d H:i:s').'"
							   		WHERE order_nr="'.$order_nr.'"
									AND dept="'.$dept.'"';		// save aux data to the order list
		
		         if($ergebnis=mysql_query($sql,$link))
		         {
				//echo $sql;
					$ofinal=true;
				    $sendok=true;			
			    }	
			//echo $sql;
			}
			else
			{
			    $error='password';
			    $mode='';
			}
		 }
		 else
		 { 
			$error='validator';
			$mode='';
		 } 
	  }
	  else
	  { echo "$sql<br>$LDDbNoRead<br>"; } 
		
	}
  	 else { echo "$sql<br>$LDDbNoLink<br>"; } 
}
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
	urlholder="products-bestellkatalog-popinfo.php?sid=<?php echo "$sid&lang=$lang"; ?>&cat=<?php echo $cat; ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}
function checkform(d)
{
	if (d.validator.value=="") 
	{
		alert("<?php echo $LDAlertNoValidator ?>");
		return false;
	}
	if (d.vpw.value=="") 
	{
		alert("<?php echo $LDAlertNoPassword ?>");
		return false;
	}
 	return true;
}
<?php if (($mode=='send')&&($sendok))
{
$idbuf=$order_nr + 1;
echo "
		function hide_bcat()
		{
			window.parent.BESTELLKATALOG.location.replace('products-bestellkatalog.php?sid=$sid&lang=$lang&userck=$userck&cat=$cat&order_nr=$idbuf')
		}";
}
?>
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
	case "add":echo ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete":echo ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
	case "send": if($sendok) echo ' onLoad="hide_bcat()" ';
}
echo "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a href="javascript:gethelp('products.php','final','<?php echo $sendok ?>','<?php echo $cat ?>')"><img <?php echo createComIcon('../','frage.gif','0','right') ?> alt="<?php echo $LDOpenHelp ?>"></a>

<?php

/* Display event messages */

if ($sendok) echo '
			<font face="Verdana, Arial" size=2 color="#800000">'.$LDOrderSent.'<p></font>';
			
if ($error )
{
?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif') ?>></td>
    <td><font face="Verdana, Arial" size=3 color="#800000"><b><?php echo ($error=='password') ? $LDInvalidPassword : $LDUnknownValidator; echo '<br>'.$LDPlsEnterInfo; ?></b></font></td>
  </tr>
</table>
<hr>
<?php
}

if($cat=='pharma') $dbtable='care_pharma_orderlist';
	else $dbtable=$dbtable='care_med_orderlist';


include_once('../include/inc_db_makelink.php');

if($link&&$DBLink_OK)
		{
				$sql='SELECT * FROM '.$dbtable.' WHERE order_nr="'.$order_nr.'"	AND dept="'.$dept.'"';
						
        		if($ergebnis=mysql_query($sql,$link))
				{
                    $rows=mysql_num_rows($ergebnis);
				}
				else  
				{ echo "$LDDbNoRead<br>"; } 
			//echo $sql;
	}
  	 else { echo "$LDDbNoLink<br>"; } 
	 
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++
	
if ($rows>0)
{

$tog=1;
$content=mysql_fetch_array($ergebnis);
echo '
		<font face="Verdana, Arial" size=2 color="#800000">'.$final_orderlist.strtoupper($dept).':</font><br>
		<font face="Arial" size=1> ('.$LDCreatedOn.': ';

		echo formatDate2Local($content['order_date'],$date_format);

		echo ' '.$LDTime.': '.convertTimeToLocal(str_replace('24','00',$content[order_time])).')</font>
		<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($LDFinindex);$i++)
	echo '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$LDFinindex[$i].'</td>';
	echo '</tr>';	

$i=1;
$artikeln=explode(" ",$content[articles]);
for($n=0;$n<sizeof($artikeln);$n++)
 	{
	parse_str($artikeln[$n],$r);
	if($tog)
	{ echo '<tr bgcolor="#ffffff">'; $tog=0; }else{ echo '<tr bgcolor="#ffffff">'; $tog=1; }
	echo'
				<td>';
	if($mode=='delete') echo '<a name="'.$i.'"></a>';
	echo'	
				<font face=Arial size=1 color="#000080">'.$i.'</td>
				<td><font face=Verdana,Arial size=1>'.$r[artikelname].'</td>
				 <td><font face=Verdana,Arial size=1>'.$r[pcs].'</td>
					<td ><font face=Verdana,Arial size=1><nobr>X '.$r[proorder].'</nobr></td>
			<td><font face=Verdana,Arial size=1>'.$r[bestellnum].'</td>
				</tr>';
	$i++;
 	}
	echo '</table></td></tr></table><font face=Verdana,Arial size=2 color="#800000">';
	
	if(($mode!='send')&&(!$sendok))
	{
		echo '
			<form action="'.$thisfile.'" method="post" onSubmit="return checkform(this)">'.$LDListindex[4].'<br>
			<input type="text" name="sender" size=30 maxlength=40 value="';
		
		echo $HTTP_COOKIE_VARS[$local_user.$sid]; 
		
		echo '"> 
			 &nbsp;'.$LDNormal.'<input type="radio" name="prior" value="normal" ';
			 
			 if(!isset($prior) || $prior=='normal' || $prior=='') echo ' checked';
			 echo '> 
			'.$LDUrgent.'<input type="radio" name="prior" value="urgent" ';
			
			 if(isset($prior) && $prior=='urgent') echo ' checked';
			
			echo '> <br>
   			<p>
			'.$LDValidatedBy.':<br>
			<input type="text" name="validator" size=30 maxlength=40 value="'.$validator.'"><br>
			<font size=1>'.$LDPassword.':</font><input type="password" name="vpw" size=15 maxlength=20>
       		<input type="hidden" name="sid" value="'.$sid.'">
       		<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="order_nr" value="'.$order_nr.'">
   			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="hidden" name="mode" value="send">
   			<p>
			<input type="submit" value="'.$LDSendOrder.'">   
   			</form></font><p>
			<font face=Verdana,Arial size=2>
			<a href="products-bestellkorb.php?sid='.$sid.'&lang='.$lang.'&cat='.$cat.'&order_nr='.$order_nr.'&userck='.$userck.'" ><< '.$LDBack2Edit.'</a></font>
			';
		}
		else 
		echo '
				<p><font face=Verdana,Arial size=1 color="#000080"><a href="'.$breakfile.'?sid='.$sid.'&lang='.$lang.'" target="_parent">
				<img '.createComIcon('../','arrow-blu.gif','0').'> '.$LDEndOrder.'</a>
				<p>
				<a href="products-bestellung.php?sid='.$sid.'&lang='.$lang.'&cat='.$cat.'&userck='.$userck.'" target="_parent"><img '.createComIcon('../','arrow-blu.gif','0').'> '.$LDCreateBasket.'</a>
				</font>';
}
?>
<a name="bottom"></a>
</body>
</html>
