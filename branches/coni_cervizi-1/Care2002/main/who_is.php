<?php


if($HTTP_SESSION_VARS['cambio']==$HTTP_SESSION_VARS['sess_login_username']) echo "cavolo".$HTTP_SESSION_VARS['sess_login_username'];
else
{
	echo "cambio";
	$HTTP_SESSION_VARS['cambio']=$HTTP_SESSION_VARS['sess_login_username'];
	
/*	echo "sess".$HTTP_SESSION_VARS['sess_user_name']);
	*/



?>
<script language="javascript">
<!--
javascript:left.location.reload();
-->
</script>
<?
}

?>