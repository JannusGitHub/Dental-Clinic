<?php
    session_start();
            try {
            if(!$_SESSION['patient_status']){
                //set status to invalid
                header("Location: ../Dental-Clinic/patient_login.php");
                // echo ("<script>window.location.href='/Dental-Clinic/login.php</script>");
                exit();

            }
        } catch (\Throwable $th) {
            throw $th;
        }
?>