<?
		// default version is english
		$langdef="en";
		// if accept language is german goto german version
		if(substr_count(strtolower($HTTP_ACCEPT_LANGUAGE),"de"))
		{
				$langdef="de";
		}
		else
		{
		// else check browser info if german 
		//print $HTTP_USER_AGENT;
		$bbuff=str_replace(";"," ",$HTTP_USER_AGENT);
		//$bbuff=str_replace(";"," ",$bbuff);
		$bbuff=str_replace(")","",$bbuff);
		$bbuff=str_replace("(","",$bbuff);
		$bbuff=explode(" ",strtolower($bbuff));
		while (list($x,$v)=each($bbuff))
			{	
				if(($v=='[dt]')||($v=='dt'))
				{ 
				$langdef="de";
				break;
				}
			}
		}
		
		// save language to cookie
		setcookie(ck_language,$langdef);
		$lang=$langdef;
		
?>
