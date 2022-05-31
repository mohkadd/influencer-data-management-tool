<?php
include 'config-pdo.php';
session_start();
date_default_timezone_set("Asia/Calcutta");
$date = date("Y-m-d");
$added_on = date('Y-m-d H:i:s');
$added_by = $_SESSION['admin_username'];
$updated_on = date('Y-m-d H:i:s');
$updated_by = $_SESSION['admin_username'];
function cleanup( $data ) {
//    global $con;
    $data = trim( $data );
    $data = htmlspecialchars( $data );
//    $data = mysqli_real_escape_string($con, $data);
    return $data;
}
   if(isset($_POST['addstate']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
//        $id = cleanup($_POST['id']);
        $state_name = cleanup($_POST['state_name']);

        if(empty($state_name)){
            echo "mandatory";
    //        echo "<script>alert('Please Fill All Fields Properly'); window.location.href='insert-inventory.php';</script>";
        }
        else{
            $checkstate = "SELECT `name` from `state` WHERE `name`=:name";
            $stmt2 = $con->prepare($checkstate);
            $stmt2->execute(["name"=>$state_name]);
            $count = $stmt2->rowCount();
            if($count > 0){
                echo "duplicate";
                die();
            }
            $insertqry="INSERT INTO `state`(`name`,`added_on`,`added_by`,`updated_on`,`updated_by`) VALUES 
            (:name,:added_on,:added_by,:updated_on,:updated_by)";
            $stmt = $con->prepare($insertqry);
            $stmt->execute(["name"=>$state_name,
            "added_on"=>$added_on,"added_by"=>$added_by,
            "updated_on"=>$updated_on,"updated_by"=>$updated_by
            ]);
        if($stmt){
            date_default_timezone_set("Asia/Kolkata");
            $datenow = date("Y-m-d H:i:s");
            $operation = "Insert";
            $comment = $_SESSION['admin_username']." has inserted $state_name in state list at $datenow";
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
    //    echo "<script>alert('Data Inserted'); window.location.href='insert-inventory.php';</script>";
        }
   }
?>