<?php
include 'config-pdo.php';
session_start();
date_default_timezone_set("Asia/Calcutta");
$date = date("Y-m-d");
$added_on = date('Y-m-d H:i:s');
$added_by = $_SESSION['admin_username'];
$updated_on = date('Y-m-d H:i:s');
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
   if(isset($_POST['updateinstagram']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = cleanup($_POST['id']);
       
        $unique_id = cleanup($_POST['unique_id']);
//        $unique_id = encrypt($unique_id);
//        $checkid = "SELECT `unique_id` from `instagram` WHERE `unique_id`=:unique_id";
//        $stmt2 = $con->prepare($checkid);
//        $stmt2->execute(["unique_id"=>$unique_id]);
//        $count = $stmt2->rowCount();
//        if($count > 0){
//            echo "duplicate";
//            die();
//        }
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
      empty($email) || empty($address) || empty($city) || empty($state) || empty($avg_views) || empty($avg_likes) ||  
       empty($influencer_category)){
            echo "mandatory";
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
            $updateqry="UPDATE `instagram` SET `unique_id`=:unique_id, `influencer_name`=:influencer_name, 
            `handle`=:handle, `profile_url`=:profile_url, `followers`=:followers,`genre`=:genre,`language`=:language, `verified`=:verified,`gender`=:gender,`enlyft_exclusive`=:enlyft_exclusive,
            `image_cost`=:image_cost,`video_cost`=:video_cost,`igtv_cost`=:igtv_cost,`reels_15sec`=:reels_15sec,
            `reels_30sec`=:reels_30sec,`image_story_cost`=:image_story_cost,`video_story_cost`=:video_story_cost,
            `image_story_swipeup_cost`=:image_story_swipeup_cost,
            `video_story_swipeup_cost`=:video_story_swipeup_cost,`carousel_cost`=:carousel_cost,
            `contact_no`=:contact_no,`contact_person_name`=:contact_person_name,
            `email`=:email,`comment`=:comment,`address`=:address,`city`=:city,`state`=:state,
            `avg_views`=:avg_views,`avg_likes`=:avg_likes,`campaign_done_earlier`=:campaign_done_earlier,
            `no_of_campaign`=:no_of_campaign,`influencer_category`=:influencer_category,
            `name_of_client_worked_before`=:name_of_client_worked_before,`brands`=:brands,`celebrity`=:celebrity, `updated_on`=:updated_on,`updated_by`=:updated_by WHERE `id`=:id";
                $stmt = $con->prepare($updateqry);
                $stmt->execute([
                "unique_id"=>$unique_id,"influencer_name"=>$influencer_name,
            "handle"=>$handle,"profile_url"=>$profile_url,
            "followers"=>$followers, "genre"=>$genre,"language"=>$language,
            "verified"=>$verified,"gender"=>$gender,"enlyft_exclusive"=>$enlyft_exclusive,
            "image_cost"=>$image_cost,"video_cost"=>$video_cost,"igtv_cost"=>$igtv_cost,
            "reels_15sec"=>$reels_15sec,"reels_30sec"=>$reels_30sec,"image_story_cost"=>$image_story_cost,
            "video_story_cost"=>$video_story_cost,"image_story_swipeup_cost"=>$image_story_swipeup_cost,
            "video_story_swipeup_cost"=>$video_story_swipeup_cost, "carousel_cost"=>$carousel_cost,
            "contact_no"=>$contact_number,"contact_person_name"=>$contact_person_name,
            "email"=>$email,"comment"=>$comment,
            "address"=>$address,"city"=>$city,"state"=>$state,
            "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
            "campaign_done_earlier"=>$campaign_done_earlier,
            "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
            "name_of_client_worked_before"=>$name_of_client_worked_before,
            "brands"=>$brands,"celebrity"=>$celebrity,"updated_on"=>$updated_on,"updated_by"=>$updated_by,"id"=>$id
                ]);
            $updatemaster="UPDATE `masterinstagram` SET `unique_id`=:unique_id, `influencer_name`=:influencer_name, 
            `handle`=:handle, `profile_url`=:profile_url, `followers`=:followers,`genre`=:genre,`language`=:language, `verified`=:verified,`gender`=:gender,`enlyft_exclusive`=:enlyft_exclusive,
            `image_cost`=:image_cost,`video_cost`=:video_cost,`igtv_cost`=:igtv_cost,`reels_15sec`=:reels_15sec,
            `reels_30sec`=:reels_30sec,`image_story_cost`=:image_story_cost,`video_story_cost`=:video_story_cost,
            `image_story_swipeup_cost`=:image_story_swipeup_cost,
            `video_story_swipeup_cost`=:video_story_swipeup_cost,`carousel_cost`=:carousel_cost,
            `contact_no`=:contact_no,`contact_person_name`=:contact_person_name,
            `email`=:email,`comment`=:comment,`address`=:address,`city`=:city,`state`=:state,
            `avg_views`=:avg_views,`avg_likes`=:avg_likes,`campaign_done_earlier`=:campaign_done_earlier,
            `no_of_campaign`=:no_of_campaign,`influencer_category`=:influencer_category,
            `name_of_client_worked_before`=:name_of_client_worked_before,`brands`=:brands,`celebrity`=:celebrity, `updated_on`=:updated_on,`updated_by`=:updated_by WHERE `id`=:id";
                $stmt1 = $con->prepare($updatemaster);
                $stmt1->execute([
                "unique_id"=>$unique_id,"influencer_name"=>$influencer_name,
            "handle"=>$handle,"profile_url"=>$profile_url,
            "followers"=>$followers, "genre"=>$genre,
            "language"=>$language,"verified"=>$verified,"gender"=>$gender,
            "enlyft_exclusive"=>$enlyft_exclusive,"image_cost"=>$image_cost,
            "video_cost"=>$video_cost,"igtv_cost"=>$igtv_cost,"reels_15sec"=>$reels_15sec,"reels_30sec"=>$reels_30sec,
            "image_story_cost"=>$image_story_cost,"video_story_cost"=>$video_story_cost,
            "image_story_swipeup_cost"=>$image_story_swipeup_cost,"video_story_swipeup_cost"=>$video_story_swipeup_cost,    
            "carousel_cost"=>$carousel_cost,"contact_no"=>$contact_number,"contact_person_name"=>$contact_person_name,
            "email"=>$email,"comment"=>$comment,
            "address"=>$address,"city"=>$city,"state"=>$state,
            "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
            "campaign_done_earlier"=>$campaign_done_earlier,
            "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
            "name_of_client_worked_before"=>$name_of_client_worked_before,
            "brands"=>$brands,"celebrity"=>$celebrity,"updated_on"=>$updated_on,"updated_by"=>$updated_by,"id"=>$id
                ]);
        if($stmt){
            date_default_timezone_set("Asia/Kolkata");
            $datenow = date("Y-m-d H:i:s");
            $operation = "Update";
            $comment = $_SESSION['admin_username']." has updated ID number $id of instagram data from system at $updated_on";
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            $browser = $_SERVER['HTTP_USER_AGENT'];
            $log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
                `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
            $stmt2 = $con->prepare($log);
            $stmt2->execute(['userid'=>$_SESSION['adminid'],'username'=>$_SESSION['admin_username'],'operation'=>$operation,
                'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$updated_on]);
            echo "success";
        }
        else{
            echo "fail";
        }
    //    echo "<script>alert('Data Inserted'); window.location.href='insert-inventory.php';</script>";
        }
   }
?>