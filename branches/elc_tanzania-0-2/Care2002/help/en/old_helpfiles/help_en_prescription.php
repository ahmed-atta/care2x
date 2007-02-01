<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Prescriptions - 
<?php
if($src=="prescription")
{
	switch($x1)
	{
	case "overview": print "Overview";
						break;
	case "new": print "Create a prescription";
						break;
	case "insert": print "Finalize a prescription";
						break;
	default: print "Overview";	
	}
}
if($src=="billing")
{
	switch($x1)
	{
	case "list": print "Pending Bills";
						break;
	case "details": print "Create Quotation";
						break;
	case "archive": print "Archive";
						break;
	default: print "Overview";	
	}
}

 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="prescription") {
	if($x1=='overview') { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to process pending prescriptions?</b>
</font>
<ul>      
	<b>Note 1: </b>Choose a person on the left list to get a summary of the persons prescription and the personal data. You'll
	see a list containing all prescriptions, their dosage and if they're whether paid or not.<br><br>
 	<b>Step 1: </b>Click a file number on the left to get the prescription summary of a person like this one:<br>
 	<img <?php echo createComIcon('../','prescription_help_list.gif','0') ?>><br>
 	<b>Option 1: </b>To create a new prescription, click on "Enter new record"<br>
 	<b>Option 2: </b>To edit an existing prescription, choose "edit"<br>
 	<b>Option 3: </b>To delete an existing prescription, choose "delete"<br>
 	<b>Note 2: </b>"Edit" and "delete" are only available for quotet items. Once an item is
 	billed you're unable to alter this prescription and a note is shown.<br>
 	<b>Note 3: </b>If the billing officer changes the dosage of the prescription it is shown like this:<br>
 	<img <?php echo createComIcon('../','prescription_help_list_alter.gif','0') ?>><br>
 	As you can see, the original dosage is striked thru and the new dosage appears beside. Also a note is shown.
 	
 	
 	<br><br>

	<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> I am finished. How to go back to the prescriptions menu?</b></font> 
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> that will appear after you have selected <?php echo $person ?>.<br>
 
</ul>
<?php }
	if($x1=='new') 
	{ ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to select prescription item groups?</b>
</font>
<ul>      
 	<b>Note: </b>If you clicked on "Enter new record" you will get this view:<br>
 	<img <?php echo createComIcon('../','prescription_help_selection.gif','0') ?>><br>
 	<b>Step 1: </b>Click on one of the thumbnails (small pictures) to select a main item group like "Supplies" or
 	"Special drugs".<br>
 	<b>Step 2: </b>Some groups have very much items. To get a better view on it you're able to select a sub item group,
 	but this is optional and not every main group has sub groups!<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> How to add an item to a prescription?</b></font> 
<ul>
 	
 	<b>Step 1: </b>Search the "Available items" list down until you found the right one. Now doubleclick it or use
 	the "add >>"-button. If the item is already prescribed, a warning message will appear. <br>
 	<b>Step 2: </b>You can add as much items as you want. To switch the item groups just click another thumbnail (explained above).
 	Your "Selected items"-List will stay the same throughout all groups, so feel free to navigate through the groups as you
 	want it<br>
 	<br><br>

	<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> How to remove an item to a prescription?</b></font> 
<ul>
 	
 	<b>Step 1: </b>Select an item in the "Selected items"-List and doubleclick it or use the "<< del"-button.<br>
 	<br><br>

	<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> I'm finished with the selection, how to proceed?</b></font> 
<ul>
 	
 	<b>Step 1: </b>Click on "Prescribe!" to enter detailed information to the prescription and finalize it.<br>
 	<br><br>

	<p>
</ul>



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> How to cancel back to the prescriptions menu?</b></font> 
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> that will appear after you have selected <?php echo $person ?>.<br>
 
</ul>
<?php }
	if($x1=='insert') 
	{ ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to finalize my prescription?</b>
</font>
<ul>      
 	<b>Note: </b>If you clicked on "Prescribe!" you will get this view:<br>
 	<img <?php echo createComIcon('../','prescription_help_finalize.gif','0') ?>><br>
 	<b>Step 1: </b>Enter a overall dosage for the first item. Please use only numbers like without "." and "," for example "15"<br>
 	<b>Step 2: </b>Enter a note for example the daily dosage, how to use it, etc. This is a free text field.<br>
 	<b>Step 3: </b>If you have more than one item in your prescription list redo the 2 previous steps with the other
 	prescriptions.<br>
 	<b>Step 4: </b>Click on "Save" to finalize the prescription and return to "pending prescriptions".<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> How to cancel back to the prescriptions menu?</b></font> 
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> that will appear after you have selected <?php echo $person ?>.<br>
 
</ul>
<?php } ?>

<?php } ?>


<?php if($src=="billing") {
	if($x1=='list') { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to process a pending bill for a selected person?</b>
</font>
<ul>       	
 	<b>Step 1: </b>You can choose to edit single items by clicking the arrow or pay all items at once:<br>
 	<img <?php echo createComIcon('../','billing_paid.gif','0') ?> align="absmiddle"><br>
	<b>Step 2: </b>After you finished work here click on <img <?php echo createComIcon('../','billing_done.gif','0') ?> align="absmiddle"> to archive this bill and return to the billing menu/quotation.<br>
	<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> How to edit an item?</b></font> 
<ul>       	
 	The following table will appear after you clicked on the arrow on the item list:<br>
 	<img <?php echo createComIcon('../','billing_edit.gif','0') ?> align="absmiddle"><br>
 	Here you can change the item name, its price, amount and if the customer already paid this item.<br>
 	In the dropdown at the lower right you can update (default) or delete the item out of the bill.<br>
 	to return to the bill and accept your changes click on <img <?php echo createComIcon('../','billing_ok.gif','0') ?> align="absmiddle">.<br>
 	If you want to return to your bill discarding your changes click on <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> How to print out the bill?</b></font> 
<ul>       	
 	Click the button <img <?php echo createComIcon('../','billing_print_out.gif','0') ?> align="absmiddle"><br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> I am finished. How to go back to the billing menu?</b></font> 
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> that will appear after you have selected <?php echo $person ?>.<br>
 
</ul>
<?php }
	if($x1=='details') 
	{ ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to create a new quotation/bill for a person (Details)?</b>
</font>
<ul>       	
	<b>Note: </b>Care2x shows you all unpaid items of this person now. For each Item you have to select an action:<br>
	<img <?php echo createComIcon('../','quotation_select_tick.gif','0') ?>> Yes, add this item to the new bill.<br>
	<img <?php echo createComIcon('../','quotation_select_clock.gif','0') ?>> Set item on status "hold" (Item will be ignored up to the next quotation).<br>
	<img <?php echo createComIcon('../','quotation_select_cross.gif','0') ?>> Remove this item from the "unpaid items"-list and ignore it in the new bill.<br><br>
 	<b>Step 1: </b>Select an action for each item<br>
 	<b>Step 2: </b>If a person is unable to pay a prescription only partly adjust the dosage and price:<br>
 	<img <?php echo createComIcon('../','quotation_prescription.gif','0') ?>><br><br>
 	<b>Step 3: </b>Click on <img <?php echo createComIcon('../','quotation_im_finished.gif','0') ?>> if you're ready to create the new bill or
 	<img <?php echo createComIcon('../','quotation_reset_fields.gif','0') ?>><br> to start from scratch.<br>
 	
 	<br><br>
	<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> I am finished. How to go back to the billing menu?</b></font> 
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> that will appear after you have selected <?php echo $person ?>.<br>
 
</ul>
<?php } 
	if($x1=='archive') 
	{ ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to create a new quotation/bill for a person (Details)?</b>
</font>
<ul>       	
	<b>Step 1: </b>Select a bill by clicking its bill number:<br>
	<img <?php echo createComIcon('../','billing_archive.gif','0') ?>><br>
	<b>Step 2: </b>After clicking a popup opens which gives you the dialog box to print out the bill.<br>
 	<br><br>
	<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> I am finished. How to go back to the billing menu?</b></font> 
<ul>       	
	<b>Step 1: </b>Close the popup.<br>
 	<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> that will appear after you have selected <?php echo $person ?>.<br>
 
</ul>
<?php } ?>



<?php } ?>



</form>

