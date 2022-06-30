<?php include "header.php"; ?>
<?php
if($_SESSION['admintype'] == 3){
    header("Location: dashboard.php");
}

?>
<?php //header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");?>
<?php include "functions/functions.php";?>
  <div id="wrapper">

<?php include "sidebar.php"; ?>    
<?php include "config-pdo.php"; ?>
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Insert Instagram Data</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-atom"></i>
            <span class="text-danger"><strong>Important Note for Inserting Data</strong></span></div>
          <div class="card-body">
            <div class="userform">
                <form name="importinventory" id="importinventory" method="post" action="addinventory.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="form-row">

                      <div class="col-md-12">
                        <ul>
                            <li>Fields mark with <strong><span class="text-danger">**</span></strong> are mandatory, fields mark with <strong><span class="text-danger">##</span></strong> has to be numeric</li>
                
                        </ul> 
                                              
                      </div>
                    </div>
                  </div>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>   
            
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Insert Instagram Data </div>
          <div class="card-body">
            <div class="userform">
                <form name="addinstagram" id="addinstagram" method="post" action="addinstagram.php">
                  <div class="form-group">
                    <div class="form-row">
                     
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Unique ID <strong class="text-danger">**</strong></label>
                          <input type="text" id="unique_id" name="unique_id" class="form-control" placeholder="Enter Unique ID" required>
                          <span class="iderror" style="display:none"><strong class="text-danger">Unique ID already exist, Please Enter Unique Entry</strong></span>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Influencer Name <strong class="text-danger">**</strong></label>
                          <input type="text" id="influencer_name" name="influencer_name" class="form-control" placeholder="Enter Influencer Name" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Instagram Handle <strong class="text-danger">**</strong></label>
                          <input type="text" id="handle" name="handle" class="form-control" placeholder="Enter Instagram Handle" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Profile URL <strong class="text-danger">**</strong></label>
                          <input type="url" id="profile_url" name="profile_url" class="form-control" placeholder="https://www.instagram.com/username" required>
                              
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Followers <strong class="text-danger">##</strong></label>
                          <input type="number" id="followers" name="followers" class="form-control" placeholder="Enter Followers">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Genre <strong class="text-danger">**</strong></label>
                          <input type="text" id="genre" name="genre" class="form-control" placeholder="Enter Genre">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Language </label>
                          <select name="language" id="language" class="form-control select2">
                              <option value="">Select Language</option>
                              <option value="English">English</option>
                              <option value="Hindi">Hindi</option>        
                              <option value="Marathi">Marathi</option>
                              <option value="Urdu">Urdu</option>
                              <option value="Bengali">Bengali</option>
                              <option value="Punjabi">Punjabi</option>
                              <option value="Telugu">Telugu</option>
                              <option value="Tamil">Tamil</option>
                              <option value="Gujarati">Gujarati</option>
                              <option value="Kannada">Kannada</option> 
                              <option value="Odia">Odia</option>
                              <option value="Malayalam">Malayalam</option>
                              <option value="Assamese">Assamese</option>
                              <option value="Santali">Santali</option>
                              <option value="Sanskrit">Sanskrit</option>
                              <option value="Maithili">Maithili</option> 
                              <option value="Bodo">Bodo</option>
                              <option value="Dogri">Dogri</option>
                              <option value="Kashmiri">Kashmiri</option>
                              <option value="Konkani">Konkani</option>
                              <option value="Manipuri">Manipuri</option>
                              <option value="Nepali">Nepali</option>
                              <option value="Sindhi">Sindhi</option>      
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Verified <strong class="text-danger">**</strong></label>
                          <select name="verified" id="verified" class="form-control" required>
                              <option value="">Is Account Verified?</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Gender <strong class="text-danger">**</strong></label>
                          <select name="gender" id="gender" class="form-control" required>
                              <option value="">Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>        
                              <option value="Other">Other</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">ENLYFT Exclusive <strong class="text-danger">**</strong></label>
                          <select name="enlyft_exclusive" id="enlyft_exclusive" class="form-control" required>
                              <option value="">Select ENLYFT Exclusive</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Image Cost</label>
                          <input type="text" id="image_cost"  name="image_cost" class="form-control" placeholder="Enter Image Cost">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Video Cost</label>
                          <input type="text" id="video_cost" name="video_cost" class="form-control" placeholder="Enter Video Cost">
                        </div>
                      </div>
                       
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">IGTV Cost</label>
                          <input type="text" id="igtv_cost" name="igtv_cost" class="form-control" placeholder="Enter IGTV Cost">
                        </div>
                      </div>
                       
                       
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Reels (15 second) Cost</label>
                          <input type="text" id="reels_15sec" name="reels_15sec" class="form-control" placeholder="Enter Reels (15 second) Cost">
                        </div>
                      </div>
                      
                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Reels (30 second) Cost</label>
                          <input type="text" id="reels_30sec" name="reels_30sec" class="form-control" placeholder="Enter Reels (30 second) Cost">
                        </div>
                      </div>
                       
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Image Story Cost</label>
                          <input type="text" id="image_story_cost" name="image_story_cost" class="form-control" placeholder="Enter Image Story Cost">
                        </div>
                      </div> 
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Video Story Cost</label>
                          <input type="text" id="video_story_cost" name="video_story_cost" class="form-control" placeholder="Enter Video Story Cost">
                        </div>
                      </div> 
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Image Story Swipeup Cost</label>
                          <input type="text" id="image_story_swipeup_cost" name="image_story_swipeup_cost" class="form-control" placeholder="Enter Image Story Swipeup Cost">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Video Story Swipeup Cost</label>
                          <input type="text" id="video_story_swipeup_cost" name="video_story_swipeup_cost" class="form-control" placeholder="Enter Video Story Swipeup Cost">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Carousel Cost</label>
                          <input type="text" id="carousel_cost" name="carousel_cost" class="form-control" placeholder="Enter Carousel Cost">
                        </div>
                      </div>                                    
        
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Contact Number <strong class="text-danger">** ##</strong></label>
                          <input type="text" id="contact_number" name="contact_number" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Enter Valid 10 Digit Contact Number" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Contact Person Name <strong class="text-danger">**</strong></label>
                          <input type="text" id="contact_person_name" name="contact_person_name" class="form-control" placeholder="Enter Contact Person Name" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Email ID <strong class="text-danger">**</strong></label>
                          <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email ID" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Comment</label>
                          <input type="text" id="comment" name="comment" class="form-control" placeholder="Enter Comment">
                        </div>
                      </div>
                      
                                            
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="title">Address <strong class="text-danger">**</strong></label>
                          <textarea name="address" class="form-control" id="address" placeholder="Enter Address" cols="30" rows="2"></textarea>
<!--                          <input type="text" id="address" name="address" class="form-control" placeholder="Enter Male Population (123)" required>-->
                        </div>
                      </div>
                      
                                          
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">City <strong class="text-danger">**</strong></label>
                          <select name="city" id="city" class="form-control select2">
                              <option value="">Select City</option>
                              <?php 
                              $city_query = "select name from city";
                              $stmt1 = $con->prepare($city_query);
                              $stmt1->execute();
                              while($row = $stmt1->fetch()){
                              ?>
                              <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
                              <?php
                              }
                              ?>
                              
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">State <strong class="text-danger">**</strong></label>
                          <select name="state" id="state" class="form-control select2" required>
                              <option value="">Select State</option>
                              <?php 
                              $state_query = "select name from state";
                              $stmt3 = $con->prepare($state_query);
                              $stmt3->execute();
                              while($row = $stmt3->fetch()){
                              ?>
                              <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
                              <?php
                              }
                              ?>
                          </select>
<!--                          <input type="number" id="target_audience" name="target_audience" class="form-control" placeholder="Enter Target Audience" required>-->
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Avg. Views <strong class="text-danger">##</strong></label>
                          <input type="number" id="avg_views" name="avg_views" class="form-control" placeholder="Enter Avg. Views">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Avg. Likes <strong class="text-danger">##</strong></label>
                          <input type="number" id="avg_likes" name="avg_likes" class="form-control" placeholder="Enter Avg. Likes">
                        </div>
                      </div>
                    
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Campaign Done Earlier? <strong class="text-danger"></strong></label>
                          <select name="campaign_done_earlier" id="campaign_done_earlier" class="form-control">
                              <option value="">Campaign Done Earlier?</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">No. of Campaign done <strong class="text-danger">##</strong></label>
                          <input type="number" id="no_of_campaign" name="no_of_campaign" class="form-control" placeholder="Enter No. of Campaign">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Influencer Category <strong class="text-danger">**</strong></label>
                          <select name="influencer_category" id="influencer_category" class="form-control" required>
                              <option value="">Select Influencer Category</option>
                              <option value="CAT - A">CAT - A</option>
                              <option value="CAT - B">CAT - B</option>        
                              <option value="CAT - C">CAT - C</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Name of Client Worked Before</label>
                          <input type="text" id="name_of_client_worked_before" name="name_of_client_worked_before" class="form-control" placeholder="Enter Name of Client Worked Before">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="brands">Brand Names Work With</label>
                          <input type="text" id="brands" name="brands" class="form-control" placeholder="Enter Influencer Name">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="celebrity">Is He/She Celebrity?</label>
                          <select name="celebrity" id="celebrity" class="form-control">
                              <option value="">Select Option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>        
                              <option value="NA">NA</option>        
                          </select>
                        </div>
                      </div>
                      
                      
                      
                    </div>
                  </div>
                  <button class="btn btn-success" onclick="return insert()" type="submit" name="insertinstagram" id="insertinstagram">Submit</button>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script> 
 <script>
     function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;  
        }
     
     function insert(){
        var unique_id = $('#unique_id').val().trim();
        var influencer_name = $('#influencer_name').val().trim();
        var handle = $('#handle').val().trim();
        var profile_url = $('#profile_url').val().trim();
//        alert(extension1);
        var followers = $('#followers').val().trim();
        var genre = $('#genre').val().trim();
        var language = $('#language').val().trim();
        var verified = $('#verified').val().trim();
        var gender = $('#gender').val().trim();
        var enlyft_exclusive = $('#enlyft_exclusive').val().trim();
        var image_cost = $('#image_cost').val().trim();
        var video_cost = $('#video_cost').val().trim();
        var igtv_cost = $('#igtv_cost').val().trim();
        var reels_15sec = $('#reels_15sec').val().trim();
        var reels_30sec = $('#reels_30sec').val().trim();
        var image_story_cost = $('#image_story_cost').val().trim();
        var video_story_cost = $('#video_story_cost').val().trim();
        var image_story_swipeup_cost = $('#image_story_swipeup_cost').val().trim();
        var video_story_swipeup_cost = $('#video_story_swipeup_cost').val().trim();
        var carousel_cost = $('#carousel_cost').val().trim();
        var contact_number = $('#contact_number').val().trim();
        var contact_person_name = $('#contact_person_name').val().trim();
        var email = $('#email').val().trim();
        var comment = $('#comment').val().trim();
        var address = $('#address').val().trim();
        var city = $('#city').val().trim();
        var state = $('#state').val().trim();
        var avg_views = $('#avg_views').val().trim();
        var avg_likes = $('#avg_likes').val().trim();
        var campaign_done_earlier = $("#campaign_done_earlier").val().trim();
        var no_of_campaign = $("#no_of_campaign").val().trim();
        var influencer_category = $("#influencer_category").val().trim();
        var name_of_client_worked_before = $("#name_of_client_worked_before").val().trim();
        var brands = $('#brands').val().trim();
        var celebrity = $('#celebrity').val().trim();
        
        if(unique_id !== ""){
            if(influencer_name !== ""){
                if(handle !== ""){
                    if(profile_url !== ""){
                        if(followers !== ""){
                            if(genre !== ""){
                                if(enlyft_exclusive !== ""){
                                    if(contact_number !== ""){
                                        if(contact_person_name !== ""){
                                            if(email !== ""){
                                                if(address !== ""){
                                                    if(city !== ""){
                                                        if(state !== ""){
                                                            if(avg_views !== ""){
                                                                if(avg_likes !== ""){
                                                                    if(influencer_category !== ""){
                                                                       $.ajax({
                                                                          url: 'addinstagram.php',
                                                                          type: 'POST',
                                                                          data: {unique_id:unique_id,
                                                                        influencer_name:influencer_name,handle:handle,
                                                                        profile_url:profile_url,followers:followers,
                                                                        genre:genre,language:language,verified:verified,
                                                                        gender:gender,enlyft_exclusive:enlyft_exclusive,
                                                                        image_cost:image_cost,video_cost:video_cost,igtv_cost:igtv_cost,
                                                                        reels_15sec:reels_15sec,reels_30sec:reels_30sec,
                                                                        image_story_cost:image_story_cost,video_story_cost:video_story_cost,
                                                                        image_story_swipeup_cost:image_story_swipeup_cost,
                                                                        video_story_swipeup_cost:video_story_swipeup_cost,
                                                                        carousel_cost:carousel_cost,contact_number:contact_number,
                                                                        contact_person_name:contact_person_name,email:email,comment:comment,
                                                                        address:address,city:city,state:state,avg_views:avg_views,
                                                                        avg_likes:avg_likes,campaign_done_earlier:campaign_done_earlier,
                                                                        no_of_campaign:no_of_campaign,influencer_category:influencer_category,
                                                                        name_of_client_worked_before:name_of_client_worked_before,
                                                                        brands:brands,celebrity:celebrity,insertinstagram:"insertinstagram"},
                                                                          beforeSend: function(){
                                                                                $('#insertinstagram').prop("disabled",true);
                                                                                $('#insertinstagram').text("Submitting....");
                                                                                $(".iderror").css("display","none"); 
                                                                          },
                                                                          success: function(data){
                                                                                $('#insertinstagram').prop("disabled",false);
                                                                                $('#insertinstagram').text("Submit"); 
                                                                                if(data == 'success'){
                                                                                    alert("Data Inserted Successfully");
                                                                                    $("#addinstagram")[0].reset();
                                                                                    $(".select2").val(null).trigger('change');
                        //                                                            $("#state").val("");
                        //                                                            $("#language").val("");
                                                                                 }
                                                                                if(data == 'duplicate'){
                                                                                    alert("Unique ID already exist, Please Enter Unique Entry");
                                                                                    $("#unique_id").focus();
                                                                                    $(".iderror").css("display","inline");
                                                                                }                                                                                
                                                                                if(data == 'mandatory'){
                                                                                    alert("Please Fill All Fields Properly");
                                                                                }
                                                                                if(data == 'fail'){
                                                                                    alert("There was some while submitting, please try again later or contact website administrator");
                                                                                }
                                                                          }   
                                                                       }); 
                                                                    }
                                                                    else{
                                                                        alert("Please Select Influencer Category");
                                                                        $("#influencer_category").focus();
                                                                    }
                                                                }
                                                                else{
                                                                    alert("Please Enter Avg Likes");
                                                                    $("#avg_likes").focus();
                                                                }
                                                            }
                                                            else{
                                                                alert("Please Enter Avg Views");
                                                                $("#avg_views").focus();
                                                            }
                                                        }
                                                        else{
                                                            alert("Please Select State");
                                                            $("#state").focus();
                                                        }
                                                    }
                                                    else{
                                                        alert("Please Select City");
                                                        $("#city").focus();
                                                    }
                                                }
                                                else{
                                                    alert("Please Enter Address");
                                                    $("#address").focus();
                                                }
                                            }
                                            else{
                                                alert("Please Enter Email ID");
                                                $("#email").focus();
                                            }
                                        }
                                        else{
                                            alert("Please Enter Contact Person Name");
                                            $("#contact_person_name").focus();
                                        }
                                    }
                                    else{
                                        alert("Please Enter Contact Number");
                                        $("#contact_number").focus();
                                    }
                                }
                                else{
                                    alert("Please Select Enlyft Exclusive");
                                    $("#enlyft_exclusive").focus();
                                }
                            }
                            else{
                                alert("Please Enter Genre");
                                $("#genre").focus();
                            }
                        }
                        else{
                            alert("Please Enter Followers");
                            $("#followers").focus();
                        }
                    }
                    else{
                        alert("Please Enter Profile URL");
                        $("#profile_url").focus();
                    }
                }
                else{
                    alert("Please Enter Instagram handle");
                    $("#handle").focus();
                }
            }
            else{
                alert("Please Enter Influencer Name");
                $("#influencer_name").focus();
            }
        }
        else{
           alert("Please Enter Unique ID");
           $('#unique_id').focus();   
        }
        return false;
    }
</script> 
   
