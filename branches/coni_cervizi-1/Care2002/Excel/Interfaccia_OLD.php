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

<form name=dati method="Post" action="test.php">
<table>
<tr>
<td>
<br />
Seleziona il giorno iniziale
<br />
<select title="Giorno" name="giorno">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
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
<br />
<br />
Seleziona il mese iniziale
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
<br	 />
<br	 />
<br	 />
Seleziona l'anno iniziale
<br />
<select title="anno" name="anno"> Mese
<option>2004</option>
<option>2005</option>

</select>
<br />
<br />
</td>
<td width="80">

</td>
<td>

Seleziona il giorno finale
<br />
<select title="Giorno" name="giorno2">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
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
<br />
<br />
Seleziona il mese finale
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
<br	 />
<br	 />
<br	 />
Seleziona l'anno finale
<br />
<select title="anno" name="anno2">
<option>2004</option>
<option>2005</option>

</select>
<br />
</td>
</tr>
<tr>
<td></td>
<td align="center">
<input type="submit" value="Invia" />
</td>
<td>
<br	 />
Seleziona l'area di interesse
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
<option>Laboratorio analisi</option>
</td>
<td>
Seleziona il medico
<br />
<select title="Dottore" name="dottore">
<option>Tutti i dottori</option>
<option>Berlutti Giovanna</option> <!--Medicina generale, Nutrizione-->
<option>Ciardo Roberto</option><!--Medicina generale-->
<option>Marcello Giuseppe</option><!--Medicina generale, Cardiologia-->
<option>Quattrini Filippo Maria</option><!--Medicina generale, Cardiologia-->
<option>Bagarone Amedeo</option><!--Medicina generale-->
<option>Siani Vincenziono</option><!--Medicina generale, Nutrizione-->
<option>Pamich Tamara</option><!--Nutrizione-->
<option>Torrisi Loredana</option><!--Nutrizione-->
<option>Biffi Alessandro</option><!--Cardiologia-->
<option>Pelliccia Antonio</option><!--Cardiologia-->
<option>Spataro Antonio</option><!--Cardiologia-->
<option>Ciardo Roberto</option><!--Cardiologia-->
<option>Di Paolo Fernando</option><!--Cardiologia, Angiologia-->
<option>Fernando Frederik</option><!--Cardiologia-->
<option>Bonsignore Domenico</option><!--Ortopedia-->
<option>Candela Vincenzo</option><!--Ortopedia-->
<option>Giombini Arrigo</option><!--Ortopedia-->
<option>Badia Mauro</option><!--Fisioterapia-->
<option>Cavalli Angelo</option><!--Fisioterapia-->
<option>Loddo Anna</option><!--Fisioterapia-->
<option>Romano Loredana</option><!--Fisioterapia-->
<option>Russo Franco</option><!--Fisioterapia-->
<option>Salvati Alberto</option><!--Fisioterapia-->
<option>Dragoni Stefano</option><!--Diagnostica Eco Rx-->
<option>Matone Massimo</option><!--Diagnostica Eco Rx-->
<option>Cerenzia Giulia</option><!--Diagnostica Eco Rx, Ginecologia-->
<option>Pischedda Fernando</option><!--Diagnostica Eco Rx-->
<option>Serafin Ezio</option><!--Diagnostica Eco Rx-->
<option>Marchini Rita</option><!--Neurologia-->
<option>Romeo Stefano</option><!--Neurologia-->
<option>Tamorri Stefano</option><!--Neurologia-->
<option>Matricciani Antonio</option><!--Otorinolaringoiatria-->
<option>Bassano Antonello</option><!--Oftalmologia-->
<option>Lodi Daniela</option><!--Oftalmologia-->
<option>Modugno Giacomo Carlo</option><!--Oftalmologia-->
<option>Sicilia Brunella</option><!--Ginecologia-->
<option>Matone Massimo</option><!--Ginecologia-->
<option>Todini Annarita</option><!--Angiologia-->
<option>Cappa Marco</option><!--Endocrinologia-->
<option>Calderini Gino</option><!--Urologia-->
<option>Bonini Sergio</option><!--Immunologia e Allergologia-->
<option>Di Luca Natale Mario</option><!--Medicina Legale-->
<option>Scoppetta Ciriaco</option><!--Neurofisiologia-->
</td>
</table>
</form>
