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
$offset = 4;

$updaterowid = "UPDATE inidfollowers SET firstrowid = '".$firstrowid1."', lastrowid = '".$lastrowid1."'";
$stmtrd = $con->prepare($updaterowid);
$stmtrd->execute();

$getrowid = "SELECT firstrowid, lastrowid,firstid,lastid from inidfollowers";
$stmtrid = $con->prepare($getrowid);
$stmtrid->execute();
$rowr = $stmtrid->fetch();
$firstrowid = $rowr->firstrowid;
$lastrowid = $rowr->lastrowid;
$firstid = $rowr->firstid;
$lastid = $rowr->lastid;
echo "firstrowid from inidfollowers table ".$firstrowid." <br>";
echo "lastrowid from inidfollowers table ".$lastrowid." <br><br>";

if($firstid == $firstrowid){
    $firstid = $firstrowid;
    $lastid = $offset;
}

//update id instagram id table
$updateid = "UPDATE inidfollowers SET firstid = '".$firstid."', lastid = '".$lastid."'";
$stmtmi = $con->prepare($updateid);
$stmtmi->execute();
echo "firstid from inidfollowers table ".$firstid." <br>";
echo "lastid from inidfollowers table ".$lastid." <br><br>";
//

if($lastid > $lastrowid){
    $lastid = $lastrowid;
}


$selectqry = "SELECT unique_id, handle, followers from instagram where id between ".$firstid." and ".$lastid."";
$stmt = $con->prepare($selectqry);
$stmt->execute();
$rowcount =  $stmt->rowCount()."<br>";
//echo $rowcount."<br>";
$count = 0;

while($row = $stmt->fetch()){
	$userid = decrypt($row->unique_id);
    $handle = $row->handle;
    $followers = $row->followers;
    echo "UserId: ".$userid." Handle: ".$handle." Followers: ".$followers."<br>";
    
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://instagram28.p.rapidapi.com/username?user_id=$userid",
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
    
    if ($err){
        echo "cURL Error #:" . $err;
    } 
    else{
        
        echo "User ID from API => ".$response['user']['pk']."<br>";
        echo "Username from API => ".$response['user']['username']."<br>";
        $newusername = $response['user']['username'];
        // $newusername = encrypt($newusername);
        echo "Profile URL from API => https://www.instagram.com/".$response['user']['username']."<br>";
        $newurl = "https://www.instagram.com/".$response['user']['username'];
        $newurl = encrypt($newurl);
        echo "Full Name from API ".$response['user']['full_name']."<br>";
        $newname = encrypt($response['user']['full_name']);
        echo "Is Verified? from API => ".$response['user']['is_verified']."<br>";
       if($response['user']['is_verified'] == 1){
           $verified = "Yes";
       }
       else{
           $verified = "No";
       }
        echo "Follower Count from API ".number_format($response['user']['follower_count'])."<br>";
        $newfollower = $response['user']['follower_count'];
        echo $newfollower."<br>";
        echo "Profile Picture URL from API => ".$response['user']['profile_pic_url']."<br><br><br>";
        $count++;
        $updatefol = "UPDATE instagram SET handle=:handle, profile_url=:profile_url,followers=:followers, verified=:verified WHERE unique_id=:unique_id";
        $stmt1 = $con->prepare($updatefol);
        $stmt1->execute(["handle"=>$newusername,"profile_url"=>$newurl,"followers"=>$newfollower,"verified"=>$verified,"unique_id"=>encrypt($userid)]);
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

//update id instagram id table
$updateid2 = "UPDATE inidfollowers SET firstid = '".$firstid."', lastid = '".$lastid."'";
$stmtmi2 = $con->prepare($updateid2);
$stmtmi2->execute();

date_default_timezone_set("Asia/Kolkata");
$datenow = date("Y-m-d H:i:s");
$operation = "Followers Update";
$comment = "Followers has been updated of $offset instagram handles through Instagram API cron job at $datenow";
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