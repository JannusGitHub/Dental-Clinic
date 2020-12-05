<?php
require('./admin/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Mapolon Dental Clinic</title>

    <!-- CSS files -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/datatables.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div class="login-form">
        <form id="patientLoginForm" method="POST">
        <div class="logo" style="width: 130px; margin: 0 auto 0.8rem;"><img src="./img/Mapolon-Logo-White.png" alt="Mapolon Logo"></div>
            <h2 class="text-center">Patient Login</h2>
            <p class="form-message text-center"></p>
            <div class="form-group">
                <input type="text" id="username" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit" id="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
            </div>
            <div class="text-center">
                <p class="text-white">Don't have an account? <a class="text-white" href="patient_registration.php">Click here!</a></p>
            </div>
        </form>
            
    </div>



<style>
    body {
        height: 100%;   
    }

    /*================FORM VALIDATION STYLE================*/
    .form-error{
        margin-top: 10px;
        color: red;
    }

    .input-error{
        box-shadow: 0 0 5px red;
    }

    .icon{
        font-size:60px;
        color: white;
    }

    .form-group{
        margin-bottom: 50px;
    }
    .form-control {
        min-height: 41px;
        background: #f2f2f2;
        box-shadow: none !important;
        border: transparent;
    }
    .form-control:focus {
        background: #e2e2e2;
    }
    .form-control, .btn {        
        border-radius: 2px;
    }
    .login-form {
        width: 400px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .login-form h2 {
        margin: 5px 0;
        color: #fff;
    }
    .login-form form {
        height: 550px;
        color: #7a7a7a;
        border-radius: 3px;
        margin-bottom: 0px;
        background: #fff;
        background: linear-gradient(#00c6ff, #0072ff);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 15px 30px 0;
    }
    .login-form .btn {        
        font-size: 16px;
        font-weight: bold;
        background: linear-gradient(#00c6ff, #0072ff);
        border: none;
        outline: none !important;
    }

    .login-form a {
        color: #fff;
        text-decoration: underline;
    }
    .login-form a:hover {
        text-decoration: none;
    }
    .login-form form a {
        color: #7a7a7a;
        text-decoration: none;
    }
    .login-form form a:hover {
        text-decoration: underline;
    }
    </style>


    <!-- JS files -->
    <script src="./js/jquery.js"></script>
    <!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.dataTables.js"></script>

    <!-- Icons files -->
    <script src="./js/all.js"></script>
    
    <script>
        $(document).ready(function(){
            $('#patientLoginForm').submit(function(event){
                event.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();
                var submit = $('#submit').val();
                $('.form-message').load('patient_login_server.php', {
                    username: username,
                    password: password,
                    submit: submit
                });
            });
        });
    </script>
</body><!--Body Ends-->
</html>
