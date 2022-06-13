<?php
include "config-pdo.php";
include "functions/functions.php";
date_default_timezone_set("Asia/Kolkata");
//header('Content-type: application/json');  
//$API_Url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCA7RxVq2pMGYp_-Qo4S2dEw&key=[APIKEY]';
$API_Key = ''; //ZAKI API KEY
$date = date('Y-m-d');
//$date2 = date('Y-m-d', strtotime('-7 days') );
$time = date('10:00:00');
$datetime = $date."T".$time."Z";
$clients = array("nita ambani", "mukesh ambani");
$arrcount = count($clients);

//echo $date2;
//echo $datetime."<br>";
$i = 0;$j = 0;$results = 50;
while($j < $arrcount){
    $query = $clients[$j];
    $capquery = ucwords($query);
    $query = urlencode($query);
    if($j == 0){
        $keywords = array("साड़ी","saree","Handbag","बैग","Sandal","सैंडल","मोबाइल","Mobile","चाय","tea","पानी","water price","lifestyle","electricity bill",
        "वैनिटी वैन","बाथरूम","Bathroom","worldrecord","शौक","Car","Car Price","waste","money");
        $keywords = implode("|",$keywords);
    }
    if($j == 1){
        $keywords = array("lifestyle","Dubai prince","Christiano Ronaldo","electricity bill","expensive house","उड़ाते","अरबों","दौलत"
        ,"ronaldo","waste","money");
        $keywords = implode("|",$keywords);
    }
//    $json_details = json_decode(file_get_contents("https://youtube.googleapis.com/youtube/v3/search?part=snippet&maxResults=$results&order=viewCount&publishedAfter=$datetime&q=$query&regionCode=IN&type=video&key=$API_Key"),true);
    $count = $json_details['pageInfo']['resultsPerPage'];
    $response = "";
    $response .= "
    <div style='color:black;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";line-height:18px'>
        <div style='margin:0 auto;max-width:600px;padding:20px 0'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>";
    while($i < $count){
        if(preg_match_all("[$keywords]i", $json_details['items'][$i]['snippet']['title']) || 
           preg_match_all("[$keywords]i", $json_details['items'][$i]['snippet']['description'])){ 
            $bg = "style='background-color:yellow';";
        }
        else{
            $bg = "";
        }
            $response .= "
                    <tr ".$bg.">
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
        $i++;
    }
            $response .= " 
                </tbody>
            </table>
        </div>
    </div>";
//                require_once 'PHPMailer-master/PHPMailerAutoload.php';
//            $mail = new PHPMailer; 
//            $mail->isSMTP();           
//            $mail->Host = 'smtp.gmail.com';   
//            $mail->SMTPAuth = true;     
//            $mail->Username = 'faizan.kazi@enlyft.in';        
//            $mail->Password = '';    
//            $mail->SMTPSecure = 'tls';   
//            $mail->Port = 587;
//            $mail->setFrom('faizan.kazi@enlyft.in', 'YouTube Email Alert');
////            $mail->addAddress('zaki.pirzada@enlyft.in', 'User1');
////            $mail->addAddress('aniruddha.sawant@enlyft.in', 'User2');
//            $mail->addBCC('faizan.kazi@enlyft.in', 'User'); 
//
//            $mail->isHTML(true);
//            $mail->Subject = "$capquery YouTube Email Alert $date Since 00:00 time";
//            $mail->Body    = $response;
//            if(!$mail->send()){ 
//                echo "fail";
//            }
//            else{
//                echo "success";
//            }
//    echo $response."<br><br><br>";
    $j++;
}
$i = 0;
$j = 0;
?>
