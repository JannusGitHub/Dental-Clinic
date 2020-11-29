<?php
require('./admin/connection.php');

if(isset($_POST['key'])){
    //retrieve row data inside the fields
    //pass this data inside the fields of modal when edit button is clicked
    if($_POST['key'] == 'getRowData'){
        $rowID = $connection->real_escape_string($_POST['rowID']);
        if($rowID !== ''){
            $query = $connection->query("SELECT username, birthday, age, mobile_number, full_address, gender, nickname, occupation FROM patient_table WHERE id='$rowID'");
            $result = $query->fetch_array();
            $jsonArray = array(
                'username' => $result['username'],
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
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $mobileNumber = $_POST['mobileNumber'];
    $fullAddress = $_POST['fullAddress'];
    $gender = $_POST['gender'];
    $nickname = $_POST['nickname'];
    $occupation = $_POST['occupation'];
    $rowID = $_POST['rowID'];
    
    $errorEmpty = false;
    $errorNumber = false;
    $errorUsername = false;
    $numberValidation = "((^(\+)(\d){12}$)|(^\d{11}$))"; //mobile number regular expression pattern

    if(empty($username) || empty($birthday) || empty($age) || empty($mobileNumber) || empty($fullAddress) || empty($gender) || empty($nickname) || empty($occupation)){
        echo "<span class='form-error'>Please fill required fields</span>";
        $errorEmpty = true;
    }else if(!preg_match($numberValidation, $mobileNumber)){
        echo "<span class='form-error'>Please use area code i.e. starts with +63927.. or 0927..</span>";
        $errorNumber = true;
    }
    else{
        $sql = "SELECT * FROM patient_table WHERE username = '$username'";
        $result = $connection->query($sql);

        //validate username
        if($result->num_rows == 1){
            echo "<span class='form-error'>This username is already taken</span>";
            $errorUsername = true;
        }else{
            $query = "UPDATE patient_table SET username ='$username', birthday ='$birthday', age ='$age', mobile_number ='$mobileNumber', full_address ='$fullAddress', gender ='$gender', nickname ='$nickname', occupation ='$occupation' WHERE id='$rowID'";
            $result = $connection->query($query);
                // $username = $row['username'];
                // echo "<span class='form-success'>Successfully Updated</span>";
                echo ("<script>alert('Successfully Updated');</script>");
                echo ("<script>window.location.href='/Dental-Clinic/patient_login.php'</script>");
                
        }

        
    }
}else{
    header('Content-Type: application/json');
    echo "<span class='form-error'>Ooops! There was an error!</span>";
}

?>

<script>
    $('#username, #birthday, #age, #mobile-number, #full-address, #gender, #nickname, #occupation').removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorNumber = "<?php echo $errorNumber; ?>";
    var errorUsername = "<?php echo $errorUsername; ?>";

    if(errorEmpty == true){
        $("#username, #birthday, #age, #mobile-number, #full-address, #gender, #nickname, #occupation").addClass("input-error");
    }

    if(errorNumber == true){
        $('#mobile-number').addClass('input-error');
    }

    if(errorUsername == true){
        $('#username').addClass('input-error');
    }

    //clear all fields
    if(errorEmpty == false && errorNumber == false && errorUsername == false){
        $('#username, #birthday, #age, #mobile-number, #full-address, #gender, #nickname, #occupation').val("");
    }
</script>