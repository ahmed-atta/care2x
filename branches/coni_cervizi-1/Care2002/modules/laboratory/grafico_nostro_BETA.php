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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDLabReport - $LDGraph"; ?></STRONG></FONT>
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
   
<?php
$j=0;
$check=0;
while (list($d,$c)=each($matriciona))  
{
?>
<tr bgcolor="#99ccff" >
     <td class="val12_n"><FONT SIZE=2  FACE="Verdana,Arial" color="black">&nbsp;<b><?php echo $mappa_lab[$d]['parametro'] ?></b>&nbsp;</td>
     <td  bgcolor="#99ccff" class="a10_b"><FONT SIZE=2  FACE="Verdana,Arial" color="black">&nbsp;<b><?php echo $mappa_lab[$d]['unita_di_misura'] ?></b>&nbsp;</td>
 
<?php
$k=0;

$elementi=count($c);
$p=0;

//Permette di mantere un valore sui vari checkbox

}
}
/*echo '
<button onClick="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph.'</button>';
*/

require($root_path.'include/inc_load_copyrite.php');
?>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> alt="<?php echo $LDClose ?>"></a>
</UL>

</FONT>
</td>
</tr>
</table>        

</BODY>
</HTML>
