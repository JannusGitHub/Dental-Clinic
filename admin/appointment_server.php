<?php
//Require connection
require("connection.php");



if(isset($_POST['key'])){
    //retrieve row data inside the fields
    //pass this data inside the fields of modal when edit button is clicked
    if($_POST['key'] == 'getRowData'){
        $rowID = $connection->real_escape_string($_POST['rowID']);
        if($rowID !== ''){
            $query = $connection->query("SELECT user_table.full_name, appointment_table.appointment_date, appointment_table.timeslot,
            appointment_table.patient_name, patient_table.mobile_number, appointment_table.status 
            FROM appointment_table, user_table, patient_table WHERE user_table.id = appointment_table.user_id AND patient_table.id = appointment_table.patient_id AND appointment_table.id = '$rowID'");

            $result = $query->fetch_array();
            $jsonArray = array(
                'fullName' => $result['full_name'],
                'appointmentDate' => $result['appointment_date'],
                'timeslot' => $result['timeslot'],
                'patientName' => $result['patient_name'],
                'mobileNumber' => $result['mobile_number'],
                'status' => $result['status']
            );
    
            exit(json_encode($jsonArray));
        }
    }


    //==================RELOAD/VIEW==================
    //view/refresh data when new record has been saved
    if($_POST['key'] == 'viewData'){

        $result = $connection->query("SELECT appointment_table.id, user_table.full_name, appointment_table.appointment_date, appointment_table.timeslot, 
		appointment_table.patient_name, appointment_table.patient_mobile_number, appointment_table.status 
		FROM appointment_table, user_table, patient_table WHERE user_table.id = appointment_table.user_id AND patient_table.id = appointment_table.patient_id 
		ORDER BY appointment_table.id DESC");
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
                        <td id="full_name'.$row["id"].'">'.$row["full_name"].'</td>
                        <td>'.$row["appointment_date"].'</td>
                        <td>'.$row["timeslot"].'</td>
                        <td>'.$row["patient_name"].'</td>
                        <td>'.$row["patient_mobile_number"].'</td>
                        <td>'.$row["status"].'</td>
                    </tr>
                ';
            }
            exit($data);
        }
    }


        //==================DELETE==================
        if ($_POST['key'] == 'deleteRow') {
            $rowID = $connection->real_escape_string($_POST['rowID']);
            $connection->query("DELETE FROM appointment_table WHERE id='$rowID'");
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
        $doctorName = $connection->real_escape_string($_POST['doctorName']);
        $appointmentDate = $connection->real_escape_string($_POST['appointmentDate']);
        $timeslot = $connection->real_escape_string($_POST['timeslot']);
        $patientName = $connection->real_escape_string($_POST['patientName']);
        $mobileNumber = $connection->real_escape_string($_POST['mobileNumber']);
        $status = $connection->real_escape_string($_POST['status']);
        $rowID = $connection->real_escape_string($_POST['rowID']);

        if(isNotEmpty($doctorName) && isNotEmpty($appointmentDate) && isNotEmpty($patientName) && isNotEmpty($mobileNumber) && isNotEmpty($status)){
            $query = "INSERT INTO appointment_table (appointment_date, timeslot, patient_name, patient_mobile_number, status, user_id, patient_id) VALUES ('$appointmentDate', '$timeslot', '$patientName','$mobileNumber', '$status', (SELECT id FROM user_table WHERE full_name = '$doctorName'), (SELECT id FROM patient_table WHERE nickname = '$patientName'))";
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
        $doctorName = $connection->real_escape_string($_POST['doctorName']);
        $appointmentDate = $connection->real_escape_string($_POST['appointmentDate']);
        $timeslot = $connection->real_escape_string($_POST['timeslot']);
        $patientName = $connection->real_escape_string($_POST['patientName']);
        $mobileNumber = $connection->real_escape_string($_POST['mobileNumber']);
        $status = $connection->real_escape_string($_POST['status']);
        $rowID = $connection->real_escape_string($_POST['rowID']);
        if(isNotEmpty($doctorName) && isNotEmpty($appointmentDate) && isNotEmpty($timeslot)
        && isNotEmpty($patientName) && isNotEmpty($mobileNumber) && isNotEmpty($status)){
            $connection->query("UPDATE appointment_table SET appointment_date ='$appointmentDate', timeslot ='$timeslot', patient_name = '$patientName', patient_mobile_number = '$mobileNumber', status ='$status' WHERE id='$rowID'");
                exit('Successfully Updated');
        }
    }

}
?>