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
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div class="wrapper">
        <header class="header">
            <nav class="site-navbar">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if($page =='index'){echo 'active';} ?>">
                        <a class="nav-link" href="/Dental-Clinic/patient_dashboard.php">&nbsp;<i class="fas fa-tachometer-alt icon"></i><span class="link-text">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Dental-Clinic/patient_appointment.php">&nbsp;<i class="fas fa-calendar-check icon"></i><span class="link-text">Appointment Management&nbsp;&nbsp;<i class="fas fa-caret-down"></i></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapseAppointment" role="button" aria-expanded="false" aria-controls="collapseExample">&nbsp;<i class="fas fa-user icon"></i><span class="link-text">&nbsp;Profile Management</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user-cog icon"></i><span class="link-text">Change Password</span></a>
                    </li>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="#">&nbsp;<i class="fas fa-clipboard-list icon"></i><span class="link-text">&nbsp;&nbsp;&nbsp;Report Management&nbsp;&nbsp;<i class="fas fa-caret-down"></i></span></a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="patient_logout.php"><i class="fas fa-sign-out-alt icon"></i><span class="link-text">Logout</span></a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>

    <main>

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
