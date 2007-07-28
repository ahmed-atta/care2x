{if $categories == null }
	<P><em>{$LANG.no_categories}</em></p>
{else}


<h3>{$LANG.manage_category} :: <a href="index.php?module=category&view=add">{$LANG.add_new_category}</a></h3>

 <hr />

<table align="center" class="ricoLiveGrid" id="rico_category">
<colgroup>
	<col style='width:10%;' />
	<col style='width:10%;' />
	<col style='width:60%;' />
<!--	<col style='width:20%;' /> -->
	<col style='width:20%;' />
</colgroup>
<thead>
<tr class="sortHeader">
	<th class="noFilter sortable">{$LANG.actions}</th>
	<th class="index_table sortable">{$LANG.category_id}</th>
	<th class="index_table sortable">{$LANG.category_name}</th>
<!--	<th class="index_table sortable">{$LANG.product_unit_price}</th> -->
	<th class="noFilter index_table sortable">{$LANG.enabled}</th>
</tr>
</thead>


{foreach from=$categories item=category}
	<tr class="index_table">
	<td class="index_table">
	<a class="index_table"
	 href="index.php?module=category&view=details&submit={$category.id}&action=view">{$LANG.view}</a> ::
	<a class="index_table"
	 href="index.php?module=category&view=details&submit={$category.id}&action=edit">{$LANG.edit}</a> </td>
	<td class="index_table">{$category.id}</td>
	<td class="index_table">{$category.name}</td>
<!--	<td class="index_table">{$category.unit_price}</td>  -->
	<td class="index_table">{$category.enabled}</td>
	</tr>

{/foreach}

	</table>
{/if}
