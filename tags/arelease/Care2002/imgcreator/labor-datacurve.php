<?
// <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
require("../req/db_dbp.php");
$dbtable="nursing_station_patients_curve";

$yr=2001;
$mo=10;
//$dy=11;

$xoffs=100;
$xunit=$xoffs/24;
$yunit_temp=135/5;
$yunit_bp=135/200;

$fielddata="patnum,name,vorname,gebdatum";

require("../req/labor-param-group.php");

//search the paramgroup of the parameter
for($i=0;$i<sizeof($parametergruppe);$i++)
{
	if(in_array($parameter,$paralistarray[$i])) 
	{
		$groupname=$parametergruppe[$i];
		break;
	}
}

//print "param ".$parameter." group ".$groupname."<p>";
$dbuf=explode("~",$tid);
$cols=sizeof($dbuf);
$srctid=" tid='$dbuf[0]'";

for($i=1;$i<$cols;$i++)
{
	$srctid.=" OR tid='$dbuf[$i]'";
}

						
if($parameterselect=="") $parameterselect=0;

$parameters=$paralistarray[$parameterselect];					
//$paramname=$parametergruppe[$parameterselect];

require("../req/db_dbp.php");

$link=mysql_connect($dbhost,$dbusername,$dbpassword);
if ($link)
 { 

   if(mysql_select_db($dbname,$link)) 
	{
				
				$dbtable="lab_test_data";
				$sql="SELECT $groupname,tid FROM $dbtable WHERE patnum='$patnum' AND ($srctid) ORDER BY tid";
				//print $sql."<p>";
        		if($ergebnis=mysql_query($sql,$link))
				{
					$rows=0;$zeile=array();
					while ($zeile=mysql_fetch_array($ergebnis)) $rows++;
					if ($rows) mysql_data_seek($ergebnis,0);
					else
					 {
					 	exit;
					 }
				}	
	} else exit;
	 mysql_close($link);
  }
  	 else 
		{ exit; }

   
$tabhi=100;
$tabcols=100;
$tablen=$tabcols*$cols;
$ox=$tabcols/2;
$tabrows=$tabhi/10;

header ("Content-type: image/PNG");
//dl("php_gd.dll");
/*
$im=@ImageCreateFromPNG("datacurve.png");

if(!$im)
{
*/
 $im = @ImageCreate ($tablen, $tabhi)
     or die ("Cannot Initialize new GD image stream");
// $background_color = ImageColorAllocate ($im, 205,225,236);
$background_color = ImageColorAllocate ($im, 255,255,255);
$text_color = ImageColorAllocate ($im, 204, 255, 204);
ImageFilledRectangle($im,0,20,$tablen,80,$text_color);

$text_color = ImageColorAllocate ($im, 175, 204, 255);

for($i=$tabcols;$i<$tablen;$i+=$tabcols)
 ImageLine($im,$i,0,$i,$tabhi-1,$text_color);
for($i=$tabrows;$i<$tabhi;$i+=$tabrows)
 ImageLine($im,0,$i,$tablen-1,$i,$text_color);

ImageLine($im,0,$tabhi-1,$tablen-1,$tabhi-1,$text_color);

/*
}
*/

//**************** start tracing ***********************
$vbuf=array();
if($rows)
{
 while($zeile=mysql_fetch_array($ergebnis)) 
	{

//**************** begin of curve tracing  data ***************
//print $zeile[$groupname]."<p>";
				parse_str($zeile[$groupname],$vbuf);
				array_unique($vbuf);
				//$text_color = ImageColorAllocate ($im, 255, 0, 255);
				//ImageString($im,1,($ox-20),50,(sizeof($vbuf)),$text_color);
				//if(($vbuf[$parameter]=="") continue;
				$dybuf=$vbuf[$parameter];
				if(!$dybuf)
				{
					$ox+=$tabcols;
				 	continue;
				 }
				//{$bc[0]=12; $bc[1]=100;}
				//print $parameter." >>>>> ".trim($vbuf[$parameter])."<p>";
				//$ox2=$xoffset; $oy2=($tabhi/$dybuf)*$tabhi;
				//if($dybuf>100) $dybuf=(100/$dybuf)*100;
				$text_color = ImageColorAllocate ($im, 204, 0, 0);
				if($dybuf>100)
				{
					ImageString($im,2,($ox+5),5,$dybuf,$text_color);
					$dybuf=99;
				}
				else
				{
				  	if($dybuf<0) {ImageString($im,2,($ox+5),95,$dybuf,$text_color); $dybuf=1; }
					else	ImageString($im,2,($ox+5),($tabhi-$dybuf),$dybuf,$text_color);
				}
				$dybuf=$tabhi-$dybuf; // invert the values
				$text_color = ImageColorAllocate ($im, 0, 0, 255);
				 ImageArc($im,$ox,$dybuf,4,4,0,360,$text_color);
				if($ox1 || $oy1) 
				ImageLine($im,$ox1,$oy1,$ox,$dybuf,$text_color);
				 $ox1=$ox;$oy1=$dybuf;
				 //$xlb=$ox2;$ylb=$oy2;
				$ox+=$tabcols; 

			
	}
}

ImagePNG($im);
ImageDestroy ($im);
 ?>
