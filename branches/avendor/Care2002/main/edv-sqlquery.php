<? 
if (($sid=="")or($sid==NULL)or($sid!=$ck_sid)or($ck_edv_sql_user==""))
{header("Location: invalid-access-warning.php"); exit;}

require("../req/config-color.php");



$thisfile="edv-sqlquery.php";

$dbname="maho";
				$link=mysql_connect("localhost","httpd","");
				if ($link)
 				{ if(mysql_select_db($dbname,$link)) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$itemname.'"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{if ($finalcommand=="delete")
								{	
									$sql='DELETE FROM mahopass WHERE mahopass_id="'.$itemname.'"';	
									if (mysql_query($sql,$link))
									{
							        header("Location: edv-accessplan-list.php?sid=$ck_sid&remark=itemdelete"); exit;
									}//else {print "Löschen der Daten gescheitert."}
								}else {$zeile=mysql_fetch_array($ergebnis);};
							}
							else {};
	
					};
				mysql_close($link);
				}
				 else 
				{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }


?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>EDV - SQL Datenbank manuelle eingabe</TITLE>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<? print $cfg['bot_bgcolor'];?>>


<FONT    SIZE=-1  FACE="Arial">

<P>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor'];?>">
<FONT  COLOR="<? print $cfg['top_txtcolor'];?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp; EDV - SQL Datenbank manuelle Eingabe</STRONG></FONT>



</td>
</tr>
<tr>
<td bgcolor=<? print $cfg['body_bgcolor'];?>>
<font face=verdan,arial size=2>&nbsp;  <b>Achtung!</b> Nur für SQL Experten!</font>

<p>
<ul>

<form method=post action=<?print $thisfile; ?>>
<table  border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffdd"><font face=verdana,arial size=2 color=#800000>
<p>
<b>Geben Sie den SQL Befehl (SQL Query) ein.</b><p>

<table border="0" cellpadding="5" cellspacing="1">
<tr>
<td><font face=verdana,arial size=2 color=#000080>SQL Befehl:<br>
<textarea name="sqlquery" cols=40 rows=10 wrap="physical"></textarea>

</td>
</tr>

<tr><td><input type="submit" value="Befehl schicken"><p>
		<input type="reset" value="Eingabe verwerfen"></td>
</tr>
</table>

</form>
</ul>
</td>
</tr>
</table>        

<p>

</td>
</tr>
</table>        
<br>

<FORM  method=get action="edv-sqlquery-pass.php" >
<input type=hidden name=sid value="<?print $ck_sid;?>">
<INPUT type="submit"  value="Abbrechen"></FORM>
<p>
<img src="../img/small_help.gif" border=0 width=20 height=20> <a href="edv-accessplan-wie.htm">Wie verwalte ich die Zugangsberechtigungen?</a><br>
<img src="../img/small_help.gif" border=0 width=20 height=20> <a href="edv-accessplan-werwo.htm">Wer hat wo Zugangsberechtigung?</a><br>
<HR>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>


</FONT>


</BODY>
</HTML>
