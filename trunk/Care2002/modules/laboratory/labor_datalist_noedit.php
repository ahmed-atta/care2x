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
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

	if($user_origin=='lab')
	{
  		$local_user='ck_lab_user';
  		$breakfile=$root_path.'modules/laboratory/labor.php'.URL_APPEND;
	}
	else
	{
  		$local_user='ck_pflege_user';
  		$breakfile=$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_APPEND;
	}
	if(!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
//echo $HTTP_COOKIE_VARS[$local_user.$sid];


if(!$pn) header("location:".$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang");
require_once($root_path.'include/inc_config_color.php');

$thisfile=basename(__FILE__);

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;
/* Load global configs */
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');	

/*if($from=='station') $breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$patnum";
	else $breakfile='labor_data_patient_such.php'.URL_APPEND;
*/
$fielddata='patnum,name,vorname,gebdatum';

require($root_path.'include/inc_labor_param_group.php');

						
if($parameterselect=='') $parameterselect=0;

$parameters=$paralistarray[$parameterselect];					
//$paramname=$parametergruppe[$parameterselect];


if($nostat) $ret=$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$pn";
	else $ret=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn";
	
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{
    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');

		$enc_obj->where=" encounter_nr=$pn";
	    if( $enc_obj->loadEncounterData($pn)) {
			switch ($enc_obj->EncounterClass())
			{
		    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		                   break;
				case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
				default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			}						

			if( $enc_obj->is_loaded){
				$result=&$enc_obj->encounter;		
				$rows=$enc_obj->record_count;	
						
				$dbtable='care_lab_test_data';
				
				$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ORDER BY tid DESC";
				
        		if($ergebnis=$db->Execute($sql))
				{
					if (!$rows=$ergebnis->RecordCount())
					 {
					 	if($nostat)header("location:".$root_path."modules/laboratory/labor-nodatafound.php?sid=$sid&lang=$lang&patnum=$pn&ln=$result[name]&fn=$result[vorname]&nodoc=labor");
					 	else header("location:".$root_path."modules/nursing/nursing-station-patientdaten-nolabreport.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&nodoc=labor&user_origin=$user_origin");
					 	//else echo("location:".$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&nodoc=labor");
					 	exit;
					 }
				}	
			}
		}
			else{echo "<p>$sql$LDDbNoRead";exit;}
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<title><?php echo "$LDLabReport $station"; ?></title>
<?php echo setCharSet(); ?>

<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
.a12_b{font-family:arial; font-size:12; color:#000000}
.j{font-family:verdana; font-size:12; color:#000000}
</style>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?><script language="javascript">
<!-- Script Begin
var toggle=true;
function selectall()
{
	for(i=0;i<document.labdata.pname.length;i++)
	{
	if(toggle==true)
	{document.labdata.pname[i].checked=true; }
		else
		{ document.labdata.reset();}
	}	
	toggle=(!toggle);

}
function prep2submit()
{

	var j=0;
	d=document.labdata;
	for(i=0;i<d.pname.length;i++)
	{
		if(d.pname[i].checked==true) 
		{
			if(j)
			{d.params.value=d.params.value +"~"+d.pname[i].value;}
			else
			{ d.params.value=d.pname[i].value;	j=1;}
		}
	}
	if(d.params.value!=''){d.submit(); }
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//  Script End -->
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php if(!$noexpand) : ?>
<script language="javascript">
<!-- Script Begin
	window.moveTo(0,0);
	 window.resizeTo(1000,740);
//  Script End -->
</script>
<?php endif ?>

<table  border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDLabReport $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab_list.php','','','','<?php echo $LDLabReport ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>

<tr>
<td colspan=2  bgcolor=#dde1ec><p><br>

<FONT    SIZE=-1  FACE="Arial">

<ul>

<table border=0>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $result['patnum']; ?>&nbsp;
</td>
</tr>

<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo "$LDLastName, $LDName, $LDBday" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php echo  $result['name']; ?>, <?php echo  $result['vorname']; ?>&nbsp;&nbsp;<?php echo  formatDate2Local($result['gebdatum'],$date_format); ?></b>
</td>
</tr>
</table>
<p>
<?php
echo '
<button onClick="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph.'</button>';
?>
<p>
<table border=0 bgcolor=#9f9f9f cellspacing=0 cellpadding=0>
<tr>
<td>
<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1>
<?php 

while($zeile=$ergebnis->FetchRow()) $data[]=$zeile;

if(sizeof($data)>5) $data=array_slice($data,0,5);
$data=array_reverse($data);
$pname=array();
for($a=0;$a<sizeof($data);$a++)
{
	$da=$data[$a];
	for($b=0;$b<sizeof($parametergruppe);$b++)
	{
		$buf=$da[($parametergruppe[$b])];
		//echo $parametergruppe[$b]."<br>";
		parse_str($buf,$elems);
		//echo $buf."<br>";
		$parameters=$paralistarray[$b];
		for($c=0;$c<sizeof($parameters);$c++)
		{
		//echo $parameters[$c]." param <br>";
			
			//list($key[($a.$b.$c)],$val[($a.$b.$c)])=$elems[$c];
			if($elems[($parameters[$c])]!='')
			{
				$val[($a.($parameters[$c]))]=$elems[($parameters[$c])];
				if(!in_array($parameters[$c],$pname)) $pname[]=$parameters[$c];
			}
		}
	}
}	

array_unique($pname);
$cols=sizeof($data);
if($cols>5) if($cfg[mask]!=2) $cols=5;  // set colunm number
if(($rows=sizeof($pname))<10) $rows=10; // set rows number
//echo sizeof($pname);
echo'
   <tr bgcolor="#dd0000" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>';
	for($i=0;$i<$cols;$i++)
	echo '
	<td class="a12_b"><font color="#ffffff">&nbsp;<b>'.formatDate2Local($data[$i]['test_date'],$date_format).'</b>&nbsp;</td>';
	echo '
   <td>&nbsp;<a href="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').' alt="'.$LDClk2Graph.'"></td></a></td></tr>';
echo'
   <tr bgcolor="#ffddee" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;</td>';
	for($i=0;$i<$cols;$i++)
	echo '
	<td class="a12_b"><font color="#0000cc">&nbsp;<b>'.convertTimeToLocal($data[$i]['test_time']).'</b> '.$LDOClock.'&nbsp;</td>';
	echo '
   <td>&nbsp;<a href="javascript:selectall()"><img '.createComIcon($root_path,'dwnarrowgrnlrg.gif','0','absmiddle').' alt="'.$LDClk2SelectAll.'"></a>
       </tr>';


for($l=0;$l<$rows;$l++)
{
	echo'
   <tr bgcolor=';
	 if($toggle) {echo '"#ffdddd"'; $toggle=(!$toggle); }else { echo '"#ffeeee"';$toggle=(!$toggle);}
   echo '>
     <td class="va12_n"> &nbsp;<nobr><a href="#">'.strtr($pname[$l],"_-",". ").'</a></nobr> 
	</td>
	<td class="j" >&nbsp;&nbsp;</td>';
	for($i=0;$i<$cols;$i++)
	echo '
	<td class="j" >&nbsp;'.$val[$i.$pname[$l]].'&nbsp;</td>';
	echo '
	<td>
	<input type="checkbox" name="pname" value="'.$pname[$l].'">
</td></tr>';
}
	echo '
</table>';     

// set the row/date variables for form
for($i=0;$i<$cols;$i++)
echo '
<input type="hidden" name="date'.$i.'" value="'.$data[$i]['test_date'].'">
<input type="hidden" name="time'.$i.'" value="'.$data[$i]['test_time'].'">';
for($i=0;$i<$cols;$i++)
echo '
<input type="hidden" name="tid'.$i.'" value="'.$data[$i]['tid'].'">';

echo '
<input type="hidden" name="colsize" value="'.$cols.'">
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="from" value="'.$from.'">
<input type="hidden" name="edit" value="'.$edit.'">
<input type="hidden" name="params" value="">
<input type="hidden" name="patnum" value="'.$result['patnum'].'">
<input type="hidden" name="name" value="'.$result['name'].'">
<input type="hidden" name="vorname" value="'.$result['vorname'].'">
<input type="hidden" name="gebdatum" value="'.$result['gebdatum'].'">';
?>                                         
</td></tr>
</table>
</form>

<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
</UL>

</FONT>


<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</td>
</tr>
</table>        


</BODY>
</HTML>
