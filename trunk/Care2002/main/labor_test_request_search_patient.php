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
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
$keyword=strtr($keyword,"%"," ");
$keyword=trim($keyword);

$dbtable='care_admission_patient';

$toggle=0;

switch($target)
{
  case "chemlabor": $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="pflege-station-patientdaten-doconsil-chemlabor.php?sid=".$sid."&lang=".$lang."&target=".$target."&noresize=1&user_origin=".$user_origin;
						  break;
  case "baclabor": $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="pflege-station-patientdaten-doconsil-baclabor.php?sid=".$sid."&lang=".$lang."&target=".$target."&noresize=1&user_origin=".$user_origin;
						  break;
  case "patho": $entry_block_bgcolor="#cde1ec";
                          $entry_border_bgcolor="#cde1ec";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="pflege-station-patientdaten-doconsil-patho.php?sid=".$sid."&lang=".$lang."&target=".$target."&noresize=1&user_origin=".$user_origin;
						  break;
  case 'blood': $entry_block_bgcolor="#99ffcc";
                          $entry_border_bgcolor="#99ffcc";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="pflege-station-patientdaten-doconsil-blood.php?sid=".$sid."&lang=".$lang."&target=".$target."&noresize=1&user_origin=".$user_origin;
						  break;
  default            : $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="pflege-station-patientdaten-doconsil-baclabor.php?sid=".$sid."&lang=".$lang."&target=".$target."&noresize=1&user_origin=".$user_origin;
}

$fielddata='patnum, name, vorname, gebdatum, item';


if(($mode=='search')&&($searchkey))
  {
		include('../include/inc_db_makelink.php');
		if($link&&$DBLink_OK) 
		{
            include_once('../include/inc_date_format_functions.php');
            
		
			$suchwort=trim($searchkey);
			if(is_numeric($suchwort))
			{
				$suchwort=(int) $suchwort;
				$numeric=1;
				if($suchwort<20000000) $suchbuffer=$suchwort+20000000; else $suchbuffer=$suchwort;
			}
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE discharge_art="" 
			                                      AND  ( name LIKE "'.$suchwort.'%" 
			                                      OR vorname LIKE "'.$suchwort.'%"
			                                      OR gebdatum LIKE "'.formatDate2STD($suchwort,$date_format).'%"
			                                      OR patnum LIKE "'.$suchbuffer.'" )
			                                    ORDER BY patnum';

        	$ergebnis=mysql_query($sql,$link);
			if($ergebnis)
       		{
				$linecount=mysql_num_rows($ergebnis);
				if ($linecount) 
				{ 
					if(($linecount==1)&&$numeric)
					{
						$zeile=mysql_fetch_array($ergebnis);
	  					mysql_close($link);
						header("location:pflege-station-patientdaten-doconsil-".$target.".php?sid=".$sid."&lang=".$lang."&pn=".$zeile['patnum']."&edit=1&status=".$status."&user_origin=".$user_origin."&noresize=1&mode=");
						exit;
					}
				}
				else $mode="";

			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
			 
	   require_once('../include/inc_date_format_functions.php');
       

	}
  	 else { echo "$LDDbNoLink<br>"; }

	
}
else
{ 
  $mode="";
}

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
  <?php 
require('../include/inc_css_a_hilitebu.php');
?>
<script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()" bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDTestRequest." - ".$LDSearchPatient ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2search.php')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo $breakfile; ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
</table>
<ul>
<FONT    SIZE=3  FACE="Arial" color="#990000"><?php echo $LDTestRequestFor.$LDTestType[$target] ?></font>
<table width=90% border=0 cellpadding="0" cellspacing="0">

<tr bgcolor="<?php echo $entry_block_bgcolor ?>" >

<td ><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchmask_bgcolor="#f3f3f3";
            include("../include/inc_test_request_searchmask.php");
       
	   ?>
</td>
     </tr>
   </table>

<p>
<a href="<?php	echo $breakfile; ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>></a>
<p>

<?php
//echo $mode;
echo '<hr width=80% align=left><p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
if ($linecount) 
	{ 
					mysql_data_seek($ergebnis,0);

					echo '
						<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa">';
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}
					echo"</tr>";

					while($zeile=mysql_fetch_array($ergebnis))
					{
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['patnum']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['name']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['vorname']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($zeile['gebdatum'],$date_format);
                        echo "</td>";	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;';
						echo "
							<a href=\"pflege-station-patientdaten-doconsil-".$target.".php?sid=".$sid."&lang=".$lang."&pn=".$zeile['patnum']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=\">";
						echo '	
							<img '.createLDImgSrc('../','ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
							
                       if(!file_exists("../cache/barcodes/pn_".$zeile['patnum'].".png"))
	      		       {
			               echo "<img src='../classes/barcode/image.php?code=".$zeile['patnum']."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo "
						</table>";
					if($linecount>15)
					{
?>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchform_count=2;
            include("../include/inc_test_request_searchmask.php");
       
	   ?>
</td>
     </tr>
   </table>
<?php
					}
				}
?>

</ul>
&nbsp;
</FONT>
<p>
</td>
</tr>
</table>        
</ul>
<p>

<?php

if(file_exists("../language/$lang/".$lang."_copyrite.php")) include("../language/$lang/".$lang."_copyrite.php");
  else include("../language/en/en_copyrite.php");
  
?>

</FONT>


</BODY>
</HTML>
