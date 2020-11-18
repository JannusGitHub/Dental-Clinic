<?php 
    require('./admin/connection.php');
    session_start();
    if($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])){
        //set status to invalid
        $_SESSION['status'] = 'invalid';
    }

    if($_SESSION['status'] == 'valid'){
        echo ("<script>window.location.href='/Dental-Clinic/admin/index.php</script>");
    }
    

    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $errorEmpty = false;
        $errorLogin = false;

        if(empty($username) || empty($password)){
            echo "<span class='form-error'>Please fill required fields</span>";
            $errorEmpty = true;
        }else{
            if($connection->connect_error){
                die("Failed to connect : " .$connection->connect_error);
            }else{
                $query = "SELECT * FROM user_table WHERE username = '$username' AND password='" . md5($password) . "'";
                $result = $connection->query($query);
                if($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        if($row['user_role'] == 'admin'){
                            $_SESSION['status'] = 'valid';
                            $_SESSION['username'] = $row['username'];

                            echo ("<script>window.location.href='/Dental-Clinic/admin/index.php'</script>");
                        }else{
                            $_SESSION['status'] = 'invalid';
                        }
                    }
                }else{
                    echo "<span class='form-error'>Invalid Username or Password</span>";
                    $errorLogin = true;
                }
            }
        }
    }else{
        echo "<span class='form-error'>Ooops! There was an error!</span>";
    }
?>


<script>
    $('#username, #password').removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorLogin = "<?php echo $errorLogin; ?>";

    if(errorEmpty == true){
        $("#username, #password").addClass("input-error");
    }
    if(errorLogin == true){
        $("#username, #password").addClass("input-error");
    }

    if(errorEmpty == false && errorLogin == false){
        $('#username, #password').val("");
    }
</script>