<?php 
include 'config-pdo.php';
if (isset($_POST['genre']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$genre = htmlspecialchars($_REQUEST['genre']);
    $query = "SELECT DISTINCT city, COUNT(IF(influencer_category = 'Category A', id, NULL)) AS category_A, 
    COUNT(IF(influencer_category = 'Category B', id, NULL)) AS category_B, 
    COUNT(IF(influencer_category = 'Category C', id, NULL)) AS category_C FROM youtube 
    WHERE genre = '$genre' GROUP BY city ORDER BY city ASC;";
    $stmt1 = $con->prepare($query);
    $stmt1->execute();
    $response = "
    <div class='card mb-3' style='border:1px solid black;'>
        <div class='card-header bg-dark text-white'>
                <i class='fas fa-table'></i>
                City - Categorywise $genre Count
        </div>
        <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover table-bordered table-condensed' width='100%' cellspacing='0'>
                <thead class='bg-dark text-white'>
                    <tr>
                        <th>City</th>
                        <th>Category A</th>
                        <th>Category B</th>
                        <th>Category C</th>
                    </tr>
                </thead>
                <tbody>
    ";
      while ($row = $stmt1->fetch()) {
        $response .= "
         
                    <tr>
                        <td>$row->city</td>
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