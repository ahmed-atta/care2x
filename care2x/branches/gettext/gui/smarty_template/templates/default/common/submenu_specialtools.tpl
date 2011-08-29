<blockquote>
<TABLE cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<TBODY>
	<TR>
		<TD>
			<TABLE cellSpacing=1 cellPadding=3>
 				<TBODY class="submenu">
					{{$LDPlugins}}
					{{$LDBilling}}
					{{$LDstaffMngmnt}}
					{{$LDInsuranceCoMngr}}
					{{$LDAddressMngr}}
					{{$LDImmunizationMngr}}
					{{$LDPhotoLab}}
					{{$LDWebCam}}
					{{$LDStandbyDuty}}
					{{$LDCalendar}}
					{{$LDNews}}
					{{$LDCalc}}

					{{if $bShowClock}}
						{{$LDClock}}
					{{/if}}

					{{$LDUserConfigOpt}}
					{{$LDAccessPw}}
					{{$LDNewsgroup}}

				</TBODY>
			</TABLE>
		</TD>
	</TR>
	</TBODY>
</TABLE>
<p>
<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}"></a>
</blockquote>
