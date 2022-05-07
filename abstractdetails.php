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
          <li class="breadcrumb-item active">User Details</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->

                <div class="mr-5 text-center">User Count<br><strong><?php echo abstractcount(); ?></strong></div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          
          
          
        </div>

        <!-- Area Chart Example-->
        <!-- <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Area Chart Example</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div> -->

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            User Details </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>Email ID</th>
                    <th>Contact No.</th>
                    <th>Marketing Activity</th>
                    <th>Industry Category</th>
                    <th>Target Audience</th>
                    <th>Age Group</th>
                    <th>Budget</th>
                    <th>Complete</th>
                    <th>Submitted</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>User ID</th>  
                    <th>Email ID</th>
                    <th>Contact No.</th>
                    <th>Marketing Activity</th>
                    <th>Industry Category</th>
                    <th>Target Audience</th>
                    <th>Age Group</th>
                    <th>Budget</th>
                    <th>Complete</th>
                    <th>Submitted</th>
                  </tr>
                </tfoot>

                <!-- <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                  </tr>
                </tfoot> -->
                <tbody>
                  <?php 
$table_data = "SELECT * FROM userdata";
$stmt1 = $con->prepare($table_data);
$stmt1->execute();
// $result = mysqli_query($connect, $table_data);
?>
<?php  
                while($row = $stmt1->fetch())  
                {
                ?>
                  <tr>
                      <td><?php echo $row->userid; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->contact; ?></td>
                      <td><?php echo $row->activity; ?></td>
                      <td><?php echo $row->industry; ?></td>
                      <td><?php echo $row->audience; ?></td>
                      <td><?php echo $row->agegroup; ?></td>
                      <td><?php echo $row->budget; ?></td>
                      <td><?php echo $row->complete; ?></td>
                      <td><?php echo $row->submitted; ?></td>
                  </tr>

                <?php  
                }  
                ?>
                  
                </tbody>
              </table>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>     
