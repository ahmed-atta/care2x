<?php
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
# Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');

require($root_path."include/inc_img_fx.php");
require ("Mappa_lab.php");
?>
<html>
<head>
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
.a12_b{font-family:arial; font-size:12; color:#000000}
.j{font-family:verdana; font-size:12; color:#000000}
</style>

<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 >

<table  border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td bgcolor="#99ccff" >
<font  COLOR="#330066"  SIZE=+2  FACE="Arial"><strong><?php echo "Referti di Laboratorio - Grafici"?></strong></font>
</td>
<td bgcolor="#99ccff" height="10" align=right ><nobr><a 
href="javascript:gethelp('lab_list.php','','','','Referto di laboratorio')"><img 
src="../../gui/img/control/default/it/it_hilfe-r.gif" border=0 width="75" height="24"  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="" ><img src="../../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24"  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>

</nobr></td>
</tr>

<tr>
<td colspan=2  bgcolor=#dde1ec><p><br>

<font    SIZE=-1  FACE="Arial">

<ul>

<table border=0>
<tr>
<td bgcolor=#ffffff><font SIZE=-1  FACE="Arial">Codice paziente:
</td>
<td bgcolor=#ffffee><font SIZE=-1  FACE="Arial">&nbsp;<?php echo $encounter_nr?>&nbsp;
</td>

</tr>
<tr>
<td bgcolor=#ffffff><font SIZE=-1  FACE="Arial">Cognome, Nome, Data di nascita:
</td>
<td bgcolor=#ffffee><font SIZE=-1  FACE="Arial">&nbsp;<b><?php echo $_POST['cognome'].", ".$_POST['nome']."&nbsp;&nbsp;".$_POST['date_birth']?></b>
</td>
</tr>
</table>






<?php
	$sesso=$_POST['sesso'];
	$compleanno=$_POST['date_birth'];
	
	$query="SELECT * FROM care_test_findings_chemlab WHERE encounter_nr=".$encounter_nr." ORDER BY job_id DESC LIMIT 0,7";
	$risposta=$db->Execute($query);
	$z=0;
	$controllo=array();
	while($dati=$risposta->FetchRow())
	{
	$array_date[$z]['test_date']=$dati['test_date'];
	$array_date[$z]['test_time']=$dati['test_time'];
	$array_date[$z]['job_id']=$dati['job_id'];
	$risultati=unserialize($dati['serial_value']);
	while (list($a,$b)=each($risultati))
	{ //echo " codice ".$a." valore ".$b."####".$z."####";
		$controllo[$a]=$z;
		$array[$a]['valore']=rtrim($b)."~".trim($array[$a]['valore']);
		$array[$a]['parametro']=$mappa_lab[$a]['parametro'];
		$array[$a]['unita_di_misura']=$mappa_lab[$a]['unita_di_misura'];
		if ($mappa_lab[$a]['valore_max_uomo'])
		{
			switch($sesso)
			{
				case 'm' :
				{
				 $array[$a]['valore_max']=$mappa_lab[$a]['valore_max_uomo'];
				 $array[$a]['valore_min']=$mappa_lab[$a]['valore_min_uomo'];
				 break;
				}
				case 'f' :
				{
				 $array[$a]['valore_max']=$mappa_lab[$a]['valore_max_donna'];
				 $array[$a]['valore_min']=$mappa_lab[$a]['valore_min_donna'];
				 break;
				}
			}
		}
		else if ($mapp_lab[$a]['valore_max_adulti'])
		{
			if ($adulto)
			{
			 $array[$a]['valore_max']=$mappa_lab[$a]['valore_max_adulto'];
			 $array[$a]['valore_min']=$mappa_lab[$a]['valore_min_adulto'];
			}
			else
			{
			 $array[$a]['valore_max']=$mappa_lab[$a]['valore_max_bambino'];
			 $array[$a]['valore_min']=$mappa_lab[$a]['valore_min_bambino'];
			}
		}
		else
		{
		 $array[$a]['valore_max']=$mappa_lab[$a]['valore_max'];
		 $array[$a]['valore_min']=$mappa_lab[$a]['valore_min'];
		}
		if (!$array[$a]['valore_min']) $array[$a]['valore_min']=0.01;
	}
	#Qui proviamo a vedere di inserire i simboli necessari
		reset ($controllo);
	while (list($q,$t)=each($controllo))
		{
		//echo " zeta ".$t;
		 if ($t!=$z)
		 $array[$q]['valore']="~".$array[$q]['valore']; 
		// echo "codice ".$q." stringa".$array[$q]['valore'];
		}
		$z++;
}
?>




</UL>
<p>
<table border=1 bgcolor=#99ccff cellspacing=0 cellpadding=0>

<tr bgcolor="#0D5BA7" >
     <td width="80" class="va12_n" ><font color="#ffffff"><b align="center">Parametri</b>
	</td>
	<!--<td  class="j"><font color="#ffffff">&nbsp;<b>Campo normale</b>&nbsp;</td>-->
	<td  class="j" width="50"><font color="#ffffff"><b align="center">Unita' di Misura</b></td>
<?php
for ($h=$z-1;$h>=0;$h--) 
{
  ?>
  
  <td class="a12_b" width="99"><font color="#ffffff">&nbsp;<b><?php echo $array_date[$h]['test_date']?><br><?php echo $array_date[$h]['job_id']?></b>&nbsp;</td>
  <!--
  <td class="a12_b" width="99"><font color="#ffffff">&nbsp;<b>0000-00-00<br>10000044</b>&nbsp;</td>
  <td class="a12_b" width="99" ><font color="#ffffff">&nbsp;<b>2004-05-14<br>10000042</b>&nbsp;</td>
  <td class="a12_b" width="99"><font color="#ffffff">&nbsp;<b>0000-00-00<br>10000041</b>&nbsp;</td>
  <td class="a12_b" width="99"><font color="#ffffff">&nbsp;<b>2004-05-14<br>10000040</b>&nbsp;</td>
  <td class="a12_b" width="99"><font color="#ffffff">&nbsp;<b>2004-05-13<br>10000039</b>&nbsp;</td>
  -->
<?php
}
?>
</tr>
</table>
<table border=1  cellspacing=0 cellpadding=0>
<?php

$max=$_POST['num_max_parametri'];
$scelta_colore=0;
for ($i=0;$i<$max;$i++)
{

	$indice='tk'.$i;
	if ($_POST[$indice]!='')
{
if($scelta_colore % 2) $colore='#99ccff'; else $colore='#99ccee';
$scelta_colore++;
//echo "ciao".$array[$_POST[$indice]]['valore'];
?>

  			
			<td bgcolor="<?php echo $colore ?>" width="80" class="a12_b" align="Center"><?php echo $array[$_POST[$indice]]['parametro']?></td><td bgcolor="<?php echo $colore?>" width="50" class="j" align="center"><?php echo $array[$_POST[$indice]]['unita_di_misura']?></td><td><img  src="../../main/imgcreator/labor-datacurve.php?sid=726ccab9817aa28290decac35d7b9c85&lang=en&cols=<?php echo $_POST['colonne'] ?>&lo=<?php echo $array[$_POST[$indice]]['valore_min']?>&hi=<?php echo $array[$_POST[$indice]]['valore_max']?>&d=<?php echo $array[$_POST[$indice]]['valore']?>" border=1>
			</td><tr bgcolor="#ffffff"></tr>
			

<?php
}
}
?>
</table>
</body>
</head>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>


<a href="<?php echo "labor.php?lang=it" ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> alt="<?php echo Chiudi ?>"></a>
</html>
