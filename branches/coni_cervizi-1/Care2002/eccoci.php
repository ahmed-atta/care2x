<HEAD>



<!-- This script and many more are available free online at -->

<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Original:  Sean Geraty () -->

<!-- Web Site:  http://www.freewebs.com/sean_geraty/ -->

<SCRIPT LANGUAGE="JavaScript">

<!--



// Control flags for list selection and sort sequence

// Sequence is on option value (first 2 chars - can be stripped off in
form processing)

// It is assumed that the select list is in sort sequence initially

var singleSelect = true;  // Allows an item to be selected once only

var sortSelect = true;  // Only effective if above flag set to true

var sortPick = true;  // Will order the picklist in sort sequence



// Initialise - invoked on load

function initIt() {

  var selectList = document.getElementById("SelectList");

  var pickList = document.getElementById("PickList");

  var pickOptions = pickList.options;

  pickOptions[0] = null;  // Remove initial entry from picklist (was only
used to set default width)

  selectList.focus();  // Set focus on the selectlist

}



// Adds a selected item into the picklist

function addIt() {

  var selectList = document.getElementById("SelectList");

  var selectIndex = selectList.selectedIndex;

  var selectOptions = selectList.options;

  var pickList = document.getElementById("PickList");

  var pickOptions = pickList.options;

  var pickOLength = pickOptions.length;

  // An item must be selected

  if (selectIndex > -1) {

    pickOptions[pickOLength] = new Option(selectList[selectIndex].text);

    pickOptions[pickOLength].value = selectList[selectIndex].value;

    // If single selection, remove the item from the select list

    if (singleSelect) {

      selectOptions[selectIndex] = null;

    }

    if (sortPick) {

      var tempText;

      var tempValue;

      // Sort the pick list

      while (pickOLength > 0 && pickOptions[pickOLength].value <
pickOptions[pickOLength-1].value) {

        tempText = pickOptions[pickOLength-1].text;

        tempValue = pickOptions[pickOLength-1].value;

        pickOptions[pickOLength-1].text = pickOptions[pickOLength].text;

        pickOptions[pickOLength-1].value = pickOptions[pickOLength].value;

        pickOptions[pickOLength].text = tempText;

        pickOptions[pickOLength].value = tempValue;

        pickOLength = pickOLength - 1;

      }

    }

  }

}



// Deletes an item from the picklist

function delIt() {

  var selectList = document.getElementById("SelectList");

  var selectOptions = selectList.options;

  var selectOLength = selectOptions.length;

  var pickList = document.getElementById("PickList");

  var pickIndex = pickList.selectedIndex;

  var pickOptions = pickList.options;

  if (pickIndex > -1) {

    // If single selection, replace the item in the select list

    if (singleSelect) {

      selectOptions[selectOLength] = new Option(pickList[pickIndex].text);

      selectOptions[selectOLength].value = pickList[pickIndex].value;

    }

    pickOptions[pickIndex] = null;

    if (singleSelect && sortSelect) {

      var tempText;

      var tempValue;

      // Re-sort the select list

      while (selectOLength > 0 && selectOptions[selectOLength].value <
selectOptions[selectOLength-1].value) {

        tempText = selectOptions[selectOLength-1].text;

        tempValue = selectOptions[selectOLength-1].value;

        selectOptions[selectOLength-1].text =
selectOptions[selectOLength].text;

        selectOptions[selectOLength-1].value =
selectOptions[selectOLength].value;

        selectOptions[selectOLength].text = tempText;

        selectOptions[selectOLength].value = tempValue;

        selectOLength = selectOLength - 1;

      }

    }

  }

}



-->

</SCRIPT>

</HEAD>



<!-- STEP TWO: Insert the onLoad event handler into your BODY tag  -->



<BODY onLoad="initIt()">



<!-- STEP THREE: Copy this code into the BODY of your HTML document  -->



<!-- This script and many more are available free online at -->

<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Original:  Sean Geraty () -->

<!-- Web Site:  http://www.freewebs.com/sean_geraty/ -->

<!-- This form is inoperational! Provisional users can't create forms
NAME="theform" ID="theform" onSubmit="return false" -->

<TABLE>

<TR>

<TD>

<SELECT NAME="SelectList" ID="SelectList" SIZE="5">

<OPTION VALUE="01sel">Selection 01</OPTION>

<OPTION VALUE="02sel">Selection 02</OPTION>

<OPTION VALUE="03sel">Selection 03</OPTION>

<OPTION VALUE="04sel">Selection 04</OPTION>

<OPTION VALUE="05sel">Selection 05</OPTION>

<OPTION VALUE="06sel">Selection 06</OPTION>

<OPTION VALUE="07sel">Selection 07</OPTION>

<OPTION VALUE="08sel">Selection 08</OPTION>

<OPTION VALUE="09sel">Selection 09</OPTION>

<OPTION VALUE="10sel">Selection 10</OPTION>

</SELECT>

</TD>

<TD>

<INPUT TYPE="BUTTON" VALUE="->" ONCLICK="addIt();"></INPUT>

<BR>

<INPUT TYPE="BUTTON" VALUE="<-" ONCLICK="delIt();"></INPUT>

</TD>

<TD>

<SELECT NAME="PickList" ID="PickList" SIZE="5">

<OPTION VALUE="01sel">Selection 01</OPTION>

</SELECT>

</TD>

</TR>

</TABLE>

</FORM>



<p><center>

<font face="arial, helvetica" size"-2">Free JavaScripts provided<br>

by <a href="http://javascriptsource.com">The JavaScript Source</a></font>

</center><p>
