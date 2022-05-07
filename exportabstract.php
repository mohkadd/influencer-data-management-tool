<?php
// The function header by sending raw excel
// header("Content-type: application/vnd-ms-excel");
header("Content-type: text/x-csv");
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=ANCIAPP-abstractdata.csv");
// Add data table
include 'abstractexcel.php';
?>