<?php
include "config-pdo.php";
define("encryption_method", "AES-128-CBC");
define("key", "enable@2022#$%");
define("iv", "enable@2022#$%^&");
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
function postercount(){
	global $con;
	$voucher_count = "SELECT COUNT(id) AS poster_count FROM abstractanciapp WHERE abs_category = 'Poster' OR abs_category = 'e-Poster'";
	$stmt = $con->prepare($voucher_count);
	$stmt->execute();
	$run_count = $stmt->rowCount();
// 	if ($run_count) {
	  if ($run_count == 1) {
	    if ($row = $stmt->fetch()) {
	      $vouchers_number = $row->poster_count;
	      echo $vouchers_number;
	    }
	  }
// 	}
}

function todaycount(){
	global $con;
    $today = date('Y-m-d');
	$voucher_view_count = "SELECT COUNT(id) AS today_count FROM userdata WHERE date = '$today'";
	$stmt = $con->prepare($voucher_view_count);
	$stmt->execute();
	$run_view = $stmt->rowCount();
// 	if ($run_view) {
	  if ($run_view == 1) {
	    if ($row = $stmt->fetch()) {
	      $voucher_views = $row->today_count;
	      echo $voucher_views;
	    }
	  }
// 	}
}

function completecount(){
	global $con;
	$voucher_count = "SELECT COUNT(id) AS complete_count FROM userdata WHERE complete = '1'";
	$stmt = $con->prepare($voucher_count);
	$stmt->execute();
	$run_count = $stmt->rowCount();
// 	if ($run_count) {
	  if ($run_count == 1) {
	    if ($row = $stmt->fetch()) {
	      $vouchers_number = $row->complete_count;
	      echo $vouchers_number;
	    }
	  }
// 	}
}

function incompletecount(){
	global $con;
	$voucher_count = "SELECT COUNT(id) AS incomplete_count FROM userdata WHERE complete = '0'";
	$stmt = $con->prepare($voucher_count);
	$stmt->execute();
	$run_count = $stmt->rowCount();
// 	if ($run_count) {
	  if ($run_count == 1) {
	    if ($row = $stmt->fetch()) {
	      $vouchers_number = $row->incomplete_count;
	      echo $vouchers_number;
	    }
	  }
// 	}
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

function youexclusivecount(){
  global $con;
  $contact_count = "SELECT COUNT(IF(enlyft_exclusive = 'Yes', id, NULL)) AS exclusive_count FROM youtube";
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

function categorycount(){
  global $con;
  $contact_count = "SELECT COUNT(DISTINCT category) AS category_count FROM inventory";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->category_count;
        echo $number_contact;
      }
    }
//   }
}

function generecount(){
  global $con;
  $contact_count = "SELECT COUNT(DISTINCT genere) AS genere_count FROM inventory";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->genere_count;
        echo $number_contact;
      }
    }
//   }
}

function propertycount(){
  global $con;
  $contact_count = "SELECT COUNT(DISTINCT property) AS property_count FROM inventory";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->property_count;
        echo $number_contact;
      }
    }
//   }
}

function mediainventorycount(){
  global $con;
  $contact_count = "SELECT COUNT(DISTINCT media_inventory_available) AS mediainventory_count FROM inventory";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->mediainventory_count;
        echo $number_contact;
      }
    }
//   }
}

function pricingmodelcount(){
  global $con;
  $contact_count = "SELECT COUNT(DISTINCT pricing_model) AS pricing_model_count FROM inventory";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->pricing_model_count;
        echo $number_contact;
      }
    }
//   }
}

function mediatypecount(){
  global $con;
  $contact_count = "SELECT COUNT(DISTINCT type_of_media) AS media_type_count FROM inventory";
  $stmt = $con->prepare($contact_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_contact = $row->media_type_count;
        echo $number_contact;
      }
    }
//   }
}

function filecount(){
  global $con;
  $file_count = "SELECT COUNT(id) AS file_count FROM websitefileanciapp";
  $stmt = $con->prepare($file_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_file = $row->file_count;
        echo $number_file;
      }
    }
//   }
}

function enablecount(){
  global $con;
  $file_count = "SELECT COUNT(id) AS file_count FROM websitefileanciapp WHERE disable = 0";
  $stmt = $con->prepare($file_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_file = $row->file_count;
        echo $number_file;
      }
    }
//   }
}

function disablecount(){
  global $con;
  $file_count = "SELECT COUNT(id) AS file_count FROM websitefileanciapp WHERE disable = 1";
  $stmt = $con->prepare($file_count);
  $stmt->execute();
  $run_count = $stmt->rowCount();
//   if ($run_count) {
    if ($run_count == 1) {
      if ($row = $stmt->fetch()) {
        $number_file = $row->file_count;
        echo $number_file;
      }
    }
//   }
}
?>