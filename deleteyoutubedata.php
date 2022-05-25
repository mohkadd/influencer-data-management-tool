<?php
session_start();
include 'config-pdo.php';
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id'])) {
//    echo "success";
	$id = htmlspecialchars(trim($_POST['id']));
    $channel = htmlspecialchars(trim($_POST['channel']));
	if (!empty($id)) {
		$delete = "DELETE FROM `youtube` WHERE `id` = :id";
        $stmt = $con->prepare($delete);
        $stmt->execute(["id"=>$id]);
//		$run_query = mysqli_query($connect, $updatestatus);
        if($stmt){
            date_default_timezone_set("Asia/Kolkata");
            $datenow = date("Y-m-d H:i:s");
            $operation = "Delete";
            $comment = $_SESSION['admin_username']." has deleted $channel channel from youtube data at $datenow";
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
	}
    else{
        echo "invalid";
    }
}
?>