<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");

$globdata="sid=$ck_sid&lang=$lang&op_nr=$op_nr&dept=$dept&saal=$saal&patnum=$patnum&pday=$pday&pmonth=$pmonth&pyear=$pyear";

if(($mode=="force_add")&&$containername&&$pcs)
{
include("../req/db-makelink.php");
if($link&&$DBLink_OK)  
	{	
	  	$dbtable="nursing_op_logbook";
		$sql="SELECT container_codedlist FROM $dbtable 
					WHERE dept='$dept'
					AND op_room='$saal'
					AND op_nr='$op_nr'
					AND op_src_date='$pyear$pmonth$pday'
					AND patnum='$patnum'";
		if($mat_result=mysql_query($sql,$link))
       	{
			$matrows=0;
			if( $matlist=mysql_fetch_array($mat_result)) $matrows++;
			if($matrows)
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
		else { print "$LDDbNoRead<br>$sql"; } 

		$newmat="b=?$bestellnum&a=?$containernum&n=$containername&i=$industrynum&c=$pcs\r\n";
		
						if(($matrows==1)&&($matlist[0]!=""))
						{
							$matlist[0]=$matlist[0]."~".$newmat;
							$item_idx=substr_count($matlist[0],"~");
						}
						else
						{
							$matlist[0]=$newmat;
							$item_idx=0;
						}
						
						$matlist[0]=strtr($matlist[0]," ","+");
						
						$dbtable="nursing_op_logbook";
						$sql="UPDATE $dbtable SET container_codedlist='$matlist[0]'
								WHERE dept='$dept'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND patnum='$patnum'";
						//print $sql;
						if($mat_result=mysql_query($sql,$link))
						{
  							header("location:op-logbuch-container-list.php?$globdata&item_idx=$item_idx&chg=1");
							exit;
						}	else { print "$LDDbNoSave<br>$sql"; } 
						
						//print $sql."<br>";
						//print $rows;
	}
  	else { print "$LDDbNoLink<br>"; } 
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <style type="text/css" name="s2">
.v12{ font-family:verdana,arial; color:#000000; font-size:12;}
.v12b{ font-family:verdana,arial; color:#cc0000; font-size:12;}
</style>

<script language="javascript">
<!-- 

function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php?sid=<? print "$ck_sid&lang=$lang"; ?>&keyword="+b+"&mode=search&cat=pharma";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}

// -->
</script>

<SCRIPT language="JavaScript">
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
</SCRIPT>

</head>
<body leftmargin=0 marginwidth=0>

<form name="plist" action="op-logbuch-container-entry-manual.php" method="post">
<table border=0>
<tr>
<?
  for($i=0;$i<sizeof($LDContainerElements);$i++)
  print '
    <td class="v12b"><b>&nbsp;'.$LDContainerElements[$i].'</b></td>';
?>
 <!--    <td class="v12b"><b>&nbsp;Art.Nr.</b></td>
    <td class="v12b"><b>Art.name</b></td>
    <td class="v12b"><b>Generic</b></td>
    <td class="v12b"><b>Zul.Nr.</b></td>
    <td class="v12b"><b>Anzahl</b></td> -->
  </tr>
   <tr>
    <td colspan=5 bgcolor="#0000ff"></td>
  </tr>
  <tr>
    <td><input type="text" name="containernum" size=15 maxlength=20 value="<?=$artikelnum ?>"></td>
    <td><input type="text" name="containername" size=25 maxlength=25></td>
    <td>&nbsp;</td>
    <td><input type="text" name="industrynum" size=15 maxlength=20></td>
    <td><input type="text" name="bestellnum" size=15 maxlength=20></td>
    <td><input type="text" name="pcs" size=1 maxlength=3></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="mode" value="force_add">
<input type="hidden" name="op_nr" value="<?=$op_nr ?>">
<input type="hidden" name="patnum" value="<?=$patnum ?>">
<input type="hidden" name="dept" value="<?=$dept ?>">
<input type="hidden" name="saal" value="<?=$saal ?>">
<input type="hidden" name="pday" value="<?=$pday ?>">
<input type="hidden" name="pmonth" value="<?=$pmonth ?>">
<input type="hidden" name="pyear" value="<?=$pyear ?>">
<p>
<input type="image" src="../img/<?="$lang/$lang" ?>_savedisc.gif" border=0 width=99 height=24 align="absmiddle" alt="<?=$LDSave ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.plist.reset()" title="<?=$LDReset ?>"><img src="../img/<?="$lang/$lang" ?>_reset.gif" width=156 height=24 border=0 align=absmiddle></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="op-logbuch-material-list.php?<?=$globdata ?>"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0 align=absmiddle alt="<?=$LDCancel ?>"></a>
</form>


</body>
</html>
