<?php
require('fpdf.php');
define('EURO', chr(128) );
define('EURO_VAL', 1936.27 );

// Xavier Nicolay 2004
// Version 1.01

//////////////////////////////////////
// Public functions                 //
//////////////////////////////////////
//  function sizeOfText( $texte, $larg )
//  function addSociete( $nom, $adresse )
//  function fact_dev( $libelle, $num )
//  function addDevis( $numdev )
//  function addFacture( $numfact )
//  function addDate( $date )
//  function addClient( $ref )
//  function addPageNumber( $page )
//  function addClientAdresse( $adresse )
//  function addReglement( $mode )
//  function addEcheance( $date )
//  function addNumTVA($tva)
//  function addReference($ref)
//  function addCols( $tab )
//  function addLineFormat( $tab )
//  function lineVert( $tab )
//  function addLine( $ligne, $tab )
//  function addRemarque($remarque)
//  function addCadreTVAs()
//  function addCadreEurosFrancs()
//  function addTVAs( $params, $tab_tva, $invoice )
//  function temporaire( $texte )

class INVOICE extends FPDF
{
// private variables
var $colonnes;
var $format;
var $angle=0;

// private functions
function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
	$k = $this->k;
	$hp = $this->h;
	if($style=='F')
		$op='f';
	elseif($style=='FD' or $style=='DF')
		$op='B';
	else
		$op='S';
	$MyArc = 4/3 * (sqrt(2) - 1);
	$this->_out(sprintf('%.2f %.2f m',($x+$r)*$k,($hp-$y)*$k ));
	$xc = $x+$w-$r ;
	$yc = $y+$r;
	$this->_out(sprintf('%.2f %.2f l', $xc*$k,($hp-$y)*$k ));

	$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
	$xc = $x+$w-$r ;
	$yc = $y+$h-$r;
	$this->_out(sprintf('%.2f %.2f l',($x+$w)*$k,($hp-$yc)*$k));
	$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
	$xc = $x+$r ;
	$yc = $y+$h-$r;
	$this->_out(sprintf('%.2f %.2f l',$xc*$k,($hp-($y+$h))*$k));
	$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
	$xc = $x+$r ;
	$yc = $y+$r;
	$this->_out(sprintf('%.2f %.2f l',($x)*$k,($hp-$yc)*$k ));
	$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
	$this->_out($op);
}

function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
	$h = $this->h;
	$this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c ', $x1*$this->k, ($h-$y1)*$this->k,
						$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}

function Rotate($angle,$x=-1,$y=-1)
{
	if($x==-1)
		$x=$this->x;
	if($y==-1)
		$y=$this->y;
	if($this->angle!=0)
		$this->_out('Q');
	$this->angle=$angle;
	if($angle!=0)
	{
		$angle*=M_PI/180;
		$c=cos($angle);
		$s=sin($angle);
		$cx=$x*$this->k;
		$cy=($this->h-$y)*$this->k;
		$this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
	}
}

function _endpage()
{
	if($this->angle!=0)
	{
		$this->angle=0;
		$this->_out('Q');
	}
	parent::_endpage();
}

// public functions
function sizeOfText( $texte, $largeur )
{
	$index    = 0;
	$nb_lines = 0;
	$loop     = TRUE;
	while ( $loop )
	{
		$pos = strpos($texte, "\n");
		if (!$pos)
		{
			$loop  = FALSE;
			$ligne = $texte;
		}
		else
		{
			$ligne  = substr( $texte, $index, $pos);
			$texte = substr( $texte, $pos+1 );
		}
		$length = floor( $this->GetStringWidth( $ligne ) );
		$res = 1 + floor( $length /1) ;
		$nb_lines += $res;
	}
	return $nb_lines;
}

// Company
function addSociete( $nom, $adresse )
{
	//per server linux
    $this->Image('/var/www/html/Care2xd/invoice/coniservizi.png',10,4,50);
    //per server windows
//    $this->Image('C:\easy\www\Care2xd\invoice\coniservizi.png',10,4,50);
    
	$x1 = 10;
	$y1 = 18;
	$this->SetXY( $x1, $y1 );
	$this->SetFont('Arial','B',12);
	$length = $this->GetStringWidth( $nom );
	$this->Cell( $length, 2, $nom);
	$this->SetXY( $x1, $y1 + 4 );
	$this->SetFont('Arial','',10);
	$length = $this->GetStringWidth( $adresse );
	//CoordonnИes de la sociИtИ
	$lignes = $this->sizeOfText( $adresse, $length) ;
	$this->MultiCell($length, 4, $adresse);
}

// Label and number of invoice/estimate
function fact_dev( $libelle, $num )
{
    $r1  = $this->w - 80;
    $r2  = $r1 + 68;
    $y1  = 6;
    $y2  = $y1 + 2;
    $mid = ($r1 + $r2 ) / 2;
    
    $texte  = $libelle . " N╟ : " . $num;    
    $szfont = 12;
    $loop   = 0;
    
    while ( $loop == 0 )
    {
       $this->SetFont( "Helvetica", "B", $szfont );
       $sz = $this->GetStringWidth( $texte );
       if ( ($r1+$sz) > $r2 )
          $szfont --;
       else
          $loop ++;
    }

    $this->SetLineWidth(0.1);
    $this->SetFillColor(192);
    $this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 2.5, 'DF');
    $this->SetXY( $r1+1, $y1+2);
    $this->Cell($r2-$r1 -1,5, $texte, 0, 0, "C" );
}

// Estimate
function addDevis( $numdev )
{
	$string = sprintf("DEV%04d",$numdev);
	$this->fact_dev( "Devis", $string );
}

// Invoice
function addFacture( $numfact )
{
	$string = sprintf("FA%04d",$numfact);
	$this->fact_dev( "Facture", $string );
}

function addDate( $date )
{
	$r1  = $this->w - 31;
	$r2  = $r1 + 24;
	$y1  = 30;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	//$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
	//$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
	$this->SetFont( "Helvetica", "B", 10);
	$this->Cell(10,5, "Data Esame", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+9 );
	$this->SetFont( "Helvetica", "", 10);
	$this->Cell(10,5,$date, 0,0, "C");
}

function addClient( $ref )
{
 $r1  = $this->w - 37;
 
   $r2  = $r1 + 25;
//era +19
	$y1  = 17;
	$y2  = $y1;
	$mid = $y1 + ($y2 / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
	$this->SetFont( "Helvetica", "B", 10);
	$this->Cell(10,5, "Cliente", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1 + 9 );
	$this->SetFont( "Helvetica", "", 10);
	$this->Cell(10,5,$ref, 0,0, "C");
}

function addPageNumber( $page )
{
	$r1  = $this->w - 80;
	$r2  = $r1 + 19;
	$y1  = 17;
	$y2  = $y1;
	$mid = $y1 + ($y2 / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
	$this->SetFont( "Helvetica", "B", 10);
	$this->Cell(10,5, "Pagina", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1 + 9 );
	$this->SetFont( "Helvetica", "", 10);
	$this->Cell(10,5,$page, 0,0, "C");
}

// Client address
function addClientAdresse( $adresse )
{
	$r1     = $this->w - 80;
	$r2     = $r1 + 68;
	$y1     = 40;
	$this->SetXY( $r1, $y1);
	$this->MultiCell( 60, 4, $adresse);
}

// Mode of payment
function addReglement( $mode )
{
	$r1  = 10;
	$r2  = $r1 + 60;
	$y1  = 80;
	$y2  = $y1+10;
	$mid = $y1 + (($y2-$y1) / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2-$r1)/2 -5 , $y1+1 );
	$this->SetFont( "Helvetica", "B", 10);
	$this->Cell(10,4, "Pagamento", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 -5 , $y1 + 5 );
	$this->SetFont( "Helvetica", "", 10);
	$this->Cell(10,5,$mode, 0,0, "C");
}

// Expiry date
function addEcheance( $date )
{
	$r1  = 80;
	$r2  = $r1 + 40;
	$y1  = 80;
	$y2  = $y1+10;
	$mid = $y1 + (($y2-$y1) / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2 - $r1)/2 - 5 , $y1+1 );
	$this->SetFont( "Helvetica", "B", 10);
	$this->Cell(10,4, "Data", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5 , $y1 + 5 );
	$this->SetFont( "Helvetica", "", 10);
	$this->Cell(10,5,$date, 0,0, "C");
}

// VAT number
function addNumTVA($tva)
{
	$this->SetFont( "Helvetica", "B", 10);
	$r1  = $this->w - 80;
	$r2  = $r1 + 70;
	$y1  = 80;
	$y2  = $y1+10;
	$mid = $y1 + (($y2-$y1) / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + 16 , $y1+1 );
	$this->Cell(40, 4, "Codice Fiscale", '', '', "C");
	$this->SetFont( "Helvetica", "", 10);
	$this->SetXY( $r1 + 16 , $y1+5 );
	$this->Cell(40, 5, $tva, '', '', "C");
}

function addReference($ref)
{
	$this->SetFont( "Helvetica", "", 10);
	$length = $this->GetStringWidth( "Note : " . $ref );
	$r1  = 10;
	$r2  = $r1 + $length;
	$y1  = 92;
	$y2  = $y1+5;
	$this->SetXY( $r1 , $y1 );
	$this->MultiCell(180,4, "Note : " . $ref);
}

function addCols( $tab )
{
	global $colonnes;
	
	$r1  = 10;
	$r2  = $this->w - ($r1 * 2) ;
	$y1  = 100;
	$y2  = $this->h - 50 - $y1;
	$this->SetXY( $r1, $y1 );
	$this->Rect( $r1, $y1, $r2, $y2, "D");
	$this->Line( $r1, $y1+6, $r1+$r2, $y1+6);
	$colX = $r1;
	$colonnes = $tab;
	while ( list( $lib, $pos ) = each ($tab) )
	{
		$this->SetXY( $colX, $y1+2 );
		$this->Cell( $pos, 1, $lib, 0, 0, "C");
		$colX += $pos;
		$this->Line( $colX, $y1, $colX, $y1+$y2);
	}
}

function addLineFormat( $tab )
{
	global $format, $colonnes;
	
	while ( list( $lib, $pos ) = each ($colonnes) )
	{
		if ( isset( $tab["$lib"] ) )
			$format[ $lib ] = $tab["$lib"];
	}
}

function lineVert( $tab )
{
	global $colonnes;

	reset( $colonnes );
	$maxSize=0;
	while ( list( $lib, $pos ) = each ($colonnes) )
	{
		$texte = $tab[ $lib ];
		$longCell  = $pos -2;
		$size = $this->sizeOfText( $texte, $longCell );
		if ($size > $maxSize)
			$maxSize = $size;
	}
	return $maxSize;
}

// add a line to the invoice/estimate
function addLine( $ligne, $tab )
{
	global $colonnes, $format;

	$ordonnee     = 10;
	$maxSize      = $ligne;

	reset( $colonnes );
	while ( list( $lib, $pos ) = each ($colonnes) )
	{
		$longCell  = $pos -2;
		$texte     = $tab[ $lib ];
		$length    = $this->GetStringWidth( $texte );
		$tailleTexte = $this->sizeOfText( $texte, $length );
		$formText  = $format[ $lib ];
		$this->SetXY( $ordonnee, $ligne-1);
		$this->MultiCell( $longCell, 4 , $texte, 0, $formText);
		if ( $maxSize < ($this->GetY()  ) )
			$maxSize = $this->GetY() ;
		$ordonnee += $pos;
	}
	return ( $maxSize - $ligne );
}

function addRemarque($remarque)
{
	$this->SetFont( "Helvetica", "", 10);
	$length = $this->GetStringWidth( " " . $remarque );
	$r1  = 10;
	$r2  = $r1 + $length;
	$y1  = $this->h - 45.5;
	$y2  = $y1+5;
	$this->SetXY( $r1 , $y1 );
	$this->Multicell(80,4,  $remarque);
}

function addCadreTVAs()
{
/*
	$this->SetFont( "Arial", "B", 8);
	$r1  = 10;
	$r2  = $r1 + 120;
	$y1  = $this->h - 40;
	$y2  = $y1+20;
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1, $y1+4, $r2, $y1+4);
	$this->Line( $r1+5,  $y1+4, $r1+5, $y2); // avant BASES HT
	$this->Line( $r1+27, $y1, $r1+27, $y2);  // avant REMISE
	$this->Line( $r1+43, $y1, $r1+43, $y2);  // avant MT TVA
	$this->Line( $r1+63, $y1, $r1+63, $y2);  // avant % TVA
	$this->Line( $r1+75, $y1, $r1+75, $y2);  // avant PORT
	$this->Line( $r1+91, $y1, $r1+91, $y2);  // avant TOTAUX
	$this->SetXY( $r1+9, $y1);
	$this->Cell(10,4, "BASES HT");
	$this->SetX( $r1+29 );
	$this->Cell(10,4, "REMISE");
	$this->SetX( $r1+48 );
	$this->Cell(10,4, "MT TVA");
	$this->SetX( $r1+63 );
	$this->Cell(10,4, "% TVA");
	$this->SetX( $r1+78 );
	$this->Cell(10,4, "PORT");
	$this->SetX( $r1+100 );
	$this->Cell(10,4, "TOTAUX");
	$this->SetFont( "Arial", "B", 6);
	$this->SetXY( $r1+93, $y2 - 8 );
	$this->Cell(6,0, "H.T.   :");
	$this->SetXY( $r1+93, $y2 - 3 );
	$this->Cell(6,0, "T.V.A. :");
*/
}

function addCadreEurosFrancs()
{
	$r1  = $this->w - 70;
	$r2  = $r1 + 60;
	$y1  = $this->h - 40;
	$y2  = $y1+20;
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1+20,  $y1, $r1+20, $y2); // avant EUROS
	$this->Line( $r1+20, $y1+4, $r2, $y1+4); // Sous Euros & Francs
	$this->Line( $r1+38,  $y1, $r1+38, $y2); // Entre Euros & Francs
	$this->SetFont( "Arial", "B",8 );
	$this->SetXY( $r1+22, $y1 );
	$this->Cell(15,4, "EURO", 0, 0, "C");
	$this->SetFont( "Arial", "", 8);
	$this->SetXY( $r1+42, $y1 );
	$this->Cell(15,4, "LIRE", 0, 0, "C");
	$this->SetFont( "Arial", "B", 8);
	$this->SetXY( $r1, $y1+5 );
	$this->Cell(20,4, "Totale ", 0, 0, "C");
	$this->SetXY( $r1, $y1+10 );
	$this->Cell(20,4, "Bollo", 0, 0, "C");
	$this->SetXY( $r1, $y1+15 );
	$this->Cell(20,4, "da pagare", 0, 0, "C");
}
function addCadreEurosFrancs2($soldi)
{
	$r1  = $this->w - 70;
	$r2  = $r1 + 60;
	$y1  = $this->h - 40;
	$y2  = $y1+10;
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1+20,  $y1, $r1+20, $y2); // avant EUROS
	$this->Line( $r1+20, $y1+4, $r2, $y1+4); // Sous Euros & Francs
	$this->Line( $r1+38,  $y1, $r1+38, $y2); // Entre Euros & Francs
	$this->SetFont( "Arial", "B",8 );
	$this->SetXY( $r1+22, $y1 );
	$this->Cell(15,4, "EURO", 0, 0, "C");
	$this->SetFont( "Arial", "", 8);
	$this->SetXY( $r1+42, $y1 );
	$this->Cell(15,4, "LIRE", 0, 0, "C");
	$this->SetFont( "Arial", "B", 8);
	$this->SetXY( $r1, $y1+5 );
	$this->Cell(20,4, "Totale ", 0, 0, "C");
	$this->SetXY( $r1+25, $y1+5 );
	$this->Cell(20,4, $soldi, 0, 0, "L");
	$this->SetXY( $r1+45, $y1+5 );
	$this->Cell(20,4, $soldi*1936.27, 0, 0, "L");
}

// remplit les cadres TVA / Totaux et la remarque
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
function addTVAs( $params, $tab_tva, $invoice, $assicurazione )
{
	$this->SetFont('Arial','',8);
	
	reset ($invoice);
	$px = array();
	while ( list( $k, $prod) = each( $invoice ) )
	{
		$tva = $prod["tva"];
		@ $px[$tva] += $prod["qte"] * $prod["px_unit"];
	}

	$prix     = array();
	$totalHT  = 0;
	$totalTTC = 0;
	$totalTVA = 0;
	$y = 261;
	reset ($px);
	natsort( $px );
	while ( list($code_tva, $articleHT) = each( $px ) )
	{
		$tva = $tab_tva[$code_tva];
		$this->SetXY(17, $y);
//		$this->Cell( 19,4, sprintf("%0.2f", $articleHT),'', '','R' );
		if ( $params["RemiseGlobale"]==1 )
		{
			if ( $params["remise_tva"] == $code_tva )
			{
				$this->SetXY( 37.5, $y );
				if ($params["remise"] > 0 )
				{
					if ( is_int( $params["remise"] ) )
						$l_remise = $param["remise"];
					else
						$l_remise = sprintf ("%.02f", $params["remise"]);
//					$this->Cell( 14.5,4, $l_remise, '', '', 'R' );
					$articleHT -= $params["remise"];
				}
				else if ( $params["remise_percent"] > 0 )
				{
					$rp = $params["remise_percent"];
					if ( $rp > 1 )
						$rp /= 100;
					$rabais = $articleHT * $rp;
					$articleHT -= $rabais;
					if ( is_int($rabais) )
						$l_remise = $rabais;
					else
						$l_remise = sprintf ("%.02f", $rabais);
//					$this->Cell( 14.5,4, $l_remise, '', '', 'R' );
				}
				else
					$this->Cell( 14.5,4, "ErrorRem", '', '', 'R' );
			}
		}
		$totalHT += $articleHT;
		$totalTTC += $articleHT * ( 1 + $tva/100 );
		$tmp_tva = $articleHT * $tva/100;
		$a_tva[ $code_tva ] = $tmp_tva;
		$totalTVA += $tmp_tva;
		$y+=4;
	}

	if ( $params["FraisPort"] == 1 )
	{
		if ( $params["portTTC"] > 0 )
		{
			$pTTC = sprintf("%0.2f", $params["portTTC"]);
			$pHT  = sprintf("%0.2f", $pTTC / 1.196);
			$pTVA = sprintf("%0.2f", $pHT * 0.196);
/*			$this->SetFont('Arial','',6);
			$this->SetXY(85, 261 );
			$this->Cell( 6 ,4, "HT : ", '', '', '');
			$this->SetXY(92, 261 );
			$this->Cell( 9 ,4, $pHT, '', '', 'R');
			$this->SetXY(85, 265 );
			$this->Cell( 6 ,4, "TVA : ", '', '', '');
			$this->SetXY(92, 265 );
			$this->Cell( 9 ,4, $pTVA, '', '', 'R');
			$this->SetXY(85, 269 );
			$this->Cell( 6 ,4, "TTC : ", '', '', '');
			$this->SetXY(92, 269 );
			$this->Cell( 9 ,4, $pTTC, '', '', 'R');
			$this->SetFont('Arial','',8);
*/			$totalHT += $pHT;
			$totalTVA += $pTVA;
			$totalTTC += $pTTC;
		}
		else if ( $params["portHT"] > 0 )
		{
			$pHT  = sprintf("%0.2f", $params["portHT"]);
			$pTVA = sprintf("%0.2f", $params["portTVA"] * $pHT / 100 );
			$pTTC = sprintf("%0.2f", $pHT + $pTVA);
			$this->SetFont('Arial','',8);
			$totalHT += $pHT;
			$totalTVA += $pTVA;
			$totalTTC += $pTTC;
		}
	}

	$params["totalHT"] = $totalHT;
	$params["TVA"] = $totalTVA;
	$accompteTTC=0;
	if ( $totalTTC > 77.47) 
        { 
	$params["AccompteExige"] = 1;
	}
	if ( $params["AccompteExige"] == 1 )
	{
		if ( $params["accompte"] > 0 )
		{
			$accompteTTC=sprintf ("%.2f", $params["accompte"]);
			if ( strlen ($params["Remarque"]) == 0 )
				$this->addRemarque( "Accompte de $accompteTTC Euros exigИ Ю la commande.");
			else
				$this->addRemarque( $params["Remarque"] );
		}
		else if ( $params["accompte_percent"] > 0 )
		{
			$percent = $params["accompte_percent"];
			if ( $percent > 1 )
				$percent /= 100;
			$accompteTTC=sprintf("%.2f", $totalTTC * $percent);
			$percent100 = $percent * 100;
			if ( strlen ($params["Remarque"]) == 0 )
				$this->addRemarque( "Accompte de $percent100 % (soit $accompteTTC Euros) exigИ Ю la commande." );
			else
				$this->addRemarque( $params["Remarque"] );
		}
		else
			$this->addRemarque( "DrТle d'acompte !!! " . $params["Remarque"]);
	}
	else
	{
		if ( strlen ($params["Remarque"]) > 0 )
			$this->addRemarque( $params["Remarque"] );
	}
	$re  = $this->w - 50;
	$rf  = $this->w - 29;
	$y1  = $this->h - 40;
	$this->SetFont( "Arial", "", 8);
	$this->SetXY( $re, $y1+5 );
	$this->Cell( 17,4, sprintf("%0.2f", $totalTTC), '', '', 'R');
	$this->SetXY( $re, $y1+10 );
	$this->Cell( 17,4, sprintf("%0.2f", $accompteTTC), '', '', 'R');
	$this->SetXY( $re, $y1+14.8 );
	$this->SetFont( "Arial", "B", 10);
	if ($assicurazione!=12 && $assicurazione!=13 && $assicurazione!=14)	$this->Cell( 17,4, sprintf("%0.2f", $totalTTC + $accompteTTC), '', '', 'R');
	  else 	$this->Cell( 17,4, sprintf("%0.2f", 0), '', '', 'R');

	$this->SetXY( $rf, $y1+5 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell( 17,4, sprintf( "%0.0f", $totalTTC * EURO_VAL), '', '', 'R');
	$this->SetXY( $rf, $y1+10 );
	$this->Cell( 17,4, sprintf("%0.0f", $accompteTTC * EURO_VAL), '', '', 'R');
	$this->SetFont( "Arial", "B", 10);
	$this->SetXY( $rf, $y1+14.8 );
        if ($assicurazione!=12 && $assicurazione!=13 && $assicurazione!=14)	$this->Cell( 17,4, sprintf("%0.0f", ($totalTTC + $accompteTTC) *EURO_VAL), '', '', 'R');
	  else 	$this->Cell( 17,4, sprintf("%0.0f", (0) * EURO_VAL), '', '', 'R');

}

// add a watermark (temporary estimate, DUPLICATA...)
// call this method first
function temporaire( $texte )
{
	$this->SetFont('Arial','B',50);
	$this->SetTextColor(203,203,203);
	$this->Rotate(45,55,190);
	$this->Text(55,190,$texte);
	$this->Rotate(0);
	$this->SetTextColor(0,0,0);
}
#####################AGGIUNTE NOSTRE a invoice.php
/*
function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
                $op='f';
        elseif($style=='FD' or $style=='DF')
                $op='B';
        else
                $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2f %.2f m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l', $xc*$k,($hp-$y)*$k ));
        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
}
function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
  $h = $this->h;
  $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c ', $x1*$this->k, ($h-$y1)*$this ->k, $x2*$this->k, ($h-$y2)*$this->k, $x3*$this-> k, ($h-$y3)*$this->k));
}


function addDate( $date )
{
        $r1  = $this->w - 61;
        $r2  = $r1 + 24;
        $y1  = 17;
        $y2  = $y1 ;
        $mid = $y1 + ($y2 / 2);
        $this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
        $this->Line( $r1, $mid, $r2, $mid);
        $this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
        $this->SetFont( "Helvetica", "B", 10);
        $this->Cell(10,5, "Data", 0, 0, "C");
        $this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+9 );
        $this->SetFont( "Helvetica", "", 10);
        $this->Cell(10,5,$date, 0,0, "C");
}


function addPageNumber( $page )
{
        $r1  = $this->w - 80;
        $r2  = $r1 + 19;
        $y1  = 17;
        $y2  = $y1;
        $mid = $y1 + ($y2 / 2);
        $this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
        $this->Line( $r1, $mid, $r2, $mid);
        $this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
        $this->SetFont( "Helvetica", "B", 10);
        $this->Cell(10,5, "Pagina", 0, 0, "C");
        $this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1 + 9 );
        $this->SetFont( "Helvetica", "", 10);
        $this->Cell(10,5,$page, 0,0, "C");
}



function addClientAdresse( $adresse )
{
        $r1     = $this->w - 80;
        $r2     = $r1 + 68;
        $y1     = 40;
        $this->SetXY( $r1, $y1);
        $this->MultiCell( 60, 4, $adresse);
}

*/


function EAN13($x,$y,$barcode,$h=16,$w=.35)
{
    $this->Barcode($x,$y,$barcode,$h,$w,13);
}

function UPC_A($x,$y,$barcode,$h=16,$w=.35)
{
    $this->Barcode($x,$y,$barcode,$h,$w,12);
}

function GetCheckDigit($barcode)
{
    //Compute the check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    $r=$sum%10;
    if($r>0)
        $r=10-$r;
    return $r;
}

function TestCheckDigit($barcode)
{
    //Test validity of check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    return ($sum+$barcode{12})%10==0;
}

function Barcode($x,$y,$barcode,$h,$w,$len)
{
    //Padding
    $barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
    if($len==12)
        $barcode='0'.$barcode;
    //Add or control the check digit
    if(strlen($barcode)==12)
        $barcode.=$this->GetCheckDigit($barcode);
    elseif(!$this->TestCheckDigit($barcode))
        $this->Error('Incorrect check digit');
    //Convert digits to bars
    $codes=array(
        'A'=>array(
            '0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
            '5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
        'B'=>array(
            '0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
            '5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
        'C'=>array(
            '0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
            '5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
        );
    $parities=array(
        '0'=>array('A','A','A','A','A','A'),
        '1'=>array('A','A','B','A','B','B'),
        '2'=>array('A','A','B','B','A','B'),
        '3'=>array('A','A','B','B','B','A'),
        '4'=>array('A','B','A','A','B','B'),
        '5'=>array('A','B','B','A','A','B'),
        '6'=>array('A','B','B','B','A','A'),
        '7'=>array('A','B','A','B','A','B'),
        '8'=>array('A','B','A','B','B','A'),
        '9'=>array('A','B','B','A','B','A')
        );
    $code='101';
    $p=$parities[$barcode{0}];
    for($i=1;$i<=6;$i++)
        $code.=$codes[$p[$i-1]][$barcode{$i}];
    $code.='01010';
    for($i=7;$i<=12;$i++)
        $code.=$codes['C'][$barcode{$i}];
    $code.='101';
    //Draw bars
    for($i=0;$i<strlen($code);$i++)
    {
        if($code{$i}=='1')
            $this->Rect($x+$i*$w,$y,$w,$h,'F');
    }
    //Print text uder barcode
    $this->SetFont('Arial','',12);
    $this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
}
//ABBIAMO ESTESO LORIGINALE CON LA PARTE CAPACE DI STAMPARE TABELLE

//Load data
function LoadData($file)
{
    //Read file lines
    $lines=file($file);
    $data=array();
    foreach($lines as $line)
        $data[]=explode(';',chop($line));
    return $data;
}

//Simple table
function BasicTable($header,$data)
{
    //Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    //Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

//Better table

function ImprovedTable($header,$data,$tre)
{
    //Column widths
	if(!$tre)
    $w=array(15,18,18,22,22);
	else
	    $w=array(40,40,15);
    //Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,$header[$i],1,0,'C');
   if(!$tre)
   $this->Ln();
   else
   {
     $this->SetXY(105,105);
    //$this->Ln();
   }
	//Data
    foreach($data as $row)
    {
	$spazio=0;
     if(!$tre)
	 {
		$this->Cell($w[0],6,$row[0],1,0,'C');
		$spazio=1;
		}
        $this->Cell($w[0+$spazio],6,$row[0+$spazio],1,0,'C');
        $this->Cell($w[1+$spazio],6,$row[1+$spazio],1,0,'C');
        $this->Cell($w[2+$spazio],6,$row[2+$spazio],1,0,'C');
        if(!$tre)
		$this->Cell($w[3+$spazio],6,$row[3+$spazio],1,0,'C');
		//$this->Cell(25,6,number_format($row[3]),'LR',1,'C');
        $this->Ln();
    if($tre)
     $this->SetX(105);
  
	}
    //Closure line
    $this->Cell(array_sum($w),0,'','T');
}



function ImprovedTable2($header,$data)
{
    //Column widths
	    $w=array(35,35,35,30,45);
	//Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,$header[$i],1,0,'C');

   $this->Ln();
  
	//Data
	  $this->SetX(15);
    foreach($data as $row)
    {
	$spazio=0;
     
		$this->Cell($w[0],6,$row[0],1,0,'C');
		$spazio=1;
        $this->Cell($w[0+$spazio],6,$row[0+$spazio],1,0,'C');
        $this->Cell($w[1+$spazio],6,$row[1+$spazio],1,0,'C');
        $this->Cell($w[2+$spazio],6,$row[2+$spazio],1,0,'C');
		$this->Cell($w[3+$spazio],6,$row[3+$spazio],1,0,'C');
		//$this->Cell(25,6,number_format($row[3]),'LR',1,'C');
        $this->Ln();

  
	}
    //Closure line
	 $this->SetX(15);
    $this->Cell(array_sum($w),0,'','T');
}


function ImprovedTable3($header,$data)
{
    //Column widths
	    $w=array(45,45,45,45);
	//Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,$header[$i],1,0,'C');

   $this->Ln();
  
	//Data
	  $this->SetX(15);
    foreach($data as $row)
    {
	$spazio=0;
     
		$this->Cell($w[0],6,$row[0],1,0,'C');
		$spazio=1;
        $this->Cell($w[0+$spazio],6,$row[0+$spazio],1,0,'C');
        $this->Cell($w[1+$spazio],6,$row[1+$spazio],1,0,'C');
        $this->Cell($w[2+$spazio],6,$row[2+$spazio],1,0,'C');
		//$this->Cell($w[3+$spazio],6,$row[3+$spazio],1,0,'C');
		//$this->Cell(25,6,number_format($row[3]),'LR',1,'C');
        $this->Ln();

  
	}
    //Closure line
	 $this->SetX(15);
    $this->Cell(array_sum($w),0,'','T');
}

function ImprovedTable4($header,$data)
{
    //Column widths
	    $w=array(45,45);
	//Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,$header[$i],1,0,'C');

   $this->Ln();
  
	//Data
	  $this->SetX(10);
    foreach($data as $row)
    {
	$spazio=0;
     
		$this->Cell($w[0],6,$row[0],1,0,'C');
		$spazio=1;
        $this->Cell($w[0+$spazio],6,$row[0+$spazio],1,0,'C');
    
		//$this->Cell($w[3+$spazio],6,$row[3+$spazio],1,0,'C');
		//$this->Cell(25,6,number_format($row[3]),'LR',1,'C');
        $this->Ln();

  
	}
    //Closure line
	 $this->SetX(10);
    $this->Cell(array_sum($w),0,'','T');
}


function ImprovedTable5($header,$data)
{
    //Column widths
	    $w=array(45,45,45,45);
	//Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,$header[$i],1,0,'C');

   $this->Ln();
  
	//Data
	  $this->SetX(15);
    foreach($data as $row)
    {
	$spazio=0;
     
		$this->Cell($w[0],6,$row[0],1,0,'C');
		$spazio=1;
        $this->Cell($w[0+$spazio],6,$row[0+$spazio],1,0,'C');
        $this->Cell($w[1+$spazio],6,$row[1+$spazio],1,0,'C');
		$this->Cell($w[2+$spazio],6,$row[2+$spazio],1,0,'C');
		//$this->Cell($w[3+$spazio],6,$row[3+$spazio],1,0,'C');
		//$this->Cell(25,6,number_format($row[3]),'LR',1,'C');
        $this->Ln();

  
	}
    //Closure line
	 $this->SetX(15);
    $this->Cell(array_sum($w),0,'','T');
}

function ImprovedTable6($header,$data)
{
    //Column widths
	    $w=array(42,25,15);
	//Header
	/*$this->SetFont('Arial','B',12);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,$header[$i],1,0,'C');

   $this->Ln();
  */
	//Data
	  $this->SetX(10);
    foreach($data as $row)
    {
	$spazio=0;
     	$this->SetFont('Arial','B',10);
		$this->Cell($w[0],6,$row[0],1,0,'C');
		$spazio=1;
     	$this->SetFont('Arial','',10);		
        $this->Cell($w[0+$spazio],6,$row[0+$spazio],1,0,'C');
		$this->SetFont('Arial','B',10);
        $this->Cell($w[1+$spazio],6,$row[1+$spazio],1,0,'C');
		//$this->Cell($w[2+$spazio],6,$row[2+$spazio],1,0,'C');
		//$this->Cell($w[3+$spazio],6,$row[3+$spazio],1,0,'C');
		//$this->Cell($w[4+$spazio],6,$row[4+$spazio],1,0,'C');
		//$this->Cell(25,6,number_format($row[3]),'LR',1,'C');
        $this->Ln();

  
	}
    //Closure line
	 $this->SetX(10);
    $this->Cell(array_sum($w),0,'','T');
}
function ImprovedTable6bis($header,$data)
{
    //Column widths
	    $w=array(42,25,15);
	//Header
	/*$this->SetFont('Arial','B',12);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,$header[$i],1,0,'C');

   $this->Ln();
  */
	//Data
	  $this->SetX(100);
    foreach($data as $row)
    {
	$this->SetX(100);
	$spazio=0;
     	$this->SetFont('Arial','B',10);
		$this->Cell($w[0],6,$row[0],1,0,'C');
		$spazio=1;
     	$this->SetFont('Arial','',10);		
        $this->Cell($w[0+$spazio],6,$row[0+$spazio],1,0,'C');
		$this->SetFont('Arial','B',10);
        $this->Cell($w[1+$spazio],6,$row[1+$spazio],1,0,'C');
		//$this->Cell($w[2+$spazio],6,$row[2+$spazio],1,0,'C');
		//$this->Cell($w[3+$spazio],6,$row[3+$spazio],1,0,'C');
		//$this->Cell($w[4+$spazio],6,$row[4+$spazio],1,0,'C');
		//$this->Cell(25,6,number_format($row[3]),'LR',1,'C');
        $this->Ln();

  
	}
    //Closure line
	 $this->SetX(100);
    $this->Cell(array_sum($w),0,'','T');
}

function ImprovedTable7($header,$data)
{
    //Column widths
	    $w=array(40,40,40);
	//Header
	$this->SetFont('Arial','',12);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,$header[$i],1,0,'C');

   $this->Ln();
  
	//Data
	  $this->SetX(40);
    foreach($data as $row)
    {
	$spazio=0;
     	
		$this->Cell($w[0],6,$row[0],1,0,'C');
		$spazio=1;
        $this->Cell($w[0+$spazio],6,$row[0+$spazio],1,0,'C');
        $this->Cell($w[1+$spazio],6,$row[1+$spazio],1,0,'C');
		//$this->Cell($w[2+$spazio],6,$row[2+$spazio],1,0,'C');
		//$this->Cell($w[3+$spazio],6,$row[3+$spazio],1,0,'C');
		//$this->Cell($w[4+$spazio],6,$row[4+$spazio],1,0,'C');
		//$this->Cell(25,6,number_format($row[3]),'LR',1,'C');
        $this->Ln();

  
	}
    //Closure line
	 $this->SetX(40);
    $this->Cell(array_sum($w),0,'','T');
}

//Colored table
function FancyTable($header,$data)
{
    //Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    //Header
    $w=array(40,35,40,45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    //Data
    $fill=0;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill=!$fill;
    }
    $this->Cell(array_sum($w),0,'','T');
}
function Vai_a_capo($testo)
{
global $pdf;

  $j=105;
  
  
  $lunghezza=strlen($testo);
  while ($lunghezza>0)
  {
 
$stringa=substr($testo,$i,$j);
$verifica=substr($stringa,$j,1);

$pippo=0;
while($verifica!=' ')
{
	--$j;
	//echo " VERIFICA ".$verifica;

	$verifica=substr($stringa,$j-1,1);
//echo substr($stringa,$j-1,$j);
//echo " VERIFICA ".$verifica;
//echo " j ".$j;
$pippo++;
if ($pippo>12) break;

}
//echo $j;
$stringa=substr($testo,$i,$j);
//echo "#####".$stringa;

$this->Cell(190,5,$stringa,$border=0,$ln=0,$align='J');
$this->Ln(6);
$i=$i+$j;
//echo " i ".$i;
$lunghezza=($lunghezza-$j);

  $j=105;
 
     }
}
function Vai_a_capo2($testo,$lenght)
{
$testo=str_replace("\\"," ",$testo);
global $pdf;
  if (!$lenght)
  $j=100;
  else
  $j=$lenght;
  
  $lunghezza=strlen($testo);
  while ($lunghezza>0)
  {
 
$stringa=substr($testo,$i,$j);
$verifica=substr($stringa,$j,1);

$pippo=0;
while($verifica!=' ')
{
	--$j;
	//echo " VERIFICA ".$verifica;

	$verifica=substr($stringa,$j-1,1);
//echo substr($stringa,$j-1,$j);
//echo " VERIFICA ".$verifica;
//echo " j ".$j;
$pippo++;
if ($pippo>12) break;

}
//echo $j;
$stringa=substr($testo,$i,$j);
//echo "#####".$stringa;

$this->Cell(190,5,$stringa,$border=0,$ln=0,$align='J');
$this->Ln(6);
$i=$i+$j;
//echo " i ".$i;
$lunghezza=($lunghezza-$j);

if (!$lenght)
  $j=105;
  else
  $j=$lenght;
     }
}
function Vai_a_capo3($testo)
{
global $pdf;

  $j=98;
  
  
  $lunghezza=strlen($testo);
  while ($lunghezza>0)
  {
 
$stringa=substr($testo,$i,$j);
$verifica=substr($stringa,$j,1);

$pippo=0;
while($verifica!=' ')
{
	--$j;
	//echo " VERIFICA ".$verifica;

	$verifica=substr($stringa,$j-1,1);
//echo substr($stringa,$j-1,$j);
//echo " VERIFICA ".$verifica;
//echo " j ".$j;
$pippo++;
if ($pippo>12) break;

}
//echo $j;
$stringa=substr($testo,$i,$j);
//echo "#####".$stringa;

$this->Cell(190,5,$stringa,$border=0,$ln=0,$align='J');
$this->Ln(6);
$i=$i+$j;
//echo " i ".$i;
$lunghezza=($lunghezza-$j);

  $j=98;
 
     }
}
}
?>
