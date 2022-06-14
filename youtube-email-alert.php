<?php
include "config-pdo.php";
include "functions/functions.php";
date_default_timezone_set("Asia/Kolkata");
//header('Content-type: application/json');  
//$API_Url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCA7RxVq2pMGYp_-Qo4S2dEw&key=[APIKEY]';
$API_Key = '';
$date = date('Y-m-10');
//$date2 = date('Y-m-d', strtotime('-7 days') );
$time = date('00:00:00');
$datetime = $date."T".$time."Z";
$query = "nita ambani";
$query = urlencode($query);
$keywords = array("साड़ी","saree","Handbag","बैग","Sandal","सैंडल","मोबाइल","Mobile","चाय","tea","पानी","water price","lifestyle","electricity bill",
    "Ambani vs Dubai Sheikh","वैनिटी वैन","बाथरूम","Bathroom","worldrecord","शौक","Car","Car Price","waste","money");
$keywords = implode("|",$keywords);
//echo $date2;
//echo $datetime."<br>";
$i = 0;
$count1 = 0;
$results = 50;
//$json_details = json_decode(file_get_contents("https://youtube.googleapis.com/youtube/v3/search?part=snippet&maxResults=$results&publishedAfter=$datetime&q=$query&regionCode=IN&type=video&key=$API_Key"),true);
$count = $json_details['pageInfo']['resultsPerPage'];
$response = "";
$response .= "
<div style='color:black;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";line-height:18px'>
    <div style='margin:0 auto;max-width:600px;padding:20px 0'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <tbody>";
//if(count($json_details['items']) > 0){
//    echo "Data Present";
//}
//else{
//    echo "No Data Found";
//}
while($i < $count){
    if(preg_match_all("[$keywords]i", $json_details['items'][$i]['snippet']['title']) || 
       preg_match_all("[$keywords]i", $json_details['items'][$i]['snippet']['description'])){
//    if(preg_match("[]", $json_details['items'][$i]['snippet']['title'])){
        $count1++; 
        $response .= "
                <tr>
                    <td style='border-top-color:#f0efef;border-top-style:solid;border-top-width:1px;padding:20px 0'>
                        <table border='0' cellpadding='5' cellspacing='0' width='100%'>
                            <tbody>
                                <tr>
                                    <td rowspan='3' width='120' style='vertical-align:top,padding:20px !important;' valign='top'>
                                        <a target='_blank' href='https://www.youtube.com/watch?v=".$json_details['items'][$i]['id']['videoId']."'
                                            style='color:#da552f!important;text-decoration:none'>
                                            <img height='180' src='".$json_details['items'][$i]['snippet']['thumbnails']['high']['url']."'>
                                        </a>
                                    </td>
                                    <td>
                                        <a target='_blank' href='https://www.youtube.com/watch?v=".$json_details['items'][$i]['id']['videoId']."'
                                            style='color:#666!important;font-size:15px;text-decoration:none'>
                                            ".$json_details['items'][$i]['snippet']['title']."
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='color:#777;padding-bottom:4px;padding-top:4px'>
                                        By <a target='_blank' href='https://youtube.com/channel/".$json_details['items'][$i]['snippet']['channelId']."'>
                                            ".$json_details['items'][$i]['snippet']['channelTitle']."
                                        </a><br>
                                        Published At ".$json_details['items'][$i]['snippet']['publishedAt']."
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
    ";
    }
//    else{
//        $response .= "<tr>
//                    <td>No</td>
//                    </tr>";
//    }
    $i++;
}
if($count1 == 0){
    $response .= "<tr>
                    <td colspan='2' width='120' style='vertical-align:top,padding:20px !important;' valign='top'>
                             No Video Found
                    </td>
                </tr>";
}
//<!--
//                <tr>
//                    <td
//                        style="border-top-color:#eee;border-top-style:solid;border-top-width:1px;color:#bbbbbb;font-size:12px;padding:20px 0">
//                        This notification was sent by <a
//                            href="https://www.labnol.org/youtube-email-alerts-201219">YouTube Email Alerts</a>.
//                    </td>
//                </tr>
//-->
        $response .= " 
            </tbody>
        </table>
    </div>
</div>";
if($count1 == 0){
    echo $response;
}
else{
    echo $response;
}
//echo $response;
?>
