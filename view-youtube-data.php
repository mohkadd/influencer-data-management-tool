<?php include "header.php"; ?>
<?php include "functions/functions.php";?>
<?php

$minmax = "SELECT MIN(subscribers) AS minsub,MAX(subscribers) AS maxsub, MIN(avg_views) AS minviews,MAX(avg_views) AS maxviews,MIN(avg_likes) AS minlikes,MAX(avg_likes) AS maxlikes FROM `youtube`;";
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
          <li class="breadcrumb-item active">YouTube Data</li>
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
             <form action="filterdata.php" method="post" name="filterform" id="filterform">
              <div>
                  <center>
                   <p><strong>Subscribers</strong></p>
                    <div>
                        <input type="" id="minsub" placeholder="Minimum Subscribers" name="minsub"
                            value="<?php echo $minsub ?>">
                        <div id="slider-range1"></div>
                        <input type="" id="maxsub" placeholder="Maximum Subscribers" name="maxsub"
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
                        <a class="btn btn-success" href="view-youtube-data.php">Close Filters</a>
                    </center>
                </div>
                </form>
            </div>
        </div>
        <div class="card mb-3">
        <div class="card-header bg-dark text-white">
                    <i class="fas fa-table"></i>
                   YouTube Data 
                   <span style="float: right;">
                   <?php 
                   if($_SESSION['admintype'] == 1){
                   ?>
                       <a class="btn btn-danger" href="bulk-delete-youtube.php"><i class="fas fa-trash"></i> Bulk Delete</a> 
                   <?php
                   }       
                   ?>
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
<!--                    <th>Sr. No.</th>-->
                    <th>Channel Name</th>
                    <th>Profile URL</th>
                    <th>Subscribers</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
                    <th>Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Youtube Story Cost</th>
                    <th>Youtube Shorts Cost</th>
                    <th>Contact Number</th>
                    <th>Conact Person Name</th>
                    <th>Email ID</th>
                    <th>Comment</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Average Views</th>
                    <th>Average Likes</th>
                    <th>Influencer Name</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign done</th>
                    <th>Influencer Category</th>
                    <th>Name of Client Worked Before</th>
                    <th>Celebrity</th>
                    <th>Brands</th>
                    <th>Added On</th>
                    <th>Added By</th>
                    <th>Updated On</th>
                    <th>Updated By</th>                    
                    <th>Options</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th>Channel Name</th>
                    <th>Profile URL</th>
                    <th>Subscribers</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
                    <th>Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Youtube Story Cost</th>
                    <th>Youtube Shorts Cost</th>
                    <th>Contact Number</th>
                    <th>Conact Person Name</th>
                    <th>Email ID</th>
                    <th>Comment</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Average Views</th>
                    <th>Average Likes</th>
                    <th>Influencer Name</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign done</th>
                    <th>Influencer Category</th>
                    <th>Name of Client Worked Before</th>
                    <th>Celebrity</th>
                    <th>Brands</th>
                    <th>Added On</th>
                    <th>Added By</th>
                    <th>Updated On</th>
                    <th>Updated By</th>                    
                    <th>Options</th>
                  </tr>
                </tfoot>

                <tbody>
                  <?php 
$table_data = "SELECT * FROM youtube";
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
<!--                      <td><?php //echo $i; ?></td>-->
                      <td><?php echo decrypt($row->channel_name); ?></td>
                      <td><?php echo decrypt($row->profile_url); ?></td>
                      <td><?php echo number_format($row->subscribers); ?></td>
                      <td><?php echo ucwords($row->genre); ?></td>
                      <td><?php echo ucwords($row->language); ?></td>
                      <td><?php echo $row->gender; ?></td>
                      <td><?php echo ucwords(decrypt($row->enlyft_exclusive)); ?></td>
                      <td><?php echo number_format(decrypt($row->integrated_video_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->dedicated_video_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->youtube_story_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->youtube_shorts_cost)); ?></td>
                      <td><?php echo decrypt($row->contact_number); ?></td>
                      <td><?php echo ucwords(decrypt($row->contact_person_name)); ?></td>
                      <td><?php echo decrypt($row->email_id); ?></td>
                      <td><?php echo $row->comment; ?></td>
                      <td><?php echo decrypt($row->address); ?></td>
                      <td><?php echo ucwords($row->city); ?></td>
                      <td><?php echo ucwords($row->state); ?></td>
                      <td><?php echo number_format($row->avg_views); ?></td>
                      <td><?php echo number_format($row->avg_likes); ?></td> 
                      <td><?php echo decrypt($row->influencer_name); ?></td>
                      <td><?php echo decrypt($row->campaign_done_earlier); ?></td>
                      <td><?php echo decrypt($row->no_of_campaign); ?></td>
                      <td><?php echo strtoupper($row->influencer_category); ?></td>
                      <td><?php echo decrypt($row->name_of_client_worked_before); ?></td>
                      <td><?php echo $row->celebrity ?></td>
                      <td><?php echo $row->brands ?></td>
                      <td><?php echo $row->added_on; ?></td>
                      <td><?php echo $row->added_by; ?></td>
                      <td><?php echo $row->updated_on; ?></td>
                      <td><?php echo $row->updated_by; ?></td>
                      <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-info edit modalButton" data-toggle="modal" data-id="<?php echo $row->id;?>"><i class="fas fa-fw fa-edit" title="EDIT/UPDATE"></i></a>
                      <a href="javascript:void(0);" class="btn btn-sm btn-danger delete" data-channel-name="<?php echo decrypt($row->channel_name); ?>" id="<?php echo $row->id; ?>"><i class="fas fa-fw fa-trash" title="DELETE"></i></a>
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
<!--                    <th>Sr. No.</th>-->
                    <th>Channel Name</th>
                    <th>Profile URL</th>
                    <th>Subscribers</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
                    <th>Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Youtube Story Cost</th>
                    <th>Youtube Shorts Cost</th>
                    <th>Contact Number</th>
                    <th>Conact Person Name</th>
                    <th>Email ID</th>
                    <th>Comment</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Average Views</th>
                    <th>Average Likes</th>
                    <th>Influencer Name</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign done</th>
                    <th>Influencer Category</th>
                    <th>Name of Client Worked Before</th>
                    <th>Celebrity</th>
                    <th>Brands</th>
                    <th>Added On</th>
                    <th>Added By</th>
                    <th>Updated On</th>
                    <th>Updated By</th>                    
                    <th>Options</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th>Channel Name</th>
                    <th>Profile URL</th>
                    <th>Subscribers</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
                    <th>Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Youtube Story Cost</th>
                    <th>Youtube Shorts Cost</th>
                    <th>Contact Number</th>
                    <th>Conact Person Name</th>
                    <th>Email ID</th>
                    <th>Comment</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Average Views</th>
                    <th>Average Likes</th>
                    <th>Influencer Name</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign done</th>
                    <th>Influencer Category</th>
                    <th>Name of Client Worked Before</th>
                    <th>Celebrity</th>
                    <th>Brands</th>
                    <th>Added On</th>
                    <th>Added By</th>
                    <th>Updated On</th>
                    <th>Updated By</th>                    
                    <th>Options</th>
                  </tr>
                </tfoot>

                <tbody>
                  <?php 
$table_data = "SELECT * FROM youtube";
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
<!--                      <td><?php //echo $i; ?></td>-->
                      <td><?php echo decrypt($row->channel_name); ?></td>
                      <td><?php echo decrypt($row->profile_url); ?></td>
                      <td><?php echo number_format($row->subscribers); ?></td>
                      <td><?php echo ucwords($row->genre); ?></td>
                      <td><?php echo ucwords($row->language); ?></td>
                      <td><?php echo $row->gender; ?></td>
                      <td><?php echo ucwords(decrypt($row->enlyft_exclusive)); ?></td>
                      <td><?php echo number_format(decrypt($row->integrated_video_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->dedicated_video_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->youtube_story_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->youtube_shorts_cost)); ?></td>
                      <td><?php echo decrypt($row->contact_number); ?></td>
                      <td><?php echo ucwords(decrypt($row->contact_person_name)); ?></td>
                      <td><?php echo decrypt($row->email_id); ?></td>
                      <td><?php echo $row->comment; ?></td>
                      <td><?php echo decrypt($row->address); ?></td>
                      <td><?php echo ucwords($row->city); ?></td>
                      <td><?php echo ucwords($row->state); ?></td>
                      <td><?php echo number_format($row->avg_views); ?></td>
                      <td><?php echo number_format($row->avg_likes); ?></td> 
                      <td><?php echo decrypt($row->influencer_name); ?></td>
                      <td><?php echo decrypt($row->campaign_done_earlier); ?></td>
                      <td><?php echo decrypt($row->no_of_campaign); ?></td>
                      <td><?php echo strtoupper($row->influencer_category); ?></td>
                      <td><?php echo decrypt($row->name_of_client_worked_before); ?></td>
                      <td><?php echo $row->celebrity ?></td>
                      <td><?php echo $row->brands ?></td>
                      <td><?php echo $row->added_on; ?></td>
                      <td><?php echo $row->added_by; ?></td>
                      <td><?php echo $row->updated_on; ?></td>
                      <td><?php echo $row->updated_by; ?></td>
                      <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-info edit modalButton" data-toggle="modal" data-id="<?php echo $row->id;?>"><i class="fas fa-fw fa-edit" title="EDIT/UPDATE"></i></a>
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
             if($_SESSION['admintype'] == 3){
             ?>
             <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th>Channel Name</th>
                    <th>Profile URL</th>
                    <th>Subscribers</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
                    <th>Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Youtube Story Cost</th>
                    <th>Youtube Shorts Cost</th>                    
                    <th>City</th>
                    <th>State</th>
                    <th>Average Views</th>
                    <th>Average Likes</th>
                    <th>Influencer Name</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign done</th>
                    <th>Influencer Category</th>
                    <th>Celebrity</th>
                    <th>Brands</th>                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th>Channel Name</th>
                    <th>Profile URL</th>
                    <th>Subscribers</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
                    <th>Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Youtube Story Cost</th>
                    <th>Youtube Shorts Cost</th>                    
                    <th>City</th>
                    <th>State</th>
                    <th>Average Views</th>
                    <th>Average Likes</th>
                    <th>Influencer Name</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign done</th>
                    <th>Influencer Category</th>
                    <th>Celebrity</th>
                    <th>Brands</th>                    
                  </tr>
                </tfoot>

                <tbody>
                  <?php 
$table_data = "SELECT * FROM youtube";
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
<!--                      <td><?php //echo $i; ?></td>-->
                      <td><?php echo decrypt($row->channel_name); ?></td>
                      <td><?php echo decrypt($row->profile_url); ?></td>
                      <td><?php echo number_format($row->subscribers); ?></td>
                      <td><?php echo ucwords($row->genre); ?></td>
                      <td><?php echo ucwords($row->language); ?></td>
                      <td><?php echo $row->gender; ?></td>
                      <td><?php echo ucwords(decrypt($row->enlyft_exclusive)); ?></td>
                      <td><?php echo number_format(decrypt($row->integrated_video_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->dedicated_video_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->youtube_story_cost)); ?></td>
                      <td><?php echo number_format(decrypt($row->youtube_shorts_cost)); ?></td>                      
                      <td><?php echo ucwords($row->city); ?></td>
                      <td><?php echo ucwords($row->state); ?></td>
                      <td><?php echo number_format($row->avg_views); ?></td>
                      <td><?php echo number_format($row->avg_likes); ?></td> 
                      <td><?php echo decrypt($row->influencer_name); ?></td>
                      <td><?php echo decrypt($row->campaign_done_earlier); ?></td>
                      <td><?php echo decrypt($row->no_of_campaign); ?></td>
                      <td><?php echo strtoupper($row->influencer_category); ?></td>
                      <td><?php echo $row->celebrity ?></td>
                      <td><?php echo $row->brands ?></td>
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
<script>
//document.oncontextmenu = new Function("return false;");
$(document).ready(function(){

 $("#dataTable").on('click','.delete',function(){
     var id = $(this).attr("id");
     var channel = $(this).data("channel-name");
     var ask = confirm("Are you sure you want to delete "+channel+" channel?");
     if(ask){
         $.ajax({
         url:'deleteyoutubedata.php',
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
            url:"fetch-single-youtube.php",
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
        var channel_name = $('#channel_name').val().trim();
        var profile_url = $('#profile_url').val().trim();
        var subscribers = $('#subscribers').val().trim();
        var genre = $('#genre').val().trim();
        var language = $('#language').val().trim();
        var gender = $('#gender').val().trim();
        var enlyft_exclusive = $('#enlyft_exclusive').val().trim();
        var integrated_video_cost = $('#integrated_video_cost').val().trim();
        var dedicated_video_cost = $('#dedicated_video_cost').val().trim();
        var youtube_story_cost = $('#youtube_story_cost').val().trim();
        var youtube_shorts_cost = $('#youtube_shorts_cost').val().trim();
        var contact_number = $('#contact_number').val().trim();
        var contact_person_name = $('#contact_person_name').val().trim();
        var email_id = $('#email_id').val().trim();
        var comment = $('#comment').val().trim();
        var address = $('#address').val().trim();
        var city = $('#city').val().trim();
        var state = $('#state').val().trim();
        var avg_views = $('#avg_views').val().trim();
        var avg_likes = $('#avg_likes').val().trim();
        var influencer_name = $('#influencer_name').val().trim();
        var campaign_done_earlier = $("#campaign_done_earlier").val().trim();
        var no_of_campaign = $("#no_of_campaign").val().trim();
        var influencer_category = $("#influencer_category").val().trim();
        var name_of_client_worked_before = $("#name_of_client_worked_before").val().trim();
        var celebrity = $('#celebrity').val().trim();
        var brands = $('#brands').val().trim();
        
        if(channel_name !== ""){
//            alert("hello");
            if(profile_url !== ""){
                if(subscribers !== ""){
                   subscribers = parseInt(subscribers);
                   if(isNaN(subscribers) && typeof subscribers !== 'number'){
                        alert("Please Enter Valid Numeric Data");
                        $("#subscribers").focus();
                    }
                }
                if(language !== ""){
                    if(gender !== ""){
                        if(enlyft_exclusive !== ""){
                            if(integrated_video_cost !== ""){
                               integrated_video_cost = parseFloat(integrated_video_cost);
                               if(isNaN(integrated_video_cost) && typeof integrated_video_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#integrated_video_cost").focus();
                               }
                            }
                            if(dedicated_video_cost !== ""){
                                dedicated_video_cost = parseFloat(dedicated_video_cost);
                                if(isNaN(dedicated_video_cost) && typeof dedicated_video_cost !== 'number'){
                                      alert("Please Enter Valid Numeric Data");
                                      $("#dedicated_video_cost").focus();
                               }
                            }
                            if(youtube_story_cost !== ""){
                                youtube_story_cost = parseFloat(youtube_story_cost);
                                if(isNaN(youtube_story_cost) && typeof youtube_story_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#youtube_story_cost").focus();
                                }
                            }
                            if(youtube_shorts_cost !== ""){
                                youtube_shorts_cost = parseFloat(youtube_shorts_cost);
                                if(isNaN(youtube_shorts_cost) && typeof youtube_shorts_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#youtube_shorts_cost").focus();
                                }
                            }
                            if(contact_number !== "" && contact_number.length == 10){
                                if(contact_person_name !== ""){
                                    if(email_id !== ""){
                                        if(state !== ""){
                                            if(avg_views !== ""){
                                                 avg_views = parseInt(avg_views);
                                                 if(isNaN(avg_views) && typeof avg_views !== 'number'){
                                                     alert("Please Enter Valid Numeric Data");
                                                     $("#avg_views").focus();
                                                 }
                                            }
                                            if(avg_likes !== ""){
                                                avg_likes = parseInt(avg_likes);
                                                if(isNaN(avg_likes) && typeof avg_likes !== 'number'){
                                                    alert("Please Enter Valid Numeric Data");
                                                    $("#avg_likes").focus();
                                                }
                                            }
                                            if(influencer_name !== ""){
                                                
                                                        if(influencer_category !== ""){
                                                            $.ajax({

                                                                url: 'updateyoutube.php',
                                                                type: 'POST',
                                                                data:{id:id,channel_name:channel_name,
                                                                profile_url:profile_url,subscribers:subscribers,
                                                                genre:genre,language:language,gender:gender,
                                                                enlyft_exclusive:enlyft_exclusive,
                                                                integrated_video_cost:integrated_video_cost,
                                                                dedicated_video_cost:dedicated_video_cost,
                                                                youtube_story_cost:youtube_story_cost,
                                                                youtube_shorts_cost:youtube_shorts_cost,
                                                                contact_number:contact_number,contact_person_name:contact_person_name,
                                                                email_id:email_id,comment:comment,address:address,city:city,state:state,
                                                                avg_views:avg_views,avg_likes:avg_likes,influencer_name:influencer_name,
                                                                campaign_done_earlier:campaign_done_earlier,no_of_campaign:no_of_campaign,
                                                                influencer_category:influencer_category,name_of_client_worked_before:name_of_client_worked_before,
                                                                celebrity:celebrity,brands:brands,updateyoutube:"updateyoutube"},
                                                                beforeSend: function(){
                                                                    $('.update').prop("disabled",true);
                                                                    $('.update').text("Updating....");
                                                                },
                                                                success: function(data){
                                                                    $('.update').prop("disabled",false);
                                                                    $('.update').text("Update"); 
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
                                                                        alert("Profile URL already exists, Please Enter Unique Profile URL");
                                                                        $("#profile_url").focus();
                                                                    }
                                                                    if(data == 'invalid'){
                                                                        alert("Please Fill All Numberic Fields Properly");
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
                                                alert("Please Enter Influencer Name");
                                                $("#influencer_name").focus();
                                            }
                                        }
                                        else{
                                            alert("Please Select State");
                                            $("#state").focus();
                                        }
                                    }
                                    else{
                                        alert("Please Enter Email ID");
                                        $("#email_id").focus();
                                    }
                                }
                                else{
                                    alert("Please Enter Contact Person Name");
                                    $("#contact_person_name").focus();
                                }
                            }
                            else{
                                alert("Please Enter Valid 10 Digit Contact Number");
                                $("#contact_number").focus();
                            }
                        }
                        else{
                            alert("Please Select Enlyft Exclusive");
                            $("#enlyft_exclusive").focus();
                        }
                    }
                    else{
                        alert("Please Select Gender");
                        $("#gender").focus();
                    }
                }
                else{
                    alert("Please Select Language");
                    $("#language").focus();
                }
            }
            else{
                alert("Please Enter Profile URL");
                $("#profile_url").focus();
            }
        }
        else{
            alert("Please Enter Channel Name");
            $("#channel_name").focus();
        }
        return false;
    }
</script>