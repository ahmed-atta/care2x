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
define('LANG_FILE','drg.php');
$local_user='ck_op_pflegelogbuch_user';
require_once($root_path.'include/inc_front_chain_lang.php');
if (!$opnr||!$pn) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
?>
<?php if($saveok) : ?>
 <script language="javascript" >
 window.opener.parent.location.href='<?php echo "drg-composite-start.php?sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
 window.close();
</script>
	<?php exit; ?>
<?php endif ?>
<?php
require_once($root_path.'include/inc_config_color.php');

$toggle=0;

$thisfile='drg-related-codes.php';

if($mode=='save')
{
	$save_related=1;
	
	$target='icd10';
	$element='icd_code';
	$element_related='related_icd';
	$itemselector='icd';
	$lastindex=$last_icd_index;
	$noheader=1;
	include($root_path.'include/inc_drg_entry_save.php');
	
	unset($qlist);
	$linebuf='';
	$noheader=0;
	$target='ops301';
	$element='ops_code';
	$element_related='related_ops';
	$itemselector='ops';
	$lastindex=$last_ops_index;
	include($root_path.'include/inc_drg_entry_save.php');
	if($linebuf=='')
	{
		header("location:$thisfile?sid=$sid&lang=$lang&saveok=1&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&target=$target");
		exit;
	}
}
else
{
	if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok)
	{	
		 
            /* Load the date formatter */
            include_once($root_path.'include/inc_date_format_functions.php');
            

			$dbtable='care_nursing_op_logbook';
			
			$sql="SELECT ops_intern_code  FROM $dbtable WHERE op_nr='$opnr' AND encounter_nr='$pn' AND dept_nr='$dept_nr' AND op_room='$oprm'";
			if($op_result=$db->Execute($sql))
       		{
				//$icdcount=0;
				//if ($zeile=mysql_fetch_array($op_result)) $opcount++;
				$opcount=$op_result->RecordCount();
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead"; };
			 
			$dbtable="care_drg_related_codes";

			$sql='SELECT related_icd,rank FROM '.$dbtable.' WHERE code="'.$maincode.'" AND related_icd<>"" AND lang="'.$lang.'" ORDER BY rank DESC';
			if($icd_result=$db->Execute($sql))
       		{
				//$icdcount=0;
				//if ($zeile=mysql_fetch_array($icd_result)) $icdcount++;
				$icdcount=$icd_result->RecordCount();
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead"; };
			 
			$sql='SELECT related_ops,rank FROM '.$dbtable.' WHERE code="'.$maincode.'" AND related_ops<>"" AND lang="'.$lang.'" ORDER BY rank DESC';
			if($ops_result=$db->Execute($sql))
       		{
				//$opscount=0;
				//if ($zeile=mysql_fetch_array($ops_result)) $opscount++;
				$opscount=$ops_result->RecordCount();
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead"; };
		}
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDQuickList $title" ?></TITLE>
  <script language="javascript" src="../js/showhide-div.js">
</script>
  <script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
function subsearch(k)
{
	//window.location.href='drg-icd10-search.php?sid=<?php echo "sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&display=$display" ?>&keyword='+k;
	document.searchdata.keyword.value=k;
	document.searchdata.submit();
}
function checkselect(d)
{
	var ret=false;
		var x=d.last_icd_index.value;
		for(i=0;i<x;i++)
		if(eval("d.icd"+i+".checked"))
		{
			ret=true;
			break;
		}
		var x=d.last_ops_index.value;
		for(i=0;i<x;i++)
		if(eval("d.ops"+i+".checked"))
		{
			ret=true;
			break;
		}
	return ret;
}
function getRelatedCodes(mc)
{
	window.location.href="drg-related-codes.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept_nr=$dept_nr&oprm=$oprm" ?>&maincode="+mc;
}
// -->
</script>
 
  <?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY marginheight=2 marginwidth=2 leftmargin=2 topmargin=2  onLoad="if(window.focus) window.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> align="right"></a>
<FONT    SIZE=2  FACE="verdana,Arial" >
<?php echo "$ln, $fn ".formatDate2Local($bd,$date_format)." - $pn";
	if($opnr) echo" - OP# $opnr - $dept_nr OP $oprm"; 
?>
</font><p>
<ul>
<FONT    SIZE=3  FACE="Arial" color="<?php echo $rowcolor ?>">
<b><?php echo "$LDPossibleCodes" ?></b>


<p>

<form name="quicklist" onSubmit="return checkselect(this)" method="post">

<table border=0 cellpadding=0 cellspacing=0 width='100%'> 
<?php if($opcount)
{
?>
<tr bgcolor="#990000">
<td width="20">
&nbsp;
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?php echo $LDOperation ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>

<?php
}

function drawdata(&$data)
{
	global $toggle;
 	global $idx,$keyword,$showonly,$deleter,$selector,$maincode;
						parse_str($data,$parsed);
						echo "
						<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo '
						<td>';
						if($deleter)
						{
						 		echo '<input type="checkbox" name="'.$selector.$idx.'" value="'.$data.'">';
								 $idx++;
						}
						else
						{
							if($maincode==$parsed[code]) echo'
							<img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle').'>';
						}
						echo '
							</td>
							<td><font face=arial size=2><nobr>';
						//echo " *$parentcode +$grandcode";
						if(!$deleter&&($maincode!=$parsed[code])) echo '
						<a href="javascript:getRelatedCodes(\''.$parsed[code].'\')"><u>'.$parsed[code].'</u></a>&nbsp;';
						else
							 echo "$parsed[code]&nbsp;";		
						echo "&nbsp;</nobr></td><td>&nbsp;";
						//echo '<font face=arial size=2>'.trim($data[description]);
						echo '<font face=arial size=2>';
						if(!$deleter&&($maincode!=$parsed[code])) echo '
						 <a href="javascript:getRelatedCodes(\''.$parsed[code].'\')"><u>'.$parsed[des].'</u></a>&nbsp;';
						else
							echo "$parsed[des]&nbsp;";		
						
						echo '</td>';
					echo "</tr>";
}
			if ($opcount>0) 
				{ 
					//mysql_data_seek($op_result,0);
					$zeile=$op_result->FetchRow();
					if($zeile[ops_intern_code]!="") 
					{
						$linebuf=explode("~",$zeile[ops_intern_code]);
						foreach($linebuf as $v)	drawdata($v);
					}
				}
				
$deleter=1;
$idx=0;
if($icdcount)
{
?>
<tr >
<td colspan=8>&nbsp;
</td>
</tr>
<tr bgcolor="#0000aa">
<td width="20">
<img <?php echo createComIcon($root_path,'delete2.gif','0') ?> alt="<?php echo $LDReset ?>" onClick="javascript:document.quicklist.reset()">
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?php echo $LDIcd10 ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>
<?php
}
	$idx=0;
			if ($icdcount>0) 
				{ 
					$selector="icd";
					//mysql_data_seek($icd_result,0);
					while($zeile=$icd_result->FetchRow())
					{
							drawdata($zeile[related_icd]);
							//$idx++;
					}
				}
?>
<input type="hidden" name="last_icd_index" value="<?php echo $idx ?>">
<?php if($opscount)
{
?>
<tr >
<td colspan=8>&nbsp;
</td>
</tr>
<tr bgcolor="#009900">
<td width="20">
<img <?php echo createComIcon($root_path,'delete2.gif','0') ?> alt="<?php echo $LDReset ?>" onClick="javascript:document.quicklist.reset()">
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?php echo $LDOps301 ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>
<?php
}
			if ($opscount>0) 
				{ 
					$selector="ops";
					$idx=0;
					//mysql_data_seek($ops_result,0);
					while($zeile=$ops_result->FetchRow())
					{
							drawdata($zeile[related_ops]);
							//$idx++;
					}
				}
				else
				{
?>
<input type="hidden" name="ops0" value="">
<?php
			}
?>
</table>
<input type="hidden" name="last_ops_index" value="<?php echo $idx ?>">
<?php if($icdcount||$opscount) : ?>
<p>
<input type="submit" value="<?php echo $LDApplySelection ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="pn" value="<?php echo $pn; ?>">
<input type="hidden" name="opnr" value="<?php echo $opnr; ?>">
<input type="hidden" name="ln" value="<?php echo $ln; ?>">
<input type="hidden" name="fn" value="<?php echo $fn; ?>">
<input type="hidden" name="bd" value="<?php echo $bd; ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>">
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="maincode" value="<?php echo $maincode; ?>">
<input type="hidden" name="mode" value="save">

</form>
<?php else : ?>
<p>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="bottom"><?php echo $LDNoQuickList ?> 
<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php endif ?>

</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
