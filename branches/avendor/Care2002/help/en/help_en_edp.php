<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
EDP - 
<?
	switch($src)
	{
	case "access": switch($x1)
						{
							case "": print "Creating access right";
												break;
							case "save": print "New access right saved";
												break;
							case "list": print "Existing access rights";
												break;
							case "update": print "Editing an existing access right";
												break;
							case "lock":  if($x2=="0") print "Locking"; else print "Unlocking"; print  " an existing right";
												break;
							case "delete": print "Deleting an access right";
												break;
						}
						break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<? if($src=="access") : ?>
	<? if($x1=="") : ?>
		<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to create a new access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the complete name of the person, or the department, or clinic, etc in the "<span style="background-color:yellow" > Name </span>" field.<br>
 	<b>Step 2: </b>Enter the username  in the "<span style="background-color:yellow" > User login name </span>" field.<p>
	<b>Note:</b> Space is not allowed for the username.<p>
 	<b>Step 3: </b>Enter the password for the username "<span style="background-color:yellow" > Password </span>" field.<br>
 	<b>Step 4: </b>Select the areas where the user is allowed to enter in the  "<span style="background-color:yellow" > Area # </span>" field.<p>
	<b>Note:</b> A user can have a maximum of ten accessible areas (Area 1 up to Area 10).<p>
</ul>

	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
I am finished entering all relevant information. How to save it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Save">.<br>
</ul>
	<? endif ?>	
	<? if($x1=="save") : ?>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
The new access right is now saved. How to create another access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="OK"> button.<br>
 	<b>Step 2: </b>The entry form will appear.<br>
 	<b>Step 3: </b>To see further instructions on creating an access right, click the "Help" button.<br>
</ul>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
I want to see the list of the existing access rights. How to do it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="List actual access rights">.<br>
 	<b>Step 2: </b>The existing access rights will be listed<br>
</ul>
	
	<? endif ?>	
	<? if($x1=="list") : ?>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
What do the buttons <img src="../img/padlock.gif" border=0 align="absmiddle"> and <img src="../img/arrow-gr.gif" border=0 align="absmiddle"> mean?</b>
</font>
<ul>       	
 	<img src="../img/padlock.gif" border=0 align="absmiddle"> = The user's access right is locked or "freezed". He cannot enter the areas set as accessible.<br>
 	<img src="../img/arrow-gr.gif" border=0 align="absmiddle"> = The user's access right is not locked . He can enter the areas set as accessible.<br>
</ul>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
What do the options "C","L", and "D", or "U" mean?</b>
</font>
<ul>       	
 	<b>C: </b> = Change or edit the user's access data.<br>
 	<b>L: </b> = Lock the user's access right.<br>
 	<b>D: </b> = Delete the user's access right.<br>
 	<b>U: </b> = Unlock the user's access right (if currently locked).<br>
</ul>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to change or edit the user's access data?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > C </span>" corresponding to the user.<br>
</ul>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to lock the user's access data?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > L </span>" corresponding to the user.<br>
</ul>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to unlock the user's access data? (if currently locked)</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > U </span>" corresponding to the user.<br>
</ul>
		<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to delete an access right?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > D </span>" corresponding to the user.<br>
</ul>

	<? endif ?>	
	
	<? if($x1=="update") : ?>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to edit an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Edit the information.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Save">.<br>
</ul>
	<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Note:</b>
</font>
<ul>       	
 	If you decide not to edit click the button <input type="button" value="Cancel">.<br>
</ul>
	
	<? endif ?>		
	<? if($x1=="delete") : ?>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to delete an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>If you are sure you want to delete the access right,<br>
	 click the button <input type="button" value="Yes, I am dead sure. Delete access right.">.<br>
</ul>
	<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Note:</b>
</font>
<ul>       	
 	If you decide not to delete click the button <input type="button" value="No. Go back.">.<br>
</ul>
	
	<? endif ?>		
	
	<? if($x1=="lock") : ?>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to <? if($x2=="0") print "lock"; else print "unlock"; ?> an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>If you are sure you want to <? if($x2=="0") print "lock"; else print "unlock"; ?> the access right,<br>
	 click the button <input type="button" value="Yes, I'm sure.">.<br>
</ul>
	<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Note:</b>
</font>
<ul>       	
 	If you decide not to <? if($x2=="0") print "lock"; else print "unlock"; ?> click the button <input type="button" value="No. Go back.">.<br>
</ul>
	
	<? endif ?>		
<? endif ?>	

	</form>

