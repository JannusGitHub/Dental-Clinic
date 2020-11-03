<?php
//Require connection
require("connection.php");



if(isset($_POST['key'])){
    //retrieve row data inside the fields
    //pass this data inside the fields of modal when edit button is clicked
    if($_POST['key'] == 'getRowData'){
        $rowID = $connection->real_escape_string($_POST['rowID']);
        if($rowID !== ''){
            $query = $connection->query("SELECT username, password, birthday, age, mobile_number, full_address, gender, nickname, occupation FROM patient_table WHERE id='$rowID'");
            $result = $query->fetch_array();
            $jsonArray = array(
                'username' => $result['username'],
                'password' => $result['password'],
                'birthday' => $result['birthday'],
                'age' => $result['age'],
                'mobileNumber' => $result['mobile_number'],
                'fullAddress' => $result['full_address'],
                'gender' => $result['gender'],
                'nickname' => $result['nickname'],
                'occupation' => $result['occupation']
            );
    
            exit(json_encode($jsonArray));
        }
    }


    //==================RELOAD/VIEW==================
    //view/refresh data when new record has been saved
    if($_POST['key'] == 'viewData'){

        $result = $connection->query("SELECT * FROM patient_table ORDER BY id DESC");
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
                        <td id="username_'.$row["id"].'">'.$row["username"].'</td>
                        <td>'.$row["password"].'</td>
                        <td>'.$row["birthday"].'</td>
                        <td>'.$row["age"].'</td>
                        <td>'.$row["mobile_number"].'</td>
                        <td>'.$row["full_address"].'</td>
                        <td>'.$row["gender"].'</td>
                        <td>'.$row["nickname"].'</td>       
                        <td>'.$row["occupation"].'</td>
                    </tr>
                ';
            }
            exit($data);
        }
    }
    

    //==================DELETE==================
    if ($_POST['key'] == 'deleteRow') {
        $rowID = $connection->real_escape_string($_POST['rowID']);
        $connection->query("DELETE FROM patient_table WHERE id='$rowID'");
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
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);
        $birthday = $connection->real_escape_string($_POST['birthday']);
        $age = $connection->real_escape_string($_POST['age']);
        $mobileNumber = $connection->real_escape_string($_POST['mobileNumber']);
        $fullAddress = $connection->real_escape_string($_POST['fullAddress']);
        $gender = $connection->real_escape_string($_POST['gender']);
        $nickname = $connection->real_escape_string($_POST['nickname']);
        $occupation = $connection->real_escape_string($_POST['occupation']);

        if(isNotEmpty($username) && isNotEmpty($password) && isNotEmpty($birthday)
        && isNotEmpty($age) && isNotEmpty($mobileNumber) && isNotEmpty($fullAddress) 
        && isNotEmpty($gender) && isNotEmpty($nickname) && isNotEmpty($occupation)){
            $query = "INSERT INTO patient_table (username, password, birthday, age, mobile_number, full_address, gender, nickname, occupation) VALUES ('$username', '$password', '$birthday', '$age', '$mobileNumber', '$fullAddress', '$gender', '$nickname', '$occupation')";
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
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);
        $birthday = $connection->real_escape_string($_POST['birthday']);
        $age = $connection->real_escape_string($_POST['age']);
        $mobileNumber = $connection->real_escape_string($_POST['mobileNumber']);
        $fullAddress = $connection->real_escape_string($_POST['fullAddress']);
        $gender = $connection->real_escape_string($_POST['gender']);
        $nickname = $connection->real_escape_string($_POST['nickname']);
        $occupation = $connection->real_escape_string($_POST['occupation']);
        $rowID = $connection->real_escape_string($_POST['rowID']);
        if(isNotEmpty($username) && isNotEmpty($password) && isNotEmpty($birthday)
        && isNotEmpty($age) && isNotEmpty($mobileNumber) && isNotEmpty($fullAddress) 
        && isNotEmpty($gender) && isNotEmpty($nickname) && isNotEmpty($occupation)){
            $connection->query("UPDATE patient_table SET username ='$username', password ='$password', birthday ='$birthday', age ='$age', mobile_number ='$mobileNumber', full_address ='$fullAddress', gender ='$gender', nickname ='$nickname', occupation ='$occupation' WHERE id='$rowID'");
                exit('Successfully Updated');
        }
    }
}


// $option = (isset($_POST['option'])) ? $_POST['option'] : '';
// $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';

// switch($option){
//     case 4:
//         $query = "SELECT * FROM `patient_table`";
//         $result = $connection->query($query);
//         $result->fetch_all(MYSQLI_ASSOC);
//         break;
// }

// print json_encode($result, JSON_UNESCAPED_UNICODE);//Send the final array format to AJAX = envio el array final el formato json a AJAX
// $connection=null;



?>