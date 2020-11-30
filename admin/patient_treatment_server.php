<?php
//Require connection
require("connection.php");


if(isset($_POST['key'])){
    //retrieve row data inside the fields
    //pass this data inside the fields of modal when edit button is clicked
    if($_POST['key'] == 'getRowData'){
        $rowID = $connection->real_escape_string($_POST['rowID']);
        if($rowID !== ''){
            $query = $connection->query("SELECT patient_table.nickname, patient_treatment_table.treatment_date, patient_treatment_table.tooth_number, patient_treatment_table.findings, patient_treatment_table.procedures, patient_treatment_table.description 
            FROM patient_treatment_table
            LEFT JOIN patient_table ON patient_table.id = patient_treatment_table.patient_id
            WHERE patient_treatment_table.id= '$rowID'
            ORDER BY patient_treatment_table.id ASC");

            $result = $query->fetch_array();
            $jsonArray = array(
                'patientName' => $result['nickname'],
                'treatmentDate' => $result['treatment_date'],
                'toothNumber' => $result['tooth_number'],
                'findings' => $result['findings'],
                'procedures' => $result['procedures'],
                'description' => $result['description'],
            );
    
            exit(json_encode($jsonArray));
        }
    }


    //==================RELOAD/VIEW==================
    //view/refresh data when new record has been saved
    if($_POST['key'] == 'viewData'){

        $result = $connection->query("SELECT patient_table.id, patient_treatment_table.treatment_date, patient_treatment_table.tooth_number, patient_treatment_table.findings, patient_treatment_table.procedures, patient_treatment_table.description 
        FROM patient_treatment_table 
        LEFT JOIN patient_table ON patient_table.id = patient_treatment_table.patient_id
        ORDER BY patient_treatment_table.id ASC");
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
                        <td id="treatment_date'.$row["id"].'">'.$row["treatment_date"].'</td>
                        <td>'.$row["tooth_number"].'</td>
                        <td>'.$row["findings"].'</td>
                        <td>'.$row["procedures"].'</td>
                        <td>'.$row["description"].'</td>
                    </tr>
                ';
            }
            exit($data);
        }
    }


    //==================DELETE==================
    if ($_POST['key'] == 'deleteRow') {
        $rowID = $connection->real_escape_string($_POST['rowID']);
        $connection->query("DELETE FROM patient_treatment_tab WHERE id='$rowID'");
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
        $treatmentDate = $connection->real_escape_string($_POST['treatmentDate']);
        $patientName = $connection->real_escape_string($_POST['patientName']);
        $toothNumber = $connection->real_escape_string($_POST['toothNumber']);
        $findings = $connection->real_escape_string($_POST['findings']);
        $procedures = $connection->real_escape_string($_POST['procedures']);
        $description = $connection->real_escape_string($_POST['description']);

        if(isNotEmpty($treatmentDate) && isNotEmpty($toothNumber) && isNotEmpty($findings)
        && isNotEmpty($procedures) && isNotEmpty($description)){
            $query = "INSERT INTO patient_treatment_table (treatment_date, tooth_number, findings, procedures, description, patient_id) VALUES ('$treatmentDate', '$toothNumber', '$findings', '$procedures', '$description', (SELECT id FROM patient_table WHERE nickname = '$patientName'))";
            $result = $connection->query($query);
            if ($result) {
                exit('Successfully Inserted');
            } else {
                echo "Error: " . $query . "<br>" . $connection->error;
                exit("Error connecting to the database");
            }
        }
        
    }
}

?>