<? 
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla
								
Beta version 1.0    2002-05-10
								
This script(s) is(are) free software; you can redistribute it and/or
modify it under the terms of the GNU General Public
License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.
																  
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
General Public License for more details.
											   
You should have received a copy of the GNU General Public
License along with this script; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
																		 
Copy of GNU General Public License at: http://www.gnu.org/
													 
Source code home page: http://www.care2x.com
Contact author at: elpidio@latorilla.com

This notice also applies to other scripts which are integral to the functioning of CARE 2002 within this directory and its top level directory
A copy of this notice is also available as file named copy_notice.txt under the top level directory.
*/

//dl("php_gd.dll");
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
require("../language/".$lang."/lang_".$lang."_aufnahme.php");

header ("Content-type: image/png");
//header ("Content-type: image/jpeg");
//header ("Content-type: image/gif");
//$person=str_replace("+"," ",$person);
$im = ImageCreateFrompng("../img/cat-com5.png");
/*
$im=ImageCreate(200,100);
$background_color = ImageColorAllocate ($im, 255,102,102);
$text_color = ImageColorAllocate ($im, 0, 170, 255);
$background= ImageColorAllocate ($im, 205, 225, 236);
 $white = ImageColorAllocate ($im, 255, 255, 255);
*/
$blue=ImageColorAllocate($im, 0, 127, 255);
$black = ImageColorAllocate ($im, 0, 0, 0);
$time=date(G);
if(($time>=0)&&($time<10)) $greet=$LDGoodMorning;
	else if(($time>9)&&($time<13)) $greet=$LDGoodDay; 
	else if(($time>12)&&($time<18)) $greet=$LDGoodAfternoon; 
		else $greet=$LDGoodEvening;
			
// *******************************************************************
// * the following code is for ttf fonts use only for php machines with ttf support
// * uncomment the following lines to use ttf font and comment the default line
// *******************************************************************

/*
ImageTTFText($im,14,0,9,25,$black,"verdanab.ttf","hello");
ImageTTFText ($im, 14, 0, 15, 76, $black, "verdana.ttf",$person);
imagecolortransparent($im,$blue);
*/

// ******************************************************************
// * the following code is the default - uses system fonts
// * comment the following lines if you use the ttf font line above
// ******************************************************************

ImageString($im,5,9,20,$greet,$black);
if(strlen($person)>18) $fs=3; else $fs=5;
ImageString($im,$fs,12,63,$person,$black);

Imagepng ($im);
//Imagegif ($im);
//Imagejpeg ($im);
ImageDestroy ($im);
?>


