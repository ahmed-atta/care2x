<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('__DEBUG_HOST__',false); // for debug

define('LANG_FILE','aufnahme.php');
$local_user='medocs_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences
$thisfile='medostart.php';
$breakfile='medopass.php?sid='.$sid.'&lang='.$lang;

if ((substr($searchkey,0,1)=='%')||(substr($searchkey,0,1)=='&')) {header("Location: $thisfile?sid=$sid&lang=$lang"); exit;}; 

/* ---- Begin routines ---- */
 
/**
 * MEDOC_ functions by Agus Ramdan 
 */
function MEDOC_Mode_Search(){

   global $link, $searchkey , $newpatfound ,  $rows  ,$newpatfound,
          $insurance_xtra ,$sex, $diagnosis_1, $therapy_1 ,$keynumber ,
          $informed ,$result , $fetchdept, $ergebnis, $LDDbNoRead ;
   
   $dbtable='care_admission_patient';

   if(is_numeric($searchkey)){
   
       $searchkey=(int)$searchkey;

       if($searchkey<20000000) $searchkey=$searchkey+20000000;

       $sql="SELECT * FROM $dbtable WHERE patnum=$searchkey";
       //$isnumeric=1;
   }
   else{

       $sql='SELECT * FROM '.$dbtable.' WHERE  name="'.$searchkey.'"';

   } // if(is_numeric($searchkey))

   if($ergebnis=mysql_query($sql,$link)){

       if (__DEBUG_HOST__ ) echo  "sql: $sql <br>";
        
       if(($rows = @mysql_num_rows($ergebnis)) < 1){
       
       //  if not found find similar
           $sql="SELECT * FROM ".$dbtable.
                " WHERE  name LIKE '".trim($searchkey)."%'
                 OR vorname LIKE '".trim($searchkey)."%'";
           $ergebnis=@mysql_query($sql,$link);
           $rows = ($ergebnis)?@mysql_num_rows($ergebnis):0;
       } //if($rows)
   }
   else {
       echo $LDDbNoRead."<p> $sql <p>";
   }//if($ergebnis=mysql_query($sql,$link))

   if (__DEBUG_HOST__ ) echo  "sql: $sql <br>";
   
   if($rows==1){

       $result=mysql_fetch_array($ergebnis);
       $newpatfound=1;

       if (__DEBUG_HOST__ ) echo  "fetchdept: $fetchdept <br>";

       if($fetchdept){
           $result[insurance_xtra]=$insurance_xtra;
           $result[sex]=$sex;
           $result[diagnosis_1]=$diagnosis_1;
           $result[therapy_1]=$therapy_1;
           $result[keynumber]=$keynumber;
           $result[informed]=$informed;
        }// if($fetchdept)
     } // if($rows==1)
} // end of 'MEDOC_Mode_Search' function

/**
*
 */
function MEDOC_Mode_Update(){

   global $link, $doc_no, $result,$rows, $newpatfound, $result, $LDDbNoRead ;
   $dbtable='care_medocs';
   
   $sql="SELECT * FROM $dbtable WHERE   doc_no='$doc_no'";
   if($ergebnis=mysql_query($sql,$link)){
               //echo $sql;
        // garanty rows must 1 or 0  if u using new tec. of database
       $rows =  ($result=mysql_fetch_array($ergebnis))?$newpatfound=1:0 ;
   }
   else {
       echo $LDDbNoRead."<p> $sql <p>";
   }// if($ergebnis=mysql_query($sql,$link))
} // end of MEDOC_Mode_Update()

/**
*
*/
function MEDOC_Mode_Select(){
   global $link,$n, $ln, $fn, $bd,$rows,$result ,$newpatfound, $LDDbNoRead, $item ;

   $dbtable='care_admission_patient';
/*   $sql='SELECT * FROM '.$dbtable.' WHERE patnum="'.$n.'" AND name="'.$ln.'"
                                                   AND vorname="'.$fn.'"    AND gebdatum="'.$bd.'"';
*/
   $sql='SELECT * FROM '.$dbtable.' WHERE item="'.$item.'"';
   
   if($ergebnis=mysql_query($sql,$link)){
       if($rows = @mysql_num_rows($ergebnis)){
           $result=mysql_fetch_array($ergebnis);
           $newpatfound=1;
       }
   }
   else {
       echo $LDDbNoRead."<p> $sql <p>";
   } // if($ergebnis=mysql_query($sql,$link))
   //echo $sql;
} // end of MEDOC_Mode_Select()

/**
*
*/
function MEDOC_Mode_SaveOk(){

   global $link,$n, $ln, $fn, $bd,$rows,$result ,$newpatfound,$docn, $LDDbNoRead ;

   $dbtable='care_medocs';
   $sql="SELECT * FROM $dbtable WHERE   doc_no= $docn";  //dept='$dept' AND
   
   if (__DEBUG_HOST__ ){
        echo "sql SaveOk  $sql<br>" ;
   }
   
   if($ergebnis=mysql_query($sql,$link)){
       if($rows= @mysql_num_rows($ergebnis)){

           $result=mysql_fetch_array($ergebnis);

       } //if($rows)
   } // if($ergebnis=mysql_query($sql,$link))
   else {
       echo $LDDbNoRead."<p> $sql <p>";
   } //if($ergebnis=mysql_query($sql,$link))
}   //end of MEDOC_Mode_SaveOk()

/**
*
*/
function MEDOC_Mode_Save(){

   global $link, $searchkey , $dbtable, $rows  ,$newpatfound ,$keynumber ,
          $result , $HTTP_COOKIE_VARS, $local_user,$ts,$sid ,$update, $lastname,
          $firstname, $birthdate,$sex, $address , $insurance , $insurance_xtra ,
          $informed, $diagnosis_1 ,$therapy_1, $diagnosis_2, $therapy_2,
          $diagnosis_3, $therapy_3,$dept,$lang,$doc_no,$patient_no,$date_format;
          
   $dbtable='care_medocs';
   if( __DEBUG_HOST__) echo "update: $update <br>";
   if($update){

	  $sql="UPDATE $dbtable SET lastname='$lastname',	firstname='$firstname',
											birthdate='$birthdate',	sex='$sex',
											address='$address',		insurance='$insurance',
											insurance_xtra='$insurance_xtra',
											informed='$informed',	diagnosis_1='".htmlspecialchars($diagnosis_1)."',
											therapy_1='".htmlspecialchars($therapy_1)."',	diagnosis_2='".htmlspecialchars($diagnosis_2)."',
											therapy_2='".htmlspecialchars($therapy_2)."',	diagnosis_3='".htmlspecialchars($diagnosis_3)."',
											therapy_3='".htmlspecialchars($therapy_3)."',	modify_id='".$HTTP_COOKIE_VARS[$local_user.$sid]."' 
										    WHERE doc_no='$doc_no'";
											
       if($ergebnis=mysql_query($sql,$link)){

           mysql_close($link);
           if (!__DEBUG_HOST__ ){
               header("Location: $thisfile?sid=$sid&lang=$lang&mode=saveok&dept=$dept&docn=$doc_no");
           }
           else {
              echo "<a href=\"$thisfile?sid=$sid&lang=$lang&mode=saveok&dept=$dept&docn=$doc_no\" >$thisfile?sid=$sid&lang=$lang </a>";
           }
           exit;
       }
       else {
            echo "$LDDbNoSave<p> $sql <p>";
       } // if($ergebnis=mysql_query($sql,$link)){
   }
   else{
       if (__DEBUG_HOST__ )  {
           echo "HTTP_COOKIE_VARS[$local_user.$sid] ".$HTTP_COOKIE_VARS[$local_user.$sid];
       }
		$sql="INSERT INTO $dbtable
							(	dept,			   enc_date,	patient_no,
								lastname,	    firstname,	birthdate,
								sex,			     address,	insurance,
								insurance_xtra,	informed,	diagnosis_1,
								therapy_1,		diagnosis_2, therapy_2,
								diagnosis_3,  therapy_3,		keynumber,
								create_time,	create_id
							 ) 
							VALUES 
							(	'$dept',		'".date("Y-m-d H:i:s")."', '$patient_no',
								'$lastname',	'$firstname',	'".$birthdate."', 
								'$sex', 			'$address',		'$insurance', 
								'$insurance_xtra', '$informed',	'".htmlspecialchars($diagnosis_1)."', 
								'".htmlspecialchars($therapy_1)."',  '".htmlspecialchars($diagnosis_2)."',	'".htmlspecialchars($therapy_2)."', 
								'".htmlspecialchars($diagnosis_3)."',	'".htmlspecialchars($therapy_3)."',	'$keynumber',
								NULL,	'".$HTTP_COOKIE_VARS[$local_user.$sid]."'
							)";
	   if (__DEBUG_HOST__ )  echo "sql: $sql <br>dn $dn <br>";
       if ($ergebnis=mysql_query($sql,$link)){

           $dn = @mysql_insert_id($link);
           if (__DEBUG_HOST__ )  echo "dn $dn";

           mysql_close($link);
           if (!__DEBUG_HOST__ ){
           
               header("Location: $thisfile?sid=$sid&lang=$lang&mode=saveok&dept=$dept&docn=$dn");
           }
           else {
               echo "<a href=\"$thisfile?sid=$sid&lang=$lang&mode=saveok&dept=$dept&docn=$dn\">$thisfile?sid=$sid&lang=$lang </a>";
           }
           exit;
       }
       else {
             echo "$LDDbNoSave<p> $sql <p>";
       }//if (@mssql_rows_affected($link)> 0)
   }// if($update)
}// MEDOC_Mode_Save

/**
 *
 */

function MEDOC_Mode_Init(){

   global $patient_no,$dept,$HTTP_COOKIE_VARS, $thisfile, $sid, 
             $lang,$searchkey,$firstname,$lastname,$mode, $fetchdept;

   if(($mode=='save')&&($dept==""))
   {
       if($patient_no)
	   {
           if($HTTP_COOKIE_VARS['ck_thispc_dept'])             $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
             elseif($HTTP_COOKIE_VARS['ck_thispc_station']) $dept=$HTTP_COOKIE_VARS['ck_thispc_station'];
               elseif($HTTP_COOKIE_VARS['ck_thispc_room'])  $dept=$HTTP_COOKIE_VARS['ck_thispc_room'];
                 else {
				           $mode="search";
						   
                           if($patient_no) $searchkey=$patient_no;
						   
                           $fetchdept=1;
                        }
	   }
	   else
	     {
               $mode="search";
               if($lastname)  
			   {
			      $searchkey=$lastname;
               }
			     elseif($firstname) 
				  {
				     $searchkey=$firstname;
                  }
				   else
				        {
                            if (!__DEBUG_HOST__ )
							{
                               header("Location: $thisfile?sid=$sid&lang=$lang");
                            }
                             else {
                                       echo "<a href=\"$thisfile?sid=$sid&lang=$lang\" >$thisfile?sid=$sid&lang=$lang </a>";
                                    }
                           exit;
                         }
        } // end of if($patient_no)
    }
} // end of MEDOC_Mode_Init

/* ================== main program starts here */

if(isset($mode)&&$mode)
{
    MEDOC_Mode_Init();
	
	include_once('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
	{	
	
	    /* Load date formatter */
        include_once('../include/inc_date_format_functions.php');
        
		
		/* Load editor functions */
		//include_once('../include/inc_editor_fx.php');
		
		switch($mode)
		{
			case 'search': MEDOC_Mode_Search();	 break;
			case 'update': MEDOC_Mode_Update(); break;
			case 'select':  MEDOC_Mode_Select();   break;
			case 'save':    MEDOC_Mode_Save(); 	   break;
			case 'saveok': MEDOC_Mode_SaveOk();	break;
			default:  header("location:medostart.php?sid=$sid&lang=$lang"); // restart fresh again
                  	     exit;
		} // end of switch
		
  	}
  	 else { echo "$LDDbNoLink<br>"; } 
} // end of if($mode

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
 <script language="JavaScript">
<!-- Script Begin
var iscat=<?php if($mode) echo 'false'; else echo 'true'; ?>;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
}

function loadcat()
{
  cat=new Image();
  cat.src="../imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person=<?php echo strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+");?>";
  pix=new Image();
  pix.src="../gui/img/common/default/pixel.gif";
}

function showcat()
{
	if(iscat)
	{
		hidecat();
		return;
	}
	else
	{
	if(document.images) document.catcom.src=cat.src;
	iscat=true;
	}
}

function hilite(idx,mode) {

if(mode==1) idx.filters.alpha.opacity=100
else idx.filters.alpha.opacity=70;

}
function setDay(d)
{
	var h="<?php echo date("d.m.Y"); ?>";
	switch(d.value)
	{
		case "h": d.value=h; break;
		case "H": d.value=h; break;
		case "g": d.value=g; break;
		case "G": d.value=g; break;
		default: d.value="";
	}
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//  Script End -->
</script>
<style type="text/css" name=cat>

div.cats{
	position: absolute;
	right: 10;
	top: 80;
}
</style>
<?php 
require('../include/inc_css_a_hilitebu.php');
?> 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" onLoad="if(window.focus) window.focus();loadcat();
<?php if(!$fetchdept) echo 'document.medocsform.searchkey.select()'; ?>">


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=5  FACE="Arial">
<STRONG>&nbsp;<?php echo $LDMEDOCS ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('medocs_how2new.php','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor'] ?>" valign=top colspan=2><p><br>

<div class="cats">
<a href="javascript:hidecat();<?php if(!$fetchdept) echo "document.medocsform.searchkey.select()"; ?>">
<?php if(($mode!="@"))echo'
<img src="../gui/img/common/default/pixel.gif" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
else echo '
<img src="../imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
?>
</a>
</div>

<ul>

<?php if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo str_replace("~nr~",$rows,$LDFoundData); ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
     <?php
for($j=0;$j<sizeof($LDElements);$j++)
		echo '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDElements[$j].'</b></td>';
	?>
 </tr>
 <?php 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	if($result['dept']=="lastdocnumber") continue;
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  //$buf="medostart.php?sid=$sid&lang=$lang&mode=select&n=".$result['patnum']."&ln=".strtr($result['name']," ","+")."&fn=".strtr($result['vorname']," ","+")."&bd=".$result['gebdatum'];
  $buf="medostart.php?sid=$sid&lang=$lang&mode=select&item=".$result['item'];
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.createComIcon('../','r_arrowgrnsm.gif','0').'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['vorname'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.formatDate2Local($result['gebdatum'],$date_format).'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['patnum'].'</a>&nbsp;&nbsp;</td>
     <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.formatDate2Local($result['pdate'],$date_format).'</a>&nbsp;&nbsp;</td>
 </tr>
  <tr bgcolor=#0000ff>
  <td colspan=6 height=1><img src="../gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>

<?php endif ?>

<?php if(!$fetchdept) : ?>

    <?php if(!$rows) 
       {
    ?>
          <table border=0>
          <tr>
            <td valign="bottom"><img <?php echo createComIcon('../','angle_down_l.gif','0') ?>></td>
            <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
            <td><img <?php echo createMascot('../','mascot1_l.gif','0','absmiddle') ?>></td>
          </tr>
          </table>
    <?php
      }
     ?>
	<form action="<?php echo $thisfile; ?>" method="post" name="medocsform">
	<FONT    SIZE=2  FACE="Arial"><?php echo $LDNewDocu ?>:<br>
	<input type="text" name="searchkey" size=40 maxlength=40>
<!-- 	<input type="submit" value="<?php echo $LDSearch ?>">
 -->	<input type="image" <?php echo createLDImgSrc('../','searchlamp.gif','0','absmiddle') ?>>
 <input type="hidden" name="sid" value="<?php echo $sid; ?>">
	<input type="hidden" name="lang" value="<?php echo $lang; ?>">
	<input type="hidden" name="mode" value="search">
	</form>
<?php endif ?>

<?php // if(($rows==1)||($mode=="?")||($mode=="")) :?>
<?php if($rows==1) :?>

<FORM method="post" action="medostart.php" name="medocsdataform">
<TABLE  <?php if($mode=="saveok") echo "bgcolor=#fcfcfc"; else echo "bgcolor=#000000"; ?> CELLPADDING=1 CELLSPACING=0>
<TR><TD > 
<TABLE  CELLPADDING=2 CELLSPACING=0 border=0>
<?php if($fetchdept)
	{
?>

    	<tr  bgcolor=#dfdfdf>
		<td><img <?php echo createMascot('../','mascot1_r.gif','0') ?>>
		</td>
     	 <td colspan=3>
		 <FONT    SIZE=2  FACE="Arial" color="#dd000">
<?php
     echo $LDPlsEnterDept.'<br>
				<input type="text" name="dept" size=15 maxlength=20>
				<input type="submit" value="'.$LDOkSaveNow.'">';
?>
		</td>
    	</tr>
		<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<?php
    }
?>  
<TR VALIGN="baseline"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDLastName ?>:</TD>
	<TD> 
	<?php 
	 if($mode=="saveok") echo '
	 	<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.ucfirst($result['lastname']).'</b>'; 
	 elseif($newpatfound)
	 {
	   echo '
	 	<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.ucfirst($result['name'].$result['lastname']).'</b>
  		<INPUT NAME="lastname" TYPE="hidden" VALUE="'.$result['name'].$result['lastname'].'">';
	}
	 else
	 {
	  echo '
	 	<INPUT NAME="lastname" TYPE="text" VALUE="'.$result['name'].$result['lastname'].'" SIZE="30">';
	 }
	 ?><BR>
				</TD>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDCaseNr ?>:</TD>
	<TD>
	<?php if($mode!="")
	{ echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result['patient_no'].$result['patnum'];
		 echo '<input type="hidden" name="patient_no" value="'.$result['patnum'].'">';
	}   
	 else echo '<INPUT NAME="patient_no" TYPE="text" VALUE="'.$result['patnum'].'" SIZE="30">';
	 ?>
	 <BR></TD>
	</TR>

<TR VALIGN="baseline" bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDFirstName ?>:</TD>
	<TD colspan=3> 
	<?php 
		if($mode=="saveok") echo '
			<FONT    SIZE=2  FACE="Arial" color="#80000">'.ucfirst($result['firstname']); 
		elseif($newpatfound) echo '
			<FONT    SIZE=2  FACE="Arial" color="#80000">'.ucfirst($result['vorname'].$result['firstname']).'
			<INPUT NAME="firstname" TYPE="hidden" VALUE="'.$result['vorname'].$result['firstname'].'">';
		else echo '
			<INPUT NAME="firstname" TYPE="text" VALUE="'.$result['vorname'].$result['firstname'].'" SIZE="30">';
	?><BR>
				</TD>
	</TR>
	
<TR VALIGN="baseline"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDBday ?></TD>
	<TD> <?php 
	            if($result['gebdatum']) $bdbuffer=$result['gebdatum'];
				 elseif($result['birthdate']) $bdbuffer=$result['birthdate'];
				if($mode=="saveok") echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.formatDate2Local($result['birthdate'],$date_format); 
				elseif($newpatfound) echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.formatDate2Local($bdbuffer,$date_format).'
													<INPUT NAME="birthdate" TYPE="hidden" VALUE="'.$bdbuffer.'">';
				 else echo '<INPUT NAME="birthdate" TYPE="text" VALUE="'.formatDate2Local($bdbuffer,$date_format).'" SIZE="30">';
			?>
				<BR>
				</TD>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDInsurance ?>:</TD>
	<TD> <?php 
				if($mode=="saveok") echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.ucfirst($result['insurance']); 
				elseif($newpatfound) echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result['kassename'].$result['insurance'].'
													<INPUT NAME="insurance" TYPE="hidden" VALUE="'.$result['kassename'].$result['insurance'].'">';
				 else echo '<INPUT NAME="insurance" TYPE="text" VALUE="'.$result['kassename'].$result['insurance'].'" SIZE="30">';
			?>
				<BR>
				</TD>
<TR VALIGN="top" bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDAddress ?>:</TD>
	<TD> <?php 
				if($mode=="saveok") echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['address']); 
				elseif($newpatfound) echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['address']).'
													<INPUT NAME="address" TYPE="hidden" VALUE="'.$result['address'].'">';
				 else echo '<TEXTAREA NAME="address" Content-Type="text/html"	COLS="28" ROWS="3">'.$result['address'].'</TEXTAREA>';
			?>
				<BR>
				</TD>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDExtraInfo ?>:</TD>
	<TD ><?php if($mode=="saveok") echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['insurance_xtra']); else echo '<TEXTAREA NAME="insurance_xtra" Content-Type="text/html"
	COLS="28" ROWS="3">'.$result['insurance_xtra'].'</TEXTAREA>';?></TD></TR>
<TR>
<TR VALIGN="baseline" bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDSex ?></TD>
	<TD colspan=3>
	<?php if($mode=="saveok")
	{  echo '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result['sex']=="m") echo $LDMale; else echo $LDFemale;
	}
	elseif($newpatfound)
	{  echo '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result['sex']=="m") echo $LDMale; else echo $LDFemale;
		echo '<INPUT NAME="sex" TYPE="hidden" VALUE="'.$result['sex'].'">';
	}
	else
	{ echo '<FONT    SIZE=2  FACE="Arial">
	<INPUT NAME="sex" TYPE="radio" VALUE="m" ';
	if ($result['sex']=="m") echo "checked";
	echo '> '.$LDMale.'&nbsp;
	<INPUT NAME="sex" TYPE="radio" VALUE="f" ';
	 if ($result['sex']=="f") echo "checked";
	echo '> '.$LDFemale.'<BR>
	</TD></TR>';
	}
	?>

<TR VALIGN="top" bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDMedAdvice ?>:</TD>
	<TD colspan=3>
	<?php if($mode=="saveok")
	{  echo '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result['informed']) echo $LDYes; else echo $LDNo;
	}
	else
	{ echo '
	<FONT    SIZE=2  FACE="Arial"><INPUT NAME="informed" TYPE="radio" VALUE="1" ';
	if($result['informed']) echo "checked" ;
	echo '> '.$LDYes.'
	<INPUT NAME="informed" TYPE="radio" VALUE="0" ';
	if(!$result['informed']) echo "checked"; 
	echo '>'.$LDNo.'<BR>
	</TD></TR>';
	}
	?>
<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<TR VALIGN="top"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDDiagnosis ?>:</TD>
	<TD colspan=3><FONT    SIZE=2  FACE="Arial"><?php if($mode=="saveok") echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['diagnosis_1']).'<p>'; else echo '<TEXTAREA NAME="diagnosis_1" Content-Type="text/html"
	COLS="75" ROWS="10">'.$result['diagnosis_1'].'</TEXTAREA>';?><br>
	<img <?php echo createComIcon('../','arrow.gif','0','middle') ?>> <FONT    SIZE=1  FACE="Arial"><a href="#?mode=<?php echo $mode ?>"><?php if ($mode!="saveok") echo $LDEnterDiagnosisNote; else echo $LDSeeDiagnosisNote; ?></a></TD></TR>
<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<TR  bgcolor=#dfdfdf>
	<TD valign=top><FONT    SIZE=2  FACE="Arial"><?php echo $LDTherapy ?>:</TD>
	<TD colspan=3><FONT    SIZE=2  FACE="Arial"><?php if($mode=="saveok") echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['therapy_1']).'<p>'; else echo '<TEXTAREA NAME="therapy_1" Content-Type="text/html"
	COLS="75" ROWS="10">'.$result['therapy_1'].'</TEXTAREA>';?><br>
	<img <?php echo createComIcon('../','arrow.gif','0','middle') ?>> <FONT    SIZE=1  FACE="Arial"><a href="#?mode=<?php echo $mode ?>"><?php if ($mode!="saveok") echo $LDEnterTherapyNote; else echo $LDSeeTherapyNote; ?></a></TD></TR>
<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<TR VALIGN="baseline"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDEditOn." / ".$LDAt ?>:</TD>
	<TD colspan=3><FONT    SIZE=2  FACE="Arial" color="#80000">
	<?php if(($mode=='saveok')||($mode=='update')) echo formatDate2Local($result['enc_date'],$date_format,1); 
	else 
	{
/*	echo '<INPUT NAME="enc_date" TYPE="text" VALUE="'.strftime("%d.%m.%Y").'" SIZE="20"  onKeyUp=setDay(this)> (tt.mm.jjjj)';
*/	echo formatDate2Local(date('Y-m-d'),$date_format).' '.convertTimeToLocal(date('H:i'));
	}
	?>
	<BR></TD>
	</TR>
<TR VALIGN="baseline"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDEditBy ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<?php
	 if(($mode=='saveok')||($mode=='update')) echo $result['create_id']; 
	else
	 echo '<INPUT NAME="encoder" TYPE="text" VALUE="'.$HTTP_COOKIE_VARS[$local_user.$sid].'" SIZE="30">';

	?>
	<BR></TD>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDKeyNr ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<?php if(($mode=="saveok")||($mode=="update")) echo $result['keynumber']; 
	else echo '<INPUT NAME="keynumber" TYPE="text" VALUE="'.$result['keynumber'].'" SIZE="30">';?><BR></TD>
	</TR>
<?php if ($mode=="saveok") : ?>
</TABLE>
</TD></TR>
</TABLE><p>
<!-- <input type="submit" value="<?php echo $LDUpdateData ?>"> -->
<input type="image" <?php echo createLDImgSrc('../','update_data.gif') ?>>
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept" value="<?php echo $result['dept'] ?>">
<input type="hidden" name="doc_no" value="<?php echo $result['doc_no'] ?>">
<input type="hidden" name="enc_date" value="<?php echo $result['enc_date'] ?>">
<input type="hidden" name="lastname" value="<?php echo $result['lastname'] ?>">
<input type="hidden" name="firstname" value="<?php echo $result['firstname'] ?>">
<input type="hidden" name="birthdate" value="<?php echo $result['birthdate'] ?>">
<input type="hidden" name="keynumber" value="<?php echo $result['keynumber'] ?>">
<?php else : ?>
<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<TR  bgcolor=#dfdfdf>
	<!-- <TD ALIGN="right"><INPUT TYPE="submit" VALUE="<?php echo $LDSave ?>"></TD> -->
	<TD ALIGN="right"><INPUT TYPE="image" <?php echo createLDImgSrc('../','savedisc.gif') ?>></TD>
	<TD ALIGN="center" colspan=3><INPUT TYPE="reset" VALUE="<?php echo $LDReset ?>"></TD>
	</TR>
</TABLE>
</TD></TR>
</TABLE>
<input type="hidden" name="mode" value="save">
	<?php if($mode=="update") 
		echo '
		<input type="hidden" name="update" value="1">
		<input type="hidden" name="dept" value="'.$result['dept'].'">
		<input type="hidden" name="doc_no" value="'.$result['doc_no'].'">
		<input type="hidden" name="patient_no" value="'.$result['patient_no'].'">
  		<input type="hidden" name="enc_time" value="'.$result['enc_time'].'">
		<input type="hidden" name="enc_date" value="'.$result['enc_date'].'">
  		<input type="hidden" name="keynumber" value="'.$result['keynumber'].'">
  		'; 
  ?>
<?php endif ?>

<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="date_format" value="<?php echo $date_format ?>">
</FORM>

<p>
<a href="<?php
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo 'startframe.php?sid='.$sid.'&lang='.$lang;
				else echo 'medopass.php?sid='.$sid.'&target=entry&lang='.$lang;
			?>"><img <?php echo createLDImgSrc('../','cancel.gif','0','absmiddle') ?> alt="<?php echo $LDCancel ?>"></a>
<p>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="medocs-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?"><?php echo $LDDocSearch ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="medocs-archiv.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?"><?php echo $LDArchive ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="javascript:showcat()"><?php echo $LDCatPls ?></a><br>

</ul>

</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=silver height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
