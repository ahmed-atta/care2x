<?

$areaopt=array();

$areaopt['']="";
$areaopt['all']="Alle Bereiche";
$areaopt['m0']="M0";
$areaopt['m1']="M1";
$areaopt['m2']="M2";
$areaopt['m3']="M3";
$areaopt['m4']="M4";
$areaopt['m5']="M5";
$areaopt['m6']="M6";
$areaopt['m7']="M7";
$areaopt['m8']="M8";
$areaopt['m9']="M9";
$areaopt['all_m']="Alle M Stationen";
$areaopt['p1']="P1";
$areaopt['p2']="P2";
$areaopt['p3']="P3";
$areaopt['p4']="P4";
$areaopt['p5']="P5";
$areaopt['all_p']="All P Stationen";
$areaopt['wards']="All Stationen";
$areaopt['op_room']="OR";
$areaopt['all_op_room']="Alle OP's";
$areaopt['lab_read']="Labor (nur lesen)";
$areaopt['lab_write']="Labor (Eingabe)";
$areaopt['tech']="Technik";
$areaopt['acct']="Lohn-Buchhaltung";
$areaopt['personell']="Personalabteilung";
$areaopt['cafe']="Cafeteria";
$areaopt['admit']="Aufnahme";
$areaopt['medocs']="Medocs";
$areaopt['duty_op']="OP Dienstplan";
$areaopt['doc']="Ärzte";
$areaopt['doc_op']="OP Ärzte";
$areaopt['pharma']="Apotheke";
$areaopt['meddepot']="Medicallager";
$areaopt['radio']="Radiologie";
$areaopt['news']="Redaktion";


function createselecttable($itemselect)
{
	global $areaopt;

	while(list($k,$v)=each($areaopt))
	{
		print '<option value="'.$k.'" ';
		if ($itemselect==$k) print "selected";
		print '>'.$v.'</option>';
	}
	reset($areaopt);
}
?>
