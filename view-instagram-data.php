<!--05c079eb2659a8ea4795b38ff0ded7f9-->
<?php include "header.php"; ?>
<?php include "functions/functions.php";?>
<?php

$minmax = "SELECT MIN(followers) AS minsub,MAX(followers) AS maxsub, MIN(avg_views) AS minviews,MAX(avg_views) AS maxviews,MIN(avg_likes) AS minlikes,MAX(avg_likes) AS maxlikes FROM `instagram`;";
$stmt5 = $con->prepare($minmax);
$stmt5->execute();
$row = $stmt5->fetch();
$minsub = $row->minsub;
$maxsub = $row->maxsub;
$minviews = $row->minviews;
$maxviews = $row->maxviews;
$minlikes = $row->minlikes;
$maxlikes = $row->maxlikes; 
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

<style>
#slider-range1 {
	width: 80%;
	float: left;
	margin: 5px 0px 5px 0px;
}
#slider-range2 {
	width: 80%;
	float: left;
	margin: 5px 0px 5px 0px;
}
#slider-range3 {
	width: 80%;
	float: left;
	margin: 5px 0px 5px 0px;
}

#maxsub {
	float: right;
	width: 100px;
	padding: 5px 10px;
}
#minsub {
	float: left;
	width: 100px;
	padding: 5px 10px;
	margin-right: 14px;
}
#maxviews {
	float: right;
	width: 100px;
	padding: 5px 10px;
}
#minviews {
	float: left;
	width: 100px;
	padding: 5px 10px;
	margin-right: 14px;
}
#maxlikes {
	float: right;
	width: 100px;
	padding: 5px 10px;
}
#minlikes {
	float: left;
	width: 100px;
	padding: 5px 10px;
	margin-right: 14px;
}
.btn-submit {
    clear: both;
	margin: 30px 0px;
}
/*
    .dataTables_length{
        margin-left: 250px;
    }
*/
</style>
        <!-- DataTables Example -->
        <div class="card mb-3" id="allfilters" style="display:none;">
            <div class="card-body">
             <form action="filterinstagram.php" method="post" name="filterform" id="filterform">
              <div>
                  <center>
                   <p><strong>Followers</strong></p>
                    <div>
                        <input type="" id="minsub" placeholder="Minimum Followers" name="minsub"
                            value="<?php echo $minsub ?>">
                        <div id="slider-range1"></div>
                        <input type="" id="maxsub" placeholder="Maximum Followers" name="maxsub"
                            value="<?php echo $maxsub ?>">
                    </div>                
                    </center>
              </div>
              <div class="clearfix"></div>
              <hr>
               <div>
                  <center>
                   <p><strong>Average Views</strong></p>
                    <div>
                        <input type="" id="minviews" placeholder="Minimum Views" name="minviews"
                            value="<?php echo $minviews ?>">
                        <div id="slider-range2"></div>
                        <input type="" id="maxviews" placeholder="Maximum Views" name="maxviews"
                            value="<?php echo $maxviews ?>">
                    </div>                
                    </center>
              </div>
               <div class="clearfix"></div>
               <hr>
               <div>
                  <center>
                   <p><strong>Average Likes</strong></p>
                    <div>
                        <input type="" id="minlikes" placeholder="Minimum Likes" name="minlikes"
                            value="<?php echo $minlikes ?>">
                        <div id="slider-range3"></div>
                        <input type="" id="maxlikes" placeholder="Maximum Likes" name="maxlikes"
                            value="<?php echo $maxlikes ?>">
                    </div>                
                    </center>
              </div>
                
                <div>
                   <center>
                    <input type="submit" name="submit_range"
                        value="Submit" class="btn-submit btn btn-danger">
                        <a class="btn btn-success" href="view-instagram-data.php">Close Filters</a>
                    </center>
                </div>
                </form>
            </div>
        </div>
        <div class="card mb-3">
        <form target="_blank" name='delete_records' action="pdf/youtube/instagram-influencers.php" method="post">
        <div class="card-header bg-dark text-white py-4">
                    <i class="fas fa-table"></i>
                   Instagram Data 
                   <span style="float: right;">
                   <strong><span class="rows_selected" id="select_count">0 Selected </span></strong>
                   <?php 
                   if($_SESSION['admintype'] == 1){
                   ?>
                       <a class="btn btn-danger" href="bulk-delete-instagram.php"><i class="fas fa-trash"></i> Bulk Delete</a> 
                   <?php
                   }       
                   ?>
                   <button type="submit" name="internal" class="btn btn-info" id="delete_records"><i class="fas fa-download"></i> Internal PDF</button>
                    <button type="submit" name="external" class="btn btn-success" id="delete_records1"><i class="fas fa-download"></i> External PDF</button>
                   <a class="btn btn-primary" id="showfilter" href="javascript:void(0);"><i class="fas fa-filter"></i> Special Filters</a></span>
                    </div>
<!--
          <div class="card-header">
            <i class="fas fa-table"></i>
            Contact Form Details <span style="float: right;"><a class="btn btn-danger" href="exportcontact.php"><i class="fas fa-file-export"></i> Export</a>  <a class="btn btn-danger" href="addabstract.php"><i class="fas fa-plus"></i> Add Abstract</a> </span></div>
-->
          <div class="card-body">
            <div class="table-responsive">
             <?php
             if($_SESSION['admintype'] == 1){
             ?>
             <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                  <tr>
                  <th><input type='checkbox' id='select_all'></th>
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
                    <th>Contact Number</th>
                    <th>Contact Person Name</th>
                    <th>Email ID</th>
                    <th>Comment</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Avg Likes</th>
                    <th>Avg Views</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign</th>
                    <th>Influencer Category</th>
                    <th>Name of Client Worked Before</th>                    
                    <th>Brands</th>
                    <th>Celebrity</th>
                    <th>Added on</th>
                    <th>Added by</th>
                    <th>Updated on</th>
                    <th>Updated by</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th><input type='checkbox' id='select_all'></th>
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
                    <th>Contact Number</th>
                    <th>Contact Person Name</th>
                    <th>Email ID</th>
                    <th>Comment</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Avg Likes</th>
                    <th>Avg Views</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign</th> 
                    <th>Influencer Category</th>
                    <th>Name of Client Worked Before</th>                   
                    <th>Brands</th>
                    <th>Celebrity</th>
                    <th>Added on</th>
                    <th>Added by</th>
                    <th>Updated on</th>
                    <th>Updated by</th>
                    <th>Options</th>
                  </tr>
                </tfoot>

                <tbody>
                  <?php 
$table_data = "SELECT * FROM instagram";
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
                  <td><input type='checkbox' name="instagram-id[]" value="<?php echo $row->id; ?>" class='delete-youtube' data-channel-id="<?php echo $row->id; ?>"></td>
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
                      <td><?php echo decrypt($row->contact_no) ?></td>
                      <td><?php echo decrypt($row->contact_person_name) ?></td>
                      <td><?php echo decrypt($row->email) ?></td>
                      <td><?php echo $row->comment ?></td>
                      <td><?php echo decrypt($row->address) ?></td>
                      <td><?php echo $row->city ?></td>
                      <td><?php echo $row->state ?></td>
                      <td><?php echo number_format($row->avg_likes) ?></td>
                      <td><?php echo number_format($row->avg_views) ?></td>
                      <td><?php echo decrypt($row->campaign_done_earlier) ?></td>
                      <td><?php echo decrypt($row->no_of_campaign) ?></td>
                      <td><?php echo $row->influencer_category ?></td>
                      <td><?php echo decrypt($row->name_of_client_worked_before) ?></td>
                      <td><?php echo $row->brands ?></td>
                      <td><?php echo $row->celebrity ?></td>
                      <td><?php echo $row->added_on ?></td>
                      <td><?php echo $row->added_by ?></td>
                      <td><?php echo $row->updated_on ?></td>
                      <td><?php echo $row->updated_by ?></td>
                      <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-info edit modalButton" data-toggle="modal" data-id="<?php echo $row->id;?>"><i class="fas fa-fw fa-edit" title="EDIT/UPDATE"></i></a>
                      <a href="javascript:void(0);" class="btn btn-sm btn-danger delete" data-influencer-name="<?php echo decrypt($row->influencer_name); ?>" id="<?php echo $row->id; ?>"><i class="fas fa-fw fa-trash" title="DELETE"></i></a>
                      </td>
                  </tr>

                <?php 
                    $i++;
                }  
                ?>
                  
                </tbody>
              </table>
             <?php     
             } 
             if($_SESSION['admintype'] == 2){
             ?>
             <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                  <tr>
                  <th><input type='checkbox' id='select_all'></th>
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
                    <th>Contact Number</th>
                    <th>Contact Person Name</th>
                    <th>Email ID</th>
                    <th>Comment</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Avg Likes</th>
                    <th>Avg Views</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign</th>  
                    <th>Influencer Category</th>
                    <th>Name of Client Worked Before</th>                  
                    <th>Brands</th>
                    <th>Celebrity</th>
                    <th>Added on</th>
                    <th>Added by</th>
                    <th>Updated on</th>
                    <th>Updated by</th>                    
                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th><input type='checkbox' id='select_all'></th>
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
                    <th>Contact Number</th>
                    <th>Contact Person Name</th>
                    <th>Email ID</th>
                    <th>Comment</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Avg Likes</th>
                    <th>Avg Views</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign</th> 
                    <th>Influencer Category</th>
                    <th>Name of Client Worked Before</th>                   
                    <th>Brands</th>
                    <th>Celebrity</th>
                    <th>Added on</th>
                    <th>Added by</th>
                    <th>Updated on</th>
                    <th>Updated by</th>                    
                    
                  </tr>
                </tfoot>

                <tbody>
                  <?php 
$table_data = "SELECT * FROM instagram";
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
                  <td><input type='checkbox' name="instagram-id[]" value="<?php echo $row->id; ?>" class='delete-youtube' data-channel-id="<?php echo $row->id; ?>"></td>
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
                      <td><?php echo decrypt($row->contact_no) ?></td>
                      <td><?php echo decrypt($row->contact_person_name) ?></td>
                      <td><?php echo decrypt($row->email) ?></td>
                      <td><?php echo $row->comment ?></td>
                      <td><?php echo decrypt($row->address) ?></td>
                      <td><?php echo $row->city ?></td>
                      <td><?php echo $row->state ?></td>
                      <td><?php echo number_format($row->avg_likes) ?></td>
                      <td><?php echo number_format($row->avg_views) ?></td>
                      <td><?php echo decrypt($row->campaign_done_earlier) ?></td>
                      <td><?php echo decrypt($row->no_of_campaign) ?></td>
                      <td><?php echo $row->influencer_category ?></td>
                      <td><?php echo decrypt($row->name_of_client_worked_before) ?></td>
                      <td><?php echo $row->brands ?></td>
                      <td><?php echo $row->celebrity ?></td>
                      <td><?php echo $row->added_on ?></td>
                      <td><?php echo $row->added_by ?></td>
                      <td><?php echo $row->updated_on ?></td>
                      <td><?php echo $row->updated_by ?></td>
                      
                  </tr>

                <?php 
                    $i++;
                }  
                ?>
                  
                </tbody>
              </table>
             <?php     
             } 
             if($_SESSION['admintype'] == 3){
             ?>
             <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                  <tr>
                  <th><input type='checkbox' id='select_all'></th>
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
                  <th><input type='checkbox' id='select_all'></th>
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
$table_data = "SELECT * FROM instagram";
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
                  <td><input type='checkbox' name="instagram-id[]" value="<?php echo $row->id; ?>" class='delete-youtube' data-channel-id="<?php echo $row->id; ?>"></td>
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
          </form>
        </div>

      </div>
      <!--Modal starts Here-->
<div class="modal fade" id="dynamicModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-white" style="background:#ef1932;">
                <h5 class="modal-title">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body responsetxt" id="modtext">
              
<!--
                <div class="row responsetxt">
                    
                </div>
-->
            </div>
            <div class="modal-footer text-white" style="background:#ef1932;">
                <button type="button" class="btn bg-dark text-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>
 
 <link rel="stylesheet"
    href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<style>
    .ui-slider{background: #9099a3;}
    .ui-slider-range{background: #0062cc;}
    .ui-state-default, .ui-state-hover{background: #ED1B34 !important;}
</style> 
<?php include "download-disable.php"; ?>
<script>
$('document').ready(function() {
    $(document).on('click', '#select_all', function() {          	
		$(".delete-youtube").prop("checked", this.checked);
		$("#select_count").html($("input.delete-youtube:checked").length+" Selected");
	});
    $(document).on('click', '.delete-youtube', function() {		
            $("#select_count").html($("input.delete-youtube:checked").length+" Selected");
        });
    // delete selected records
    $('#delete_records').on('click', function(e) { 
        var youtube = [];  
        $(".delete-youtube:checked").each(function() {  
            youtube.push($(this).data('channel-id'));
        });	
        if(youtube.length <=0)  {  
            alert("Please select records.");
            e.preventDefault();
        }  
//        else {
//            WRN_PROFILE_DELETE = "Are you sure you want to download internal PDF of "+youtube.length+" channel?";  
//            var checked = confirm(WRN_PROFILE_DELETE);  
//            if(checked == true) {			
//                var selected_values = youtube.join(","); 
//                $.ajax({ 
//                    type: "POST",  
//                    url: "pdf/youtube/youtube-influencers.php",  
//                    cache:false,  
//                    data: 'yt_id='+selected_values,  
//                    success: function(response) {
//                        var blob = new Blob([response], { type: "application/octetstream" });
//                        window.navigator.msSaveOrOpenBlob(blob, 'youtube-influencer.pdf');
//                        alert("PDF Downloaded");
//                        // remove deleted employee rows
////                        var yt_ids = response.split(",");
////                        alert(youtube.length+" youtube channel deleted");
////                        for (var i=0; i < yt_ids.length; i++ ) {						
////                            $("#"+yt_ids[i]).remove();
////                        }
////                        location.reload();
//                    }   
//                });				
//            }  
//        }  
    });
    
    $('#delete_records1').on('click', function(e) { 
        var youtube = [];  
        $(".delete-youtube:checked").each(function() {  
            youtube.push($(this).data('channel-id'));
        });	
        if(youtube.length <=0)  {
            alert("Please select records."); 
            e.preventDefault();
        }  
//        else {
//            WRN_PROFILE_DELETE = "Are you sure you want to download external PDF of "+youtube.length+" channel?";  
//            var checked = confirm(WRN_PROFILE_DELETE);  
//            if(checked == true) {			
//                var selected_values = youtube.join(","); 
//                $.ajax({ 
//                    type: "POST",  
//                    url: "delete-youtube-bulk.php",  
//                    cache:false,  
//                    data: 'yt_id='+selected_values,  
//                    success: function(response) {	
//                        // remove deleted employee rows
//                        var yt_ids = response.split(",");
//                        alert(youtube.length+" youtube channel deleted");
//                        for (var i=0; i < yt_ids.length; i++ ) {						
//                            $("#"+yt_ids[i]).remove();
//                        }
//                        location.reload();
//                    }   
//                });				
//            }  
//        }  
    });
});
</script>   
<script>
//document.oncontextmenu = new Function("return false;");
$(document).ready(function(){
  
 $("#dataTable").on('click','.delete',function(){
     var id = $(this).attr("id");
     var channel = $(this).data("influencer-name");
     var ask = confirm("Are you sure you want to delete "+channel+" instagram inlfuencer?");
     if(ask){
         $.ajax({
         url:'deleteinstagramdata.php',
         type:'POST',
         data:{id:id,channel:channel},
         cache:false,
         beforeSend: function(){
             $('.delete').addClass("disabled");
         },
         success: function(data){
             $('.delete').removeClass("disabled");
             if(data == "success"){
//                 removerow(id);
                 alert('Data has been deleted');
//                 location.reload();
             }
             if(data == "fail"){
                 alert('There was some error, please try again later or contact your website administrator');
             }
             if(data == "invalid"){
                 alert("Please refresh page again properly and then try");
             }
         }
        });
        $(this).closest('tr').remove();
     }
 
 });
    
    
$("#dataTable").on('click','.modalButton',function(){
    
        var id =$(this).data('id');
//        $("#dynamicModal").modal('show');
//        $("#modtext").text(media);
        $.ajax({
            url:"fetch-single-instagram.php",
            method:"post",
            data:{id:id},
            success:function(response){
                $(".responsetxt").html(response);
                $("#dynamicModal").modal('show'); 
            }
        });
    });

$("#showfilter").on('click',function(){
//    alert("hello");
    $("#allfilters").css("display","block");        
    });    


});

   
    
$(function() {
    $( "#slider-range1" ).slider({
      range: true,
      min: 0,
      max: <?php echo $maxsub ?> ,
      values: [ <?php echo $minsub ?>, <?php echo $maxsub ?> ],
      slide: function( event, ui ) {
        $( "#amount" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		$( "#minsub" ).val(ui.values[ 0 ]);
		$( "#maxsub" ).val(ui.values[ 1 ]);
      }
      });
//    $( "#amount" ).html( "$" + $( "#slider-range1" ).slider( "values", 0 ) +
//     " - $" + $( "#slider-range1" ).slider( "values", 1 ) );
  });
$(function() {
    $( "#slider-range2" ).slider({
      range: true,
      min: 0,
      max: <?php echo $maxviews ?> ,
      values: [ <?php echo $minviews ?>,<?php echo $maxviews ?> ],
      slide: function( event, ui ) {
        $( "#amount" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		$( "#minviews" ).val(ui.values[ 0 ]);
		$( "#maxviews" ).val(ui.values[ 1 ]);
      }
      });
//    $( "#amount" ).html( "$" + $( "#slider-range2" ).slider( "values", 0 ) +
//     " - $" + $( "#slider-range2" ).slider( "values", 1 ) );
  });
$(function() {
    $( "#slider-range3" ).slider({
      range: true,
      min: 0,
      max: <?php echo $maxlikes ?> ,
      values: [ <?php echo $minlikes ?>,<?php echo $maxlikes ?> ],
      slide: function( event, ui ) {
        $( "#amount" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		$( "#minlikes" ).val(ui.values[ 0 ]);
		$( "#maxlikes" ).val(ui.values[ 1 ]);
      }
      });
//    $( "#amount" ).html( "$" + $( "#slider-range3" ).slider( "values", 0 ) +
//     " - $" + $( "#slider-range3" ).slider( "values", 1 ) );
  });
</script>
<script>
function update(){
        var id = $('#id').val().trim();
        var unique_id = $('#unique_id').val().trim();
        var influencer_name = $('#influencer_name').val().trim();
        var handle = $('#handle').val().trim();
        var profile_url = $('#profile_url').val().trim();
//        alert(extension1);
        var followers = $('#followers').val().trim();
        var genre = $('#genre').val().trim();
        var language = $('#language').val().trim();
        var verified = $('#verified').val().trim();
        var gender = $('#gender').val().trim();
        var enlyft_exclusive = $('#enlyft_exclusive').val().trim();
        var image_cost = $('#image_cost').val().trim();
        var video_cost = $('#video_cost').val().trim();
        var igtv_cost = $('#igtv_cost').val().trim();
        var reels_15sec = $('#reels_15sec').val().trim();
        var reels_30sec = $('#reels_30sec').val().trim();
        var image_story_cost = $('#image_story_cost').val().trim();
        var video_story_cost = $('#video_story_cost').val().trim();
        var image_story_swipeup_cost = $('#image_story_swipeup_cost').val().trim();
        var video_story_swipeup_cost = $('#video_story_swipeup_cost').val().trim();
        var carousel_cost = $('#carousel_cost').val().trim();
        var contact_number = $('#contact_number').val().trim();
        var contact_person_name = $('#contact_person_name').val().trim();
        var email = $('#email').val().trim();
        var comment = $('#comment').val().trim();
        var address = $('#address').val().trim();
        var city = $('#city').val().trim();
        var state = $('#state').val().trim();
        var avg_views = $('#avg_views').val().trim();
        var avg_likes = $('#avg_likes').val().trim();
        var campaign_done_earlier = $("#campaign_done_earlier").val().trim();
        var no_of_campaign = $("#no_of_campaign").val().trim();
        var influencer_category = $("#influencer_category").val().trim();
        var name_of_client_worked_before = $("#name_of_client_worked_before").val().trim();
        var brands = $('#brands').val().trim();
        var celebrity = $('#celebrity').val().trim();
        
        if(unique_id !== ""){
            if(influencer_name !== ""){
                if(handle !== ""){
                    if(profile_url !== ""){
                        if(followers !== ""){
                            if(genre !== ""){
                                if(enlyft_exclusive !== ""){
                                    if(contact_number !== ""){
                                        if(contact_person_name !== ""){
                                            if(email !== ""){
                                                if(address !== ""){
                                                    if(city !== ""){
                                                        if(state !== ""){
                                                            if(avg_views !== ""){
                                                                if(avg_likes !== ""){
                                                                    if(influencer_category !== ""){
                                                                       $.ajax({
                                                                          url: 'updateinstagram.php',
                                                                          type: 'POST',
                                                                          data: {id:id,unique_id:unique_id,
                                                                        influencer_name:influencer_name,handle:handle,
                                                                        profile_url:profile_url,followers:followers,
                                                                        genre:genre,language:language,verified:verified,
                                                                        gender:gender,enlyft_exclusive:enlyft_exclusive,
                                                                        image_cost:image_cost,video_cost:video_cost,igtv_cost:igtv_cost,
                                                                        reels_15sec:reels_15sec,reels_30sec:reels_30sec,
                                                                        image_story_cost:image_story_cost,video_story_cost:video_story_cost,
                                                                        image_story_swipeup_cost:image_story_swipeup_cost,
                                                                        video_story_swipeup_cost:video_story_swipeup_cost,
                                                                        carousel_cost:carousel_cost,contact_number:contact_number,
                                                                        contact_person_name:contact_person_name,email:email,comment:comment,
                                                                        address:address,city:city,state:state,avg_views:avg_views,
                                                                        avg_likes:avg_likes,campaign_done_earlier:campaign_done_earlier,
                                                                        no_of_campaign:no_of_campaign,influencer_category:influencer_category,
                                                                        name_of_client_worked_before:name_of_client_worked_before,
                                                                        brands:brands,celebrity:celebrity,updateinstagram:"updateinstagram"},
                                                                          beforeSend: function(){
                                                                                $('#updateinstagram').prop("disabled",true);
                                                                                $('#updateinstagram').text("Updating....");
                                                                                $(".iderror").css("display","none"); 
                                                                          },
                                                                          success: function(data){
                                                                                $('#updateinstagram').prop("disabled",false);
                                                                                $('#updateinstagram').text("Submit"); 
                                                                                if(data == 'success'){
                                                                                    alert("Data Updated Successfully");
                                                                                    $("#edit")[0].reset();
                                                                                    $(".select2").val(null).trigger('change');
                                                                                    $("#dynamicModal").modal('hide');

            //                                                                        $("#dataTable").load();
                                                                                    location.reload();
                        //                                                            $("#state").val("");
                        //                                                            $("#language").val("");
                                                                                 }
                                                                                if(data == 'duplicate'){
                                                                                    alert("Unique ID already exist, Please Enter Unique Entry");
                                                                                    $("#unique_id").focus();
                                                                                    $(".iderror").css("display","inline");
                                                                                }                                                                                
                                                                                if(data == 'mandatory'){
                                                                                    alert("Please Fill All Fields Properly");
                                                                                }
                                                                                if(data == 'fail'){
                                                                                    alert("There was some while submitting, please try again later or contact website administrator");
                                                                                }
                                                                          }   
                                                                       }); 
                                                                    }
                                                                    else{
                                                                        alert("Please Select Influencer Category");
                                                                        $("#influencer_category").focus();
                                                                    }
                                                                }
                                                                else{
                                                                    alert("Please Enter Avg Likes");
                                                                    $("#avg_likes").focus();
                                                                }
                                                            }
                                                            else{
                                                                alert("Please Enter Avg Views");
                                                                $("#avg_views").focus();
                                                            }
                                                        }
                                                        else{
                                                            alert("Please Select State");
                                                            $("#state").focus();
                                                        }
                                                    }
                                                    else{
                                                        alert("Please Select City");
                                                        $("#city").focus();
                                                    }
                                                }
                                                else{
                                                    alert("Please Enter Address");
                                                    $("#address").focus();
                                                }
                                            }
                                            else{
                                                alert("Please Enter Email ID");
                                                $("#email").focus();
                                            }
                                        }
                                        else{
                                            alert("Please Enter Contact Person Name");
                                            $("#contact_person_name").focus();
                                        }
                                    }
                                    else{
                                        alert("Please Enter Contact Number");
                                        $("#contact_number").focus();
                                    }
                                }
                                else{
                                    alert("Please Select Enlyft Exclusive");
                                    $("#enlyft_exclusive").focus();
                                }
                            }
                            else{
                                alert("Please Enter Genre");
                                $("#genre").focus();
                            }
                        }
                        else{
                            alert("Please Enter Followers");
                            $("#followers").focus();
                        }
                    }
                    else{
                        alert("Please Enter Profile URL");
                        $("#profile_url").focus();
                    }
                }
                else{
                    alert("Please Enter Instagram handle");
                    $("#handle").focus();
                }
            }
            else{
                alert("Please Enter Influencer Name");
                $("#influencer_name").focus();
            }
        }
        else{
           alert("Please Enter Unique ID");
           $('#unique_id').focus();   
        }
        return false;
    }
</script>