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
                              <td>Non-Exclusive Influencers</td>
                              <td><?php echo younonexclusivecount(); ?></td>
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
            <div class="col-xl-8">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                  <script type="text/javascript">
                    google.charts.load("current", {packages:['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ["Element", "Count", { role: "style" } ],
                        ["Total Influencers", <?php echo youinfluencercount(); ?>, "black"],
                        ["Exclusive Influencers", <?php echo youexclusivecount(); ?>, "red"],
                        ["Non-Exclusive Influencers", <?php echo younonexclusivecount(); ?>, "yellow"],
                        ["Male Influencers", <?php echo youmalecount(); ?>, "blue"],
                        ["Female Influencers", <?php echo youfemalecount(); ?>, "pink"]
                      ]);

                      var view = new google.visualization.DataView(data);
                      view.setColumns([0, 1,
                                       { calc: "stringify",
                                         sourceColumn: 1,
                                         type: "string",
                                         role: "annotation" },
                                       2]);

                      var options = {
                        title: "Overall Count of Youtube Influencers",
//                        width: 800,
//                        height: 400,
                        bar: {groupWidth: "75%"},
                        legend: { position: "none" },
                      };
                      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                      chart.draw(view, options);
                  }
                  </script>
                <div id="columnchart_values" style="width: auto; height: 400px;"></div>
            </div>
            
            <div class="col-xl-4 col-md-4">
              <?php 
//                $localIP = getHostByName(getHostName());
  
// Displaying the address 
//echo $localIP;
                ?>
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
                              <td><?php echo instainfluencercount(); ?></td>
                          </tr>
                          <tr>
                              <td>Exclusive Influencers</td>
                              <td><?php echo instaexclusivecount(); ?></td>
                          </tr>
                          <tr>
                              <td>Non-Exclusive Influencers</td>
                              <td><?php echo instanonexclusivecount(); ?></td>
                          </tr>
                          <tr>
                              <td>Male</td>
                              <td><?php echo instamalecount(); ?></td>
                          </tr>
                          <tr>
                              <td>Female</td>
                              <td><?php echo instafemalecount(); ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
            </div>
            <div class="col-xl-8">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                  <script type="text/javascript">
                    google.charts.load("current", {packages:['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ["Element", "Count", { role: "style" } ],
                        ["Total Influencers", <?php echo instainfluencercount(); ?>, "black"],
                        ["Exclusive Influencers", <?php echo instaexclusivecount(); ?>, "red"],
                        ["Non-Exclusive Influencers", <?php echo instanonexclusivecount(); ?>, "yellow"],
                        ["Male Influencers", <?php echo instamalecount(); ?>, "blue"],
                        ["Female Influencers", <?php echo instafemalecount(); ?>, "pink"]
                      ]);

                      var view = new google.visualization.DataView(data);
                      view.setColumns([0, 1,
                                       { calc: "stringify",
                                         sourceColumn: 1,
                                         type: "string",
                                         role: "annotation" },
                                       2]);

                      var options = {
                        title: "Overall Count of Instagram Influencers",
//                        width: 800,
//                        height: 400,
                        bar: {groupWidth: "75%"},
                        legend: { position: "none" },
                      };
                      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values1"));
                      chart.draw(view, options);
                  }
                  </script>
                <div id="columnchart_values1" style="width: auto; height: 400px;"></div>
            </div>
<!--
            <div class="col-xl-8">
                <div class="card mb-3">
                  <div class="card-header">
                    <i class="fas fa-chart-bar"></i>
                    Bar Chart Example</div>
                  <div class="card-body">
                    <canvas id="myBarChart" width="100%" height="50"></canvas>
                  </div>
                </div>
            </div>
-->
            
            
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
<!--
<script src="vendor/chart.js/Chart.min.js"></script>
<script>
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Total Influencers", "Exclusive Influencers", "Male Influencers", "Female Influencers"],
    datasets: [{
      label: "Count",
      backgroundColor: ['black','red','blue','pink'],
      borderColor: "rgba(2,117,216,1)",
      data: [<?php //echo youinfluencercount(); ?>, <?php //echo youexclusivecount(); ?>, <?php //echo youmalecount(); ?>,
            <?php //echo youfemalecount(); ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'influencers'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?php //echo youinfluencercount(); ?>,
          maxTicksLimit: 7
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});    
</script>
-->
 <?php include "footer.php"; ?>     
