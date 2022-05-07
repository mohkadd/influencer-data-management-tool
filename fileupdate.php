<?php 
include 'config-pdo.php';
date_default_timezone_set("Asia/Kolkata");
$datenow = date("d-m-Y");
$updated = date("Y-m-d H:i:s");
if (isset($_POST['submitfile']) && isset($_POST['title']) && isset($_POST['filename']) && isset($_POST['fileid'])){
	$updateid = htmlspecialchars(trim($_POST['fileid']));
	$title = htmlspecialchars(trim($_POST['title']));
	$filename = htmlspecialchars(trim($_POST['filename']));
	$tmpname = $_FILES['uploadfile']['tmp_name'];
	$uploadfile = $datenow."-".$_FILES['uploadfile']['name'];
	$uploadfile = htmlspecialchars(trim($uploadfile));
// 	$uploadfile = mysqli_real_escape_string($connect, $uploadfile);
	if (!empty($updateid) && !empty($title) && !empty($filename) && !empty($uploadfile)) {
		move_uploaded_file($tmpname,"../images/".$uploadfile);
		$updatequery = "UPDATE websitefileanciapp SET name = :name, lastupdated = :updated WHERE id = :id";
		$stmt1 = $con->prepare($updatequery);
		$stmt1->execute(['name' => $uploadfile, 'updated' => $updated, 'id' => $updateid]);
// 		$runquery = mysqli_query($connect, $updatequery);
		if($stmt1){
			// echo "testing $updateid $title $filename $uploadfile";
			echo "<script> alert('File has been Updated')</script>";
			echo "<script> window.location.href = 'filedetails.php';</script>";	
		}
		else{
			echo "<script> alert('There was an error while Updating File, Please check the filename or file type')</script>";
			echo "<script> window.location.href = 'filedetails.php';</script>";
		}
		

	}
	
}
?>