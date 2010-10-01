{{if $result.tcm_address ne ''}}
<script type="text/javascript">
$(function(){

$(":input").attr("disabled",true);
})
</script>
{{/if}}
<style type="text/css">
table.tcm{
	border-width: 0px;
	border-spacing: 3px;
	border-style: none;
	border-color: gray;
	border-collapse: separate;
	background-color: white;
}

table.tcm td {
	border-width: thin;
	padding: 5px;
	border-style: none;
	border-color: white;
	background-color: rgb(246, 246, 246);
	-moz-border-radius: 0px 0px 0px 0px;
}
</style>
{{if $bSetAsForm}}
	{{$sDocsJavaScript}}
	<form method="post" name="entryform" onSubmit="return chkForm(this)">
{{/if}}
<table class="tcm">
	<tr>
		<td>Address</td>
		<td><textarea name='tcm_address' cols=60 rows=2 wrap='physical'>{{$person.addr_str}} {{$person.addr_str_nr}} {{$person.addr_zip}}</textarea></td>
	</tr>
	<tr>
		<td>About what kind of ailment you came to our clinic?</td>
		<td><textarea name='tcm_ailment' cols=60 rows=2 wrap='physical'>{{$result.tcm_ailment}}</textarea></td>
	</tr>
	<tr>
		<td>what kind of treatment you had so far ?</td>
		<td>
			<table>
				<tr>
					<td>Acupuncture</td>
					<td></td>
				</tr>
				<tr>
					<td valign="top">
						<label><input type='radio' name='treatment_type' value='acupunctur_1to6'{{if $result.treatment_type eq 'acupunctur_1to6'}} checked {{/if}}>1 to 6 threatments</label><br/>
						<label><input type='radio' name='treatment_type' value='acupunctur_7to12'{{if $result.treatment_type eq 'acupunctur_7to12'}} checked {{/if}}>7 to 12 threatments</label><br/>
						<label><input type='radio' name='treatment_type' value='acupunctur_plus'{{if $result.treatment_type eq 'acupunctur_plus'}} checked {{/if}}>more than 12 threatments</label><br/>
					</td>
					<td valign="top">
						<label><input type='radio' name='treatment_type' value='herb'{{if $result.treatment_type eq 'herb'}} checked {{/if}}>Herb-Therapies</label><br/>
						<label><input type='radio' name='treatment_type' value='moxibustion'{{if $result.treatment_type eq 'moxibustion'}} checked {{/if}}>Moxibustion</label><br/>
						<label><input type='radio' name='treatment_type' value='qi_gong_tai_qi'{{if $result.treatment_type eq 'qi_gong_tai_qi'}} checked {{/if}}>Qi Gong / Tai Qi</label><br/>
						<label><input type='radio' name='treatment_type' value='tuina'{{if $result.treatment_type eq 'tuina'}} checked {{/if}}>Tuina</label><br/>
						<label><input type='radio' name='treatment_type' value='nutrition_science'{{if $result.treatment_type eq 'nutrition_science'}} checked {{/if}}>Nutrition Science</label><br/>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			How would you evaluate the success of the threatment?<br />
			Do you have ailments like  ...<i>(Mark it, 1 is best, 6 is worsest)</i>
		</td>
		<td>
			<label>1<input type='radio' name='treatment_success' value='1'{{if $result.treatment_success eq '1'}} checked {{/if}}>Free of ailments</label><br/>
			<label>2<input type='radio' name='treatment_success' value='2'{{if $result.treatment_success eq '2'}} checked {{/if}}>Improvements</label><br/>
			<label>3<input type='radio' name='treatment_success' value='3'{{if $result.treatment_success eq '3'}} checked {{/if}}>Improvements</label><br/>
			<label>4<input type='radio' name='treatment_success' value='4'{{if $result.treatment_success eq '4'}} checked {{/if}}>Improvements</label><br/>
			<label>5<input type='radio' name='treatment_success' value='5'{{if $result.treatment_success eq '5'}} checked {{/if}}>Consistent</label><br/>
		</td>
	</tr>	
	<tr>
		<td>How strong where your hurts (please mark)</td>
		<td>
			<table>
				<tr>
					<td>Before TCM-treatment starts</td>
				</tr>
				<tr>
					<td>
						<label><input type='radio' name='hurt_before_treatment' value='1'{{if $result.hurt_before_treatment eq '1'}} checked {{/if}}>1</label>
						<label><input type='radio' name='hurt_before_treatment' value='2'{{if $result.hurt_before_treatment eq '2'}} checked {{/if}}>2</label>
						<label><input type='radio' name='hurt_before_treatment' value='3'{{if $result.hurt_before_treatment eq '3'}} checked {{/if}}>3</label>
						<label><input type='radio' name='hurt_before_treatment' value='4'{{if $result.hurt_before_treatment eq '4'}} checked {{/if}}>4</label>
						<label><input type='radio' name='hurt_before_treatment' value='6'{{if $result.hurt_before_treatment eq '5'}} checked {{/if}}>5</label>
						<label><input type='radio' name='hurt_before_treatment' value='6'{{if $result.hurt_before_treatment eq '6'}} checked {{/if}}>6</label>
						<label><input type='radio' name='hurt_before_treatment' value='7'{{if $result.hurt_before_treatment eq '7'}} checked {{/if}}>7</label>
						<label><input type='radio' name='hurt_before_treatment' value='8'{{if $result.hurt_before_treatment eq '8'}} checked {{/if}}>8</label>
						<label><input type='radio' name='hurt_before_treatment' value='9'{{if $result.hurt_before_treatment eq '9'}} checked {{/if}}>9</label>
						<label><input type='radio' name='hurt_before_treatment' value='10'{{if $result.hurt_before_treatment eq '10'}} checked {{/if}}>10</label>
					</td>
				</tr>
				<tr>
					<td>none_________________distinctive______________extreme distinctive</td>
				</tr>				
				<tr>
					<td>After TCM-treatment</td>
				</tr>
				<tr>
					<td>
						<label><input type='radio' name='hurt_after_treatment' value='1'{{if $result.hurt_after_treatment eq '1'}} checked {{/if}}>1</label>
						<label><input type='radio' name='hurt_after_treatment' value='2'{{if $result.hurt_after_treatment eq '2'}} checked {{/if}}>2</label>
						<label><input type='radio' name='hurt_after_treatment' value='3'{{if $result.hurt_after_treatment eq '3'}} checked {{/if}}>3</label>
						<label><input type='radio' name='hurt_after_treatment' value='4'{{if $result.hurt_after_treatment eq '4'}} checked {{/if}}>4</label>
						<label><input type='radio' name='hurt_after_treatment' value='5'{{if $result.hurt_after_treatment eq '5'}} checked {{/if}}>5</label>
						<label><input type='radio' name='hurt_after_treatment' value='6'{{if $result.hurt_after_treatment eq '6'}} checked {{/if}}>6</label>
						<label><input type='radio' name='hurt_after_treatment' value='7'{{if $result.hurt_after_treatment eq '7'}} checked {{/if}}>7</label>
						<label><input type='radio' name='hurt_after_treatment' value='8'{{if $result.hurt_after_treatment eq '8'}} checked {{/if}}>8</label>
						<label><input type='radio' name='hurt_after_treatment' value='9'{{if $result.hurt_after_treatment eq '9'}} checked {{/if}}>9</label>
						<label><input type='radio' name='hurt_after_treatment' value='10'{{if $result.hurt_after_treatment eq '10'}} checked {{/if}}>10</label>
					</td>
				</tr>
				<tr>
					<td>none_________________distinctive______________extreme distinctive</td>
				</tr>				
			</table>
		</td>
	</tr>	
	<tr>
		<td>Did you had the feeling about <u>good</u> side effects during the treatment?</td>
		<td>
			<table>
				<tr>
					<td><label>yes<input type='radio' name='side_effects_during_treatment_good_radio' value='1'{{if $result.side_effects_during_treatment_good_radio eq '1'}} checked {{/if}}></label></td>
					<td><label>what kind of<textarea name='side_effects_during_treatment_good_text_yes' cols=60 rows=2 wrap='physical'>{{$result.side_effects_during_treatment_good_text_yes}}</textarea></label></td>
				</tr>
				<tr>
					<td><label>no<input type='radio' name='side_effects_during_treatment_good_radio' value='0'{{if $result.side_effects_during_treatment_good_radio eq '0'}} checked {{/if}}></label></td>
					<td><label>what kind of<textarea name='side_effects_during_treatment_good_text_no' cols=60 rows=2 wrap='physical'>{{$result.side_effects_during_treatment_good_text_no}}</textarea></label></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>Did you had the feeling about <u>bad</u> side effects during the treatment?</td>
		<td>
			<table>
				<tr>
					<td><label>yes<input type='radio' name='side_effects_during_treatment_bad_radio' value='1'{{if $result.side_effects_during_treatment_bad_radio eq '1'}} checked {{/if}}></label></td>
					<td><label>what kind of<textarea name='side_effects_during_treatment_bad_text_yes' cols=60 rows=2 wrap='physical'>{{$result.side_effects_during_treatment_bad_text_yes}}</textarea></label></td>
				</tr>
				<tr>
					<td><label>no<input type='radio' name='side_effects_during_treatment_bad_radio' value='0'{{if $result.side_effects_during_treatment_bad_radio eq '0'}} checked {{/if}}></label></td>
					<td><label>what kind of<textarea name='side_effects_during_treatment_bad_text_no' cols=60 rows=2 wrap='physical'>{{$result.side_effects_during_treatment_bad_text_no}}</textarea></label></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>Please evaluate <i>( 1 is best, 6 is worsest)</i></td>
		<td>
			<table>
				<tr><td>Doctors</td></tr>
				<tr>
					<td>
						<label><input type='radio' name='staff_eval_doctors' value='1'{{if $result.staff_eval_doctors eq '1'}} checked {{/if}}>1</label>
						<label><input type='radio' name='staff_eval_doctors' value='2'{{if $result.staff_eval_doctors eq '2'}} checked {{/if}}>2</label>
						<label><input type='radio' name='staff_eval_doctors' value='3'{{if $result.staff_eval_doctors eq '3'}} checked {{/if}}>3</label>
						<label><input type='radio' name='staff_eval_doctors' value='4'{{if $result.staff_eval_doctors eq '4'}} checked {{/if}}>4</label>
						<label><input type='radio' name='staff_eval_doctors' value='5'{{if $result.staff_eval_doctors eq '5'}} checked {{/if}}>5</label>
						<label><input type='radio' name='staff_eval_doctors' value='6'{{if $result.staff_eval_doctors eq '6'}} checked {{/if}}>6</label>
					</td>
				</tr>
				<tr><td>Interpreter</td></tr>
				<tr>
					<td>
						<label><input type='radio' name='staff_eval_interpreter' value='1'{{if $result.staff_eval_interpreter eq '1'}} checked {{/if}}>1</label>
						<label><input type='radio' name='staff_eval_interpreter' value='2'{{if $result.staff_eval_interpreter eq '2'}} checked {{/if}}>2</label>
						<label><input type='radio' name='staff_eval_interpreter' value='3'{{if $result.staff_eval_interpreter eq '3'}} checked {{/if}}>3</label>
						<label><input type='radio' name='staff_eval_interpreter' value='4'{{if $result.staff_eval_interpreter eq '4'}} checked {{/if}}>4</label>
						<label><input type='radio' name='staff_eval_interpreter' value='5'{{if $result.staff_eval_interpreter eq '5'}} checked {{/if}}>5</label>
						<label><input type='radio' name='staff_eval_interpreter' value='6'{{if $result.staff_eval_interpreter eq '6'}} checked {{/if}}>6</label>
					</td>
				</tr>
				<tr><td>Assistance staff</td></tr>
				<tr>
					<td>
						<label><input type='radio' name='staff_eval_assistance' value='1'{{if $result.staff_eval_assistance eq '1'}} checked {{/if}}>1</label>
						<label><input type='radio' name='staff_eval_assistance' value='2'{{if $result.staff_eval_assistance eq '2'}} checked {{/if}}>2</label>
						<label><input type='radio' name='staff_eval_assistance' value='3'{{if $result.staff_eval_assistance eq '3'}} checked {{/if}}>3</label>
						<label><input type='radio' name='staff_eval_assistance' value='4'{{if $result.staff_eval_assistance eq '4'}} checked {{/if}}>4</label>
						<label><input type='radio' name='staff_eval_assistance' value='5'{{if $result.staff_eval_assistance eq '5'}} checked {{/if}}>5</label>
						<label><input type='radio' name='staff_eval_assistance' value='6'{{if $result.staff_eval_assistance eq '6'}} checked {{/if}}>6</label>
					</td>
				</tr>
				<tr><td>Organisation</td></tr>
				<tr>
					<td>
						<label><input type='radio' name='staff_eval_organisation' value='1'{{if $result.staff_eval_organisation eq '1'}} checked {{/if}}>1</label>
						<label><input type='radio' name='staff_eval_organisation' value='2'{{if $result.staff_eval_organisation eq '2'}} checked {{/if}}>2</label>
						<label><input type='radio' name='staff_eval_organisation' value='3'{{if $result.staff_eval_organisation eq '3'}} checked {{/if}}>3</label>
						<label><input type='radio' name='staff_eval_organisation' value='4'{{if $result.staff_eval_organisation eq '4'}} checked {{/if}}>4</label>
						<label><input type='radio' name='staff_eval_organisation' value='5'{{if $result.staff_eval_organisation eq '5'}} checked {{/if}}>5</label>
						<label><input type='radio' name='staff_eval_organisation' value='6'{{if $result.staff_eval_organisation eq '6'}} checked {{/if}}>6</label>
					</td>
				</tr>
				<tr><td>Rooms</td></tr>
				<tr>
					<td>
						<label><input type='radio' name='staff_eval_room' value='1'{{if $result.staff_eval_room eq '1'}} checked {{/if}}>1</label>
						<label><input type='radio' name='staff_eval_room' value='2'{{if $result.staff_eval_room eq '2'}} checked {{/if}}>2</label>
						<label><input type='radio' name='staff_eval_room' value='3'{{if $result.staff_eval_room eq '3'}} checked {{/if}}>3</label>
						<label><input type='radio' name='staff_eval_room' value='4'{{if $result.staff_eval_room eq '4'}} checked {{/if}}>4</label>
						<label><input type='radio' name='staff_eval_room' value='5'{{if $result.staff_eval_room eq '5'}} checked {{/if}}>5</label>
						<label><input type='radio' name='staff_eval_room' value='6'{{if $result.staff_eval_room eq '6'}} checked {{/if}}>6</label>
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td>What kind of improvements do you suggest?</td>
		<td><textarea name='improvemements_suggestion' cols=60 rows=3 wrap='physical'>{{$result.improvemements_suggestion}}</textarea></td>
	</tr>
	<tr>
		<td>What did you enjoyed much at TCM-Clinic?</td>
		<td><textarea name='enjoy' cols=60 rows=3 wrap='physical'>{{$result.enjoy}}</textarea></td>
	</tr>		
	<tr>
		<td><FONT  color='red'>*</font>  {{$LDBy}} </td>
		<td>
			{{if $bSetAsForm}}
				<input type='text' name='staff_name' size=50 maxlength=60 value="" readonly>
			{{else}}
				{{$staffName}}
			{{/if}}
		</td>
	</tr>
</table>

{{if $bSetAsForm}}
	{{$sHiddenInputs}}
	</form>
{{/if}}