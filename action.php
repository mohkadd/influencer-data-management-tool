<?php 

include "config-pdo.php";
include "functions/functions.php";
if($_POST['action'] == "Load"){
    $table_data = "SELECT * FROM userdata";
    $stmt1 = $con->prepare($table_data);
    $stmt1->execute();
    $result = $stmt1->fetchAll();
    $output = '';
    $output .= '
    <table class="table table-bordered table-condensed dataTable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>User ID</th>
                    <th>Email ID</th>
                    <th>Contact No.</th>
                    <th>Marketing Activity</th>
                    <th>Industry Category</th>
                    <th>Target Audience</th>
                    <th>Age Group</th>
                    <th>Budget</th>
                    <th>Complete</th>
                    <th>Submitted</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Sr. No.</th>
                    <th>User ID</th>  
                    <th>Email ID</th>
                    <th>Contact No.</th>
                    <th>Marketing Activity</th>
                    <th>Industry Category</th>
                    <th>Target Audience</th>
                    <th>Age Group</th>
                    <th>Budget</th>
                    <th>Complete</th>
                    <th>Submitted</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
    ';
    if($stmt1->rowCount() > 0){
        foreach($result as $row){
            $output .= '
            <tr>
            <td>'.$row->id.'</td>
            <td>'.$row->userid.'</td>
            <td>'.decrypt($row->email).'</td>
            <td>'.decrypt($row->contact).'</td>
            <td>'.$row->activity.'</td>
            <td>'.$row->industry.'</td>
            <td>'.$row->audience.'</td>
            <td>'.$row->agegroup.'</td>
            <td>'.$row->budget.'</td>
            <td>'.$row->date.'</td>
            <td>'.$row->submitted.'</td>
            <td>'.$row->complete.'</td>
            <td>'.$row->mode.'</td>
            <td>'.$row->status.'</td>
            </tr>
            ';
        }
    }
    else
    {
       $output .= '
        <tr>
         <td>Data not Found</td>
        </tr>
       ';
    }
    $output .= '</tbody></table>';
    echo $output;
}
?>