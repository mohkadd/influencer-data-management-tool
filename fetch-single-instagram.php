<!--
<center>
    <img class='card-img-top img-responsive img-thumbnail text-center' style='width:200px;' src='images/airtel.jpg' alt='Card image cap'>
</center>
-->
<?php 
include 'config-pdo.php';
session_start();
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
if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = htmlspecialchars($_REQUEST['id']);
    $query = "SELECT * FROM instagram WHERE id = '$id'";
    $stmt1 = $con->prepare($query);
    $stmt1->execute();
    $count = $stmt1->rowCount();
    if($_SESSION['admintype'] == 2){
        $readonly = "readonly";
    }
    else{
        $readonly = " ";
    }
    
//   if ($run_users) {
    if ($count == 1) {
      if ($row = $stmt1->fetch()) {
        $output = "
         
                    <form method='POST' id='edit' name='edit' action='updateinstagram.php'>
                    <div class='row'>
                        <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Unique ID <strong class='text-danger'>**</strong></label>
                              <input type='hidden' id='id' name='id' value='$row->id'>
                              <input type='text' id='unique_id' name='unique_id' class='form-control' placeholder='Enter Unique ID' value='".decrypt($row->unique_id)."' required readonly>
                            </div>
                          </div>
                          
                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Influencer Name <strong class='text-danger'>**</strong></label>
                              <input type='text' id='influencer_name' name='influencer_name' class='form-control' placeholder='Enter Influencer Name' value='".decrypt($row->influencer_name)."' required>
                            </div>
                          </div>
                          
                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Instagram Handle <strong class='text-danger'>**</strong></label>
                              <input type='text' id='handle' name='handle' class='form-control' placeholder='Enter Instagram Handle' value='".$row->handle."' required>
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Profile URL <strong class='text-danger'>**</strong></label>
                              <input type='url' id='profile_url' name='profile_url' class='form-control' placeholder='Enter Profile URL' value='".decrypt($row->profile_url)."' required>
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Followers <strong class='text-danger'>##</strong></label>
                              <input type='number' id='followers' name='followers' class='form-control' placeholder='Enter Followers' value='$row->followers' ".$readonly.">
                            </div>
                          </div>
                          
                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Genre</label>
                              <input type='text' id='genre' name='genre' class='form-control' placeholder='Enter Genre' value='$row->genre'>
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Language <strong class='text-danger'>**</strong></label>
                              <select name='language' id='language' class='form-control select2' required>
                                  <option value='$row->language' selected>$row->language</option>
                                  <option value=''>Select Language</option>
                                  <option value='English'>English</option>
                                  <option value='Hindi'>Hindi</option>        
                                  <option value='Marathi'>Marathi</option>
                                  <option value='Urdu'>Urdu</option>
                                  <option value='Bengali'>Bengali</option>
                                  <option value='Punjabi'>Punjabi</option>
                                  <option value='Telugu'>Telugu</option>
                                  <option value='Tamil'>Tamil</option>
                                  <option value='Gujarati'>Gujarati</option>
                                  <option value='Kannada'>Kannada</option> 
                                  <option value='Odia'>Odia</option>
                                  <option value='Malayalam'>Malayalam</option>
                                  <option value='Assamese'>Assamese</option>
                                  <option value='Santali'>Santali</option>
                                  <option value='Sanskrit'>Sanskrit</option>
                                  <option value='Maithili'>Maithili</option> 
                                  <option value='Bodo'>Bodo</option>
                                  <option value='Dogri'>Dogri</option>
                                  <option value='Kashmiri'>Kashmiri</option>
                                  <option value='Konkani'>Konkani</option>
                                  <option value='Manipuri'>Manipuri</option>
                                  <option value='Nepali'>Nepali</option>
                                  <option value='Sindhi'>Sindhi</option>      
                              </select>
                            </div>
                          </div>
                          
                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Verified <strong class='text-danger'>**</strong></label>
                              <select name='verified' id='verified' class='form-control' required>
                                  <option value=''>Is Account Verified?</option>
                                  <option value='$row->verified' selected>$row->verified</option>
                                  <option value='Yes'>Yes</option>
                                  <option value='No'>No</option>                
                              </select>
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Gender <strong class='text-danger'>**</strong></label>
                              <select name='gender' id='gender' class='form-control' required>
                                  <option value=''>Select Gender</option>
                                  <option value='$row->gender' selected>$row->gender</option>
                                  <option value='Male'>Male</option>
                                  <option value='Female'>Female</option>        
                                  <option value='Both'>Both</option>        
                              </select>
                            </div>
                          </div>
                          
                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>ENLYFT Exclusive <strong class='text-danger'>**</strong></label>
                              <select name='enlyft_exclusive' id='enlyft_exclusive' class='form-control' required>
                                  <option value=''>Select ENLYFT Exclusive</option>
                                  <option value='".decrypt($row->enlyft_exclusive)."' selected>".decrypt($row->enlyft_exclusive)."</option>
                                  <option value='Yes'>Yes</option>
                                  <option value='No'>No</option>        
                              </select>
                            </div>
                          </div>

                          <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Image Cost</label>
                          <input type='text' id='image_cost'  name='image_cost' class='form-control' placeholder='Enter Image Cost' value='".decrypt($row->image_cost)."'>
                        </div>
                      </div>
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Video Cost</label>
                          <input type='text' id='video_cost' name='video_cost' class='form-control' placeholder='Enter Video Cost' value='".decrypt($row->video_cost)."'>
                        </div>
                      </div>
                       
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>IGTV Cost</label>
                          <input type='text' id='igtv_cost' name='igtv_cost' class='form-control' placeholder='Enter IGTV Cost' value='".decrypt($row->igtv_cost)."'>
                        </div>
                      </div>
                       
                       
                       <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Reels (15 second) Cost</label>
                          <input type='text' id='reels_15sec' name='reels_15sec' class='form-control' placeholder='Enter Reels (15 second) Cost' value='".decrypt($row->reels_15sec)."'>
                        </div>
                      </div>
                      
                        <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Reels (30 second) Cost</label>
                          <input type='text' id='reels_30sec' name='reels_30sec' class='form-control' placeholder='Enter Reels (30 second) Cost' value='".decrypt($row->reels_30sec)."'>
                        </div>
                      </div>
                       
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Image Story Cost</label>
                          <input type='text' id='image_story_cost' name='image_story_cost' class='form-control' placeholder='Enter Image Story Cost' value='".decrypt($row->image_story_cost)."'>
                        </div>
                      </div> 
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Video Story Cost</label>
                          <input type='text' id='video_story_cost' name='video_story_cost' class='form-control' placeholder='Enter Video Story Cost' value='".decrypt($row->video_story_cost)."'>
                        </div>
                      </div> 
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Image Story Swipeup Cost</label>
                          <input type='text' id='image_story_swipeup_cost' name='image_story_swipeup_cost' class='form-control' placeholder='Enter Image Story Swipeup Cost' value='".decrypt($row->image_story_swipeup_cost)."'>
                        </div>
                      </div>
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Video Story Swipeup Cost</label>
                          <input type='text' id='video_story_swipeup_cost' name='video_story_swipeup_cost' class='form-control' placeholder='Enter Video Story Swipeup Cost' value='".decrypt($row->video_story_swipeup_cost)."'>
                        </div>
                      </div>
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Carousel Cost</label>
                          <input type='text' id='carousel_cost' name='carousel_cost' class='form-control' placeholder='Enter Carousel Cost' value='".decrypt($row->carousel_cost)."'>
                        </div>
                      </div>                   


                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Contact Number <strong class='text-danger'>**</strong></label>
                              <input type='text' id='contact_number' name='contact_number' onkeypress='return isNumberKey(event)' class='form-control' placeholder='Enter Valid 10 Digit Contact Number' value='".decrypt($row->contact_no)."' required ".$readonly.">
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Contact Person Name <strong class='text-danger'>**</strong></label>
                              <input type='text' id='contact_person_name' name='contact_person_name' class='form-control' placeholder='Enter Contact Person Name' value='".decrypt($row->contact_person_name)."' required>
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Email<strong class='text-danger'>**</strong></label>
                              <input type='text' id='email' name='email' class='form-control' placeholder='Enter Email ID' value='".decrypt($row->email)."' required ".$readonly.">
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Comment</label>
                              <input type='text' id='comment' name='comment' class='form-control' placeholder='Enter Comment' value='$row->comment'>
                            </div>
                          </div>
                          
                          <div class='col-md-12'>
                            <div class='form-group'>
                              <label for='title'>Address</label>
                              <textarea name='address' class='form-control' id='address' placeholder='Enter Address' cols='30' rows='2'>".decrypt($row->address)."</textarea>
                            </div>
                          </div>";
          

          $output .= "
                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>City</label>
    
                              <select name='city' id='city' class='form-control select2'>
                                  <option value=''>Select City</option>
                                  <option value='$row->city' selected>$row->city</option>";
          
          $city_query = "select name from city";
          $stmt2 = $con->prepare($city_query);
          $stmt2->execute();
          while($row1= $stmt2->fetch()){
              if($row->city == $row1->name){
                  $selected = "selected";
              }
              else{
                  $selected = "";
              }
              $output .= "<option value='$row1->name'>$row1->name</option>";
          }
            $output.=                  "</select>
                            </div>
                          </div>";

            $output .=    "                  
                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>State <strong class='text-danger'>**</strong></label>
                              <select name='state' id='state' class='form-control select2' required>
                                  <option value=''>Select State</option>
                                  <option value='$row->state' selected>$row->state</option>";
          $state_query = "select name from state";
          $stmt4 = $con->prepare($state_query);
          $stmt4->execute();
          while($row2= $stmt4->fetch()){
              if($row->city == $row2->name){
                  $selected = "selected";
              }
              else{
                  $selected = "";
              }
              $output .= "<option value='$row2->name'>$row2->name</option>";
          }
          
            $output .= "                      
                              </select>
    
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Avg. Views <strong class='text-danger'>##</strong></label>
                              <input type='number' id='avg_views' name='avg_views' class='form-control' placeholder='Enter Avg. Views' value='$row->avg_views'>
                            </div>
                          </div>

                          <div class='col-md-4'>
                            <div class='form-group'>
                              <label for='title'>Avg. Likes <strong class='text-danger'>##</strong></label>
                              <input type='number' id='avg_likes' name='avg_likes' class='form-control' placeholder='Enter Avg. Likes' value='$row->avg_likes'>
                            </div>
                          </div>

                          
                          <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Campaign Done Earlier? <strong class='text-danger'></strong></label>
                          <select name='campaign_done_earlier' id='campaign_done_earlier' class='form-control'>
                              <option value=''>Campaign Done Earlier?</option>
                              <option value='".decrypt($row->campaign_done_earlier)."' selected>".decrypt($row->campaign_done_earlier)."</option>
                              <option value='Yes'>Yes</option>
                              <option value='No'>No</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>No. of Campaign done <strong class='text-danger'>##</strong></label>
                          <input type='number' id='no_of_campaign' name='no_of_campaign' class='form-control' placeholder='Enter No. of Campaign' value='".decrypt($row->no_of_campaign)."'>
                        </div>
                      </div>
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Influencer Category <strong class='text-danger'>**</strong></label>
                          <select name='influencer_category' id='influencer_category' class='form-control' required>
                              <option value=''>Select Influencer Category</option>
                              <option value='$row->influencer_category' selected>$row->influencer_category</option>
                              <option value='CAT - A'>CAT - A</option>
                              <option value='CAT - B'>CAT - B</option>        
                              <option value='CAT - C'>CAT - C</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='title'>Name of Client Worked Before</label>
                          <input type='text' id='name_of_client_worked_before' name='name_of_client_worked_before' class='form-control' placeholder='Enter Name of Client Worked Before' value='".decrypt($row->name_of_client_worked_before)."'>
                        </div>
                      </div>
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='brands'>Brand Names Work With</label>
                          <input type='text' id='brands' name='brands' class='form-control' placeholder='Enter Influencer Name' value='$row->brands'>
                        </div>
                      </div>
                      
                      <div class='col-md-4'>
                        <div class='form-group'>
                          <label for='celebrity'>Is He/She Celebrity?</label>
                          <select name='celebrity' id='celebrity' class='form-control'>
                              <option value=''>Select Option</option>
                              <option value='$row->celebrity' selected>$row->celebrity</option>
                              <option value='Yes'>Yes</option>
                              <option value='No'>No</option>        
                              <option value='NA'>NA</option>        
                          </select>
                        </div>
                      </div>
                          
                    </div>
                    <button class='btn btn-primary update' onclick='return update()' type='submit' name='updateinstagram' id='updateinstagram'>Update</button>
                    </form>
                    <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'></script>
<script>
$(document).ready(function() {
    //$('.select2').select2({dropdownAutoWidth : true});
});
</script>
                
            
            ";
          echo $output;
      }
    }
}
?>