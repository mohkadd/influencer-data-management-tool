<!--
<center>
    <img class='card-img-top img-responsive img-thumbnail text-center' style='width:200px;' src='images/airtel.jpg' alt='Card image cap'>
</center>
-->
<?php 
include 'config-pdo.php';

if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = htmlspecialchars($_REQUEST['id']);
    $query = "SELECT * FROM city WHERE id = '$id'";
    $stmt1 = $con->prepare($query);
    $stmt1->execute();
    $count = $stmt1->rowCount();
//   if ($run_users) {
    if ($count == 1) {
      if ($row = $stmt1->fetch()) {
        $output = "
         
                    <form method='POST' id='edit' name='edit' action='updatecity.php'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class='form-group'>
                              <label for='title'>City Name <strong class='text-danger'>**</strong></label>
                              <input type='hidden' id='id' name='id' value='$row->id'>
                              <input type='text' id='city_name' name='city_name' class='form-control' placeholder='Enter City Name' value='".$row->name."' required>
                            </div>
                          </div>";
        

            $output .=    "                           
                    </div>
                    <button class='btn btn-primary update' onclick='return update()' type='submit' name='updatecity' id='updatecity'>Update</button>
                    </form>
            ";
          echo $output;
      }
    }
}
?>