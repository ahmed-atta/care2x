<?php
 error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
 require('./roots.php');
 require($root_path.'include/inc_environment_global.php');
 /**
 * CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
 * GNU General Public License
 * Copyright 2002,2003,2004 Elpidio Latorilla
 * elpidio@latorilla.com
 *
 * See the file "copy_notice.txt" for the licence notice
 */
 define('USE_PIE_CHART',1); // define to 1 if pie chart is preferred as display
 define('PIE_CHART_USED_COLOR','red'); // define the color of the used bed portion of the graph 

 $lang_tables=array('date_time.php'); 
 define('LANG_FILE','nursing.php');
 define('NO_2LEVEL_CHK',1);
 require_once($root_path.'include/inc_front_chain_lang.php');

  /* Load date formatter */
  include_once($root_path.'include/inc_date_format_functions.php'); 
  
  /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so 
 # that the smarty script can use the user configured template theme
 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

 $breakfile='nursing.php'.URL_APPEND;
 $thisfile=basename(__FILE__);

 $today=date('Y-m-d');
 
 // Let us make some interface for calendar class
 if($from=='arch'){
	 if($pday=='') $pday=date('d');
	 if($pmonth=='') $pmonth=date('m');
	 if($pyear=='') $pyear=date('Y');
	 $currDay=$pday;
	 $currMonth=$pmonth;
	 $currYear=$pyear;
 	$s_date=formatDate2STD($pyear.'-'.$pmonth.'-'.$pday,'yyyy-mm-dd'); 
 } else {
	 if($currDay=='') $currDay=date('d');
	 if($currMonth=='') $currMonth=date('m');
	 if($currYear=='') $currYear=date('Y');
	 $pday=$currDay;
	 $pmonth=$currMonth;
	 $pyear=$currYear;
	 # Resolve the date with leading zeroes
 	$s_date=formatDate2STD($pyear.'-'.$pmonth.'-'.$pday,'yyyy-mm-dd'); 
	list($currYear,$currMonth,$currDay)=explode('-',$s_date);
 }

 if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;

 $dbtable='care_ward';

if($s_date<=$today){
 
 # Establish db connection
 if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
 if($dblink_ok) {

	
  # Get the wards' info
  $sql="SELECT nr,ward_id,name,room_nr_start,room_nr_end	FROM $dbtable 
     WHERE is_temp_closed IN ('',0) AND status NOT IN ('hide','delete','void','inactive') AND date_create<='$s_date' ORDER BY nr";
 
  if($wards=$db->Execute($sql)) {
   $rows=$wards->RecordCount();
  } else {
   echo "$sql<br>$LDDbNoRead";
  } 
 
  
  # Get the rooms' info
  $sql="SELECT SUM(r.nr_of_beds) AS maxbed
          FROM $dbtable AS w 
     LEFT JOIN care_room AS r 
            ON r.ward_nr=w.nr
         WHERE w.is_temp_closed IN ('',0) 
           AND w.status NOT IN ('hide','delete','void','inactive')
           AND w.date_create<='$s_date'
         GROUP BY w.nr
         ORDER BY w.nr";
         
  if($rooms=$db->Execute($sql))  {
   $roomcount=$rooms->RecordCount();
  } else {
   echo "$sql<br>$LDDbNoRead";
  } 
  
  # Get the today's occupancy
  $sql="SELECT  COUNT(l.location_nr) AS maxoccbed, w.nr AS ward_nr	
          FROM $dbtable AS w 
     LEFT JOIN care_encounter_location AS l 
            ON l.group_nr=w.nr AND l.type_nr=5 ";
  if($is_today) 
   $sql.=" AND '$s_date'>=l.date_from AND l.date_to IN ('0000-00-00','')";
  else 
   $sql.=" AND '$s_date'>= l.date_from AND '$s_date' <='$today' AND ('$s_date'<=l.date_to OR l.date_to IN ('0000-00-00',''))";
   
  $sql.=" WHERE NOT w.is_temp_closed  AND w.status NOT IN ('hide','delete','void','inactive')   AND w.date_create<='$s_date' ";
  $sql.="	GROUP BY w.nr ORDER BY w.nr";
     
  if($occbed=$db->Execute($sql)) {
   //echo $sql;
   $bedcount=$occbed->RecordCount();
  } else {
   echo "$sql<br>$LDDbNoRead";
  } 
	
 } else { 
  echo "$LDDbNoLink<br>";
  
 } // end if($dblink_ok)

}

 /**
 * HEAD META definition
 */
 $smarty->assign('setCharSet',setCharSet()); 


 /**
 * collect JavaScript for Smarty
 */

 ob_start();
 require($root_path.'include/inc_js_gethelp.php');
 require($root_path.'include/inc_css_a_hilitebu.php');
 $sTemp = ob_get_contents();
 ob_end_clean();
 $smarty->assign('JavaScript',$sTemp); 

 $sTemp = $sid.'&lang='.$lang.'&pday='.$pday.'&pmonth='.$pmonth.'&pyear='.$pyear;
 $smarty->assign('SID_Parameter',$sTemp);
 $smarty->assign('aufnahme_user',$aufnahme_user);

 /**
 * Toolbar (look at header_topblock.tbl)
 */
 
 $smarty->assign('HTMLtag',html_ret_rtl($lang)); 
 
 $smarty->assign('LDNursing',$LDNursing );
 $smarty->assign('Subtitle',$LDQuickView ); // Nursing-Subtitle (header_toblock.tpl)  
 $smarty->assign('top_txtcolor',$cfg['top_txtcolor']);
 $smarty->assign('top_bgcolor',$cfg['top_bgcolor']); 

 # Added for the common header top block
 $smarty->assign('pbBack','javascript:window.history.back()');
 $smarty->assign('gifBack2',createLDImgSrc($root_path,'back2.gif','0') );
 $smarty->assign('pbHelp','javascript:gethelp(\'nursing_how2search.php\',\'\','.$rows.',\'quick\',\'\')');
 
 # Added for the common header top block
 $smarty->assign('gifHilfeR',createLDImgSrc($root_path,'hilfe-r.gif','0') );
 
 $smarty->assign('LDCloseAlt',$LDCloseAlt );
 $smarty->assign('gifClose2',createLDImgSrc($root_path,'close2.gif','0') );
 if($cfg['dhtml']) {
  $smarty->assign('dhtml','style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"');
 } else {
  $smarty->assign('dhtml','');
 }


 $smarty->assign('body_bgcolor',$cfg['body_bgcolor']);

 /*generate the calendar */
 include($root_path.'classes/calendar_jl/class.calendar.php'); 
 /** CREATE CALENDAR OBJECT **/
 $Calendar = new Calendar;
 $Calendar->deactivateFutureDay();


 /** WRITE CALENDAR **/
 ob_start();
 $Calendar -> mkCalendar ($currYear, $currMonth, $currDay);
 $sTemp = ob_get_contents();
 ob_end_clean();
 $smarty->assign('tblCalendar',$sTemp);

 $smarty->assign('gifVarrow',createComIcon($root_path,'varrow.gif','0') );

 /**
 * wards count
 */
 if($rows) {  
 
 // ECHO "DATE".date(Ymd);
 $smarty->assign('LDOld',$LDOld);
 $smarty->assign('LDTodays',$LDTodays);
 $smarty->assign('LDOccupancy',$LDOccupancy);
 $smarty->assign('formatDate2Local',formatDate2Local($pyear.'-'.$pmonth.'-'.$pday,$date_format));

  
  /* Load the common icons */
  $img_mangr=createComIcon($root_path,'man-gr.gif','0');
  $img_mans_gr=createComIcon($root_path,'mans-gr.gif','0','absmiddle');
  $img_mans_red=createComIcon($root_path,'mans-red.gif','0','absmiddle');
  $img_statbel=createComIcon($root_path,'statbel2.gif','0','absmiddle');
  
  
  $randombett=0;
  $randommaxbett=0;
  $frei=0;
  
  $sWardrows = "";     
  
  while ($result=$wards->FetchRow())
  {
    
   $maxbed=$result['room_nr_end']-$result['room_nr_start'];
    
   $roomrow=$rooms->FetchRow();
   $bedrow=$occbed->FetchRow();
   $freebeds=$roomrow['maxbed']-$bedrow['maxoccbed'];
   $frei=floor(($freebeds/$roomrow['maxbed'])*10);
     
   if ($toggler==0) {
    $bgc='ffffcc'; $toggler=1;
   } else {
    $bgc='dfdfdf'; $toggler=0;
   }
  
   /**
   * collect the hole ward block into $sWardrows
   */	
					
   ob_start();
   echo '
     <tr bgcolor="#'.$bgc.'">';
   echo '
        <td align=center><font face="verdana,arial" size="2" ><a href="javascript:statbel(\'1\',\''.$result['nr'].'\',\''.$result['ward_id'].'\')"  title="'.$LDClk2Show.'">';
   echo strtoupper($result['name']).'
        </a>';
   echo '</td>
        <td align=center><font face="verdana,arial" size="2" >
        '.$freebeds.'&nbsp;&nbsp;&nbsp;</td>
        <td align=center><font face="verdana,arial" size="2" color="'.PIE_CHART_USED_COLOR.'">
        ';
   if($bedrow['maxoccbed']) echo $bedrow['maxoccbed'];
   echo '&nbsp;&nbsp;&nbsp;</td>
        ';
   echo '
        <td align="center">';
   if(defined('USE_PIE_CHART')&&USE_PIE_CHART){
    echo '<img src="occupancy_pie_chart.php?qouta='.($roomrow['maxbed']-$bedrow['maxoccbed']).'&used='.$bedrow['maxoccbed'].'&bgc='.$bgc.'&uc='.PIE_CHART_USED_COLOR.'">';
   }else{
       for ($n=0;$n<(10-$frei);$n++) echo '<img '.$img_mans_red.'>';
       for ($n=0;$n<$frei;$n++) echo '<img '.$img_mans_gr.'>';
   }
   
   echo '
    </td><td align=center>
      <font face="verdana,arial" size="2" >'.$roomrow['maxbed'].'
    </td>
    </td>
    <td align=center> <a href="javascript:statbel(\'1\',\''.$result['nr'].'\',\''.$result['ward_id'].'\')">
	';
	
    if ($is_today) echo '<img '.$img_statbel.' alt="'.str_replace("~station~",$result['name'],$LDEditStation).'" border="0">';
    
	echo '
    </a>
    </td>
  </tr>';
   
   $sWardrows = $sWardrows . ob_get_contents();
   ob_end_clean();
  
  } // end While
  
 $smarty->assign('LDNrUnocc',$LDNrUnocc);
 $smarty->assign('gifImg_mangr',$img_mangr);
 $smarty->assign('LDStation',$LDStation);
 $smarty->assign('LDFreeBed',$LDFreeBed);
 $smarty->assign('PIE_CHART_USED_COLOR',PIE_CHART_USED_COLOR);
 $smarty->assign('LDOccupied',$LDOccupied);
 $smarty->assign('LDOccupancy',$LDOccupancy);
 $smarty->assign('LDBedNr',$LDBedNr);
 $smarty->assign('LDOptions',$LDOptions);

 $smarty->assign('WardRows',$sWardrows); 
  
 } // if ($rows)

 /**
 * ========= start with GUI - Block =======================
 */




 //$smarty->assign('maxbed',$roomrow['maxbed']); 
 //$smarty->assign('LINKstatbel','javascript:statbel(\'1\',\''.$result['nr'].'\',\''.$result['ward_id'].'\')' );
 //$smarty->assign('altImg_statbel',str_replace("~station~",$result['name'],$LDEditStation));
 //$smarty->assign('gifImg_statbel',$img_statbel); 

 /**
 * IF ($is_today)
 */
 $smarty->assign('is_today',$is_today); 
 $smarty->assign('gifBul_arrowgrnlrg',createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle') );  
 $smarty->assign('gifMascot1_r',createMascot($root_path,'mascot1_r.gif','0','absmiddle') );
 $smarty->assign('LDNoOcc',$LDNoOcc); 
 $smarty->assign('LDClk2Archive',$LDClk2Archive);  

 $smarty->assign('nRows',$rows);
 
 /**
 * IF ($from == "arch")
 */
 $smarty->assign('from',$from);
 $smarty->assign('LINKArchiv','nursing-station-archiv.php'.URL_APPEND.'&pyear='.$pyear.'&pmonth='.$pmonth);
 $smarty->assign('pbBack2',createLDImgSrc($root_path,'back2.gif','0') );
 /* ELSE */
 $smarty->assign('pbClose2',createLDImgSrc($root_path,'close2.gif','0') );
 $smarty->assign('breakfile',$breakfile);
 
 
 $smarty->assign('bot_bgcolor',$cfg['bot_bgcolor']);


 /**
 * show Copyright
 * managed in smarty_care.class.php
 */
 $smarty->assign('sCopyright',$smarty->Copyright());
 $smarty->assign('sPageTime',$smarty->Pagetime());

 /**
 * show Template
 */
 
 $smarty->display('file:nursing/nursing-schnellansicht.tpl');
// $smarty->display('debug.tpl');
?>
