<html>

</SCRIPT>



<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 >

<table width=100% border=0 height=10 cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="#99ccff" height="10">
<font  COLOR="#330066"  SIZE=+2  FACE="Arial">
<strong> &nbsp; Statistiche sui medici</strong></font></td>
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

<form name="dati" method="Post" action="test_medici.php">
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
<b>Seleziona l'area di interesse</b>
<br />
<select title="Reparto" name="reparto"> 
<option>Tutti i reparti</option>
<option>Medicina</option>
<option>Nutrizione</option>
<option>Cardiologia</option>
<option>Ortopedia</option>
<option>Fisioterapia</option>
<option>Diagnostica Eco Rx</option>
<option>Neurologia ed Elettroencefalografia</option>
<option>Otorinolaringoiatria</option>
<option>Oftalmologia</option>
<option>Ginecologia</option>
<option>Eco Internistica</option>
<option>Endocrinologia</option>
<option>Urologia</option>
<option>Immunologia e allergologia</option>
<option>Angiologia</option>
<option>Medicina Legale</option>
<option>Neurofisiologia</option>
<option>Laboratorio analisi</option>
	</td>
	<td align="left">
<b>Seleziona il medico</b>
<br />
<select title="Dottore" name="dottore">
<option>Tutti i dottori</option>
<optgroup label="Medicina">
        <option>Tutti i dottori</option>
		<option>Giovanna Berlutti</option>
		<option>Roberto Ciardo</option>
		<option>Giuseppe Marcello</option>
		<option>Filippo Quattrini</option>
		<option>Amedeo Bagarone</option>
		<option>Vincenzino Siani</option>
    </optgroup>
	<optgroup label="Nutrizione">
        <option>Tutti i dottori</option>
		<option>Giovanna Berlutti</option>
		<option>Tamara Pamich</option>
		<option>Loredana Torrisi</option>
		<option>Vincenzino Siani</option>
    </optgroup>
	<optgroup label="Cardiologia">
        <option>Tutti i dottori</option>
		<option>Giuseppe Marcello</option>
		<option>Filippo Quattrini</option>
		<option>Alessandro Biffi</option>
		<option>Antonio Pelliccia</option>
		<option>Antonio Spataro</option>
		<option>Roberto Ciardo</option>
		<option>Fernando Di Paolo</option>
		<option>Frederik Fernando</option>
    </optgroup>
	<optgroup label="Ortopedia">
		<option>Tutti i dottori</option>
       	<option>Domenico Bonsignore</option><!--Ortopedia-->
		<option>Vincenzo Candela</option><!--Ortopedia-->
		<option>Arrigo Giombini</option><!--Ortopedia-->
    </optgroup>
	<optgroup label="Fisioterapia">
		<option>Tutti i dottori</option>
       	<option>Mauro Badia</option><!--Fisioterapia-->
		<option>Angelo Cavalli</option><!--Fisioterapia-->
		<option>Anna Loddo</option><!--Fisioterapia-->
		<option>Loredana Romano</option><!--Fisioterapia-->
		<option>Franco Russo</option><!--Fisioterapia-->
		<option>Alberto Salvati</option><!--Fisioterapia-->
    </optgroup>
	<optgroup label="Diagnostica Eco Rx">
		<option>Tutti i dottori</option>
       	<option>Stefano Dragoni</option><!--Diagnostica Eco Rx-->
		<option>Massimo Matone</option><!--Diagnostica Eco Rx-->
		<option>Giulia Cerenzia</option><!--Diagnostica Eco Rx, Ginecologia-->
		<option>Fernando Pischedda</option><!--Diagnostica Eco Rx-->
		<option>Ezio Serafin</option><!--Diagnostica Eco Rx-->
    </optgroup>
	<optgroup label="Neurologia ed Elettroencefalografia">
		<option>Tutti i dottori</option>
       	<option>Rita Marchini</option><!--Neurologia-->
		<option>Stefano Romeo</option><!--Neurologia-->
		<option>Stefano Tamorri</option><!--Neurologia-->
    </optgroup>
	<optgroup label="Otorinolaringoiatria">
       	<option>Antonio Matricciani</option>
    </optgroup>
	<optgroup label="Oftalmologia">
		<option>Tutti i dottori</option>
       	<option>Antonello Bassano</option><!--Oftalmologia-->
		<option>Daniela Lodi</option><!--Oftalmologia-->
		<option>Giacomo Carlo Modugno</option><!--Oftalmologia-->
    </optgroup>
	<optgroup label="Ginecologia">
		<option>Tutti i dottori</option>
        <option>Brunella Sicilia</option><!--Ginecologia-->
		<option>Massimo Matone</option><!--Ginecologia-->
    </optgroup>
	<optgroup label="Endocrinologia">
       	<option>Marco Cappa</option>
    </optgroup>
	<optgroup label="Urologia">
       	<option>Gino Calderini</option><!--Urologia-->
    </optgroup>
	<optgroup label="Immunologia e allergologia">
       	<option>Sergio Bonini</option>
    </optgroup>
	<optgroup label="Angiologia">
		<option>Tutti i dottori</option>
       	<option>Fernando Di Paolo</option>
		<option>Annarita Todini</option><!--Angiologia-->
    </optgroup>
	<optgroup label="Medicina Legale">
       <option>Natale Mario Di Luca</option><!--Medicina Legale-->
    </optgroup>
	<optgroup label="Neurofisiologia">
		<option>Ciriaco Scoppetta</option><!--Neurofisiologia-->
    </optgroup>
	/optgroup>
	<optgroup label="Laboratorio">
		<option>Tutti i dati</option><!--Neurofisiologia-->
    </optgroup>
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
