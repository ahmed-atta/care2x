<?

if($_POST['num_fatt'])
{

$file="iniziofattura.txt";
$fp=fopen($file,"w") or die ("errore in apertura");
fwrite($fp,$_POST['num_fatt']) or die("impossibile scrivere");
fclose($fp);
 echo "dati aggiornati";
}

else
{
?>
<html>
<header>

</header>
<body>
<form method="post" action="scrivifile.php">
<input type="text" name="num_fatt">
<input type="submit" name="b1" value="Invia">
</form>
</body>
</html>

<?
   }


?>