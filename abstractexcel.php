<?php

 include ('config.php');

//query get data
$sql = mysqli_query($connect, "SELECT  abs_name, abs_email, abs_phone, abs_city, abs_message, abs_category, abs_ticketNo, abs_uploadfile FROM abstractanciapp");
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
// $no = 1;
?>

