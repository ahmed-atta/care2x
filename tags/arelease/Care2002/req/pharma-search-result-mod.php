<?
//<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

$fieldname=array("","Bestell-Nr.","Artikel-Nr.","Zul.-Nr.","Artikelname","Generic","Beschreibung");

if($bcat) $fieldname[]=""; // if parent is order catalog add one empty column at the end
if($update||($mode=="search"))
 {	
 	
 	if($saveok||(!$update)) $statik=true;
	if($linecount>0)
	{
				$zeile=mysql_fetch_array($ergebnis);
				//print $linecount;
				if($linecount==1)
				{
					print '
						  <table border=0 cellspacing=2 cellpadding=3 >
    						<tr >
      							<td align=right width=140 bgcolor="#ffffdd"><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080>Bestellnummer</td>
      						';
					if($statik) 
						print '
								<td width=320  bgcolor="#ffffdd"><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[bestellnum].'<input type="hidden" name="bestellnum" value="'.$zeile[bestellnum].'">                                                                                                   
         						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="bestellnum" value="'.$zeile[bestellnum].'" size=20 maxlength=20>                                                                                                   
         						 </td>';		 
								 
					print '
							<td rowspan=13 valign=top  >';
					if($zeile[picfile]!="")
					{
						print'
		  							<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">Vorschau:<br>
	 										<img src="'.$zeile[picfile].'" border=0 name="prevpic" ';
						if(!$update||$statik)
						{
						$imgsize=GetImageSize("..".$zeile[picfile]);
						 print $imgsize[3];
						 }
						print ' >'; 
					}
					else print '<img src="../img/pixel.gif" border=0 name="prevpic"  >';
					print '</td>';
					print '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Name</td>
      						';
					if($statik) 
						print '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>'.$zeile[artikelname].'</b><input type="hidden" name="artname" value="'.$zeile[artikelname].'">
           						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="artname" value="'.$zeile[artikelname].'" size=20 maxlength=40>                                                                                                   
         						 </td>';
					print '
   						</tr>
          					<tr bgcolor="#ffffdd">
     						 		<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Generic</td>
       						';
					if($statik) 
						print '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[generic].'<input type="hidden" name="generic" value="'.$zeile[generic].'">
           						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="generic" value="'.$zeile[generic].'"  size=40 maxlength=60>                                                                                                   
         						 </td>';
					print '
    						</tr>
    						<tr bgcolor="#ffffdd">
     								 <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Beschreibung</td>
       						';
					if($statik) 
						print '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.nl2br($zeile[description]).'<input type="hidden" name="besc" value="'.$zeile[desription].'">
          							</td>               
           						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><textarea name="besc"  cols=35 rows=4>'.$zeile[description].'</textarea>                                                                                                   
         						 </td>';
					print '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Packung/Konfektion</td>
      	       						';
					if($statik) 
						print '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[packing].'<input type="hidden" name="pack" value="'.$zeile[packing].'">
           						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="pack" value="'.$zeile[packing].'" size=40 maxlength=40>                                                                                                   
         						 </td>';
					print '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">CAVE</td>
      	       						';
					if($statik) 
						print '
							<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[cave].'<input type="hidden" name="caveflag" value="'.$zeile[cave].'">
            						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="caveflag" value="'.$zeile[cave].'" size=40 maxlength=80>                                                                                                   
         						 </td>';
					print '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Kategorie</td>
       						';
					if($statik) 
						print '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[medgroup].'<input type="hidden" name="medgroup" value="'.$zeile[medgroup].'">
           						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="medgroup" value="'.$zeile[medgroup].'" size=20 maxlength=40>                                                                                                   
         						 </td>';
					print '
    						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Minimum Bestellung</td>
      	       						';
					if($statik) 
						print '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[minorder].'<input type="hidden" name="minorder" value="'.$zeile[minorder].'">
            						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="minorder" value="'.$zeile[minorder].'" size=20 maxlength=9>                                                                                                   
         						 </td>';
					print '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Maximum Bestellung</td>
       	       						';
					if($statik) 
						print '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[maxorder].'<input type="hidden" name="maxorder" value="'.$zeile[maxorder].'">
            						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="maxorder" value="'.$zeile[maxorder].'" size=20 maxlength=9>                                                                                                   
         						 </td>';
					print '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Stück pro Bestellung</td>
      	       						';
					if($statik) 
						print '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[proorder].'<input type="hidden" name="proorder" value="'.$zeile[proorder].'"></td>
            						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="proorder" value="'.$zeile[proorder].'" size=20 maxlength=40>                                                                                                   
         						 </td>';
					print '
    						</tr>
    								<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Artikelnummer PZN</td>
      						';
					if($statik) 
						print '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[artikelnum].'<input type="hidden" name="artnum" value="'.$zeile[artikelnum].'">
          						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="artnum" value="'.$zeile[artikelnum].'" size=20 maxlength=20>                                                                                                   
         						 </td>';
					print '
   						</tr>
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Zullasungsnummer</td>
      						';
					if($statik) 
						print '
      								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[industrynum].'<input type="hidden" name="indusnum" value="'.$zeile[industrynum].'">
          						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="text" name="indusnum" value="'.$zeile[industrynum].'" size=20 maxlength=20>                                                                                                   
         						 </td>';
					print '
    						</tr>
						
    						<tr bgcolor="#ffffdd">
      								<td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Bilddatei</td>
       	       						';
					if($statik) 
						print '
     								<td><FONT face="Verdana,Helvetica,Arial" size=2>'.$zeile[picfile].'<input type="hidden" name="bild" value="'.$zeile[picfile].'"></td>
            						 </td>';
							else print '
								<td width=320  bgcolor="#ffffdd"><input type="file" name="bild" accept="" value="" onChange="getfilepath(this)">                                                                                                   
         						 </td>';
					print '
    						</tr>
  						</table>
						';
					}
				
			else
			{
				print "<p>Die Suche hat <font color=red><b>".$linecount."</b></font> Daten gefunden, die dem Suchbegriff entsprechen.<br>
						Bitte klicken Sie das richtige an, um die komplette Information zu zeigen.<p>";

					mysql_data_seek($ergebnis,0);
					print "<table border=0 cellpadding=3 cellspacing=1> ";
		
					print "<tr bgcolor=#ffffdd>";
	
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						print"<td><font face=verdana,arial size=1 color=#000080>".$fieldname[$i]."</td>";
		
					}
					print "</tr>";

					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "<tr bgcolor=";
						if($toggle) { print "#dfdfdf>"; $toggle=0;} else {print "#fefefe>"; $toggle=1;};
						print '
									<td valign="top"><a href="'.$thisfile.'?sid='.$ck_sid.'&keyword='.$zeile[bestellnum].'&mode=search&from=multiple"><img src="../img/info3.gif" width=16 height=16 border=0></a></td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[bestellnum].'</td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[artikelnum].'</td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[industrynum].'</td>
									<td valign="top"><a href="'.$thisfile.'?sid='.$ck_sid.'&keyword='.$zeile[bestellnum].'&mode=search&from=multiple"><font face=verdana,arial size=2 color="#800000"><b>'.$zeile[artikelname].'</b></font></a></td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[generic].'</td>
									<td valign="top"><font face=verdana,arial size=1>'.$zeile[description].'</td>
									';
						// if parent is order catalog add this option column at the end
						if($bcat) print'
									<td valign="top"><a href="'.$thisfile.'?sid='.$ck_sid.'&mode=save&artname='.str_replace("&","%26",strtr($zeile[artikelname]," ","+")).'&bestellnum='.$zeile[bestellnum].'&proorder='.str_replace(" ","+",$zeile[proorder]).'&hit=0"><img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 alt="Dieses Artikel in Bestellkatalog stellen"></a></td>';				
						print    '
									</tr>';
					}
					print "</table>";
					if($linecount>15)
					{
						print '
								<a href="#pagetop">Zurück nach ganz oben.</a>';
					}//end of if $linecount>15

			}//end of else
	}
	else
		print '<font face=verdana,arial size=2>
			<p><img src="../img/catr.gif" width=88 height=80 border=0 align=middle>Die Suche hat <font color=red><b>keine</b></font> Daten gefunden, die dem Suchbegriff entsprechen.<p>
			Die Daten könnten aus der Datenbank gelöscht worden sein.
			<br>Bitte verständigen Sie die'.$title.' und evtl. die EDV Abteilung. Vielen Dank.';

}
?>
