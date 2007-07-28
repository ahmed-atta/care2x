<?php

//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();

# Deal with op and add some basic sanity checking

$op = !empty( $_POST['op'] ) ? addslashes( $_POST['op'] ) : NULL;


#insert category

if (  $op === 'insert_category' ) {

$sql = "INSERT into
		{$tb_prefix}category(id,name,notes,enabled)
	VALUES
		(	
			'',
			'$_POST[name]',
			'$_POST[notes]',
			'$_POST[enabled]'			
		)";

if (mysqlQuery($sql, $conn)) {
	$display_block = $LANG['save_category_success'];
} else {
	$display_block = $LANG['save_category_failure'];
}

	//header( 'refresh: 2; url=manage_products.php' );
	$refresh_total = "<META HTTP-EQUIV=REFRESH CONTENT=1;URL=index.php?module=category&view=manage>";
}



#edit category

else if (  $op === 'edit_category' ) {

$conn = mysql_connect("$db_host","$db_user","$db_password");
mysql_select_db("$db_name",$conn);

	if (isset($_POST['save_category'])) {
		$sql = "UPDATE
				{$tb_prefix}category
			SET
				name = '$_POST[name]',
				enabled = '$_POST[enabled]',
				notes = '$_POST[notes]'							
			WHERE
				id = '$_GET[submit]'";

		if (mysqlQuery($sql, $conn)) {
			$display_block = $LANG['save_category_success'];
		} else {
			$display_block = $LANG['save_category_failure'];
		}

		//header( 'refresh: 2; url=manage_products.php' );
		$refresh_total = "<META HTTP-EQUIV=REFRESH CONTENT=0;URL=index.php?module=category&view=manage>";


		}

	else if (isset($_POST['cancel'])) {
	
		//header( 'refresh: 0; url=manage_products.php' );
		$refresh_total = "<META HTTP-EQUIV=REFRESH CONTENT=0;URL=index.php?module=category&view=manage>";
	}
}


$refresh_total = isset($refresh_total) ? $refresh_total : '&nbsp';

$smarty -> assign('display_block',$display_block); 
$smarty -> assign('refresh_total',$refresh_total); 

?>
