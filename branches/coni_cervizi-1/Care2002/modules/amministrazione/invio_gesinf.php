<?php

if($_POST['cancella']=='Cancella')
header("Location:amministrazione.php");

 if($_POST['invio']=='Invia')
{
require ("FileSearcher.php");

$path="../../Gesinf/temp/beneficiari";
$files= new FileSearcher("txt");
$filelist=$files->GetFiles($path, true);

function mail_attach($to, $from, $subject, $message, $files = FALSE,$lb="\r\n") {
 // $to Recipient
 // $from Sender (like "email@domain.com" or "Name <email@domain.com>")
 // $subject Subject
 // $message Content
 // $files hash-array of files to attach
 // $lb is linebreak characters... some mailers need \r\n, others need \n
 $mime_boundary = "<<<:" . md5(uniqid(mt_rand(), 1));
 $header = "From: ".$from;
 if(is_array($files)) {
 $header.= $lb;
 $header.= "MIME-Version: 1.0".$lb;
 $header.= "Content-Type: multipart/mixed;".$lb;
 $header.= " boundary=\"".$mime_boundary."\"".$lb;
 $content = "This is a multi-part message in MIME format.".$lb.$lb;
 $content.= "--".$mime_boundary.$lb;
 $content.= "Content-Type: text/plain; charset=\"iso-8859-1\"".$lb;
 $content.= "Content-Transfer-Encoding: 7bit".$lb.$lb;

 }
 $content.= $message.$lb;
 if(is_array($files)) {
  $content.= "--".$mime_boundary.$lb;
   
  foreach($files as $filename=>$filelocation) {
  
    
   if(is_readable($filelocation)) {
 
     $data = chunk_split(base64_encode(implode("", file($filelocation))));
       $content.= "Content-Disposition: attachment;".$lb;
       //$content.= "Content-Type: Application/Octet-Stream;";
       $content.= "Content-Type: text/plain;";
	   $content.= " name=\"".$filename."\"".$lb;
	 
       $content.= "Content-Transfer-Encoding: base64".$lb.$lb;
	   
       $content.= $data.$lb;
       $content.= "--".$mime_boundary.$lb;
   }
  }
 }
 
 if(mail($to, $subject, $content, $header)) {
  return TRUE;
 }
 return FALSE;

}

//$file[0]="Richiesta Help Desk";
//$file[1]="by Marco Bernardi";
//$file=file("utenti.txt");
//$file[0]="leo.php";
$i=0;
$filelist2=$filelist;
$stringa='';
while(list($a,$b)=each($filelist))
{
//echo substr($c,0,10);
//echo date('d-m-Y');
//echo $b;
$posizione=strrpos($b,'/');
$c=substr($b,$posizione+1);
  if(substr($c,0,10)!=date('d-m-Y'))
  	{
	$stringa.=$c." e ";
	//echo "stringa ".$stringa."<br>";
	$file[$c]=$b;
	$i++; ##CONTA QUANTI FILE SONO SPEDITI
	}
}
//echo $filelist;

$posizione2=strrpos($stringa,'e');
$stringa=substr($stringa,0,$posizione2);
$stringa2=$stringa;
$stringa_app='';
while(strstr($stringa2,"txt"))
{
//echo "dentro <br>";
$posizione4=strpos($stringa2,"t");
//echo "prima ".$stringa_app."<br>";
$stringa_app.=substr($stringa2,0,$posizione4-1);
//echo "dopo ".$stringa_app."<br>";
$stringa2=substr($stringa2,$posizione4+3);
//echo "aggiornamento ".$stringa2."<br>";
}

$corretto=mail_attach("francesco.imme@coni.it","HIS@coni.it","HIS - Istituto Nazionale di Medicina dello Sport - Beneficiari delle fatture del ".$stringa_app,"I dati sono stati inviati il ".date('d-m-Y')." ed il nome del file indica la data a cui si riferisce ( ".$stringa." ).\nGrazie mille per la collaborazione.\nSegreteria dell'Istituto Nazionale di Medicina dello Sport",$file);
while(list($a,$b)=each($filelist2))
{
$posizione3=strrpos($b,"/");
$d=substr($b,$posizione+1);
  if(substr($d,0,10)!=date('d-m-Y'))
  	{
	//echo $d."<br>";
	//echo $b."<br>";
	copy($b,"../../Gesinf/beneficiari/".$d);
	unlink($b);
	}
}


/*
$success = $fail = array();
		
		$usr = $_SESSION['usr'];
		$msg = "richiesta di aiuto per help desk";
		$sub = "richiesta";
		$to = "marco.bernardi@guest.coni.it";
		//$to = $adminEmail;

		// Send HTML email
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		//	$headers .= 'From: phpScheduleIt <' . $conf['app']['adminEmail'] . ">\r\n";
		$headers .= "From: phpScheduleIt < bernardi.marco@libero.it >\r\n";
		//$headers .= 'Bcc:' . join(','," ") . "\r\n";
		
		if (mail($to, $sub, $msg, $headers))
				$success = true;
		else
				$success = false;
echo $success;
*/

if($corretto==1)
{
?>
<br>
<br>
<p align="center"><b><i>I file sui beneficiari delle fatture del <? echo $stringa_app;?> sono stati inviati correttamente!</i></b></p>
<?
}
$path="../../Gesinf/temp/fatture";
$files= new FileSearcher("txt");
$filelist=$files->GetFiles($path, true);
$i=0;
$filelist2=$filelist;
$stringa='';
while(list($a,$b)=each($filelist))
{
//echo $b;
$posizione=strrpos($b,'/');
$c=substr($b,$posizione+1);
 if(substr($c,0,10)!=date('d-m-Y'))
  	{
	$stringa.=$c." e ";
	//echo "stringa ".$stringa."<br>";
	$file[$c]=$b;
	$i++; ##CONTA QUANTI FILE SONO SPEDITI
	}
}
//echo $filelist;

$posizione2=strrpos($stringa,'e');
$stringa=substr($stringa,0,$posizione2);
$stringa2=$stringa;
$stringa_app='';
while(strstr($stringa2,"txt"))
{
//echo "dentro <br>";
$posizione4=strpos($stringa2,"t");
//echo "prima ".$stringa_app."<br>";
$stringa_app.=substr($stringa2,0,$posizione4-1);
//echo "dopo ".$stringa_app."<br>";
$stringa2=substr($stringa2,$posizione4+3);
//echo "aggiornamento ".$stringa2."<br>";
}

$corretto=mail_attach("francesco.imme@coni.it","HIS@coni.it","HIS - Istituto Nazionale di Medicina dello Sport - Fatture del ".$stringa_app,"I dati sono stati inviati il ".date('d-m-Y')." ed il nome del file indica la data a cui si riferisce ( ".$stringa." ).\nGrazie mille per la collaborazione.\nSegreteria dell'Istituto Nazionale di Medicina dello Sport",$file);
while(list($a,$b)=each($filelist2))
{
$posizione3=strrpos($b,"/");
$d=substr($b,$posizione+1);
  if(substr($d,0,10)!=date('d-m-Y'))
  	{
     //echo $d."<br>";
     //echo $b."<br>";
     copy($b,"../../Gesinf/fatture/".$d);
     unlink($b);
	}
}

if($corretto==1)
{
?>
<br>
<br>
<p align="center"><b><i>I file sulle fatture del <? echo $stringa_app;?> sono stati inviati correttamente!</i></b></p>
<?
}
}
if($_POST['invio']=='' && $_POST['cancella']=='')
{
?>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 >
<table  width=100% border=0  cellpadding="0" cellspacing="0" >
	<tr>
	<td bgcolor="#99ccff" valing="top" height="28">
	<font  COLOR="#330066"  SIZE=+2  FACE="Arial">
<strong> &nbsp; Invio dati Fatturazione a Sistema Gesinf</strong></font>
	</td>
	</tr>
</table>
</body>
<form name="dati" method="POST" scrollbar size="" action="">
<table cellspacing="10" cellpadding="10">
	<tr >
		<td align="center">
		<b><i>Il sistema automaticamente inviera' i file relativi alle fatture dei giorni passati che non sono stati ancora inviati.<br>Si e' certi di voler proseguire?</i></b>
		</td>
	</tr>
	<tr>
		<td align="center">
		<input type="submit" name="invio" value="Invia">
		<input type="submit" name="cancella" value="Cancella">
		</td>
	</tr>
</table>

</form>
<?
}
?>
