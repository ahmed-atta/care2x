<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","drg.php");
$local_user="ck_op_pflegelogbuch_user";
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$toggle=0;

if($opnr)
{
	include("../include/inc_db_makelink.php");
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
													header("location:drg-ops301.php?sid=$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1");
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
															header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1");
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
															header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1");
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
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
function openOPSsearch(k,x)
{
	urlholder="drg-ops301-search.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&keyword="+k+"&showonly="+x;
	drgwin_<?php echo $uid ?>=window.open(urlholder,"drgwin_<?php echo $uid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?php echo $uid ?>.moveTo(100,100);
}
function openQuicklist(t)
{
	urlholder="drg-quicklist.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&target="+t;
	drgwin_<?php echo $uid ?>=window.open(urlholder,"drgwin_<?php echo $uid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?php echo $uid ?>.moveTo(100,100);
}
function deleteItem(i)
{
	if(confirm("<?php echo $LDAlertSureDelete ?>"))
	{
		window.location.href='drg-ops301.php?sid=<?php echo "$sid&lang=$lang&mode=delete&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&display=$display" ?>&item='+i;
	}
}
function makeChange(v,i,m)
{
	//window.location.replace('<?php echo "$thisfile?sid=$sid&lang=$lang&mode=updatestat&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&display=$display" ?>&item='+i+'&val='+v);
	document.submitter.val.value=v;
	document.submitter.itemx.value=i;
	document.submitter.mode.value=m;
	document.submitter.submit();
}

// -->
</script>
 
  <?php 
require("../include/inc_css_a_hilitebu.php");
?>
 <?php if($newsave) : ?>
 <script language="javascript" >
window.parent.opener.location.href='<?php echo "oploginput.php?sid=$sid&lang=$lang&mode=saveok&patnum=$pn&op_nr=$opnr&dept=$dept&saal=$oprm&pyear=$y&pmonth=$m&pday=$d" ?>';
</script>
<?php endif ?>
</HEAD>

<BODY 
<?php if($display=="composite") print 'topmargin=0 marginheight=0 leftmargin=0 marginwidth=0';
else  print 'topmargin=2 marginheight=2';
?>
 onLoad="if(window.focus) window.focus()" bgcolor=<?php print $cfg['body_bgcolor']; ?>
 bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<form>
<?php if($display!="composite") : ?>
<a href="javascript:window.history.back()" ><img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="right"></a>
<FONT    SIZE=3  FACE="verdana,Arial" color="#006600">
<b><?php echo $LDOps301 ?></b></font>&nbsp;
<!--  <input type="button" value="<?php echo $LDSearch4OPS301 ?>" onClick="javascript:openOPSsearch('','0')">&nbsp;
 <input type="button" value="<?php echo $LDQuickList ?>" onClick="javascript:openOPSsearch('','0')">
 --><?php endif ?>

<table border=0 width=100%>
  <tr>
    <td width=100% valign="top">
	<table border=0 cellpadding=1 cellspacing=1 width=100%> 
		<tr bgcolor="#009900">
 		<td><font face=arial size=2 color=#ffffff><b><nobr><?php echo $LDOps301 ?></nobr></b></td>
 		<td ><font face=arial size=2 color=#ffffff><b><?php echo $LDDescription ?></b></td>
 		<td ><font face=arial size=2 color=#ffffff><b><?php echo $LDMainAuxOp ?></b></td>
 		<td ><font face=arial size=2 color=#ffffff><b><?php echo $LDLocalization ?></b></td>
 		<td><font face=arial size=2 color=#ffffff><b><?php echo $LDDoneBy ?></b></td>
<?php if($display=="composite") : ?>
 		<td><font face=arial size=2 color=#ffffff>&nbsp;</td>
<?php endif ?>
    	</tr>

<?php
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
								<select name="opstat_<?php echo $i ?>"  onChange="makeChange(this.value,'<?php echo $i ?>','update_stat')">
 						       	<option value="1" <?php if($parsedline[stat]=="1") print "selected"; ?>><?php echo $LDMain ?></option>
        						<option value="2" <?php if(($parsedline[stat]=="2")||!$parsedline[stat]) print "selected"; ?>><?php echo $LDAux ?></option>
        						</select>
<?php
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
								<select name="local_<?php echo $i ?>"  onChange="makeChange(this.value,'<?php echo $i ?>','update_loc')">
        						<option value="">  </option>
 						       	<option value="r" <?php if($parsedline[loc]=="r") print "selected"; ?>><?php echo $LDRight ?></option>
        						<option value="l" <?php if($parsedline[loc]=="l") print "selected"; ?>><?php echo $LDLeft ?></option>
        						<option value="b" <?php if($parsedline[loc]=="b") print "selected"; ?>><?php echo $LDBoth ?></option>
        						</select>
								
<?php       
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
	<?php if($display=="composite") : ?> 	 
	<td valign="top" bgcolor="#009900"><font face=arial size=2 color=#ffffff>
  
	<input type="button" value="<?php echo $LDSearch ?>" onClick="javascript:openOPSsearch('','0')">&nbsp;
 	<p><input type="button" value="<?php echo $LDQuickList ?>" onClick="javascript:openQuicklist('ops301')"><p><br><p>
	<a href="javascript:window.parent.close()" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24></a><p>

	</td>
	<?php endif ?>  
	</tr>
</table>


</form>
<form name="submitter">
<input type="hidden" name="val" value="">
<input type="hidden" name="itemx" value="">
<input type="hidden" name="mode" value="">
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
<input type="hidden" name="y" value="<?php print $y; ?>">
<input type="hidden" name="m" value="<?php print $m; ?>">
<input type="hidden" name="d" value="<?php print $d; ?>">
</form>

</FONT>


</FONT>


</BODY>
</HTML>
