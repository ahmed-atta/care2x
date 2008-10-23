<a href="<?php echo $updatefile.URL_APPEND.'&encounter_nr='.$HTTP_SESSION_VARS['sess_en'].'&update=1&target='.$target; ?>"><img <?php echo createLDImgSrc($root_path,'update_data.gif','0','top') ?>></a>
<a href="javascript:makeBarcodeLabel('<?php echo $HTTP_SESSION_VARS['sess_en'];  ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_label.gif','0','top') ?>></a>
<a href="javascript:makeWristBands('<?php echo $HTTP_SESSION_VARS['sess_en']; ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_wristband.gif','0','top') ?>></a>
