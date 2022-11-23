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
    $truncate_data = "TRUNCATE TABLE duplicateyoutube";
    $stmttruncate = $con->prepare($truncate_data);
    $stmttruncate->execute();
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

                $channel_name = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
                $profile_url = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
                $lastchar = substr($profile_url, -1); //to get last character of the string
                $parts = explode("/", $profile_url); // convert string into separate array elements after every /
                $extension1 = end($parts); // get last element of array
                $extlen = strlen($extension1); // get length of the string
                $subscribers = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
                $subscribers = checkemptynumber($subscribers);
                $genre = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
                $genre = ucwords($genre);
                $genre = checkemptystring($genre);
                $language = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
                $language = ucwords($language);
                $gender = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
                $gender = ucwords($gender);
                $enlyft_exclusive = $worksheet->getCellByColumnAndRow(6,$row)->getValue();
                $enlyft_exclusive = ucwords($enlyft_exclusive);
                $integrated_video_cost = $worksheet->getCellByColumnAndRow(7,$row)->getValue();
                $integrated_video_cost = checkemptynumber($integrated_video_cost);
                $dedicated_video_cost = $worksheet->getCellByColumnAndRow(8,$row)->getValue();
                $dedicated_video_cost = checkemptynumber($dedicated_video_cost);
                $youtube_story_cost = $worksheet->getCellByColumnAndRow(9,$row)->getValue();
                $youtube_story_cost = checkemptynumber($youtube_story_cost);
                $youtube_shorts_cost = $worksheet->getCellByColumnAndRow(10,$row)->getValue();
                $youtube_shorts_cost = checkemptynumber($youtube_shorts_cost);
                $contact_number = $worksheet->getCellByColumnAndRow(11,$row)->getValue();
                $contact_person_name = $worksheet->getCellByColumnAndRow(12,$row)->getValue();
                $contact_person_name = ucwords($contact_person_name);
                $email_id = $worksheet->getCellByColumnAndRow(13,$row)->getValue();
                $comment = $worksheet->getCellByColumnAndRow(14,$row)->getValue();
                $comment = checkemptystring($comment);
                $address = $worksheet->getCellByColumnAndRow(15,$row)->getValue();
                $address = checkemptystring($address);
                $city = $worksheet->getCellByColumnAndRow(16,$row)->getValue();
                $city = ucwords($city);
                $city = checkemptystring($city);
                $state = $worksheet->getCellByColumnAndRow(17,$row)->getValue();
                $state = ucwords($state);
                $avg_views = $worksheet->getCellByColumnAndRow(18,$row)->getValue();
                $avg_views = checkemptynumber($avg_views);
                $avg_likes = $worksheet->getCellByColumnAndRow(19,$row)->getValue();
                $avg_likes = checkemptynumber($avg_likes);
                $influencer_name = $worksheet->getCellByColumnAndRow(20,$row)->getValue();
                $campaign_done_earlier = $worksheet->getCellByColumnAndRow(21,$row)->getValue();
                $campaign_done_earlier = checkemptystring($campaign_done_earlier);
                $no_of_campaign = $worksheet->getCellByColumnAndRow(22,$row)->getValue();
                $no_of_campaign = checkemptynumber($no_of_campaign);
                $influencer_category = $worksheet->getCellByColumnAndRow(23,$row)->getValue();
                $influencer_category = strtoupper($influencer_category);
                $name_of_client_worked_before = $worksheet->getCellByColumnAndRow(24,$row)->getValue();
                $name_of_client_worked_before = checkemptystring($name_of_client_worked_before);
                $celebrity = $worksheet->getCellByColumnAndRow(25,$row)->getValue();
                $celebrity = checkemptystring($celebrity);
                $brands = $worksheet->getCellByColumnAndRow(26,$row)->getValue();
                $brands = checkemptystring($brands);
                $encrypturl = encrypt($profile_url);
                $checkurl1 = "SELECT `profile_url` from `youtube` WHERE `profile_url`=:profile_url";
                $stmt3 = $con->prepare($checkurl1);
                $stmt3->execute(["profile_url"=>$encrypturl]);
                $count1 = $stmt3->rowCount();
                if(($count1 > 0)){
                    $error = 1;
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
                    $insertqry="INSERT INTO `duplicateyoutube`(`channel_name`, `profile_url`, `subscribers`,`genre`,`language`,`gender`,`enlyft_exclusive`,`integrated_video_cost`,
                    `dedicated_video_cost`,`youtube_story_cost`,`youtube_shorts_cost`,`contact_number`,`contact_person_name`,
                    `email_id`,`comment`,`address`,`city`,`state`,`avg_views`,`avg_likes`,
                    `influencer_name`,`campaign_done_earlier`,`no_of_campaign`,`influencer_category`,`name_of_client_worked_before`,
                    `celebrity`,`brands`,`added_on`,`added_by`,`updated_on`,`updated_by`) VALUES 
                    (:channel_name,:profile_url,:subscribers,:genre,:language,
                    :gender,:enlyft_exclusive,:integrated_video_cost,:dedicated_video_cost,
                    :youtube_story_cost,:youtube_shorts_cost,:contact_number,:contact_person_name,
                    :email_id,:comment,:address,:city,
                    :state,:avg_views,:avg_likes,:influencer_name,:campaign_done_earlier,:no_of_campaign,
                    :influencer_category,:name_of_client_worked_before,:celebrity,:brands,
                    :added_on,:added_by,:updated_on,:updated_by)";
                    $stmt = $con->prepare($insertqry);
                    $stmt->execute([
                    "channel_name"=>$channel_name,"profile_url"=>$profile_url,
                    "subscribers"=>$subscribers, "genre"=>$genre,
                    "language"=>$language,"gender"=>$gender,
                    "enlyft_exclusive"=>$enlyft_exclusive,"integrated_video_cost"=>$integrated_video_cost,
                    "dedicated_video_cost"=>$dedicated_video_cost,
                    "youtube_story_cost"=>$youtube_story_cost,"youtube_shorts_cost"=>$youtube_shorts_cost,
                    "contact_number"=>$contact_number,"contact_person_name"=>$contact_person_name,
                    "email_id"=>$email_id,"comment"=>$comment,
                    "address"=>$address,"city"=>$city,
                    "state"=>$state,
                    "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
                    "influencer_name"=>$influencer_name,"campaign_done_earlier"=>$campaign_done_earlier,
                    "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
                    "name_of_client_worked_before"=>$name_of_client_worked_before,
                    "celebrity"=>$celebrity,"brands"=>$brands,    
                    "added_on"=>$added_on,"added_by"=>$added_by,
                    "updated_on"=>$updated_on,"updated_by"=>$updated_by
                    ]);
                    $error = 1;
                }
                else{
                    $error = 0;
                }
                    
            }
            $table_data = "SELECT channel_name, profile_url FROM duplicateyoutube";
                $stmtdup = $con->prepare($table_data);
                $stmtdup->execute();
                $dupcount = $stmtdup->rowCount();
                if($dupcount > 1){
                    $response = "
                    <div class='card mb-3' style='border:1px solid black;'>
                        <div class='card-header bg-dark text-white'>
                                <i class='fas fa-table'></i>
                                Duplicate YouTube Data
                        </div>
                        <div class='card-body'>
                        <div class='table-responsive'>
                            <table class='table table-hover table-bordered table-condensed' width='100%' cellspacing='0'>
                                <thead class='bg-dark text-white'>
                                    <tr>
                                        <th>Channel Name</th>
                                        <th>Profile URL</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    while ($row = $stmtdup->fetch()) {
                        $channel = decrypt($row->channel_name);
                        $url = decrypt($row->profile_url);
                        $response .= "
                                    <tr>
                                        <td>$channel</td>
                                        <td>$url</td>
                                    </tr>
                            ";
                    }
                    $response .= "
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>";
                    echo $response;
                }
                else{
                    echo "success";
                }
        }
    }
    else{
        echo "invalid";
    }
}


if(isset($_POST['insertyoutube']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $profile_url = cleanup($_POST['profile_url']);
    if(!preg_match("[https://www.youtube.com/channel/]", $profile_url)){
        echo "format";
        die();
    }
    $lastchar = substr($profile_url, -1);
    if($lastchar == '/'){
        echo "validurl";
        die();
    }
    $extension1 = cleanup($_POST['extension1']);
    $extlen = strlen($extension1);
    if($extlen !== 24){
        echo "length";
        die();
    }
    $profile_url = encrypt($profile_url);
    $checkurl = "SELECT `profile_url` from `youtube` WHERE `profile_url`=:profile_url";
    $stmt2 = $con->prepare($checkurl);
    $stmt2->execute(["profile_url"=>$profile_url]);
    $count = $stmt2->rowCount();
    if($count > 0){
        echo "duplicate";
        die();
    }
    else{
        echo "success";
    }
    
    
    
}
?>