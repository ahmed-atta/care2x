<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Bagaimana untuk memulai ';

switch($x1)
{
 	case "entry": print $foreword.'sebuah medocs dokumen baru'; break;
	case "search": print $foreword.'sebuah pencarian untuk sebuah medocs dokumen';break;
	case "archiv": print $foreword.'pencarian kebali dalam arsif medocs ';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_id_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Step 1</b>
<ul> Click the button <img src="../img/id/id<?php  switch($x1)
{
	case "entry": print '_newdata-gray.gif'; break;
	case "search": print '_such-gray.gif'; break;
	case "archiv": print '_arch-gray.gif'; break;
}
?>" border="0">.
		
</ul>
<b>Step 2</b>
<?php endif ?>
<ul> Jika anda telah login sebelumnya dan anda mempunyai hak akses untuk fungsi ini,
<?php switch($x1)
	{
		case "entry": print 'form inisial document '; break;
		case "search": print 'pencarian field '; break;
		case "archiv": print 'pencarian field arsif '; break;
	}
?>  akan muncul dalam frame utama .<br>
Sebaliknya, jika anda tidak login , anda perlu untuk memasukan username dan password.
Masukan username dan password dan click button <img src="../img/id/id_continue.gif" border=0>.
Jika anda  memutuskan untuk membatalkan klik tombol  <img src="../img/id/id_cancel.gif" border=0>.
</ul>


</form>
<?php endif ?>
