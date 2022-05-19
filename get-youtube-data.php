<?php
header('Content-type: application/json');  
$API_Url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCA7RxVq2pMGYp_-Qo4S2dEw&key=AIzaSyClR56gbTmK3BhSka8UdrV8bjLYmJYHqSk';
$API_Key = '';
 
 
// If you don't know the channel ID see below
$channelId = 'UCA7RxVq2pMGYp_-Qo4S2dEw';
 
$parameter = [
    'id'=> $channelId,
    'part'=> 'contentDetails',
    'key'=> $API_Key
];
$channel_URL = $API_Url . 'channels?' . http_build_query($parameter);
$json_details = json_decode(file_get_contents("https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCA7RxVq2pMGYp_-Qo4S2dEw&key=API_KEY"),true);
//echo "<pre>";
//print_r($json_details);
echo $json_details['items'][0]['statistics']['subscriberCount']; 
//echo "</pre>";
//echo $json_details;
?>