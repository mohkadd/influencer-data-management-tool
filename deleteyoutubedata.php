<?php 
include 'config-pdo.php';
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id'])) {
//    echo "success";
	$id = htmlspecialchars(trim($_POST['id']));
	if (!empty($id)) {
		$delete = "DELETE FROM `youtube` WHERE `id` = :id";
        $stmt = $con->prepare($delete);
        $stmt->execute(["id"=>$id]);
//		$run_query = mysqli_query($connect, $updatestatus);
        if($stmt){
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