<!--05c079eb2659a8ea4795b38ff0ded7f9-->
<?php include "header.php"; ?>
<?php include "functions/functions.php";?>
<?php
if(isset($_POST['filterinstagram'])){
    $genre = htmlspecialchars(trim($_POST['genre']));
    if(!empty($genre)){
        $filterdata = "SELECT * FROM `instagram` WHERE genre = '".$genre."'";
    }
    $gender = htmlspecialchars(trim($_POST['gender']));
    if(!empty($gender)){
        $filterdata .= " AND gender = '".$gender."'"; 
    }
    $influencer_category = htmlspecialchars(trim($_POST['influencer_category']));
    if(!empty($influencer_category)){
        $filterdata .= " AND influencer_category = '".$influencer_category."';";   
    }
//    echo "<script>alert(\"$filterdata\")</script>";
    $stmt1 = $con->prepare($filterdata);
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
          <li class="breadcrumb-item active">Instagram Data</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
        <div class="card-header bg-dark text-white">
                    <i class="fas fa-table"></i>
                   Instagram Data 
                   <span style="float: right;">
                   <a class="btn btn-primary" id="showfilter" href="instagram-filter-data.php"><i class="fas fa-filter"></i>Back to Filters</a></span>
                    </div>
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
<!--                    <th>Sr. No.</th>-->
                    <th>Unique ID</th>
                    <th>Influencer Name</th>
                    <th>Handle</th>
                    <th>Profile URL</th>
                    <th>Followers</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Verified</th>
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
                    <th>Image Cost</th>
                    <th>Video Cost</th>
                    <th>IGTV Cost</th>
                    <th>Reels 15 Second Cost</th>
                    <th>Reels 30 Second Cost</th>
                    <th>Image Story Cost</th>
                    <th>Video Story Cost</th>
                    <th>Image Story Swipe Up Cost</th>
                    <th>Video Story Swipe Up Cost</th>
                    <th>Carousel Cost</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Avg Likes</th>
                    <th>Avg Views</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign</th>
                    <th>Influencer Category</th>                    
                    <th>Brands</th>
                    <th>Celebrity</th>                   
                  </tr>
                </thead>
                <tfoot>
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th>Unique ID</th>
                    <th>Influencer Name</th>
                    <th>Handle</th>
                    <th>Profile URL</th>
                    <th>Followers</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Verified</th>
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
                    <th>Image Cost</th>
                    <th>Video Cost</th>
                    <th>IGTV Cost</th>
                    <th>Reels 15 Second Cost</th>
                    <th>Reels 30 Second Cost</th>
                    <th>Image Story Cost</th>
                    <th>Video Story Cost</th>
                    <th>Image Story Swipe Up Cost</th>
                    <th>Video Story Swipe Up Cost</th>
                    <th>Carousel Cost</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Avg Likes</th>
                    <th>Avg Views</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign</th>
                    <th>Influencer Category</th>                    
                    <th>Brands</th>
                    <th>Celebrity</th>                    
                  </tr>
                </tfoot>

                <tbody>
<?php  
                while($row = $stmt1->fetch())  
                {
                ?>
                  <tr onmousedown = 'return false' onselectstart = 'return false'>
<!--                      <td><?php //echo $i; ?></td>-->
                     <td><?php echo decrypt($row->unique_id) ?></td>
                      <td><?php echo decrypt($row->influencer_name) ?></td>
                      <td><?php echo $row->handle ?></td>
                      <td><?php echo decrypt($row->profile_url) ?></td>
                      <td><?php echo number_format($row->followers) ?></td>
                      <td><?php echo $row->genre ?></td>
                      <td><?php echo $row->language ?></td>
                      <td><?php echo $row->verified ?></td>
                      <td><?php echo $row->gender ?></td>
                      <td><?php echo decrypt($row->enlyft_exclusive) ?></td>
                      <td><?php echo number_format(decrypt($row->image_cost)) ?></td>
                      <td><?php echo number_format(decrypt($row->video_cost)) ?></td>
                      <td><?php echo number_format(decrypt($row->igtv_cost)) ?></td>
                      <td><?php echo number_format(decrypt($row->reels_15sec)) ?></td>
                      <td><?php echo number_format(decrypt($row->reels_30sec)) ?></td>
                      <td><?php echo number_format(decrypt($row->image_story_cost)) ?></td>
                      <td><?php echo number_format(decrypt($row->video_story_cost)) ?></td>
                      <td><?php echo number_format(decrypt($row->image_story_swipeup_cost)) ?></td>
                      <td><?php echo number_format(decrypt($row->video_story_swipeup_cost)) ?></td>
                      <td><?php echo number_format(decrypt($row->carousel_cost)) ?></td>
                      <td><?php echo $row->city ?></td>
                      <td><?php echo $row->state ?></td>
                      <td><?php echo number_format($row->avg_likes) ?></td>
                      <td><?php echo number_format($row->avg_views) ?></td>
                      <td><?php echo decrypt($row->campaign_done_earlier) ?></td>
                      <td><?php echo decrypt($row->no_of_campaign) ?></td>
                      <td><?php echo $row->influencer_category ?></td>
                      <td><?php echo $row->brands ?></td>
                      <td><?php echo $row->celebrity ?></td>
                      
                  </tr>

                <?php 
//                    $i++;
                }
                ?>
                  
                </tbody>
              </table>
             
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <?php } ?>
    
      
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?> 
<?php include "download-disable.php"; ?>
