<head>
<script language="JavaScript">
<!--

var singleSelect= false;

var sortSelect= true;

var sortPick = true;

function initIt ()
{
  var selectList = document.getElementByID("SelectList");

  var pickList = document.getElementById("PickList");

  var cpickOptions = pickList.options;

  pickOptions[0] = null;

  selectList.focus();
}

function addIt ()
{
  var selectList = document.getElementById("SelectList");
  var selectIndex = selectList.selectedIndex;
  var selectOptions = selectList.options;
  var pickList = document.getElementById("PickList");
  var pickOptions = pickList.options;
  var pickOLength = pickOptions.lenght;

  if (selectIndex > -1)
    {
      pickOptions[pickOLength] = new Option (selectList[selectIndex].text);
      pickOptions[pickOLength].value = selectList[selectIndex].value;

      if (singleSelect)
	{
  selectOptions[selectIndex] = null;
	}
      if (sortPick)
	{
