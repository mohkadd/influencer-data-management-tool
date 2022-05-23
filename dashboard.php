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
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
<!--
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden bg-dark h-100">
              <div class="card-body">
                
                <div class="text-center">User Count<br><strong style="color:#ef1932;"><?php //echo abstractcount(); ?></strong></div>
              </div>
              
            </div>
          </div>
          
          
        </div>
-->

        <!-- DataTables Example -->
        <div class="row">
            <div class="col-xl-4 col-md-4">
              <?php 
//                $localIP = getHostByName(getHostName());
  
// Displaying the address 
//echo $localIP;
                ?>
               <div class="card mb-3" style="border:1px solid black;">
                  <div class="card-header bg-dark text-white">
                    <i class="fas fa-table"></i>
                   YouTube
                    </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead class="bg-dark text-white">
                          <tr>
                            <th>Properties</th>
                            <th>Count</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>Total Influencers</td>
                              <td><?php echo youinfluencercount(); ?></td>
                          </tr>
                          <tr>
                              <td>Exclusive Influencers</td>
                              <td><?php echo youexclusivecount(); ?></td>
                          </tr>
                          <tr>
                              <td>Male</td>
                              <td><?php echo youmalecount(); ?></td>
                          </tr>
                          <tr>
                              <td>Female</td>
                              <td><?php echo youfemalecount(); ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
            </div>
            
<!--
            <div class="col-xl-4 col-md-4">
               <div class="card mb-3" style="border:1px solid black;">
                  <div class="card-header bg-dark text-white">
                    <i class="fas fa-table"></i>
                   Instagram
                    </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead class="bg-dark text-white">
                          <tr>
                            <th>Properties</th>
                            <th>Count</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>Total Influencers</td>
                              <td>12345</td>
                          </tr>
                          <tr>
                              <td>Exclusive Influencers</td>
                              <td>12345</td>
                          </tr>
                          <tr>
                              <td>Male</td>
                              <td>12345</td>
                          </tr>
                          <tr>
                              <td>Female</td>
                              <td>12345</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
            </div>
-->
            
<!--
            <div class="col-xl-4 col-md-4">
               <div class="card mb-3" style="border:1px solid black;">
                  <div class="card-header bg-dark text-white">
                    <i class="fas fa-table"></i>
                   Facebook
                    </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead class="bg-dark text-white">
                          <tr>
                            <th>Properties</th>
                            <th>Count</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>Total Influencers</td>
                              <td>12345</td>
                          </tr>
                          <tr>
                              <td>Exclusive Influencers</td>
                              <td>12345</td>
                          </tr>
                          <tr>
                              <td>Male</td>
                              <td>12345</td>
                          </tr>
                          <tr>
                              <td>Female</td>
                              <td>12345</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
            </div>
-->
        </div>
        

      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>     
