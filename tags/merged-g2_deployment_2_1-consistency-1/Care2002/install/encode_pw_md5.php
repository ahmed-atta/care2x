<?php
# All passwords of Care2x installations before version 1.0.09 are not encrypted.
#
# IMPORTANT! run this script only for versions 1.0.08, 1.0.07, 1.0.06, 1.0.05, 1.0.04
#
# This is a script to encrypt your existing user's password which are not yet md5 encrypted
# Requirements:
# - Your care2x installation is running properly
# - Your database is intact
# - Your user's table is intact and the passwords are stored in plain (unencrypted) text
# - You have a valid admin access
#
# How to do the conversion
# 1)  copy this script into the /install/ directory of care2x
# 2) type /install/encode_pw_md5.php in your browser
# 3) enter your admin username and password
# 4) press proceed button
# 5) after the conversion, DELETE THIS FILE from the /install directory
#
# If you do not delete this file after conversion, care2x will refuse to run. Also, there is a
# danger that another person could ruin your users' access data by running this script the second time

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
$root_path='../';
$sid='1'; # Dummy sid 
require($root_path.'include/inc_environment_global.php');
//$lang_tables[]='intramail.php';
$lang_tables[]='create_admin.php';
define('LANG_FILE','edp.php');
define('NO_CHAIN',1);
require_once('../include/inc_front_chain_lang.php');

if(isset($HTTP_POST_VARS['mode'])&&($HTTP_POST_VARS['mode']=='convert')
	&&isset($HTTP_POST_VARS['username'])&&($HTTP_POST_VARS['username']!='')
	&&isset($HTTP_POST_VARS['pw1'])&&($HTTP_POST_VARS['pw1']!='')){
	
	$error_msg='';
	$users_ok=false;
	$admin_ok=false;
	
	# Check if user is admin
	
	$sql0="SELECT password FROM care_users WHERE login_id='".$HTTP_POST_VARS['username']."' AND permission='System_Admin'";
	
		$db->BeginTrans();
        $ok=$db->Execute($sql0);
        if($ok) {
            $db->CommitTrans();
			$row=$ok->FetchRow();
			if($row['password']==$HTTP_POST_VARS['pw1']){
				$admin_ok=true;
			}else{
				$error_msg='Wrong password!';
			}
        } else {
	        $db->RollbackTrans();
			$error_msg='Could not get the admin data from the database. Username could be wrong.';
			//echo $sql;
	    }
	
	# Fetch the users from the db
	if($admin_ok){
		$sql="SELECT name,login_id,password,create_time FROM care_users";
	
		$db->BeginTrans();
        $ok=$db->Execute($sql);
        if($ok) {
            $db->CommitTrans();
			$users_ok=true;
        } else {
	        $db->RollbackTrans();
			$error_msg='Could not get the users from the database';
			//echo $sql;
	    }
		
		if($users_ok){
			#Start updating with md5 encrypted passwords
			while($row=$ok->FetchRow()){
				$sql2="UPDATE care_users SET password='".md5($row['password'])."' 
				WHERE name='".$row['name']."' AND login_id='".$row['login_id']."' AND create_time='".$row['create_time']."'";
				
				$db->BeginTrans();
       		 	$v=$db->Execute($sql2);
        		if($v) {
           			 $db->CommitTrans();
					echo "Encrypted pw, user: ".$row['name']."<br>";
       			 } else {
	       			 $db->RollbackTrans();
					echo "Could not encrypt pw, user: ".$row['name']."<br>";
				//echo $sql;
	   			 }
			}
			$error_msg='OK';
		}
	}

}else{
	$error_msg='newcreate';
}

?>
<html>
<head>
<title>Encrypting users' passwords with MD5</title>
<script language="javascript">
<!-- Script Begin
function chkForm(d) {
	if(d.username.value==""||d.pw1.value=="") return false
		else return true;

}
//  Script End -->
</script>


</head>
<body>
<?php
if($error_msg=='newcreate'){
?>
<table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td align=center><font size=5 color=#800000 face="verdana,arial,helvetica">Encrypting users' passwords with MD5</font></td>
   </tr>
 </table>
 
	</td>
  </tr>
</table>
<p>
<div align="center">
<font size=4 color=#ff0000 face="verdana,arial,helvetica">This will encrypt all users' password stored in the database with MD5. <br>You have to be a
system administrator to be able to do this. <br>Do you want to proceed?</font>
</div>
<p>
<table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td align=center><font face="verdana,arial,helvetica">&nbsp;
	 <p>
<form  method=post  onSubmit="return chkForm(this)" >
<?php echo $LDUserId ?><br>
<input type="text" name="username" size=40 maxlength=35><br>
<?php echo $LDPassword ?><br>
<input type="password" name="pw1" size=40 maxlength=255><br>&nbsp;<p>
<input type="submit" value="Yes, proceed">
<input type="hidden" name="mode" value="convert">
</form>	 
<form  action="../blank.htm">
<input type="submit" value="NO, cancel">
</form>	 
	</font> 
	</td>
   </tr>
 </table>
 
	</td>
  </tr>
</table>

<?php
}else{
?>
	 <table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td align=center><font size=6 color=#ff0000 face="verdana,arial,helvetica"><b><?php echo $error_msg ?></b></font></td>
   </tr>
 </table>
 
	</td>
  </tr>
</table>
<font size=4 >&nbsp;</font>
<?php
	if(stristr($error_msg,'OK')){
?>
	 <table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td align=center><font size=5 color=#000000 face="verdana,arial,helvetica">
	 The encryption of passwords is finished. Please remove this /install/encode_pw_md5.php script NOW. 
	 Otherwise, another person could make your users' access data useless by running this script anew.
	 </font><p>
	 <form action="../blank.htm" method="post">
	<input type="submit" value="OK">
	</form>
	 
	 </td>
   </tr>
 </table>
 
	</td>
  </tr>
</table>

<?php
	}
}
?>
</body>
</html>
