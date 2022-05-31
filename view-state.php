<?php include "header.php"; ?>
<?php
if($_SESSION['admintype'] == 3){
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
          <li class="breadcrumb-item active">All States</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
        <div class="card-header bg-dark text-white">
                    <i class="fas fa-table"></i>
                   All States <span style="float: right;"><a class="btn btn-primary modalButton1" data-toggle="modal" href="javascript:void(0);"><i class="fas fa-plus"></i> Add New State</a></span>
                    </div>
<!--
          <div class="card-header">
            <i class="fas fa-table"></i>
            Contact Form Details <span style="float: right;"><a class="btn btn-danger" href="exportcontact.php"><i class="fas fa-file-export"></i> Export</a>  <a class="btn btn-danger" href="addabstract.php"><i class="fas fa-plus"></i> Add Abstract</a> </span></div>
-->
          <div class="card-body">
            <div class="table-responsive">
             <?php
             if($_SESSION['admintype'] !== 3){
             ?>
             <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th>State</th>                    
<!--                    <th>Options</th>-->
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th>State</th>                    
<!--                    <th>Options</th>-->
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </tfoot>

                <tbody>
                  <?php 
$table_data = "SELECT * FROM state";
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
                      <td><?php echo $row->name; ?></td>
                      <td>
                          <a href="javascript:void(0);" class="btn btn-sm btn-info edit modalButton" data-toggle="modal" data-id="<?php echo $row->id;?>"><i class="fas fa-fw fa-edit" title="EDIT/UPDATE"></i></a>
                      </td>
                      <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-danger delete" data-state-name="<?php echo $row->name; ?>" id="<?php echo $row->id; ?>"><i class="fas fa-fw fa-trash" title="DELETE"></i></a>
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
             ?>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <!--Modal starts Here-->
<div class="modal fade" id="dynamicModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white" style="background:#ef1932;">
                <h5 class="modal-title">Update State</h5>
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

<div class="modal fade" id="dynamicModal1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white" style="background:#ef1932;">
                <h5 class="modal-title">Add State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form method='POST' id='insert' name='insert' action='add-state.php'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class='form-group'>
                              <label for='title'>State Name <strong class='text-danger'>**</strong></label>
                              <input type='text' id='state_name' name='state_name' class='form-control' placeholder='Enter State Name' required>
                            </div>
                          </div>
                    </div>
                    <button class='btn btn-primary add' onclick='return add()' type='submit' name='addstate' id='addstate'>Add</button>
                    </form>
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
<script>
//document.oncontextmenu = new Function("return false;");
$(document).ready(function(){

 $("#dataTable").on('click','.delete',function(){
     var id = $(this).attr("id");
     var state = $(this).data("state-name");
     var ask = confirm("Are you sure you want to delete "+state+" state?");
     if(ask){
         $.ajax({
         url:'delete-state.php',
         type:'POST',
         data:{id:id,state:state},
         cache:false,
         beforeSend: function(){
             $('.delete').addClass("disabled");
         },
         success: function(data){
             $('.delete').removeClass("disabled");
             if(data == "success"){
//                 removerow(id);
                 alert(state+' has been deleted');
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
            url:"fetch-single-state.php",
            method:"post",
            data:{id:id},
            success:function(response){
                $(".responsetxt").html(response);
                $("#dynamicModal").modal('show'); 
            }
        });
    });
    
$(".card-header").on('click','.modalButton1',function(){
        $("#dynamicModal1").modal('show');
    });
});

</script>
<script>
function add(){
    var state_name = $('#state_name').val().trim();
        
        if(state_name !== ""){
            $.ajax({
              url: 'add-state.php',
              type: 'POST',
              data:{state_name:state_name,
              addstate:"addstate"},
              beforeSend: function(){
                  $('.add').prop("disabled",true);
                  $('.add').text("Inserting....");
              },
              success: function(data){
                  $('.add').prop("disabled",false);
                  $('.add').text("Add"); 
                  if(data == 'success'){
                      alert(state_name+" Added Successfully");
                      $("#insert")[0].reset();
                      $("#dynamicModal1").modal('hide');
                      location.reload();
                   }
                  if(data == 'duplicate'){
                      alert("State already exists, Please Enter Unique State Name");
                      $("#state_name").focus();
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
            alert("Please Enter State Name");
            $("#state_name").focus();
        }
        return false;
}  
    
function update(){
        var id = $('#id').val().trim();
        var state_name = $('#state_name').val().trim();
        
        if(state_name !== ""){
            $.ajax({

              url: 'updatestate.php',
              type: 'POST',
              data:{id:id,state_name:state_name,
              updatestate:"updatestate"},
              beforeSend: function(){
                  $('.update').prop("disabled",true);
                  $('.update').text("Updating....");
              },
              success: function(data){
                  $('.update').prop("disabled",false);
                  $('.update').text("Update"); 
                  if(data == 'success'){
                      alert("State Updated Successfully");
                      $("#edit")[0].reset();
                      $("#dynamicModal").modal('hide');
                      location.reload();
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
            alert("Please Enter State Name");
            $("#state_name").focus();
        }
        return false;
    }
</script>