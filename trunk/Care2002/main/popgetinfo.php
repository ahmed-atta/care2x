<HTML>
<HEAD>
<TITLE></TITLE>
<META name="description" content="">
<META name="keywords" content="">
<META name="generator" content="CuteHTML">

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.neuedaten.value="";
	}
-->
</script>


</HEAD>
<BODY  background=img/leinwand.gif TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="if (window.focus) window.focus()" >
<!--Don't forget to add your FREE HitBOX statistics to your web page. To
do so, click on Tools\Online Services\Add statistics...-->

<font face=verdana,arial size=5 color=maroon>

<?php 
	echo $window;
?>

</font>
<p>


<font face=verdana,arial size=3 >
<form name="infoform">
<font face=verdana,arial size=2 >Aktuelle Eintragung(en):<br></font>
<textarea cols="35" rows="4" name="aktuell">Dummy text</textarea>
<p>
<font face=verdana,arial size=2 ><b>Ihre neue Eintragung bitte hier unten eingeben:</b><br></font>
<textarea cols="35" rows="4" name="neuedaten"></textarea>
</form>
<p>
<a href="#" onClick="window.close()"><img src="../img/savedisc.gif" border="0" alt="Speichern und Fenster schliessen"></a>
&nbsp;&nbsp;
<a href="#" onClick="resetinput()"><img src="../img/verwerf.gif" border="0" alt="Eingeben verwerfen (Die alte Eintragungen bleiben)"></a>
&nbsp;&nbsp;
<a href="#" onClick="window.close()"><img src="../img/abbrech.gif" border="0" alt="Dieses Fenster schliessen ohne zu Speichern">
</a>

<script language="javascript">
<!-- 
  
	if (document.infoform.neuedaten) document.infoform.neuedaten.focus();
-->
</script>
</BODY>
</HTML>
