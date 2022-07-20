<?php
include "config-pdo.php";
include "functions/functions.php";

//header('Content-type: application/json');  
//$API_Url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCA7RxVq2pMGYp_-Qo4S2dEw&key=';
$API_Key = '';

$selectqry = "SELECT id, subscribers, channel_name, profile_url, influencer_category, celebrity from youtube where id in (2,4,5,6)";
$stmt = $con->prepare($selectqry);
$stmt->execute();
$rowcount =  $stmt->rowCount()."<br>";
//echo $rowcount."<br>";
$count = 0;
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
while($row = $stmt->fetch()){
    $id = $row->id;
//    $profile_url = decrypt($row->profile_url);
    $url = explode("/", decrypt($row->profile_url)); // convert string into separate array elements after every /
    $channelID = end($url);
    $influencer_category = $row->influencer_category;
//    echo "ID = ".$row->id." Channel Name = ".decrypt($row->channel_name)." Subscribers = ".$row->subscribers." Channel ID = ".$channelID."<br>";

    $json_details = json_decode(file_get_contents("https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=$channelID&key=$API_Key"),true);
    
    if(array_key_exists("items",$json_details)){
        if(!$json_details['items'][0]['statistics']['hiddenSubscriberCount']){
            $latestsub = $json_details['items'][0]['statistics']['subscriberCount'];
            $latestchannelname = $json_details['items'][0]['snippet']['title'];
            $latestchannelname = encrypt($latestchannelname);
            $latestprofileimage = $json_details['items'][0]['snippet']['thumbnails']['default']['url'];
            if($row->celebrity == "Yes"){
                $influencer_category = "CAT - A";
            }
            elseif($latestsub > 500000){
                $influencer_category = "CAT - A";
            }
            elseif(($latestsub > 100000) && $latestsub <= 500000){
                $influencer_category = "CAT - B";
            }
            else{
                $influencer_category = "CAT - C";
            }
            $updatesub = "UPDATE `youtube` SET `channel_name`=:channel_name, `profile_image`=:profile_image, `subscribers`=:subscribers, `influencer_category`=:influencer_category WHERE `profile_url`=:profile_url";
            $stmt1 = $con->prepare($updatesub);
            $stmt1->execute(["channel_name"=>$latestchannelname,"profile_image"=>$latestprofileimage,
            "subscribers"=>$latestsub,"influencer_category"=>$influencer_category,"profile_url"=>$row->profile_url]);
            $updatemaster = "UPDATE `masteryoutube` SET `channel_name`=:channel_name, `profile_image`=:profile_image, `subscribers`=:subscribers, `influencer_category`=:influencer_category WHERE `profile_url`=:profile_url";
            $stmt2 = $con->prepare($updatemaster);
            $stmt2->execute(["channel_name"=>$latestchannelname,"profile_image"=>$latestprofileimage,
            "subscribers"=>$latestsub,"influencer_category"=>$influencer_category,"profile_url"=>$row->profile_url]); 
            $count++;
        }
    }
}
$subzero = "SELECT id, subscribers, channel_name, profile_url, avg_views, influencer_category, celebrity from youtube where subscribers = 0";
$stmt11 = $con->prepare($subzero);
$stmt11->execute();
$rowcount1 =  $stmt11->rowCount()."<br>";
while($row1 = $stmt11->fetch()){
//    echo "ID = ".$row1->id." Channel Name = ".decrypt($row1->channel_name)." Views = ".$row1->avg_views." Category = ".$row1->influencer_category."<br>";
    $influencer_category = $row1->influencer_category;
    if($row1->celebrity == "Yes"){
        $influencer_category = "CAT - A";
    }
    elseif($row1->avg_views > 100000){
        $influencer_category = "CAT - A";
    }
    elseif(($row1->avg_views > 10000) && ($row1->avg_views <= 100000)){
        $influencer_category = "CAT - B";
    }
    else{
        $influencer_category = "CAT - C";
    }
    $updatesub11 = "UPDATE `youtube` SET `influencer_category`=:influencer_category WHERE `profile_url`=:profile_url";
    $stmt1111 = $con->prepare($updatesub11);
    $stmt1111->execute(["influencer_category"=>$influencer_category,"profile_url"=>$row1->profile_url]);

}

date_default_timezone_set("Asia/Kolkata");
$datenow = date("Y-m-d H:i:s");
$operation = "Subscribers Update";
$comment = "Subscribers count updated of $count youtube channel through YouTube API cron job at $datenow";
$ipaddress = "0.0.0.0";
$browser = "NA";
$userid = "0";
$username = "automatedsystem";
$log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
        `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
$stmt3 = $con->prepare($log);
$stmt3->execute(['userid'=>$userid,'username'=>$username,'operation'=>$operation,
        'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$datenow]);
//echo "Count of Data Update ".$count;
?>
