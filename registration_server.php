<?php
require('./admin/connection.php');

if(isset($_POST['submit'])){
    $fullname = $_POST['fullname'];
    $userRole = $_POST['userRole'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $mobileNumber = $_POST['mobileNumber'];
    $fullAddress = $_POST['fullAddress'];

    $errorEmpty = false;
    $errorNumber = false;
    $errorUsername = false;
    $errorPassword = false;
    $numberValidation = "((^(\+)(\d){12}$)|(^\d{11}$))";

    if(empty($fullname) || empty($userRole) || empty($username) || empty($password) || empty($birthday) || empty($age) || empty($mobileNumber) || empty($fullAddress)){
        echo "<span class='form-error'>Please fill required fields</span>";
        $errorEmpty = true;
    }else if(!preg_match($numberValidation, $mobileNumber)){
        echo "<span class='form-error'>Please use area code i.e. starts with +63927.. or 0927..</span>";
        $errorNumber = true;
    }
    else{

        //Validate username
            $sql = "SELECT id FROM user_table WHERE username = '$username'";
            $result = $connection->query($sql);

            if($result->num_rows == 1){
                echo "This username is already taken.";
                $errorUsername = true;
            } else{
                $username = trim($_POST["username"]);
            }

        // Validate password
        if(strlen(trim($_POST["password"])) < 8){
            echo "Password must have atleast 8 characters.";
            $errorPassword = true;
        } else{
            $password = trim($_POST["password"]);
        }

        echo "<span class='form-success'>Registered Successfully</span>";
    }
}else{
    echo "<span class='form-error'>Ooops! There was an error!</span>";
}

?>

<script>
    $('#full-name, #user-role, #username, #password, #birthday, #age, #mobile-number, #full-address').removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorNumber = "<?php echo $errorNumber; ?>";

    if(errorEmpty == true){
        $("#full-name, #user-role, #username, #password, #birthday, #age, #mobile-number, #full-address").addClass("input-error");
    }

    if(errorNumber == true){
        $('#mobile-number').addClass('input-error');
    }

    if(errorEmpty == false && errorNumber == false){
        $('#full-name, #user-role, #username, #password, #birthday, #age, #mobile-number, #full-address').val("");
    }
</script>