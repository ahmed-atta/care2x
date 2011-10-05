
 <blockquote>
{{$sFormTag}}		 
		<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
		<TBODY>
		<TR>
			<TD>
				<TABLE cellSpacing=1 cellPadding=3 width=600>
				<TBODY class="submenu">
				{{if $LDSelectHospitalServices}}
					{{$LDSelectHospitalServices}}
				
					
				
					{{$LDSelectLaboratoryTests}}
				{{/if}}
				{{if $LDViewBill}}
					

					{{$LDViewBill}}	
	
					
				{{/if}}
				
				{{if $LDViewPayment}}
					{{$LDViewPayment}}
	
					
				{{/if}}
				
				{{if $LDGenerateFinalBill}}
					{{$LDGenerateFinalBill}}
				{{/if}}

				{{if $LDPatienthasclearedallthebills}}
					{{$LDPatienthasclearedallthebills}}
				{{/if}}
				</TBODY>
				</TABLE>
			</TD>
		</TR>
		</TBODY>
		</TABLE>
	<p>
	{{$sHiddenInputs}}
	<p>
	</form>
	<p>
	<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}"></a>
	<p>
	</blockquote>
	