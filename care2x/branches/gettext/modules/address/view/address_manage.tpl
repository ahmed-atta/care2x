<table border=0 cellpadding=5>
{{foreach from=$menu key=id item=i}}
	<tr>
		<td>
			<a href="{{$i.link}}">
				<img {{$i.icon}}>
			</a>
		</td>
		<td>
			<a href="{{$i.link}}">
				<b><font color="#990000"><a href="{{$i.link}}">{{$i.linkname}}</font></b>
			</a>
			<br>
			{{$i.description}}
		</td>
	</tr>
{{/foreach}}
</table>