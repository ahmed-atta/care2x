<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
//if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_drg.php");
require("../req/config-color.php");

$toggle=0;

if($opnr)
{
	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
	{	
				$dbtable="nursing_op_logbook";
				$sql="SELECT ops_intern_code  FROM $dbtable WHERE op_nr='$opnr' AND patnum='$pn' AND dept='$dept' AND op_room='$oprm'";
        		$ergebnis=mysql_query($sql,$link);
				$linecount=0;
				if($ergebnis)
       			{
					if ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
					if($linecount)
					{
						mysql_data_seek($ergebnis,0);
						switch($mode)
						{
							case "delete": 
												$zeile=mysql_fetch_array($ergebnis);
												$linebuf=trim($zeile[ops_intern_code]);
												if($linebuf=="") break;
												$arrbuf=explode("~",$linebuf);
												array_unique($arrbuf);
												array_splice($arrbuf,$item,1);
												$linebuf=addslashes(implode("~",$arrbuf));
												$sql="UPDATE $dbtable SET ops_intern_code='$linebuf' WHERE patnum='$pn' AND op_nr='$opnr' AND dept='$dept' AND op_room='$oprm'";
        										if($ergebnis=mysql_query($sql,$link)) 
												{
													header("location:drg-ops-intern.php?sid=$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1");
													exit;
												}
												else {print "<p>".$sql."<p>$LDDbNoWrite";};
											break;
						}
					}
				}
				 else {print "<p>".$sql."<p>$LDDbNoRead";};
	}
}
$uid="$dept_$oprm_$pn_$opnr"; 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>
 
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
function openOPSsearch()
{
	urlholder="drg-ops-intern-search.php?sid=<?="$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>";
	drgwin_<?=$uid ?>=window.open(urlholder,"drgwin_<?=$uid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?=$uid ?>.moveTo(100,100);
}
function deleteItem(i)
{
	if(confirm("<?=$LDAlertSureDelete ?>"))
	{
		window.location.href='drg-ops-intern.php?sid=<?="$ck_sid&lang=$lang&mode=delete&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&display=$display" ?>&item='+i;
	}
}
function openQuicklist(t)
{
	urlholder="drg-quicklist.php?sid=<?="$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&target="+t;
	drgwin_<?=$uid ?>=window.open(urlholder,"drgwin_<?=$uid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?=$uid ?>.moveTo(100,100);
}
function openRelatedCodes()
{
<? if($cfg['dhtml'])
	print '
			w=window.parent.screen.width-75;
			h=window.parent.screen.height-50;';
	else
	print '
			w=800;
			h=650;';
?>

	mc=document.ops_intern.maincode.value;
	relcodewin_<?=$uid ?>=window.open("drg-related-codes.php?sid=<?="$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&maincode="+mc,"relcodewin_<?=$uid ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.relcodewin_<?=$uid ?>.moveTo(0,0);
}

// -->
</script>
 
  <? 
require("../req/css-a-hilitebu.php");
?>
 <? if($newsave) : ?>
 <script language="javascript" >
 //window.opener.location.href='drg-composite-start.php?sid=<?="$ck_sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
window.parent.opener.location.href='<?="oploginput.php?sid=$ck_sid&lang=$lang&mode=saveok&patnum=$pn&op_nr=$opnr&dept=$dept&saal=$oprm&pyear=$y&pmonth=$m&pday=$d" ?>';
</script>
<? endif ?>
</HEAD>

<BODY 
<?
if($display=="composite") print 'topmargin=0 marginheight=0 leftmargin=0 marginwidth=0';
else  print 'topmargin=2 marginheight=2';
?> 
onLoad="if(window.focus) window.focus();" bgcolor="<? print $cfg['body_bgcolor']; ?>" 
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<form name="ops_intern" action="drg-ops-intern.php" method="post">
<FONT    SIZE=2  FACE="verdana,Arial" >
<? print "$ln, $fn $bd - $pn";
	if($opnr) print" - OP# $opnr - $dept OP $oprm"; 
?>
<? if($display!="composite") : ?>
<a href="javascript:window.history.back()" ><img src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="right"></a>

<b><?=$LDOps301 ?></b></font>&nbsp;
 <input type="button" value="<?=$LDSearch4OPS301 ?>" onClick="javascript:openOPSsearch()">&nbsp;
 <input type="button" value="<?=$LDQuickList ?>" onClick="javascript:openICDsearch()">
<p>
<? endif ?>

<table border=0 width=100%>
  <tr>
    <td width=100% valign="top">
	<table border=0 cellpadding=1 cellspacing=1 width=100%> 
		<tr bgcolor="#990000">
 		<td width="15%"><font face=arial size=2 color=#ffffff><b><?=$LDOpsIntern ?></b></td>
 		<td colspan=2><font face=arial size=2 color=#ffffff><b><?=$LDOperation ?></b></td>
    	</tr>

<?
			if ($linecount>0) 
				{ 
						mysql_data_seek($ergebnis,0);
						$zeile=mysql_fetch_array($ergebnis);
						$linebuf=trim($zeile[ops_intern_code]);
						if($linebuf)
						{
							$arrbuf=explode("~",trim($linebuf));
							array_unique($arrbuf);
							for($i=0;$i<sizeof($arrbuf); $i++)
							{
								parse_str(trim($arrbuf[$i]),$parsedline);
								if($i==0) $main_code=$parsedline[code];
								print "<tr bgcolor=";
								if($toggle) { print "#efefef>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
								print '
									<td><font face=arial size=2>'.stripslashes($parsedline[code]).'
									</td>
									<td><font face=arial size=2>'.stripslashes($parsedline[des]).'
									</td>
									<td><a href="';
								print "javascript:deleteItem('$i')";
								print '"><img src="../img/delete2.gif" border=0 width=20 height=20 alt="'.$LDDeleteEntry.'" align="absmiddle"></a>
									</td>';
								print "</tr>";
							}
						}
				}

?>
	</table>
	
	</td>
	 <td valign="top" bgcolor="#990000"><font face=arial size=2 color=#ffffff>
	<? if($display!="composite") : ?>   
	<a href="javascript:window.history.back()" ><img src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24></a>
 	<p>
	<? else : ?>
	<input type="button" value="<?=$LDSearch ?>" onClick="javascript:openOPSsearch()">&nbsp;
 	<p><input type="button" value="<?=$LDQuickList ?>" onClick="javascript:openQuicklist('ops-intern')">
	<? endif ?>
 	<p><input type="button" value="<?=$LDConvert2IcdOps ?>" onClick="javascript:openRelatedCodes()"><p>
	</td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="opnr" value="<?=$opnr ?>">
<input type="hidden" name="pn" value="<?=$pn ?>">
<input type="hidden" name="ln" value="<?=$ln ?>">
<input type="hidden" name="fn" value="<?=$fn ?>">
<input type="hidden" name="bd" value="<?=$bd ?>">
<input type="hidden" name="display" value="<?=$display ?>">
<input type="hidden" name="maincode" value="<?=$main_code ?>">

</form>

</FONT>


</FONT>


</BODY>
</HTML>
