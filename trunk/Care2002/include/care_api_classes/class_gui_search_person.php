<?php
/**
* @package care_api
*/

/**
*/
//require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  GUI person search methods.
* Dependencies:
* assumes the following files are in the given path
* /include/care_api_classes/class_person.php
* /include/care_api_classes/class_paginator.php
* /include/care_api_classes/class_globalconfig.php
* /include/inc_date_format_functions.php
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/

$thisfile = basename($HTTP_SERVER_VARS['PHP_SELF']);

class GuiSearchPerson {

	# Default value for the maximum nr of rows per block displayed, define this to the value you wish
	# In normal cases the value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
	var $max_block_rows =30 ;
	
	# Set to TRUE if you want to show the option to select  inclusion of the first name in universal searches
	# This would give the user a chance to shut the search for first names and makes the search faster, but the user has one element more to consider
	# If set to FALSE the option will be hidden and both last name and first names will be searched, resulting to slower search
	var $show_firstname_controller = TRUE;

	# Set to TRUE if you want the sql query to be displayed
	# Useful for debugging or optimizing the query
	var $show_sqlquery = FALSE;

	# Set to TRUE to automatically show data if result count is only 1
	var $auto_show_bynumeric = FALSE;
	var $auto_show_byalphanumeric = FALSE;

	# The language tables
	var $langfile = array( 'aufnahme.php', 'personell.php');

	# Initialize some flags
	var $toggle = 0;
	var $mode = '';


	# Set color values for the search mask
	# Default search mask background color
	var $searchmask_bgcolor='#f3f3f3';

	# Default block background color
	var $entry_block_bgcolor='#fff3f3';

	# Default border color
	var $entry_border_bgcolor='#66ee66';

	# Defaut body border color
	var $entry_body_bgcolor='#ffffff';

	# Search key buffer
	var $searchkey='';
	
	# Optional url parameter to append to target url
	var $targetappend ='';

	# The text holder in front of output block
	var $pretext='';

	# The text holder after the output block
	var $posttext='';

	# script parameters buffer
	var $script_vars = array();
	
	# Tipps tricks flag
	var $showtips = TRUE;
	
	var $closefile='main/startframe.php';
	var $thisfile ='' ;
	var $cancelfile = 'main/startframe.php';
	var $targetfile = '';
	var $searchfile = '';
	/**
	* Constructor
	*/
	function GuiSearchPerson($target='',$filename='',$cancelfile=''){
		global $thisfile, $root_path;
		if(empty($filename)) $this->thisfile = $thisfile;
			else $this->thisfile = $filename;
		if(!empty($cancelfile)) $this->cancelfile = $cancelfile;
			else $this->cancelfile =$root_path.$this->cancelfile;
		if(!empty($target)){
			$this->targetfile = $target;
			$this->withtarget=TRUE;
		}
	}
	/**
	* Sets the target file of each listed item
	*/
	function setTargetFile($target){
		$this->targetfile = $target;
	}
	/**
	* Sets the file name of the script where this gui is  being displayed
	*/
	function setThisFile($target){
		$this->targetfile = $target;
	}
	/**
	* Sets the file name of the script to run when the search button is pressed
	*/
	function setSearchFile($target){
		$this->searchfile = $target;
	}
	/**
	* Sets the file name of the script to run when the cancel button is pressed
	*/
	function setCancelFile($target){
		$this->cancelfile = $target;
	}
	/**
	* Appends a string of url parameters to the target url
	*/
	function appendTargetUrl($str){
		$this->targetappend = $this->targetappend.$str;
	}
	/**
	* Sets the prompt text string
	*/
	function setPrompt($str){
		$this->prompt = $str;
	}
	/**
	* Displaying the GUI
	*/

	function display($skey=''){
		global 	$db, $searchkey, $root_path,  $firstname_too, $HTTP_POST_VARS, $HTTP_GET_VARS,
				$sid, $lang, $mode,$totalcount, $pgx, $odir, $oitem, $HTTP_SESSION_VARS,
				$dbf_nodate,  $user_origin, $parent_admit, $status, $target;

		$this->thisfile = $filename;
		$this->searchkey = $skey;
		$this->mode = $mode;
		
		if(empty($this->targetfile)){
			$withtarget = FALSE;
			$navcolspan = 5;
		}else{
			$withtarget = TRUE;
			$navcolspan = 6;
		}

		if(!empty($skey)) $searchkey = $skey;
		
		# Load the language tables
		$lang_tables =$this->langfile;
		include($root_path.'include/inc_load_lang_tables.php');

		# Initialize pages control variables
		if($mode=='paginate'){
			$searchkey=$HTTP_SESSION_VARS['sess_searchkey'];
			//$searchkey='USE_SESSION_SEARCHKEY';
			//$mode='search';
		}else{
			# Reset paginator variables
			$pgx=0;
			$totalcount=0;
			$odir='';
			$oitem='';
		}

		# Create an array to hold the config values
		$GLOBAL_CONFIG=array();

		#Load and create paginator object
		include_once($root_path.'include/care_api_classes/class_paginator.php');
		$pagen=new Paginator($pgx,$this->thisfile,$HTTP_SESSION_VARS['sess_searchkey'],$root_path);

		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('person_id_%');

		# Get the max nr of rows from global config
		$glob_obj->getConfig('pagin_person_search_max_block_rows');
		if(empty($GLOBAL_CONFIG['pagin_person_search_max_block_rows'])){
			# Last resort, use the default defined at the start of this page
			$pagen->setMaxCount($max_block_rows);
		}else{
			$pagen->setMaxCount($GLOBAL_CONFIG['pagin_person_search_max_block_rows']);
		}

		//$db->debug=true;
			
		if(!defined('SHOW_FIRSTNAME_CONTROLLER')) define('SHOW_FIRSTNAME_CONTROLLER',$this->show_firstname_controller);

		if(SHOW_FIRSTNAME_CONTROLLER){
			if(isset($HTTP_POST_VARS['firstname_too'])){
				if($HTTP_POST_VARS['firstname_too']){
					$firstname_too=1;
				}elseif($mode=='paginate'&&isset($HTTP_GET_VARS['firstname_too'])&&$HTTP_GET_VARS['firstname_too']){
					$firstname_too=1;
				}
			}elseif($mode!='search'){
				$firstname_too=TRUE;
			}

		}
		if(($this->mode=='search' || $this->mode=='paginate') && !empty($searchkey)){
			
			# Translate *? wildcards
			$searchkey=strtr($searchkey,'*?','%_');

			include_once($root_path.'include/inc_date_format_functions.php');

			include_once($root_path.'include/care_api_classes/class_person.php');
			$person=& new Person();

			# Set the sorting directive
			if(isset($oitem)&&!empty($oitem)) $sql3 =" ORDER BY $oitem $odir";

			//$sql='SELECT * FROM '.$dbtable.$sql2;

			if($mode=='paginate'){
				$fromwhere=$HTTP_SESSION_VARS['sess_searchkey'];
				$sql='SELECT pid, name_last, name_first, date_birth, addr_zip, sex, death_date, status FROM '.$fromwhere.$sql3;
				$ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pagen->BlockStartIndex());
				$linecount=$ergebnis->RecordCount();
			}else{
				$ergebnis=$person->SearchSelect($searchkey,$pagen->MaxCount(),$pagen->BlockStartIndex(),$oitem,$odir,$firstname_too);
				#Retrieve the sql fromwhere portion
				$fromwhere=$person->buffer;
				$HTTP_SESSION_VARS['sess_searchkey']=$fromwhere;
				$sql=$person->getLastQuery();
				$linecount=$person->LastRecordCount();
			}

			if($ergebnis){
				if($linecount==1){
					if(( $this->auto_show_bynumeric && $person->is_nr) || $this->auto_show_byalphanumeric  ){
						$zeile=$ergebnis->FetchRow();
						header("location:".$this->targetfile."?sid=".$sid."&lang=".$lang."&pid=".$zeile['pid']."&edit=1&status=".$status."&user_origin=".$user_origin."&noresize=1&mode=");
						exit;
					}
				}

				$pagen->setTotalBlockCount($linecount);

				# If more than one count all available
				if(isset($totalcount)&&$totalcount){
					$pagen->setTotalDataCount($totalcount);
				}else{
					# Count total available data
					$sql='SELECT COUNT(pid) AS maxnr FROM '.$fromwhere;
					if($result=$db->Execute($sql)){
						if ($result->RecordCount()) {
							$rescount=$result->FetchRow();
							$totalcount=$rescount['maxnr'];
						}
					}
					$pagen->setTotalDataCount($totalcount);
				}

				# Set the sort parameters
				$pagen->setSortItem($oitem);
				$pagen->setSortDirection($odir);
			}else{
				if($show_sqlquery) echo $sql;
			}

		} else {
			$mode='';
		}

		$entry_block_bgcolor=$this->entry_block_bgcolor;
		$entry_border_bgcolor=$this->entry_border_bgcolor;
		$entry_body_bgcolor=$this->entry_body_bgcolor;
		$searchmask_bgcolor= $this->searchmask_bgcolor;


		# Here starts the html output
		# Output any existing text before the search block
		if(!empty($this->pretext)) echo $this->pretext;

		# Show tips and tricks link and the javascript
		if($this->showtips){
			include_once($root_path.'include/inc_js_gethelp.php');
			echo '<font size="2" face="arial,verdana,">';
			echo '<a href="javascript:gethelp(\'person_search_tips.php\')">'.$LDTipsTricks.'</a>';
			echo '</font>';
		}
		echo '
			<table border=0 cellpadding=10 bgcolor="'.$entry_border_bgcolor.'">
			  <tr>
			    <td>';
		if(empty($this->prompt)) $searchprompt=$LDEntryPrompt;
			else $searchprompt=$this->prompt;
		//$searchprompt=$LDEnterEmployeeSearchKey;
		
		if(empty($this->searchfile)) $search_script = $this->thisfile;
			else $search_script = $this->searchfile;
		
		# Displays the search input block
		
		include($root_path.'include/inc_patient_searchmask.php');
?>
			</td>
			</tr>
			</table>

			<p>
			<a href="<?php	echo $this->cancelfile.URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
			<p>
<?php

		# Create append data
		$this->targetappend.="&firstname_too=$firstname_too";

		//echo $mode;
		if($parent_admit) $bgimg='tableHeaderbg3.gif';
			else $bgimg='tableHeader_gr.gif';
		$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

		if($mode=='search'||$mode=='paginate'){
			echo '<font size="2" face="arial,verdana,">';
			if ($linecount) echo '<hr width=80% align=left>'.str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
				else echo str_replace('~nr~','0',$LDSearchFound);
			echo '</font>';
		}

		if ($linecount){

			$img_male=createComIcon($root_path,'spm.gif','0');
			$img_female=createComIcon($root_path,'spf.gif','0');

			echo '
			<p>
			<table border=0 cellpadding=2 cellspacing=1>
			  <tr class="reg_list_titlebar">';
?>
			    <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
<?php
			echo $pagen->makeSortLink($LDRegistryNr,'pid',$oitem,$odir,$this->targetappend);
?>
			    </b>
			    </td>
			    <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
<?php
			echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$this->targetappend);
 ?>
 			    </b>
			    </td>
			    <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
<?php
			echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$this->targetappend);
?>
			    </b>
			    </td>
			   <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
<?php
			echo $pagen->makeSortLink($LDFirstName,'name_first',$oitem,$odir,$this->targetappend);
?>
			    </b>
			    </td>
			    <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
<?php
			echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$this->targetappend);
?>
			    </b>
			    </td>
			    <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
<?php
			echo $pagen->makeSortLink($LDZipCode,'addr_zip',$oitem,$odir,$this->targetappend);
?>
			    </b>
			    </td>
<?php
			if(!empty($this->targetfile)){
?>
			    <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>&nbsp;&nbsp;<?php echo $LDOptions; ?></b>
			    </td>
			  </tr>
<?php
			}
			while($zeile=$ergebnis->FetchRow()){
						
				if($zeile['status']==''||$zeile['status']=='normal'){

					echo "<tr ";
					if($toggle) {
						echo 'class="wardlistrow2">';
						$toggle=0;
					} else {
						echo 'class="wardlistrow1">';
						$toggle=1;
					};
					
					echo '<td align="right"><font face=arial size=2>';
					echo "&nbsp;".$zeile['pid'];
					echo "&nbsp;</td>";

					echo '<td>';
					switch(strtolower($zeile['sex'])){
						case 'f': echo '<img '.$img_female.'>'; break;
						case 'm': echo '<img '.$img_male.'>'; break;
						default: echo '&nbsp;'; break;
					}
					
					echo '</td>
						';	
					echo "<td><font face=arial size=2>";
					echo "&nbsp;".ucfirst($zeile['name_last']);
					echo "</td>";
					echo "<td><font face=arial size=2>";
					echo "&nbsp;".ucfirst($zeile['name_first']);
					# If person is dead show a black cross
					if($zeile['death_date']&&$zeile['death_date']!=$dbf_nodate) echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0','absmiddle').'>';
					echo "</td>";
					echo "<td><font face=arial size=2>";
					echo "&nbsp;".formatDate2Local($zeile['date_birth'],$date_format);
					echo "</td>";
					echo "<td><font face=arial size=2>";
					echo "&nbsp;".$zeile['addr_zip'];
					echo "</td>";
					if($withtarget){
						echo '
							<td><font face=arial size=2>&nbsp;';
						echo "
							<a href=\"$this->targetfile".URL_APPEND."&pid=".$zeile['pid']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=\">";
						echo '
							<img '.createLDImgSrc($root_path,'ok_small.gif','0').' title="'.$LDShowDetails.'"></a>&nbsp;
							</td>';
						}
					if(!file_exists($root_path.'cache/barcodes/pn_'.$zeile['pid'].'.png')){
						echo "<img src='".$root_path."classes/barcode/image.php?code=".$zeile['pid']."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
					}
					echo '</tr>';
				}
			}
			echo '
					<tr><td colspan='.$navcolspan.'><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious,$this->targetappend).'</td>
					<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext,$this->targetappend).'</td>
					</tr>
					</table>';
			if(!empty($this->posttext)) echo $this->posttext;
		}
	} // end of function display()
} // end of class
?>
