<tr>
    <td align="right">{$field->label}:</td>
    <td align="left">
        <select name='FIELDS[{$field->name}]'>
            {html_options values=$field->values output=$field->options selected=$field->default}
        </select>
    </td>
</tr>
