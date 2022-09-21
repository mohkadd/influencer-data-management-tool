<?php 
include 'config-pdo.php';
session_start();
date_default_timezone_set("Asia/Calcutta");
$date = date("Y-m-d");
$added_on = date('Y-m-d H:i:s');
$added_by = $_SESSION['admin_username'];
$updated_on = "0000-00-00 00:00:00";
$updated_by = $_SESSION['admin_username'];
define("encryption_method", "AES-128-CBC");
define("key", "enlyft@2022#$%");
define("iv", "dataencrypt@2022");
function encrypt($data) {
    $key = key;
    $plaintext = $data;
    $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
    $iv = iv;
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
    return $ciphertext;
}
function decrypt($data) {
    $key = key;
    $c = base64_decode($data);
    $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
    $iv = iv;
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    if (hash_equals($hmac, $calcmac))
    {
        return $original_plaintext;
    }
}
function cleanup( $data ) {
//    global $con;
    $data = trim( $data );
    $data = htmlspecialchars( $data );
//    $data = mysqli_real_escape_string($con, $data);
    return $data;
}
function checkemptystring($data){
    if(empty($data)){
        $data = "NA";
    }
    return $data;
}
function checkemptynumber($data){
    if(empty($data)){
        $data = 0;
    }
    return $data;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['uploadfile'])){
    $validextension = array('xlsx');

    $uploadog = $_FILES['uploadfile']['name'];
    $uploadfile=$_FILES['uploadfile']['tmp_name'];
    
    $ext = strtolower(pathinfo($uploadog, PATHINFO_EXTENSION));
    
    if(in_array($ext, $validextension)){
        require 'PHPExcel1/Classes/PHPExcel.php';
        require_once 'PHPExcel1/Classes/PHPExcel/IOFactory.php';
        $error = 0;
        $impcount = 0;
        $objExcel=PHPExcel_IOFactory::load($uploadfile);
        foreach($objExcel->getWorksheetIterator() as $worksheet)
        {
            $highestrow=$worksheet->getHighestRow();

            for($row=0;$row<=$highestrow;$row++)
            {

                $unique_id = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
                $unique_id = cleanup($unique_id);
                if(is_numeric($unique_id) == 1){
                    $intid = 1;
                }
                else{
                    $intid = 0;
                }
                $influencer_name = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
                $influencer_name = cleanup($influencer_name);
                $handle = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
                $handle = cleanup($handle);
                $profile_url = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
                $profile_url = cleanup($profile_url);
                $followers = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
                $followers = checkemptynumber(cleanup($followers));
                $genre = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
                $genre = ucwords($genre);
                $genre = checkemptystring(cleanup($genre));
                $language = $worksheet->getCellByColumnAndRow(6,$row)->getValue();
                $language = ucwords($language);
                $language = cleanup($language);
                $verified = $worksheet->getCellByColumnAndRow(7,$row)->getValue();
                $verified = ucwords($verified);
                $verified = cleanup($verified);
                $gender = $worksheet->getCellByColumnAndRow(8,$row)->getValue();
                $gender = ucwords($gender);
                $gender = cleanup($gender);
                $enlyft_exclusive = $worksheet->getCellByColumnAndRow(9,$row)->getValue();
                $enlyft_exclusive = ucwords($enlyft_exclusive);
                $enlyft_exclusive = cleanup($enlyft_exclusive);
                $image_cost = $worksheet->getCellByColumnAndRow(10,$row)->getValue();
                $image_cost = checkemptynumber($image_cost);
                $video_cost = $worksheet->getCellByColumnAndRow(11,$row)->getValue();
                $video_cost = checkemptynumber($video_cost);
                $igtv_cost = $worksheet->getCellByColumnAndRow(12,$row)->getValue();
                $igtv_cost = checkemptynumber($igtv_cost);
                $reels_15sec = $worksheet->getCellByColumnAndRow(13,$row)->getValue();
                $reels_15sec = checkemptynumber($reels_15sec);
                $reels_30sec = $worksheet->getCellByColumnAndRow(14,$row)->getValue();
                $reels_30sec = checkemptynumber($reels_30sec);
                $image_story_cost = $worksheet->getCellByColumnAndRow(15,$row)->getValue();
                $image_story_cost = checkemptynumber($image_story_cost);
                $video_story_cost = $worksheet->getCellByColumnAndRow(16,$row)->getValue();
                $video_story_cost = checkemptynumber($video_story_cost);
                $image_story_swipeup_cost = $worksheet->getCellByColumnAndRow(17,$row)->getValue();
                $image_story_swipeup_cost = checkemptynumber($image_story_swipeup_cost);
                $video_story_swipeup_cost = $worksheet->getCellByColumnAndRow(18,$row)->getValue();
                $vide_story_swipeup_cost = checkemptynumber($video_story_swipeup_cost);
                $carousel_cost = $worksheet->getCellByColumnAndRow(19,$row)->getValue();
                $carousel_cost = checkemptynumber($carousel_cost);
                $contact_number = $worksheet->getCellByColumnAndRow(20,$row)->getValue();
                $contact_number = cleanup($contact_number);
                $contact_person_name = $worksheet->getCellByColumnAndRow(21,$row)->getValue();
                $contact_person_name = ucwords($contact_person_name);
                $contact_person_name = checkemptystring($contact_person_name);
                $email = $worksheet->getCellByColumnAndRow(22,$row)->getValue();
                $email = cleanup($email);
                $comment = $worksheet->getCellByColumnAndRow(23,$row)->getValue();
                $comment = checkemptystring($comment);
                $address = $worksheet->getCellByColumnAndRow(24,$row)->getValue();
                $address = checkemptystring($address);
                $city = $worksheet->getCellByColumnAndRow(25,$row)->getValue();
                $city = ucwords($city);
                $city = checkemptystring($city);
                $state = $worksheet->getCellByColumnAndRow(26,$row)->getValue();
                $state = ucwords($state);
                $avg_views = $worksheet->getCellByColumnAndRow(27,$row)->getValue();
                $avg_views = checkemptynumber($avg_views);
                $avg_likes = $worksheet->getCellByColumnAndRow(28,$row)->getValue();
                $avg_likes = checkemptynumber($avg_likes);
                $campaign_done_earlier = $worksheet->getCellByColumnAndRow(29,$row)->getValue();
                $campaign_done_earlier = checkemptystring($campaign_done_earlier);
                $no_of_campaign = $worksheet->getCellByColumnAndRow(30,$row)->getValue();
                $no_of_campaign = checkemptynumber($no_of_campaign);
                $influencer_category = $worksheet->getCellByColumnAndRow(31,$row)->getValue();
                $influencer_category = cleanup($influencer_category);
                $influencer_category = strtoupper($influencer_category);
                $name_of_client_worked_before = $worksheet->getCellByColumnAndRow(32,$row)->getValue();
                $name_of_client_worked_before = checkemptystring($name_of_client_worked_before);
                $brands = $worksheet->getCellByColumnAndRow(33,$row)->getValue();
                $brands = cleanup($brands);
                $brands = checkemptystring($brands);
                $celebrity = $worksheet->getCellByColumnAndRow(34,$row)->getValue();
                $celebrity = cleanup($celebrity);
                $celebrity = checkemptystring($celebrity);
                $encryptid = encrypt($unique_id);
                $checkid1 = "SELECT `unique_id` from `instagram` WHERE `unique_id`=:unique_id";
                $stmt3 = $con->prepare($checkid1);
                $stmt3->execute(["unique_id"=>$encryptid]);
                $count1 = $stmt3->rowCount();
                $checkid2 = "SELECT `unique_id` from `masterinstagram` WHERE `unique_id`=:unique_id";
                $stmt4 = $con->prepare($checkid2);
                $stmt4->execute(["unique_id"=>$encryptid]);
                $count2 = $stmt4->rowCount();
                if($count1 > 0 || $intid == 0 || empty($contact_number)){
                    $error = 1;
                }
                else{
                    $unique_id = encrypt($unique_id);
                    $influencer_name = encrypt($influencer_name);
            //        $channel_name = encrypt($channel_name);
                    $profile_url = encrypt($profile_url);
                    $enlyft_exclusive = encrypt($enlyft_exclusive);
                    $image_cost = encrypt($image_cost);
                    $image_story_cost = encrypt($image_story_cost);
                    $image_story_swipeup_cost = encrypt($image_story_swipeup_cost);
                    $video_story_cost = encrypt($video_story_cost);
                    $video_story_swipeup_cost = encrypt($video_story_swipeup_cost);
                    $video_cost = encrypt($video_cost);
                    $igtv_cost = encrypt($igtv_cost);
                    $carousel_cost = encrypt($carousel_cost);
                    $reels_15sec = encrypt($reels_15sec);
                    $reels_30sec = encrypt($reels_30sec);
                    $contact_number = encrypt($contact_number);
                    $contact_person_name = encrypt($contact_person_name);
                    $email = encrypt($email);
                    $address = encrypt($address);
                    
                    $campaign_done_earlier = encrypt($campaign_done_earlier);
                    $no_of_campaign = encrypt($no_of_campaign);
                    $name_of_client_worked_before = encrypt($name_of_client_worked_before);
                    $insertqry="INSERT INTO `instagram`(`unique_id`, `influencer_name`, `handle`, `profile_url`, `followers`,`genre`,`language`, `verified`,`gender`,`enlyft_exclusive`,`image_cost`,
                    `video_cost`,`igtv_cost`,`reels_15sec`,`reels_30sec`,`image_story_cost`,`video_story_cost`,
                    `image_story_swipeup_cost`,`video_story_swipeup_cost`,`carousel_cost`,`contact_no`,`contact_person_name`,
                    `email`,`comment`,`address`,`city`,`state`,`avg_views`,`avg_likes`,
                    `campaign_done_earlier`,`no_of_campaign`,`influencer_category`,`name_of_client_worked_before`,
                    `brands`,`celebrity`,`added_on`,`added_by`,`updated_on`,`updated_by`) VALUES 
                    (:unique_id,:influencer_name,:handle,:profile_url,:followers,:genre,:language,:verified,
                    :gender,:enlyft_exclusive,:image_cost,:video_cost,:igtv_cost,:reels_15sec,:reels_30sec,:image_story_cost,:video_story_cost,
                    :image_story_swipeup_cost,:video_story_swipeup_cost,:carousel_cost,:contact_number,:contact_person_name,
                    :email,:comment,:address,:city,
                    :state,:avg_views,:avg_likes,:campaign_done_earlier,:no_of_campaign,
                    :influencer_category,:name_of_client_worked_before,:brands,:celebrity,
                    :added_on,:added_by,:updated_on,:updated_by)";
                    $stmt = $con->prepare($insertqry);
                    $stmt->execute([
                    "unique_id"=>$unique_id,"influencer_name"=>$influencer_name,
                    "handle"=>$handle,"profile_url"=>$profile_url,
                    "followers"=>$followers, "genre"=>$genre,
                    "language"=>$language,"verified"=>$verified,"gender"=>$gender,
                    "enlyft_exclusive"=>$enlyft_exclusive,"image_cost"=>$image_cost,
                    "video_cost"=>$video_cost,"igtv_cost"=>$igtv_cost,"reels_15sec"=>$reels_15sec,"reels_30sec"=>$reels_30sec,
                    "image_story_cost"=>$image_story_cost,"video_story_cost"=>$video_story_cost,
                    "image_story_swipeup_cost"=>$image_story_swipeup_cost,"video_story_swipeup_cost"=>$video_story_swipeup_cost,    
                    "carousel_cost"=>$carousel_cost,"contact_number"=>$contact_number,"contact_person_name"=>$contact_person_name,
                    "email"=>$email,"comment"=>$comment,
                    "address"=>$address,"city"=>$city,"state"=>$state,
                    "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
                    "campaign_done_earlier"=>$campaign_done_earlier,
                    "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
                    "name_of_client_worked_before"=>$name_of_client_worked_before,
                    "brands"=>$brands,"celebrity"=>$celebrity,    
                    "added_on"=>$added_on,"added_by"=>$added_by,
                    "updated_on"=>$updated_on,"updated_by"=>$updated_by
                    ]);
                    if($count2 == 0){
                        $masterqry="INSERT INTO `masterinstagram`(`unique_id`, `influencer_name`, `handle`, `profile_url`, `followers`,`genre`,`language`, `verified`,`gender`,`enlyft_exclusive`,`image_cost`,
                        `video_cost`,`igtv_cost`,`reels_15sec`,`reels_30sec`,`image_story_cost`,`video_story_cost`,
                        `image_story_swipeup_cost`,`video_story_swipeup_cost`,`carousel_cost`,`contact_no`,`contact_person_name`,
                        `email`,`comment`,`address`,`city`,`state`,`avg_views`,`avg_likes`,
                        `campaign_done_earlier`,`no_of_campaign`,`influencer_category`,`name_of_client_worked_before`,
                        `brands`,`celebrity`,`added_on`,`added_by`,`updated_on`,`updated_by`) VALUES 
                        (:unique_id,:influencer_name,:handle,:profile_url,:followers,:genre,:language,:verified,
                        :gender,:enlyft_exclusive,:image_cost,:video_cost,:igtv_cost,:reels_15sec,:reels_30sec,:image_story_cost,:video_story_cost,
                        :image_story_swipeup_cost,:video_story_swipeup_cost,:carousel_cost,:contact_number,:contact_person_name,
                        :email,:comment,:address,:city,
                        :state,:avg_views,:avg_likes,:campaign_done_earlier,:no_of_campaign,
                        :influencer_category,:name_of_client_worked_before,:brands,:celebrity,
                        :added_on,:added_by,:updated_on,:updated_by)";
                        $stmt1 = $con->prepare($masterqry);
                        $stmt1->execute([
                        "unique_id"=>$unique_id,"influencer_name"=>$influencer_name,
                        "handle"=>$handle,"profile_url"=>$profile_url,"followers"=>$followers,"genre"=>$genre,
                        "language"=>$language,"verified"=>$verified,"gender"=>$gender,
                        "enlyft_exclusive"=>$enlyft_exclusive,"image_cost"=>$image_cost,
                        "video_cost"=>$video_cost,"igtv_cost"=>$igtv_cost,"reels_15sec"=>$reels_15sec,"reels_30sec"=>$reels_30sec,
                        "image_story_cost"=>$image_story_cost,"video_story_cost"=>$video_story_cost,
                        "image_story_swipeup_cost"=>$image_story_swipeup_cost,"video_story_swipeup_cost"=>$video_story_swipeup_cost, "carousel_cost"=>$carousel_cost,"contact_number"=>$contact_number,
                        "contact_person_name"=>$contact_person_name,"email"=>$email,"comment"=>$comment,
                        "address"=>$address,"city"=>$city,"state"=>$state,
                        "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
                        "campaign_done_earlier"=>$campaign_done_earlier,
                        "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
                        "name_of_client_worked_before"=>$name_of_client_worked_before,
                        "brands"=>$brands,"celebrity"=>$celebrity,    
                        "added_on"=>$added_on,"added_by"=>$added_by,
                        "updated_on"=>$updated_on,"updated_by"=>$updated_by
                        ]);
                    }
                    $impcount = $impcount + 1;
                }

                    
            }
            if($stmt && $error == 0){
                $impcount = $impcount - 1;
                date_default_timezone_set("Asia/Kolkata");
                $datenow = date("Y-m-d H:i:s");
                $operation = "Import";
                $comment = $_SESSION['admin_username']." has imported $impcount entries in instagram data at $datenow";
                $ipaddress = $_SERVER['REMOTE_ADDR'];
                $browser = $_SERVER['HTTP_USER_AGENT'];
                $log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
                    `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
                $stmt2 = $con->prepare($log);
                $stmt2->execute(['userid'=>$_SESSION['adminid'],'username'=>$_SESSION['admin_username'],'operation'=>$operation,
                    'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$datenow]);
                echo "success";
            }
            elseif($error == 1){
//                $impcount = $impcount - 1;
                date_default_timezone_set("Asia/Kolkata");
                $datenow = date("Y-m-d H:i:s");
                $operation = "Import";
                $comment = $_SESSION['admin_username']." has imported $impcount entries in instagram data at $datenow";
                $ipaddress = $_SERVER['REMOTE_ADDR'];
                $browser = $_SERVER['HTTP_USER_AGENT'];
                $log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
                    `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
                $stmt2 = $con->prepare($log);
                $stmt2->execute(['userid'=>$_SESSION['adminid'],'username'=>$_SESSION['admin_username'],'operation'=>$operation,
                    'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$datenow]);
                echo "duplicate";
            }
            else{
                echo "fail";
            }
        }
    }
    else{
        echo "invalid";
    }
}

if(isset($_POST['insertinstagram']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $unique_id = cleanup($_POST['unique_id']);
    $unique_id = encrypt($unique_id);
    $checkid = "SELECT `unique_id` from `instagram` WHERE `unique_id`=:unique_id";
    $stmt2 = $con->prepare($checkid);
    $stmt2->execute(["unique_id"=>$unique_id]);
    $count = $stmt2->rowCount();
    if($count > 0){
        echo "duplicate";
        die();
    }
    $influencer_name = cleanup($_POST['influencer_name']);
    $handle = cleanup($_POST['handle']);
    $profile_url = cleanup($_POST['profile_url']);
    $followers = cleanup($_POST['followers']);
    $followers = checkemptynumber($followers);
    $genre = cleanup($_POST['genre']);
    $genre = ucwords($genre);
    $genre = checkemptystring($genre);
    $language = cleanup($_POST['language']);
    $language = ucwords($language);
    $verified = cleanup($_POST['verified']);
    $gender = cleanup($_POST['gender']);
    $gender = ucwords($gender);
    $enlyft_exclusive = cleanup($_POST['enlyft_exclusive']);
    $enlyft_exclusive = ucwords($enlyft_exclusive);
    $image_cost = cleanup($_POST['image_cost']);
    $image_cost = checkemptynumber($image_cost);
    $video_cost = cleanup($_POST['video_cost']);
    $video_cost = checkemptynumber($video_cost);
    $igtv_cost = cleanup($_POST['igtv_cost']);
    $igtv_cost = checkemptynumber($igtv_cost);
    $reels_15sec = cleanup($_POST['reels_15sec']);
    $reels_15sec = checkemptynumber($reels_15sec);
    $reels_30sec = cleanup($_POST['reels_30sec']);
    $reels_30sec = checkemptynumber($reels_30sec);
    $image_story_cost = cleanup($_POST['image_story_cost']);
    $image_story_cost = checkemptynumber($image_story_cost);
    $video_story_cost = cleanup($_POST['video_story_cost']);
    $video_story_cost = checkemptynumber($video_story_cost);
    $image_story_swipeup_cost = cleanup($_POST['image_story_swipeup_cost']);
    $image_story_swipeup_cost = checkemptynumber($image_story_swipeup_cost);
    $video_story_swipeup_cost = cleanup($_POST['video_story_swipeup_cost']);
    $video_story_swipeup_cost = checkemptynumber($video_story_swipeup_cost);
    $carousel_cost = cleanup($_POST['carousel_cost']);
    $carousel_cost = checkemptynumber($carousel_cost);
    $contact_number = cleanup($_POST['contact_number']);
    $contact_person_name = cleanup($_POST['contact_person_name']);
    $contact_person_name = ucwords($contact_person_name);
    $email = cleanup($_POST['email']);
    $comment = cleanup($_POST['comment']);
    $comment = checkemptystring($comment);
    $address = cleanup($_POST['address']);
    $address = checkemptystring($address);
    $city = cleanup($_POST['city']);
    $city = ucwords($city);
    $city = checkemptystring($city);
    $state = cleanup($_POST['state']);
    $state = ucwords($state);
    $avg_views = cleanup($_POST['avg_views']);
    $avg_views = checkemptynumber($avg_views);
    $avg_likes = cleanup($_POST['avg_likes']);
    $avg_likes = checkemptynumber($avg_likes);
//    $influencer_name = cleanup($_POST['influencer_name']);
    $campaign_done_earlier = checkemptystring($_POST['campaign_done_earlier']);
    $no_of_campaign = checkemptynumber($_POST['no_of_campaign']);
//    $no_of_campaign = checkemptynumber($no_of_campaign);
    $influencer_category = cleanup($_POST['influencer_category']);
    $influencer_category = strtoupper($influencer_category);
    $name_of_client_worked_before = cleanup($_POST['name_of_client_worked_before']);
    $name_of_client_worked_before = checkemptystring($name_of_client_worked_before);
    $celebrity = cleanup($_POST['celebrity']);
    $celebrity = checkemptystring($celebrity);
    $brands = cleanup($_POST['brands']);
    $brands = checkemptystring($brands);
    
    if(empty($unique_id) || empty($influencer_name) || empty($handle) || empty($profile_url) || 
    empty($followers) || empty($genre) || empty($language) || empty($verified) || empty($gender) || 
       empty($enlyft_exclusive) || empty($contact_number) || empty($contact_person_name) ||
      empty($email) || empty($address) || empty($city) || empty($state) ||  
       empty($influencer_category)){
        echo "mandatory";
    }
    else{
        $influencer_name = encrypt($influencer_name);
//        $channel_name = encrypt($channel_name);
        $profile_url = encrypt($profile_url);
        $enlyft_exclusive = encrypt($enlyft_exclusive);
        $image_cost = encrypt($image_cost);
        $image_story_cost = encrypt($image_story_cost);
        $image_story_swipeup_cost = encrypt($image_story_swipeup_cost);
        $video_story_cost = encrypt($video_story_cost);
        $video_story_swipeup_cost = encrypt($video_story_swipeup_cost);
        $video_cost = encrypt($video_cost);
        $igtv_cost = encrypt($igtv_cost);
        $carousel_cost = encrypt($carousel_cost);
        $reels_15sec = encrypt($reels_15sec);
        $reels_30sec = encrypt($reels_30sec);
        $contact_number = encrypt($contact_number);
        $contact_person_name = encrypt($contact_person_name);
        $email = encrypt($email);
        $address = encrypt($address);
        
        $campaign_done_earlier = encrypt($campaign_done_earlier);
        $no_of_campaign = encrypt($no_of_campaign);
        $name_of_client_worked_before = encrypt($name_of_client_worked_before);
        $insertqry="INSERT INTO `instagram`(`unique_id`, `influencer_name`, `handle`, `profile_url`, `followers`,`genre`,`language`, `verified`,`gender`,`enlyft_exclusive`,`image_cost`,
            `video_cost`,`igtv_cost`,`reels_15sec`,`reels_30sec`,`image_story_cost`,`video_story_cost`,
            `image_story_swipeup_cost`,`video_story_swipeup_cost`,`carousel_cost`,`contact_no`,`contact_person_name`,
            `email`,`comment`,`address`,`city`,`state`,`avg_views`,`avg_likes`,
            `campaign_done_earlier`,`no_of_campaign`,`influencer_category`,`name_of_client_worked_before`,
            `brands`,`celebrity`,`added_on`,`added_by`,`updated_on`,`updated_by`) VALUES 
            (:unique_id,:influencer_name,:handle,:profile_url,:followers,:genre,:language,:verified,
            :gender,:enlyft_exclusive,:image_cost,:video_cost,:igtv_cost,:reels_15sec,:reels_30sec,:image_story_cost,:video_story_cost,
            :image_story_swipeup_cost,:video_story_swipeup_cost,:carousel_cost,:contact_number,:contact_person_name,
            :email,:comment,:address,:city,
            :state,:avg_views,:avg_likes,:campaign_done_earlier,:no_of_campaign,
            :influencer_category,:name_of_client_worked_before,:brands,:celebrity,
            :added_on,:added_by,:updated_on,:updated_by)";
            $stmt = $con->prepare($insertqry);
            $stmt->execute([
            "unique_id"=>$unique_id,"influencer_name"=>$influencer_name,
            "handle"=>$handle,"profile_url"=>$profile_url,
            "followers"=>$followers, "genre"=>$genre,
            "language"=>$language,"verified"=>$verified,"gender"=>$gender,
            "enlyft_exclusive"=>$enlyft_exclusive,"image_cost"=>$image_cost,
            "video_cost"=>$video_cost,"igtv_cost"=>$igtv_cost,"reels_15sec"=>$reels_15sec,"reels_30sec"=>$reels_30sec,
            "image_story_cost"=>$image_story_cost,"video_story_cost"=>$video_story_cost,
            "image_story_swipeup_cost"=>$image_story_swipeup_cost,"video_story_swipeup_cost"=>$video_story_swipeup_cost,    
            "carousel_cost"=>$carousel_cost,"contact_number"=>$contact_number,"contact_person_name"=>$contact_person_name,
            "email"=>$email,"comment"=>$comment,
            "address"=>$address,"city"=>$city,"state"=>$state,
            "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
            "campaign_done_earlier"=>$campaign_done_earlier,
            "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
            "name_of_client_worked_before"=>$name_of_client_worked_before,
            "brands"=>$brands,"celebrity"=>$celebrity,    
            "added_on"=>$added_on,"added_by"=>$added_by,
            "updated_on"=>$updated_on,"updated_by"=>$updated_by
            ]);
        $masterqry="INSERT INTO `masterinstagram`(`unique_id`, `influencer_name`, `handle`, `profile_url`, `followers`,`genre`,`language`, `verified`,`gender`,`enlyft_exclusive`,`image_cost`,
            `video_cost`,`igtv_cost`,`reels_15sec`,`reels_30sec`,`image_story_cost`,`video_story_cost`,
            `image_story_swipeup_cost`,`video_story_swipeup_cost`,`carousel_cost`,`contact_no`,`contact_person_name`,
            `email`,`comment`,`address`,`city`,`state`,`avg_views`,`avg_likes`,
            `campaign_done_earlier`,`no_of_campaign`,`influencer_category`,`name_of_client_worked_before`,
            `brands`,`celebrity`,`added_on`,`added_by`,`updated_on`,`updated_by`) VALUES 
            (:unique_id,:influencer_name,:handle,:profile_url,:followers,:genre,:language,:verified,
            :gender,:enlyft_exclusive,:image_cost,:video_cost,:igtv_cost,:reels_15sec,:reels_30sec,:image_story_cost,:video_story_cost,
            :image_story_swipeup_cost,:video_story_swipeup_cost,:carousel_cost,:contact_number,:contact_person_name,
            :email,:comment,:address,:city,
            :state,:avg_views,:avg_likes,:campaign_done_earlier,:no_of_campaign,
            :influencer_category,:name_of_client_worked_before,:brands,:celebrity,
            :added_on,:added_by,:updated_on,:updated_by)";
            $stmt1 = $con->prepare($masterqry);
            $stmt1->execute([
            "unique_id"=>$unique_id,"influencer_name"=>$influencer_name,
            "handle"=>$handle,"profile_url"=>$profile_url,
            "followers"=>$followers, "genre"=>$genre,
            "language"=>$language,"verified"=>$verified,"gender"=>$gender,
            "enlyft_exclusive"=>$enlyft_exclusive,"image_cost"=>$image_cost,
            "video_cost"=>$video_cost,"igtv_cost"=>$igtv_cost,"reels_15sec"=>$reels_15sec,"reels_30sec"=>$reels_30sec,
            "image_story_cost"=>$image_story_cost,"video_story_cost"=>$video_story_cost,
            "image_story_swipeup_cost"=>$image_story_swipeup_cost,"video_story_swipeup_cost"=>$video_story_swipeup_cost,    
            "carousel_cost"=>$carousel_cost,"contact_number"=>$contact_number,"contact_person_name"=>$contact_person_name,
            "email"=>$email,"comment"=>$comment,
            "address"=>$address,"city"=>$city,"state"=>$state,
            "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
            "campaign_done_earlier"=>$campaign_done_earlier,
            "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
            "name_of_client_worked_before"=>$name_of_client_worked_before,
            "brands"=>$brands,"celebrity"=>$celebrity,    
            "added_on"=>$added_on,"added_by"=>$added_by,
            "updated_on"=>$updated_on,"updated_by"=>$updated_by
            ]);
        if($stmt){
            date_default_timezone_set("Asia/Kolkata");
            $datenow = date("Y-m-d H:i:s");
            $operation = "Insert";
            $comment = $_SESSION['admin_username']." has inserted instagram data in system at $datenow";
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            $browser = $_SERVER['HTTP_USER_AGENT'];
            $log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
                `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
            $stmt2 = $con->prepare($log);
            $stmt2->execute(['userid'=>$_SESSION['adminid'],'username'=>$_SESSION['admin_username'],'operation'=>$operation,
                'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$datenow]);
            echo "success";
        }
        else{
            echo "fail";
        }
    }
}
?>