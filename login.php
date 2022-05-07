<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
$datenow = date("Y-m-d H:i:s");
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