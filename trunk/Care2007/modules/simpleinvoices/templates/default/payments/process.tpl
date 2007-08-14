<form name="frmpost" action="index.php?module=payments&view=save" method="post" onsubmit="return frmpost_Validator(this)">
<h3>{$LANG.process_payment}</h3>
 <hr />
 

{if $smarty.get.op === "pay_selected_invoice"}

<table align="center">	
<tr>
	<td class="details_screen">{$LANG.invoice_id}</td>
	<td><input type="hidden" name="ac_inv_id" value="{$invoice.id}" />{$invoice.id}</td>
	<td class="details_screen">{$LANG.total}</td><td>{$invoice.total_format}</td>
</tr>
<tr>
	<td class="details_screen">{$LANG.biller}</td>
	<td>{$biller.name}</td>
	<td class="details_screen">{$LANG.paid}</td>
	<td>{$invoice.paid_format}</td>
</tr>
<tr>
	<td class="details_screen">{$LANG.customer}</td>
	<td>{$customer.name}</td>
	<td class="details_screen">{$LANG.owing}</td>
	<td><u>{$invoice.owing}</u></td>
</tr>
<tr>
	<td class="details_screen">{$LANG.amount}</td>
	<td colspan="5"><input type="text" name="ac_amount" size="25" value="{$invoice.owing1}" /><a href="docs.php?t=help&p=process_payment_auto_amount" rel="gb_page_center.450, 450"><img src="./images/common/help-small.png"></img></a></td>
</tr>
<tr>
	<td class="details_screen">{$LANG.date_formatted}</td>
	<td><input type="text" class="date-picker" name="ac_date" id="date1" value="{$today}" /></td>
</tr>
<tr>
	<td class="details_screen">{$LANG.payment_type_method}</td>
	<td>

{/if}


{if $smarty.get.op === "pay_invoice"}
	
<table align="center">
<tr>
	<td class="details_screen">{$LANG.invoice_id}
	<a href="docs.php?t=help&p=process_payment_inv_id" rel="gb_page_center.450, 450"><img src="./images/common/help-small.png"></img></a></td>
	<td><input type="text" id="ac_me" name="ac_inv_id" /></td>
</tr>
<tr>
	<td class="details_screen">{$LANG.details}
	<a href="docs.php?t=help&p=process_payment_details" rel="gb_page_center.450, 450"><img src="./images/common/help-small.png"></img></a></td>
	<td id="js_total"><i>{$LANG.select_invoice}</i> </td>
</tr>
<tr>
	<td class="details_screen">{$LANG.amount}</td>
	<td colspan="5"><input type="text" name="ac_amount" size="25" /></td>
</tr>
<tr>
	<div class="demo-holder">
		<td class="details_screen">{$LANG.date_formatted}</td>
		<td><input type="text" class="date-picker" name="ac_date" id="date1" value="{$today}" /></td>
	</div>
</tr>
<tr>
	<td class="details_screen">{$LANG.payment_type_method}</td>
	<td>
{/if}


{if $paymentTypes == null}
	<p><em>{$LANG.no_payment_types}</em></p>
{else}

<select name="ac_payment_type">
<option selected value="{$defaults.payment_type}" style="font-weight: bold">{$pt.pt_description}</option>

	{foreach from=$paymentTypes item=paymentType}
		<option value="{$paymentType.pt_id}">
		{$paymentType.pt_description}</option>
	{/foreach}
{/if}


	
	</td>
</tr>
<tr>
	<td class="details_screen">{$LANG.note}</td>
	<td colspan="5"><textarea name="ac_notes" rows="5" cols="50"></textarea></td>
</tr>
</table>


<hr />
<div style="text-align:center;">
	<input type="submit" name="process_payment" value="{$LANG.process_payment}">
</div>
</form>

