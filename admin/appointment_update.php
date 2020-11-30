<?php 
    require('connection.php');
    require('../includes/auth_session.php');

    if(!isset($_SESSION['user']))
    {
        $_SESSION['user'] = session_id(); //generate current session_id for the current user
    }
    $session_uid = $_SESSION['user'];  // set session user to session_uid  
    $datetime_string = date('c',time()); 

    $patientName = $_SESSION['nickname'];
    $patientMobileNumber = $_SESSION['patientMobileNumber'];
    $status = 'Pending'; //default values of Status


    if(isset($_POST["id"])){
        $connection->query("UPDATE appointment_table set 
            title = '".mysqli_real_escape_string($connection,$_POST["title"])."', 
            start_time = '".mysqli_real_escape_string($connection,($_POST["start"]))."', 
            end_time = '".mysqli_real_escape_string($connection,($_POST["end"]))."'
            WHERE id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
        exit;
    }
?>