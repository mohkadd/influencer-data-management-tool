<?php 
if (isset($_POST['adduser'])) {
	include "config.php";
	$number = htmlspecialchars(trim($_POST['user_number']));
	$number = mysqli_real_escape_string($connect, $number);
	$name = htmlspecialchars(trim($_POST['name']));
	$name = mysqli_real_escape_string($connect, $name);
	$email = htmlspecialchars($_POST['email']);
	$email = mysqli_real_escape_string($connect, $email);
	if (!empty($number) && !empty($name) && !empty($email)) {
		$checkcontact = "SELECT user_number FROM users WHERE user_number = '".$number."'";
		$result = mysqli_query($connect, $checkcontact);
		if ($result) {
			$count = mysqli_num_rows($result);
			if ($count == 0) {
				$insertquery = "INSERT INTO users (user_number, email, name) VALUES ('".$number."', '".$email."', '".$name."')";
				$runquery = mysqli_query($connect, $insertquery);
				if ($runquery) {
					echo "success";
				}
				else{
					echo "fail";
				}
			}
			else{
				echo "exist";
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