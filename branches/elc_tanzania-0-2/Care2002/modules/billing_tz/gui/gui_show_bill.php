<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script language="javascript"> this.window.print(); </script>
<title><?php echo $TXT['BillNo']; ?> <?php echo $bill_number;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?php 
  if ($show_archived_bill)
    $bill_obj->DisplayArchivedBills($batch_nr,$bill_number,0,TRUE);
  else
    $bill_obj->DisplayBills($batch_nr,$bill_number,0,TRUE);
?>

</body>
</html>
