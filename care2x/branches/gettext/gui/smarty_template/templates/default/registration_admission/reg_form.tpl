		{{*  Javascript block local to this form template *}}
		{{$sRegFormJavaScript}}

		{{* The duplicate data error block *}}
		{{if $error || $errorDupPerson}}
			{{include file="registration_admission/reg_error_duplicate.tpl"}}
		{{/if}}

		{{* extra block for additional front text *}}
		{{$pretext}}
		
		{{if $bSetAsForm}}
		<form method="post" action="{{$thisfile}}" name="aufnahmeform" ENCTYPE="multipart/form-data" onSubmit="return chkform(this)">
		{{/if}}

		<table border=0 cellspacing=0 cellpadding=0 {{$sFormWidth}}>
				<tr>
					<td class="reg_item">
						{{$LDRegistryNr}}
					</td>
					<td class="reg_input">
						{{$pid}}
						<br>
						{{$sBarcodeImg}}
					</td>
					<td {{$sPicTdRowSpan}} class="photo_id" align="center">
						<a href="#"  onClick="showpic(document.aufnahmeform.photo_filename)"><img {{$img_source}} name="headpic"></a>
						<br>
						{{$LDPhoto}}
						<br>
						{{$sFileBrowserInput}}
					</td>
				</tr>

				<tr>
					<td  class="reg_item">
						{{$LDRegDate}}
					</td>
					<td class="reg_input">
						<FONT color="#800000">
						{{$sRegDate}}
					</td>
				</tr>

				<tr>
					<td  class="reg_item">
						{{$LDRegTime}}
					</td>
					<td class="reg_input">
						<FONT color="#800000">
						{{$sRegTime}}
					</td>
				</tr>

				{{* The following tags contain rows patterned after the  "registration_admission/reg_row.tpl" template *}}

				{{$sPersonTitle}}
				{{$sNameLast}}
				{{$sNameFirst}}
				{{$sName2}}
				{{$sName3}}
				{{$sNameMiddle}}
				{{$sNameMaiden}}
				{{$sNameOthers}}

				<tr>
					<td class="reg_input_must">
						{{$LDBday}}
					</td>
					<td class="reg_input_must">
						{{$sBdayInput}}&nbsp;{{$sCrossImg}} {{$sDeathDate}}
					</td>
					<td class="reg_input_must">
						{{$LDSex}} <label>{{$sSexM}}{{$LDMale}}</label> &nbsp;&nbsp; <label>{{$sSexF}}{{$LDFemale}}</label>
					</td>
				</tr>

			{{if $LDBloodGroup}}
				<tr>
				<td class="reg_item">
					{{$LDBloodGroup}}
				</td>
				<td colspan=2 class="reg_input">
					<label>{{$sBGAInput}}{{$LDA}}</label>  &nbsp;&nbsp; <label>{{$sBGBInput}}{{$LDB}}</label> &nbsp;&nbsp; <label>{{$sBGABInput}}{{$LDAB}}</label>  &nbsp;&nbsp;<label>{{$sBGOInput}}{{$LDO}}</label>
				</td>
				</tr>
			{{/if}}

			{{if $LDCivilStatus}}
				<tr>
				<td class="reg_item">
					{{$LDCivilStatus}}
				</td>
				<td colspan=2 class="reg_input">
					<label>{{$sCSSingleInput}}{{$LDSingle}}</label>  &nbsp;&nbsp;
					<label>{{$sCSMarriedInput}}{{$LDMarried}}</label> &nbsp;&nbsp;
					<label>{{$sCSDivorcedInput}}{{$LDDivorced}}</label>  &nbsp;&nbsp;
					<label>{{$sCSWidowedInput}}{{$LDWidowed}}</label> &nbsp;&nbsp;
					<label>{{$sCSSeparatedInput}}{{$LDSeparated}}</label>
				</td>
				</tr>
			{{/if}}

				<tr>
				<td colspan=3>
					{{$LDAddress}}
				</td>
				</tr>

				<tr>
					<td class="reg_input_must">
						{{$LDStreet}}
					</td>
					<td class="reg_input_must">
						{{$sStreetInput}}
					</td>
					<td class="reg_input_must">
						{{$LDStreetNr}} &nbsp;&nbsp; {{$sStreetNrInput}}
					</td>
				</tr>

				<tr>
					<td class="reg_input_must">
						{{$LDTownCity}}
					</td>
					<td class="reg_input_must">
						{{$sTownCityInput}} 
					</td>
					<td class="reg_input_must">
						{{$LDZipCode}} &nbsp;&nbsp; {{$sZipCodeInput}}
					</td>
				</tr>

			{{if $bShowInsurance}}

				<tr class="reg_input_must">
				<td>
					&nbsp;
				</td>
				<td colspan=2 >
					{{$sErrorInsClass}} 
					{{foreach from=$sInsClasses item=InsClass}}
						{{$InsClass}}
					{{/foreach}}
				</td>
			
				</tr>
				
				<tr>
					<td>
						{{$sInsuranceNr}}
					</td>
				</tr>
				
				<tr>
				<td class="reg_item">
					{{$LDInsuranceCo}}
				</td>
				<td colspan=2 class="reg_input">
					{{$sInsCoNameInput}} {{$sInsCoMiniCalendar}}
				</td>	
				</tr>
			{{/if}}

			{{if $bNoInsurance}}
				<tr>
				<td>
					&nbsp;
				</td>
				<td colspan=2 class="reg_input">
					{{$LDSeveralInsurances}}
				</td>
				</tr>
			{{/if}}

				{{* The following tags contain rows patterned after the  "registration_admission/reg_row.tpl" template *}}

				{{$sPhone1}}
				{{$sPhone2}}
				{{$sCellPhone1}}
				{{$sCellPhone2}}
				{{$sFax}}
				{{$sEmail}}
				{{$sCitizenship}}
				{{$sSSSNr}}
				{{$sNatIdNr}}
				{{$sReligion}}

				<tr>
				<td class="reg_item">
					{{$LDEthnicOrig}}
				</td>
				<td colspan=2 class="reg_input">
					{{$sEthnicOrigInput}} {{$sEthnicOrigMiniCalendar}}
				</td>
			</tr>
			
			{{if $bShowOtherHospNr}}
				<tr>
				<td class="reg_item" valign=top class="reg_input">
					{{$LDOtherHospitalNr}}
				</td>
				<td colspan=2 class="reg_input">
					{{$sOtherNr}}
					{{$sOtherNrSelect}}
				</td>
				</tr>
				{{/if}}

				<tr>
				<td class="reg_item">
					{{$LDRegBy}}
				</td>
				<td colspan=2 class="reg_input">
					{{$sRegByInput}}
				</td>
			</tr>
		</table>

		{{$sHiddenInputs}}
		{{$sUpdateHiddenInputs}}
		<p>
		{{$pbSubmit}} &nbsp;&nbsp; {{$pbReset}} {{$pbForceSave}}

		{{if $bSetAsForm}}
		</form>
		{{/if}}

		{{$sNewDataForm}}
