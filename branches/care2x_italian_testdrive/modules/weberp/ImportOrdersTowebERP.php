<?php
/* $Revision: 1.00$ */


/*
 * Based on the script to import zen-cart orders to webERP this script takes a file name of a comma delimited file CSV and
 * imports it into webERP orders
 *
 * HEADER, customers_id,
 * 			customers_telephone,
 * 			customers_email_address,
 * 			billing_company,
 * 			billing_street_address,
 * 			billing_suburb, billing_city,
 * 			billing_postcode, billing_state,
 * 			billing_country,
 * 			date_purchased,
 * 			reference
 *
 * LINE, stockid,
 * 			quantity,
 * 			price
 *
 * Any number of lines for each header record - a new header record initiates a new order and completes the previous order
 *
 * If the customer code already exists in webERP then the current billing details are checked and updated as necessary
 *
 * Developed by Phil Daintree - Logic Works Ltd - phil@logicworks.co.nz
 *
*/

/* Specific Configuration parameters */

$ReceivedFilesDir = '/opt/lampp/htdocs/webERP/voucher_files/'; //where the files are to import
$SalesType ='DE';
$Salesman = 'DE';
$HoldReason =1;
$PaymentTerms ='30';
$SalesArea ='DE';
$InventoryLocation ='MEL';
$TaxGroup =1;
$DefaultShipper=1;
$Currency ='AUD';
$Notify_Email = '';


//If using the get files with FTP options parameters are required below
$FTP_Server_Host = 'ftp.someremotemachine.com';
$FTP_User_Name = 'ftpuser';
$FTP_User_Pwd = 'ftppwd';
$Filename = 'GetFileName';




$PageSecurity =1;
include('includes/session.inc');
$title = _('Upload Orders to webERP');
include('includes/header.inc');


//An option to get the files from a remote ftp server may be required ??

if ($_POST['GetFilesWithFTP']){

	$FTP_Server_Host = 'ftp.someremotemachine.com';
	$FTP_User_Name = 'ftpuser';
	$FTP_User_Pwd = 'ftppwd';
	$Filename = 'GetFileName';


	echo '<P>' . _('FTP Connection progress') . ' .....';
// set up basic connection
	$conn_id = ftp_connect($FTP_Server_Host); // login with username and password
	$login_result = ftp_login($conn_id, $FTP_User_Name, $FTP_User_Pwd); // check connection
	if ((!$conn_id) || (!$login_result)) {
		  prnMsg( _('Ftp connection has failed'),'error');
		  prnMsg( _('Attempted to connect to') . ' ' . $FTP_Server_Host . ' ' . _('for user') . ' ' . $FTP_User_Name, 'error');
		  include('includes/footer.inc');
		  exit;
	  } else {
		  prnMsg( _('Connected to remote FTP server at') . ' ' . $FTP_Server_Host . ' ' . _('with user name') . ' ' . $FTP_User_Name,'success');
	  } // upload the file
	  $upload = ftp_get($conn_id, $FileName, $ReceivedFilesDir, FTP_ASCII); // check upload status
	  if (!$upload) {
		   prnMsg(_('FTP upload has failed'),'error');
		   include('includes/footer.inc');
		   exit;
	  } else {
		   prnMsg(_('Uploaded') . ' ' . $FileName . ' ' . _('from') . ' ' . $FTP_Server_Host, 'success');
	  } // close the FTP stream
	  ftp_quit($conn_id);
}


echo '<TABLE>';

echo '<TR><TD>' . _('Select the file(s) to import') . '</TD>
		<TD><SELECT name="FileSelected" multiple>';

$FileDirHandle = dir($ReceivedFilesDir);
while (false != ($FileName = $FileDirHandle->read())){
	if (is_dir($ReceivedFilesDir . $FileName) AND $FileName != '..' AND $FileName!='.'){
		if (is_array($_POST['FileSelected'])){
			if (in_array($FileName,$_POST['FileSelected'])){
				echo "<OPTION SELECTED VALUE='" . $FileName . "'>" . $FileName;
			}
		}
		echo "<OPTION VALUE='" . $FileName . "'>" . $FileName;
	}
}

echo '</SELECT></TD></TR>';

echo '<tr><td colspan=2 align="center"><input type="submit" name="ImportFiles" value="Import Files"></td></tr></table>';

if (isset($_POST['ImportFiles'])){
	$FirstOrder = true;
	foreach ($_POST['FileSelected'] as $FileName){

		$FileLines = file($Filename); //makes an array of all lines in the file
		foreach ($FileLines as $Line){ //loop through each line
			$Fields = explode (',',$Line); //makes an array of all fields in the line delimeted by the comma
			if ($Fields[0] ='HEADER'){ // then its a new order header line

				if ($FirstOrder==false) { //then process the previous order

						$SQL = "SELECT name,
								address1,
								address2,
								address3,
								address4,
								address5,
								address6,
								currcode
								FROM debtorsmaster
								WHERE debtorno ='" . $customers_id . "'";

						$DebtorResult = DB_query($SQL,$db);


						if (DB_num_rows($DebtorResult)==0){
							$EmailText .= "\n" . _('The customer did not exist .... creating the customer record in webERP for' ) . ' ' .$billing_company . ' ' . _('for the customer') . ' ' .$customers_id ;

							$BranchCode = $customers_id;

							$SQL ="INSERT INTO debtorsmaster (debtorno,
											name,
											address1,
											address2,
											address3,
											address4,
											address5,
											address6,
											currcode,
											salestype,
											clientsince,
											holdreason,
											paymentterms)
									VALUES ('" . $customer_id . "',
										'" . $billing_company . "',
										'" . $billing_street_address . "',
										'" . $billing_suburb . "',
										'" . $billing_city . "',
										'" . $billing_state . "',
										'" . $billing_postcode . "',
										'" . $billing_country . "',
										'" . $Currency . "',
										'" . $SalesType . "',
										'" . Date('Y-m-d') . "',
										" .  $HoldReason . ",
										'" . $PaymentTerms . "')";
							$ErrMsg = _('The webERP customer record could not be inserted because');
							$InsertCustomerResult = DB_query($SQL,$weberp_db,$ErrMsg);
							/*Now the customer branch detail needs to be inserted also
							It is possible to store multiple delivery addresses against a single customer in webERP*/

							$SQL = "INSERT INTO custbranch (branchcode,
											debtorno,
											brname,
											braddress1,
											braddress2,
											braddress3,
											braddress4,
											braddress5,
											braddress6,
											area,
											salesman,
											phoneno,
											email,
											defaultlocation,
											taxgroupid,
											defaultshipvia
											)
									VALUES ('" . $BranchCode . "',
										'" . $customer_id . "',
										'" . $billing_company . "',
										'" . $billing_street_address . "',
										'" . $billing_suburb . "',
										'" . $billing_city . "',
										'" . $billing_postcode . "',
										'" . $billing_state . "',
										'" . $billing_country . "',
										'" . $SalesArea . "',
										'" . $Salesman . "',
										'" . $customers_telephone . "',
										'" . $customers_email_address . "',
										'" . $InventoryLocation . "',
										" . $TaxGroup . ",
										" . $DefaultShipper . ")";

							$ErrMsg = _('The webERP customer branch record could not be inserted because');
							$InsertCustomerBranchResult = DB_query($SQL,$weberp_db,$ErrMsg);

						} // end if the customer record didn't exist
							else { /* the customer exists already in webERP	*/
									/*Check that the customer details in debtorsmaster agree*/

								$webERPCustomerRow = DB_fetch_array($DebtorResult);

								if ($webERPCustomerRow['name'] != $billing_company OR
													 $webERPCustomerRow['address1'] != $billing_street_address OR
													 $webERPCustomerRow['address2'] != $billing_suburb OR
													 $webERPCustomerRow['address3'] != $billing_city  OR
													 $webERPCustomerRow['address4'] != $billing_state OR
													 $webERPCustomerRow['address5'] != $billing_postcode OR
													 $webERPCustomerRow['address6'] != $billing_country ){

														$SQL = "UPDATE debtormaster SET name = '" . $billing_company . "',
																				 address1 = '" . $billing_street_address . "',
																				 address2 = '" . $billing_suburb . "',
																				 address3 = '" . $billing_city . "',
																				 address4 = '" . $billing_state . "',
																				 address5 = '" . $billing_postcode . "',
																				 address6 = '" . $billing_country . "'
																  WHERE debtorno = '" . $customers_id . "'";

										$ErrMsg = _('Could not update the webERP debtor data with the order customer information');
										$EmailText .= "\n" . _('The customer billing name and/or address has changed so webERP has been updated with the new details for') . ' ' . $billing_company . ' ' . _('customer id') . ' ' . $customer_id;
										$UpdateDebtorResult = DB_query($SQL,$db,$ErrMsg);

										$SQL = "UPDATE custbranch (	brname='" . $billing_company . "',
																braddress1='" . $billing_street_address . "',
																braddress2='" . $billing_suburb . "',
																braddress3= '" . $billing_city . "',
																braddress4= '" . $billing_state . "',
																braddress5 = '" . $billing_postcode . "',
																braddress6 = '" . $billing_country . "'
														WHERE debtorno = '" . $customers_id . "'
														AND branchcode ='" . $customers_id . "'";
										$UpdateBranchResult = DB_query($SQL,$db,$ErrMsg);

								}
						} //end if the customer already existed so checked off the details agree

						//OK we have the customer in webERP now we insert the order

						$BeginTrans = DB_query('BEGIN',$weberp_db);

						$sql = "INSERT INTO salesorders ( debtorno,
										  branchcode,
										  buyername,
										  orddate,
										  ordertype,
										  shipvia,
										  deladd1,
										  deladd2,
										  deladd3,
										  deladd5,
										  deladd6,
										  contactemail,
										  deliverto,
										  fromstkloc,
										  deliverydate,
										  customerref)
										VALUES ('" . DB_escape_string($customer_id) . "',
											'" . DB_escape_string($customer_id) . "',
											'" . DB_escape_string($billing_company) . "',
											'" . DB_escape_string($date_purchased) . "',
											'" . DB_escape_string($SalesType) . "',
											'" . DB_escape_string($DefaultShipVia) . "',
											'" . DB_escape_string($billing_street_address) . "',
											'" . DB_escape_string($billing_suburb) . "',
											'" . DB_escape_string($billing_city) . "',
											'" . DB_escape_string($billing_postcode) . "',
											'" . DB_escape_string($billing_country) . "',
											'" . DB_escape_string($customers_email_address) . "',
											'" . DB_escape_string($billing_company) . "',
											'" . DB_escape_string($DefaultLocation) . "',
											'" . DB_escape_string($date_purchased) . "',
											'" . DB_escape_string($reference) . "')";


						$InsertOrderResult = DB_query($sql, $db);
						$webERPOrderNo = DB_Last_Insert_ID($wdb,'salesorders','orderno');

						/*Now the line items ...... */

						/*Also Need to check that all line items are mapped to webERP item codes*/

						for ($i=0;$i<count($LineItems);$i++){

							$CheckItemExistsResult = DB_query("SELECT stockid FROM	stockmaster
																WHERE stockid='" . $LineItems[$i]['StockID'] . "'",
																$db);

							if (DB_num_rows($CheckItemExistsResult)==0){
								$EmailText = "\n" . _('The order line for the product id') . ' ' . $LineItems[$i]['StockID'] . ' ' . _('does not exist in webERP') ."\n" . _('This order line was for') . ' ' . $LineItems[$i]['Quantity'] . ' ' . _('at a price of') . ' ' . $LineItems[$i]['Price'];
							} else {
								$InsOrderLineResult = DB_query("INSERT INTO salesorderdetails (
																orderlineno,
																orderno,
																stkcode,
																unitprice,
																quantity)
													VALUES (
														" . $i . ",
														" . $webERPOrderNo . ",
														'" . $LineItems[$i]['StockID'] . "',
														" . $LineItems[$i]['Price'] . ",
														" . $LineItems[$i]['Quantity'] ."
														)",
														$db);
							} //end if the item does exist
						}//end for loop around the array of line items on the order


						$CommitTrans = DB_query('COMMIT',$weberp_db);
						$EmailText .= "\n"  . _('A new webERP order has been created - number') .  ' ' . $webERPOrderNo;

						mail($Notify_Email, _('Imported webERP order number') . ' ' .$webERPOrderNo,$EmailText);
						echo '<p>' . $EmailText;
						for ($i=0;$i<count($LineItems);$i++){
							unset($LineItems[$i]);
						}
						unset($LineItems);
				} else { // this was the first order
					$FirstOrder=false; // it isn't the first order anymore
				}
				//Kick off the entry of the new order

				$customers_id = strtoupper($Fields[1]);
 				$customers_telephone = $Fields[2];
 				$customers_email_address = $Fields[3];
 				$billing_company = $Fields[4];
 				$billing_street_address = $Fields[5];
 				$billing_suburb = $Fields[6];
 				$billing_city = $Fields[7];
 				$billing_postcode = $Fields[8];
 				$billing_state = $Fields[9];
 				$billing_country = $Fields[10];
 				$date_purchased = FormatDateForSQL($Fields[11]);
 				$reference = $Fields[12];

				$LineItems = array();
				$LineCounter =0;
			}//end of a new order header line
				else { //it must be a LINE entry
					$LineItems[$LineCounter]['StockID'] = $Fields[1];
					$LineItems[$LineCounter]['Quantity'] = $Fields[2];
					$LineItems[$LineCounter]['Price'] = $Fields[3];
					$LineCounter++;
			}//end of a new LINE detail line
		} //end loop through all lines of the file
	} // end for each FileName
} //end user hit the Import Files button


include('includes/footer.php');

/* End of page logic */

?>