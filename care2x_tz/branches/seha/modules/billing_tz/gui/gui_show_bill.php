<head>

<script language="javascript"> this.window.print(); </script>
<title><?php echo $TXT['BillNo']; ?> <?php echo $bill_number;?></title>
</head>
<body>

<div> 

<?php 
  if ($show_archived_bill)
    $bill_obj->DisplayArchivedBills($batch_nr,$bill_number,0,TRUE);
  else
    $bill_obj->DisplayBills($batch_nr,$bill_number,0,TRUE);
?>

</body>
</html>
