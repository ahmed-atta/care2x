<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>How to 
<?
switch($src)
{
 	case "search": print 'search for a phone number'; break;
	case "dir": print 'open the entire directory';break;
	case "newphone": print 'enter new phone information';break;
 }
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="search") : ?>
<b>Step 1</b>

<ul> Enter  in the "<span style="background-color:yellow" >Enter search keyword.</span>" field either a full information or a few letters, like for example the ward's or department's code, a name, or Given name,
		or a room number.
		<br>Example 1: enter "m9a" or "M9A" or "M9".
		<br>Example 2: enter "Guerero" or "gue".
		<br>Example 3: enter "Alfredo" or "Alf".
		<br>Example 4: enter "op11" or "OP11" or "op".
		
</ul>
<b>Step 2</b>
<ul> Click the button <input type="button" value="SEARCH"> to start the search.<p>
</ul>
<b>Step 3</b>
<ul> If the search finds result(s), a list will be displayed.<p>
</ul>
<?php endif ?>
<?php if($src=="dir") : ?>
<b>Step 1</b>
<ul> Click the button <img src="../img/en/en_phonedir-gray.gif" border="0">.
</ul>
<?php endif ?>
<?php if($src=="newphone") : ?>
<b>Step 1</b>
<ul> Click the button <img src="../img/en/en_newdata-gray.gif" border="0">.
</ul>
<b>Step 2</b>
<ul> If you have logged in before and you have an access right for this function, the 
		entry form for new phone information  will appear on the main frame.<br>
		Otherwise, if you are not logged in, you will be required to enter your username and password. <p>
		Enter your username and password and click the button <img src="../img/en/en_continue.gif" border=0>.<p>
		If you decide to cancel click the button <img src="../img/en/en_cancel.gif" border=0>.
		
</ul><?php endif ?>

<b>Note</b>
<ul> If you decide to cancel search click the button <img src="../img/en/en_cancel.gif" border=0>.
</ul>


</form>

