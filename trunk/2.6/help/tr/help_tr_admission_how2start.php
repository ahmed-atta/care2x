<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Nas�l ba�lan�r ';

switch($x1)
{
 	case "giri�": print $foreword.'yeni hasta kabul'; break;
	case "ara": print $foreword.'bir hastan�n kabul bilgisini ara';break;
	case "ar�iv": print $foreword.'ar�ivde arama';break;
 }
?>

<?php if(!$x1) : ?>
// 		<?php require("help_tr_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Ad�m 1</b>
<ul>  <img src="../gui/img/control/default/en/en<?php switch($x1)
																			{
																				case "entry": print '_admit-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0"> d��mesini t�klay�n�z.
		
</ul>
<b>Ad�m 2</b>
<?php endif ?>
<ul> E�er daha �nce giri� yapt� iseniz ve bu i�leve eri�im hakk�n�z var ise ,  
<?php switch($x1)
	{
		case "giri�": print 'hasta kabul formu'; break;
		case "ara": print 'ara alan� '; break;
		case "ar�iv": print 'ar�iv de ara alan�'; break;
	}
?>  ana �er�evede g�r�nt�lenecektir.<br>
		Giri� yapmad� iseniz kullan�c� ad� ve �ifrenizi girmeniz istenecektir. <p>
		Kullan�c� ad� ve �ifrenizi girip <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> d��mesini t�klay�n�z.<p>
		E�er iptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
		
</ul>


</form>
<?php endif ?>
