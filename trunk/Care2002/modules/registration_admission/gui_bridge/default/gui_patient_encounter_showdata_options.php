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
<img <?php echo createComIcon($root_path,'angle_left.gif',0); ?>>
<br>
<FONT face="Verdana,Helvetica,Arial" size=2 color="#cc0000">
<?php echo $LDOptsForPatient ?>
</font>

<script language="javascript" >
<!-- 
function openDRGComposite()
{
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;
			h=650;';
?>
	
	drgcomp_<?php echo $HTTP_SESSION_VARS['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>=window.open("<?php echo $root_path ?>modules/drg/drg-composite-start.php<?php echo URL_REDIRECT_APPEND."&display=composite&pn=".$HTTP_SESSION_VARS['sess_full_en']."&ln=$name_last&fn=$name_first&bd=$date_birth&dept_nr=$dept_nr&oprm=$saal"; ?>","drgcomp_<?php echo $encounter_nr."_".$op_nr."_".$dept_nr."_".$saal ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.drgcomp_<?php echo $HTTP_SESSION_VARS['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>.moveTo(0,0);
} 
//-->
</script>

<TABLE cellSpacing=0 cellPadding=0 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=2 bgColor=#999999 
            border=0>
              <TBODY>
				  
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'post_discussion.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2>
				 <a href="show_sick_confirm.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDSickReport; ?></a>
				   </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
				  
             <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="javascript:alert('Function not  available yet');"><?php echo $LDAnamnesisForm; ?></a>
				   </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>

				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
			 <a href="javascript:alert('Function not  available yet');"><?php echo $LDConsentDec ?></a>
				   </FONT></TD>
                </TR>				 
			   
 			   
           <?php Spacer(); ?>
				  
               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bubble.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				  <a href="show_diagnostics_result.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDDiagXResults ?></a>
				   </FONT></TD>
                </TR>
			   
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
           <?php Spacer(); ?>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'eye_s.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="javascript:openDRGComposite()"><?php echo $LDDRG ?></a>
				  </nobr> </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'prescription.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="show_prescription.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDPrescriptions ?></a>
				  </nobr> </FONT></TD>
               </TR>
			   
			   
      <?php Spacer(); ?>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'new_group.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <nobr>
				 <a href="show_notes.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>&type_nr=21"><?php echo $LDPatientDev.' '.$LDNotes ?></a>
				  </nobr> </FONT></TD>
                </TR>
				
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
				<a href="show_weight_height.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>"><?php echo $LDWtHt ?></a>
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
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'people_search_online.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="patient_register.php<?php echo URL_APPEND; ?>&pid=<?php echo $pid ?>&update=1"><?php echo  $LDUpdate.' '.$LDPatientRegister ?></a>
				   </FONT></TD>
                </TR>					
          <?php Spacer(); ?>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'new_address.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2> 
				<a href="javascript:popRecordHistory('care_encounter',<?php echo $HTTP_SESSION_VARS['sess_en']; ?>)"><?php echo $LDRecordsHistory ?></a>
				   </FONT></TD>
                </TR>									</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
