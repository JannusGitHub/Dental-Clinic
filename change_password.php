<?php 
    require('./admin/connection.php');
    require('./includes/patient_auth_session.php');


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
    <link rel="stylesheet" href="./css/fullcalendar.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include('./includes/patient_sidebar.php'); ?>

    <main style="overflow-x: hidden;">
        <form id="changePasswordForm" action="patient_change_password_server.php" method="POST">
            <div class="container m-2">
                <div class="row border-left" style="border-width: 3px !important;">
                    <div class="col-7">
                        <h4>Change Password</h4>
                        <p class="form-message text-left"></p>
                        <label for="current-password">Current Password</label>
                        <div class="form-group">
                            <input type="password" id="current-password" class="form-control" name="current-password" placeholder="Current Password" autocomplete="off">
                        </div>
                        <label for="new-password">New Password</label>
                        <div class="form-group">
                            <input type="password" id="new-password" class="form-control" name="new-password" placeholder="New Password" autocomplete="off">
                        </div>
                        <label for="confirm-password">Confirm Password</label>
                        <div class="form-group mb-0">
                            <input type="password" id="confirm-password" class="form-control" name="confirm-password" placeholder="Confirm Password" autocomplete="off">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn button my-3 ml-1 pull-right btn-md" id="saveBtn">Save</button>
            </div>
        </form>
    </main>

    <style>
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

    <script src="./js/jquery.js"></script>
    <!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.dataTables.js"></script>
    <script src="./js/moment.min.js"></script>
    <script src="./js/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" crossorigin="anonymous"></script>

    <!-- Icons files -->
    <script src="./js/all.js"></script>

    <script>
        $(document).ready(function(){
            
            $('#changePasswordForm').on('submit', function(event){
                event.preventDefault();
                var currentPassword = $('#current-password').val();
                var newPassword = $('#new-password').val();
                var confirmPassword = $('#confirm-password').val();
                var saveBtn = $('#saveBtn').val();
                
                $('.form-message').load('patient_change_password_server.php', {
                    currentPassword: currentPassword,
                    newPassword: newPassword,
                    confirmPassword: confirmPassword,
                    saveBtn: saveBtn
                });
            });

        });
    </script>

    </body><!--Body Ends-->
</html>