<?php
mysql_connect('localhost','root','');
mysql_select_db('caredb');

$arrayfile=file('../SocietaSportive/SOC_CONI2004_v.csv');
$i=0;
while($arrayfile[$i])
{
//echo $arrayfile[$i];
$appoggio=split(";",$arrayfile[$i]);
$nome=ltrim(rtrim(str_replace("\""," ",$appoggio[1])));
echo "<br /><b>CODICE</b> ".$appoggio[0]."<br />";
echo "<br /><b>DESCRIZIONE</b> ".$nome."<br />";
echo "<b>PRIVATO</b> ".$appoggio[2]."<br />";
echo "<b>UNISALUTE</b> ".$appoggio[3]."<br />";
echo "<b>UNISALUTE CONI</b> ".$appoggio[4]."<br />";

	for($j=0;$j<6;$j++)
	{
		switch($j)
		{
		case 0:
		$numero=1;
		$prezzo=$appoggio[4];
		break;
		case 1:
		$numero=10;
		$prezzo=$appoggio[3];
		break;
		case 2:
		$numero=11;
		$prezzo=$appoggio[2];
		break;
		case 3:
		$numero=12;
		$prezzo=$appoggio[4];
		break;
		case 4:
		$numero=13;
		$prezzo=$appoggio[4];
		break;
		case 5:
		$numero=14;
		$prezzo=$appoggio[4];
		break;
		}

//$nome=ltrim(rtrim(str_replace("\""," ",$appoggio[1])));
//$query="INSERT INTO prezzi_".$numero." (item_code,item_description,item_unit_cost,item_type,WHO) VALUES('CO".$appoggio[0]."','".$nome."','".$prezzo."','LT',0)";
	//	$riuscitaquery=mysql_query($query);
//echo $query;
	//	if($connessione && $riuscitaquery)
	//	echo "OK!!<br />";
	}
echo "<br />";
unset($sportspecia);
unset($appoggio);

$i++;

}
echo "Je ho fatta!!!";

mysql_close();

exit;
?>
