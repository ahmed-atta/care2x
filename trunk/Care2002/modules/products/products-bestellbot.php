<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

/* Check if register globals is "on" */

$reg_glob_ini=ini_get('register_globals');

if(empty($reg_glob_ini)||(!$reg_glob_ini))
{
   include_once($root_path.'include/inc_vars_resolve.php');
}

define('LANG_FILE','products.php');

if(!isset($userck)) 
  if(isset($HTTP_GET_VARS['userck'])) $userck=$HTTP_GET_VARS['userck'];
    elseif(isset($HTTP_POST_VARS['userck'])) $userck=$HTTP_POST_VARS['userck'];
$local_user=$userck;
require_once($root_path.'include/inc_front_chain_lang.php');


switch($cat)
{
	case 'pharma':	if ($HTTP_COOKIE_VARS[$local_user.$sid]==NULL) $cat="";  
							$title="$LDPharmacy - $LDOrderBotActivate";
							$bot_name=$LDPharmaOrderBot;
							$dbtable='care_pharma_orderlist';
							break;
	case 'medlager':if ($HTTP_COOKIE_VARS[$local_user.$sid]==NULL) $cat="";  
							$title="$LDMedDepot - $LDOrderBotActivate";
							$bot_name=$LDDepotOrderBot;
							$dbtable='care_med_orderlist';
							break;
	//default:   {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
}

$rows=0;
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{
    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    
	
    /* Load editor functions for time format converter */
    //include_once('../include/inc_editor_fx.php');

				//$sql='SELECT * FROM '.$dbtable.' WHERE status LIKE "o_%" ORDER BY t_stamp DESC';;
				$sql='SELECT * FROM '.$dbtable.' WHERE status="pending" OR status="ack_print" ORDER BY sent_datetime DESC';;
        		if($ergebnis=$db->Execute($sql))
				{
					$rows=$ergebnis->RecordCount();
				}else{ echo "$LDDbNoRead<br>"; } 
			//echo $sql;
}
else 
{ echo "$LDDbNoLink<br>"; } 

?>

<html>
<head>
<?php echo setCharSet(); ?>
<meta http-equiv="refresh" content="15, url: products-bestellbot.php<?php echo "$sid&lang=$lang&userck=$userck"; ?>&cat=<?php echo $cat ?>">
<title><?php echo $title ?></title>
<script language=javascript>
function goactive()
	{
<?php
if ($nofocus=='') echo "	
 	if(window.focus) window.focus();
 	";
?>
	window.resizeTo(800,600);
	}
	
function show_order(d,o,s,t)
{
	url="products-bestellbot-print.php<?php echo URL_REDIRECT_APPEND."&userck=$userck"; ?>&cat=<?php echo $cat ?>&dept="+d+"&order_nr="+o+"&status="+s+"&sent_datetime="+t;
	<?php echo $cat.'powin'.$sid; ?>=window.open(url,"<?php echo $cat.'powin'.$sid; ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
</script>

</head>
<body <?php 	if($rows && !$nofocus) echo ' bgcolor="#ffffee"  onLoad="goactive()" '; ?>>
<?php
//echo "$rows <br>";
if($rows)
{
	if($showlist)
	{
	echo '<center>
			<font face=Verdana,Arial size=2>
			<p>';
			if ($rows>1) echo $LDNewOrderMany; else echo $LDNewOrder; 
			echo'<br> '.$LDClk2Ack.'<br></font><p>';

		$tog=1;
		echo '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($LDOrderIndex);$i++)
		echo '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$LDOrderIndex[$i].'</td>';
		echo '
				</tr>';	

		$i=$rows;

		while($content=$ergebnis->FetchRow())
 		{
			if($tog)
			{ 
			    echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1;
			}
			
			echo'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content['dept'].'\',\''.$content['order_nr'].'\',\''.$content['status'].'\',\''.$content['sent_datetime'].'\')"><img '.createComIcon($root_path,'uparrowgrnlrg.gif','0').' alt="'.$LDClk2Ack.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content[dept]).'</td>
				<td><font face=Verdana,Arial size=2>';
				
			$buf=explode(' ',$content['sent_datetime']);
			
			echo formatDate2Local($buf[0],$date_format).'</td>
				 <td><font face=Verdana,Arial size=2>'.convertTimeToLocal(str_replace('24','00',$buf[1])).'</td>
				<td align="center">';
		   
		   if($content['status']=='ack_print')
		   {
				 if($content['priority']=='urgent') echo '<img '.createComIcon($root_path,'check-r.gif','0').' alt="'.$LDUrgent.'">';
				     else echo '<img '.createComIcon($root_path,'check2.gif','0').' alt="'.$LDOK.'">';
			}
			else
			{
			     if($content['priority']=='urgent')  echo '<img '.createComIcon($root_path,'warn.gif','0').' alt="'.$LDUrgent.'">';
			}

			echo '
					</td>
				</tr>';
			$i--;
 		}
		echo '
			</table>
			</td></tr></table>
			</center>';
	}
	else 
	{
 	echo '<center><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>
			<font face="Verdana, Arial" size=3 color=#ff0000>
			&nbsp;<b>'.$LDOrderArrived.'</b><p>
			<form name=ack>
			<input type="hidden" name="showlist" value="1">
			<input type="hidden" name="sid" value="'.$sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="submit" value="'.$LDShowOrder.'">
    		</form>
			</center>'; 
	}
	

}
else {

	if($showlist) {	
		$showlist=0;
		echo '<script language="javascript">	self.resizeTo(200,180);	</script>';
	}
	
	echo '<img '.createComIcon($root_path,'butft2_d.gif').'>';
?>
<font face="Verdana, Arial" size=2 color=#800000>
<MARQUEE dir=ltr scrollAmount=3 scrollDelay=120 width=150
      height=10 align="middle"><b><?php echo "$LDIm $bot_name" ?>...</b></MARQUEE></font>
<p>
<?php
}
?>
</body>
</html>
