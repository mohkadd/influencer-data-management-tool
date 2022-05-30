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
            <span class="text-danger"><strong>Instructions for Importing Excel Data</strong></span></div>
          <div class="card-body">
            <div class="userform">
                <form name="importinventory" id="importinventory" method="post" action="addinventory.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="form-row">

                      <div class="col-md-12">
                        <ul>
                            <li>Step 1 => Download Excel Template</li>
                            <li>Step 2 => Columns marked in <span class="text-danger"><strong>Yellow are Mandatory fields</strong></span>, kindly fill those field properly for smooth importing process</li>
                            <li>Step 3 => Make sure each mandatory field entry has proper value respective to the columns whether its text or numeric value</li>
                            <li>Step 4 => Once you have entered or copied the data properly, <span class="text-danger"><strong>delete the header row which have column name</strong></span></li>
                            <li>Step 5 => Save the file and Import the excel below by selecting <span class="text-danger"><strong>.xlsx</strong></span> the file</li>
                        </ul>
<!--                        <p><span class="text-danger"><strong>Note: Make sure each profile url excel you are uploading is not present in system database, otherwise data importing will be failed due to already existing data.</strong></span></p>-->
                      </div>
                    </div>
                  </div>
                  <a href="import-youtube-data-template.xlsx" class="btn btn-success" id="download" download>Download Excel Template</a>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>
        
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Import Youtube Data via Excel</div>
          <div class="card-body">
            <div class="userform">
                <form name="importyoutube" id="importyoutube" method="post" action="addyoutube.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="form-row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="uploadfile">Upload Excel (<strong class="text-danger">**only .xlsx file to be uploaded</strong>)</label>
                          <input type="file" id="uploadfile" name="uploadfile" class="form-control" required="required" accept=".xlsx">
                          <span class="text-danger" id="exterror" style="display: none;"><strong>Please Enter Valid File</strong></span>
                          <span class="text-danger" id="msgerror" style="display: none;"><strong>Data Imported Successfully with Profile URL Validation</strong></span>
                          <span class="text-success" id="msgsuccess" style="display: none;"><strong>Data Imported Successfully</strong></span>

                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-danger" type="submit" name="submitfile" id="submitfile">Import</button>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>
      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>
 <script>
$(document).ready(function(){
    $('#uploadfile').change(function(){
        var extension1 = $(this).val().split('\\').pop();
        var validfile = ['import-youtube-data-template.xlsx'];
//        alert(extension1);
        var extension = $(this).val().split('.').pop().toLowerCase();
        var validextension = ['xlsx'];
        if(($.inArray(extension, validextension) == -1) || (!extension1.startsWith("import-youtube-data-template"))){
            $("#exterror").css({"display":"inline"});
            $("#submitfile").prop("disabled",true);
        }
        else{
            $("#exterror").css({"display":"none"});
            $("#submitfile").prop("disabled",false);
        }
    });
    
    $("#importyoutube").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "addyoutube.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(){
                $("#submitfile").prop("disabled",true);
                $("#submitfile").text("Submitting.....");
                $("#exterror").css({"display":"none"});
                $("#msgerror").css({"display":"none"});
                $("#msgsuccess").css({"display":"none"});
            },
            success: function(data){
                if(data == 'success'){
                    $("#submitfile").prop("disabled",false);
                    $("#submitfile").text("Import");
                    alert("Data Imported Successfully");
                    $("#importyoutube")[0].reset();
                    $("#msgsuccess").css({"display":"inline"});
                }
                if(data == 'duplicate'){
                    $("#submitfile").prop("disabled",false);
                    $("#submitfile").text("Import");
                    alert("Data Imported Successfully with Profile URL Validation");
                    $("#importyoutube")[0].reset();
                    $("#msgerror").css({"display":"inline"});
                }
                if(data == 'invalid'){
                    alert("Please Enter Valid File");
                    $("#submitfile").prop("disabled",false);
                    $("#submitfile").text("Import");
                    $("#exterror").css({"display":"inline"});
                }
                if(data == 'fail'){
                    alert("There was some error while submitting, Please try after some time or contact your Website Administrator");
                    $("#submitfile").prop("disabled",false);
                    $("#submitfile").text("Import");
                }
            }
        });
    });
});   
</script>     
