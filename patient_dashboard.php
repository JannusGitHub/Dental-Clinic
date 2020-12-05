<?php
    require('./admin/connection.php');
    require('./includes/patient_auth_session.php');

    $patientName = $_SESSION['nickname'];
    //fetch data from the database of user table and pass the value inside the select tag, where user_role is dentist
    $appointmentQuery = "SELECT COUNT(1) FROM appointment_table WHERE patient_id = (SELECT id FROM patient_table WHERE nickname = '$patientName')";
    $appointmentResult = $connection->query($appointmentQuery);
    $totalAppointment = $appointmentResult->fetch_array();
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
    <?php include('./includes/patient_sidebar.php'); ?>

    
    <main>
        <div class="container-fluid">
            <h2 class="mt-1">Dashboard</h2>
            <p class="mb-4">Hi, welcome to Mapolon Dental Clinic</p>
            <div class="row mb-3">
                <div class="col-xl-4 col-lg-4 col-sm-6 py-2">
                    <div class="card text-white h-100">
                        <div class="card-body button bg-success">
                            <div class="text-center">
                                <i class="fa fa-user fa-4x"></i>
                            </div>
                            <h6 class="text-center text-white mt-2">Your total appointment</h6>
                            <h1 class="display-4 text-center text-white">
                                <?php echo $totalAppointment[0]; ?>
                            </h1>
                            <!-- <p class="text-center"><a class="text-white" href="patient.php">View Patients&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- JS files -->
    <script src="./js/jquery.js"></script>
    <!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.dataTables.js"></script>

    <!-- Icons files -->
    <script src="./js/all.js"></script>
    
    <style>
        .patientAppointmentTabs{
            margin: 5px 0 5px;
            padding: 5px;
        }

        #nav-tabs a{
            color: black;
        }

        #nav-tabs li:active{
            background: #dee2e6;
        }

        .tab-content .tab-pane{
            padding-top: 5px;
            padding-left: 10px;
            border-left: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
        }
        
        .container{
            padding-left: 5px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('ul li').click(function(){
                $(this).addClass('active')
                $(this).parent().children('li').not(this).removeClass('active');
            });
        });
    </script>
    
</body><!--Body Ends-->
</html>
