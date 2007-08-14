{* if customer is updated or saved.*} 

{if $smarty.post.name != "" && $smarty.post.submit != null } 
{$refresh_total}

<br />
<br />
{$display_block} 
<br />
<br />

{else}
{* if  name was inserted *} 
	{if $smarty.post.submit !=null} 
		<div class="validation_alert"><img src="./images/common/important.png"</img>
		You must enter a name for a category</div>
		<hr />
	{/if}
<form name="frmpost" ACTION="index.php?module=category&view=add" METHOD="POST">

<div id="top"><h3>&nbsp;{$LANG.category_to_add}&nbsp;</h3></div>
 <hr />

<table align=center>
	<tr>
		<td class="details_screen">{$LANG.category_name} <a href="docs.php?t=help&p=required_field" rel="gb_page_center[350, 150]"><img src="./images/common/required-small.png"></img></a></td>
		<td><input type=text name="name" value="{$smarty.post.name}" size=50></td>
	</tr>
<!--	<tr>
		<td class="details_screen">{$LANG.product_unit_price}</td>
		<td><input type=text name="unit_price" value="{$smarty.post.unit_price}"  size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf1} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="custom_field1" value="{$smarty.post.custom_field1}"  size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf2} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="custom_field2" value="{$smarty.post.custom_field2}" size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf3} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="custom_field3" value="{$smarty.post.custom_field3}" size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf4} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="custom_field4" value="{$smarty.post.custom_field4}" size=50></td>
	</tr>  
-->

	<tr>
		<td class="details_screen">{$LANG.notes}</td>
		<td><textarea input type=text name='notes' rows=8 cols=50>{$smarty.post.notes}</textarea></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.category_enabled}</td>
		<td>
			{html_options name=enabled options=$enabled selected=1}
		</td>
	</tr>
</table>
<!-- </div> -->
<hr />
<div style="text-align:center;">
	<input type=submit name="submit" value="{$LANG.insert_category}">
	<input type=hidden name="op" value="insert_category">
</div>
</form>
	{/if}
