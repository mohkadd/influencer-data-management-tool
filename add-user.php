<?php
include 'config-pdo.php';
session_start();
date_default_timezone_set("Asia/Calcutta");
$date = date("Y-m-d");
$added_on = date('Y-m-d H:i:s');
$added_by = $_SESSION['admin_username'];
$updated_on = date('Y-m-d H:i:s');
$last_login = '0000-00-00 00:00:00';
$updated_by = $_SESSION['admin_username'];
function cleanup( $data ) {
//    global $con;
    $data = trim( $data );
    $data = htmlspecialchars( $data );
//    $data = mysqli_real_escape_string($con, $data);
    return $data;
}
   if(isset($_POST['adduser']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
//        $id = cleanup($_POST['id']);
        $username = cleanup($_POST['username']);
        $pwd = cleanup($_POST['pwd']);
        $usertype = cleanup($_POST['usertype']);

        if(empty($username)){
            echo "mandatory";
    //        echo "<script>alert('Please Fill All Fields Properly'); window.location.href='insert-inventory.php';</script>";
        }
        else{
            $checkuser = "SELECT `username` from `admin` WHERE `username`=:username";
            $stmt2 = $con->prepare($checkuser);
            $stmt2->execute(["username"=>$username]);
            $count = $stmt2->rowCount();
            if($count > 0){
                echo "duplicate";
                die();
            }
            $insertqry="INSERT INTO `admin`(`username`,`password`,`admin_type`,`last_login`) VALUES 
            (:username,:password,:admin_type,:last_login)";
            $stmt = $con->prepare($insertqry);
            $stmt->execute(["username"=>$username,
            "password"=>$pwd,"admin_type"=>$usertype,
            "last_login"=>$last_login
            ]);
        if($stmt){
            date_default_timezone_set("Asia/Kolkata");
            $datenow = date("Y-m-d H:i:s");
            $operation = "Insert";
            $comment = $_SESSION['admin_username']." has inserted $username in user list at $datenow";
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