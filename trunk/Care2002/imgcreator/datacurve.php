<?
// <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
require("../req/db_dbp.php");
$dbtable="nursing_station_patients_curve";

//$yr=2001;
//$mo=10;
//$dy=11;

function aligndate(&$ad,&$am,&$ay)
{
	if(!checkdate($am,$ad,$ay))
	{
		if($am==12)
		{
			$am=1;
			$ad=1;
			$ay++;
		}
		else
		{
			$am=$am+1;
    		$ad=1;
		}
	}
}

$xoffs=100;
$xunit=$xoffs/24;
$yunit_temp=135/5;
$yunit_bp=135/200;

$link=mysql_connect($dbhost,$dbusername,$dbpassword);
 if ($link)
 {
	if(mysql_select_db($dbname,$link)) 
	{	
		 	$sql="SELECT bp_temp FROM $dbtable WHERE patnum='$pn'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					$arr=explode("_",$result[bp_temp]);
					
					$actmonat=$mo;
					$actjahr=$yr;
					
					for($i=$dy,$acttag=$dy,$d=0;$i<($dy+7);$i++,$d++,$acttag++)
		 			{
						aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date

						$cbuf="sd=$actjahr$actmonat$acttag&rd=$acttag.$actmonat.$actjahr";
		 				$loaded[$i]=0;
						while(list($x,$v)=each($arr))
						{
							if(stristr($v,$cbuf))
							{
								$sbuf[$d]=$v;
								$loaded[$d]=1;
								break;
							}
						}// end of while
						reset($arr);
	 				}// end of for $i=0
				}// end of if rows
			}// end of if ergebnis
	}//else print "$sql<br>";
	mysql_close($link);
  } //else { print " $sql<br>"; }

 

  
  
$tabhi=135;
$tablen=700;
$tabcols=$tablen/28;
$tabrows=$tabhi/20;

 header ("Content-type: image/PNG");
//dl("php_gd.dll");

$im=@ImageCreateFromPNG("datacurve.png");

if(!$im)
{
 $im = @ImageCreate ($tablen, $tabhi)
     or die ("Cannot Initialize new GD image stream");
// $background_color = ImageColorAllocate ($im, 205,225,236);
$background_color = ImageColorAllocate ($im, 255,255,255);
$text_color = ImageColorAllocate ($im, 0, 170, 255);

for($i=$tabcols;$i<$tablen;$i+=$tabcols)
 ImageLine($im,$i,0,$i,$tabhi-1,$text_color);
for($i=$tabrows;$i<$tabhi;$i+=$tabrows)
 ImageLine($im,0,$i,$tablen-1,$i,$text_color);

ImageLine($im,0,$tabhi-1,$tablen-1,$tabhi-1,$text_color);
}

//**************** start tracing ***********************
//$ox1=0;$oy1=135-(80*$yunit_bp);
//$tx1=0; $ty1=$oy1;
$ox1=0;$oy1=0;
$tx1=0; $ty1=0;
for($n=0,$xof=0;$n<7;$n++,$xof+=$xoffs)
{
	if(!$loaded[$n]) continue;
	
	if ($sbuf[$n]) 	parse_str($sbuf[$n],$abuf);
	$b_t=explode("~",trim($abuf[e])); 
	
					//print $b_t[0]." ".$b_t[1]."<br>";
					//print "here we gow";


//**************** begin of curve tracing  Blood Pressure***************
$b=explode("B",trim($b_t[0]));
if(!$b[0]) array_splice($b,0,1);
$b=array_unique($b);
sort($b,SORT_NUMERIC);

$text_color = ImageColorAllocate ($im, 255, 0, 0);

//$bb=explode("b",$b[0]);
//if(($bc[0])&&($bc[1])) 
//$ox1=$xlb ;$oy1=$ylb;

// ImageArc($im,$ox1,$oy1,4,4,0,360,$text_color);

//print $ox1." ".$oy1."<br>";
			for($i=0;$i<(sizeof($b));$i++)
			{
				if(!$b[$i]) continue;
				$bc=explode("b",$b[$i]);
				if(($bc[0]==0)||($bc[1]==0)) continue;
				//{$bc[0]=12; $bc[1]=100;}
				$ox2=(($bc[0])*$xunit)+$xof; $oy2=(($bc[1])-70)*$yunit_bp;$oy2=134-$oy2;
				 ImageArc($im,$ox2,$oy2,4,4,0,360,$text_color);
				if($ox1 || $oy1) 
				ImageLine($im,$ox1,$oy1,$ox2,$oy2,$text_color);
				 $ox1=$ox2;$oy1=$oy2;
				 //$xlb=$ox2;$ylb=$oy2;
			}
			
//**************** begin of curve tracing  Temperature***************

$b=explode("T",trim($b_t[1]));
if(!$b[1]) array_splice($b,0,1);
$b=array_unique($b);
sort($b,SORT_NUMERIC);

$text_color = ImageColorAllocate ($im, 0, 0, 255);

//$tx1=$xlt; $ty1=$ylt;

//print $ox1." ".$oy1."<br>";
			for($i=0;$i<(sizeof($b));$i++)
			{
				if(!$b[$i]) continue;
				$bc=explode("t",$b[$i]);
				if(($bc[0]==0)||($bc[1]==0)) continue;
				$tx2=(($bc[0])*$xunit)+$xof; $ty2=(($bc[1])-35)*$yunit_temp;$ty2=134-$ty2;
//print $ox2." ".$oy2."<br>";
				 ImageFilledRectangle($im,$tx2-2,$ty2-2,$tx2+1,$ty2+1,$text_color);
				if($tx1 || $ty1) ImageLine($im,$tx1,$ty1,$tx2,$ty2,$text_color);
				 $tx1=$tx2;$ty1=$ty2;
				// $xlt=$ox2;$ylt=$oy2;

			}
} // end of for $n

 				// ImageLine($im,0,0,350,98,$text_color);

ImagePNG($im);
ImageDestroy ($im);
 ?>
