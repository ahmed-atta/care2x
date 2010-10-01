<br>
<!--  The search mask  -->
<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
	<tr>
		<td>
			{{$searchMask}}
		</td>
	</tr>
</table>
<br>
{{if $foundCity ne ''}}
	{{$recordsFound}}
	<table border="0" cellpadding="2" cellspacing="1">
		<tr class="wardlisttitlerow">
			<td>{{$name}}</td>	
			<td>{{$iso_country_id}}</td>	
			<td>{{$unece_locode_type}}</td>	
			<td>{{$info_url}}</td>	
		</tr>
		{{foreach from=$result item=i key=id}}
		<tr>
			<td><a href="citytown_info.php{{$URL_APPEND}}&retpath=search&nr={{$i.nr}}">{{$i.name}}</a></td>
			<td>{{$i.iso_country_id}}</td>
			<td>{{$i.unece_locode}}</td>
			<td><a href="{{$i.info_url}}">{{$i.info_url}}</a></td>
		</tr>
		{{/foreach}}
		<tr>
			<td colspan="3">{{$prevLink}}</td>
			<td align="right">{{$nextLink}}</td>
		</tr>
	</table>
{{else}}
	{{$nothingFound}}
{{/if}}



<form action="citytown_new.php" method="post">
	<input type="hidden" name="lang" value="{{$lang}}"> 
	<input type="hidden" name="sid" value="{{$sid}}"> 
	<input type="hidden" name="retpath" value="search"> 
	<input type="submit" value="{{$LDNeedEmptyFormPls}}">
</form>