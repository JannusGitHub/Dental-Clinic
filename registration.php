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
        <form id="registerForm" action="registration_server.php" method="POST">
            <div class="text-center"><i class="fas fa-users icon"></i></div>
            <h5 class="text-center">Create your account</h5>
            <p class="form-message text-center"></p>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" id="full-name" class="form-control" name="full-name" placeholder="Full Name">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select  id="user-role" class="form-control" name="user-role"">
                            <option value="admin">Admin</option>
                            <option value="dentist">Dentist</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" id="username" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="date" id="birthday" class="form-control" name="birthday" placeholder="Birthday">
            </div>
            <div class="form-group">
                <input type="text" id="age" class="form-control" name="age" placeholder="Age">
            </div>
            <div class="form-group">

                <input type="text" id="mobile-number" class="form-control" name="mobile-number" placeholder="Mobile #">
            </div>
            <div class="form-group">
                <input type="text" id="full-address" class="form-control" name="full-address" placeholder="Full Address">
            </div>
            <div class="form-group d-flex align-items-center">
                <button type="submit" id="submit" name="submit" class="btn button btn-md mr-auto">Register</button>
                <a href="login_form.php">Click here to login</a>
            </div>
        </form>
    </div>



<style>
    body {
        height: 100vh;
        width: 100%;
        background: linear-gradient(#00c6ff, #0072ff);
        
    }
    .icon{
        font-size:60px;
        /* background: -webkit-linear-gradient(#00c6ff, #0072ff);
        background: -webkit-linear-gradient(#00c6ff, #0072ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent; */
        display: initial;
    }

    .login-form{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form{
        max-width: 50%;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
    }

    .button{
        width: 40%;
    }


    /*================FORM VALIDATION STYLE================*/
    .form-error{
        margin-top: 10px;
        color: red;
    }

    .form-success{
        color: green;
    }

    .input-error{
        box-shadow: 0 0 5px red;
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
            $('#registerForm').submit(function(event){
                event.preventDefault();
                var fullname = $('#full-name').val();
                var userRole = $('#user-role').val();
                var username = $('#username').val();
                var password = $('#password').val();
                var birthday = $('#birthday').val();
                var age = $('#age').val();
                var mobileNumber = $('#mobile-number').val();
                var fullAddress = $('#full-address').val();
                var submit = $('#submit').val();
                $('.form-message').load('registration_server.php', {
                    fullname: fullname,
                    userRole: userRole,
                    username: username,
                    password: password,
                    birthday: birthday,
                    age: age,
                    mobileNumber: mobileNumber, 
                    fullAddress: fullAddress,
                    submit: submit
                });
            });
        });
    </script>
</body><!--Body Ends-->
</html>
