<?php 
    require('connection.php');
    require('../includes/auth_session.php');

    include('../includes/header.php');
    include('../includes/sidebar.php');
?>


    <main style="overflow-x: hidden;">
        <form id="changePasswordForm" action="change_password_server.php" method="POST">
            <div class="container m-2">
                <div class="row border-left" style="border-width: 3px !important;">
                    <div class="col-7">
                        <h3>Change Password</h3>
                        <p class="d-flex align-items-center mb-0"><i class="fas fa-info-circle fa-2x icon align-items-center"></i>&nbsp;Note: </p>
                        <p class="mb-4">After the submission of this form, you will be directed to the login page to ensure that all your Session is updated.</p>
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


<?php
    include('../includes/script.php');
?>


    <script>
        $(document).ready(function(){
            
            $('#changePasswordForm').on('submit', function(event){
                event.preventDefault();
                var currentPassword = $('#current-password').val();
                var newPassword = $('#new-password').val();
                var confirmPassword = $('#confirm-password').val();
                var saveBtn = $('#saveBtn').val();
                
                $('.form-message').load('change_password_server.php', {
                    currentPassword: currentPassword,
                    newPassword: newPassword,
                    confirmPassword: confirmPassword,
                    saveBtn: saveBtn
                });
            });

        });
    </script>


<?php
    include('../includes/footer.php');
?>