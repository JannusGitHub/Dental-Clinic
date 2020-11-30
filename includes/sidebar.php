<div class="wrapper">
        <header class="header">
            <nav class="site-navbar">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if($page =='index'){echo 'active';} ?>">
                        <a class="nav-link" href="../admin/index.php">&nbsp;<i class="fas fa-tachometer-alt icon"></i><span class="link-text">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapsePatient" role="button" aria-expanded="false" aria-controls="collapseExample">&nbsp;<i class="fas fa-user icon"></i><span class="link-text">&nbsp;&nbsp;Patient Management&nbsp;&nbsp;<i class="fas fa-caret-down"></i></span></a>
                        <div class="collapse" id="collapsePatient">
                            <div class="card card-body">
                                <a class="<?php if($page =='patient'){echo 'active';} ?>" href="../admin/patient.php">Add New Patient</a>
                                <a class="<?php if($page =='patient_treatment'){echo 'active';} ?>"href="../admin/patient_treatment.php">Add Patient Treatment</a>                                                                            
                                <a class="<?php if($page =='patient_bill'){echo 'active';} ?>" href="#">Add Patient Bill</a>                                
                            </div>
                        </div>
                    </li>
                    <li class="nav-item <?php if($page =='doctor'){echo 'active';} ?>">
                        <a class="nav-link" href="#">&nbsp;<i class="fas fa-user-md icon"></i><span class="link-text">&nbsp;&nbsp;Doctor Management&nbsp;&nbsp;<i class="fas fa-caret-down"></i></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapseAppointment" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-home icon"></i><span class="link-text">Appointment Management&nbsp;&nbsp;<i class="fas fa-caret-down"></i></span></a>
                        <div class="collapse" id="collapseAppointment">
                            <div class="card card-body">
                                <a class="<?php if($page =='view_appointment'){echo 'active';} ?>" href="../admin/view_appointment.php">View Appointment</a>                               
                                <a class="<?php if($page =='patient_appointment'){echo 'active';} ?>" href="../admin/patient_appointment.php">Add New Appointment</a>                               
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-users icon"></i><span class="link-text">User Management&nbsp;&nbsp;<i class="fas fa-caret-down"></i></span></a>
                    </li>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="#">&nbsp;<i class="fas fa-clipboard-list icon"></i><span class="link-text">&nbsp;&nbsp;&nbsp;Report Management&nbsp;&nbsp;<i class="fas fa-caret-down"></i></span></a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user-cog icon"></i><span class="link-text">Settings&nbsp;&nbsp;<i class="fas fa-caret-down"></i></span></a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt icon"></i><span class="link-text">Logout</span></a>
                    </li>
                </ul>
            </nav>
        </header>
</div>
