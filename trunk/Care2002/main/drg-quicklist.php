<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$opnr||!$pn) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
?>
<? if($saveok) : ?>
<?
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
	default:{header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;};
}
?>
 <script language="javascript" >
 window.opener.location.href='<?="$openerfile?sid=$ck_sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
 window.close();
</script>
	<? exit; ?>
<? endif ?>
<?
require("../language/".$lang."/lang_".$lang."_drg.php");
require("../req/config-color.php");
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
	default:{header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;};
}

$toggle=0;

$thisfile="drg-quicklist.php";

if($mode=="save")
{
	$itemselector="sel";
	include("../req/drg-entry-save.php");
}
else
{
	$fielddata="code_description,rank";
	$dbtable="drg_quicklist_".$lang;
		include("../req/db-makelink.php");
		if($link&&$DBLink_OK) 
		 {

			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE dept="'.$dept.'" AND type="'.$target.'" ORDER BY rank DESC';
			if($ergebnis=mysql_query($sql,$link))
       		{
				$linecount=0;
				if ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
			}
			 else {print "<p>".$sql."<p>$LDDbNoRead"; exit;};

		}
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?="$LDQuickList $title" ?></TITLE>
  <script language="javascript" src="../js/showhide-div.js">
</script>
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
function subsearch(k)
{
	//window.location.href='drg-icd10-search.php?sid=<?="sid=$ck_sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&display=$display" ?>&keyword='+k;
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
 
  <? 
require("../req/css-a-hilitebu.php");
?>
 
</HEAD>

<BODY   onLoad="if(window.focus) window.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<FONT    SIZE=3  FACE="Arial" color="<?=$rowcolor ?>">
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="right"></a>
<b><?="$LDQuickList $title" ?></b>
<ul>

<p>

<form name="quicklist" onSubmit="return checkselect(this)" method="post">

<table border=0 cellpadding=0 cellspacing=0 width='100%'> 
<tr bgcolor="<?=$rowcolor ?>">
<td width="20">
<img src="../img/delete2.gif" border=0 width=20 height=20 alt="<?=$LDReset ?>" onClick="javascript:document.quicklist.reset()">
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?=$title ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?=$LDDescription ?></b>
</td>
		
</tr>

<?

function drawdata(&$data)
{
	global $toggle,$LDInclusive,$LDExclusive,$LDNotes,$LDRemarks,$LDExtraCodes,$LDAddCodes;
 	global $idx,$keyword,$showonly;
						parse_str($data,$parsed);
						print "
						<tr bgcolor=";
						if($toggle) { print "#efefef>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
						print '
						<td>';
						 		print '<input type="checkbox" name="sel'.$idx.'" value="'.$data.'">';
								 $idx++;
						print '
							</td>
							<td><font face=arial size=2><nobr>';
						//print " *$parentcode +$grandcode";
						 print "$parsed[code]&nbsp;";		
						print "&nbsp;</nobr></td><td>&nbsp;";
						//print '<font face=arial size=2>'.trim($data[description]);
						print '<font face=arial size=2>';
						print "$parsed[des]&nbsp;";		
						
						print '</td>';
					print "</tr>";
}

			if ($linecount>0) 
				{ 
					$idx=0;
					mysql_data_seek($ergebnis,0);
					while($zeile=mysql_fetch_array($ergebnis))
					{
							drawdata($zeile[code_description]);
							//$idx++;
					}
				}
?>

</table>
<? if($linecount>0) : ?>
<input type="hidden" name="lastindex" value="<?=$idx ?>">
<input type="submit" value="<?=$LDApplySelection ?>">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="pn" value="<? print $pn; ?>">
<input type="hidden" name="opnr" value="<? print $opnr; ?>">
<input type="hidden" name="ln" value="<? print $ln; ?>">
<input type="hidden" name="fn" value="<? print $fn; ?>">
<input type="hidden" name="bd" value="<? print $bd; ?>">
<input type="hidden" name="dept" value="<? print $dept; ?>">
<input type="hidden" name="oprm" value="<? print $oprm; ?>">
<input type="hidden" name="display" value="<? print $display; ?>">
<input type="hidden" name="target" value="<? print $target; ?>">
<input type="hidden" name="mode" value="save">

</form>
<? else : ?>
<p>
<img src="../img/catr.gif" border=0 width=88 height=80 align="bottom"><?=$LDNoQuickList ?> 
<a href="<?="$searchfile?sid=$ck_sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&display=$display&target=$target" ?>"><u><?=$LDClick2Search ?></u></a> 
<p>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24></a>
<? endif ?>

</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
