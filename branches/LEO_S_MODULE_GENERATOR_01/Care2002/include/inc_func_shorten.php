<?PHP

function shorten($string){
$laenge=strlen($string);

trim($string);

//Array anlegen; Wert 0 entspricht der Modulbez., Wert 1 dem blank_flag.
$neuerstring=array(2);
$neuerstring[0]="";
$i=0;

while ($i<$laenge){
       $text=$string{$i};
		
   if ($text==" " and $i !=0){ // $i, um Leerzeichen am Anfang zu eliminieren
      	$neuerstring[1]="true";
	      break;
		  }
   else {
	      $neuerstring[1]="false";
			  $neuerstring[0]=$neuerstring[0].$text;
        $i++;
        }
}
return $neuerstring;
}
?>