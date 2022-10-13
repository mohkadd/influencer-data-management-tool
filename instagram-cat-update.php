<?php 
include "config-pdo.php";
include "functions/functions.php";

$selectqry = "SELECT unique_id, followers, verified, celebrity from instagram";
$stmt = $con->prepare($selectqry);
$stmt->execute();

while($row = $stmt->fetch()){
    $unique_id = $row->unique_id;
    $followers = $row->followers;
    $verified = $row->verified;
    $celebrity = $row->celebrity;

    if($verified == "Yes"){
        $influencer_category = "CAT - A";
    }
    elseif($celebrity == "Yes"){
        $influencer_category = "CAT - A";
    }
    elseif($followers > 500000){
        $influencer_category = "CAT - A";
    }
    elseif(($followers > 100000) && ($followers <= 500000)){
        $influencer_category = "CAT - B";
    }
    else{
        $influencer_category = "CAT - C";
    }

    $updatefol = "UPDATE `instagram` SET `influencer_category`=:influencer_category WHERE `unique_id`=:unique_id";
    $stmt1 = $con->prepare($updatefol);
    $stmt1->execute(["influencer_category"=>$influencer_category,"unique_id"=>$unique_id]);
    $updatemaster = "UPDATE `masterinstagram` SET `influencer_category`=:influencer_category WHERE `unique_id`=:unique_id";
    $stmt2 = $con->prepare($updatemaster);
    $stmt2->execute(["influencer_category"=>$influencer_category,"unique_id"=>$unique_id]);
}

date_default_timezone_set("Asia/Kolkata");
$datenow = date("Y-m-d H:i:s");
$operation = "Category Update";
$comment = "Automated instagram category updated with cron job at $datenow";
$ipaddress = "0.0.0.0";
$browser = "NA";
$userid = "0";
$username = "automatedsystem";
$log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
        `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
$stmt31 = $con->prepare($log);
$stmt31->execute(['userid'=>$userid,'username'=>$username,'operation'=>$operation,
        'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$datenow]);
?>