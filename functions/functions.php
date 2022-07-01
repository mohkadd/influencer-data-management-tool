<?php
include "config-pdo.php";
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

function youinfluencercount(){
  global $con;
  $contact_count = "SELECT COUNT(id) AS influencer_count FROM youtube";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->influencer_count;
        echo $number_contact;
      }
    }
//   }
}

function instainfluencercount(){
  global $con;
  $contact_count = "SELECT COUNT(id) AS influencer_count FROM instagram";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->influencer_count;
        echo $number_contact;
      }
    }
//   }
}

function youexclusivecount(){
  global $con;
  $enex = "Yes";
  $enex = encrypt($enex);    
  $contact_count = "SELECT COUNT(IF(enlyft_exclusive = '$enex', id, NULL)) AS exclusive_count FROM youtube";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->exclusive_count;
        echo $number_contact;
      }
    }
//   }
}

function younonexclusivecount(){
  global $con;
  $enex = "No";
  $enex = encrypt($enex);    
  $contact_count = "SELECT COUNT(IF(enlyft_exclusive = '$enex', id, NULL)) AS exclusive_count FROM youtube";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->exclusive_count;
        echo $number_contact;
      }
    }
//   }
}

function instaexclusivecount(){
  global $con;
  $enex = "Yes";
  $enex = encrypt($enex);    
  $contact_count = "SELECT COUNT(IF(enlyft_exclusive = '$enex', id, NULL)) AS exclusive_count FROM instagram";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->exclusive_count;
        echo $number_contact;
      }
    }
//   }
}

function instanonexclusivecount(){
  global $con;
  $enex = "No";
  $enex = encrypt($enex);    
  $contact_count = "SELECT COUNT(IF(enlyft_exclusive = '$enex', id, NULL)) AS exclusive_count FROM instagram";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->exclusive_count;
        echo $number_contact;
      }
    }
//   }
}

function youmalecount(){
  global $con;
  $contact_count = "SELECT COUNT(IF(gender = 'Male', id, NULL)) AS male_count FROM youtube";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->male_count;
        echo $number_contact;
      }
    }
//   }
}

function youfemalecount(){
  global $con;
  $contact_count = "SELECT COUNT(IF(gender = 'Female', id, NULL)) AS female_count FROM youtube";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->female_count;
        echo $number_contact;
      }
    }
//   }
}

function instamalecount(){
  global $con;
  $contact_count = "SELECT COUNT(IF(gender = 'Male', id, NULL)) AS male_count FROM instagram";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->male_count;
        echo $number_contact;
      }
    }
//   }
}

function instafemalecount(){
  global $con;
  $contact_count = "SELECT COUNT(IF(gender = 'Female', id, NULL)) AS female_count FROM instagram";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->female_count;
        echo $number_contact;
      }
    }
//   }
}


?>