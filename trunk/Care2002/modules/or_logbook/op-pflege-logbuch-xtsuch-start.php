<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

if (!$internok&&!$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require_once($root_path.'include/inc_config_color.php');

/* Initialization */
$thisfile='op-pflege-logbuch-xtsuch-start.php';
$breakfile='javascript:window.close()';

if($srcword!='')
{
	if(is_numeric($srcword)){
		$srcword=(int) $srcword;
	}else{
		# Convert other wildcards
		$srcword=strtr($srcword,'*&','%_');
	}

	$dbtable='care_nursing_op_logbook';

       /* Load the date formatter */
       include_once($root_path.'include/inc_date_format_functions.php');
       
	
       /* Load editor functions for time format converter */
       //include_once('../include/inc_editor_fx.php');
	   $selectfrom="SELECT o.*,
								e.encounter_class_nr,
								 p.name_last, 
								 p.name_first, 
								 p.date_birth, 
								 p.addr_str,
								 p.addr_str_nr,
								 p.addr_zip,
								 t.name AS citytown_name,
								 d.name_formal,
								 d.LD_var
					FROM  (care_nursing_op_logbook AS o,
								care_encounter AS e,
								care_person AS p)
								LEFT JOIN care_address_citytown AS t ON t.nr=p.addr_citytown_nr
								LEFT JOIN care_department AS d ON d.nr=o.dept_nr";
		
	  if($mode=='get'||$mode=='getbypid'||$mode=='getbyenc')
	   {
			if($mode=='get'){
				$sql=$selectfrom."	WHERE o.nr='$nr'
								AND o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid
					ORDER BY o.create_time DESC";
			}elseif($mode=='getbypid'){
				$sql=$selectfrom."	WHERE p.pid='$nr'
								AND o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid
					ORDER BY o.create_time DESC";
			}else{
				$sql=$selectfrom."	WHERE o.encounter_nr='$nr'
								AND o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid
					ORDER BY o.create_time DESC";
			}
			
			if($ergebnis=$db->Execute($sql))
       		{
				if($rows=$ergebnis->RecordCount())
				{
						$datafound=1;
				}else { 
					echo "$LDDbNoRead<br>$sql"; 
				}
			}
       	}
	   	else
	   	{
			//********************************** start searching ***************************************
			$sql=$selectfrom."	WHERE (o.op_nr = '$srcword'
								OR e.encounter_nr = '$srcword'
								OR p.name_last = '$srcword'
								OR p.name_first = '$srcword'
								OR p.date_birth = '$srcword')
								AND o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid
					ORDER BY o.op_date DESC";
					
				if($ergebnis=$db->Execute($sql))
       			{
					if($rows=$ergebnis->RecordCount())
					{
						if($rows==1) $datafound=1;
					}else{
						$sql="SELECT o.nr,o.op_nr,o.dept_nr,o.op_room,o.op_date, e.encounter_nr, p.pid, p.name_last, p.name_first, p.date_birth
						FROM care_nursing_op_logbook AS o,
								care_encounter AS e,
								care_person AS p
						WHERE (o.op_nr LIKE '$srcword%'
								OR e.encounter_nr LIKE '$srcword%'
								OR p.name_last LIKE '$srcword%'
								OR p.name_first LIKE '$srcword%'
								OR p.date_birth LIKE '$srcword%')
								AND o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid
						ORDER BY p.name_last";
						if($ergebnis=$db->Execute($sql))
       					{
							$rows=$ergebnis->RecordCount();
	           			}else { echo "$LDDbNoRead<br>$sql"; }
	           		}
			   }else { echo "$LDDbNoRead<br>$sql"; }
			
		} // end of else if mode== get

} //end of if (srcword!="")
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDSearch - $LDOrLogBook" ?></TITLE>

<script  language="javascript">
<!-- 

var wwin;
var lock=true;
var nodept=false;

function pruf(f)
{
 d=f.srcword.value;
 if(d=="") return false;
 else return true;
}

function open_such_editwin(filename,y,m,d,dp,sl)
{
	url="op-pflege-logbuch-arch-edit.php?mode=edit&fileid="+filename+"&sid=<?php echo "$sid&lang=$lang"; ?>&user=<?php echo str_replace(" ","+",$user); ?>&pyear="+y+"&pmonth="+m+"&pday="+d+"&dept_nr="+dp+"&saal="+sl;
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;';
?>
	sucheditwin=window.open(url,"sucheditwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=400");
	window.sucheditwin.moveTo(0,0);
}

function waitwin()
{
	wwin=window.open("waitwin.htm","wait","menubar=no,resizable=no,scrollbars=no,width=400,height=200");
}
function getinfo(pid,dept,pdata){
	urlholder="<?php echo $root_path; ?>modules/nursing/nursing-station-patientdaten.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pid+"&patient=" + pdata + "&station="+dept+"&op_shortcut=<?php echo strtr($ck_op_pflegelogbuch_user," ","+") ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>


</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();document.suchform.srcword.select();"
<?php 
 echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
  ?> onUnload="if (wwin) wwin.close();">
 
<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor=<?php echo $cfg['top_bgcolor']; ?>>
<FONT  COLOR="<?php echo $cfg['top_txtcolor'];?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp;<?php echo "$LDOrLogBook - $LDSearch" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<!-- <a href="javascript:window.history.back()"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --><a href="javascript:gethelp('oplog.php','search','<?php echo $mode ?>','<?php echo $rows ?>','<?php echo $datafound ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td>
</tr>
<tr>
<td colspan=3  bgcolor=<?php echo $cfg['body_bgcolor']; ?>>


<FONT    SIZE=-1  FACE="Arial">
<?php if((($mode=='get')||($datafound))&&$rows)
{
	if($rows>1) echo $LDPatLogbookMany;
		else echo $LDPatLogbook;
echo '
		<table cellpadding="0" cellspacing="0" border="0" bgcolor="#999999" width="100%">
		<tr><td>
		<table  cellpadding="3" cellspacing="1" border="0" width="100%">
		';	
echo '
		<tr bgcolor="#0000cc">';
	while(list($x,$v)=each($LDOpMainElements))
	{
		echo '		
		<td background="'.$root_path.'gui/img/common/default/tableHeaderbg.gif"><font face="verdana,arial" size="1" color="#fefefe"><b>'.$v.'</b></td>';	
	}
echo '
		</tr>';
		
$img_arrow=createComIcon($root_path,'bul_arrowgrnlrg.gif','0','middle'); // Loads the arrow icon image
$img_info=createComIcon($root_path,'info2.gif','0','middle'); // Loads the arrow icon image
		
		
while($pdata=$ergebnis->FetchRow())
	{
		echo '
				<tr>
				<td colspan=9  background="'.$root_path.'gui/img/common/default/tableHeaderbg3.gif"><font size=2>&nbsp;
				<font color="#000033">';
				$buffer=$pdata['LD_var'];
				if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
					else echo $pdata['name_formal'];
				echo ' :: '.strtoupper($pdata[op_room]).'</font></font>
				</td></tr>';

	if ($toggler==0) 
		{ echo '<tr bgcolor="#fdfdfd">'; $toggler=1;} 
		else { echo '<tr bgcolor="#eeeeee">'; $toggler=0;}
	echo '
			<a name="'.$pdata['encounter_nr'].'"></a>';
			
	list($iyear,$imonth,$iday)=explode('-',$pdata['op_date']);

	echo '
			<td valign=top><font face="verdana,arial" size="1" ><font size=2 color=red><b>'.$pdata['op_nr'].'</b></font><hr>'.formatDate2Local($pdata['op_date'],$date_format).'<br>
			'.$tage[date("w",mktime(0,0,0,$imonth,$iday,$iyear))].'<br>
			<a href="op-pflege-logbuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=saveok&enc_nr='.$pdata['encounter_nr'].'&op_nr='.$pdata[op_nr].'&dept_nr='.$pdata[dept_nr].'&saal='.$pdata[op_room].'&thisday='.$pdata['op_date'].'">
			<img '.$img_arrow.' alt="'.str_replace("~tagword~",$pdata['name_last'],$LDEditPatientData).'"></a>
			</td>';
	
	echo '
			<td valign=top><nobr><font face="verdana,arial" size="1" color=blue>
			<a href="javascript:getinfo(\''.$pdata[encounter_nr].'\',\''.$pdata[dept_nr].'\')">
			<img '.$img_info.' alt="'.str_replace("~tagword~",$pdata['name_last'],$LDOpenPatientFolder).'"></a>&nbsp; ';

	echo ($pdata['encounter_class_nr']==1)?($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']) : ($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']);
			
	echo '<br>
			<font color=black><b>'.$pdata['name_last'].', '.$pdata['name_first'].'</b><br>'.formatDate2Local($pdata['date_birth'],$date_format).'<p>
			<font color="#000000">'.$pdata['addr_str'].' '.$pdata['addr_str_nr'].'<br>'.$pdata['addr_zip'].' '.$pdata['citytown_name'].'</font><br></td>';
			
	echo '
			<td valign=top><font face="verdana,arial" size="1" >';
	echo '
	<font color="#cc0000">'.$LDOpMainElements[diagnosis].':</font><br>';
	echo nl2br($pdata['diagnosis']);
	echo '
			</td><td valign=top><font face="verdana,arial" size="1" ><nobr>';
			
	$ebuf=array('operator','assistant','scrub_nurse','rotating_nurse');
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
		</table>
		</td>
		</tr>
		</table>
		';
}
else
if($mode=='search')
{
	
	echo '
			<ul>
				<table cellpadding=0 cellspacing=0 border=0>
				<tr>
				<td valign="middle" align="center">
				<font color="#800000" size=4>'.$LDPatientsFound.'</font>
				</td>
				<td>	
					<img '.createMascot($root_path,'mascot1_l.gif','0','middle').'>
				</td>
				</tr>
				<tr>
				<td valign=top colspan=2>

				<table cellpadding=0 cellspacing=0 border=0 >
				<tr>
				<td bgcolor=#999999>
				<table cellpadding=2 cellspacing=1 border=0 >
				';
				
	if($rows)
	{
		echo '<tr ><td colspan=7 bgcolor=#eeeee0><p><font size=2>'.$LDButFf;
		if($rows==1) echo " $LDSimilar ";
		else echo " $LDSimilarMany ";
		echo $LDNeededInfo.'</td></tr>';
		
		$img_src='<img '.createComIcon($root_path,'arrow.gif','0','middle').'>'; // Loads the arrow icon image
		
		echo '<tr bgcolor=#eeeeee>
				<td>&nbsp;</td >
				<td >&nbsp;</td >
				<td >&nbsp;</td >
				<td><font size=2>'.$LDOpRoom.':</td>
				<td><font size=2> '.$LDSrcListElements[5].'</td>
				<td><font size=2>'.$LDOpNr.'</td>
				<td><font size=2>'.$LDPatientNr.'</td >
				</tr>';
		while($pdata=$ergebnis->FetchRow())
		{
/*				echo "
						<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=get&dept_nr=$pdata[dept_nr]&op_nr=$pdata[op_nr]&srcword=".strtr($srcword," ","+")."\">";
*/				echo "
						<tr bgcolor=#eeeeee><td ><font size=2>
						<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=getbypid&nr=".$pdata['pid']."&dept_nr=$dept_nr&saal=$saal&srcword=".strtr($srcword," ","+")."\">&nbsp;";
				
				//echo $img_src;
				
				if($srcword&&stristr($pdata['name_last'],$srcword)) echo '<b><span style="background:yellow">'.$pdata['name_last'].'</span></b>';
 					else echo $pdata['name_last'];			
						
 				echo '</a></td>
				<td><font size=2>&nbsp;';
				
				if($srcword&&stristr($pdata['name_first'],$srcword)) echo '<b><span style="background:yellow">'.$pdata['name_first'].'</span></b>';
 					else echo $pdata['name_first'];		
							
 				echo '</td>
				<td align="center" ><font size=2>';
				
				if($srcword&&stristr($pdata['date_birth'],$srcword)) echo '<b><span style="background:yellow">'.formatDate2Local($pdata['date_birth'],$date_format).'</span></b>';
 					else echo formatDate2Local($pdata['date_birth'],$date_format);				
 				echo '
				</td>
				<td align="center"><font size=2>';
						
				echo "<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=get&nr=".$pdata['nr']."&dept_nr=$dept_nr&saal=$saal&srcword=".strtr($srcword," ","+")."\">&nbsp;";
				
				echo '<b>'.$pdata[op_room].'</b></a></td>
				<td align="center" ><font size=2><b>'.formatDate2Local($pdata['op_date'],$date_format).'</b> </td>
				<td align="center" ><font size=2>';
				echo "<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=get&nr=".$pdata['nr']."&dept_nr=$dept_nr&saal=$saal&srcword=".strtr($srcword," ","+")."\">&nbsp;";		
				echo $pdata['op_nr'];
				echo '</a>
				</td>
				<td align="center" ><font size=2>';
				echo "<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=getbyenc&nr=".$pdata['encounter_nr']."&dept_nr=$dept_nr&saal=$saal&srcword=".strtr($srcword," ","+")."\">&nbsp;";		
				echo $pdata['encounter_nr'];
				echo '</a>
				</td>
				</tr>';	
			}	
		
	}
	echo '	
				</table>
				</td>
				</tr>
				</table>
			</td>
			</tr>
			</table>
			</ul>
			';
}
?>

<ul>
<?php echo $LDPromptSearch ?>

<form action="<?php echo $thisfile; ?>" method=post name=suchform onSubmit="return pruf(this)">
<table border=0 cellspacing=0 cellpadding=1 bgcolor=#999999>
  <tr>
    <td>
		<table border=0 cellspacing=0 cellpadding=5 bgcolor=#eeeeee>
    <tr>
      <td >	<font color=maroon size=2><b><?php echo $LDKeyword ?>:</b></font><br>
          		<input type="text" name="srcword" size=40 maxlength=100 value="<?php echo $srcword; ?>">
				<input type="hidden" name="sid" value="<?php echo $sid; ?>"> 
				<input type="hidden" name="lang" value="<?php echo $lang; ?>"> 
				<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>"> 
				<input type="hidden" name="saal" value="<?php echo $saal; ?>"> 
				<input type="hidden" name="child" value="<?php echo $child; ?>"> 
				<input type="hidden" name="user" value="<?php echo str_replace(" ","+",$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]); ?>">
    			<input type="hidden" name="mode" value="search">
       
           	</td>
	   </tr>
  			   <tr>
      <td>	
		<input type="submit" value="<?php echo $LDSearch ?>" align="right">
              	</td>
	   </tr>

  </table>

	</td>
  </tr>
</table>
  	</form>


</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<b><?php echo $LDOtherFunctions ?>:</b><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-pflege-logbuch-arch-start.php?sid=<?php echo "$sid&lang=$lang&dept_nr=$dept_nr&saal=$saal&child=$child" ?>"><?php echo "$LDResearchArchive [$LDOrLogBook]" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-pflege-logbuch-start.php?sid=<?php echo "$sid&lang=$lang&mode=fresh&dept_nr=$dept_nr&saal=$saal" ?>" <?php if ($child) echo "target=\"_parent\""; ?>><?php echo "$LDStartNewDocu [$LDOrLogBook]" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="javascript:gethelp('oplog.php','search','<?php echo $mode ?>','<?php echo $rows ?>','<?php echo $datafound ?>')"><?php echo "$LDHelp" ?></a><br>

<!-- <p>
<a href="javascript:window.opener.focus();window.close();"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>  alt="<?php echo $LDCancel ?>"></a>
 -->
 </ul>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>


</BODY>
</HTML>
