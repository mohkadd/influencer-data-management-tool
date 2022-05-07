<?php 
include 'config-pdo.php';
if (isset($_REQUEST['status']) && isset($_REQUEST['id'])) {
	$status = htmlspecialchars(trim($_REQUEST['status']));
	$id = htmlspecialchars(trim($_REQUEST['id']));
	if ($status == "1") {
		$updatestatus = "UPDATE `userdata` SET `status` = :status WHERE `id` = :id";
        $stmt = $con->prepare($updatestatus);
        $stmt->execute(["status"=>$status, "id"=>$id]);
//		$run_query = mysqli_query($connect, $updatestatus);
        if($stmt){
            header('Location: userdata.php');
        }
	}
    if($status == "2"){
        $updatestatus = "UPDATE `userdata` SET `status` = :status WHERE `id` = :id";
        $stmt = $con->prepare($updatestatus);
        $stmt->execute(["status"=>$status, "id"=>$id]);
//		$run_query = mysqli_query($connect, $updatestatus);
        if($stmt){
            header('Location: userdata.php');
        }
    }
	if($status == "3"){
		$updatestatus = "UPDATE `userdata` SET `status` = :status WHERE `id` = :id";
		$stmt = $con->prepare($updatestatus);
        $stmt->execute(["status"=>$status, "id"=>$id]);
//		$run_query = mysqli_query($connect, $updatestatus);
        if($stmt){
            header('Location: userdata.php');
        }
	}
}
?>