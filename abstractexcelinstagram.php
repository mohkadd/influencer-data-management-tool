<?php

include ('config.php');
date_default_timezone_set("Asia/Calcutta");
$datetime = date('Y-m-d H:i:s');
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
$delimiter = ",";
$fileName = "backupinstagram_" . date('YmdHis') . ".csv"; 
$f = fopen("backup/$fileName", 'w+');
$fields = array('unique_id', 'influencer_name', 'handle', 'profile_url', 'followers', 'genre', 'language', 'verified', 'gender', 'enlyft_exclusive', 'image_cost', 'video_cost', 'igtv_cost', 'reels_15sec', 'reels_30sec', 'image_story_cost', 'video_story_cost', 'image_story_swipeup_cost', 'video_story_swipeup_cost', 'carousel_cost', 'contact_no', 'contact_person_name', 'email', 'comment', 'address', 'city', 'state', 'avg_views', 'avg_likes', 'campaign_done_earlier', 'no_of_campaign', 'influencer_category', 'name_of_client_worked_before', 'brands', 'celebrity');
fputcsv($f, $fields, $delimiter); 
//$csv_export = implode("\t", array_values($fields)) . "\n";
    //query get data
$sql = mysqli_query($connect, "SELECT unique_id, influencer_name, handle, profile_url, followers, genre, language, verified, gender, enlyft_exclusive, image_cost, video_cost, igtv_cost, reels_15sec, reels_30sec, image_story_cost, video_story_cost, image_story_swipeup_cost, video_story_swipeup_cost, carousel_cost, contact_no, contact_person_name, email, comment, address, city, state, avg_views, avg_likes, campaign_done_earlier, no_of_campaign, influencer_category, name_of_client_worked_before, brands, celebrity FROM instagram");
//$csv_export = '';
//$field = mysqli_field_count($connect);
// Output each row of the data, format line as csv and write to file pointer 
while($row = mysqli_fetch_assoc($sql)) {
    // create line with field values
    $lineData = array(decrypt($row['unique_id']), decrypt($row['influencer_name']), $row['handle'], decrypt($row['profile_url']), number_format($row['followers']), $row['genre'], $row['language'], $row['verified'], $row['gender'], decrypt($row['enlyft_exclusive']), number_format(decrypt($row['image_cost'])), number_format(decrypt($row['video_cost'])), number_format(decrypt($row['igtv_cost'])), number_format(decrypt($row['reels_15sec'])), number_format(decrypt($row['reels_30sec'])), number_format(decrypt($row['image_story_cost'])), number_format(decrypt($row['video_story_cost'])), number_format(decrypt($row['image_story_swipeup_cost'])), number_format(decrypt($row['video_story_swipeup_cost'])), number_format(decrypt($row['carousel_cost'])), decrypt($row['contact_no']), decrypt($row['contact_person_name']), decrypt($row['email']), $row['comment'], decrypt($row['address']), $row['city'], $row['state'], number_format($row['avg_likes']), number_format($row['avg_views']), decrypt($row['campaign_done_earlier']), decrypt($row['no_of_campaign']), $row['influencer_category'], decrypt($row['name_of_client_worked_before']), $row['brands'], $row['celebrity']);
    fputcsv($f, $lineData, $delimiter);
}

// Move back to beginning of file 
fseek($f, 0); 
//header('Content-Type: text/csv'); 
//header('Content-Disposition: attachment; filename="' . $fileName . '";'); 
//output all remaining data on a file pointer 
//fpassthru($f);
exit;
//echo($csv_export);
// $no = 1;
?>

