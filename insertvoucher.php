<?php
if (isset($_POST['addvoucher'])) {
	include "config.php";
	$vname = htmlspecialchars(trim($_POST['name']));
	$vname = mysqli_real_escape_string($connect, $vname);
	$vpin = htmlspecialchars(trim($_POST['pin']));
	$vpin = mysqli_real_escape_string($connect,$vpin);
	$vnumber = htmlspecialchars(trim($_POST['number']));
	$vnumber = mysqli_real_escape_string($connect, $vnumber);
	$vuser = htmlspecialchars(trim($_POST['user']));
	$vuser = mysqli_real_escape_string($connect, $vuser);
	if (!empty($vname) && !empty($vpin) && !empty($vnumber) && !empty($vuser)) {
		$checkvoucher = "SELECT voucher_no FROM vouchers WHERE voucher_no = '".$vnumber."'";
		$result = mysqli_query($connect, $checkvoucher);
		if ($result) {
			$count = mysqli_num_rows($result);
			if ($count == 0) {
				$insertvoucher = "INSERT INTO vouchers (user_id, voucher_name, voucher_no, voucher_pin) VALUES ('".$vuser."','".$vname."','".$vnumber."','".$vpin."')";
				$runquery = mysqli_query($connect, $insertvoucher);
				if ($runquery) {
					echo "success";
				}
				else{
					echo "fail";
				}
			}
			else
			{
				echo "exist";
			}
		}
		else
		{
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