<?php 
include 'config-pdo.php';
if (isset($_POST['genre']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$genre = htmlspecialchars($_REQUEST['genre']);
    $query = "SELECT DISTINCT state, COUNT(IF(influencer_category = 'CAT - A', id, NULL)) AS category_A, 
    COUNT(IF(influencer_category = 'CAT - B', id, NULL)) AS category_B, 
    COUNT(IF(influencer_category = 'CAT - C', id, NULL)) AS category_C FROM instagram 
    WHERE genre = '$genre' GROUP BY state ORDER BY state ASC;";
    $stmt1 = $con->prepare($query);
    $stmt1->execute();
    $response = "
    <div class='card mb-3' style='border:1px solid black;'>
        <div class='card-header bg-dark text-white'>
                <i class='fas fa-table'></i>
                State - Categorywise $genre Count
        </div>
        <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover table-bordered table-condensed' width='100%' cellspacing='0'>
                <thead class='bg-dark text-white'>
                    <tr>
                        <th>State</th>
                        <th>CAT - A</th>
                        <th>CAT - B</th>
                        <th>CAT - C</th>
                    </tr>
                </thead>
                <tbody>
    ";
      while ($row = $stmt1->fetch()) {
        $response .= "
         
                    <tr>
                        <td>$row->state</td>
                        <td>$row->category_A</td>
                        <td>$row->category_B</td>
                        <td>$row->category_C</td>
                    </tr>
                
            
            ";
      }
    $response .= "
                </tbody>
            </table>
         </div>
         </div>
    </div>
    ";
    echo $response;
//    }
}
?>