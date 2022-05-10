<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
$datenow = date("Y-m-d H:i:s");
$dateout = "0000-00-00 00:00:00";
if (isset($_POST['logincheck'])) {
	include "config-pdo.php";
	$uname = htmlspecialchars(trim($_POST['username']));
// 	$uname = mysqli_real_escape_string($connect, $uname);
	$upass = htmlspecialchars(trim($_POST['password']));
// 	$upass = mysqli_real_escape_string($connect, $upass);
	$checkuser = "SELECT * FROM admin WHERE username = :username";
	$stmt = $con->prepare($checkuser);
	$stmt->execute(['username' => $uname]);
// 	$result = mysqli_query($connect, $checkuser);
	if ($stmt) {
	    $result = $stmt->rowCount();
		if ($result == 1){
			while($row = $stmt->fetch()) {
				$password = $row->password;
				if ($upass == $password) {
					$updatelogin = "UPDATE admin SET last_login = :login WHERE username = :user";
					$stmt1 = $con->prepare($updatelogin);
					$stmt1->execute(['login' => $datenow, 'user' => $uname]);
				// 	$runquery = mysqli_query($connect, $updatelogin);
					if ($stmt1) {
						$user_id = $row->id;
						$user_type = $row->admin_type;
						$_SESSION['adminid'] = $user_id;
						$_SESSION['admin_username'] = $uname;
						$_SESSION['admintype'] = $user_type;
                        $operation = "Login";
                        $comment = "$uname has logged into system at $datenow";
                        $ipaddress = $_SERVER['REMOTE_ADDR'];
                        $browser = $_SERVER['HTTP_USER_AGENT'];
                        $log = "INSERT into `loghistory` (`userid`,`username`,`operation`,`comment`,`ipaddress`,`browser`,
                        `actiontime`) values (:userid,:username,:operation,:comment,:ipaddress,:browser,
                        :actiontime)";
                        $stmt2 = $con->prepare($log);
                        $stmt2->execute(['userid'=>$user_id,'username'=>$uname,'operation'=>$operation,
                        'comment'=>$comment,'ipaddress'=>$ipaddress,'browser'=>$browser,
                        'actiontime'=>$datenow]);
                        
						echo "success";
					}
					else{
						echo "fail";
					}
				}
				else{
					echo "fail";
				}
			}
		}
		else{
			echo "fail";
		}	
	}
	else{
		echo "fail";
	}
}
else{
	echo "fail";
}
?>