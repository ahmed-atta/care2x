<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_date_format_functions.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/**
* getDateFormat gets the date format stored in the databank
* if unsuccesful, it will get the default from the defaults.ini
* param $link = receives the link created by the db connection routine
* param $DBLink_OK = receives the tag created by the db connection routine
* return = the date format
*/
function getDateFormat($link,$DBLink_OK)
{

	$errFormat=0;

    /* If no link to db, make own link*/
    if(!isset($link) || !$link)
	{
	    
	    include('../include/inc_init_main.php');
	  
	     if ($link=mysql_connect($dbhost,$dbusername,$dbpassword))
        {
	       if(mysql_select_db($dbname,$link)) 
	      {	
		      $DBLink_OK=1;
	       }
	       else $DBLink_OK=0;  
       }
    }
	
	
	if($link&&$DBLink_OK) 
	{
	  $sql='SELECT date_format FROM care_global_config';
	  if($result=mysql_query($sql,$link))
	  {
	    if(mysql_num_rows($result))
		{
		  $df=mysql_fetch_array($result);
		  return $df['date_format'];
		}
		else $errFormat=1;
	  }
	  else $errFormat=1;
	}
	else $errFormat=1;
	
	if($errFormat)
	{
	  $df=get_meta_tags('../global_conf/date_format_default.pid');

      if($df['date_format']!='') return $df['date_format'];
	    else return 'dd.MM.yyyy'; // this is the last alternative format (german traditional)
    }
}

/**
* format2Local converts the standard YYYY-MM-DD format to the local format
* param $stdDate = receives the standard YYYY-MM-DD formatted date
* param $localFromat = receives the local format
* param $retTime = if 1, will append the time part to the returned date
* param $sepChars = will accept the reference to an array containing the separator chars list.  if empty, the default will be used
* return = the date in local format
* The function assumes that the dates are in correct formats
* therefore a validation routine must be done at the client side
*/
function formatDate2Local($stdDate,$localFormat,$retTime,$timeOnly,&$sepChars)
{
   if(!$sepChars) $sepChars=array('-','.','/',':',',');
   $localFormat=strtolower($localFormat); 
   
   if(eregi('0000',$stdDate))  return strtr($localFormat,'yYmMdDHis','000000000'); // IF  std date is 0 return 0's in local format

   /* If time is included then isolate */
   if(strchr($stdDate,':'))
   {
      list($stdDate,$stdTime) = explode(' ',$stdDate);
	  if($timeOnly) return $stdTime; /* It time only is needed */
   }

   $stdArray=explode('-',$stdDate);
   
   /* Detect time separator and explode localFormat */
   for($i=0;$i<sizeof($sepChars);$i++)
   {
     if(strchr($localFormat,$sepChars[$i]))
	 {
	    $localSeparator=$sepChars[$i];
        $localArray=explode($localSeparator,$localFormat);
		break;
	 }
   }
   
   for($i=0;$i<3;$i++)
   {
     if($localArray[$i]=='yyyy') $localArray[$i]=$stdArray[0];
	  elseif($localArray[$i]=='mm') $localArray[$i]=$stdArray[1];
	    elseif($localArray[$i]=='dd') $localArray[$i]=$stdArray[2];
   }
   
   if($retTime) return implode($localSeparator,$localArray).' '.$stdTime;
    else return implode($localSeparator,$localArray);
   
}

function formatShortDate2Local($month,$day,$localFormat)
{
   if(!$sepChars) $sepChars=array('-','.','/',':',',');
   $localFormat=strtolower($localFormat); 
   
 
   /* Detect time separator and explode localFormat */
   for($i=0;$i<sizeof($sepChars);$i++)
   {
     if(strchr($localFormat,$sepChars[$i]))
	 {
	    $localSeparator=$sepChars[$i];
        $localArray=explode($localSeparator,$localFormat);
		break;
	 }
   }
   
   for($i=0;$i<3;$i++)
   {
     if($localArray[$i]=='yyyy') $s_tag=$i;
	  elseif($localArray[$i]=='mm') $localArray[$i]=$month;
	    elseif($localArray[$i]=='dd') $localArray[$i]=$day;
   }
   
   array_splice($localArray,$s_tag,1);
   return implode($localSeparator,$localArray);
   
}


function formatDate2STD($localDate,$localFormat,&$sepChars)
{
   $finalDate=0;
   $localFormat=strtolower($localFormat);

   if(!$sepChars) $sepChars=array('-','.','/',':',',');

	  if(eregi('0000',$finalDate)) $finalDate=0;

   
   if(!$finalDate)
   {
     
	 for($i=0;$i<sizeof($sepChars);$i++)
	 {
        if(strchr($localDate,$sepChars[$i]))
		{
	       $loc_array=explode($sepChars[$i],$localDate);
		   break;
		}
	 }
     
	 for($i=0;$i<sizeof($sepChars);$i++)
	 {
        if(strchr($localFormat,$sepChars[$i]))
		{
	       $Format_array=explode($sepChars[$i],$localFormat);
		   break;
		}
	 }
	 
	 /* Detect local format and reformat the local time to DATE standard */
	 for($i=0;$i<3;$i++)
	 {
	    if($Format_array[$i]=='yyyy')   	{ $vYear = $loc_array[$i];}
		 elseif($Format_array[$i]=='mm') { $vMonth = $loc_array[$i];}
		   elseif($Format_array[$i]=='dd') { $vDay = $loc_array[$i];}
	 }
 	  
	  $finalDate=$vYear.'-'.$vMonth.'-'.$vDay; /* DATE standard */
     
   }
   return $finalDate;
}

/**
* convertTimeStandard() will return a time in the format HH:mm:ss
* param $time_val = the time value to be converted
* return = the time in the format HH:mm:ss
*/
function convertTimeToStandard($time_val)
{
   $time_val=strtr($time_val,'.,/-','::::'); // convert the separators to ':'
   
   $sep_count=substr_count($time_val,':');
   
   switch($sep_count)
   {
     case '': $time_val.=':00:00'; break;
     case 0: $time_val.=':00:00'; break;
     case 1: $time_val.=':00';
   }
   
   return $time_val;
}

/**
* convertTimeLocal() will return a time in the local format 
* param $time_val = the time value to be converted
* return = the time in the format HH:mm:ss
*/
function convertTimeToLocal($time_val)
{
   global $lang;
   
   switch($lang)
   {
     case 'de': $time_val=strtr($time_val,':,/-','....'); break; // convert the separators to '.' 
     default : $time_val=strtr($time_val,'.,/-','::::'); // convert the separators to ':'
   }
   
   return $time_val;
}

/* Now load the date format*/
if(isset($link) && !empty($link) && isset($DBLink_OK) && !empty($DBLink_OK)) $date_format=getDateFormat($link,$DBLink_OK);
  else $date_format=getDateFormat();

?>
