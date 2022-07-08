<?php include "header.php"; ?>
<?php
if($_SESSION['admintype'] != 3){
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
          <li class="breadcrumb-item active">YouTube Data Requirement</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-atom"></i>
            <span class="text-danger"><strong>Important Note for Filter Instagram Data Requirement</strong></span></div>
          <div class="card-body">
            <div class="userform">
                <form name="importinventory" id="importinventory" method="post" action="addinventory.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="form-row">

                      <div class="col-md-12">
                        <ul>
                            <li><strong class="text-danger">All Fields are mandatory to be filled or selected</strong></li>
                            <li><strong>Below are the category range definition
                                <ul>
                                    <li>CAT - A : Celebrity OR Above 500k Followers</li>
                                    <li>CAT - B : Between 100k to 500k Followers</li>
                                    <li>CAT - C : Below 100k Followers</li>
                                </ul></strong>
                            </li>
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
            Filter Instagram Data </div>
          <div class="card-body">
            <div class="userform">
                <form name="addinstagram" id="addinstagram" method="post" action="bd-instagram-data.php">
                  <div class="form-group">
                    <div class="form-row">
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="genre">Genre <strong class="text-danger">**</strong></label>
                          <select name="genre" id="genre" class="form-control select2" required>
                              <option value="">Select Genre</option>
                              <?php 
                              $state_query = "select distinct genre from instagram";
                              $stmt3 = $con->prepare($state_query);
                              $stmt3->execute();
                              while($row = $stmt3->fetch()){
                              ?>
                              <option value="<?php echo $row->genre; ?>"><?php echo $row->genre; ?></option>
                              <?php
                              }
                              ?>
                          </select>
                        </div>
                      </div>
                      
                      
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="gender">Gender <strong class="text-danger">**</strong></label>
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
                          <label for="influencer_category">Influencer Category <strong class="text-danger">**</strong></label>
                          <select name="influencer_category" id="influencer_category" class="form-control" required>
                              <option value="">Select Influencer Category</option>
                              <option value="CAT - A">CAT - A</option>
                              <option value="CAT - B">CAT - B</option>        
                              <option value="CAT - C">CAT - C</option>        
                          </select>
                        </div>
                      </div>
                      
                     
                      
                    </div>
                  </div>
                  <button class="btn btn-success" type="submit" name="filterinstagram" id="filterinstagram">Filter</button>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>

