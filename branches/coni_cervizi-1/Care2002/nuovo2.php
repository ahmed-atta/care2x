<html>
<head>
<script language="JavaScript">
function add()
{
  if (form.list.selectedIndex >=0 &&  form.list.options[form.list.selectedIndex]!=null)
      {
  form2.options[form2.lenght]= new Option (form.options[form.selectIndex].value, form.list.lenght);
      }
}
function del ()
{
  if (document.form2.list.selectedIndex >=0
      {
	document.form2.list.options[document.form2.list.selectedIndex]=null;
	document.form.list.selectedIndex=0;
      }
}
</script>

</head>
<body>
<center>
<form name="form">
<select name="list" size="10">
<option> Muro </option>
<option> List Item  </option>
<option> Ciccio </option>
<option> Marco </option>
</select>
<p><input type="button" value="Add" onClick="add"> <input type="button" value="Del" onClick="del">
</form>
</center>

<center>
<form name="form2">
<select name="list" size="10">

</select>

</form>
</center>



</body>
</html>
