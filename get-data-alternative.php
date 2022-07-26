<?php
include "config-pdo.php";
include "functions/functions.php";

$selectqry = "SELECT unique_id, handle, followers from instagram where id = 13";
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
        CURLOPT_URL => "https://instagram174.p.rapidapi.com/api/v1/user/196490967/info",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: instagram174.p.rapidapi.com",
            "X-RapidAPI-Key: cc64a88bbfmsh7fdd5714f1ee4c5p1a304fjsnb4e1953cdb17"
        ],
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response,true);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
       print_r($response);
    }
}