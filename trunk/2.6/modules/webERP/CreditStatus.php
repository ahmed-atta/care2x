<?php
/* $Revision: 1.16 $ */

$PageSecurity = 3;
include('includes/session.inc');
$title = _('Credit Status Code Maintenance');
include('includes/header.inc');

if (isset($_GET['SelectedReason'])){
	$SelectedReason = $_GET['SelectedReason'];
} elseif(isset($_POST['SelectedReason'])){
	$SelectedReason = $_POST['SelectedReason'];
}

if (isset($Errors)) {
	unset($Errors);
}
$Errors = array();
$InputError = 0;

if (isset($_POST['submit'])) {

	//initialise no input errors assumed initially before we test
	$i=1;

	/* actions to take once the user has clicked the submit button
	ie the page has called itself with some user input */

	//first off validate inputs are sensible

	$sql="SELECT count(reasoncode) 
			FROM holdreasons WHERE reasoncode='".$_POST['ReasonCode']."'";
	$result=DB_query($sql, $db);
	$myrow=DB_fetch_row($result);

	if ($myrow[0]!=0 and !isset($SelectedReason)) {
		$InputError = 1;
		prnMsg( _('The credit status code already exists in the database'),'error');
		$Errors[$i] = 'ReasonCode';
		$i++;		
	}
	if (!is_numeric($_POST['ReasonCode'])) {
		$InputError = 1;
		prnMsg(_('The status code name must be an integer'),'error');
		$Errors[$i] = 'ReasonCode';
		$i++;		
	} 
	if (strlen($_POST['ReasonDescription']) > 30) {
		$InputError = 1;
		prnMsg(_('The credit status description must be thirty characters or less long'),'error');
	}
	if (strlen($_POST['ReasonDescription']) == 0) {
		$InputError = 1;
		prnMsg(_('The credit status description must be entered'),'error');
		$Errors[$i] = 'ReasonDescription';
		$i++;		
	}

	$msg='';

	if (isset($SelectedReason) AND $InputError !=1) {

		/*SelectedReason could also exist if submit had not been clicked this code would not run in this case cos submit is false of course	see the delete code below*/

		if (isset($_POST['DisallowInvoices']) and $_POST['DisallowInvoices']=='on'){
			$sql = "UPDATE holdreasons SET 
					reasondescription='" . $_POST['ReasonDescription'] . "', 
					dissallowinvoices=1 
					WHERE reasoncode = $SelectedReason";
		} else {
			$sql = "UPDATE holdreasons SET 
					reasondescription='" . $_POST['ReasonDescription'] . "', 
					dissallowinvoices=0 
					WHERE reasoncode = $SelectedReason";
		}
		$msg = _('The credit status record has been updated');

	} else if ($InputError !=1) {

	/*Selected Reason is null cos no item selected on first time round so must be adding a record must be submitting new entries in the new status code form */

		if (isset($_POST['DisallowInvoices']) and $_POST['DisallowInvoices']=='on'){

			$sql = 'INSERT INTO holdreasons (
					reasoncode, 
					reasondescription, 
					dissallowinvoices) 
					VALUES (' . 
					$_POST['ReasonCode'] . ", '" . 
					$_POST['ReasonDescription'] . "', 1)";
		} else {
			$sql = 'INSERT INTO holdreasons (
					reasoncode, 
					reasondescription, 
					dissallowinvoices) 
					VALUES (' . 
					$_POST['ReasonCode'] . ", '" . 
					$_POST['ReasonDescription'] . "', 0)";
		}

		$msg = _('A new credit status record has been inserted');
		unset ($SelectedReason);
		unset ($_POST['ReasonDescription']);
	}
	//run the SQL from either of the above possibilites
	$result = DB_query($sql,$db);
	if ($msg != '') {
		prnMsg($msg,'success');
	}
} elseif (isset($_GET['delete'])) {
//the link to delete a selected record was clicked instead of the submit button

// PREVENT DELETES IF DEPENDENT RECORDS IN DebtorsMaster

	$sql= "SELECT COUNT(*) 
			FROM debtorsmaster 
			WHERE debtorsmaster.holdreason=$SelectedReason";
			
	$result = DB_query($sql,$db);
	$myrow = DB_fetch_row($result);
	if ($myrow[0] > 0) {
		prnMsg( _('Cannot delete this credit status code because customer accounts have been created referring to it'),'warn');
		echo '<br>' . _('There are') . ' ' . $myrow[0] . ' ' . _('customer accounts that refer to this credit status code');
	}  else {
		//only delete if used in neither customer or supplier accounts

		$sql="DELETE FROM holdreasons WHERE reasoncode=$SelectedReason";
		$result = DB_query($sql,$db);
		prnMsg(_('This credit status code has been deleted'),'success');
	}
	//end if status code used in customer or supplier accounts
	unset ($_GET['delete']);
	unset ($SelectedReason);

}

if (!isset($SelectedReason)) {

/* It could still be the second time the page has been run and a record has been selected for modification - SelectedReason will exist because it was sent with the new call. If its the first time the page has been displayed with no parameters
then none of the above are true and the list of status codes will be displayed with
links to delete or edit each. These will call the same page again and allow update/input
or deletion of the records*/

	$sql = 'SELECT reasoncode, reasondescription, dissallowinvoices FROM holdreasons';
	$result = DB_query($sql, $db);

	echo '<table border=1>';
	echo "<tr>
		<th>". _('Status Code') ."</th>
		<th>". _('Description') ."</th>
		<th>". _('Disallow Invoices') .'</th>';

	$k=0; //row colour counter
	while ($myrow=DB_fetch_row($result)) {

		if ($myrow[2]==0) {
			$DissallowText = _('Invoice OK');
		} else {
			$DissallowText = '<b>'. _('NO INVOICING') .'</b>';
		}
		if ($k==1){
			echo '<tr class="EvenTableRows">';
			$k=0;
		} else {
			echo '<tr class="OddTableRows">';
			$k=1;
		}

	printf("<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td><a href=\"%s?SelectedReason=%s\">" . _('Edit') . "</a></td>
		<td><a href=\"%s?SelectedReason=%s&delete=1\">". _('Delete') .'</a></td>
		</tr>',
		$myrow[0],
		$myrow[1],
		$DissallowText,
		$_SERVER['PHP_SELF'],
		$myrow[0],
		$_SERVER['PHP_SELF'],
		$myrow[0]);

	} //END WHILE LIST LOOP
	echo '</table>';

} //end of ifs and buts!

if (isset($SelectedReason)) {
	echo '<div class="centre"><a href="' . $_SERVER['PHP_SELF'] . '">' . _('Show Defined Credit Status Codes') . '</a></div>';
}

if (!isset($_GET['delete'])) {

	echo "<form method='post' action=" . $_SERVER['PHP_SELF'] . '>';

	if (isset($SelectedReason) and ($InputError!=1)) {
		//editing an existing status code

		$sql = "SELECT reasoncode,
				reasondescription,
				dissallowinvoices
			FROM holdreasons
			WHERE reasoncode='$SelectedReason'";

		$result = DB_query($sql, $db);
		$myrow = DB_fetch_array($result);

		$_POST['ReasonCode'] = $myrow['reasoncode'];
		$_POST['ReasonDescription']  = $myrow['reasondescription'];
		$_POST['DisallowInvoices']  = $myrow['dissallowinvoices'];

		echo "<input type=hidden name='SelectedReason' VALUE='" . $SelectedReason . "'>";
		echo "<input type=hidden name='ReasonCode' VALUE='" . $_POST['ReasonCode'] . "'>";
		echo "<table><tr><td>". _('Status Code') .':</td><td>';
		echo $_POST['ReasonCode'] . '</td></tr>';

	} else { //end of if $SelectedReason only do the else when a new record is being entered
		if (!isset($_POST['ReasonCode'])) {
			$_POST['ReasonCode'] = '';
		}
		echo '<table>
			<tr>
				<td>'. _('Status Code') .":</td>
				<td><input " . (in_array('ReasonCode',$Errors) ? 'class="inputerror"' : '' ) .
					" tabindex=1 type='Text' name='ReasonCode' VALUE='". $_POST['ReasonCode'] ."' size=3 maxlength=2></td>
			</tr>";
	}

	if (!isset($_POST['ReasonDescription'])) {
		$_POST['ReasonDescription'] = '';
	}
	echo '<tr>
		<td>'. _('Description') .":</td>
		<td><input " . (in_array('ReasonDescription',$Errors) ? 'class="inputerror"' : '' ) .
		 " tabindex=2 type='text' name='ReasonDescription' VALUE='". $_POST['ReasonDescription'] ."' size=28 maxlength=30>
	</td></tr>
	<tr><td>". _('Disallow Invoices') . "</td>";
	if (isset($_POST['DisallowInvoices']) and $_POST['DisallowInvoices']==1) {
		echo "<td><input tabindex=3 type='checkbox' checked name='DisallowInvoices'></td></tr>";
	} else {
		echo "<td><input tabindex=3 type='checkbox' name='DisallowInvoices'></td></tr>";		
	}
	echo "</table><div class='centre'><input tabindex=4 type='Submit' name='submit' value='" . _('Enter Information') . "'></div></form>";
} //end if record deleted no point displaying form to add record
include('includes/footer.inc');
?>