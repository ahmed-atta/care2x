<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?
switch($x2)
{
	case "search": print "How to "; 
 						if($x1) print 'display the ward\'s occupancy where the search keyword was found';
						else  print 'search for a patient';
						break;
	case "quick": print  "Nursing - Quickview of today's ward occupancy";
						break;
	case "arch": print "Nursing wards - Archive";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<? if($x2=="search") : ?>
<? if(!$x1) : ?>
<b>Step 1</b>

<ul> Enter  in the "<span style="background-color:yellow" >Please enter a search keyword.</span>" 
	field either a full information or the first few letters, like for example a name, or Given name, or both.
		<ul type=disc><li>Example 1: enter "Guerero" or "gue".
		<li>Example 2: enter "Alfredo" or "Alf".
		<li>Example 3: enter "Guerero, Alf".
	</ul>	
</ul>
<b>Step 2</b>
<ul> Click the button <input type="button" value="Search"> to start the search.<p>
</ul>
<b>Step 3</b>
<ul> If the search finds one result, the ward's occupancy list where the search keyword is found will be displayed.<p>
</ul>
<b>Step 4</b>
<ul> If the search finds several results, a list of the results will be displayed.<p>
</ul>
<b>Note</b>
<ul> If you decide to cancel search click the button <img src="../img/en/en_cancel.gif" border=0>.
</ul><? endif ?>
<b>Step <? if($x1) print "1"; else print "5"; ?></b><ul>Click the button <img src="../img/bul_arrowBluSm.gif" width=12 height=12 border=0>,
 or the date, or the ward to display the ward's occupancy list.
<p><b>Note:</b> The search keyword will be highlighted in the list.
<br><b>Note:</b> The list is not editable "read only mode". If you attempt to open the patient's data folder by clicking on its name, you will be prompted to
enter your username and password.
</ul>
<? endif ?>
<? if($x2=="quick") : ?>
	<? if($x1) : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to show the ward's occupancy list?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the ward's id or name on the left column.<br>
	<b>Note: </b>The occupancy list that will be displayed is "read only". You cannot edit or change any patients' data.<br>
	</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to show  the ward's occupancy list for editing or updating data?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the icon <img src="../img/statbel2.gif" width=20 height=20 border=0> corresponding to the chosen ward.<br>
 	<b>Step 2: </b>If you have logged in before and you have access right for the function, the occupancy list will be displayed immediately.<br>
		Otherwise,  you will be asked to enter your username and password.<br>
 	<b>Step 3: </b>If asked, enter your username and password.<br>
 	<b>Step 4: </b>Click the button <input type="button" value="Continue...">.<br>
 	<b>Step 5: </b>If you have an access right for the function, the occupancy list will be displayed.<br>
	<b>Note: </b>The occupancy list that will be displayed can be "edited". Options for editing or updataing patients' data will be displayed.
		You can also open the patients' data folder for further editing.<br>
	</ul>
	<? else : ?>
<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b>
There is no available occupancy list at the moment!</b>
</font><p>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to display previous occupancy quickviews using the archive?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click "<span style="background-color:yellow" > Click this to go to archive <img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0> </span>".<br>
 	<b>Step 2: </b>A guide calendar will appear.<br>
 	<b>Step 3: </b>Click on a date in the calendar to display the occupancy quickview for that day.<br>
	</ul>
	
	<? endif ?>
<b>Note</b>
<ul> If you decide to close the quickview click the button <img src="../img/en/en_close2.gif" border=0>.
</ul><? endif ?>

<? if($x2=="arch") : ?>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to display previous occupancy quickviews using the archive?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click on a date in the calendar to display the occupancy quickview for that day.<br>
	</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to change the guide calendar's month?</b>
</font>
<ul>       	
 	<b>Step 1: </b>To display next month, click on the month's name on the upper RIGHT corner of the guide calendar.
								Click as many times as needed until the desired month is displayed.<p>
 	<b>Step 2: </b>To display previous month, click on the month's name on the upper LEFT corner of the guide calendar.
								Click as many times as needed until the desired month is displayed.<br>
	</ul>
	
	<? endif ?>


</form>

