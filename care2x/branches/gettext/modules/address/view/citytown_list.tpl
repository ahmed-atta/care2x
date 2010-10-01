<p>{{$resultsFound}}</p>

<table border=0 cellpadding=2 cellspacing=1>
	<thead>
		<tr class="wardlisttitlerow">
		      <th><b>{{$nameTitle}}</b></th>
		      <th><b>{{$zipTitle}}</b></th>
		      <th><b>{{$isoTitle}}</b></th>
		      <th><b>{{$uneceTitle}}</b></th>
		      <th><b>{{$infoTitle}}</b></th>
		</tr> 
	</thead>
	<tbody>
		{{foreach from=$address item="item"}}
		<tr>
			<td><a href="citytown_info.php{{$URL_APPEND}}&retpath=list&nr={{$item.nr}}">{{$item.name}}</a></td>
			<td>{{$item.zip_code}}</td>
			<td>{{$item.iso_country_id}}</td>
			<td>{{$item.unece_locode}}</td>
			<td><a href="{{$item.info_url}}">{{$item.info_url}}</a></td>
		</tr> 
		{{/foreach}}
		<tr><td colspan=3>{{$prev}}</td><td align=right>{{$next}}</td></tr>
	</tbody>
</table>

<form action="citytown_new.php" method="post">
	<input type="hidden" name="lang" value="{{$lang}}">
	<input type="hidden" name="sid" value="{{$sid}}">
	<input type="hidden" name="retpath" value="list">
	<input type="submit" value="{{$LDNeedEmptyFormPls}}">
</form>