<?php 
include 'config-pdo.php';
session_start();
date_default_timezone_set("Asia/Calcutta");
$date = date("Y-m-d");
$added_on = date('Y-m-d H:i:s');
$added_by = $_SESSION['admin_username'];
$updated_on = "0000-00-00 00:00:00";
$updated_by = $_SESSION['admin_username'];
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
        $objExcel=PHPExcel_IOFactory::load($uploadfile);
        foreach($objExcel->getWorksheetIterator() as $worksheet)
        {
            $highestrow=$worksheet->getHighestRow();

            for($row=0;$row<=$highestrow;$row++)
            {

                $channel_name = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
                $profile_url = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
                $subscribers = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
                $subscribers = checkemptynumber($subscribers);
                $genre = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
                $genre = checkemptystring($genre);
                $language = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
                $gender = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
                $enlyft_exclusive = $worksheet->getCellByColumnAndRow(6,$row)->getValue();
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
                $email_id = $worksheet->getCellByColumnAndRow(13,$row)->getValue();
                $comment = $worksheet->getCellByColumnAndRow(14,$row)->getValue();
                $comment = checkemptystring($comment);
                $address = $worksheet->getCellByColumnAndRow(15,$row)->getValue();
                $address = checkemptystring($address);
                $city = $worksheet->getCellByColumnAndRow(16,$row)->getValue();
                $city = checkemptystring($city);
                $state = $worksheet->getCellByColumnAndRow(17,$row)->getValue();
                $avg_views = $worksheet->getCellByColumnAndRow(18,$row)->getValue();
                $avg_views = checkemptynumber($avg_views);
                $avg_likes = $worksheet->getCellByColumnAndRow(19,$row)->getValue();
                $avg_likes = checkemptynumber($avg_likes);
                $influencer_name = $worksheet->getCellByColumnAndRow(20,$row)->getValue();
                $campaign_done_earlier = $worksheet->getCellByColumnAndRow(21,$row)->getValue();
                $no_of_campaign = $worksheet->getCellByColumnAndRow(22,$row)->getValue();
                $influencer_category = $worksheet->getCellByColumnAndRow(23,$row)->getValue();
                $name_of_client_worked_before = $worksheet->getCellByColumnAndRow(24,$row)->getValue();
                $name_of_client_worked_before = checkemptystring($name_of_client_worked_before);
                
                $checkurl1 = "SELECT `profile_url` from `youtube` WHERE `profile_url`=:profile_url";
                $stmt3 = $con->prepare($checkurl1);
                $stmt3->execute(["profile_url"=>$profile_url]);
                $count1 = $stmt3->rowCount();
                if($count1 > 0){
                    $error = 1;
//                    break;
//                    echo "duplicate";
//                    die();
                }
                else{
                    $insertqry="INSERT INTO `youtube`(`channel_name`, `profile_url`, `subscribers`,`genre`,`language`,`gender`,`enlyft_exclusive`,`integrated_video_cost`,
                    `dedicated_video_cost`,`youtube_story_cost`,`youtube_shorts_cost`,`contact_number`,`contact_person_name`,
                    `email_id`,`comment`,`address`,`city`,`state`,`avg_views`,`avg_likes`,
                    `influencer_name`,`campaign_done_earlier`,`no_of_campaign`,`influencer_category`,`name_of_client_worked_before`,`added_on`,`added_by`,`updated_on`,`updated_by`) VALUES 
                    (:channel_name,:profile_url,:subscribers,:genre,:language,
                    :gender,:enlyft_exclusive,:integrated_video_cost,:dedicated_video_cost,
                    :youtube_story_cost,:youtube_shorts_cost,:contact_number,:contact_person_name,
                    :email_id,:comment,:address,:city,
                    :state,:avg_views,:avg_likes,:influencer_name,:campaign_done_earlier,:no_of_campaign,
                    :influencer_category,:name_of_client_worked_before,
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
                    "added_on"=>$added_on,"added_by"=>$added_by,
                    "updated_on"=>$updated_on,"updated_by"=>$updated_by
                    ]);
                }

                    
            }
            if($stmt && $error == 0){
                echo "success";
            }
            elseif($error == 1){
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

if(isset($_POST['insertyoutube']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $channel_name = cleanup($_POST['channel_name']);
    $profile_url = cleanup($_POST['profile_url']);
    $checkurl = "SELECT `profile_url` from `youtube` WHERE `profile_url`=:profile_url";
    $stmt2 = $con->prepare($checkurl);
    $stmt2->execute(["profile_url"=>$profile_url]);
    $count = $stmt2->rowCount();
    if($count > 0){
        echo "duplicate";
        die();
    }
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
       empty($no_of_campaign) ||empty($influencer_category)){
        echo "mandatory";
    }
    else{
        $insertqry="INSERT INTO `youtube`(`channel_name`, `profile_url`, `subscribers`,`genre`,`language`,`gender`,`enlyft_exclusive`,`integrated_video_cost`,
            `dedicated_video_cost`,`youtube_story_cost`,`youtube_shorts_cost`,`contact_number`,`contact_person_name`,
            `email_id`,`comment`,`address`,`city`,`state`,`avg_views`,`avg_likes`,
            `influencer_name`,`campaign_done_earlier`,`no_of_campaign`,`influencer_category`,`name_of_client_worked_before`,`added_on`,`added_by`,`updated_on`,`updated_by`) VALUES 
            (:channel_name,:profile_url,:subscribers,:genre,:language,
            :gender,:enlyft_exclusive,:integrated_video_cost,:dedicated_video_cost,
            :youtube_story_cost,:youtube_shorts_cost,:contact_number,:contact_person_name,
            :email_id,:comment,:address,:city,
            :state,:avg_views,:avg_likes,:influencer_name,:campaign_done_earlier,:no_of_campaign,
            :influencer_category,:name_of_client_worked_before,
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
            "address"=>$address,"city"=>$city,"state"=>$state,
            "avg_views"=>$avg_views,"avg_likes"=>$avg_likes,
            "influencer_name"=>$influencer_name,"campaign_done_earlier"=>$campaign_done_earlier,
            "no_of_campaign"=>$no_of_campaign,"influencer_category"=>$influencer_category,
            "name_of_client_worked_before"=>$name_of_client_worked_before,
            "added_on"=>$added_on,"added_by"=>$added_by,
            "updated_on"=>$updated_on,"updated_by"=>$updated_by
            ]);
        if($stmt){
            echo "success";
        }
        else{
            echo "fail";
        }
    }
}
?>