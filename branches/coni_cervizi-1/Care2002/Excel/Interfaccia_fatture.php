<html>

</SCRIPT>



<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 >

<table width=100% border=0 height=10 cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="#99ccff" height="10">
<font  COLOR="#330066"  SIZE=+2  FACE="Arial">
<strong> &nbsp; Statistiche per le fatture</strong></font></td>
<td bgcolor="#99ccff" height="10" align=right><a href="../main/startframe.php?lang=it"><img src="../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24" alt=""  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
</table>
<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//echo "root vale".$root_path;
$root_path='../';
require($root_path.'roots.php');
$root_path='../';
require($root_path.'include/inc_environment_global.php');
//require_once($root_path.'include/inc_front_chain_lang.php'); 
/*echo "han".addslashes($userid);
require_once($root_path.'global_conf/areas_allow.php');
$allowedareas=&$allow_area['Permessi'];
*/
echo $allowedarea[0];
?>

<form name=dati method="Post" action="test_fatture.php">
<table width="400" height="300" border=0 align="center" cellspacing="15" background="../CONIServizi.jpg">
<tr>
	<td width="350" align="right" >
		
<b>Seleziona il giorno iniziale</b>
<br />
<select title="Giorno" name="giorno">
<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>
</td>
<td width="350" align="left">
 <b>Seleziona il giorno finale</b>
<br />
<select title="Giorno" name="giorno2">
<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>

</select>
	</td>
</tr>
<tr>
	<td width="350" align="right">
<b>Seleziona il mese iniziale</b>
<br />
<select title="Mese" name="mese">
<option>Gennaio</option>
<option>Febbraio</option>
<option>Marzo</option>
<option>Aprile</option>
<option>Maggio</option>
<option>Giugno</option>
<option>Luglio</option>
<option>Agosto</option>
<option>Settembre</option>
<option>Ottobre</option>
<option>Novembre</option>
<option>Dicembre</option>
</select>	
	</td>
	<td width="350" align="left">
<b>Seleziona il mese finale</b>
<br />
<select title="Mese" name="mese2">
<option>Gennaio</option>
<option>Febbraio</option>
<option>Marzo</option>
<option>Aprile</option>
<option>Maggio</option>
<option>Giugno</option>
<option>Luglio</option>
<option>Agosto</option>
<option>Settembre</option>
<option>Ottobre</option>
<option>Novembre</option>
<option>Dicembre</option>
</select>
	</td>
</tr>
<tr>
	<td width="350" align="right">	
  <b>Seleziona l'anno iniziale</b>
<br />
<select title="anno" name="anno"> Mese
<option>2004</option>
<option>2005</option>
</select>
	</td>
	<td width="350" align="left">
<b>Seleziona l'anno finale</b>
<br />
<select title="anno" name="anno2">
<option>2004</option>
<option>2005</option>
</select>	
	</td>
</tr>	
<tr>
	<td align="right">
	<input type="submit" value="Invia" />
	</td>
	<td align="left">
	<input type="reset" value="Resetta" />
	</td>
</tr>
</table>



	<!--
<option>Tutti i dottori</option>
<option>Berlutti Giovanna</option> 
<option>Ciardo Roberto</option>
<option>Marcello Giuseppe</option> 
<option>Quattrini Filippo Maria</option>
<option>Bagarone Amedeo</option>
<option>Siani Vincenziono</option>
<option>Pamich Tamara</option>
<option>Torrisi Loredana</option>
<option>Biffi Alessandro</option>
<option>Pelliccia Antonio</option>
<option>Spataro Antonio</option>
<option>Ciardo Roberto</option>
<option>Di Paolo Fernando</option>
<option>Fernando Frederik</option>
<option>Bonsignore Domenico</option>
<option>Candela Vincenzo</option>
<option>Giombini Arrigo</option>
<option>Badia Mauro</option>
<option>Cavalli Angelo</option>
<option>Loddo Anna</option>
<option>Romano Loredana</option>
<option>Russo Franco</option>
<option>Salvati Alberto</option>
<option>Dragoni Stefano</option>
<option>Matone Massimo</option>
<option>Cerenzia Giulia</option>
<option>Pischedda Fernando</option>
<option>Serafin Ezio</option>
<option>Marchini Rita</option>
<option>Romeo Stefano</option>
<option>Tamorri Stefano</option>
<option>Matricciani Antonio</option>
<option>Bassano Antonello</option>
<option>Lodi Daniela</option>
<option>Modugno Giacomo Carlo</option>
<option>Sicilia Brunella</option>
<option>Matone Massimo</option>
<option>Todini Annarita</option>
<option>Cappa Marco</option>
<option>Calderini Gino</option>
<option>Bonini Sergio</option>
<option>Di Luca Natale Mario</option>
<option>Scoppetta Ciriaco</option>
-->
</form>

</html>
