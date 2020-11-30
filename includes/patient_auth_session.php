<?php
    session_start();
    if($_SESSION['username'] == '' || $_SESSION['status'] == 'invalid' || empty($_SESSION['status'])){
        //set status to invalid
        $_SESSION['status'] = 'invalid';

        // since the username is not set in session, the user is not-logged-in
        // he is trying to access this page unauthorized
        unset($_SESSION['username']);

        header("Location: ./patient_login.php");
    } 
?>