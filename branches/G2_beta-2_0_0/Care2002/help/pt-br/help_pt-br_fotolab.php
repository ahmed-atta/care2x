<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Photolab - 
<?php
	switch($src)
	{
	case "init": print "Initializing";
												break;
	case "input": print "Selecting photos for storage";
												break;
	case "maindata": print "Patient's data";
												break;
	case "save": print "Photos stored";
												break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="input") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The entry fields are displayed. What to do next?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Browse..."> to find the file of the photo you want to store.<br>
 	<b>Step 2: </b>A "Select file" window will pop up. Select the file you want and click "Open".<br>
 	<b>Step 3: </b>If the file you selected is a valid graphic file format, a preview of the photo will appear on the upper right frame. Otherwise, repeat step 1 and 2.<br>
 	<b>Step 4: </b>Enter the date when this photo was taken in the "<span style="background-color:yellow" > Shotdate </span>" field.<p>
 	<img src="../img/warn.gif" border=0> <b>Achtung! </b>This date could be overwritten eventually when you select the date function in the patient's data on the lower right frame. Tip: If you want this date
	to be different than the one you will enter in the patient's data frame, leave it blank for the meantime. You can enter the unique date later.<p>
 	<b>Step 5: </b>Enter the photo number in the "<span style="background-color:yellow" > Number </span>" field.<p>
 	<img src="../img/warn.gif" border=0> <b>Achtung! </b>If you want this photo to be the "main photo" of the patient, enter 'main' instead of a number. The "main photo" will always appear on the patient's data folder and
	on other documents.<p>
 	<font color="#990000">What to do next?</font><p>
	<b>Step 6: </b>Find the patient's data. Enter the patient's number  in the "<span style="background-color:yellow" > Patient number </span>" field.<br>
 	<b>Step 7: </b>Click the button <input type="button" value="Search"> to find the patient.<br>
 	<b>Step 8: </b>When the patient is found, his basic data will appear in the corresponding fields.<br>
 	<b>Step 9: </b>If all or most of the photos are taken on the same date, enter the date in the <nobr>"<span style="background-color:yellow" > Shotdate </span>"</nobr> field.<br>
 	<b>Step 10: </b>Click the button <img src="../img/preset-add.gif" border=0 align="absmiddle"> to set this date for all the photos. This date will
	automatically appear in the "Shotdate" fields on the left frame.<p>
 	<img src="../img/warn.gif" border=0><b> Achtung! </b>If one or some photos must have a different date, enter the unique date into the photo's corresponding "Shotdate" field. You can only do this after you are finished with step 10.<p>
 	<b>Step 11: </b>Click the button <input type="button" value="Save"> to store the photos in the databank.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to preview the photo?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the photo's corresponding <img src="../img/lilcamera.gif" border=0> button.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I cannot find the patient through his patient number. Can I simply enter his data manually and save the photos?</b>
</font>
<ul>       	
 	<b>No. </b>In this program version, you can not save photos of a patient when he has no valid patient or case number.<br>
</ul>
<?php endif ?>	

<?php if($src=="maindata") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to find the patient's data?</b>
</font>
<ul>	
	<b>Step 1: </b>Enter the patient's patient or case number  in the "<span style="background-color:yellow" > Patient number </span>" field.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Search"> to find the patient.<br>
 	<b>Step 3: </b>When the patient is found, his basic data will appear in the corresponding fields.<br>
 	<b>Step 4: </b>If all or most of the photos are taken on the same date, enter the date in the <nobr>"<span style="background-color:yellow" > Shotdate </span>"</nobr> field.<br>
 	<b>Step 5: </b>Click the button <img src="../img/preset-add.gif" border=0 align="absmiddle"> to set this date for all the photos. This date will
	automatically appear in the "Shotdate" fields on the left frame.<p>
 	<img src="../img/warn.gif" border=0><b> Achtung! </b>If one or some photos must have a different date, enter the unique date into the photo's corresponding "Shotdate" field. You can only do this after you are finished with step 5.<p>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I cannot find the patient through his patient number. Can I simply enter his data manually and save the photos?</b>
</font>
<ul>       	
 	<b>No. </b>In this program version, you can not save photos of a patient when he has no valid patient or case number.<br>
</ul>

	<?php endif ?>	
<?php if($src=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to store additional photos from the same patient. How to do it?</b>
</font>
<ul>	
	<b>Step 1: </b>Enter the number of photos you want to store in the <nobr>"Additional <input type="text" name="g" size=3 maxlength=2> photos of the <span style="background-color:yellow" > same patient. </span>"</nobr> field.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Go">.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to store photos from another patient. How to do it?</b>
</font>
<ul>	
	<b>Step 1: </b>Enter the number of photos you want to store in the <nobr>" <input type="text" name="g" size=3 maxlength=2> photos of <span style="background-color:yellow" > another patient. </span>"</nobr> field.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Go">.<br>
</ul>

	<?php endif ?>	
	
<?php if($src=="init") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to store photos in the databank?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Initialize first. Enter the number of photos you want to store in the databank.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="OK Continue...">.<br>
 	<b>Step 3: </b>The entry fields for photos will appear. Click the button "Help" for further instructions.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The new access right is now saved. How to create another access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="OK"> button.<br>
 	<b>Step 2: </b>The entry form will appear.<br>
 	<b>Step 3: </b>To see further instructions on creating an access right, click the "Help" button.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see the list of the existing access rights. How to do it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="List actual access rights">.<br>
 	<b>Step 2: </b>The existing access rights will be listed<br>
</ul>
	
	<?php endif ?>	
	<?php if($x1=="list") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What do the buttons <img src="../img/arrow-r.gif" border=0 align="absmiddle"> and <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> mean?</b>
</font>
<ul>       	
 	<img src="../img/arrow-r.gif" border=0 align="absmiddle"> = The user's access right is locked or "freezed". He cannot enter the areas set as accessible.<br>
 	<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = The user's access right is not locked . He can enter the areas set as accessible.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What do the options "C","L", and "D", or "U" mean?</b>
</font>
<ul>       	
 	<b>C: </b> = Change or edit the user's access data.<br>
 	<b>L: </b> = Lock the user's access right.<br>
 	<b>D: </b> = Delete the user's access right.<br>
 	<b>U: </b> = Unlock the user's access right (if currently locked).<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to change or edit the user's access data?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > C </span>" corresponding to the user.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to lock the user's access data?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > L </span>" corresponding to the user.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to unlock the user's access data? (if currently locked)</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > U </span>" corresponding to the user.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to delete an access right?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > D </span>" corresponding to the user.<br>
</ul>

	<?php endif ?>	
	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to edit an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Edit the information.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Save">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Achtung!</b>
</font>
<ul>       	
 	If you decide not to edit click the button <input type="button" value="Cancel">.<br>
</ul>
	
	<?php endif ?>		
	<?php if($x1=="delete") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to delete an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>If you are sure you want to delete the access right,<br>
	 click the button <input type="button" value="Yes, I am dead sure. Delete access right.">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Achtung!</b>
</font>
<ul>       	
 	If you decide not to delete click the button <input type="button" value="No. Go back.">.<br>
</ul>
	
	<?php endif ?>		
	
	<?php if($x1=="lock") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to <?php if($x2=="0") print "lock"; else print "unlock"; ?> an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>If you are sure you want to <?php if($x2=="0") print "lock"; else print "unlock"; ?> the access right,<br>
	 click the button <input type="button" value="Yes, I'm sure.">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Achtung!</b>
</font>
<ul>       	
 	If you decide not to <?php if($x2=="0") print "lock"; else print "unlock"; ?> click the button <input type="button" value="No. Go back.">.<br>
</ul>
	
	<?php endif ?>		
<?php endif ?>	

	</form>

