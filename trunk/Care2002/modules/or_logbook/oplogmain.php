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
$lang_tables=array('departments.php');
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

if (!$internok&&!$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require_once($root_path.'include/inc_config_color.php');

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
if(!isset($saal)||empty($saal)) $saal=1; // default is op room #1

$Or2Dept=get_meta_tags($root_path.'global_conf/resolve_or2ordept.pid');
setcookie(firstentry,'1');

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);
/* Create the global object, load the patient configs*/
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');

$surgery_arr=&$dept_obj->getAllActiveWithSurgery();

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{
    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    
	
    /* Load editor functions for time format converter */
    //include_once('../include/inc_editor_fx.php');
	
	// get orig data

	  		$dbtable='care_nursing_op_logbook';
			
		 	$sql="SELECT o.*,e.encounter_class_nr, p.name_last, p.name_first, p.date_birth, p.addr_str, p.addr_str_nr, p.addr_zip, t.name AS citytown_name
					FROM $dbtable AS o, care_encounter AS e, care_person AS p
					LEFT JOIN care_address_citytown AS t ON p.addr_citytown_nr=t.nr
					WHERE o.dept_nr='$dept_nr'
						AND o.op_room='$saal'
						AND o.op_date='$pyear-$pmonth-$pday'
						AND o.encounter_nr=e.encounter_nr
						AND e.pid=p.pid
						ORDER BY o.nr
						";

			if($ergebnis=$db->Execute($sql))
       		{
				if($rows=$ergebnis->RecordCount())
				{
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
 	if((d.dept_nr.value=='<?php echo $dept_nr; ?>')&&(d.saal.value=='<?php echo $saal;?>')) return false;
	window.top.LOGINPUT.location.replace('oploginput.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=chgdept&dept_nr='+d.dept_nr.value+'&saal='+d.saal.value);
	return true;
}
function getinfo(pid,pdata){
	urlholder="<?php echo $root_path; ?>modules/nursing/nursing-station-patientdaten.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pid+"&patient=" + pdata + "&dept_nr=<?php echo "$dept_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&op_shortcut=".$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}
 function initall(){
	d=window.parent.LOGINPUT.document.oppflegepatinfo.xx2;
	if(d) d.value="";
	}
 // -->
 </script>
 <?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 <?php if(!$datafound) : ?>
   <script language="javascript" src="<?php echo $root_path; ?>js/showhide-div.js">
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
	
$opabt=get_meta_tags($root_path.'global_conf/'.$lang.'/op_tag_dept.pid');


echo '
<table  cellpadding="3" cellspacing="1" border="0" width="100%">';	
		
echo '
		<tr bgcolor=#999999><td colspan=2><nobr>
		<a href="oplogmain.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&pyear='.$ty.'&pmonth='.$tm.'&pday='.$td.'&dept_nr='.$dept_nr.'&saal='.$saal.'" title="'.formatDate2Local("$ty-$tm-$td",$date_format).'">
		<FONT  COLOR="white"  SIZE=2  FACE="Arial">&lt;&lt; '.$LDPrevDay.'</a></td>
		<td colspan=3 align=center><FONT  COLOR="white"  SIZE=4  FACE="Arial"> 
		<b>';
		$buffer=$dept_obj->LDvar();
		if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
			else echo $dept_obj->FormalName();
		echo ' '.$LDRoom.'-'.strtoupper($saal).' ('.formatDate2Local("$pyear-$pmonth-$md",$date_format).')</b></td>';
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
    
				<!-- <select name="dept_nr" size=1 onChange="syncDept(this,document.chgdept.saal)"> -->
				<select name="dept_nr" size=1>
				<?php
                   while(list($x,$v)=each($surgery_arr))
					{
						if($x==42) continue;
						echo'
					<option value="'.$v['nr'].'"';
						if ($dept_nr==$v['nr']) echo " selected";
						echo '>';
						$buffer=$v['LD_var'];
						if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
							else echo $v['name_formal'];
						echo '</option>';
					}
				?>
					
				</select>
			</td>
			<td>
				<!-- <select name="saal" size=1 onChange="syncSaal(this,document.chgdept.dept)"> -->
				<select name="saal" size=1>
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
			<a href="javascript:gethelp(\'oplog.php\',\'create\',\'logmain\')"><img '.createComIcon($root_path,'frage.gif','0','absmiddle').' alt="'.$LDHelp.'"></a></td>
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
		<a href="oplogmain.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&pyear='.$ty.'&pmonth='.$tm.'&pday='.$td.'&dept_nr='.$dept_nr.'&saal='.$saal.'" title="'.formatDate2Local("$ty-$tm-$td",$date_format).'"><FONT  COLOR="white"  SIZE=2  FACE="Arial"><nobr>'.$LDNextDay.' &gt;&gt;</a>';
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

while($pdata=$ergebnis->FetchRow())
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
	<a href="oploginput.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&mode=edit&enc_nr='.$pdata['encounter_nr'].'&dept_nr='.$dept_nr.'&saal='.$saal.'&op_nr='.$pdata['op_nr'].'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'" target="LOGINPUT" >
	<img '.createComIcon($root_path,'dwnarrowgrnlrg.gif','0').' alt="'.str_replace("~tagword~",$pdata['lastname'],$LDEditPatientData).'"></a>
	</td>';
	echo '
	<td valign=top><nobr><font face="verdana,arial" size="1" color=blue>
	<a href="javascript:getinfo(\''.$pdata['encounter_nr'].'\')">
	<img '.createComIcon($root_path,'info2.gif','0').' alt="'.str_replace("~tagword~",$pdata['lastname'],$LDOpenPatientFolder).'"></a> ';
	
	echo ($pdata['encounter_class_nr']==1)?($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']) : ($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']);

	echo '<br>
	<font color=black><b>'.$pdata['name_last'].', '.$pdata['name_first'].'</b><br>'.formatDate2Local($pdata['date_birth'],$date_format).'<p>
			<font color="#000000">'.$pdata['addr_str'].' '.$pdata['addr_str_nr'].'<br>'.$pdata['addr_zip'].' '.$pdata['citytown_name'].'</font><br></td>';
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
	<td valign=top><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements['therapy'].':<font color=black><br>'.nl2br($pdata['op_therapy']).'</td>';
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
			<AREA SHAPE="RECT" COORDS="232,87,308,110" HREF="op-pflege-logbuch-xtsuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=fresh&dept_nr='.$dept_nr.'&saal='.$saal.'&child=1"  target="_parent"  title="'.$LDSearchPatient.' ['.$LDOrLogBook.']" >
			</MAP><img ismap usemap="#catcom" '.createLDImgSrc($root_path,'cat-com2.gif','0').'>';
?>
			<DIV id=dLogoTable style=" VISIBILITY: hidden; POSITION: relative">
			<table border=0 bgcolor="#33333" cellspacing=0 cellpadding=1>
     		<tr>
       		<td>
				<table border=0 bgcolor="#ffffee" >
     				<tr>
       				<td><font size=2 face="verdana,arial">
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowPrevLog ?></a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowNextLog ?></a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowGuideCal ?></a>&nbsp;<br></font>
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
		 echo '<img src="'.$root_path.'main/imgcreator/catcom.php?lang='.$lang.'&person='.$buffy.'">';
		 }
}
?>

<a name="bot"></a>
</BODY>
</HTML>
