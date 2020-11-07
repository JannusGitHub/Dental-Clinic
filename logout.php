<?php 
    session_start();
    // Destroy session
    
    if(session_destroy()){
        session_unset();
        
        header('location: login_form.php');
    }

?>