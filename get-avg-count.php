<?php
//ini_set('max_execution_time', 300);
include "config-pdo.php";
include "functions/functions.php";

//header('Content-type: application/json');  
//$API_Url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCA7RxVq2pMGYp_-Qo4S2dEw&key=AIzaSyClR56gbTmK3BhSka8UdrV8bjLYmJYHqSk';
$API_Key = 'AIzaSyClR56gbTmK3BhSka8UdrV8bjLYmJYHqSk';
//get first row id
$getfirstid = "SELECT id from youtube order by id asc limit 1";
$stmtfsid = $con->prepare($getfirstid);
$stmtfsid->execute();
$rowfs = $stmtfsid->fetch();
$firstid = $rowfs->id;

//offset value
$offset = 40;

//get last row id
$getlastid = "SELECT id from youtube order by id desc limit 1";
$stmtlsid = $con->prepare($getlastid);
$stmtlsid->execute();
$rowls = $stmtlsid->fetch();
$lastid = $rowls->id;

$selectqry = "SELECT * from youtube where id between $lastid and $newid";
$stmt = $con->prepare($selectqry);
$stmt->execute();
$rowcount =  $stmt->rowCount()."<br>";
//echo $rowcount."<br>";
$subcount = 0;$vidcount = 0;$avgcount = 0;
$rescount = 10;$views = 0;$likes = 0;
$i = 0;$j = 1;
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
while($row = $stmt->fetch()){
    $id = $row->id;
//    $profile_url = decrypt($row->profile_url);
    $url = explode("/", decrypt($row->profile_url)); // convert string into separate array elements after every /
    $channelID = end($url);
    echo "ID = ".$row->id." Channel Name = ".decrypt($row->channel_name)." Subscribers = ".$row->subscribers." Channel ID = ".$channelID." Avg Views = ".$row->avg_views."Avg Likes = ".$row->avg_likes."<br>";

    $videoID = array();
    $vids_json_details = json_decode(file_get_contents("https://youtube.googleapis.com/youtube/v3/search?part=snippet,id&order=date&maxResults=10&channelId=$channelID&key=$API_Key"), true);
    while($vidcount < 10){
       array_push($videoID, $vids_json_details['items'][$vidcount]['id']['videoId']);
        $vidcount++;
    }
//    $videoID = $vids_json_details;
//    echo "<pre>";
//    print_r($videoID);
//    echo "</pre>";
//    echo "Video Count is ".count($videoID)."<br>";

    $videos = array();
    foreach($videoID as $x => $val){
        $count_json_details = json_decode(file_get_contents("https://youtube.googleapis.com/youtube/v3/videos?part=statistics&id=$videoID[$x]&key=$API_Key"), true);
        array_push($videos, $count_json_details['items'][0]['statistics']);
        //        echo $subcount." ".$count_json_details['items'][$x]['statistics']['viewCount']." <br>";
//        echo $subcount." ".$count_json_details['items'][$x]['statistics']['likeCount']." <br>";
    }
//    echo "<pre>";
//        print_r($videos);
//        echo "</pre>";
    while($i < count($videoID)){
        if(array_key_exists("viewCount",$videos[$i])){
            $views = $views + $videos[$i]['viewCount'];
        }
        else{
            $views = 0;
        }
        
        if(array_key_exists("likeCount",$videos[$i])){
            $likes = $likes + $videos[$i]['likeCount'];
        }
        else{
            $likes = 0;
        }        
//        echo $j.") Views ".$videos[$i]['viewCount']." Likes ".$videos[$i]['likeCount']."<br>";
//        echo "Likes ".$videos[$i]['likeCount']."<br>";
        $i++;$j++;
    }
    $avg_views = ceil($views/10);
    $avg_likes = ceil($likes/10);
    echo "<br>Avg Views ".$avg_views." Avg Likes ".$avg_likes."<br>";
    $updatelikeview = "UPDATE `youtube` SET `avg_views`=:avg_views, `avg_likes`=:avg_likes WHERE `profile_url`=:profile_url";
    $stmt1 = $con->prepare($updatelikeview);
    $stmt1->execute(["avg_views"=>$avg_views,"avg_likes"=>$avg_likes,"profile_url"=>$row->profile_url]);
    $updatemaster = "UPDATE `masteryoutube` SET `avg_views`=:avg_views, `avg_likes`=:avg_likes WHERE `profile_url`=:profile_url";
    $stmt2 = $con->prepare($updatemaster);
    $stmt2->execute(["avg_views"=>$avg_views,"avg_likes"=>$avg_likes,"profile_url"=>$row->profile_url]);
    $subcount = 0;$vidcount = 0;$avgcount = 0;
    $rescount = 10;
    $views = 0;$likes = 0;
    $i = 0;$j = 1;
}

date_default_timezone_set("Asia/Kolkata");
$datenow = date("Y-m-d H:i:s");
$operation = "Avg views, Avg likes Update";
$comment = "Avg Views and Avg Likes has been updated of youtube channels through YouTube API cron job at $datenow";
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