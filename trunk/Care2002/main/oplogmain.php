<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

if (!$internok&&!$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require_once('../include/inc_config_color.php');

$toggler=0;

$pdata=array();
$template=array();
if(!$pyear) $pyear=date('Y');
if(!$pmonth) $pmonth=date('m');
if(strlen($pmonth)<2) $pmonth='0'.$pmonth;
if(!$pday) $pday=date('d');
$md=$pday;
if (strlen($md)<2) $md='0'.$md; 
/*
if($dept==NULL) $dept='plop';
if($saal==NULL) $saal="a";
*/
$Or2Dept=get_meta_tags('../global_conf/resolve_or2ordept.pid');
setcookie(firstentry,'1');


/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{
    /* Load the date formatter */
    include_once('../include/inc_date_format_functions.php');
    
	
    /* Load editor functions for time format converter */
    //include_once('../include/inc_editor_fx.php');
	
	// get orig data

	  		$dbtable='care_nursing_op_logbook';
			
		 	$sql="SELECT * FROM $dbtable 
					WHERE dept='$dept'
						AND op_room='$saal'
						AND op_date='$pyear-$pmonth-$pday'
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
					//echo $sql."<br>";
					//echo $rows;
				}
				//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else { echo "$LDDbNoRead<br>"; } 
		}
  		 else { echo "$LDDbNoLink<br>"; } 


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 
 <script language=javascript src="../js/syncdeptsaal.js">
 </script>
 
 <script language=javascript>
 <!-- 
 function pruf(d)
{
 	if((d.dept.value=='<?php echo $dept; ?>')&&(d.saal.value=='<?php echo $saal;?>')) return false;
	window.top.LOGINPUT.location.replace('oploginput.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=chgdept&dept='+d.dept.value+'&saal='+d.saal.value);
	return true;
}
function getinfo(pid,pdata){
	urlholder="pflege-station-patientdaten.php?sid=<?php echo "$sid&lang=$lang"; ?>&pn="+pid+"&patient=" + pdata + "&station=<?php echo "$dept&pday=$pday&pmonth=$pmonth&pyear=$pyear&op_shortcut=".$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}
 function initall(){
	d=window.parent.LOGINPUT.document.oppflegepatinfo.xx2;
	if(d) d.value="";
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

 // -->
 </script>
 
 <?php if(!$datafound) : ?>
   <script language="javascript" src="../js/showhide-div.js">
</script>
<?php endif ?>
 
 
</HEAD>

<BODY bgcolor=#666666 topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"
onLoad="window.location.replace('#<?php if ($gotoid) echo $gotoid; else echo 'bot'; ?>');">


<CENTER>

<?php if ($pday<2)
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
		if(strlen($tm)<2) $tm='0'.$tm;
		//$td=31;
		//while (!checkdate($tm,$td,$pyear)) $td--;
		$td=date('t',mktime(0,0,0,$tm,1,$pyear));
	}
}
else 
{
	$td=$pday-1;
	if(strlen($td)<2) $td="0".$td;
	 $tm=$pmonth; 
	 $ty=$pyear;
}
	
$opabt=get_meta_tags('../global_conf/'.$lang.'/op_tag_dept.pid');


echo '
<table  cellpadding="3" cellspacing="1" border="0" width="100%">';	
		
echo '
		<tr bgcolor=#999999><td colspan=2><nobr>
		<a href="oplogmain.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&pyear='.$ty.'&pmonth='.$tm.'&pday='.$td.'&dept='.$dept.'&saal='.$saal.'" title="'.formatDate2Local("$ty-$tm-$td",$date_format).'"><FONT  COLOR="white"  SIZE=2  FACE="Arial">&lt;&lt; '.$LDPrevDay.'</a></td>
		<td colspan=3 align=center><FONT  COLOR="white"  SIZE=4  FACE="Arial"> 
		<b>'.$opabt[$dept].' '.$LDRoom.'-'.strtoupper($saal).' ('.formatDate2Local("$pyear-$pmonth-$md",$date_format).')</b></td>';
?>
		<td colspan=2>
		<nobr>
			<table cellpadding=0 cellspacing=0 border=0>	
			<form action="oplogmain.php" method="post" name="chgdept" onSubmit="return pruf(this)">
			<tr>
			<td>
				<input type="hidden" name="pyear" value="<?php // echo $pyear; ?>">
    			<input type="hidden" name="pmonth" value="<?php //echo $pmonth; ?>">
    			<input type="hidden" name="pday" value="<?php // echo $md; ?>">
    			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
    			<input type="hidden" name="lang" value="<?php echo $lang; ?>">
    
				<select name="dept" size=1 onChange="syncDept(this,document.chgdept.saal)">
				<?php
                   while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						echo'
					<option value="'.$x.'"';
						if ($dept==$x) echo " selected";
						echo '> '.$v.'</option>';
					}
				?>
					
				</select>
			</td>
			<td>
				<select name="saal" size=1 onChange="syncSaal(this,document.chgdept.dept)">
				<?php
                    while(list($x,$v)=each($Or2Dept))
					{
						echo'
					<option value="'.$x.'"';
						if ($saal==$x) echo " selected";
						echo '> '.$x.'</option>';
					}
				?>
				</select>
			</td>
			<td>&nbsp;
			<input type="submit" value="<?php echo $LDChange ?>" >
   			</td>
			</tr></form>
			</table>
			</nobr>
<?php
	echo '
			</td>
			<td colspan=1 align=middle>
			<a href="javascript:gethelp(\'oplog.php\',\'create\',\'logmain\')"><img '.createComIcon('../','frage.gif','0','absmiddle').' alt="'.$LDHelp.'"></a></td>
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

  echo '
		<a href="oplogmain.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&pyear='.$ty.'&pmonth='.$tm.'&pday='.$td.'&dept='.$dept.'&saal='.$saal.'" title="'.formatDate2Local("$ty-$tm-$td",$date_format).'"><FONT  COLOR="white"  SIZE=2  FACE="Arial"><nobr>'.$LDNextDay.' &gt;&gt;</a>';
}

echo '
		</td></tr>';

if($datafound)
{
echo '
<tr bgcolor="#f9f9f9" >';
while(list($x,$v)=each($LDOpMainElements))
	echo '
		<td><font face="verdana,arial" size="1"><b>&nbsp;'.$v.'</b></td>';

echo '
</tr>';
}

while($pdata=mysql_fetch_array($ergebnis))
	{
	if ($toggler==0) 
		{ echo '
		<tr bgcolor="#fdfdfd">'; $toggler=1;} 
		else { echo '
		<tr bgcolor="#fdfdfd">'; $toggler=0;}
	echo '<a name="'.$pdata['op_nr'].'"></a>
	<td valign=top><font face="verdana,arial" size="1" ><font size=2 color=red><b>'.$pdata['op_nr'].'</b></font>
	<hr>'.formatDate2Local($pdata['op_date'],$date_format).'<br>
	'.$tage[date(w,mktime(0,0,0,$pmonth,$pday,$pyear))].'<br>
	<a href="oploginput.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&mode=edit&patnum='.$pdata[patnum].'&dept='.$dept.'&saal='.$saal.'&op_nr='.$pdata[op_nr].'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'" target="LOGINPUT" >
	<img '.createComIcon('../','dwnarrowgrnlrg.gif','0').' alt="'.str_replace("~tagword~",$pdata['lastname'],$LDEditPatientData).'"></a>
	</td>';
	echo '
	<td valign=top><nobr><font face="verdana,arial" size="1" color=blue>
	<a href="javascript:getinfo(\''.$pdata[patnum].'\')">
	<img '.createComIcon('../','info2.gif','0').' alt="'.str_replace("~tagword~",$pdata['lastname'],$LDOpenPatientFolder).'"></a> '.$pdata['patnum'].'<br>';
	echo '
	<font color=black><b>'.$pdata['lastname'].', '.$pdata['firstname'].'</b><br>'.formatDate2Local($pdata['bday'],$date_format).'<br>'.nl2br(stripcslashes($pdata['address'])).'</td>';
	echo '
	<td valign=top width=150><font face="verdana,arial" size="1" >';
	echo '
	<font color="#cc0000">'.$LDOpMainElements[diagnosis].':</font><br>';
	echo nl2br($pdata['diagnosis']);
	echo '
	</td><td valign=top><font face="verdana,arial" size="1" ><nobr>';
	
	$ebuf=array("operator","assistant","scrub_nurse","rotating_nurse");
	//$tbuf=array("O","A","I","S");
	//$cbuf=array("Operateur","Assistent","Instrumenteur","Springer");
	for($n=0;$n<sizeof($ebuf);$n++)
	{
		if(!$pdata[$ebuf[$n]]) continue;
		echo '<font color="#cc0000">'.$cbuf[$n].'</font><br>';
		$dbuf=explode("~",$pdata[$ebuf[$n]]);
		for($i=0;$i<sizeof($dbuf);$i++)
		{
			parse_str(trim($dbuf[$i]),$elems);
			if($elems[n]=="") continue;
			else echo '&nbsp;'.$elems[n]." ".$tbuf[$n].$elems[x]."<br>";
		}
	}	
		
	echo '
	</td>
	<td valign=top><font face="verdana,arial" size="1" >'.$LDAnaTypes[$pdata['anesthesia']].'<p>';
	if($pdata[an_doctor])
		{ 
			echo '<font color="#cc0000">'.$LDAnaDoc.'</font><br><font color="#000000">';
			$dbuf=explode("~",$pdata[an_doctor]);
			for($i=0;$i<sizeof($dbuf);$i++)
			{
				parse_str(trim($dbuf[$i]),$elems);
				if($elems[n]=="") continue;
				else echo '&nbsp;'.$elems[n].' '.$LDAnaPrefix.$elems[x].'<br>';
			}
			echo '</font>';
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


	echo '
	</td>
	<td valign=top><font face="verdana,arial" size="1" >';
	echo '<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpCut.':</font><br>'.convertTimeToLocal($ccbuf[s]).'<p>
	<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpClose.':</font><br>'.convertTimeToLocal($ccbuf[e]).'</td>';
	echo '
	<td valign=top><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements[therapy].':<font color=black><br>'.nl2br($pdata['op_therapy']).'</td>';
	echo '
	<td valign=top><nobr><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements[result].':<br>';
	echo '<font color=black>'.nl2br($pdata['result_info']).'</td>';
	echo '
	<td valign=top><font face="verdana,arial" size="1" >';
	echo '<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpIn.':</font><br>'.convertTimeToLocal($eobuf[s]).'<p>
	<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpOut.':</font><br>'.convertTimeToLocal($eobuf[e]).'</td>';
	echo '
	</tr>';

	}

echo '
</table>';

if(!$datafound)
{
	echo '<p>';
	if ($pyear.$pmonth.$pday != date(Y).date(m).date(d))
	{
	echo '
			<MAP NAME="catcom">
			<AREA SHAPE="RECT" COORDS="116,87,191,109" HREF="javascript:ssm(\'dLogoTable\'); clearTimeout(timer)"  onmouseout="timer=setTimeout(\'hsm()\',1000)">
			<AREA SHAPE="RECT" COORDS="232,87,308,110" HREF="op-pflege-logbuch-xtsuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=fresh&dept='.$dept.'&saal='.$saal.'&child=1"  target="_parent"  title="'.$LDSearchPatient.' ['.$LDOrLogBook.']" >
			</MAP><img ismap usemap="#catcom" '.createLDImgSrc('../','cat-com2.gif','0').'>';
?>
			<DIV id=dLogoTable style=" VISIBILITY: hidden; POSITION: relative">
			<table border=0 bgcolor="#33333" cellspacing=0 cellpadding=1>
     		<tr>
       		<td>
				<table border=0 bgcolor="#ffffee" >
     				<tr>
       				<td><font size=2 face="verdana,arial">
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon('../','redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowPrevLog ?></a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon('../','redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowNextLog ?></a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon('../','redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowGuideCal ?></a>&nbsp;<br></font>
	   				</td>
     				</tr>
  		 </table>
	
	   		</td>
     		</tr>
  		 </table>
		 </DIV>
<?php
		/*echo '<img src="../img/'.$lang.'/'.$lang.'_cat-com2.gif">';*/
	}
	elseif(!$firstentry)
	{
		if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) $buffy=str_replace(" ","+",$HTTP_COOKIE_VARS["ck_login_username".$sid]); 
			else $buffy=str_replace(" ","+",$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]);
		 echo '<img src="../imgcreator/catcom.php?lang='.$lang.'&person='.$buffy.'">';
		 }
}
?>
<a name="bot"></a>
</BODY>
</HTML>
