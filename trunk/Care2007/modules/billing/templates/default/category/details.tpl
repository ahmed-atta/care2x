<form name="frmpost"
	action="index.php?module=category&view=save&submit={$smarty.get.submit}"
	method="post">


{if $smarty.get.action== 'view' }

	<b>{$LANG.category} ::
	<a href="index.php?module=category&view=details&submit={$category.id}&action=edit">{$LANG.edit}</a></b>
	
 	<hr></hr>

	<table align="center">
	<tr>
		<td class="details_screen">{$LANG.category_id}</td><td>{$category.id}</td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.category_name}</td>
		<td>{$category.name}</td>
	</tr>
<!--	<tr>
		<td class="details_screen">{$LANG.product_unit_price}</td>
		<td>{$product.unit_price}</td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf1} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td>{$product.custom_field1}</td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf2} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td>{$product.custom_field2}</td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf3} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td>{$product.custom_field3}</td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf4} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td>{$product.custom_field4}</td>
	</tr>
-->
	<tr>
		<td class="details_screen">{$LANG.notes}</td><td>{$category.notes}</td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.category_enabled}</td>
		<td>{$category.wording_for_enabled}</td>
	</tr>
	</table>

<hr></hr>
<a href="index.php?module=category&view=details&submit={$category.id}&action=edit">{$LANG.edit}</a>
{/if}


{if $smarty.get.action== 'edit' }

	<b>{$LANG.category_edit}</b>
	<hr></hr>

	<table align="center">
	<tr>
		<td class="details_screen">{$LANG.category_id}</td><td>{$category.id}</td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.category_name}</td>
		<td><input type="text" name="name" size="50" value="{$category.name}" /></td>
	</tr>
<!--	<tr>
		<td class="details_screen">{$LANG.product_unit_price}</td>
		<td><input type="text" name="unit_price" size="25" value="{$product.unit_price}" /></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf1} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type="text" name="custom_field1" size="50" value="{$product.custom_field1}" /></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf2} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type="text" name="custom_field2" size="50" value="{$product.custom_field2}" /></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf3} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type="text" name="custom_field3" size="50" value="{$product.custom_field3}" /></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.product_cf4} <a href="docs.php?t=help&p=custom_fields" rel="gb_page_center[450, 450]"><img src="./images/common/help-small.png"></img></a></td>
		<td><input type="text" name="custom_field4" size="50" value="{$product.custom_field4}" /></td>
	</tr>
-->
	<tr>
		<td class="details_screen">{$LANG.notes}</td>
		<td><textarea name="notes" rows="8" cols="50">{$category.notes}</textarea></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.category_enabled}</td>
		<td>
			{html_options name=enabled options=$enabled selected=$category.enabled}
		</td>
	</tr>
	</table>
{/if} 
{if $smarty.get.action== 'edit' }
	<hr></hr>
		<input type="submit" name="cancel" value="{$LANG.cancel}" /> 
		<input type="submit" name="save_category" value="{$LANG.save_category}" /> 
		<input type="hidden" name="op" value="edit_category" /> 
	{/if}
</form>
