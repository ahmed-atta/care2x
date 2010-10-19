<?PHP

	require_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj= new Department;
	$deps=&$dept_obj->getAllMedical();

	if ($_GET['mode']=='edit'){
		$nb = ' where name="'.$name.'" AND dpt='.$dpt;
		$all = $obj->listRooms($nb);
		$jj = $all->FetchRow();
	}

	foreach($jj as $v=>$o)
		$$v = $o;

	while(list($x,$v)=each($deps)){
		$select = (($v['nr']==$dpt) && ($mode=='edit'))? ' selected ' : '';
		$TP_SELECT_BLOCK.='
		<option value="'.$v['nr'].'" '.$select.' >';
		$buffer=$v['LD_var'];
		if(isset($$buffer)&&!empty($$buffer)) $TP_SELECT_BLOCK.=$$buffer;
			else $TP_SELECT_BLOCK.=$v['name_formal'];
		$TP_SELECT_BLOCK.='</option>';
	}
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

	<form name="form1" method="post" onsubmit="if (document.getElementById('name').value==''){ alert('Room Name is needed'); document.getElementById('name').focus(); return false; } " action="room.php?mode=<?php print $_GET['mode'];?>">
	  <table width="400" border="0" align="left" cellpadding="0" style="margin:20px 0 0 20px;" cellspacing="0">
	    <tr>
	      <td><table width="470"  border="0" align="center" bgcolor="#E7EEE6" cellpadding="4" cellspacing="1" class="style3">
	        <tr align="center" bgcolor="#E7EEE6">
	          <td height="38" colspan="2" bgcolor="#C0D2BD"><div align="center" style="text-transform:uppercase;">Add NEW room</div></td>
	        </tr>
	        <tr bgcolor="#FFFFFF">
	          <td width="111" height="30" class="cell" align="right">Name:</td>
	          <td><input name="name" type="text" id="name" class="cell3" value="<?php print(($feed==-1)?$_POST['name']:$name); ?>" style="border:1px solid #C0D2BD; padding:3px;" maxlength="20" size="20" />          </td>
	        </tr>

	        <tr align="center" bgcolor="#FFFFFF">
	          <td align="right" class="cell" valign="top" nowrap>Description:</td>
	          <td align="left" nowrap bgcolor="#FFFFFF"><textarea name="notes" cols="40" rows="5" id="notes" class="cell3" style="border:1px solid #C0D2BD; padding:3px;"><?php print(($feed==-1)?$_POST['notes']:$notes); ?></textarea>          </td>
	        </tr>


	        <tr align="center" bgcolor="#FFFFFF">
	          <td align="right" valign="middle" class="cell" >Department:</td>
	          <td align="left" bgcolor="#FFFFFF">
				  <select name="dpt" id="dpt" class="cell3" style="width:200px; border:1px solid #FFF;">
				  	 <?php print $TP_SELECT_BLOCK; ?>
				  </select>
	          </td>
	        </tr>


	        <tr align="center" bgcolor="#FFFFFF">
	          <td align="right" class="cell" valign="middle">Status:</td>
	          <td align="left" bgcolor="#FFFFFF" class="style7">
				  <select name="status" id="status" class="cell3" style="width:100px; border:1px solid #FFF;">
				  	 <option value="1" selected>Active</option>
				  	 <option value="2">Not Active</option>
				  </select>
	          </td>
	        </tr>

	        <tr align="center" bgcolor="#FFFFFF">
	          <td align="right" class="cell" valign="middle">Created by: </td>
	          <td align="left" bgcolor="#FFFFFF" class="style7">
	          <input name="by" type="text" id="by" style="border:0px solid #000;" readonly="true" value="<?php echo $HTTP_SESSION_VARS['sess_user_name'];?>">
	            <input name="id" type="hidden" id="id" class="cell3" value="<?php echo $_GET['encounter']; ?>"></td>
	        </tr>
	        <tr align="center" valign="top">
	          <td colspan="2" bgcolor="#E7EEE6" align="right" valign="middle">

	  			<input type="hidden" name="iname" value="<?php print $name; ?>" />
	  			<input type="hidden" name="idpt" value="<?php print $dpt; ?>" />
	  			<input name="Print2" type="submit" id="Print25" style="width:100px !important;" value="<?php print strtoupper( $mode ); ?> &raquo;" >
	            <input name="Close2" type="button" id="Close25" value="Cancel" class="button2" onClick="javascript:history.back();" >          </td>
	        </tr>
	      </table>

	      </td>
	    </tr>
	  </table>
	</form>
