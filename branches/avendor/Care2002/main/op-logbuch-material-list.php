<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");

$parsedstr=array();
$globdata="sid=$ck_sid&lang=$lang&op_nr=$op_nr&dept=$dept&saal=$saal&patnum=$patnum&pday=$pday&pmonth=$pmonth&pyear=$pyear";
// clean the input data
$material_nr=strtr($material_nr,"§%&?/\+*~#';:,!$","                ");// convert chars to (15) spaces
$material_nr=trim($material_nr);
//$material_nr=str_replace(" ","",$material_nr);

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
	  	$dbtable="nursing_op_logbook";
		$sql="SELECT material_codedlist FROM $dbtable 
					WHERE dept='$dept'
					AND op_room='$saal'
					AND op_nr='$op_nr'
					AND op_src_date='$pyear$pmonth$pday'
					AND patnum='$patnum'";
		if($mat_result=mysql_query($sql,$link))
       	{
			$matrows=0;
			while( $matlist=mysql_fetch_array($mat_result)) $matrows++;
			if($matrows==1)
			{
				mysql_data_seek($mat_result,0); //reset the variable
				$matlist=mysql_fetch_array($mat_result);
						//$datafound=1;
						//$pdata=mysql_fetch_array($ergebnis);
						//print $sql."<br>";
						//print $rows;
			}
					//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
		}
		else { print "$LDDbNoRead<br>"; } 

		switch($mode)	
		{
		case "search":
	  		$dbtable="pharma_products_main";
			
			
			if(!empty($material_nr))
			{
				if(is_numeric($material_nr)) 
				{
					$material_nr=(int) $material_nr; 
		 			$sql="SELECT bestellnum,artikelnum,artikelname,industrynum,generic,description FROM $dbtable WHERE artikelnum=$material_nr";
					$nonumeric=0;
				}
				else
				{ 
					if(strlen($material_nr)>3) $material_nr="%".$material_nr;
		 			$sql="SELECT bestellnum,artikelnum,artikelname,industrynum,generic,description FROM $dbtable 
							WHERE artikelnum LIKE '$material_nr%'
							OR bestellnum  LIKE '$material_nr%'
							OR artikelname  LIKE '$material_nr%'
							OR generic  LIKE '$material_nr%'
							OR description  LIKE '$material_nr%'
							OR industrynum  LIKE '$material_nr%'
							";
					$nonumeric=1;
				}
			}
			else break;
			//print $sql."<br>";
				if($ergebnis=mysql_query($sql,$link))
       			{
					$art_avail=0;
					while( $pdata=mysql_fetch_array($ergebnis)) $art_avail++;
					if($art_avail)	mysql_data_seek($ergebnis,0); //reset the variable
						//$datafound=1;
					if(($art_avail==1)&&(!$nonumeric))
					{
						$pdata=mysql_fetch_array($ergebnis);
						//if($nonumeric) $material_nr=$pdata[artikelnum];
						if(($matrows==1)&&($matlist[0]!=""))
						{
							$matbuf=explode("~",$matlist[0]);
							for($i=0;$i<sizeof($matbuf);$i++)
							{
								reset($parsedstr);
								parse_str(trim($matbuf[$i]),$parsedstr);
								if((int)$parsedstr[a]==$material_nr)
								{
									 $parsedstr[c]=$parsedstr[c]+1;
									 $matbuf[$i]="b=$parsedstr[b]&a=$parsedstr[a]&n=$parsedstr[n]&g=$parsedstr[g]&i=$parsedstr[i]&c=$parsedstr[c]\r\n";
									 $item_idx=$i;
									 //print $i."found ".$matbuf[$i]."<br>";
									 $listchg=1;
									 break;
								}
							}
							if(!$listchg)
							{
								$matbuf[$i]="b=$pdata[bestellnum]&a=$pdata[artikelnum]&n=$pdata[artikelname]&g=$pdata[generic]&i=$pdata[industrynum]&c=1\r\n";
								$item_idx=$i;
							}
    						$matlist[0]=implode("~",$matbuf);
						}
						else
						{
							$matlist[0]="b=$pdata[bestellnum]&a=$pdata[artikelnum]&n=$pdata[artikelname]&g=$pdata[generic]&i=$pdata[industrynum]&c=1\r\n";
							$item_idx=0;
						}
						
						$matlist[0]=strtr($matlist[0]," ","+");
						
						$dbtable="nursing_op_logbook";
						$sql="UPDATE $dbtable SET material_codedlist='$matlist[0]'
								WHERE dept='$dept'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND patnum='$patnum'";
						//print $sql;
						if($mat_result=mysql_query($sql,$link))
						{
							mysql_close($link);
  							header("location:op-logbuch-material-list.php?$globdata&item_idx=$item_idx&chg=1");
							exit;
						}	else { print "$LDDbNoSave<br>"; } 
						
						//print $sql."<br>";
						//print $rows;
					}
					//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
				}
				else { print "$LDDbNoRead<br>"; } 
				break;
		case "delete":
			//print "hello delete".$art_idx;
			$matbuf=explode("~",$matlist[0]);
			array_splice($matbuf,$art_idx,1);
			$matlist[0]=implode("~",$matbuf);
			$sql="UPDATE $dbtable SET material_codedlist='$matlist[0]'
								WHERE dept='$dept'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND patnum='$patnum'";
			//print $sql;
			if($mat_result=mysql_query($sql,$link))
			{
				mysql_close($link);
  				header("location:op-logbuch-material-list.php?$globdata");
				exit;
			}	else { print "$LDDbNoSave<br>"; } 
			break;
			
		case "update":
			$matbuf=explode("~",$matlist[0]);
			for($i=0;$i<sizeof($matbuf);$i++)
				{
					$pcs="pcs".$i;
					reset($parsedstr);
					parse_str(trim($matbuf[$i]),$parsedstr);
					$matbuf[$i]="b=$parsedstr[b]&a=$parsedstr[a]&n=$parsedstr[n]&g=$parsedstr[g]&i=$parsedstr[i]&c=".$$pcs."\r\n";
				}
			$matlist[0]=implode("~",$matbuf);
			$sql="UPDATE $dbtable SET material_codedlist='$matlist[0]'
								WHERE dept='$dept'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND patnum='$patnum'";
			//print "update ".$sql;
			if($mat_result=mysql_query($sql,$link))
			{
				mysql_close($link);
  				header("location:op-logbuch-material-list.php?$globdata");
				exit;
			}	else { print "$LDDbNosave<br>"; }  
			break;
		} //end of switch($mode
}
  else { print "$LDDbNoLink<br>"; } 


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <style type="text/css" name="s2">
.v12{ font-family:verdana,arial; color:#000000; font-size:12;}
.v12b{ font-family:verdana,arial; color:#cc0000; font-size:12;}
.v12g{ font-family:verdana,arial; color:#9f9f9f; font-size:12;}
</style>

<script language="javascript">
<!-- 

function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php?sid=<? print "$ck_sid&lang=$lang"; ?>&keyword="+b+"&mode=search&cat=pharma";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}
	
<? if(empty($material_nr)||($art_avail==1)) : ?>	
function delete_item(x)
{
	window.location.replace('op-logbuch-material-list.php?<? print $globdata; ?>&mode=delete&art_idx='+x);
}

// -->
</script>

<SCRIPT language="JavaScript">
<!--
function ssm(menuId){
	if (brwsVer>=4) {
		if (curSubMenu!='') hsm();
		if (document.all) {
			eval('document.all.'+menuId).style.visibility='visible';
		} else {
			eval('document.'+menuId).visibility='show';
		}
		curSubMenu=menuId;
	}
}
function hsm(){
	if(curSubMenu=="") return;
	else
	if (brwsVer>=4) {
		if (document.all) {
			eval('document.all.'+curSubMenu).style.visibility='hidden';
		} else {
			eval('document.'+curSubMenu).visibility='hide';
		}
		curSubMenu='';
	}
}
var brwsVer=parseInt(navigator.appVersion);var timer;var curSubMenu='';
<? endif ?>
// -->
</SCRIPT>

</head>
<body leftmargin=0 marginwidth=0>


<? 
if(empty($material_nr)||(($art_avail==1)&&(!$nonumeric)))
{
$matbuf=explode("~",trim($matlist[0]));
$rows=sizeof($matbuf);
if(($rows==1)&&(trim($matbuf[0])=="")) $rows=0;
if($rows)
{
print'
<form action="op-logbuch-material-list.php" method="post" name="plist" onReset="hsm()">
<table border=0 cellpadding=0 cellspacing=0 width="100%">
  <tr>';
  for($i=0;$i<sizeof($LDMaterialElements);$i++)
  print '
    <td class="v12b"><b>&nbsp;'.$LDMaterialElements[$i].'</b></td>';
	print '
  </tr>
   <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>

';
	for($i=0;$i<$rows;$i++)
	{
		reset($parsedstr);
		parse_str(trim($matbuf[$i]),$parsedstr);
		if(strstr($parsedstr[a],"?")) $f_class="v12g"; else $f_class="v12";
		print'
 	<tr ';
 		if (($chg)&&($i==$item_idx)) print 'bgcolor="#00cccc"';
 		print '
 		>
    <td class="'.$f_class.'">&nbsp;'.$parsedstr[a].'&nbsp;</td>
    <td class="'.$f_class.'">&nbsp;'.$parsedstr[n].'&nbsp;</td>
    <td class="'.$f_class.'">&nbsp;';
	if($f_class=="v12") print '<a href="javascript:popinfo('.$parsedstr[b].')"><img src="../img/info3.gif" alt="'.$LDDbInfo.'" width=16 height=16 border=0 ></a>';
		else print '<a href="#"><img src="../img/info3-pale.gif" alt="'.$LDArticleNoList.'" width=16 height=16 border=0 ></a>';
	print '
	&nbsp;</td>
    <td class="'.$f_class.'">&nbsp;'.$parsedstr[g].'&nbsp;</td>
    <td class="'.$f_class.'">&nbsp;'.$parsedstr[i].'&nbsp;</td>
    <td class="'.$f_class.'">&nbsp;<input type="text" name="pcs'.$i.'" size=1 maxlength=2 value="'.$parsedstr[c].'" onKeyUp="ssm(\'savebut\')">&nbsp;</td>
    <td class="'.$f_class.'">&nbsp;<a href="javascript:delete_item('.$i.')" title="'.$LDRemoveArticle.'"><img src="../img/delete2.gif" width=20 height=20 border=0></a>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>';
  }
  
  print '
</table>
<input type="hidden" name="sid" value="'.$ck_sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="op_nr" value="'.$op_nr.'">
<input type="hidden" name="patnum" value="'.$patnum.'">
<input type="hidden" name="dept" value="'.$dept.'">
<input type="hidden" name="saal" value="'.$saal.'">
<input type="hidden" name="pday" value="'.$pday.'">
<input type="hidden" name="pmonth" value="'.$pmonth.'">
<input type="hidden" name="pyear" value="'.$pyear.'">
</form>  

<DIV id=savebut
style=" VISIBILITY: hidden; POSITION: relative;">
<a href="javascript:document.plist.submit()" title="'.$LDSave.'"><img src="../img/'.$lang.'/'.$lang.'_savedisc.gif" width=99 height=24 border=0></a>&nbsp;&nbsp;&nbsp;
<a href="javascript:document.plist.reset()" title="'.$LDReset.'"><img src="../img/'.$lang.'/'.$lang.'_reset.gif" width=156 height=24 border=0>
</div>
  ';
}
}
else
{
	if($art_avail)
	{

		print '
			<font size=2 face="verdana,arial">
 			<font size=4 color="#009900">
 			<img src="../img/catr.gif" width=88 height=80 border=0 align=absmiddle> <b>'.$LDPlsClkArticle.'</b></font> 
			<br>';
		print'
			<table border=0 cellpadding=0 cellspacing=0 width="100%">
  			<tr>';
		for($i=0;$i<sizeof($LDSearchElements);$i++)
			print '
    		<td class="v12b"><b>'.$LDSearchElements[$i].'</b></td>';
		print '
   			<tr>
    		<td colspan=7 bgcolor="#0000ff"></td>
  			</tr>';
	while($pdata=mysql_fetch_array($ergebnis))
	{
		print'
 		<tr bgcolor="#ffffff">
    	<td class="v12" valign="top">&nbsp;<a href="op-logbuch-material-list.php?'.$globdata.'&mode=search&material_nr='.$pdata[artikelnum].'"><img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDSelectArticle.'"></a></td>
    	<td class="v12" valign="top">&nbsp;<a href="op-logbuch-material-list.php?'.$globdata.'&mode=search&material_nr='.$pdata[artikelnum].'" title="'.$LDSelectArticle.'">'.$pdata[artikelnum].'</a>&nbsp;</td>
    	<td class="v12" valign="top"><a href="op-logbuch-material-list.php?'.$globdata.'&mode=search&material_nr='.$pdata[artikelnum].'" title="'.$LDSelectArticle.'">'.$pdata[artikelname].'</a>&nbsp;</td>
    	<td class="v12" valign="top">'.$pdata[description].'&nbsp;</td>
   	 	<td class="v12" valign="top">&nbsp;<a href="javascript:popinfo(\''.$pdata[bestellnum].'\')"><img src="../img/info3.gif" alt="'.$LDDbInfo.'" width=16 height=16 border=0 ></a>&nbsp;</td>
    	<td class="v12" valign="top">&nbsp;'.$pdata[generic].'&nbsp;</td>
    	<td class="v12" valign="top">&nbsp;'.$pdata[industrynum].'&nbsp;</td>
  		</tr>
  		<tr>
    		<td colspan=7 bgcolor="#0000ff"></td>
  		</tr>';
 	 }
	print '
	  </table>';
			
	}
	else
	{
 		print '<center>
 			<font size=2 face="verdana,arial">
 			<font size=4 color="#cc0000">
 			<img src="../img/catr.gif" width=88 height=80 border=0 align=absmiddle> <b>'.$LDArticleNotFound.'</b><p></font> '.$LDNoArticleTxt.'<p>';
			$databuf="$ck_sid&lang=$lang&op_nr=$op_nr&dept=$dept&saal=$saal&patnum=$patnum&pday=$pday&pmonth=$pmonth&pyear=$pyear&artikelnum=$material_nr";
		print '
			<a href="op-logbuch-material-entry-manual.php?sid='.$databuf.'"><img src="../img/accessrights.gif" width=35 height=35 border=0 align=absmiddle> 
			<font size=3 > '.$LDClk2ManualEntry.'</font></a>
			</font><p>
			<a href="op-logbuch-material-list.php?sid='.$databuf.'"><img src="../img/'.$lang.'/'.$lang.'_cancel.gif" border="0" alt="'.$LDCancel.'">
			</a>
			</center>
			';
	}
}
?>

</body>
</html>
