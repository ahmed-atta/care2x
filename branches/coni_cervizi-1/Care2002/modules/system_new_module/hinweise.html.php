<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="OpenOffice.org 1.1.0  (Win32)">
	<META NAME="CREATED" CONTENT="20040504;12084154">
	<META NAME="CHANGED" CONTENT="20040504;12211982">
	<STYLE>
	<!--
		@page { size: 21.59cm 27.94cm; margin: 2cm }
		P { margin-bottom: 0.21cm }
	-->
	</STYLE>
</HEAD>
<BODY LANG="de-DE" DIR="LTR">
<P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>Ihr
neues Modul ist beinahe fertig.</FONT></FONT></P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><BR>
</P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>Aber
Sie m&uuml;ssen noch folgende &Auml;nderungen manuell vornehmen, da
diese derzeit noch nicht</FONT></FONT></P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>automatisiert
werden k&ouml;nnen.</FONT></FONT></P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>Beispielhaft
gehe ich von einem neuen Modul namens test im Ordner /modules/ aus.</FONT></FONT></P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><BR>
</P>
<OL>
	<LI><P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>Wechseln
	Sie in den Ordner des neu erstellten Moduls nach /modules/test</FONT></FONT></P>
</OL>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><BR>
</P>
<OL START=2>
	<LI><P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>&Ouml;ffnen
	Sie die Datei test-main-pass.php mit einem geeigneten Editor
	(HTML-Kit)</FONT></FONT></P>
</OL>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><BR>
</P>
<OL START=2>
	<OL>
		<LI><P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>In
		Zeile 19 gibt es eine Array-Variable $allowedarea[]. Diese sollte  
		                       </FONT></FONT>
		</P>
		<P LANG="en-US" STYLE="margin-bottom: 0cm">  <FONT FACE="Courier New"><FONT SIZE=2>sinnigerweise
		als Wert den Modulnamen enthalten, </FONT></FONT>
		</P>
		<P LANG="en-US" STYLE="margin-bottom: 0cm">  <FONT FACE="Courier New"><FONT SIZE=2>z.B.:
		$allowedarea=&amp;$allow_area['test'];</FONT></FONT></P>
		<P LANG="en-US" STYLE="margin-bottom: 0cm"></P>
		<LI><P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>In
		Zeile 25 begintn ein &quot;Switch ($target)&quot;. Sollte ein
		weiteres    </FONT></FONT>
		</P>
		<P LANG="en-US" STYLE="margin-bottom: 0cm">  <FONT FACE="Courier New"><FONT SIZE=2>Untermodul
		     </FONT></FONT>
		</P>
	</OL>
</OL>
<OL START=2>
	<OL START=2>
		<P LANG="en-US" STYLE="margin-bottom: 0cm">    <FONT FACE="Courier New"><FONT SIZE=2>angelegt
		werden, mu&szlig; hier ein weiteres case manuell erstellt werden.</FONT></FONT></P>
		<P LANG="en-US" STYLE="margin-bottom: 0cm"></P>
	</OL>
</OL>
<OL START=2>
	<OL START=3>
		<LI><P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>In
		der Variable $fileforward muss die Zieldatei angegeben werden.</FONT></FONT></P>
		<P LANG="en-US" STYLE="margin-bottom: 0cm"></P>
	</OL>
</OL>
<OL START=2>
	<OL START=4>
		<LI><P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>In
		der Variable $this_cookie_name den cookie auf </FONT></FONT>
		</P>
		<P STYLE="margin-bottom: 0cm">  <SPAN LANG="en-US"><FONT SIZE=2><FONT FACE="Courier New">&quot;ck_&quot;
		+ Modulname + &quot;_user&quot; also im Bsp.: 'ck_test_user' </FONT></FONT></SPAN>.</P>
	</OL>
</OL>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><BR>
</P>
<OL START=3>
	<LI><P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>&Ouml;ffnen
	sie die Datei areas_allow.php im Ordner /global_conf.</FONT></FONT></P>
</OL>
<P LANG="en-US" STYLE="margin-bottom: 0cm">   <FONT FACE="Courier New"><FONT SIZE=2>Hier
muss am Ende ein Eintrag erfolgen.</FONT></FONT></P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><BR>
</P>
<OL START=3>
	<OL>
		<LI><P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>Ensprechend
		in den Unterordnern von /global_conf/de z.B. die</FONT></FONT></P>
	</OL>
</OL>
<P LANG="en-US" STYLE="margin-bottom: 0cm">          <FONT FACE="Courier New"><FONT SIZE=2>Sprachdatei
accessplan_areas.php, muss ebenfalls nen Eintrag erhalten 		damit man
im anderen Men&uuml; unter EDV die Rechte f&uuml;r dieses Modul
&quot;test&quot; 		setzten kann.</FONT></FONT></P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><BR>
</P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>Somit
ist das neue Modul auch zugriffsgesichert, und relativ einfach
erweiterbar, was Untermen&uuml;s betrifft.</FONT></FONT></P>
<P LANG="en-US" STYLE="margin-bottom: 0cm"><FONT FACE="Courier New"><FONT SIZE=2>	</FONT></FONT></P>
<P STYLE="margin-bottom: 0cm"><BR>
</P>
</BODY>
</HTML>