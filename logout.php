<?php 
    session_start();

    //set status to invalid
    $_SESSION['status'] = 'invalid';
    // Destroy session

    unset($_SESSION['username']);

    //redirect to login form
    header('location: login_form.php');
?>