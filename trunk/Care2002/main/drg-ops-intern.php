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
require_once($root_path.'include/inc_config_color.php');

$toggle=0;

if($opnr)
{
	if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok)
	{	
	       /* Load the date formatter */
           include_once($root_path.'include/inc_date_format_functions.php');
           
	   
				$dbtable='care_nursing_op_logbook';
				
				$sql="SELECT ops_intern_code  FROM $dbtable WHERE op_nr='$opnr' AND encounter_nr='$pn' AND dept_nr='$dept_nr' AND op_room='$oprm'";
				
        		$ergebnis=$db->Execute($sql);
				$linecount=0;
				if($ergebnis)
       			{
					if($linecount=$ergebnis->RecordCount())
					{
						switch($mode)
						{
							case 'delete': 
												$zeile=$ergebnis->FetchRow();
												$linebuf=trim($zeile['ops_intern_code']);
												if($linebuf=='') break;
												$arrbuf=explode('~',$linebuf);
												array_unique($arrbuf);
												array_splice($arrbuf,$item,1);
												$linebuf=addslashes(implode('~',$arrbuf));
												$sql="UPDATE $dbtable SET ops_intern_code='$linebuf' WHERE patnum='$pn' AND op_nr='$opnr' AND dept='$dept' AND op_room='$oprm'";
        										if($ergebnis=$db->Execute($sql)) 
												{
													header("location:drg-ops-intern.php?sid=$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1");
													exit;
												}
												else {echo "<p>".$sql."<p>$LDDbNoWrite";};
											break;
						}
					}
				}
				 else {echo "<p>".$sql."<p>$LDDbNoRead";};
	}
}
$uid="$dept_$oprm_$pn_$opnr"; 
/* Load the icon images */
$img_delete=createComIcon($root_path,'delete2.gif','0','right');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
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
function openOPSsearch()
{
	urlholder="drg-ops-intern-search.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>";
	drgwin_<?php echo $uid ?>=window.open(urlholder,"drgwin_<?php echo $uid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?php echo $uid ?>.moveTo(100,100);
}
function deleteItem(i)
{
	if(confirm("<?php echo $LDAlertSureDelete ?>"))
	{
		window.location.href='drg-ops-intern.php?sid=<?php echo "$sid&lang=$lang&mode=delete&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm&display=$display" ?>&item='+i;
	}
}
function openQuicklist(t)
{
	urlholder="drg-quicklist.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&target="+t;
	drgwin_<?php echo $uid ?>=window.open(urlholder,"drgwin_<?php echo $uid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?php echo $uid ?>.moveTo(100,100);
}
function openRelatedCodes()
{
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width-75;
			h=window.parent.screen.height-50;';
	else
	echo '
			w=800;
			h=650;';
?>

	mc=document.ops_intern.maincode.value;
	relcodewin_<?php echo $uid ?>=window.open("drg-related-codes.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept=$dept&oprm=$oprm" ?>&maincode="+mc,"relcodewin_<?php echo $uid ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.relcodewin_<?php echo $uid ?>.moveTo(0,0);
}

// -->
</script>
 
  <?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 <?php if($newsave) : ?>
 <script language="javascript" >
 //window.opener.location.href='drg-composite-start.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
window.parent.opener.location.href='<?php echo "oploginput.php?sid=$sid&lang=$lang&mode=saveok&patnum=$pn&op_nr=$opnr&dept=$dept&saal=$oprm&pyear=$y&pmonth=$m&pday=$d" ?>';
</script>
<?php endif ?>
</HEAD>

<BODY 
<?php if($display=="composite") echo 'topmargin=0 marginheight=0 leftmargin=0 marginwidth=0';
else  echo 'topmargin=2 marginheight=2';
?> 
onLoad="if(window.focus) window.focus();" bgcolor="<?php echo $cfg['body_bgcolor']; ?>" 
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<form name="ops_intern" action="drg-ops-intern.php" method="post">
<FONT    SIZE=2  FACE="verdana,Arial" >
<?php echo "$ln, $fn ".formatDate2Local($bd,$date_format)." - $pn";
	if($opnr) echo" - OP# $opnr - $dept OP $oprm"; 
?>
<?php if($display!="composite") : ?>
<a href="javascript:window.history.back()" ><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?> width=110 height=24 align="right"></a>

<b><?php echo $LDOps301 ?></b></font>&nbsp;
 <input type="button" value="<?php echo $LDSearch4OPS301 ?>" onClick="javascript:openOPSsearch()">&nbsp;
 <input type="button" value="<?php echo $LDQuickList ?>" onClick="javascript:openICDsearch()">
<p>
<?php endif ?>

<table border=0 width=100%>
  <tr>
    <td width=100% valign="top">
	<table border=0 cellpadding=1 cellspacing=1 width=100%> 
		<tr bgcolor="#990000">
 		<td width="15%"><font face=arial size=2 color=#ffffff><b><?php echo $LDOpsIntern ?></b></td>
 		<td colspan=2><font face=arial size=2 color=#ffffff><b><?php echo $LDOperation ?></b></td>
    	</tr>

<?php
if ($linecount>0) 
				{ 
						mysql_data_seek($ergebnis,0);
						
						$zeile=$ergebnis->FetchRow();
						
						$linebuf=trim($zeile[ops_intern_code]);
						
						if($linebuf)
						{
							$arrbuf=explode('~',trim($linebuf));
							
							array_unique($arrbuf);
							
							for($i=0;$i<sizeof($arrbuf); $i++)
							{
								parse_str(trim($arrbuf[$i]),$parsedline);
								
								if($i==0) $main_code=$parsedline[code];
								
								echo '<tr bgcolor=';
								
								if($toggle) { echo '#efefef>'; $toggle=0;} else {echo '#ffffff>'; $toggle=1;};
								
								echo '
									<td><font face=arial size=2>'.stripslashes($parsedline[code]).'
									</td>
									<td><font face=arial size=2>'.stripslashes($parsedline[des]).'
									</td>
									<td><a href="';
								
								echo 'javascript:deleteItem(\''.$i.'\')';
								
								echo '"><img '.$img_delete.' alt="'.$LDDeleteEntry.'"></a>
									</td>';
									
								echo '</tr>';
							}
						}
				}

?>
	</table>
	
	</td>
	 <td valign="top" bgcolor="#990000"><font face=arial size=2 color=#ffffff>
	<?php if($display!="composite") : ?>   
	<a href="javascript:window.history.back()" ><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?> width=110 height=24></a>
 	<p>
	<?php else : ?>
	<input type="button" value="<?php echo $LDSearch ?>" onClick="javascript:openOPSsearch()">&nbsp;
 	<p><input type="button" value="<?php echo $LDQuickList ?>" onClick="javascript:openQuicklist('ops-intern')">
	<?php endif ?>
 	<p><input type="button" value="<?php echo $LDConvert2IcdOps ?>" onClick="javascript:openRelatedCodes()"><p>
	</td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="opnr" value="<?php echo $opnr ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="ln" value="<?php echo $ln ?>">
<input type="hidden" name="fn" value="<?php echo $fn ?>">
<input type="hidden" name="bd" value="<?php echo $bd ?>">
<input type="hidden" name="display" value="<?php echo $display ?>">
<input type="hidden" name="maincode" value="<?php echo $main_code ?>">

</form>

</FONT>


</FONT>


</BODY>
</HTML>
