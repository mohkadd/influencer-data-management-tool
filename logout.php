<?php
include "config-pdo.php";
session_start();
date_default_timezone_set("Asia/Kolkata");
$datenow = date("Y-m-d H:i:s");
$operation = "Logout";
$comment = $_SESSION['admin_username']." has logout of system at $datenow";
$ipaddress = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
    `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,:actiontime)";
$stmt2 = $con->prepare($log);
$stmt2->execute(['userid'=>$_SESSION['adminid'],'username'=>$_SESSION['admin_username'],'operation'=>$operation,
    'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,'actiontime'=>$datenow]);
unset($_SESSION['adminid']);
unset($_SESSION['admin_username']);
unset($_SESSION['admintype']);
session_destroy();
$con = null;
header("Location: index.php");
?>