<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
GNU GPL. For details read file "copy_notice.txt".
*/

/**
* This routine creates graphical chart for blood pressure and temperature
*/

/**
* This function aligns the date to the start of the grahical chart
*/
function aligndate(&$ad,&$am,&$ay)
{
	if(!checkdate($am,$ad,$ay)) // checks if the day is valid for example Feb.29 or Sept. 31, last day of month, or last day of year, etc.
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
/**
* Initialize some values
*/
$xoffs=100; // The width of a day's column in pixels
$xunit=$xoffs/24; // Unit of 1 hour in pixels = Width of day's column divided by 24 hours
$yunit_temp=135/5; // Unit of y coord per temperature value in pixels
$yunit_bp=135/200; // Unit of y coord per blood pressure value in pixels

if(!extension_loaded('gd')) dl('php_gd.dll');

if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){	
    $dbtable='care_nursing_station_patients_curve';
	
	$sql="SELECT bp_temp FROM $dbtable WHERE patnum='$pn'";

	if($ergebnis=$db->Execute($sql)){
		if($rows=$ergebnis->RecordCount()){

			$result=$ergebnis->FetchRow();
			$arr=explode('_',$result['bp_temp']);
			$actmonat=$mo;
			$actjahr=$yr;
					
			for($i=$dy,$acttag=$dy,$d=0;$i<($dy+7);$i++,$d++,$acttag++){
				aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
				$cbuf="sd=$actjahr$actmonat$acttag&rd=$acttag.$actmonat.$actjahr";
		 		$loaded[$i]=0;
				
				while(list($x,$v)=each($arr)){
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
} //else { print " $sql<br>"; }
  
/* Initialize general  dimensions */ 
$tabhi=135; // Height of graph chart in pixels
$tablen=700; // Total width of graph chart in pixels
$tabcols=$tablen/28; // Total number of vertical lines
$tabrows=$tabhi/20; // Total number of horizontal lines

header ('Content-type: image/PNG');


$im=@ImageCreateFromPNG($root_path.'main/imgcreator/datacurve.png'); // Loads the ready made image (makes this routine faster)

/**
* The next set of codes create the graph chart on-the-fly 
* if the ready made image is not loaded successfully
*/
if(!$im)
{
 $im = @ImageCreate ($tablen, $tabhi)
     or die ("Cannot Initialize new GD image stream");
// $background_color = ImageColorAllocate ($im, 205,225,236);
$background_color = ImageColorAllocate ($im, 255,255,255);
$text_color = ImageColorAllocate ($im, 0, 170, 255);
/**
* The vertical and horizontal lines are drawn
*/
for($i=$tabcols;$i<$tablen;$i+=$tabcols) ImageLine($im,$i,0,$i,$tabhi-1,$text_color);
for($i=$tabrows;$i<$tabhi;$i+=$tabrows) ImageLine($im,0,$i,$tablen-1,$i,$text_color);
ImageLine($im,0,$tabhi-1,$tablen-1,$tabhi-1,$text_color);
}

$text_red = ImageColorAllocate ($im, 255, 0, 0);
$text_blue = ImageColorAllocate ($im, 0, 0, 255);

//**************** start drawing the graph values ***********************
/**
* These variables are used in the following lines of code
*
* $ox1 = a line's start x coord for blood pressure
* $oy1= a line's start y coord for blood pressure
* $tx1 = a line's start x coord for temperature
* $ty1 = a line's start y coord for temperature
* $ox2 = a line's end x coord for blood pressure
* $oy2= a line's end y coord for blood pressure
* $tx2 = a line's end x coord for temperature
* $ty2 = a line's end y coord for temperature
*
* $n = Column number of the chart = corresponding to a day
* $xof= The current start x coord
*/
$ox1=0;$oy1=0;
$tx1=0; $ty1=0;

for($n=0,$xof=0;$n<7;$n++,$xof+=$xoffs)
{
	if(!$loaded[$n]) continue;
	
	if ($sbuf[$n]) 	parse_str($sbuf[$n],$abuf);
	$b_t=explode("~",trim($abuf[e])); 
	
//**************** begin of curve tracing  Blood Pressure***************
    $b=explode("B",trim($b_t[0]));
    if(!$b[0]) array_splice($b,0,1);
    $b=array_unique($b);
    sort($b,SORT_NUMERIC);

    for($i=0;$i<(sizeof($b));$i++)
    {
        if(!$b[$i]) continue;
        $bc=explode("b",$b[$i]);
        if(($bc[0]==0)||($bc[1]==0)) continue;
        $ox2=(($bc[0])*$xunit)+$xof; 
	    $oy2=(($bc[1])-70)*$yunit_bp;$oy2=134-$oy2;
        ImageArc($im,$ox2,$oy2,4,4,0,360,$text_red);
        if($ox1 || $oy1) ImageLine($im,$ox1,$oy1,$ox2,$oy2,$text_red);
        $ox1=$ox2;
	    $oy1=$oy2;
    }
			
//**************** begin of curve tracing  Temperature***************
    $b=explode("T",trim($b_t[1]));
    if(!$b[1]) array_splice($b,0,1);
    $b=array_unique($b);
    sort($b,SORT_NUMERIC);

    for($i=0;$i<(sizeof($b));$i++)
    {
        if(!$b[$i]) continue;
        $bc=explode("t",$b[$i]);
        if(($bc[0]==0)||($bc[1]==0)) continue;
        $tx2=(($bc[0])*$xunit)+$xof; 
	    $ty2=(($bc[1])-35)*$yunit_temp;$ty2=134-$ty2;
        ImageFilledRectangle($im,$tx2-2,$ty2-2,$tx2+1,$ty2+1,$text_blue);
        if($tx1 || $ty1) ImageLine($im,$tx1,$ty1,$tx2,$ty2,$text_blue);
        $tx1=$tx2;$ty1=$ty2;
    }
} // end of for $n

ImagePNG($im);
ImageDestroy ($im);
 ?>
