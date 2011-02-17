{{* Frame template for prescription module *}}
{{* Used by module template *}}
{{* Robert Meggle 2011 *}}


<div class="modul">
	
	{{* Include standard headline for prescription module *}}
	{{include file='pharmacy/module_prescription_headline.tpl'}}
	
	<div class="item">
	
		<div class="item_name">
			<h4>ADRENALLINE IMG/ML,IML INJECTON</h4>
		</div>
		<div class="item_details">
		
			<div>
				<div class="item_amount">
					<select id="maxListSize">
						<option value="50">25</option>
						<option value="50">50</option>
						<option value="100" selected="selected">100</option>
						<option value="150">150</option>
						<option value="200">200</option>
						<option value="300">300</option>
					</select>
				</div>
				<div class="item_times_per_day">
					<select id="maxListSize">
						<option value="50">25</option>
						<option value="50">50</option>
						<option value="100" selected="selected">100</option>
						<option value="150">150</option>
						<option value="200">200</option>
						<option value="300">300</option>
					</select>
				</div>
			</div>**
			<div class="item_total_dose">
				{{* Will be calculated *}}
			</div>

			<div class="item_notes">
				<input type="text"/>
			</div>
		</div>
	</div>
	
</div>