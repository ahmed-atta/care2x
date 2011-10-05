{{* pass_entry_mask.tpl  Password check entry template *}}


	{{* Any eventuall display content for the top part of the mask (sTopDisplayRow) must be packaged as a table row *}}
	{{$sTopDisplayRow}}

<table>
	<tr>
		<td>

			{{if $bShowErrorPrompt}}
				<table border=0>
					<tr>
						<td align="center">{{$sErrorMsg}}</td>
					</tr>
				</table>
			{{/if}}
	</td>
	<tr>
		<td>
			<form {{$sPassFormParams}}>
				<div class="prompt">
					{{$LDPwNeeded}}!
				</div><br />
				<label for="username">{{$LDUserPrompt}}:</label>
				<div class="input">
					<input type="text" name="userid" size="14" maxlength="25" id="username">
           		</div>					
				
				<label for="username">{{$LDPwPrompt}}:</label>
				<div class="input">
					<input type="password" name="keyword" size="14" maxlength="25" id="password">
				</div>
				
				{{* Do not move the sPassHiddenInputs outside of the <form></form> block *}}
				{{$sPassHiddenInputs}}

				<div class="actions">
					{{$sPassSubmitButton}} 
					{{$sCancelButton}}
				</div>
			</form>
		</td>
	</tr>
</table>