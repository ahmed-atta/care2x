<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?="$x3 - $x2" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<? if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to assign a bed to a patient?</b></font>
<ul> <b>Step 1: </b>Click on the <img src="../img/plus2.gif" border=0> button corresponding to the room number and bed.
                                                                     <br>
		<b>Step 2: </b>A pop-up window for searching the patient will appear.<br>
		<b>Step 3: </b>Find first the patient by entering a search keyword into one of several entry fields.<br>
		If you  want to find the patient...<ul type="disc">
		<li>by its patient number, enter the number into the <br>"<span style="background-color:yellow" >Patient nr.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" field.
		<li>by its Family name, enter its Family name or the first few letters into the <br>"<span style="background-color:yellow" >Family name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" field.
		<li>by its Given name, enter its Given name or the first few letters into the <br>"<span style="background-color:yellow" >Given name:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" field.
		<li>by its birthdate, enter its birthdate or the first few numbers into the <br>"<span style="background-color:yellow" >Birthdate:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" field.
		</ul>
		<b>Step 4: </b>Click the button <img src="../img/en/en_searchlamp.gif" border=0> to start searching for the patient.<br>
		<b>Step 5: </b>If the search finds the patient or several patients, a list of patients will be displayed.<br>
		<b>Step 6: </b>To select the right patient, click on the button&nbsp;<button><img src="../img/post_discussion.gif" width=20 height=20 border=0></button> corresponding to it.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to discharge a patient from the ward?</b></font>
<ul> <b>Step 1: </b>Click on the <img src="../img/bestell.gif" width=16 height=16 border=0> button corresponding to the patient.
                                                                     <br>
		<b>Step 2: </b>The patient dischargeal form will appear.<br>
		<b>Step 3: </b>If you are sure to discharge the patient, <br>click the checkbox 
		"<input type="checkbox" name="g" ><span style="background-color:yellow" > Yes, I am sure. discharge the patient.</span>" field to
		activate it.<br>
       	<b>Step 4: </b>Click the button <input type="button" value="discharge"> to discharge the patient.<p>
       	<b>Note: </b>If you want to cancel, click the button <img src="../img/en/en_cancel.gif"> and the patient will not be dischargeed.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to lock a bed?</b></font>
<ul> <b>Step 1: </b>Click on the <img src="../img/plus2.gif" border=0> button corresponding to the room number and bed.
                                                                     <br>
		<b>Step 2: </b>A pop-up window for searching the patient will appear.<br>
		<b>Step 3: </b>Click on the "<span style="background-color:yellow" > <img src="../img/delete2.gif" border=0 align="absmiddle"> <font color="#0000ff">Lock this bed</font> </span>".<br>
		<b>Step 4: </b>Choose&nbsp;<button>OK</button> when asked for confirmation.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
I want to delete a patient from the list</b></font>
<ul> <b>Note: </b>You CANNOT just simply delete a patient from the list. To remove the patient, you have to discharge him regularly. To do it,
				follow the instructions on how to discharge a patient from the ward described above.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>What do these  <img src="../img/s_colorbar.gif" border=0> color bars mean? </b></font>
<ul> <b>Note: </b>Each of these color bars when "set visible" signalize the availability of a particular information, an instruction, a change, or a query, etc.<br>
			The meaning of a color can be set for every ward. 
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>What does this icon <img src="../img/patdata.gif" border=0> mean? </b></font>
<ul> <b>Note: </b>This is the patient's data file button. To display the patient's data file folder, click this icon. A pop-up window will appear
			showing the basic information on the patient, its id picture if available, and several other options.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>What does this icon <img src="../img/bubble2.gif" border=0> mean? </b></font>
<ul> <b>Note: </b>This is the Read/Write notice button. Clicking it will open a pop-up window for reading or writing notices regarding the patient.<br>
			The  plain <img src="../img/bubble2.gif" border=0> icon means that there is no current notes or remarks about the patient. To write a note or remarks click on this icon.
			The icon <img src="../img/bubble3.gif" border=0> means that there is an stored note or remark about the patient. To read  or append notes or remarks
			click on this icon.
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>What does this icon <img src="../img/bestell.gif" width=16 height=16 border=0> mean? </b></font>
<ul> <b>Note: </b>This is the patient dischargeal button. To discharge a patient, click this to open the patient dischargeal form.<br>
</ul>
<? elseif(($src=="")&&($x1=="template")) : ?>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
What should I do when <span style="background-color:yellow" >today's list is not yet created</span>?</b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Show last occupancy list"> to find the last recorded list.
                                                                     <br>
		<b>Step 2: </b>When a recorded list is found within the last 31 days, it will be displayed.<br>
		<b>Step 3: </b>Click on the button <input type="button" value="Copy this list for today anyway."><br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
I don't want to see the last occupancy list. How to create a new list?</b></font>
<ul> <b>Step 1: </b>Click on the <img src="../img/plus2.gif" border=0> button corresponding to the room number and bed.
                                                                     <br>
		<b>Step 2: </b>A pop-up window for searching the patient will appear.<br>
		<b>Step 3: </b>Find first the patient by entering a search keyword into one of several entry fields.<br>
		If you  want to find the patient...<ul type="disc">
		<li>by its patient number, enter the number into the <br>"<span style="background-color:yellow" >Patient nr.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" field.
		<li>by its Family name, enter its Family name or the first few letters into the <br>"<span style="background-color:yellow" >Family name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" field.
		<li>by its Given name, enter its Given name or the first few letters into the <br>"<span style="background-color:yellow" >Given name:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" field.
		<li>by its birthdate, enter its birthdate or the first few numbers into the <br>"<span style="background-color:yellow" >Birthdate:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" field.
		</ul>
		<b>Step 4: </b>Click the button <img src="../img/en/en_searchlamp.gif" border=0> to start searching for the patient.<br>
		<b>Step 5: </b>If the search finds the patient or several patients, a list of patients will be displayed.<br>
		<b>Step 6: </b>To select the right patient, click on the button&nbsp;<button><img src="../img/post_discussion.gif" width=20 height=20 border=0></button> corresponding to it.<br>
</ul>
<? elseif(($src=="getlast")&&($x1=="last")) : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to copy the displayed last recorded list for today's occupancy list?</b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Copy this list for today anyway."> to copy the last recorded list.
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
The last occupancy list is being displayed but I don't want to copy it. How to start a new list? </b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Do not copy this! Create a new list."> to start creating a new list.
</ul>
<? elseif($src=="assign") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to assign a bed to a patient?</b></font>
<ul> <b>Step 1: </b>Find first the patient by entering a search keyword into one of several entry fields.<br>
		If you  want to find the patient...<ul type="disc">
		<li>by its patient number, enter the number into the <br>"<span style="background-color:yellow" >Patient nr.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" field.
		<li>by its Family name, enter its Family name or the first few letters into the <br>"<span style="background-color:yellow" >Family name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" field.
		<li>by its Given name, enter its Given name or the first few letters into the <br>"<span style="background-color:yellow" >Given name:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" field.
		<li>by its birthdate, enter its birthdate or the first few numbers into the <br>"<span style="background-color:yellow" >Birthdate:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" field.
		</ul>
		<b>Step 2: </b>Click the button <img src="../img/en/en_searchlamp.gif" border=0> to start searching for the patient.<br>
		<b>Step 3: </b>If the search finds the patient or several patients, a list of patients will be displayed.<br>
		<b>Step 4: </b>To select the right patient, click on the button&nbsp;<button><img src="../img/post_discussion.gif" width=20 height=20 border=0></button> corresponding to it.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to lock a bed?</b></font>
<ul> <b>Step 1: </b>Click on the "<span style="background-color:yellow" > <img src="../img/delete2.gif" border=0 align="absmiddle"> <font color="#0000ff">Lock this bed</font> </span>".<br>
		<b>Step 2: </b>Choose&nbsp;<button>OK</button> when asked for confirmation.<p>
</ul>
  <b>Note: </b>If you want to cancel, click the button <img src="../img/en/en_cancel.gif" border=0 align="absmiddle">.</ul>
  
<? elseif($src=="remarks") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to write remarks or notes about the patient?</b></font>
<ul> <b>Step 1: </b>Click on the text entry field.<br>
		<b>Step 2: </b>Type your remarks or notes<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
I am finished writing. How to save the remarks or notes?</b></font>
<ul> 	<b>Step 1: </b>Click the button <input type="button" value="Save"> to save.<p>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
I have saved the remarks. How to close the window?</b></font>
<ul> 	<b>Step 1: </b>Click the button <img src="../img/en/en_close2.gif" border=0 align="absmiddle"> to close the window.<p>
</ul>
<? elseif($src=="discharge") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to discharge a patient?</b></font>
<ul> <b>Step 1: </b>Select the type of dischargeal by clicking on its corresponding button<br>
	<ul><br>
		<input type="radio" name="relart" value="reg" checked> Regular dischargeal<br>
                 	<input type="radio" name="relart" value="self"> Patient left the hospital on his own will<br>
                 	<input type="radio" name="relart" value="emgcy"> Emergency dischargeal<br>  <br>
	</ul>
		<b>Step 2: </b>Type additional notice or notes about the dischargeal in the "<span style="background-color:yellow" > Notice: </span>" field if available. <br>
		<b>Step 3: </b>Type your name in the "<span style="background-color:yellow" > Nurse: <input type="text" name="a" size=20 maxlength=20></span>" field if it is empty. <br>
		<b>Step 4: </b>Check the " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Yes, I'm sure. discharge the patient. </span>" field. <br>
		<b>Step 5: </b>Click the button <input type="button" value="discharge"> to discharge the patient.<p>
		<b>Step 6: </b>Click the button <img src="../img/en/en_close2.gif" border=0 align="absmiddle"> to go back to the ward's new occupancy list.<p>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
I tried clicking the <input type="button" value="discharge"> button, but there is no response. Why?</b></font>
<ul> <b>Note: </b>The following checkbox field must be checked and look like this: <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked> Yes, I'm sure. discharge the patient. </span>". <p>
		<b>Step 1: </b>Click the checkbox if it is not checked.<p>
</ul>
  <b>Note: </b>If you want to cancel, click the button <img src="../img/en/en_cancel.gif" border=0 align="absmiddle">.</ul>

<? endif ?>
<? if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>What does this "<span style="background-color:yellow" > <img src="../img/delete2.gif" border=0 align="absmiddle"> <font color="#0000ff">Locked</font> </span>" mean? </b></font>
<ul> <b>Note: </b>This means that the bed is locked and cannot be assigned to a patient. To unlock it, click on the "<span style="background-color:yellow" ><font color="#0000ff">Locked</font></span>" and choose&nbsp;<button>OK</button>
			when asked for confirmation.<br>
 <b>Note: </b>Depending on the program's version or setup configurations, undoing a locked bed might require a password.</ul>

<? endif ?>

</form>

