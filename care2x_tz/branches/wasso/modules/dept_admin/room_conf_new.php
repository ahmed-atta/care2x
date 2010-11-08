<?PHP

	require_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj= new Department;
	$deps=&$dept_obj->getAllMedical();

	if ($_GET['mode']=='edit'){
		$nb = ' where name="'.$name.'" AND dpt='.$dpt." AND `date` = '".$v['dates']."'";
		$all = $obj->listRooms($nb);
		$jj = $all->FetchRow();
	}

	foreach($jj as $v=>$o)
		$$v = $o;

	while(list($x,$v)=each($deps))
		$lst[$v['nr']] = $v['name_formal'];

	$exc = "'0'";
	$sql = "";

	$obj->Dates = $_GET['dates'];

	$users = $obj->GetAllUsers($exc, $sql);

	$assign = $obj->ListAsignedUsers($name,$dpt);

	$assign = explode('|',$assign);

	?>
	<script language="javascript">
	<!--

	function chkForm(d){
		if(d.name_formal.value==""){
			alert("<?php echo $LDPlsNameFormal ?>");
			d.name_formal.focus();
			return false;
		}else if(d.id.value==""){
			alert("<?php echo $LDPlsDeptID ?>");
			d.id.focus();
			return false;
		}else if(d.type.value==""){
			alert("<?php echo $LDPlsSelectType ?>");
			d.type.focus();
			return false;
		}else{
			return true;
		}
	}

	// -->
	</script>

	</style type="text/css">
	<!--
	  *{font-family:Tahoma;}
	-->
	</style>

<form name="mover" method="post" onSubmit="
	 	var list = document.forms['mover'].elements['selected_item_list[]'];
	 	var vale = '';
			for(var i=0;i<list.length;i++)
				vale  += list.options[i].value + '|';
		if (vale.length>0){
			document.getElementById('users').value = vale;
			return true;
		} else{
			alert('Please select atleast one Doctor');
			return false;
		}
		">
  <table width="555" align="center" cellpadding="5" cellspacing="1" style="margin:20px" bgcolor="#E7EEE6">
    <tr valign="baseline">
      <td colspan="2" align="center" valign="top" nowrap style="font-size: 16px; text-transform:capitalize; background:#E7EEE6">Assign Doctor to a Room</td>
    </tr>
    <tr valign="baseline">
      <td width="117" align="right" nowrap="nowrap" bgcolor="#FFFFFF"  class="cell">Room Name:</td>
      <td width="423" bgcolor="#FFFFFF" class = "cell2"><?php print $name; ?>
      <input type="hidden" value="<?php print $name; ?>" id="name" name="name" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"  class="cell">Department:</td>
      <td bgcolor="#FFFFFF" class = "cell2"><?php print $lst[$dpt]; ?>
      <input type="hidden" value="<?php print $dpt; ?>" id="dpt" name="dpt" />
      <input type="hidden" value="<?php print $mode; ?>" id="mode" name="mode" />
      <input type="hidden" value="" id="users" name="users" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"  class="cell">
      	  Of Date:
      </td>
      <td bgcolor="#FFFFFF" class = "cell2">
	      <?php print ($_GET['sv']!='')?$_GET['sv']:$_GET['dates']; ?>
	      <input type="hidden" value="<?php print $_GET['dates']; ?>" id="dates" name="dates" />
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#F2F9F9"  class="lable">
      <table width="551" border="0" align="center" cellpadding="2" cellspacing="5">
        <tr bgcolor="#F2F9F9" class="smaltxt">
          <td align="center" class="menu">Available Doctors </td>
          <td align="center" class="menu">&nbsp;</td>
          <td align="center" bgcolor="#F2F9F9" class="menu">Selected Doctors</td>
        </tr>
        <tr bgcolor="#F2F9F9" class="smaltxt">
          <td width="230">
          <select name="itemlist[]" size="10" multiple="multiple" id="itemlist[]" style="width:300px; height:200px; border:1px solid green; " ondblclick="javascript:moveitem('itemlist[]','selected_item_list[]','toright');"><?php
				while($rw = $users->fetchRow()){
          			if (!in_array($rw[1],$assign))
						print '<option value="'.$rw[1].'" title="username: '.$rw[1].'" >'.$rw[0].'</option>';
					$yuza[$rw[1]] = $rw[0];
				} ?>
            </select>
            </td>
          <td width="50" align="center"><input type="button" name="moveallright" title=" &raquo; Move All to Right &raquo;" value="All &raquo;" style="width:50px; "  onclick="javascript:moveall('alltoright','itemlist[]','selected_item_list[]');" />
              <br />
              <input type="button" name="moveright" title=" &raquo; Move to Right &raquo;" value="&raquo;" style="width:50px; "  onclick="javascript:moveitem('itemlist[]','selected_item_list[]','toright');" />
            <br />
              <br />
              <input type="button" name="moveleft"  title=" &laquo; Move to Left &laquo;" value="&laquo;" style="width:50px; "  onclick="javascript:moveitem('selected_item_list[]','itemlist[]','toleft');" />
            <br />
              <input type="button" name="moveallleft"  title=" &laquo; Move All to Left &laquo;" value="&laquo; All" style="width:50px; "  onclick="javascript:moveall('alltoleft','itemlist[]','selected_item_list[]');" />          </td>
          <td width="251" nowrap="nowrap">
          	<select name="selected_item_list[]" size="10" multiple="multiple" id="selected_item_list[]" style="width:300px; height:200px; border:1px solid green; " ondblclick="javascript:moveitem('selected_item_list[]','itemlist[]','toleft');" ><?php

              		foreach($assign as $rw)
              			if ($rw!='')
							print '<option value="'.$rw.'" title="username: '.$rw.'" >'.$yuza[$rw].'</option>';?>

            </select>
          </td>
        </tr>
      </table>
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" valign="middle" nowrap bgcolor="#FFFFFF">
        <input type="submit" value="Save &raquo;" />
      <input type="button" value="&laquo; Back" onClick="javascript:history.back(2);" /></td>
    </tr>
  </table>
</form>