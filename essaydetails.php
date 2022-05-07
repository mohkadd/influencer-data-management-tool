<?php include "header.php"; ?>
<?php include "functions/functions.php";?>
  <div id="wrapper">

<?php include "sidebar.php"; ?>    
<?php include "config.php"; ?>
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Essays</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->

                <div class="mr-5 text-center">Essay Count<br><strong><?php echo essaycount(); ?></strong></div>
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
          <div class="card-header">
            <i class="fas fa-table"></i>
            Essay Details <span style="float: right;"><a class="btn btn-danger" href="exportessay.php"><i class="fas fa-file-export"></i> Export</a> <!-- <a class="btn btn-danger" href="addabstract.php"><i class="fas fa-plus"></i> Add Abstract</a> --></span></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Ticket No.</th>
                    <th>Message</th>
                    <th>File</th>
                    <th>Submission Time</th>
                  </tr>
                </thead>

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
$table_data = "SELECT * FROM essay";
$result = mysqli_query($connect, $table_data);
?>
<?php  
                while($row = mysqli_fetch_array($result))  
                {
                ?>
                  <tr>
                      <td><?php echo $row['ess_name']; ?></td>
                      <td><?php echo $row['ess_phone']; ?></td>
                      <td><?php echo $row['ess_email']; ?></td>
                      <td><?php echo $row['ess_city']; ?></td>
                      <td><?php echo $row['ess_ticketNo']; ?></td>
                      <td><?php echo $row['ess_message']; ?></td>
                      <td><?php echo "<a class='btn btn-sm btn-info' href='../uploadeddata/essay/".$row['ess_uploadfile']."' target='_blank' title='".$row['ess_uploadfile']."'>Open</a>"; ?></td>
                      <td><?php echo $row['ess_submissiondate']; ?></td>
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
