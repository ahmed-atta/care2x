<?php
mysql_connect("localhost",'francesco','francesco');
mysql_select_db('care');
$query="Select * from care_encounter";
echo $query;
$risp=mysql_query($query);
while($risposta=mysql_fetch_array($result))
{
echo $risposta['encounter_nr']."<br />";
}
mysql_close();
?>