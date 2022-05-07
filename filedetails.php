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

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->
                <div class="mr-5 text-center">File Count<br><strong><?php echo filecount(); ?></strong></div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->
                <div class="mr-5 text-center">Disable File Count<br><strong><?php echo disablecount(); ?></strong></div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->
                <div class="mr-5 text-center">Enable File Count<br><strong><?php echo enablecount(); ?></strong></div>
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
            Website File Details</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Title / Type</th>
                    <th>File Name</th>
                    <th>Last Updated</th>
                    <th>File</th>
                    <th>Update</th>
                    <!--<th>Enable/Disable</th>-->
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
$table_data = "SELECT * FROM websitefileanciapp";
$stmt1 = $con->prepare($table_data);
$stmt1->execute();
// $result = mysqli_query($connect, $table_data);
?>
<?php  
                while($row = $stmt1->fetch())  
                {
                ?>
                  <tr>
                      <td><?php echo $row->title; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->lastupdated; ?></td>
                      <td><?php echo "<a class='btn btn-sm btn-info' href='../images/".$row->name."' target='_blank'>Open</a>"; ?></td>
                      <td><?php echo "<a class='btn btn-sm btn-primary' href='updatefile.php?id=".$row->id."'>Update</a>"; ?></td>
                      <!--<td>-->
                      <?php 
                            //   if($row['disable'] == 0){
                            //     echo "<a class='btn btn-sm btn-success' href='status.php?id=".$row['id']."&dis=1'>Enabled</a>";
                            //   }
                            //   else{
                            //   echo "<a class='btn btn-sm btn-danger' href='status.php?id=".$row['id']."&dis=0'>Disabled</a>"; 
                            //  }
                            ?>
                            <!--</td>-->
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
