<?php
$pippo['primo']=12;
$pippo['secondo']=13;
$pippo['quarto']=1243556;

$datiserializzati=serialize($pippo);
echo " eccoci ".$datiserializzati;
$datinon=unserialize($datiserializzati);
echo "primo ".$datinon['primo'];
echo "secondo ".$datinon['secondo'];
echo "quarto ".$datinon['quarto'];
echo "vediamo...".$datinon[0];
?>