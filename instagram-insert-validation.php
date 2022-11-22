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
          <li class="breadcrumb-item active">Validate Instagram Data</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-atom"></i>
            <span class="text-danger"><strong>Important Note for Validating Instagram Data</strong></span></div>
          <div class="card-body">
            <div class="userform">
                  <div class="form-group">
                    <div class="form-row">

                      <div class="col-md-12">
                        <ul>
                            <li>Unique ID has to be numeric</li>
                
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
            Validate Instagram Data </div>
          <div class="card-body">
            <div class="userform">
                <form name="addinstagram" id="addinstagram" method="post" action="validate-instagram.php">
                  <div class="form-group">
                    <div class="form-row">
                     
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Unique ID <strong class="text-danger">**</strong></label>
                          <input type="text" id="unique_id" name="unique_id" class="form-control" placeholder="Enter Unique ID" required>
                          <span class="iderror" style="display:none"><strong class="text-danger">Unique ID already exist in our system</strong></span>
                          <span class="idsuccess" style="display:none"><strong class="text-success">Inserted ID is Unique</strong></span>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  <button class="btn btn-success" onclick="return validate()" type="submit" name="insertinstagram" id="insertinstagram">Submit</button>
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
        var unique_id = $('#unique_id').val().trim();
        if(unique_id !== ""){
            $.ajax({
                url: 'validate-instagram.php',
                type: 'POST',
                data: {unique_id:unique_id,insertinstagram:"insertinstagram"},
                beforeSend: function(){
                    $('#insertinstagram').prop("disabled",true);
                    $('#insertinstagram').text("Submitting....");
                    $(".iderror").css("display","none");
                    $(".idsuccess").css("display","none"); 
                },
                success: function(data){
                    $('#insertinstagram').prop("disabled",false);
                    $('#insertinstagram').text("Submit"); 
                    if(data == 'success'){
                        alert("Entered ID is Unique");
                        $(".idsuccess").css("display","inline");
                        $("#addinstagram")[0].reset();
                    }
                    if(data == 'duplicate'){
                        alert("Unique ID already exist in our system");
                        $("#unique_id").focus();
                        $(".iderror").css("display","inline");
                    }
                }   
            });
        }
        else{
           alert("Please Enter Unique ID");
           $('#unique_id').focus();   
        }
        return false;
    }
</script> 
   
