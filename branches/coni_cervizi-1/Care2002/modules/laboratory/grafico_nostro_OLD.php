<?php
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

require ("Mappa_lab.php");
	$sesso=$_POST['sesso'];
	$compleanno=$_POST['date_birth'];
	$adulto=true;
	$query="SELECT * FROM care_test_findings_chemlab WHERE encounter_nr=".$encounter_nr." ORDER BY job_id DESC LIMIT 0,7";
	$risposta=$db->Execute($query);
	while($dati=$risposta->FetchRow())
	{
	$risultati=unserialize($dati['serial_value']);
	while (list($a,$b)=each($risultati))
	{
		
		$array[$a]['valore']=rtrim($b)."~".trim($array['valore']);
		$array[$a]['parametro']=$mappa_lab[$a]['parametro'];
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
}
?>
<html>
<body>

<table  border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td bgcolor="#0D5BA7" >
<FONT  COLOR="#ffffff"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "Referti di Laboratorio - Grafici" ?></STRONG></FONT>
</td>
<td bgcolor="#0D5BA7" height="10" align=right ><nobr><a href="javascript:gethelp('lab_list.php','graph','','','<?php echo "LDGraph" ?>')"><img <?php echo "createLDImgSrc" ?>  <?php echo 'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo "createLDImgSrc" ?>  <?php echo 'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>

<tr>
<td colspan=2  bgcolor=#dde1ec><p><br>

<FONT    SIZE=-1  FACE="Arial">

<ul>

<table border=0>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo "LDCaseNr" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo "encounter_nr"; ?>&nbsp;
</td>
</tr>

<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo "LDLastName, LDName, LDBday" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php echo  "name_last"; ?>, <?php echo  "name_first"; ?>&nbsp;&nbsp;<?php echo  "date_birth"; ?></b>
</td>
</tr>
</table>

</UL>
<p>
<table border=0 bgcolor=#9f9f9f cellspacing=0 cellpadding=0>
<tr>
<td>

<?php
$max=$_POST['num_max_parametri'];
for ($i=0;$i<$max;$i++)
{
	$indice='tk'.$i;
	if ($_POST[$indice]!='')
{
?>
<td class="a10_b" >&nbsp;<?php /*echo "cacca".$array['CO251']['parametro']*/?><p><br>&nbsp;</td>
  			<td class="a10_b" ><?php echo $array[$_POST[$indice]]['parametro']?></td><td colspan="9"><img  src="../../main/imgcreator/labor-datacurve.php?sid=726ccab9817aa28290decac35d7b9c85&lang=en&cols=8&lo=<?php echo $array[$_POST[$indice]]['valore_min']?>&hi=<?php echo $array[$_POST[$indice]]['valore_max']?>&d=<?php echo $array[$_POST[$indice]]['valore']?>" border=0>
			</td></tr><tr bgcolor="#ffeeee">

<?php
}
}
?>
</body>
</html>
