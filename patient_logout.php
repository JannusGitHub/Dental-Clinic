<?php 
    session_start();
    // $username = $_SESSION['username'];
    // echo "<script>alert('$username')</script>";
    //set status to invalid
    // Destroy session

    unset($_SESSION['patient_status']);

    //redirect to login form
    header('location: patient_login.php');
    exit();
?>