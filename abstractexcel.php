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
$fileName = "backupyoutube_" . date('YmdHis') . ".csv"; 
$f = fopen("backup/$fileName", 'w+');
$fields = array('channel_name', 'profile_url', 'profile_image', 'subscribers', 'genre', 'language', 'gender', 'enlyft_exclusive', 'integrated_video_cost', 'dedicated_video_cost', 'youtube_story_cost', 'youtube_shorts_cost', 'contact_number', 'contact_person_name', 'email_id', 'comment', 'address', 'city', 'state', 'avg_views', 'avg_likes', 'influencer_name', 'campaign_done_earlier', 'no_of_campaign', 'influencer_category', 'name_of_client_worked_before', 'celebrity', 'brands');
fputcsv($f, $fields, $delimiter); 
//$csv_export = implode("\t", array_values($fields)) . "\n";
    //query get data
$sql = mysqli_query($connect, "SELECT channel_name, profile_url, profile_image, subscribers, genre, language, gender, enlyft_exclusive, integrated_video_cost, dedicated_video_cost, youtube_story_cost, youtube_shorts_cost, contact_number, contact_person_name, email_id, comment, address, city, state, avg_views, avg_likes, influencer_name, campaign_done_earlier, no_of_campaign, influencer_category, name_of_client_worked_before, celebrity, brands FROM youtube");
//$csv_export = '';
//$field = mysqli_field_count($connect);
// Output each row of the data, format line as csv and write to file pointer 
while($row = mysqli_fetch_assoc($sql)) {
    // create line with field values
    $lineData = array(decrypt($row['channel_name']), decrypt($row['profile_url']),$row['profile_image'],number_format($row['subscribers']),$row['genre'],$row['language'],$row['gender'],decrypt($row['enlyft_exclusive']),number_format(decrypt($row['integrated_video_cost'])),number_format(decrypt($row['dedicated_video_cost'])),number_format(decrypt($row['youtube_story_cost'])),number_format(decrypt($row['youtube_shorts_cost'])),decrypt($row['contact_number']),decrypt($row['contact_person_name']),decrypt($row['email_id']),$row['comment'],decrypt($row['address']),$row['city'],$row['state'],number_format($row['avg_views']),number_format($row['avg_likes']),decrypt($row['influencer_name']),decrypt($row['campaign_done_earlier']),decrypt($row['no_of_campaign']),$row['influencer_category'],decrypt($row['name_of_client_worked_before']),$row['celebrity'],$row['brands']);
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

