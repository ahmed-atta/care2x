<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","drg.php");
$local_user="ck_op_pflegelogbuch_user";
require("../include/inc_front_chain_lang.php");
if (!$opnr||!$pn) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
?>
<?php if($saveok) : ?>
 <script language="javascript" >
 window.opener.parent.location.href='<?php echo "drg-composite-start.php?sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
 window.close();
</script>
	<?php exit; ?>
<?php endif ?>
<?php
require("../include/inc_config_color.php");

$toggle=0;

$thisfile="drg-related-codes.php";

if($mode=="save")
{
	$save_related=1;
	
	$target="icd10";
	$element="icd_code";
	$element_related="related_icd";
	$itemselector="icd";
	$lastindex=$last_icd_index;
	$noheader=1;
	include("../include/inc_drg_entry_save.php");
	
	unset($qlist);
	$linebuf="";
	$noheader=0;
	$target="ops301";
	$element="ops_code";
	$element_related="related_ops";
	$itemselector="ops";
	$lastindex=$last_ops_index;
	include("../include/inc_drg_entry_save.php");
	if($linebuf=="")
	{
		header("location:$thisfile?sid=$sid&lang=$lang&saveok=1&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&target=$target");
		exit;
	}
}
else
{
		include("../include/inc_db_makelink.php");
		if($link&&$DBLink_OK) 
		 {
			$dbtable="nursing_op_logbook";
			$sql="SELECT ops_intern_code  FROM $dbtable WHERE op_nr='$opnr' AND patnum='$pn' AND dept='$dept' AND op_room='$oprm'";
			if($op_result=mysql_query($sql,$link))
       		{
				$icdcount=0;
				if ($zeile=mysql_fetch_array($op_result)) $opcount++;
			}
			 else {print "<p>".$sql."<p>$LDDbNoRead"; };
			 
			$dbtable="drg_related_codes_".$lang;

			$sql='SELECT related_icd,rank FROM '.$dbtable.' WHERE code="'.$maincode.'" AND related_icd<>"" ORDER BY rank DESC';
			if($icd_result=mysql_query($sql,$link))
       		{
				$icdcount=0;
				if ($zeile=mysql_fetch_array($icd_result)) $icdcount++;
			}
			 else {print "<p>".$sql."<p>$LDDbNoRead"; };
			 
			$sql='SELECT related_ops,rank FROM '.$dbtable.' WHERE code="'.$maincode.'" AND related_ops<>"" ORDER BY rank DESC';
			if($ops_result=mysql_query($sql,$link))
       		{
				$opscount=0;
				if ($zeile=mysql_fetch_array($ops_result)) $opscount++;
			}
			 else {print "<p>".$sql."<p>$LDDbNoRead"; };

		}
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
	//window.location.href='drg-icd10-search.php?sid=<?php echo "sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&display=$display" ?>&keyword='+k;
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
	window.location.href="drg-related-codes.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&maincode="+mc;
}
// -->
</script>
 
  <?php 
require("../include/inc_css_a_hilitebu.php");
?>
 
</HEAD>

<BODY marginheight=2 marginwidth=2 leftmargin=2 topmargin=2  onLoad="if(window.focus) window.focus();" bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<a href="javascript:window.close()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="right"></a>
<FONT    SIZE=2  FACE="verdana,Arial" >
<?php print "$ln, $fn $bd - $pn";
	if($opnr) print" - OP# $opnr - $dept OP $oprm"; 
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
						print "
						<tr bgcolor=";
						if($toggle) { print "#efefef>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
						print '
						<td>';
						if($deleter)
						{
						 		print '<input type="checkbox" name="'.$selector.$idx.'" value="'.$data.'">';
								 $idx++;
						}
						else
						{
							if($maincode==$parsed[code]) print'
							<img src="../img/bul_arrowgrnlrg.gif" border=0 width=16 height=16 align="absmiddle">';
						}
						print '
							</td>
							<td><font face=arial size=2><nobr>';
						//print " *$parentcode +$grandcode";
						if(!$deleter&&($maincode!=$parsed[code])) print '
						<a href="javascript:getRelatedCodes(\''.$parsed[code].'\')"><u>'.$parsed[code].'</u></a>&nbsp;';
						else
							 print "$parsed[code]&nbsp;";		
						print "&nbsp;</nobr></td><td>&nbsp;";
						//print '<font face=arial size=2>'.trim($data[description]);
						print '<font face=arial size=2>';
						if(!$deleter&&($maincode!=$parsed[code])) print '
						 <a href="javascript:getRelatedCodes(\''.$parsed[code].'\')"><u>'.$parsed[des].'</u></a>&nbsp;';
						else
							print "$parsed[des]&nbsp;";		
						
						print '</td>';
					print "</tr>";
}
			if ($opcount>0) 
				{ 
					mysql_data_seek($op_result,0);
					$zeile=mysql_fetch_array($op_result);
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
<img src="../img/delete2.gif" border=0 width=20 height=20 alt="<?php echo $LDReset ?>" onClick="javascript:document.quicklist.reset()">
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
					mysql_data_seek($icd_result,0);
					while($zeile=mysql_fetch_array($icd_result))
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
<img src="../img/delete2.gif" border=0 width=20 height=20 alt="<?php echo $LDReset ?>" onClick="javascript:document.quicklist.reset()">
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
					mysql_data_seek($ops_result,0);
					while($zeile=mysql_fetch_array($ops_result))
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
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="hidden" name="lang" value="<?php print $lang; ?>">
<input type="hidden" name="pn" value="<?php print $pn; ?>">
<input type="hidden" name="opnr" value="<?php print $opnr; ?>">
<input type="hidden" name="ln" value="<?php print $ln; ?>">
<input type="hidden" name="fn" value="<?php print $fn; ?>">
<input type="hidden" name="bd" value="<?php print $bd; ?>">
<input type="hidden" name="dept" value="<?php print $dept; ?>">
<input type="hidden" name="oprm" value="<?php print $oprm; ?>">
<input type="hidden" name="display" value="<?php print $display; ?>">
<input type="hidden" name="target" value="<?php print $target; ?>">
<input type="hidden" name="maincode" value="<?php print $maincode; ?>">
<input type="hidden" name="mode" value="save">

</form>
<?php else : ?>
<p>
<img src="../img/catr.gif" border=0 width=88 height=80 align="bottom"><?php echo $LDNoQuickList ?> 
<p>
<a href="javascript:window.close()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24></a>
<?php endif ?>

</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
