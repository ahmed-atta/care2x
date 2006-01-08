<?php
/**
* Care2x beta 2.0.1 auto-installer
* copyright 2004-2005 Elpidio Latorilla elpidio@care2x.org
*/
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
$root_path='../';

$notable=1;

#
# Set the comment chars and dump file id
#
if($HTTP_POST_VARS['dbtype']=='mysql'){
	$comment = '#';
	$dbid = 'my';
}elseif($HTTP_POST_VARS['dbtype']=='postgres7'){
	$comment = '--';
	$dbid='pg';
}

#
# Set here the installer sql script
# This line should be after the setting of comment chars and dump file id $dbid
#
$sql_dump_file ="care_db_structure_b201_auto_$dbid.sql";

#define('QUERY_MSG_SHOW', FALSE);
define('QUERY_MSG_SHOW', TRUE);

# Function to parse the sql file and execute the query
function runSqlQuery($file) {
    global $link, $comment,$HTTP_POST_VARS, $conn;

    //if (QUERY_MSG_SHOW) echo $file.'<br>';

    if ($fp = fopen($file,'r')) {

        $sql = '';
        while (!feof($fp)) { 
            $str = fgets($fp,8192);
            $str = chop($str);
            if (eregi(';',$str)) {
                $sql .= (str_replace(';','',$str));
                
                $qresult = $conn->Execute($sql);
			
                if ($qresult) {
                   // if (QUERY_MSG_SHOW) echo 'ok '.$sql.'<p>';
                } elseif (QUERY_MSG_SHOW){
                    echo 'SQL query failed:<br> '.$sql.'<br>Reason: '.$conn->ErrorMsg().'<p>';
	    		}
                $sql = '';
            } elseif (eregi($comment,$str)){
                $sql = '';
	    	} elseif ($str != '') {
                $sql .= $str;
            }
        } 
        $result='done_tables';
        fclose($fp);
    } else {
        $result='no_sqlfile_found';
    }
    return $result;
}

# Function to rename the critical files
function renameFile($filename,$ext){
	$ok=false;
	if(file_exists($filename.$ext)){
		if(!is_writeable($filename.$ext)){
			if(!chmod($filename.$ext,0777)) echo "Could not set /create_admin.php for renaming.. Please rename or delete the file manually.<p>";
			else {
				$ok=true;
			}
		}else{
			$ok=true;
		}
		if($ok){
			$init=$filename.'_'.rand(1,$rmax).$ext;
			rename($filename.$ext,$init);
			chmod($init,0644);
		}
	}
}

# Start here
if(isset($HTTP_POST_VARS['mode'])&&($HTTP_POST_VARS['mode']=='save')){
	$error_msg='';
	# Clean values
	$HTTP_POST_VARS['dbname']=trim($HTTP_POST_VARS['dbname']);
	$HTTP_POST_VARS['admin_user']=trim($HTTP_POST_VARS['admin_user']);
	$HTTP_POST_VARS['admin_pw']=trim($HTTP_POST_VARS['admin_pw']);
	# Clean values
/*	$HTTP_POST_VARS['dbusername']=trim($HTTP_POST_VARS['dbusername']);
	$HTTP_POST_VARS['dbhost']=trim($HTTP_POST_VARS['dbhost']);
	$HTTP_POST_VARS['dbpassword']=trim($HTTP_POST_VARS['dbpassword']);
*/
	$HTTP_POST_VARS['mainhost']=trim($HTTP_POST_VARS['mainhost']);
	
	# Debugged by Bededikt Wismans
	$dbusername=trim($HTTP_POST_VARS['dbusername']);
	$dbhost=trim($HTTP_POST_VARS['dbhost']);
	$dbpassword=trim($HTTP_POST_VARS['dbpassword']);
	
	# If db values empty, use default values
	if(empty($HTTP_POST_VARS['dbusername'])) $HTTP_POST_VARS['dbusername']='root';
	if(empty($HTTP_POST_VARS['dbhost'])) 	$HTTP_POST_VARS['dbhost']='';
	if(empty($HTTP_POST_VARS['dbpassword'])) 	$HTTP_POST_VARS['dbpassword']=''; 
	if(empty($HTTP_POST_VARS['mainhost'])) 	$HTTP_POST_VARS['mainhost']='localhost'; 
	
	if(empty($HTTP_POST_VARS['dbname'])){
		$error_msg='Database name is missing!!!  Please enter the correct database name.';
		$mode='new';
	}elseif(empty($HTTP_POST_VARS['admin_user'])){
		$error_msg='System admin user name is missing!!! Please enter the  name.';
		$mode='new';
	}elseif(empty($HTTP_POST_VARS['admin_pw'])){
		$error_msg='System admin password is missing!!! Please enter the  password.';
		$mode='new';
	}elseif(empty($HTTP_POST_VARS['dbtype'])){
		$error_msg='You did not specify the database type!!! Please select a database type.';
		$mode='new';
	}else{
		# Start creating the database
		echo 'Connecting to the database server...<br>';
	
		# This is needed to turn fatal errors to warnings when connecting.
		# We use Connect for database checks, so this is really needed.
		define('ADODB_ERROR_HANDLER_TYPE', E_USER_WARNING); 

		# include ADOdb class files:
		require_once('../classes/adodb/adodb-errorhandler.inc.php'); 
		require_once('../classes/adodb/adodb.inc.php');
		
		# create connection object:
		$conn = ADONewConnection($HTTP_POST_VARS['dbtype']); 
		$conn->debug = FALSE;
		
		# first try to connect to the exact database on server
		$ok = $conn->Connect($HTTP_POST_VARS['dbhost'],
      		             $HTTP_POST_VARS['dbusername'],
      		             $HTTP_POST_VARS['dbpassword'],
      		             $HTTP_POST_VARS['dbname']);
      		             
		# if failed to connect to database then create it:
		if (!$ok)
		{
		    # failed db connection has to be constructed from start:
		    $conn = ADONewConnection($HTTP_POST_VARS['dbtype']); 
		    $conn->debug = FALSE;
    
		    # try connecting without database parameter:
		    $ok = $conn->Connect($HTTP_POST_VARS['dbhost'],
      		                 $HTTP_POST_VARS['dbusername'],
      		                 $HTTP_POST_VARS['dbpassword']);
    
		    if ($ok) # if connected without database param:
		    {
                # get SQL to create database:
		        $dict = NewDataDictionary($conn);
		        $sql = $dict->CreateDatabase($HTTP_POST_VARS['dbname']);

		        # try creating database:
		        # "2" is status returned by ExecuteSQLArray()
		        $ok = (2 == $dict->ExecuteSQLArray($sql));
		        if ($ok)
		        {
                    # try to connect after creating:
                    $ok = $conn->Connect($HTTP_POST_VARS['dbhost'],
                    $HTTP_POST_VARS['dbusername'],
                    $HTTP_POST_VARS['dbpassword'],
                    $HTTP_POST_VARS['dbname']);
		        }
		    }
		}

		# Check status:
		if ($ok) {
            # Proceed to create the db schema
            echo "Creating the database structure... /".$HTTP_POST_VARS['dbtype']."/auto/care_db_structure_d21_auto_$dbid.sql<br>";
            $res = @runSqlQuery("./".$HTTP_POST_VARS['dbtype']."/auto/care_db_structure_d21_auto_$dbid.sql");

				# Extra insert config user preload data
				
				$sql='INSERT INTO care_config_user (user_id,serial_config_data,notes, status, history, modify_id, modify_time, create_id, create_time) VALUES (\'default\', \'a:19:{s:4:"mask";s:1:"1";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:0:"";s:8:"bversion";s:0:"";s:2:"ip";s:0:"";s:3:"cid";s:0:"";s:5:"dhtml";s:1:"1";s:4:"lang";s:0:"";}\',  \'default values\',  \'normal\',  \'installed '.date('Y-m.d H:i:s').'\', \'auto-installer\', 0, \'auto-installer\', 0)';
				/*
				if($HTTP_POST_VARS['dbtype']=='mysql'){
					$qresult= @ mysql_query($sql,$link);
				}elseif($HTTP_POST_VARS['dbtype']=='postgres7'){
					$qresult= @ pg_query($link,$sql);
				}
				*/
				$qresult=$conn->Execute($sql);
				if( $qresult) {
			  		// if (QUERY_MSG_SHOW) echo 'ok '.$sql.'<p>';
				}elseif(QUERY_MSG_SHOW){
			  		echo 'SQL query (insert of default user config values) failed:<br> '.$sql.'<p>';
				}
				# Insert the admin user
				$sql='INSERT INTO care_users (name,login_id,password,permission,exc,s_date,s_time,modify_id,modify_time,create_id,create_time) VALUES (\'admin\', \''.$HTTP_POST_VARS['admin_user'].'\',\''.md5($HTTP_POST_VARS['admin_pw']).'\',\'System_Admin\',1,\''.date('Y-m-d').'\',\''.date('H:i:s').'\',\'auto-installer\',00000000000000, \'auto-installer\', 00000000000000)';
		    	/*
				if($HTTP_POST_VARS['dbtype']=='mysql'){
					$qresult= @ mysql_query($sql,$link);
				}elseif($HTTP_POST_VARS['dbtype']=='postgres7'){
					$qresult= @ pg_query($link,$sql);
				}
				*/
				$qresult=$conn->Execute($sql);
				if($qresult) {
			  		// if (QUERY_MSG_SHOW) echo 'ok '.$sql.'<p>';
				}elseif(QUERY_MSG_SHOW){
			  		echo 'SQL query (insert of admin permission) failed:<br> '.$sql.'<p>';
				}
				# Start SQL  loading of data
				if($HTTP_POST_VARS['icd10_en']){
					echo 'Loading ICD10 English codes...<br>';
					@runSqlQuery('./sql/icd10_en/insert-data-a2l.sql');
					@runSqlQuery('./sql/icd10_en/insert-data-m2y.sql');
				}
				if($HTTP_POST_VARS['icd10_de']){
					echo 'Loading ICD10 German codes...<br>';
					@runSqlQuery('./sql/icd10_de/a2g-insert.sql');
					@runSqlQuery('./sql/icd10_de/h2n-insert.sql');
					@runSqlQuery('./sql/icd10_de/o2s-insert.sql');
					@runSqlQuery('./sql/icd10_de/t2z-insert.sql');
				}
				if($HTTP_POST_VARS['icd10_br']){
					echo 'Loading ICD10 Brazilian codes...<br>';
					@runSqlQuery('./sql/icd10_br/insert-data-a2l.sql');
					@runSqlQuery('./sql/icd10_br/insert-data-m2z.sql');
				}
				if($HTTP_POST_VARS['icd10_es']){
					echo 'Loading ICD10 Spanish codes...<br>';
					@runSqlQuery('./sql/icd10_es/insert-data-a2o.sql');
					@runSqlQuery('./sql/icd10_es/insert-data-p2z.sql');
				}
				if($HTTP_POST_VARS['icd10_bs']){
					echo 'Loading ICD10 Bosnian/Latin codes...<br>';
					@runSqlQuery('./sql/icd10_bs/insert-data-a2l.sql');
					@runSqlQuery('./sql/icd10_bs/insert-data-m2y.sql');
				}
				if($HTTP_POST_VARS['icd10_bg']){
					echo 'Loading ICD10 Bulgarian codes...<br>';
					@runSqlQuery('./sql/icd10_bg/insert-data-a2m.sql');
					@runSqlQuery('./sql/icd10_bg/insert-data-n2z.sql');
				}
				if($HTTP_POST_VARS['icd10_tr']){
					echo 'Loading ICD10 Turkish codes...<br>';
					@runSqlQuery('./sql/icd10_tr/insert-data.sql');
				}
				if($HTTP_POST_VARS['ops_de']){
					echo 'Loading OPS301 German codes...<br>';
					@runSqlQuery('./sql/ops301_de/insert-data-1-5-499.sql');
					@runSqlQuery('./sql/ops301_de/insert-data-55-57.sql');
					@runSqlQuery('./sql/ops301_de/insert-data-58-94.sql');
				}
				if($HTTP_POST_VARS['ops_es']){
					echo 'Loading OPS301 Spanish codes...<br>';
					@runSqlQuery('./sql/ops301_es/insert-data-1.sql');
				}
		} else {
			$mode='new';
			$error_msg='Database error: '.$conn->ErrorMsg().'<p>';
		}
		
	
		if($ok){

		# seed the random generator
		srand ((double) microtime() * 1000000);
		$rmax=getrandmax();

		
		if(empty($HTTP_POST_VARS['key'])) $HTTP_POST_VARS['key']=(rand(1,$rmax).rand(1,$rmax))*rand(1,$rmax); 
		if(empty($HTTP_POST_VARS['key_2level'])) 	$HTTP_POST_VARS['key_2level']=(rand(1,$rmax).rand(1,$rmax))*rand(1,$rmax); 
		if(empty($HTTP_POST_VARS['key_login'])) 	$HTTP_POST_VARS['key_login']=(rand(1,$rmax).rand(1,$rmax))*rand(1,$rmax); 
		
		# Let us set permissions of several folders and files
		echo 'Setting file permissions...<br>';
		if(!is_writeable('../cache')){
			if(!chmod('../cache',0777)) echo "Could not set /cache directory for writing. Please set it manually otherwise Care2x cannot create cache data.<p>";
		}
		if(!is_writeable('../cache/barcodes')){
			if(!chmod('../cache/barcodes',0777)) echo "Could not set /cache/barcodes directory for writing. Please set it manually otherwise Care2x cannot cache barcode images.<p>";
		}
		if(!is_writeable('../counter')){
			if(!chmod('../counter',0777)) echo "Could not set /counter directory for writing. Please set it manually otherwise Care2x cannot  write hits counts.<p>";
		}
		if(!is_writeable('../counter/hitcount.txt')){
			if(!chmod('../counter/hitcount.txt',0777)) echo "Could not set /counter/hitcount.txt file for writing. Please set it manually otherwise Care2x cannot write hits counts.<p>";
		}
		if(!is_writeable('../fotos')){
			if(!chmod('../fotos',0777)) echo "Could not set /fotos directory for writing. Please set it manually otherwise you cannot upload patient's images.<p>";
		}
		if(!is_writeable('../fotos/encounter')){
			if(!chmod('../fotos/encounter',0777)) echo "Could not set  /fotos/encounter directory for writing. Please set it manually otherwise you cannot upload encounters' images.<p>";
		}
		if(!is_writeable('../fotos/registration')){
			if(!chmod('../fotos/registration',0777)) echo "Could not set  /fotos/registration directory for writing. Please set it manually otherwise you cannot upload encounters' images.<p>";
		}
		if(!is_writeable('../fotos/news')){
			if(!chmod('../fotos/news',0777)) echo "Could not set  /fotos/news directory for writing. Please set it manually otherwise you cannot upload news' images.<p>";
		}
		if(!is_writeable('../logs')){
			if(!chmod('../logs',0777)) echo "Could not set  /logs directory for writing. Please set it manually otherwise Care2x cannot log data.<p>";
		}
		if(!is_writeable('../logs/access')){
			if(!chmod('../logs/access',0777)) echo "Could not set  /logs/access directory for writing. Please set it manually otherwise Care2x cannot log access data.<p>";
		}
		if(!is_writeable('../logs/access/'.date('Y'))){
			if(!chmod('../logs/access/'.date('Y'),0777)) echo "Could not set  /logs/access/".date('Y')." directory for writing. Please set it manually otherwise Care2x cannot log this year's access data.<p>";
		}
		if(!is_writeable('../logs/access_fail')){
			if(!chmod('../logs/access_fail',0777)) echo "Could not set  /logs/access_fail directory for writing. Please set it manually otherwise Care2x cannot log failed access data.<p>";
		}
		if(!is_writeable('../logs/access_fail/'.date('Y'))){
			if(!chmod('../logs/access_fail/'.date('Y'),0777)) echo "Could not set  /logs/access_fail/".date('Y')." directory for writing. Please set it manually otherwise Care2x cannot log this year's failed access data.<p>";
		}
		if(!is_writeable('../pharma')){
			if(!chmod('../pharma',0777)) echo "Could not set /pharma directory for writing. Please set it manually otherwise Care2x cannot store uploaded pharma data.<p>";
		}
		if(!is_writeable('../pharma/img')){
			if(!chmod('../pharma/img',0777)) echo "Could not set /pharma/img directory for writing. Please set it manually otherwise Care2x cannot store uploaded pharma images.<p>";
		}
		if(!is_writeable('../med_depot')){
			if(!chmod('../med_depot',0777)) echo "Could not set /med_depot directory for writing. Please set it manually otherwise Care2x cannot store uploaded med_depot data.<p>";
		}
		if(!is_writeable('../med_depot/img')){
			if(!chmod('../med_depot/img',0777)) echo "Could not set /med_depot/img directory for writing. Please set it manually otherwise Care2x cannot store uploaded med_depot images.<p>";
		}
		if(!is_writeable('../radiology')){
			if(!chmod('../radiology',0777)) echo "Could not set /radiology directory for writing. Please set it manually otherwise Care2x cannot create cache data.<p>";
		}
		if(!is_writeable('../radiology/dicom_img')){
			if(!chmod('../radiology/dicom_img',0777)) echo "Could not set /radiology/dicom_img directory for writing. Please set it manually otherwise Care2x cannot cache barcode images.<p>";
		}
		if(!is_writeable('../gui')){
			if(!chmod('../gui',0777)) echo "Could not set /gui directory for writing. Please set it manually otherwise Care2x cannot store department logos.<p>";
		}
		if(!is_writeable('../gui/img')){
			if(!chmod('../gui/img',0777)) echo "Could not set /gui/img directory for writing. Please set it manually otherwise Care2x cannot store department logos.<p>";
		}
		if(!is_writeable('../gui/img/logos_dept')){
			if(!chmod('../gui/img/logos_dept',0777)) echo "Could not set /gui/img/logos_dept directory for writing. Please set it manually otherwise Care2x cannot store department logos.<p>";
		}
		# Try to chmod the template cache dir
		if(!is_writeable('../gui/smarty_template/templates_c')){
			if(!chmod('../gui/smarty_template/templates_c',0777)) echo "Could not set ../gui/smarty_template/templates_c directory for writing. Please set it manually otherwise Care2x will not run properly.<p>";
		}

		# Now save the db data, try to make directories writeable
		if(!is_writeable('../include')){
			if(!chmod('../include',0777)){
	  			$error_msg='Could not set  /include/ directory for writing. Please set it manually.';
			}else{$incok=true;}
		}else{$incok=true;}
		
		if(!is_writeable('../include/inc_init_main.php')){
			if(!chmod('../include/inc_init_main.php',0777)){
	   			$error_msg='Could not set  /include/inc_init_main.php file for writing. Please set it manually';
			}else{$fnok=true;}
		}else{$fnok=true;}
		
		if($incok&&$fnok){
						# Now write the file
						$fname=$root_path.'include/inc_init_main.php';
						
						echo 'Saving configuration data...<br>';

    					if($fp=fopen($fname,'w+')) {
       						fputs($fp,"<?php\n");
       						fputs($fp,"# This is the database name\n");
       						fputs($fp,"\$dbname='".$HTTP_POST_VARS['dbname']."';\n\n");
       						fputs($fp,"# Database user name, default is root or httpd for mysql, or postgres for postgresql\n");
       						fputs($fp,"\$dbusername='".$HTTP_POST_VARS['dbusername']."';\n\n");
       						fputs($fp,"# Database user password, default is empty char\n");
       						fputs($fp,"\$dbpassword='".$HTTP_POST_VARS['dbpassword']."';\n\n");
       						fputs($fp,"# Database host name, default = localhost\n");
       						fputs($fp,"\$dbhost='".$HTTP_POST_VARS['dbhost']."';\n\n");
       						fputs($fp,"# First key used for simple chaining protection of scripts\n");
       						fputs($fp,"\$key='".$HTTP_POST_VARS['key']."';\n\n");
       						fputs($fp,"# Second key used for accessing modules\n");
       						fputs($fp,"\$key_2level='".$HTTP_POST_VARS['key_2level']."';\n\n");
       						fputs($fp,"# 3rd key for encrypting cookie information\n");
       						fputs($fp,"\$key_login='".$HTTP_POST_VARS['key_login']."';\n\n");
       						fputs($fp,"# Main host address or domain\n");
       						fputs($fp,"\$main_domain='".$HTTP_POST_VARS['mainhost']."';\n\n");
       						fputs($fp,"# Host address for images\n");
       						fputs($fp,"\$fotoserver_ip='".$HTTP_POST_VARS['mainhost']."';\n\n");
       						fputs($fp,"# Transfer protocol. Use https if this runs on SSL server\n");
       						fputs($fp,"\$httprotocol='".$HTTP_POST_VARS['prot']."';\n\n");
       						fputs($fp,"# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/\n");
       						fputs($fp,"\$dbtype='".$HTTP_POST_VARS['dbtype']."';\n");
       						fputs($fp,"?>");
        					fclose($fp);
							$error_msg='OK';
							$mode='no_create';
						}else{
							$error_msg='Could not write the data to file /include/inc_init_main.php. Please check the directory & file permissions.';
							$showTextBox = TRUE;
    					}
						# Restrict the file permission
						chmod('../include/inc_init_main.php',0755);
						
						# Rename the critical files
						echo 'Renaming critical files with random numbers...<br>';
						$ok=false;
						if(file_exists('install.php')){
    						if(!is_writeable('install.php')){
    							if(!chmod('install.php',0777)) echo "Could not set /install/install.php for renaming.. Please rename or delete the file manually.<p>";
    								else {
    									$ok=true;
    								}
    						}else{
    							$ok=true;
    						}
    						if($ok){
    							$insfile='install_'.rand(1,$rmax).'.php';
    							rename('install.php',$insfile);
    									chmod($insfile,0644);
    						}
						}
						$ok=false;
						if(file_exists('encode_pw_md5.php')){
							if(!is_writeable('encode_pw_md5.php')){
    							if(!chmod('encode_pw_md5.php',0777)) echo "Could not set /install/encode_pw_md5.php for renaming.. Please rename or delete the file manually.<p>";
    								else {
    								$ok=true;
    							}
    						}else{
    							$ok=true;
    						}
    						if($ok){
    							$pwfile='encode_pw_md5_'.rand(1,$rmax).'.php';
    							rename('encode_pw_md5.php',$pwfile);
    									chmod($pwfile,0644);
    						}
						}
						$ok=false;
						if(file_exists('../create_admin.php')){
    						if(!is_writeable('../create_admin.php')){
    							if(!chmod('../create_admin.php',0777)) echo "Could not set /create_admin.php for renaming.. Please rename or delete the file manually.<p>";
    								else {
    								$ok=true;
    								}
    						}else{
    							$ok=true;
    						}
    						if($ok){
    									$adm='create_admin_'.rand(1,$rmax).'.php';
    									rename('../create_admin.php','../'.$adm);
    									chmod($adm,0644);
    						}
						}
						$ok=false;
						if(file_exists('initialize.php')){
							if(!is_writeable('initialize.php')){
								if(!chmod('initialize.php',0777)) echo "Could not set /create_admin.php for renaming.. Please rename or delete the file manually.<p>";
									else {
									$ok=true;
									}
							}else{
								$ok=true;
							}
							if($ok){
									$init='initialize_'.rand(1,$rmax).'.php';
									rename('initialize.php',$init);
									chmod($init,0644);
							}
						}
			}else{
				$error_msg='Could not write the data to file /include/inc_init_main.php. Please check the directory & file permissions.';
				$showTextBox = TRUE;
    		}
		}else{
			$mode='new';
		}
			
    }
	
}else{
	$mode='new';
}

?>
<html>
<head>
<title></title>

<script language="">
<!-- Script Begin
function chkForm(d) {
	if(d.dbname.value=="") return false
		else return true;

}
//  Script End -->
</script>
</head>
<body>
<font color=#ff0000 size=4><b>
<?php
if($mode==''||$mode=='new'){
	if($error_msg) echo $error_msg;
?></b>
</font>
<table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td><font size=5 color=#800000 face="verdana,arial,helvetica">Setting the primary installation values</font><br>
	 <font size=3 color=#ff0000 face="verdana,arial,helvetica">NOTE: If you install in PostgreSQL, make sure that the php's postgresql module is active before proceeding!<br>
	 Installing ICD/OPS codes in PostgreSQL takes much longer than in mySQL, so please be patient until it is finished.</font>
</td>
   </tr>
 </table>
 
	</td>
  </tr>
</table>

<font size=4 color=#000000 face="verdana,arial,helvetica">Please enter the information</font>

<table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td><font face="verdana,arial,helvetica">
<font size=2 color=maroon>
<form onSubmit="return chkForm(this)" method=post>
Database type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="dbtype" value="mysql" <?php if($HTTP_POST_VARS['dbtype']=='mysql') echo 'checked';  ?>> mySQL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="dbtype" value="postgres7" <?php if($HTTP_POST_VARS['dbtype']=='postgres7') echo 'checked';  ?>> PostgreSQL<p>
<b><font color=#ff0000>* </font></b>Database name (If this database is existing, it will be used. If not, the installer will attempt to create it.)<br>
<input type="text" name="dbname" size=40 maxlength=60 value="<?php echo $HTTP_POST_VARS['dbname'] ?>"><br>
Database username (If left blank, the installer will use "root" as username.)<br>
<input type="text" name="dbusername" size=40 maxlength=35 value="<?php echo $HTTP_POST_VARS['dbusername'] ?>"><br>
Database password (If left blank, the installer will use empty string)<br>
<input type="text" name="dbpassword" size=40 maxlength=255 value="<?php echo $HTTP_POST_VARS['dbpassword'] ?>"><br>
Database host (If left blank, the installer will use empty string)<br>
<input type="text" name="dbhost" size=40 maxlength=35  value="<?php if (empty($HTTP_POST_VARS['dbhost'])) echo 'localhost'; else echo $HTTP_POST_VARS['dbhost']; ?>"><br>
1st Key (leave blank for random key)<br>
<input type="text" name="key" size=80 maxlength=255 ><br>
2nd Key (leave blank for random key)<br>
<input type="text" name="key_2level" size=80 maxlength=255 ><br>
3rd Key (leave blank for random key)<br>
<input type="text" name="key_login" size=80 maxlength=255 ><br>

<b><font color=#ff0000>* </font></b>System administrator user login name (Admin)<br>
<input type="text" name="admin_user" size=40 maxlength=35 value="<?php echo $HTTP_POST_VARS['admin_user'] ?>"><br>
<b><font color=#ff0000>* </font></b>System admin password<br>
<input type="text" name="admin_pw" size=40 maxlength=255  value="<?php echo $HTTP_POST_VARS['admin_pw'] ?>"><br>
<p>
<?php
if(!isset($HTTP_POST_VARS['prot'])||empty($HTTP_POST_VARS['prot'])) 	$HTTP_POST_VARS['prot']='http';
?>
Transfer protocol. Commonly "http". Select "https" only if you are installing this Care2x in an SSL server.<br><font color=#000000>
<input type="radio" name="prot" value="http" <?php if($HTTP_POST_VARS['prot']=='http') echo 'checked';  ?>> http<br>
<input type="radio" name="prot" value="https" <?php if($HTTP_POST_VARS['prot']=='https') echo 'checked';  ?>> https<br></font>
<br>
Domain or host address where this Care2x is installed. Without the "http://" and without a trailing slash (/). If your web server is using a non-default port number (default is 80),
add this port number separated by colon (:) for example www.carehospital.org:9090.  If you leave this blank, "localhost" will be used and port 80 will be assumed.
Note: If Care2x is stored in a subdirectory e.g http://www.care2x.net/hospital/ , include the subdirectory name e.g
<font color=#000080>www.care2x.net/hospital</font> or in case of non-default port number (e.g. 9090)  <font color=#000080>www.care2x.net:9090/hospital</font>.<br>
<input type="text" name="mainhost" size=40 maxlength=35 value="<?php if (empty($HTTP_POST_VARS['mainhost'])) echo 'localhost'; else echo $HTTP_POST_VARS['mainhost']; ?>">
<p>
 Select  the following diseases/procedures code data for loading: <br>(Note: These data are high volume and may take some time to finish loading, select only the language that
 you are going to use!)<br><font color=#000000>
	<input type="checkbox" name="icd10_en" value="1" <?php if($HTTP_POST_VARS['icd10_en']=='1') echo 'checked';  ?>> ICD10 (English language)<br>
	<input type="checkbox" name="icd10_de" value="1" <?php if($HTTP_POST_VARS['icd10_de']=='1') echo 'checked';  ?>> ICD10 (German language)<br>
	<input type="checkbox" name="icd10_br" value="1" <?php if($HTTP_POST_VARS['icd10_br']=='1') echo 'checked';  ?>> ICD10 (Brazilian language)<br>
	<input type="checkbox" name="icd10_es" value="1" <?php if($HTTP_POST_VARS['icd10_es']=='1') echo 'checked';  ?>> ICD10 (Spanish language)<br>
	<input type="checkbox" name="icd10_bs" value="1" <?php if($HTTP_POST_VARS['icd10_bs']=='1') echo 'checked';  ?>> ICD10 (Bosnian/Latin language)<br>
	<input type="checkbox" name="icd10_bg" value="1" <?php if($HTTP_POST_VARS['icd10_bg']=='1') echo 'checked';  ?>> ICD10 (Bulgarian language)<br>
	<input type="checkbox" name="icd10_tr" value="1" <?php if($HTTP_POST_VARS['icd10_tr']=='1') echo 'checked';  ?>> ICD10 (Turkish language)<br>
	<input type="checkbox" name="ops_de" value="1" <?php if($HTTP_POST_VARS['ops_de']=='1') echo 'checked';  ?>> OPS301 (German language)<br>
	<input type="checkbox" name="ops_es" value="1" <?php if($HTTP_POST_VARS['ops_es']=='1') echo 'checked';  ?>> OPS301 (Spanish language)<br></font>
	<p>
<input type="submit" value="Install Care2x">
<input type="hidden" name="mode" value="save">
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

<?php

if($showTextBox){

	echo '<div align="center"> <font color="black">AND Copy and paste this text from the textbox and save it as 
	"<font color="red">inc_init_main.php</font>" and upload it to the "/include/" subdirectory of Care2x server</font>
	<form>
	<textarea cols="80" rows="20">';

	echo ("<?php\n");
	echo ("/* This is the database name*/\n");
	echo ("\$dbname='".$HTTP_POST_VARS['dbname']."';\n\n");
	echo ("/* Database user name, default is root or httpd for mysql, or postgres for postgresql*/\n");
	echo ("\$dbusername='".$HTTP_POST_VARS['dbusername']."';\n\n");
	echo ("/* Database user password, default is empty char*/\n");
	echo ("\$dbpassword='".$HTTP_POST_VARS['dbpassword']."';\n\n");
	echo ("/* Database host name, default = localhost*/\n");
	echo ("\$dbhost='".$HTTP_POST_VARS['dbhost']."';\n\n");
	echo ("/* First key used for simple chaining protection of scripts*/\n");
	echo ("\$key='".$HTTP_POST_VARS['key']."';\n\n");
	echo ("/* Second key used for accessing modules*/\n");
	echo ("\$key_2level='".$HTTP_POST_VARS['key_2level']."';\n\n");
	echo ("/* 3rd key for encrypting cookie information*/\n");
	echo ("\$key_login='".$HTTP_POST_VARS['key_login']."';\n\n");
	echo ("/* Main host address or domain*/\n");
	echo ("\$main_domain='".$HTTP_POST_VARS['mainhost']."';\n\n");
	echo ("/* Host address for images*/\n");
	echo ("\$fotoserver_ip='".$HTTP_POST_VARS['mainhost']."';\n\n");
	echo ("/* Transfer protocol. Use https if this runs on SSL server*/\n");
	echo ("\$httprotocol='".$HTTP_POST_VARS['prot']."';\n\n");
	echo ("/* Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/*/\n");
	echo ("\$dbtype='".$HTTP_POST_VARS['dbtype']."';\n");
	echo ("?>");

	echo'
	</textarea>
	</form></div>';
}
?>

<font size=4 >&nbsp;</font>
<?php
	if($error_msg=='OK'){
?>
	<font color=#008000><div align="center">Installation successful.<p> Congratulations!<p>
	<font face="verdana, Arial" size=2 color=#000000>The following files were renamed as:<br>
	/install/install.php => /install/<?php echo $insfile ?><br>
	/install/encode_pw_md5.php => /install/<?php echo $pwfile ?><br>
	/install/initialize.php => /install/<?php echo $init ?><br>
	/create_admin.php => /<?php echo $adm ?><p></font>
	Please delete them or move them outside the server directory for security reasons.
	</div></font><p>
	 <table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td align=center><font size=5 color=#000000 face="verdana,arial,helvetica">Please click here to start Care2x</font><p>
	 <form action="../index.php" method="post">
	<input type="submit" value="Start Care2x">
	</form>
	 
	 </td>
   </tr>
 </table>
 
	</td>
  </tr>
</table>
<p><font color=#000000 face="verdana,arial,helvetica">
<!-- <div align="center">If you want to know how to load the ICD and ICPM codes (OPS), <a href="./howto/en_loading_dpcodes.htm" target="_blank">please click here</a>.<br>
<font face="Verdana, Arial" size=2>Or you can read it later at <a href="http://care2x.org/en_loading_dpcodes.htm" target="_blank">http://care2x.org/en_loading_dpcodes.htm</a></font>.</div>
<p>
<div align="center">If you want to launch the phpMyAdmin to start loading the ICD and ICPM (OPS) codes, <a href="../modules/phpmyadmin/index.php" target="_blank">please click here</a>.<br>
<font face="Verdana, Arial" size=2>Or you can launch it later via the System Admin module</font>.</div> -->
</font>
<?php
	}
}
?>


</body>
</html>
