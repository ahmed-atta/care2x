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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

/* Load date formatter */
require_once('../include/inc_date_format_functions.php');


$datum=date('Y-m-d');
$zeit=date('H:m:s');
$toggler=0;
// init sql dbase 

$dbtable='care_admission_patient';

$fieldname=array($LDPatListElements[4],$LDLastName,$LDName,$LDBirthDate);
			
$fielddata="patnum, name, vorname, gebdatum";

if(($pnum=="")&&($name=="")&&($vname=="")&&($gdatum=="")) $mode="";

if(is_numeric($pnum)) $pnum=(int)$pnum;

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDAssignOcc ?></TITLE>


<script language="javascript">
<!-- 
var urlholder;

function initwindow(){
	 	if (window.focus) window.focus();
		window.resizeTo(700,450);
		}

function enlargewin(){
	//window.moveTo(0,0);
	 window.resizeTo(700,600);
	}

function belegen(anum)
	{
		if((anum=="lock")&&(!confirm("<?php echo $LDConfirmLock ?>")))  return;

             <?php
            echo '
	          urlholder="pflege-station.php?mode=newdata&sid='.$sid.'&lang='.$lang.'&rm='.$rm.'&bd='.$bd.'&pyear='.$py.'&pmonth='.$pm.'&pday='.$pd.'&patnum="+anum+"&station='.$s.'";
			  ';
             ?>
	          window.opener.location.replace(urlholder);
	          window.close();
	}
	
function pruf(d)
	{
		if ((d.pnum.value=="")&&(d.name.value=="")&&(d.vname.value=="")&&(d.gdatum.value=="")) return false;
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>

// -->
</script>

<script language="javascript" src="../js/checkdate.js" type="text/javascript"></script>

<script language="javascript" src="../js/setdatetime.js"></script>

<?php if($d)
{ echo' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>';
}
?>
</HEAD>

<BODY bgcolor=white  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 link="#800080" vlink="#800080" onLoad="if (window.focus) window.focus();document.psearch.pnum.select();">
<table width=100% border=0 cellpadding="5" cellspacing=0 >
<tr>
<td bgcolor="<?php echo "#".$tb; ?>" >
<FONT  COLOR="<?php echo "#".$tt; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDAssignOcc $s"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('nursing_station.php','assign','','<?php echo $s ?>','<?php echo $LDAssignOcc ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close();" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td colspan=2>
<font face=verdana,arial ><?php echo $LDPatListElements[0] ?>: <b><?php echo $rm; ?></b> &nbsp;<?php echo $LDPatListElements[1] ?>: <b><?php echo $bd; ?></b>&nbsp;
<a href="javascript:belegen('lock')" title="<?php echo $LDClk2LockBed ?>"><img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?> alt="<?php echo $LDClk2LockBed ?>"> <?php echo $LDLockThisBed ?></a>
<p>
 <ul>
 
 <form action="pflege-station-bettbelegen.php" method="post" name="psearch" onSubmit="return pruf(this)">
 <table border=0 cellspacing=0 cellpadding=1>
   <tr>
     <td bgcolor=#0>
	 
	 <table border=0 bgcolor=#ffffcc cellspacing=0>
 		 <tr>
	    <td align=right><font face=verdana,arial size=2><?php echo $LDPatListElements[4] ?>:</td>
	    <td><input type="text" name="pnum" size=20 maxlength=20 value=<?php echo $pnum; ?>>
   	     </td>		  
			 <td>&nbsp;
	       </td>
		  </tr>
		  <tr>
		    <td align=right><font face=verdana,arial size=2><?php echo $LDLastName ?>:</td>
 		   <td><input type="text" name="name" size=40 maxlength=40 value=<?php echo $name; ?>>
  	      </td>		  
			 <td>&nbsp;
	       </td>
 	 </tr>
	  <tr>
 	   <td align=right><font face=verdana,arial size=2><?php echo $LDName ?>:</td>
	    <td><input type="text" name="vname" size=40 maxlength=40 value=<?php echo $vname; ?>>
	        </td>		  
			 <td>&nbsp;
	       </td>
	  </tr>
	  <tr>
	    <td align=right><font face=verdana,arial size=2><?php echo $LDBirthDate ?>:</td>
 	   <td><input type="text" name="gdatum" size=8 maxlength=8 value="<?php echo $gdatum; ?>"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')"   onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> <font face=verdana,arial size=2>[ <?php $dbuf='LD_'.strtr($date_format,'./-','psh'); echo $$dbuf; ?> ]
 	       </td>
		   <td> <a href="javascript:window.close()"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>></a>
	       </td>
	  </tr>
	</table>
</td>
   </tr>
 </table>
  
 <input type="hidden" name="sid" value="<?php echo $sid; ?>">
 <input type="hidden" name="lang" value="<?php echo $lang; ?>">
 <input type="hidden" name="tb" value="<?php echo $tb; ?>">
 <input type="hidden" name="tt" value="<?php echo $tt; ?>">
 <input type="hidden" name="bb" value="<?php echo $bb; ?>">
 <input type="hidden" name="s" value="<?php echo $s; ?>">
 <input type="hidden" name="rm" value="<?php echo $rm; ?>">
 <input type="hidden" name="bd" value="<?php echo $bd; ?>">
 <input type="hidden" name="py" value="<?php echo $py; ?>">
 <input type="hidden" name="pm" value="<?php echo $pm; ?>">
 <input type="hidden" name="pd" value="<?php echo $pd; ?>">
 <input type="hidden" name="d" value="<?php echo $d; ?>">                                                      
 <input type="hidden" name="mode" value="search">
  <p>
</FONT>

<input type="image" <?php echo createLDImgSrc('../','searchlamp.gif','0','absmiddle') ?> alt="<?php echo $LDSearchPatient ?>" > 
</form>
</ul>

<?php
/**
* Function to fetch the actual occupancy list of the station in a given day
* Used to check whether the patient is already checked-in in the station or not
* globals:  $s = station, $py = year, $pm = month, $pd = day, $LDDbNoLink = no db link error message
* $ergebnis = the resulting array from db table care_admission_patient search
* $new_zeile = buffer for filtered arrays
* db table used = nursing_station_patients
*/
function f_checkBedOccupancy(){

  global $link, $s, $py, $pm, $pd, $LDDbNoLink, $ergebnis, $new_zeile, $linecount, $lang;
  
  $sql="SELECT bed_patient FROM care_nursing_station_patients WHERE station='".$s."' AND s_date='".$py."-".$pm."-".$pd."' AND lang='".$lang."'";
  if($result=mysql_query($sql,$link))
  {
  	$rows=mysql_num_rows($result);
    if($rows==1) 
	{
	   $bed_occ=mysql_fetch_array($result);
	     $pat_count=0;
		  while($zeile=mysql_fetch_array($ergebnis))
		  {
		    if(eregi($zeile['patnum'],$bed_occ['bed_patient'])) continue;
			else
			 {
				 $new_zeile[]=$zeile;
				 $pat_count++;
			 }
		   }
	       return $pat_count;
	 }
	  elseif($rows>1) die ($LDErrorDuplicateBed);
        else 
		{
		  while($new_zeile[]=mysql_fetch_array($ergebnis))
				 $pat_count++;
		  return $pat_count;
		}
  }
  else 
  {
    echo $LDDbNoLink."<p>";
	return 0;
  }
}
	
/**
* Here begins the search routine
*/
if($mode=='search')
{
	$pnum=trim($pnum);
	if(is_numeric($pnum)) $pnum=(int)$pnum;
	$name=trim($name);
	$vname=trim($vname);
	$gdatum=trim($gdatum);

	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK)
		{
            include_once('../include/inc_date_format_functions.php');
            
			
	        $sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE name LIKE "'.$name.'%" 
	                                                                      AND vorname LIKE "'.$vname.'%" 
																		  AND patnum LIKE "'.$pnum.'%" 
																		  AND gebdatum LIKE "'.$gdatum.'%" 
																		  AND (discharge_date="" 
																		           OR discharge_date="0000-00-00")
																		  AND ( 
																		           discharge_art="chg_ward" 
																				   OR discharge_art="chg_bed" 
																				   OR discharge_art="")
																		  AND ( 
																		           at_station="0"
																				   OR at_station="")';
			
			$linecount=0;
        	//$ergebnis=mysql_query($sql,$link);
			if($ergebnis=mysql_query($sql,$link))
       		{
				$linecount=mysql_num_rows($ergebnis);
				if ($linecount>0) 
				{ 
				
					 /*  "Same patient entry bug" patch:  If patient is already assigned do not show him. patched = 2002-08-10 */
				  $pat_count=f_checkBedOccupancy();
				  if($pat_count)
					{
			         echo "<hr><font face=arial size=2><ul>".str_replace("~nr~",$pat_count,$LDSearchFound).$LDPlsClk."<br>\r\n";
					  //mysql_data_seek($ergebnis,0);
					  echo "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=orange>\r\n";
					  for($i=0;$i<sizeof($fieldname);$i++) 
					  {
						echo"
						<td><font face=arial size=2><b>".$fieldname[$i]."</b></td>\r\n";
					  }
					  echo "
					  </tr>\r\n";
					
					  $elem_buf=array("patnum","name","vorname");
					 
					  for($z=0;$z<$pat_count;$z++)
					  {
						echo "
						<tr bgcolor=";
						if($toggle) { echo "#cecece>"; $toggle=0;} else {echo "#ffffaa>"; $toggle=1;};
            			while(list($x,$v)=each($elem_buf))
						{
						   echo "
							<td><font face=arial size=2>";
							if($new_zeile[$z][$v]=="")echo "&nbsp;"; else echo $new_zeile[$z][$v];
							echo "
							</td>\r\n";
						}
    					   echo "
							<td><font face=arial size=2>";
							if($new_zeile[$z]['gebdatum']=="")echo "&nbsp;"; else echo formatDate2Local($new_zeile[$z]['gebdatum'],$date_format);
							echo "
							</td>\r\n";
						reset($elem_buf);
/*						echo "
						<td><a href=\"javascript:belegen('".$new_zeile[$z]['patnum']."')\"><button onClick=\"javascript:belegen('".$new_zeile[$z]['patnum']."')\"><img ".createLDImgSrc('../','ok_small.gif','0')." alt=\"$LDAssign2Bed\"></button></a></td>\r\n";
						echo "
*/						echo "
						<td><a href=\"javascript:belegen('".$new_zeile[$z]['patnum']."')\"><img ".createLDImgSrc('../','ok_small.gif','0')." alt=\"$LDAssign2Bed\"></a></td>\r\n";
						echo "
						</tr>\r\n";
					   }
					   echo "
					   </table></ul>";
					   echo "
						<script language='javascript'>window.resizeTo(700,600);</script>
							";
				    } // end of if ($pat_count)
					else echo "<hr><ul><img ".createMascot('../','mascot1_r.gif','0','absmiddle')."><font face=arial size=2>".$LDNoFound."<br>\r\n";
				} // end of if($linecount)
				else  echo "<hr><ul><img ".createMascot('../','mascot1_r.gif','0','absmiddle')."><font face=arial size=2>".$LDNoFound."<br>\r\n";

			}
			 else {echo "<p>$sql$LDDbNoRead";exit;}
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }

}
?>

<p>
</td>
</tr>
</table>        

<hr>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</BODY>
</HTML>
