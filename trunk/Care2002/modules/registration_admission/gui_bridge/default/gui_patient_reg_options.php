<?php

function Spacer()
{
/*?>
<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
<?php
*/}
?>
<img <?php echo createComIcon($root_path,'angle_left_s.gif',0); ?>>
<br>
<FONT face="Verdana,Helvetica,Arial" size=2 color="#cc0000">
<?php echo $LDOptsForPerson ?>
</font>

<TABLE cellSpacing=0 cellPadding=0 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=2 bgColor=#999999 
            border=0>
              <TBODY>
			<?php
			if($current_encounter){
			?>
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'pdata.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="aufnahme_daten_zeigen.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $current_encounter ?>&origin=patreg_reg"><?php echo $LDPatientData; ?></a>
				  </nobr> </FONT></TD>
                </TR>
			   
			<?php
			}elseif(!$death_date||$death_date=='0000-00-00'){
			?>
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'post_discussion.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="aufnahme_start.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&origin=patreg_reg&encounter_class_nr=1"><?php echo $LDAdmission.' - '.$LDStationary; ?></a>
				  </nobr> </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
				  
             <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="aufnahme_start.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&origin=patreg_reg&encounter_class_nr=2"><?php echo $LDVisit.' - '.$LDAmbulant; ?></a>
				   </FONT></TD>
                </TR>
		
			<?php
			}
			?>
			
           <?php Spacer(); ?>

				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'timeplan.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
			 <a href="show_appointment.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDAppointments ?></a>
				   </FONT></TD>
                </TR>				 

           <?php Spacer(); ?>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'qkvw.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="show_encounter_list.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDListEncounters ?></a>
				  </nobr> </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
				  
               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				  <a href="show_medocs.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDMedocs ?></a>
				   </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
				  
               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'eye_s.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				  <a href="show_drg.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDDRG ?></a>
				   </FONT></TD>
                </TR>
				
           <?php Spacer(); ?>
				  
               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bubble.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				  <a href="show_diagnostics_result.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDDiagXResults ?></a>
				   </FONT></TD>
                </TR>
			   
<!-- 				   
           <?php Spacer(); ?>
				  
			  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'eye_s.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="show_diagnosis.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDDiagnoses ?></a>
				  </nobr> </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>

               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="show_procedure.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDProcedures ?></a>
				  </nobr> </FONT></TD>
                </TR>
			   
 -->           <?php Spacer(); ?>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'prescription.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="show_prescription.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDPrescriptions ?></a>
				  </nobr> </FONT></TD>
               </TR>
<!-- 			   
           <?php Spacer(); ?>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'new_group.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="show_notes.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>&type_nr=21"><?php echo "$LDNotes - $LDPatientDev" ?></a>
				  </nobr> </FONT></TD>
                </TR>
 -->				
      	<?php Spacer(); ?>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'new_group.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="show_notes.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo "$LDNotes $LDAndSym $LDReports" ?></a>
				  </nobr> </FONT></TD>
                </TR>
           <?php Spacer(); ?>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'people_search_online.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="show_immunization.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDImmunization ?></a>
				   </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'people_search_online.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="show_weight_height.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDMeasurements ?></a>
				   </FONT></TD>
                </TR>
				
		  <?php
		  /* If the sex is female, show the pregnancies option link */
		   if($sex=='f') { 
		   ?>
           <?php Spacer(); ?>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'man-whi.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="show_pregnancy.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDPregnancies ?></a>
				   </FONT></TD>
                </TR>				  
		  <?php } ?>
		  
           <?php Spacer(); ?>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'new_address.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="show_birthdetail.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDBirthDetails ?></a>
				   </FONT></TD>
                </TR>	

           <?php Spacer(); ?>
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'new_address.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="javascript:popRecordHistory('care_person',<?php echo $pid ?>)"><?php echo $LDRecordsHistory ?></a>
				   </FONT></TD>
                </TR>					
				</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
