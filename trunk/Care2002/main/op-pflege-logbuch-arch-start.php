<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","or.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

if (!$internok&&!$HTTP_COOKIE_VARS["ck_op_pflegelogbuch_user".$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");
//setcookie(op_pflegelogbuch_user,$user);
$thisfile="op-pflege-logbuch-arch-start.php";
$breakfile="javascript:window.close()";

require("../include/inc_config_color.php");


/********************************* Resolve the department and op room ***********************/
require("../include/inc_resolve_opr_dept.php");

$pdata=array();
$filetitles=array();
$template=array();

if($pyear=="") $pyear=date(Y);
if($pmonth=="") $pmonth=date(m);
if(strlen($pmonth)<2) $pmonth="0".$pmonth;
if($pday=="") $pday=date(d);
if(strlen($pday)<2) $pday="0".$pday;

//$pyear=2001;
//$pmonth=04;
//$pday=8;

function yesterday(&$fd,&$fm,&$fy,$minyr)
{
	if ($fd<2)
		{
			if ($fm<2)
				{
					if($fy<$minyr) //minimum year allowed is minyr - 1
						{
							return false;
						}
						else	
							{
								$fy=$fy-1; $fm=12; $fd=31;
							}
	 			}
	 			else	
	 				{
						$fm=$fm-1;
						$fd=date("t",mktime(0,0,0,$fm,1,$fy)) ;
					}
		}
		else 
			{
				$fd=$fd-1;
			}
	if (strlen($fd)==1) $fd="0".$fd; 
	if (strlen($fm)==1) $fm="0".$fm;
	return true;
}

function tomorrow(&$fd,&$fm,&$fy,$maxyr)
{
	if($fd<(date("t",mktime(0,0,0,$fm,1,$fy))))
	{
		$fd++;
	}
	else
	{
		if($fm<12)
		{
			$fm++;
			$fd="01";
		}
		else 
		{
			$fy++;
			$fm="01";
			$fd="01";
		}
	}
	/*
	if (checkdate($fm,$fd+1,$fy))
	{
		$fd=$fd+1;
	}
	else
	{
		$fd=1;
			if ($fm<12){ $fm=$fm+1;}
				else {
							if($fy<$maxyr)
							{
								$fm=1;
								$fy=$fy+1;
							}
							else return false;
						}
	}
	*/
	if (strlen($fd)==1) $fd="0".$fd; 
	if (strlen($fm)==1) $fm="0".$fm;
	return true;
}
	
	
$md=$pday;
if (strlen($md)==1) $md="0".$md; 


setcookie(firstentry,"1");

$dbtable="nursing_op_logbook";

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK)
	{	
	// get orig data
		$sql="SELECT  op_src_date FROM $dbtable 
					WHERE dept='$dept'
						AND op_room='$saal' ORDER BY op_src_date DESC";
	
		if($ergebnis=mysql_query($sql,$link))
       	{
			$maxelem=0;
			while($plast=mysql_fetch_array($ergebnis)) $maxelem++;
			if($maxelem)
			{
				mysql_data_seek($ergebnis,0); //reset the variable
				$plast=mysql_fetch_array($ergebnis);
				//print $sql."<br>";
				
		 		$sql="SELECT  * FROM $dbtable 
							WHERE dept='$dept'
							AND op_room='$saal'
							AND op_date='$pday.$pmonth.$pyear' ORDER BY op_nr 
									";

				if($ergebnis=mysql_query($sql,$link))
       			{
					$rows=0;
					while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
					if($rows)
					{
						mysql_data_seek($ergebnis,0); //reset the variable
						$datafound=1;
					}
					elseif(!$nogetlast)
					{
		 		
						//print $rows;
					 
						 $sql="SELECT * FROM $dbtable 
							WHERE dept='$dept'
								AND op_room='$saal' 
								AND op_src_date='$plast[op_src_date]'
								ORDER BY op_nr ";
						//print $sql;
						if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=0;
								while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
									mysql_data_seek($ergebnis,0); //reset the variable
									$datafound=1;
									$pday=substr($plast[op_src_date],6,2);
									$md=$pday;
									$pmonth=substr($plast[op_src_date],4,2);
									$pyear=substr($plast[op_src_date],0,4);
									//print $sql."<br>";
									//print $rows;
								}
							}
							//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 	
						}
							//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 

					}
					else print "<p>".$sql."<p>$LDDbNoRead"; 
				}
		}
			else print "<p>".$sql."<p>$LDDbNoRead"; 		
  } else { print "$LDDbNoLink $sql<br>"; }

$past=0;
$validyr=true;
$td=$md;
$tm=$pmonth;
$ty=$pyear;

	$tz=date(z,mktime(0,0,0,date(m),date(j),date(Y)));
	$cz=date(z,mktime(0,0,0,$pmonth,(int)$pday,$pyear));
	//print $tz." ".$cz;
	$dif=$tz-$cz;

	if(($datafound)&&($plast[op_src_date]==$pyear.$pmonth.$pday)) $lastlog=1; else $lastlog=0;

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?php echo "$LDArchive - $LDOrLogBook" ?></TITLE>

<script  language="javascript">
<!-- 

function syncDept(d)
{
	var s=document.chgdept.saal;
	//alert(d.value);
	switch(d.value)
	{
		case "plop": s.options[0].selected=true;break;
		case "hnop": s.options[10].selected=true;break;
		case "gyn_op": s.options[3].selected=true;break;
		case "allg_op": s.options[2].selected=true;break;
		case "unfall_op": s.options[8].selected=true;break;
		case "augen_op": s.options[16].selected=true;break;
		default: s.options[0].selected=true;
	}
	
}

function syncSaal(d)
{
	var v=d.value;
	var s=document.chgdept.dept;
	if((v=="a")||(v=="b")||(v=="11")||(v=="12")) s.options[0].selected=true;
	if((v=="9")||(v=="10")) s.options[1].selected=true;
	if((v=="1")||(v=="4")||(v=="5")||(v=="6")) s.options[2].selected=true;
	if((v=="7")||(v=="8")) s.options[3].selected=true;
	if((v=="2")||(v=="3")||(v=="13")||(v=="14")) s.options[4].selected=true;
	if(v=="15") s.options[5].selected=true;

}

function pruf(d)
{
	if((d.dept.value=="<?php echo $dept;?>")&&(d.saal.value=="<?php echo $saal;?>")) return false;
	return true;
}
<?php if ($datafound) : ?>
function openeditwin(filename,y,m,d)
{
	url="op-pflege-logbuch-arch-edit.php?mode=edit&fileid="+filename+"&sid=<?php print $sid; ?>&user=<?php echo str_replace(" ","+",$user); ?>&pyear="+y+"&pmonth="+m+"&pday="+d+"&dept=<?php echo $dept;?>&saal=<?php echo $saal;?>";
	
	w=window.parent.screen.width;
	h=window.parent.screen.height;
	archeditwin=window.open(url,"editwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=400");
	window.archeditwin.moveTo(0,0);
}

function getinfo(pid,pdata){
	urlholder="pflege-station-patientdaten.php?sid=<?php print $sid; ?>&pn="+pid+"&patient=" + pdata + "&station=<?php print "$dept&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}
<?php endif ?>	
	
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

// -->
</script>

	<script language="javascript" src="../js/hilitebu.js">
	</script>

<STYLE TYPE="text/css">
<?php if($cfg['dhtml'])
{ print' 
	A:link  {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	';
}
?>

div.cats{
	position: absolute;

	right: 10;
	top: 80;
}

</style>
<?php if(!$datafound) : ?>
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
<?php endif ?>

</HEAD>

<BODY   topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php  print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; }
 if(!$nofocus) print ' onLoad="if (window.focus) window.focus();"';
?>>

<table width=100% border=0 cellspacing="0"  cellpadding=0>

<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrLogBook $LDArchive " ?>- </STRONG>
<font size=+1><?php print $opabt[$dept]." $LDRoom $saal"; ?></font></font>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<!-- <a href="javascript:window.history.back()"><img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" width=110 height=24 border=0  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --><a href="javascript:gethelp('oplog.php','arch','<?php echo $dif ?>','<?php echo $lastlog ?>','<?php echo $datafound ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td>
</tr>
<tr>
<td colspan=3  bgcolor=<?php print $cfg['body_bgcolor']; ?>>
<FONT    SIZE=-1  FACE="Arial">

<?php
if($lastlog)
{


if($maxelem)
{
if($rows>1) print $LDLastEntryMany;
 else
	print $LDLastEntry;
	switch($dif)
	{
		case 0: print ": $LDFrom <font color=red>$LDToday</font>."; break;
		case 1: print ": $LDFrom <font color=red>$LDYesterday</font>.";break;
		case 2: print ": $LDFrom <font color=red>$LDVorYesterday</font>.";break;
		default:print ": $LDFromMany <font color=red>$dif $LDDays</font>.";
	}
}
} // end of if datafound



print '
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#999999" width="100%">
		<tr><td>
		<table  cellpadding="3" cellspacing="1" border="0" width="100%">';	
print '
		<tr bgcolor="#999999"><td colspan=2><nobr>';
		
		$pd=$td;
		$pm=$tm;
		$py=$ty;
		$vyr=yesterday($pd,$pm,$py,2000);
		

		
if(($vyr&&$maxelem))
{ 	
	print '
			<a href="op-pflege-logbuch-arch-start.php?sid='.$sid.'&lang='.$lang.'&nogetlast=1&dept='.$dept.'&saal='.$saal.'&pyear='.$py.'&pmonth='.$pm.'&pday='.$pd.'&noseek=1" 
			title="'.$pd.'.'.$pm.'.'.$py.'">
			<FONT  COLOR="white"  SIZE=2  FACE="Arial">&lt;&lt; '.$LDPrevDay.'</a>';
}

print '				
		</td><td colspan=5 align=center><FONT  COLOR="white"  SIZE=4  FACE="Arial"> 
		<b>'.$tage[(date("w",mktime(0,0,0,$tm,$td,$ty)))].' ('.$td.'.'.$tm.'.'.$ty.')</b> </td>
		<td colspan=2 align=right>';

$pd=$td;
$pm=$tm;
$py=$ty;
$vyr=tomorrow($pd,$pm,$py,2015);
if($vyr&&(date("Ymd")>=$py.$pm.$pd)&&$maxelem) print '
					<a href="op-pflege-logbuch-arch-start.php?sid='.$sid.'&lang='.$lang.'&nogetlast=1&dept='.$dept.'&saal='.$saal.'&pyear='.$py.'&pmonth='.$pm.'&pday='.$pd.'&noseek=1" 
					title="'.$pd.'.'.$pm.'.'.$py.'">
					<FONT  COLOR="white"  SIZE=2  FACE="Arial"><nobr>'.$LDNextDay.' &gt;&gt;</a></td></tr>';
print '
		<tr bgcolor="#f9f9f9" >';
	while(list($x,$v)=each($LDOpMainElements))
	{
		print '		
		<td><font face="verdana,arial" size="1" ><b>'.$v.'</b></td>';	
	}
print '
		</tr>';

if($datafound)
{

while($pdata=mysql_fetch_array($ergebnis))
	{
	if ($toggler==0) 
		{ print '<tr bgcolor="#dddddd">'; $toggler=1;} 
		else { print '<tr bgcolor="#fdfdfd">'; $toggler=0;}
	print '
			<a name="'.$pdata['patnum'].'"></a>';
	list($iday,$imonth,$iyear)=explode(".",$pdata[op_date]);
	print '
			<td valign=top><font face="verdana,arial" size="1" ><font size=2 color=red><b>'.$pdata['op_nr'].'</b></font><hr>'.$pdata['op_date'].'<br>
			'.$tage[date("w",mktime(0,0,0,$imonth,$iday,$iyear))].'<br>
			<a href="op-pflege-logbuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=saveok&patnum='.$pdata[patnum].'&op_nr='.$pdata[op_nr].'&dept='.$pdata[dept].'&saal='.$pdata[op_room].'&pyear='.$iyear.'&pmonth='.$imonth.'&pday='.$iday.'" ';
	if ($child) print 'target="_parent"';		
	print '>
			<img src="../img/bul_arrowgrnlrg.gif" width=16 height=16 border=0 alt="'.str_replace("~tagword~",$pdata['lastname'],$LDEditPatientData).'"></a>
			</td>';
	print '
			<td valign=top><nobr><font face="verdana,arial" size="1" color=blue>
			<a href="javascript:getinfo(\''.$pdata[patnum].'\',\''.$pdata[dept].'\')">
			<img src="../img/info2.gif" width=16 height=16 border=0 alt="'.str_replace("~tagword~",$pdata['lastname'],$LDOpenPatientFolder).'"></a> '.$pdata['patnum'].'<br>';
	print '
			<font color=black><b>'.$pdata['lastname'].', '.$pdata['firstname'].'</b><br>'.$pdata['bday'].'<br>'.nl2br(stripcslashes($pdata['address'])).'</td>';
	print '
			<td valign=top><font face="verdana,arial" size="1" >';
	print '
			<font color="#cc0000">Diagnose:</font><br>';
	print nl2br($pdata['diagnosis']);
	print '
			</td>
			<td valign=top><font face="verdana,arial" size="1" ><nobr>';
	
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
		
	print '</td>';
	
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

}
else
{
		print '
		<tr><td colspan=9 bgcolor="#fcfcfc">';
	if($validyr)
	{
		print '<p><br><center>';
		if ($pyear.$pmonth.$pday != date(Y).date(m).date(d))
		{
			print '
			<MAP NAME="catcom">
			<AREA SHAPE="RECT" COORDS="116,87,191,109" HREF="javascript:ssm(\'dLogoTable\'); clearTimeout(timer)"  onmouseout="timer=setTimeout(\'hsm()\',1000)">
			<AREA SHAPE="RECT" COORDS="232,87,308,110" HREF="op-pflege-logbuch-xtsuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=fresh&dept='.$dept.'&saal='.$saal.'"   title="'.$LDSearchPatient.' ['.$LDOrLogBook.']" >
			</MAP><img ismap usemap="#catcom" src="../img/'.$lang.'/'.$lang.'_cat-com2.gif" border=0>
			<DIV id=dLogoTable style=" VISIBILITY: hidden; POSITION: relative">
			<table border=0 bgcolor="#33333" cellspacing=0 cellpadding=1>
     		<tr>
       		<td>
				<table border=0 bgcolor="#ffffee" >
     				<tr>
       				<td><font size=2>
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
		}
		else
			{ 
				$buffy=str_replace(" ","+",$HTTP_COOKIE_VARS["ck_op_pflegelogbuch_user".$sid]);
				print '<img src="../imgcreator/catcom.php?person='.$buffy.'&rnd='.$r.'">';
				if($nofile) print '<p><b><font color="#800000" size=4>Die Datei oder das Verzeichnis ist nicht vorhanden!</font>
										<br> Bitte wenden Sie sich an die EDV.</b>';
			}
		//print '
			//<br><p>
			//<b>Heute ist der '.date(d).'.'.date(m).'.'.date(Y).'</b></center>';
		print '</center>';

	}
	else  print ' Keine Eintragung im OP Logbuch im '.strtoupper($dept).' Saal '.strtoupper($saal).' vorhanden!.';
	print '
		</td></tr>';}
print '
		</table>
		</td>
		</tr>
		</table>
		';
		
?>


</FONT>
<p>
        
<ul>
<FONT    SIZE=2  FACE="Arial">
<b><?php echo $LDOtherFunctions ?>:</b><br>
<form action="op-pflege-logbuch-arch-start.php" method="post" name="chgdept" onSubmit="return pruf(this)">

<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="hidden" name="lang" value="<?php print $lang; ?>">
<input type="hidden" name="user" value="<?php print $user; ?>">
<input type="hidden" name="child" value="<?php print $child; ?>">

<img src="../img/varrow.gif" width="20" height="15"> 
<nobr>
<?php echo $LDChangeDept ?><br>
<select name="dept" size=1 onChange="syncDept(this)">
				<?php
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
<select name="saal" size=1 onChange=syncSaal(this)>
				<?php
				reset($Or2Dept);
					while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selected";
						print '> '.$x.'</option>';
					}
				?>

</select></nobr>
<input type="submit" value="<?php echo $LDChange ?>">

</form><p>
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-pflege-logbuch-xtsuch-start.php?sid=<?php echo "$sid&lang=$lang&mode=fresh&dept=$dept&saal=$saal&child=$child" ?>"><?php echo "$LDSearchPatient [$LDOrLogBook]" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-pflege-logbuch-start.php?sid=<?php echo "$sid&lang=$lang&mode=fresh&dept=$dept&saal=$saal" ?>" <?php if ($child) print "target=\"_parent\""; ?>><?php echo "$LDStartNewDocu [$opabt[$dept] $LDRoom $saal]" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:gethelp('oplog.php','arch','<?php echo $dif ?>','<?php echo $lastlog ?>','<?php echo $datafound ?>')"><?php echo "$LDHelp" ?></a><br>

<p>
<a href="javascript:window.opener.focus();window.close();"><img border=0 align="right" src="../img/<?php echo "$lang/$lang" ?>_cancel.gif"  alt="<?php echo $LDCancel ?>"></a>
</ul>
<p>
<hr>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>

</td>
</tr>
</table>
</BODY>
</HTML>
