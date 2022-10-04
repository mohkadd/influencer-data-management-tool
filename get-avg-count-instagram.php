<?php 
include "config-pdo.php";
include "functions/functions.php";
header("Access-Control-Allow-Origin: *");

//get first row id
$getfirstid = "SELECT id from instagram order by id asc limit 1";
$stmtfsid = $con->prepare($getfirstid);
$stmtfsid->execute();
$rowfs = $stmtfsid->fetch();
$firstrowid1 = $rowfs->id;

//get last row id
$getlastid = "SELECT id from instagram order by id desc limit 1";
$stmtlsid = $con->prepare($getlastid);
$stmtlsid->execute();
$rowls = $stmtlsid->fetch();
$lastrowid1 = $rowls->id;

//offset value
$offset = 2;

$updaterowid = "UPDATE inidlikes SET firstrowid = '".$firstrowid1."', lastrowid = '".$lastrowid1."'";
$stmtrd = $con->prepare($updaterowid);
$stmtrd->execute();

$getrowid = "SELECT firstrowid, lastrowid,firstid,lastid from inidlikes";
$stmtrid = $con->prepare($getrowid);
$stmtrid->execute();
$rowr = $stmtrid->fetch();
$firstrowid = $rowr->firstrowid;
$lastrowid = $rowr->lastrowid;
$firstid = $rowr->firstid + 1;
$lastid = $rowr->lastid;
echo "firstrowid from inidlikes table ".$firstrowid." <br>";
echo "lastrowid from inidlikes table ".$lastrowid." <br><br>";

if($firstid == $firstrowid){
    $firstid = $firstrowid;
    $lastid = $offset;
}

//update id instagram id table
$updateid = "UPDATE inidlikes SET firstid = '".$firstid."', lastid = '".$lastid."'";
$stmtmi = $con->prepare($updateid);
$stmtmi->execute();
echo "firstid from inidlikes table ".$firstid." <br>";
echo "lastid from inidlikes table ".$lastid." <br><br>";
//

if($lastid > $lastrowid){
    $lastid = $lastrowid;
}

$selectqry = "SELECT unique_id, handle, followers, avg_likes from instagram where id between ".$firstid." and ".$lastid."";
$stmt = $con->prepare($selectqry);
$stmt->execute();
$rowcount =  $stmt->rowCount()."<br>";
//echo $rowcount."<br>";
$count = 0;

while($row = $stmt->fetch()){
	$userid = decrypt($row->unique_id);
    $handle = $row->handle;
    $followers = $row->followers;
    echo "UserId: ".$userid." Handle: ".$handle." Followers: ".$followers." Avg_Likes: ".$row->avg_likes."<br>";
    
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://instagram28.p.rapidapi.com/medias?user_id=$userid&batch_size=10",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: instagram28.p.rapidapi.com",
            "X-RapidAPI-Key: ",
            "Content-Type: application/json"
        ],
     ]);
    
    $response = curl_exec($curl);
    $response = json_decode($response,true);
    $err = curl_error($curl);

    curl_close($curl);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $j=0;
        $likes = 0;
        while($j < 10){
            @$likes = $likes + $response['data']['user']['edge_owner_to_timeline_media']['edges'][$j]['node']['edge_media_preview_like']['count'];
            // echo $j."=>".$likes."<br>";
            $j++;
        }
        $avglikes = ceil($likes/10);
        $j = 0;
        echo "Avg Likes ".$avglikes."<br>";
        $updatelikes = "UPDATE instagram SET avg_likes=:avg_likes WHERE unique_id=:unique_id";
        $stmt1 = $con->prepare($updatelikes);
        $stmt1->execute(["avg_likes"=>$avglikes,"unique_id"=>encrypt($userid)]);
        $updatemasterlikes = "UPDATE instagram SET avg_likes=:avg_likes WHERE unique_id=:unique_id";
        $stmt101 = $con->prepare($updatemasterlikes);
        $stmt101->execute(["avg_likes"=>$avglikes,"unique_id"=>encrypt($userid)]);
        $count++;
    }
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
$updateid2 = "UPDATE inidlikes SET firstid = '".$firstid."', lastid = '".$lastid."'";
$stmtmi2 = $con->prepare($updateid2);
$stmtmi2->execute();

date_default_timezone_set("Asia/Kolkata");
$datenow = date("Y-m-d H:i:s");
$operation = "Avg likes Update";
$comment = "Avg Likes has been updated of $offset instagram handles through Instagram API cron job at $datenow";
$ipaddress = "0.0.0.0";
$browser = "NA";
$userid = "0";
$username = "automatedsystem";
$log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
        `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
$stmt31 = $con->prepare($log);
$stmt31->execute(['userid'=>$userid,'username'=>$username,'operation'=>$operation,
        'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$datenow]);

echo "$count instagram handles updated<br><br>";
?>