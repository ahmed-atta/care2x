<?
	$datum=date(Y_m_d);
	$fname="counter/$datum.txt";
	$fname2="counter/hitcount.txt";
	$count=get_meta_tags($fname2);
	if($fp=fopen($fname,"a"))
	{
		 if($fp2=fopen($fname2,"w+"));
 		{
			fputs($fp,"date=$datum&tstamp=".date(H_i)."&ip=$REMOTE_ADDR&port=$REMOTE_PORT&agent=$HTTP_USER_AGENT&ref=$HTTP_REFERER\r\n");
			fclose($fp);
			if(($count['hit']==NULL)||($count['hit']==0)) $count['hit']=1; 
				else $count['hit']=$count['hit']+1;
			fputs($fp2,'<meta name="hit" content="'.$count['hit'].'">');
			fclose($fp2);
 		}
	}
?>
