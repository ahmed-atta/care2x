<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Nasıl başlanır ';

switch($x1)
{
 	case "giriş": print $foreword.'yeni hasta kabul'; break;
	case "ara": print $foreword.'bir hastanın kabul bilgisini ara';break;
	case "arşiv": print $foreword.'arşivde arama';break;
 }
?>

<?php if(!$x1) : ?>
// 		<?php require("help_tr_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Adım 1</b>
<ul>  <img src="../gui/img/control/default/en/en<?php switch($x1)
																			{
																				case "entry": print '_admit-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0"> düğmesini tıklayınız.
		
</ul>
<b>Adım 2</b>
<?php endif ?>
<ul> Eğer daha önce giriş yaptı iseniz ve bu işleve erişim hakkınız var ise ,  
<?php switch($x1)
	{
		case "giriş": print 'hasta kabul formu'; break;
		case "ara": print 'ara alanı '; break;
		case "arşiv": print 'arşiv de ara alanı'; break;
	}
?>  ana çerçevede görüntülenecektir.<br>
		Giriş yapmadı iseniz kullanıcı adı ve şifrenizi girmeniz istenecektir. <p>
		Kullanıcı adı ve şifrenizi girip <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düğmesini tıklayınız.<p>
		Eğer iptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
		
</ul>


</form>
<?php endif ?>
