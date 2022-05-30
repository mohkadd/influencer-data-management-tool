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
          <li class="breadcrumb-item active">Insert Youtube Data</li>
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
                            <li><strong class="text-danger">Profile URL has to be UNIQUE</strong></li>
                            <li><strong class="text-danger">Profile URL has to be in below FORMAT: https://www.youtube.com/channel/UCRGl2gA9X6BXqOvNL2jePtw</strong></li>
                            <li><strong class="text-danger">Profile URL ID has to be 24 character i.e UCRGl2gA9X6BXqOvNL2jePtw</strong></li>
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
            Insert Youtube Data </div>
          <div class="card-body">
            <div class="userform">
                <form name="addyoutube" id="addyoutube" method="post" action="addyoutube.php">
                  <div class="form-group">
                    <div class="form-row">
                     
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Channel Name <strong class="text-danger">**</strong></label>
                          <input type="text" id="channel_name" name="channel_name" class="form-control" placeholder="Enter Channel Name" required>
                          
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Profile URL <strong class="text-danger">**</strong></label>
                          <input type="url" id="profile_url" name="profile_url" class="form-control" placeholder="https://www.youtube.com/channel/UCRGl2gA9X6BXqOvNL2jePtw" required>
                          <span class="urlerror" style="display:none"><strong class="text-danger">Please Enter Unique Profile URL with proper format</strong></span>    
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Subscribers <strong class="text-danger">##</strong></label>
                          <input type="number" id="subscribers" name="subscribers" class="form-control" placeholder="Enter Subscribers">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Genre</label>
                          <input type="text" id="genre" name="genre" class="form-control" placeholder="Enter Genre">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Language <strong class="text-danger">**</strong></label>
                          <select name="language" id="language" class="form-control select2" required>
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
                          <label for="title">Gender <strong class="text-danger">**</strong></label>
                          <select name="gender" id="gender" class="form-control" required>
                              <option value="">Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>        
                              <option value="Both">Both</option>        
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
                          <label for="title">Integrated Video Cost</label>
                          <input type="text" id="integrated_video_cost"  name="integrated_video_cost" class="form-control" placeholder="Enter Integrated Video Cost">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Dedicated Video Cost</label>
                          <input type="text" id="dedicated_video_cost" name="dedicated_video_cost" class="form-control" placeholder="Enter Dedicated Video Cost">
                        </div>
                      </div>
                       
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Youtube Story Cost</label>
                          <input type="text" id="youtube_story_cost" name="youtube_story_cost" class="form-control" placeholder="Enter Youtube Story Cost">
                        </div>
                      </div>
                       
                       
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Youtube Shorts Cost</label>
                          <input type="text" id="youtube_shorts_cost" name="youtube_shorts_cost" class="form-control" placeholder="Enter Youtube Shorts Cost">
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
                          <input type="text" id="email_id" name="email_id" class="form-control" placeholder="Enter Email ID" required>
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
                          <label for="title">Address</label>
                          <textarea name="address" class="form-control" id="address" placeholder="Enter Address" cols="30" rows="2"></textarea>
<!--                          <input type="text" id="address" name="address" class="form-control" placeholder="Enter Male Population (123)" required>-->
                        </div>
                      </div>
                      
                                          
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">City</label>
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
                          <label for="title">Influencer Name <strong class="text-danger">**</strong></label>
                          <input type="text" id="influencer_name" name="influencer_name" class="form-control" placeholder="Enter Influencer Name" required>
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
                      
                    </div>
                  </div>
                  <button class="btn btn-success" onclick="return insert()" type="submit" name="insertyoutube" id="insertyoutube">Submit</button>
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
        var channel_name = $('#channel_name').val().trim();
        var profile_url = $('#profile_url').val().trim();
        var extension1 = profile_url.split('/').pop();
//        alert(extension1);
        var subscribers = $('#subscribers').val().trim();
        var genre = $('#genre').val().trim();
        var language = $('#language').val().trim();
        var gender = $('#gender').val().trim();
        var enlyft_exclusive = $('#enlyft_exclusive').val().trim();
        var integrated_video_cost = $('#integrated_video_cost').val().trim();
        var dedicated_video_cost = $('#dedicated_video_cost').val().trim();
        var youtube_story_cost = $('#youtube_story_cost').val().trim();
        var youtube_shorts_cost = $('#youtube_shorts_cost').val().trim();
        var contact_number = $('#contact_number').val().trim();
        var contact_person_name = $('#contact_person_name').val().trim();
        var email_id = $('#email_id').val().trim();
        var comment = $('#comment').val().trim();
        var address = $('#address').val().trim();
        var city = $('#city').val().trim();
        var state = $('#state').val().trim();
        var avg_views = $('#avg_views').val().trim();
        var avg_likes = $('#avg_likes').val().trim();
        var influencer_name = $('#influencer_name').val().trim();
        var campaign_done_earlier = $("#campaign_done_earlier").val().trim();
        var no_of_campaign = $("#no_of_campaign").val().trim();
        var influencer_category = $("#influencer_category").val().trim();
        var name_of_client_worked_before = $("#name_of_client_worked_before").val().trim();
        
        if(channel_name !== ""){
//            alert("hello");
            if(profile_url !== ""){
                if(subscribers !== ""){
                   subscribers = parseInt(subscribers);
                   if(isNaN(subscribers) && typeof subscribers !== 'number'){
                        alert("Please Enter Valid Numeric Data");
                        $("#subscribers").focus();
                    }
                }
                if(language !== ""){
                    if(gender !== ""){
                        if(enlyft_exclusive !== ""){
                            if(integrated_video_cost !== ""){
                               integrated_video_cost = parseFloat(integrated_video_cost);
                               if(isNaN(integrated_video_cost) && typeof integrated_video_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#integrated_video_cost").focus();
                               }
                            }
                            if(dedicated_video_cost !== ""){
                                dedicated_video_cost = parseFloat(dedicated_video_cost);
                                if(isNaN(dedicated_video_cost) && typeof dedicated_video_cost !== 'number'){
                                      alert("Please Enter Valid Numeric Data");
                                      $("#dedicated_video_cost").focus();
                               }
                            }
                            if(youtube_story_cost !== ""){
                                youtube_story_cost = parseFloat(youtube_story_cost);
                                if(isNaN(youtube_story_cost) && typeof youtube_story_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#youtube_story_cost").focus();
                                }
                            }
                            if(youtube_shorts_cost !== ""){
                                youtube_shorts_cost = parseFloat(youtube_shorts_cost);
                                if(isNaN(youtube_shorts_cost) && typeof youtube_shorts_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#youtube_shorts_cost").focus();
                                }
                            }
                            if(contact_number !== "" && contact_number.length == 10){
                                if(contact_person_name !== ""){
                                    if(email_id !== ""){
                                        if(state !== ""){
                                            if(avg_views !== ""){
                                                 avg_views = parseInt(avg_views);
                                                 if(isNaN(avg_views) && typeof avg_views !== 'number'){
                                                     alert("Please Enter Valid Numeric Data");
                                                     $("#avg_views").focus();
                                                 }
                                            }
                                            if(avg_likes !== ""){
                                                avg_likes = parseInt(avg_likes);
                                                if(isNaN(avg_likes) && typeof avg_likes !== 'number'){
                                                    alert("Please Enter Valid Numeric Data");
                                                    $("#avg_likes").focus();
                                                }
                                            }
                                            if(influencer_name !== ""){
                                                        if(influencer_category !== ""){
                                                            $.ajax({

                                                                url: 'addyoutube.php',
                                                                type: 'POST',
                                                                data:{channel_name:channel_name,
                                                                profile_url:profile_url,extension1:extension1,subscribers:subscribers,
                                                                genre:genre,language:language,gender:gender,
                                                                enlyft_exclusive:enlyft_exclusive,
                                                                integrated_video_cost:integrated_video_cost,
                                                                dedicated_video_cost:dedicated_video_cost,
                                                                youtube_story_cost:youtube_story_cost,
                                                                youtube_shorts_cost:youtube_shorts_cost,
                                                                contact_number:contact_number,contact_person_name:contact_person_name,
                                                                email_id:email_id,comment:comment,address:address,city:city,state:state,
                                                                avg_views:avg_views,avg_likes:avg_likes,influencer_name:influencer_name,
                                                                campaign_done_earlier:campaign_done_earlier,no_of_campaign:no_of_campaign,
                                                                influencer_category:influencer_category,name_of_client_worked_before:name_of_client_worked_before,
                                                                insertyoutube:"insertyoutube"},
                                                                beforeSend: function(){
                                                                    $('#insertyoutube').prop("disabled",true);
                                                                    $('#insertyoutube').text("Submitting....");
                                                                    $(".urlerror").css("display","none");
                                                                },
                                                                success: function(data){
                                                                    $('#insertyoutube').prop("disabled",false);
                                                                    $('#insertyoutube').text("Submit"); 
                                                                    if(data == 'success'){
                                                                        alert("Data Inserted Successfully");
                                                                        $("#addyoutube")[0].reset();
                                                                        $(".select2").val(null).trigger('change');
            //                                                            $("#state").val("");
            //                                                            $("#language").val("");
                                                                     }
                                                                    if(data == 'duplicate'){
                                                                        alert("Profile URL Already Exist, Please Enter Unique URL");
                                                                        $("#profile_url").focus();
                                                                        $(".urlerror").css("display","inline");
                                                                    }
                                                                    if(data == 'format'){
                                                                        alert("Please Enter Valid Profile URL Format");
                                                                        $("#profile_url").focus();
                                                                        $(".urlerror").css("display","inline");
                                                                        $(".urlerror").html("<strong class='text-danger'>Please Enter Valid Profile URL Format</strong>");
                                                                    }
                                                                    if(data == 'validurl'){
                                                                        alert("Profile URL Should Not End with /");
                                                                        $("#profile_url").focus();
                                                                        $(".urlerror").css("display","inline");
                                                                        $(".urlerror").html("<strong class='text-danger'>Profile URL Should Not End with /</strong>");
                                                                    }
                                                                    if(data == 'length'){
                                                                        alert("Profile URL ID Character Length Cannot Be Greater Than 24");
                                                                        $("#profile_url").focus();
                                                                        $(".urlerror").css("display","inline");
                                                                        $(".urlerror").html("<strong class='text-danger'>Profile URL ID Character Length Cannot Be Greater Than 24</strong>");
                                                                    }
                                                                    if(data == 'invalid'){
                                                                        alert("Please Fill All Numeric Fields Properly");
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
                                                alert("Please Enter Influencer Name");
                                                $("#influencer_name").focus();
                                            }
                                        }
                                        else{
                                            alert("Please Select State");
                                            $("#state").focus();
                                        }
                                    }
                                    else{
                                        alert("Please Enter Email ID");
                                        $("#email_id").focus();
                                    }
                                }
                                else{
                                    alert("Please Enter Contact Person Name");
                                    $("#contact_person_name").focus();
                                }
                            }
                            else{
                                alert("Please Enter Valid 10 Digit Contact Number");
                                $("#contact_number").focus();
                            }
                        }
                        else{
                            alert("Please Select Enlyft Exclusive");
                            $("#enlyft_exclusive").focus();
                        }
                    }
                    else{
                        alert("Please Select Gender");
                        $("#gender").focus();
                    }
                }
                else{
                    alert("Please Select Language");
                    $("#language").focus();
                }
            }
            else{
                alert("Please Enter Profile URL");
                $("#profile_url").focus();
            }
        }
        else{
            alert("Please Enter Channel Name");
            $("#channel_name").focus();
        }
        return false;
    }
</script> 
   
