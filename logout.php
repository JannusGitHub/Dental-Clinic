<?php 
    session_start();
    // $username = $_SESSION['username'];
    // echo "<script>alert('$username')</script>";
    //set status to invalid
    unset($_SESSION['status']); 
    // Destroy session

    // unset($_SESSION['username_session']);

    // session_destroy();

    //redirect to login form
    header('location: login.php');
    exit();
?>