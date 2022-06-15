<?php
//ini_set('max_execution_time', 300);
include "config-pdo.php";
include "functions/functions.php";

//get first row id
$getfirstid = "SELECT id from youtube order by id asc limit 1";
$stmtfsid = $con->prepare($getfirstid);
$stmtfsid->execute();
$rowfs = $stmtfsid->fetch();
$firstrowid1 = $rowfs->id;
echo "firstrowid from youtube table $firstrowid1 <br>";
//get last row id
$getlastid = "SELECT id from youtube order by id desc limit 1";
$stmtlsid = $con->prepare($getlastid);
$stmtlsid->execute();
$rowls = $stmtlsid->fetch();
$lastrowid1 = $rowls->id;
echo "lastrowid from youtube table $lastrowid1 <br><br>";

//offset value
$offset = 20;

$updaterowid = "UPDATE ytid SET firstrowid = '".$firstrowid1."', lastrowid = '".$lastrowid1."'";
$stmtrd = $con->prepare($updaterowid);
$stmtrd->execute();

$getrowid = "SELECT firstrowid, lastrowid,firstid,lastid from ytid";
$stmtrid = $con->prepare($getrowid);
$stmtrid->execute();
$rowr = $stmtrid->fetch();
$firstrowid = $rowr->firstrowid;
$lastrowid = $rowr->lastrowid;
$firstid = $rowr->firstid;
$lastid = $rowr->lastid;
echo "firstrowid from ytid table ".$firstrowid." <br>";
echo "lastrowid from ytid table ".$lastrowid." <br><br>";

if($firstid == $firstrowid){
    $firstid = $firstrowid;
    $lastid = $offset;
}

//update id youtube id table
$updateid = "UPDATE ytid SET firstid = '".$firstid."', lastid = '".$lastid."'";
$stmtmi = $con->prepare($updateid);
$stmtmi->execute();
echo "firstid from ytid table ".$firstid." <br>";
echo "lastid from ytid table ".$lastid." <br><br>";
//

if($lastid > $lastrowid){
    $lastid = $lastrowid;
}

$selectqry = "SELECT * from youtube where id between ".$firstid." and ".$lastid."";
$stmt = $con->prepare($selectqry);
$stmt->execute();
while($row = $stmt->fetch()){
    echo $row->id."<br>";
}

if($lastid == $lastrowid){
    $firstid = $firstrowid;
    $lastid = $offset;
}
else{
    $firstid = $lastid;
    $lastid = $lastid + $offset;
}

//update id youtube id table
$updateid2 = "UPDATE ytid SET firstid = '".$firstid."', lastid = '".$lastid."'";
$stmtmi2 = $con->prepare($updateid2);
$stmtmi2->execute();

?>