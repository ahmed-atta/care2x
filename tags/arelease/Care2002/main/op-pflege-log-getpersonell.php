<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");

$title=$LDOpPersonElements[$winid];
switch($winid)
{
	case "operator": 
							$stitle="O";
							break;
	case "assist": 
							$stitle="A";
							break;
	case "scrub": 
							$stitle="I";
							break;
	case "rotating": 
							$stitle="O";
							break;
	case "ana": 
							$element="an_doctor";
							//$maxelement=10;
							break;
	default:{header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

require("../req/config-color.php"); // load color preferences

$dbtable="personell_data";
$thisfile="op-pflege-log-getpersonell.php";
$forwardfile="op-pflege-log-getinfo.php?sid=$ck_sid&lang=$lang&winid=$winid&mode=save&patnum=$patnum&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday&op_nr=$op_nr";

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get data if exists
			$sql="SELECT * FROM $dbtable
					 WHERE lastname LIKE '$inputdata%'
					 OR firstname LIKE '$inputdata%'
					 OR bday LIKE '$inputdata%'
					 OR personell_nr LIKE '$inputdata%'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$datafound=1;
					//print $sql."<br>";
				}
			}
				else { print "$LDDbNoRead<br>"; } 
}
  else { print "$LDDbNoLink<br>"; } 


?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?=$title ?></TITLE>

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

  function pruf(d){
	if(!d.inputdata.value) return false;
	else return true
	}
function savedata(iln,ifn,inx,ipr)
{
	x=inx.selectedIndex;
	//urlholder="<?=$forwardfile ?>&ln="+ln+"&fn="+fn+"&nx="+d[x].value;
	//window.location.replace(urlholder);
	d=document.infoform;
	d.action="op-pflege-log-getinfo.php";
	d.ln.value=iln;
	d.fn.value=ifn;
	d.pr.value=ipr;
	d.nx.value=inx[x].value;
	d.inputdata.value="?";
	d.submit();
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

	
-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v13 { font-family:verdana,arial;font-size:13; }
.v13_n { font-family:verdana,arial;font-size:13;color:#0000cc }
.v10 { font-family:verdana,arial;font-size:10; }
</style>

</HEAD>
<BODY   bgcolor="#cde1ec" TEXT="#000000" LINK="#0000FF" VLINK="#800080" topmargin=2 marginheight=2 
onLoad="<? if($saved) print "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();document.infoform.inputdata.focus();" >
<a href="javascript:gethelp()"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 alt="<?=$LDHelp ?>" align="right"></a>

<form name="infoform" action="op-pflege-log-getpersonell.php" method="post" onSubmit="return pruf(this)">
<img src="../img/magnify.gif" width=68 height=73 border=0 align=absmiddle><font face=verdana,arial size=5 color=maroon>
<b>
<? 
	print str_replace("~tagword~",$title,$LDSearchPerson)."...";
	//print $tage[$dyidx]." ($dy".".".$mo.".".$yr.")</font>";
?>
</b>
</font>

<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
  <tr>
	<td  align=center bgcolor="#cfcfcf" class="v13_n" colspan=5><?=$LDSearchResult ?>:</td>
  </tr>
 <tr>
    <td align=center bgcolor="#ffffff" class="v13_n" >
<?=$LDLastName ?>
	</td> 
    <td align=center bgcolor="#ffffff" class="v13_n" >
<?=$LDName ?>

	</td> 
    <td align=center bgcolor="#ffffff"  class="v13_n" >
<?=$LDJobId ?>

	</td> 
    <td align=center bgcolor="#ffffff"   class="v13_n" >
<?="$LDOr $LDFunction" ?>
	</td> 
    <td align=center bgcolor="#ffffff"   class="v13_n" >

	</td> 
  </tr>	

<? if($datafound) : ?>

<? 	$counter=0;
		while($result=mysql_fetch_array($ergebnis))
		{
			print '
	  		<tr bgcolor="#ffffff">
    			<td class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$result[lastname].'\',\''.$result[firstname].'\',document.infoform.f'.$counter.',\''.$result[profession].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$result[lastname].'</a>
				</td> 
    			<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$result[lastname].'\',\''.$result[firstname].'\',document.infoform.f'.$counter.',\''.$result[profession].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$result[firstname].'</a>
				</td> 
    			<td class="v13" >
				&nbsp;'.$LDJobIdTag[$result[profession]].'
				</td> 
    			<td   class="v13" >
				<select name="f'.$counter.'">';
				for($i=1;$i<=($entrycount);$i++)
				{
					print '
    				<option value="'.$i.'" ';
					if($i==$entrycount) print "selected";
					print '>'.$title.' '.$i.'</option>';
				}
    			print '
				</select>
    
				</td> 
    			<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$result[lastname].'\',\''.$result[firstname].'\',document.infoform.f'.$counter.',\''.$result[profession].'\')"><img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 align=absmiddle>
				'.str_replace("~tagword~",$title,$LDUseData).'..</a>
				</td> 
    			
  				</tr>';
				$counter++;
		}
?>

<? else : ?>
  <tr>
    <td bgcolor="#ffffff"  colspan=5 align=center>
	
	<table border=0>
   <tr>
     <td><img src="../img/catr.gif" border=0 width=88 height=80 align=middle> </td>
     <td><font size=3 color=maroon face=verdana,arial>
	 <?=$LDSorryNotFound ?>
	</td>
   </tr>
 </table>
 
	
	
	</td> 

  </tr>	
<? endif ?>


  		<tr>
   			 <td  class="v12"  bgcolor="#cfcfcf" colspan=5>&nbsp;
		 </td>

		  </tr>
  		<tr>
   			 <td  class="v12"  bgcolor="#ffffff" colspan=5 align=center><br><p>
			<font size=3><b><?=str_replace("~tagword~",$title,$LDSearchNewPerson) ?>:</b>	<br>
			 <input type="text" name="inputdata" size=25 maxlength=30><br> <input type="submit" value="<?=$LDSearch ?>"><p><br>
			 </td>

		  </tr>
	 
		  </table>
</td>
  </tr>
</table>

<input type="hidden" name="encoder" value="<? print $ck_op_pflegelogbuch_user; ?>">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="winid" value="<?=$winid ?>">
<input type="hidden" name="pyear" value="<?=$pyear ?>">
<input type="hidden" name="pmonth" value="<?=$pmonth ?>">
<input type="hidden" name="pday" value="<?=$pday ?>">
<input type="hidden" name="dept" value="<?=$dept ?>">
<input type="hidden" name="saal" value="<?=$saal ?>">
<input type="hidden" name="op_nr" value="<?=$op_nr ?>">
<input type="hidden" name="patnum" value="<?=$patnum ?>">
<input type="hidden" name="title" value="<?=$title ?>">
<input type="hidden" name="entrycount" value="<?=$entrycount ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="ln" value="">
<input type="hidden" name="fn" value="">
<input type="hidden" name="pr" value="">
<input type="hidden" name="nx" value="">

</form>
<p>
<a href="<?="op-pflege-log-getinfo.php?sid=$ck_sid&lang=$lang&dept=$dept&saal=$saal&op_nr=$op_nr&patnum=$patnum&pday=$pday&pmonth=$pmonth&pyear=$pyear&winid=$winid";?>"><img src="../img/<?="$lang/$lang" ?>_back2.gif" border="0"  align="left">
</a><a href="javascript:window.close()">
<img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0" alt="<?=$LDClose ?>" align="right">
</a>

</BODY>

</HTML>
