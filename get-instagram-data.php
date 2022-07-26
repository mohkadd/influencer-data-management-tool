<?php 
include "config-pdo.php";
include "functions/functions.php";
header("Access-Control-Allow-Origin: *");

$selectqry = "SELECT unique_id, handle, followers from instagram where id = 10";
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
            "X-RapidAPI-Key: cc64a88bbfmsh7fdd5714f1ee4c5p1a304fjsnb4e1953cdb17",
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
        
//         echo "User ID from API => ".$response['user']['pk']."<br>";
//         echo "Username from API => ".$response['user']['username']."<br>";
//         $newusername = $response['user']['username'];
//         $newusername = encrypt($newusername);
//         echo "Profile URL from API => https://www.instagram.com/".$response['user']['username']."/<br>";
//         $newurl = "https://www.instagram.com/".$response['user']['username'];
//         $newurl = encrypt($newurl);
//         echo "Full Name from API ".$response['user']['full_name']."<br>";
//         $newname = encrypt($response['user']['full_name']);
//         echo "Is Verified? from API => ".$response['user']['is_verified']."<br>";
//        if($response['user']['is_verified'] == 1){
//            $verified = "Yes";
//        }
//        else{
//            $verified = "No";
//        }
//         echo "Follower Count from API ".number_format($response['user']['follower_count'])."<br>";
         $newfollower = $response['user']['follower_count'];
        echo $newfollower."<br>";
//         echo "Profile Picture URL from API => ".$response['user']['profile_pic_url']."<br><br><br>";
        $count++;
        $updatefol = "UPDATE instagram SET followers=:followers WHERE unique_id=:unique_id";
        $stmt1 = $con->prepare($updatefol);
        $stmt1->execute(["followers"=>$newfollower,"unique_id"=>$userid]);
    }
}
echo "$count instagram handles updated";
?>