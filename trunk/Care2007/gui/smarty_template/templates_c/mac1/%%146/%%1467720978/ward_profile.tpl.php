<?php /* Smarty version 2.6.0, created on 2004-07-06 23:35:52
         compiled from nursing/ward_profile.tpl */ ?>

<ul>
<table>
  <tbody>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDStation']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['name']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDWard_ID']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['ward_id']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDDept']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['dept_name']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDDescription']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['description']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoom1Nr']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['room_nr_start']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoom2Nr']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['room_nr_end']; ?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDRoomPrefix']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['roomprefix']; ?>
</td>
    </tr>
   <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDCreatedOn']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['date_create']; ?>
</td>
    </tr>
   <tr>
      <td class="adm_item"><?php echo $this->_tpl_vars['LDCreatedBy']; ?>
</td>
      <td class="adm_input" colspan="2"><?php echo $this->_tpl_vars['create_id']; ?>
</td>
    </tr>

  <?php if ($this->_tpl_vars['bShowRooms']): ?>
   <tr>
      <td class="adm_item" colspan="3">&nbsp;</td>
    </tr>
   <tr  class="wardlisttitlerow">
      <td><?php echo $this->_tpl_vars['LDRoom']; ?>
</td>
      <td><?php echo $this->_tpl_vars['LDBedNr']; ?>
</td>
      <td><?php echo $this->_tpl_vars['LDRoomShortDescription']; ?>
</td>
    </tr>
	
	<?php echo $this->_tpl_vars['sRoomRows']; ?>

  
  <?php endif; ?>

  </tbody>
</table>
<p>

<table width="100%">
  <tbody>
    <tr valign="top">
      <td><?php echo $this->_tpl_vars['sClose']; ?>
</td>
      <td align="right"><?php echo $this->_tpl_vars['sWardClosure']; ?>
</td>
    </tr>
  </tbody>
</table>

</ul>