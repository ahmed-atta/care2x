<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile=$root_path.'main/spediens.php'.URL_APPEND;

/*    include('includes/condb.php');
    error_reporting(0);
    connect_db();*/
?>
<html>

<head>
<title>Patient Name</title>
</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong>eComBill</strong></font></td>
      </tr>
    </table>

<form method="POST" action="">
  
  <p>
  <div align="center">
    <center>
    <table border="1" width="585" height="11" bordercolor="#000000" style="border-style: solid">
      <tr>
        <td width="100%" height="155" valign="top" bordercolor="#FFFFFF">
          <table border="0" width="100%">
            <tr>
              <td width="50%"><a href="enter_hospital_services.php<?php echo URL_APPEND ?>">Create Hospital Service Item</a>
                <p>&nbsp;</td>
              <td width="50%"><a href="enter_laboratory_tests.php<?php echo URL_APPEND ?>">Create Laboratory Test Item</a>
                <p>&nbsp;</td>
            </tr>
            <tr>
              <td width="50%"><a href="edit_hospital_services.php<?php echo URL_APPEND ?>&service=HS">Edit Hospital Service Items</a>
                <p>&nbsp;</td>
              <td width="50%"><a href="edit_hospital_services.php<?php echo URL_APPEND ?>&service=LT">Edit Laboratory Test Items</a>
                <p>&nbsp;</td>
            </tr>
            <tr>
              <td width="50%"><a href="search.php<?php echo URL_APPEND ?>">Search For a Patient</a>
                <p>&nbsp;</td>
              <td width="50%"></td>
            </tr>
          </table>
        </td>
        <td width="287" height="155" valign="top" bordercolor="#FFFFFF">
        </td>
      </tr>
      <tr><td colspan="2" height="1" width="641" bordercolor="#FFFFFF">
        </td></tr>
<!--      
       <tr>
        <td height="105" width="479" bordercolor="#FFFFFF">
        </td>
      </tr>
 -->        
      <tr><td height="47" width="414" bordercolor="#FFFFFF">
        </td></tr>
    
    </table>
  <p>&nbsp;</p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDCloseBack2Main ?>" align="middle"></a>
    </center>
  </div>
</form>
  <p>&nbsp;</p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</body>
</html>

