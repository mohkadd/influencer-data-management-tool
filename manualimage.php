<?php
include "config-pdo.php";
include "functions/functions.php";
ini_set('max_execution_time', 0);
//header('Content-type: application/json');  
//$API_Url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCA7RxVq2pMGYp_-Qo4S2dEw&key=';
$API_Key = 'AIzaSyClR56gbTmK3BhSka8UdrV8bjLYmJYHqSk';

$selectqry = "SELECT id, subscribers, channel_name, profile_url,profile_image, influencer_category, celebrity from youtube where profile_image = '../../images/user.jpg'";
$stmt = $con->prepare($selectqry);
$stmt->execute();
$i=1;
echo "<table>";
    echo "<tr>";
    echo "<td>Sr. No.</td><td>ID</td><td>Subscribers</td><td>URL</td><td>Image</td><tr>";
while($row = $stmt->fetch()){
    
    echo "<tr><td>$i</td><td>".$row->id."</td><td>".$row->subscribers."</td><td>".decrypt($row->profile_url)."</td>";
    echo "<td>".$row->profile_image."</td></tr>";
    $i++;
}
echo "</table>";
?>