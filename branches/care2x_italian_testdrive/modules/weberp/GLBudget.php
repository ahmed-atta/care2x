<?php

/* $Revision: 1.17 $ */


$PageSecurity = 8;
include ('includes/session.inc');
$title = _('General Ledger Budget Entry');
include('includes/header.inc');

if (isset($_POST['Account'])){
	$SelectedAccount = $_POST['Account'];
} elseif (isset($_GET['Account'])){
	$SelectedAccount = $_GET['Account'];
}

if (isset($_POST['Period'])){
	$SelectedPeriod = $_POST['Period'];
} elseif (isset($_GET['Period'])){
	$SelectedPeriod = $_GET['Period'];
}

echo "<FORM METHOD='POST' ACTION=" . $_SERVER['PHP_SELF'] . '?' . SID . '>';

/*Dates in SQL format for the last day of last month*/
$DefaultPeriodDate = Date ('Y-m-d', Mktime(0,0,0,Date('m'),0,Date('Y')));

/*Show a form to allow input of criteria for TB to show */
echo '<CENTER><TABLE>
        <TR>
         <TD>'._('Account').":</TD>
         <TD><SELECT Name='Account'>";
         $sql = 'SELECT accountcode, accountname FROM chartmaster ORDER BY accountcode';
         $Account = DB_query($sql,$db);
         while ($myrow=DB_fetch_array($Account,$db)){
            if($myrow['accountcode'] == $SelectedAccount){
   	        echo '<OPTION SELECTED VALUE=' . $myrow['accountcode'] . '>' . $myrow['accountcode'] . ' ' . $myrow['accountname'];
	    } else {
		echo '<OPTION VALUE=' . $myrow['accountcode'] . '>' . $myrow['accountcode'] . ' ' . $myrow['accountname'];
	    }
         }
         echo '</SELECT></TD></TR>
         <TR>
         <TD>'._('For Period range').':</TD>
         <TD><SELECT Name=Period[] multiple>';
	 $sql = 'SELECT periodno, lastdate_in_period FROM periods';
	 $Periods = DB_query($sql,$db);
         $id=0;
         while ($myrow=DB_fetch_array($Periods,$db)){

            if($myrow['periodno'] == $SelectedPeriod[$id]){
              echo '<OPTION SELECTED VALUE=' . $myrow['periodno'] . '>' . _(MonthAndYearFromSQLDate($myrow['lastdate_in_period']));
            $id++;
            } else {
              echo '<OPTION VALUE=' . $myrow['periodno'] . '>' . _(MonthAndYearFromSQLDate($myrow['lastdate_in_period']));
            }

         }
         echo "</SELECT></TD>
        </TR>
</TABLE><P>
<INPUT TYPE=SUBMIT NAME='Show' VALUE='"._('Show Account Transactions')."'></CENTER>";

/* End of the Form  rest of script is what happens if the show button is hit*/

if (isset($_POST['Show'])){

	if (!isset($SelectedPeriod)){
		prnMsg(_('A period or range of periods must be selected from the list box'),'info');
		include('includes/footer.inc');
		exit;
	}
	/*Is the account a balance sheet or a profit and loss account */
	$result = DB_query("SELECT pandl
				FROM accountgroups
				INNER JOIN chartmaster ON accountgroups.groupname=chartmaster.group_
				WHERE chartmaster.accountcode=$SelectedAccount",$db);
	$PandLRow = DB_fetch_row($result);
	if ($PandLRow[0]==1){
		$PandLAccount = True;
	}else{
		$PandLAccount = False; /*its a balance sheet account */
	}

	$FirstPeriodSelected = min($SelectedPeriod);
	$LastPeriodSelected = max($SelectedPeriod);

 	$sql="SELECT *, chartmaster.accountname from chartdetails
			INNER JOIN chartmaster on chartmaster.accountcode = chartdetails.accountcode 
			WHERE chartdetails.accountcode = $SelectedAccount
			AND period>=$FirstPeriodSelected
		AND period<=$LastPeriodSelected
		ORDER BY period";
	$ErrMsg = _('The transactions for account') . ' ' . $SelectedAccount . ' ' . _('could not be retrieved because') ;
	$TransResult = DB_query($sql,$db,$ErrMsg);
$TransCount = DB_num_rows ($TransResult);
				echo '<p>row count ' . $TransCount . '</p>';
	echo '<table>';

	$TableHeader = "<TR>
			<TD class='tableheader'>" . _('Month') . "</TD>
			<TD class='tableheader'>" . _('Actual') . "</TD>
			<TD class='tableheader'>" . _('Budget') . "</TD>
			<TD class='tableheader'>" . _('Variance') . "</TD>
			<TD class='tableheader'>" . _('Period Actual') . "</TD>
			<TD class='tableheader'>" . _('Period Budget') . "</TD>
			<TD class='tableheader'>" . _('Revised Budget') . '</TD>
			</TR>';

	echo $TableHeader;

	if ($PandLAccount==True) {
		$RunningTotal = 0;
	} else {
	       // added to fix bug with Brought Forward Balance always being zero
					$sql = "SELECT *
					FROM chartdetails 
					WHERE chartdetails.accountcode= $SelectedAccount 
					AND chartdetails.period=" . $FirstPeriodSelected; 
					
				$ErrMsg = _('The chart details for account') . ' ' . $SelectedAccount . ' ' . _('could not be retrieved');
				$ChartDetailsResult = DB_query($sql,$db,$ErrMsg);
				$ChartDetailRow = DB_fetch_array($ChartDetailsResult);
				$ChartDetailCount = DB_num_rows ($ChartDetailsResult);
				
				// --------------------
				
		$RunningTotal =$ChartDetailRow['bfwd'];
		if ($RunningTotal < 0 ){ //its a credit balance b/fwd
			echo "<TR bgcolor='#FDFEEF'>
				<TD COLSPAN=3><B>" . _('Brought Forward Balance') . '</B><TD>
				</TD></TD>
				<TD ALIGN=RIGHT><B>' . number_format(-$RunningTotal,2) . '</B></TD>
				<TD></TD>
				</TR>';
		} else { //its a debit balance b/fwd
			echo "<TR bgcolor='#FDFEEF'>
				<TD COLSPAN=3><B>" . _('Brought Forward Balance') . '</B></TD>
				<TD ALIGN=RIGHT><B>' . number_format($RunningTotal,2) . '</B></TD>
				<TD COLSPAN=2></TD>
				</TR>';
		}
		
		$RunningBTotal =$ChartDetailRow['bfwdbudget'];
		if ($RunningBTotal < 0 ){ //its a credit balance b/fwd
			echo "<TR bgcolor='#FDFEEF'>
				<TD COLSPAN=3><B>" . _('Brought Forward Budget Balance') . '</B><TD>
				</TD></TD>
				<TD ALIGN=RIGHT><B>' . number_format(-$RunningBTotal,2) . '</B></TD>
				<TD></TD>
				</TR>';
		} else { //its a debit balance b/fwd
			echo "<TR bgcolor='#FDFEEF'>
				<TD COLSPAN=3><B>" . _('Brought Forward Budget Balance') . '</B></TD>
				<TD ALIGN=RIGHT><B>' . number_format($RunningBTotal,2) . '</B></TD>
				<TD COLSPAN=2></TD>
				</TR>';
		}
	}
	$PeriodTotal = 0;
	$PeriodNo = -9999;
	$ShowIntegrityReport = False;
	$j = 1;
	$k=0; //row colour counter

	while ($myrow=DB_fetch_array($TransResult)) {

		if ($myrow['periodno']!=$PeriodNo){
			if ($PeriodNo!=-9999){ //ie its not the first time around
				/*Get the ChartDetails balance b/fwd and the actual movement in the account for the period as recorded in the chart details - need to ensure integrity of transactions to the chart detail movements. Also, for a balance sheet account it is the balance carried forward that is important, not just the transactions*/

				$sql = "SELECT *,periods.lastdate_in_period,periods.periodno
					FROM chartdetails,periods 
					INNER JOIN periods on periods.periodno=chartdetails.period
					WHERE chartdetails.accountcode=" . $PeriodNo; 
					
				$ErrMsg = _('The chart details for account') . ' ' . $SelectedAccount . ' ' . _('could not be retrieved');
				$ChartDetailsResult = DB_query($sql,$db,$ErrMsg);
				$ChartDetailRow = DB_fetch_array($ChartDetailsResult);
				
				echo "<TR bgcolor='#FDFEEF'>
					<TD COLSPAN=3><B>" . _('Total for period') . ' ' . $PeriodNo . '</B></TD>';
				if ($PeriodTotal < 0 ){ //its a credit balance b/fwd
					echo '<TD></TD>
						<TD ALIGN=RIGHT><B>' . number_format(-$PeriodTotal,2) . '</B></TD>
						<TD></TD>
						</TR>';
				} else { //its a debit balance b/fwd
					echo '<TD ALIGN=RIGHT><B>' . number_format($PeriodTotal,2) . '</B></TD>
						<TD COLSPAN=2></TD>
						</TR>';
				}
				$IntegrityReport .= '<BR>' . _('Period') . ': ' . $PeriodNo  . _('Account movement per transaction') . ': '  . number_format($PeriodTotal,2) . ' ' . _('Movement per ChartDetails record') . ': ' . number_format($ChartDetailRow['actual'],2) . ' ' . _('Period difference') . ': ' . number_format($PeriodTotal -$ChartDetailRow['actual'],3);
				
				if (ABS($PeriodTotal -$ChartDetailRow['actual'])>0.01){
					$ShowIntegrityReport = True;
				}
			}
			$PeriodNo = $myrow['periodno'];
			$PeriodTotal = 0;
		}

		if ($k==1){
			echo "<tr bgcolor='#CCCCCC'>";
			$k=0;
		} else {
			echo "<tr bgcolor='#EEEEEE'>";
			$k++;
		}

		$RunningTotal += $myrow['actual'];
		$RunningBTotal += $myrow['budget'];
		$PeriodTotal += $myrow['actual'];
		
		if($myrow['actual']>=0){
			$ActualAmount = number_format($myrow['actual'],2);
			} else {
			$ActualAmount = number_format(-$myrow['actual'],2);
			}

		if($myrow['budget']>=0){
			$BudgetAmount = number_format($myrow['budget'],2);
			} else {
			$BudgetAmount = number_format(-$myrow['budget'],2);
			
		}
//$Variance = $BudgetAmount-$ActualAmount;
//if ($Variance == "" || $Variance == 0)
//	{
			if ($myrow['actual']<=0)
			{
			 $Actual1 = $myrow['actual']*(-1);
			 $Budget1 = $myrow['budget']*(-1);
			 $Variance = $Budget1 - $Actual1;
			}
			else
			{
			 $Variance = $Budget1 - $Actual1;
			}
	    $Variance1 = number_format($Variance,2);
		
		
					$sql = "SELECT lastdate_in_period FROM periods 
					WHERE periods.periodno=" . $myrow['period']; 
					
				$ErrMsg = _('The Period dates') . ' ' . $myrow['period'] . ' ' . _('could not be retrieved');
				$PeriodResult = DB_query($sql,$db,$ErrMsg);
				$PeriodRow = DB_fetch_array($PeriodResult);
				
				$PeriodText = MonthAndYearFromSQLDate($PeriodRow['lastdate_in_period']);
				

		printf('<td>%s</td>
			<td>%s</td>
			<td><input name="budget" type="text" size="15" value="%s"></td>
			<td ALIGN=RIGHT>%s</td>
			<td ALIGN=RIGHT>%s</td>
			<td ALIGN=RIGHT>%s</td>
			<td><input name="revised_budget" type="text" size="15" value="%s"></td>
			</tr>',
			$PeriodText,
			$ActualAmount,
			$BudgetAmount,
			$Variance1,
			$RunningTotal,
			$RunningBTotal,
			$myrow['budget']);

		$j++;

		If ($j == 18){
			echo $TableHeader;
			$j=1;
		}
		
	}

	echo "<TR bgcolor='#FDFEEF'><TD COLSPAN=3><B>";
	if ($PandLAccount==True){
		echo _('Total Period Movement');
	} else { /*its a balance sheet account*/
		echo _('Balance C/Fwd');
	}
	echo '</B></TD>';

	if ($RunningTotal >0){
		echo '<TD ALIGN=RIGHT><B>' . number_format(($RunningTotal),2) . '</B></TD><TD COLSPAN=2></TD></TR>';
	}else {
		echo '<TD></TD><TD ALIGN=RIGHT><B>' . number_format((-$RunningTotal),2) . '</B></TD><TD COLSPAN=2></TD></TR>';
	}
		echo '<tr><td colspan=6><input NAME="BudgetUpdate" type="submit" value="Update Budget">';
		printf ("%s",$ChartDetailCount); 
		echo '</td></tr>';


	echo '</table>';
	echo $ChartDetailCount;
} /* end of if Show button hit */

if (isset($_POST['BudgetUpdate'])){

	prnMsg(_('SUCCESS'),'info');
	$sql = "UPDATE chartdetails
				SET budget='" . $_POST['budget'] . "'
				WHERE period='" . $ChartDetailRow['period'] . "'
				AND accountcode = " . $ChartDetailRow['accountcode'];
// $result = mysql_query($sql, $connection);
$result = DB_query($sql,$db,$ErrMsg,$DbgMsg);
//					

// stick an echo in here:
echo $sql;
	
	exit;
		
	}
if (isset($_POST['submit'])) {

	//initialise no input errors assumed initially before we test

	$InputError = 0;

	/* actions to take once the user has clicked the submit button
	ie the page has called itself with some user input */

	//first off validate inputs sensible

	if (strpos($_POST['SectionName'],'&')>0 OR strpos($_POST['SectionName'],"'")>0) {
		$InputError = 1;
		prnMsg( _('The account section name cannot contain the character') . " '&' " . _('or the character') ." '",'error');
	} elseif (isset($_POST['SectionID']) && (!is_long((int) $_POST['SectionID']))) {
		$InputError = 1;
		prnMsg( _('The section number must be an integer'),'error');
	}

	if ($_POST['SelectedSectionID']!='' AND $InputError !=1) {

		/*SelectedSectionID could also exist if submit had not been clicked this code would not run in this case cos submit is false of course  see the delete code below*/

		$sql = "UPDATE accountsection
				SET sectionname='" . $_POST['SectionName'] . "'
				WHERE sectionid = " . $_POST['SelectedSectionID'];

		$msg = _('Record Updated');
	} elseif ($InputError !=1) {

	/*SelectedSectionID is null cos no item selected on first time round so must be adding a record must be submitting new entries in the new account section form */

		$sql = "INSERT INTO accountsection (
					sectionid,
					sectionname )
			VALUES (
				" . $_POST['SectionID'] . ",
				'" . $_POST['SectionName'] ."'
				)";
		$msg = _('Record inserted');
	}

	if ($InputError!=1){
		//run the SQL from either of the above possibilites
		$result = DB_query($sql,$db);
		prnMsg($msg,'success');
	}
	unset ($_POST['SelectedSectionID']);
	unset ($_POST['SectionID']);
	unset ($_POST['SectionName']);

}


echo "</FORM>";
include('includes/footer.inc');
?>
