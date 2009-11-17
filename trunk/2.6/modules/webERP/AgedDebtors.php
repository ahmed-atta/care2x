<?php

$PageSecurity = 2;
include('includes/session.inc');
/* $Revision: 1.18 $ */


If (isset($_POST['PrintPDF'])
	AND isset($_POST['FromCriteria'])
	AND strlen($_POST['FromCriteria'])>=1
	AND isset($_POST['ToCriteria'])
	AND strlen($_POST['ToCriteria'])>=1){


	include('includes/PDFStarter.php');

	$FontSize=12;
	$pdf->addinfo('Title',_('Aged Customer Balance Listing'));
	$pdf->addinfo('Subject',_('Aged Customer Balances'));

	$PageNumber=0;
	$line_height=12;

      /*Now figure out the aged analysis for the customer range under review */
	if (trim($_POST['Salesman'])!=''){
		$SalesLimit = " and debtorsmaster.debtorno in (SELECT DISTINCT debtorno FROM custbranch where salesman = '".$_POST['Salesman']."') ";
	} else {
		$SalesLimit = "";
	}
	if ($_POST['All_Or_Overdues']=='All'){
		$SQL = "SELECT debtorsmaster.debtorno,
				debtorsmaster.name,
				currencies.currency,
				paymentterms.terms,
				debtorsmaster.creditlimit,
				holdreasons.dissallowinvoices,
				holdreasons.reasondescription,
				SUM(
					debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
				) as balance,
				SUM(
					CASE WHEN (paymentterms.daysbeforedue > 0)
					THEN
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate)) >= paymentterms.daysbeforedue
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
						ELSE 0 END
					ELSE
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') .")) >= 0
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc ELSE 0 END
					END
				) AS due,
				Sum(
					CASE WHEN (paymentterms.daysbeforedue > 0)
					THEN
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate)) > paymentterms.daysbeforedue AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays1'] . ")
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc ELSE 0 END
					ELSE
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL ('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= " . $_SESSION['PastDueDays1'] . "
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
						ELSE 0 END
					END
				) AS overdue1,
				Sum(
					CASE WHEN (paymentterms.daysbeforedue > 0)
					THEN
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate)) > paymentterms.daysbeforedue AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays2'] . ")
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc ELSE 0 END
					ELSE
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL ('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= " . $_SESSION['PastDueDays2'] . "
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
						ELSE 0 END
					END
				) AS overdue2
				FROM debtorsmaster,
					paymentterms,
					holdreasons,
					currencies,
					debtortrans
				WHERE debtorsmaster.paymentterms = paymentterms.termsindicator
					AND debtorsmaster.currcode = currencies.currabrev
					AND debtorsmaster.holdreason = holdreasons.reasoncode
					AND debtorsmaster.debtorno = debtortrans.debtorno
					AND debtorsmaster.debtorno >= '" . $_POST['FromCriteria'] . "'
					AND debtorsmaster.debtorno <= '" . $_POST['ToCriteria'] . "'
					AND debtorsmaster.currcode ='" . $_POST['Currency'] . "'
					$SalesLimit
				GROUP BY debtorsmaster.debtorno,
					debtorsmaster.name,
					currencies.currency,
					paymentterms.terms,
					paymentterms.daysbeforedue,
					paymentterms.dayinfollowingmonth,
					debtorsmaster.creditlimit,
					holdreasons.dissallowinvoices,
					holdreasons.reasondescription
				HAVING
					Sum(debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc) <>0";

	} elseif ($_POST['All_Or_Overdues']=='OverduesOnly') {

	      $SQL = "SELECT debtorsmaster.debtorno,
	      		debtorsmaster.name,
	      		currencies.currency,
	      		paymentterms.terms,
			debtorsmaster.creditlimit,
	      		holdreasons.dissallowinvoices,
	      		holdreasons.reasondescription,
			SUM(
	      			debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
	      		) AS balance,
			SUM(
	      			CASE WHEN (paymentterms.daysbeforedue > 0)
	      				THEN
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= paymentterms.daysbeforedue
	      					THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
	      					ELSE 0 END
	      				ELSE
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= 0 )
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc ELSE 0 END
					END
	      		) AS due,
			SUM(
		      		CASE WHEN (paymentterms.daysbeforedue > 0)
	      				THEN
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) > paymentterms.daysbeforedue AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays1'] . ")
	      					THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
	      					ELSE 0 END
	      				ELSE
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= " . $_SESSION['PastDueDays1'] . ")
	      					THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
	      					ELSE 0 END
					END
	      		) AS overdue1,
			SUM(
		      		CASE WHEN (paymentterms.daysbeforedue > 0)
	      				THEN
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) > paymentterms.daysbeforedue AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays2'] . ")
	      					THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
	      					ELSE 0 END
	      				ELSE
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= " . $_SESSION['PastDueDays2'] . ")
	      					THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
	      					ELSE 0 END
					END
	      		) AS overdue2
			FROM debtorsmaster,
	      			paymentterms,
	      			holdreasons,
	      			currencies,
	      			debtortrans
	      		WHERE debtorsmaster.paymentterms = paymentterms.termsindicator
	      		AND debtorsmaster.currcode = currencies.currabrev
	      		AND debtorsmaster.holdreason = holdreasons.reasoncode
	      		AND debtorsmaster.debtorno = debtortrans.debtorno
				AND debtorsmaster.debtorno >= '" . $_POST['FromCriteria'] . "'
	      		AND debtorsmaster.debtorno <= '" . $_POST['ToCriteria'] . "'
	      		AND debtorsmaster.currcode ='" . $_POST['Currency'] . "'
				$SalesLimit
			GROUP BY debtorsmaster.debtorno,
	      			debtorsmaster.name,
	      			currencies.currency,
	      			paymentterms.terms,
	      			paymentterms.daysbeforedue,
	      			paymentterms.dayinfollowingmonth,
	      			debtorsmaster.creditlimit,
	      			holdreasons.dissallowinvoices,
	      			holdreasons.reasondescription
			HAVING Sum(
				CASE WHEN (paymentterms.daysbeforedue > 0)
	      				THEN
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) > paymentterms.daysbeforedue AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays1'] . ")
	      					THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
	      					ELSE 0 END
	      				ELSE
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= " . $_SESSION['PastDueDays1'] . ")
	      					THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
	      					ELSE 0 END
					END
	      			) > 0";

	} elseif ($_POST['All_Or_Overdues']=='HeldOnly'){

		$SQL = "SELECT debtorsmaster.debtorno,
					debtorsmaster.name,
					currencies.currency,
					paymentterms.terms,
					debtorsmaster.creditlimit,
					holdreasons.dissallowinvoices,
					holdreasons.reasondescription,
			SUM(debtortrans.ovamount +
				debtortrans.ovgst +
				debtortrans.ovfreight +
				debtortrans.ovdiscount -
				debtortrans.alloc) AS balance,
			SUM(
				CASE WHEN (paymentterms.daysbeforedue > 0)
					THEN
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= paymentterms.daysbeforedue
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
						ELSE 0 END
					ELSE
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate," . INTERVAL('1', 'MONTH') . ")," .  INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= 0)
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
						ELSE 0 END
				END
			) AS due,
			SUM(
				CASE WHEN (paymentterms.daysbeforedue > 0)
					THEN
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) > paymentterms.daysbeforedue
						AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays1'] . ")
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc ELSE 0 END
					ELSE
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= " . $_SESSION['PastDueDays1'] . ")
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
					ELSE 0 END
				END
			) AS overdue1,
			SUM(
				CASE WHEN (paymentterms.daysbeforedue > 0)
					THEN
						CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) > paymentterms.daysbeforedue
						AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays2'] . ")
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
						ELSE 0 END
					ELSE
						CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= ".$_SESSION['PastDueDays2'] . ")
						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
					ELSE 0 END
				END
			) AS overdue2
		FROM debtorsmaster,
		paymentterms,
		holdreasons,
		currencies,
		debtortrans
		WHERE debtorsmaster.paymentterms = paymentterms.termsindicator
		AND debtorsmaster.currcode = currencies.currabrev
		AND debtorsmaster.holdreason = holdreasons.reasoncode
		AND debtorsmaster.debtorno = debtortrans.debtorno
		AND holdreasons.dissallowinvoices=1
		AND debtorsmaster.debtorno >= '" . $_POST['FromCriteria'] . "'
		AND debtorsmaster.debtorno <= '" . $_POST['ToCriteria'] . "'
		AND debtorsmaster.currcode ='" . $_POST['Currency'] . "'
		$SalesLimit
		GROUP BY debtorsmaster.debtorno,
		debtorsmaster.name,
		currencies.currency,
		paymentterms.terms,
		paymentterms.daysbeforedue,
		paymentterms.dayinfollowingmonth,
		debtorsmaster.creditlimit,
		holdreasons.dissallowinvoices,
		holdreasons.reasondescription
		HAVING Sum(
			debtortrans.ovamount +
			debtortrans.ovgst +
			debtortrans.ovfreight +
			debtortrans.ovdiscount -
			debtortrans.alloc
		) <>0";
	}
	$CustomerResult = DB_query($SQL,$db,'','',False,False); /*dont trap errors handled below*/

	if (DB_error_no($db) !=0) {
		$title = _('Aged Customer Account Analysis') . ' - ' . _('Problem Report') . '.... ';
		include('includes/header.inc');
		echo '<p>' . _('The customer details could not be retrieved by the SQL because') . ' ' . DB_error_msg($db);
		echo "<br><a href='$rootpath/index.php?" . SID . "'>" . _('Back to the menu') . '</a>';
		if ($debug==1){
			echo "<br>$SQL";
		}
		include('includes/footer.inc');
		exit;
	}

	include ('includes/PDFAgedDebtorsPageHeader.inc');

	$TotBal=0;
	$TotCurr=0;
	$TotDue=0;
	$TotOD1=0;
	$TotOD2=0;

	While ($AgedAnalysis = DB_fetch_array($CustomerResult,$db)){

		$DisplayDue = number_format($AgedAnalysis['due']-$AgedAnalysis['overdue1'],2);
		$DisplayCurrent = number_format($AgedAnalysis['balance']-$AgedAnalysis['due'],2);
		$DisplayBalance = number_format($AgedAnalysis['balance'],2);
		$DisplayOverdue1 = number_format($AgedAnalysis['overdue1']-$AgedAnalysis['overdue2'],2);
		$DisplayOverdue2 = number_format($AgedAnalysis['overdue2'],2);

		$TotBal += $AgedAnalysis['balance'];
		$TotDue += ($AgedAnalysis['due']-$AgedAnalysis['overdue1']);
		$TotCurr += ($AgedAnalysis['balance']-$AgedAnalysis['due']);
		$TotOD1 += ($AgedAnalysis['overdue1']-$AgedAnalysis['overdue2']);
		$TotOD2 += $AgedAnalysis['overdue2'];

		$LeftOvers = $pdf->addTextWrap($Left_Margin,$YPos,220-$Left_Margin,$FontSize,$AgedAnalysis['debtorno'] . ' - ' . $AgedAnalysis['name'],'left');
		$LeftOvers = $pdf->addTextWrap(220,$YPos,60,$FontSize,$DisplayBalance,'right');
		$LeftOvers = $pdf->addTextWrap(280,$YPos,60,$FontSize,$DisplayCurrent,'right');
		$LeftOvers = $pdf->addTextWrap(340,$YPos,60,$FontSize,$DisplayDue,'right');
		$LeftOvers = $pdf->addTextWrap(400,$YPos,60,$FontSize,$DisplayOverdue1,'right');
		$LeftOvers = $pdf->addTextWrap(460,$YPos,60,$FontSize,$DisplayOverdue2,'right');

		$YPos -=$line_height;
		if ($YPos < $Bottom_Margin + $line_height){
		      include('includes/PDFAgedDebtorsPageHeader.inc');
		}


		if ($_POST['DetailedReport']=='Yes'){

		   /*draw a line under the customer aged analysis*/
		   $pdf->line($Page_Width-$Right_Margin, $YPos+10,$Left_Margin, $YPos+10);

				$sql = "SELECT systypes.typename,
			   			debtortrans.transno,
			   			debtortrans.trandate,
				   		(debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc) as balance,
						(CASE WHEN (paymentterms.daysbeforedue > 0)
							THEN
		   						(CASE WHEN (TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate)) >= paymentterms.daysbeforedue
		   						then debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
		   						ELSE 0 END)
							ELSE
		   						(CASE WHEN TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= 0
		   						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
		   						ELSE 0 END)
						END) AS due,
						(CASE WHEN (paymentterms.daysbeforedue > 0)
		   					THEN
								(CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) > paymentterms.daysbeforedue AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays1'] . ") THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc ELSE 0 END)
		   					ELSE
								(CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))', 'DAY') . ")) >= " . $_SESSION['PastDueDays1'] . ")
		   						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
		   						ELSE 0 END)
						END) AS overdue1,
						(CASE WHEN (paymentterms.daysbeforedue > 0)
		   					THEN
								(CASE WHEN TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) > paymentterms.daysbeforedue AND TO_DAYS(Now()) - TO_DAYS(debtortrans.trandate) >= (paymentterms.daysbeforedue + " . $_SESSION['PastDueDays2'] . ")
		   						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
		   						ELSE 0 END)
		 					ELSE
								(CASE WHEN (TO_DAYS(Now()) - TO_DAYS(DATE_ADD(DATE_ADD(debtortrans.trandate, " . INTERVAL('1', 'MONTH') . "), " . INTERVAL('(paymentterms.dayinfollowingmonth - DAYOFMONTH(debtortrans.trandate))','DAY') . ")) >= " . $_SESSION['PastDueDays2'] . ")
		   						THEN debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc
		   						ELSE 0 END)
						END) AS overdue2
				   FROM debtorsmaster,
		   				paymentterms,
		   				debtortrans,
		   				systypes
				   WHERE systypes.typeid = debtortrans.type
		   				AND debtorsmaster.paymentterms = paymentterms.termsindicator
		   				AND debtorsmaster.debtorno = debtortrans.debtorno
				   		AND debtortrans.debtorno = '" . $AgedAnalysis['debtorno'] . "'
		   				AND ABS(debtortrans.ovamount + debtortrans.ovgst + debtortrans.ovfreight + debtortrans.ovdiscount - debtortrans.alloc)>0.004";


		    $DetailResult = DB_query($sql,$db,'','',False,False); /*Dont trap errors */
		    if (DB_error_no($db) !=0) {
			$title = _('Aged Customer Account Analysis') . ' - ' . _('Problem Report') . '....';
			include('includes/header.inc');
			echo '<br><br>' . _('The details of outstanding transactions for customer') . ' - ' . $AgedAnalysis['debtorno'] . ' ' . _('could not be retrieved because') . ' - ' . DB_error_msg($db);
			echo "<br><a href='$rootpath/index.php'>" . _('Back to the menu') . '</a>';
			if ($debug==1){
				echo '<br>' . _('The SQL that failed was') . '<p>' . $sql;
			}
			include('includes/footer.inc');
			exit;
		    }

		    while ($DetailTrans = DB_fetch_array($DetailResult)){

		    	    $LeftOvers = $pdf->addTextWrap($Left_Margin+5,$YPos,60,$FontSize,$DetailTrans['typename'],'left');
			    $LeftOvers = $pdf->addTextWrap($Left_Margin+65,$YPos,60,$FontSize,$DetailTrans['transno'],'left');
			    $DisplayTranDate = ConvertSQLDate($DetailTrans['trandate']);
			    $LeftOvers = $pdf->addTextWrap($Left_Margin+125,$YPos,75,$FontSize,$DisplayTranDate,'left');

			    $DisplayDue = number_format($DetailTrans['due']-$DetailTrans['overdue1'],2);
			    $DisplayCurrent = number_format($DetailTrans['balance']-$DetailTrans['due'],2);
			    $DisplayBalance = number_format($DetailTrans['balance'],2);
			    $DisplayOverdue1 = number_format($DetailTrans['overdue1']-$DetailTrans['overdue2'],2);
			    $DisplayOverdue2 = number_format($DetailTrans['overdue2'],2);

			    $LeftOvers = $pdf->addTextWrap(220,$YPos,60,$FontSize,$DisplayBalance,'right');
			    $LeftOvers = $pdf->addTextWrap(280,$YPos,60,$FontSize,$DisplayCurrent,'right');
			    $LeftOvers = $pdf->addTextWrap(340,$YPos,60,$FontSize,$DisplayDue,'right');
			    $LeftOvers = $pdf->addTextWrap(400,$YPos,60,$FontSize,$DisplayOverdue1,'right');
			    $LeftOvers = $pdf->addTextWrap(460,$YPos,60,$FontSize,$DisplayOverdue2,'right');

			    $YPos -=$line_height;
			    if ($YPos < $Bottom_Margin + $line_height){
				$PageNumber++;
				include('includes/PDFAgedDebtorsPageHeader.inc');
			    }

		    } /*end while there are detail transactions to show */
		    $FontSize=8;
		    /*draw a line under the detailed transactions before the next customer aged analysis*/
		    $pdf->line($Page_Width-$Right_Margin, $YPos+10,$Left_Margin, $YPos+10);
		} /*Its a detailed report */
	} /*end customer aged analysis while loop */

	$YPos -=$line_height;
	if ($YPos < $Bottom_Margin + (2*$line_height)){
		$PageNumber++;
		include('includes/PDFAgedDebtorsPageHeader.inc');
	} elseif ($_POST['DetailedReport']=='Yes') {
		//dont do a line if the totals have to go on a new page
		$pdf->line($Page_Width-$Right_Margin, $YPos+10 ,220, $YPos+10);
	}

	$DisplayTotBalance = number_format($TotBal,2);
	$DisplayTotDue = number_format($TotDue,2);
	$DisplayTotCurrent = number_format($TotCurr,2);
	$DisplayTotOverdue1 = number_format($TotOD1,2);
	$DisplayTotOverdue2 = number_format($TotOD2,2);

	$LeftOvers = $pdf->addTextWrap(220,$YPos,60,$FontSize,$DisplayTotBalance,'right');
	$LeftOvers = $pdf->addTextWrap(280,$YPos,60,$FontSize,$DisplayTotCurrent,'right');
	$LeftOvers = $pdf->addTextWrap(340,$YPos,60,$FontSize,$DisplayTotDue,'right');
	$LeftOvers = $pdf->addTextWrap(400,$YPos,60,$FontSize,$DisplayTotOverdue1,'right');
	$LeftOvers = $pdf->addTextWrap(460,$YPos,60,$FontSize,$DisplayTotOverdue2,'right');

	$buf = $pdf->output();
	$len = strlen($buf);

	if ($len < 1000) {
		$title = _('Aged Customer Account Analysis') . ' - ' . _('Problem Report') . '....';
		include('includes/header.inc');
		prnMsg(_('There are no customers meeting the critiera specified to list'),'info');
		if ($debug==1){
			prnMsg($SQL,'info');
		}
		echo "<br><a href='$rootpath/index.php'>" . _('Back to the menu') . '</a>';
		include('includes/footer.inc');
		exit;
	}

	header('Content-type: application/pdf');
	header("Content-Length: $len");
	header('Content-Disposition: inline; filename=AgedDebtors.pdf');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');

	$pdf->stream();

} else { /*The option to print PDF was not hit */

	$title=_('Aged Debtor Analysis');
	include('includes/header.inc');

    echo '<p class="page_title_text"><img src="'.$rootpath.'/css/'.$theme.'/images/magnifier.png" title="' . _('Search') . '" alt="">' . ' ' . $title.'<br>';

	if ((!isset($_POST['FromCriteria']) || !isset($_POST['ToCriteria']))) {

	/*if $FromCriteria is not set then show a form to allow input	*/

		echo '<form action=' . $_SERVER['PHP_SELF'] . " method='post'><table>";

		echo '<tr><td>' . _('From Customer Code') . ':' . "</font></td><td><input tabindex='1' Type=text maxlength=6 size=7 name=FromCriteria value='0'></td></tr>";
		echo '<tr><td>' . _('To Customer Code') . ':' . "</td><td><input tabindex='2' Type=text maxlength=6 size=7 name=ToCriteria value='zzzzzz'></td></tr>";

		echo '<tr><td>' . _('All balances or overdues only') . ':' . "</td><td><select tabindex='3' name='All_Or_Overdues'>";
		echo "<option selected Value='All'>" . _('All customers with balances');
		echo "<option Value='OverduesOnly'>" . _('Overdue accounts only');
		echo "<option Value='HeldOnly'>" . _('Held accounts only');
		echo '</select></td></tr>';

		echo '<tr><td>' . _('Only Show Customers Of') . ':' . "</td><td><select tabindex='4' name='Salesman'>";

		$sql = 'SELECT salesmancode, salesmanname FROM salesman';

		$result=DB_query($sql,$db);
		echo "<option value=''></option>";
		while ($myrow=DB_fetch_array($result)){
				echo "<option value='" . $myrow['salesmancode'] . "'>" . $myrow['salesmanname'];
		}
		echo '</select></td></tr>';


		echo '<tr><td>' . _('Only show customers trading in') . ':' . "</td><td><select tabindex='5' name='Currency'>";

		$sql = 'SELECT currency, currabrev FROM currencies';

		$result=DB_query($sql,$db);


		while ($myrow=DB_fetch_array($result)){
		      if ($myrow['currabrev'] == $_SESSION['CompanyRecord']['currencydefault']){
				echo "<option selected value='" . $myrow['currabrev'] . "'>" . $myrow['currency'];
		      } else {
			      echo "<option value='" . $myrow['currabrev'] . "'>" . $myrow['currency'];
		      }
		}
		echo '</select></td></tr>';

		echo '<tr><td>' . _('Summary or detailed report') . ':' . "</td>
			<td><select tabindex='6' name='DetailedReport'>";
		echo "<option selected value='No'>" . _('Summary Report');
		echo "<option value='Yes'>" . _('Detailed Report');
		echo '</select></td></tr>';

		echo '</table><br><div class="centre"><input tabindex="7" type=submit name="PrintPDF" value="' . _('Print PDF') , '"></div>';
	}
	include('includes/footer.inc');

} /*end of else not PrintPDF */

?>