<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if (!$internok&&!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
require("../req/config-color.php");

$toggler=0;

$pdata=array();
$template=array();
if(!$pyear) $pyear=date(Y);
if(!$pmonth) $pmonth=date(m);
if(strlen($pmonth)<2) $pmonth="0".$pmonth;
if(!$pday) $pday=date(d);
$md=$pday;
if (strlen($md)<2) $md="0".$md; 
/*
if($dept==NULL) $dept="plop";
if($saal==NULL) $saal="a";
*/
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
setcookie(firstentry,"1");


require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get orig data

	  		$dbtable="nursing_op_logbook";
		 	$sql="SELECT * FROM $dbtable 
					WHERE dept='$dept'
						AND op_room='$saal'
						AND op_date='".$pday.".".$pmonth.".".$pyear."'
						ORDER BY op_nr
						";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0); //reset the variable
					$datafound=1;
					//print $sql."<br>";
					//print $rows;
				}
				//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else { print "$LDDbNoRead<br>"; } 
		}
  		 else { print "$LDDbNoLink<br>"; } 


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 
 <script language=javascript src="../js/syncdeptsaal.js">
 </script>
 
 <script language=javascript>
 <!-- 
 function pruf(d)
{
 	if((d.dept.value=='<?print $dept; ?>')&&(d.saal.value=='<?print $saal;?>')) return false;
	window.top.LOGINPUT.location.replace('oploginput.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=chgdept&dept='+d.dept.value+'&saal='+d.saal.value);
	return true;
}
function getinfo(pid,pdata){
	urlholder="pflege-station-patientdaten.php?sid=<? print "$ck_sid&lang=$lang"; ?>&pn="+pid+"&patient=" + pdata + "&station=<? print "$dept&pday=$pday&pmonth=$pmonth&pyear=$pyear&op_shortcut=$ck_op_pflegelogbuch_user"; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}
 function initall(){
	d=window.parent.LOGINPUT.document.oppflegepatinfo.xx2;
	if(d) d.value="";
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

 // -->
 </script>
 
 <? if(!$datafound) : ?>
   <script language="javascript" src="../js/showhide-div.js">
</script>
<? endif ?>
 
 
</HEAD>

<BODY bgcolor=#666666 topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"
onLoad="window.location.replace('#<? if ($gotoid) print $gotoid; else print 'bot'; ?>');">


<CENTER>

<?
if ($pday<2)
{
 if ($pmonth<2)
	{
		$tm=12;
		$td=31;
		$ty=$pyear-1;
    }
 	else
	{
	 	$tm=$pmonth-1;
		if(strlen($tm)<2) $tm="0".$tm;
		//$td=31;
		//while (!checkdate($tm,$td,$pyear)) $td--;
		$td=date("t",mktime(0,0,0,$tm,1,$pyear));
	}
}
else 
{
	$td=$pday-1;
	if(strlen($td)<2) $td="0".$td;
	 $tm=$pmonth; 
	 $ty=$pyear;
}
	
$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");


print '
<table  cellpadding="3" cellspacing="1" border="0" width="100%">';	
		
print '
		<tr bgcolor=#999999><td colspan=2><nobr>
		<a href="oplogmain.php?sid='.$ck_sid.'&lang='.$lang.'&internok='.$internok.'&pyear='.$ty.'&pmonth='.$tm.'&pday='.$td.'&dept='.$dept.'&saal='.$saal.'" title="'.$td.'.'.$tm.'.'.$ty.'"><FONT  COLOR="white"  SIZE=2  FACE="Arial">&lt;&lt; '.$LDPrevDay.'</a></td>
		<td colspan=3 align=center><FONT  COLOR="white"  SIZE=4  FACE="Arial"> 
		<b>'.$opabt[$dept].' '.$LDRoom.'-'.strtoupper($saal).' ('.$md.'.'.$pmonth.'.'.$pyear.')</b></td>';
?>
		<td colspan=2>
		<nobr>
			<table cellpadding=0 cellspacing=0 border=0>	
			<form action="oplogmain.php" method="post" name="chgdept" onSubmit="return pruf(this)">
			<tr>
			<td>
				<input type="hidden" name="pyear" value="<?// print $pyear; ?>">
    			<input type="hidden" name="pmonth" value="<? //print $pmonth; ?>">
    			<input type="hidden" name="pday" value="<?// print $md; ?>">
    			<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
    			<input type="hidden" name="lang" value="<? print $lang; ?>">
    
				<select name="dept" size=1 onChange="syncDept(this,document.chgdept.saal)">
				<?
					while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " selected";
						print '> '.$v.'</option>';
					}
				?>
					
				</select>
			</td>
			<td>
				<select name="saal" size=1 onChange="syncSaal(this,document.chgdept.dept)">
				<?
					while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selected";
						print '> '.$x.'</option>';
					}
				?>
				</select>
			</td>
			<td>&nbsp;
			<input type="submit" value="<?=$LDChange ?>" >
   			</td>
			</tr></form>
			</table>
			</nobr>
<?		 
	print '
			</td>
			<td colspan=1 align=middle>
			<a href="javascript:gethelp(\'oplog.php\',\'create\',\'logmain\')"><img src="../img/frage.gif" border=0 width=15 height=15 alt="'.$LDHelp.'" align="absmiddle"></a></td>
			<td colspan=1 align=right>';



if(($pyear!=date(Y))||($pmonth!=date(m))||($md!=date(d)))
{

  if (checkdate($pmonth,$pday+1,$pyear))
  {
	$td=$pday+1;
	if(strlen($td)<2) $td="0".$td;
	$tm=$pmonth;
	$ty=$pyear;
		
  }
  else
  {
	$td="01";
		if ($pmonth<12){ $tm=$pmonth+1;if(strlen($m)<2) $tm="0".$tm; $ty=$pyear; }
			else {
					$tm="01";
					$ty=$pyear+1;
				}
  }

  print '
		<a href="oplogmain.php?sid='.$ck_sid.'&lang='.$lang.'&internok='.$internok.'&pyear='.$ty.'&pmonth='.$tm.'&pday='.$td.'&dept='.$dept.'&saal='.$saal.'" title="'.$td.'.'.$tm.'.'.$ty.'"><FONT  COLOR="white"  SIZE=2  FACE="Arial"><nobr>'.$LDNextDay.' &gt;&gt;</a>';
}

print '
		</td></tr>';

if($datafound)
{
print '
<tr bgcolor="#f9f9f9" >';
while(list($x,$v)=each($LDOpMainElements))
	print '
		<td><font face="verdana,arial" size="1"><b>&nbsp;'.$v.'</b></td>';

print '
</tr>';
}

while($pdata=mysql_fetch_array($ergebnis))
	{
	if ($toggler==0) 
		{ print '
		<tr bgcolor="#fdfdfd">'; $toggler=1;} 
		else { print '
		<tr bgcolor="#fdfdfd">'; $toggler=0;}
	print '<a name="'.$pdata['op_nr'].'"></a>
	<td valign=top><font face="verdana,arial" size="1" ><font size=2 color=red><b>'.$pdata['op_nr'].'</b></font>
	<hr>'.$pdata['op_date'].'<br>
	'.$tage[date(w,mktime(0,0,0,$pmonth,$pday,$pyear))].'<br>
	<a href="oploginput.php?sid='.$ck_sid.'&lang='.$lang.'&internok='.$internok.'&mode=edit&patnum='.$pdata[patnum].'&dept='.$dept.'&saal='.$saal.'&op_nr='.$pdata[op_nr].'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'" target="LOGINPUT" >
	<img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.str_replace("~tagword~",$pdata['lastname'],$LDEditPatientData).'"></a>
	</td>';
	print '
	<td valign=top><nobr><font face="verdana,arial" size="1" color=blue>
	<a href="javascript:getinfo(\''.$pdata[patnum].'\')">
	<img src="../img/info2.gif" width=16 height=16 border=0 alt="'.str_replace("~tagword~",$pdata['lastname'],$LDOpenPatientFolder).'"></a> '.$pdata['patnum'].'<br>';
	print '
	<font color=black><b>'.$pdata['lastname'].', '.$pdata['firstname'].'</b><br>'.$pdata['bday'].'<br>'.nl2br(stripcslashes($pdata['address'])).'</td>';
	print '
	<td valign=top width=150><font face="verdana,arial" size="1" >';
	print '
	<font color="#cc0000">'.$LDOpMainElements[diagnosis].':</font><br>';
	print nl2br($pdata['diagnosis']);
	print '
	</td><td valign=top><font face="verdana,arial" size="1" ><nobr>';
	
	$ebuf=array("operator","assistant","scrub_nurse","rotating_nurse");
	//$tbuf=array("O","A","I","S");
	//$cbuf=array("Operateur","Assistent","Instrumenteur","Springer");
	for($n=0;$n<sizeof($ebuf);$n++)
	{
		if(!$pdata[$ebuf[$n]]) continue;
		print '<font color="#cc0000">'.$cbuf[$n].'</font><br>';
		$dbuf=explode("~",$pdata[$ebuf[$n]]);
		for($i=0;$i<sizeof($dbuf);$i++)
		{
			parse_str(trim($dbuf[$i]),$elems);
			if($elems[n]=="") continue;
			else print '&nbsp;'.$elems[n]." ".$tbuf[$n].$elems[x]."<br>";
		}
	}	
		
	print '
	</td>
	<td valign=top><font face="verdana,arial" size="1" >'.$LDAnaTypes[$pdata['anesthesia']].'<p>';
	if($pdata[an_doctor])
		{ 
			print '<font color="#cc0000">'.$LDAnaDoc.'</font><br><font color="#000000">';
			$dbuf=explode("~",$pdata[an_doctor]);
			for($i=0;$i<sizeof($dbuf);$i++)
			{
				parse_str(trim($dbuf[$i]),$elems);
				if($elems[n]=="") continue;
				else print '&nbsp;'.$elems[n].' '.$LDAnaPrefix.$elems[x].'<br>';
			}
			print '</font>';
		}
		
	 $eo=explode("~",$pdata[entry_out]);
	for($i=0;$i<sizeof($eo);$i++)
	{
	parse_str($eo[$i],$eobuf);
	if(trim($eobuf[s])) break;
	}
	 $cc=explode("~",$pdata[cut_close]);
	for($i=0;$i<sizeof($cc);$i++)
	{
	parse_str($cc[$i],$ccbuf);
	if(trim($ccbuf[s])) break;
	}


	print '
	</td>
	<td valign=top><font face="verdana,arial" size="1" >';
	print '<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpCut.':</font><br>'.$ccbuf[s].'<p>
	<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpClose.':</font><br>'.$ccbuf[e].'</td>';
	print '
	<td valign=top><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements[therapy].':<font color=black><br>'.nl2br($pdata['op_therapy']).'</td>';
	print '
	<td valign=top><nobr><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements[result].':<br>';
	print '<font color=black>'.nl2br($pdata['result_info']).'</td>';
	print '
	<td valign=top><font face="verdana,arial" size="1" >';
	print '<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpIn.':</font><br>'.$eobuf[s].'<p>
	<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpOut.':</font><br>'.$eobuf[e].'</td>';
	print '
	</tr>';

	}

print '
</table>';

if(!$datafound)
{
	print '<p>';
	if ($pyear.$pmonth.$pday != date(Y).date(m).date(d))
	{
	print '
			<MAP NAME="catcom">
			<AREA SHAPE="RECT" COORDS="116,87,191,109" HREF="javascript:ssm(\'dLogoTable\'); clearTimeout(timer)"  onmouseout="timer=setTimeout(\'hsm()\',1000)">
			<AREA SHAPE="RECT" COORDS="232,87,308,110" HREF="op-pflege-logbuch-xtsuch-start.php?sid='.$ck_sid.'&lang='.$lang.'&mode=fresh&dept='.$dept.'&saal='.$saal.'&child=1"  target="_parent"  title="'.$LDSearchPatient.' ['.$LDOrLogBook.']" >
			</MAP><img ismap usemap="#catcom" src="../img/'.$lang.'/'.$lang.'_cat-com2.gif" border=0>
			<DIV id=dLogoTable style=" VISIBILITY: hidden; POSITION: relative">
			<table border=0 bgcolor="#33333" cellspacing=0 cellpadding=1>
     		<tr>
       		<td>
				<table border=0 bgcolor="#ffffee" >
     				<tr>
       				<td><font size=2 face="verdana,arial">
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout(\'hsm()\',500)" ><img src="../img/redpfeil.gif" width=4 height=7 border=0> '.$LDShowPrevLog.'</a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout(\'hsm()\',500)" ><img src="../img/redpfeil.gif" width=4 height=7 border=0> '.$LDShowNextLog.'</a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout(\'hsm()\',500)" ><img src="../img/redpfeil.gif" width=4 height=7 border=0> '.$LDShowGuideCal.'</a>&nbsp;<br></font>
	   				</td>
     				</tr>
  		 </table>
	
	   		</td>
     		</tr>
  		 </table>
		 </DIV>';
	
		/*print '<img src="../img/'.$lang.'/'.$lang.'_cat-com2.gif">';*/
	}
	elseif(!$firstentry)
	{
		if($ck_login_logged) $buffy=str_replace(" ","+",$ck_login_username); 
			else $buffy=str_replace(" ","+",$ck_op_pflegelogbuch_user);
		 print '<img src="../imgcreator/catcom.php?lang='.$lang.'&person='.$buffy.'">';
		 }

}
?>

<a name="bot"></a>


</BODY>
</HTML>
