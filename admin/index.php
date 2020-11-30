<?php

    require('../includes/auth_session.php');
    include('../includes/header.php');
    include('connection.php');

    //pass this value to sidebar.php .nav-item to active the class and highlight
    $page = 'index';

    include('../includes/sidebar.php');
    $query = "SELECT COUNT(1) FROM user_table";
    $result = $connection->query($query);
    $totalUser = $result->fetch_array();

    $queryPatient = "SELECT COUNT(1) FROM patient_table";
    $resultPatient = $connection->query($queryPatient);
    $totalPatient = $resultPatient->fetch_array();
    
?>
    <main>
        <div class="container">
            <h2 class="mt-1">Dashboard</h2>
            <p class="mb-4">Hi <?php echo $_SESSION['username']; ?>, welcome to Mapolon Dental Clinic</p>
            <div class="row mb-3">
                <div class="col-xl-4 col-lg-4 col-sm-6 py-2">
                    <div class="card text-white h-100">
                        <div class="card-body button bg-success">
                            <div class="text-center">
                                <i class="fa fa-user fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase text-center text-white mt-2">Total Patient</h6>
                            <h1 class="display-4 text-center text-white">
                                <?php echo $totalPatient[0]; ?>
                            </h1>
                            <p class="text-center"><a class="text-white" href="patient.php">View Patients&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-6 py-2">
                    <div class="card text-white h-100">
                        <div class="card-body button bg-success">
                            <div class="text-center">
                                <i class="fa fa-user fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase text-center text-white mt-2">Total User</h6>
                            <h1 class="display-4 text-center text-white">
                                <?php echo $totalUser[0]; ?>
                            </h1>
                            <p href="#" class="text-center"><a class="text-white" href="#">View Users&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-6 py-2">
                    <div class="card text-white h-100">
                        <div class="card-body button bg-success">
                            <div class="text-center">
                                <i class="fa fa-user fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase text-center text-white mt-2">Total Dentist</h6>
                            <h1 class="display-4 text-center text-white">
                                3
                            </h1>
                            <p href="#" class="text-center"><a class="text-white" href="#">View Dentists&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></p>
                        </div>
                    </div>
                </div>
            </div>
    </main>
<?php
    //Include the script first, before using any jquery script
    include('../includes/script.php');

    include('../includes/footer.php');

?>