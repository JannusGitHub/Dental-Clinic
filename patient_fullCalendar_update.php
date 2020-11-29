<?php 
    require('./admin/connection.php');
    require('./includes/patient_auth_session.php');

    if(!isset($_SESSION['user']))
    {
        $_SESSION['user'] = session_id(); //generate current session_id for the current user
    }
    $session_uid = $_SESSION['user'];  // set session user to session_uid  
    $datetime_string = date('c',time()); 

    $patientName = $_SESSION['nickname'];
    $patientMobileNumber = $_SESSION['patientMobileNumber'];
    $status = 'Pending'; //default values of Status

    // $data = array();
    // $start = $connection->real_escape_string($_GET["start"]);
    // $end = $connection->real_escape_string($_GET["end"]);
    // $query = "SELECT * FROM appointment_table";

    // $result = $connection->query($query);

    // $result->fetch_all(MYSQLI_ASSOC);

    // foreach($result as $row){
    //     $data[] = array(
    //         'id'                => $row['id'],
    //         'title'             => $row['title'],
    //         'start'             => $row['start_time'],
    //         'end'               => $row['end_time']
    //     );
    // }
    // echo json_encode($data);

    if(isset($_POST["id"])){
        $connection->query("UPDATE appointment_table set 
            title = '".mysqli_real_escape_string($connection,$_POST["title"])."', 
            start_time = '".mysqli_real_escape_string($connection,($_POST["start"]))."', 
            end_time = '".mysqli_real_escape_string($connection,($_POST["end"]))."'
            WHERE id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
        exit;
    }
    
    
    // if(isset($_POST['action']) or isset($_GET['view'])){
    //     if(isset($_GET['view'])){
    //         header('Content-Type: application/json');
    //         $start = $connection->mysqli_real_escape_string($_GET["start"]);
    //         $end = $connection->mysqli_real_escape_string($_GET["end"]);
            
    //         $result = $connection->query("SELECT id, title, start_time, end_time FROM appointment_table WHERE (date(start) >= '$start' AND date(start) <= '$end') AND session_uid='".$session_uid."'");
            
    //         while($row = fetch_assoc($result)){
    //             $events[] = $row; 
    //         }
    //         echo json_encode($events); 
    //         exit;
    //     }
    //     elseif($_POST['action'] == "add"){
    //         $connection->query("INSERT INTO appointment_table (
    //             title,
    //             start_time,
    //             end_time,
    //             patient_name,
    //             patient_mobile_number,
    //             status,
    //             session_uid
    //             )
    //             VALUES (
    //             '".mysqli_real_escape_string($connection,$_POST["title"])."',
    //             '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["start"])))."',
    //             '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["end"])))."',
    //             '".mysqli_real_escape_string($connection,$patientName)."',
    //             '".mysqli_real_escape_string($connection,$patientMobileNumber)."',
    //             '".mysqli_real_escape_string($connection,$status)."',
    //             '".mysqli_real_escape_string($connection,$session_uid)."'
    //             )");
    //         header('Content-Type: application/json');
    //         echo '{"id":"'.mysqli_insert_id($connection).'"}';
    //         exit;
    //     }
    //     elseif($_POST['action'] == "update"){
    //         $connection->query("UPDATE appointment_table set 
    //             title = '".mysqli_real_escape_string($connection,$_POST["title"])."', 
    //             start_time = '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', 
    //             end_time = '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["end"])))."',
    //             patient_name = '".mysqli_real_escape_string($connection,$patientName)."',
    //             patient_mobile_number = '".mysqli_real_escape_string($connection,$patientMobileNumber)."',
    //             status = '".mysqli_real_escape_string($connection,$status)."',
    //             where session_uid = '".mysqli_real_escape_string($connection,$session_uid)."' and id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
    //         exit;
    //     }
    //     elseif($_POST['action'] == "delete"){
    //         $connection->query("DELETE from appointment_table where session_uid = '".mysqli_real_escape_string($connection,$session_uid)."' and id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
    //         if (mysqli_affected_rows($connection) > 0) {
    //             echo "1";
    //         }
    //         exit;
    //     }
    // }
    
?>