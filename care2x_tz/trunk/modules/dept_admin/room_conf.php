<?PHP


	include('./gui_room_conf.php');

	require_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj = new Department;

	if ($_GET['Submit']){
		$syear  = $_GET['yrs'];
		$smonth = $_GET['mnth'];
		$sdate  = intval($_GET['date']);

		if ((intval( $_GET['date'])>31) || (intval( $_GET['date'])<1)){ ?>
			<div style="width:85%; margin: 20px 0px 0px 20px; text-align:center; float:left; padding:20px; background:red; color:#fff; border:1px solid black; font:bold 14px Tahoma; text-transform: capitalize;">
      			Wrong Date [<?php print $_GET['date'].'/'.$smonth.'/'.$syear; ?>]
      		</div><?php exit();
		}

	}

	if (intval($sdate)<10) $sdate = '0'.$sdate;

	define('DATES',$syear.'-'.$smonth.'-'.$sdate);

	$obj->Dates = DATES;

	$deps=&$dept_obj->getAllMedical();

	while(list($x,$v)=each($deps))
		$lst[$v['nr']] =
			((isset($$buffer)&&!empty($$buffer))?
				$$buffer
					:
				$v['name_formal']);

	$nb='';

	$hv = $obj->listRooms(' WHERE active = 1');

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
	          	<div align="center" style="text-transform:uppercase; font: bold 12px Tahoma,Arial;">
		          	Available hospital rooms <br />
		          	<?php print $sdate.'/'.$smonth.'/'.$syear;?>
		        </div>
		     </td>
	        </tr>
	        <?php if ($hv->RecordCount()>0) { ?>
	        <tr bgcolor="#E7EEE6">
	          <td width="15%" class="cell2" align="left">Room Name:</td>
	          <td width="15%" class="cell2" align="center"># of Doctors</td>
	          <td width="50%" class="cell2" align="center">Department</td>
	          <td width="10%" class="cell2" align="center">Active</td>
	          <td width="10%" class="cell2" align="center">Options</td>
	        </tr>
	        <?php while($rw = $hv->FetchRow()){

					$assign  = $obj->ListAsignedUsers($rw['name'],$rw['dpt']);

					$assign  = explode('|',$assign);
					$assign  = count($assign) - 1;?>
		        <tr bgcolor="#FFFFFF" id="roller">
		          <td height="25" class="cell" align="left">
		          	<a href="?mode=conf&fw=conf_new&name=<?php print $rw['name'].'&dpt='.$rw['dpt'].'&dates='.DATES.'&sv='.$sdate.'/'.$smonth.'/'.$syear;?>"><?php print $rw['name'];?></a>&nbsp;</td>
		          <td class="cell" align="center"><?php print $assign;?>&nbsp;</td>
		          <td class="cell" nowrap><?php print $lst[$rw['dpt']];?>&nbsp;</td>
		          <td class="cell"><?php print ($rw['active']==1)?'YES': 'NO';?>&nbsp;</td>
		          <td class="cell" align="center" nowrap>
					<a href="?mode=conf&fw=conf_new&name=<?php print $rw['name'].'&dpt='.$rw['dpt'].'&dates='.DATES.'&sv='.$sdate.'/'.$smonth.'/'.$syear;?>">Assign &raquo;</a>
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
	      </table>
	      </td>
	    </tr>
	  </table>
