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
   if(isset($_POST['updateyoutube']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = cleanup($_POST['id']);
        $channel_name = cleanup($_POST['channel_name']);
        $profile_url = cleanup($_POST['profile_url']);
//        $checkurl = "SELECT `profile_url` from `youtube` WHERE `profile_url`=:profile_url";
//        $stmt2 = $con->prepare($checkurl);
//        $stmt2->execute(["profile_url"=>$profile_url]);
//        $count = $stmt2->rowCount();
//        if($count > 1){
//            echo "duplicate";
//            die();
//        }
        $subscribers = cleanup($_POST['subscribers']);
        $subscribers = checkemptynumber($subscribers);
        $genre = cleanup($_POST['genre']);
        $genre = checkemptystring($genre);
        $language = cleanup($_POST['language']);
        $gender = cleanup($_POST['gender']);
        $enlyft_exclusive = cleanup($_POST['enlyft_exclusive']);
        $integrated_video_cost = cleanup($_POST['integrated_video_cost']);
        $integrated_video_cost = checkemptynumber($integrated_video_cost);
        $dedicated_video_cost = cleanup($_POST['dedicated_video_cost']);
        $dedicated_video_cost = checkemptynumber($dedicated_video_cost);
        $youtube_story_cost = cleanup($_POST['youtube_story_cost']);
        $youtube_story_cost = checkemptynumber($youtube_story_cost);
        $youtube_shorts_cost = cleanup($_POST['youtube_shorts_cost']);
        $youtube_shorts_cost = checkemptynumber($youtube_shorts_cost);
        $contact_number = cleanup($_POST['contact_number']);
        $contact_person_name = cleanup($_POST['contact_person_name']);
        $email_id = cleanup($_POST['email_id']);
        $comment = cleanup($_POST['comment']);
        $comment = checkemptystring($comment);
        $address = cleanup($_POST['address']);
        $address = checkemptystring($address);
        $city = cleanup($_POST['city']);
        $city = checkemptystring($city);
        $state = cleanup($_POST['state']);
        $avg_views = cleanup($_POST['avg_views']);
        $avg_views = checkemptynumber($avg_views);
        $avg_likes = cleanup($_POST['avg_likes']);
        $avg_likes = checkemptynumber($avg_likes);
        $influencer_name = cleanup($_POST['influencer_name']);
        $campaign_done_earlier = cleanup($_POST['campaign_done_earlier']);
        $no_of_campaign = cleanup($_POST['no_of_campaign']);
    //    $no_of_campaign = checkemptynumber($no_of_campaign);
        $influencer_category = cleanup($_POST['influencer_category']);
        $name_of_client_worked_before = cleanup($_POST['name_of_client_worked_before']);
        $name_of_client_worked_before = checkemptystring($name_of_client_worked_before);

        if(empty($channel_name) || empty($profile_url) || empty($language) || empty($gender) || 
           empty($enlyft_exclusive) || empty($contact_number) || empty($contact_person_name) ||
          empty($email_id) || empty($state) || empty($influencer_name) || empty($campaign_done_earlier) || 
        empty($influencer_category)){
            echo "mandatory";
    //        echo "<script>alert('Please Fill All Fields Properly'); window.location.href='insert-inventory.php';</script>";
        }
        else{
            $channel_name = encrypt($channel_name);
            $profile_url = encrypt($profile_url);
            $enlyft_exclusive = encrypt($enlyft_exclusive);
            $integrated_video_cost = encrypt($integrated_video_cost);
            $dedicated_video_cost = encrypt($dedicated_video_cost);
            $youtube_story_cost = encrypt($youtube_story_cost);
            $youtube_shorts_cost = encrypt($youtube_shorts_cost);
            $contact_number = encrypt($contact_number);
            $contact_person_name = encrypt($contact_person_name);
            $email_id = encrypt($email_id);
            $address = encrypt($address);
            $influencer_name = encrypt($influencer_name);
            $campaign_done_earlier = encrypt($campaign_done_earlier);
            $no_of_campaign = encrypt($no_of_campaign);
            $name_of_client_worked_before = encrypt($name_of_client_worked_before);
            $updateqry="UPDATE `youtube` SET `channel_name`=:channel_name, `profile_url`=:profile_url, 
            `subscribers`=:subscribers,`genre`=:genre,`language`=:language,`gender`=:gender,
            `enlyft_exclusive`=:enlyft_exclusive,`integrated_video_cost`=:integrated_video_cost,
            `dedicated_video_cost`=:dedicated_video_cost,`youtube_story_cost`=:youtube_story_cost,
            `youtube_shorts_cost`=:youtube_shorts_cost,`contact_number`=:contact_number,
            `contact_person_name`=:contact_person_name,`email_id`=:email_id,`comment`=:comment,
            `address`=:address,`city`=:city,`state`=:state,`avg_views`=:avg_views,`avg_likes`=:avg_likes,
            `influencer_name`=:influencer_name,`campaign_done_earlier`=:campaign_done_earlier,
            `no_of_campaign`=:no_of_campaign,`influencer_category`=:influencer_category,
            `name_of_client_worked_before`=:name_of_client_worked_before,
            `updated_on`=:updated_on,`updated_by`=:updated_by WHERE `id`=:id";
                $stmt = $con->prepare($updateqry);
                $stmt->execute([
                "channel_name"=>$channel_name,"profile_url"=>$profile_url,
                "subscribers"=>$subscribers, "genre"=>$genre,
                "language"=>$language,"gender"=>$gender,
                "enlyft_exclusive"=>$enlyft_exclusive,"integrated_video_cost"=>$integrated_video_cost,
                "dedicated_video_cost"=>$dedicated_video_cost,
                "youtube_story_cost"=>$youtube_story_cost,"youtube_shorts_cost"=>$youtube_shorts_cost,
                "contact_number"=>$contact_number,"contact_person_name"=>$contact_person_name,
                "email_id"=>$email_id,"comment"=>$comment,
                "address"=>$address,"city"=>$city,"state"=>$state,
                "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
                "influencer_name"=>$influencer_name,"campaign_done_earlier"=>$campaign_done_earlier,
                "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
                "name_of_client_worked_before"=>$name_of_client_worked_before,
                "updated_on"=>$updated_on,"updated_by"=>$updated_by,"id"=>$id
                ]);
        if($stmt){
            date_default_timezone_set("Asia/Kolkata");
            $datenow = date("Y-m-d H:i:s");
            $operation = "Update";
            $comment = $_SESSION['admin_username']." has updated ID number $id of youtube data from system at $datenow";
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
    //    echo "<script>alert('Data Inserted'); window.location.href='insert-inventory.php';</script>";
        }
   }
?>