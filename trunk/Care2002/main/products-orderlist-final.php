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

if(!$dept)
{
	if($HTTP_COOKIE_VARS[ck_thispc_dept]) $dept=$HTTP_COOKIE_VARS[ck_thispc_dept];
	elseif($HTTP_COOKIE_VARS[ck_thispc_station]) $dept=$HTTP_COOKIE_VARS[ck_thispc_station];
	 elseif($HTTP_COOKIE_VARS[ck_thispc_room]) $dept=$HTTP_COOKIE_VARS[ck_thispc_room];
	 	 else $dept="plop"; //simulate plop dept
}

$sendok=false;
$ofinal=false;


if($cat=="pharma") 
 {
 	$dbtable="pharma_orderlist";
	$title=$LDPharmacy;
	$breakfile="apotheke.php";
 }
 else
 {
 	$dbtable="med_orderlist";
	$title=$LDMedDepot;
	$breakfile="medlager.php";
 }

$thisfile="products-orderlist-final.php";

// define the content array
$rows=0;
$count=0;


if(($mode=="send")&&($order_id))
{
	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK)
		{
			
        // the column sent_stamp is not included in the sql to cause its auto update	
		$sql='UPDATE '.$dbtable.' SET 										
							 		validator="'.$validator.'@'.crypt($vpw).'",
									priority="'.$prior.'"
							   		WHERE order_id="'.$dept.$order_id.'"
									AND dept="'.$dept.'"';		// save aux data to the order list
		
		 if($ergebnis=mysql_query($sql,$link))
			{
				//print $sql;
					$ofinal=true;
					
				//$dbtable="pharma_orderlist_todo"; // select pharma table		
				if($cat=="pharma") $dbtable="pharma_orderlist_todo"; 
					else $dbtable=$dbtable="med_orderlist_todo";

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
	}
  	 else { print "$LDDbNoLink<br>"; } 
}
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
	urlholder="products-bestellkatalog-popinfo.php?sid=<?php print "$sid&lang=$lang"; ?>&cat=<?php print $cat; ?>&keyword="+b+"&mode=search";
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
<?php if (($mode=="send")&&($sendok))
{
$idbuf=uniqid("");
print "
		function hide_bcat()
		{
			window.parent.BESTELLKATALOG.location.replace('products-bestellkatalog.php?sid=$sid&lang=$lang&userck=$userck&cat=$cat&order_id=$idbuf')
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
	case "add":print ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete":print ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
	case "send": if($sendok) print ' onLoad="hide_bcat()" ';
}
print "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a href="javascript:gethelp('products.php','final','<?php echo $sendok ?>','<?php echo $cat ?>')"><img src="../img/frage.gif" border=0 width=15 height=15 align="right" alt="<?php echo $LDOpenHelp ?>"></a>

<?php if($sendok)
	print '
			<font face="Verdana, Arial" size=2 color="#800000">'.$LDOrderSent.'<p></font>';

//$dbtable="pharma_orderlist_".$dept;

if($cat=="pharma") $dbtable="pharma_orderlist";
	else $dbtable=$dbtable="med_orderlist";

$rows=0;
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
				}else  { print "$LDDbNoRead<br>"; } 
			//print $sql;
	}
  	 else { print "$LDDbNoLink<br>"; } 
	
if($rows>0)
{
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

$tog=1;
$content=mysql_fetch_array($ergebnis);
print '
		<font face="Verdana, Arial" size=2 color="#800000">'.$final_orderlist.strtoupper($dept).':</font><br>
		<font face="Arial" size=1> (erstellt am: ';
		$dt=explode(".",$content[order_date]);
		print "$dt[2].$dt[1].$dt[0]";
		print ' zeit: '.str_replace("24","00",$content[order_time]).')</font>
		<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($LDFinindex);$i++)
	print '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$LDFinindex[$i].'</td>';
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
	{
		print '
			<form action="'.$thisfile.'" method="get" onSubmit="return checkform(this)">'.$LDListindex[4].'<br>
			<input type="text" name="sender" size=30 maxlength=40 value="';
		print $HTTP_COOKIE_VARS[$local_user.$sid]; 
		print '"> 
			 &nbsp;'.$LDNormal.'<input type="radio" name="prior" value="normal" checked> 
			'.$LDUrgent.'<input type="radio" name="prior" value="urgent" > <br>
   			<p>
			'.$LDValidatedBy.':<br>
			<input type="text" name="validator" size=30 maxlength=40 value="'.$validator.'"><br>
			<font size=1>'.$LDPassword.':</font><input type="password" name="vpw" size=15 maxlength=20>
       		<input type="hidden" name="sid" value="'.$sid.'">
       		<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="order_id" value="'.$order_id.'">
   			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="hidden" name="mode" value="send">
   			<p>
			<input type="submit" value="'.$LDSendOrder.'">   
   			</form></font><p>
			<font face=Verdana,Arial size=2>
			<a href="products-bestellkorb.php?sid='.$sid.'&lang='.$lang.'&cat='.$cat.'&order_id='.$order_id.'&userck='.$userck.'" ><< '.$LDBack2Edit.'</a></font>
			';
		}
		else 
		print '
				<p><font face=Verdana,Arial size=1 color="#000080"><a href="'.$breakfile.'?sid='.$sid.'&lang='.$lang.'" target="_parent">
				<img src="../img/arrow-blu.gif" width=12 height=12 border=0> '.$LDEndOrder.'</a>
				<p>
				<a href="products-bestellung.php?sid='.$sid.'&lang='.$lang.'&cat='.$cat.'&userck='.$userck.'" target="_parent"><img src="../img/arrow-blu.gif" width=12 height=12 border=0> '.$LDCreateBasket.'</a>
				</font>';
}
?>
<a name="bottom"></a>
</body>
</html>
