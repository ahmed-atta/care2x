<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$foreword='
<form action="#">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Nas�l ba�lamal� ';

switch($x1)
{
 	case "entry": print $foreword.'yeni bir t�bbi belgeye'; break;
	case "search": print $foreword.'Bir t�bbi belge arama ';break;
	case "archiv": print $foreword.'t�bbi belgeler ar�ivinde ara�t�rma';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_tr_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Ad�m 1</b>
<ul> <img src="../img/tr/tr<?php switch($x1)
																			{
																				case "entry": print '_newdata-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0"> d��mesini t�klay�n�z.
		
</ul>
<b>Ad�m 2</b>
<?php endif ?>
<ul> E�er daha �nce giri� yapt� iseniz ve bu fonksiyona eri�im hakk�n�z var ise 
<?php switch($x1)
	{
		case "entry": print 'ilk belge formu'; break;
		case "search": print 'arama alan� '; break;
		case "archiv": print 'ar�iv arama alan�'; break;
	}
?>  ana �er�evede g�r�nt�lenir.<br>
		Giri� yapmad� iseniz, kullan�c� ad� ve �ifreniz sorulur.. <p>
		Kullan�c� ad� ve �ifrenizi girip  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> d��mesini t�klay�n�z.<p>
		�ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
		
</ul>


</form>
<?php endif ?>
