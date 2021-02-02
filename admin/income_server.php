<?php
//Require connection
require("connection.php");


if(isset($_POST["fromDate"], $_POST["toDate"])){

    $resultIncome = mysqli_query($connection, "
        SELECT SUM(amount_paid) AS Total_Income FROM patient_bill_table
        WHERE bill_date BETWEEN '" .$_POST["fromDate"]. "' AND '" .$_POST["toDate"]. "'
    "); 
    $rowIncome = mysqli_fetch_assoc($resultIncome); 
    $sumOfIncome = $rowIncome['Total_Income'];

    $output = '';
    $query = "
    SELECT * FROM patient_bill_table
    WHERE bill_date BETWEEN '" .$_POST["fromDate"]. "' AND '" .$_POST["toDate"]. "'
    ORDER BY id ASC
    ";
    $result = mysqli_query($connection, $query);
    $output .= '
        <table class="table table-responsive" id="table">
            <thead class="table-head">
                <tr>
                    <th>ID</th>
                    <th>Bill date</th>
                    <th>Payment Mode</th>
                    <th>Amount Paid</th>
                </tr>
            </thead>
        ';

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $output .='
                <tr>
                    <td>'. $row["id"] .'</td>
                    <td>'. $row["bill_date"] .'</td>
                    <td>'. $row["payment_mode"] .'</td>
                    <td style="padding-left: 16px;">'. $row["amount_paid"] .'</td>
                </tr>
            ';
        }
        $output .= '
            <tfoot>
                <tr>
                    <th colspan="3" style="padding-left: 0px;">Total Income</th>
                    <th id="total-income">'. $sumOfIncome .'</th>
                </tr>
            </tfoot>
        ';
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