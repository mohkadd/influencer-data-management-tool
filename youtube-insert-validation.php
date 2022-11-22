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
          <li class="breadcrumb-item active">Youtube Data Validation</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-atom"></i>
            <span class="text-danger"><strong>Important Note for Youtube Data Validation</strong></span></div>
          <div class="card-body">
            <div class="userform">
                  <div class="form-group">
                    <div class="form-row">

                      <div class="col-md-12">
                        <ul>
                            <li><strong class="text-danger">Profile URL has to be in below FORMAT:<br> https://www.youtube.com/channel/UCRGl2gA9X6BXqOvNL2jePtw</strong></li>
                            <br><li><strong class="text-danger">Profile URL ID has to be 24 character i.e UCRGl2gA9X6BXqOvNL2jePtw</strong></li>
                        </ul> 
                                              
                      </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>   
            
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Validate Youtube Data </div>
          <div class="card-body">
            <div class="userform">
                <form name="addyoutube" id="addyoutube" method="post" action="validate-youtube.php">
                  <div class="form-group">
                    <div class="form-row">
                     
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Profile URL <strong class="text-danger">**</strong></label>
                          <input type="url" id="profile_url" name="profile_url" class="form-control" placeholder="https://www.youtube.com/channel/UCRGl2gA9X6BXqOvNL2jePtw" required>
                          <span class="urlerror" style="display:none"><strong class="text-danger">Profile URL already exist in our system</strong></span>
                          <span class="urlsuccess" style="display:none"><strong class="text-success">Profile URL is Unique</strong></span>    
                        </div>
                      </div>
                     
                      
                    </div>
                  </div>
                  <button class="btn btn-success" onclick="return validate()" type="submit" name="insertyoutube" id="insertyoutube">Submit</button>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?> 
 <script>
     
     
     function validate(){         
        var profile_url = $('#profile_url').val().trim();
        var extension1 = profile_url.split('/').pop();
//        alert(extension1);
        
        if(profile_url !== ""){
            // alert(extension1);
            $.ajax({

                url: 'validate-youtube.php',
                type: 'POST',
                data:{profile_url:profile_url,extension1:extension1,insertyoutube:"insertyoutube"},
                beforeSend: function(){
                    $('#insertyoutube').prop("disabled",true);
                    $('#insertyoutube').text("Submitting....");
                    $(".urlerror").css("display","none");
                    $(".urlsuccess").css("display","none");
                },
                success: function(data){
                    $('#insertyoutube').prop("disabled",false);
                    $('#insertyoutube').text("Submit"); 
                    if(data == 'success'){
                        alert("Profile URL is Unique");
                        $("#addyoutube")[0].reset();
                        $(".urlsuccess").css("display","inline");
                    }
                    if(data == 'duplicate'){
                        alert("Profile URL Already Exist in our system");
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
                }
                });
        }
        else{
            alert("Please Enter Profile URL");
            $("#profile_url").focus();
        }
        return false;
    }
</script> 
   
