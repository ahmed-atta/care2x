<?php

define('LAB_MAX_DAY_DISPLAY',7); # define the max number or days displayed at one time

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

setcookie('ck_lab_user'.$sid,$_SESSION['idutente'],0,'/');
$lang_tables=array('chemlab_groups.php','chemlab_params.php','prompt.php');
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

#Richiediamo il file che mappa i laboratori in modo corretto
require ('Mappa_lab.php');

if(!isset($user_origin)) $user_origin='';

if($user_origin=='lab'||$user_origin=='lab_mgmt'){
  	$local_user='ck_lab_user';
  	if(isset($from)&&$from=='input') $breakfile=$root_path.'modules/laboratory/labor_datainput.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&user_origin='.$user_origin;
		else $breakfile=$root_path.'modules/laboratory/labor_data_patient_such.php'.URL_APPEND;
}else{
  	$local_user='ck_pflege_user';
  	$breakfile=$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_APPEND.'&pn='.$pn.'&edit='.$edit;
	$encounter_nr=$pn;
}



//if(!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if(!$encounter_nr) header("location:".$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang");

$thisfile=basename(__FILE__);

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_lab.php');
$enc_obj= new Encounter($encounter_nr);
$lab_obj=new Lab($encounter_nr);

$cache='';

if($nostat) $ret=$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$encounter_nr";
	else $ret=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$encounter_nr";
	
# Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
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

<script language="javascript">
<!-- Script Begin
var toggle=true;
function selectall(){

	d=document.labdata;
	var t=d.ptk.value;
	
	if(t==1){
		if(toggle==true){ d.tk.checked=true;}
	}else{
		for(i=0;i<t;i++){
			if(toggle==true){d.tk[i].checked=true; }
		}
	}
	if(toggle==false){ 
		d.reset();
	}
	toggle=(!toggle);

}

function prep2submit(){

	d=document.labdata;
	var j=false;
	var t=d.ptk.value;
	var n=false;
	for(i=0;i<t;i++)
	{
		if(t==1) {
			n=d.tk;
			v=d.tk.value;
		}else{
			n=d.tk[i];
			v=d.tk[i].value;
		}
		if(n.checked==true){
			if(j){
				d.params.value=d.params.value +"~"+v;
			}else{ 
				d.params.value=v;	
				j=1;
			}
		 }
	}
	if(d.params.value!=''){
		d.submit();
	}else{
		alert("<?php echo $LDCheckParamFirst ?>");
	}
}
//  Script End -->
</script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table  border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDLabReport $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a 
href="javascript:gethelp('lab_list.php','','','','<?php echo $LDLabReport ?>')"><img 
<?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr></td>
</tr>

<tr>
<td colspan=2  bgcolor=#dde1ec><p><br>

<FONT    SIZE=-1  FACE="Arial">

<ul>

<table border=0>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $encounter_nr; ?>&nbsp;
</td>
</tr>
<?php
	$query="SELECT per.name_first, per.name_last, per.date_birth, per.sex FROM care_encounter AS enc LEFT JOIN care_person AS per ON per.pid=enc.pid WHERE enc.encounter_nr=".$encounter_nr; 
	$ris=$db->Execute($query);
	$risultati=$ris->FetchRow();
	
?>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo "$LDLastName, $LDName, $LDBday" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php echo  $risultati['name_last']; ?>, <?php echo  $risultati['name_first']; ?>&nbsp;&nbsp;<?php echo  formatDate2Local($risultati['date_birth'],$date_format); ?></b>
</td>
</tr>
</table>
<p>
<?php
/*echo '
<button onClick="javascript:document.labdata.submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph.'</button>';
*/
?>
<p>
<table border=0 bgcolor=#9f9f9f cellspacing=0 cellpadding=0>
<tr>
<td>

<!--<form action="labor-data-makegraph.php" method="post" name="labdata">-->
<form action="grafico_nostro.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1>
<?php 
if(empty($cache)){
	# Get the number of colums
	$cols=sizeof($records);
$cache= '
   <tr bgcolor="#0D5BA7" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDMsrUnit.'</b>&nbsp;</td>
	';

/*
$cache= '
   <tr bgcolor="#dd0000" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDMsrUnit.'</b>&nbsp;</td>
	';
	*/
	
}

//echo $cache;
?>
<tr bgcolor="#0D5BA7" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>Parametri</b>
	</td>
	<!--<td  class="j"><font color="#ffffff">&nbsp;<b>Campo normale</b>&nbsp;</td>-->
	<td  class="j"><font color="#ffffff">&nbsp;<b>Msr. Unit</b>&nbsp;</td>
<?php 
$query="SELECT * FROM care_test_findings_chemlab WHERE encounter_nr=".$encounter_nr." ORDER BY job_id DESC LIMIT 0,7";
$answer2=$db->Execute($query);
$i=0;
while($answer=$answer2->FetchRow())
{
$matrice[$i]['job_id']=$answer['job_id'];
$matrice[$i]['test_date']=$answer['test_date'];
$matrice[$i]['test_time']=$answer['test_time'];
$matrice[$i]['serial_value']=$answer['serial_value'];
$nonseriali=unserialize($answer['serial_value']);
 while (list($x,$y)=each($nonseriali))
 {
  $matriciona[$x][$answer['job_id']]=$y;

 }
$i++;
 ?>
 <td class="a12_b"><font color="#ffffff">&nbsp;<b><?php echo $answer['test_date'] ?><br><?php echo $answer['job_id'] ?></b>&nbsp;</td>
 <?php
}
   ?>
   <td>&nbsp;<a href="javascript:document.labdata.submit()"><img src="../../gui/img/common/default/chart.gif" border=0 align="absmiddle" width="16" height="17" alt="Selezionare per visualizzare i grafici"></td></a></td></tr>
<?php
$j=0;
$check=0;
while (list($d,$c)=each($matriciona))  
{
if($j % 2) $colore='#99ccff'; else $colore='#99ccee';
?>
<!-- Come dovrebbe essere il codice
<td class="va12_n"> &nbsp;<nobr><a href="#">Quick</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;mm/s</td>
			<td class="j">&nbsp;121&nbsp;</td>

			<td class="j">&nbsp;12&nbsp;</td>
			<td class="j">&nbsp;&nbsp;</td>
			<td class="j">&nbsp;1&nbsp;</td>
			<td class="j">&nbsp;2&nbsp;</td>
			<td class="j">&nbsp;&nbsp;</td>
			<td class="j">&nbsp;4&nbsp;</td>
			<td class="j">&nbsp;6&nbsp;</td>

			<td class="j">&nbsp;7&nbsp;</td><td>
			<input type="checkbox" name="tk" value="0">
			</td></tr><tr bgcolor="#ffdddd">
	-->		
<tr bgcolor="<?php echo $colore?>" >
     <td class="val12_n"><FONT SIZE=2  FACE="Verdana,Arial" color="black">&nbsp;<b><?php echo $mappa_lab[$d]['parametro'] ?></b>&nbsp;</td>
     <td  bgcolor="<?php echo $colore?>" class="a10_b"><FONT SIZE=2  FACE="Verdana,Arial" color="black">&nbsp;<b><?php echo $mappa_lab[$d]['unita_di_misura'] ?></b>&nbsp;</td>
 
<?php
$k=0;

$elementi=count($c);
$p=0;

//Permette di mantere un valore sui vari checkbox


while (list($e,$f)=each($c))
 { $ok=true;
 	
    while($ok)
	{
	if($e==$matrice[$k]['job_id'])
    {
	   $ok=false;
      ?>
	  <td  bgcolor="<?php echo $colore?>" class="j"><FONT SIZE=2  FACE="Verdana,Arial" color="black">&nbsp;<b><?php echo $f ?></b>&nbsp;</td>
  	  <?php
	  $p++;
	  $k++;
    }
  	else
  	{
	//Necessario per riempire gli spazi vuoti tra valori
	?>
	
  	  <td  bgcolor="<?php echo $colore?>" class="j"><FONT SIZE=2  FACE="Verdana,Arial" color="black">&nbsp;<b><?php echo " "  ?></b>&nbsp;</td>
  	<?php
	
	$k++;
	if($k>200) break;
	}
	
	/*
  	echo " job_id? ".$e." valore? ".$f;
  	echo "<br />";*/
   }
   //Consente di verificare se sono stati stampati tutti i risulati presenti e riempire nel caso 
   //gli spazi vuoti alla fine
   if($elementi==$p)
	{
		$temp=$k;
		while($i-$temp>0)
		{
			?>
		  <td  bgcolor="<?php echo $colore?>" class="j"><FONT SIZE=2  FACE="Verdana,Arial" color="black">&nbsp;<b><?php echo ""  ?></b>&nbsp;</td>
		  <?php
		  $temp++;
		  
		  }
		   ?>
			<td>
			<!--QUESTO $d ? il codice della prestazione!!!!-->
			<input type="checkbox" name="<?php echo "tk".$check?>" value="<?php echo $d ?>">
			</td>
			<?
		
			$check++;
   
		  
	}
	
 }


 

$j++; 

}


//exit;

?>
<!--
<td class="a12_b"><font color="#ffffff">&nbsp;<b><?php echo $matrice[$j]['test_date'] ?><br><?php echo $matrice[$j]['job_id'] ?></b>&nbsp;</td>
	<td  class="j"><font color="#ffffff">&nbsp;</td> 
 
   <td>&nbsp;<a href="javascript:prep2submit()"><img src="../../gui/img/common/default/chart.gif" border=0 align="absmiddle" width="16" height="17" alt="Selezionare per visualizzare i grafici"></td></a></td></tr>
  
   <tr bgcolor="#ffddee" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;</td>
	<td class="a12_a"><font color="#0000cc">&nbsp;<b><?php echo "AAAA" ?></b> Ora&nbsp;</td>
   <td>&nbsp;<a href="javascript:selectall()"><img src="../../gui/img/common/default/dwnarrowgrnlrg.gif" border=0 align="absmiddle" width="16" height="16" alt="Selezionare o deselezionare tutti i grafici"></a>
       </tr><tr bgcolor="#ffeeee">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">Quick</a></nobr> 
			</td>
			<td class="va12_p"> &nbsp;CICCIO</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;mm/s</td>
			<td class="j">&nbsp;34&nbsp;</td><td>
			<input type="checkbox" name="tk" value="0">
			</td></tr><tr bgcolor="#ffdddd">
			<td class="va12_n"> &nbsp;<nobr><a href="#">PTT</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;mm/s</td>
			<td class="j">&nbsp;4&nbsp;</td><td>
			<input type="checkbox" name="tk" value="1">
			</td></tr><tr bgcolor="#ffeeee">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">Hb</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;12 - 18</td>
			<td class="a10_b" >&nbsp;g/dl</td>
			<td class="j">&nbsp;<img src="../../gui/img/common/default/arrow_red_dwn_sm.gif" border=0 width="15" height="15"> <font color="red">4</font>&nbsp;</td><td>
			<input type="checkbox" name="tk" value="2">
			</td></tr><tr bgcolor="#ffdddd">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">Hk</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;36 - 58</td>
			<td class="a10_b" >&nbsp;%</td>
			<td class="j">&nbsp;<img src="../../gui/img/common/default/arrow_red_dwn_sm.gif" border=0 width="15" height="15"> <font color="red">4</font>&nbsp;</td><td>
			<input type="checkbox" name="tk" value="3">
			</td></tr><tr bgcolor="#ffeeee">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">RBC</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;4.5 - 5.5</td>
			<td class="a10_b" >&nbsp;mil/cmm</td>
			<td class="j">&nbsp;5&nbsp;</td><td>
			<input type="checkbox" name="tk" value="5">
			</td></tr><tr bgcolor="#ffdddd">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">T3</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;23&nbsp;</td><td>
			<input type="checkbox" name="tk" value="107">
			</td></tr><tr bgcolor="#ffeeee">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">Thyroxin/T4</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;32&nbsp;</td><td>
			<input type="checkbox" name="tk" value="108">
			</td></tr><tr bgcolor="#ffdddd">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">TSH basal</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;3&nbsp;</td><td>
			<input type="checkbox" name="tk" value="109">
			</td></tr><tr bgcolor="#ffeeee">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">TSH stim.</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;4&nbsp;</td><td>
			<input type="checkbox" name="tk" value="110">
			</td></tr><tr bgcolor="#ffdddd">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">TAB</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;3&nbsp;</td><td>
			<input type="checkbox" name="tk" value="111">
			</td></tr><tr bgcolor="#ffeeee">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">MAB</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;5&nbsp;</td><td>
			<input type="checkbox" name="tk" value="112">
			</td></tr><tr bgcolor="#ffdddd">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">TRAB</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;2&nbsp;</td><td>
			<input type="checkbox" name="tk" value="113">
			</td></tr><tr bgcolor="#ffeeee">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">Thyreoglobulin</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;1&nbsp;</td><td>
			<input type="checkbox" name="tk" value="114">
			</td></tr><tr bgcolor="#ffdddd">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">Thyroxinbind.Glob.</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;4&nbsp;</td><td>
			<input type="checkbox" name="tk" value="115">
			</td></tr><tr bgcolor="#ffeeee">
     		<td class="va12_n"> &nbsp;<nobr><a href="#">free T3</a></nobr> 
			</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="a10_b" >&nbsp;</td>
			<td class="j">&nbsp;2&nbsp;</td><td>
			<input type="checkbox" name="tk" value="116">
			</td></tr>
			-->
<input type="hidden" name="colsize" value="1">
<input type="hidden" name="params" value="">
<input type="hidden" name="ptk" value="15">

</table> 
<input type="hidden" name="sesso" value="<?php echo $risultati['sex']?>">  
<input type="hidden" name="num_max_parametri" value="<?php echo $check?>">
<input type="hidden" name="date_birth" value="<?php echo $risultati['date_birth']?>"> 
<input type="hidden" name="nome" value="<?php echo $risultati['name_first']?>"> 
<input type="hidden" name="colonne" value="<?php echo $i?>">
<input type="hidden" name="cognome" value="<?php echo $risultati['name_last']?>"> 
<?php
echo '
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="from" value="'.$from.'">
<input type="hidden" name="encounter_nr" value="'.$encounter_nr.'">
<input type="hidden" name="edit" value="'.$edit.'">
<input type="hidden" name="lang" value="'.$lang.'">';



if($from=='input'){
	echo '
<input type="hidden" name="parameterselect" value="'.$parameterselect.'">
<input type="hidden" name="job_id" value="'.$job_id.'">
<input type="hidden" name="allow_update" value="'.$allow_update.'">';
}
?>                                         
<input type="hidden" name="user_origin" value="<?php echo $user_origin ?>">
</td></tr>
</table>
</form>

<p>
<?php
/*echo '
<button onClick="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph.'</button>';
*/
echo '
<button onClick="javascript:document.labdata.submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph.'</button>';
?>&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> alt="<?php echo $LDClose ?>"></a>
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
