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
            <div class="card text-white o-hidden h-100" style="background-color:black;">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->

                <div class="text-center">User Count<br><strong style="color:#ef1932;"><?php echo abstractcount(); ?></strong></div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color:black;">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->

                <div class="text-center">Complete<br><strong style="color:#ef1932;"><?php echo completecount(); ?></strong></div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color:black;">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->

                <div class="text-center">Incomplete<br><strong style="color:#ef1932;"><?php echo incompletecount(); ?></strong></div>
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color:black;">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->

                <div class="text-center">Today<br><strong style="color:#ef1932;"><?php echo todaycount(); ?></strong></div>
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
                <thead class="bg-dark text-white">
                  <tr>
                    <th>Sr. No.</th>
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
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Sr. No.</th>
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
                    <th>Status</th>
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
$i = 1;
// $result = mysqli_query($connect, $table_data);
?>
<?php  
                while($row = $stmt1->fetch())  
                {
                    if($row->complete == "1"){
                        $row->complete = "Complete";
                    }
                    else{
                        $row->complete = "Incomplete";
                    }
                    if($row->status == "1"){
                        $color = "bg-info text-white";
                    }
                    else if($row->status == "2"){
                        $color = "bg-danger text-white";
                    }
//                    else if($row->status == "3"){
//                        $color = "text-white";
//                    }
                    else if($row->status == "3"){
                        $color = "bg-success text-white";
                    }
                    else{
                        $color = "bg-light";
                    }
                ?>
                  <tr class="<?php echo $color; ?>">
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row->userid; ?></td>
                      <td><?php echo decrypt($row->email); ?></td>
                      <td><?php echo decrypt($row->contact); ?></td>
                      <td><?php echo $row->activity; ?></td>
                      <td><?php echo $row->industry; ?></td>
                      <td><?php echo $row->audience; ?></td>
                      <td><?php echo $row->agegroup; ?></td>
                      <td><?php echo $row->budget; ?></td>
                      <td><?php echo $row->complete; ?></td>
                      <td><?php echo $row->date; ?></td>
                      <td>
                          <?php 
                        if($row->status == "0"){
                            ?>
                            <a href="status.php?id=<?php echo $row->id ?>&status=1" class="btn btn-sm btn-primary">Contact</a>
                            <?php
                        }
                        if($row->status == "1"){
                            ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                In Progress
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="status.php?id=<?php echo $row->id ?>&status=2">Callback Later</a>
                                <a class="dropdown-item" href="status.php?id=<?php echo $row->id ?>&status=3">Lead Contacted</a>
<!--                                <a class="dropdown-item" href="#">Something else here</a>-->
                              </div>
                            </div>
<!--                            <a href="status.php?id=<?php //echo $row->id ?>&status=3" class="btn btn-sm btn-warning">In Progress</a>-->
                            <?php
                        }
                        if($row->status == "2"){
                            ?>
                            <a href="status.php?id=<?php echo $row->id ?>&status=3" class="btn btn-sm btn-success">Lead Contacted</a>
                        <?php
                        }
                        if($row->status == "3"){
                                ?>
                                <span class="badge badge-danger">Closed</span>
                                <?php
                            }
                          ?>
                      </td>
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
      
