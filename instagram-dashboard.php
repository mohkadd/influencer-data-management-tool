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
          <li class="breadcrumb-item active">Instagram Dashboard</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
         <?php 
          $table_data = "SELECT DISTINCT genre, COUNT(id) AS countid FROM instagram GROUP BY genre ORDER BY genre ASC";
          $stmt1 = $con->prepare($table_data);
          $stmt1->execute();
          $i = 1;
        
         ?>
         <?php  
                    while($row = $stmt1->fetch())  
                    {
                        $genre = $row->genre;
                    ?>
        
          <div class="col-xl-3 col-sm-6 mb-3">
            <a href="javascript:void(0);" class="genre" id="<?php echo $row->genre; ?>">
             <div class="card text-white o-hidden h-100 bg-dark">
              <div class="card-body">
                <!-- <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div> -->
                <div class="mr-4 text-center"><?php echo $row->genre; ?><br><strong style="color:#ef1932;"><?php echo $row->countid; ?> - Influencers</strong></div>
              </div>
              
            </div>
            </a>
          </div>      
         <?php
                        $i++;
                    }  
                    ?>
        </div>


        <!-- DataTables Example -->
        <div class="col-xl-9 col-sm-12 responsetxt">

        </div>

      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?> 
     
<script>
$(document).ready(function(){
    $(".genre").click(function(){
        var genre =$(this).attr('id');
        $.ajax({
            url:"fetch-instagram-genre-count.php",
            method:"post",
            data:{genre:genre},
            success:function(response){
                $(".responsetxt").html(response);
                $("html , body").animate({
                        scrollTop: $(".responsetxt").offset().top},
                    'slow');
            }
        });
    });
});
</script>