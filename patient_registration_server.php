<?php
require('./admin/connection.php');

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $mobileNumber = $_POST['mobileNumber'];
    $fullAddress = $_POST['fullAddress'];
    $gender = $_POST['gender'];
    $nickname = $_POST['nickname'];
    $occupation = $_POST['occupation'];

    $errorEmpty = false;
    $errorNumber = false;
    $errorUsername = false;
    $errorPassword = false;
    $numberValidation = "((^(\+)(\d){12}$)|(^\d{11}$))"; //mobile number regular expression pattern

    if(empty($username) || empty($password) || empty($birthday) || empty($age) || empty($mobileNumber) || empty($fullAddress) || empty($gender) || empty($nickname) || empty($occupation)){
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
        //validate password
        } elseif(strlen(trim($_POST["password"])) < 8){
            echo "<span class='form-error'>Password must have atleast 8 characters</span>";
            $errorPassword = true;
        }else{
            $query = "INSERT INTO patient_table (username, password, birthday, age, mobile_number, full_address, gender, nickname, occupation) VALUES ('$username', '" .md5($password). "', '$birthday', '$age', '$mobileNumber', '$fullAddress', '$gender', '$nickname', '$occupation')";

            $result = $connection->query($query);
            echo "<span class='form-success'>Registered Successfully</span>";
        }

        
    }
}else{
    echo "<span class='form-error'>Ooops! There was an error!</span>";
}

?>

<script>
    $('#username, #password, #birthday, #age, #mobile-number, #full-address, #gender, #nickname, #occupation').removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorNumber = "<?php echo $errorNumber; ?>";
    var errorUsername = "<?php echo $errorUsername; ?>";
    var errorPassword = "<?php echo $errorPassword; ?>";

    if(errorEmpty == true){
        $("#username, #password, #birthday, #age, #mobile-number, #full-address, #gender, #nickname, #occupation").addClass("input-error");
    }

    if(errorNumber == true){
        $('#mobile-number').addClass('input-error');
    }

    if(errorUsername == true){
        $('#username').addClass('input-error');
    }

    if(errorPassword == true){
        $('#password').addClass('input-error');
    }

    //clear all fields
    if(errorEmpty == false && errorNumber == false && errorUsername == false && errorPassword == false){
        $('#username, #password, #birthday, #age, #mobile-number, #full-address, #gender, #nickname, #occupation').val("");
    }
</script>