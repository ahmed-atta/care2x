{{* pass_entry_mask.tpl  Password check entry template *}}

<!--<table width=100% border=0 cellpadding="0" cellspacing="0">-->

	{{* Any eventuall display content for the top part of the mask (sTopDisplayRow) must be packaged as a table row *}}
	{{$sTopDisplayRow}}

	<tr>
		<td class="passborder" colspan=3>&nbsp;</td>
	</tr>

	<tr>
		<td class="passborder" width=1%></td>
		<td class="passbody">
			<p><br>
			<center>

			{{if $bShowErrorPrompt}}
				<table border=0>
					<tr>
						<td>{{$sMascotImg}}</td>
						<td align="center">{{$sErrorMsg}}</td>
					</tr>
				</table>
			{{/if}}

			<table border=0 cellpadding=0  cellspacing=0>
				<tr>
					{{$sMascotColumn}}
					<td valign=top>
						<table cellspacing=0 class="passmaskframe">
							<tr>
								<td>
									<table cellpadding=20 cellspacing=0 class="passmask">
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

													<div class="buttons">
													{{$sPassSubmitButton}} 
													{{$sCancelButton}}
													</div>
												</form>

											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<p><br>
			</center>

		</td>
		<td class="passborder">
			&nbsp;
			</td>
	</tr>

	<tr >
		<td class="passborder" colspan=3>&nbsp;</td>
	</tr>

</table>