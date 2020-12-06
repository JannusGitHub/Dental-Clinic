<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Mapolon Dental Clinic</title>

    <!-- CSS files -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    

</head>
<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" style="width: 80px" href="/Dental-Clinic/index.php"><img src="img/Mapolon-Logo-Blue.png" alt="">Mapolon Dental Clinic</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Our Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Dental-Clinic/patient_login.php"><span class="login">Sign In</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
                <div class="carousel-item active" data-interval="2000">
                    <div class="overlay-image" style="background-image: url(./img/teeth-checking.jpg);"></div>
                    <div class="carousel-caption">
                        <h3 class="text-white">We will take care of your teeth</h3>
                        <p>Mapolon Dental Clinic offers full range of dental services<br>
                        for both adults and children.</p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="2000">
                    <div class="overlay-image" style="background-image: url(./img/satisfied-patient.jpg);"></div>
                    <div class="carousel-caption">
                        <h3 class="text-white">We care for <span>YOUR SMILE</span></h3>
                        <p>Dentist is your primary care dental provider. This dentist diagnoses and treats.</p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="2000">
                    <div class="overlay-image" style="background-image: url(./img/tooth-clean.jpg);"></div>
                    <div class="carousel-caption">
                        <h3 class="text-white">We will take care of your teeth</h3>
                        <p> Thousands of patients were given a new,<br> beautiful smile thanks to our dental clinic and our dentist.</p>
                    </div>
                </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section class="about-area section-padding" id="about">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2>About Us</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 d-flex flex-column justify-content-center">
                    <p>Our clinic is happy to provide our patients with qualified dental help. For many people attending dentist is always a stress, but here at Mapolon Dental Clinic you will forget about any troubles! Thousands of patients were given a new, beautiful smile thanks to our dental clinic and our doctors.</p>
                    <p><b>Just come to us and experience the most comfortable and relaxed dental healthcare!</b></p>
                </div>
                <div class="col-md-4">
                    <img src="./img/dentist.jpg" alt="">
                </div>
            </div>

        </div>
    </section>

    <section class="services-area section-padding" id="services">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2>Our Services</h2>
                </div>
            </div>

            <div class="row services">
                <div class="col-sm-12 col-md-6 col-lg-4 text-center">
                    <div class="img-area">
                        <img class="img" src="./img/services-img/preventive-care.png" alt="">
                    </div>
                    <h4>Preventive Care</h4>
                    <p>We focus on the overall state of your oral health.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 text-center">
                    <div class="img-area">
                        <img src="./img/services-img/restorative-solution.png" alt="">
                    </div>
                    <h4>Restorative Solutions</h4>
                    <p>Restoring teeth in bad condition is what we specialize in.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 text-center">
                    <div class="img-area">
                        <img src="./img/services-img/braces.png" alt="">
                    </div>
                    <h4>Orthodontics</h4>
                    <p>Diagnodent is an important part of our Orthodontics services.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 text-center mt-5">
                    <div class="img-area">
                        <img src="./img/services-img/pediatric.png" alt="">
                    </div>
                    <h4>Pediatric</h4>
                    <p>It's crucial to check Children's Oral Health even more often, than the adults' teeth.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 text-center mt-5">
                    <div class="img-area">
                        <img src="./img/services-img/diagnostic-preventive.png" alt="">
                    </div>
                    <h4>Diagnostics & Preventive</h4>
                    <p>Teeth cleanings, Fluoride and Sealant are just a few of our advanced diagnostics.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 text-center mt-5">
                    <div class="img-area">
                        <img src="./img/services-img/denture-repair.png" alt="">
                    </div>
                    <h4>Denture Repair</h4>
                    <p>If you need a new denture or if you're in need of fixing your old one, broken denture.</p>
                </div>
            </div>
        </div>
    </section>

    <!--Contact area starts-->
    <section class="contact-area pt-5" id="contact">
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-md-3">
                    <i class="fa fa-map-marker-alt fa-2x"></i>
                    <p>#047 National Road, Pulo Cabuyao, Laguna</p>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-envelope fa-2x"></i>
                    <p>mapolondentalclinic@gmail.com</p>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-phone-alt fa-2x"></i>
                    <p>+63 917-835-6685</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-clock fa-2x"></i>
                    <p>Mon-Sat: 9:00am - 6:00pm</p>
                </div>
            </div>
        </div>
    </section>
    <!--Contact area ends-->


    <style>
        .carousel-item{
            height: 30rem;
            background: #000;
            color: white;
            position: relative;
        }

        .overlay-image{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            opacity: 0.6;
        }
    </style>


    <!-- JS files -->
    <script src="./js/jquery.js"></script>
    <!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>

    <!-- Icons files -->
    <script src="./js/all.js"></script>

    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
<?php 
    include ('includes/footer.php');
?>