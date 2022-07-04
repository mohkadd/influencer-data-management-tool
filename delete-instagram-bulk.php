<?php
session_start();
include 'config-pdo.php';
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['yt_id'])) {
//    echo "success";
	$yt_id = htmlspecialchars(trim($_POST['yt_id']));
    $yt_arr = explode(",", $yt_id);
    $ch_count = count($yt_arr);
//    echo $ch_count;
//    exit;
//    $channel = htmlspecialchars(trim($_POST['channel']));
	if (!empty($yt_id)) {
		$delete = "DELETE FROM `instagram` WHERE `id` in ($yt_id)";
        $stmt = $con->prepare($delete);
        $stmt->execute();
//		$run_query = mysqli_query($connect, $updatestatus);
        if($stmt){
            date_default_timezone_set("Asia/Kolkata");
            $datenow = date("Y-m-d H:i:s");
            $operation = "Bulk Delete";
            $comment = $_SESSION['admin_username']." has deleted $ch_count influencer from instagram data at $datenow";
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            $browser = $_SERVER['HTTP_USER_AGENT'];
            $log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
                `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
            $stmt2 = $con->prepare($log);
            $stmt2->execute(['userid'=>$_SESSION['adminid'],'username'=>$_SESSION['admin_username'],'operation'=>$operation,
                'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$datenow]);
            echo $yt_id; 
        }
        else{
            echo "fail";
        }
	}
    else{
        echo "invalid";
    }
}
?>