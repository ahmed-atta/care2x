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
switch($HTTP_SESSION_VARS['sess_user_origin'])
{
	case 'admission': 
	{
		$local_user='aufnahme_user';
		break;
	}
	default: 
	{
		$local_user='ck_op_pflegelogbuch_user';
	}
}
require_once($root_path.'include/inc_front_chain_lang.php');
if (!$pn) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
require_once($root_path.'include/inc_config_color.php');
?>
<?php if($saveok) { ?>
<?php
switch($target)
{
	case "ops-intern":
							$openerfile="drg-ops-intern.php";
							break;
	case "icd10":
							$openerfile="drg-icd10.php";
							break;
	case "ops301":
							$openerfile="drg-ops301.php";
							break;
	default:{header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;};
}
?>
 <script language="javascript" >
 window.opener.location.href='<?php echo "$openerfile?sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
 window.close();
</script>
	<?php exit; ?>
<?php } ?>
<?php
switch($target)
{
	case "ops-intern":
							$title=$LDOperation;
							$rowcolor="#990000";
							$element="ops_intern_code";
							$searchfile="drg-ops-intern-search.php";
							break;
	case "icd10":
							$title=$LDIcd10;
							$rowcolor="#0000aa";
							$element="icd_code";
							$searchfile="drg-icd10-search.php";
							$save_related=1;
							$element_related="related_icd";
							break;
	case "ops301":
							$title=$LDOps301;
							$rowcolor="#009900";
							$element="ops_code";
							$searchfile="drg-ops301-search.php";
							$save_related=1;
							$element_related="related_ops";
							break;
	default:{header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;};
}

$toggle=0;

$thisfile="drg-quicklist.php";

if($mode=='save')
{
	$itemselector="sel";
	include($root_path."include/inc_drg_entry_save.php");
}
else
{
	$fielddata="item, code_description, rank";
	$dbtable="care_drg_quicklist";
	$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE dept_nr="'.$dept_nr.'" AND type="'.$target.'" AND lang="'.$lang.'" ORDER BY rank DESC';
		if($ergebnis=$db->Execute($sql))
       	{
			$linecount=$ergebnis->RecordCount();
		}
		else {echo "<p>".$sql."<p>$LDDbNoRead"; exit;};
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
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
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
	var x=d.lastindex.value;
	for(i=0;i<x;i++)
	if(eval("d.sel"+i+".checked"))
	{
		ret=true;
		break;
	}
	return ret;
}
// -->
</script>
 
  <?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY   onLoad="if(window.focus) window.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<FONT    SIZE=3  FACE="Arial" color="<?php echo $rowcolor ?>">
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> align="right"></a>
<b><?php echo "$LDQuickList $title" ?></b>
<ul>

<p>

<form name="quicklist" onSubmit="return checkselect(this)" method="post">

<table border=0 cellpadding=0 cellspacing=0 width='100%'> 
<tr bgcolor="<?php echo $rowcolor ?>">
<td width="20">
<img <?php echo createComIcon($root_path,'delete2.gif','0') ?> alt="<?php echo $LDReset ?>" onClick="javascript:document.quicklist.reset()">
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?php echo $title ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>

<?php
function drawdata(&$data)
{
	global $toggle,$LDInclusive,$LDExclusive,$LDNotes,$LDRemarks,$LDExtraCodes,$LDAddCodes;
 	global $idx,$keyword,$showonly;
						parse_str($data,$parsed);
						echo "
						<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo '
						<td>';
						 		echo '<input type="checkbox" name="sel'.$idx.'" value="'.htmlspecialchars($data).'">';
								 $idx++;
						echo '
							</td>
							<td><font face=arial size=2><nobr>';
						//echo " *$parentcode +$grandcode";
						 echo "$parsed[code]&nbsp;";		
						echo "&nbsp;</nobr></td><td>&nbsp;";
						//echo '<font face=arial size=2>'.trim($data[description]);
						echo '<font face=arial size=2>';
						echo "$parsed[des]&nbsp;";		
						
						echo '</td>';
					echo "</tr>";
}

			if ($linecount>0) 
				{ 
					$idx=0;
					while($zeile=$ergebnis->FetchRow())
					{
							drawdata($zeile['code_description']);
							//$idx++;
					}
				}
?>

</table>
<?php if($linecount>0) : ?>
<input type="hidden" name="lastindex" value="<?php echo $idx ?>">
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
<input type="hidden" name="mode" value="save">

</form>
<?php else : ?>
<p>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="bottom"><?php echo $LDNoQuickList ?> 
<a href="<?php echo "$searchfile?sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&display=$display&target=$target" ?>"><u><?php echo $LDClick2Search ?></u></a> 
<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php endif ?>

</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
