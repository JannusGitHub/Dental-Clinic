<?php
//Require connection
require("connection.php");


if(isset($_POST['key'])){
    //retrieve row data inside the fields
    //pass this data inside the fields of modal when edit button is clicked
    if($_POST['key'] == 'getRowData'){
        $rowID = $connection->real_escape_string($_POST['rowID']);
        if($rowID !== ''){
            $query = $connection->query("SELECT patient_table.nickname, patient_bill_table.bill_date, patient_bill_table.bill_type, patient_bill_table.payment_mode, patient_bill_table.amount_charge, patient_bill_table.amount_paid, patient_bill_table.balance
            FROM patient_bill_table, patient_table WHERE patient_table.id = patient_bill_table.patient_id 
            AND patient_bill_table.id = '$rowID'
            ORDER BY patient_bill_table.id DESC");

            $result = $query->fetch_array();
            $jsonArray = array(
                'patientName' => $result['nickname'],
                'billDate' => $result['bill_date'],
                'billType' => $result['bill_type'],
                'paymentMode' => $result['payment_mode'],
                'amountCharge' => $result['amount_charge'],
                'amountPaid' => $result['amount_paid'],
                'balance' => $result['balance']
            );
    
            exit(json_encode($jsonArray));
        }
    }


    //==================RELOAD/VIEW==================
    //view/refresh data when new record has been saved
    if($_POST['key'] == 'viewData'){

        $result = $connection->query("SELECT patient_bill_table.id, patient_bill_table.bill_date, patient_bill_table.bill_type, patient_bill_table.payment_mode, patient_bill_table.amount_charge, patient_bill_table.amount_paid, patient_bill_table.balance 
        FROM patient_bill_table 
        LEFT JOIN patient_table ON patient_table.id = patient_bill_table.patient_id
        ORDER BY patient_bill_table.id ASC");
        if ($result->num_rows > 0){
            $data = "";
            // output data of each row
            while($row = $result->fetch_array()) {
                $data .='
                    <tr>
                        <td class="d-flex"> <!--To align the button-->
                            <button class="btn button mr-1" onclick="edit('.$row["id"].')" id="edit'.$row["id"].'" value="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger" onclick="deleteRow('.$row["id"].')" id="delete'.$row["id"].'" ><i class="fas fa-trash-alt"></i></button>
                        </td>
                        <td>'.$row["id"].'</td>
                        <td id="bill_date'.$row["id"].'">'.$row["bill_date"].'</td>
                        <td>'.$row["bill_type"].'</td>
                        <td>'.$row["payment_mode"].'</td>
                        <td>'.$row["amount_charge"].'</td>
                        <td>'.$row["amount_paid"].'</td>
                        <td>'.$row["balance"].'</td>
                    </tr>
                ';
            }
            exit($data);
        }
    }


    //==================DELETE==================
    if ($_POST['key'] == 'deleteRow') {
        $rowID = $connection->real_escape_string($_POST['rowID']);
        $connection->query("DELETE FROM patient_bill_table WHERE id='$rowID'");
        exit('Successfully Deleted!');
    }


    //Validation
    function isNotEmpty($caller) {
        if ($caller == '') {
            echo 'Please fill all the required fields';
            return false;
        } else{
            return true;
        }
    }
    //==================INSERT==================
    //add new data when manageData('addNew'); btn is clicked
    if($_POST['key'] == 'addNew'){
        $patientName = $connection->real_escape_string($_POST['patientName']);
        $billDate = $connection->real_escape_string($_POST['billDate']);
        $billType = $connection->real_escape_string($_POST['billType']);
        $paymentMode = $connection->real_escape_string($_POST['paymentMode']);
        $amountCharge = $connection->real_escape_string($_POST['amountCharge']);
        $amountPaid = $connection->real_escape_string($_POST['amountPaid']);
        $balance = $connection->real_escape_string($_POST['balance']);

        if(isNotEmpty($billDate) && isNotEmpty($billType) && isNotEmpty($paymentMode)
        && isNotEmpty($amountCharge) && isNotEmpty($amountPaid) && isNotEmpty($balance)){
            $query = "INSERT INTO patient_bill_table (bill_date, bill_type, payment_mode, amount_charge, amount_paid, balance, patient_id) VALUES ('$billDate', '$billType', '$paymentMode', '$amountCharge', '$amountPaid', '$balance', (SELECT id FROM patient_table WHERE nickname = '$patientName'))";
            $result = $connection->query($query);
            if ($result) {
                exit('Successfully Inserted');
            } else {
                echo "Error: " . $query . "<br>" . $connection->error;
                exit("Error connecting to the database");
            }
        }
    }


    //=================UPDATE==================
    //update row when the manageData('updateRow') btn is clicked
    if($_POST['key'] == 'updateRow'){
        $patientName = $connection->real_escape_string($_POST['patientName']);
        $billDate = $connection->real_escape_string($_POST['billDate']);
        $billType = $connection->real_escape_string($_POST['billType']);
        $paymentMode = $connection->real_escape_string($_POST['paymentMode']);
        $amountCharge = $connection->real_escape_string($_POST['amountCharge']);
        $amountPaid = $connection->real_escape_string($_POST['amountPaid']);
        $balance = $connection->real_escape_string($_POST['balance']);
        $rowID = $connection->real_escape_string($_POST['rowID']);
        if(isNotEmpty($patientName) && isNotEmpty($billDate) && isNotEmpty($billType)
        && isNotEmpty($paymentMode) && isNotEmpty($amountCharge) && isNotEmpty($amountPaid) && isNotEmpty($balance)){
            $connection->query("UPDATE patient_bill_table SET bill_date ='$billDate', bill_type ='$billType', payment_mode ='$paymentMode', amount_charge ='$amountCharge', amount_paid ='$amountPaid', balance = '$balance' WHERE id='$rowID'");
                exit('Successfully Updated');
        }else{
            exit('Not Updated');
        }
    }

}