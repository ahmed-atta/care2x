<?php

//gjergji
//used to calculate the max_rows per column
$SQLStatementNum = "SELECT id,name,status FROM care_test_param WHERE status NOT IN ('deleted','hidden') ORDER BY name"; 
$rowNum = $db->Execute($SQLStatementNum);
$numRows = $rowNum->numRows();
$max_row = round($numRows / 7);


//gjergji : thanx to Robert Mengle for the idea...a for the code also :)
$SQLStatement = "SELECT id , name FROM care_test_param WHERE group_id = -1 AND status NOT IN ('deleted','hidden') ORDER BY sort_nr";
$top_rs = $db->Execute($SQLStatement);

if(!empty($top_rs) && isset($top_rs)) {
    $column=0;
    $row=-1;
    while ($categories = $top_rs->FetchRow()) {
        $row++;
        if($row>=$max_row) {
            $column++;
            $row=0;
        }
        $LD_Elements[$column][$row]['type'] = 'top';
        $LD_Elements[$column][$row]['value'] = strtoupper($categories['name']);
        $LD_Elements[$column][$row]['id'] = $categories['id'];
        $SQLStatementParam = "SELECT id,name,status FROM care_test_param WHERE group_id = '".$categories['id']."' AND status NOT IN ('deleted','hidden') ORDER BY name"; 
        $row_rs = $db->Execute($SQLStatementParam);
        if(!empty($row_rs) && isset($row_rs)) {
            while ($parameters = $row_rs->FetchRow()) {
                $row++;
                if($row>=$max_row) {
                    $column++;
                    $row=0;
                }
            $LD_Elements[$column][$row]['type'] = 'normal';
            $LD_Elements[$column][$row]['value'] = $parameters['name'];
            $LD_Elements[$column][$row]['id'] = $parameters['id'];
            }
        }
    }
}