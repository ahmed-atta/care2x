<HTML>
<HEAD>
<TITLE></TITLE>
<META name="description" content="">
<META name="keywords" content="">
<META name="generator" content="CuteHTML">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080">



<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp; EDV - Zugangsberechtigungen Verwalten</STRONG></FONT>
<tr>
<td><FONT    SIZE=-1  FACE="Arial">
<tr bgcolor="silver">
<td ><p><br>
<ul>


<table bgcolor="aqua" border="1" cellpadding="10" cellspacing="1">

<tr>
<td colspan="3"><FONT    SIZE=-1  FACE="Arial">
mySQL communication protocol:<br>

<?


$link=mysql_connect("localhost","httpd","");
if ($link)
 { print "Verbindung zur Datenbank steht. <br>" ;

	if(mysql_select_db("echo2",$link)) 

	{	print "echo2 selected. <br>";

		$sql="INSERT INTO bongsdb (bongsdb_obj_name, bongsdb_obj_username, bongsdb_obj_password, bongsdb_obj_territory) 
		VALUES('$objname', '$user', '$password', '$bereich1')";

	if(mysql_query($sql,$link)){ echo mysql_affected_rows()." Daten wurden gespeichert. <p>"; 
		print "Name: ".$objname."<br>";
		print "Benutzerkennung: ".$user."<br>";
		print "Passwort: ".$password."<br>";
		print "Zulässige(r) Bereich(e): <br>";
		print "Bereich 1: ".$bereich1."<br>";
		print "Bereich 2: ".$bereich2."<br>";
		print "Bereich 3: ".$bereich3."<br>";
		print "Bereich 4: ".$bereich4."<br>";
		print "Bereich 5: ".$bereich5."<br>";
		print "Bereich 6: ".$bereich6."<br>";
		print "Bereich 7: ".$bereich7."<br>";

	}




	else {print "Das Speichern der Daten is gescheitert.";};
	};

	mysql_close($link);}

 else 
{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }

?>

</td>

</tr>
</table>





<FONT    SIZE=-1  FACE="Arial">

<p>
<FORM action="edv-accessplan-edit.php" >
<INPUT type="submit"  value="OK"></font></FORM>
<p>
</FONT>

</ul>


<p>
</td>
</tr>
</table>        
<p>

<FONT    SIZE=1  FACE="Arial">
Copyright &copy; 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts used here for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>



    
</BODY>
</HTML>
