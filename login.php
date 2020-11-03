<?php 
    require('./admin/connection.php');

    $username =$_POST['username'];
    $password = $_POST['password'];

    if($connection->connect_error){
        die("Failed to connect : " .$connection->connect_error);
    }else{
        $query = "SELECT * FROM patient_table WHERE username = '$username'";
        $result = $connection->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if($row['password'] === $password){
                echo '<script type="text/javascript">alert("Success")</script>';
                header('Location: ./admin/patient.php');
            }else{
                echo '<script>alert("Invalid Username or Password")</script>';
                header('Location: login_form.php');
            }
        }else{
            echo '<script type="text/javascript">alert("Invalid Username or Password")</script>';
            header('Location: login_form.php');
        }
    }

?>