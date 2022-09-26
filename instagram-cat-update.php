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
?>