<?php include "header.php"; ?>
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
          <li class="breadcrumb-item active">Website Files</li>
        </ol>
<?php 
if (isset($_REQUEST['id'])) {
	$fileid = htmlspecialchars(trim($_REQUEST['id']));
	$filedetail = "SELECT * FROM websitefileanciapp WHERE id = :id";
	$stmt1 = $con->prepare($filedetail);
	$stmt1->execute(['id' => $fileid]);
// 	$run_query = mysqli_query($connect, $filedetail);
	$row = $stmt1->fetch();
	$title = $row->title;
	$filename = $row->name;
}
?>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Update Website File</div>
          <div class="card-body">
            <div class="userform">
                <form name="fileupdate" method="post" action="fileupdate.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Title / Type</label>
                          <input type="text" id="title" name="title" class="form-control" value="<?php echo $title; ?>" readonly>
                          <input type="hidden" id="fileid" name="fileid" value="<?php echo $fileid; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="filename">Filename</label>
                          <input type="text" id="filename" name="filename" class="form-control" value="<?php echo $filename; ?>" readonly>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-group">
                      <label for="uploadfile">Upload File (<strong class="text-danger">**Only PDF file / Image file to be uploaded</strong>)</label>
                      <input type="file" id="uploadfile" name="uploadfile" class="form-control" required="required" accept="image/*,application/pdf">
                      
                    </div>
                  </div>
                  <center><button class="btn btn-success" type="submit" name="submitfile">Submit</button></center>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>     
