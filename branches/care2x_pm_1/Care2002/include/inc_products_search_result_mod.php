<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_products_search_result_mod.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if($bcat) $LDMSRCindex[]=""; // if parent is order catalog add one empty column at the end
if($update||($mode=="search"))
 {	
 	
	switch($cat)
	{
		case "pharma":
							$imgpath=$root_path."pharma/img/";
							break;
		case "medlager":
							$imgpath=$root_path."med_depot/img/";
							break;
	}

	
 	if($saveok||(!$update)) $statik=true;
	if($linecount)
	{
				//echo $linecount;
				if($linecount==1)
				{
					$zeile=$ergebnis->FetchRow();
					echo '
						  <table border=0 cellspacing=2 cellpadding=3 >
    						<tr >
      							<td align=right width=140 bgcolor="#ffffdd"><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDOrderNr.'</td>
      						';
					if($statik||$update) 
						echo '
								<td width=320  bgcolor="#ffffdd"><FONT face="Verdana,Helvetica,Arial" size=3><b>'.$zeile[bestellnum].'</b><input type="hidden" name="bestellnum" value="'.$zeile[bestellnum].'">                                                                                                   
         						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="bestellnum" value="'.$zeile[bestellnum].'" size=20 maxlength=20>                                                                                                   
         						 </td>';		 
								 
					echo '
							<td rowspan=13 valign=top  >';
					if($zeile[picfile]!="")
					{
						echo'
		  							<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">'.$LDPreview.':<br>
	 										<img src="'.$imgpath.$zeile[picfile].'" border=0 name="prevpic" ';
						if(!$update||$statik)
						{
							if(file_exists($imgpath.$zeile[picfile]))
							{
								$imgsize=GetImageSize($imgpath.$zeile[picfile]);
						 		echo $imgsize[3];
							}
						 }
						echo ' >'; 
					}
					else echo '<img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 name="prevpic"  >';
					echo '</td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDArticleName.'</td>
      						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>'.$zeile[artikelname].'</b><input type="hidden" name="artname" value="'.$zeile[artikelname].'">
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="artname" value="'.$zeile[artikelname].'" size=20 maxlength=40>                                                                                                   
         						 </td>';
					echo '
   						</tr>
          					<tr bgcolor="#ffffdd">
     						 		<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDGeneric.'</td>
       						';
					if($statik) 
						echo '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[generic].'<input type="hidden" name="generic" value="'.$zeile[generic].'">
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="generic" value="'.$zeile[generic].'"  size=40 maxlength=60>                                                                                                   
         						 </td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
     								 <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDDescription.'</td>
       						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.nl2br($zeile[description]).'<input type="hidden" name="besc" value="'.$zeile[desription].'">
          							</td>               
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><textarea name="besc"  cols=35 rows=4>'.$zeile[description].'</textarea>                                                                                                   
         						 </td>';
					echo '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDPacking.'</td>
      	       						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[packing].'<input type="hidden" name="pack" value="'.$zeile[packing].'">
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="pack" value="'.$zeile[packing].'" size=40 maxlength=40>                                                                                                   
         						 </td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDCAVE.'</td>
      	       						';
					if($statik) 
						echo '
							<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[cave].'<input type="hidden" name="caveflag" value="'.$zeile[cave].'">
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="caveflag" value="'.$zeile[cave].'" size=40 maxlength=80>                                                                                                   
         						 </td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDCategory.'</td>
       						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[medgroup].'<input type="hidden" name="medgroup" value="'.$zeile[medgroup].'">
           						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="medgroup" value="'.$zeile[medgroup].'" size=20 maxlength=40>                                                                                                   
         						 </td>';
					echo '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDMinOrder.'</td>
      	       						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[minorder].'<input type="hidden" name="minorder" value="'.$zeile[minorder].'">
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="minorder" value="'.$zeile[minorder].'" size=20 maxlength=9>                                                                                                   
         						 </td>';
					echo '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDMaxOrder.'</td>
       	       						';
					if($statik) 
						echo '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[maxorder].'<input type="hidden" name="maxorder" value="'.$zeile[maxorder].'">
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="maxorder" value="'.$zeile[maxorder].'" size=20 maxlength=9>                                                                                                   
         						 </td>';
					echo '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDPcsProOrder.'</td>
      	       						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[proorder].'<input type="hidden" name="proorder" value="'.$zeile[proorder].'"></td>
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="proorder" value="'.$zeile[proorder].'" size=20 maxlength=40>                                                                                                   
         						 </td>';
					echo '
    						</tr>
    								<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDIndustrialNr.'</td>
      						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[artikelnum].'<input type="hidden" name="artnum" value="'.$zeile[artikelnum].'">
          						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="artnum" value="'.$zeile[artikelnum].'" size=20 maxlength=20>                                                                                                   
         						 </td>';
					echo '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDLicenseNr.'</td>
      						';
					if($statik) 
						echo '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[industrynum].'<input type="hidden" name="indusnum" value="'.$zeile[industrynum].'">
          						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="indusnum" value="'.$zeile[industrynum].'" size=20 maxlength=20>                                                                                                   
         						 </td>';
					echo '
    						</tr>
						
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDPicFile.'</td>
       	       						';
					if($statik) 
						echo '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[picfile].'<input type="hidden" name="bild" value="'.$zeile[picfile].'"></td>
            						 </td>';
							else echo '
								<td width=320  bgcolor="#ffffdd"><input type="file" name="bild" onChange="getfilepath(this)">                                                                                                   
         						 </td>';
					echo '
    						</tr>
  						</table>
						';
					}
				
			else
			{
				echo "<p>".str_replace("~nr~",$linecount,$LDFoundNrData)."<br>$LDClk2SeeInfo<p>";

					echo "<table border=0 cellpadding=3 cellspacing=1> ";
		
					echo "<tr bgcolor=#ffffdd>";
	
					for($i=0;$i<sizeof($LDMSRCindex);$i++) 
					{
						echo"<td><font face=verdana,arial size=1 color=#000080>".$LDMSRCindex[$i]."</td>";
		
					}
					echo "</tr>";

					/* Load common icons */
					$img_info=createComIcon($root_path,'info3.gif','0');
					$img_arrow=createComIcon($root_path,'dwnarrowgrnlrg.gif','0');
					
					while($zeile=$ergebnis->FetchRow())
					{
						echo "<tr bgcolor=";
						if($toggle) { echo "#dfdfdf>"; $toggle=0;} else {echo "#fefefe>"; $toggle=1;};
						echo '
									<td valign="top"><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&keyword='.$zeile[bestellnum].'&mode=search&from=multiple&cat='.$cat.'&userck='.$userck.'"><img '.$img_info.' alt="'.$LDOpenInfo.$zeile[artikelname].'"></a></td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[bestellnum].'</td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[artikelnum].'</td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[industrynum].'</td>
									<td valign="top"><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&keyword='.$zeile[bestellnum].'&mode=search&from=multiple&cat='.$cat.'&userck='.$userck.'"><font face=verdana,arial size=2 color="#800000"><b>'.$zeile[artikelname].'</b></font></a></td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[generic].'</td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[description].'</td>
									';
						// if parent is order catalog add this option column at the end
						if($bcat) echo'
									<td valign="top"><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&mode=save&artikelname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&bestellnum='.$zeile['bestellnum'].'&proorder='.str_replace(" ","+",$zeile['proorder']).'&hit=0&cat='.$cat.'&userck='.$userck.'"><img '.$img_arrow.' alt="'.$LDPut2Catalog.'"></a></td>';				
						echo    '
									</tr>';
					}
					echo "</table>";
					if($linecount>15)
					{
						echo '
								<a href="#pagetop">'.$LDPageTop.'</a>';
					}//end of if $linecount>15

			}//end of else
	}
	else
		echo '<font face=verdana,arial size=2>
			<p><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>
			'.$LDNoDataFound;

}
?>
