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
				$sql="SELECT ops_code  FROM $dbtable WHERE op_nr='$opnr' AND patnum='$pn' AND dept='$dept' AND op_room='$oprm'";
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
												$linebuf=trim($zeile[ops_code]);
												if($linebuf=="") break;
												$arrbuf=explode("~",$linebuf);
												array_unique($arrbuf);
												array_splice($arrbuf,$item,1);
												$linebuf=addslashes(implode("~",$arrbuf));
												$sql="UPDATE $dbtable SET ops_code='$linebuf' WHERE patnum='$pn' AND op_nr='$opnr' AND dept='$dept' AND op_room='$oprm'";
        										if($ergebnis=mysql_query($sql,$link)) 
												{
													header("location:drg-ops301.php?sid=$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1");
													exit;
												}
												else {print "<p>".$sql."<p>$LDDbNoWrite";};
											break;
							case "update_stat":
												$sql="SELECT ops_code FROM $dbtable WHERE patnum='$pn' AND op_nr='$opnr' AND dept='$dept' AND op_room='$oprm'";
        										if($ergebnis=mysql_query($sql,$link)) 
												{
													if($zeile=mysql_fetch_array($ergebnis))
													{
														$linebuf=str_replace("&stat=1","&stat=2",$zeile[ops_code]);
														$arrbuf=explode("~",$linebuf);
														//$arrbuf[$itemx]=str_replace("&stat=2","&stat=1",$arrbuf[$itemx]);
														parse_str($arrbuf[$itemx],$parsed);
														$arrbuf[$itemx]="code=$parsed[code]&des=$parsed[des]&stat=1&loc=$parsed[loc]&byna=$parsed[byna]&bynr=$parsed[bynr]";
														if($itemx!=0)
														{
															$helpbuf=$arrbuf[$itemx];
															$arrbuf[$itemx]=$arrbuf[0];													
															$arrbuf[0]=$helpbuf;
														}
														$linebuf=implode("~",$arrbuf);
														
														$sql="UPDATE $dbtable SET ops_code='$linebuf' WHERE patnum='$pn' AND op_nr='$opnr' AND dept='$dept' AND op_room='$oprm'";
        												if($ergebnis=mysql_query($sql,$link)) 
														{
															header("location:$thisfile?sid=$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1");
															exit;
														}
														else {print "<p>".$sql."<p>$LDDbNoWrite";};
													
													}
												}
												else {print "<p>".$sql."<p>$LDDbNoWrite";};
											break;
							case "update_loc":
												$sql="SELECT ops_code FROM $dbtable WHERE patnum='$pn' AND op_nr='$opnr' AND dept='$dept' AND op_room='$oprm'";
        										if($ergebnis=mysql_query($sql,$link)) 
												{
													if($zeile=mysql_fetch_array($ergebnis))
													{
														$arrbuf=explode("~",$zeile[ops_code]);
														parse_str($arrbuf[$itemx],$parsed);
														$arrbuf[$itemx]="code=$parsed[code]&des=$parsed[des]&stat=$parsed[stat]&loc=$val&byna=$parsed[byna]&bynr=$parsed[bynr]";
														$linebuf=implode("~",$arrbuf);
														
														$sql="UPDATE $dbtable SET ops_code='$linebuf' WHERE patnum='$pn' AND op_nr='$opnr' AND dept='$dept' AND op_room='$oprm'";
        												if($ergebnis=mysql_query($sql,$link)) 
														{
															header("location:$thisfile?sid=$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1");
															exit;
														}
														else {print "<p>".$sql."<p>$LDDbNoWrite";};
													
													}
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
function openOPSsearch(k,x)
{
	urlholder="drg-ops301-search.php?sid=<?="$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&keyword="+k+"&showonly="+x;
	drgwin_<?=$uid ?>=window.open(urlholder,"drgwin_<?=$uid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?=$uid ?>.moveTo(100,100);
}
function openQuicklist(t)
{
	urlholder="drg-quicklist.php?sid=<?="$ck_sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&target="+t;
	drgwin_<?=$uid ?>=window.open(urlholder,"drgwin_<?=$uid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?=$uid ?>.moveTo(100,100);
}
function deleteItem(i)
{
	if(confirm("<?=$LDAlertSureDelete ?>"))
	{
		window.location.href='drg-ops301.php?sid=<?="$ck_sid&lang=$lang&mode=delete&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&display=$display" ?>&item='+i;
	}
}
function makeChange(v,i,m)
{
	//window.location.replace('<?="$thisfile?sid=$ck_sid&lang=$lang&mode=updatestat&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&display=$display" ?>&item='+i+'&val='+v);
	document.submitter.val.value=v;
	document.submitter.itemx.value=i;
	document.submitter.mode.value=m;
	document.submitter.submit();
}

// -->
</script>
 
  <? 
require("../req/css-a-hilitebu.php");
?>
 <? if($newsave) : ?>
 <script language="javascript" >
window.parent.opener.location.href='<?="oploginput.php?sid=$ck_sid&lang=$lang&mode=saveok&patnum=$pn&op_nr=$opnr&dept=$dept&saal=$oprm&pyear=$y&pmonth=$m&pday=$d" ?>';
</script>
<? endif ?>
</HEAD>

<BODY 
<?
if($display=="composite") print 'topmargin=0 marginheight=0 leftmargin=0 marginwidth=0';
else  print 'topmargin=2 marginheight=2';
?>
 onLoad="if(window.focus) window.focus()" bgcolor=<? print $cfg['body_bgcolor']; ?>
 bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<form>
<? if($display!="composite") : ?>
<a href="javascript:window.history.back()" ><img src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="right"></a>
<FONT    SIZE=3  FACE="verdana,Arial" color="#006600">
<b><?=$LDOps301 ?></b></font>&nbsp;
<!--  <input type="button" value="<?=$LDSearch4OPS301 ?>" onClick="javascript:openOPSsearch('','0')">&nbsp;
 <input type="button" value="<?=$LDQuickList ?>" onClick="javascript:openOPSsearch('','0')">
 --><? endif ?>

<table border=0 width=100%>
  <tr>
    <td width=100% valign="top">
	<table border=0 cellpadding=1 cellspacing=1 width=100%> 
		<tr bgcolor="#009900">
 		<td><font face=arial size=2 color=#ffffff><b><nobr><?=$LDOps301 ?></nobr></b></td>
 		<td ><font face=arial size=2 color=#ffffff><b><?=$LDDescription ?></b></td>
 		<td ><font face=arial size=2 color=#ffffff><b><?=$LDMainAuxOp ?></b></td>
 		<td ><font face=arial size=2 color=#ffffff><b><?=$LDLocalization ?></b></td>
 		<td><font face=arial size=2 color=#ffffff><b><?=$LDDoneBy ?></b></td>
<? if($display=="composite") : ?>
 		<td><font face=arial size=2 color=#ffffff>&nbsp;</td>
<? endif ?>
    	</tr>

<?
			if ($linecount>0) 
				{ 
						mysql_data_seek($ergebnis,0);
						$zeile=mysql_fetch_array($ergebnis);
						$linebuf=trim($zeile[ops_code]);
						if($linebuf)
						{
							$arrbuf=explode("~",trim($linebuf));
							array_unique($arrbuf);
							for($i=0;$i<sizeof($arrbuf); $i++)
							{
								parse_str(trim($arrbuf[$i]),$parsedline);
								if($parsedline[stat]=="1") $fcolor="#006600"; else $fcolor="#000000";
								print "<tr bgcolor=";
								if($toggle) { print "#efefef>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
								print '
								<td><font face=arial size=2><nobr><a href="javascript:openOPSsearch(\''.$parsedline[code].'\',\'1\')">'.stripslashes($parsedline[code]).'</a></nobr>
								</td>
								<td><font face=arial size=2 color="'.$fcolor.'">'.stripslashes($parsedline[des]).'
								</td>
								<td><font face=arial size=2  color="'.$fcolor.'">';
								if($parsedline[stat]=="1") print "<b>$LDMain</b>";
								elseif($display=="composite")
								{
?>
								<select name="opstat_<?=$i ?>"  onChange="makeChange(this.value,'<?=$i ?>','update_stat')">
 						       	<option value="1" <? if($parsedline[stat]=="1") print "selected"; ?>><?=$LDMain ?></option>
        						<option value="2" <? if(($parsedline[stat]=="2")||!$parsedline[stat]) print "selected"; ?>><?=$LDAux ?></option>
        						</select>
<?								
/*								<font face=arial size=2>'.stripslashes($parsedline[stat]).'
*/								
								}
								else print $LDAux;
							print '</td>
								<td>';
								if($display!="composite")
								{
									print '<font face=arial size=2  color="'.$fcolor.'">';
									switch($parsedline[loc])
									{
										case "r": print $LDRight; break;
										case "l": print $LDLeft; break;
										case "b": print $LDBoth; break;
									}
								}
								else
								{
?>
								<select name="local_<?=$i ?>"  onChange="makeChange(this.value,'<?=$i ?>','update_loc')">
        						<option value="">  </option>
 						       	<option value="r" <? if($parsedline[loc]=="r") print "selected"; ?>><?=$LDRight ?></option>
        						<option value="l" <? if($parsedline[loc]=="l") print "selected"; ?>><?=$LDLeft ?></option>
        						<option value="b" <? if($parsedline[loc]=="b") print "selected"; ?>><?=$LDBoth ?></option>
        						</select>
								
<?       
/*								<font face=arial size=2>'.stripslashes($parsedline[loc]).'
								*/
								}
								print '</td>								
								<td><font face=arial size=2>'.stripslashes($parsedline[byna]).' - '.$parsedline[bynr].'
								</td>';
								if($display=="composite")
								{ print '
									<td><a href="';
								print "javascript:deleteItem('$i')";
								print '"><img src="../img/delete2.gif" border=0 width=20 height=20 alt="'.$LDDeleteEntry.'" align="absmiddle"></a>
								</td>';
								}
								print "</tr>";
							}
						}
				}

?>
	</table>
	
	</td>
	<? if($display=="composite") : ?> 	 
	<td valign="top" bgcolor="#009900"><font face=arial size=2 color=#ffffff>
  
	<input type="button" value="<?=$LDSearch ?>" onClick="javascript:openOPSsearch('','0')">&nbsp;
 	<p><input type="button" value="<?=$LDQuickList ?>" onClick="javascript:openQuicklist('ops301')"><p><br><p>
	<a href="javascript:window.parent.close()" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24></a><p>

	</td>
	<? endif ?>  
	</tr>
</table>


</form>
<form name="submitter">
<input type="hidden" name="val" value="">
<input type="hidden" name="itemx" value="">
<input type="hidden" name="mode" value="">
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
<input type="hidden" name="y" value="<? print $y; ?>">
<input type="hidden" name="m" value="<? print $m; ?>">
<input type="hidden" name="d" value="<? print $d; ?>">
</form>

</FONT>


</FONT>


</BODY>
</HTML>
