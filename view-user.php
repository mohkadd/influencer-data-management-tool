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
          <li class="breadcrumb-item active">All Users</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
        <div class="card-header bg-dark text-white">
                    <i class="fas fa-table"></i>
                   All Users <span style="float: right;"><a class="btn btn-primary modalButton1" data-toggle="modal" href="javascript:void(0);"><i class="fas fa-plus"></i> Add New User</a></span>
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
                    <th>Username</th>                    
                    <th>Password</th>
                    <th>Usertype</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Last Login</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
<!--                    <th>Sr. No.</th>-->
                    <th>Username</th>                    
                    <th>Password</th>
                    <th>Usertype</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Last Login</th>
                  </tr>
                </tfoot>

                <tbody>
                  <?php 
$table_data = "SELECT * FROM admin";
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
                      <td><?php echo $row->username; ?></td>
                      <td><?php echo $row->password; ?></td>
                      <td><?php
                        if($row->admin_type == 1){
                            $usertype = "Super Admin";
                        }
                        if($row->admin_type == 2){
                            $usertype = "Admin";
                        }
                        if($row->admin_type == 3){
                            $usertype = "Viewer";
                        }
                        if($row->admin_type == 4){
                            $usertype = "Scrapper";
                        }
                        echo $usertype; ?></td>
                      <td>
                          <a href="javascript:void(0);" class="btn btn-sm btn-info edit modalButton" data-toggle="modal" data-id="<?php echo $row->id;?>"><i class="fas fa-fw fa-edit" title="EDIT/UPDATE"></i></a>
                      </td>
                      <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-danger delete <?php if($row->admin_type == 1){echo "disabled";} ?>" data-user-name="<?php echo $row->username; ?>" id="<?php echo $row->id; ?>"><i class="fas fa-fw fa-trash" title="DELETE"></i></a>
                      </td>
                      <td><?php echo $row->last_login; ?></td>
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
                <h5 class="modal-title">Update User</h5>
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
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form method='POST' id='insert' name='insert' action='add-user.php'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='form-group'>
                              <label for='title'>Username <strong class='text-danger'>**</strong></label>
                              <input type='text' id='username' name='username' class='form-control' placeholder='Enter Username' required>
                            </div>
                          </div>
                        <div class='col-md-12'>
                            <div class='form-group'>
                              <label for='title'>Password <strong class='text-danger'>**</strong></label>
                              <input type='text' id='pwd' name='pwd' class='form-control' placeholder='Enter Password' required>
                            </div>
                          </div>
                        <div class='col-md-12'>
                            <div class='form-group'>
                              <label for='title'>User Type <strong class='text-danger'>**</strong></label>
                              <select class="form-control" name="usertype" id="usertype" required>
                                  <option value="">Please Select User Type</option>
                                  <option value="1">Super Admin</option>
                                  <option value="2">Admin</option>
                                  <option value="3">Viewer</option>
                              </select>
                            </div>
                          </div>
                    </div>
                    <button class='btn btn-primary add' onclick='return add()' type='submit' name='adduser' id='adduser'>Add</button>
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
<?php include "download-enable.php"; ?>    
<script>
//document.oncontextmenu = new Function("return false;");
$(document).ready(function(){

 $("#dataTable").on('click','.delete',function(){
     var id = $(this).attr("id");
     var user = $(this).data("user-name");
     var ask = confirm("Are you sure you want to delete "+user+"?");
     if(ask){
         $.ajax({
         url:'delete-user.php',
         type:'POST',
         data:{id:id,user:user},
         cache:false,
         beforeSend: function(){
             $('.delete').addClass("disabled");
         },
         success: function(data){
             $('.delete').removeClass("disabled");
             if(data == "success"){
//                 removerow(id);
                 alert(user+' has been deleted');
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
            url:"fetch-single-user.php",
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
    var username = $('#username').val().trim();
    var pwd = $('#pwd').val().trim();
    var usertype = $('#usertype').val().trim();
        
        if(username !== ""){
            if(pwd !== ""){
                if(usertype !== ""){
                    $.ajax({
                      url: 'add-user.php',
                      type: 'POST',
                      data:{username:username,pwd:pwd,usertype:usertype,
                      adduser:"adduser"},
                      beforeSend: function(){
                          $('.add').prop("disabled",true);
                          $('.add').text("Inserting....");
                      },
                      success: function(data){
                          $('.add').prop("disabled",false);
                          $('.add').text("Add"); 
                          if(data == 'success'){
                              alert(username+" Added Successfully");
                              $("#insert")[0].reset();
                              $("#dynamicModal1").modal('hide');
                              location.reload();
                           }
                          if(data == 'duplicate'){
                              alert("Username already exists, Please Enter Unique Username");
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
                    alert("Please Select Usertype");
                    $('#usertype').focus();
                }
            }
            else{
                alert("Please Enter Passowrd");
                $('#pwd').focus();
            }
        }
        else{
            alert("Please Enter Username");
            $("#username").focus();
        }
        return false;
}  
    
function update(){
        var id = $('#id').val().trim();
        var username = $('#username').val().trim();
        var pwd = $('#pwd').val().trim();
        var usertype = $('#usertype').val().trim();
        
        if(username !== ""){
            if(pwd !== ""){
                if(usertype !== ""){
                    $.ajax({

                      url: 'updateuser.php',
                      type: 'POST',
                      data:{id:id,username:username,pwd:pwd,usertype:usertype,
                      updateuser:"updateuser"},
                      beforeSend: function(){
                          $('.update').prop("disabled",true);
                          $('.update').text("Updating....");
                      },
                      success: function(data){
                          $('.update').prop("disabled",false);
                          $('.update').text("Update"); 
                          if(data == 'success'){
                              alert("User Updated Successfully");
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
                    alert("Please Select Usertype");
                    $('#usertype').focus();
                }
            }
            else{
                alert("Please Enter Passowrd");
                $('#pwd').focus();
            }
        }
        else{
            alert("Please Enter Username");
            $("#username").focus();
        }
        return false;
    }
</script>