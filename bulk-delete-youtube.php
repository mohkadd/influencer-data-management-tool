<?php include "header.php"; ?>
<?php
if($_SESSION['admintype'] !== 1){
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
          <li class="breadcrumb-item active">Bulk Delete YouTube Data</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
        <div class="card-header bg-dark text-white">
                    <i class="fas fa-table"></i>
                   Bulk Delete <span style="float: right;">
                   <strong><span class="rows_selected" id="select_count">0 Selected </span></strong> 
                   <a class="btn btn-danger" id="delete_records"><i class="fas fa-trash"></i> Delete</a> </span>
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
                    <th><input type='checkbox' id='select_all'></th>
                    <th>Channel Name</th>
                    <th>Profile URL</th>
                    <th>Subscribers</th>
                    <th>Genre</th>
<!--                    <th>Language</th>-->
<!--
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
-->
<!--
                    <th>Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Youtube Story Cost</th>
                    <th>Youtube Shorts Cost</th>
-->
<!--
                    <th>City</th>
                    <th>State</th>
-->
<!--
                    <th>Average Views</th>
                    <th>Average Likes</th>
                    <th>Influencer Name</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign done</th>
-->
                    <th>Influencer Category</th>
<!--                    <th>Delete</th>-->
                  </tr>
                </thead>
                <tfoot>
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th><input type='checkbox' id='select_all'></th>
                    <th>Channel Name</th>
                    <th>Profile URL</th>
                    <th>Subscribers</th>
                    <th>Genre</th>
<!--                    <th>Language</th>-->
<!--
                    <th>Gender</th>
                    <th>ENLYFT Exclusive</th>
-->
<!--
                    <th>Integrated Video Cost</th>
                    <th>Dedicated Video Cost</th>
                    <th>Youtube Story Cost</th>
                    <th>Youtube Shorts Cost</th>
-->
<!--
                    <th>City</th>
                    <th>State</th>
-->
<!--
                    <th>Average Views</th>
                    <th>Average Likes</th>
                    <th>Influencer Name</th>
                    <th>Campaign Done Earlier</th>
                    <th>No. of Campaign done</th>
-->
                    <th>Influencer Category</th>
<!--                    <th>Delete</th>-->
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
                  <tr id="<?php echo $row->id; ?>" onmousedown = 'return false' onselectstart = 'return false'>
<!--                      <td><?php //echo $i; ?></td>-->
                     <td><input type='checkbox' class='delete-youtube' data-channel-id="<?php echo $row->id; ?>"></td>
                      <td><?php echo decrypt($row->channel_name); ?></td>
                      <td><?php echo decrypt($row->profile_url); ?></td>
                      <td><?php echo number_format($row->subscribers); ?></td>
                      <td><?php echo $row->genre; ?></td>
<!--                      <td><?php //echo $row->language; ?></td>-->
<!--
                      <td><?php //echo $row->gender; ?></td>
                      <td><?php //echo decrypt($row->enlyft_exclusive); ?></td>
-->
<!--
                      <td><?php //echo number_format(decrypt($row->integrated_video_cost)); ?></td>
                      <td><?php //echo number_format(decrypt($row->dedicated_video_cost)); ?></td>
                      <td><?php //echo number_format(decrypt($row->youtube_story_cost)); ?></td>
                      <td><?php //echo number_format(decrypt($row->youtube_shorts_cost)); ?></td>
-->
<!--
                      <td><?php //echo $row->city; ?></td>
                      <td><?php //echo $row->state; ?></td>
-->
<!--
                      <td><?php //echo number_format($row->avg_views); ?></td>
                      <td><?php //echo number_format($row->avg_likes); ?></td> 
                      <td><?php //echo decrypt($row->influencer_name); ?></td>
                      <td><?php //echo decrypt($row->campaign_done_earlier); ?></td>
                      <td><?php //echo decrypt($row->no_of_campaign); ?></td>
-->
                      <td><?php echo $row->influencer_category ?></td>
                      
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
 <?php include "download-enable.php"; ?>
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
        }  
        else {
    //        alert(youtube);
            WRN_PROFILE_DELETE = "Are you sure you want to delete "+youtube.length+" channel?";  
            var checked = confirm(WRN_PROFILE_DELETE);  
            if(checked == true) {			
                var selected_values = youtube.join(","); 
                $.ajax({ 
                    type: "POST",  
                    url: "delete-youtube-bulk.php",  
                    cache:false,  
                    data: 'yt_id='+selected_values,  
                    success: function(response) {	
                        // remove deleted employee rows
                        var yt_ids = response.split(",");
                        alert(youtube.length+" youtube channel deleted");
                        for (var i=0; i < yt_ids.length; i++ ) {						
                            $("#"+yt_ids[i]).remove();
                        }
                        location.reload();
                    }   
                });				
            }  
        }  
    });
});
</script>