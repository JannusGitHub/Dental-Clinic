<?php
require('connection.php');
require('../includes/auth_session.php');

if(isset($_POST['saveBtn'])){
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $username = $_SESSION['username_session'];

    $errorEmpty = false;
    $errorPassword = false;
    $errorCurrentPassword = false;

    if(empty($currentPassword) || empty($newPassword) || empty($confirmPassword)){
        echo "<span class='form-error'>Please fill required fields</span>";
        $errorEmpty = true;
    }else if($newPassword != $confirmPassword){
        echo "<span class='form-error'>Password doesn't matched. Please try again.</span>";
        $errorPassword = true;
    }
    else{
        $sql = "SELECT * FROM user_table WHERE username = '".$username."'";
        $result = $connection->query($sql);
        $row = mysqli_fetch_object($result);

        //show the currentPassword input & row Password to match the values if it is equal
        // echo md5($currentPassword);
        // echo '<br>';
        // echo $row->password;

        //if currentPassword input is equal to old password
        if(md5($currentPassword) == $row->password){
            if(strlen(trim($newPassword)) < 8){
                echo "<span class='form-error'>Password must have atleast 8 characters</span>";
                $errorPassword = true;
            }else{
                $connection->query("UPDATE user_table SET password ='".md5($newPassword)."' WHERE username = '". $username ."'");
                echo "<script>alert('Password Successfully Changed');</script>";
                echo ("<script>window.location.href='../logout.php'</script>");
            }
        }else{
            echo "<span class='form-error'>Wrong Current Password! Please try again.</span>";
            $errorCurrentPassword = true;
        }
        

        
    }
}else{
    echo "<span class='form-error'>Ooops! There was an error!</span>";
}
?>


<script>
    $('#current-password, #new-password, #confirm-password').removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorPassword = "<?php echo $errorPassword; ?>";
    var errorCurrentPassword = "<?php echo $errorCurrentPassword; ?>";

    if(errorEmpty == true){
        $("#current-password, #new-password, #confirm-password").addClass("input-error");
    }

    if(errorPassword == true){
        $('#new-password, #confirm-password').addClass('input-error');
    }

    if(errorCurrentPassword == true){
        $('#current-password').addClass('input-error');
    }

    //clear all fields
    if(errorEmpty == false && errorPassword == false && errorCurrentPassword == false){
        $('#current-password, #new-password, #confirm-password').val("");
    }
</script>