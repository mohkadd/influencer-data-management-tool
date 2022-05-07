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
          <li class="breadcrumb-item active">Contact Form</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->
                <div class="mr-5 text-center">Contact-form Count<br><strong style="color:#ef1932;"><?php echo contactcount(); ?></strong></div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          
          <!-- <div class="col-xl-3 col-sm-6 mb-3"> -->
            <!-- <div class="card text-white bg-danger o-hidden h-100"> -->
              <!-- <div class="card-body"> -->
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div> -->
                <!-- <div class="mr-5">13 New Tickets</div> -->
              <!-- </div> -->
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            <!-- </div> -->
          <!-- </div> -->
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
<!--
          <div class="card-header">
            <i class="fas fa-table"></i>
            Contact Form Details <span style="float: right;"><a class="btn btn-danger" href="exportcontact.php"><i class="fas fa-file-export"></i> Export</a>  <a class="btn btn-danger" href="addabstract.php"><i class="fas fa-plus"></i> Add Abstract</a> </span></div>
-->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                  <tr>
                    <th>ID</th>  
                    <th>Name</th>
<!--                    <th>Contact No.</th>-->
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Datetime</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>  
                    <th>Name</th>
<!--                    <th>Contact No.</th>-->
                    <th>Email</th>
                    <th>City</th>
                    <th>Message</th>
                    <th>Datetime</th>
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
$table_data = "SELECT * FROM contactform";
$stmt1 = $con->prepare($table_data);
$stmt1->execute();
$i = 1;
// $result = mysqli_query($connect, $table_data);
?>
<?php  
                while($row = $stmt1->fetch())  
                {
                ?>
                  <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row->name; ?></td>
<!--                      <td><?php //echo $row->contactno; ?></td>-->
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->subject; ?></td>
                      <td><?php echo $row->message; ?></td>
                      <td><?php echo $row->submitted; ?></td>
                  </tr>

                <?php
                    $i++;
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
