<?php

define('QUERY_MSG_SHOW', 0);

function runSqlQuery($file)
{
   global $link;

 if(QUERY_MSG_SHOW) echo $file.'<br>';

 if($fp=fopen($file,'r'))
 {
   
   $sql='';
   
   while(!feof($fp))
   { 
	   
	   
       $str = fgets($fp,8192);
	  
	    $str=chop($str);
		
		    
	    if(eregi(';',$str))
		{
		    $sql.=(str_replace(';','',$str));
		   
			
		    if( @ mysql_query($sql,$link)) 
			{
			   if (QUERY_MSG_SHOW) echo 'ok '.$sql.'<br>';
			}
			elseif(QUERY_MSG_SHOW)  echo 'no create '.$sql.'<br>';
			  
			  
			  
           $sql = '';
		}
		elseif(eregi('#',$str))
		{
		   $sql='';

		}
		elseif($str !='')
		{
           $sql.=$str;
		 }

    } 
	 
	 $result='done_tables';
   
     fclose($fp);
  }
  else
  {
     $result='no_sqlfile_found';
  }
  
  return $result;
}


function createAll($dbname)
{

    global $link;
	
	if(mysql_create_db($dbname,$link))
	{	   
               
		 if(mysql_select_db($dbname,$link)) 
	    {	              

	     /* Run the db main tables structure batch queries*/
	    runSqlQuery('sql/care_db_structure_b1003.sql');
	 
		/* Run the addtional drg tables structure batch queries*/
		runSqlQuery('sql/care_db_drg_tables_b1003.sql');
		   
		/* Run the icd data batch inserts - english */
	     runSqlQuery('sql/icd10_en/insert-data-a2l.sql');
		 runSqlQuery('sql/icd10_en/insert-data-m2y.sql');

		/* Run the icd data batch inserts - german */
	     runSqlQuery('sql/icd10_de/a2g-insert.sql');
		 runSqlQuery('sql/icd10_de/h2n-insert.sql');
		 runSqlQuery('sql/icd10_de/o2s-insert.sql');
		 runSqlQuery('sql/icd10_de/t2z-insert.sql');
 
		/* Run the ops data batch inserts - german */
		 runSqlQuery('sql/ops301/insert-data-1-5-499.sql');
		 runSqlQuery('sql/ops301/insert-data-55-57.sql');
		 runSqlQuery('sql/ops301/insert-data-58-94.sql');
				   
		   
		$result='done_all';
	    }
	    else
	    {
	         $result='error_nodblink';
	     }
		 
	}
	else
	{
		     $result='error_dbcreation';
	}

   return $result;

}
?>
