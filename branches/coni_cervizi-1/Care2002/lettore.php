<?php
mysql_connect('localhost','root','');
mysql_select_db('caredb');
##PER IL SERVER, DA COPIARE SOTTO CARE
/*
mysql_connect("localhost",'francesco','francesco');
mysql_select_db('care');
*/
#COPIARE ANCHE IL FILE SUL SERVER!!!!
$arrayfile=file('ana-finale5.csv');
$i=0;
while($arrayfile[$i])
{
//echo $arrayfile[$i];
$appoggio=split(";",$arrayfile[$i]);

$appoggio[2]=ltrim(rtrim($appoggio[2]));
$posiz1=strpos(ltrim(rtrim($appoggio[2]))," ");
$posiz2=strrpos(ltrim(rtrim($appoggio[2]))," ");
if ($posiz1==$posiz2 && $posiz1)
$nome=strtoupper(substr($appoggio[2],0,1)).strtolower(substr($appoggio[2],1,$posiz1-1))." ".strtoupper(substr($appoggio[2],$posiz1+1,1)).strtolower(substr($appoggio[2],$posiz1+2));
else if ($posiz1!=$posiz2 && $posiz1)
$nome=strtoupper(substr($appoggio[2],0,1)).strtolower(substr($appoggio[2],1,$posiz1-1))." ".strtoupper(substr($appoggio[2],$posiz1+1,1)).strtolower(substr($appoggio[2],$posiz1+2))." ".strtoupper(substr($appoggio[2],$posiz2+1,1)).strtolower(substr($appoggio[2],1,$posiz2+2));
else
$nome=substr($appoggio[2],0,1).strtolower(substr($appoggio[2],1));

$appoggio[1]=ltrim(rtrim($appoggio[1]));
$posiz3=strpos($appoggio[1]," ");
$posiz4=strrpos($appoggio[1]," ");
if ($posiz3==$posiz4 && $posiz3)
$cognome=strtoupper(substr($appoggio[1],0,1)).strtolower(substr($appoggio[1],1,$posiz3-1))." ".strtoupper(substr($appoggio[1],$posiz3+1,1)).strtolower(substr($appoggio[1],$posiz3+2));
else if ($posiz3!=$posiz4 && $posiz3)
$cognome=strtoupper(substr($appoggio[1],0,1)).strtolower(substr($appoggio[1],1,$posiz3-1))." ".strtoupper(substr($appoggio[1],$posiz3+1,1)).strtolower(substr($appoggio[1],$posiz3+2))." ".strtoupper(substr($appoggio[1],$posiz4+1,1)).strtolower(substr($appoggio[1],1,$posiz4+2));
else
$cognome=strtoupper(substr($appoggio[1],0,1)).strtolower(substr($appoggio[1],1));
/*
echo "<b>Nome</b> ".substr($appoggio[2],0,1).strtolower(substr($appoggio[2],1));
echo "<br />Cognome ".substr($appoggio[1],0,1).strtolower(substr($appoggio[1],1));
if($appoggio[3])
echo "<br />Data di nascita ".substr($appoggio[3],6,4).substr(str_replace("/","-",$appoggio[3]),2,3).substr(str_replace("/","-",$appoggio[3]),2,1).substr(str_replace("/","-",$appoggio[3]),0,2);
if($appoggio[4])
echo "<br />Comune di nascita ".strtoupper(substr($appoggio[4],0,1)).strtolower(substr($appoggio[4],1));
if($appoggio[5])
echo "<br />Sesso ".$appoggio[5];
if($appoggio[7])
echo "<br />Numero di telefono ".$appoggio[7];
if($appoggio[8])
echo "<br />Via di residenza ".$appoggio[8];
if($appoggio[9] && $appoggio[9]!=0)
echo "<br />Peso".$appoggio[9];
if($appoggio[10] && $appoggio[10]!=0)
echo "<br />Altezza".$appoggio[10];
if($appoggio[13])
echo "<br />Qualifica ".$appoggio[13];
if($arrayfile[$i][14])
echo "<br /> Federazione ".$appoggio[14];
if($appoggio[15] && $appoggio[15]!="-1.0")
{
//echo $appoggio[15];
$sportspecia=split("-",$appoggio[15]);
echo "<br /> Sport ".$sportspecia[0];
if ($sportspecia[1])
echo "<br /> Specialita' ".$sportspecia[1];
}
echo "<br />";
*/
//echo "<b>NOME</b>".$nome."<br />";
//echo "<b>COGNOME</b>".$cognome."<br />";
$query="INSERT INTO care_person (name_first,name_last,date_birth,name_middle,sex,phone_1_nr,sss_nr,addr_str,religion,name_maiden,name_3,date_reg,create_time) VALUES('".$nome."','".$cognome."','".substr($appoggio[3],6,4).substr(str_replace("/","-",$appoggio[3]),2,3).substr(str_replace("/","-",$appoggio[3]),2,1).substr(str_replace("/","-",$appoggio[3]),0,2)."','".$appoggio[4]."','".strtolower($appoggio[5])."','".$appoggio[7]."','".$appoggio[6]."','".str_replace("t'","t\'",str_replace("L'","L\'",str_replace("D'","D\'",str_replace("d'","d\'",str_replace("l'","l\'",$appoggio[8])))))."','".str_replace("a'","a\'",str_replace("l'","l\'",str_replace("d'","d\'",$appoggio[14])))."','".$sportspecia[0]."','".$sportspecia[1]."','".date("Y-m-d")." ".date("H:i:s")."',".date("YmdHis").")";
//echo " <b>NOME</b>".substr($appoggio[2],0,1).strtolower(substr($appoggio[2],1))." <b>COGNOME</b>".substr($appoggio[1],0,1).strtolower(substr($appoggio[1],1))."<br />";
$RIUSCITA=mysql_query($query);
//echo "<b>CARE PERSON</b>".$RIUSCITA;
if($RIUSCITA==0)
echo $query."<br />";
//$prova=$db->Execute($query);
$query2="SELECT pid FROM care_person ORDER BY pid DESC LIMIT 1";
$result=mysql_query($query2);
$row=mysql_fetch_array($result);
//$pid=$db->Execute($query2);
//$pid=$pid->FetchRow();
//echo "<b>PID</b> ".$row['pid']."<br />";
if ($appoggio[13]=="P.O.")
$assicu=14;
else if ($appoggio[13]=="I.N.")
$assicu=13;
else $assicu=1;
$query3="INSERT INTO care_encounter (in_ward,encounter_class_nr,pid,insurance_firm_id,encounter_date,create_time) VALUES (1,1,".$row['pid'].",".$assicu.",'".date("Y-m-d")." ".date("H:i:s")."',".date("YmdHis").")";
//echo "<b>CARE ENCOUNTER</b>".
mysql_query($query3);
//echo $query2."<br />";
//echo $query3."<br />";
$i++;
unset($sportspecia);
unset($appoggio);



}
echo "Je ho fatta!!!";

mysql_close();
exit;
?>