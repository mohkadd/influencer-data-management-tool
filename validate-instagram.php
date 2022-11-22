<?php 
include 'config-pdo.php';
session_start();
// date_default_timezone_set("Asia/Calcutta");
// $date = date("Y-m-d");
// $added_on = date('Y-m-d H:i:s');
// $added_by = $_SESSION['admin_username'];
// $updated_on = "0000-00-00 00:00:00";
// $updated_by = $_SESSION['admin_username'];
define("encryption_method", "AES-128-CBC");
define("key", "enlyft@2022#$%");
define("iv", "dataencrypt@2022");
function encrypt($data) {
    $key = key;
    $plaintext = $data;
    $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
    $iv = iv;
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
    return $ciphertext;
}
function decrypt($data) {
    $key = key;
    $c = base64_decode($data);
    $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
    $iv = iv;
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    if (hash_equals($hmac, $calcmac))
    {
        return $original_plaintext;
    }
}
function cleanup( $data ) {
//    global $con;
    $data = trim( $data );
    $data = htmlspecialchars( $data );
//    $data = mysqli_real_escape_string($con, $data);
    return $data;
}
function checkemptystring($data){
    if(empty($data)){
        $data = "NA";
    }
    return $data;
}
function checkemptynumber($data){
    if(empty($data)){
        $data = 0;
    }
    return $data;
}

if(isset($_POST['insertinstagram']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $unique_id = cleanup($_POST['unique_id']);
    $unique_id = encrypt($unique_id);
    $checkid = "SELECT `unique_id` from `instagram` WHERE `unique_id`=:unique_id";
    $stmt2 = $con->prepare($checkid);
    $stmt2->execute(["unique_id"=>$unique_id]);
    $count = $stmt2->rowCount();
    if($count > 0){
        echo "duplicate";
        die();
    }
    else{
        echo "success";
    }
    
}
?>