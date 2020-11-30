<?php 
    session_start();
    // $username = $_SESSION['username'];
    // echo "<script>alert('$username')</script>";
    //set status to invalid
    $_SESSION['status'] = 'invalid';
    // Destroy session

    unset($_SESSION['username']);

    //redirect to login form
    header('location: patient_login.php');
?>