<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Billing - 
<?php
if($src=="quotation")
{
	switch($x1)
	{
	case "overview": print "Overview";
						break;
	case "details": print "Create Quotation";
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
<?php if($src=="quotation") {
	if($x1=='overview') { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to create a new quotation/bill for a person?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Search in the list for a patient who has unbilled items. You can see the amount of preoscriptions and/or lab requests in the column "Count".<br>
 	<b>Step 2: </b>To select a person click on the ">>"-Button.<br><br>
 	
	<img <?php echo createComIcon('../','quotation_overview.gif','0') ?>>
	<p>
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
	<img <?php echo createComIcon('../','quotation_select_tick.gif','0') ?> align="absmiddle"> Yes, add this item to the new bill.<br>
	<img <?php echo createComIcon('../','quotation_select_clock.gif','0') ?> align="absmiddle"> Set item on status "hold" (Item will be ignored up to the next quotation).<br>
	<img <?php echo createComIcon('../','quotation_select_cross.gif','0') ?> align="absmiddle"> Remove this item from the "unpaid items"-list and ignore it in the new bill.<br><br>
 	<b>Step 1: </b>Select an action for each item<br>
 	<b>Step 2: </b>If a person is unable to pay a prescription only partly adjust the dosage and price:<br>
 	<img <?php echo createComIcon('../','quotation_prescription.gif','0') ?> align="absmiddle"><br><br>
 	<b>Step 3: </b>Click on <img <?php echo createComIcon('../','quotation_im_finished.gif','0') ?>> if you're ready to create the new bill or
 	<img <?php echo createComIcon('../','quotation_reset_fields.gif','0') ?> align="absmiddle"><br> to start from scratch.<br>
 	
 	<br><br>
	<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> I am finished. How to go back to the billing menu?</b></font> 
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

