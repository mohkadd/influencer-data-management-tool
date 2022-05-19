<?php include "header.php"; ?>
<?php
if($_SESSION['admintype'] == '3'){
    header("Location: dashboard.php");
}
?>
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
          <li class="breadcrumb-item active">Log History</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
        
<!--
          <div class="card-header">
            <i class="fas fa-table"></i>
            Contact Form Details <span style="float: right;"><a class="btn btn-danger" href="exportcontact.php"><i class="fas fa-file-export"></i> Export</a>  <a class="btn btn-danger" href="addabstract.php"><i class="fas fa-plus"></i> Add Abstract</a> </span></div>
-->
          <div class="card-body">
            <div class="table-responsive">
             <?php
             if($_SESSION['admintype'] == '1' || $_SESSION['admintype'] == '2'){
             ?>
             <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                  <tr>
                    <th>Sr. No.</th>
                    <th>Username</th>
                    <th>Activity</th>
                    <th>Message</th>
                    <th>IP Address</th>
<!--                    <th>Browser</th>-->
                    <th>Datetime</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Username</th>
                    <th>Activity</th>
                    <th>Message</th>
                    <th>IP Address</th>
<!--                    <th>Browser</th>-->
                    <th>Datetime</th>
                                        
                  </tr>
                </tfoot>

                <tbody>
                  <?php 
$table_data = "SELECT * FROM loghistory";
$stmt1 = $con->prepare($table_data);
$stmt1->execute();
$i = 1;
// $result = mysqli_query($connect, $table_data);
?>
<?php  
                while($row = $stmt1->fetch())  
                {
                ?>
                  <tr onmousedown = 'return false' onselectstart = 'return false'>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row->username; ?></td>
                      <td><?php echo $row->operation; ?></td>
                      <td><?php echo $row->comment; ?></td>
                      <td><?php echo $row->ipaddress; ?></td>
<!--                      <td><?php //echo $row->browser; ?></td>-->
                      <td><?php echo $row->actiontime; ?></td>
                      
                  </tr>

                <?php 
                    $i++;
                }  
                ?>
                  
                </tbody>
              </table>
             <?php     
             } 
             ?>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>

      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>