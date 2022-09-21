<?php include "header.php"; ?>
<?php include "functions/functions.php";?>
<?php
if(isset($_POST['markup'])){
    $channelid = $_POST['channel-id'];
    $ids = implode(',', $channelid);
    //fetching data from database
    $table_data = "SELECT * FROM youtube WHERE id IN ($ids)";
    $stmt1 = $con->prepare($table_data);
    $stmt1->execute();

?>

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
          <li class="breadcrumb-item active">YouTube Data Markup Cost</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
        <form target="_blank" name='delete_records' action="pdf/youtube/youtube-influencers-markup.php" method="post">
        <div class="card-header bg-dark text-white py-4">
                    <i class="fas fa-table"></i>
                   YouTube Data 
                   <span style="float: right;">
<!--                   <strong><span class="rows_selected" id="select_count">0 Selected </span></strong>-->
                   <a class="btn btn-primary" id="showfilter" href="youtube-filter-data.php"><i class="fas fa-filter"></i> Back to Filters</a>
                   <button type="submit" name="internal" class="btn btn-info" id="delete_records"><i class="fas fa-download"></i> Internal PDF</button>
                   <button type="submit" name="external" class="btn btn-success" id="delete_records1"><i class="fas fa-download"></i> External PDF</button>
                   </span>
                    </div>
<!--
          <div class="card-header">
            <i class="fas fa-table"></i>
            Contact Form Details <span style="float: right;"><a class="btn btn-danger" href="exportcontact.php"><i class="fas fa-file-export"></i> Export</a>  <a class="btn btn-danger" href="addabstract.php"><i class="fas fa-plus"></i> Add Abstract</a> </span></div>
-->
          <div class="card-body">
            <div class="table-responsive">
             
             <table class="table table-bordered table-condensed" id="dataT" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                  <tr>
                      
<!--                    <th>Sr. No.</th>-->
                    <th>Channel Name</th>
                    <th>Subscribers</th>
                    <th>Influencer Category</th>
                    <th>Integrated Video Cost</th>
                    <th>Markup Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Markup Dedicated Video Cost</th>
                                      
                  </tr>
                </thead>

                <tbody>
<?php  
                while($row = $stmt1->fetch())  
                {
                    // if(decrypt($row->markupivcost) == 0){
                        $markupivcost = (decrypt($row->integrated_video_cost) * (25/100)) + decrypt($row->integrated_video_cost);
                    // }
                    // else{
                    //     $markupivcost = decrypt($row->markupivcost);
                    // }
                    
                    // if(decrypt($row->markupdvcost) == 0){
                        $markupdvcost = (decrypt($row->dedicated_video_cost) * (25/100)) + decrypt($row->dedicated_video_cost);
                    // }
                    // else{
                    //     $markupdvcost = decrypt($row->markupdvcost);
                    // }
                ?>
                  <tr id="<?php echo $row->id; ?>">
<!--                      <td><?php //echo $i; ?></td>-->
                     
                      <td><input type="hidden" name="channel-id[]" value="<?php echo $row->id; ?>">
                      <?php echo decrypt($row->channel_name); ?></td>
                      <td><?php echo number_format($row->subscribers); ?></td>
                      <td><?php echo strtoupper($row->influencer_category); ?></td>
                      <td><?php echo number_format(decrypt($row->integrated_video_cost)); ?></td>
                      <td><input type="text" name="markupivcost[]" placeholder="Enter Markup Integrated Video Cost" value="<?php echo $markupivcost; ?>"></td>
                      <td><?php echo number_format(decrypt($row->dedicated_video_cost)); ?></td>
                      <td><input type="text" name="markupdvcost[]" placeholder="Enter Markup Dedicated Video Cost" value="<?php echo $markupdvcost; ?>"></td>
                      
                  </tr>

                <?php 
//                    $i++;
                }  
                ?>
                  
                </tbody>
              </table>
             
            </div>
          </div>
          </form>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <?php 
}
?>
      <!--Modal starts Here-->
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>  
