<?php
//Require connection
require("connection.php");


if(isset($_POST["fromDate"], $_POST["toDate"])){
    $output = '';
    $query = "
        SELECT * FROM patient_table
        WHERE created_at BETWEEN '" .$_POST["fromDate"]. "' AND '" .$_POST["toDate"]. "'
        ORDER BY id ASC
    ";
    $result = mysqli_query($connection, $query);
    $output .= '
        <table class="table table-responsive" id="table">
            <thead class="table-head">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Created At</th>
                </tr>
            </thead>
        ';

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $output .='
                <tr>
                    <td>'. $row["id"] .'</td>
                    <td>'. $row["nickname"] .'</td>
                    <td>'. $row["created_at"] .'</td>
                </tr>
            ';
        }
    }else{
        $output .= '
            <tr>
                <td colspan="50">No record found</td>
            </tr>
        ';
    }
    $output .= '</table>';
    echo $output;
}

?>