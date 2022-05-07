<?php
// The function header by sending raw excel
// header("Content-type: application/vnd-ms-excel");
header("Content-type: text/x-csv");
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=ANCIAPP-contactformdata.csv");
// Add data table
// include 'abstractexcel.php';
include ('config.php');

//query get data
$sql = mysqli_query($connect, "SELECT  name, email, contactno, city, message, contacttime FROM contactformanciapp");
$csv_export = '';
$field = mysqli_field_count($connect);

// create line with field names
for($i = 0; $i < $field; $i++) {
    $csv_export.= mysqli_fetch_field_direct($sql, $i)->name.',';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
while($row = mysqli_fetch_array($sql)) {
    // create line with field values
    for($i = 0; $i < $field; $i++) {
        $csv_export.= '"'.$row[mysqli_fetch_field_direct($sql, $i)->name].'",';
    }
    $csv_export.= '
';
}
echo($csv_export);
?>