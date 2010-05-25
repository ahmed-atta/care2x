<?PHP

	require_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj= new Department;
	$deps=&$dept_obj->getAllMedical();

	while(list($x,$v)=each($deps))
		$lst[$v['nr']] =
			((isset($$buffer)&&!empty($$buffer))?
				$$buffer
					:
				$v['name_formal']);
	$nb='';

	$hv = $obj->listRooms($nb);

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


	  <table width="90%" border="0" align="left" cellpadding="0" bgcolor="#E7EEE6" style="margin:20px 0 0 20px;" cellspacing="0">
	    <tr>
	      <td><table width="100%"  border="0" align="center" bgcolor="#C0D2BD" cellpadding="6" cellspacing="1" class="style3">
	        <tr align="center" bgcolor="#E7EEE6">
	          <td height="38" colspan="5" bgcolor="#C0D2BD">
	          	<div align="center" style="text-transform:uppercase; font: bold 12px Tahoma,Arial;">List of hospital rooms</div></td>
	        </tr>
	        <?php if ($hv->RecordCount()>0) { ?>
	        <tr bgcolor="#E7EEE6">
	          <td width="15%" class="cell2" align="left">Room Name:</td>
	          <td width="40%" class="cell2" align="center">Department</td>
	          <td width="25%" class="cell2" align="center">Description</td>
	          <td width="10%" class="cell2" align="center">Active</td>
	          <td width="10%" class="cell2" align="center">Options</td>
	        </tr>
	        <?php while($rw = $hv->FetchRow()){ ?>
		        <tr bgcolor="#FFFFFF">
		          <td height="25" class="cell" align="left"><?php print $rw['name'];?>&nbsp;</td>
		          <td class="cell" nowrap><?php print $lst[$rw['dpt']];?>&nbsp;</td>
		          <td class="cell"><?php print $rw['notes'];?>&nbsp;</td>
		          <td class="cell" align="center"><?php print ($rw['active']==1)?'YES': 'NO';?>&nbsp;</td>
		          <td class="cell" align="center" nowrap>
					<a href="?mode=edit&fw=new&name=<?php print $rw['name'].'&dpt='.$rw['dpt'];?>">Edit</a> |
					<a href="javascript:void(0);" onclick="if (confirm('Remove <?php print $rw['name'];?> of <?php print $lst[$rw['dpt']];?>')) window.location.href='?mode=remove&fw=list&name=<?php print $rw['name'].'&dpt='.$rw['dpt'];?>'">Remove</a>
				  </td>
		        </tr>
	        <?php }?>
		        <tr align="center" bgcolor="#E7EEE6">
		          <td colspan="5" class="cell" align="center" valign="middle" bgcolor="#E7EEE6">(<?php print $hv->RecordCount();?>) records</td>
		        </tr><?php
	        } else { ?>
		        <tr>
		          <td colspan="5" class="cell" align="center" valign="middle" style="background:green; padding:10px; color:white; border:1px solid black; font:bold 11px Tahoma, Arial;">No Room Specified</td>
		        </tr><?php
	        }?>


	      </table></td>
	    </tr>
	  </table>
