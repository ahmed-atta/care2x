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

header ("Content-type: image/png");
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
require("../language/".$lang."/lang_".$lang."_nursing.php");

//dl("php_gd.dll");

//$person=str_replace("+"," ",$person);

$im = ImageCreateFromPNG("../img/cat-com8.png");
$blue=ImageColorAllocate ($im, 0, 0, 255);
$black = ImageColorAllocate ($im, 0, 0, 0);

// *******************************************************************
// * the following code is for ttf fonts use only for php machines with ttf support
// *******************************************************************

/*$txt=$LDNoOccList;
ImageTTFText ($im, 15, 0, 9, 27, $black, "arial.ttf",$txt);
$txt=$LDFromWard.strtoupper($station);
ImageTTFText ($im, 15, 0, 9, 52, $black, "arial.ttf",$txt);
$txt=$LDWithinLast.($c-1).$LDDays;
ImageTTFText ($im, 15, 0, 9, 77, $black, "arial.ttf",$txt);
$txt=$LDAvailable;
ImageTTFText ($im, 15, 0, 9, 102, $black, "arial.ttf",$txt);
*/

// ******************************************************************
// * the following code is the default - uses system fonts
// ******************************************************************

$txt=$LDNoOccList;
ImageString($im,3,9,17,$txt,$black);
$txt=$LDFromWard.strtoupper($station);
ImageString($im,3,9,42,$txt,$black);
$txt=$LDWithinLast;
ImageString($im,3,9,67,$txt,$black);
$txt=($c-1).$LDDays." ".$LDAvailable;
ImageString($im,3,9,92,$txt,$black);

Imagepng ($im);
ImageDestroy ($im);
 ?>


