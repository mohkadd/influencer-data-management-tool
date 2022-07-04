<!--
<center>
    <img class='card-img-top img-responsive img-thumbnail text-center' style='width:200px;' src='images/airtel.jpg' alt='Card image cap'>
</center>
-->
<?php 
include 'config-pdo.php';

if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = htmlspecialchars($_REQUEST['id']);
    $query = "SELECT * FROM admin WHERE id = '$id'";
    $stmt1 = $con->prepare($query);
    $stmt1->execute();
    $count = $stmt1->rowCount();
//   if ($run_users) {
    if ($count == 1) {
      if ($row = $stmt1->fetch()) {
          if($row->admin_type == 1){
              $word = "Super Admin";
          }
          if($row->admin_type == 2){
              $word = "Admin";
          }
          if($row->admin_type == 3){
              $word = "Viewer";
          }
          if($row->admin_type == 4){
              $word = "Scrapper";
          }
        $output = "
         
                    <form method='POST' id='edit' name='edit' action='updateuser.php'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='form-group'>
                              <label for='title'>Username <strong class='text-danger'>**</strong></label>
                              <input type='hidden' id='id' name='id' value='$row->id'>
                              <input type='text' id='username' name='username' value='$row->username' class='form-control' placeholder='Enter Username' required>
                            </div>
                          </div>
                        <div class='col-md-12'>
                            <div class='form-group'>
                              <label for='title'>Password <strong class='text-danger'>**</strong></label>
                              <input type='text' id='pwd' name='pwd' value='$row->password' class='form-control' placeholder='Enter Password' required>
                            </div>
                          </div>
                        <div class='col-md-12'>
                            <div class='form-group'>
                              <label for='title'>User Type <strong class='text-danger'>**</strong></label>
                              <select class='form-control' name='usertype' id='usertype' required>
                                  <option value=''>Please Select User Type</option>
                                  <option value='$row->admin_type' selected>$word</option>
                                  <option value='1'>Super Admin</option>
                                  <option value='2'>Admin</option>
                                  <option value='3'>Viewer</option>
                                  <option value='4'>Scrapper</option>
                              </select>
                            </div>
                          </div>
                    </div>
                    <button class='btn btn-primary update' onclick='return update()' type='submit' name='updateuser' id='updateuser'>Update</button>
                    </form>";
        

          echo $output;
      }
    }
}
?>