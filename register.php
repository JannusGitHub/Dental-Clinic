<?php
require('./admin/connection.php');
// Define variables and initialize with empty values
$username = "";
$password = "";
$confirm_password = "";

$username_err = "";
$password_err = "";
$confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM user_table WHERE username = '$username'";
        $result = $connection->query($sql);
            if($result->num_rows == 1){
                $username_err = "This username is already taken.";
            } else{
                $username = trim($_POST["username"]);
            }
    }


    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
}
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="text-center"><i class="fas fa-users icon"></i></div>
            <h2 class="text-center">Sign Up</h2>
            <!--<div class="form-group <?php //echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Full Name</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <span class="help-block"><?php //echo $username_err; ?></span>
            </div>
            <div class="form-group <?php //echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>User Role</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <span class="help-block"><?php //echo $username_err; ?></span>
            </div>-->
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label class="text-white">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label class="text-white">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <!--<div class="form-group <?php //echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Birthday</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <span class="help-block"><?php// echo $username_err; ?></span>
            </div>
            <div class="form-group <?php// echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Age</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <span class="help-block"><?php //echo $username_err; ?></span>
            </div>
            <div class="form-group <?php// echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Mobile #</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <span class="help-block"><?php //echo $username_err; ?></span>
            </div>
            <div class="form-group <?php //echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Full Address </label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <span class="help-block"><?php //echo $username_err; ?></span>
            </div>-->
            
            <div class="form-group">
                <button type="submit" class="btn button btn-lg btn-block">Sign in</button>
            </div>
        </form>
    </div>



    <style>
body {
    height: 100%;   
}
.icon{
    font-size:60px;
    color: white;
}

.has-error, .help-block{
    font-weight: 300;
    color: red;
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
    margin: 10px 0 25px;
    color: #fff;
}
.login-form form {
    height: 500px;
	color: #7a7a7a;
	border-radius: 3px;
	margin-bottom: 15px;
    background: #fff;
    background: linear-gradient(#00c6ff, #0072ff);
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.login-form .btn {        
	font-size: 16px;
	font-weight: bold;
    background: linear-gradient(#00c6ff, #0072ff);
	border: none;
	outline: none !important;
}
.login-form .btn:hover, .login-form .btn:focus {
	background: #2389cd;
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
    
</body><!--Body Ends-->
</html>
