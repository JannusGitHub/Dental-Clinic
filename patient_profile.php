<?php 
    require('./admin/connection.php');
    require('./includes/patient_auth_session.php');

    if(!isset($_SESSION['user']))
    {
        $_SESSION['user'] = session_id(); //generate current session_id for the current user
    }
    $session_uid = $_SESSION['user'];  // set session user to session_uid  


    $username = $_SESSION['patient_username'];

    //fetch data from the database of patient table and pass the value inside the select tag
    $patientQuery = "SELECT * FROM patient_table WHERE username = '$username'";
    $patientResult = $connection->query($patientQuery);
    
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
        <form id="patientProfileForm" action="patient_profile_server.php" method="POST">
            <div class="container mt-2 ml-2" style="overflow-x: hidden;">
                <div class="row border-left" style="border-width: 3px !important;">
                    <div class="col-7">
                        <h4>Update your profile</h4>
                        <p class="d-flex align-items-center mb-0"><i class="fas fa-info-circle fa-2x icon align-items-center"></i>&nbsp;Note: </p>
                        <p class="mb-4">After the submission of this form, you will be directed to the login page to ensure that all your Session is updated.</p>
                        <p class="form-message text-left"></p>

                        <?php while($patientRow = $patientResult->fetch_array()):;?>
                            <input type="hidden" id="rowID" value="<?php echo $patientRow['id']; ?>">
                        <?php endwhile;?>
                        
                        <div class="form-group">
                            <input type="text" id="username" class="form-control" name="username" placeholder="Username" autocomplete="off">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="date" id="birthday" class="form-control" name="birthday" placeholder="Birthday" autocomplete="off">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <input type="number" id="age" class="form-control" name="age" placeholder="Age" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" id="mobile-number" class="form-control" name="mobile-number" placeholder="Mobile #" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" id="full-address" class="form-control" name="full-address" placeholder="Full Address" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" id="gender" class="form-control" name="gender" placeholder="Gender" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" id="nickname" class="form-control" name="nickname" placeholder="Nickname">
                        </div>
                        <div class="form-group">
                            <input type="text" id="occupation" class="form-control" name="occupation" placeholder="Occupation" autocomplete="off">
                        </div>
                    </div>
                </div>
                <button type="submit" id="submit" class="btn button my-3 ml-1 pull-right btn-md" id="updateBtn">Update</button>
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
            $('#patientProfileForm').on('load',function(event){
                event.preventDefault();
                var rowID = $('#rowID').val();
                $.ajax({
                    method: 'POST',
                    url: 'patient_profile_server.php',
                    dataType: 'json',
                    data: {
                        key: 'getRowData',
                        rowID: rowID
                    },
                    success: function(data){
                        //catch/retrieve the data in the row
                        $('#rowID').val(rowID);
                        $('#username').val(data.username);
                        $('#birthday').val(data.birthday);
                        $('#age').val(data.age);
                        $('#mobile-number').val(data.mobileNumber);
                        $('#full-address').val(data.fullAddress);
                        $('#gender').val(data.gender);
                        $('#nickname').val(data.nickname);
                        $('#occupation').val(data.occupation);
                    }
                });
            });

            
            $('#patientProfileForm').on('submit', function(event){
                event.preventDefault();
                var username = $('#username').val();
                var birthday = $('#birthday').val();
                var age = $('#age').val();
                var mobileNumber = $('#mobile-number').val();
                var fullAddress = $('#full-address').val();
                var gender = $('#gender').val();
                var nickname = $('#nickname').val();
                var occupation = $('#occupation').val();
                var submit = $('#submit').val();
                var rowID = $('#rowID').val();

                $('.form-message').load('patient_profile_server.php', {
                    username: username,
                    birthday: birthday,
                    age: age,
                    mobileNumber: mobileNumber, 
                    fullAddress: fullAddress,
                    gender: gender,
                    nickname: nickname,
                    occupation: occupation,
                    rowID: rowID,
                    submit: submit
                });
            });

        });
    </script>

    
<?php 
    include('./includes/footer.php');
?>