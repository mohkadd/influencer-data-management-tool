<?php
include "config-pdo.php";
include "functions/functions.php";

//header('Content-type: application/json');  
//$API_Url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCA7RxVq2pMGYp_-Qo4S2dEw&key=AIzaSyClR56gbTmK3BhSka8UdrV8bjLYmJYHqSk';
$API_Key = 'AIzaSyClR56gbTmK3BhSka8UdrV8bjLYmJYHqSk';

$selectqry = "SELECT id, subscribers, channel_name, profile_url from youtube";
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
//    echo "ID = ".$row->id." Channel Name = ".decrypt($row->channel_name)." Subscribers = ".$row->subscribers." Channel ID = ".$channelID."<br>";

    $json_details = json_decode(file_get_contents("https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=$channelID&key=$API_Key"),true);
    
    if(array_key_exists("items",$json_details)){
        if(!$json_details['items'][0]['statistics']['hiddenSubscriberCount']){
            $latestsub = $json_details['items'][0]['statistics']['subscriberCount'];
            $updatesub = "UPDATE `youtube` SET `subscribers`=:subscribers WHERE `profile_url`=:profile_url";
            $stmt1 = $con->prepare($updatesub);
            $stmt1->execute(["subscribers"=>$latestsub,"profile_url"=>$row->profile_url]);
            $updatemaster = "UPDATE `masteryoutube` SET `subscribers`=:subscribers WHERE `profile_url`=:profile_url";
            $stmt2 = $con->prepare($updatemaster);
            $stmt2->execute(["subscribers"=>$latestsub,"profile_url"=>$row->profile_url]);
//            echo $latestsub."<br>"; 
            $count++;
        }
    }
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